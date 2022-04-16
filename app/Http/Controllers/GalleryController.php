<?php

namespace App\Http\Controllers;

use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class GalleryController extends Controller
{
    use PageFirstOrCreateTrait;
    public function __invoke()
    {
        $page = $this->pageFirstOrCreate('gallery');

        $galleries = $page->galleries()->with('attachment')->paginate();
        Paginator::useBootstrapFour();
        return view('gallery', compact('page', 'galleries'));
    }
}
