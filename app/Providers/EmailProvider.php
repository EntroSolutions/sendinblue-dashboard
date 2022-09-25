<?php

namespace App\Providers;

use App\EmailProvider\SendInBlueProvider;
use Illuminate\Support\ServiceProvider;
use App\EmailProvider\EmailProviderInterface;

class EmailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmailProviderInterface::class, SendInBlueProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
