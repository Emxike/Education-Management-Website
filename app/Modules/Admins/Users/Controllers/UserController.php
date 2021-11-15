<?php


namespace App\Modules\Admins\Users\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Users\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseAdminController implements CommonActionController
{
    private $screenName = 'member';
    /**
     *
     * @var string
     */
    private $className = 'Member';
    /**
     * @var string
     */
    private $route = 'member.list';

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
        $data = $this->userService->list($request);
        return \view("Users::users.index", [
            "data" => $data
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
        $roles = $this->getRoleForAdmin();
        return \view("Users::users.add", [
            "roles" => $roles
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
        $roles = $this->getRoleForAdmin();
        $data = $this->userService->fetchById($id);
        return \view("Users::users.edit", [
            "roles" => $roles,
            "data" => $data
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
            $role = $this->userService->add($request);
            return self::responseAndMessage($role, $this->className, self::ADD, $this->route);
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
            $role = $this->userService->update($request, $id);
            return self::responseAndMessage($role, $this->className, self::UPDATE, $this->route);
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
            $role = $this->userService->delete($request);
            return self::responseAndMessage($role, $this->className, self::DELETE, $this->route);
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
    public function lock(Request $request)
    {
        try {
            self::checkPermission(self::EDIT, $this->screenName);
            $role = $this->userService->lock($request);
            return self::responseAndMessage($role, $this->className, self::UPDATE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }

    public function changePassword(Request $request) {
        try {
            $role = $this->userService->changePassword($request);
            return self::responseAndMessage($role, $this->className, self::UPDATE, $this->route);
        } catch (\Exception $ex) {
            dd($ex);
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
