<?php


namespace app\index\controller;


use app\index\model\RegisterModel;
use think\captcha\Captcha;
use think\Controller;
use think\Request;
use think\Validate;

class Register extends Controller
{
    public function index()
    {
        return $this->fetch('registers/registers');
    }

    public function register(Request $request)
    {
        $code = $request->param('code');
        $email = $request->param('email');
        $passwd = $request->param('passwd');
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
        if ($this->checkVerify($code) === 'success') {
            if (!$result) {
                dump($validate->getError());
            } else {
                $reg = new RegisterModel();
                $reg->connectDB($email, $passwd);
            }
        } else {
            echo("验证码错误");
        }
    }


    //验证码
    public function verify()
    {
        $captcha = new Captcha();
        $captcha->length = 4;
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