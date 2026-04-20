<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\PostCategory;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['public.*', 'admin.*'], function ($view) {
            $settings = SiteSetting::query()->where('is_public', true)->get()->pluck('value', 'key');

            $view->with('siteSettings', $settings);
        });

        View::composer(['public.*'], function ($view) {
            $view->with('publicCategories', PostCategory::query()->orderBy('name')->get());
            $view->with('headerAnnouncements', Announcement::query()->where('status', 'published')->latest('event_date')->take(3)->get());
        });
    }
}
