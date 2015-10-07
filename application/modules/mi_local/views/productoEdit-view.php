<? foreach($producto as $rowP):?>
<aside id="tabs">
<?if ($rowP->ofertaStatus == 'No Publicado'):?><strong class="warningMsg"><h2>Su producto no ha sido publicado por falta de información, Arregle los siguientes segmentos</h2><br><?= $this->session->flashdata('msg'); ?></strong><?endif;?>
<h4 id="infoRam">Categorias <?= $rowP->ramaNombre;?></h4>
<h1 id="ofeTitu" class="marEdit"><? if ($rowP->ofertaTitulo != ''):?>* <?= character_limiter(($rowP->ofertaTitulo),40);?><?else:?>Click aquí para añadir el titulo de tu producto.<? endif;?></h1>
  <ul>
    <li><a class="desComm" href="#tabs-1">Descripción</a></li
  </ul>
  <div class="bTab" id="tabs-1">
   <p id="ofeDes" class="marEdit<?if ($rowP->ofertaDescripcion ==''):?> bckDark<?endif;?>"><? if ($rowP->ofertaDescripcion != ''):?><?= nl2br($rowP->ofertaDescripcion);?><? else:?>Para escribir una descripción de tu product Da click aquí<br> Recuerda que para impulsar la venta de tus productos es necesario una buena descripción.<? endif;?></p>
  </div>
</aside>

<aside class="ml20">
<div id="fotoPro">
	<div class="targetarea">
		<? if($rowP->ofertaImagen != 'sinEdicion.png'):?>
		<img id="mz" alt="zoomable" title="" src="<?=base_url()?>ofertasLocatarios/<?= $rowP->ofertaImagen;?>"/>
		<a class="borrarFoto" href="<?=base_url()?>mi_local/borFoPri/<?= $rowP->ofertaID;?>/<?= $rowP->ramaID;?>"><img src="<?=base_url()?>assets/graphics/borrarFotoPrincipal.png" alt="Borrar Foto" /></a>
	</div>
	<div class="mz thumbs">
		<a href="<?=base_url()?>ofertasLocatarios/<?= $rowP->ofertaImagen;?>" data-large="<?=base_url()?>ofertasLocatarios/<?= $rowP->ofertaImagen;?>" ><img src="<?=base_url()?>ofertasLocatarios/<?= $rowP->ofertaImagen;?>" alt="Samsung" /></a>
		<? $imagenes = $this->ofertas_model->cargarFotosExtras($rowP->ofertaID);?>
		<? if($imagenes) : foreach($imagenes as $rowImag):?>
		<a href="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>" data-large="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>"><img src="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>" /></a>
		<? endforeach; ?>
		<? $count = count($imagenes);?>
			<? if ($count < '3'):?>
			<p class="fotoP" href="#fotoP"><img src="<?=base_url()?>assets/graphics/agregarFotoProducto.png" alt="Agregar foto extra de producto" /></p>
			<? endif;?>
		<? else:?>
		<p class="fotoP" href="#fotoP"> <img src="<?=base_url()?>assets/graphics/agregarFotoProducto.png" alt="Agregar foto extra de producto" /></p>
		<? endif;?>
	<? else:?>
	<a class="fotoMain" href="#fotoMain"><img src="<?=base_url()?>assets/graphics/sinEdicion.png" alt="Agrega la foto principal" /></a>
	<? endif;?>
	</div>
</div>
<div id="infoProEdit">
	<h2>* Caracteristicas Principales</h2>
	<div class="MarcaEdit"><b>Garantia:</b><em id="garPro"><?= $rowP->garantia;?></em></i></div>
	<div class="MarcaEdit"><b>Estado Producto:</b><em id="statusPro"><?= $rowP->statusProducto;?></em></i></div>
	<div class="MarcaEdit"><b>Marca :</b><em id="marcaOp"><?= $rowP->marca;?></em></i></div>
	<div class="MarcaEdit"><b>Categoria :</b><em id="tematicaOp<?=$this->uri->segment(4)?>"><? if($rowP->tematicaNombre != ''):?><?= $rowP->tematicaNombre;?><? else:?>Escoge una categoria<? endif;?></em></i></div>
	<div class="MarcaEdit"><b>Color :</b><em id="colorPro"><?= $rowP->color;?></em></i></div>
	
	<!-- Agregado de Caracteristicas -->
	<? foreach($catTipo as $rowCt):?>
		<? $descripcion = $this->ofertas_model->cargarBusquedaCat($rowP->ofertaID, $rowCt->tipoID);?>
		<div class="MarcaEdit"><b><?= $rowCt->descripcion;?></b><em id="catOp<?= $rowCt->tipoID;?>"><? if ($descripcion) : foreach($descripcion as $rowDes):?><?= $rowDes->descripcion;?><? endforeach; ?><?else:?>Otros<?endif;?></em></div>
	<? endforeach; ?>
	<ul>
	<? $catPrin = $this->ofertas_model->cargarOfertaCaract($rowP->ofertaID);?>
		<? if($catPrin) : foreach($catPrin as $rowCP):?>
		<li id="agregaCat<?= $rowCP->caracteristicaID;?>"><?= $rowCP->caracteristica;?></li>
		<? endforeach; ?>
	</ul>
	<? $countCat = count($catPrin);?>
	<? if ($countCat < '6'):?>
	  <a class="agregaCat" href="#agregarCat"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar caracteristica especial" /> <span>Agregar Caracteristicas</span></a>
	<? endif?>
	<? else:?>
	  <a class="agregaCat" href="#agregarCat"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar caracteristica especial" /><span>Agregar más caracteristicas</span></a>
	<? endif;?>
</div>
</aside>
<div id="finCom">
	<form id="comForm" action="<?=base_url()?>mi_local/publicarOferta/<?= $this->uri->segment(3)?>/<?= $this->uri->segment(4)?>" method="post">
		<strong>Información de Venta</strong>
		<span>
		  <label>Unidades en venta</label>
		  <em class="tipEnv"><img src="<?=base_url()?>assets/graphics/tip.png" alt="tip" />Inventario o exitencia</em>
		  <select name="cantPro">
		    <option value="1" selected="selected">1</option>
		  <?php for ($i=2;$i<=10;$i++){?>
		    <option value="<?=$i?>" <?if ($rowP->existencia == $i):?> selected="selected"<? endif;?>><?=$i?></option>
		  <?php } ?>
		  </select>
		</span>
		<span>
		 <label>Precio por pieza</label>
		 <input id="subTot" name="total" class="comInp" type="text" onkeyup="this.value=this.value.replace(/[^\d∂,.]/,'')" placeholder="Ejemplo 12,0000" value=" <? if ($rowP->precioLocal):?> <?=number_format($rowP->precioLocal);?>.00<?endif;?>" />
		</span>
		<span id="valDes">
			<label>¿Tienes un descuento?</label>
			<em class="tipEnv"><img src="<?=base_url()?>assets/graphics/tip.png" alt="tip" />¡ Haz tu producto atractivo !</em>
			<p><i>No</i>
			<input id="noEnv" type="radio" name="des" value="No" <?if ($rowP->descuento == '0'):?> checked<? endif;?> />
			</p>
			<p><i>Si</i>
			<input id="siEnv" type="radio" name="des" value="Si" <?if ($rowP->descuento != '0'):?> checked<? endif;?>/>
			</p>
		</span>
		<span id="precioDes"  <?if ($rowP->envio == 'No'):?> class="none"<? endif;?>>
			<label>Descuento</label>
            <input type="text" name="descuento" class="comInp" id="des" value="<?= $rowP->descuento;?>" onkeyup="this.value=this.value.replace(/\D/g, '')" maxlength="2" >
        </span>
		<!---<span id="valEnv">
			<label>¿El precio incluye envio a domicilio?</label>
			<p><i>No</i>
			<input id="no" type="radio" name="envia" value="No" <?if ($rowP->envio == 'No'):?> checked<? endif;?> />
			</p>
			<p><i>Si</i>
			<input id="si" type="radio" name="envia" value="Si" <?if ($rowP->envio == 'Si'):?> checked<? endif;?>/>
			</p>
		</span>-->
		<span id="precioEnvio"  <?if ($rowP->envio == 'No'):?> <? endif;?>>
			<label>Costo por Envio</label>
            <input type="text" name="costoEnvio" id="cosEnv" value="<?= $rowP->costoEnvio;?>" onkeyup="this.value=this.value.replace(/[^\d∂,.]/,'')" placeholder="Ejemplo 150">
        </span>
        <span id="diasEnvio" <?if ($rowP->envio == 'No'):?> <? endif;?>>
        	 <label>Dias de entrega</label>
			<select name="diasEntrega" id="diasEntrega">
				<option value="1 a 3 días" <?if ($rowP->diasEntrega == '1 a 3 dias'):?> selected="selected"<? endif;?>>1 a 3 días</option>
				<option value="3 a 5 días"<?if ($rowP->diasEntrega == '3 a 5 dias'):?> selected="selected"<? endif;?>>3 a 5 días</option>
				<option value="5 a 7 días"<?if ($rowP->diasEntrega == '5 a 7 dias'):?> selected="selected"<? endif;?>>5 a 7 días</option>
			</select>
        </span>
        <input type="hidden" value="<?= $rowP->ramaNombre;?>" name="rama"/>
		<span id="totAjax">
			<div id='totales'>
				<span><b>Precio por pieza</b>$ <?=$rowP->precioLocal?></span>
				<span><b>Costo envio</b><div class='comInpAja'>$ <?= $rowP->costoEnvio;?></div></span>
				<span><b>Descuento de <?= $rowP->descuento;?>% <img class="tip" title="Descuento calculado sobre precio por pieza mas costo por transacción $ <?=$rowP->precioLocal + $rowP->gananciaPt?>" src="<?=base_url()?>assets/graphics/gnome-help.png" /></b><div class='comInpAja'>$ -<?= $rowP->descuentoTotal;?></div></span>
				<span><b>Costo transacción bancaria</b><div class='comInpAja'>$ <?= $rowP->gananciaPt?></div></span>
				<span><b>Precio x por pieza publico</b><div class='comInpAja resaltar'>$ <?=number_format(ceil($rowP->ofertaPrecio))?></div></span>
			</div>
		</span>
		<span>
		  <input type="submit" class="narBotonBlaRig mtb10" value="Publicar producto">
		</span>
	</form>
</div>
<? $this->load->view('includes/forms/uploadMainFoto');?>
<? $this->load->view('includes/forms/uploadFotoPro');?>
<? $this->load->view('includes/forms/uploadCat');?>
<script>
jQuery(function($) {
	$('#subTot, #cosEnv').autoNumeric('init');
    
    $( "#no" ).click(function() {
    	$( "#precioEnvio").show( "slow" );
	});
	$( "#si" ).click(function() {
		$( "#precioEnvio").hide( "slow" );
	});
	
	$( "#noEnv" ).click(function() {
    	$( "#precioDes" ).hide( "slow" );
	});
	$( "#siEnv" ).click(function() {
		$( "#precioDes" ).show( "slow" );
	});
});
</script>
<script type="text/javascript">
jQuery(function($){
	//Gennera el zoom para las imagenes
	$('#mz').addimagezoom({
		descArea: '#description', 
		speed: 1500, 
		descpos: true, 
		imagevertcenter: true, 
		magvertcenter: true, 
		zoomrange: [2, 10],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true,
		magnifiersize: [400, 400]
	});
	
	//actualiza descripcion
	$("#ofeDes").editInPlace({
		url: '<?=base_url()?>ajax/editProDesc/<?= $rowP->ofertaID;?>',
		default_text: 'Agrega o edita la descripción de tu producto..',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "15",
		show_buttons: false,
	});
	
	//actualiza precio
	$("#ofePrec").editInPlace({
		url: '<?=base_url()?>ajax/editPrec/<?= $rowP->ofertaID;?>',
		default_text: 'Producto sin precio.',
		bg_over: "#FFF1E2",
		element_id: "tester",
		field_type: "text",
		show_buttons: false,
	});
	
	//actualiza descripcion
	$("#ofeTitu").editInPlace({
		url: '<?=base_url()?>ajax/editTitu/<?= $rowP->ofertaID;?>',
		default_text: 'Agrega el titulo de tu oferta.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	// Actualiza inventario
	$("#marcaOp").editInPlace({
		url: '<?=base_url()?>ajax/editMarca/<?= $rowP->ofertaID;?>',
		default_text: 'Escoge la Marca del articulo.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "<? foreach($marcas as $rowMar):?><?= $rowMar->marca.', '  ; ?><? endforeach; ?>"
	});
	// Actualiza status producto
	$("#statusPro").editInPlace({
		url: '<?=base_url()?>ajax/statusProducto/<?= $rowP->ofertaID;?>',
		default_text: 'Tu producto es nuevo o usado.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Nuevo,Usado"
	});
	// Actualiza color producto
	$("#colorPro").editInPlace({
		url: '<?=base_url()?>ajax/colorProducto/<?= $rowP->ofertaID;?>',
		default_text: 'Selecciona el color de tu producto.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Sin color,Amarillo,Naranja,Rojo,Violeta,Azul,Verde,Negro,Blanco,Gris"
	});
	// Actualiza garantia de producto
	$("#garPro").editInPlace({
		url: '<?=base_url()?>ajax/garantias/<?= $rowP->ofertaID;?>',
		default_text: 'Tiempo de garantia.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Sin garantia, 1 mes,3 meses,6 meses,9 meses,12 meses"
	});
	// Actualiza categoria
	$("#ramaOp").editInPlace({
		url: '<?=base_url()?>ajax/editRama/<?= $rowP->ofertaID;?>',
		default_text: 'Escoge la Marca del articulo.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "<? foreach($ramas as $rowRama):?><?= $rowRama->ramaNombre.', '  ; ?><? endforeach; ?>"
	});
	<? $ramaID = $this->uri->segment(4);?>
	<? foreach($catTipo as $rowCe):?>
	
	// Actualiza inventario
	<? $cat 	=	$this->ofertas_model->cargarCatInfo($rowCe->tipoID);?>
	$("#catOp<?= $rowCe->tipoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/insertSubCat/<?= $rowP->ofertaID;?>/<?= $rowCe->tipoID;?>',
		default_text: 'Click aquí para seleccionar.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "<? foreach($cat as $rowCatNo):?><?= $rowCatNo->descripcion.', '  ;?><? endforeach; ?>"
	});
	<? endforeach; ?>
	<? $tematicas 	=	$this->milocal_model->cargarTematicasRama($ramaID);?>
	$("#tematicaOp<?= $ramaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/addTematica/<?= $rowP->ofertaID;?>/<?= $ramaID;?>',
		default_text: 'Click aquí para seleccionar.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "<? foreach($tematicas as $rowTem):?><?= $rowTem->tematicaNombre;?>, <? endforeach; ?>"
	});
	
	$("#tipOp<?= $ramaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/addTipo/<?= $rowP->ofertaID;?>/<?= $ramaID;?>',
		default_text: 'Click aquí para seleccionar.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Oferta o promoción, Liquidacion, Costo regular"
	});
	
	
	<? foreach($catPrin as $rowC):?>
	//Actualiza caracteristicas
	$("#agregaCat<?= $rowC->caracteristicaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editCarat/<?= $rowC->caracteristicaID;?>',
		default_text: 'Ajusta o Edita el nombre de tu marca aquí.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "1",
		show_buttons: false,
	});
	<? endforeach; ?>
	
})
</script>
<? endforeach; ?>