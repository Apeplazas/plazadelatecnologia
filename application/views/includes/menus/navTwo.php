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
			    <li><a title="<?=$marcaRow->marca?>" class="cat" href="<?=base_url()?><?=strtolower($rowH->enlaceNombre)?>/<?=strtolower($marcaRow->marcaUrl)?>"><?=$marcaRow->marca?></a></li>
			     <? endforeach; ?>
			     <li><a title="Ver todas las marcas" class="cat" href="<?=base_url()?><?= $rowH->paginaUrl;?>">Ver mas...</a></li>
			</ul>
			<?$cates = $this->data_model->cargaTematicas($rowH->enlaceNombre,$marca = '');?>
		    <ul class="subUl">
		    	<li><strong>Categorias</strong></li>
		    	<? foreach($cates as $catRow) :?>
			    <li><a title="<?=$catRow->tematicaNombre?>" class="cat" href="<?=base_url()?><?=strtolower($rowH->enlaceNombre)?>/0/<?=strtolower($catRow->tematicaUrl)?>"><?=$catRow->tematicaNombre?></a></li>
			     <? endforeach; ?>
			</ul>
			 <? $tematica = $this->data_model->cargaCaracteristicas($rowH->enlaceNombre, $marca = '');?>
	    	<? foreach($tematica as $rowT) :?>
		    <ul class="subUl">
		    	<? $categoria = $this->data_model->cargaSubCat($rowH->enlaceNombre,$marca = '', $rowT->tipoID);?>
		    	<li><strong><?= $rowT->descripcion?></strong></li>
		    	<? foreach($categoria as $rowC) :?>
			    	<li><a title="<?=$rowC->descripcion?>" class="cat" href="<?=base_url()?><?= strtolower($rowH->enlaceNombre);?>/0/0/<?= $rowC->catUrl?>"><?= character_limiter($rowC->descripcion, 20)?></a></li>
			     <? endforeach; ?>
			     <li><a title="Ver mas" class="cat" href="<?=base_url()?><?= $rowH->paginaUrl;?>">Ver mas...</a></li>
		    </ul>
		    <? endforeach; ?>
		</ul>
	    <? endif;?>	
	  </li>
	  <? endforeach; ?>
	  <li class="me"><a title="Noticias de Plaza de la Tecnología" class="rama" href="<?=base_url()?>noticias">Noticias</a>
	  <li class="me"><a title="Videos de Plaza de la Tecnología" class="rama" href="<?=base_url()?>videoblog">Videoblog</a>
	  </li>
	</ul>
</nav>