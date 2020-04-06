<?php


namespace app\index\controller;

use app\index\model\LoginModel;
use think\Controller;
use think\Validate;

class Login extends Controller
{

    public function login($email, $passwd)
    {
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
            $log = new LoginModel();
            $log->connectDB($email, $passwd);
        }
    }
}