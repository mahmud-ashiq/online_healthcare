<?php

include '../../model/patient_db.php';
/*$mydb = new Model();
$conObj = $mydb->OpenCon();
$result = $mydb->ShowProfile($conObj, $_SESSION['email']);
$pname = $result['name'];
$padd = $result['address'];
echo $_SESSION['dname'];*/
$val_id = '';
if (isset($_POST['val_id'])) {
	$val_id = urlencode($_POST['val_id']);



	$store_id = urlencode("onlin663c67129cd1e");
	$store_passwd = urlencode("onlin663c67129cd1e@ssl");
	$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $requested_url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

	$result = curl_exec($handle);

	$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

	if ($code == 200 && !(curl_errno($handle))) {

		# TO CONVERT AS ARRAY
		# $result = json_decode($result, true);
		# $status = $result['status'];

		# TO CONVERT AS OBJECT
		$result = json_decode($result);

		# TRANSACTION INFO
		$status = $result->status;
		$tran_date = $result->tran_date;
		$tran_id = $result->tran_id;
		$val_id = $result->val_id;
		$amount = $result->amount;
		$store_amount = $result->store_amount;
		$bank_tran_id = $result->bank_tran_id;
		$card_type = $result->card_type;

		# EMI INFO
		$emi_instalment = $result->emi_instalment;
		$emi_amount = $result->emi_amount;
		$emi_description = $result->emi_description;
		$emi_issuer = $result->emi_issuer;

		# ISSUER INFO
		$card_no = $result->card_no;
		$card_issuer = $result->card_issuer;
		$card_brand = $result->card_brand;
		$card_issuer_country = $result->card_issuer_country;
		$card_issuer_country_code = $result->card_issuer_country_code;

		# API AUTHENTICATION
		$APIConnect = $result->APIConnect;
		$validated_on = $result->validated_on;
		$gw_version = $result->gw_version;

		$mydb = new Model();
		$conObj = $mydb->OpenCon();
		$result = $mydb->updatePayment($conObj, $_SESSION['app_id'], $tran_id, $tran_date, $amount, $card_type);
	} else {

		echo "Failed to connect with SSLCOMMERZ";
	}
}
$mydb = new Model();
$conObj = $mydb->OpenCon();
$r_result = $mydb->viewReceipt($conObj, $_SESSION['app_id']);
if ($r_result) {
	$amount = $r_result['amount'];
	$trx = $r_result['trx'];
	$trx_date = $r_result['trx_date'];
	$card = $r_result['card'];
}
