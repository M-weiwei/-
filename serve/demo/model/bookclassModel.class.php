<?php
	include "userModel.class.php";
    class BookclassModel extends UserModel{
        protected $bookclassId;
        protected $bookclassName;
		public function __construct($dbname = "bookclass"){
			// 初始化属性值
			parent::__construct($dbname);
		}
        public function showBookClass($type = 0){
            parent::__construct("bookclass");
            parent::field("bookclassName");
            $arr0 = parent::select();
            if($type == 0){
                $arr1 = [];
                foreach($arr0 as $i){
                    array_push($arr1,$i['bookClassName']);
                }
            }else{
                $arr1 = $arr0;
            }
            return $arr1;
        }
        // 通过书号查询书籍分类
        public function findClass($bookclassId){
            parent::__construct("bookclass");
            $this->bookclassId = $bookclassId;
            parent::field("bookclassName");
            parent::where("bookclassId in ({$this->bookclassId})");
            $arr0 = parent::select();
            $arr1 = [];
            foreach($arr0 as $i){
                array_push($arr1,$i['bookClassName']);
            }
            return $arr1;
        }

    }
?>