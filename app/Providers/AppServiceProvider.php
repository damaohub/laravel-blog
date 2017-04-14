<?php

namespace App\Providers;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Navs;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share([
            'sitename'=>'damaohub',
            'navs'=>Navs::all(),
            'lasts'=> Article::orderby('art_time','desc')->take(3)->get(),
            'cates'=> Category::all(),
            'tags'=> Article::lists('art_tag')->unique()->all()
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
