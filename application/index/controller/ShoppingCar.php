<?php


namespace app\index\controller;


use app\index\model\ShoppingCarModel;
use think\Session;

class ShoppingCar
{
    public $list = array();


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

//        $name = $detail[0].name;
//        $price = $detail[0].price;
//        $img = $detail[0].img;

//        $data = ['ID'=>$ID,'info'=>$name,'price'=>$price,'number'=>$num,'img'=>$img];

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
            $result = $model->addList($data);
            if ($result)
                echo("添加成功！");
        }
    }


}