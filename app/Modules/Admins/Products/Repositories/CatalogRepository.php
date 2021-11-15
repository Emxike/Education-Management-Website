<?php


namespace App\Modules\Admins\Products\Repositories;


use App\Modules\Admins\Products\Models\CatalogModel;
use App\Modules\Admins\Products\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogRepository implements CatalogService
{

    function list(Request $request)
    {
        return CatalogModel::all();
    }

    function add(Request $request)
    {
        // TODO: Implement add() method.
    }

    function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    function delete(Request $request)
    {
        // TODO: Implement delete() method.
    }

    function fetchById($id)
    {
        // TODO: Implement fetchById() method.
    }

    function validation($form)
    {
        // TODO: Implement validation() method.
    }
}
