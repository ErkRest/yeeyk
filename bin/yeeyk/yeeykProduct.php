<?php
// edit by David 2017/11/6
// product dataobject object class
	class yeeykProduct{

		protected $productName = "";		// string 30	產品名稱
		protected $productType = "";		// string 30	產品類型
		protected $productDesc = "";		// string 30	產品敘述
		protected $extInfo = "";			// string 50	產品擴展訊息

		function __construct($name,$type,$desc,$info){
			$this->productName = $name;
			$this->productType = $type;
			$this->productDesc = $desc;
			$this->extInfo = $info;	
		}

		public function getProductName (){
			return $this->productName;
		}
		public function getProductType (){
			return $this->productType;
		}
		public function getProductDesc (){
			return $this->productDesc;
		}
		public function getExtInfo(){
			return $this->extInfo;
		}

		function setProduct($name,$type,$desc,$info){
			$this->productName = $name;
			$this->productType = $type;
			$this->productDesc = $desc;
			$this->extInfo = $info;	
		}
		function setArrProduct($arrayarr){

			if(!is_array ($array)) return ;

			foreach($array as $key => $value){
				switch ($variable) {
					case 'cardAmt':
						$this->productName = $value;
						break;
					case 'cardNo':
						$this->productType = $value;
						break;
					case 'cardPwd':
						$this->productDesc = $value;
						break;
					case 'cardCode':
						$this->extInfo = $value;
						break;						
					default:
						break;
				}
			}
		}
	}

?>