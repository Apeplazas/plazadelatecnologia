<? $user = $this->session->userdata('user');?>

<? if($user['uid'] == ''):?>
<form id="muroInteraccion"  class="answer border formLocal hideForm" action="<?=base_url()?>inicio/comentario/<?= $this->uri->segment(4);?>" method="post">
<textarea id="pregComm" name="comentario" placeholder=" Pregunta y cotiza en nuestra comunidad aqui..."></textarea>
<input type="hidden"  value="oferta" name="tipo"/>
<input type="hidden"  value="<?= $this->uri->uri_string()?>" name="url"/>
<br />
<a  class="nBotonBig ml10 mt10 log" href="#login_form" href="<?=base_url()?>registrate/accesoDinamica">Solicita mas Información</a>
</form>

<? else:?>
<form id="muroInteraccion"  class="answer border formLocal hideForm" action="<?=base_url()?>inicio/comentario/<?= $this->uri->segment(4);?>" method="post">
<textarea id="pregComm" name="comentario" placeholder=" Pregunta y cotiza en nuestra comunidad aqui..."></textarea>
<input type="hidden"  value="oferta" name="tipo"/>
<input type="hidden"  value="<?= $this->uri->uri_string()?>" name="url"/>
<br />
<input type="submit"  id="submit" class="nBotonBig ml10 mt10" value="Enviar pregunta o comentario" />
</form>
<? endif;?>