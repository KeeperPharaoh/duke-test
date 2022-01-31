<?php

namespace App\Domain\Contracts;

interface CheckContract
{
    public const TABLE = 'checks';

    public const USER_ID = 'user_id';
    public const IMAGE   = 'image';
    public const TYPE    = 'type';
    public const CODE    = 'code';
    public const STATUS  = 'status';
}
