<? foreach($menuLocal as $rowMel):?>
<li <? if($rowMel->paginaUrl == $this->uri->uri_string()):?>class="mark"<? else:?>class="regLi"<? endif;?>>
  <a id="<?= $rowMel->enlaceID;?>" href="<?=base_url()?><?= $rowMel->paginaUrl;?>" title="<?= $rowMel->enlaceDescripcion;?>"><img src="<?=base_url()?>assets/graphics/<?= url_title($rowMel->enlaceNombre,'_');?>.png" alt="<?= $rowMel->enlaceNombre;?>"><?= $rowMel->enlaceNombre;?></a>
</li>
<? endforeach; ?>
<li class="regLi">
  <a class="addProRam" href="#addProRam" ><img src="<?=base_url()?>assets/graphics/Agregar_Producto.png" alt="Agregar Producto">Agregar Producto</a>
</li>
<? if ($noConf):?>
<li <? if($this->uri->uri_string() == 'mi_local/noConfirmados'):?>class="mark"<? else:?>class="regLi"<? endif;?>>
  <a id="confirmaVenta" href="<?=base_url()?>mi_local/noConfirmados" title="Confirma tus ventas"><img src="<?=base_url()?>assets/graphics/compraIcon.png" alt="Confirmacion de Ventas">Confirma tus ventas</a>
</li>
<? endif; ?>
<? if ($nopublicados):?>
<li <? if($this->uri->uri_string() == 'mi_local/noPublicados'):?>class="mark"<? else:?>class="regLi"<? endif;?>>
  <a id="confirmaVenta" href="<?=base_url()?>mi_local/noPublicados" title="Ofertas que no sean publicado"><img src="<?=base_url()?>assets/graphics/alertIcon.png" alt="Confirmacion de Ventas">Productos no publicados</a>
</li>
<? endif; ?>