<div id="contentReg">
<section>
	<h1>Solicita tu traspaso.</h1>
	<p>Este traspaso sera procesado para el dia viernes.</p>	
	<form id="traspaso" method="post" action="<?=base_url()?>mi_local/traspaso">
	<strong>Para cualquier duda o información que necesites no dudes en contactarnos.</strong>
	<?= $this->session->flashdata('msg'); ?>
	<table cellpadding="5" cellspacing="0" id="inboxLocal" style="float: left; margin-right: 100px;">
	  	<thead>
			<tr>
			  <th>Folio</th>
			  <th></th>
	          <th>Venta</th>
	        </tr>
		</thead>
	    <tbody id="det">
	    	<? $totalSolicitar = 0;?>
	    	<? foreach($producto as $rowP):?>
	    	<? $totalSolicitar += $rowP->totalSinComision;?>
		    <tr>
		      <td><?= $rowP->folio;?></td>
		      <td></td>
		      <td>$ <?=  number_format($rowP->totalSinComision);?></td>
		    </tr>
	      	<? endforeach; ?>
	      	<tr>
	      		<td>Saldo que solicitas:</td>
	      		<td></td>
	      		<td>$ <?= number_format($totalSolicitar)?></td>
	      	</tr>  
	    </tbody>
		</table>
	<fieldset>
	<?= form_error('nombre'); ?>
	  <input class="regIn required" type="text" name="nombre" placeholder="Nombre del solicitante*" value="">
	</fieldset>
	<fieldset>
	<?= form_error('nombreCuenta'); ?>
	  <input class="regIn required" type="text" name="nombreCuenta" placeholder="Nombre del titular de la cuenta bancaria*" value="">
	</fieldset>
	<fieldset>
	<?= form_error('banco'); ?>
	  <input class="regIn required" type="text" name="banco" placeholder="Nombre del banco al que quiere transferir*" value="">
	</fieldset>
	<fieldset>
	  <?= form_error('numeroCuenta'); ?>
	  <input class="regIn required" type="text" name="numeroCuenta" placeholder="# Numero de cuenta*" value="">
	</fieldset>
	<fieldset>
	  <?= form_error('clabe'); ?>
	  <input class="regIn required" type="text" name="clabe" placeholder="# Clabe bancaria*" value="">
	</fieldset>
	<fieldset>
	  <?= form_error('email'); ?>
	  <input class="regIn required email idleField" type="text" placeholder="Email del solicitante*" name="email" value="">
	</fieldset>
	<fieldset>
	<?= form_error('privacidad'); ?>
	<p class="aviso"><input name="privacidad" checked type="checkbox" value="Leido">
	He leido los <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">Terminos y Condiciones</a></p>
	</fieldset>
	<fieldset>
	  <input class="narBotonBla ml10 mt10 fwlight" type="submit" value="Finalizar traspaso">
	</fieldset>
	</form>
	
</section>
</div>