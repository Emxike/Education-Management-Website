<?php

namespace App\Modules\Admins\Department\Services;

use App\Core\MVC\Services\BaseService;

interface DepartmentService extends BaseService
{
    function getMember();
}
