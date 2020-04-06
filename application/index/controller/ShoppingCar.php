<?php


namespace app\index\controller;


use app\index\model\ShoppingCarModel;

class ShoppingCar
{
    public $list = array();

//    public function add(){
//        $this->list
//    }

    public function shopping($email)
    {
        $shp = new ShoppingCarModel();
        $result = $shp->searchList($email);
        var_dump(json_encode($result));
        return json_encode($result);
    }

}