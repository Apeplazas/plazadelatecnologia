<? foreach($notificaciones as $row):?>
<img src="<?=base_url()?>assets/graphics/inbox-noactive.png" alt="Tu Inbox" /> <?if ($row->cuenta != '0'):?><span><?= $row->cuenta;?></span><?endif;?>
<? endforeach; ?>