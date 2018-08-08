<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /*

        \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
           echo '<pre>';
           print_r([ $query->sql, $query->bindings, $query->time]);
           echo '</pre>';
       });

       */
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
