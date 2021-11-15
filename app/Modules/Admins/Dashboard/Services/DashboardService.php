<?php

namespace App\Modules\Admins\Dashboard\Services;

interface DashboardService
{
    function getDepartment();
    function getStaff();
    function getIdea();
    function getStaffOfDepartment();
}
