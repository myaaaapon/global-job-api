<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;
use App\Application\Contracts\UserUseCaseInterface;
use App\Application\UseCases\UserUseCase;
use App\Application\Contracts\JobUseCaseInterface;
use App\Application\UseCases\JobUseCase;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\UserRepository;
use App\Domain\Repositories\JobRepositoryInterface;
use App\Infrastructure\Repositories\JobRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // UseCaseのバインド
        $this->app->bind(UserUseCaseInterface::class, UserUseCase::class);
        $this->app->bind(JobUseCaseInterface::class, JobUseCase::class);

        // Repositoryのバインド
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
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
