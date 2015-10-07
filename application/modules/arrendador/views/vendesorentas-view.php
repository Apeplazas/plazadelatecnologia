<div id="contentRent">
<span id="spanRent"><img src="<?=base_url()?>assets/graphics/cbza_terreno.jpg" alt="Renta de oficinas en Plaza de la Tecnologia" /></span>
<section id="renta">
<h1>Vende o Rentanos tu Local o Terreno</h1>
<p>En APE Plazas estamo en constante crecimiento y en búsqueda constante de nuevos sitios para realizar Plazas. <br>
	Si tienes un Terreno o un Local en ¡Envíanos ya tu información para evaluar la zona de tu inmueble. <br><strong>Buscamos que tu local o terreno tenga...</strong></p>
<aside>
	<ul id="serv">
		<li>
			<span><img src="<?=base_url()?>assets/graphics/ubicacion_estrategica.png" alt="Ubicación Estrategica" /></span>
			<strong>Ubicacion Estrategica</strong>
			<p>Buscamos terrenos o locales en las colonias Centro de las principales ciudades del país, para que las Plazas esten en un punto de fácil acceso para todo público y sea un negocio referente.</p>
		</li>
		<li>
			<span><img src="<?=base_url()?>assets/graphics/afluencia.png" alt="Gran Afluencia peatonal y vehicular" /></span>
			<strong>Gran afluencia peatonal y vehicular</strong>
			<p>Necesitamos el paso constante de peatones y vehículos, líneas de transporte colectivo.</p>
		</li>
		<!--<li>
			<span><img src="<?=base_url()?>assets/graphics/seguridad.png" alt="Seguridad Constante" /></span>
			<strong>Seguridad constante</strong>
			<p>La Plaza está vigilada con personal capacitado durante las 24 horas los 365 días del año, realizamos un monitoreo constante por circuito cerrado de televisión con grabación.</p>
		</li>-->
		<li>
			<span><img src="<?=base_url()?>assets/graphics/publicidad.png" alt="Publicidad Permanente" /></span>
			<strong>Requisitos</strong>
			<p><strong>Local naturista </strong> <br>&bull;Frente m&iacute;nimo 5m
<br>&bull;Superficie mínima 60m 
<br>&bull;Flujo de gente mínima de 800 personas en una hora 
<br>&bull;Nivel socioeconómico Medio / medio bajo
​<br>&bull;10 Años de contrato​
<br><br><strong>Terreno para Plaza Comercial</strong>
<br>&bull;Frente m&iacute;nimo 12m 
<br>&bull;Superficie mínima 1,000m<sup>2</sup>
<br>&bull;Flujo de gente mínima de 800 personas en una hora 
<br>&bull;Nivel socioeconómico Medio / medio bajo
​<br>&bull;venta o renta a 30 años con capacidad de subarriendo​</p>
		</li>
		<!--<li>
			<span><img src="<?=base_url()?>assets/graphics/localenlinea.png" alt="Local en Linea" /></span>
			<strong>Local en linea</strong>
			<p>¡Ofrece tus servicios ahora por Internet! Te ofrecemos un espacio virtual donde puedes recibir cotizaciones publicar y contactar a más clientes por nuestra página web, que cuenta con 71 mil visitas mensuales.</p>
		</li>-->
	</ul>
</aside>
<form method="post" action="<?=base_url()?>arrendador/guardarDatos" enctype="multipart/form-data">
<h2>¿Vendes o Rentas?</h2>
	<fieldset>
	  <input class="idleField" type="radio" name="tipo" value="Renta">Renta
	</fieldset>
	<fieldset>
	  <input class="idleField" type="radio" name="tipo" value="Renta">Venta
	</fieldset>
	<fieldset>
		<label>Fotos del terreno o local</label> <blockquote> <span style="color:#adadad;">Elige varias fotos a la vez.</span></blockquote>
	  	<input class="regIn required email idleField" accept="image/jpeg, image/png" type="file" name="fotosInterior[]" multiple required />
	</fieldset>
	<fieldset>
		<label>Fotos de la calle</label>
	  	<input class="regIn required email idleField" accept="image/jpeg, image/png" type="file" name="fotosExterior[]" multiple required />
	</fieldset>
	<fieldset>
		<span style="color:#000;">A continuación escribe la dirección del local o terreno, para localizarlo en el mapa</span>
		<input id="pac-input" class="controls" type="text" placeholder="Escribe la dirección y arrastra el icono hasta seleccionar la ubicacion exacta.">
	  	<div id="mapCanvasTwo"></div>
	  	<input type="hidden" name="googleMaps" id="googleMaps" value="" />
		<input type="hidden" name="googleEstado" id="googleEstado" value="" />
		<input type="hidden" name="googleDelegacion" id="googleDelegacion" value="" />
		<input type="hidden" name="googleCp" id="googleCp" value="" />
		<input type="hidden" name="googleColonia" id="googleColonia" value="" />
	</fieldset>
	<fieldset>
		<span style="color:#adadad;">Puedes seleccionar el muñequito naranja  y colocarlo dentro del mapa para asegurarte que colocaste la ubicación correcta.</span>
		<br><label>Planos del local</label>
	  	<input class="regIn idleField" accept="image/jpeg, image/png" type="file" name="planos[]" multiple />
	</fieldset>
	<fieldset>
		<input class="regIn idleField" type="text" name="usoSuelo" placeholder="Uso de suelo" />
	</fieldset>
	<fieldset>
	<p class="aviso"><input name="privacidad" checked="" type="checkbox" value="Leido">
	He leido el <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">aviso de privacidad</a></p>
	</fieldset>
	<fieldset>
	  <input class="nBotonBig fwlight" type="submit" value="Enviar Información">
	</fieldset>
	</form>
</section>
</div>

<script>
		
		
	$(document).ready(function(jQuery) {	
	
		var geocoder;
		geocoder = new google.maps.Geocoder();
		var mapOptions = {
	    	center: new google.maps.LatLng(21.0000, -102.3667),
	    	zoom: 5
	  	};
		var map = new google.maps.Map(document.getElementById('mapCanvasTwo'),
	    mapOptions);

	  	var input = /** @type {HTMLInputElement} */(
			document.getElementById('pac-input'));
	
	  	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	
	  	var autocomplete = new google.maps.places.Autocomplete(input);
	  	autocomplete.bindTo('bounds', map);
	
	  	var marker = new google.maps.Marker({
	    	map: map,
	    	draggable:true,
	    	anchorPoint: new google.maps.Point(0, -29)
	  	});
	
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
	    	marker.setVisible(false);
	    	var place = autocomplete.getPlace();
	    	if (!place.geometry) {
	      		return;
	    	}
	
	    	//Si el lugar cuenta con datos presentarlo en el mapa
	    	if (place.geometry.viewport) {
	    		
	      		map.fitBounds(place.geometry.viewport);
	      		
	    	}else{
	    		
	      		map.setCenter(place.geometry.location);
	      		map.setZoom(17);  // Why 17? Because it looks good.
	    	}
	    	
	    	marker.setIcon(/** @type {google.maps.Icon} */({
	      		url: place.icon,
	      		size: new google.maps.Size(71, 71),
	      		origin: new google.maps.Point(0, 0),
	      		anchor: new google.maps.Point(17, 34),
	      		scaledSize: new google.maps.Size(35, 35)
	    	}));
	    
	    	marker.setPosition(place.geometry.location);
	    	marker.setVisible(true);
	    
	    	//Inserta datos de Google
	    	$('#googleMaps').val(place.geometry.location);
			actualizaDatosGoogle(place.address_components);
	
	    	var address = '';
	    	if (place.address_components) {
	    		
	      		address = [
	        		(place.address_components[0] && place.address_components[0].short_name || ''),
	        		(place.address_components[1] && place.address_components[1].short_name || ''),
	        		(place.address_components[2] && place.address_components[2].short_name || '')
	      		].join(' ');
	    	}
	
	  	});
	  
		function actualizaDatosGoogle(datos){

			$.each(datos,function(key,val){
			
				//Inserta Estado
				if(val.types[0] == 'administrative_area_level_1')
					$('#googleEstado').val(val.long_name);
					
				//Inserta Delegacion
				if(val.types[0] == 'sublocality_level_1')
					$('#googleDelegacion').val(val.long_name);
				
				//Inserta CP
				if(val.types[0] == 'postal_code')
					$('#googleCp').val(val.long_name);
					
				//Inserta Colonia
				if(val.types[0] == 'neighborhood')
					$('#googleColonia').val(val.long_name);
				
			});	
			
		}
	  
		function geocodePosition(pos) {
			geocoder.geocode({
				latLng: pos
		  	}, function(responses) {
		    	if (responses && responses.length > 0) {
		    		actualizaDatosGoogle(responses[0].address_components);
		    		$('#googleMaps').val(responses[0].geometry.location);
		    	} else {
		    	}
		  	});
		}
	  
		google.maps.event.addListener(marker, 'dragend', function(){
			geocodePosition(marker.getPosition());
		});
	
	
	});	
	
	</script>