<?php


namespace Chareice\LaravelChat\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * 参与聊天的对象
 * Interface ChatAbleContract
 * @package Chareice\Chat\Contracts
 */
interface ChatAbleContract
{
    /**
     * 聊天对象ID
     * @return string
     */
    public function getId(): string;

    /**
     * 头像
     * @return string
     */
    public function getAvatar(): string;

    /**
     * 名称
     * @return string
     */
    public function getName(): string;

    /**
     * 发送消息
     * @param string $content
     * @param string $type
     * @param ChatAbleContract $receiver
     * @return mixed
     */
    public function sendMessage(string $content, string $type, ChatAbleContract $receiver): MessageContact;
}