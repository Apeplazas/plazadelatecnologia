<? $header = $this->data_model->cargarRamaDisponibles();?>
<nav id="nav">
	<ul id="main">
	<? foreach($header as $rowH) :?>
	  <li class="me">
	    <a class="rama" title="<?= $rowH->enlaceTitulo?>" <? if($rowH->microFormatos != ''):?><?=$rowH->microFormatos;?><? endif?> href="<?=base_url()?><?= $rowH->paginaUrl;?>"><?= $rowH->enlaceNombre;?></a>
	    <? if ($rowH->subMenu == 'si' ):?>
	    <ul id="<?=$rowH->paginaUrl?>"  class="subMenu">
	    	<?$marcas = $this->ofertas_model->marcas($rowH->enlaceNombre,$order = 'lo.marcaID ASC');?>
		    <ul class="subUl">
		    	<li><strong>Marcas</strong></li>
		    	<? foreach($marcas as $marcaRow) :?>
			    <li><a class="cat" href="<?=base_url()?><?=strtolower($rowH->enlaceNombre)?>/<?=strtolower($marcaRow->marcaUrl)?>" title="<?=$marcaRow->marca?>"><?=$marcaRow->marca?></a></li>
			     <? endforeach; ?>
			     <li><a class="cat" href="<?=base_url()?><?= $rowH->paginaUrl;?>" title="Ver todas las marcas">Ver todas...</a></li>
			</ul>
			<?$cates = $this->data_model->cargaTematicas($rowH->enlaceNombre,$marca = '');?>
		    <ul class="subUl">
		    	<li><strong>Categorias</strong></li>
		    	<? foreach($cates as $catRow) :?>
			    <li><a class="cat" href="<?=base_url()?><?=strtolower($rowH->enlaceNombre)?>/0/<?=strtolower($catRow->tematicaUrl)?>" title="<?=$catRow->tematicaNombre?>"><?=$catRow->tematicaNombre?></a></li>
			     <? endforeach; ?>
			</ul>
			 <? $tematica = $this->data_model->cargaCaracteristicas($rowH->enlaceNombre, $marca = '');?>
	    	<? foreach($tematica as $rowT) :?>
		    <ul class="subUl">
		    	<? $categoria = $this->data_model->cargaSubCat($rowH->enlaceNombre,$marca = '', $rowT->tipoID);?>
		    	<li><strong><?= $rowT->descripcion?></strong></li>
		    	<? foreach($categoria as $rowC) :?>
			    	<li><a class="cat" href="<?=base_url()?><?= strtolower($rowH->enlaceNombre);?>/0/0/<?= $rowC->catUrl?>" title="<?=$rowC->descripcion?>"><?= character_limiter($rowC->descripcion, 20)?></a></li>
			     <? endforeach; ?>
			     <li><a class="cat" href="<?=base_url()?><?= $rowH->paginaUrl;?>" title="Ver mas">Ver mas...</a></li>
		    </ul>
		    <? endforeach; ?>
		</ul>
	    <? endif;?>	
	  </li>
	  <? endforeach; ?>
	  <li class="me"><a class="rama" title="Ofertas y promociónes" href="<?=base_url()?>ofertas" title="Ofertas">Ofertas</a></li>
	  <!-- Tu comentario <li class="me"><a class="rama" title="Outlet y liquidaciones" href="<?=base_url()?>venta_outlet">Outlet</a></li>-->
	  <li id="renta" class="me"><a class="rama" title="Renta de locales" href="<?=base_url()?>renta_de_locales">Renta de Locales</a></li>
	  <? $this->load->library('cart');?>
	  <li id="miCarrito"><a href="<?=base_url()?>carrito" title="Carrito de compras">Mi Carrito <? if($this->cart->total() > 0):?><span>$ <?=number_format($this->cart->total());?><? endif;?></span></a></li>
	</ul>
</nav>