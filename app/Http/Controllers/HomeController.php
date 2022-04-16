<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use PageFirstOrCreateTrait;

    public function __invoke()
    {
        $page = $this->pageFirstOrCreate('home');

        $promotions = Promotion::orderByDesc('id')->limit(5)->get();
        $galleries = Gallery::orderByDesc('updated_at')->with(['attachment' => function ($query) {
            $query->limit(2);
        }])->get();

        return view('home', compact('page', 'promotions', 'galleries'));
    }
}
