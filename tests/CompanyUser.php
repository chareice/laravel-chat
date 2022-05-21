<?php


namespace Tests;


use Chareice\LaravelChat\Contracts\ChatAbleContract;

class CompanyUser extends User implements ChatAbleContract
{
    protected $table = 'users';
}