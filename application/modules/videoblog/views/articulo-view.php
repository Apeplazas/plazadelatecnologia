<div id="content">
<? foreach($noticia as $rowN):?>
<section id="artNotPart">
<h1><img src="<?=base_url()?>assets/graphics/noticias-de-interes.png" alt="<?= $rowN->articuloTitulo;?>" />Noticias y reseñas de tecnología.</h1>
<article>
	<h2><?= $rowN->articuloTitulo;?></h2>
    <ul class="postmetadata">
      <li class="autor"><em>por <?= $rowN->autor;?></em></li>
      <li class="fechaArt"><?= $rowN->articuloFecha;?></li>
      <? $tags = $this->blog_model->cargarTags($rowN->articuloID);?>
      <? if ($tags):?>
      <li class="tags"><strong>Categoria</strong>
        <? foreach($tags as $rowT):?>
        <em><?= ucfirst($rowT->tagNombre);?></em>,
        <? endforeach; ?> 
      </li>
      <? endif;?>
    </ul>
    <div id="contArt">
    <? if( nl2br($rowN->articuloDescripcionPeque) != ''):?>
	<p class="descArt"><span><a title="<?= $rowN->articuloTitulo;?>" href="<?=base_url()?>noticias/post/<?= $rowN->articuloUrl;?>"><img class="fleft"  src="<?=base_url()?>articulosUpload/<?= $rowN->articuloImagenes;?>" alt="<?= $rowN->articuloTitulo;?>" /></a></span> <?= $rowN->articuloDescripcionPeque;?></p>
	<p class="descArt"><?= nl2br($rowN->articuloDescripcion);?></p>
	<? else:?>
	<p class="descArt"><span><a title="<?= $rowN->articuloTitulo;?>" href="<?=base_url()?>noticias/post/<?= $rowN->articuloUrl;?>"><img class="fleft"  src="<?=base_url()?>articulosUpload/<?= $rowN->articuloImagenes;?>" alt="<?= $rowN->articuloTitulo;?>" /></a></span><?= $rowN->articuloDescripcion;?></p>
	<? endif;?>
	</div>
</article>
<div id="comArt">
	<form class="fleft100" action="<?=base_url()?>noticias/insertarComentario" method="post">
		<fieldset>
		  <?= form_error('nombre'); ?>
		  <label>Tu nombre*</label>
		  <input type="text" class="artInp" name="nombre" />
		</fieldset>
		<fieldset>
		  <?= form_error('email'); ?>
		  <label>Tu email*</label>
		  <input type="text" class="artInp" name="email" />
		</fieldset>
		<fieldset>
		<?= form_error('comentario'); ?>
		<label>Tu comentario*</label>
			<textarea name="comentario"></textarea>
		</fieldset>
		<fieldset>
			<input type="hidden" name="articuloID" value="<?= $rowN->articuloID;?>" />
			<input type="hidden" name="url" value="<?= uri_string();?>" />
			<input class="envArt" type="submit" value="Enviar Comentario" />
		</fieldset>
	</form>
</div>
<? foreach($comments as $rowCom):?>
<div class="comFin">
	<span><img class="fleft" src="<?=base_url()?>assets/graphics/avatar.jpg" alt="Avatar" /></span>
	<p><strong><?= $rowCom->nombre;?></strong> <em><?= $rowCom->comentarioFecha;?></em> <i><?= $rowCom->comentarioHora;?></i></p>
	<p><?= nl2br($rowCom->comentario);?></p>
</div>
<? endforeach; ?>
</section>
<?= $this->load->view('includes/barras/blogBar1');?>
<? endforeach; ?>
</div>