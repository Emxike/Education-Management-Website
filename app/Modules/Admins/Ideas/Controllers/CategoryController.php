<?php

namespace App\Modules\Admins\Ideas\Controllers;

use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Ideas\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CategoryController extends BaseAdminController implements CommonActionController
{

    private $screenName = 'category';
    /**
     * @var string
     */
    private $className = 'Category';
    /**
     * @var string
     */
    private $route = 'category.list';

    private $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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
        $data = $this->categoryService->list($request);
        return \view("Ideas::category.index", [
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
        return \view("Ideas::category.add");
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
        $category = $this->categoryService->fetchById($id);
        return \view("Ideas::category.edit", [
            "data" => $category
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
            $status = $this->categoryService->add($request);
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
            $status = $this->categoryService->update($request, $id);
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
            $status = $this->categoryService->delete($request);
            return self::responseAndMessage($status, $this->className, self::DELETE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
