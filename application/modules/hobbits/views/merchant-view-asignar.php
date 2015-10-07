
<table id="panel" class="merchant">
<thead>
<tr>
  <th>Imagen</th>
  <th>id</th>
  <th>fecha</th>
  <th>Titulo</th> 
  <th>price</th>
  <th>asignar</th>
</tr>
</thead>
<tbody>
<? foreach($productos as $row):?>
<tr>
  <td>
    <? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $row->ofertaImagen))):?>
    <img width="60" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $row->ofertaImagen)?>" alt="ofertas" />
    
      <? else:?>
      <?=base_url()?>assets/graphics/no_image.png
    <? endif;?>
  </td>
  <td> <?= $row->ofertaID;?>  </td>
  <td><?= $row->ofertaFecha;?></td>
  <td><?= $row->ofertaTitulo;?></td>
  <td>$ <?= number_format($row->ofertaPrecio)?></td>
  
  <td>
  	 <em id="status<?= $row->ofertaID;?>"><?= $row->googleMerchant;?></em>
  </td>
</tr>
<script type="text/javascript">
jQuery(function($){
	// Actualiza status
	$("#status<?= $row->ofertaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/addMerchant/<?= $row->ofertaID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "activado, desactivado"
	});
})
</script>
<? endforeach; ?>
</tbody>
</table>