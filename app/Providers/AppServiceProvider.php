<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\SystemSetting;
use App\Models\Category;

use DB;


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

        $tables = DB::select('SHOW TABLES');
        dd($tables);

        $AllCategories = Category::get();
        View::share([
            // 'AllCategories' => $AllCategories,
            'assetVer' => SystemSetting::where('key', 'AssetCache')->first()->value,
            ]);
    }
}
