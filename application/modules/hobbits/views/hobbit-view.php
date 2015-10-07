<link rel="stylesheet" href="/resources/demos/style.css">
<? $user  = $this->session->userdata('user');?>
 <script>
  $(function() {
    $( "#d" ).datepicker({
      numberOfMonths: 3,
      showButtonPanel: true,
      'dateFormat': 'yy-mm-dd',
    });
  });
  </script>
  <script>
  $(function() {
    $( "#a" ).datepicker({
      numberOfMonths: 3,
      showButtonPanel: true,
      'dateFormat': 'yy-mm-dd',
    });
  });
  </script>
  
<aside id="asideInb">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuAdmin');?>
	</ul>
</aside>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Reporte del dia PT</h3>
	<div id="wrapDates">
	  <form id="wrapDate" method="post" action="<?=base_url()?>hobbits/buscarFecha">
		<fieldset><label>De:</label> <input class="fecha" name="de" type="text" id="d"></fieldset>
		<fieldset><label>a:</label> <input class="fecha" name="a" type="text" id="a"></fieldset>
		<input class="go" type="submit" value="buscar" />
	  </form>
	</div>
	<div id="panel">
		<div id="wrapPanel">
			<? $total = 0;?>
			<? $comisiones = 0;?>
			
			<? $transacciones = count($pagadas);?>
			<? foreach($pagadas as $rowP):?>
			<? $total += $rowP->total;?>
			<? $comisiones += $rowP->comisionBanco;?>
			<? endforeach; ?>
			<h1 class="mt20 mainRep">Transacciones y totales</h1>
			<p><b>Compras / Transacciones</b> <em><?= $transacciones;?></em></p>
			<p><b>Total Pagadas</b> <em>$<?= number_format($total);?></em></p>
			<p><b>Comisiones Bancos</b> <em>$<?= number_format($comisiones);?></em></p>
			
			
			<? $solicitada 	= $this->hobbits_model->cargarPagadasTipos('solicitado');?>
			<? $pendientes = 0;?>
			<? $totalSolicitado = 0;?>
			<? $pagadoLocal = 0;?>
			<? $comisionesSolicitado = 0;?>
			<? foreach($solicitada as $rowS):?>
			<? $comisionesSolicitado += $rowS->comisionBanco;?>
			<? $pagadoLocal += $rowS->pagoLocal;?>
			<? $totalSolicitado += $rowS->total;?>
			<? if($rowS->statusPagoLocal == 'no'):?><? $pendientes += $rowS->pagoLocal;?><? endif?>
			<? endforeach; ?>
			<? $totalSol = $totalSolicitado - $comisionesSolicitado;?>
			<? $banco = $totalSol - $pagadoLocal;?>
			
			
			
			<h1 class="mt20 mainRep">Información de traspasos</h1>
			<? $solPagadas 	= $this->hobbits_model->cargarPagadasSolicitadas();?>
			
			<? $pagosLocales = 0;?>
			<? foreach($solPagadas as $rowPs):?>
			<? $pagosLocales += $rowPs->pagoLocal;?>
			<? endforeach; ?>
			
			<? $dinero = $totalSol - $pagosLocales;?>
			
			<p><b>Dinero Solicitado en traspasos</b> <em>$<?= number_format($totalSol);?></em></p>
			<!-- Busca transacciones transferidas a los bancos -->
			<p><b>Pagos a locales</b> <em>$<?= number_format($pagadoLocal);?></em></p>
			<p><b>Dinero pagado a locales</b> <em>$<?= number_format($pagosLocales);?></em></p>
			<p><b>Pagos Pendientes a locatarios</b> <em>$<?= number_format($pendientes);?></em></p>
			<p><b>Comisiones pagadas</b> <em>$<?= number_format($comisionesSolicitado);?></em></p>
			
			
			<p><b>Dinero en la Cuenta</b> <em>$<?= number_format($dinero);?></em></p>
			<p><b>Ganancias</b> <em>$<?= number_format($banco);?></em></p>
			
			<!-- Solicitudes de locales -->
			<h1 class="mt20 mainRep">Locales en linea</h1>
			<p><b>Solicitud de locales en linea</b> <em> <?= count($localesenlinea);?></em></p>
			<p><b>Locales activos en linea</b> <em> <?= count($localesActivos);?></em></p>
			
			<!-- Informacion ofertas -->
			<? $activas		= $this->hobbits_model->ofertasInfo('Activo');?>
			<? $borradas	= $this->hobbits_model->ofertasInfo('Borrado');?>
			<? $cuentaActivas = count($activas);?>
			<? $cuentaBorradas = count($borradas);?>
			<? $sumaOfertas = $cuentaActivas + $cuentaBorradas;?>
			
			<h1 class="mt20 mainRep">Información de ofertas</h1>
			<p><b>Ofertas Activas</b> <em> <?= $cuentaActivas;?></em></p>
			<p><b>Ofertas Borradas</b> <em> <?= $cuentaBorradas;?></em></p>
			<p><b>Total de Ofertas</b> <em> <?= $sumaOfertas;?></em></p>
			
			<!-- Contactos de renta de locales -->
			<h1 class="mt20 mainRep">Renta de locales</h1>
			<p><b>Solicitan información de Renta de locales</b> <em> <?= count($infoLocales);?></em><a href="<?=base_url()?>hobbits/rentadelocales">(+) Ver más</a></p>
			
		</div>
	</div>
</section>
