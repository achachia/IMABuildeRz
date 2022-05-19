<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 
 * @package No project loaded
 */

defined("JSM_EXEC") or die("Silence is golden");
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

$page_js = $breadcrumb = $content = null;
// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . ('Youtube Channel') . '</li>';
$breadcrumb .= '</ol>';

 
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-life-bouy"></i> ' . __e('Youtube Channel') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>'.__e('Please subscribe and press the bell on our YouTube channel to get the latest information') . '</p>';
$content .= '<iframe width="100%" height="709" src="https://www.youtube.com/embed/Zf-01YF_VWY?list=PLTZu651JU2QL-D3pBPa_xHg9msvCEP0NT" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
$content .= '<br/>';
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = ('Youtube Channel');
$template->page_desc = '';
$template->page_content = $content;

?>