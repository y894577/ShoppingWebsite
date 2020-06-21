<?php


namespace app\index\controller;


use think\Controller;

class Captcha extends Controller
{
    public function verify()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }

    public function check($code = '')
    {
        //     $captcha=new \think\captcha\Captcha();
        $captcha = new Captcha();
        if (!$captcha->check($code)) {
            $this->error('验证码错误');
        } else {
            $this->success('验证码正确');
        }
    }

}