<?php if(isset($bannerLead)) : foreach($bannerLead  as $rowbanner) :?>
<?if ($rowbanner->bannerUrl != ''):?>
<a id="leadBanner" href="<?= $rowbanner->bannerUrl;?>" title="<?= $rowbanner->bannerTitulo;?>"><img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?= $rowbanner->imagen;?>" alt="<?= $rowbanner->bannerTitulo;?>" /></a>
<? else:?>
<span id="leadBanner"><img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?= $rowbanner->imagen;?>" alt="<?= $rowbanner->bannerTitulo;?>" /></span>
<?endif?>
<?php endforeach; ?>
<?php endif; ?>
