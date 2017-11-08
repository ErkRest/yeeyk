<?php

	$oqcb = null;	// 儲存回傳 OrderQueryCallBack 型態資料物件變數
	$merchantOrderNo = "";

	try{

		$binDir = dirname(__FILE__)."/bin/PublicFunc.php"; // include public function file

		if(!is_file($binDir))	// check dir
			throw new Exception("include bin ".$binDir." file is not exist", 1);

		require $binDir;
		
		if(isset($_GET['merchantOrderNo'])){
			$merchantOrderNo = $_GET['merchantOrderNo'];
		}else{
			if (!isset($_POST['merchantOrderNo'])) {
				throw new Exception("post merchantOrderNo not exit", 1);
			}
			$merchantOrderNo = $_POST['merchantOrderNo'];
		}
		
		$oqcb = queryOrder($merchantOrderNo); // queryOrder($var) 查詢 merchantOrderNo 的下定資訊 return (obj) OrderQueryCallBack 資料物件

		echo "</br>";
		echo "查詢狀態碼".$oqcb->getCode() ."</br>";
		echo "訂單訊息".$oqcb->getData() ."</br>";
		echo "服務類型".$oqcb->getBizType() ."</br>";
		echo "支付結果".$oqcb->getResult() ."</br>";
		echo "商戶編號".$oqcb->getMerchantNo() ."</br>";
		echo "商戶訂單號".$oqcb->getMerchantOrderNo() ."</br>";
		echo "成功金額".$oqcb->getSuccessAmount() ."</br>";
		echo "支付方式".$oqcb->getCardCode() ."</br>";

		echo "通知類型".$oqcb->getNoticeType() ."</br>";
		echo "擴展信息".$oqcb->getExtInfo() ."</br>";
		echo "卡序列號組".$oqcb->getCardNo() ."</br>";
		echo "卡狀態組".$oqcb->getCardStatus() ."</br>";
		echo "卡處理訊數".$oqcb->getCardReturnInfo() ."</br>";
		echo "是否是餘額卡".$oqcb->getCardIsbalance() ."</br>";
		echo "卡餘額".$oqcb->getCardBalance() ."</br>";
		echo "卡成功金額".$oqcb->getCardSuccessAmount() ."</br>";

	}
	catch(Exception $e){
		echo $e;
		exit();
	}

?>
