<?php

namespace App\Services;

use App\Domain\Contracts\CheckContract;
use App\Domain\Repositories\CheckRepository;
use App\Responses\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response;

class CheckServices
{
    private CheckRepository $checkRepository;

    public function __construct(
        CheckRepository $checkRepository
    ) {
        $this->checkRepository = $checkRepository;
    }

    public function show(): array
    {
        $checks = $this->checkRepository->getChecks();

        $now           = Carbon::now();
        $weekStartDate = $now->startOfWeek()
                             ->format('Y-m-d H:i');
        $weekEndDate   = $now->endOfWeek()
                             ->format('Y-m-d H:i');
        foreach ($checks as $check) {
            $check->image = env('APP_URL') . '/storage/' . $check->image;
            if (!$check->created_at->between($weekStartDate, $weekEndDate)) {
                $check->code = NOT_PARTICIPATING_THIS_WEEK;
            }
        }

        return ApiResponse::success(
              $checks
            , Response::HTTP_OK
        );

    }

    public function unload(array $data): array
    {
        $currentTime = (int)Carbon::now()
                                  ->format('H');
        $type        = USUAL_TYPE;
        $code        = null;
        $imageCheck  = $data['image'];

        if ($currentTime % 2 == 0) {
            $type = PRIZE_TYPE;
            $code = Str::random(10);
        }

        $pathToCheck = Storage::disk('public')
                              ->put('check', $imageCheck);

        try {
            DB::beginTransaction();
            $this->checkRepository->create([
                                               CheckContract::USER_ID => Auth::id(),
                                               CheckContract::IMAGE   => $pathToCheck,
                                               CheckContract::TYPE    => $type,
                                               CheckContract::CODE    => $code,
                                               CheckContract::STATUS  => ACCEPTED,
                                           ]);
            DB::commit();
        } catch (ValidatorException $exception) {
            DB::rollBack();

            return ApiResponse::failure(
                FAILED_TO_CREATE_USER,
                Response::HTTP_CONFLICT
            );
        }

        return ApiResponse::success(SUCCESSFUL, Response::HTTP_OK);
    }

}
