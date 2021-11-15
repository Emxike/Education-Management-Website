<?php


namespace App\Core\MVC\Repositories;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

abstract class BaseRepository
{
    /**
     * @param false $status
     * @param null $message
     * @param null $code
     * @param null $data
     * @return JsonResponse
     */
    public static function responseJson($status = false, $message = null, $code = null,  $data = null) {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ], $code);
    }

    /**
     * @param false $status
     * @param null $messages
     * @return array
     */
    public static function responseStatus($status = false, $messages = null) {
        return [
            'status' => $status,
            'messages' => $messages
        ];
    }
}
