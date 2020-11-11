<?php
	include "bookModel.class.php";
	// 预约排队书籍模型
	class ReservationModel extends BookModel{
		// 属性
		protected $reservationId;
		protected $bookId;
		protected $userId;
		public function __construct($userId,$dbname="reservation"){
			// 初始化属性值
			$this->userId = $userId;
			parent::__construct($dbname);
		}
		// get/set方法
		public function getReservationId(){
			return $this->reservationId;
		}
		public function setReservationId($reservationId){
				$this->reservationId = $reservationId;
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
		// 查询当前用户预约排队书籍
		public function showReservation(){
			parent::field("bookId");
			parent::where("userId={$this->userId}");
			$bookarr = parent::select();
			return $bookarr;
		}
        // 通过书籍id查询当前排队最前方的用户id
        public function findPDR(){
            parent::field("userId");
            parent::where("bookId={$this->bookId}");
            $sel = parent::select();
            $userId = 0;
            if($sel != []){
                $flag = $sel[0]["reservationId"];
                foreach($sel as $i){
                    $val = $i["reservationId"];
                    if($val <= $flag){
                        $userId = $i["userId"];
                    }
                }
            }
            return $userId;
        }
		// 通过与书籍id查询当前排队人数
		public function findPD(){
			parent::where("userId={$this->userId} and bookId={$this->bookId}");
			return parent::countsql();
		}
		// 通过书籍id与用户id查询当前排队在用户前的人数
		public function findUserPD(){
			parent::where("userId={$this->userId} and bookId={$this->bookId}");
			parent::field("reservationId");
			$this->reservationId = parent::select()[0]["reservationId"];
			parent::where("bookId={$this->bookId} and reservationId < {$this->reservationId}");
			return parent::countsql();
		}
		// 写入订单
		public function setReservation($userId,$bookId){
			$this->userId = $userId;
			$this->bookId = $bookId;
			$arr = array("userId"=>$this->userId,"bookId"=>$this->bookId);
			parent::add($arr);
		}
	}
?>