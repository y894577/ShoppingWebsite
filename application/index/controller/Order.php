<?php


namespace app\index\controller;


use app\index\model\OrderModel;

class Order
{
    public function showOrder()
    {

    }

    public function showUserOrder()
    {

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
            $data['orderID'] = $this->get_random(10);
            $data['address'] = $address;
            $data['isReceive'] = 0;
            $data['isDeliver'] = 0;
            $model = new OrderModel;
            $model->addOrder($data);
        }
    }

    public function get_random($length = 10)
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

}