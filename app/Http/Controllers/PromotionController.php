<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Traits\PageFirstOrCreateTrait;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PromotionController extends Controller
{
    use PageFirstOrCreateTrait;
    public function __invoke()
    {
        $page = $this->pageFirstOrCreate('promotion');

        $promotions = $page->promotions()->paginate();
        Paginator::useBootstrapFour();
        return view('promotion', compact('page', 'promotions'));
    }
}
