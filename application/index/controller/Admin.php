<?php


namespace app\index\controller;


use app\index\model\AdminModel;
use app\index\model\ShoppingCarModel;
use app\index\model\UserModel;
use think\Controller;

class Admin extends Controller
{
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
}