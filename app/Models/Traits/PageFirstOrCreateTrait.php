<?php

namespace App\Models\Traits;

use App\Models\Page;

trait PageFirstOrCreateTrait
{
    public function pageFirstOrCreate($slug): Page
    {
        $page = null;
        foreach (config('main.pages') as $type => $slugs) {

            foreach ($slugs as $config_slug) {
                $item = Page::firstOrCreate([
                    'slug' => $config_slug
                ], [
                    'name' => __('admin.' . $config_slug),
                    'type' => $type
                ]);

                if ($item->slug == $slug) {
                    $page = $item;
                }
            }
        }

        return $page ?? new Page();
    }
}
