<?php


namespace app\index\model;


use think\Db;
use think\Model;

class AdminModel extends Model
{
    public function searchUser()
    {
        $result = Db::table('user')->select();
        return json_encode($result);
    }

    public function searchOrder()
    {
        $result = Db::table('order')->select();
        return json_encode($result);
    }

    public function searchGoods()
    {
        $result = Db::table('goods')->select();
        return json_encode($result);
    }

    public function searchComment(){
        $result = Db::table('comment')->select();
        return json_encode($result);
    }

}