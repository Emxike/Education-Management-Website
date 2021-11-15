<?php


namespace App\Modules\Admins\Users\Repositories;


use App\Core\MVC\Repositories\BaseRepository;
use App\Modules\Admins\Users\Models\MemberModel;
use App\Modules\Admins\Users\Models\RoleModel;
use App\Modules\Admins\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository extends BaseRepository implements UserService
{

    function list(Request $request)
    {
        $tbRole = RoleModel::getTableName();
        $tbUser = MemberModel::getTableName();
        return MemberModel::query()
            ->select("{$tbUser}.*", "{$tbRole}.role_name")
            ->join("{$tbRole}", "{$tbRole}.id", "=", "{$tbUser}.role_id")
            ->get();
    }

    function add(Request $request)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $params = [
            "full_name" => $param["full_name"],
            "user_name" => $param["user_name"],
            "phone" => $param["phone"],
            "address" => $param["address"],
            "password" => Hash::make("password"),
            "role_id" => $param["role"],
        ];
        MemberModel::query()->create($params);
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
            "full_name" => $param["full_name"],
            "user_name" => $param["user_name"],
            "phone" => $param["phone"],
            "address" => $param["address"],
            "role_id" => $param["role"],
        ];
        MemberModel::query()->findOrFail($id)->update($params);
        return self::responseStatus(true);
    }

    function delete(Request $request)
    {
        $id = $request->get("id");
        MemberModel::query()->findOrFail($id)->delete();
        return self::responseStatus(true);
    }

    function fetchById($id)
    {
        return MemberModel::query()->whereIn("role_id", [1,2,3])->findOrFail($id);
    }

    function validation($form)
    {
        return Validator::make($form, [
            'user_name' => [
                'required',
            ],
            'full_name' => [
                'required',
            ],
            'phone' => [
                'required',
            ],
            'role' => [
                'required','max:50',
            ],
        ]);
    }

    function lock(Request $request)
    {
        $id = $request->get("id");
        $query = MemberModel::query()->findOrFail($id);
        $query->update([
            "status" => !$query['status']
        ]);
        return self::responseStatus(true);
    }

    function changePassword(Request $request)
    {
        $id = Auth::guard("admin")->user()->id;
        $param = $request->all();
        $validation = Validator::make($param, [
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new'
        ]);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $query = MemberModel::query()->findOrFail($id);
        $query->update([
            "password" => Hash::make($param["password_new"])
        ]);
        return self::responseStatus(true);
    }
}
