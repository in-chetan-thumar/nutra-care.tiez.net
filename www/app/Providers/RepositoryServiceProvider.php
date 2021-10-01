<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('users', \App\Repositories\UsersRepository::class);
        $this->app->singleton('contact', \App\Repositories\ContactRepository::class);
        $this->app->singleton('attribute', \App\Repositories\AttributeRepository::class);
        $this->app->singleton('inquiry', \App\Repositories\InquiryRepository::class);
        $this->app->singleton('category', \App\Repositories\CategoryRepository::class);
        $this->app->singleton('product', \App\Repositories\ProductRepository::class);
        $this->app->singleton('pages', \App\Repositories\PageRepository::class);
        $this->app->singleton('notification', \App\Repositories\NotificationRepository::class);
        $this->app->singleton('news-category', \App\Repositories\NewsCategoryRepository::class);
        $this->app->singleton('news', \App\Repositories\NewsRepository::class);
		$this->app->singleton('wallpaper-category', \App\Repositories\WallpaperCategoryRepository::class);
		$this->app->singleton('wallpaper', \App\Repositories\WallpaperRepository::class);
		$this->app->singleton('wallpaper-comment', \App\Repositories\WallpaperCommentRepository::class);
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
