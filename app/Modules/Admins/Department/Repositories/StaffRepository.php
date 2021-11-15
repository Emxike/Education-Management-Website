<?php

namespace App\Modules\Admins\Department\Repositories;

use App\Core\MVC\Repositories\BaseRepository;
use App\Models\Department;
use App\Models\Staff;
use App\Modules\Admins\Department\Models\DepartmentModel;
use App\Modules\Admins\Department\Models\StaffModel;
use App\Modules\Admins\Department\Services\StaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffRepository extends BaseRepository implements StaffService
{

    function list(Request $request)
    {
        $user = Auth::guard("admin")->user();
        $tbDeparment = Department::getTableName();
        $tbStaff = Staff::getTableName();
        $query = StaffModel::query()
            ->select(["{$tbStaff}.*", "{$tbDeparment}.department_name"])
            ->leftJoin("{$tbDeparment}", "{$tbDeparment}.id", "=", "{$tbStaff}.department_id");
        if ($user->role_id == 3) {
            $query->where("{$tbDeparment}.member_id", "=", $user->id);
        }
        return $query->get();
    }

    function add(Request $request)
    {
        $param = $request->all();
        $param["mod"] = true;
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }

        $params = [
            "staff_name" => $param["staff_name"],
            "sex" => $param["sex"],
            "phone" => $param["phone"],
            "email" => $param["email"],
            "address" => $param["address"],
            "password" => Hash::make($param["password"]),
            "department_id" => $param["department"],
        ];
        StaffModel::query()->create($params);
        return self::responseStatus(true);
    }

    function update(Request $request, $id)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }

        $params = [
            "staff_name" => $param["staff_name"],
            "sex" => $param["sex"],
            "phone" => $param["phone"],
            "email" => $param["email"],
            "address" => $param["address"],
            "department_id" => $param["department"],
        ];
        StaffModel::query()->findOrFail($id)->update($params);
        return self::responseStatus(true);
    }

    function delete(Request $request)
    {
        $id = $request->get("id");
        StaffModel::query()->findOrFail($id)->delete();
        return self::responseStatus(true);
    }

    function fetchById($id)
    {
        return StaffModel::query()->findOrFail($id);
    }

    function validation($form)
    {
        $validate_array = [
            'staff_name' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'sex' => [
                'required',
            ],
            'department' => [
                'required',
            ],
        ];

        if (isset($form['mod']) && $form['mod'] == true){
            $validate_array['password'] = ['required'];
        }

        return Validator::make($form, $validate_array);
    }
}
