<?php

namespace app\index\controller;

use app\index\model\UserModel;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\View;

class Index extends Controller
{
    public function index()
    {
        $v = new View();
        $v->email = Session::get('email');
        return $v->fetch('index/index');
    }

    public function login(){
        return $this->fetch('login/login');
    }


    public function jumpToUser()
    {

        $result = json_encode(Db::table('user')->where('email', Session::get('email'))->select());
        $v = new View();
        $v->email = Session::get('email');
        $v->user = $result;
        return $v->fetch('user/user');
    }



    public function updateUser(Request $request)
    {
        $data = $request->param();
        $model = new UserModel();
        $result = $model->update($data);
        echo '更新成功';
    }


    public function getImg(Request $request)
    {
        $file = $request->file('image');

        if ($file) {
            $oldPath = $file->getInfo()["tmp_name"];
            $fileName = $request->post('fileName');
            $newPath = $_SERVER['DOCUMENT_ROOT'] . '/public/static/img/user/' . $fileName . '.jpg';
            move_uploaded_file($oldPath, $newPath);
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

}
