<?php


namespace Chareice\LaravelChat\Contracts;


use Carbon\Carbon;

interface ChatSessionContract
{
    public function getId(): string;
}