<style>
	.bjqs-markers{
		top: 440px !important;
	}
</style>
	
    <DIV ID='BF01'>
       <div id='BF01_s'><img src="<?=base_url()?>assets/graphics/BF2015/sombra01.png" width="1149" height="20" /> </div>
      <Div id='BF01a'>
        
        
        <div id='BF01a1'>
        <img src="<?=base_url()?>assets/graphics/BF2015/logo_buenfin.png" class="logobf" />
        <img src="<?=base_url()?>assets/graphics/BF2015/slogan.png"class="sloganbf" />
        <img src="<?=base_url()?>assets/graphics/BF2015/separa01.png"  class="separadobf" />
        </div>
        
        <div id='BF01a2'>
           <div id='BF01a2a'>
          BÚSCA TU PLAZA
          </div>
          
          <div id='BF01a2b'>
          <form id="" method="post" action="<?=base_url()?><?=$this->uri->segment(1)?>">
	<select name="plaza" onchange="this.form.submit()">
		<?  
			$opciones[1] 	= 'ACAPULCO';
			$opciones[2] 	= 'AGUASCALIENTES';
			$opciones[3] 	= 'CHIHUAHUA';
			$opciones[4] 	= 'COACALCO';
			$opciones[5] 	= 'CUERNAVACA';
			$opciones[6] 	= 'CULIACAN';
			$opciones[7] 	= 'GUADALAJARA';
			$opciones[8] 	= 'GUADALAJARA2';
			$opciones[9] 	= 'LEON';
			$opciones[10] 	= 'LOS REYES';
			$opciones[11] 	= 'MERIDA';
			$opciones[12] 	= 'MEXICO';
			$opciones[13] 	= 'MONTERREY';
			$opciones[14] 	= 'MORELIA';
			$opciones[15] 	= 'PERICENTRO';
			$opciones[16] 	= 'CANCUN';
			$opciones[17] 	= 'PUEBLA'; 
			$opciones[18] 	= 'QUERETARO';
			$opciones[19] 	= 'SAN LUIS P';
			$opciones[20] 	= 'TAMPICO';
			$opciones[21] 	= 'TIJUANA';
			$opciones[22] 	= 'TOLUCA';
			$opciones[23] 	= 'TORREON';
			$opciones[24] 	= 'VERACRUZ';
			$opciones[25] 	= 'VILLAHERMOSA';

			;?>
		<? for($i = 1; $i <= count($opciones); $i++):?>
		<option value="<?=$opciones[$i]?>" <?if($opciones[$i] == $order):?> selected <?endif;?>> <?=$opciones[$i]?></option>
		<? endfor;?>
	</select>
	<?if($hidden):?>
	<input type="hidden" name="keyhide" value="<?=$hidden?>" />
	<? endif;?>
</form>
          </div>
        </div></Div>
       <div id='break'> </div>
    </DIV>
    <span class='bf02iz_tit'><?= $plaza = $this->input->post('plaza');?> </span>
    
    <DIV ID='BF02'>
    
      <Div id='BF02W'>
		<Div ID='BF02IZ'>
         
		
			<!-- Inicio Slider-->
		  		<ul class="bjqs">
		    		<!--<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/promoSLP.jpg" width="770" height="390" />
		    			</a>
		    		</li>-->
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_01.jpg" />
		    			</a>
		    		</li>
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_02.jpg" />
		    			</a>
		    		</li>
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_03.jpg" />
		    			</a>
		    		</li>
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_04.jpg" />
		    			</a>
		    		</li>
	      		</ul>
			<!-- Fin Slider-->

        </Div>
        
        <Div ID='BF02DER'>
        
        	<div id="BF02DER_1" class="bf02der_300x250">
        		<!-- Inicio Slider-->
		  		<ul class="bjqs">
		    		<!--<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/300x250px.jpg" width="300" height="250" class="bf02der_300x250" />
		    			</a>
		    		</li>-->
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/promo_arriba01.jpg" width="300" height="250" class="bf02der_300x250" />
		    			</a>
		    		</li>
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/promo_arriba02.jpg" width="300" height="250" class="bf02der_300x250" />
		    			</a>
		    		</li>
		    		
	      		</ul>
				<!-- Fin Slider-->
        	</div>
        	<div id="BF02DER_2" class="bf02der_300x180">
        		<!-- Inicio Slider-->
		  		<ul class="bjqs">
		    		<!--<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/300x180px.jpg" width="300" height="180" class="bf02der_300x180" /> 
		    			</a>
		    		</li>-->
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/promoabajo01.jpg" width="300" height="180" class="bf02der_300x180" /> 
		    			</a>
		    		</li>
		    		<li class="bjqs-slide">
		    			<a class="texInd" href="http://www.plazadelatecnologia.com/accesorios/oferta/Disco_Duro_Externo_Seagate_4tb_Backup_Plus_Usb_30_Y_20/2172/s/2015-06-09" title="HDD Seagate">
		    				<img src="<?=base_url()?>assets/graphics/BF2015/promoabajo02.jpg" width="300" height="180" class="bf02der_300x180" /> 
		    			</a>
		    		</li>
		    		
	      		</ul>
				<!-- Fin Slider-->
        	</div>
        </Div>
        </Div>
    </DIV>
    <DIV ID='BF03'>
		<div id='BF03wrap'>
			<!--Inicia recuadro producto-->
        <? 
        $n = 1;
        foreach($productos as $listaPro):
        if($n < 3){
        	$clase = 'BF03blk';
        }else{
			$clase = 'BF03blkd';
			$n = 0;
		}
		//echo $n;
        ?>
        <a href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/<?=$listaPro->id;?>" title="">
        <div class='<?=$clase; ?>'>
             <Div class='BF03_wrap'>      
                <div class='BF03_tit'>
                <?= substr($listaPro->ofertaTitulo, 0, 13);?>
                </div>
                
                <div class='BF03_empresa'>
                <?= substr($listaPro->nombreCte,0, 15);?>
                </div>
                
                <div class='BF03_des'>
                <?= substr($listaPro->ofertaDescripcion, 0, 35);?>
                </div>
              <div class='precio BF03_precio'>
              	<?= $listaPro->precio > 0 ? '$ ' . number_format($listaPro->precio) : '-' . $listaPro->campLib1;?>
              </div>
                
               </Div>
        <div class='BF03_foto'><img src="<?=base_url()?>assets/graphics/BF2015/<?= $listaPro->id;?>.jpg" /></div>
        </div>
        </a> 
        <?
        $n ++;
        endforeach;
        ?>
        <!--Termina recuadro producto-->

<!--Comienza Mas Ofertas-->


    <DIV ID='BF04'>
     <div id='BF04_WRAP'>
     <span class='BF04_seccion'> MÁS OFERTAS</span>
      
      <!--Inicia recuadro mas ofertas-->
      <?foreach($masofertas as $Pro):?>
      <a  href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/<?=$Pro->id;?>" title="<?=$Pro->id;?>">
      <div class='BF04_item'>	
      <div class='BF04_item_foto'>
      	<img src="<?=base_url()?>assets/graphics/BF2015/<?=$Pro->id;?>.jpg" width="160px" height="124px" />
      	</div>
        <div class='BF04_item_txt'>         
          <div class='BF04_item_titulo'><?= substr($Pro->ofertaTitulo, 0, 11);?></div>
          <div class='BF04_item_empresa'><?= $Pro->nombreCte;?></div>
          <div class='BF04_item_descripción'><?= substr($Pro->ofertaDescripcion, 0, 35);?></div>
          <div class='BF04_item_descripción'>Plaza: <?= substr($Pro->plaza, 0, 35);?></div>
         </div>
      	<div class='precio BF03_precio'>
      		<?= $Pro->precio > 0 ? '$ ' . number_format($Pro->precio) : '- ' . $Pro->campLib1;?>
      	</div>
      	<!--<span class='bf03precio'></span>-->
     </div>
     </a>
     <?endforeach;?>
     <!--Termina recuadro mas ofertas-->
     </div>
    </DIV>

    <DIV ID='BF05'>
    <div id='BF05banner'>
    <img src="<?=base_url()?>assets/graphics/BF2015/banner01.jpg" width="1100" height="133" />
    </div>
    </DIV> 
    
    
 <a href="http://www.plazadelatecnologia.com/buenfin" class="stickyfloat_element">
  	<center><img src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/banner.jpg" /></center>
  </a>
  
  
<script>
	$('#BF02IZ').bjqs({

        'width' : 770,
        
        'height': 390,

        'responsive' : false,

        'showcontrols' : false,

        'centercontrols' : false,

        'centermarkers' : false,

        'usecaptions' : false,

        'animspeed' : 4000,

        'nexttext' : '<img src="http://www.plazadelatecnologia.com/assets/graphics/nextSlider.png" alt="Siguiente" />',

        'prevtext' : '<img src="http://www.plazadelatecnologia.com/assets/graphics/prevSlider.png" alt="Anterior" />',

    });
    
    $('#BF02DER_1').bjqs({

        'width' : 300,
        
        'height': 250,

        'responsive' : false,

        'showcontrols' : false,

        'centercontrols' : false,

		'showmarkers' : false,

        'centermarkers' : false,

        'usecaptions' : false,

        'animspeed' : 4000

    });
    
    $('#BF02DER_2').bjqs({

        'width' : 300,
        
        'height': 180,

        'responsive' : false,

        'showcontrols' : false,

        'centercontrols' : false,

		'showmarkers' : false,

        'centermarkers' : false,

        'usecaptions' : false,

        'animspeed' : 4000

    });
    
</script>
<!-- Facebook Pixel Code Buen fin -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '533793683440327');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=533793683440327&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
