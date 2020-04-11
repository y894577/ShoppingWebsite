<?php


namespace app\index\model;


use think\Controller;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\Validate;

class LoginModel extends Model
{
    public function connectDB($email, $passwd)
    {
        try {
            $result = Db::table('user')->where('email', $email)->select();
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        }
        $item = $result[0];
        if (!$result) {
            return "该用户不存在";
        } else {
            if (md5($passwd) !== $item['passwd']) {
                return "密码错误";
            } else {
                session('email', $email);
                session('passwd', md5($passwd));
                return "登录成功";
            }
        }
    }
}