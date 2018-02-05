<?php

namespace App\Http\Controllers\Admin;

use App\AdminPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //权限列表页面
    public function index()
    {
        $permissions = AdminPermission::paginate(10);
        return view('admin/permission/index', compact('permissions'));
    }

    //创建权限
    public function create()
    {
        return view('admin/permission/add');
    }

    //创建权限实际行为
    public function store()
    {

    }
}
