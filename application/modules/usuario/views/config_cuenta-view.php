<? $user  = $this->session->userdata('user');?>
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
	<h3>Configurar Cuenta</h3>
	<div id="inbWrap">
		<?= $this->session->flashdata('msg'); ?>
		<form action="<?=base_url()?>usuario/updateInfo" method="post">
			<? foreach($ajustes as $ajusteItem):?>
			<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/usuariosFotos/'.$ajusteItem->imagenPersonalizada)):?>
			<img src="<?=base_url()?>usuariosFotos/thumbs/<?=$ajusteItem->imagenPersonalizada?>" />
			<a class="upAvatar" href="#banAvatar"><img src="<?=base_url()?>assets/graphics/cambiar_foto.png" /></a>
			<? else:?>
			<a class="upAvatar" href="#banAvatar"><img src="<?=base_url()?>assets/graphics/sinlogo.png" /></a>
			<? endif;?>
			<fieldset>
				<input class="regIn" type="text" name="nickname" placeholder="Nickname: <?=$ajusteItem->userAlias?>" value=""/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="name" placeholder="Nombre: <?=$ajusteItem->userName?>" value="" />
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="lastName" placeholder="Apellido(s): <?=$ajusteItem->lastName?>" value="" />
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="email" placeholder="Email: <?=$ajusteItem->email?>" readonly/>
			</fieldset>
			<? endforeach;?>
		<input class="nBotonBig" type="submit" value="Actualizar" />
		</form>
		<h4>Modificar Contraseña</h4>
		<form action="<?=base_url()?>usuario/updatePass" method="post">
			<? if($ajusteItem->contrasenia != ''):?>
			<fieldset>
				<input class="regIn" type="password" name="passwordNow" placeholder="Contraseña Actual" value=""/>
			</fieldset>
			<? endif;?>
			<fieldset>
				<input class="regIn" type="password" name="passwordNew" placeholder="Nueva Contraseña" value=""/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="password" name="passwordAgain" placeholder="Repetir Contraseña" value="" />
			</fieldset>
		<input class="nBotonBig" type="submit" value="Modificar" />
		</form>
	</div>
</section>
<? $this->load->view('includes/forms/uploadAvatar');
