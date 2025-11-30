<?php

declare(strict_types=1);

namespace RashidLaasri\YCODE;

use Illuminate\Support\ServiceProvider;

class YCodeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(YCode::class,
            fn (): YCode => new YCode(new Config(config('ycode.base_url'), config('ycode.token')))
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/ycode.php' => config_path('ycode.php'),
        ]);
    }
}
