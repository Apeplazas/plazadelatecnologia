<div id="contentFolle">
<span id="spanRent"><img src="<?=base_url()?>assets/graphics/brochures-plazadelatecnologia.png" alt="Folletos de ofertas en Plaza de la Tecnologia" /></span>
<section id="renta">
<h1>Encuentra las mejores ofertas en Plaza de la Tecnología</h1>
<p>En Plaza de la Tecnología nos esforzamos cada día para ofrecerte las mejores ofertas, explora nuetros folletos y encuentra todo lo que buscas en cómputo, electrónica, telefonía, impresoras, tintas, reparaciones y mucho más.</p>
	<? foreach($folletos as $row):?>
	<div class="folleto">
	<h2>Folleto <?= $row->sucursalCiudad;?></h2>
	<div class="wrapFol"><?= $row->folleto;?></div>
	</div>
	<? endforeach; ?>
</section>
</div>