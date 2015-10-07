<? foreach($info as $rowInfo):?>
<? foreach($infoUsuario as $row):?>
<aside  id="asideMil">
  <ul class="pFix">
  <? $this->load->view('includes/menus/menuLocal');?>
  </ul>
</aside>
<section id="milocalPanel">
<h3>Mensaje de <?= $rowInfo->localNombre;?></h3>
<div id="msgMilocal">
	<div id="inbWrap">
		<form id="mensajeHead" method="post" action="<?=base_url()?>mi_local/enviarMensajeCompra/<?= $this->uri->segment(3);?>/<?= $this->uri->segment(4);?>"> 
			<ul id="herInbox">
			  <li><a id="inboxReg" href="<?=base_url()?>mi_local"><img src="<?=base_url()?>assets/graphics/regresarInbox.png" alt="Regresa a inbox" /> Regresar a Inbox</a></li>
			</ul>
		  <p class="msgInbMes"><b>De:</b> <em><?= $rowInfo->localNombre;?></em> <i>( <?= $rowInfo->email;?> )</i> 
		  <strong class="inbHor"><?= convierteFechaBDLetra(date("Y-m-d"),2);?></strong>
		  </p>
		  <p class="msgInbMes"><b>Para:</b> <em><?= ucfirst($row->name);?> ( <?= $row->email;?> )</em></p>
		  <textarea id="envCom" name="mensaje" placeholder="Escribe tu comentario"></textarea>
		  <input type="submit" class="nBotonBigRig mtb10" value="Enviar comentario"/>
		</form>
	</div>
</div>
<? endforeach; ?>
<? endforeach; ?>
</section>