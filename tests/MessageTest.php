<?php


namespace Tests;


use Chareice\LaravelChat\ChatSession;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_message()
    {
        /** @var User $a */
        $a = User::query()->create([
            'name' => 'user1',
            'avatar' => 'user1-avatar'
        ]);

        /** @var User $b */
        $b = User::query()->create([
            'name' => 'user2',
            'avatar' => 'user2-avatar'
        ]);

        $a->sendMessage('test', 'text', $b);

        $this->assertDatabaseHas('chat_messages', [
            'content' => 'test'
        ]);

        $this->assertTrue(ChatSession::query()->whereMorphedTo('ownerable', $a)->whereMorphedTo('targetable', $b)->exists());
        $this->assertTrue(ChatSession::query()->whereMorphedTo('ownerable', $b)->whereMorphedTo('targetable', $a)->exists());

        /** @var ChatSession $aSession */
        $aSession = $a->chatSessions()->first();
        $this->assertEquals('test', $aSession->lastMessage()->content());
        $this->assertEquals(0, $aSession->unreadMessageCount());

        /** @var ChatSession $bSession */
        $bSession = $b->chatSessions()->first();
        $this->assertEquals(1, $bSession->unreadMessageCount());
    }
}