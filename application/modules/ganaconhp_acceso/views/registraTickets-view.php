<? $errorNumero = form_error('txtboxToFilter'); ?>
<? $errorFecha 	= form_error('fechaVneta'); ?>
<? $totVe		= form_error('totVe'); ?>
<section id="hp" >
	<div id="headHp">
	<span id="add"><img src="<?=base_url()?>assets/graphics/ganavendiendoproductoshp.png" alt="Gana vendiendo productos HP en Plaza de la tecnologia" /></span>
	</div>
	<? $this->load->view('includes/dinamicas/menuHP_ganaconhp');?>
	
	<div id="wrapHD">
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
	$(function() {  
		$('#datepicker').datepicker({
		inline:false,
		'dateFormat': 'yy/mm/dd',
		});
	});
	</script>
	
	<form id="addTicket" method="post" action="<?=base_url()?>ganaconhp_acceso/agregarTicket" enctype="multipart/form-data">
		<fieldset id="cam" class="mt5">
			<div class="containerS_two">
			  <span class="select-wrapper-two">
			    <input type="file" name="imagen" id="image_src_two">
			  </span>
			</div>
			<i id="addFot">Agregar fotografia del ticket</i>
		</fieldset>
			<div id="contForm">
			<fieldset class="mt5">
				<?= $errorNumero; ?>
				<label class="tic">Numero de ticket</label>
				<input id="txtboxToFilter" class="tick inD" type="text" class="inS" name="txtboxToFilter" />
				<i id="dig">Solo se aceptan numeros</i>
			</fieldset>
			<fieldset class="mt5">
				<?= $errorFecha; ?>
				<label class="fec">Fecha de Venta</label>
				<input type="text" id="datepicker" class="inD" name="fechaVneta" />
			</fieldset>
			<fieldset class="mt5">
				<?= $totVe; ?>
				<label>Cantidad de Articulos:</label>
				<input id="totVe" name="totVe" type="text" class="inD" />
			</fieldset>
			<fieldset>
				<input type="submit" id="enviarHpTicket" />
			</fieldset>
			</div>
	</form>
	
		
		
	</div>
</section>
<script type="text/javascript">      
	
	$(document).ready(function () {          
		$.extend($.fn.autoNumeric.defaults, {              
			aSep: '.',              
			aDec: ','          
		});      
	});  

</script>