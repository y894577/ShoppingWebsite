<?php


namespace app\index\controller;


use app\index\model\ShoppingCarModel;

class ShoppingCar
{
    public $list = array();


    public function shopping($email)
    {
        $shp = new ShoppingCarModel();
        $result = $shp->searchList($email);
//        var_dump(json_encode($result));
        return json_encode($result);
    }

    public function update($ID,$value){
        $shp = new ShoppingCarModel();
        $shp->updateList($ID,$value);
    }

}