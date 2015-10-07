<div id="resultados">
<?php $i=1; foreach($respuestas as $rowRes) :?>
<strong><?=$i?>.- <?=$rowRes->pregunta;?> </strong>
<table cellpadding="0" cellspacing="0" border="0">
  	<thead>
		<tr>
        
          <th class="dos" align="left">Usuario</th>
          <th class="dos" align="left">Respuesta</th>
          <th class="dos" align="left">Por Que?</th>
          <th class="dos" align="left">Cual?</th>
		</tr>
	</thead>
    <tbody>
    <?php  
			$rs = $this->encuesta_modelo->preguntaID($rowRes->encuestaPreguntaID);
			if ($rs > 0) {?>
			<?php $c=1;  foreach($rs as $rowT) :?>
      <tr>
      	<td class="usuario"><?=$c?>.- <?=$rowT->usuarioNombre;?> <?=$rowT->usuarioApellido;?></td>
        <td class="respuestas"><?=$rowT->respuesta;?></td>
        <td class="porque">
		  <?php if ($rowT->porque=="0"): ?>
          Sin Respuesta
		  <?php elseif ($rowT->porque!="0"): ?>
		  <?=$rowT->porque;?>
		  <?php endif; ?>
        </td>
        <td class="cual">
		  <?php if ($rowT->cual=="0"): ?>
            Sin Respuesta
			<?php elseif ($rowT->cual!="0"): ?>
			<?=$rowT->cual;?>
			<?php endif; ?>
         </td>
         <td class="otros">
		  <?php if ($rowT->otros=="0"): ?>
            Sin Respuesta
			<?php elseif ($rowT->otros!="0"): ?>
			<?=$rowT->otros;?>
			<?php endif; ?>
         </td>
         
      </tr>
      <?php $c++; endforeach; ?>  
        <?php } ?>
     
    </tbody>
</table>
<?php $i++; endforeach; ?>



</div>