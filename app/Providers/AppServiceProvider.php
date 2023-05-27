<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $event)
    {
        Schema::defaultStringLength(191);
        // Pagination
       // Paginator::useBootstrap();

        // Create new Validation for Phone Number Format
        //Validator::extend('phone_number', function($attribute, $value, $parameters){
           // return substr($value, 0, 2) == '08';
        //});
        //Validator::replacer('phone_number', function($message, $attribute, $rule, $parameters){
          //  return str_replace(':attribute', $attribute, 'Format Nomor Telpon tidak sesuai, mohon gunakan format 08xxxxxxxxxx');
        //});
        $event->listen(BuildingMenu::class, function (BuildingMenu $event) {

        });

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}
