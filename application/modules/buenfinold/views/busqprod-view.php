<style>
	.bjqs-markers{
		top: 440px !important;
	}
</style>
<!-- Custom styles for this template -->
<!--<link href="carousel.css" rel="stylesheet">-->
<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">

<!--Barra roja--> 
				<div class="col-lg-12 barraroja">
					<div class="col-md-6">
						<img class="img-responsive" src="<?=base_url()?>assets/graphics/BF2015/banner02_960.png" />
					</div>
					<div class="col-md-6">
						<h3 class="formu1">BUSCA TU PLAZA:</h3>
						<form class="formu" method="post" action="<?=base_url()?><?=$this->uri->segment(1)?>">
							<select class="btn btn-default dropdown-toggle" name="plaza" onchange="this.form.submit()">
									
								<?  
									$opciones[1]    = 'SELECCIONA TU PLAZA';
									$opciones[2] 	= 'ACAPULCO';
									$opciones[3] 	= 'AGUASCALIENTES';
									$opciones[4] 	= 'CHIHUAHUA';
									$opciones[5] 	= 'COACALCO';
									$opciones[6] 	= 'CUERNAVACA';
									$opciones[7] 	= 'CULIACAN';
									$opciones[8] 	= 'GUADALAJARA';
									$opciones[9] 	= 'GUADALAJARA2';
									$opciones[10] 	= 'LEON';
									$opciones[11] 	= 'LOSREYES';
									$opciones[12] 	= 'MERIDA';
									$opciones[13] 	= 'MEXICO';
									$opciones[14] 	= 'MONTERREY';
									$opciones[15] 	= 'MORELIA';
									$opciones[16] 	= 'PERICENTRO';
									$opciones[17] 	= 'CANCUN';
									$opciones[18] 	= 'PUEBLA'; 
									$opciones[19] 	= 'QUERETARO';
									$opciones[20] 	= 'SANLUISPOTOSI';
									$opciones[21] 	= 'TAMPICO';
									$opciones[22] 	= 'TIJUANA';
									$opciones[23] 	= 'TOLUCA';
									$opciones[24] 	= 'TORREON';
									$opciones[25] 	= 'VERACRUZ';
									$opciones[26] 	= 'VILLAHERMOSA';
						
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
				</div>
				<!--Termina barra roja-->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<span class='bf02iz_tit'><?= $plaza =  $this->input->post('plaza');?> </span>
								<span class="bf02iz_tit"><?= $plaza1 = $this->uri->segment(3);?></span>
								<!--carousel-->
								<div class="row">
									
				                   <div class="col-md-12">
				                   	<?if($plaza == '' AND $plaza1 == ''):?>
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
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/8" title="HDD Seagate">
											    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_01.jpg" />
											    			</a>
											    		</li>
											    		<li class="bjqs-slide">
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/1" title="HDD Seagate">
											    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_02.jpg" />
											    			</a>
											    		</li>
											    		<li class="bjqs-slide">
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/28" title="HDD Seagate">
											    				<img width="770" height="390" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/stage_03.jpg" />
											    			</a>
											    		</li>
											    		<li class="bjqs-slide">
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/73" title="HDD Seagate">
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
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/25" title="HDD Seagate">
											    				<img src="<?=base_url()?>assets/graphics/BF2015/promo_arriba01.jpg" width="300" height="250" class="bf02der_300x250" />
											    			</a>
											    		</li>
											    		<li class="bjqs-slide">
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/155" title="HDD Seagate">
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
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/27" title="HDD Seagate">
											    				<img src="<?=base_url()?>assets/graphics/BF2015/promoabajo01.jpg" width="300" height="180" class="bf02der_300x180" /> 
											    			</a>
											    		</li>
											    		<li class="bjqs-slide">
											    			<a class="texInd" href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/72" title="HDD Seagate">
											    				<img src="<?=base_url()?>assets/graphics/BF2015/promoabajo02.jpg" width="300" height="180" class="bf02der_300x180" /> 
											    			</a>
											    		</li>
											    		
										      		</ul>
													<!-- Fin Slider-->
									        	</div>
									        </Div>
									        </Div>
									    </DIV>
									    <?endif?>
				                  </div>
				
				             </div>
								<!--Termina carousel-->
								<!--Detalle Articulo-->
								<div class="col-lg-12">
								 <? 
							        $n = 1;
							        foreach($productos as $listaPro):
							        if($n < 3){
							        	$clase = 'BF03blk';
							        }else{
										$clase = 'BF03blkd';
										$n = 0;
									}
							      ?>
							      <a href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/<?=$listaPro->id;?>">
				                    <div class="col-sm-4 col-lg-4 col-md-4 bonito">
				                        <div class="col-sm-7">
				                        	<span class="tit"><strong><?= substr($listaPro->ofertaTitulo, 0, 25);?></strong></span>
				                        	<p class="letra"><strong><?= substr($listaPro->nombreCte,0, 15);?></strong></p>
				                        	<p class="letra"><?= substr($listaPro->ofertaDescripcion, 0, 50);?></p>
				                        	<p class="letra">Local(es): <?= substr($listaPro->localcte, 0, 25)?></p>
								            <p class="letra ubic"><?= $listaPro->precio > 0 ? '$ ' . number_format($listaPro->precio) : '-' . $listaPro->campLib1;?></p>
				                        </div>
				                        <div class="col-sm-5">
				                        	<center><img class="img-responsive imgmax" src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/<?=$listaPro->id;?>.jpg" /></center>
				                        </div>
				                    </div> 
				                    </a>
				                     <?
								        $n ++;
								        endforeach;
								     ?>
								  </div>
				                 <!--Termina detalle articulo-->
				                 <div class="col-lg-12">
				                 	<span class='BF04_seccion'> ¡MÁS OFERTAS! </span>
				                 </div>
				                 <!--Detalle mas ofertas articulo-->
				                 <div class="col-lg-12">
				                 	<?foreach($masofertas as $Pro):?>
				                 	<a  href="http://www.plazadelatecnologia.com/buenfin/caracteristicas/<?=$Pro->id;?>" title="<?=$Pro->id;?>">
				                 	<div class="col-sm-12 col-lg-12 col-md-12 bonito2">
				                 		<div class="col-sm-4">
				                 			<center><img class="img-responsive imgmax" src="<?=base_url()?>assets/graphics/BF2015/<?=$Pro->id;?>.jpg" /></center>
				                 		</div>
				                 		<div class="col-sm-4">
				                 			<span class="tit"><?= substr($Pro->ofertaTitulo, 0, 23);?></span>
				                 			<p class="letra"><?= $Pro->nombreCte;?></p> 
				                 			<p class="letra"><?= substr($Pro->ofertaDescripcion, 0, 70);?></p>
				                 			<p class="letra">Plaza: <?= substr($Pro->plaza, 0, 35);?></p>
				                 			<p class="letra">Local(es): <?= substr($Pro->localcte, 0, 30);?></p>
				                 		</div>
				                 		<div class="col-sm-4 prec" style="float: right;">
				                 			<center><?= $Pro->precio > 0 ? '$ ' . number_format($Pro->precio) : '- ' . $Pro->campLib1;?></center>
				                 		</div>
				                 	</div>
				                 	<?endforeach;?>
				                 </div>
				                 </a>
				                 <!--Termina detalle mas ofertas-->
				            </div>
						</div>
					</div> 
					
					<!--<a href="http://www.plazadelatecnologia.com/buenfin" class="stickyfloat_element">
				  	<center><img src="http://www.plazadelatecnologia.com/assets/graphics/BF2015/banner.jpg" /></center>
				 </a>-->
				</div>

<script>
	$('#BF02IZ').bjqs({

        'width' : 770,
        
        'height': 390,

        'responsive' : true,

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

        'responsive' : true,
 
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

        'responsive' : true,

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