<?php


namespace App\Modules\Admins\Users\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Modules\Admins\Users\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends BaseAdminController
{

    private $screenName = 'permission';
    /**
     *
     * @var string
     */
    private $className = 'Permission';
    /**
     * @var string
     */
    private $route = 'permission';
    /**
     * @var PermissionService
     */
    private $permissionService;

    /**
     * PermissionController constructor.
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(Request $request) {
        $roles = $this->getRoleForAdmin();
        $roleId = $request->get("role_id") ?? 1;
        $screen = $this->permissionService->listMenu($request, $roleId);
        return \view("Users::permission.index", [
            "roles" => $roles,
            "screen" => $screen,
            "role_id" => $roleId
        ]);
    }

    public function save(Request $request) {
        try {
            $permission = $this->permissionService->savePermission($request);
            return self::responseAndMessage($permission, $this->className, self::EDIT, $this->route, ["role_id" => $request->get("role_id")]);
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
