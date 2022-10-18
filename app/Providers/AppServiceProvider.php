<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('layout.sidebar', function ($view) {
            $view->with('tagsCloud', \App\Models\Tag::tagsCloud());
        });

        \Blade::directive('datatime', function ($value) {
            return "<?php echo ($value)->toFormattedDateString(); ?>";
        });

        \Blade::if('admin', function () {

            if ( Auth::user() !== null ) {
                return User::with('role')->where('name', Auth::user()->name)->first()->role->first()->name === 'admin';
            }
        });
    }
}
