<?php

use Chareice\LaravelChat\Models\ChatMessage;
use Tests\CompanyUser;
use Tests\User;

it('should send message', function () {
    /** @var User $a */
    $a = User::query()->create([
        'name' => 'user1',
        'avatar' => 'user1-avatar'
    ]);

    /** @var User $b */
    $b = CompanyUser::query()->create([
        'name' => 'user2',
        'avatar' => 'user2-avatar'
    ]);

    $a->sendMessage('test', 'text', $b);

    /** @var ChatMessage $message */
    $message = ChatMessage::first();
    $this->assertEquals(CompanyUser::class, $message->receiverable_type);
});