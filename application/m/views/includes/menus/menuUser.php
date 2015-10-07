<? foreach($menuLocal as $rowMel):?>
<li <? if($rowMel->paginaUrl == $this->uri->uri_string()):?>class="mark"<? else:?>class="regLi"<? endif;?>>
  <a id="<?= $rowMel->enlaceID;?>" href="<?=base_url()?><?= $rowMel->paginaUrl;?>" title="<?= $rowMel->enlaceDescripcion;?>"><img src="<?=base_url()?>assets/graphics/<?= url_title(strtolower($rowMel->enlaceNombre),'_');?>.png" alt="<?= $rowMel->enlaceNombre;?>"><?= $rowMel->enlaceNombre;?></a>
</li>
<? endforeach; ?>