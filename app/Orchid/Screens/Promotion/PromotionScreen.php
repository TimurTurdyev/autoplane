<?php

namespace App\Orchid\Screens\Promotion;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\Traits\PageHomeFirstOrCreateTrait;
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

class PromotionScreen extends Screen
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
        $this->page = $this->pageFirstOrCreate('promotion');;

        return [
            'page' => $this->page,
            'promotions' => $this->page->promotions()
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
        return 'Список акций';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить акцию')
                ->icon('plus')
                ->route('promotions.create'),

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
            Layout::tabs([
                'Список акций' => Layout::table('promotions', [
                    TD::make('photo', 'Фото')
                        ->cantHide()
                        ->width(200)
                        ->render(function (Promotion $promotion) {
                            if ($promotion->photo) {
                                return "<img src='{$promotion->photo}' class='mw-100 d-block img-fluid'>";;
                            }
                            return '';
                        }),

                    TD::make('name', 'Название акции')
                        ->cantHide()
                        ->render(function (Promotion $promotion) {
                            return $promotion->name;
                        }),

                    TD::make('updated_at', 'Создан')
                        ->sort()
                        ->render(function (Promotion $promotion) {
                            return $promotion->created_at->toDateTimeString();
                        }),

                    TD::make('updated_at', 'Обновлен')
                        ->sort()
                        ->render(function (Promotion $promotion) {
                            return $promotion->updated_at->toDateTimeString();
                        }),

                    TD::make(__('Actions'))
                        ->cantHide()
                        ->align(TD::ALIGN_CENTER)
                        ->width('100px')
                        ->render(function (Promotion $promotion) {
                            return DropDown::make()
                                ->icon('options-vertical')
                                ->list([
                                    Link::make(__('Edit'))
                                        ->route('promotions.edit', $promotion->id)
                                        ->icon('pencil'),

                                    Button::make(__('Delete'))
                                        ->icon('trash')
                                        ->confirm('Что хотите удалить запись?')
                                        ->method('remove', [
                                            'id' => $promotion->id,
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
        Promotion::findOrFail($request->get('id'))->delete();

        Toast::info('Запись удалена');
    }
}
