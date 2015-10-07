<section id="hp" >
	<div id="headHp">
	<span id="add"><img src="<?=base_url()?>assets/graphics/ganavendiendoproductoshp.png" alt="Gana vendiendo productos HP en Plaza de la tecnologia" /></span>
	</div>
	<div id="navHp">
		<a id="logoHp" title="Hp" href="http://www8.hp.com/mx/es/products/gateway/printers/"><img src="<?=base_url()?>assets/graphics/logoHp.png" alt="" /></a>
		<ul>
			<li class="menuHp"><a title="http://www8.hp.com/mx/es/products/gateway/printers/" href="url">Para el hogar</a></li>
			<li class="menuHp"><a title="http://www8.hp.com/mx/es/products/gateway/printers/" href="url">Para empresas</a></li>
			<li class="menuHp"><a title="http://www8.hp.com/mx/es/products/gateway/printers/" href="url">Soporte técnico</a></li>
		</ul>
	</div>
	
	<div id="graciasHp">
		<span class="marg">
		<h1>Se ha enviado un email a su cuenta de correo electronico!!!</h1>
		<p>Para activar su cuenta confirme presionando el boton de confirmar en el correo electronico que acabamos de enviar</p>
		</span>
	</div>
</section>


<style type="text/css" media="screen">
	#hp{float:left; width:100%; background:url(../assets/graphics/bck-hp.png) left top repeat-x;}
	#add {float:left; width:100%; background-color:#eee; height:99px;}
	#add img{float:left; margin:25px 0 0 25px}
	#navHp img{float:left; margin-left:25px}
	.menuHp a{float:left; color:#fff; font-weight:700; font-size:.9em; font-family:HPSimplified,Arial; padding:30px 0px 0 20px; letter-spacing:-.5px}
	#contHp{float:left; margin-left:25px;}
	#navHp{float:left; width:100%; background-color:#0096D6; height:72px}
	#logoHp{float:left; margin:10px 0 0 0}
	#contHp{float:left; width:980px; margin-left:25px; padding:25px 0}
	#regHp{float:left; width:650px; border-right:3px solid #ccc; margin-right:25px}
	#logHp{float:left; width:280px;}
	#subHp{border:none; float:left; margin:15px 0 0 210px;}
	#regHp h1{font-size:1.2em; font-weight:700; float:left; width:100%; padding:20px 0}
	#regHp fieldset{float:left; width:100%; padding:13px 0; position:relative}
	#regHp label{font-size:.9em; float:left; font-weight:200; width:200px; text-align:right; padding-right:10px; padding-top:8px;}
	.smaInp{float:left; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-color:#eee; width:300px; border:1px solid #ccc; height:32px; padding:0 10px}
	#logHp span{float:left; width:100%; padding-bottom:1a5px}
	#logHp label{float:left; width:100%; font-weight:200; padding-bottom:5px;}
	#logHp fieldset{float:left; width:100%; padding:10px 0 0 15px}
	.selectOne{border:none; -webkit-appearance:none; -moz-appearance:none; cursor:pointer;padding:10px 20px 10px 15px; background:url(../assets/graphics/triangulo.png) 95% 12px no-repeat #eee; font-size:.8em; height:35px; color:#777; border:1px solid #ccc; width:200px;}
	.selectTwo{border:none; -webkit-appearance:none; -moz-appearance:none; cursor:pointer;padding:10px 20px 10px 15px; background:url(../assets/graphics/triangulo.png) 98% 10px no-repeat #eee; font-size:.8em; height:35px; color:#777; border:1px solid #ccc; width:320px;}
	#preg{float:left; width:210px; margin-left:210px;}
	#preg span{float:left; width:100%; font-size:.7em; text-transform:uppercase; padding:15px 0 3px 5px; color:#999}
	#ema img, #regHp i img{float:left;}
	#ema, #regHp i{position:absolute; top:-12px; text-transform:uppercase; left:210px;}
	#ema p, #regHp i p{float:left; font-weight:700; padding-top:5px; font-size:.7em; color:#999}
	#graciasHp{float:left; width:100%; background-color:#fff}
	.marg{float:left; margin:75px 0 75px 25px;}
	.marg h1{float:left; width:100%; font-size:1.4em; font-weight:200}
	.marg p{float:left; width:100%;}
</style>

<script type="text/javascript">
$(document).ready(function() {
	// Busca que el email no este registrado
    $("#emaCheck").keyup(function(){
		var filtro    = $("#emaCheck").val();
		$("#ema").removeAttr("disabled");
		$.post("http://www.plazadelatecnologia.com/gana_con_hp/verificaUrl",{filtro:filtro},function(data){
			sucess:				
				$("#ema").empty().append(data);
				$("#ema").removeAttr("disabled");
		});
		
	})
	
    $("#txtboxToFilter").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    
});
</script>




