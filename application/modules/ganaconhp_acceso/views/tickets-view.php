<? $usuario		= $this->session->userdata('usuarioHP');?>
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
$(document).ready(function() {
	$("#txtboxToFilter, #totVe").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>
<script type="text/javascript"> 
	$(document).ready(function () {          
		$.extend($.fn.autoNumeric.defaults, {              
			aSep: '.',              
			aDec: ','          
		});      
	});  

  	jQuery(function($) {
      	$('#totVe').autoNumeric('init');    
  	});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#tab').DataTable({
	  	"bLengthChange": false,
    });
    
});
</script>






















