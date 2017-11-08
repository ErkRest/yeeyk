<?php
	// 2017/11/6 edit by David
	// note 
	// 1. oreder parameter must not null # page 5
	// 2. value is order by hmacCode rule
	// 3. NonSynchronizationCallback must call return success 
	// 4. chinese must use charset = GB2312/GBK
	// 5. ask must have UserAgent

	// 處理api對話類別
	// 儲存資料傳遞url
	// UserAgent
	class yeeyk{

		protected $orderUrl = ""; // order send address 
		protected $queryUrl = "";//	orderQuery send address
		protected $UserAgent = "";

		//protected $alog = "md5";// hash hmac 

		function __construct(){
			$config = new yeeykConfigLoader();
			$this->orderUrl = $config->getOrderUrl();
			$this->queryUrl = $config->getQueryUrl();
			$this->UserAgent = $config->getUserAgent();
		}

		public function setOrderUrl($url){
			$this->orderUrl=$value;
		}

		public function setQueryUrl($url){
			$this->queryUrl=$value;
		}

		public function setUserAgent($Agent){
			$this->UserAgent=$value;
		}

		public function createOrder($array){

			$obj = null;
			$curl = null;
			$orderResult = null;

	   		try{
	   			
	   			//$array['alog']=$this->alog;
	   			$curl = curl_init();
	   			$obj = new order($array);
	   			
	   			curl_setopt($curl,CURLOPT_URL, $this->orderUrl);
	   			curl_setopt($curl,CURLOPT_POST,true);
	   			curl_setopt($curl,CURLOPT_USERAGENT,$this->UserAgent); // useragent
	   			curl_setopt($curl,CURLOPT_POSTFIELDS,$obj->getPostSteam());
	   			$result = curl_exec($curl);
	   			curl_close($curl);

	   			$orderResult = new OrderSynchronizationCallback($result);

	   			if(is_null($orderResult)){
	   				throw new Exception("createOrder Curl fail.", 1);	   	
	   			}
	   		}
	   		catch(Exception $e){
	   			echo $e;
	   			try{
	   				curl_close($curl);
	   			}
	   			catch(Exception $e){}

	   			return null;
	   		}
	   		return $orderResult;
		}

	   	public function searchOrder($array){
	   		$obj = null;
			$curl = null;
			$orderResult = null;
	   		try{

	   			//$array['alog']=$this->alog;
	   			$curl = curl_init();
	   			$obj = new OrderQuery($array);
	   			
	   			curl_setopt($curl,CURLOPT_URL, $this->queryUrl);
	   			curl_setopt($curl,CURLOPT_POST,true);
	   			curl_setopt($curl,CURLOPT_USERAGENT,$this->UserAgent); // useragent
	   			curl_setopt($curl,CURLOPT_POSTFIELDS,$obj->getPostSteam());
	   			$result = curl_exec($curl);
	   			curl_close($curl);

	   			$orderResult = new OrderQueryCallBack($result);

	   			if(is_null($orderResult)){
	   				throw new Exception("searchOrder Curl fail.", 1);	 
	   			}
	   		}
	   		catch(Exception $e){   			
	   			try{
	   				curl_close($curl);
	   			}
	   			catch(Exception $e){}
	   			return null;
	   		}
	   		return $orderResult;
		}
	}


?>