<?php


namespace app\index\model;


use think\Db;

class UserModel
{
    public function update($data)
    {
        $email = $data['email'];
        $passwd = $data['passwd'];
        $address = $data['address'];
        $result = Db::table('user')->where('email', $email)->update(['passwd' => md5($passwd), 'address' => $address]);
        return $result;
    }

    public function deleted($email)
    {
        $result = Db::table('user')->where('email', $email)->delete();
        return $result;
    }
}