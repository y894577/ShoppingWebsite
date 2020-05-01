<?php


namespace app\index\model;


use think\Db;
use think\Model;

class OrderModel extends Model
{
    public function selectAllOrder()
    {
        $result = Db::table('order')->select();
        return $result;
    }

    public function selectOrder($orderID)
    {
        $result = Db::table('order')->where('orderID', $orderID)->select();
        return $result;
    }

    public function deleteOrder($orderID)
    {
        $result = Db::table('order')->where('orderID', $orderID)->delete();
        return $result;
    }

    public function updateOrder($data)
    {
        $orderID = $data['orderID'];
        $result = Db::table('order')->where('orderID', $orderID)->update($data);
    }

    public function insertOrder($data)
    {
        $result = Db::table('order')->insert($data);
        return $result;
    }

    public function selectUserOrder($email)
    {
        $result = Db::table('order')->where('email', $email)->select();
        $res = Db::name('order')
            ->alias('a')
            ->join('goods b', 'a.ID=b.ID')
            ->select();
        return $res;
    }
}