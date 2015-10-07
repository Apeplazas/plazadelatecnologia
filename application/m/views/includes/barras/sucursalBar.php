<? foreach($ciudadInfo as $row):?>
<aside id="barRight">
<section id="comollegar">
<span class="mapIcon">
<img src="<?=base_url()?>assets/graphics/map.png" alt="Como Llegar a Plaza de la Tecnología" />
<h1>¿Como llegar a Plaza de la Tecnologia?</h1>
</span>
<p><?= $row->comoLlegar;?></p>
</section>
<section id="folletos">
	<span class="folletoIcon"><img src="<?=base_url()?>assets/graphics/pdf.png" alt="Folletos de Descuentos de Plaza de  la Tecnologia" />
	<h1>Ofertas en <?= ucfirst(str_replace('_', ' ',$this->uri->segment(1)));?></h1>
	</span>
	<p><?= $row->folleto;?></p>
</section>
</aside>
<? endforeach; ?>