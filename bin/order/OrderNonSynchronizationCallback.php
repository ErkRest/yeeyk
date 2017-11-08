<?php
	class OrderNonSynchronizationCallback{

		protected $bizType = "";			//string 20		服務類型
		protected $result = "";				//支付結果
		protected $merchantNo = "" ;		//string 11		商戶編號
		protected $merchantOrderNo = "";	//string 36 	商戶訂單編號
		
		protected $successAmount = "";		//string 20		成功金額
		protected $cardCode = "";			//string 10		支付方式
		protected $noticeType = "";			//default 2 	通知類型
		protected $extInfo = "";			//string 50 	擴展訊息

		protected $cardNo = "";				//string 300 	卡序列號組
		protected $cardStatus = "";			//string 100 	卡狀態組
		protected $cardReturnInfo = "";		//卡處理敘述
		protected $cardIsbalance = "";		//是否是餘額卡

		protected $cardBalance = "";		//卡餘額
		protected $cardSuccessAmount = "";	//卡成功金額
		protected $hmac = "";				//string 32		簽名數據

		// construct
		function __construct($str) {
			$arr = json_decode($str);
			foreach ($arr as $key => $value) {
				switch ($key) {
					case 'bizType':
						$this->bizType = $value ;
						break;
					case 'result':
						$this->result = $value ;
						break;
					case 'merchantNo':
						$this->merchantNo = $value ;
						break;
					case 'merchantOrderNo':
						$this->merchantOrderNo = $value ;
						break;
					case 'successAmount':
						$this->successAmount = $value ;
						break;
					case 'cardCode':
						$this->cardCode = $value ;
						break;
					case 'noticeType':
						$this->noticeType = $value ;
						break;
					case 'extInfo':
						$this->extInfo = $value ;
						break;
					case 'cardNo':
						$this->cardNo = $value ;
						break;
					case 'cardStatus':
						$this->cardStatus = $value ;
						break;
					case 'cardReturnInfo':
						$this->cardReturnInfo = $value ;
						break;
					case 'cardIsbalance':
						$this->cardIsbalance = $value ;
						break;
					case 'cardBalance':
						$this->cardBalance = $value ;
						break;
					case 'cardSuccessAmount':
						$this->cardSuccessAmount = $value;
						break;
					case 'hmac':
						$this->hmac = $value;
						break;
					default:
						
						break;
				}
			}
	   	}
	}
?>