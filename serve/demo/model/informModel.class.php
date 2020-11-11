<?php
include "feedbackModel.class.php";
// 通知模型
class informModel extends FeedbackModel
{
    // 属性
    protected $informId;
    protected $userid;
    protected $informTittle;
    protected $informCon;
    protected $informTime;
    public function __construct($dbname = "inform")
    {
        // 初始化属性值
        parent::__construct($dbname);
    }
    // get/set方法
    public function getInformId()
    {
        return $this->informId;
    }
    public function setInformId($informId)
    {
        $this->informId = $informId;
    }
    public function getUserid()
    {
        return $this->userid;
    }
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }
    public function getInformTittle()
    {
        return $this->informTittle;
    }
    public function setInformTittle($informTittle)
    {
        $this->informTittle = $informTittle;
    }
    public function getInformCon()
    {
        return $this->informCon;
    }
    public function setInformCon($informCon)
    {
        $this->informCon = $informCon;
    }
    public function getInformTime()
    {
        return $this->informTime;
    }
    public function setInformTime($informTime)
    {
        $this->informTime = $informTime;
    }
    // 写入通知
    public function setInform()
    {
        return parent::add(array("userid" => $this->userid, "informTittle" => $this->informTittle, "informCon" => $this->informCon, "informTime" => $this->informTime));
    }
    // 删除通知
    public function delInform()
    {
        parent::where("informId={$this->informId}");
        return parent::deletesql();
    }
    // 获取通知
    public function fetInform()
    {
        parent::field("*");
        parent::where("userId={$this->userid}");
        return parent::select();
    }
}
