<?php

namespace App\Orchid\Screens\Traits;

use App\Http\Requests\PageRequest;
use App\Orchid\Layouts\Page\PageDefaultLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

trait PageDefaultScreen
{
    public function name(): ?string
    {
        return 'Редактирование';
    }

    /**
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    public function save(PageRequest $request)
    {
        $page = $this->query()['page'];
        $redirect_route = $this->query()['redirect_route'];

        $request_data = $request->validated('page');

        $page->fill($request_data)->save();

        Toast::info(__('Страница обновлена.'));

        return redirect()->route($redirect_route);
    }

    /**
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::tabs([
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
}
