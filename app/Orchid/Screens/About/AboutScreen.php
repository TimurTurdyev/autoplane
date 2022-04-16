<?php

namespace App\Orchid\Screens\About;

use App\Models\Traits\PageFirstOrCreateTrait;
use App\Orchid\Screens\Traits\PageDefaultScreen;
use Orchid\Screen\Screen;

class AboutScreen extends Screen
{
    use PageDefaultScreen, PageFirstOrCreateTrait;

    public function query(): iterable
    {
        return [
            'redirect_route' => 'about.edit',
            'page' => $this->pageFirstOrCreate('about-us')
        ];
    }
}
