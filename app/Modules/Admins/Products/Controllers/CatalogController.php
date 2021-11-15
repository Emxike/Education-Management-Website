<?php


namespace App\Modules\Admins\Products\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Products\Services\CatalogService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends BaseAdminController implements CommonActionController
{

    private $screenName = 'catalog';
    /**
     * @var string
     */
    private $className = 'Catalog';
    /**
     * @var string
     */
    private $route = 'catalog.list';
    /**
     * @var ExampleService
     */

    private $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
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
        $catalogs = $this->catalogService->list($request);
        return \view("Products::catalog.index", [
            "data" => $catalogs
        ]);
    }

    /**
     * @Route("{route_admin}/{model}/add")
     * @param Request $request
     * @return Factory|View
     */
    public function add(Request $request)
    {
        return \view("Products::catalog.add");
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
        return \view("Products::catalog.edit");
    }

    /**
     * @Route("{route_admin}/{model}/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request)
    {
        // TODO: Implement create() method.
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
        // TODO: Implement update() method.
    }

    /**
     * @Route("{route_admin}/{model}/delete")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function destroy(Request $request, $id)
    {
        // TODO: Implement destroy() method.
    }
}
