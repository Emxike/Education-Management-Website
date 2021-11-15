<?php

namespace App\Modules\Admins\Department\Controllers;

use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Department\Services\StaffService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class StaffController extends BaseAdminController implements CommonActionController
{

    private $screenName = 'staff';
    /**
     * @var string
     */
    private $className = 'Staff';
    /**
     * @var string
     */
    private $route = 'staff.list';

    /**
     * @var StaffService
     */
    private $staffService;

    /**
     * @param StaffService $staffService
     */
    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index(Request $request)
    {
        self::checkPermission(self::VIEW, $this->screenName);
        $departments = $this->getDeparment();
        $data = $this->staffService->list($request);
        return \view("Department::staff.index", [
            "departments" => $departments,
            "data" => $data
        ]);
    }

    public function add(Request $request)
    {
        self::checkPermission(self::CREATE, $this->screenName);
        $departments = $this->getDeparment();
        return \view("Department::staff.add", [
            "departments" => $departments
        ]);
    }

    public function edit(Request $request, $id)
    {
        self::checkPermission(self::EDIT, $this->screenName);
        $departments = $this->getDeparment();
        $data = $this->staffService->fetchById($id);
        return \view("Department::staff.edit", [
            "departments" => $departments,
            "data" => $data
        ]);
    }

    public function create(Request $request)
    {
        try {
            self::checkPermission(self::CREATE, $this->screenName);
            $status = $this->staffService->add($request);
            return self::responseAndMessage($status, $this->className, self::ADD, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            self::checkPermission(self::EDIT, $this->screenName);
            $status = $this->staffService->update($request, $id);
            return self::responseAndMessage($status, $this->className, self::UPDATE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    public function destroy(Request $request)
    {
        try {
            self::checkPermission(self::DESTROY, $this->screenName);
            $status = $this->staffService->delete($request);
            return self::responseAndMessage($status, $this->className, self::DELETE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
