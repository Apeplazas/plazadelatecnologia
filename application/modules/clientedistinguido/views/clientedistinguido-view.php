<? $user    = $this->session->userdata('user');?>
<? $op['info']   = array();
  
  if ($user['uid'] != '') {
   $tipo = 'info_'.$user['tipoUsuario'];
  }
?>
<section id="dis" >
<div id="wrapDis">
	<div id="contentContDis">
	
	<span><img src="<?=base_url()?>assets/graphics/clientedistinguido-b.png" alt="El Socio de tu negocio" /></span>
	<p>Compra a precio de mayorista mientras acumulas puntos y recibe trato preferencial</p>
	<form method="post" action="<?=base_url()?>clientedistinguido/guardarContacto" name="contactoForm">
	<fieldset>
	  <input class="regIn required inMem" placeholder="Nombre" type="text" name="nombreContacto" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required inMem" type="text" name="empresa" placeholder="Compañia o Empresa" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required inMem" type="text" name="emailContacto" placeholder="Correo electronico Ejemplo: email@gmail.com" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required inMem" type="text" name="telefonoContacto" placeholder="Telefono" value="">
	</fieldset>
	<fieldset>
	   <select id="estado" name="estadoContacto" class="selReg required valid">
	   	 <option value="">Estado</option>
	   	 <? foreach($ciudades as $row):?>
	     <option value="<?= $row->sucursalCiudad;?>"><?= $row->sucursalCiudad;?></option>
	     <? endforeach; ?>   
	   </select>
	</fieldset>
	<fieldset>
	  <textarea id="dirMem" name="comentarioContacto" placeholder="Escribe aquí tu pregunta o comentario" class="espInput required" value=""></textarea>
	</fieldset>
	<fieldset>
	<input type="hidden" name="usuarioTipo" value="<? if ($user['tipoUsuario'] == ''):?>No Registrado<? else:?><?= $user['tipoUsuario'];?><? endif;?>"/>
	<input id="regAho" class="nBotonBig" type="submit" value="Enviar registro">
	</fieldset>
	<br class="clear">
	</form>
	</div>
</div>
</section>