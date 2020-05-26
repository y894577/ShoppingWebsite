<?php


namespace app\index\controller;

use app\index\model\LoginModel;
use think\Controller;
use think\Request;
use think\Validate;

class Login extends Controller
{

    public function index(){
        return $this->fetch('login/login');
    }

    public function login(Request $request)
    {
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $log = new Login();
        $msg = $log->checkLogin($email, $passwd, 0);
        if ($msg === '登录成功') {
            var_dump("success");
        }
    }

    public function checkLogin($email, $passwd, $isAdmin)
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
            $log->connectDB($email, $passwd,$isAdmin);
        }
    }

    public function logout()
    {
        session(null);
        return $this->fetch('login/login');
    }
}