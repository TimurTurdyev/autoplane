<?php

namespace App\Orchid\Layouts\Page;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class PageDefaultLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('page.name')
                    ->type('text')
                    ->readonly(true)
                    ->max(255)
                    ->required()
                    ->title(__('Name'))
                    ->placeholder(__('Name'))
                    ->help(__('Общее название - должно быть уникально что бы не путаться потом')),

                Input::make('page.slug_read')
                    ->type('text')
                    ->readonly(true)
                    ->required()
                    ->title(__('Slug'))
                    ->placeholder(__('Slug'))
                    ->help(__('Сео урл уникален на всю систему')),
            ]),
            Input::make('page.heading')
                ->type('text')
                ->max(255)
                ->title('Заголовок')
                ->placeholder(__('Заголовок'))
                ->help(__('Используется на странице. До 255 символов.')),

            Input::make('page.meta_title')
                ->type('text')
                ->max(255)
                ->title('Сео заголовок')
                ->placeholder(__('Сео заголовок'))
                ->help(__('Используется для поисковых роботов. До 255 символов.')),

            TextArea::make('page.meta_description')
                ->max(255)
                ->title('Сео описание')
                ->placeholder(__('Сео описание'))
                ->help(__('Используется для поисковых роботов. До 255 символов.')),

            Quill::make('page.body')
                ->title('Описание')
                ->toolbar(['text', 'color', 'header', 'list', 'format', 'tables']),

            Input::make('page.id')
                ->type('hidden'),

            Input::make('page.slug')
                ->type('hidden'),

            Input::make('page.type')
                ->type('hidden'),
        ];
    }
}
