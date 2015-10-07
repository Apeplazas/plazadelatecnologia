<? $header = $this->data_model->cargarRamaDisponibles();?>
<nav id="nav">
	<ul id="main">
	<? foreach($header as $rowH) :?>
	  <li class="me">
	    <a class="rama" title="<?= $rowH->enlaceTitulo?>" <? if($rowH->microFormatos != ''):?><?=$rowH->microFormatos;?><? endif?> href="http://m.plazadelatecnologia.com/<?= $rowH->paginaUrl;?>"><?= $rowH->enlaceNombre;?></a>
	    <? if ($rowH->subMenu == 'si' && $rowH->paginaUrl == $this->uri->segment(1)):?>
	    <ul id="<?=$rowH->paginaUrl?>"  class="subMenu">
	    	<?$marcas = $this->ofertas_model->marcas($rowH->enlaceNombre,$order = 'lo.marcaID ASC');?>
		    <ul class="subUl">
		    	<li><strong><a href="http://m.plazadelatecnologia.com/">Marcas</a></strong></li>
		    	<? foreach($marcas as $marcaRow) :?>
			    <li><a class="cat" href="http://m.plazadelatecnologia.com/<?=strtolower($rowH->enlaceNombre)?>/<?=strtolower($marcaRow->marcaUrl)?>"><?=$marcaRow->marca?></a></li>
			     <? endforeach; ?>
			     <li><a class="cat" href="http://m.plazadelatecnologia.com/<?= $rowH->paginaUrl;?>">Ver mas...</a></li>
			</ul>
			<?$cates = $this->data_model->cargaTematicas($rowH->enlaceNombre,$marca = '');?>
		    <ul class="subUl">
		    	<li><strong><a href="http://m.plazadelatecnologia.com/">Categorias</a></strong></li>
		    	<? foreach($cates as $catRow) :?>
			    <li><a class="cat" href="http://m.plazadelatecnologia.com/<?=strtolower($rowH->enlaceNombre)?>/0/<?=strtolower($catRow->tematicaUrl)?>"><?=$catRow->tematicaNombre?></a></li>
			     <? endforeach; ?>
			</ul>
			 <? $tematica = $this->data_model->cargaCaracteristicas($rowH->enlaceNombre, $marca = '');?>
	    	<? foreach($tematica as $rowT) :?>
		    <ul class="subUl">
		    	<? $categoria = $this->data_model->cargaSubCat($rowH->enlaceNombre,$marca = '', $rowT->tipoID);?>
		    	<li><strong><a href="http://m.plazadelatecnologia.com/"><?= $rowT->descripcion?></a></strong></li>
		    	<? foreach($categoria as $rowC) :?>
			    	<li><a class="cat" href="http://m.plazadelatecnologia.com/<?= strtolower($rowH->enlaceNombre);?>/0/0/<?= $rowC->catUrl?>"><?= character_limiter($rowC->descripcion, 20)?></a></li>
			     <? endforeach; ?>
			     <li><a class="cat" href="http://m.plazadelatecnologia.com/<?= $rowH->paginaUrl;?>">Ver mas...</a></li>
		    </ul>
		    <? endforeach; ?>
		</ul>
	    <? endif;?>	
	  </li>
	  <? endforeach; ?>
	  <li class="me"><a class="rama" title="Ofertas y promociónes" href="http://m.plazadelatecnologia.com/ofertas">Ofertas</a></li>
	  <!-- Tu comentario <li class="me"><a class="rama" title="Outlet y liquidaciones" href="http://m.plazadelatecnologia.com/venta_outlet">Outlet</a></li>-->
	  <li class="me"><a class="rama" title="Renta de locales" href="http://m.plazadelatecnologia.com/renta_de_locales">Renta de Locales</a></li>
	 <br class="clear">
	</ul>
</nav>