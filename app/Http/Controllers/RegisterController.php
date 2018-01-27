<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * 注册行为
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register()
    {
        $this->validate(\request(), [
            'name' => 'required|min:4|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6|max:16|confirmed'
        ]);

        $name = \request('name');
        $email = \request('email');
        $password = bcrypt(\request('password'));
        $user = User::create(compact('name', 'email', 'password'));

        return redirect('login');


    }
}
