<?php

function payuSend($datosPago,$tipoTrans=false){   

    date_default_timezone_set('America/Mexico_City');
    $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('y'));
    $expirationDate = date('Y-m-d', $tomorrow).date('\TH:i:s');

    $array_info=array();

    if($tipoTrans){    
        //modo produccion
        $apiLogin='7fd0db4db91da36';
        $apiKey='iumk8ibsq155lfk64kpoic7b8';
        $accountId='508695';
        $merchantId='507650';  
        $urlTrans = 'https://api.payulatam.com/payments-api/4.0/service.cgi'; 
        $bandTrans = 'false'; 
    }else{      
    
        //tarjeta test visa
        $apiLogin="11959c415b33d0c";
        $apiKey="6u39nqhq8ftd0hlvnjfs66eh8c";    
        $merchantId="500238";
        //prueba oxxo y 7
        //$accountId="500547";
        //prueba tajeta
        $accountId="500537";    
        $urlTrans = 'https://stg.api.payulatam.com/payments-api/4.0/service.cgi';
        $bandTrans = 'true';
    }

    $referenceCode=$datosPago['reference'];    
    $amount=$datosPago['amount'];
    $currency=$datosPago['cc_issue'];      
    $descripcion_venta=$datosPago['descripcion_venta'];      
    
    $res_nombre_cliente = $datosPago['res_nombre_cliente'];
    $res_email = $datosPago['res_email'];
    $res_telefono = $datosPago['res_telefono'];
    $res_dir = $datosPago['res_dir'];
    $cli_ciudad = $datosPago['cli_ciudad'];
    $cli_estado = $datosPago['cli_estado'];
    $cli_pais = $datosPago['cli_pais'];
    $cli_cp = $datosPago['cli_cp']; 

    $direccion_payer = $datosPago['direccion_payer'];
    $ciudad_p = $datosPago['ciudad_payer'];
    $pais_p = $datosPago['pais_payer'];
    $cp_p = $datosPago['cp_payer'];
    
    $signature=$apiKey.'~'.$merchantId.'~'.$referenceCode.'~'.$amount.'~'.$currency;
    $signature_md5 = md5($signature);
    $ipAddress = $_SERVER['SERVER_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    $pago='';

    switch($datosPago['txtAPagarEn']){
	case 'TC':
        $number=$datosPago['number'];
        $securityCode=$datosPago['cvv-csc'];
        $expirationDateT=$datosPago['expyear'].'/'.$datosPago['expmonth'];
        $name_tarjeta=$datosPago['name'];    
        $paymentMethod=$datosPago['cc_type'];
        $cookie=$datosPago['divice_folio']; 

	    $pago="<creditCard>
	    <number>$number</number>
	    <securityCode>$securityCode</securityCode>
	    <expirationDate>$expirationDateT</expirationDate>
	    <name>$name_tarjeta</name>
	    </creditCard>
	    <type>AUTHORIZATION_AND_CAPTURE</type>
	    <paymentMethod>$paymentMethod</paymentMethod>
	    <paymentCountry>MX</paymentCountry>
	    <payer>
	    <fullName>$name_tarjeta</fullName>
	    <emailAddress>$res_email</emailAddress>
        <contactPhone>$res_telefono</contactPhone>
        <billingAddress>
        <street1>$direccion_payer</street1>
        <street2>$ciudad_p</street2>
        <city>$ciudad_p</city>
        <state>$ciudad_p</state>
        <country>$pais_p</country>
        <postalCode>$cp_p</postalCode>
        </billingAddress>
	    </payer>	    	    	    	    
        <deviceSessionId>$cookie</deviceSessionId>
        <ipAddress>$ipAddress</ipAddress>
        <cookie>cookie_$cookie</cookie>
        <userAgent>$userAgent</userAgent>
        <extraParameters class='java.util.HashMap'>
	    <entry>
	    <string>RESPONSE_URL</string>
	    <string>http://www.plazadelatecnologia.com/carrito/pagoOk</string>
	    </entry>
	    <entry>
	    <string>INSTALLMENTS_NUMBER</string>
	    <string>1</string>
	    </entry>
	    </extraParameters>	
	    ";
	    break;
	case 'OXXO':
	    $pago="<type>AUTHORIZATION_AND_CAPTURE</type>
	    <paymentMethod>OXXO</paymentMethod>
	    <paymentCountry>MX</paymentCountry>
	    <expirationDate>$expirationDate</expirationDate>
	    <extraParameters class='java.util.HashMap'>
	    <entry>
	    <string>BANK_REFERENCED_NAME</string>
	    <string>OXXO</string>
	    </entry>
	    </extraParameters>";
	    break;
	case '7ELEVEN':
	    $pago="<type>AUTHORIZATION_AND_CAPTURE</type>
	    <paymentMethod>SEVEN_ELEVEN</paymentMethod>
	    <expirationDate>$expirationDate</expirationDate>";
	    break;
    }
    
    
$xml_datos = "<?xml version='1.0' encoding='UTF-8'?>
<request>
<language>es</language>
<command>SUBMIT_TRANSACTION</command>
<merchant>
<apiLogin>$apiLogin</apiLogin>
<apiKey>$apiKey</apiKey>
</merchant>
<transaction>
<order>
<accountId>$accountId</accountId>
<referenceCode>$referenceCode</referenceCode>
<description>$descripcion_venta</description>
<language>es</language>
<notifyUrl>http://www.plazadelatecnologia.com/carrito/respuestaPayuFin</notifyUrl>
<signature>$signature_md5</signature>
<shippingAddress>
<street1>$res_dir</street1>
<city>$cli_ciudad</city>
<state>$cli_estado</state>
<country>MX</country>
<postalCode>$cli_cp</postalCode>
<phone>$res_telefono</phone>
</shippingAddress>
<buyer>
<fullName>$res_nombre_cliente</fullName>
<emailAddress>$res_email</emailAddress>
<dniNumber>$res_telefono</dniNumber>
<shippingAddress>
<street1>$res_dir</street1>
<city>$cli_ciudad</city>
<state>$cli_estado</state>
<country>$cli_pais</country>
<postalCode>$cli_cp</postalCode>
<phone>$res_telefono</phone>
</shippingAddress>
</buyer>
<additionalValues class='java.util.HashMap'>
<entry>
<string>TX_VALUE</string>
<additionalValue>
<value>$amount</value>
<currency>$currency</currency>
</additionalValue>
</entry>
</additionalValues>
</order>
$pago
</transaction>
<isTest>$bandTrans</isTest>
</request>";    
    
    
    //echo $xml_datos;
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL,$urlTrans);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml; charset=utf-8"));
    curl_setopt($ch, CURLOPT_POSTFIELDS,$xml_datos);
    
    $resultado_c = curl_exec($ch);
    $error_c=curl_error($ch);   
    
    if($resultado_c==FALSE){
        $error_c=curl_error($ch);
        $array_info['payu_r']['error_code']=200;
        $array_info['payu_r']['error_msg']=$error_c;
        $array_info['payu_r']['datos']='';
        $array_info['payu_r']['request']=$xml_datos;
        $array_info['payu_r']['respuesta']='';
        return $array_info;
        exit;
    }
    else{
	    $array_info['payu_r']['datos']=simplexml_load_string($resultado_c);
        $array_info['payu_r']['request']=$xml_datos;
        $array_info['payu_r']['respuesta']=$resultado_c;
	    $array_info['payu_r']['error_code']=0;
        $array_info['payu_r']['error_msg']='';
	    return $array_info;
	    exit;	    
	    
    }
    

    curl_close($ch);
}
