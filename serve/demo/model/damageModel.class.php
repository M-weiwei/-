<?php
    include "../model/lesaseorderModel.class.php";
	// 损毁书籍模型
	class DamageModel extends LesaseorderModel{
		// 属性
		protected $damageId;
		protected $bookId;
		protected $userId;
		protected $damageReason;
		protected $damageTime;
		public function __construct($dbname = "damage"){
			// 初始化属性值
			parent::__construct($dbname);
		}
		// get/set方法
		public function getDamageId(){
			return $this->damageId;
		}
		public function setDamageId($damageId){
				$this->damageId = $damageId;
		}
		public function getBookId(){
			return $this->bookId;
		}
		public function setBookId($bookId){
				$this->bookId = $bookId;
		}
		public function getUserId(){
			return $this->userId;
		}
		public function setUserId($userId){
				$this->userId = $userId;
		}
		public function getDamageReason(){
			return $this->damageReason;
		}
		public function setDamageReason($damageReason){
				$this->damageReason = $damageReason;
		}
		public function getDamageTime(){
			return $this->damageTime;
		}
		public function setDamageTime($damageTime){
				$this->damageTime = $damageTime;
		}
		// 书籍损毁信息查询
        public function showDamage(){
            parent::field("*");
            if($damageId!=null){
                parent::where("damageId={$damageId}");
            }
            return parent::select();
        }
        // 书籍损毁录入
        public function setDamage(){
            $add = parent::add(array("userId" => $this->userId,"bookId" => $this->bookId,"damageReason" => $this->damageReason,"damageTime" => $this->damageTime));
            // echo parent::_sql();
            return $add;
        }
	}
?>