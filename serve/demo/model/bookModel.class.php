<?php
include "bookclassModel.class.php";
// 书籍模型
class BookModel extends BookclassModel
{
    // 属性
    protected $bookId;                // 书籍id
    protected $bookName;                // 书籍名
    protected $bookAuthor;            // 书籍作者
    protected $bookPublishingTime;    // 书籍出版时间
    protected $bookClassification;    // 书籍分类标签
    protected $bookIntroduction;        // 书籍介绍
    protected $bookInventory;            // 书籍库存
    // 方法
    // 构造方法
    public function __construct($dbname = "book")
    {
        // 初始化属性值
        parent::__construct($dbname);
    }
    // get/set方法
    public function getBookId()
    {
        return $this->bookId;
    }
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }

    public function getBookName()
    {
        return $this->bookName;
    }
    public function setBookName($bookName)
    {
        $this->bookName = $bookName;
    }

    public function getBookAuthor()
    {
        return $this->bookAuthor;
    }
    public function setBookAuthor($bookAuthor)
    {
        $this->bookAuthor = $bookAuthor;
    }

    public function getBookPublishingTime()
    {
        return $this->bookPublishingTime;
    }
    public function setBookPublishingTime($bookPublishingTime)
    {
        $this->bookPublishingTime = $bookPublishingTime;
    }

    public function getBookClassification()
    {
        return $this->bookClassification;
    }
    public function setBookClassification($bookClassification)
    {
        $this->bookClassification = $bookClassification;
    }

    public function getBookIntroduction()
    {
        return $this->bookIntroduction;
    }
    public function setBookIntroduction($bookIntroduction)
    {
        $this->bookIntroduction = $bookIntroduction;
    }

    public function getBookInventory()
    {
        return $this->bookInventory;
    }
    public function setBookInventory($bookInventory)
    {
        $this->bookInventory = $bookInventory;
    }

    public function getBookImg()
    {
        return $this->bookImg;
    }
    public function setBookImg($bookImg)
    {
        $this->bookImg = $bookImg;
    }
    public function countBook()
    {
        return parent::countsql();
    }
    // 书籍信息查询(单本，多本)通过书号
    public function iShowInfo($bookId = "")
    {
        parent::field("*");
        // parent::limit("10");
        if ($bookId != "") {
            $this->bookId = $bookId;
            parent::where("bookId={$this->bookId}");
        }
        return parent::select();
    }
    // 书籍信息查询(单本，多本)通过书名 模糊搜索
    public function nShowInfo($bookName = "", $bookClassification = "", $num = "0")
    {
        parent::field("*");
        // parent::limit("10");
        $this->bookName = $bookName;
        $str = "bookName like '%{$this->bookName}%'";
        if ($bookClassification != "") {
            $this->bookClassification = $bookClassification;
            $str = $str . "and bookClassification = {$this->bookClassification}";
        }
        parent::where($str);
        if ($num != "0") {
            parent::limit($num);
        }
        return parent::select();
    }
    // 书籍库存查询
    public function showBookInventory()
    {
        parent::field("bookInventory");
        if (is_array($this->bookId)) {
            $str = " in (" . implode(",", $this->bookId) . ")";
        } else {
            $str = " = " . $this->bookId;
        }
        parent::where("bookId{$str}");
        $this->bookInventory = parent::find();
        // echo parent::_sql();
        return $this->bookInventory;
    }
    // 1:书籍写入,2:书籍修改
    public function msetBook($type)
    {
        $arr = array("bookName" => $this->bookName/*书名*/, "bookAuthor" => $this->bookAuthor/*作者*/, "bookPublishingTime" => $this->bookPublishingTime/*出版时间*/, "bookClassification" => $this->bookClassification/*分类id*/, "bookIntroduction" => $this->bookIntroduction /*书籍介绍*/, "bookInventory" => $this->bookInventory/*库存*/, "bookImg" => $this->bookImg/*库存*/);
        if ($type == 1) {
            return parent::add($arr);
        } else {
            return parent::update($arr);
        }
    }
}
