<?php
	// 2017/11/1 edit by David
	// note 
	// 1. oreder parameter must not null # page 5
	// 2. value is order by hmacCode rule
	// 3. NonSynchronizationCallback must call return success 
	// 4. chinese must use charset = GB2312/GBK
	// 5. ask must have UserAgent
	
	try
	{
		$dirname = dirname(__FILE__);

		if(!is_dir($dirname ."/order"))
			throw new Exception("include bin Order dir is not exist", 1);
				
		if(!is_file($dirname ."/order/Order.php"))
			throw new Exception("include bin Order/Order.php file is not exist", 1);
			
		if(!is_file($dirname ."/order/OrderQuery.php"))
			throw new Exception("include bin Order/OrderQuery.php file is not exist", 1);

		if(!is_file($dirname ."/order/OrderQueryCallBack.php"))
			throw new Exception("include bin Order/OrderQueryCallBack.php file is not exist", 1);

		if(!is_file($dirname ."/order/OrderSynchronizationCallback.php"))
			throw new Exception("include bin Order/OrderSynchronizationCallback.php file is not exist", 1);

		if(!is_file($dirname ."/order/OrderNonSynchronizationCallback.php"))
			throw new Exception("include bin Order/OrderNonSynchronizationCallback.php file is not exist", 1);

		if (!is_dir($dirname ."/yeeyk")) 
			throw new Exception("include bin yeeyk dir is not exist", 1);

		if(!is_file($dirname ."/yeeyk/yeeyk.php"))
			throw new Exception("include bin yeeyk/yeeyk.php file is not exist", 1);

		if(!is_file($dirname ."/yeeyk/yeeykCard.php"))
			throw new Exception("include bin yeeyk/yeeykCard.php file is not exist", 1);

		if(!is_file($dirname ."/yeeyk/yeeykProduct.php"))
			throw new Exception("include bin yeeyk/yeeykProduct.php file is not exist", 1);

		if(!is_file($dirname ."/yeeyk/yeeykConfigLoader.php"))
			throw new Exception("include bin yeeyk/yeeykConfigLoader.php file is not exist", 1);

		require $dirname ."/order/Order.php";
		require $dirname ."/order/OrderQuery.php";
		require $dirname ."/order/OrderQueryCallBack.php";
		require $dirname ."/order/OrderSynchronizationCallback.php";
		require $dirname ."/order/OrderNonSynchronizationCallback.php";
		require $dirname ."/yeeyk/yeeyk.php";
		require $dirname ."/yeeyk/yeeykCard.php";
		require $dirname ."/yeeyk/yeeykProduct.php";
		require $dirname ."/yeeyk/yeeykConfigLoader.php";

	}
	catch(Exception $e)
	{
		echo $e;
		exit();
	}

	function order($merchantOrderNo,$requestAmount,$card,$product)
	// order() 下定訂單 回傳 OrderSynchronizationCallback 型態資料物件
	// merchantOrderNo 商戶訂單編號 string 36 
	// requestAmount 訂單金額 string 10
	// Card 卡片資訊 yeeykCard 型態資料物件
	// Product 商品資訊 yeeykProduct 型態資料物件
	{

		$yeeyk = null ;
		$skey = "";
		$merchantNo = "";
		$url =  "";
		$bizTypeCode = "";
		$alog = "";
		
		$bizType = array(
			'0' 		=> "PROFESSION",	//	非銀行專業版支付
			'1' 		=> "SDK",			//	非銀行SDK版支付
			'2' 		=> "STANDARD",		//	非銀行卡標準版支付
		); 
		
		try{

			$config = new yeeykConfigLoader();
			$skey = $config->getSkey();
			$merchantNo = $config->getMerchantNo();
			$url = $_SERVER['SERVER_ADDR'].$config->getCallBackUrl();
			$alog = $config->getAlog();
			$bizTypeCode = $config->getBizType();
			
			// 2017/11/3 edit by david
			$arr = array(
				'skey' => $skey, 
				'alog' => $alog, 
				'bizType' => $bizType[$bizTypeCode], 
				'merchantNo' => $merchantNo, 
				'merchantOrderNo' => $merchantOrderNo, //商品 GUID 需唯一值 
				'requestAmount' => $requestAmount, // 價格 精確到分
				'url' => $url, 
				'cardAmt' => $card->getCardAmt(), 
				'cardNo' => $card->getCardNo(), 
				'cardPwd' => $card->getCardPwd(), 
				'cardCode' => $card->getCardCode(), 
				'productName' => $product->getProductName(), 
				'productType' => $product->getProductType(), 
				'productDesc' => $product->getProductDesc(), 
				'extInfo' => $product->getExtInfo()
			);

			$yeeyk = new yeeyk();

			$result = $yeeyk->createOrder($arr);

		}
		catch(Exception $e){
			echo $e;
			return null;
		}

		return $result;
	}

	function queryOrder($merchantOrderNo)	
	// queryOrder()	查詢商品相關資訊 回傳 OrderQueryCallBack 型態資料物件
	// merchantOrderNo 查詢的商品單號 string
	{

		$yeeyk = null ;
		$skey = "";
		$merchantNo = "" ;
		$alog = "";

		try{

			$config = new yeeykConfigLoader();
			$skey = $config->getSkey();
			$merchantNo = $config->getMerchantNo();
			$alog = $config->getAlog();

			// 2017/11/3 edit by david
			$arr = array(
				'skey' => $skey, 
				'alog' => $alog, 
				'merchantNo' => $merchantNo, 
				'merchantOrderNo' => $merchantOrderNo //商品 GUID 需唯一值 
				
			);

			$yeeyk = new yeeyk();

			$result = $yeeyk->searchOrder($arr);

		}
		catch(Exception $e){
			return null;
		}

		return $result;
	}
?>