<?php

namespace App\Modules\Admins\Ideas\Repositories;

use App\Core\MVC\Repositories\BaseRepository;
use App\Modules\Admins\Ideas\Models\CategoryModel;
use App\Modules\Admins\Ideas\Models\IdeaModel;
use App\Modules\Admins\Ideas\Models\StaffModel;
use App\Modules\Admins\Ideas\Services\CategoryService;
use App\Modules\Admins\Ideas\Services\IdeaService;
use App\Modules\Admins\Users\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdeaRepository extends BaseRepository implements IdeaService
{

    function list(Request $request)
    {
        $tbCategory = CategoryModel::getTableName();
        $tbIdea = IdeaModel::getTableName();
        $tbStaff = StaffModel::getTableName();
        return IdeaModel::query()
            ->select(["{$tbIdea}.*", "{$tbCategory}.category_name", "{$tbStaff}.staff_name"])
            ->leftJoin("{$tbCategory}", "{$tbCategory}.id", "=", "{$tbIdea}.category_id")
            ->join("{$tbStaff}", "{$tbStaff}.id", "=", "{$tbIdea}.staff_id")
            ->get();
    }

    function add(Request $request)
    {
    }

    function update(Request $request, $id)
    {
        $param = $request->all();
        $params = [
            "category_id" => $param["category"]
        ];
        IdeaModel::query()->findOrFail($id)->update($params);
        return self::responseStatus(true);
    }

    function delete(Request $request)
    {
        $id = $request->get("id");
        CategoryModel::query()->findOrFail($id)->delete();
        return self::responseStatus(true);
    }

    function fetchById($id)
    {
        return IdeaModel::query()->findOrFail($id);
    }

    function validation($form)
    {
        return Validator::make($form, [
            'category_name' => [
                'required','max:50',
            ],
        ]);
    }
}
