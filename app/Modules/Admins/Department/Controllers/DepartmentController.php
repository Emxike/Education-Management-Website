<?php


namespace App\Modules\Admins\Department\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Department\Services\DepartmentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends BaseAdminController implements CommonActionController
{

    private $screenName = 'department';
    /**
     * @var string
     */
    private $className = 'Catalog';
    /**
     * @var string
     */
    private $route = 'department.list';

    /**
     * @var DepartmentService
     */
    private $departmentService;

    /**
     * @param DepartmentService $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @Route("{route_admin}/{model}/list")
     * @Array list {model}
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        self::checkPermission(self::VIEW, $this->screenName);
        $departments = $this->departmentService->list($request);
        return \view("Department::department.index", [
            "data" => $departments
        ]);
    }

    /**
     * @Route("{route_admin}/{model}/add")
     * @param Request $request
     * @return Factory|View
     */
    public function add(Request $request)
    {
        self::checkPermission(self::CREATE, $this->screenName);
        $users = $this->departmentService->getMember();
        return \view("Department::department.add", [
            "users" => $users
        ]);
    }

    /**
     * @Route("{route_admin}/{model}/edit")
     * @param Request $request
     * @param $id
     * @return Factory|View
     */
    public function edit(Request $request, $id)
    {
        self::checkPermission(self::EDIT, $this->screenName);
        $data = $this->departmentService->fetchById($id);
        $users = $this->departmentService->getMember();
        return \view("Department::department.edit", [
            "data" => $data,
            "users" => $users
        ]);
    }

    /**
     * @Route("{route_admin}/{model}/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request)
    {
        try {
            self::checkPermission(self::CREATE, $this->screenName);
            $status = $this->departmentService->add($request);
            return self::responseAndMessage($status, $this->className, self::ADD, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("{route_admin}/{model}/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function update(Request $request, $id)
    {
        try {
            self::checkPermission(self::EDIT, $this->screenName);
            $status = $this->departmentService->update($request, $id);
            return self::responseAndMessage($status, $this->className, self::EDIT, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    /**
     * @Route("{route_admin}/{model}/delete")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function destroy(Request $request)
    {
        try {
            self::checkPermission(self::DESTROY, $this->screenName);
            $status = $this->departmentService->delete($request);
            return self::responseAndMessage($status, $this->className, self::DELETE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
