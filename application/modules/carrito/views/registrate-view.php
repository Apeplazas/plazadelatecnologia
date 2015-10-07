<div id="contentRegTwo">
<section>
	<h1>Registrate con nosotros</h1>
	<p>Forma parte de nuestra comunidad, comparte y obtén los mejores descuentos tips y consejos, aparte podras estar actualizado en cuanto a los ultimos productos en computo, telefonia y reparación a los mejores precios.</p>
	<!-- En espera
	<a id="conFac" title="Registrate con facebook" href="<?=base_url()?>registrate"><img src="<?=base_url()?>assets/graphics/conectate.png" alt="Registrate con facebook" /></a>-->
	
	<form method="post" action="<?=base_url()?>carrito/guardarRegistro">
	<strong>Registrate aquí proporcionandonos tu información</strong>
	<?= $this->session->flashdata('msg'); ?>
	<fieldset>
	  <input class="regIn required" type="text" name="nickname" placeholder="Nickname *" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required" type="text" name="nombre" placeholder="Nombre *" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required" type="text" name="apellido" placeholder="Apellido *" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required email idleField" type="text" placeholder="Email *" name="email" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required" placeholder="Contraseña" minlength="6" type="password" name="password" value="" id="password">
	</fieldset>
	<fieldset>
	  <input placeholder="Repite la Contraseña" class="regIn required" minlength="6" type="password" name="password_again" data-equals="contrasenia" id="password_again">
	</fieldset>
	<fieldset>
	   <select name="state" class="selReg select required valid">
	   	 <option value="">Elige un estado</option>
	   	 <? foreach($estados as $estado):?>
	     <option value="<?=$estado->idEstado?>"><?=$estado->nombreEstado?></option>
	    <? endforeach;?>
	   </select>
	</fieldset>
	<fieldset>
	   <select name="gender" class="selReg select required valid">
	   	 <option value="">Tu Genero</option>
	     <option value="Masculino">Masculino</option>
	     <option value="Femenino">Femenino</option>
	   </select>
	</fieldset>
	<fieldset>
	   <select name="dia" class="regDate required valid">
	   		<option value="0">Fecha de nacimiento</option>
	   		<? for ($i=1; $i <= 31 ; $i++):?>
			<option value="<?=$i?>"><?=$i?></option>	   
			<? endfor;?>
	   </select>
	   <select name="mes" class="regMes required valid">
	   	<option value="00">Mes</option>
	   	<option value="01">Enero</option>
	   	<option value="02">Febrero</option>
	   	<option value="03">Marzo</option>
	   	<option value="04">Abril</option>
	   	<option value="05">Mayo</option>
	   	<option value="06">Junio</option>
	   	<option value="07">Julio</option>
	   	<option value="08">Agosto</option>
	   	<option value="09">Septiembre</option>
	   	<option value="10">Octubre</option>
	   	<option value="11">Noviembre</option>
	   	<option value="12">Diciembre</option>
	   </select>
	   <select name="anio" class="regAnio required valid">
	   	<option value="0">Año</option>
	   	<? for ($i=1920; $i <= 2013; $i++):?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? endfor;?>	
	    </select>
	</fieldset>
	<fieldset>
	<p class="aviso"><input name="privacidad" checked type="checkbox" value="Leido">
	He leido el <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">aviso de privacidad</a></p>
	</fieldset>
	<fieldset>
	  <input class="nBotonBig fwlight" type="submit" value="Enviar Información">
	</fieldset>
	</form>
</section>
<aside>
	<h2>Acceso a usuarios</h2>
	<p>Si ya tienes un email y contraseña registrada accesa en el siguiente formulario.</p>
	<em>Es un placer atenderte</em>
	<form action="<?=base_url()?>registrate/accesoDinamico" method="post" >
	<fieldset>
		<input name="email" class="regIn" type="text" placeholder="Escribe tu email" />
	</fieldset>
	<fieldset>
		<input name="contrasenia" class="regIn" type="password" placeholder="Contraseña" />
		<input name="url" type="hidden" value="carrito" />
	</fieldset>
	<fieldset>
		<input type="submit" class="nBotonBig fwlight" value="Entrar" />
	</fieldset>
	</form>
</aside>
</div>