<?php

namespace App\Modules\Admins\Ideas\Controllers;

use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Ideas\Services\IdeaService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class IdeaController extends BaseAdminController implements CommonActionController
{

    private $screenName = 'idea';
    /**
     * @var string
     */
    private $className = 'Idea';
    /**
     * @var string
     */
    private $route = 'idea.list';

    private $ideaService;

    /**
     * @param IdeaService $ideaService
     */
    public function __construct(IdeaService $ideaService)
    {
        $this->ideaService = $ideaService;
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
        $categories = $this->getCategory();
        $data = $this->ideaService->list($request);
        return \view("Ideas::idea.index", [
            'categories' => $categories,
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
        return \view("Ideas::idea.add");
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
        $categories = $this->getCategory();
        $idea = $this->ideaService->fetchById($id);
        return \view("Ideas::idea.edit", [
            'categories' => $categories,
            "data" => $idea
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
            $status = $this->ideaService->add($request);
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
            $status = $this->ideaService->update($request, $id);
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
            $status = $this->ideaService->delete($request);
            return self::responseAndMessage($status, $this->className, self::DELETE, $this->route);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return view('admin.error.502');
        }
    }
}
