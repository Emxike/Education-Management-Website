<?php


namespace App\Modules\Admins\Users\Services;


use App\Core\MVC\Services\BaseService;
use Illuminate\Http\Request;

interface UserService extends BaseService
{
    function lock(Request $request);
    function changePassword(Request $request);
}
