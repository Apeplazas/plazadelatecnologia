<? foreach($producto as $rowP):?>
<div class="MarcaEdit"><b>Marca :</b><em id="marcaOp"><?= $rowP->marca;?></em></i></div>
<div class="MarcaEdit"><b>Tematica :</b><em id="tematicaOp<?=$this->uri->segment(4)?>"><? if($rowP->tematicaNombre != ''):?><?= $rowP->tematicaNombre;?><? else:?>Escoge una tematica<? endif;?></em></i></div>
<div class="MarcaEdit"><b>Categorias :</b><em id="categoriaOp"><?= $rowP->marca;?></em></i></div>
<? endforeach; ?>