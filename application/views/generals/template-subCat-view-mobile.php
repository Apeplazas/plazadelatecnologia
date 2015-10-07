<div class="tabs"> <a href="#" class="active">Productos</a> <a href="#" style="margin:0 17px">Filtros</a> <a href="#">Menu</a></div>
<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<div class="content-slide">
			<section id="busTotal" class="busqGenList">
			<ul id="listChange" class=" box" title="">
			  <? foreach($productos as $listaPro):?>
			  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
			  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
			  <? $meses				= $masComisionMes/12;?>
			  <li>
			  	<a href="<?=base_url()?><?=strtolower($listaPro->rama)?>/oferta/<?=url_title(trim($listaPro->ofertaTitulo), '_')?>/<?=$listaPro->ofertaID?>">
			  	<p class="title"><?= word_limiter($listaPro->ofertaTitulo,6) ?> </p>
				  <span>
				    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPro->ofertaImagen))):?>
				    	<img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPro->ofertaImagen)?>" title="<?= $listaPro->ofertaTitulo?>" />
				    	<? else:?>
				    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
				    	<? endif;?>
				  </span>
				  
				  <p><strong>Marca:</strong> <em><?= $listaPro->marca?></em></p>
				  <? if ($listaPro->descuentoPorcentaje > '0'):?><strong>Descuento </strong><em><?= $listaPro->descuentoPorcentaje;?>%</em><? endif?>
				  <p><strong>12 pagos de</strong> $ <?= number_format($meses, 2)?></p>
				  <p><? if ($listaPro->descuentoPorcentaje > '0'):?><em class="tachado">$ <?= number_format($listaPro->precioLocal + $listaPro->gananciaPt + $listaPro->costoEnvio);?></em><? endif?> <em class="precio">$ <?= number_format($listaPro->ofertaPrecio)?></em></p>
				  
				  
				  </a>
			  </li>
			  <? endforeach;?>
			</ul>
			</section>
            </div>
		</div>
		<div class="swiper-slide">
			<div class="content-slide">
	         <aside id="RamCatSub">
				<dl>
				  <dt>Marca</dt>
				    <? foreach($marcas as $marcaRow):?>
				    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?= $marcaRow->marcaUrl?>/<?=$this->uri->segment(3)?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
				    <? endforeach;?>
				</dl>
				<dl>
					<dt>Categoria</dt>
					<? foreach($tematica as $rowTem):?>
					<dd><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<? if($this->uri->segment(2) != ''){ echo $this->uri->segment(2); }else{ echo '0';} ?>/<?= $rowTem->tematicaUrl;?>"><?= $rowTem->tematicaNombre;?></a></dd>
					<? endforeach; ?>
				</dl>
				<? foreach($caracteristicas as $caractRow):?>
				<dl>
				  <dt><?=$caractRow->descripcion?></dt>
				  <? $subCat = $this->data_model->cargaSubCat( $this->uri->segment(1), $this->uri->segment(2),$caractRow->tipoID);?>
				  <? foreach($subCat as $rowSub):?>
				  <? if($this->uri->segment(4) != $rowSub->catUrl ):?>
				  <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<? if ($this->uri->segment(2) != '0'):?><?= $this->uri->segment(2)?><? else:?>0<? endif?>/<? if ($this->uri->segment(3) != '0'):?><?= $this->uri->segment(3)?><? else:?>0<? endif?>/<?= $rowSub->catUrl;?>"><?= $rowSub->descripcion;?></a></dd>
				  <? else:?>
				  <dd><?= $rowSub->descripcion;?></dd>
				  <? endif?>
				  <? endforeach; ?>
				</dl>
				<? endforeach;?>
			</aside>
	        </div>
		</div>
		<div class="swiper-slide">
			<div class="content-slide"><? $this->load->view('includes/menus/navMobile');?></div>
		</div>
	</div>
</div>


