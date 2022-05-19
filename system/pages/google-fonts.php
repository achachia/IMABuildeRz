<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

if (file_exists(JSM_PATH . "/system/google_fonts.php"))
{
    require_once (JSM_PATH . "/system/google_fonts.php");
} else
{
    die("error: google_fonts.php");
}

defined("JSM_EXEC") or die("Silence is golden");
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
$breadcrumb = $content = $page_js = null;
$db = new jsmDatabase();
$icon = new jsmIcon();
$db->current();

if (isset($_POST['save-fonts']))
{
    $data = $_POST['google-fonts'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = ('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = ('The font has been successfully saved');
    $db->saveFonts($data);
    $db->current();
    rebuild();
    header("Location: ./?p=google-fonts");
}

if (isset($_POST['save-font-components']))
{
    $data = $_POST['components'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = ('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = ('The component fonts has been successfully saved');
    $db->saveFontComponents($data);
    $db->current();
    rebuild();
    header("Location: ./?p=google-fonts");
}


$_content = null;
$fonts = $db->getFonts();
if (!isset($fonts['fonts']))
{
    $fonts['fonts'] = array();
}
if (isset($fonts['fonts']))
{
    $max = count($fonts['fonts']);
}

foreach ($fonts['fonts'] as $font)
{
    $_content .= '<link href="https://fonts.googleapis.com/css2?family=' . $font . '" rel="stylesheet" type="text/css" />';
}

// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . ('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . ('Google Fonts') . '</li>';
$breadcrumb .= '</ol>';

$z = 0;
// TODO: LAYOUT --+-- LIST-OF-FONTS
$_content .= '<table class="table table-striped">';
$_content .= '<thead>';
$_content .= '<tr>';
$_content .= '<th>' . __e('Font Name') . '</th>';
$_content .= '<th>' . __e('Preview') . '</th>';
$_content .= '<th>' . __e('Example') . '</th>';
$_content .= '<th>' . __e('Action') . '</th>';
$_content .= '</tr>';
$_content .= '</thead>';
$_content .= '<tbody>';
$_content .= '<tr>';
$_content .= '<td>' . __e('Default') . '</td>';
$_content .= '<td><p style="font-family:\'Helvetica Neue\'">Simply Dummy Text</p></td>';
$_content .= '<td><code>selector{font-family:\'Helvetica Neue\';}</code></td>';
$_content .= '<td></td>';
$_content .= '</tr>';
foreach ($fonts['fonts'] as $font)
{
    $_content .= '<tr id="font-list-' . $z . '">';
    $_content .= '<td><input type="hidden" name="google-fonts[fonts][' . $z . ']"  value="' . $font . '" />' . $font . '</td>';
    $_content .= '<td><p style="font-family:\'' . $font . '\'">Simply Dummy Text</p></td>';
    $_content .= '<td><code>selector{font-family:\'' . $font . '\';}</code></td>';
    $_content .= '<td><a href="#!_" data-target="#font-list-' . $z . '" class="remove-item btn btn-danger"><i class="fa fa-trash"></i></a></td>';
    $_content .= '</tr>';
    $z++;
}
$_content .= '</tbody>';
$_content .= '</table>';
$z++;



$content .= '<div class="row">';
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<form action="" method="post">';
// TODO: LAYOUT --+-- GOOGLE FONTS
$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-google"></i> ' . __e('Google Fonts') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/index.html</code></p>';
$content .= '<div id="preview_css"></div>';
$content .= '<div id="preview" class="font-preview">';
$content .= '<h1>SIMPLY DUMMY TEXT</h1>';
$content .= '<h1>Simply Dummy Text</h1>';
$content .= '<h2>SIMPLY DUMMY TEXT</h2>';
$content .= '<h2>Simply Dummy Text</h2>';
$content .= '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>';
$content .= '</div>';

$content .= '<br/>';
$content .= '<label>' . __e('Select Font:') . '</label>';
$content .= '<select name="google-fonts[fonts][' . $z . ']" class="form-control" id="font-preview">';
$content .= '<option value="">' . __e('None') . '</option>';

foreach ($goggle_fonts as $goggle_font)
{
    $content .= '<option value="' . $goggle_font['prefix'] . '">' . $goggle_font['name'] . ' (' . $goggle_font['category'] . ') - by ' . htmlentities($goggle_font['designer']) . '</option>';
}
$content .= '</select>';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="save-fonts" type="submit" class="btn btn btn-success btn-flat pull-right" value="' . __e('Add New Font') . '" />';

$content .= '</div><!-- ./box-footer -->';
$content .= '</div><!-- ./box -->';

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-google"></i> ' . __e('List of fonts') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= $_content;
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="save-fonts" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?index&type=html">' . __e('View Source Code') . '</a>';
$content .= '</div><!-- ./box-footer -->';
$content .= '</div><!-- ./box -->';
$content .= '</form>';

// TODO: LAYOUT --+-- UI-COMPONENTS
$content .= '</div><!-- ./col-md-6 -->';
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<form action="" method="post">';
$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-moon-o"></i> ' . __e('UI Components') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/global.scss</code></p>';
$content .= '<br>';

$x = 0;
$components[$x]['label'] = 'Card';
$components[$x]['name'] = 'ion-card';

$x++;
$components[$x]['label'] = 'Card Header';
$components[$x]['name'] = 'ion-card-header';

$x++;
$components[$x]['label'] = 'Card Content';
$components[$x]['name'] = 'ion-card-content';

$x++;
$components[$x]['label'] = 'List';
$components[$x]['name'] = 'ion-list';

$x++;
$components[$x]['label'] = 'List Header';
$components[$x]['name'] = 'ion-list-header';

$x++;
$components[$x]['label'] = 'Item';
$components[$x]['name'] = 'ion-item';

$x++;
$components[$x]['label'] = 'Text';
$components[$x]['name'] = 'ion-text';

$x++;
$components[$x]['label'] = 'Chip';
$components[$x]['name'] = 'ion-chip';

$x++;
$components[$x]['label'] = 'Label';
$components[$x]['name'] = 'ion-label';

$x++;
$components[$x]['label'] = 'Title';
$components[$x]['name'] = 'ion-title';

$x++;
$components[$x]['label'] = 'Button';
$components[$x]['name'] = 'ion-button';

$x++;
$components[$x]['label'] = 'Slide';
$components[$x]['name'] = 'ion-slide';

$x++;
$components[$x]['label'] = 'Segment';
$components[$x]['name'] = 'ion-segment';

$x++;
$components[$x]['label'] = 'Header';
$components[$x]['name'] = 'ion-header';
 

$content .= '<table class="table table-striped">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>';
$content .= __e('Components');
$content .= '</th>';
$content .= '<th>';
$content .= __e('Preview');
$content .= '</th>';
$content .= '<th>';
$content .= __e('Font');
$content .= '</th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';

$component_currents = $db->getFontComponents();
if (!isset($component_currents['components']))
{
    $component_currents['components'] = array();
}
$z = 0;
foreach ($components as $component)
{
    $current_value = '';
    foreach ($component_currents['components'] as $component_current)
    {
        if ($component['name'] == $component_current['name'])
        {
            $current_value = $component_current['font'];
        }
    }

    $content_select = null;
    $content_select .= '<input type="hidden" name="components[components][' . $z . '][name]" value="' . $component['name'] . '" />';
    $content_select .= '<select name="components[components][' . $z . '][font]" class="form-control">';
    $content_select .= '<option value="">' . __e('Default') . '</option>';
    foreach ($fonts['fonts'] as $font)
    {
        $selected = '';
        if ($font == $current_value)
        {
            $selected = 'selected';
        }
        $content_select .= '<option value="' . $font . '" ' . $selected . '>' . $font . '</option>';
    }
    $content_select .= '<select>';

    $content .= '<tr>';
    $content .= '<td>';
    $content .= '<code>' . $component['name'] . '</code>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<p style="font-family:\'' . $current_value . '\'">Simply Dummy Text</p>';
    $content .= '</td>';

    $content .= '<td>';
    $content .= $content_select;
    $content .= '</td>';
    $content .= '</tr>';
    $z++;
}
$content .= '</tbody>';
$content .= '</table>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="save-font-components" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?theme=global&type=scss">' . __e('View Source Code') . '</a>';
$content .= '</div><!-- ./box-footer -->';
$content .= '</div><!-- ./box -->';
$content .= '</form>';


$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$page_js = '
$("#font-preview").change(function() {
   var currentFont = $(this).val();
   var fontUrl = "https://fonts.googleapis.com/css2?family=" + encodeURI(currentFont) + "&display=swap";
   var fontLoad = "<link href=\'" + fontUrl + "\' rel=\'stylesheet\' type=\'text/css\' />";
   $("#preview_css").html(fontLoad);
   $("#preview, #preview h1, #preview h2").css("font-family","\'" + currentFont + "\'");           
});
';


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = ('(IMAB) Google Fonts');
$template->page_desc = ('Insert Google Fonts to your themes');
$template->page_content = $content;

?>