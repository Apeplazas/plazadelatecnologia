<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\AddressType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;

use PayPal\EBLBaseComponents\DoExpressCheckoutPaymentRequestDetailsType;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentReq;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentRequestType;

use PayPal\PayPalAPI\GetExpressCheckoutDetailsReq;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsRequestType;

use PayPal\Service\PayPalAPIInterfaceServiceService;

require_once APPPATH."/third_party/PPBootStrap.php";
session_start();

class paypal{
	
	private $address;
	private $returnUrl;
	private	$cancelUrl;
	private $currencyCode;
	private $paymentDetails;
	private $itemTotalValue;
	private $taxTotalValue;
	private $orderTotalValue;
	 
    public function __construct() { 
     
		$this->address		= new AddressType();
		$this->returnUrl 	= base_url()."carrito/paypal_gracias";
		$this->cancelUrl 	= base_url()."carrito";	 

		$this->currencyCode = "MXN";
		// total shipping amount
		//$shippingTotal = new BasicAmountType($currencyCode, 100);
		//total handling amount if any
		//$handlingTotal = new BasicAmountType($currencyCode, $_REQUEST['handlingTotal']);
		//total insurance amount if any
		//$insuranceTotal = new BasicAmountType($currencyCode, $_REQUEST['insuranceTotal']);
		
		$this->paymentDetails = new PaymentDetailsType();
		$this->itemTotalValue = 0;
		$this->taxTotalValue = 0;
		$this->orderTotalValue = 0;
		
	}
	
	public function setAddress($addressDetails){
		
		// shipping address
		$this->address->CityName		= $addressDetails['cityName'];
		$this->address->Name 			= $addressDetails['name'];
		$this->address->Street1 		= $addressDetails['street'];
		$this->address->StateOrProvince = $addressDetails['stateOrProvince'];
		$this->address->PostalCode 		= $addressDetails['postalCode'];
		$this->address->Country 		= "MX";
		$this->address->Phone 			= $addressDetails['phone'];

	}
	
	public function setCarItems($carItems){
				
		/*
		 * iterate trhough each item and add to atem detaisl
		 */
		for($i=0; $i<count($carItems); $i++) {
			
			$itemAmount				= new BasicAmountType($this->currencyCode, $carItems[$i]->ofertaPrecio);	
			$this->itemTotalValue 	+= $carItems[$i]->subtotalPago; 
			//$this->taxTotalValue 	+= $_REQUEST['itemSalesTax'][$i] * $_REQUEST['itemQuantity'][$i];
			$itemDetails 			= new PaymentDetailsItemType();
			$itemDetails->Name 		= $carItems[$i]->ofertaTitulo;
			$itemDetails->Amount 	= $itemAmount;
			$itemDetails->Quantity 	= $carItems[$i]->cantidadProducto;
		
			//$itemDetails->ItemCategory	= $_REQUEST['itemCategory'][$i];
			//$itemDetails->Tax 			= new BasicAmountType($this->currencyCode, $_REQUEST['itemSalesTax'][$i]);	
			
			$this->paymentDetails->PaymentDetailsItem[$i] = $itemDetails;	
		}
		
		/*
 		* The total cost of the transaction to the buyer. If shipping cost and tax charges are known, include them in this value. If not, this value should be the current subtotal of the order. If the transaction includes one or more one-time purchases, this field must be equal to the sum of the purchases. If the transaction does not include a one-time purchase such as when you set up a billing agreement for a recurring payment, set this field to 0.
 		*/
		$this->orderTotalValue = $this->itemTotalValue;
	}

	function sendToPaypal(){
			
		//Payment details
		$this->paymentDetails->ShipToAddress = $this->address;
		$this->paymentDetails->ItemTotal = new BasicAmountType($this->currencyCode, $this->itemTotalValue);
		//$paymentDetails->TaxTotal = new BasicAmountType($currencyCode, $taxTotalValue);
		$this->paymentDetails->OrderTotal = new BasicAmountType($this->currencyCode, $this->orderTotalValue);
		
		/*
		 * How you want to obtain payment. When implementing parallel payments, this field is required and must be set to Order. When implementing digital goods, this field is required and must be set to Sale. If the transaction does not include a one-time purchase, this field is ignored. It is one of the following values:
		
		    Sale � This is a final sale for which you are requesting payment (default).
		
		    Authorization � This payment is a basic authorization subject to settlement with PayPal Authorization and Capture.
		
		    Order � This payment is an order authorization subject to settlement with PayPal Authorization and Capture.
		
		 */
		$this->paymentDetails->PaymentAction = "Sale";

		//$paymentDetails->HandlingTotal = $handlingTotal;
		//$paymentDetails->InsuranceTotal = $insuranceTotal;
		//$paymentDetails->ShippingTotal = $shippingTotal;

		$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
		$setECReqDetails->PaymentDetails[0] = $this->paymentDetails;
		/*
		 * (Required) URL to which the buyer is returned if the buyer does not approve the use of PayPal to pay you. For digital goods, you must add JavaScript to this page to close the in-context experience.
		 */
		$setECReqDetails->CancelURL = $this->cancelUrl;
		/*
		 * (Required) URL to which the buyer's browser is returned after choosing to pay with PayPal. For digital goods, you must add JavaScript to this page to close the in-context experience.
		 */
		$setECReqDetails->ReturnURL = $this->returnUrl;
		
		/*
		 * Determines where or not PayPal displays shipping address fields on the PayPal pages. For digital goods, this field is required, and you must set it to 1. It is one of the following values:
		
		    0 � PayPal displays the shipping address on the PayPal pages.
		
		    1 � PayPal does not display shipping address fields whatsoever.
		
		    2 � If you do not pass the shipping address, PayPal obtains it from the buyer's account profile.
		
		 */
		$setECReqDetails->NoShipping = 0;
		/*
		 *  (Optional) Determines whether or not the PayPal pages should display the shipping address set by you in this SetExpressCheckout request, not the shipping address on file with PayPal for this buyer. Displaying the PayPal street address on file does not allow the buyer to edit that address. It is one of the following values:
		
		    0 � The PayPal pages should not display the shipping address.
		
		    1 � The PayPal pages should display the shipping address.
		
		 */
		$setECReqDetails->AddressOverride = 1;
		
		/*
		 * Indicates whether or not you require the buyer's shipping address on file with PayPal be a confirmed address. For digital goods, this field is required, and you must set it to 0. It is one of the following values:
		
		    0 � You do not require the buyer's shipping address be a confirmed address.
		
		    1 � You require the buyer's shipping address be a confirmed address.
		
		 */
		$setECReqDetails->ReqConfirmShipping = 1;
		
		// Billing agreement details
		$billingAgreementDetails = new BillingAgreementDetailsType("None");
		$billingAgreementDetails->BillingAgreementDescription = "Un solo pago";
		$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);
		
		// Display options
		$setECReqDetails->cppheaderimage = "http://www.plazadelatecnologia.com/assets/graphics/paypal-plazadelatecnologia.png";
		//$setECReqDetails->cppheaderbordercolor = $_REQUEST['cppheaderbordercolor'];
		//$setECReqDetails->cppheaderbackcolor = $_REQUEST['cppheaderbackcolor'];
		//$setECReqDetails->cpppayflowcolor = $_REQUEST['cpppayflowcolor'];
		//$setECReqDetails->cppcartbordercolor = $_REQUEST['cppcartbordercolor'];
		//$setECReqDetails->cpplogoimage = $_REQUEST['cpplogoimage'];
		//$setECReqDetails->PageStyle = $_REQUEST['pageStyle'];
		//$setECReqDetails->BrandName = $_REQUEST['brandName'];
		
		// Advanced options
		$setECReqDetails->AllowNote = 1;
		
		$setECReqType = new SetExpressCheckoutRequestType();
		$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
		$setECReq = new SetExpressCheckoutReq();
		$setECReq->SetExpressCheckoutRequest = $setECReqType;
		
		/*
		 * 	 ## Creating service wrapper object
		Creating service wrapper object to make API call and loading
		Configuration::getAcctAndConfig() returns array that contains credential and config parameters
		*/
		$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
		try {
			/* wrap API method calls on the service object with a try catch */
			$setECResponse = $paypalService->SetExpressCheckout($setECReq);
		} catch (Exception $ex) {
			if(isset($ex)) {
				$ex_message = $ex->getMessage();
				$ex_type = get_class($ex);
			
				if($ex instanceof PPConnectionException) {
					$ex_detailed_message = "Error connecting to " . $ex->getUrl();
				} else if($ex instanceof PPMissingCredentialException || $ex instanceof PPInvalidCredentialException) {
					$ex_detailed_message = $ex->errorMessage();
				} else if($ex instanceof PPConfigurationException) {
					$ex_detailed_message = "Invalid configuration. Please check your configuration file";
				}
				print_r($ex_detailed_message);
			}
			exit;
		}
		
		if(isset($setECResponse) && $setECResponse->Ack =='Success') {

			$token = $setECResponse->Token;
			// Redirect to paypal.com here
			$payPalURL = 'https://www.paypal.com/webscr?cmd=_express-checkout&token=' . $token;
			redirect($payPalURL);
			
		}else{
			
			echo "<table>";
			echo "<tr><td>Ack :</td><td><div id='Ack'>$setECResponse->Ack</div> </td></tr>";
			echo "<tr><td>Token :</td><td><div id='Token'>$setECResponse->Token</div> </td></tr>";
			echo "</table>";
			echo '<pre>';
			print_r($setECResponse);
			echo '</pre>';
			
		}
	 
	    
    }

	function getResponse(){
			
		
		$token = $_GET['token'];

		$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);

		$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
		$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

		/*
		 * 	 ## Creating service wrapper object
		Creating service wrapper object to make API call and loading
		Configuration::getAcctAndConfig() returns array that contains credential and config parameters
		*/
		$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
		try {
			/* wrap API method calls on the service object with a try catch */
			$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
		} catch (Exception $ex) {
			if(isset($ex)) {
				$ex_message = $ex->getMessage();
				$ex_type = get_class($ex);
			
				if($ex instanceof PPConnectionException) {
					$ex_detailed_message = "Error connecting to " . $ex->getUrl();
				} else if($ex instanceof PPMissingCredentialException || $ex instanceof PPInvalidCredentialException) {
					$ex_detailed_message = $ex->errorMessage();
				} else if($ex instanceof PPConfigurationException) {
					$ex_detailed_message = "Invalid configuration. Please check your configuration file";
				}
				print_r($ex_detailed_message);
			}
			exit;
		}
		if(isset($getECResponse)) {
			
			$payerId		= urlencode($getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerID);
			$paymentAction 	= urlencode("Sale");
			
			$getExpressCheckoutDetailsRequest 							= new GetExpressCheckoutDetailsRequestType($token);
			$getExpressCheckoutReq										= new GetExpressCheckoutDetailsReq();
			$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest 	= $getExpressCheckoutDetailsRequest;
			/*
			Configuration::getAcctAndConfig() returns array that contains credential and config parameters
			*/
			$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
			try {
				/* wrap API method calls on the service object with a try catch */
				$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
			} catch (Exception $ex) {
				if(isset($ex)) {
					$ex_message = $ex->getMessage();
					$ex_type = get_class($ex);
				
					if($ex instanceof PPConnectionException) {
						$ex_detailed_message = "Error connecting to " . $ex->getUrl();
					} else if($ex instanceof PPMissingCredentialException || $ex instanceof PPInvalidCredentialException) {
						$ex_detailed_message = $ex->errorMessage();
					} else if($ex instanceof PPConfigurationException) {
						$ex_detailed_message = "Invalid configuration. Please check your configuration file";
					}
					print_r($ex_detailed_message);
				}
				exit;
			}
			//----------------------------------------------------------------------------

			/*
			 * The total cost of the transaction to the buyer. If shipping cost (not applicable to digital goods) and tax charges are known, include them in this value. If not, this value should be the current sub-total of the order. If the transaction includes one or more one-time purchases, this field must be equal to the sum of the purchases. Set this field to 0 if the transaction does not include a one-time purchase such as when you set up a billing agreement for a recurring payment that is not immediately charged. When the field is set to 0, purchase-specific fields are ignored.
			*/
			$orderTotal 			= new BasicAmountType();
			$orderTotal->currencyID = "MXN";
			$orderTotal->value 		= $getECResponse->GetExpressCheckoutDetailsResponseDetails->PaymentDetails[0]->OrderTotal->value;

			$paymentDetails= new PaymentDetailsType();
			$paymentDetails->OrderTotal = $orderTotal;

			$DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
			$DoECRequestDetails->PayerID = $payerId;
			$DoECRequestDetails->Token = $token;
			$DoECRequestDetails->PaymentAction = $paymentAction;
			$DoECRequestDetails->PaymentDetails[0] = $paymentDetails;

			$DoECRequest = new DoExpressCheckoutPaymentRequestType();
			$DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;


			$DoECReq = new DoExpressCheckoutPaymentReq();
			$DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;

			try {
				/* wrap API method calls on the service object with a try catch */
				$DoECResponse = $paypalService->DoExpressCheckoutPayment($DoECReq);
			} catch (Exception $ex) {
				if(isset($ex)) {
					$ex_message = $ex->getMessage();
					$ex_type = get_class($ex);
				
					if($ex instanceof PPConnectionException) {
						$ex_detailed_message = "Error connecting to " . $ex->getUrl();
					} else if($ex instanceof PPMissingCredentialException || $ex instanceof PPInvalidCredentialException) {
						$ex_detailed_message = $ex->errorMessage();
					} else if($ex instanceof PPConfigurationException) {
						$ex_detailed_message = "Invalid configuration. Please check your configuration file";
					}
					print_r($ex_detailed_message);
				}
				exit;
			}
			if(isset($DoECResponse)) {
				
				if(isset($DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo)) {
					
					$return = array(
						'transactionID' => $DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->TransactionID,
						'total'			=> $DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->GrossAmount->value
					);
					
					return $return;
					
				}else{
					return false;
				}
				
			}
				
		}
		
	}
	 
}