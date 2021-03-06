<?php

namespace App\Providers;

use App\Http\Repositories\MapRepository;
use App\Model\Comment;
use App\Model\Page;
use App\Model\Post;
use App\Observers\CommentObserver;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Comment::observe(CommentObserver::class);
        Post::observe(PostObserver::class);
        Page::observe(PageObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('XblogConfig', function ($app) {
            return new MapRepository();
        });
    }
}
