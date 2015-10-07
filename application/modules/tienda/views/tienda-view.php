<? foreach($tienda as $localInfo):?>

<aside id="tienda">
<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/localesLogos/'.$localInfo->avatar)):?>
  <figure>
  	<img src="<?=base_url()?>localesLogos/<?=$localInfo->avatar?>" alt="<?=$localInfo->name?>">
  </figure>
<? endif;?>
	<ul>
		<? if($this->uri->segment(1) == 'ofertas'):?><li><a alt="Tienda de <?=$localInfo->name?>" class="log" href="<?=base_url()?>tienda/<?=$localInfo->localUrl?>/<?=$localInfo->id?>">Tienda de <?=$localInfo->name?></a></li><? endif;?>
		<li class="regLi"><a title="Contantanos" class="log" href="#contactanos"><img src="http://www.plazadelatecnologia.com/assets/graphics/Inbox.png" alt="Inbox"> Contáctanos</a></li>
		<li class="regLi"><a title="Checa todas las ofertas" href="<?=base_url()?><?=$localInfo->localUrl?>/ofertas"><img src="http://www.plazadelatecnologia.com/assets/graphics/alertIcon.png" alt="Confirmación de Ventas"> Ofertas</a></li>
	</ul>
	<? if($localInfo->bannerIzq != ''):?>
	<div id="promoTienda">
	<? if ($localInfo->bannerIzq != '3640787d8add083a0a1070e9cdfce6fb.png'):?>
			<img src="<?=base_url()?>assets/graphics/bannersPromocionales/<?=$localInfo->bannerIzq?>" alt="Anuncios de <?=$localInfo->name?>"/>
	<? endif;?>
	</div>
	<? endif;?>
</aside>
<section id="miTienda">
<? if($localInfo->bannerCabecera != ''):?>
	<? if ($localInfo->bannerCabecera != '34bbe01f2fa79ce133d6c8d5bd66f09b.png' ):?>
	<div id="banMitienda">
	<img src="<?=base_url()?>assets/graphics/bannersPromocionales/thumbs/<?=$localInfo->bannerCabecera?>" alt="Tienda  <?=$localInfo->name?>" />
	</div>
	<? endif;?>
<? endif;?>
<? if($this->uri->segment(2) != 'ofertas'):?>
<h1>Tienda <?=$localInfo->name?></h1>
<p><?=$localInfo->descripcion?></p>
<? if($destacados):?>
	<h3>Productos destacados de <?=$localInfo->name?></h3>
	<div id="proVenTie">
	<ul id="listChange" class=" box">
	 <? foreach($destacados as $rowDestaca):?>
	  <? $masComision 		= $rowDestaca->ofertaPrecio + ($rowDestaca->ofertaPrecio * $rowDestaca->comision)/100?>
  	  <? $masComisionMes 	= $masComision + ($masComision * $rowDestaca->meses)/100?>
  	  <? $meses				= $masComisionMes/12;?>
  	 <li class="noPag">
	  <a href="<?=base_url()?><?=strtolower($rowDestaca->rama)?>/oferta/<?=url_title(trim($rowDestaca->ofertaTitulo), '_')?>/<?=$rowDestaca->ofertaID?>" title="<?= $rowDestaca->ofertaTitulo?>">
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.$rowDestaca->ofertaImagen)):?>
	    	<img style="max-width:145px; max-height:120px;" src="<?=base_url()?>ofertasLocatarios/<?= $rowDestaca->ofertaImagen?>" alt="<?= $rowDestaca->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	   <strong><?= $rowDestaca->marca?></strong>
	  <p><?= $rowDestaca->ofertaTitulo?> </p>
	  <em>$ <?=$rowDestaca->ofertaPrecio?></em>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas">ver mas...</button>
	  </a>
  	</li>
	<? endforeach;?>
	</ul>
	</div>
<? endif;?>
<? endif;?>
	<div id="busTotal" class="busqGenListTwo">
<? if($productos && $this->uri->segment(2) == 'ofertas'):?>		
<h1 class="ml10">Ofertas de <?=$localInfo->name?></h1>
<div id="busqExtra">
<form method="post" id="orderBy" action="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>" >
	<label>Mostrar</label>
	<select name="selectRama" onchange="this.form.submit()">
		<option value="todo">Todo</option>
	<? foreach($ramasLocal as $ramaRow):?>
		<option value="<?= $ramaRow->ramaID;?>" <? if($ramaRow->ramaID == $ramaID):?> selected<? endif?>><?=$ramaRow->rama;?></option>
	<? endforeach;?>
	</select>
</form>
<span id="listType">
	<em>Tipo de Lista: </em>
	<button id="box" class="actBox">Cubo</button>
	<button id="wide" class="inactWide">Lista</button>
</span>
</div>
<span id="cantBus"><?= count($productos)?> ITEMS ENCONTRADOS</span>
<ul id="listChange" class=" box">
<? foreach($productos as $roWproducto):?>
  <? $masComision 		= $roWproducto->ofertaPrecio + ($roWproducto->ofertaPrecio * $roWproducto->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $roWproducto->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li class="noPag">
	  <a href="<?=base_url()?><?=strtolower($roWproducto->rama)?>/oferta/<?=url_title(trim($roWproducto->ofertaTitulo), '_')?>/<?=$roWproducto->ofertaID?>" title="<?= $roWproducto->ofertaTitulo?>">
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.$roWproducto->ofertaImagen)):?>
	    	<img style="max-width:145px; max-height:120px;" src="<?=base_url()?>ofertasLocatarios/<?= $roWproducto->ofertaImagen?>" alt="<?= $roWproducto->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	   <strong><?= $roWproducto->marca?></strong>
	  <p><?= $roWproducto->ofertaTitulo?> </p>
	  <em>$ <?=$roWproducto->ofertaPrecio?></em>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas">ver mas...</button>
	  </a>
  </li>
<? endforeach;?>
</ul>
<? endif;?>
	</div>
</section>
<div id="contactanos" style="display:none">
	<h3>Contacta a <?=$localInfo->name?></h3>
	<ul>
		<li><strong>Teléfono(s):</strong> <em><?=$localInfo->telefono?></em></li>
		<li><strong>Email:</strong> <em><?= $localInfo->email?></em></li>
		<li><strong>Sucursal:</strong> <em>Plaza de la Tecnología <?=$localInfo->sucursal?></em></li>
		<li><strong>Planta:</strong> <em><?=$localInfo->planta?></em></li>
		<li><strong>Local(es):</strong> <em><?=$localInfo->numero?></em></li>
	</ul>
	<? $user = $this->session->userdata('user');?>
	<? if($user['uid'] != ''):?>
	<form id="muroInteraccion"  class="answer border formLocal hideForm" action="<?=base_url()?>inicio/contactoLocal" method="post">
	<textarea id="pregComm" name="comentario" placeholder=" Pregunta y cotiza en nuestra comunidad aqui..."></textarea>
	<input type="hidden" value="<?=$localInfo->id?>" name="localID"/>
	<input type="hidden" value="<?=$localInfo->email?>" name="localEmail"/>
	<input type="hidden" value="<?=$localInfo->name?>" name="localNombre"/>
	<input type="hidden" value="<?=$this->uri->segment(1)?>" name="url"/>
	<br />
	<input type="submit"  id="submit" class="nBotonBig ml10 mt10" value="Enviar pregunta o comentario" />
	</form>
	<? endif;?>
</div>
<? endforeach;?>
<div style="display:none">
<?= $this->load->view('includes/forms/preguntasycomentarios');?>
</div>