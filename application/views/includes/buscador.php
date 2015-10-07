<div id="busquedas" itemscope itemtype="http://schema.org/WebSite">
	<meta itemprop="url" content="http://www.plazadelatecnologia.com/" />
<form id="formBuscar" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" action="<?=base_url()?>busqueda_rapida" method="get" />
	<meta itemprop="target" content="http://www.plazadelatecnologia.com/busqueda_rapida?query={query}" />
  <fieldset>
    <label>Encuentra rapidamente</label>
    <!--<span>
	    <select name="categorias" id="cat">
	    	<option value="all" selected="selected">Todas las categorias</option>
	    	
		    <option value="8">testing search</option>
		    <option value="">----------------------------------</option>
		    <option value="subcat-">elementos</option>
	    </select>
    </span>-->
    <input class="inputReg" id="bckBuscar" placeholder="Ejemplo: Tablets" itemprop="query-input" type="text" name="query">
    <input  id="buscar" type="submit"  value="Buscar" title="Buscar" >
    <input type="hidden" value="<?if(isset($hidden)) echo $hidden;?>" name="hidden" id="avanzada" >
  </fieldset>
</form>
<? if(isset($relacionadas)):?>
<ul>
	<li><strong>Búsquedas relacionadas:</strong></li>
<? foreach ($relacionadas as $palabraRel):?>
	<li class="rels"><a class="relB" href="#" title="<?=strtolower($palabraRel->texto)?>"><?=character_limiter($palabraRel->texto,20)?></a></li>
<? endforeach;?>
</ul>
<?endif;?>
</div>
<script>
jQuery(function($) {
/********************************************************************************************************************
Ajax para el autocompletar
********************************************************************************************************************/
	$(function() {
		var urlPost = (("https:" == document.location.protocol) ? "https://www.plazadelatecnologia.com/" : "http://www.plazadelatecnologia.com/");
		$("ul.subnav").parent().append("<span></span>"); //Muestra el dropdown 
		$("ul.topnav li span").click(function() { //Cuando el trigger acciona muestra estas etiquetas...
		//Sigue el evento y genera un slide Down de efecto para los resultados
		$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click
		$(this).parent().hover(function() {}, function(){
				$(this).parent().find("ul.subnav").slideUp('slow'); //Cuando el mouse esta arriba lo vuelve a quitar poco a poco
			});
		}).hover(function() {
			$(this).addClass("subhover"); //en over agrega la clase subhover
		}, function(){	//cuando se quita el over
			$(this).removeClass("subhover"); //remueve la clase subhover
		});
		/*CODIGO PARA generar la busqueda del resultado por ajax*/
		$("#bckBuscar").autocomplete(urlPost+"index.php/ajax/cargarTit", {
			width: 550,
			selectFirst: false
		});
		$("#bckBuscar").result(function(event, data, formatted) {
		if (data == '<h1>Busqueda por tipo</h1>' || data == '<h1>Busqueda por marca</h1>'){
			$("#bckBuscar").val('');
			alert("Por favor ingrese una opcion valida");
			}
		else {
			$("#avanzada").val(data[2]);
			$("#formBuscar").submit();
			}
		});
	});
	
	$('.relB').click(function(){
		var texto = $(this).attr('title');
		$('#formBuscar input[name=key]').val(texto);
		$('#formBuscar').submit();
	});
	
	$("#formBuscar input[name=key]").keypress(function(e) {
		$('#formBuscar input[name=hidden]').val('');
	});
});
</script>