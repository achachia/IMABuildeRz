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

$_SESSION['ICON_GENERATOR']['enable'] = true;
$_SESSION['ICON_GENERATOR']['path'] = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP_PREFIX'] . '/resources/';


// TODO: ICON

if (isset($_POST['icon']['color']))
{
    $_SESSION['ICON_GENERATOR']['icon']['color'] = $_POST['icon']['color'];
}

if (isset($_POST['icon']['size']))
{
    $_SESSION['ICON_GENERATOR']['icon']['size'] = (int)$_POST['icon']['size'];
}

if (isset($_POST['icon']['left']))
{
    $_SESSION['ICON_GENERATOR']['icon']['left'] = (int)$_POST['icon']['left'];
}

if (isset($_POST['icon']['top']))
{
    $_SESSION['ICON_GENERATOR']['icon']['top'] = (int)$_POST['icon']['top'];
}


// TODO: SETTINGS BACKGROUND


if (isset($_POST['bg']['color']))
{
    $_SESSION['ICON_GENERATOR']['bg']['color'] = $_POST['bg']['color'];
}

if (isset($_POST['bg']['gradient']['enable']))
{
    $_POST['bg']['gradient']['enable'] = 'true';
} else
{
    $_POST['bg']['gradient']['enable'] = 'false';
}


if (isset($_POST['bg']['border']['enable']))
{
    $_POST['bg']['border']['enable'] = 'true';
} else
{
    $_POST['bg']['border']['enable'] = 'false';
}

if (isset($_POST['submit']))
{
    $_SESSION['ICON_GENERATOR']['bg'] = $_POST['bg'];
}

// TODO: FONTAWESOME
if (!isset($_SESSION['ICON_GENERATOR']['icon']['font']))
{
    $_SESSION['ICON_GENERATOR']['icon']['font'] = 'fontawesome';
}


// TODO: SETTINGS BACKGROUND
if (!isset($_SESSION['ICON_GENERATOR']['bg']['color']))
{
    $_SESSION['ICON_GENERATOR']['bg']['color'] = '#086b36';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['border']['enable']))
{
    $_SESSION['ICON_GENERATOR']['bg']['border']['enable'] = 'false';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['gradient']['start']))
{
    $_SESSION['ICON_GENERATOR']['bg']['gradient']['start'] = '#044723';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['gradient']['end']))
{
    $_SESSION['ICON_GENERATOR']['bg']['gradient']['end'] = '#045e2e';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['border']['color']))
{
    $_SESSION['ICON_GENERATOR']['bg']['border']['color'] = '#970B0B';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['gradient']['style']))
{
    $_SESSION['ICON_GENERATOR']['bg']['gradient']['style'] = '2';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['gradient']['enable']))
{
    $_SESSION['ICON_GENERATOR']['bg']['gradient']['enable'] = 'false';
}

if (!isset($_SESSION['ICON_GENERATOR']['bg']['border']['width']))
{
    $_SESSION['ICON_GENERATOR']['bg']['border']['width'] = 1;
}
if (!isset($_SESSION['ICON_GENERATOR']['bg']['border']['radius']))
{
    $_SESSION['ICON_GENERATOR']['bg']['border']['radius'] = 25;
}


// TODO: ICON

if (!isset($_SESSION['ICON_GENERATOR']['icon']['color']))
{
    $_SESSION['ICON_GENERATOR']['icon']['color'] = '#fefefe';
}
if (!isset($_SESSION['ICON_GENERATOR']['icon']['code']))
{
    $_SESSION['ICON_GENERATOR']['icon']['code'] = '&#xf11c;';
}

if (!isset($_SESSION['ICON_GENERATOR']['icon']['top']))
{
    $_SESSION['ICON_GENERATOR']['icon']['top'] = 0;
}

if (!isset($_SESSION['ICON_GENERATOR']['icon']['left']))
{
    $_SESSION['ICON_GENERATOR']['icon']['left'] = 0;
}

if (!isset($_SESSION['ICON_GENERATOR']['icon']['size']))
{
    $_SESSION['ICON_GENERATOR']['icon']['size'] = 0;
}


if (isset($_GET['a']))
{

    switch ($_GET['a'])
    {
        case 'reset':
            $_SESSION['ICON_GENERATOR'] = null;
            header('Location: ./?p=icon-generator&' . time());
            break;
        case 'step-1':
            $_SESSION['ICON_GENERATOR']['icon']['code'] = base64_decode($_GET['code']);
            $_SESSION['ICON_GENERATOR']['icon']['font'] = htmlentities($_GET['font']);
            header('Location: ?p=icon-generator&' . time());
            break;
        case 'step-2':
            $fileStyle = './system/plugin/icon-generator/styles/' . basename($_GET['style']) . '.json';
            $icon_style = json_decode(file_get_contents($fileStyle), true);

            $current_icon = $_SESSION['ICON_GENERATOR']['icon']['code'];
            $current_font = $_SESSION['ICON_GENERATOR']['icon']['font'];

            $_SESSION['ICON_GENERATOR']['icon'] = $icon_style['icon'];
            $_SESSION['ICON_GENERATOR']['bg'] = $icon_style['bg'];

            $_SESSION['ICON_GENERATOR']['icon']['code'] = $current_icon;
            $_SESSION['ICON_GENERATOR']['icon']['font'] = $current_font;

            header('Location: ./?p=icon-generator&' . time());
            break;
    }

}


$font_selector = null;
$font_selector .= '<div class="box-group" id="accordion"> <!-- accordion -->';
foreach (glob("system/plugin/icon-generator/fonts/*.inf") as $filename)
{
    if (file_exists(str_replace('.inf', '.lst', $filename)))
    {

        $basename = str_replace('.inf', '', basename($filename));
        $info_font = json_decode(file_get_contents($filename), true);
        $icons = json_decode(file_get_contents(str_replace('.inf', '.lst', $filename)), true);
        $in = null;
        if ($basename == $_SESSION['ICON_GENERATOR']['icon']['font'])
        {
            $in = 'in';
        }
        $font_selector .= '<div class="panel box box-primary">';
        $font_selector .= '<div class="box-header with-border">';
        $font_selector .= '<h4 class="box-title">';
        $font_selector .= '<a data-toggle="collapse" data-parent="#accordion" href="#' . $basename . '">';
        $font_selector .= '' . $info_font['name'] . '';
        $font_selector .= '</a>';
        $font_selector .= '</h4>';
        $font_selector .= '</div>';
        $font_selector .= '<div id="' . $basename . '" class="panel-collapse collapse ' . $in . '">';
        $font_selector .= '<div class="box-body">';
        $font_selector .= '<div class="icon-generator-box row">';

        foreach ($icons as $icon)
        {
            $active = '';
            if ($_SESSION['ICON_GENERATOR']['icon']['code'] == $icon['unicode'])
            {
                $active = 'icon-active';
            }
            $className = $info_font['class'] . ' ' . $info_font['prefix'] . '-' . $icon['var'];
            $font_selector .= '<div class="col-xs-2 col-md-2 col-lg-2 icon-generator-list ' . $active . '">';
            $font_selector .= '<a class="icon-generator-link" href="./?p=icon-generator&font=' . $basename . '&code=' . base64_encode($icon['unicode']) . '&a=step-1">';
            $font_selector .= '<i data-toggle="tooltip" title="' . $icon['var'] . '" class="icon-item ' . $className . '"></i>';
            $font_selector .= '</a>';
            $font_selector .= '</div>';
        }
        $font_selector .= '</div>';
        $font_selector .= 'by <a href="' . $info_font['link'] . '" target="blank">' . $info_font['author'] . '</a>';
        $font_selector .= '</div>';
        $font_selector .= '</div>';
        $font_selector .= '</div><!-- ./accordion -->';
        $font_selector .= '<link rel="stylesheet" href="system/plugin/icon-generator/fonts/' . $basename . '/css/' . $basename . '.min.css"/>';
    }
}
$font_selector .= '</div> <!-- ./accordion -->';


$font_styles = null;
$font_styles .= '<form action="" method="post">';
$font_styles .= '<input type="hidden" name="icon[code]" value="' . htmlentities($_SESSION['ICON_GENERATOR']['icon']['code']) . '">';
$font_styles .= '<input type="hidden" name="icon[font]" value="' . htmlentities($_SESSION['ICON_GENERATOR']['icon']['font']) . '">';

$font_styles .= '<ul class="nav nav-tabs">';
$font_styles .= '<li id="tab-icon" class="tab_style active"><a class="" href="#panel-tab-icon" data-toggle="tab">Icon</a></li>';
$font_styles .= '<li id="tab-background" class="tab_style"><a class="" href="#panel-tab-background" data-toggle="tab">Background</a></li>';
$font_styles .= '</ul>';

$font_styles .= '<div class="tab-content">';
$font_styles .= '<div class="tab-pane tab_panel_style active" id="panel-tab-icon">';
$font_styles .= '<div class="panel">';
$font_styles .= '<div class="panel-body">';
$font_styles .= '<div class="row">';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="icon-color">Color</span>';
$font_styles .= '<input name="icon[color]" type="color" class="form-control" value="' . htmlentities($_SESSION['ICON_GENERATOR']['icon']['color']) . '" placeholder="#ffffff">';
$font_styles .= '<p class="helper-block">ex: <code>#fefefe</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="row">';

$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="icon-top">Enlarge Size</span>';
$font_styles .= '<input type="number" name="icon[size]" class="form-control" placeholder="0" value="' . htmlentities($_SESSION['ICON_GENERATOR']['icon']['size']) . '">';
$font_styles .= '<p class="helper-block">ex: <code>-100</code> or <code>100</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';

$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="icon-top">Top</span>';
$font_styles .= '<input type="number" name="icon[top]" class="form-control" placeholder="10" value="' . htmlentities($_SESSION['ICON_GENERATOR']['icon']['top']) . '">';
$font_styles .= '<p class="helper-block">ex: <code>-100</code> or <code>100</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="icon-left">Left</span>';
$font_styles .= '<input type="number" name="icon[left]" class="form-control" placeholder="10" value="' . htmlentities($_SESSION['ICON_GENERATOR']['icon']['left']) . '">';
$font_styles .= '<p class="helper-block">ex: <code>-100</code> or <code>100</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="tab-pane tab_panel_style" id="panel-tab-background">';
$font_styles .= '<div class="panel">';
$font_styles .= '<div class="panel-body">';
$font_styles .= '<div class="row">';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-color">Color</span>';
$font_styles .= '<input name="bg[color]" type="color" class="form-control" value="' . htmlentities($_SESSION['ICON_GENERATOR']['bg']['color']) . '" placeholder="#d3312c">';
$font_styles .= '<p class="helper-block">ex: <code>#fefefe</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="row">';
$font_styles .= '<div class="col-md-12">';
if ($_SESSION['ICON_GENERATOR']['bg']['gradient']['enable'] == 'true')
{
    $gradient = 'checked="checked"';
} else
{
    $gradient = '';
}
$font_styles .= '<input name="bg[gradient][enable]" type="checkbox" ' . $gradient . ' class="flat-red" />&nbsp;<label>Gradient</label>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="row">';

$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-gradient-start" class="control-label">Start</span>';
$font_styles .= '<input name="bg[gradient][start]" type="color" class="form-control" value="' . $_SESSION['ICON_GENERATOR']['bg']['gradient']['start'] . '" placeholder="#d3312c">';
$font_styles .= '<p class="helper-block">ex: <code>#fefefe</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';

$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-gradient-end" class="control-label">End</span>';
$font_styles .= '<input name="bg[gradient][end]" type="color" class="form-control" value="' . htmlentities($_SESSION['ICON_GENERATOR']['bg']['gradient']['end']) . '" placeholder="#d3312c">';
$font_styles .= '<p class="helper-block">ex: <code>#fefefe</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';

$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-gradient-style" class="control-label">Style</span>';
$font_styles .= '<select id="bg-gradient-style" name="bg[gradient][style]" class="form-control" >';
for ($i = 1; $i <= 2; $i++)
{
    $selected = '';
    if ((int)$_SESSION['ICON_GENERATOR']['bg']['gradient']['style'] == $i)
    {
        $selected = 'selected';
    }
    $font_styles .= '<option value="' . $i . '" ' . $selected . '>Style ' . $i . '</option>';
}
$font_styles .= '</select>';

$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
if ($_SESSION['ICON_GENERATOR']['bg']['border']['enable'] == 'true')
{
    $border = 'checked="checked"';
} else
{
    $border = '';
}
$font_styles .= '<div class="row">';
$font_styles .= '<div class="col-md-12">';
$font_styles .= '<input name="bg[border][enable]" type="checkbox" ' . $border . ' class="flat-blue"/>&nbsp;<label for="bg-border-color" class="control-label">Border</label>';
$font_styles .= '</div>';
$font_styles .= '</div>';

$font_styles .= '<div class="row">';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-border-color">Color</span>';
$font_styles .= '<input name="bg[border][color]" type="color" class="form-control" value="' . htmlentities($_SESSION['ICON_GENERATOR']['bg']['border']['color']) . '" placeholder="#d3312c">';
$font_styles .= '<p class="helper-block">ex: <code>#fefefe</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-border-width">Width</span>';
$font_styles .= '<input id="bg-border-width" name="bg[border][width]" type="number" max="100" min="0" class="form-control" value="' . (int)$_SESSION['ICON_GENERATOR']['bg']['border']['width'] . '" placeholder="25">';
$font_styles .= '<p class="helper-block">ex: <code>-100</code> or <code>100</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '<div class="col-md-4">';
$font_styles .= '<div class="form-group">';
$font_styles .= '<span for="bg-border-radius">Radius</span>';
$font_styles .= '<input id="bg-border-radius" name="bg[border][radius]" type="number" max="50" min="0" class="form-control" value="' . (int)$_SESSION['ICON_GENERATOR']['bg']['border']['radius'] . '" placeholder="25">';
$font_styles .= '<p class="helper-block">ex: <code>10</code>, <code>25</code> or <code>50</code></p>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>'; //tab-pane
$font_styles .= '</div>'; //tab-content

$font_styles .= '<div class="panel">';
$font_styles .= '<div class="panel-body">';
$font_styles .= '<div class="row">';
$font_styles .= '<div class="col-md-12">';
$font_styles .= '<input type="submit" name="submit" class="btn btn-danger" value="Update" />';
$font_styles .= '&nbsp;<a href="./?p=icon-generator&a=reset" class="btn btn-success">Reset</a>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</div>';
$font_styles .= '</form>';


$param = array();
$param['hash'] = time();
$param['bg-color'] = $_SESSION['ICON_GENERATOR']['bg']['color'];
$param['bg-gradient-enable'] = $_SESSION['ICON_GENERATOR']['bg']['gradient']['enable'];
$param['bg-gradient-start'] = $_SESSION['ICON_GENERATOR']['bg']['gradient']['start'];
$param['bg-gradient-style'] = $_SESSION['ICON_GENERATOR']['bg']['gradient']['style'];
$param['bg-gradient-end'] = $_SESSION['ICON_GENERATOR']['bg']['gradient']['end'];
$param['bg-border-enable'] = $_SESSION['ICON_GENERATOR']['bg']['border']['enable'];
$param['bg-border-color'] = $_SESSION['ICON_GENERATOR']['bg']['border']['color'];
$param['bg-border-width'] = (int)$_SESSION['ICON_GENERATOR']['bg']['border']['width'];
$param['bg-border-radius'] = (int)$_SESSION['ICON_GENERATOR']['bg']['border']['radius'];
$param['icon-code'] = $_SESSION['ICON_GENERATOR']['icon']['code'];
$param['icon-font'] = $_SESSION['ICON_GENERATOR']['icon']['font'];
$param['icon-color'] = $_SESSION['ICON_GENERATOR']['icon']['color'];
$param['icon-left'] = (int)$_SESSION['ICON_GENERATOR']['icon']['left'];
$param['icon-top'] = (int)$_SESSION['ICON_GENERATOR']['icon']['top'];
$param['icon-size'] = (int)$_SESSION['ICON_GENERATOR']['icon']['size'];

$link = './system/plugin/icon-generator/generator.php?' . http_build_query($param);

$img_preview = null;

$img_preview .= '<div class="panel panel-default">';
$img_preview .= '<div class="panel-body text-center icon-preview">';
$img_preview .= '<img class="img-preview" src="' . $link . '"  /><br/>';
$img_preview .= '</div>';
$img_preview .= '</div>';

$img_preview .= '<div class="panel panel-default">';
$img_preview .= '<div class="panel-body icon-preview">';
$basename = null;

$img_preview .= '<div class="btn-group btn-group-justified">';
$t = 0;
foreach (glob("./system/plugin/icon-generator/styles/*.json") as $style)
{
    if (($t == 4) || ($t == 8) || ($t == 12) || ($t == 16) || ($t == 20))
    {
        $img_preview .= '</div>';
        $img_preview .= '<div class="btn-group btn-group-justified">';
    }
    $basename = str_replace('.json', '', basename($style));
    $img_preview .= '<div class="btn-group"><a class="btn btn-default" href="./?p=icon-generator&a=step-2&style=' . $basename . '"><img src="./system/plugin/icon-generator/styles/' . $basename . '.png" width="48" height="48" /></a></div>';
    $t++;
}
$img_preview .= '</div>';
$img_preview .= '</div>';
$img_preview .= '</div>';

$img_preview .= '<div class="panel panel-default">';
$img_preview .= '<div class="panel-body">';
$img_preview .= '<a href="' . $link . '&type=download" class="btn btn-danger btn-group-justified">Download</a>';
$img_preview .= '</div>';
$img_preview .= '</div>';


$content .= '<div class="row">';

$content .= '<div class="col-md-4">';
$content .= '<div class="box box-default">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Choose font') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-info">' . __e('The icon is only made for the Android and IOS platform, for other platforms please do it manually') . '</div>';


$content .= $font_selector;
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '<div class="col-md-4">';
$content .= $img_preview;
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4">';
$content .= '<div class="box box-default">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Styles') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= $font_styles;
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- row -->';

$content .= '<div class="row">';
$content .= '<div class="col-md-12">';

$content .= '<div class="box box-default">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Custom Icons') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('Custom icons can be done by <strong>editing the images</strong> on this files') . ':</p>';
$content .= '<div>';
foreach (glob($_SESSION['ICON_GENERATOR']['path'] . "/android/icon/*.png") as $filename)
{
    $icon = realpath($filename);
        $content .= '<h4>' . basename($icon) . '</h4>';
    $content .= '<pre><code>' . $icon . '</code></pre>';
}
$content .= '</div>';
$content .= '<p>' . __e('Use <em>Adobe Photoshop</em> or <em>Gimp</em> to edit the images.') . '</p>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';

$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- row -->';


$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Icon Generator') . '</li>';
$breadcrumb .= '</ol>';


$template->page_breadcrumb = $breadcrumb;
$template->page_title = 'Icon Generator';
$template->page_desc = 'Create an icon for the your application quickly';
$template->page_content = $content;

?>