<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use PageFirstOrCreateTrait;

    public function __invoke(Page $page, Request $request)
    {
        if (!$page->exists) {
            $page = $this->pageFirstOrCreate($request->path());
        }

        return view('page', compact('page'));
    }
}
