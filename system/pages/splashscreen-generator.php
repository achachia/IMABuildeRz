<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */


defined("JSM_EXEC") or die("Silence is golden");
$breadcrumb = $content = null;

$db = new jsmDatabase();
$icon = new jsmIcon();
$current_app = $db->current();

$output_splashscreen = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP_PREFIX'] . '/resources/';


if (isset($_POST['splashscreen']))
{
    if (!file_exists($output_splashscreen . '/android/splash/'))
    {
        @mkdir($output_splashscreen . '/android/splash/', 0777, true);
    }

    $file_splashscreens[] = array(
        'path' => 'splash.png',
        'w' => '2732',
        'h' => '2732');

    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-land-ldpi-screen.png',
        'w' => '320',
        'h' => '200');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-land-mdpi-screen.png',
        'w' => '480',
        'h' => '320');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-land-hdpi-screen.png',
        'w' => '800',
        'h' => '480');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-land-xhdpi-screen.png',
        'w' => '1280',
        'h' => '720');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-land-xxhdpi-screen.png',
        'w' => '1600',
        'h' => '960');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-land-xxxhdpi-screen.png',
        'w' => '1920',
        'h' => '1280');

    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-port-ldpi-screen.png',
        'h' => '320',
        'w' => '200');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-port-mdpi-screen.png',
        'h' => '480',
        'w' => '320');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-port-hdpi-screen.png',
        'h' => '800',
        'w' => '480');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-port-xhdpi-screen.png',
        'h' => '1280',
        'w' => '720');
    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-port-xxhdpi-screen.png',
        'h' => '1600',
        'w' => '960');

    $file_splashscreens[] = array(
        'path' => 'android/splash/drawable-port-xxxhdpi-screen.png',
        'h' => '1920',
        'w' => '1280');


    // TODO: IOS APP
    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default@2x~iphone.png',
        'h' => '960',
        'w' => '640');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default@2x~universal~anyany.png',
        'h' => '2732',
        'w' => '2732');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default~iphone.png',
        'h' => '480',
        'w' => '320');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-568h@2x~iphone.png',
        'h' => '1136',
        'w' => '640');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-667h.png',
        'h' => '1134',
        'w' => '750');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-736h.png',
        'h' => '2208',
        'w' => '1242');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-2436h.png',
        'h' => '2436',
        'w' => '1125');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Landscape@~ipadpro.png',
        'h' => '2048',
        'w' => '2732');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Landscape@2x~ipad.png',
        'h' => '1536',
        'w' => '2048');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Landscape~ipad.png',
        'h' => '768',
        'w' => '1024');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Landscape-736h.png',
        'h' => '1242',
        'w' => '2208');

    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Landscape-2436h.png',
        'h' => '1125',
        'w' => '2436');


    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Portrait@~ipadpro.png',
        'h' => '2732',
        'w' => '2048');


    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Portrait@2x~ipad.png',
        'h' => '2048',
        'w' => '1536');


    $file_splashscreens[] = array(
        'path' => 'ios/splash/Default-Portrait~ipad.png',
        'h' => '1024',
        'w' => '768');


    function get_center_text_position($img_width, $font_size, $font_file, $string)
    {
        $bounding_box_size = imagettfbbox($font_size, 0, $font_file, $string);
        $text_width = $bounding_box_size[2] - $bounding_box_size[0];
        return ceil(($img_width - $text_width) / 2);
    }

    $textcolor = $_POST['splashscreen']['text-color'];
    $backgroundstyle = $_POST['splashscreen']['background-style'];
    $backgroundcolor = $_POST['splashscreen']['background-color'];
    $backgroundcolor_striped = $_POST['splashscreen']['striped-color'];

    $appText = $current_app['apps']['app-name'];
    $poweredText = 'by ' . $current_app['apps']['author-organization'];

    foreach ($file_splashscreens as $file_splashscreen)
    {

        $font_file = JSM_PATH . '/templates/default/assets/fonts/FjallaOne.ttf';


        $filename = $file_splashscreen['path'];
        $width = $file_splashscreen['w'];
        $height = $file_splashscreen['h'];

        $im = imagecreatetruecolor($width, $height) or die('Cannot Initialize new GD image stream');
        //imagealphablending($im, false);
        imagesavealpha($im, false);

        list($background_r, $background_g, $background_b) = sscanf($backgroundcolor, "#%02x%02x%02x");
        $background = imagecolorallocate($im, $background_r, $background_g, $background_b);
        imagefill($im, 0, 0, $background);

        list($background_striped_r, $background_striped_g, $background_striped_b) = sscanf($backgroundcolor_striped, "#%02x%02x%02x");
        $color_striped = imagecolorallocate($im, $background_striped_r, $background_striped_g, $background_striped_b);

        switch ($backgroundstyle)
        {
            case 'pattern-a':


                $values = array(
                    0,
                    0,
                    $width / 2,
                    $height / 2,
                    $width / 4,
                    0,
                    0,
                    0,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);

                $values = array(
                    $width / 2,
                    0,
                    $width / 2,
                    $height / 2,
                    (($width / 4) * 3),
                    0,
                    0,
                    0,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);


                $values = array(
                    $width,
                    0,
                    $width / 2,
                    $height / 2,
                    $width,
                    $height / 4,
                    $width,
                    0,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);

                $values = array(
                    $width,
                    $height / 2,
                    $width / 2,
                    $height / 2,
                    $width,
                    (($height / 4) * 3),
                    $width,
                    0,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);


                $values = array(
                    $width,
                    $height,
                    $width / 2,
                    $height / 2,
                    ($width / 4) * 3,
                    $height,
                    $width,
                    $height,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);


                $values = array(
                    $width / 2,
                    $height,
                    $width / 2,
                    $height / 2,
                    ($width / 4),
                    $height,
                    $width,
                    $height,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);

                $values = array(
                    0,
                    $height,
                    $width / 2,
                    $height / 2,
                    0,
                    ($height / 4) * 3,
                    0,
                    $height,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);


                $values = array(
                    0,
                    $height / 2,
                    $width / 2,
                    $height / 2,
                    0,
                    ($height / 4),
                    0,
                    $height,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);
                break;
            case 'pattern-b':
                $values = array(
                    0,
                    0,
                    $width,
                    0,
                    0,
                    $height,
                    0,
                    0,
                    );
                imagefilledpolygon($im, $values, 4, $color_striped);

                break;
        }

        list($text_colour_r, $text_colour_g, $text_colour_b) = sscanf($textcolor, "#%02x%02x%02x");
        $text_colour_foreground = imagecolorallocate($im, $text_colour_r, $text_colour_g, $text_colour_b);
        $text_colour_shadow = imagecolorallocate($im, 55, 55, 55);


        $line_1 = 40;
        if ($height > 200)
        {
            $line_1 = 35;
        }
        if ($height > 500)
        {
            $line_1 = 36;
        }
        if ($height > 700)
        {
            $line_1 = 40;
        }
        if ($height > 1000)
        {
            $line_1 = 55;
        }
        if ($height > 1200)
        {
            $line_1 = 65;
        }
        if ($height > 1500)
        {
            $line_1 = 70;
        }
        if ($height > 2000)
        {
            $line_1 = 90;
        }

        $font_size = (int)($width * 0.03);
        imagettftext($im, $font_size, 0, get_center_text_position($width, $font_size, $font_file, $appText) + 1, (($height - $font_size) - $line_1) + 1, $text_colour_shadow, $font_file, $appText);
        imagettftext($im, $font_size, 0, get_center_text_position($width, $font_size, $font_file, $appText), (($height - $font_size) - $line_1), $text_colour_foreground, $font_file, $appText);


        $font_size = (int)($width * 0.02);
        imagettftext($im, $font_size, 0, get_center_text_position($width, $font_size, $font_file, $poweredText) + 1, (($height - $font_size) - 20) + 1, $text_colour_shadow, $font_file, $poweredText);
        imagettftext($im, $font_size, 0, get_center_text_position($width, $font_size, $font_file, $poweredText), (($height - $font_size)) - 20, $text_colour_foreground, $font_file, $poweredText);


        imagepng($im, $output_splashscreen . '/' . $filename);
        imagedestroy($im);

    }


    $data_splashscreen = $_POST['splashscreen'];

    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = ('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = ('The splashscreen settings has been successfully edited');
    $db->saveSplashScreen($data_splashscreen);
    $db->current();
    rebuild();
    header("Location: ./?p=splashscreen-generator");
}


$splashscreen = $db->getSplashScreen();

if (!isset($splashscreen['text-color']))
{
    $splashscreen['text-color'] = '#ffffff';
}
if (!isset($splashscreen['background-color']))
{
    $splashscreen['background-color'] = '#000080';
}
if (!isset($splashscreen['background-color']))
{
    $splashscreen['background-color'] = '#000080';
}
if (!isset($splashscreen['striped-color']))
{
    $splashscreen['striped-color'] = '#333399';
}

if (!isset($splashscreen['background-style']))
{
    $splashscreen['background-style'] = 'none';
}

$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('SplashScreen') . '</li>';
$breadcrumb .= '</ol>';


$content .= '<form action="" method="post">';
$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-6">';

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-info">' . __e('The splashscreeens is only made for the Android and IOS platform, for other platforms please do it manually') . '</div>';

$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-4">';
$content .= '<div class="form-group">';
$content .= '<label for="splashscreen-text-color">' . ('Text Color') . '</label>';
$content .= '<input type="color" class="form-control" name="splashscreen[text-color]" id="splashscreen-text-color" placeholder="#ffffff" value="' . $splashscreen['text-color'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!--./col-md-4-->';
$content .= '<div class="col-md-4">';
$content .= '<div class="form-group">';
$content .= '<label for="splashscreen-background-color">' . ('Background Color') . '</label>';
$content .= '<input type="color" class="form-control" name="splashscreen[background-color]" id="background-text-color" placeholder="#ffffff" value="' . $splashscreen['background-color'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!--./col-md-4-->';

$content .= '<div class="col-md-4">';
$content .= '<div class="form-group">';
$content .= '<label for="splashscreen-striped-color">' . ('Striped Color') . '</label>';
$content .= '<input type="color" class="form-control" name="splashscreen[striped-color]" id="striped-text-color" placeholder="#ffffff" value="' . $splashscreen['striped-color'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';

$content .= '</div><!--./col-md-4-->';
$content .= '</div><!--./row-->';


$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-4">';

$styles[] = array('value' => 'none', 'label' => __e('None'));
$styles[] = array('value' => 'pattern-a', 'label' => 'Pattern A');
$styles[] = array('value' => 'pattern-b', 'label' => 'Pattern B');
$styles[] = array('value' => 'pattern-c', 'label' => 'Pattern C');

$content .= '<div class="form-group">';
$content .= '<label for="splashscreen-background-style">' . ('Background Style') . '</label>';
$content .= '<select class="form-control" name="splashscreen[background-style]" id="background-style">';
foreach ($styles as $style)
{
    $selected = '';
    if ($style['value'] == $splashscreen['background-style'])
    {
        $selected = 'selected';
    }
    $content .= '<option ' . $selected . ' value="' . $style['value'] . '">' . $style['label'] . '</option>';
}
$content .= '</select>';

$content .= '<p class="help-block">' . __e('please select type background!') . '</p>';
$content .= '</div>';

$content .= '</div><!--./col-md-4-->';
$content .= '</div><!--./row-->';


$content .= '</div><!--./box-body-->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-danger btn-flat pull-left" value="' . __e('Update') . '" />';
$content .= '</div>';
$content .= '</div><!--./box-->';
$content .= '</div><!--./col-md-6-->';

$content .= '<div class="col-md-6">';

$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Preview') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
$content .= '<img class="img-thumbnail" src="outputs/' . $_SESSION['CURRENT_APP_PREFIX'] . '/resources/android/splash/drawable-port-xhdpi-screen.png?' . time() . '" width="360" height="640" />';
$content .= '</div><!--./col-md-6-->';
$content .= '<div class="col-md-6">';
$content .= '<img class="img-thumbnail" src="outputs/' . $_SESSION['CURRENT_APP_PREFIX'] . '/resources/android/splash/drawable-land-mdpi-screen.png?' . time() . '" width="480" height="320" />';
$content .= '</div><!--./col-md-6-->';
$content .= '</div><!--./row-->';

$content .= '</div><!--./box-body-->';
$content .= '</div><!--./box-->';

$content .= '</div><!--./col-md-6-->';
$content .= '</div><!--./row-->';


$content .= '<div class="row">';
$content .= '<div class="col-md-12">';

$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Technical Guide') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>' . __e('Custom splashscreens can be done by <strong>editing the images</strong> on this files') . ':</p>';
$content .= '<div>';
foreach (glob(JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP_PREFIX'] . '/resources/android/splash/*.png') as $filename)
{
    $icon = realpath($filename);
    $content .= '<h4>' . basename($icon) . '</h4>';
    $content .= '<pre><code>' . $icon . '</code></pre>';
}
$content .= '</div>';
$content .= '<p>' . __e('Use <em>Adobe Photoshop</em> or <em>Gimp</em> to edit the images.') . '</p>';
$content .= '<p>' . __e('Reference') . ': <a target="_blank" href="https://cordova.apache.org/docs/en/latest/reference/cordova-plugin-splashscreen/index.html">cordova-plugin-splashscreen</a></p>';


$content .= '</div><!--./box-body-->';
$content .= '</div><!--./box-->';


$content .= '</div><!--./col-md-12-->';
$content .= '</div><!--./row-->';
$content .= '</form>';

$template->page_breadcrumb = $breadcrumb;
$template->page_title = 'SplashScreen';
$template->page_desc = 'Create an SplashScreen for the your application quickly';
$template->page_content = $content;

?>