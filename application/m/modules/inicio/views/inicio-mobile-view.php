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


