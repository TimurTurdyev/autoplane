<?php

namespace App\Orchid\Screens\Promotion;

use App\Models\Promotion;
use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PromotionEditScreen extends Screen
{
    use PageFirstOrCreateTrait;

    private ?Promotion $promotion = null;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Promotion $promotion): iterable
    {
        $page = $this->pageFirstOrCreate('promotion');
        $promotion->load('attachment');
        $this->promotion = $promotion;
        $this->promotion->page_id = $page->id;

        return [
            'promotion' => $this->promotion
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->promotion->exist ? 'Редактирование' : 'Создание';
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
                ->canSee($this->promotion->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    public function remove(Promotion $promotion)
    {
        $promotion->attachment()->delete();
        $promotion->delete();

        \Orchid\Support\Facades\Toast::info(__('Акция удалена'));

        return redirect()->route('galleries');
    }

    public function save(Request $request, Promotion $promotion)
    {
        $page = $this->pageFirstOrCreate('promotion');

        $request_data = $request->validate([
            'promotion.name' => 'required|string|max:255',
            'promotion.photo' => 'required|string|max:255',
            'promotion.description' => 'required|string',
        ]);

        $promotion->fill(array_merge($request_data['promotion'], ['page_id' => $page->id]))->save();

        $promotion->touch();

        \Orchid\Support\Facades\Toast::info(__('Вы успешно сохранили акцию.'));

        return redirect()->route('promotions');
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
                Input::make('promotion.name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Quill::make('promotion.description')
                    ->required()
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Cropper::make('promotion.photo')
                    ->targetRelativeUrl()
                    ->title('Фото')
                    ->width(500)
                    ->height(500),
            ])
        ];
    }
}
