<?php
namespace Chareice\LaravelChat\Contracts;

/**
 * 消息
 * Interface MessageContact
 * @package Chareice\Chat\Contracts
 */
interface MessageContact
{
    /**
     * 消息ID
     * @return string
     */
    public function id(): string;

    /**
     * 所属会话
     * @return ChatSessionContract
     */
    public function session(): ChatSessionContract;

    /**
     * 消息发送方
     * @return ChatAbleContract
     */
    public function sender(): ChatAbleContract;

    /**
     * 消息接收方
     * @return ChatAbleContract
     */
    public function receiver(): ChatAbleContract;

    /**
     * 消息内容
     * @return string
     */
    public function content() : string;

    /**
     * 消息类型
     * @return string
     */
    public function type() : string;

    /**
     * 消息创建时间
     * @return mixed
     */
    public function createdAt();

    /**
     * 消息接收方阅读时间
     * @return mixed
     */
    public function readAt();

    /**
     * 消息的预览内容
     * @return string
     */
    public function preview() : string;
}