<?php


namespace Tests;


class CompanyUser extends User
{
    protected $table = 'users';

    public function type(): string
    {
        return 'company-user';
    }
}