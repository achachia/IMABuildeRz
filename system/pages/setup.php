<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 
 * @package No project loaded
 */

header('Location: ./setup.php');

$page_js = $breadcrumb = $content = null;
$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('Register');
$template->page_desc = '';
$template->page_content = $content;


?>