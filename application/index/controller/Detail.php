<?php


namespace app\index\controller;


use app\index\model\DetailModel;
use think\Controller;

class Detail extends Controller
{
    public function showDetail($ID){
        $model = new DetailModel();
        $result = $model->selectDB($ID);
        return json_encode($result);
    }
}