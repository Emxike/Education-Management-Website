<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class LoginAdminController extends Controller
{
    use AuthenticatesUsers;

    /**
     * LoginAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * @return Factory|View
     */
    public function getLogin()
    {
        return view('auth.adminLogin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $param = $request->all();

        $validation = Validator::make($request->post(), [
            'user_name' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $member = Member::query()->where('user_name', '=', $param['user_name'])->first();
        if (isset($member)) {
            // Attempt to log the user in
            if ($member->status == Member::LOCK) {
                return back()->withErrors([
                    "user_name" => " ",
                    "password" => "Your account is locked. Please contact admin to unlock!"
                ])->withInput();
            }
            $remember_me = $request->has('remember') ? true : false;
            if (auth()->guard('admin')->attempt(['user_name' => $param['user_name'], 'password' => $param['password']], $remember_me)) {
                $member->status = Member::UNLOCK;
                $member->save();

                $admin = Auth::guard('admin')->user();
                Auth::guard('admin')->login($admin, true);
                return redirect()->route("dashboard");
            }
            return back()->withErrors([
                'user_name' => ' ',
                'password' => trans('Wrong account or password!'),
            ])->withInput();
        }
        return back()->withErrors([
            'user_name' => ' ',
            'password' => trans('Wrong account or password!'),
        ])->withInput();
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route("admin.show");
    }
}
