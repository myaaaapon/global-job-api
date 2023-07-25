<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;
use App\Application\Contracts\UserUseCaseInterface;
use App\Application\UseCases\UserUseCase;
use App\Application\Contracts\JobUseCaseInterface;
use App\Application\UseCases\JobUseCase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserUseCaseInterface::class, UserUseCase::class);
        $this->app->bind(JobUseCaseInterface::class, JobUseCase::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
