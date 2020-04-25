<?php


namespace app\index\controller;


use app\index\model\SearchModel;
use think\Controller;

class Search extends Controller
{
    public function searchAll($item)
    {
        $model = new SearchModel();
        $result = $model->search($item);
        return json_encode($result);
    }

    public function searchPart($item, $tag)
    {
        $model = new SearchModel();
        $result = $model->searchTag($item, $tag);
        return json_encode($result);
    }
}