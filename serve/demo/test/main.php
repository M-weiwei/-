<?php
	class db extends cook{
		public $sqlname="localhost";
		public $sqluname="root";
		public $sqlpassword="";
		public $dbName='yigame';
		public $sql=null;
		public $conn=null;
		public $charset='utf8';
		public function __construct($sqlname,$sqluname,$sqlpassword,$dbName,$sql,$conn,$charset){
			$this->sqlname=$sqlname;
			$this->sqluname=$sqluname;
			$this->sqlpassword=$sqlpassword;
			$this->dbName=$dbName;
			$this->sql=$sql;
			$this->conn=$conn;
			$this->charset=$charset;
		}
		public function dbConn(){
			$this->conn=mysqli_connect($this->sqlname,$this->sqluname,$this->sqlpassword,$this->dbName);
			// mysqli_query($this->conn,'set character set '.$this->charset);
			mysqli_set_charset($this->conn,$this->charset);
			return $this->conn->connect_error;
		}
		public function dbClose(){
			mysqli_close($this->conn);
		}
		public function dbQuery(){
			$query = mysqli_query($this->conn,$this->sql);
			return $query;
		}
		public function row(){
			return $this->dbQuery() ? mysqli_fetch_assoc($this->dbQuery()) : 1;
		}
		//取出整租数据
		public function counts($key,$table){
			$this->dbConn();
			$this->sql = 'select count('.$key.') as counts from '.$table;
			return $this->row() != 1 ? $this->row()['counts'] : 1;
			$this->dbClose();
		}
		// 删
		public function del($table,$key,$value){
			$this->sql = 'DELETE FROM '.$table.' WHERE '.$key.'='.$value;
			$this->dbQuery();
		}
		// 改
		public function update($uid,$update){
			$this->dbConn();
			$update1 = urldecode($update);
			$this->sql = "UPDATE USER SET ".$update1." WHERE uid=".$uid;
			$this->dbQuery();
			$this->dbClose();
			// echo "<script>location.href='./self_info.php?uid=".$uid."';</script>";
		}
		// 增
		public function insetr
	}
	//cook类
	class cook{
		public $name='myUserName';
		public $cook=null;
		public $times=0;
		public function __construct($name,$cook,$times){
			$this->name = $name;
			$this->cook = $cook;
			$this->times = $times;
		}
		//添加cookie
		public function cookie(){
			setcookie($this->name,$this->cook,$this->times,'/');
			setcookie($this->name,$this->cook,$this->times,'/js');
			setcookie($this->name,$this->cook,$this->times,'/admin');
		}
		//获取cookie
		public function setcook(){
			if (isset($_COOKIE[$this->name])){
			    return 200;
			}else{
				return 203;
			}
		}
		//删除cookie
		public function delcook($cook){
			setcookie($name,$cook,time()-1);
		}
	}
	//用户类
	class user extends db{
		public $userName=null;
		public $userPassword=null;
		public $userEmail=null;
		public $userBirthday=null;
		public $userLove=null;
		public $userType=null;
		public function __construct($userName,$userPassword,$userEmail,$userBirthday,$userLove,$userType){
			$this->userName = $userName;
			$this->userPassword = $userPassword;
			$this->userEmail = $userEmail;
			$this->userBirthday = $userBirthday;
			$this->userLove = $userLove;
			$this->userType = $userType
		}
		//注册
		public function register(){
			parent::dbConn();
			// $this->sql = "INSERT INTO user(upw,email,developertype) VALUE('{$this->userPassword}','{$this->userEmail}',1)";
			parent::dbQuery();
			// $this->sql="SELECT uid FROM user WHERE email='".$this->userEmail."'";
			$num = parent::dbQuery();
			parent::dbClose();
			return $num;
		}
		//登陆
		public function login(){
			parent::dbConn();
			$this->sql = "SELECT upw,developertype FROM USER where uid='".$this->userName."'";
			if(parent::dbQuery()){
				$row = parent::row();
				if($row['upw']==$this->userPassword){
					if($this->userName == '1000'){
						$this->name = 'admin';
						$this->cook = 'admin';
						parent::cookie();
						parent::dbClose();
						return "admin";
					}elseif($row['developertype'] == 0){
						return 204;
					}else{
						$this->cook=$this->userName;
						parent::cookie();
						parent::dbClose();
						return 200;
					}
				}else{
					parent::dbClose();
					return 201;
				}
			}else{
				parent::dbClose();
				return 202;
			}
		}
		// 更改信息
		// 反馈问题
		// 申请主播
	}
	class admin extends game{
		public function __construct(){
			
		}
		// 查看所有用户
		public function adminShowAllUser(){
			parent::dbConn();
			$this->sql = "SELECT * FROM user";
			$userShowAll = parent::dbQuery();
			parent::dbClose();
			return $userShowAll;
		}
		// 查看单个用户
		public function adminShowUser($userid){
			parent::dbConn();
			$this->sql = "SELECT * FROM user where userid = ".$userid;
			$usershow = parent::dbQuery();
			parent::dbClose();
			return $usershow;
		}
		// 冻结/解封 用户
		// 查看用户反馈
		// 修改用户反馈状态
		// 普通用户升级主播
		// 查看用户申请
	}
?>