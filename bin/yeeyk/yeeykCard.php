<?php

	class yeeykCard{
		protected $cardAmt = "";// string 100	卡面額組
		protected $cardNo = "";// string 300	卡號組
		protected $cardPwd = "";// string 300	卡密組
		protected $cardCode = "";// string 10	支付渠道編碼

		function __construct($amt,$no,$pwd,$code){
			$this->cardAmt = $amt;
			$this->cardNo = $no;
			$this->cardPwd = $pwd;
			$this->cardCode = $code;
		}

		public function getCardAmt(){
			return $this->cardAmt;
		}
		public function getCardNo(){
			return $this->cardNo;
		}
		public function getCardPwd(){
			return $this->cardPwd;
		}
		public function getCardCode(){
			return $this->cardCode;
		}


		function setCard($amt,$no,$pwd,$code){
			$this->cardAmt = $amt;
			$this->cardNo = $no;
			$this->cardPwd = $pwd;
			$this->cardCode = $code;	
		}
		function setArrCard($array){

			if(!is_array ($array)) return ;

			foreach($array as $key => $value){
				switch ($variable) {
					case 'cardAmt':
						$this->cardAmt = $value;
						break;
					case 'cardNo':
						$this->cardNo = $value;
						break;
					case 'cardPwd':
						$this->cardPwd = $value;
						break;
					case 'cardCode':
						$this->cardCode = $value;
						break;						
					default:
						break;
				}
			}
		}
	}

?>