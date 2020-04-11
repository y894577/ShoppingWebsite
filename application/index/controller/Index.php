<?php

namespace app\index\controller;

use app\index\model\ShoppingCarModel;
use think\Controller;
use think\Exception;
use think\Request;
use think\Session;
use think\Url;
use think\View;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('login/login');
    }

    public function jumpToRegister()
    {
        return $this->fetch('registers/registers');
    }

    public function jumpToIndex()
    {
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

    public function jumpToDetail(Request $request)
    {
        $ID = $request->param('ID');
        $detail = new Detail();
        $list = $detail->showDetail($ID);
        $v = new View();
        $v->email = Session::get('email');
        $v->detail = $list;

        return Url::build('index/detail', 'ID=123abc');
    }

    public function jumpToOrder()
    {
        $v = new View();
        $v->email = Session::get('email');
        return $v->fetch('order/order');
    }

    public function jumpToPayment(){
        $v = new View();
        $v->email = Session::get('email');
        return $v->fetch('payment/payment');
    }

    public function detail($ID)
    {
        var_dump($ID);
        $detail = new Detail();
        $list = $detail->showDetail($ID);
        $v = new View();
        $v->email = Session::get('email');
        $v->detail = $list;
        return $v->fetch('itemDetail/itemDetail');
    }

    public function addGoods(Request $request)
    {
        $email = Session::get('email');
        $ID = $request->param('ID');
        $price = $request->param('price');
        $name = $request->param('name');
        $number = $request->param('num');
        $img = $request->param('img');
        $data = ['email' => $email, 'ID' => $ID, 'name' => $name, 'price' => $price, 'number' => $number, 'img' => $img];
        $car = new ShoppingCar();
        $car->addGoods($data);
    }

    public function deleteGoods($ID)
    {
        $email = Session::get('email');
        $model = new ShoppingCarModel();
        $model->deleted($email, $ID);
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


    public function logout()
    {
        session(null);
        return $this->fetch('login/login');
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
