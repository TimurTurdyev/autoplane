<?php

namespace App\Orchid\Screens\Gallery;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;
use Orchid\Alert\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class GalleryEditScreen extends Screen
{
    use PageFirstOrCreateTrait;

    private ?Gallery $gallery = null;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Gallery $gallery): iterable
    {
        $page = $this->pageFirstOrCreate('gallery');
        $gallery->load('attachment');
        $this->gallery = $gallery;
        $this->gallery->page_id = $page->id;

        return [
            'gallery' => $this->gallery
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->gallery->exist ? 'Редактирование' : 'Создание';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->gallery->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    public function remove(Gallery $gallery)
    {
        $gallery->attachment()->delete();
        $gallery->delete();

        \Orchid\Support\Facades\Toast::info(__('Галерея удалена'));

        return redirect()->route('galleries');
    }

    public function save(Request $request, Gallery $gallery)
    {
        $page = Page::firstOrCreate([
            'slug' => 'gallery'
        ], [
            'name' => 'Галерея работ',
            'type' => 'gallery'
        ]);

        $request_data = $request->validate([
            'gallery.name' => 'required|string|max:255'
        ]);

        $gallery->fill(array_merge($request_data['gallery'], ['page_id' => $page->id]))->save();

        $gallery->touch();

        $gallery->attachment()->syncWithoutDetaching(
            $request->input('gallery.attachment', [])
        );

        \Orchid\Support\Facades\Toast::info(__('Вы успешно сохранили галерею.'));

        return redirect()->route('galleries');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('gallery.name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Upload::make('gallery.attachment')
                    ->acceptedFiles('image/*')
                    ->title(__('Фотографии')),
            ])
        ];
    }
}
