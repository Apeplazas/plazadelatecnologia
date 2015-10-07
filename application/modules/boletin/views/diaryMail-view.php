<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body{font-family: 'Raleway', sans-serif;}
blockquote {display: block; -webkit-margin-before: .8em;
-webkit-margin-after: .8em;
-webkit-margin-start: 15px;
-webkit-margin-end: 20px}
.ofertasEsp, .ofertasLap, .ofertasComp, .ofertasTab, .ofertasTel{background: radial-gradient(circle, #FFFFFF 20%, #CECECE 175%);}
a {color: #FFFFFF; text-decoration: none; cursor: pointer; font-size:.9em; }
.VerOfertaEsp{background: url(<?=base_url();?>assets/graphics/mailing-graphics/ofertasLabel.png)  1px 0px no-repeat;
padding: 2px 30px 8px 6px;
color: #fff;
font-size: .9em;}
strong {text-transform: uppercase; font-size: .8em; font-weight: normal; }
p {text-transform: lowercase; font-size: .8em;}
</style>
<link href="<?=base_url();?>assets/graphics/pt.ico" rel="icon" type="image/gif">
<?php foreach ($mail as $rowMail) :?>
<title><?=$rowMail->mailNombre;?></title>
</head>

<body>
<table width="670" border="0" align="center" cellspacing="0">
  <tr>
    <td><img src="<?=base_url();?>assets/graphics/mailing-graphics/logoHeaderMail.jpg" usemap="#Map" border="0"></td>
  </tr>
  <tr>
    <td colspan="2">
    <?php if ($rowMail->mailTipoUrl!="si"): ?>
    	<img src="<?=base_url();?>assets/graphics/mailing-graphics/<?=$rowMail->mailImagen;?>">
        <?php elseif ($rowMail->mailTipoUrl=="si"): ?>
        <a href="<?=$rowMail->mailUrl;?>"><img src="<?=base_url();?>assets/graphics/mailing-graphics/<?=$rowMail->mailImagen;?>">
        </a>
        <?php endif; ?>
    </td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="2">
    	<?php foreach ($banner as $rowBanner) :?>
    	<?php if ($rowBanner->bannerLink=="si"): ?>
    		<a title="<?=$rowBanner->bannerTitulo;?>" rel="nofollow" href="<?=$rowBanner->bannerUrl;?>"><img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?=$rowBanner->bannerImagen;?>" alt="<?=$rowBanner->bannerTitulo;?>"></a>
    		<?php elseif ($rowBanner->bannerLink=="no"): ?>
    		<img src="<?=base_url()?>assets/graphics/bannerPublicidad/<?=$rowBanner->bannerImagen;?>" alt="<?=$rowBanner->bannerTitulo;?>"/>
    		<?php endif; ?> 
    	<?php endforeach;?>
    </td>
  </tr>
  <?php foreach($categorias as $rowCat) :?>
  <?php $as = $this->boletin_model->cargarDiaryMail($rowCat->ramaUrl);?>
  <?php if(!empty($as)):?>
  <tr>
    <td colspan="2"><img src="<?=base_url();?>assets/graphics/mailing-graphics/<?= $rowCat->ramaUrl;?>.jpg"></td>
  </tr>
  <? endif ?>
  <tr>
    <td class="ofertasLap"><table width="100%" border="0" cellspacing="0">
      <tr>
        <?php foreach ($as as $rowOfertas) :?>
        <td width="223" align="left" valign="top">
        	<blockquote>
        	  <strong><?=$rowOfertas->tituloOferta;?></strong><br /><br />
        	  <a href="<?=base_url();?><?=$rowOfertas->ofertaCategoria;?>/oferta/<?=url_title($rowOfertas->tituloOferta,"_");?>/<?=$rowOfertas->ofertaID;?>"><img src="<?=base_url();?>ofertasLocatarios/<?=str_replace(".", "_thumb.", $rowOfertas->imagenOferta);?>"/></a>
        	  <p><?=character_limiter(nl2br($rowOfertas->descripcionOferta),30);?></p>
        	  <a href="<?=base_url();?><?=$rowOfertas->ofertaCategoria;?>/oferta/<?=url_title($rowOfertas->tituloOferta,"_");?>/<?=$rowOfertas->ofertaID;?>"><img src="<?=base_url();?>assets\graphics\mailing-graphics\verOfertaComp.png"></a>
      	  </blockquote>
        </td>
        <?php endforeach;?>
      </tr>
    </table></td>
  </tr>
  <?php endforeach;?>
  </td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0">
      <tr>
        <td width="167" align="left" valign="top"><img src="<?=base_url();?>assets/graphics/mailing-graphics/formas_de_pago.png" usemap="#Map2" border="0"></td>
        <td width="167" align="left" valign="top" >            
	        <strong>Atención a Clientes</strong>
	        <p><a style="color: #333;" href="<?=base_url();?>registrate/solicitud_local">Solicitud de local en línea</a></p>
	        <p><a style="color: #333;" href="<?=base_url();?>contacto">Contacto</a></p>
	        <p><a style="color: #333;" href="<?=base_url();?>">Quejas y sugerencias</a></p>
	        <p><a style="color: #333;" href="<?=base_url();?>avisoPrivacidad">Políticas de privacidad</a></p>
        </td>
        <td width="167" align="left" valign="top" style="
            font-size: 1em;">
        	<strong>Redes Sociales</strong>
        	<p><a style="color: #333;" href="https://www.facebook.com/plazadelatecnologia" />Facebook</a></p>
        	<p><a style="color: #333;" href="https://www.twitter.com/plazatecnologia" />Twitter</a></p>
        	<p><a style="color: #333;" href="https://plus.google.com/+plazadelatecnologia/" />Google Plus</a></p>
        	<p><a style="color: #333;" href="http://www.youtube.com/user/plazadelatecnologia" />Youtube</a></p>  
		</td>
        <td width="167" align="left" valign="top" style="
            font-size: 1em;">
        	<strong>Noticias</strong>
        	<p><a style="color: #333;" href="<?=base_url();?>noticias/computo">Cómputo</a></p>
        	<p><a style="color: #333;" href="<?=base_url();?>noticias/telefonia">Telefonía</a></p>
        	<p><a style="color: #333;" href="<?=base_url();?>noticias/electronica">Electrónica</a></p>
        	<p><a style="color: #333;" href="<?=base_url();?>noticias/reparaciones">Reparación</a></p>
        	<p><a style="color: #333;" href="<?=base_url();?>noticias/eventosyactividades">Eventos</a></p>
        </td>
      </tr>
    </table><td align="left" valign="top"></td>
  </tr>
</table>

<map name="Map" id="Map">
  <area shape="rect" coords="11,13,393,103" href="<?=base_url();?>" />
  <area shape="rect" coords="442,37,477,73" href="https://www.facebook.com/plazadelatecnologia" />
  <area shape="rect" coords="480,37,515,73" href="https://www.twitter.com/plazatecnologia" />
  <area shape="rect" coords="517,37,553,73" href="https://plus.google.com/+plazadelatecnologia/" />
  <area shape="rect" coords="554,36,590,73" href="http://www.youtube.com/user/plazadelatecnologia" />
  <area shape="rect" coords="592,36,628,73" href="<?=base_url();?>contacto" />
</map>

<map name="Map2" id="Map2">
  <area shape="rect" coords="6,3,160,60" href="http://www.plazadelatecnologia.com" />
</map>
</body>
</html>