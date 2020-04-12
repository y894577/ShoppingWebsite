<?php


namespace app\index\controller;


use app\index\model\CommentModel;
use think\Controller;

class Comment extends Controller
{
    public function showComment($ID)
    {
        $model = new CommentModel();
        $result = $model->selectList($ID);

        return json_encode($result);
    }
}