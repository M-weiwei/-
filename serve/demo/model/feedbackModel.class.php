<?php
    include "../model/evaluationModel.class.php";
	// 问题反馈模型
	class FeedbackModel extends EvaluationModel{
		// 属性
		protected $feedbackId;
		protected $userId;
		protected $feedbackReason;
		protected $feedbackTime;
		protected $feedbackType;
		protected $feedbackReply;
		public function __construct($dbname = "feedback"){
			// 初始化属性值
			parent::__construct($dbname);
		}
		// get/set方法
		public function getFeedbackId(){
			return $this->feedbackId;
		}
		public function setFeedbackId($feedbackId){
				$this->feedbackId = $feedbackId;
		}
		public function getUserId(){
			return $this->userId;
		}
		public function setUserId($userId){
				$this->userId = $userId;
		}
		public function getFeedbackReason(){
			return $this->feedbackReason;
		}
		public function setFeedbackReason($feedbackReason){
				$this->feedbackReason = $feedbackReason;
		}
		public function getFeedbackTime(){
			return $this->feedbackTime;
		}
		public function setFeedbackTime($feedbackTime){
				$this->feedbackTime = $feedbackTime;
		}
		public function getFeedbackType(){
			return $this->feedbackType;
		}
		public function setFeedbackType($feedbackType){
				$this->feedbackType = $feedbackType;
		}
		public function getFeedbackReply(){
			return $this->feedbackReply;
		}
		public function setFeedbackReply($feedbackReply){
				$this->feedbackReply = $feedbackReply;
		}
        // 写入反馈
        public function setFeedback(){
            return parent::add(array("userId" => $this->userId,"feedbackReason" => $this->feedbackReason,"feedbackTime" => $this->feedbackTime));
        }
        // 获取反馈
        public function getFeedback($val = "",$key = "feedbackId"){
            parent::field("*");
            if($id != 0){
                parent::where("{$key} = {$val}");
            }
            return parent::select();
        }
        // 修改
        public function upFeedback($id,$key,$val){
            parent::where("feedbackId = {$id}");
            for($i = 0 ; $i < count($key) ; $i++){
                $arr[$key[$i]] = $val[$i];
            }
            parent::update($arr);
        }
	}
?>