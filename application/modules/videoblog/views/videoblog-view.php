<div id="contentFolle">
<span id="spanVideoblog"><img src="<?=base_url()?>assets/graphics/videoblog.png" alt="Plaza de la tecnología videoblog - Tips, Tutoriales, Reseñas" /></span>
<section id="videoblog">
<h1 id="mainVid">Videoblog de plazadelatecnolgia.com</h1>
<p id="desVid">Disfruta de tips, tutoriales y reseñas. La mejor guia en compras de tecnología en México.</p>
<? foreach($videoMain as $videoMain):?>
<div id="videoMain">
	<div id="wrapMain">
	<?=$videoMain->iframeVideo?>
	<h3><?=$videoMain->articuloTitulo?></h3>
	<p><?= character_limiter($videoMain->articuloDescripcionPeque ,'150');?></p>
	</div>
	<ul id="masRecomendados">
	  <? foreach($videosDestacados as $videoRow):?>
	    <li>
	      <a href="<?=$videoRow->embedVideo?>">
	      <span><img src="<?=base_url()?>articulosUpload/<?=$videoRow->articuloImagenes?>.jpg" /></span>
	      <p><strong><?=$videoRow->articuloTitulo?></strong>
	      <?= character_limiter($videoRow->articuloDescripcionPeque, '70')?></p>
	      </a>
	    </li>
	  <? endforeach;?>
	</ul>
</div>
<? endforeach;?>
<h2 class="titVid">Tips, Reseñas y Tutoriales.</h2>
<ul class="listaVideos">
<? $resenias = $this->videoblog_model->cargarVideos('resenias'); ?>
<? foreach($resenias as $videoRow):?>
  <li>
    <a href="<?=$videoRow->embedVideo?>">
    <span><img src="<?=base_url()?>articulosUpload/<?=$videoRow->articuloImagenes?>.jpg" alt="<?=$videoRow->articuloTitulo?>"/></span>
    <strong><?=$videoRow->articuloTitulo?></strong>
    <p><?= character_limiter($videoRow->articuloDescripcionPeque, '70')?></p>
    </a>
  </li>
<? endforeach;?>
</ul>
<h2 class="titVid">Promociones, Dinámicas, Sorteos y Concursos.</h2>
<ul class="listaVideos">
<? $promociones = $this->videoblog_model->cargarVideos('promociones'); ?>
<? foreach($promociones as $videoRow):?>
  <li>
    <a href="<?=$videoRow->embedVideo?>">
    <span><img src="<?=base_url()?>articulosUpload/<?=$videoRow->articuloImagenes?>.jpg" alt="<?=$videoRow->articuloTitulo?>"/></span>
    <strong><?=$videoRow->articuloTitulo?></strong>
    <p><?= character_limiter($videoRow->articuloDescripcionPeque, '70')?></p>
    </a>
  </li>
<? endforeach;?>
</ul>
<h2 class="titVid">Spots de Televisión</h2>
<ul class="listaVideos">
<? $comerciales = $this->videoblog_model->cargarVideos('comerciales'); ?>
<? foreach($comerciales as $videoRow):?>
  <li>
    <a href="<?=$videoRow->embedVideo?>">
    <span><img src="<?=base_url()?>articulosUpload/<?=$videoRow->articuloImagenes?>.jpg" alt="<?=$videoRow->articuloTitulo?>"/></span>
    <strong><?=$videoRow->articuloTitulo?></strong>
    <p><?= character_limiter($videoRow->articuloDescripcionPeque, '70')?></p>
    </a>
  </li>
<? endforeach;?>
</ul>
</section>
</div>
