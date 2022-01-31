<?php

namespace App\Domain\Contracts;

interface UserContract
{
    public const TABLE = 'users';

    public const NAME           = 'name';
    public const EMAIL          = 'email';
    public const PASSWORD       = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
}
