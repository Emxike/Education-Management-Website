<?php


namespace App\Modules\Admins\Products\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Admins\Products\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends BaseAdminController implements CommonActionController
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("{route_admin}/{model}/list")
     * @Array list {model}
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    /**
     * @Route("{route_admin}/{model}/add")
     * @param Request $request
     * @return Factory|View
     */
    public function add(Request $request)
    {
        // TODO: Implement add() method.
    }

    /**
     * @Route("{route_admin}/{model}/edit")
     * @param Request $request
     * @param $id
     * @return Factory|View
     */
    public function edit(Request $request, $id)
    {
        // TODO: Implement edit() method.
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
    public function destroy(Request $request)
    {
        // TODO: Implement destroy() method.
    }
}
