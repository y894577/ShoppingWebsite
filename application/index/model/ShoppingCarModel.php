<?php


namespace app\index\model;


use app\index\controller\Goods;
use app\index\controller\Car;
use think\Db;
use think\Model;

class ShoppingCarModel extends Model
{

    public function searchList($email)
    {
        $result = Db::table('shoppingcar')->where('email', $email)->select();
//        $list = new Car();
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

    //查找指定条目
    public function searchGoods($ID, $email)
    {
        $result = Db::table('shoppingcar')->where('ID', $ID)->where('email', $email)->select();
        return $result;
    }

    //更新数量
    public function updateList($email, $ID, $value)
    {
        $result = Db::table('shoppingcar')->where('ID', $ID)->update(['number' => $value]);
        return $result;
    }

    //添加数量
    public function addList($data)
    {
        $result = Db::table('shoppingCar')->insert($data);
        return $result;
    }

    //删除购物车
    public function deleted($email, $ID)
    {
        $result = Db::table('shoppingcar')->where('ID', $ID)->where('email', $email)->delete();
        return $result;
    }

    //删除某一商品的所有信息
    public function deletedGoods($ID){
        $result = Db::table('shoppingcar')->where('ID', $ID)->delete();
        return $result;
    }

}