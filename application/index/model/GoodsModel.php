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
        $result = Db::table('goods')->where('ID',$ID)->delete();
        return $result;
    }

}