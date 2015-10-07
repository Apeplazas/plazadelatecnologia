<? foreach($noticias as $rowN):?>
<article class="comment" id="<?=$rowN->articuloID;?>">
	<h2><?= $rowN->articuloTitulo;?></h2>
	<span>
	<a href="<?=base_url()?>noticias/post/<?= $rowN->articuloUrl;?>"><img class="fleft" src="<?=base_url()?>articulosUpload/<?= $rowN->articuloImagenes;?>.jpg" alt="<?= $rowN->articuloTitulo;?>" /></a>
	<ul class="postmetadata">
      <li class="autor">por <a rel="author" href="<?=base_url()?>" title=""><?= $rowN->autor;?></a></li>
      <li class="fechaArt"><?= $rowN->articuloFecha;?></li>
      <? $tags = $this->blog_model->cargarTags($rowN->articuloID);?>
      <? if ($tags):?>
      <li class="tags"><strong>Categoria</strong>
        <? foreach($tags as $rowT):?>
        <em><?= ucfirst($rowT->tagNombre);?></em>,
        <? endforeach; ?> 
      </li>
      <? endif;?>
      <? $cuenta = $this->blog_model->cuentaComentarios($rowN->articuloID);?>
      <? foreach($cuenta as $rowC):?>
      <? $total = $rowC->total * 1;?>
      <? if($total != 0):?>
      <li class="comments"><em><?= $rowC->total;?> Comentarios</em></li>
      <? endif;?>
      <? endforeach; ?>
    </ul>
    </span>
    <? if($rowN->articuloDescripcionPeque = ''):?>
	<p><?= character_limiter($rowN->articuloDescripcionPeque, 350);?></p>
	<? else:?>
	<p><?= character_limiter($rowN->articuloDescripcion, 350);?></p>
	<? endif;?>
</article>
<? endforeach; ?>