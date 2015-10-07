<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '1536796426593649']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1536796426593649&amp;ev=PixelInitialized" /></noscript>
<?
$rama			= ucfirst($this->uri->segment(1));
$marca			= ucfirst($this->uri->segment(2));
$tematicaOpt	= ucfirst($this->uri->segment(3));
$cat			= ucfirst($this->uri->segment(4));
$cat1			= ucfirst($this->uri->segment(5));
$cat2			= ucfirst($this->uri->segment(6));
$cat3			= ucfirst($this->uri->segment(7));
$cat4			= ucfirst($this->uri->segment(8));
?>
<aside id="RamCatSub">
	<h3>Filtrar por:</h3>
	<ul id="filtro">
		<? if ($this->uri->segment(2) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/0/<?= $this->uri->segment(3);?>" title="Quitar filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(2)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(3) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/0" title="Quitar filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(3)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(4) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $this->uri->segment(3);?>" title="Quitar filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(4)));?></a></li>
		<? endif;?>
	</ul>
	<dl>
	  <dt>Marca</dt>
	    <? foreach($marcas as $marcaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?= $marcaRow->marcaUrl?>/<?=$this->uri->segment(3)?>" title="<?=$marcaRow->marca?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
	
	<? if ($this->uri->segment(2) == ''):?>
	<? foreach($opt as $rowOpt):?>
	<?= $rowOpt->divGoogleBox;?>
	<!--?= $rowOpt->DivGoogleSeg2;?-->
	<? endforeach;?>
	
	<? endif?>
	
	
	<dl>
		<dt>Categoria</dt>
		<? foreach($tematica as $rowTem):?>
		<dd><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $rowTem->tematicaUrl;?>" title="<?= $rowTem->tematicaNombre;?>"><?= $rowTem->tematicaNombre;?></a></dd>
		<? endforeach; ?>
	</dl>
	<? foreach($caracteristicas as $caractRow):?>
	<dl>
	  <dt><?=$caractRow->descripcion?></dt>
	  <? $subCat = $this->data_model->cargaSubCat( $this->uri->segment(1), $this->uri->segment(2),$caractRow->tipoID);?>
	  <? foreach($subCat as $rowSub):?>
	  <? if($this->uri->segment(4) != $rowSub->catUrl ):?>
	  <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<? if ($this->uri->segment(2) != '0'):?><?= $this->uri->segment(2)?><? else:?>0<? endif?>/<? if ($this->uri->segment(3) != '0'):?><?= $this->uri->segment(3)?><? else:?>0<? endif?>/<?= $rowSub->catUrl;?>" title="<?= $rowSub->descripcion;?>"><?= $rowSub->descripcion;?></a></dd>
	  <? else:?>
	  <dd><?= $rowSub->descripcion;?></dd>
	  <? endif?>
	  <? endforeach; ?>
	</dl>
	<? endforeach;?>
	<a id="brochureBanSma" title="Descarga nuestro brochure de ofertas" href="<?=base_url()?>folletos"><img class="100Pc" src="<?=base_url()?>assets/graphics/ofertasBrochureSmall.png" alt="Brochure de Ofertas"></a>
</aside>
<section id="busTotal" class="busqGenList">
<h1 class="ml10 ml20"><?if($this->uri->segment(1) == 'ofertas'){foreach($localInfo as $value){echo 'Ofertas de '.$value->name;}}elseif($this->uri->segment(2) == 'busqueda_rapida'){echo 'Resultado de busqueda';}?></h1>
<div id="busqExtra">
	<h1><?= $this->uri->segment(1);?> <? if ($marca != '0'):?><?=$marca?><?endif;?> <? if (isset($tematicaOpt)):?><?= str_replace('_',' ', $tematicaOpt)?><?endif;?> <? if (isset($cat)):?><?= str_replace('_',' ', $cat)?><?endif;?> al mejor precio.</h1>	
</div>
<? foreach($opt as $rowOpt):?>
<p class="desOpt">Compra en linea <?= $this->uri->segment(1);?> <?= $rowOpt->metaTitle;?></p>
<? endforeach; ?>
<span id="cantBus"><?=count($productos)?> RESULTADOS ENCONTRADOS</span>
<ul id="listChange" class="box" title="">
  <? foreach($productosPagados as $listaPag):?>
  <? $masComision 		= $listaPag->ofertaPrecio + ($listaPag->ofertaPrecio * $listaPag->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPag->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
	<li class="box noPag" itemscope itemtype="http://schema.org/Product">
	<div class="iconSponsored"><img src="<?=base_url()?>assets/graphics/destacados.png" alt="Articulos Destacados" /></div>
	  <a href="<?=base_url()?><?=strtolower($listaPag->rama)?>/oferta/<?=url_title(trim($listaPag->ofertaTitulo), '_')?>/<?=$listaPag->ofertaID?>" title="<?= $listaPag->ofertaTitulo?>">
  	  <? if ($listaPag->descuentoPorcentaje > '0'):?><b class="tagDisc"><?= $listaPag->descuentoPorcentaje;?>%</b><? endif?>
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPag->ofertaImagen))):?>
	    	<img itemprop="image" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPag->ofertaImagen)?>" alt="<?= $listaPag->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	  <strong itemprop="brand"><?= $listaPag->marca?></strong>
	  <p itemprop="name"><?= $listaPag->ofertaTitulo?> </p>
	  <? if ($listaPag->descuentoPorcentaje > '0'):?><b class="tachadoPag">$ <?= number_format($listaPag->precioLocal + $listaPag->gananciaPt + $listaPag->costoEnvio);?></b><? endif?>
	  <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	  <em itemprop="price">$ <?= number_format($listaPag->ofertaPrecio)?></em></div>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas" itemprop="url">ver mas...</button>
	  </a>
	  <? if ($listaPag->promoBuenFin > '0'):?><b class="tagBuenFin"></b><? endif?>
	</li>
  <? endforeach;?>
  
  <? foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100 ?><!--Comisión actual de 8%-->
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li class="noPag" itemscope itemtype="http://schema.org/Product">
  	  <a href="<?=base_url()?><?=strtolower($listaPro->rama)?>/oferta/<?=url_title(trim($listaPro->ofertaTitulo), '_')?>/<?=$listaPro->ofertaID?>" title="<?= $listaPro->ofertaTitulo?>">
  	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tagDisc"><?= $listaPro->descuentoPorcentaje;?>%</b><? endif?>
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPro->ofertaImagen))):?>
	    	<img itemprop="image" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPro->ofertaImagen)?>" alt="<?= $listaPro->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	  <strong itemprop="brand"><?= $listaPro->marca?></strong>
	  <p itemprop="name"><?= $listaPro->ofertaTitulo?> </p>
	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tachado">$ <?= number_format($listaPro->precioLocal + $listaPro->gananciaPt + $listaPro->costoEnvio);?></b><? endif?>
	  
	  <div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><em itemprop="price">$ <?= number_format($listaPro->ofertaPrecio)?></em></div>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas" itemprop="url">ver mas...</button>
	  </a>
	  <? if ($listaPro->promoBuenFin > '0'):?><b class="tagBuenFin"></b><? endif?>
  </li>
  <? endforeach;?>
</ul>
</section>
<script type="text/javascript">mixpanel.track("<?=$this->uri->segment(1);?> Funnel");</script>

<!-- Begin Inspectlet Embed Code -->
<script type="text/javascript" id="inspectletjs">
window.__insp = window.__insp || [];
__insp.push(['wid', 1947585724]);
(function() {
function __ldinsp(){var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); }
if (window.attachEvent) window.attachEvent('onload', __ldinsp);
else window.addEventListener('load', __ldinsp, false);
})();
</script>
<!-- End Inspectlet Embed Code -->

<!-- twitter -->
<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">twttr.conversion.trackPid('l6f1p', { tw_sale_amount: 0, tw_order_quantity: 0 });</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l6f1p&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l6f1p&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
</noscript>
