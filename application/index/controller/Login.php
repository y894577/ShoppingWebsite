<?php


namespace app\index\controller;

use app\index\model\LoginModel;
use think\captcha\Captcha;
use think\Controller;
use think\Request;
use think\Session;
use think\Validate;
use think\View;

class Login extends Controller
{
    public $captcha;

    public function index()
    {
        return $this->fetch('login/login');
    }

    public function login(Request $request)
    {
        $code = $request->param('code');
        $email = $request->param('email');
        $passwd = $request->param('passwd');
        $isAdmin = 0;
        if ($this->checkVerify($code) === 'success') {
            $log = new Login();
            $msg = $log->checkLogin($email, $passwd, $isAdmin);
            if ($msg === '登录成功') {
                echo("登录成功");
            } else {
                echo("登录失败");
            }
        } else {
            echo("验证码错误");
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
            return $log->connectDB($email, $passwd, $isAdmin);
        }
    }

    public function logout()
    {
        session(null);
        return $this->fetch('login/login');
    }

    //验证码
    public function verify()
    {
        $captcha = new Captcha();
        $captcha->length   = 4;
        return $captcha->entry();
    }

    public function checkVerify($code = '')
    {
        $captcha = new Captcha();
        if (!$captcha->check($code)) {
//            $this->error('验证码错误');
            return 'error';
        } else {
//            $this->success('验证码正确');
            return 'success';
        }
    }
}