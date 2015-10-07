
	<div id="wrapEncu">
	<!--<p></p>-->
	<ul>
		<form id="encuesta" method="post" action="<?=base_url()?>encuestas/enviar_respuestas_ape">
		<?php $i=1; foreach($encuesta as $pregunta) :?>
		 <li <?php  if($pregunta->encuestaLigadura!="display"){?>
	     class="paginaUrl"
	        <?php } ?>
	     > 
	        <p><?=$i?>.- <strong><?=$pregunta->pregunta?></strong></p>
	        	<?php  
				$rs = $this->encuesta_modelo->obtiene_opciones($pregunta->encuestaPreguntaID);
				if ($rs > 0) {?>
				<?php foreach($rs as $rowT) :?>
	              <? if($rowT['tipo'] == 'checkbox'):?>
	              <fieldset>
	                <label class="radius"><?=$rowT['opcion']?></label>
	                <input class="required" type="<?=$rowT['tipo']?>" value="<?=$rowT['opcion']?>" name="txt<?=$i?>[]" />
	              </fieldset>
				  <? endif;?>
	              
				  <? if($rowT['tipo'] == 'radio'):?>
	              <fieldset>
	                <label class="radius"><?=$rowT['opcion']?></label>
	                <input  class="required <?=$rowT['liga']?>"  type="<?=$rowT['tipo']?>" value="<?=$rowT['opcion']?>" name="txt<?=$i?>[]" required="required"/>
	              </fieldset>
				  <? endif;?>
	            <?php endforeach; ?> 
	
	              <? if($rowT['tipo'] == 'select'):?>
	              <fieldset class="seleccion">
	                <select class="required <?=$rowT['liga']?>" name="txt<?=$i?>[]" required="required">
					  <?php foreach($rs as $rowT) :?>
	                    <option  value="<?=$rowT['opcion']?>" ><?=$rowT['opcion']?></option>
				      <?php endforeach; ?>
	                </select>
	               </fieldset>
				  <? endif;?>
	            
	            <?php foreach($rs as $rowT) :?>
				  <? if($rowT['tipo'] == 'text'):?>
	              <fieldset>
	                <textarea class="textarea"  required="required" name="txt<?=$i?>[]" ></textarea>
	              </fieldset>
				  <? endif;?>
	            <?php endforeach; ?>  
	            <fieldset>
	              <input type="hidden" name="ep<?=$i?>" value="<?=$rowT['ID']?>" />
	              <input type="hidden" name="order<?=$i?>" value="<?=$i?>" />
	            </fieldset>
				
	        <?php } ?>
	        <?php  if($pregunta->porqueStatus!="0"){?>
	       <label class="block">Por qué</label>
	       <textarea class="textarea" name="porque<?=$i?>"></textarea>
	        <?php } ?>
	        
	        <?php  if($pregunta->cualStatus!="0"){?>
	       <label class="block">Cuál</label>
	       <textarea class="textarea" name="cual<?=$i?>"></textarea>
	        <?php } ?>
            
            <?php  if($pregunta->otrosStatus!="0"){?>
	       <label class="block">Otros</label>
	       <textarea class="textarea" name="otros<?=$i?>"></textarea>
	        <?php } ?>
	      </li>
		<?php $i++; endforeach; ?>
	    <!-- Se capturan los datos del usuarioApe mediante metodo post
	    <input type="hidden" name="usuarioNombre" value="<?=$this->input->post('usuarioNombre')?>" />
	    <input type="hidden" name="usuarioApellido" value="<?=$this->input->post('usuarioApellido')?>" />
	    <input type="hidden" name="usuarioEmail" value="<?=$this->input->post('usuarioEmail')?>" />
	    <input type="hidden" name="sucursal" value="<?=$this->input->post('sucursal')?>" />-->
	    <input type="hidden" name="usuarioID" value="<?=$this->session->userdata('usuarioID')?>" />
	    <input type="hidden" name="encuestaID" value="<?=$this->uri->segment(3);?>" />
	    <input type="hidden" name="respuestaVarias" value="<?=$this->uri->segment(3);?>" />
	    <input id="enviarEncuesta" class="test" type="image" src="<?=base_url()?>assets/graphics/enviar-encuesta.jpg" />
	    <br class="clear">
		</form>
	</ul>
	</div>
	 <script>
  $(document).ready(function(){
    $("#encuesta").validate();
  });
  
  //BOTON DE RADIO
	$(document).ready(function(){
		$(".display").click(function(){
				$(".paginaUrl").show("fast");
				});
		$(".non").click(function(){
				$(".paginaUrl").hide("fast");
				});
	});
		
  </script>