<?php


namespace app\index\controller;


use app\index\model\OrderModel;
use think\Controller;
use think\Request;

class Order extends Controller
{
    private static $model;

    public function showUserOrder($email)
    {
        $model = new OrderModel();
        $result = $model->selectUserOrder($email);
        return json_encode($result);

    }

    public function showAllOrder()
    {
        $model = new OrderModel();
    }

    public function submitOrder($form, $address)
    {

        foreach ($form as $data) {
            unset($data['name']);
            unset($data['total']);
            unset($data['price']);
            unset($data['img']);
            $data['orderID'] = $this->getRandom(10);
            $data['address'] = $address;
            $data['isReceive'] = 0;
            $data['isDeliver'] = 0;
            $model = new OrderModel;
            $model->insertOrder($data);
        }
    }

    public function getRandom($length = 10)
    {
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars); // 将数组打乱
        $output = "";
        for ($i = 0; $i < $length; $i++) {
            $output .= $chars [mt_rand(0, $charsLen)];
        }
        return $output;
    }

    public function receiveGoods($orderID)
    {
        $model = new OrderModel();
        $order = $model->selectOrder($orderID);
        $order[0]['isReceive'] = 1;
        $order[0]['isDeliver'] = 1;
        $model->updateOrder($order[0]);
        echo "确认收货成功！";
    }
}