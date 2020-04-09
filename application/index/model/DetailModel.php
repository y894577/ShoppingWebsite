<?php


namespace app\index\model;


use think\Db;
use think\Model;

class DetailModel extends Model
{
    //通过ID搜索该商品的详情
    public function selectDB($ID){
        $result = Db::table('goods')->where('ID', $ID)->select();
        var_dump($result);
        return $result;
    }
}