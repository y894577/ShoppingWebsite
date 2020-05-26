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
        $v = new View();
        $v->email = Session::get('email');

        return $v->fetch('index/index');
    }


    public function jumpToUser()
    {

        $result = json_encode(Db::table('user')->where('email', Session::get('email'))->select());
        $v = new View();
        $v->email = Session::get('email');
        $v->user = $result;
        return $v->fetch('user/user');
    }



//    public function detail($ID)
//    {
//        $detail = new Detail();
//        $list = $detail->showDetail($ID);
//        $comment = new Comment();
//        $list2 = $comment->showComment($ID);
//        $v = new View();
//        $v->email = Session::get('email');
//        $v->detail = $list;
//        $v->comment = $list2;
//
//        return $v->fetch('itemDetail/itemDetail');
//    }



//    public function addGoods(Request $request)
//    {
//        $email = Session::get('email');
//        $ID = $request->param('ID');
//        $price = $request->param('price');
//        $name = $request->param('name');
//        $number = $request->param('num');
//        $img = $request->param('img');
//        $data = ['email' => $email, 'ID' => $ID, 'name' => $name, 'price' => $price, 'number' => $number, 'img' => $img];
//        $car = new ShoppingCar();
//        $car->addGoods($data);
//    }

    public function updateUser(Request $request)
    {
        $data = $request->param();
        $model = new UserModel();
        $result = $model->update($data);
        echo '更新成功';
    }

//    //此函数用于删除购物车内商品
//    public function deleteCarGoods($ID)
//    {
//        $email = Session::get('email');
//        $model = new ShoppingCarModel();
//        $model->deleted($email, $ID);
//    }






//    public function login(Request $request)
//    {
//        $email = $request->param('email');
//        $passwd = $request->param('passwd');
//        $log = new Login();
//        $msg = $log->login($email, $passwd, 0);
//        if ($msg === '登录成功') {
//            var_dump("success");
//        }
//    }

//    public function adminLogin(Request $request)
//    {
//        $email = $request->param('email');
//        $passwd = $request->param('passwd');
//        $log = new Login();
//        $msg = $log->login($email, $passwd, 1);
//        if ($msg === '登录成功') {
//            var_dump("success");
//        }
//    }

//    public function logout()
//    {
//        session(null);
//        return $this->fetch('login/login');
//    }

    public function register(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $checkpasswd = $request->param('checkpasswd');
        $reg = new Register();
        $reg->register($email, $passwd, $checkpasswd);
    }

    public function submitOrder(Request $request)
    {
        $data = $request->param();
        $form = $data['form'];
        $address = $data['address'];
        $model = new Order();
        $model->submitOrder($form, $address);
    }

    public function getImg(Request $request)
    {
        $file = $request->file('image');

        if ($file) {
            $oldPath = $file->getInfo()["tmp_name"];
            $fileName = $request->post('fileName');
            $newPath = $_SERVER['DOCUMENT_ROOT'] . '/public/static/img/user/' . $fileName . '.jpg';
            move_uploaded_file($oldPath, $newPath);
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

//    public function receiveGoods(Request $request)
//    {
//        $orderID = $request->param('orderID');
//        $model = new Order();
//        $model->receiveGoods($orderID);
//    }
}
