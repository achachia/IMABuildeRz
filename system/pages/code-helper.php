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

$content = $breadcrumb = $form_content = $html_color_option = null;
$db = new jsmDatabase();
$icon = new jsmIcon();


$db->current();

$breadcrumb = $content = null;
$content = '';
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>';
$breadcrumb .= '<li class="active">Code Helper</li>';
$breadcrumb .= '</ol>';

$content .= '<div class="row">';
$content .= '<div class="col-md-6">';

$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Internal Link') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

foreach ($db->getPages() as $page)
{
    if (!isset($page['param']))
    {
        $page['param'] = '';
    }
    $content .= '<div>';
    $content .= '<h3>Goto `' . $page['name'] . '` Page</h3>';

    $content .= '<pre>';
    if ($page['param'] == '')
    {
        $content .= htmlentities('<ion-button [routerDirection]="\'root\'" [routerLink]="[\'/\',\'' . $page['name'] . '\']" >') . "\r\n";
    } else
    {
        $content .= htmlentities('<ion-button [routerDirection]="\'root\'" [routerLink]="[\'/\',\'' . $page['name'] . '\',\'1\']" >') . "\r\n";
    }
    $content .= htmlentities("\t" . '' . $page['title'] . '') . "\r\n";
    $content .= htmlentities('</ion-button>') . "\r\n";
    $content .= '</pre>';

    $content .= '<pre>';
    if ($page['param'] == '')
    {
        $content .= htmlentities('<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $page['name'] . '\']" >') . "\r\n";
    } else
    {
        $content .= htmlentities('<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $page['name'] . '\',\'1\']" >') . "\r\n";
    }
    $content .= htmlentities("\t" . '' . $page['title'] . '') . "\r\n";
    $content .= htmlentities('</ion-button>') . "\r\n";
    $content .= '</pre>';
    $content .= '</div>';
}

$content .= '</div>';
$content .= '</div>';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Pipes') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

foreach ($_SESSION['CURRENT_APP']['pipes'] as $pipe)
{
    $content .= '<div>';
    $content .= '<h3>' . $pipe['name'] . '</h3>';
    $content .= '<blockquote>' . $pipe['desc'] . '</blockquote>';
    $content .= $pipe['instruction'];
    $content .= '</div>';
}

$content .= '</div>';
$content .= '</div>';


$content .= '</div>';

$content .= '<div class="col-md-6">';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Directives') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

foreach ($_SESSION['CURRENT_APP']['directives'] as $directive)
{
    $content .= '<div>';
    $content .= '<h3>' . $directive['name'] . '</h3>';
    $content .= '<blockquote>' . $directive['desc'] . '</blockquote>';
    $content .= $directive['instruction'];
    $content .= '</div>';
}

$content .= '</div>';
$content .= '</div>';

$content .= '</div>';

$template->page_breadcrumb = $breadcrumb;
$template->page_title = 'Code Helper';
$template->page_desc = 'Code samples are used to edit pages';
$template->page_content = $content;

?>