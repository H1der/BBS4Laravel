<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //管理员列表
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    //创建管理员页面
    public function create()
    {
        return view('admin.user.add');
    }

    //创建操作
    public function store()
    {
        $this->validate(\request(), [
            'name' => 'required|min:3',
            'password' => 'required',
        ]);

        $name = \request('name');
        $password = bcrypt(\request('password'));
        AdminUser::create(compact('name', 'password'));

        return redirect('admin/users');
    }
}
