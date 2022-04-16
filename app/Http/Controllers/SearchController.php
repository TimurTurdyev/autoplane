<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $content = Page::select('id', 'name', 'type', 'slug')
            ->search($request->get('q', ''))
            ->limit(10)
            ->get()->map(function ($item) {
                return [
                    'name' => $item->name,
                    'value' => $item->slug,
                    'data' => [],
                ];
            });
        return response()->json($content);
    }
}
