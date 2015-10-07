<?php if(isset($bannerSky)) : foreach($bannerSky  as $rowbanner) :?>
<div id="slidedown" style="background-color:<?=$rowbanner->fondoColor;?>;">
	<div id="panel" class="<?=$rowbanner->imagen;?>" style="background-color:<?=$rowbanner->fondoColor;?>;">
	<?php if ($rowbanner->bannerLink=="si"): ?>
    <a title="<?=$rowbanner->bannerTitulo;?>" rel="nofollow" href="<?=$rowbanner->bannerUrl;?>" target="_blank">
      <img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?=$rowbanner->imagen;?>" alt="<?=$rowbanner->bannerTitulo;?>" />
    </a>
	<?php elseif ($rowbanner->bannerLink!="si"): ?>
      <img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?=$rowbanner->imagen;?>" alt="<?=$rowbanner->bannerTitulo;?>" />
	<?php endif; ?>
    </div>
    <span id="toggle_panel">
	<a id="close"  class="close" href="#"><img src="<?=base_url()?>assets/graphics/<?=$rowbanner->cerrar;?>" alt="Cerrar Banner" /></a>
	<a id="open"  style="display: none;" class="open" href="#"><img src="<?=base_url()?>assets/graphics/<?=$rowbanner->abrir;?>" alt="Abrir Banner" /></a>
	</span>
</div>
<?php endforeach; ?>
<?php else : ?>
<?php endif; ?>
