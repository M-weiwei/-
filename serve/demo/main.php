<?php
	// 用户模型类
	class UserModel{
		// 属性
		protected $userId;
		protected $userName;
		protected $userPassword;
		protected $userEmail;
		protected $userMarking;
		protected $userStuld;
		protected $userType;

		// 方法
		// 构造方法
		public function __construct(){
			// 初始化属性值
		}
		// get/set方法
		public function getUserId(){
			return $this->userId;
		}
		public function setUserId($userId){
			$this->userId = $userId;
		}
		
		public function getUserName(){
			return $this->userName;
		}
		public function setUserName($userName){
			$this->userName = $userName;
		}
		public function getUserPassword(){
			return $this->userPassword;
		}
		public function setUserPassword($userPassword){
			$this->userPassword = $userPassword;
		}
		public function getUserEmail(){
			return $this->userEmail;
		}
		public function setUserEmail($userEmail){
			$this->userEmail = $userEmail;
		}
		public function getUserMarking(){
			return $this->userMarking;
		}
		public function setUserMarking($userMarking){
			$this->userMarking = $userMarking;
		}
		public function getUserStuld(){
			return $this->userStuld;
		}
		public function setUserStuld($userStuld){
			$this->userStuld = $userStuld;
		}
		public function getUserType(){
			return $this->userType;
		}
		public function setUserType($userType){D
			$this->userType = $userType;
		}
		// 查询用户是否存在
		// 显示用户所有信息(单个用户、所有用户)
		// 查询用户状态
		// 查询用户租借的书籍
	}
	// 用户类控制器
	class UserAction{
		// 登录
		// 注册
		// 预约借书
		// 发表书评
		// 问题反馈
		// 发起学生认证
		// 修改个人信息
	}
	// 管理员控制器类
	class AdminAction{
		// 书籍录入
		// 书籍报损
		// 书评审核
		// 审核学生认证
		// 用户账号封禁
		// 催促还书
	}
	// 书籍类
	class BookModel{
		// 属性
		protected $bookId;				// 书籍id
		protected $bookName;				// 书籍名
		protected $bookAuthor;			// 书籍作者
		protected $bookPublishingTime;	// 书籍出版时间
		protected $bookClassification;	// 书籍分类标签
		protected $bookIntroduction;		// 书籍介绍
		protected $bookInventory;			// 书籍库存
		// 方法
		// 构造方法
		public function __construct(){
			// 初始化属性值
		}
		// get/set方法
		public function getBookId(){
			return $this->bookId;
		}
		public function setBookId($bookId){
			$this->bookId = $bookId;
		}
		public function getBookName(){
			return $this->bookName;
		}
		public function setBookName($bookName){
			$this->bookName = $bookName;
		}
		public function getBookAuthor(){
			return $this->bookAuthor;
		}
		public function setBookAuthor($bookAuthor){
			$this->bookAuthor = $bookAuthor;
		}
		public function getBookPublishingTime(){
			return $this->bookPublishingTime;
		}
		public function setBookPublishingTime($bookPublishingTime){
			$this->bookPublishingTime = $bookPublishingTime;
		}
		public function getBookClassification(){
			return $this->bookClassification;
		}
		public function setBookClassification($bookClassification){
			$this->bookClassification = $bookClassification;
		}
		public function getBookIntroduction(){
			return $this->bookIntroduction;
		}
		public function setBookIntroduction($bookIntroduction){
			$this->bookIntroduction = $bookIntroduction;
		}
		public function getBookInventory(){
			return $this->bookInventory;
		}
		public function setBookType($bookInventory){
			$this->bookInventory = $bookInventory;
		}
		// 书籍信息查询(单本，多本)
		// 书籍库存查询
	}
	// 书籍租出模型表
	class LesaseorderModel{
		// 属性
		protected $lesaseorderId;
		protected $userId;
		protected $lesaseorderRantalTime;
		protected $lesaseorderReturnTime;
		protected $lesaseorderCurrentType;

		public function __construct(){
			// 初始化属性值
		}
		// get/set
		public function getLesaseorderId(){
			return $this->lesaseorderId;
		}
		public function setLesaseorderId($lesaseorderId){
			$this->lesaseorderId = $lesaseorderId;
		}
		public function getLesaseorderRantalTime(){
			return $this->lesaseorderRantalTime;
		}
		public function setLesaseorderRantalTime($lesaseorderRantalTime){
			$this->lesaseorderRantalTime = $lesaseorderRantalTime;
		}
		public function getLesaseorderReturnTime(){
			return $this->lesaseorderReturnTime;
		}
		public function setLesaseorderReturnTime($lesaseorderReturnTime){
			$this->lesaseorderReturnTime = $lesaseorderReturnTime;
		}
		public function getLesaseorderCurrentType(){
			return $this->lesaseorderCurrentType;
		}
		public function setLesaseorderCurrentType($lesaseorderCurrentType){
			$this->lesaseorderCurrentType = $lesaseorderCurrentType;
		}
		// 书籍当前租出信息查询
	}
	// 书评表
	class EvaluationModel{
		// 属性
		protected $evaluationId;
		protected $evaluation;
		protected $evaluationTime;
		protected $evaluationType;
		
		public function __construct(){
			// 初始化属性值
		}
		// get/set方法
		public function getEvaluationId(){
			return $this->evaluationId;
		}
		public function setEvaluationId($evaluationId){
				$this->evaluationId = $evaluationId;
		}
		public function getEvaluation(){
			return $this->evaluation;
		}
		public function setEvaluation($evaluation){
				$this->evaluation = $evaluation;
		}
		public function getEvaluationTime(){
			return $this->evaluationTime;
		}
		public function setEvaluationTime($evaluationTime){
				$this->evaluationTime = $evaluationTime;
		}
		public function getEvaluationType(){
			return $this->evaluationType;
		}
		public function setEvaluationType($evaluationType){
				$this->evaluationType = $evaluationType;
		}
		// 书籍评论查询
	}
	// 预约书籍排队表
	class ReservationModel{
		// 属性
		protected $reservationId;
		protected $bookId;
		protected $userId;
		public function __construct(){
			// 初始化属性值
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
	}
	// 报损书籍录入表
	class DamageModel{
		// 属性
		protected $damageId;
		protected $bookId;
		protected $userId;
		protected $damageReason;
		protected $damageTime;
		public function __construct(){
			// 初始化属性值
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
	}
	// 问题反馈表
	class FeedbackModel{
		// 属性
		protected $feedbackId;
		protected $userId;
		protected $feedbackReason;
		protected $feedbackTime;
		protected $feedbackType;
		protected $feedbackReply;
		public function __construct(){
			// 初始化属性值
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
	}
?>