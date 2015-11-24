<div class="tabs"> <a href="#" class="active">Promociones</a> <a href="#" style="margin:0 17px">Menu</a> <a href="#">Contacto</a></div>
<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<div class="content-slide">
			<? foreach($slider as $rowC):?>
            <a href="http://m.plazadelatecnologia.com/<?= $rowC->bannerUrl;?>" class="camp"> 
            	<img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?= $rowC->bannerSlider;?>" alt="<?= $rowC->bannerTitulo;?>" />
            </a>
            <? endforeach; ?>
            <a href="<?=base_url()?>" class="camp"> <img src="<?=base_url()?>assets/graphics/mobile/enviosincluidos-mobile.png" alt="Laptops, Netbooks, Ultrabooks y más..." /></a>
            </div>
            <br class="clear">
		</div>
		<div class="swiper-slide">
			<div class="content-slide"><? $this->load->view('includes/menus/navMobile');?></div>
		</div>
		<div class="swiper-slide">
			<div class="content-slide">
		        <div id="contacto">
					<h1>Atención al cliente - Plaza de la Tecnología</h1>
					<p>Estamos aquí para ayudarte porque para nosotros tu eres muy importante, en el Área de Atención a Clientes nos comprometemos a realizar nuestro mayor esfuerzo para responder tus inquietudes o reclamaciones, buscando lograr tu entera satisfacción con nuestro servicio de venta en linea.</p>
					<ul>
						<li>
						  <span><img src="<?=base_url()?>/assets/graphics/contacto.png" alt="Contato directo"></span>
					      <a href="http://m.plazadelatecnologia.com/contacto/formulario">
							  <strong>Contáctanos aquí</strong>
							  <p>En plazadelatecnologia.com nos interesa tu opinión</p>
						  </a>
						</li>
						<li>
						  <span><img src="<?=base_url()?>assets/graphics/llamasincosto.png" alt="Telefonos de Atención"></span>
						  	<strong>Llámanos sin costo</strong>
							 <p>Telefonos:<br>01-800-0175-292 <em>atención a clientes de 9:00am a 6:00pn</em></p>
						</li>
					</ul>
					<br class="clear">
				</div>
	        </div>
		</div>
	</div>
</div>

<!--FancyBox--
    <div id="mdialog"> 
		<DIV  id='mcuponbox'>
		  <div id='mcuponbox_01'>
		  <img src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/logos01.png" class="mlogos01" />
		  </div>
		  <div id='mcuponbox_02'>
		  <img src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/recibe01.png" class="mlogos01" />
		  </div>
		  <div id='mcuponbox_03'>
		  	<form id="buenfin" name="buenfin" action="<?base_url()?>/inicio/gracias_cupon" method="post"> 
		  		<input id="nombre" type="text" pattern="[a-zA-Z ]+" name="nombre" placeholder="NOMBRE" class="mbtn01" required="required" />
		  		<input id="email" type="email" name="email" placeholder="E-MAIL" class='mbtn01' required="required" />
		  		<input type="submit" class="mbtn001 idleField minpout" value="RECIBIR PROMO" />
		   </form>
		  </div>
		  <div id='mcuponbox_04'><br />
		  <div id='mcuponbox_txt'> 
		  Tus datos estarán seguros y no serán compatidos con nadie, además puedes desuscribirte cuando tú lo desees
		  </div>
		  </div>
		 </DIV>
    </div>
    <!--Termina FancyBox-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <!--<link rel="stylesheet" href="/resources/demos/style.css">--> 
   <script>
   $(function () {
			$("#mdialog").dialog({
							autoOpen: true,
							modal: true,
							width: 300,
							closeOnEscape: true,
							 closeText: "hide",
							 
							 buttons: {
							                X: function () {
							                    $(this).dialog("close");
							                }
							           } 
							});
			$(".ui-dialog-titlebar").hide();
});
$("#buenfin").submit(function () {  
    if($("#nombre").val().length < 1) {  
        alert("El nombre es obligatorio");  
        return false;  
    }
    if($("#email").val().length < 1){
    	alert("El Email es obligatorio");
    	return false;
    }  
    return true;  
});  

  </script>

