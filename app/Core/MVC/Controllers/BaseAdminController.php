<?php


namespace App\Core\MVC\Controllers;


use App\Models\Category;
use App\Models\Department;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

abstract class BaseAdminController extends Controller
{
    const ADD = 0;
    const UPDATE = 1;
    const DELETE = 3;

    const VIEW = 'view';
    const EDIT = 'edit';
    const CREATE = 'create';
    const DESTROY = 'delete';

    /**
     * @param array $object
     * @param null $route
     * @param null $model
     * @param null $type
     * @param false $param
     * @return RedirectResponse
     */
    public static function responseAndMessage($object = [], $model = null, $type = null, $route = null, $param = false)
    {
        $action = config('appConfig.action.' . $type);
        if ($object['status']) {
            $msg = $action . " " . $model . " " . "Successfully!";
            return redirect()->route($route, $param)->with(['status' => "success", 'message' => $msg]);
        } else {
            $msg = $action . " " . $model . " " . "Failed!";
            return redirect()->back()->with(['status' => "error", 'message' => $msg])->withErrors($object['messages'])->withInput();
        }
    }


    /**
     * @param $type
     * @param $screen
     * @return false
     */
    public static function checkPermission($type = false, $screen){
        $roleId = Auth::guard("admin")->user()->role_id;
        $permission = Permission::join("mtb_menu", "dtb_permission_role.menu_id", "=", "mtb_menu.id")
            ->where("role_id", $roleId)
            ->where("menu_href", $screen)
            ->first();
        view()->share("permission_screen", $permission);
        switch ($type) {
            case "view":
                if (!$permission->view_flg){
                    echo view("admin.error.404");
                    die();
                }
                break;
            case "edit":
                if (!$permission->edit_flg){
                    echo view("admin.error.502");
                    die();
                }
                break;
            case "delete":
                if (!$permission->del_flg){
                    echo view("admin.error.502");
                    die();
                }
                break;
            case "create":
                if (!$permission->add_flg){
                    echo view("admin.error.502");
                    die();
                }
                break;
            default:
                return false;
        }
    }

    public function getCategory(){
        return Category::query()->select(["id", "category_name"])->get();
    }

    public function getRoleForAdmin() {
        return Role::query()->where("is_admin", "=", true)->get();
    }

    public function getRoleForClient() {
        return Role::query()->where("is_client", "=", true)->get();
    }

    public function getDeparment() {
        $user = Auth::guard("admin")->user();
        return Department::query()
            ->where(function ($q) use ($user) {
                if ($user['role_id'] == 3) {
                    $q->where("member_id", "=", $user["id"]);
                }
            })->get();
    }
}
