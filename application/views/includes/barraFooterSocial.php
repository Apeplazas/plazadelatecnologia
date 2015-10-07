<script type="text/javascript">
$(function() {
    $(window).scroll(function(){
        var distanceTop = $('#foot').offset().top - $(window).height();
 
        if  ($(window).scrollTop() > distanceTop)
            $('#slidebox').animate({'right':'0px'},300);
        else
            $('#slidebox').stop(true).animate({'right':'-430px'},100);
    });
 
    $('#slidebox .close').bind('click',function(){
        $(this).parent().remove();
    });
});
</script>
<div id="slidebox">
    <a class="close"></a>
    <a class="socialSlid" href="https://www.facebook.com/plazadelatecnologia" target="_blank" title="Siguenos en Facebook"><img src="<?=base_url()?>assets/graphics/siguenosenfacebook.png" alt="Siguenos en Facebook" /></a>
    <a class="socialSlid" href="https://twitter.com/plazatecnologia" target="_blank" title="Siguenos en Twitter"><img src="<?=base_url()?>assets/graphics/siguenosentwitter.png" alt="Siguenos en Twitter" /></a>
</div>