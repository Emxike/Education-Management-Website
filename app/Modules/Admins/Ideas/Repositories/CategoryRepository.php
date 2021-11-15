<?php

namespace App\Modules\Admins\Ideas\Repositories;

use App\Core\MVC\Repositories\BaseRepository;
use App\Modules\Admins\Ideas\Models\CategoryModel;
use App\Modules\Admins\Ideas\Models\IdeaModel;
use App\Modules\Admins\Ideas\Services\CategoryService;
use App\Modules\Admins\Users\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryRepository extends BaseRepository implements CategoryService
{

    function list(Request $request)
    {
        $tbIdea = IdeaModel::getTableName();
        $tbCategory = CategoryModel::getTableName();
        return CategoryModel::query()
            ->select("{$tbCategory}.*", DB::raw("COUNT({$tbIdea}.id) as is_idea"))
            ->leftJoin("{$tbIdea}", "{$tbIdea}.category_id", "=", "{$tbCategory}.id")
            ->groupBy(["{$tbCategory}.id", "{$tbCategory}.category_name", "{$tbCategory}.created", "{$tbCategory}.updated"])
            ->get();
    }

    function add(Request $request)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $params = [
            "category_name" => $param["category_name"]
        ];
        CategoryModel::query()->create($params);
        return self::responseStatus(true);
    }

    function update(Request $request, $id)
    {
        $param = $request->all();
        $validation = $this->validation($param);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $params = [
            "category_name" => $param["category_name"]
        ];
        CategoryModel::query()->findOrFail($id)->update($params);
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
        return CategoryModel::query()->findOrFail($id);
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
