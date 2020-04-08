<?php


namespace app\index\model;


use app\index\controller\Goods;
use app\index\controller\ShoppingCar;
use think\Db;
use think\Model;

class ShoppingCarModel extends Model
{

    public function searchList($email){
        $result= Db::table('shoppingCar')->where('email',$email)->select();
//        var_dump($result);
//        $list = new ShoppingCar();
//        foreach ($result as $item){
//            $goods = new Goods();
//            $goods->setEmail($item['email']);
//            $goods->setImg($item['img']);
//            $goods->setInfo($item['info']);
//            $goods->setPrice($item['price']);
//            $goods->setNumber($item['number']);
//        }
        return $result;
    }
}