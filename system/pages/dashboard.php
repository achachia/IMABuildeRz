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
$breadcrumb = '<ol class="breadcrumb"><li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Dashboard</li></ol>';


$template->page_breadcrumb = $breadcrumb;
$template->page_title = 'Dashboard';
$template->page_desc = '';
$template->page_content = $content;

?>