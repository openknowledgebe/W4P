<?php

use Illuminate\Database\Seeder;

use W4P\Models\Page;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DefaultPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create(
            [
                "title" => trans('how_does_it_work'),
                "slug" => "how_it_works",
                "content" => "",
                "default" => true
            ]
        );
        Page::create(
            [
                "title" => trans('press_materials'),
                "slug" => "press",
                "content" => "",
                "default" => true
            ]
        );
        Page::create(
            [
                "title" => trans('privacy_policy'),
                "slug" => "privacy_policy",
                "content" => "",
                "default" => true
            ]
        );
        Page::create(
            [
                "title" => trans('terms_of_use'),
                "slug" => "terms_of_use",
                "content" => "",
                "default" => true
            ]
        );
    }
}
