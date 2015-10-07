<!-- Comentado hasta nuevo aviso <a id="boxBanner" href="<?=base_url()?>videoblog" title="Tutoriales, Reseñas, Tips y mucho más..."><img src="<?=base_url()?>assets/graphics/banner-videoblog.jpg" alt="Tutoriales, Reseñas, Tips y mucho más..."></a>-->
<?php if(isset($bannerBox)) : foreach($bannerBox  as $rowBox) :?>
<a id="boxBanner" href="<?= $rowBox->bannerUrl;?>/b1/<?= $rowBox->bannerFecha;?>" target="_blank" title="<?= $rowBox->bannerTitulo;?>"><img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?= $rowBox->imagen;?>" alt="<?= $rowBox->bannerTitulo;?>" /></a>
<?php endforeach; ?>
<?php endif; ?>
