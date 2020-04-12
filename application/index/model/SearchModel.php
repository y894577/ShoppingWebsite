<?php


namespace app\index\model;


use think\Db;

class SearchModel
{
    public function search($item)
    {
        $where['name'] = array('like', '%{$' . $item . '}%');
        $result = Db::table('goods')->where('');
        return $result;
    }
}