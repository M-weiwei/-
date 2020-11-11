<?php
	//数据库类
	class DBModel{
		protected $sqlName="localhost";
		protected $sqluName="root";
		protected $sqlPassword="";
		protected $dbName='libaray';
		protected $conn=null;
		protected $charset='utf8';
		public function __construct(){
			$this->connect();
		}
		public function connect(){
			$this->conn = mysqli_connect($this->sqlName,$this->sqluName,$this->sqlPassword,$this->dbName);
			mysqli_set_charset($this->conn,"utf8");
		}
		public function query($sql){
			return mysqli_query($this->conn,$sql);
		}
		public function fExec($sql){
			mysqli_query($this->conn,$sql);
			return mysqli_affected_rows($this->conn);
		}
		public function row($que){
			return mysqli_fetch_array($que);
		}
		public function closeDB(){
			// print_r($this->conn);
			mysqli_close($this->conn);
		}
	}
?>