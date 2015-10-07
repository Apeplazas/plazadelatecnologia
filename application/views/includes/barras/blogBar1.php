<aside id="barRight">
	<h3>Nuestras Redes Sociales</h3>
	<ul id="socialBlog">
		<li>
		  <a title="Google+ de Plaza de la Tecnología" href="https://plus.google.com/+plazadelatecnologia/posts"><img src="<?=base_url()?>assets/graphics/googleplus-blog.png" alt="" /></a>
		</li>
		<li>
		  <a title="Canal YouTube de Plaza de la Tecnología" href="http://www.youtube.com/plazadelatecnologia"><img src="<?=base_url()?>assets/graphics/youtube-blog.png" alt="" /></a>
		</li>
		<li>
		  <a title="Twitter de Plaza de la Tecnología" href="https://twitter.com/plazatecnologiayout"><img src="<?=base_url()?>assets/graphics/twitter-blog.png" alt="" /></a>
		</li>
		<li>
		  <a title="Facebook de Plaza de la Tecnología" href="https://www.facebook.com/plazadelatecnologia"><img src="<?=base_url()?>assets/graphics/facebook-blog.png" alt="" /></a>
		</li>
		<li>
		  <a title="Contacto directo a Plaza de la Tecnología" href="<?=base_url()?>contacto"><img src="<?=base_url()?>assets/graphics/contacto-blog.png" alt="" /></a>
		</li>
	</ul>
	<a title="Descarga nuestro brochure de ofertas" href="<?=base_url()?>folletos"><img class="100Pc" src="<?=base_url()?>assets/graphics/brochure-ofertas.png" alt="Brochure de Ofertas" /></a>
	<h3>Ultimos Eventos y Actividades</h3>
	<dl id="eveAct">
	  <dt>Eventos</dt>
	  <? foreach($eventos as $row):?>
	  <dd><a href="<?=base_url()?>eventos/post/<?= $row->articuloUrl;?>" title="<?= $row->articuloTitulo;?>"><?= $row->articuloTitulo;?> - <?= $row->lugarEvento;?></a></dd>
	  <? endforeach; ?>
	  <dt>Sorteos, Concursos y Rifas</dt>
	  <? foreach($sorteos as $rowS):?>
	  <dd><a href="<?=base_url()?>sorteos/<?= $rowS->articuloUrl;?>" title="<?= $rowS->articuloTitulo;?> "><?= $rowS->articuloTitulo;?> - <?= $rowS->lugarEvento;?></a></dd>
	  <? endforeach; ?>
	</dl>
	<h3>Noticias Destacadas</h3>
	<ul id="notDes">
		<? foreach($destacados as $rowD):?>
		<li><a href="<?=base_url()?>noticias/post/<?= $rowD->articuloUrl;?>" title="<?=$rowD->articuloTitulo?>"><img src="<?=base_url()?>articulosUpload/<?= $rowD->imagenesThumbs;?>.jpg" alt="<?=$rowD->articuloTitulo?>" /><em><?= character_limiter($rowD->articuloTitulo,'26');?> </em></a></li>
		<? endforeach; ?>
	</ul>
</aside>