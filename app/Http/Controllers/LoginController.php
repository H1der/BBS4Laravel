<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 登陆首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * 登陆行为
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login()
    {
        $this->validate(\request(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:16',
            'is_remember' => 'integer',
        ]);

        $user = \request(['email', 'password']);
        $is_remember = boolval(\request('is_remember'));
        if (\Auth::attempt($user, $is_remember)) {
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors('邮箱密码不匹配');

    }

    /**
     * 退出
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }
}
