<?php

	class OrderQueryCallBack{

		protected $code = "";			//查詢狀態碼
		protected $data = null;			//json 			訂單訊息
		protected $bizType = "";		//string 20		服務類型
		protected $result = "";			//				支付結果

		protected $merchantNo = "";		//string 11		商戶編號
		protected $merchantOrderNo = "";//string 36		商戶訂單號
		protected $successAmount = "";	//string 20		成功金額
		protected $cardCode = "";		//string 10		支付方式

		protected $noticeType = "";		//default == 2	通知類型
		protected $extInfo = "";		//string 50		擴展信息
		protected $cardNo = "";			//string 300	卡序列號組
		protected $cardStatus = "";		//string 100	卡狀態組

		protected $cardReturnInfo = "";	//				卡處理訊數
		protected $cardIsbalance = "";	//				是否是餘額卡
		protected $cardBalance = "";	//				卡餘額
		protected $cardSuccessAmount = "";//			卡成功金額


		protected $hmac = "";				//string 32	簽名數據

		public function getCode(){
			return $this->code;
		}
		public function getData(){
			return $this->data;
		}
		public function getBizType(){
			return $this->bizType;
		}
		public function getResult(){
			return $this->result;
		}
		public function getMerchantNo(){
			return $this->merchantNo;
		}
		public function getMerchantOrderNo(){
			return $this->merchantOrderNo;
		}
		public function getSuccessAmount(){
			return $this->successAmount;
		}
		public function getCardCode(){
			return $this->cardCode;
		}
		public function getNoticeType(){
			return $this->noticeType;
		}
		public function getExtInfo(){
			return $this->extInfo;
		}

		public function getCardNo(){
			return $this->cardNo;
		}

		public function getCardStatus(){
			return $this->cardStatus;
		}

		public function getCardReturnInfo(){
			return $this->cardReturnInfo;
		}

		public function getCardIsbalance(){
			return $this->cardIsbalance;
		}

		public function getCardBalance(){
			return $this->cardBalance;
		}

		public function getCardSuccessAmount(){
			return $this->cardSuccessAmount;
		}
		public function getHmac(){
			return $this->hmac;
		}


		// construct
		function __construct($array) {
			if(!is_array ($array)) return ;
			foreach ($array as $key => $value) {
				switch ($key) {
					case 'code':
						$this->code=$value;
						break;
					case 'data':
						$this->data=$value;
						break;
					case 'bizType':
						$this->bizType=$value;
						break;
					case 'result':
						$this->result=$value;
						break;
					case 'merchantNo':
						$this->merchantNo=$value;
						break;
					case 'merchantOrderNo':
						$this->merchantOrderNo=$value;
						break;
					case 'successAmount':
						$this->successAmount=$value;
						break;															
					case 'cardCode':
						$this->cardCode=$value;
						break;
					case 'noticeType':
						$this->noticeType=$value;
						break;
					case 'extInfo':
						$this->extInfo=$value;
						break;
					case 'cardNo':
						$this->cardNo=$value;
						break;	
					case 'cardStatus':
						$this->cardStatus=$value;
						break;	
					case 'cardReturnInfo':
						$this->cardReturnInfo=$value;
						break;	
					case 'cardIsbalance':
						$this->cardIsbalance=$value;
						break;	
					case 'cardBalance':
						$this->cardBalance=$value;
						break;		
					case 'cardSuccessAmount':
						$this->cardSuccessAmount=$value;
						break;																					
					default:
						# code...
						break;
				}
			}
	   	}
	}


?>