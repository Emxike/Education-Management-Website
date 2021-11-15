<?php

namespace App\Modules\Admins\Dashboard\Repositories;

use App\Models\Category;
use App\Models\Department;
use App\Models\Idea;
use App\Models\Member;
use App\Models\Staff;
use App\Modules\Admins\Dashboard\Models\DepartmentModel;
use App\Modules\Admins\Dashboard\Models\IdeaModel;
use App\Modules\Admins\Dashboard\Models\StaffModel;
use App\Modules\Admins\Dashboard\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardService
{

    function getDepartment()
    {
        $user = Auth::guard("admin")->user();
        $tbMember = Member::getTableName();
        $tbDeparment = Department::getTableName();
        $query = DepartmentModel::query()
            ->leftJoin("{$tbMember}", "{$tbMember}.id", "=", "{$tbDeparment}.member_id");

        if ($user->role_id == 3) {
            $query->where("{$tbDeparment}.member_id", "=", $user->id);
        }
        return $query->get();
    }

    function getStaff()
    {
        $user = Auth::guard("admin")->user();
        $tbDepartment = Department::getTableName();
        $tbStaff = Staff::getTableName();
        $query = StaffModel::query()
            ->leftJoin("{$tbDepartment}", "{$tbDepartment}.id", "=", "{$tbStaff}.department_id");
        if ($user->role_id == 3) {
            $query->where("{$tbDepartment}.member_id", "=", $user->id);
        }
        return $query->get();
    }

    function getIdea()
    {
        $user = Auth::guard("admin")->user();
        $tbDepartment = Department::getTableName();
        $tbIdea = Idea::getTableName();
        $tbStaff = Staff::getTableName();
        $query =  IdeaModel::query()
            ->join("{$tbStaff}", "{$tbStaff}.id", "=", "{$tbIdea}.staff_id")
            ->leftJoin("{$tbDepartment}", "{$tbDepartment}.id", "=", "{$tbStaff}.department_id");
        if ($user->role_id == 3) {
            $query->where("{$tbDepartment}.member_id", "=", $user->id);
        }
        return $query->get();
    }

    function getStaffOfDepartment()
    {
        $user = Auth::guard("admin")->user();
        $tbMember = Member::getTableName();
        $tbDeparment = Department::getTableName();
        $tbStaff = Staff::getTableName();
        $query = DepartmentModel::query()
            ->select(["{$tbDeparment}.department_name", DB::raw("COUNT($tbStaff.id) as total_staff")])
            ->join("{$tbStaff}", "{$tbStaff}.department_id", "=", "{$tbDeparment}.id")
            ->leftJoin("{$tbMember}", "{$tbMember}.id", "=", "{$tbDeparment}.member_id");

        if ($user->role_id == 3) {
            $query->where("{$tbDeparment}.member_id", "=", $user->id);
        }

        return $query->groupBy(["{$tbDeparment}.id", "{$tbDeparment}.department_name"])->get();
    }
}
