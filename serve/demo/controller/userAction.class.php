<?php
include "../model/hotbookModel.class.php";
include "email.class.php";
// 用户类控制器 
class UserAction
{
    // 登录
    public function clogin($userName, $userPassword)
    {
        $user = new UserModel();
        $user->setUserName($userName);
        $user->setUserPassword($userPassword);
        $logintype = $user->getUser();
        $user->closeDB();
        return $logintype;
    }
    // 注册
    public function cregister($userName, $userPassword, $userEmail)
    {
        $user = new UserModel();
        $user->setUserName($userName);
        $user->setUserPassword($userPassword);
        $user->setUserEmail($userEmail);
        $regtype = $user->getUser();
        if ($regtype['type'] == 200 or $regtype['type'] == 201) {
            // 如果有此用户返回201
            $user->closeDB();
            return 201;
        } else {
            // 如果无此用户
            $user->setUser();
            $user->closeDB();
            return 200;
        }
    }

    // 个人信息
    public function cshowUser($userId = null)
    {
        $user = new UserModel();
        $user->setUserId($userId);
        return $user->showUser();
    }

    // 预约借书与排队
    public function cyuyuejieshu($userId, $bookId)
    {
        $num = $this->cshowBookInventory($bookId)["bookInventory"];
        if ($num == 0) {
            // 进入排队类
            $reservation = new ReservationModel($userId);
            $reservation->setReservation($userId, $bookId);
            // 返回300
            return 300;
        } else {
            // 进入预约类
            $lesaseorder = new LesaseorderModel();
            $lesaseorder->setLesaseorder($userId, $bookId, $num);

            //返回301
            return 301;
        }
    }
    // 当前用户预约书籍信息
    public function cshowTUHBook($userId)
    {
        $lesaseorder = new LesaseorderModel();
        $lesaseorder->setUserId($userId);
        $con = $lesaseorder->showUHBook("0,1");
        $book = new BookModel();
        for ($i = 0; $i < count($con); $i++) {
            $con[$i]["bookName"] = $book->iShowInfo($con[$i]["bookId"])[0]["bookName"];
            $con[$i]["bookImg"] = $book->iShowInfo($con[$i]["bookId"])[0]["bookImg"];
        }
        return $con;
    }
    // 发送书籍id查询库存
    public function cshowBookInventory($bookId)
    {
        $book = new BookModel();
        $book->setBookId($bookId);
        return $book->showBookInventory();
    }
    // 发表书评
    public function setEvaluation($bookId, $userId, $evaluatione, $type)
    {
        $evaluationTime = date("Y-m-d");
        $evalua = new EvaluationModel();
        $evalua->setBookId($bookId);
        $evalua->setUserId($userId);
        $evalua->setEvaluation($evaluatione);
        $evalua->setEvaluationTime($evaluationTime);
        $evalua->setEvaluationType($type);
        return $evalua->setEvaluationCon();
    }
    // 问题反馈
    public function setFeedback($userId, $feedbackReason, $feedbackTime)
    {
        $fd = new FeedbackModel();
        $fd->setUserId($userId);
        $fd->setFeedbackReason($feedbackReason);
        $fd->setFeedbackTime($feedbackTime);
        return $fd->setFeedback();
    }
    // 发起学生认证
    public function setStu($userId, $userStuld)
    {
        $user = new UserModel();
        $user->setUserId($userId);
        $user->setUserStuld($userStuld);
        return $user->mSetUserStu();
    }
    // 用户通知
    public function tongzhi($userId)
    {
        $inform = new InformModel();
        $inform->setUserid($userId);
        return $inform->fetInform();
    }
    // 修改个人信息
    public function aUpUser($userId, $userName, $userPassword, $userEmail)
    {
        $user = new UserModel();
        $user->setUserId($userId);
        $user->setUserName($userName);
        $user->setUserPassword($userPassword);
        $user->setUserEmail($userEmail);
        $user->upUser();
        return $this->cshowUser($userId);
    }
}
