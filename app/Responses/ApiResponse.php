<?php

namespace App\Responses;

class ApiResponse
{
    public const SUCCESS = 'success';

    public const FAILURE = 'failure';

    /**
     * @param $data
     * @param $code
     *
     * @return array
     */
    public static function success($data, $code): array
    {
        return [
            'message' => [
                'status' => self::SUCCESS,
                'data'   => $data,
            ],
            'code'    => $code,
        ];
    }

    /**
     * @param $data
     * @param $code
     *
     * @return array
     */
    public static function failure($data, $code): array
    {
        return [
            'message' => [
                'status' => self::FAILURE,
                'data'   => $data,
            ],
            'code'    => $code,
        ];
    }
}

