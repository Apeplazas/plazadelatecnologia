<table id="panel" class="merchant">
<thead>
<tr>
  <th>id</th>
  <th>título</th> 
  <th>descripción</th> 
  <th>enlace</th>
  <th>estado</th>
  <th>precio</th>
  <th>disponibilidad</th>
  <th>enlace imagen</th>
  <th>Google Product</th>
</tr>
</thead>
<tbody>
<? foreach($productos as $row):?>
<tr>
  <td> <?= $row->ofertaID;?>  </td>
  <td><?= strtolower($row->ofertaTitulo);?></td>
  <td><?= $row->ofertaDescripcion;?></td>
  <td>http://www.plazadelatecnologia.com/<?= strtolower($row->rama);?>/oferta/<?= url_title($row->ofertaTitulo, '_');?>/<?= $row->ofertaID;?></td>
  <td>nuevo</td>
  <td><?= str_replace(',','' , number_format($row->ofertaPrecio))?></td>
  <td>en stock</td>
  <td>http://www.plazadelatecnologia.com/ofertasLocatarios/<?= str_replace('.', '_thumb.', $row->ofertaImagen)?></td>
  <td><?= $row->rama;?> > <?= $row->marca;?></td>
</tr>
<? endforeach; ?>
</tbody>
</table>