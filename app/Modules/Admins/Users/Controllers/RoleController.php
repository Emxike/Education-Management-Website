<?php

namespace App\Modules\Admins\Users\Controllers;

use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Users\Services\RoleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RoleController extends BaseAdminController implements CommonActionController
{
    private $screenName = 'role';
    /**
     *
     * @var string
     */
    private $className = 'Role';
    /**
     * @var string
     */
    private $route = 'role.list';

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        self::checkPermission(self::VIEW, $this->screenName);
        $list = $this->roleService->list($request);
        return \view("Users::role.index", [
            "data" => $list
        ]);
    }

    public function add(Request $request)
    {
        self::checkPermission(self::CREATE, $this->screenName);
        return \view("Users::role.add");
    }

    public function edit(Request $request, $id)
    {
        self::checkPermission(self::EDIT, $this->screenName);
        $data = $this->roleService->fetchById($id);
        return \view("Users::role.edit", [
            "data" => $data
        ]);
    }

    public function create(Request $request)
    {
        try {
            self::checkPermission(self::CREATE, $this->screenName);
            $role = $this->roleService->add($request);
            return self::responseAndMessage($role, $this->className, self::ADD, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            self::checkPermission(self::EDIT, $this->screenName);
            $role = $this->roleService->update($request, $id);
            return self::responseAndMessage($role, $this->className, self::EDIT, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    public function destroy(Request $request)
    {
        try {
            self::checkPermission(self::DESTROY, $this->screenName);
            $status = $this->roleService->delete($request);
            return self::responseAndMessage($status, $this->className, self::DELETE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
