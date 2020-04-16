<?php


namespace app\index\controller;


use app\index\model\OrderModel;

class Order
{
    public function showOrder()
    {

    }

    public function showAllOrder()
    {
        $model = new OrderModel();
    }

}