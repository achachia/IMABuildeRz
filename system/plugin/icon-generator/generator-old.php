<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License

 * @package ionic v4
 */

 error_reporting(0);

session_start();

ob_start("ob_gzhandler");

if (!isset($_SESSION['ICON_GENERATOR']['enable']))
{
    $_SESSION['ICON_GENERATOR']['enable'] = false;
}
if ($_SESSION['ICON_GENERATOR']['enable'] != true)
{
    die();
}

if (!isset($_GET['type']))
{
    $_GET['type'] = 'preview';
}

if ($_GET['type'] == 'download')
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Disposition: attachment; filename="' . time() . '.png"');
} else
{
    header('Content-Type: image/png');
}


$bg['width'] = 1023;
$bg['high'] = 1023;

$bg['color'] = '#D3312C';

$bg['gradient']['enable'] = true;
$bg['gradient']['start'] = '#D3312C';
$bg['gradient']['end'] = '#970B0B';

$bg['border']['enable'] = true;
$bg['border']['radius'] = 20;
$bg['border']['width'] = 5;
$bg['border']['color'] = '#FD6262';


if (isset($_GET['bg-opacity']))
{
    $bg['opacity'] = (int)$_GET['bg-opacity'];
}

if (isset($_GET['bg-color']))
{
    $bg['color'] = strtoupper(str_replace('0x', '#', $_GET['bg-color']));
}

// TODO: gradient
if ($_GET['bg-gradient-enable'] == 'true')
{
    $bg['gradient']['enable'] = true;
} else
{
    $bg['gradient']['enable'] = false;
}

if (isset($_GET['bg-gradient-start']))
{
    $bg['gradient']['start'] = strtoupper(str_replace('0x', '#', $_GET['bg-gradient-start']));
}

if (isset($_GET['bg-gradient-end']))
{
    $bg['gradient']['end'] = strtoupper(str_replace('0x', '#', $_GET['bg-gradient-end']));
}


if (isset($_GET['bg-gradient-style']))
{
    $bg['style'] = $_GET['bg-gradient-style'];
}

if ($_GET['bg-border-enable'] == 'true')
{
    $bg['border']['enable'] = true;
} else
{
    $bg['border']['enable'] = false;
}

if (isset($_GET['bg-border-color']))
{
    $bg['border']['color'] = strtoupper(str_replace('0x', '#', $_GET['bg-border-color']));
}

if (isset($_GET['bg-border-radius']))
{
    $bg['border']['radius'] = (int)$_GET['bg-border-radius'];
}

if (isset($_GET['bg-border-width']))
{
    $bg['border']['width'] = (int)$_GET['bg-border-width'];
}


$icon['icon'] = '&#xf11c;';
$icon['color'] = '#ffffff';
$icon['left'] = -80;
$icon['top'] = 0;
$icon['size'] = 0;
$icon['font'] = 'fontawesome';

if (isset($_GET['icon-font']))
{
    $icon['font'] = $_GET['icon-font'];
}

if (isset($_GET['icon-code']))
{
    $icon['icon'] = $_GET['icon-code'];
}

if (isset($_GET['icon-color']))
{
    $icon['color'] = strtoupper(str_replace('0x', '#', $_GET['icon-color']));
}

if (isset($_GET['icon-left']))
{
    $icon['left'] = (int)$_GET['icon-left'];
}
if (isset($_GET['icon-top']))
{
    $icon['top'] = (int)$_GET['icon-top'];
}
if (isset($_GET['icon-size']))
{
    $icon['size'] = (int)$_GET['icon-size'];
}

$resize = $bg['width'] / 1024;


$im = imagecreatetruecolor($bg['width'], $bg['high']);
imagesavealpha($im, false);
imagealphablending($im, false);
imageantialias($im, true);

// TODO:  color background
list($r, $g, $b) = sscanf($bg['color'], "#%02x%02x%02x");
$bgc = imagecolorallocatealpha($im, $r, $g, $b, 0);
imagefilledrectangle($im, 0, 0, $bg['width'], $bg['high'], $bgc);

// TODO:  color gradient
if ($bg['gradient']['enable'] == true)
{
    list($s['r'], $s['g'], $s['b']) = sscanf($bg['gradient']['start'], "#%02x%02x%02x");
    list($e['r'], $e['g'], $e['b']) = sscanf($bg['gradient']['end'], "#%02x%02x%02x");

    $bg_style = $bg['style'];
    if (!isset($bg_style))
    {
        $bg_style = '2';
    }
    switch ($bg_style)
    {
        case '1':
            $steps = $bg['high'] - 0;
            for ($i = 0; $i < $steps; $i++)
            {
                $r = $s['r'] - ((($s['r'] - $e['r']) / $steps) * $i);
                $g = $s['g'] - ((($s['g'] - $e['g']) / $steps) * $i);
                $b = $s['b'] - ((($s['b'] - $e['b']) / $steps) * $i);
                $color = imagecolorallocate($im, $r, $g, $b);
                imagefilledrectangle($im, 0, 0 + $i, $bg['width'], 0 + $i + 1, $color);
            }
            break;
        case '2':
            $steps = $bg['high'];
            $half_steps = ($steps / 2);
            for ($i = $half_steps; $i < $steps; $i++)
            {
                $r = $s['r'] - ((($s['r'] - $e['r']) / $steps) * $i);
                $g = $s['g'] - ((($s['g'] - $e['g']) / $steps) * $i);
                $b = $s['b'] - ((($s['b'] - $e['b']) / $steps) * $i);
                $color = imagecolorallocate($im, $r, $g, $b);
                imagefilledrectangle($im, 0 + $i, 0, 0 + $i + 1, $bg['width'], $color);
            }
            break;
    }

}


// TODO: border
if ($bg['border']['enable'] == true)
{

    if (!isset($bg['border']['width']))
    {
        $bg['border']['width'] = 0;
    }

    // TODO: border - radius
    if (!isset($bg['border']['radius']))
    {
        $bg['border']['radius'] = 10;
    }

    $h = $w = ($bg['width']);
    $r = ($bg['border']['radius'] / 100) * $w;
    $im_mask = imagecreatetruecolor($bg['width'], $bg['high']);
    imagealphablending($im_mask, true);
    imageantialias($im_mask, true);
    $red = imagecolorallocate($im_mask, 255, 0, 0);
    $black = imagecolorallocate($im_mask, 0, 0, 0);

    imagefill($im_mask, 0, 0, $black);

    $values[0] = $r;
    $values[1] = 0;
    $values[2] = ($w - $r);
    $values[3] = 0;
    $values[4] = $w;
    $values[5] = $r;
    $values[6] = $w;
    $values[7] = ($h - $r);
    $values[8] = ($w - $r);
    $values[9] = $h;
    $values[10] = $r;
    $values[11] = $h;
    $values[12] = 0;
    $values[13] = ($h - $r);
    $values[14] = 0;
    $values[15] = $r;

    imagefilledpolygon($im_mask, $values, 8, $red);
    imagefilledellipse($im_mask, $r, $r, ($r * 2), ($r * 2), $red);
    imagefilledellipse($im_mask, ($w - $r), $r, ($r * 2), ($r * 2), $red);
    imagefilledellipse($im_mask, ($w - $r), ($w - $r), ($r * 2), ($r * 2), $red);
    imagefilledellipse($im_mask, $r, $w - $r, ($r * 2), ($r * 2), $red);

    imagecolortransparent($im_mask, $red);
    imagecopymerge($im, $im_mask, 0, 0, 0, 0, $w, $w, 100);
    imagecolortransparent($im, $black);
    imagedestroy($im_mask);


    $border_width = $bg['width'] + (($bg['border']['width'] * $resize) * 2);
    $border_high = $bg['high'] + (($bg['border']['width'] * $resize) * 2);
    $im_border = imagecreatetruecolor($border_width, $border_high);
    list($r, $g, $b) = sscanf($bg['border']['color'], "#%02x%02x%02x");
    $border_color = imagecolorallocatealpha($im, $r, $g, $b, 0);

    imagefilledrectangle($im_border, 0, 0, $border_width, $border_high, $black);

    imagealphablending($im_border, true);
    imageantialias($im_border, true);

    $h = $w = $border_width;
    $r = ($bg['border']['radius'] / 100) * $w;
    $border_point[0] = $r;
    $border_point[1] = 0;
    $border_point[2] = ($w - $r);
    $border_point[3] = 0;
    $border_point[4] = $w;
    $border_point[5] = $r;
    $border_point[6] = $w;
    $border_point[7] = ($h - $r);
    $border_point[8] = ($w - $r);
    $border_point[9] = $h;
    $border_point[10] = $r;
    $border_point[11] = $h;
    $border_point[12] = 0;
    $border_point[13] = ($h - $r);
    $border_point[14] = 0;
    $border_point[15] = $r;
    imagefilledpolygon($im_border, $border_point, 8, $border_color);
    imagefilledellipse($im_border, $r, $r, ($r * 2), ($r * 2), $border_color);
    imagefilledellipse($im_border, ($w - $r), $r, ($r * 2), ($r * 2), $border_color);
    imagefilledellipse($im_border, ($w - $r), ($w - $r), ($r * 2), ($r * 2), $border_color);
    imagefilledellipse($im_border, $r, $w - $r, ($r * 2), ($r * 2), $border_color);
    imagecolortransparent($im_border, $black);
    imagecopymerge($im_border, $im, ($bg['border']['width'] * $resize), ($bg['border']['width'] * $resize), 0, 0, $bg['width'], $bg['high'], 100);

    $im = $im_border;
}


//imagefilter($im, IMG_FILTER_PIXELATE, 1, true);

// TODO: opacity

imagealphablending($im, true);

$fontSize = (($bg['width'] + ($icon['size'] * $resize)) / 2);
$fontX = (($fontSize + ($icon['left'] * $resize)) / 2);
$fontY = (($fontSize + ($icon['top'] * $resize)) + ($fontSize / 2));

$fontFile = __dir__ . '/fonts/' . $icon['font'] . '.ttf';

list($r, $g, $b) = sscanf($icon['color'], "#%02x%02x%02x");
$fontColor = imagecolorallocate($im, $r, $g, $b);
$_r = $r + 20 ;
if($_r > 254){
    $_r = 254 ;
}

$_g = $g + 20 ;
if($_g > 254){
    $_g = 254 ;
}

$_b = $b + 20 ;
if($_b > 254){
    $_b = 254 ;
}

$fontColorBg = imagecolorallocate($im,$_r , $_g, $_b);

imagettftext($im, $fontSize, 0, $fontX, $fontY, $fontColorBg, $fontFile, $icon['icon']);
imagettftext($im, $fontSize, 0, $fontX + 2, $fontY + 2, $fontColor, $fontFile, $icon['icon']);


imagepng($im);

if(!file_exists($_SESSION['ICON_GENERATOR']['path'].'/android/icon/')){
    @mkdir($_SESSION['ICON_GENERATOR']['path'].'/android/icon/',0777,true);
}
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/icon.png');

//ANDROID
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/android/icon/drawable-hdpi-icon.png');
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/android/icon/drawable-ldpi-icon.png');
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/android/icon/drawable-mdpi-icon.png');
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/android/icon/drawable-xhdpi-icon.png');
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/android/icon/drawable-xxhdpi-icon.png');
imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/android/icon/drawable-xxxhdpi-icon.png');


//ios
//imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/ios/icon/icon.png');
//imagepng($im, $_SESSION['ICON_GENERATOR']['path'] . '/ios/icon/icon@2x.png');

imagedestroy($im);




?>