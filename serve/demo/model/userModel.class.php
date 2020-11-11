<?php
	include "model.php";
	// 用户模型
	class UserModel extends Model{
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
		public function __construct($dbname="user"){
			parent::__construct($dbname);
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
		public function setUserType($userType){
			$this->userType = $userType;
		}
		// 根据用户名密码查询用户是否存在
		public function getUser(){
			// 查询相关字段
			parent::field("*");
			// 添加条件
			parent::where("userName='".$this->userName."'");
			$thisuser = parent::find();
			if($thisuser != []){
				if($this->userPassword == $thisuser['userPassword'] and $thisuser['userType'] == 0){
					// 用户密码正确返回200
					$this->userId = parent::find()['userId'];
					return array("type"=>200,'userId'=>$this->showUser()[0]['userId'],'userName'=>$this->showUser()[0]['userName'],"userEmail"=>$this->showUser()[0]['userEmail'],"userMarking"=>$this->showUser()[0]['userMarking']);
				}else{
					// 用户密码错误返回201
					return array("type"=>201);
				}
			}else{
				// 无此用户返回202
				return array("type"=>202);
			}
			
		}
		// 显示用户所有信息(单个用户、所有用户)
		public function showUser($page = ""){
			parent::field("*");
            if ($page != ""){
                $con = parent::countsql();
                $opNum = 10*($page-1);
                parent::limit("{$opNum},10");
                $list = parent::select();
                return array("list"=>$list,"con"=>$con);
            }else if($this->userId != null){
                parent::where("userId={$this->userId}");
            }
			return parent::select();
		}
		// 写入用户
		public function setUser(){
			$arr = array("userName" => $this->userName,"userPassword" =>$this->userPassword,"userEmail" => $this->userEmail,"userMarking" => 0,"userStuld" => 0,"userType" => 0);
			return parent::add($arr);
		}
		// 查询用户 单个字段（使用状态/认证状态/用户名）
		public function showUserType($key){
			parent::field($key);
            parent::where("userId = {$this->userId}");
			return parent::find();
		} 
        // 改变用户状态
        public function upUserType(){
            $arr = array("userType" => $this->userType);
            parent::where("userId={$this->userId}");
            return parent::update($arr);
        }
        // 发起审核
        public function mSetUserStu(){
            $arr = array("userMarking" => 1,"userStuld" => $this->userStuld);
            parent::where("userId={$this->userId}");
            return parent::update($arr);
        }
        // 改变用户审核状态
        public function updateUserStu(){
            $arr = array("userMarking" => $this->userMarking);
            parent::where("userId={$this->userId}");
            return parent::update($arr);
        }
        // 认证中用户列表
        public function mUserList($page){
            parent::field("*");
            parent::where("userMarking = 1");
            $con = parent::countsql();
            $opNum = 10*($page-1);
            parent::limit("{$opNum},10");
            $list = parent::select();
            // echo parent::_sql();
            return array("list"=>$list,"con"=>$con);
        }
        // 修改用户信息
        public function upUser(){
            $arr = array("userName" => $this->userName,"userPassword" => $this->userPassword,"userEmail" => $this->userEmail);
            parent::where("userId={$this->userId}");
            return parent::update($arr);
        }
	}
?>