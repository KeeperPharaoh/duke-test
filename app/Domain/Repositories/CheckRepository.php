<?php

namespace App\Domain\Repositories;

use App\Models\Check;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class CheckRepository extends BaseRepository
{
    public function model(): string
    {
        return Check::class;
    }

    public function getChecks(): LengthAwarePaginator
    {
        return Check::query()
            ->join('users','checks.user_id','=','users.id')
            ->select('checks.*','name')
            ->paginate(8)
        ;
    }
}
