<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\CheckContract;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        CheckContract::USER_ID,
        CheckContract::CODE,
        CheckContract::TYPE,
        CheckContract::STATUS,
        CheckContract::IMAGE
    ];

    protected $hidden = [
        CheckContract::USER_ID,
        'updated_at',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
