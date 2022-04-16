<?php

namespace App\Orchid\Screens\Service;

use App\Models\Page;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use function __;
use function redirect;

class ServiceScreen extends Screen
{

    private $services = [];

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->services = Page::where('type', 'service')->get();

        return [
            'services' => $this->services,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Услуги';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Add'))
                ->icon('plus')
                ->method('add')
                ->canSee($this->services->count() !== count(config('main.pages.service'))),
        ];
    }

    public function add()
    {
        foreach (config('main.pages') as $type => $slugs) {
            foreach ($slugs as $slug) {
                Page::firstOrCreate(['slug' => $slug], ['type' => $type, 'name' => __('admin.' . $slug)]);
            }
        }

        Toast::info('Услуги успешно добавлены. Можете приступать к редактированию!');

        return redirect()->route('services');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('services', [
                TD::make('name', __('Name'))
                    ->cantHide()
                    ->render(function (Page $page) {
                        return $page->name;
                    }),

                TD::make('slug', __('Slug'))
                    ->cantHide()
                    ->render(function (Page $page) {
                        return $page->slug;
                    }),

                TD::make(__('Actions'))
                    ->cantHide()
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Page $page) {
                        return Link::make(__('Edit'))
                            ->route('services.edit', $page->id)
                            ->icon('pencil');
                    }),
            ]),
        ];
    }
}
