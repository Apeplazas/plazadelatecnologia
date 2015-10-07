<?php
    define('IN_CB', true);
    
    include_once('include/function.php');
    
    $filetype="PNG";
    $dpi=72;
    $scale=2;
    $rotation=0;
    $font_family="Arial.ttf";
    $font_size=10;
    $start="C";
    $text="27000018572540201310250000050009";
    
    registerImageKey('filetype', $filetype);
    registerImageKey('dpi', $dpi);
    registerImageKey('scale', $scale);
    registerImageKey('rotation', $rotation);
    registerImageKey('font_family', $font_family);
    registerImageKey('font_size', $font_size);
    registerImageKey('text', $text);
    registerImageKey('start', $start);
    registerImageKey('code', 'BCGcode128');

    $finalRequest = '';
    foreach (getImageKeys() as $key => $value) {
        $finalRequest .= '&' . $key . '=' . urlencode($value);
    }
    if (strlen($finalRequest) > 0) {
        $finalRequest[0] = '?';
    }
?>
        <div id="imageOutput">
            <?php if ($imageKeys['text'] !== '') { ?><img width="231" height="80" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
            else { ?>Fill the form to generate a barcode.<?php } ?>
        </div>


