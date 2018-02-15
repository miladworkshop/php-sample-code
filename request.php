<?php
$MerchantID 			= "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$Price 					= 100;
$InvoiceNumber 			= 15;
$Description 			= "تراکنش شماره {$InvoiceNumber}";
$CallbackURL 			= "http://example.com/verify.php";
	
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://miladworkshop.ir/payment/webservice/paymentRequest.php');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID=$MerchantID&Price=$Price&Description=$Description&InvoiceNumber=$InvoiceNumber&CallbackURL=". urlencode($CallbackURL));
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($curl));
curl_close($curl);

if ($result->Status == 100)
{
	header('Location: https://miladworkshop.ir/payment/webservice/startPayment.php?au='. $result->Authority);
} else {
	echo $result->Status;
}
?>