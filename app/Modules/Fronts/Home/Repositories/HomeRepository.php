<?php

namespace App\Modules\Fronts\Home\Repositories;

use App\Core\MVC\Repositories\BaseRepository;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Staff;
use App\Models\View;
use App\Modules\Fronts\Home\Models\CategoryModel;
use App\Modules\Fronts\Home\Models\CommentModel;
use App\Modules\Fronts\Home\Models\IdeaModel;
use App\Modules\Fronts\Home\Models\StaffModel;
use App\Modules\Fronts\Home\Models\ViewModel;
use App\Modules\Fronts\Home\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeRepository extends BaseRepository implements HomeService
{

    function getCategories()
    {
        return CategoryModel::query()->get();
    }

    function getIdea(Request $request, $my = false)
    {
        $param = $request->all();
        $tbIdea = Idea::getTableName();
        $tbStaff = Staff::getTableName();
        $tbCategory = Category::getTableName();
        $tbComment = Comment::getTableName();
        $tbView = View::getTableName();


        $query = IdeaModel::query()
            ->with(["views", "comments"])
            ->select([
                "{$tbIdea}.*",
                "{$tbStaff}.staff_name", "{$tbStaff}.avatar", "{$tbStaff}.phone", "{$tbStaff}.sex", "{$tbStaff}.email",
                DB::raw("COUNT({$tbComment}.id) as total_comment"),
                DB::raw("COUNT({$tbView}.id) as total_view"),
            ])
            ->join("{$tbStaff}", "{$tbStaff}.id", "=", "{$tbIdea}.staff_id")
            ->leftJoin("{$tbView}", "{$tbIdea}.id", "=", "{$tbView}.idea_id")
            ->leftJoin("{$tbCategory}", "{$tbCategory}.id", "=", "{$tbIdea}.category_id")
            ->leftJoin("{$tbComment}", "{$tbIdea}.id", "=", "{$tbComment}.idea_id");

        if (!empty($param['category'])) {
            $query->where("{$tbIdea}.category_id", "=", $param["category"]);
        }

        if (!empty($param["search"])) {
            $query->where(function($q) use ($param, $tbIdea) {
                $q->where("{$tbIdea}.title", "like", "%" . $param["search"]. "%")
                    ->orWhere("{$tbIdea}.content", "like", "%" . $param["search"]. "%");
            });
        }

        $query->groupBy([
            "{$tbIdea}.id", "{$tbIdea}.category_id", "{$tbIdea}.staff_id", "{$tbIdea}.title", "{$tbIdea}.content", "{$tbIdea}.created", "{$tbIdea}.updated",
            "{$tbStaff}.staff_name", "{$tbStaff}.avatar", "{$tbStaff}.phone", "{$tbStaff}.sex", "{$tbStaff}.email",
        ]);

        if ($my) {
            $idUser = Auth::guard('web')->user()->id;
            $query->where("{$tbIdea}.staff_id", "=", $idUser);
        }

        if (!empty($param["type"])) {
            if ($param["type"] == 1) {
                $query->orderBy("total_view", "DESC");
            }else {
                $query->orderBy("{$tbIdea}.created", "DESC");
                if ($param["type"] == 3) {
                    $query->where("{$tbIdea}.title", "like", "%" . $param["search"]. "%");
                }else {
                    return $query->get()->take(1);
                }
            }
        }else {
            $query->orderBy("{$tbIdea}.created", "DESC");
        }

        return $query->paginate(5);
    }

    function getIdeaDetail($id)
    {
        $tbIdea = Idea::getTableName();
        $tbStaff = Staff::getTableName();
        $tbCategory = Category::getTableName();
        $tbComment = Comment::getTableName();
        $tbView = View::getTableName();

        $query = IdeaModel::query()
            ->with(["views", "comments"])
            ->select([
                "{$tbIdea}.*",
                "{$tbStaff}.staff_name", "{$tbStaff}.avatar", "{$tbStaff}.phone", "{$tbStaff}.sex", "{$tbStaff}.email",
                DB::raw("COUNT({$tbComment}.id) as total_comment"),
                DB::raw("COUNT({$tbView}.id) as total_view"),
            ])
            ->join("{$tbStaff}", "{$tbStaff}.id", "=", "{$tbIdea}.staff_id")
            ->leftJoin("{$tbView}", "{$tbIdea}.id", "=", "{$tbView}.idea_id")
            ->leftJoin("{$tbCategory}", "{$tbCategory}.id", "=", "{$tbIdea}.category_id")
            ->leftJoin("{$tbComment}", "{$tbIdea}.id", "=", "{$tbComment}.idea_id")
            ->where("{$tbIdea}.id", "=", $id)
            ->groupBy([
                "{$tbIdea}.id", "{$tbIdea}.category_id", "{$tbIdea}.staff_id", "{$tbIdea}.title", "{$tbIdea}.content", "{$tbIdea}.created", "{$tbIdea}.updated",
                "{$tbStaff}.staff_name", "{$tbStaff}.avatar", "{$tbStaff}.phone", "{$tbStaff}.sex", "{$tbStaff}.email",
            ])
            ->first();

        return $query;
    }

    function getCommentByIdea($id)
    {
        $tbStaff = Staff::getTableName();
        $tbIdea = Idea::getTableName();
        $tbComment = Comment::getTableName();
        return CommentModel::query()
            ->select([
                "{$tbComment}.*",
                "{$tbStaff}.staff_name", "{$tbStaff}.avatar", "{$tbStaff}.phone", "{$tbStaff}.sex", "{$tbStaff}.email"
            ])
            ->join("{$tbStaff}", "{$tbStaff}.id", "=", "{$tbComment}.staff_id")
            ->join("{$tbIdea}", "{$tbIdea}.id", "=", "{$tbComment}.idea_id")
            ->where("{$tbIdea}.id", "=", $id)
            ->get();
    }

    function postIdea(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $param = $request->all();
        $data = [
            'title' => $param["title"],
            'content' => $param["content"],
            'category_id' => $param["category"],
            'staff_id' => Auth::guard("web")->user()->id,
        ];

        IdeaModel::query()->insert($data);
        return true;
    }

    function postComment(Request $request)
    {
        $param = $request->all();
        $data = [
            "staff_id" => Auth::guard("web")->user()->id,
            "idea_id" => $param["idea_id"],
            "message" => $param["comment"]
        ];
        CommentModel::query()->create($data);
        return true;

    }

    function saveProfile(Request $request)
    {
        $id = Auth::guard("web")->user()->id;
        $param = $request->all();
        $validation = Validator::make($param, [
            'staff_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['max:255'],
        ]);

        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $data = [
            'staff_name' => $param["staff_name"],
            'phone' => $param["phone"],
            'sex' => $param["sex"],
            'email' => $param["email"],
            'address' => $param["address"],
        ];

        StaffModel::query()->findOrFail($id)->update($data);
        return self::responseStatus(true);
    }

    function saveChangePassword(Request $request)
    {
        $id = Auth::guard("web")->user()->id;
        $param = $request->all();
        $validation = Validator::make($param, [
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new'
        ]);
        if ($validation->fails()){
            return self::responseStatus(false, $validation);
        }
        $query = StaffModel::query()->findOrFail($id);
        $query->update([
            "password" => Hash::make($param["password_new"])
        ]);
        return self::responseStatus(true);
    }

    function checkView($id)
    {
        $device = Auth::guard("web")->user()->device;
        $q = ViewModel::query()->where("device", "=", $device)
            ->where("idea_id", "=", $id)->first();

        if (!empty($q)) {
            return true;
        }
        $data = [
            "device" => $device,
            "idea_id" => $id
        ];

        return ViewModel::query()->insert($data);
    }
}
