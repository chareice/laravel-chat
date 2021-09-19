# Laravel Chat

为Laravel提供消息（私信）服务

### 使用

```php
class User extends Model implements ChatAbleContract
{
    use ChatAble;
}

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


// A用户给B发送消息
$a->sendMessage('test', 'text', $b);

/** @var ChatSession $bSession */
$bSession = $b->chatSessions()->first();

// b的session存在1条未读消息
$bSession->unreadMessageCount();
```