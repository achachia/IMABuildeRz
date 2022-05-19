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
if(!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

$breadcrumb = $content = $page_js = null;

$db = new jsmDatabase();
$icon = new jsmIcon();
$db->Current();


// TODO: LAYOUT
 
$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Discuss';
$template->page_desc = __e('');
$template->page_content = $content;

?>