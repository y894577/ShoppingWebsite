<?php

namespace app\index\controller;

use app\index\model\SearchModel;
use app\index\model\ShoppingCarModel;
use app\index\model\User;
use think\Console;
use think\Controller;
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

    public function jumpToIndex()
    {
        $v = new View();
        $v->email = Session::get('email');

        return $v->fetch('index/index');
    }

    public function jumpToRegister()
    {
        return $this->fetch('registers/registers');
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
        $string = 'ID=' . $ID;

        return Url::build('index/detail', $string);
    }

    public function jumpToOrder()
    {
        $v = new View();
        $v->email = Session::get('email');

        $car = new ShoppingCar();
        $list = $car->shopping(Session::get('email'));
        $v->list = $list;

        return $v->fetch('order/order');
    }

    public function jumpToSearch(Request $request)
    {
        $item = $request->param('item');
        $string = 'item=' . $item;

        return Url::build('index/search', $string);
    }

    public function jumpToPayment()
    {
        $v = new View();
        $v->email = Session::get('email');
        return $v->fetch('payment/payment');
    }


    public function detail($ID)
    {
        $detail = new Detail();
        $list = $detail->showDetail($ID);
        $comment = new Comment();
        $list2 = $comment->showComment($ID);
        $v = new View();
        $v->email = Session::get('email');
        $v->detail = $list;
        $v->comment = $list2;

        return $v->fetch('itemDetail/itemDetail');
    }

    public function search($item)
    {
        $model = new Search();
        $result = $model->searchAll($item);

        $v = new View();
        $v->email = Session::get('email');
        $v->result = $result;

        return $v->fetch('search/search');

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
