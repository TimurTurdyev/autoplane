<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Услуги')
                ->icon('monitor')
                ->route('services')
                ->title('Страницы'),

            Menu::make('Список акций')
                ->icon('monitor')
                ->route('promotions'),

            Menu::make('Галерея работ')
                ->icon('monitor')
                ->route('galleries'),

            Menu::make('Главная')
                ->icon('monitor')
                ->route('home.edit'),

            Menu::make('Контакты')
                ->icon('monitor')
                ->route('contact.edit'),
            Menu::make('О нас')
                ->icon('monitor')
                ->route('about.edit'),

            Menu::make('Настройки')
                ->icon('monitor')
                ->route('settings')
                ->title('Настройки'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
