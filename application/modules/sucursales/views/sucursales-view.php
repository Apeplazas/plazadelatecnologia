<aside id="mapDir">
	<h1>Directorio</h1>
	<p>¿Como llegar a Plazas de la tecnología?</p>
	<ul id="clickMap" class="tabsSliderMap">
		<? foreach($suc as $rowS):?>
		<li><a href="#tab<?=$rowS->sucursalID;?>" title="Plaza de la tecnología <?= $rowS->sucursalNombre;?>"><?= $rowS->sucursalNombre;?></a></li>
		<? endforeach; ?>
	</ul>
</aside>
<section class="map">
	<? foreach($suc as $rowMap):?>
	<div id="tab<?=$rowMap->sucursalID;?>" class="tab_map">
		<strong>Sucursal <?=$rowMap->sucursalNombre;?></strong>
		<div id="map<?=$rowMap->sucursalID;?>">
		  <?= $rowMap->googleMap;?>
		</div>
		<h3>Consejos utiles como llegar a plaza de la tecnologia <?=$rowMap->sucursalCiudad;?></h3>
		<p><?= $rowMap->comoLlegar;?></p>
	</div>
	<? endforeach; ?>
</section>
<section id="extraContent">
	<aside>
	<h2>Atención a Clientes</h2>
	<dl>
      <dt><dfn>Soporte</dfn></dt>
      <dd><a href="<?=base_url()?>renta_de_locales" title="Renta de locales">Renta de locales</a></dd>
      <dd><a href="<?=base_url()?>contacto/atencion_a_locatarios" title="atencion a locatarios de plaza de la tecnologia">Atencion a Locatarios</a></dd>
      <dd><a href="<?=base_url()?>contacto/compras_en_linea" title="compras en plazadelatecnologia.com">Compras en linea</a></dd>
      <dd><a href="<?=base_url()?>registrate/solicitud_local" title="Solicita tu local en linea">Solicitud local en linea</a></dd>
      <dd><a href="<?=base_url()?>contacto" title="Ayuda Plaza de la Tecnologia">Ayuda en general</a></dd>
    </dl>
    </aside>
    <aside>
	<h2>Conócenos</h2>
	<dl>
      <dt><dfn>¿Quienes Somos?</dfn></dt>
      <dd><a title="Quienes Somos" href="<?=base_url()?>nosotros">Nosotros</a></dd>
      <dd><a title="Administracion de plazas especializadas" target="_blank" href="http://www.apeplazas.com">Ape plazas</a></dd>
    </dl>
    </aside>
    <aside>
	<h2>Renta de locales</h2>
	<dl>
      <dt><dfn class="markRed">Ventas por telefono</dfn></dt>
      <dd class="phone">rentadelocales@plazadelatecnologia.com</dd>
      <dt><dfn class="markRed">Contrata un local con nosotros</dfn></dt>
      <dd class="phone">Numero Gratuito 01.800.017.5292</dd>
      <dd><a href="<?=base_url()?>renta_de_locales">Da click aquí para mayor información</a></dt>
    </dl>
    </aside>
     <aside>
	<h2>Redes sociales</h2>
	<dl>
      <dt><dfn class="markRed">Contáctanos en nuestras redes</dfn></dt>
      <dd><a title="Facebook Plaza de la Tecnología" target="_blank" href="https://www.facebook.com/plazadelatecnologia">Facebook</a></dd>
      <dd><a title="Google Plus Plaza de la Tecnología" target="_blank" href="https://plus.google.com/+plazadelatecnologia">Google Plus</a></dd>
      <dd><a title="Twitter Plaza de la Tecnología" target="_blank" href="https://twitter.com/plazatecnologia">Twitter</a></dd>
      <dd><a title="Canal Youtube Plaza de la Tecnología" target="_blank" href="http://www.youtube.com/plazadelatecnologia">Canal Youtube</a></dd>
    </dl>
    </aside>
</section>
<script>
//Tabulador mapas
$(document).ready(function(){
	$(".tab_map").hide();
	$("ul.tabsSliderMap li:first").addClass("activeMap").show();
	$(".tab_map:first").show();
	$("ul.tabsSliderMap li").click(function()
       {
		$("ul.tabsSliderMap li").removeClass("activeMap");
		$(this).addClass("activeMap");
		$(".tab_map").hide();

		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});
	$("ul.tabsSliderMap li:even").addClass("even-list");
});
</script>