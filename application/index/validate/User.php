<?php


namespace app\index\validate;

use think\Validate;


class User extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'email' => 'email',
    ];

}