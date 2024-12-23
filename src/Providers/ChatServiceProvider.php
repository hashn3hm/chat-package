<?php

namespace Hasicode\Chats\Providers;

use Illuminate\Support\ServiceProvider;
use Hasicode\Chats\Middleware\EnsureChatParticipant;

class ChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        // Load API routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        // Load Web routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        // Publish migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // Publish models if necessary
        $this->publishes([
            __DIR__ . '/../Config/chat.php' => config_path('chat.php'),
        ], 'config');

        // Publish Migrations
        $this->publishes([
            __DIR__ . '/../Database/Migrations/' => database_path('migrations'),
        ], 'migrations');

        // Publish Views
        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('views/'),
        ], 'views');

        // Publish Controllers
        $this->publishes([
            __DIR__ . '/../Http/Controllers' => app_path('Http/Controllers'),
        ], 'controllers');

        // Publish Models
        $this->publishes([
            __DIR__ . '/../Models' => app_path('Models'),
        ], 'models');

        // Register middleware dynamically
        $this->registerMiddleware();
    }

    protected function registerMiddleware()
    {
        $router = $this->app['router'];

        // Register the middleware
        $router->aliasMiddleware('chat.participant', EnsureChatParticipant::class);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        // Register config
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/chat.php',
            'chats'
        );
    }
}
