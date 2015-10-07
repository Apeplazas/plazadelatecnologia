<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<form name="Renta de locales" action="http://localhost:8888/vtiger/modules/Webforms/capture.php" method="post" accept-charset="utf-8" enctype="multipart/form-data"><input type="hidden" name="__vtrftk" value="sid:38b36e1d178824b9a33e6fdf7efe1ac30d4dec5e,1430175550">
	<input type="hidden" name="publicid" value="edddc5caf98fdbc4d1ff39ff5fb65a28">
	<input type="hidden" name="name" value="Renta de locales">
        <input type="hidden" name="VTIGER_RECAPTCHA_PUBLIC_KEY" value="RECAPTCHA PUBLIC KEY FOR THIS DOMAIN">
    	<table>
                            								                                																<tbody><tr>

<td><label>Nombre*</label></td><td>
                                                                                                                            										                                        	<input type="text" name="firstname" value="" required="">                                        </td></tr>
                                								                                																<tr>

<td><label>Apellido*</label></td><td>
                                                                                                                            										                                        	<input type="text" name="lastname" value="" required="">                                        </td></tr>
                                								                                																<tr>

<td><label>Email*</label></td><td>
                                                                                                                            										                                        	<input type="email" name="email" value="" required="">                                        </td></tr>
                                								                                																<tr>

<td><label>Teléfono Empresa</label></td><td>
                                                                                                                            										                                        	<input type="text" name="phone" value="">                                        </td></tr>
                                								                                																<tr>

<td><label>Teléfono (Alternativo)</label></td><td>
                                                                                                                            										                                        	<input type="text" name="otherphone" value="">                                        </td></tr>
                                	</tbody></table>
    <input type="submit" value="Submit">
</form>
            <script  type="text/javascript">window.onload = function() { var N=navigator.appName, ua=navigator.userAgent, tem;var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];M=M? [M[1], M[2]]: [N, navigator.appVersion, "-?"];var browserName = M[0];var form = document.forms[0], inputs = form.elements; form.onsubmit = function() { var required = [], att, val; for (var i = 0; i < inputs.length; i++) { att = inputs[i].getAttribute("required"); val = inputs[i].value; type = inputs[i].type; if(type == "email") {if(val != "") {var elemLabel = inputs[i].getAttribute("label");var emailFilter = /^[_/a-zA-Z0-9]+([!"#$%&()*+,./:;<=>?\^_`{|}~-]?[a-zA-Z0-9/_/-])*@[a-zA-Z0-9]+([\_\-\.]?[a-zA-Z0-9]+)*\.([\-\_]?[a-zA-Z0-9])+(\.?[a-zA-Z0-9]+)?$/;var illegalChars= /[\(\)\<\>\,\;\:\"\[\]]/ ;if (!emailFilter.test(val)) {alert("For "+ elemLabel +" field please enter valid email address"); return false;} else if (val.match(illegalChars)) {alert(elemLabel +" field contains illegal characters");return false;}}}if (att != null) { if (val.replace(/^\s+|\s+$/g, "") == "") { required.push(inputs[i].getAttribute("label")); } } } if (required.length > 0) { alert("The following fields are required: " + required.join()); return false; } var numberTypeInputs = document.querySelectorAll("input[type=number]");for (var i = 0; i < numberTypeInputs.length; i++) { val = numberTypeInputs[i].value;var elemLabel = numberTypeInputs[i].getAttribute("label");if(val != "") {var intRegex = /^[+-]?\d+$/;if (!intRegex.test(val)) {alert("For "+ elemLabel +" field please enter valid number"); return false;}}}}; }</script>