<? foreach($info as $rowInfo):?>
<aside  id="asideMil">
  <ul>
  <? $this->load->view('includes/menus/menuUser');?>
  </ul>
</aside>
<section id="milocalPanel">
<? foreach($mensaje as $rowMen):?>
<h3>Mensaje de <?= $rowMen->userAlias;?></h3>
<div id="msgMilocal">
	<div id="inbWrap">
		<div id="mensajeHead">
			<ul id="herInbox">
			  <li><a id="inboxReg" href="<?=base_url()?>usuario"><img src="<?=base_url()?>assets/graphics/regresarInbox.png" alt="Regresa a inbox" /> Regresar a Inbox</a></li>
			</ul>
		  <p class="msgInbMes"><b>De:</b> <em><?= $rowMen->userName;?> </em> <i>( <?= $rowMen->email;?> )</i> <strong class="inbHor"><?= convierteFechaBDLetra($rowMen->contactoFecha,2)?> | <?= $rowMen->contactoHora;?></strong></p>
		  <p class="msgInbMes"><b>Para:</b> <em><?= $rowInfo->name;?></em></p>
		  
		  <? if ($rowMen->contactoTipo == 'oferta'):?><p class="msgInbMes"><b>Asunto:</b><em>Pregunta de oferta | <?= strtolower($rowMen->ofertaTitulo);?></em> <a class="oferSty" target="_blank" href="<?=base_url()?><?= strtolower($rowMen->ramaNombre);?>/<?= url_title($rowMen->ofertaTitulo, '_');?>/<?= $rowMen->ofertaID;?>">Ver oferta</a></p><? endif;?>
		</div>
		<div class="menInb">
		<? if ($rowMen->contactoTipo == 'oferta'):?>
			<div class="ofeInbMue">
			  <h5> Solicitaste información de la Oferta. </h5>
			  <span><img src="<?=base_url()?>ofertasLocatarios/<?= $rowMen->ofertaImagen;?>" alt="<?= $rowMen->ofertaTitulo;?>" /></span>
			  <strong><?= strtolower($rowMen->ofertaTitulo);?></strong>
			  <p>Precio: <em>$ <?= $rowMen->ofertaPrecio;?></em></p>
			  <!-- <a href="<?=base_url()?>" target="_blank" ><img src="<?=base_url()?>assets/graphics/vermasIcon.png" alt="ver mas" /> ver mas</a> -->
			</div>
		 <? endif;?>
			<p>Tu pregunta fue: <?= nl2br($rowMen->contactoComentario);?></p>
		</div>
		<? $contestaciones = $this->usuario_model->cargarContestaciones($rowMen->contactoID);?>
		<? foreach($contestaciones as $rowCont):?>
		<div<? if ($rowCont->usuarioTipo == 'usuario'):?> class="locCont" <? else:?> class="contestacion" <?endif;?>>
			<span>
			<em><?= convierteFechaBDLetra($rowMen->contactoFecha,2)?> | <?= $rowCont->contactoHora;?></em>
			<i><img src="<?=base_url()?>assets/graphics/user.png" alt="<?=$rowCont->localNombre;?>" /></i>
			<p><?= nl2br($rowCont->contactoComentario);?></p>
			</span>
		</div>
		<? endforeach; ?>
		<? if ($rowMen->contactoTipo != 'compra'):?>
		<form action="<?=base_url()?>usuario/responder" method="post">
		<fieldset id="resp">
			<label>Responder a <?= $rowMen->userName;?> </label>
			<textarea name="responder" placeholder="">Escribe aquí tu respuesta...</textarea>
		</fieldset>
		<fieldset>
			<input type="hidden" name="mensajeID" value="<?= $this->uri->segment(3);?>"/>
			<input type="hidden" name="contactoTipo" value="<?= $rowMen->contactoTipo;?>" />
			<input type="hidden" name="ofertaID" value="<?= $rowMen->ofertaID;?>" />
			<input type="hidden" name="xls" value="<?= $rowMen->usuarioIDRecibe;?>" />
			<input type="hidden" name="email" value="<?= $rowMen->email;?>" />
			<input type="hidden" name="ofertaTit" value="<?= $rowMen->ofertaTitulo;?>" />
			<input type="hidden" name="name" value="<?= $rowMen->userName;?> | <? if($rowMen->userAlias == ''):?><?= $rowMen->userName;?> <?= $rowMen->lastName;?><? else:?><?= $rowMen->userAlias;?><? endif;?>" />
		</fieldset>
		<input class="nBotonBigRig mtb10" type="submit" value="Enviar comentario" />
		</form>
		<? else:?>
		<a class="narBotonBig mtb10" href="<?=base_url()?>mi_local/infoVendido/<?= $rowMen->ofertaID;?>/<?= $rowMen->usuarioIDRecibe;?>" title="Confirmar pedido">Confirmar pedido a usuario</a>
		<? endif;?>
	</div>
</div>
<? endforeach; ?>
<? endforeach; ?>
</section>