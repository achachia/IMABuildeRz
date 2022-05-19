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

if ($_SESSION['CURRENT_APP_PREFIX'] == '')
{
    header('Location: ?');
}

if (isset($_POST['code']))
{
     $_SESSION['TEST-CODE'] = $_POST['code'];
    header('Location: ?p=components-tester&'.time());
}


$content = $breadcrumb = $form_content = $html_color_option = null;
$db = new jsmDatabase();
$icon = new jsmIcon();


$db->current();
$breadcrumb = $content = null;
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>';
$breadcrumb .= '<li class="active">Components Tester</li>';
$breadcrumb .= '</ol>';
if(!isset($_SESSION['TEST-CODE'])){
    $_SESSION['TEST-CODE'] = '';
}

$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Components') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<form action="" method="post">';

$content .= '<div class="form-group">';
$content .= '<textarea class="form-control" data-type="html5" name="code">'.htmlentities( $_SESSION['TEST-CODE']).'</textarea>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<input type="submit" class="btn btn-danger" value="'.__e('Test Code').'" />';
$content .= '</div>';
$content .= '</form>';

$content .= '</div>';
$content .= '</div>';

$content .= '</div>';
$content .= '<div class="col-md-6">';

$content .= '<iframe src="./system/plugin/tester/index.php?'.time().'" width="375" height="667"></iframe>';

$content .= '</div>';
$content .= '</div>';

$template->page_breadcrumb = $breadcrumb;
$template->page_title = 'Components Tester';
$template->page_desc = 'Test your ionic components, before saving them to the page.';
$template->page_content = $content;


?>