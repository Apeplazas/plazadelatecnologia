<? $usuario		= $this->session->userdata('usuarioHP');?>
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
	<div id="wrapText">
			<strong>Conoce el proceso después de darse de alta en el micrositio y haber registrado los primeros tickets:</strong>
			<ul>
				<li>• Visita del Promotor. Los locales del giro de impresión registrados por plaza recibirán la visita del promotor, en la cual se les explicará en qué consiste el nuevo programa y confirmar su participación.</li>
				<li>• Entrega de POP (Stoppers - Bolsas-Globos). Se entregará material POP a los locales participantes que hayan registrado al menos un ticket. Es responsabilidad del locatario mantener los tickets en buen estado.</li>
				<li>• Visita semanal del promotor. Con esto se apoyará al locatario con las dudas o cuestionamientos en el registro de tickets.  El promotor tomará fotos de locales, de los tickets físicos y entregará y verificará el estado de los materiales POP. </li>
				<li>• Conteo del monto de los tickets registrados.  En el mes de marzo se realizará el conteo. Se informará a los ganadores vía mail y con una visita del promotor.</li>
			</ul>

			</div>
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
	<div id="tableTicket">
	<span id="head">
	<strong>Tús tickets regístrados</strong>
	</span>
	<? if($tickets):?>
	<table id="tab" class="display" border="0" cellspacing="0" width="100%">
		<thead>
	            <tr>
	                <th># Ticket</th>
	                <th>Fecha de venta</th>
	                <th>Artículos Vendidos</th>
	            </tr>
	        </thead>
	 
	        <tbody>
		        
		        <? foreach($tickets as $b):?>
	            <tr>
	                <td><a class="titSt" href="<?=base_url()?>ganaconhp_acceso/vistaTicket/<?= $b->ticketID;?>"><?= $b->ticketNumero;?></a></td>
	                <td><a href="<?=base_url()?>ganaconhp_acceso/vistaTicket/<?= $b->ticketID;?>" class="admDes"><?= $b->fechaVenta;?></a></td>
	                <? $var = $this->hp_model->sumaCantidadProductosTicket($usuario['localID'], $b->ticketID); ?>
	                <? foreach($var as $r):?>
	                <td><a href="<?=base_url()?>ganaconhp_acceso/vistaTicket/<?= $b->ticketID;?>" class="admSta"><?= $r->cantidad;?></a></td>
	                <? endforeach; ?>
	                <? $tic = $this->hp_model->sumaTickets($usuario['localID'], $b->ticketID); ?>
	                
	            </tr>
	            <? endforeach; ?>
	            
	        </tbody>
	    </table>
	    <? else:?>
	     <div class="noInfo">No tiene tickets registrados, Suba sus tickets para participar.</div>
	    <?endif;?>
	    </div>
		
		
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
