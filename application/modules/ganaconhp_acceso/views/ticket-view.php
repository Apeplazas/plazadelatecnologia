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
	<div id="tableTicket">
	<span id="head">
	<strong>Tús tickets regístrados</strong>
	</span>
	<? if($tickets):?>
	<table id="tab" class="display" border="0" cellspacing="0" width="100%">
		<thead>
	            <tr>
	                <th>Productos</th>
	                <th>Tipo</th>
	                <th>Cantidad</th>
	            </tr>
	        </thead>
	 
	        <tbody>
		        
		        <? foreach($tickets as $b):?>
	            <tr>
	                <td><?= $b->producto;?></td>
	                <td><?= $b->tipo;?></td>
	                <td><?= $b->cantidad;?></td>
	                
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
