<div class="tabs"> <a href="#" class="active">Promociones</a> <a href="#" style="margin:0 17px">Menu</a> <a href="#">Contacto</a></div>
<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<div class="content-slide">
			<? foreach($campanias as $rowC):?>
            <a href="<?=base_url()?><?= $rowC->campaniaUrl;?>" class="camp"> <img src="<?=base_url()?>assets/graphics/mobile/<?= strtolower($rowC->campaniaNombre);?>-mobile.png" alt="<?= $rowC->campaniaDescripcion;?>" /></a>
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
	          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lacinia vulputate hendrerit. Suspendisse potenti. Etiam rutrum egestas massa, ut facilisis magna tristique nec. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc interdum tempus turpis ut tempus. Mauris dictum blandit lectus, a dictum erat dictum non. Etiam ultrices convallis interdum. Curabitur varius auctor enim, quis dictum nibh fringilla ut. Sed vel lacus ac odio molestie sodales quis sit amet lacus. Curabitur id porta eros. Fusce in varius nisi.</p>
	        </div>
		</div>
	</div>
</div>


