<?php


namespace Chareice\LaravelChat\Contracts;


interface ChatSessionContract
{
    /**
     * 会话对象
     * @return ChatAbleContract
     */
    public function target(): ChatAbleContract;

    /**
     * 会话中的最后一条消息
     * @return MessageContact
     */
    public function lastMessage(): MessageContact;

    /**
     * 会话中未读消息数量
     * @return int
     */
    public function unreadMessageCount(): int;
}