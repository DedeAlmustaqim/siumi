<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $data = DB::table('config')->first();
        $config = DB::table('config')->first();
        $kategori = DB::table('kategori')->get();
        View::share('category', $kategori);
        View::share('config', $config);
    }
}
