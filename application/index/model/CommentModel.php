<?php


namespace app\index\model;


use think\Db;
use think\Model;

class CommentModel extends Model
{
    public function deleteComment($data)
    {
        $commentID = $data['commentID'];
        Db::table('comment')->where(['commentID' => $commentID])->delete();
    }

    public function selectList($ID)
    {
        $result = Db::table('comment')->where('ID', $ID)->select();
        return $result;
    }

    public function updateComment($data)
    {
        $ID = $data['ID'];
        $email = $data['email'];
        $date = $data['date'];
        $result = Db::table('comment')->where(['ID' => $ID, 'email' => $email, 'date' => $date])->update($data);
    }
}