<?php


namespace app\index\controller;


use app\index\model\RegisterModel;
use think\Controller;
use think\Validate;

class Register extends Controller
{
    public function register($email, $passwd, $checkpasswd)
    {
        $this->email = $email;
        $this->passwd = $passwd;
        $rule = [
            'passwd' => 'require|max:18|min:6',
            'email' => 'require|email',
        ];
        $msg = [
            'passwd.require' => '密码不能为空',
            'passwd.max' => '密码必须在6-18位之间',
            'passwd.min' => '密码必须在6-18位之间',
            'email' => '邮箱格式错误',
            'email.require' => '邮箱不能为空',
        ];
        $data = [
            'email' => $email,
            'passwd' => $passwd
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($data);
        if (!$result) {
            dump($validate->getError());
        } else {
            $reg = new RegisterModel();
            $reg->connectDB($email,$passwd);
        }
    }
}