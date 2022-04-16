<?php

namespace App\Orchid\Screens\Gallery;

use App\Http\Requests\PageRequest;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Traits\PageFirstOrCreateTrait;
use App\Orchid\Layouts\Page\PageDefaultLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class GalleryScreen extends Screen
{
    use PageFirstOrCreateTrait;
    private $page;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->page = $this->pageFirstOrCreate('gallery');

        return [
            'page' => $this->page,
            'galleries' => $this->page->galleries()
                ->filters()
                ->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список фото';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить альбом')
                ->icon('plus')
                ->route('galleries.create'),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save', ['id' => $this->page->id]),
        ];
    }

    public function save(Page $page, PageRequest $request)
    {
        $request_data = $request->validated('page');

        $page->fill($request_data)->save();

        Toast::info(__('Страница обновлена.'));

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
            Layout::tabs([
                'Список альбомов' => Layout::table('galleries', [
                    TD::make('id', __('Id'))
                        ->cantHide()
                        ->render(function (Gallery $gallery) {
                            return $gallery->id;
                        }),

                    TD::make('name', 'Название альбома')
                        ->cantHide()
                        ->render(function (Gallery $gallery) {
                            return $gallery->name;
                        }),

                    TD::make('photos', 'Кол-во фото')
                        ->cantHide()
                        ->render(function (Gallery $gallery) {
                            return $gallery->attachment->count();
                        }),

                    TD::make('updated_at', 'Создан')
                        ->sort()
                        ->render(function (Gallery $gallery) {
                            return $gallery->created_at->toDateTimeString();
                        }),

                    TD::make('updated_at', 'Обновлен')
                        ->sort()
                        ->render(function (Gallery $gallery) {
                            return $gallery->updated_at->toDateTimeString();
                        }),

                    TD::make(__('Actions'))
                        ->cantHide()
                        ->align(TD::ALIGN_CENTER)
                        ->width('100px')
                        ->render(function (Gallery $gallery) {
                            return DropDown::make()
                                ->icon('options-vertical')
                                ->list([
                                    Link::make(__('Edit'))
                                        ->route('galleries.edit', $gallery->id)
                                        ->icon('pencil'),

                                    Button::make(__('Delete'))
                                        ->icon('trash')
                                        ->confirm('Что хотите удалить запись?')
                                        ->method('remove', [
                                            'id' => $gallery->id,
                                        ]),
                                ]);
                        }),
                ]),
                'Общая информация' => PageDefaultLayout::class,
                'Медиа' => Layout::rows([
                    Cropper::make('page.hero')
                        ->targetRelativeUrl()
                        ->title('Главный баннер')
                        ->width(1000)
                        ->height(500),
                ]),
            ]),
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Gallery::findOrFail($request->get('id'))->delete();

        Toast::info('Запись удалена');
    }
}
