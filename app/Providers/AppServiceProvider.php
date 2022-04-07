<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Journal;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['transactions._form'], function ($view) {
            $view->with('journals', Journal::all());
        });
        View::composer(['transactions._line'], function ($view) {
            $view->with('accounts', Account::orderBy('code')->get());
        });
    }
}
