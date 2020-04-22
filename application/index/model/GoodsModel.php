<?php


namespace app\index\model;


use think\Db;

class GoodsModel
{
    public function addGoods($data)
    {
        $result = Db::table('goods')->update($data);
        return $result;
    }

    public function deleteGoods($ID)
    {
        $result = Db::table('goods')->where('ID', $ID)->delete();
        return $result;
    }

    public function updateGoods($data)
    {
        $ID = $data['ID'];
        $result = Db::table('goods')->where('ID', $ID)->update($data);

        //这块数据库没有设计好，shoppingCar还要再更新一次
        //2.0一定.jpg
        $name = $data['name'];
        $price = $data['price'];
        Db::table('shoppingCar')->where('ID', $ID)->update(['name' => $name, 'price' => $price]);
    }
}