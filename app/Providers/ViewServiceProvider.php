<?php
namespace App\Providers;

use App\View\Composers\DefaultCRUDComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // View::composer('*', function ($view) {
        //     View::share('view_name', $view->getName());
        // });
        // View::composer(
        //     ['management.assemblies.index'], 
                
        //         DefaultCRUDComposer::class

            
        // );
    }
}