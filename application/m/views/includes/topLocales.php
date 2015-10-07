<section id="topLocales" class="mt20">
<h5>Locales Destacados</h5>
<?php foreach ($topLocales as $localesTop):?>
<div class="localTop">
<img src="<?base_url();?>localesLogos/<?=$localesTop->imagenLocal;?>" width="46" alt="<?=$localesTop->nombreLocal;?>">
<p><b><?=$localesTop->nombreLocal;?></b><br>
ver <a href="<?base_url();?><?=$localesTop->urlLocal;?>/ofertas" title="Ofertas de <?=$localesTop->nombreLocal;?>">Ofertas</a></p>
</div>
<?php endforeach; ?>
</section>