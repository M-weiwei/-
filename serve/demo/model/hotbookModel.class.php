<?php
include "informModel.class.php";
// 预约排队书籍模型
class HotBoook extends informModel
{
    // 属性
    protected $hId;
    protected $bookId;
    public function __construct($dbname = "hotBook")
    {
        // 初始化属性值
        parent::__construct($dbname);
    }
    // get/set方法
    public function getHId()
    {
        return $this->hId;
    }
    public function setHId($hId)
    {
        $this->hId = $hId;
    }
    public function getBookId()
    {
        return $this->bookId;
    }
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }
    // 修改热门
    public function setInform()
    {
        return parent::add(array("userid" => $this->userid, "informTittle" => $this->informTittle, "informCon" => $this->informCon, "informTime" => $this->informTime));
    }
    // 获取通知
    public function fetInform()
    {
        parent::field("*");
        return parent::select();
    }
}
