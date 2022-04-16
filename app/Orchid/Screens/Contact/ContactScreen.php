<?php

namespace App\Orchid\Screens\Contact;

use App\Models\Traits\PageFirstOrCreateTrait;
use App\Orchid\Screens\Traits\PageDefaultScreen;
use Orchid\Screen\Screen;

class ContactScreen extends Screen
{
    use PageDefaultScreen, PageFirstOrCreateTrait;

    public function query(): iterable
    {
        return [
            'redirect_route' => 'contact.edit',
            'page' => $this->pageFirstOrCreate('contact')
        ];
    }
}
