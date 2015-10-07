<? $user  = $this->session->userdata('user');?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#inboxLocal').dataTable();
	"bSort": false,
    "iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
});
</script>
<aside id="asideInb">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuLocal');?>
	</ul>
</aside>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Modificar Contraseña</h3>
	<div id="inboxMilocal">
		<div id="inbWrap">
		<form action="<?=base_url()?>mi_local/updatePass" method="post">
			<fieldset>
				<input class="regIn" type="password" name="passwordNow" placeholder="Contraseña Actual" value=""/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="password" name="passwordNew" placeholder="Nueva Contraseña" value=""/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="password" name="passwordAgain" placeholder="Repetir Contraseña" value="" />
			</fieldset>
		<input class="nBotonBig" type="submit" value="Modificar" />
		</form>
		</div>
	</div>
</section>