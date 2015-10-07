<? if ($rama):?><h1>Busqueda por tipo</h1><? endif?>
<? foreach($rama as $rowR):?>

<? 

$titulo = $rowR->ofertaTitulo;
$corte = substr($titulo, 0, 50);
$ultimoEspacio = strrpos($corte, " "); 
$limpia = substr($corte, 0, $ultimoEspacio);
// add three dots...
$cadena = $limpia . "...";
echo $cadena;

?>
	

<? endforeach; ?>

<? if ($marca):?><h1>Busqueda por marca</h1><? endif?>
<? foreach($marca as $rowM):?>

 <?= "{$rowM->marca}|{$rowM->marcaID}\n";?>

<? endforeach; ?>


