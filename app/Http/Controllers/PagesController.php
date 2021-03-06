<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }


    public function permissionDenied()
    {
        //如果当前用户有权限登录后台，就直接跳转
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }

        return view('pages.permission_denied');
    }
}
