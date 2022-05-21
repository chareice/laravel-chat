<?php

namespace Tests;

use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Traits\ChatAble;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements ChatAbleContract
{
    use ChatAble;

    protected $guarded = false;


    public function getId(): string
    {
        return $this->getAttribute('id');
    }


    public function getAvatar(): string
    {
        return $this->getAttribute('avatar');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }
}