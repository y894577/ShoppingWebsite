<?php


namespace app\index\validate;


use think\Validate;

class BaseValidate extends Validate
{

    protected $rule = [
        'name' => 'require|max10',
        'email' => 'email',
    ];

    public function test(){
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
    }
}
