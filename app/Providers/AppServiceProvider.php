<?php

namespace App\Providers;

use App\Service\AuthService;
use App\Service\BookService;
use App\Service\CartService;
use App\Service\CategoryService;
use App\Service\CommentService;
use App\Service\Impl\AuthServiceImpl;
use App\Service\Impl\BookServiceImpl;
use App\Service\Impl\CartServiceImpl;
use App\Service\Impl\CategoryServiceImpl;
use App\Service\Impl\CommentServiceImpl;
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
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthServiceImpl();
        });
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryServiceImpl();
        });
        $this->app->bind(BookService::class, function ($app) {
            return new BookServiceImpl();
        });
        $this->app->bind(CommentService::class, function ($app) {
            return new CommentServiceImpl();
        });
        $this->app->bind(CartService::class, function ($app) {
            return new CartServiceImpl();
        });
    }
}
