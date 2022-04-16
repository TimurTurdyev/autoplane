<?php

namespace App\Orchid\Screens\Home;

use App\Models\Traits\PageFirstOrCreateTrait;
use App\Orchid\Screens\Traits\PageDefaultScreen;
use Orchid\Screen\Screen;

class HomeScreen extends Screen
{
    use PageDefaultScreen, PageFirstOrCreateTrait;

    public function query(): iterable
    {
        return [
            'redirect_route' => 'home.edit',
            'page' => $this->pageFirstOrCreate('home')
        ];
    }
}
