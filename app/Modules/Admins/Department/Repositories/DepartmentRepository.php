<?php

namespace App\Modules\Admins\Department\Repositories;

use App\Core\MVC\Repositories\BaseRepository;
use App\Modules\Admins\Department\Models\DepartmentModel;
use App\Modules\Admins\Department\Models\MemberModel;
use App\Modules\Admins\Department\Services\DepartmentService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartmentRepository extends BaseRepository implements DepartmentService
{

    function list(Request $request)
    {
        $user = Auth::guard("admin")->user();
        $tbMember = MemberModel::getTableName();
        $tbDeparment = DepartmentModel::getTableName();
        $query = DepartmentModel::query()
            ->select("{$tbDeparment}.*", "{$tbMember}.user_name as manager")
            ->leftJoin("{$tbMember}", "{$tbMember}.id", "=", "{$tbDeparment}.member_id");

        if ($user->role_id == 3) {
            $query->where("{$tbDeparment}.member_id", "=", $user->id);
        }

          return $query->get();
    }

    function add(Request $request)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }

        $user = Auth::guard("admin")->user();

        $params = [
            "department_name" => $param["department_name"],
            "member_id" => $user['role_id'] == 3 ? $user['id'] : $param["manager"],
        ];
        DepartmentModel::query()->create($params);
        return self::responseStatus(true);
    }

    function update(Request $request, $id)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $user = Auth::guard("admin")->user();

        $params = [
            "department_name" => $param["department_name"],
            "member_id" => $user['role_id'] == 3 ? $user['id'] : $param["manager"],
        ];
        DepartmentModel::query()->findOrFail($id)->update($params);
        return self::responseStatus(true);
    }

    function delete(Request $request)
    {
        $id = $request->get("id");
        DepartmentModel::query()->findOrFail($id)->delete();
        return self::responseStatus(true);
    }

    function fetchById($id)
    {
        return DepartmentModel::query()->findOrFail($id);
    }

    function validation($form)
    {
        return Validator::make($form, [
            'department_name' => [
                'required','max:50',
            ],
        ]);
    }

    function getMember()
    {
        return MemberModel::query()
            ->select("id", "user_name", "full_name")
            ->where("role_id", "=", "3")
            ->where("status", "=", "0")
            ->get();
    }
}
