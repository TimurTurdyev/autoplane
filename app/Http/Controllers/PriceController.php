<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    use PageFirstOrCreateTrait;

    public function __invoke(Page $page, Request $request)
    {
        if (!$page->exists) {
            $page = $this->pageFirstOrCreate($request->path());
        }

        $prices = Page::where('type', 'service')->where('slug', '<>', $request->path())->get();

        return view('price', compact('page', 'prices'));
    }
}
