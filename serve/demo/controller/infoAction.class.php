<?php
	//直接取需要展示的信息
	include "../model/hotbookModel.class.php";
	class infoAction
	{
		// 书籍搜索
		public function showbook($bookName="",$bookClassification="",$num="",$type=2){
			$book = new BookModel();
			// print_r($book->iShowInfo($bookName));
            $arr1 = [];
			if($type == 1){
				$arr = $book->nShowInfo($bookName,$bookClassification,$num);
                $num = $book->countBook();
                foreach($arr as $bookinfo){
                    $bookinfo["bookClassification"] = $book->findClass($bookinfo["bookClassification"]);
                    array_push($arr1,$bookinfo);
                }
			}else if($type == 2){
				$arr = $book->iShowInfo($bookName);
                $num = $book->countBook();
                foreach($arr as $bookinfo){
                    $bookinfo["bookClassification"] = $book->findClass($bookinfo["bookClassification"]);
                    array_push($arr1,$bookinfo);
                }
			}
			return array("bookList" => $arr1,"con" =>$num);
		}
		// 书籍详情
		public function showbookinfo($bookid,$opNum){
			$book = new BookModel();
			$bookinfo = $book->iShowInfo($bookid);
            $bookinfo[0]["bookClassification"] = $book->findClass($bookinfo[0]["bookClassification"]);
			$evaluation = new EvaluationModel();
			$ecaluationinfo = $evaluation->getEvaluationCon($bookid,$opNum);
            $con = $evaluation->conEvaluationCon($bookid);
            if($ecaluationinfo != 0){
                for($i = 0 ; $i <count($ecaluationinfo); $i++){
                    $user = new UserModel();
                    $user->setUserId($ecaluationinfo[$i]["userId"]);
                    $username = $user->showUserType("userName")["userName"];
                    $ecaluationinfo[$i]["userName"] = $username;
                }
                $arr = array("bookinfo"=>$bookinfo[0],"evaluation"=>$ecaluationinfo,"con"=>$con);
                return $arr;    
            }
            $arr = array("bookinfo"=>$bookinfo[0],"evaluation"=>$ecaluationinfo,"con"=>0);
			return $arr;
		}
		// 获取排队信息
		public function paidui($userid){
			$reservation = new ReservationModel($userid);
            $con = $reservation->showReservation();
            $reservation->setUserId($userid);
            for($i=0;$i<count($con);$i++){
                $reservation->setBookId($con[$i]["bookId"]);
                $con[$i]["paidui"] = $reservation->findUserPD();
            }
            $book = new BookModel();
            for($i = 0 ; $i<count($con) ;$i++){
                $con[$i]["bookName"] = $book->iShowInfo($con[$i]["bookId"])[0]["bookName"];
                $con[$i]["bookImg"] = $book->iShowInfo($con[$i]["bookId"])[0]["bookImg"];
            }
            return $con;
		}
        // 获取用户发起的审核
        public function getUserMarking(){
            $user = new UserModel();
            return $user->showUserType("userMarking");
        }
        // 获取热门
        public function getHot(){
            $hot = new HotBoook();
            $bookIdArr =  $hot->fetInform();
            $arr = [];
            $book = new BookModel();
            foreach($bookIdArr as $i){
                array_push($arr,$book->iShowInfo($i["bookId"])[0]);
            }
            return $arr; 
            // $this->showbook($bookName="",$bookClassification="",$num="",$type=2);
        }
	}
