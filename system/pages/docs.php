<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 
 * @package No project loaded
 */

header('Location: https://ihsana.com/imabuilder3/?/docs/');

$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Documentation';
$template->page_desc = __e('');
$template->page_content = $content;

?>