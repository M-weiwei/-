<?php
	include "damageModel.class.php";
	// 书评模型
	class EvaluationModel extends DamageModel{
		protected $evaluationId;
		protected $userId;
		protected $evaluation;
		protected $evaluationTime;
		protected $evaluationtype ; // 0未通过 1通过
		public function __construct($dbname = "evaluation"){
			// 初始化属性值
			parent::__construct($dbname);
		}
        public function getEvaluationId(){
        	return $this->evaluationId;
        }
        public function setevaluationId($evaluationId){
        	$this->evaluationId = $evaluationId;
        }
        public function getuserId(){
        	return $this->userId;
        }
        public function setuserId($userId){
        	$this->userId = $userId;
        }
        public function getEvaluation(){
        	return $this->evaluation;
        }
        public function setevaluation($evaluation){
        	$this->evaluation = $evaluation;
        }
        public function getEvaluationTime(){
        	return $this->evaluationTime;
        }
        public function setevaluationTime($evaluationTime){
        	$this->evaluationTime = $evaluationTime;
        }
        public function getevaluationtype (){
        	return $this->evaluationtype ;
        }
        public function setevaluationtype ($evaluationtype ){
        	$this->evaluationtype  = $evaluationtype ;
        }
		// 书评写入 
        public function setEvaluationCon(){
            return parent::add(array("bookId"=>$this->bookId,"userId"=>$this->userId,"Evaluatione"=>$this->evaluation,"evaluationTime"=>$this->evaluationTime,"evaluationtype "=>$this->evaluationtype ));
        }
		// 书评状态改变
		public function updateEvaluation(){
            parent::where("evaluationId=".$this->evaluationId);
            $arr = array("evaluationtype"=>$this->evaluationtype);
            parent::update($arr);
        }
		// 书评获取
		public function getEvaluationCon($bookId="",$opNum,$type=1){
            $this->evaluationtype  = $type;
            if($bookId!=""){
                $this->bookId = $bookId;
                if($this->conEvaluationCon($bookId) == 0){
                	return 0; 
                }
            }
            parent::where("bookId={$this->bookId} and evaluationtype ={$this->evaluationtype }");
            parent::field("userId,evaluation,evaluationTime,evaluationtype ");
            parent::limit($opNum.",10");
            parent::order("evaluationTime DESC");
            $flag = parent::select();
            // echo parent::_sql();
			return $flag;
		}
		// 书评统计
		public function conEvaluationCon($bookId=""){
			if($bookId != ""){
				$this->bookId = $bookId;
			}
			parent::where("bookId={$this->bookId} and evaluationtype ={$this->evaluationtype }");
			return parent::countsql();
		}
        // 获取书评列表
        public function mEvaluaList($page){
            parent::field("*");
            $con = parent::countsql();
            $opNum = 10*($page-1);
            parent::limit("{$opNum},10");
            return array("list"=>parent::select(),"con"=>$con);
        }
	}
