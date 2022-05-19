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
$db->Current();


// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Add-Ons Developer') . '</li>';
$breadcrumb .= '</ol>';

$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Join Us') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="well">';
$content .= '<h1>' . __e('Add-Ons Developer') . '</h1>';
$content .= '<p class="lead">' . __e('Discover new business opportunities of IMABuildeRz Add-on market. Develop new add-ons to extend the capabilities of the appbuilder and start earning, need more answers about Add-ons Developer? Join <a href="https://web.facebook.com/groups/ihsana/" target="_blank">our facebook group</a>') . '</p>';
$content .= '<a href="./3party/" class="btn btn-danger btn-lg" target="_blank">Try create an Add-ons</a>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('API Reference') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<h3>' . __e('Database') . '</h3>';
$content .= '<pre>$db = jsmDatabase();</pre>';
$content .= '<pre>$db->saveService($data);</pre>';

$content .= '<table class="table table-striped">';

$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>' . __e('Function') . '</th>';
$content .= '<th>' . __e('Example') . '</th>';
$content .= '</tr>';
$content .= '</thead>';

$content .= '<tbody>';
$content .= '<tr>';
$content .= '<td>saveProject($data)</td>';
$content .= '<td>$db->saveProject($data)</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>saveMenu($data)</td>';
$content .= '<td>$db->saveMenu($data)</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>saveService($data)</td>';
$content .= '<td>$db->saveService($data)</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>saveDirective($data)</td>';
$content .= '<td>$db->saveDirective($data)</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>getDirective($name)</td>';
$content .= '<td>$db->getDirective($name)</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>deleteDirective($name)</td>';
$content .= '<td>$db->deleteDirective($name)</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>savePipe($data)</td>';
$content .= '<td>$db->savePipe($data)</td>';
$content .= '</tr>';


$content .= '</tbody>';
$content .= '</table>';

$content .= '<h4>' . __e('Save settings for Add-ons') . '</h4>';
$content .= '<div class="highlight">';
$content .= highlight_string('<?php
$addons_setting = array();
$addons_setting["page-target"] = $current_page_target ;
$addons_setting["page-title"] = trim($_POST["your-addons"]["page-title"]) ;
$addons_setting["other-option"] = trim($_POST["your-addons"]["other-option"]) ;
$db = new jsmDatabase(); 
$db->saveAddOns("your-addons",$addons_setting); 
?>
', true);
$content .= '</div>';
$content .= '<br/>';
$content .= '<h4>' . __e('Get Add-ons settings') . '</h4>';
$content .= '<div class="highlight">';
$content .= highlight_string('<?php
$addons_setting = $db->getAddOns("your-addons",$current_page_target);
print_r($addons_setting);', true);
$content .= '</div>';
$content .= '<br/>';
$content .= '<h4>' . __e('Add Styles:') . '</h4>';

$content .= '<div class="highlight">';
$content .= highlight_string('<?php
$css[] = array("url"=>"http://yourwebsite/css1.css","attr"=>"media=\'all\'");
$css[] = array("url"=>"http://yourwebsite/css2.css");
$db->getAddOns("styles",$css);
?>', true);
$content .= '</div>';

$content .= '</div>';
$content .= '</div>';

// TODO: LAYOUT

$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Add-Ons Developer';
$template->page_desc = __e('Join us to make an addons!');
$template->page_content = $content;

?>