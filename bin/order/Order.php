<?php
	class Order {
		// control value
		private $alog = "md5";
		private $skey = "";

		protected $bizType = ""; 			// string 20	服務類型
		protected $merchantNo = "";			// string 11	商戶編號
		protected $merchantOrderNo = "";	// string 36	商戶編號訂單
		protected $requestAmount = "";		// string 10	訂單金額
		protected $url = "";				// string 100	商戶接收支付成功數據的地址(回調地址)

		protected $cardAmt = "";			// string 100	卡面額組
		protected $cardNo = "";				// string 300	卡號組
		protected $cardPwd = "";			// string 300	卡密組

		protected $cardCode = "";			// string 10	支付渠道編碼

		protected $productName = "";		// string 30	產品名稱
		protected $productType = "";		// string 30	產品類型
		protected $productDesc = "";		// string 30	產品敘述
		protected $extInfo ="";				// string 50	產品擴展訊息
		protected $hmac ="";				// string 32	簽名數據

		function __construct($arrayName){
	   		foreach ($arrayName as $key=>$value) {
	   			
	   			if (is_null($value)) {
	   				throw new Exception("parameter array's value must not null value", 1);
	   			}
			    switch ($key) {
			    	case 'skey':
			    		$this->skey = $value;
			    		break;
					case 'alog':
			    		$this->alog = $value;
			    		break;
			    	case 'bizType':
			    		$this->bizType = $value;
			    		break;
			    	case 'merchantNo':
			    		$this->merchantNo = $value;
			    		break;
			    	case 'merchantOrderNo':
			    		$this->merchantOrderNo = $value;
			    		break;
			    	case 'requestAmount':
			    		$this->requestAmount = $value;
			    		break;
			    	case 'url':
			    		$this->url = $value;
			    		break;
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
			    	case 'productName':
			    		$this->productName = $value;
			    		break;
			    	case 'productType':
			    		$this->productType = $value;
			    		break;
			    	case 'productDesc':
			    		$this->productDesc = $value;
			    		break;
			    	case 'extInfo':
			    		$this->extInfo = $value;
			    		break;
			    	default:
			    		break;
			    }
			}

			$str = 
	   			$this->bizType.
	   			$this->merchantNo.
	   			$this->merchantOrderNo.
	   			$this->requestAmount.
	   			$this->url.
	   			$this->cardAmt.
	   			$this->cardNo.
	   			$this->cardPwd.
	   			$this->cardCode.
	   			$this->productName.
	   			$this->productType.
	   			$this->productDesc.
	   			$this->extInfo
	   			;

	   		$this->hmac = hash_hmac ( 'md5', $str , $this->skey);
	   	}

	   	//取得 CURL POST所需 資料字串
	   	public function getPostSteam(){
	   		$data = array( 
	   				"bizType"=> $this->bizType, 
	   				"merchantNo"=> $this->merchantNo,
	   				"merchantOrderNo"=> $this->merchantOrderNo,
	   				"url"=> $this->url,

	   				"cardAmt"=> $this->cardAmt,
	   				"cardNo"=> $this->cardNo,
	   				"cardPwd"=> $this->cardPwd,
	   				"cardCode"=> $this->cardCode,

	   				"productName"=> $this->productName,
	   				"productType"=> $this->productType,
	   				"productDesc"=> $this->productDesc,
	   				"extInfo"=> $this->extInfo,

	   				"hmac"=> $this->hmac,
	   			);
			return http_build_query($data);
	   	}

	   	public function getHmac(){
	   		return $this->hmac;
	   	}
	}
?>