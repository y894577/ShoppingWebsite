<?php


namespace app\index\controller;


use app\index\model\SearchModel;
use think\Controller;
use think\Request;
use think\Session;
use think\Url;
use think\View;

class Search extends Controller
{
    public function search(Request $request){
        $data = $request->param();
        $item = $data['item'];
        $tag = $data['tag'];
        $string = 'item=' . $item . '&tag=' . $tag;
        return Url::build('Search/searchTag', $string);
    }

    public function searchTag(Request $request)
    {
        $item = $request->param('item');
        $tag = $request->param('tag');
        $model = new Search();
        if ($tag !== '全部') {
            $result = $model->searchPart($item, $tag);
        } else {
            $result = $model->searchAll($item);
        }
        $v = new View();
        $v->email = Session::get('email');
        $v->result = $result;
        return $v->fetch('search/search');
    }

    public function searchAll($item)
    {
        $model = new SearchModel();
        $result = $model->search($item);
        return json_encode($result);
    }

    public function searchPart($item, $tag)
    {
        $model = new SearchModel();
        $result = $model->searchTag($item, $tag);
        return json_encode($result);
    }
}