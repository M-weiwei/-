<?php
include "reservationModel.class.php";
// 书籍租出模型
class LesaseorderModel extends ReservationModel
{
    // 属性
    protected $lesaseorderId;
    protected $userId;
    protected $bookId; // *
    protected $lesaseorderRantalTime;
    protected $lesaseorderReturnTime;
    protected $lesaseorderCurrentType;

    public function __construct($dbname = "lesaseorder")
    {
        parent::__construct(0, $dbname);
    }
    // get/set
    public function getLesaseorderId()
    {
        return $this->lesaseorderId;
    }
    public function setLesaseorderId($lesaseorderId)
    {
        $this->lesaseorderId = $lesaseorderId;
    }
    public function getLesaseorderRantalTime()
    {
        return $this->lesaseorderRantalTime;
    }
    public function setLesaseorderRantalTime($lesaseorderRantalTime)
    {
        $this->lesaseorderRantalTime = $lesaseorderRantalTime;
    }
    public function getLesaseorderReturnTime()
    {
        return $this->lesaseorderReturnTime;
    }
    public function setLesaseorderReturnTime($lesaseorderReturnTime)
    {
        $this->lesaseorderReturnTime = $lesaseorderReturnTime;
    }
    public function getLesaseorderCurrentType()
    {
        return $this->lesaseorderCurrentType;
    }
    public function setLesaseorderCurrentType($lesaseorderCurrentType)
    {
        $this->lesaseorderCurrentType = $lesaseorderCurrentType;
    }
    public function showBookName()
    {
        parent::field("*");
        parent::where("lesaseorderId={$this->lesaseorderId}");
        $sel = parent::select();
        // print_r($sel);
        $this->bookId = $sel[0]["bookId"];
        $this->userId = $sel[0]["userId"];
        return $sel;
    }
    // 查询当前用户当前已租借租借的书籍
    public function showUHBook($type)
    {
        // 获取所有字段*
        parent::field("bookId");
        // 通过id查询
        parent::where("userId={$this->userId} and lesaseorderCurrentType in ({$type})");
        $sel = parent::select();
        // echo parent::_sql();
        return $sel;
    }
    // 查看所有快过期的租借订单
    public function mLesList($page)
    {
        if ($page != -2) {
            $opNum = 10 * ($page - 1);
            parent::limit("{$opNum},10");
        }
        $date = date('Y-m-d', strtotime('+1day'));
        parent::field("*");
        parent::where("lesaseorderReturnTime < '{$date}' or lesaseorderReturnTime = '{$date}'");
        $con = parent::countsql();
        return array("list" => parent::select(), "con" => $con);
    }
    // 写入订单
    public function setLesaseorder($userId, $bookId, $num)
    {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $time = date('Y-m-d');
        $time1 = date('Y-m-d', strtotime('+1 months'));
        $arr = array("userId" => $this->userId, "bookId" => $this->bookId, "lesaseorderRantalTime" => $time, "lesaseorderReturnTime" => $time1, "lesaseorderCurrentType" => 0);
        parent::add($arr);
        // echo parent::_sql();

        parent::setTableName("book");
        parent::where("bookId={$this->bookId}");
        $update = parent::update(array("bookInventory" => ($num - 1)));
        parent::setTableName("lesaseorder");
        return $update;
    }
    // 根据用户id与书籍id查询订单
    public function mSetLesaseorderId()
    {
        parent::field("*");
        parent::where("userId = {$this->userId} and bookId = {$this->bookId}");
        $sel = parent::select();
        $this->lesaseorderId = $sel["lesaseorderId"];
        return $sel;
    }
    // 修改订单状态
    public function mSetLesaseorderType($type, $type1, $num)
    {
        $this->lesaseorderCurrentType = $type;
        parent::where("lesaseorderId = {$this->lesaseorderId}");
        // echo $this->lesaseorderCurrentType;
        $update = parent::update(array("lesaseorderCurrentType" => $this->lesaseorderCurrentType));
        // echo parent::_sql();
        if ($type == 2 and $type1 == 0) {
            parent::setTableName("book");
            parent::where("bookId={$this->bookId}");
            $update = parent::update(array("bookInventory" => ($num + 1)));
            parent::setTableName("lesaseorder");
        }
        return $update;
    }
}
