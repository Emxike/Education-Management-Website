<?php

namespace App\Modules\Admins\Example\Repositories;


use App\Core\MVC\Repositories\BaseRepository;
use App\Modules\Admins\Example\Models\ExampleModel;
use App\Modules\Admins\Example\Services\ExampleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExampleRepository extends BaseRepository implements ExampleService
{

    function list(Request $request)
    {
        $fillable = ['id', 'name', 'content', 'created_by', 'created_at'];
        $params = $request->all();
        return ExampleModel::select($fillable)->get();
    }

    function add(Request $request)
    {
        $params = $request->all();
        $validate = $this->validation($params);
        if ($validate->fails()) {
            return self::responseStatus(false, $validate);
        }
        ExampleModel::insert([
            "name" => $params['name'],
            "content" => $params['content'],
            'created_at' => Carbon::now()
        ]);
        return self::responseStatus(true);

    }

    function update(Request $request, $id)
    {
        $params = $request->all();
        $validate = $this->validation($params);
        if ($validate->fails()) {
            return self::responseStatus(false, $validate);
        }

        ExampleModel::where("id", $id)
            ->whereNull('deleted_at')
            ->update([
            'name' => $params['name'],
            'content' => $params['content'],
            'updated_at' => Carbon::now()
        ]);

        return self::responseStatus(true);
    }

    function delete(Request $request)
    {
        $params = $request->all();
        ExampleModel::where('id', $params["id"])
            ->whereNull('deleted_at')
            ->delete();
        return self::responseStatus(true);
    }

    function fetchById($id)
    {
        return ExampleModel::whereNull('deleted_at')->findOrFail($id);
    }

    function validation($form)
    {
        return Validator::make($form, [
            'name' => 'required',
            'content' => 'required'
        ]);
    }
}
