<?php


namespace app\index\controller;


use app\index\model\DetailModel;
use think\Controller;
use think\Request;
use think\Session;
use think\Url;
use think\View;

class Detail extends Controller
{
    public function detail(Request $request)
    {
        $ID = $request->param('ID');
        $string = 'ID=' . $ID;

        return Url::build('detail/itemDetail', $string);
    }

        public function itemDetail($ID)
    {
        $detail = new Detail();
        $list = $detail->showDetail($ID);
        $comment = new Comment();
        $list2 = $comment->showComment($ID);
        $v = new View();
        $v->email = Session::get('email');
        $v->detail = $list;
        $v->comment = $list2;

        return $v->fetch('itemDetail/itemDetail');
    }

    public function showDetail($ID){
        $model = new DetailModel();
        $result = $model->selectDB($ID);
        return json_encode($result);
    }
}