<?php

namespace App\Orchid\Screens\Service;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Orchid\Layouts\Page\PageDefaultLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Quill;
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
        if ($this->page->slug === 'seasonal-tire-storage') {
            return Layout::rows([
                Matrix::make('page.setting.data0')
                    ->title('Таблица расценок')
                    ->columns([
                        'Категория' => 'value0',
                        'R13-R15' => 'value1',
                        'R16-R17' => 'value2',
                        'R18-R19' => 'value3',
                        'R20-R21' => 'value4',
                    ]),
                Quill::make('page.setting.text0')
                    ->title('Доп информация под таблицей'),
            ]);
        }
        if ($this->page->slug === 'tire-service') {
            return Layout::rows([
                Matrix::make('page.setting.data0')
                    ->title('Таблица расценок')
                    ->columns([
                        'Виды услуг' => 'value0',
                        'Л 12-16' => 'value1',
                        'Л 17' => 'value2',
                        'Л 18' => 'value3',
                        'Л 19' => 'value4',
                        'Л 20' => 'value5',
                        'Л 21' => 'value6',
                        'Л 22' => 'value7',
                        'Г 15-18' => 'value8',
                        'Г 19' => 'value9',
                        'Г 20' => 'value10',
                        'Г 21' => 'value11',
                        'Г 22' => 'value12',
                        'Г 23-26' => 'value13',
                    ]),
                Quill::make('page.setting.text0')
                    ->title('Доп информация под таблицей'),
            ]);
        }
        return Layout::rows([
            Matrix::make('page.setting.data0')
                ->title('Таблица расценок')
                ->columns([
                    'Категория автотранспорта' => 'value0',
                    'I группа' => 'value1',
                    'II группа' => 'value2',
                    'III группа' => 'value3',
                    'IV группа' => 'value4',
                    'V группа' => 'value5',
                ]),
            Quill::make('page.setting.text0')
                ->title('Доп информация под таблицей'),
        ]);
    }
}
