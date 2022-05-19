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
if(!isset($_SESSION['CURRENT_APP']['apps']['app-prefix'])) {
    header('Location: ?');
}


$db = new jsmDatabase();

$db->current();

if(isset($_POST['config'])) {
    $_newConfig = $_POST['config'];

    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The global configuration has been successfully edited');
    $db->saveConfig($_newConfig);
    $db->current();
    rebuild();
    header("Location: ./?p=config");
}

if(isset($_SESSION['CURRENT_APP']['config'])) {
    $configxml = $_SESSION['CURRENT_APP']['config'];
}

$breadcrumb = $content = null;
if(!isset($configxml['content'])) {
    $configxml['content'] = '';
}

$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> '.__e('Home').'</a></li>';
$breadcrumb .= '<li class="active">'.__e('Global Configuration').'</li>';
$breadcrumb .= '</ol>';

$content .= '<form action="" method="post">';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-gear"></i> '.__e('General').'</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body pad">';
$content .= '<p>This menu for append code to <code>config.xml</code>, config.xml is a global configuration file that controls many aspects of a cordova application\'s behavior. </p>';

$content .= '<p class="output-file">' . __e('Generated file') . ': <code>config.xml</code></p>';
$content .= '<div class="example-code">';
$content .= __e('Example') . ':';
$content .= '<pre>';
$content .= htmlentities('<platform name="android">'."\r\n");
$content .= htmlentities('...')."\r\n";
$content .= htmlentities('</platform>');
$content .= '</pre>';
$content .= '</div>';

$content .= '<textarea data-type="html5" id="page-xml" name="config[content]" placeholder="XML Code" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.htmlentities($configxml['content']).'</textarea>';
$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> '.__e('Save Changes').'</button>&nbsp;';
$content .= '<a class="btn btn-flat btn-info" href="./?p=config" ><i class="fa fa-rotate-right"></i> '.__e('Reload').'</a>&nbsp;';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?config">'.__e('View Source Code').'</a>';
$content .= '</div>';

$content .= '</div>';
$content .= '</form>';

$page_js = "";


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Configuration');
$template->page_desc = '';
$template->page_content = $content;

?>