<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('login/login');
    }

    public function login(Request $request)
    {
//        print_r($request->param());

        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $reg = new register();
        $reg = $reg->index($email,$passwd);
    }

    public function res()
    {
        return;
    }

}
