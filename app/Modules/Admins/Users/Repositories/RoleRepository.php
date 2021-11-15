<?php

namespace App\Modules\Admins\Users\Repositories;

use App\Core\MVC\Repositories\BaseRepository;
use App\Models\Role;
use App\Modules\Admins\Users\Models\RoleModel;
use App\Modules\Admins\Users\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleRepository extends BaseRepository implements RoleService
{

    function list(Request $request)
    {
        return RoleModel::query()->get();
    }

    function add(Request $request)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $params = [
            "role_name" => $param["role_name"]
        ];
        RoleModel::query()->create($params);
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
            "role_name" => $param["role_name"]
        ];
        RoleModel::query()->findOrFail($id)->update($params);
        return self::responseStatus(true);
    }

    function delete(Request $request)
    {
        $id = $request->get("id");
        RoleModel::query()->findOrFail($id)->delete();
        return self::responseStatus(true);
    }

    function fetchById($id)
    {
        return RoleModel::query()->findOrFail($id);
    }

    function validation($form)
    {
        return Validator::make($form, [
            'role_name' => [
                'required','max:50',
            ],
        ]);
    }
}
