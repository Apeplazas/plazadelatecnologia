<? $user    = $this->session->userdata('user');?>
<? $op['info']   = array();
  
  if ($user['uid'] != '') {
   $tipo = 'info_'.$user['tipoUsuario'];
  }
?>
 <section id="contentCont">
<h1>Para nosotros siempre sera un placer atenderlo</h1>
<p>Nuestra política de devolución es muy sencilla. Podrás devolver cualquier artículo comprado en plazadelatecnologia.com por las siguientes causas:</p>
<ul>
	<li>1.- Si el artículo presenta defectos de fabricación.</li>
	<li>2.- Si existe equivocación en el artículo enviado, conservando la envoltura original de celofán (emplaye) y sin presentar muestras de maltrato.</li>
</ul>
<br>
<p>En la recepción de mercancía errónea o dañada se aplicará el cambio físico de la misma solo si ésta fue reportada durante las primeras 72 horas posteriores a su entrega, a los siguientes teléfonos:</p>
<form method="post" action="<?=base_url()?>contacto/guardarDevolucion" name="contactoForm">
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
   <select id="estado" name="motivo" class="selReg required valid">
   	 <option value="">Motivo de devolución</option>
   	 <option value="Defecto">Defecto</option>
   	 <option value="Error en pedido">Error en pedído</option>
   	 <option value="Error en envio">Error en envio</option>
   	 <option value="Recibi producto incorrecto"></option>
   </select>
</fieldset>
<fieldset>
  <textarea id="dirMem" name="comentarioContacto" placeholder="Con mas detalle explique el motivo de su devolución" class="espInput required" value=""></textarea>
</fieldset>
<fieldset>
<input type="hidden" name="usuarioTipo" value="<? if ($user['tipoUsuario'] == ''):?>No Registrado<? else:?><?= $user['tipoUsuario'];?><? endif;?>"/>
<input id="regAho" class="nBotonBig" type="submit" value="Enviar Información">
</fieldset>
<br class="clear">
</form>
</section>