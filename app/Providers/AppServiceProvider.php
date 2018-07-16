<?php

namespace App\Providers;

use App\Repositories\Messages;
use App\Repositories\CacheMessages;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MessagesInterface;


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

        $this->app->bind(MessagesInterface::class, CacheMessages::class);

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
