<form id="guia" class="guia-popup" action="<?=base_url()?>mi_local/confirmaFecha" method="post" accept-charset="utf-8">
<fieldset class="mt20">
  <label>Numero de guía</label>
  <input class="guiaInp" name="numeroGuia" type="text" placeholder="Escribe el numero de guía. Ejemplo: 123123"/>
</fieldset>
<fieldset>
  <label>Empresa</label>
  <input class="guiaInp" name="empresaEnvio" type="text" placeholder="¿Con que empresa mandaste el equipo? Ejemplo: DHL"/>
</fieldset>
<fieldset>
  <input type="hidden" name="ofertaID" value="<?= $this->uri->segment(3);?>"/>
  <input type="hidden" name="ventaFolio" value="<?= $this->uri->segment(5);?>"/>
  <input class="nBotonBigRig ml10 mt10" type="submit" value="Enviar" />
</fieldset>
</form>
       
		