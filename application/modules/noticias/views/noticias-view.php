<div id="content">
<h1 id="mainTit">Articulos interesantes de Tecnología</h1>
<p id="mainDes">Aquí podrás enterarte de la información más reciente de tecnología en cómputo, telefonía, fotografía, videojuegos y electrónica. En Plaza de la Tecnología tu opinión es muy importante para nosotros, todas cuentan y nos ayudan a mejorar esta página, así que no olvides dejar un comentario en la nota que más sea de tu interés.</p>

<section id="artNot">
<h1><img src="<?=base_url()?>assets/graphics/noticias-de-interes.png" alt="Noticias interesantes de Plaza de la Tecnología" />Noticias interesantes</h1>
	<? foreach($noticias as $rowN):?>
	<article class="comment" id="<?=$rowN->articuloID;?>">
	<h2><?= $rowN->articuloTitulo;?></h2>
	<span>
	<a href="<?=base_url()?>noticias/post/<?= $rowN->articuloUrl;?>" title="<?= $rowN->articuloTitulo;?>"><img class="fleft" src="<?=base_url()?>articulosUpload/<?= $rowN->articuloImagenes;?>.jpg" alt="<?= $rowN->articuloTitulo;?>" /></a>
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
	<p><?= character_limiter($rowN->articuloDescripcionPeque, 350);?></p>
	</article>
	<? endforeach; ?>
	<div class="box noComments" id="box"><div id="loadMore" style="display:none;"><center><img width="90" src="<?=base_url()?>assets/graphics/ptloading.gif" alt="Cargando..." /></center></div>
	</div>
</section>
<?= $this->load->view('includes/barras/blogBar1');?>
<script type="text/javascript">
$(window).scroll(function(){
	///if($(window).scrollTop() == $(document).height() - $(window).height()){
	if($(window).scrollTop() + 1 >= $(document).height() - $(window).height()){
		$("#text").hide();
		$('div#loadMore').show();
		$.ajax({
			url:"<?=base_url()?>noticias/cargarMasNoticias/" +$(".comment:last").attr("id"),
			success: function(html){
				if(html){
					$("#artNot").append(html);
					$('div#loadMore').hide();
					$("#text").show();
					}
				 else {
					  $('div#box').replaceWith("<div class='box noComments'>No mas comentarios...</div>")
					 }
				}
			});
		}
	});
</script>
<script type="text/javascript">
$("#showMore").click(function(){
	$("#showMore").hide();
	$('div#loadMore').show();
	$.ajax({
		url:"<?=base_url()?>noticias/cargarMasNoticias/" +$(".comment:last").attr("id"),
		success: function(html){
			if(html){
				$("#artNot").append(html);
				$('div#loadMore').hide();
				$("#showMore").show();
			}
			else {
				$('div#box').replaceWith("<div class='box noComments'>Ultima noticia...</div>")
				}
			}
		});
	});
</script>
</div>