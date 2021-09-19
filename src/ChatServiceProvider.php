<?php


namespace Chareice\LaravelChat;


use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/chat.php', 'chat');
    }
}