<?php


namespace app\index\model;


use think\Db;
use think\Model;

class CommentModel extends Model
{
    public function selectList($ID)
    {
        $result = Db::table('comment')->where('ID', $ID)->select();
        return $result;
    }
}