<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/../third_party/conekta/vendor/conekta/conekta-php/lib/Conekta.php');

class conektapt{
	
	function conektapt(){
		
		Conekta::setApiKey("key_YYhQPyu53UTGdCSWor5LYw");
				
	}
	
	function makePayment($amount,$refId,$token,$user){
		
		if(!$amount || !$refId || !$token)
			return false;
		
		try{
		  $charge = Conekta_Charge::create(array(
		    "amount"=> $amount,
		    "currency"=> "MXN",
		    "description"=> "Compra en Plaza de la Tecnología",
		    "reference_id"=> $refId,
		    "card"=> $token,
		    "details" => array("email" => $user['email'])
		  ));

		  return $charge;
		  
		}catch (Conekta_Error $e){
		  return $e->getMessage(); //el pago no pudo ser procesado
		}
		
	}
	
}
