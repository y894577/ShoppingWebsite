<?php


namespace app\index\model;


use think\Db;

class SearchModel
{
    public function search($item)
    {
        $where['name'] = array('like', '%' . $item . '%');
        $result = Db::table('goods')->where($where)->select();
        return $result;
    }

    public function searchTag($item, $tag)
    {
        $where['name'] = array('like', '%' . $item . '%');
        $result = Db::table('goods')->where($where)->where('tag', $tag)->select();
        return $result;
    }
}