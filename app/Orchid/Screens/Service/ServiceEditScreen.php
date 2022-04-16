<?php

namespace App\Orchid\Screens\Service;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Orchid\Layouts\Page\PageDefaultLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use function __;
use function abort_if;
use function redirect;

class ServiceEditScreen extends Screen
{
    private ?Page $page = null;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Page $page): iterable
    {
        $this->page = $page->load('attachment');

        return [
            'page' => $this->page,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->page->name;
    }

    /**
     * Button commands.
     *
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

    public function save(Page $page, PageRequest $request)
    {
        $request_data = $request->validated('page');
        $page->fill($request_data)->save();

        Toast::info(__('Страница услуги обновлена.'));

        return redirect()->route('services');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $tabs = [
            'Общая информация' => PageDefaultLayout::class,
            'Медиа' => Layout::rows([
                Cropper::make('page.hero')
                    ->targetRelativeUrl()
                    ->title('Главный баннер')
                    ->width(1000)
                    ->height(500),
            ]),
        ];

        if ($table = $this->getTable()) {
            $tabs['Таблица цен'] = $table;
        }

        return [
            Layout::tabs($tabs),
        ];
    }

    private function getTable()
    {
        if ($this->page->slug === 'tire-service') {
            return Layout::rows([
                Matrix::make('page.setting')
                    ->title('Таблица расценок')
                    ->columns([
                        'Виды услуг' => 'services',
                        'Л 12-16' => 'size1',
                        'Л 17' => 'size2',
                        'Л 18' => 'size3',
                        'Л 19' => 'size4',
                        'Л 20' => 'size5',
                        'Л 21' => 'size6',
                        'Л 22' => 'size7',
                        'Г 15-18' => 'size8',
                        'Г 19' => 'size9',
                        'Г 20' => 'size10',
                        'Г 21' => 'size11',
                        'Г 22' => 'size12',
                        'Г 23-26' => 'size13',
                    ])
            ]);
        }
        return Layout::rows([
            Matrix::make('page.setting')
                ->title('Таблица расценок')
                ->columns([
                    'Категория автотранспорта' => 'type',
                    'I группа' => 'group1',
                    'II группа' => 'group2',
                    'III группа' => 'group3',
                    'IV группа' => 'group4',
                    'V группа' => 'group5',
                ])
        ]);
    }
}
