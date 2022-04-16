<?php

declare(strict_types=1);

use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Services
Route::screen('services/{service}/edit', \App\Orchid\Screens\Service\ServiceEditScreen::class)
    ->name('services.edit')
    ->breadcrumbs(function (Trail $trail, $service) {
        return $trail
            ->parent('services')
            ->push('Редактирование', route('services.edit', $service));
    });

Route::screen('services', \App\Orchid\Screens\Service\ServiceScreen::class)
    ->name('services')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Услуги', route('services'));
    });

// Home
Route::screen('home/edit', \App\Orchid\Screens\Home\HomeScreen::class)->name('home.edit');
Route::screen('contact/edit', \App\Orchid\Screens\Contact\ContactScreen::class)->name('contact.edit');
Route::screen('about/edit', \App\Orchid\Screens\About\AboutScreen::class)->name('about.edit');

// Galleries
Route::screen('galleries/create', \App\Orchid\Screens\Gallery\GalleryEditScreen::class)
    ->name('galleries.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('galleries')
            ->push('Создать', route('galleries.create'));
    });

Route::screen('galleries/{gallery}/edit', \App\Orchid\Screens\Gallery\GalleryEditScreen::class)
    ->name('galleries.edit')
    ->breadcrumbs(function (Trail $trail, $gallery) {
        return $trail
            ->parent('galleries')
            ->push('Редактирование', route('galleries.edit', [$gallery]));
    });

Route::screen('galleries', \App\Orchid\Screens\Gallery\GalleryScreen::class)
    ->name('galleries')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Галерея работ', route('galleries'));
    });

// Promotions
Route::screen('promotions/create', \App\Orchid\Screens\Promotion\PromotionEditScreen::class)
    ->name('promotions.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('promotions')
            ->push('Создать', route('promotions.create'));
    });

Route::screen('promotions/{page}/edit', \App\Orchid\Screens\Promotion\PromotionEditScreen::class)
    ->name('promotions.edit')
    ->breadcrumbs(function (Trail $trail, $page) {
        return $trail
            ->parent('promotions')
            ->push('Редактирование', route('promotions.edit', $page));
    });

Route::screen('promotions', \App\Orchid\Screens\Promotion\PromotionScreen::class)
    ->name('promotions')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Список акций', route('promotions'));
    });

// Settings
Route::screen('settings', \App\Orchid\Screens\Setting\SettingScreen::class)
    ->name('settings')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Настройки', route('settings'));
    });
