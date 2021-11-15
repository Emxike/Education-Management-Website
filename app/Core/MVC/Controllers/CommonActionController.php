<?php


namespace App\Core\MVC\Controllers;


use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Routing\Annotation\Route;

interface CommonActionController
{
    /**
     * @Route("{route_admin}/{model}/list")
     * @Array list {model}
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request);

    /**
     * @Route("{route_admin}/{model}/add")
     * @param Request $request
     * @return Factory|View
     */
    public function add(Request $request);

    /**
     * @Route("{route_admin}/{model}/edit")
     * @param Request $request
     * @param $id
     * @return Factory|View
     */
    public function edit(Request $request, $id);

    /**
     * @Route("{route_admin}/{model}/add")
     * @Method POST
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request);

    /**
     * @Route("{route_admin}/{model}/edit")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function update(Request $request, $id);

    /**
     * @Route("{route_admin}/{model}/delete")
     * @Method POST
     * @param Request $request
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function destroy(Request $request);
}
