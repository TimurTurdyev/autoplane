<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        foreach (config('main.pages') as $type => $slugs) {
//            foreach ($slugs as $slug) {
//                Page::firstOrCreate(['slug' => $slug], ['type' => $type, 'name' => __('admin.' . $slug)]);
//            }
//        }
    }
}
