<?php

namespace App\Modules\Fronts\Home\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Fronts\Home\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var HomeService
     */
    private $homeService;

    /**
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request) {

        $categories = $this->homeService->getCategories();
        $data = $this->homeService->getIdea($request);
        return view("Home::home.index", [
            "param" => $request,
            "categories" => $categories,
            "data" => $data
        ]);
    }


    /**
     * detail
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function detail(Request $request, $id) {
        $categories = $this->homeService->getCategories();
        $data = $this->homeService->getIdeaDetail($id);
        $comments = $this->homeService->getCommentByIdea($id);
        $this->homeService->checkView($id);
        return view("Home::detail.index", [
            "param" => $request,
            "categories" => $categories,
            "data" => $data,
            "comments" => $comments
        ]);
    }

    /**
     * postIdea
     *
     * @param  mixed $request
     * @return void
     */
    public function postIdea(Request $request) {
        $this->homeService->postIdea($request);
        return response()->json([
                "data" => "Created Successfully"
        ]);
    }

    /**
     * postComment
     *
     * @param  mixed $request
     * @return void
     */
    public function postComment(Request $request) {
        $status = $this->homeService->postComment($request);
        return redirect()->back()->with($status);
    }

    /**
     * profile
     *
     * @return void
     */
    public function profile() {
        return view("Home::setting.profile", [
            "data" => Auth::guard("web")->user()
        ]);
    }

    /**
     * saveProfile
     *
     * @param  mixed $request
     * @return void
     */
    public function saveProfile(Request $request) {
        $status = $this->homeService->saveProfile($request);
        return $this->responseAndMessage($status, "profile");
    }

    /**
     * changePassword
     *
     * @return void
     */
    public function changePassword() {
        return view("Home::setting.password");
    }

    /**
     * postChangePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function postChangePassword(Request $request) {
        $status = $this->homeService->saveChangePassword($request);
        return $this->responseAndMessage($status, "home");
    }


    /**
     * myIdea
     *
     * @param  mixed $request
     * @return void
     */
    public function myIdea(Request $request)
    {
        $categories = $this->homeService->getCategories();
        $data = $this->homeService->getIdea($request, true);
        return view("Home::my-idea.index", [
            "param" => $request,
            "categories" => $categories,
            "data" => $data
        ]);
    }

    /**
     * responseAndMessage
     *
     * @param  mixed $object
     * @param  mixed $route
     * @param  mixed $param
     * @return void
     */
    public static function responseAndMessage($object = [], $route = null, $param = false)
    {
        if ($object['status']) {
            $msg = "Successfully!";
            return redirect()->route($route, $param)->with(['status' => "success", 'message' => $msg]);
        } else {
            $msg =  "Failed!";
            return redirect()->back()->with(['status' => "error", 'message' => $msg])->withErrors($object['messages'])->withInput();
        }
    }
}
