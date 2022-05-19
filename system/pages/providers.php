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
$content = $breadcrumb = null;
if(!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> '.__e('Home').'</a></li>';
$breadcrumb .= '<li class="active">'.__e('Providers').'</li>';
$breadcrumb .= '</ol>';

$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> '.__e('General').'</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="well"><h1>Under Construction</h1><p class="lead">This page is under construction. Please come back soon!</p></div>';
$content .= '</div>';
$content .= '</div>';


$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('Providers');
$template->page_desc = __e('');
$template->page_content = $content;

?>