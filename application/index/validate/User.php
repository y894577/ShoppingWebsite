<?php


namespace app\index\validate;

use think\Validate;


class User extends Validate
{
    protected $rule = [
        'passwd' => 'require|between:6:12',
        'email' => 'email',
    ];

}