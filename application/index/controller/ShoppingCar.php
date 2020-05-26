<?php


namespace app\index\controller;


use app\index\model\ShoppingCarModel;
use think\Controller;
use think\Session;
use think\View;

class ShoppingCar extends Controller
{
    public $list = array();

    public function ShoppingCar()
    {
        //获取shoppingList
        $car = new ShoppingCar();
        $list = $car->shopping(Session::get('email'));

        $v = new View();
        $v->email = Session::get('email');
        $v->list = $list;

        return $v->fetch('shoppingCar/shoppingCar');
    }


    public function shopping($email)
    {
        $shp = new ShoppingCarModel();
        $result = $shp->searchList($email);
        return json_encode($result);
    }

    public function update($ID, $value)
    {
        $email = Session::get('email');
        $shp = new ShoppingCarModel();
        $shp->updateList($email, $ID, $value);
    }

    public function addGoods($data)
    {
        $email = Session::get('email');
        $ID = $data['ID'];
        $model = new ShoppingCarModel();
        if ($model->searchGoods($ID, $email) != null) {
            //若该商品在购物车内，则修改数量
            $result = $model->updateList($email, $ID, $data['number']);
            if ($result)
                echo("更新购物车成功！");
        } else {
            //若该商品不在购物车内，则添加
            $model->addList($data);
            echo("添加成功！");
        }
    }

    public function deleteCarGoods($ID)
    {
        $email = Session::get('email');
        $model = new ShoppingCarModel();
        $model->deleted($email, $ID);
    }


}