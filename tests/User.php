<?php

namespace Tests;

use Chareice\LaravelChat\Contracts\ChatAbleContract;
use Chareice\LaravelChat\Traits\ChatAble;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements ChatAbleContract
{
    use ChatAble;

    protected $guarded = false;

    public function id(): string
    {
        return $this->id;
    }

    public function type(): string
    {
        return 'user';
    }

    public function avatar(): string
    {
        return $this->avatar;
    }

    public function name(): string
    {
        return $this->name;
    }


}