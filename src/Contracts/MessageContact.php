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
    public function getId(): string;

    /**
     * 消息发送方
     * @return ChatAbleContract
     */
    public function getSender(): ChatAbleContract;

    /**
     * 消息接收方
     * @return ChatAbleContract
     */
    public function getReceiver(): ChatAbleContract;

    /**
     * 消息内容
     * @return string
     */
    public function getContent(): string;

    /**
     * 消息类型
     * @return string
     */
    public function getType(): string;

    /**
     * 消息创建时间
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * 消息接收方阅读时间
     * @return mixed
     */
    public function getReadAt();

    /**
     * 消息的预览内容
     * @return string
     */
    public function getPreview(): string;
}