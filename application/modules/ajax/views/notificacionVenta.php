<? foreach($venConf as $rowVC):?>
<?if ($rowVC->cuentaVenta != '0'):?> <i></i><b><?= $rowVC->cuentaVenta;?><? endif;?></b>
<? endforeach; ?>