<?php if(isset($bannerLeadFoot)) : foreach($bannerLeadFoot  as $rowbanner) :?>
<a id="leadFootBanner" href="<?= $rowbanner->bannerUrl;?>" title="<?= $rowbanner->bannerTitulo;?>"><img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?= $rowbanner->imagen;?>" alt="<?= $rowbanner->bannerTitulo;?>" /></a>
<?php endforeach; ?>
<?php endif; ?>
