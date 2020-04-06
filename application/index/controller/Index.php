<?php

namespace app\index\controller;

use app\index\model\User;
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

    public function jumpToIndex()
    {
//        $email = Session::get('email');
//        $passwd = Session::get('passwd');

        $v = new View();
        $v->email = Session::get('email');

        return $v->fetch('index/index');
    }

    public function jumpToAdmin()
    {
        $v = new View();
        $v->email = Session::get('email');
        return $v->fetch('admin/admin');
    }

    public function jumpToShoppingCar()
    {
        //获取shoppingList
        $car = new ShoppingCar();
        $list = $car->shopping(Session::get('email'));

        $v = new View();
        $v->email = Session::get('email');
        $v->list = $list;
        return $v->fetch('shoppingCar/shoppingCar');
    }


    public function login(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        echo 'success';
        $log = new Login();
        $msg = $log->login($email, $passwd);
        if ($msg === '登录成功') {
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

    public function shopping($email)
    {
        $shop = new ShoppingCar();
        $shop->shopping();
    }

}
