<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */
defined("JSM_EXEC") or die("Silence is golden");
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
$breadcrumb = $content = $page_js = null;
$db = new jsmDatabase();
$icon = new jsmIcon();
$db->current();
if (isset($_POST['submit']))
{
    $new_enqueue = $_POST['enqueue'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The meta tags settings has been successfully edited');
    $db->saveEnqueues($new_enqueue);
    $db->current();
    rebuild();
    header("Location: ./?p=meta-tags");
}

// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Meta Tags') . '</li>';
$breadcrumb .= '</ol>';
$enqueues['styles'] = array();
$enqueues['scripts'] = array();
if (isset($_SESSION['CURRENT_APP']['enqueues']))
{
    $enqueues = $_SESSION['CURRENT_APP']['enqueues'];
}

$content .= '<form action="" method="post">';
$content .= '<div class="row"> <!-- row -->';

// TODO: FORM --|-- STYLES
$content .= '<div class="col-md-6">';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Enqueue Styles') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/index.html</code></p>';

$content .= '<p>' . __e('You can enter the url of styles in the fields below:') . '</p>';
if (!isset($enqueues['styles']))
{
    $enqueues['styles'] = array();
}
if (!is_array($enqueues['styles']))
{
    $enqueues['styles'] = array();
}
$z = 0;
$content .= '<table class="table table-striped">';
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th>#</th>';
$content .= '<th>' . __e('URL') . '</th>';
$content .= '<th>' . __e('Attributes') . '</th>';
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody class="item-list">' . "\r\n";
foreach ($enqueues['styles'] as $style)
{
    if (!isset($style['attr']))
    {
        $style['attr'] = '';
    }
    $content .= '<tr class="item" id="style-' . $z . '">';
    $content .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>';
    $content .= '<td class="handle"><input name="enqueue[styles][' . $z . '][url]" type="url"  class="form-control" value="' . htmlentities($style['url']) . '" placeholder="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/></td>';
    $content .= '<td class="handle"><input name="enqueue[styles][' . $z . '][attr]" type="text"  class="form-control" value="' . htmlentities($style['attr']) . '" placeholder="media=&quot;all&quot;"/></td>';
    $content .= '<td class="handle"><a href="#!" data-target="#style-' . $z . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>';
    $content .= '</tr>';
    $z++;
}
$z++;
$content .= '<tr>';
$content .= '<td></td>';
$content .= '<td><input name="enqueue[styles][' . $z . '][url]" type="url"  class="form-control" placeholder="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/></td>';
$content .= '<td><input name="enqueue[styles][' . $z . '][attr]" type="text" class="form-control" placeholder="media=&quot;all&quot; crossorigin=&quot;anonymous&quot;" /></td>';
$content .= '<td><input name="submit" type="submit" class="btn btn btn-primary btn-flat pull-left" value="' . __e('Add') . '" /></td>';
$content .= '</tr>';

$content .= '</tbody>';
$content .= '</table>';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?index&type=html">' . __e('View Source Code') . '</a>';

$content .= '</div><!-- ./box-footer -->';
$content .= '</div><!-- ./box -->';

$content .= '</div>';

// TODO: FORM --|-- SCRIPTS
$content .= '<div class="col-md-6">';
$content .= '<form action="" method="post">';
$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Enqueue Scripts') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/index.html</code></p>';
$content .= '<p>' . __e('You can enter the url of scripts in the fields below:') . '</p>';
if (!isset($enqueues['scripts']))
{
    $enqueues['scripts'] = array();
}
if (!is_array($enqueues['scripts']))
{
    $enqueues['scripts'] = array();
}
$z = 0;
$content .= '<table class="table table-striped">';
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th>#</th>';
$content .= '<th>' . __e('URL') . '</th>';
$content .= '<th>' . __e('Attributes') . '</th>';
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody class="item-list">' . "\r\n";
foreach ($enqueues['scripts'] as $script)
{
    if (!isset($script['attr']))
    {
        $script['attr'] = '';
    }
    $content .= '<tr class="item" id="script-' . $z . '">';
    $content .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>';
    $content .= '<td class="handle"><input name="enqueue[scripts][' . $z . '][url]" type="url"  class="form-control" value="' . htmlentities($script['url']) . '" placeholder="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"/></td>';
    $content .= '<td class="handle"><input name="enqueue[scripts][' . $z . '][attr]" type="text" class="form-control" value="' . htmlentities($script['attr']) . '" placeholder="crossorigin=&quot;anonymous&quot;" /></td>';
    $content .= '<td class="handle"><a href="#!" data-target="#script-' . $z . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>';
    $content .= '</tr>';
    $z++;
}
$z++;
$content .= '<tr>';
$content .= '<td></td>';
$content .= '<td><input name="enqueue[scripts][' . $z . '][url]" type="url"  class="form-control" placeholder="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap" /></td>';
$content .= '<td><input name="enqueue[scripts][' . $z . '][attr]"  class="form-control" placeholder="crossorigin=&quot;anonymous&quot;" /></td>';
$content .= '<td><input name="submit" type="submit" class="btn btn btn-primary btn-flat pull-left" value="' . __e('Add') . '" /></td>';
$content .= '</tr>';

$content .= '</tbody>';
$content .= '</table>';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?index&type=html">' . __e('View Source Code') . '</a>';

$content .= '</div><!-- ./box-footer -->';
$content .= '</div><!-- ./box -->';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="row"> <!-- row -->';
// TODO: FORM --|-- STYLES
$content .= '<div class="col-md-12">';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Custom Meta Tags') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
if (!isset($enqueues['code']))
{
    $enqueues['code'] = '';
}


$content .= '<p> ' . __e('This menu used for custom Meta Tags HTML') . '</p>';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/index.html</code></p>';
$content .= '<div class="example-code">';
$content .= __e('Example') . ':';
$content .= '<pre>';
$content .= htmlentities('<meta http-equiv="Content-Security-Policy" content="default-src *; style-src * \'self\' \'unsafe-inline\' \'unsafe-eval\'; script-src * \'self\' \'unsafe-inline\' \'unsafe-eval\';">');
$content .= '</pre>';
$content .= '</div>';

$content .= '<textarea id="html" data-type="html5"  name="enqueue[code]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($enqueues['code']) . '</textarea>';
$content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?index&type=html">' . __e('View Source Code') . '</a>';
$content .= '</div><!-- ./box-footer -->';
$content .= '</div><!-- ./box -->';
$content .= '</div>';
$content .= '</div>';


$content .= '</form>';


$page_js = '
$(document).ready(function() {   
    $(".item-list").sortable({
        opacity: 0.5,
        items: ".item",
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: false,
        zIndex: 999999
    });    
    
});
';

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Meta Tags');
$template->page_desc = __e('Meta Tags and enqueue your scripts or style');
$template->page_content = $content;

?>