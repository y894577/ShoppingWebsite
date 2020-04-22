<?php

namespace app\index\controller;

use app\index\model\CommentModel;
use app\index\model\GoodsModel;
use app\index\model\OrderModel;
use app\index\model\SearchModel;
use app\index\model\ShoppingCarModel;
use app\index\model\User;
use app\index\model\UserModel;
use think\Console;
use think\Controller;
use think\Db;
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

    public function jumpToUser()
    {

        $result = json_encode(Db::table('user')->where('email', Session::get('email'))->select());
        $v = new View();
        $v->email = Session::get('email');
        $v->user = $result;
        return $v->fetch('user/user');
    }

    public function jumpToAdmin()
    {
        //获取所有用户数据
        $admin = new Admin();
        $userlist = $admin->showAllUser();

        //获取所有订单数据
        $orderlist = $admin->showAllOrder();

        //获取所有货物数据
        $goodslist = $admin->showAllGoods();

        //获取所有评价数据
        $commentlist = $admin->showAllComment();

        $v = new View();
        $v->email = Session::get('email');
        $v->userlist = $userlist;
        $v->orderlist = $orderlist;
        $v->goodslist = $goodslist;
        $v->commentlist = $commentlist;
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

        $result = json_encode(Db::table('user')->where('email', Session::get('email'))->select());
        $v->user = $result;

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

    public function jumpToAdminLogin()
    {
        return $this->fetch('adminLogin/adminLogin');
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

    public function updateUser(Request $request)
    {
        $data = $request->param();
        $model = new UserModel();
        $result = $model->update($data);
        echo '更新成功';
    }

    //此函数用于删除购物车内商品
    public function deleteCarGoods($ID)
    {
        $email = Session::get('email');
        $model = new ShoppingCarModel();
        $model->deleted($email, $ID);
    }

    //此函数用于删除数据库商品
    public function deleteGoods(Request $request)
    {
        $ID = $request->param('ID');
        $model = new GoodsModel();
        $model->deleteGoods($ID);
        $car = new ShoppingCarModel();
        $car->deletedGoods($ID);
    }

    public function deleteUser(Request $request)
    {
        $email = $request->param('email');
        $model = new UserModel();
        $model->deleted($email);
    }

    public function deleteOrder(Request $request)
    {
        $orderID = $request->param('orderID');
        var_dump($orderID);
        $model = new OrderModel();
        $model->deleteOrder($orderID);
    }


    public function login(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $log = new Login();
        $msg = $log->login($email, $passwd, 0);
        if ($msg === '登录成功') {
            var_dump("success");
        }
    }

    public function adminLogin(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $log = new Login();
        $msg = $log->login($email, $passwd, 1);
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

    public function adminUpdateUser(Request $request)
    {
        $data = $request->param();

        $model = new UserModel();
        $result = $model->update($data);
        var_dump($result);
    }

    public function adminUpdateOrder(Request $request)
    {
        $data = $request->param();
        $model = new OrderModel($data);
        $model->updateOrder($data);
    }

    public function adminUpdateGoods(Request $request)
    {
        $data = $request->param();
        $model = new GoodsModel($data);
        $model->updateGoods($data);
    }

    public function adminUpdateComment(Request $request)
    {
        $data = $request->param();
        $model = new CommentModel($data);
        $model->updateComment($data);
    }
}
