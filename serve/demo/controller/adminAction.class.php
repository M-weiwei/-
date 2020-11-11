<?php
// 管理员控制器类
include "../model/InformModel.class.php";
class AdminAction
{
    // 书籍录入与修改
    public function setBook($bookName/*书名*/, $bookAuthor/*作者*/, $bookPublishingTime/*出版时间*/, $bookClassification/*分类id*/, $bookIntroduction/*书籍介绍*/, $bookInventory/*库存*/, $bookImg/*书籍封面路径*/, $type)
    {
        $book = new BookModel();
        $book->setBookName($bookName);
        $book->setBookAuthor($bookAuthor);
        $book->setBookPublishingTime($bookPublishingTime);
        $book->setBookClassification($bookClassification);
        $book->setBookIntroduction($bookIntroduction);
        $book->setBookInventory($bookInventory);
        $book->setBookImg($bookImg);
        // $type = 1写入 type = 2修改
        return $book->msetBook($type);
    }
    // 书籍报损
    public function damage($bookId, $userId, $damageReason)
    {
        $dam = new DamageModel();
        $dam->setBookId($bookId);
        $dam->setUserId($userId);
        $dam->setDamageReason($damageReason);
        $dam->setDamageTime(date("Y-m-d"));
        return $dam->setDamage();
    }
    // 书评审核
    public function auditEvaluation($evaluationId, $type)
    {
        $evalua = new EvaluationModel();
        $evalua->setEvaluationId($evaluationId);
        $evalua->setEvaluationtype($type);
        // echo $type;
        return $evalua->updateEvaluation();
    }
    // 学生认证(1:审核状态，2：审核通过,0：审核不通过)
    public function upUserMarkin($userId, $type)
    {
        $user = new UserModel();
        $user->setUserId($userId);
        $user->setUserMarking($type);
        return $user->updateUserStu();
    }
    // 用户账号封禁
    public function updateUserType($userId, $type)
    {
        $user = new UserModel();
        $user->setUserId($userId);
        $user->setUserType($type);
        return $user->upUserType();
    }
    // 反馈回复
    public function rFeedback($userId, $feedbackId, $feedbackCon)
    {
        $fb = new FeedbackModel();
        $fb->upFeedback($feedbackId, ["FeedbackType"], [1]);
        $inform = new InformModel();
        $inform->setUserId($userId);
        $inform->setInformTittle("反馈回复");
        $inform->setInformCon($feedbackCon);
        $inform->setInformTime(date("Y-m-d"));
        $inform->setInform();
    }
    // 审核中用户列表
    public function stuList($page)
    {
        $user = new UserModel();
        // echo $page;
        return $user->mUserList($page);
    }
    // 用户列表
    public function userList($page)
    {
        $user = new UserModel();
        // echo $page;
        return $user->showUser($page);
    }
    // 评论列表
    public function evaluaList($page)
    {
        $evalua = new EvaluationModel();
        return $evalua->mEvaluaList($page);
    }

    // 借书列表(快过期的)
    public function lesList($page)
    {
        $les = new LesaseorderModel();
        return $les->mLesList($page);
    }

    // 一键催还
    public function cuiHuan()
    {
        $les = new LesaseorderModel();
        $arr = $this->lesList(-2);
        $arr1 = [];
        $inform = new informModel();
        foreach ($arr as $i) {
            $inform->setUserid($i["userId"]);
            $inform->setInformTittle("还书通知");
            $inform->setInformCon("您借阅书号为{$i['bookId']}的书籍即将到期或已到期，请尽快还书。");
            $inform->setInformTime(date("Y-m-d"));
            $inform->setInform();
            array_push($arr1, $i["userId"]);
        }
        return 1;
    }
    // 确认借/还书接口
    // public function jieHuan($userId, $bookId, $type)
    // {
    //     $rUserId = 0;
    //     if ($type == 2) {
    //         // 还书同时将下一位排队的加入借阅表
    //         $rese = new ReservationModel(0);
    //         $rese->setBookId($bookId);
    //         // 根据排队顺序查找到用户id
    //         $rUserId = $rese->findPDR();
    //         $les = new LesaseorderModel();
    //         if ($rUserId != 0) {
    //             // 写入借阅表
    //             $les->setLesaseorder($rUserId, $bookId, 1);
    //             // 通知
    //             $inform = new informModel();
    //             $inform->setUserid($rUserId);
    //             $inform->setInformTittle("借阅通知");
    //             $inform->setInformCon("您所借阅书号为{$bookId}的书已有空余库存，已为您自动借阅，请与明日中午12点前取书，否则将会过期");
    //             $inform->setInformTime(date("Y-m-d"));
    //             $inform->setInform();
    //         }
    //     }
    //     $book = new BookModel();
    //     $book->setBookId($bookId);
    //     $num = $book->showBookInventory();
    //     $les = new LesaseorderModel();
    //     $les->setUserId($userId);
    //     $les->setBookId($bookId);
    //     $les->mSetLesaseorderId();
    //     $flag = $les->mSetLesaseorderType($type, $rUserId, $num);
    //     return $flag;
    // }
    public function jieHuan($LesaseorderId, $type)
    {
        $les = new LesaseorderModel();
        $les->setLesaseorderId($LesaseorderId);
        $les->showBookName();
        $bookId = $les->getBookId();
        $rUserId = 0;
        if ($type == 2) {
            // 还书同时将下一位排队的加入借阅表
            $rese = new ReservationModel(0);
            $rese->setBookId($bookId);
            // 根据排队顺序查找到用户id
            $rUserId = $rese->findPDR();
            if ($rUserId != 0) {
                // 写入借阅表
                $les->setLesaseorder($rUserId, $bookId, 1);
                // 通知
                $inform = new informModel();
                $inform->setUserid($rUserId);
                $inform->setInformTittle("借阅通知");
                $inform->setInformCon("您所借阅书号为{$bookId}的书已有空余库存，已为您自动借阅，请与明日中午12点前取书，否则将会过期");
                $inform->setInformTime(date("Y-m-d"));
                $inform->setInform();
            }
        }

        $book = new BookModel();
        $book->setBookId($bookId);
        // 获取当前库存
        $num = $book->showBookInventory();
        // print_r($num);
        $flag = $les->mSetLesaseorderType($type, $rUserId, $num);
        return $flag;
    }
}
