<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\BookRepositoryInterface::class,
            \App\Repositories\BookRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\AuthorRepositoryInterface::class,
            \App\Repositories\AuthorRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\PublisherRepositoryInterface::class,
            \App\Repositories\PublisherRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
