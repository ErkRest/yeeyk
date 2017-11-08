<?php
// edit by David 2017/11/6
// config set dataobject object class
	class yeeykConfigLoader{

		public $skey = "";
		public $merchantNo = "";
		public $callBackUrl = "";
		public $bizType = "";
		public $alog = "";
		public $orderUrl = ""; // order send address 
		public $queryUrl = "";//	orderQuery send address
		public $UserAgent = "";

		private $myfile = null ;

		public function getSkey(){
			return $this->skey;
		}
		public function getMerchantNo(){
			return $this->merchantNo;
		}
		public function getCallBackUrl(){
			return $this->callBackUrl;
		}

		public function getBizType(){
			return $this->bizType;
		}
		public function getAlog(){
			return $this->alog;
		}
		public function getOrderUrl(){
			return $this->orderUrl;
		}
		public function getQueryUrl(){
			return $this->queryUrl;
		}
		public function getUserAgent(){
			return $this->UserAgent;
		}

		function __construct(){
			
			try{

				$dirname = dirname(__FILE__);

				$str = "";

				$myfile = fopen($dirname."/../../config.txt", "r") or die("Unable to open Config.txt!");

				while(!feof($myfile)) {
			  		$str= $str.fgets($myfile);
				}

				fclose($myfile);

				$obj = json_decode($str);

				$this->skey = $obj->SKEY;

				$this->merchantNo = $obj->MerchantNo;

				$this->callBackUrl = $obj->CallBackUrl;

				$this->bizType = $obj->bizType;

				$this->alog = $obj->alog;

				$this->orderUrl = $obj->orderUrl; // order send address 

				$this->queryUrl = $obj->queryUrl;//	orderQuery send address

				$this->UserAgent = $obj->UserAgent;

			}
			catch(Exception $e){

				echo $e;

				try{fclose($myfile);}catch(Exception $e){}
			}
		}
	}
?>