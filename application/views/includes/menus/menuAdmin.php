<? foreach($menuLocal as $rowMel):?>
<li <? if($rowMel->paginaUrl == $this->uri->uri_string()):?>class="mark"<? else:?>class="regLi"<? endif;?>>
  <a id="<?= $rowMel->enlaceID;?>" href="<?=base_url()?><?= $rowMel->paginaUrl;?>" title="<?= $rowMel->enlaceDescripcion;?>"><?= $rowMel->enlaceNombre;?></a>
</li>
<? endforeach; ?>