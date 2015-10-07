<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use HechoEnDrupal\ComproPago\Api;
use HechoEnDrupal\ComproPago\Charge;
use HechoEnDrupal\ComproPago\Customer;
use HechoEnDrupal\ComproPago\Webhook;

require dirname(__FILE__) . '/../third_party/compropago/vendor/autoload.php';

class compropago{
	
	public $api;
	public $api_key					= 'sk_live_43d116360b7363b49';
	public $paymentTypesMaxAmounts	= array(
		"OXXO"					=> 15000,
		"SEVEN_ELEVEN"			=> 15000,
		"EXTRA"					=> 5000,
		"WALMART"				=> 15000,
		"CHEDRAUI"				=> 5000,
		"SAMS_CLUB"				=> 15000,
		"BODEGA_AURRERA"		=> 15000,
		"SUPERAMA"				=> 15000,
		"ELEKTRA"				=> 15000,
		"COPPEL"				=> 15000,
		"FARMACIA_BENAVIDES"	=> 5000,
		"FARMACIA_ESQUIVAR"		=> 5000,
		"SORIANA"				=> 5000,
	);
	
	function compropago(){
		
		$this->api = new Api($this->api_key);
				
	}
	
	function makePayment($data,$formaPago){
				
		$charge = new Charge(array(
			'currency'			=> 'MXN',
			'product_price' 	=> $data['total'],
			'product_name' 		=> 'Compra en Plaza de la Tecnología',
			'product_id'		=> $data['ref'],
			'image_url'			=> 'http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png',
			'customer_name'		=> $data['name'],
			'customer_email'	=> $data['email'],
			'customer_phone'	=> '0000000000',
			'payment_type'		=> $formaPago,
			'send_sms'			=> false
		));
		
		$product = $this->api->createCharge($charge);

		$status = $this->api->getCharge($product['payment_id']);
		$status["payment_instructions"] = $product["payment_instructions"];
		return $status;
		//
		// Send sms
		//
		/*
		$customer = new Customer(array(
		'customer_phone' => '5540505606',
		'customer_company_phone' => 'TELCEL'
		));
		print_r($this->api->createSMS($customer,$product['payment_id']));
		*/
	}
	
	function validatePayment($cp_request){
		
		$webhook = new WebHook($cp_request);
		//Check if payment is success
		if ($webhook->paid()) {
			
			$checkstatus = $this->api->getCharge($webhook->getID());
		
			if(isset($checkstatus['type']) && $checkstatus['type'] == 'charge.success'){
				
				// Payment Details
				$payment = $webhook->getPaymentDetails();
				return $webhook->getID();
				
			}else{
				
				return false;
				
			}
				
		}
		
	}
	
}
