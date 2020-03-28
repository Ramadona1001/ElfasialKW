<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Cookie;
use App\Setting;
use App\SoicalMedia;
use App\Category;

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
        app()->singleton('lang',function(){
            if(Cookie::has('webLanG')){
                return Cookie::get('webLanG');
            }else{
                return 'en';
            }
        });

        $lang = \Lang::getLocale();
        $soicalMedia = SoicalMedia::findOrfail(1);
        $settings = Setting::findOrfail(1);
        $all_categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id','created_at')->orderBy('id','desc')->limit(3)->get();

        View::share('system_facebook',$soicalMedia->facebook);
        View::share('system_twitter',$soicalMedia->twitter);
        View::share('system_instagram',$soicalMedia->instagram);
        View::share('system_mobile',$settings->phone_number);
        View::share('system_description',$settings->description);
        View::share('system_title',$settings->title);
        View::share('system_logo',$settings->logo);
        View::share('system_email',$settings->email);
        View::share('system_currency',$settings->currency);
        View::share('system_all_categories',$all_categories);
        View::share('system_en_terms',$settings->en_terms_conditions);
        View::share('system_ar_terms',$settings->ar_terms_conditions);


        Schema::defaultStringLength(191);
    }
}
