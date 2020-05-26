<?php


namespace app\index\controller;


use app\index\model\AdminModel;
use app\index\model\CommentModel;
use app\index\model\GoodsModel;
use app\index\model\OrderModel;
use app\index\model\ShoppingCarModel;
use app\index\model\UserModel;
use think\Controller;
use think\Request;
use think\Session;
use think\View;

class Admin extends Controller
{

    public function index(){
            return $this->fetch('adminLogin/adminLogin');
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

    public function admin()
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

    public function showAllUser()
    {
        $model = new AdminModel();
        $result = $model->searchUser();
        return $result;
    }

    public function deleteUser($data)
    {
        $email = $data['email'];
        $model = new UserModel();
        $result = $model->deleted($email);
        if ($result)
            echo("删除成功");
    }

    public function showAllOrder()
    {
        $model = new AdminModel();
        $result = $model->searchOrder();
        return $result;
    }

    public function showAllGoods(){
        $model = new AdminModel();
        $result = $model->searchGoods();
        return $result;
    }

    public function showAllComment(){
        $model = new AdminModel();
        $result = $model->searchComment();
        return $result;
    }

    public function deleteOrder(Request $request)
    {
        $orderID = $request->param('orderID');
        var_dump($orderID);
        $model = new OrderModel();
        $model->deleteOrder($orderID);
    }

    public function adminDeleteUser(Request $request)
    {
        $email = $request->param('email');
        $model = new UserModel();
        $model->deleted($email);
    }

    public function adminDeleteOrder(Request $request)
    {
        $orderID = $request->param('orderID');
        var_dump($orderID);
        $model = new OrderModel();
        $model->deleteOrder($orderID);
    }

    //此函数用于删除数据库商品
    public function adminDeleteGoods(Request $request)
    {
        $ID = $request->param('ID');
        $model = new GoodsModel();
        $model->deleteGoods($ID);
        $car = new ShoppingCarModel();
        $car->deletedGoods($ID);
    }

    public function adminDeleteComment(Request $request){
        $data = $request->param();
        $model = new CommentModel();
        $model->deleteComment($data);
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
        var_dump($data);
        $model = new CommentModel($data);
        $model->updateComment($data);
    }
}