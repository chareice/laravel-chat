<?php


namespace Chareice\LaravelChat\Contracts;


use Carbon\Carbon;

interface ChatSessionContract
{
    /**
     * 会话对象
     * @return ChatAbleContract
     */
    public function target(): ChatAbleContract;

    /**
     * 最后一条消息发送时间
     * @return Carbon
     */
    public function lastMessageAt(): Carbon;

    /**
     * 最后一条消息的预览消息
     * @return string
     */
    public function lastMessagePreview() : string;

    /**
     * 会话中未读消息数量
     * @return int
     */
    public function unreadMessageCount(): int;
}