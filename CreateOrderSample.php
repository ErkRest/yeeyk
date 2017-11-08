<?php
	
	$userCard = null ; 		// (yeeykCard) obj CARD DATA BOJECT
	$userOrder = null ; 	// (yeeykProduct) obj PRODUCT DATA OBJECT
	$oscb = null ;			// (OrderSynchronizationCallback) obj JSON RETURN TO DATA OBJECT


	$merchantOrderNo = "";
	$requestAmount = "";

	$cardAmt = "";
	$cardNo = "";
	$cardPwd = "";
	$cardCode = "";

	$productName = "";
	$productType = "";
	$productDesc = "";
	$extInfo = "";

	try{

		$binDir = dirname(__FILE__)."/bin/PublicFunc.php"; // include public function file

		if(!is_file($binDir))	// check dir
			throw new Exception("include bin ".$binDir." file is not exist", 1);

		require $binDir;
		
		
		if(isset($_GET['merchantOrderNo'])){ //使用 GET 傳遞

			//if (!isset($_GET['merchantOrderNo'])) {
			//	throw new Exception("get merchantOrderNo not exit", 1);
			//}
			if (!isset($_GET['requestAmount'])) {
				throw new Exception("get requestAmount not exit", 1);
			}
			if (!isset($_GET['cardAmt'])) {
				throw new Exception("get cardAmt not exit", 1);
			}
			if (!isset($_GET['cardNo'])) {
				throw new Exception("get cardNo not exit", 1);
			}
			if (!isset($_GET['cardPwd'])) {
				throw new Exception("get cardPwd not exit", 1);
			}
			if (!isset($_GET['cardCode'])) {
				throw new Exception("get cardCode not exit", 1);
			}
			if (!isset($_GET['productName'])) {
				throw new Exception("get productName not exit", 1);
			}
			if (!isset($_GET['productType'])) {
				throw new Exception("get productType not exit", 1);
			}
			if (!isset($_GET['productDesc'])) {
				throw new Exception("get productDesc not exit", 1);
			}
			if (!isset($_GET['extInfo'])) {
				throw new Exception("get extInfo not exit", 1);
			}

			$merchantOrderNo = $_GET['merchantOrderNo'];

			$requestAmount = $_GET['requestAmount'];

			$cardAmt = $_GET['cardAmt'];

			$cardNo = $_GET['cardNo'];

			$cardPwd = $_GET['cardPwd'];

			$cardCode = $_GET['cardCode'];

			$productName = $_GET['productName'];

			$productType = $_GET['productType'];

			$productDesc = $_GET['productDesc'];

			$extInfo = $_GET['extInfo'];

		}
		else{	//使用 POST 傳遞

			if (!isset($_POST['merchantOrderNo'])) {
				throw new Exception("post merchantOrderNo not exit", 1);
			}
			if (!isset($_POST['requestAmount'])) {
				throw new Exception("post requestAmount not exit", 1);
			}
			if (!isset($_POST['cardAmt'])) {
				throw new Exception("post cardAmt not exit", 1);
			}
			if (!isset($_POST['cardNo'])) {
				throw new Exception("post cardNo not exit", 1);
			}
			if (!isset($_POST['cardPwd'])) {
				throw new Exception("post cardPwd not exit", 1);
			}
			if (!isset($_POST['cardCode'])) {
				throw new Exception("post cardCode not exit", 1);
			}
			if (!isset($_POST['productName'])) {
				throw new Exception("post productName not exit", 1);
			}
			if (!isset($_POST['productType'])) {
				throw new Exception("post productType not exit", 1);
			}
			if (!isset($_POST['productDesc'])) {
				throw new Exception("post productDesc not exit", 1);
			}
			if (!isset($_POST['extInfo'])) {
				throw new Exception("post extInfo not exit", 1);
			}

			$merchantOrderNo = $_POST['merchantOrderNo'];

			$requestAmount = $_POST['requestAmount'];

			$cardAmt = $_POST['cardAmt'];

			$cardNo = $_POST['cardNo'];

			$cardPwd = $_POST['cardPwd'];

			$cardCode = $_POST['cardCode'];

			$productName = $_POST['productName'];

			$productType = $_POST['productType'];

			$productDesc = $_POST['productDesc'];

			$extInfo = $_POST['extInfo'];

		}
		

		//$rd = md5(uniqid(rand()));// 產生亂數流水號

		$userCard = new yeeykCard($cardAmt,$cardNo,$cardPwd ,$cardCode); // 建立卡號物件 用於管理卡片資料的存取

		$userOrder = new yeeykProduct($productName,$productType,$productDesc,$extInfo); // 建立產品 物件用於產品資訊的存取

		$oscb = order($merchantOrderNo,$requestAmount,$userCard,$userOrder);
		// function order((string)var1,(string)var2,(yeeykCard)obj1,(yeeykProduct)obj2)
		// 下定訂單 回傳 OrderSynchronizationCallback 型態資料物件
		// merchantOrderNo 商戶訂單編號 string 36 必須唯一值
		// requestAmount 訂單金額 string 10
		// Card 卡片資訊 yeeykCard 型態資料物件
		// Product 商品資訊 yeeykProduct 型態資料物件

		if (is_null($oscb)) // 確認是否有回傳資料物件
		{
			throw new Exception("oscb return null", 1);
		}

		echo "<br>";
		echo "返回訊息".$oscb->getMessage()."</br>";
		echo "業務類型".$oscb->getBizType()."</br>";			
		echo "商戶定單號".$oscb->getMerchantOrderNo()."</br>";
		echo "提交狀態碼".$oscb->getCode()."</br>"; // 技術文件第5頁 Code 介紹
		echo "簽名資訊".$oscb->getHmac()."</br>";

	}
	catch(Exception $e){
		echo $e;
		exit();
	}
?>

