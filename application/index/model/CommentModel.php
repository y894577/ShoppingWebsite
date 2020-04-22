<?php


namespace app\index\model;


use think\Db;
use think\Model;

class CommentModel extends Model
{
    public function selectList($ID)
    {
        $result = Db::table('comment')->where('ID', $ID)->select();
        return $result;
    }

    public function updateComment($data)
    {
        $ID = $data['ID'];
        $email = $data['email'];
        $date = $date['date'];
        $result = Db::table('comment')->where(['ID' => $ID, 'email' => $email, 'date' => $date])->update($data);
    }
}