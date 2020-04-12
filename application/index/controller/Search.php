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

    public function searchPart()
    {

    }
}