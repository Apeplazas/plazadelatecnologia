<? $user    = $this->session->userdata('user');?>
<? $op['info']   = array();
  
  if ($user['uid'] != '') {
   $tipo = 'info_'.$user['tipoUsuario'];
  }
?>
 <section id="contentCont">
<h1>Para nosotros siempre sera un placer atenderlo</h1>
<p>Confiando en darle la respuesta suficiente a su requerimiento, quedamos a su disposición para cualquier duda aclaración que consideren necesaria.</p>
<form method="post" action="<?=base_url()?>contacto/guardarContacto" name="contactoForm">
<fieldset>
  <input class="regIn required inMem" placeholder="Nombre" type="text" name="nombreContacto" value="">
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
	<select id="moCo" name="motivoContacto" class="selReg required valid inMem">
		<? if ($this->uri->segment(3) != ''):?>
		<option value="<?= $this->uri->segment(3);?>" checked ><?= $this->uri->segment(3);?></option>
		<? else:?>
		<option value="" checked >Motivo de Contacto</option>
		<? endif;?>
		<option value="Bolsa de trabajo">Bolsa de trabajo</option>
		<option value="Atencion a Clientes">Atención a Clientes</option>
		<option value="Tienda en linea">Tienda en Linea</option>
		<option value="Quejas o Sugerencias">Quejas o Sugerencias</option>
		<option value="Otros">Otros</option>
	</select>
</fieldset>
<fieldset>
  <textarea id="dirMem" name="comentarioContacto" placeholder="Escribe aquí tu pregunta o comentario" class="espInput required" value=""></textarea>
</fieldset>
<fieldset>
<input type="hidden" name="usuarioTipo" value="<? if ($user['tipoUsuario'] == ''):?>No Registrado<? else:?><?= $user['tipoUsuario'];?><? endif;?>"/>
<input id="regAho" class="nBotonBig" type="submit" value="Enviar comentario">
</fieldset>
<br class="clear">
</form>
</section>
<img style="float: left;padding: 32px 0 0 50px;" src="<?=base_url()?>assets/graphics/banner-contactoNegocios.jpg" title="Cotización PYMES"/>