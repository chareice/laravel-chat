<?php


namespace Chareice\LaravelChat;


use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            \dirname(__DIR__) . '/database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/chat.php', 'chat');
    }
}