<?php


namespace App\Modules\Admins\Users\Services;


use Illuminate\Http\Request;

interface PermissionService
{
    function listMenu(Request $request, $roleId);
    function savePermission(Request $request);
    function validation(Request $request, $mod = false);
}
