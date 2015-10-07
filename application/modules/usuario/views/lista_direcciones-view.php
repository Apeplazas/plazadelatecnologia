<? $user  = $this->session->userdata('user');?>
<style>
	#listaDirs li{float: left;width: 200px;padding: 15px;font-size: .8em;}
	#listaDirs dl{font-weight: 700;text-transform: uppercase;}
	#nuevaDir{float: left;width: 100%;margin-left: 357px;font-size: .8em;color: cadetblue;text-decoration: underline;}
	#listaDirs dd a{color:#CC3300;}
</style>
<script type="text/javascript" charset="utf-8">
$(document).ready( function () {
  $('#inboxLocal').dataTable({
    "bSort": false,
    "iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
  });
  $( document ).tooltip();
});
</script>
<aside id="asideInb">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuUser');?>
	</ul>
</aside>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Lista de direcciones.</h3>
	<a id="nuevaDir" href="<?=base_url()?>usuario/nueva_dir">Agregar nueva dirección</a>
	<div id="inbWrap">
		<?= $this->session->flashdata('msg'); ?>
		<ul id="listaDirs">
		<? foreach($direcciones as $dirItem):?>
		<li>
			<dl><?=$dirItem->titulo?></dl>
			<dd>Calle: <?=$dirItem->direccion?></dd>
			<dd>Estado: <?=$dirItem->nombreEstado?></dd>
			<dd>Municipo/Del.: <?=$dirItem->nombreMunicipio?></dd>
			<dd>Colonia: <?=$dirItem->nombreColonia?></dd>
			<dd>C.P.: <?=$dirItem->codigoCP?></dd>
			<dd>Telefono:<?=$dirItem->telefono?></dd>
			<dd>Recibé: <?=$dirItem->recibe?></dd>
			<dd><a href="<?=base_url()?>usuario/eliminar_dir/<?=$dirItem->idSitio?>" title="Eliminar de la lista de direcciones">Eliminar</a>-<a href="<?=base_url()?>usuario/editar_dir/<?=$dirItem->idSitio?>" title="Editar Direccion">Editar</a></dd>
		</li>
		<? endforeach;?>
		</ul>
	</div>
</section>
<? $this->load->view('includes/forms/uploadAvatar');
