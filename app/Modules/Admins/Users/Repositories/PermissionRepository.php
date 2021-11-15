<?php


namespace App\Modules\Admins\Users\Repositories;


use App\Core\MVC\Repositories\BaseRepository;
use App\Model\Menu;
use App\Model\Permission;
use App\Modules\Admins\Users\Models\MemberModel;
use App\Modules\Admins\Users\Models\MenuModel;
use App\Modules\Admins\Users\Models\PermissionModel;
use App\Modules\Admins\Users\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionRepository extends BaseRepository implements PermissionService
{

    function listMenu(Request $request, $roleId)
    {
        $param = $request->all();
        $menus = MenuModel::query()->get();
        if(!empty($roleId)){
            $menuAccept = PermissionModel::query()->where("role_id", $roleId)->get();
            foreach ($menuAccept as $key => $item){
                $menu = collect($menus)->where("id", $item["menu_id"])->first();
                if ($menu){
                    $menu->view_flg = $item->view_flg;
                    $menu->add_flg = $item->add_flg;
                    $menu->edit_flg = $item->edit_flg;
                    $menu->del_flg = $item->del_flg;
                }
            }
        }
        return $menus;
    }

    function savePermission(Request $request)
    {
        $validation = $this->validation($request);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }

        $param = $request->all();
        PermissionModel::query()->where("role_id", $param["role_id"])->delete();
        $data = [];
        foreach ($param["screen"] as $key => $value){
           $data[] = [
            "role_id" => $param["role_id"],
            "menu_id" => $value["id"],
            "view_flg" => !empty($value["view"]),
            "add_flg" => !empty($value["add"]),
            "edit_flg" => !empty($value["edit"]),
            "del_flg" => !empty($value["delete"]),
            ];
        }
        PermissionModel::query()->insert($data);
        return self::responseStatus(true);
    }

    function validation(Request $request, $mod = false)
    {
        return Validator::make($request->all(), [
            'role_id' => [
                'required',
            ],
        ]);
    }
}
