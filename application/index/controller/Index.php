<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\View;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('login/login');
    }

    public function jump()
    {
        $v = new View();
        $v->email = Session::get('email');
        return $v->fetch('admin/admin');
    }


    public function login(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        echo 'success';
        $log = new Login();
        $msg = $log->login($email, $passwd);
        if($msg === '登录成功'){
            var_dump("success");
        }
    }

    public function register(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $checkpasswd = $request->param('checkpasswd');
        $reg = new Register();
        $reg->register($email, $passwd, $checkpasswd);
    }

}
