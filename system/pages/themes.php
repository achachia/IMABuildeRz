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
$db->current();
if (isset($_POST['themes']))
{
    $_newThemes = $_POST['themes'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = ('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = ('The theme settings has been successfully edited');
    $db->saveThemes($_newThemes);
    $db->current();
    rebuild();
    header("Location: ./?p=themes");
}
// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . ('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . ('Themes') . '</li>';
$breadcrumb .= '</ol>';
if (isset($_SESSION['CURRENT_APP']['themes']))
{
    $themes = $_SESSION['CURRENT_APP']['themes'];
}
// TODO: CONTENT
if (!isset($themes['color']['primary']))
{
    $themes['color']['primary'] = '#3880ff';
}
if (!isset($themes['color']['primary-rgb']))
{
    $themes['color']['primary-rgb'] = '56, 128, 255';
}
if (!isset($themes['color']['primary-contrast']))
{
    $themes['color']['primary-contrast'] = '#ffffff';
}
if (!isset($themes['color']['primary-contrast-rgb']))
{
    $themes['color']['primary-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['primary-shade']))
{
    $themes['color']['primary-shade'] = '#3171e0';
}
if (!isset($themes['color']['primary-tint']))
{
    $themes['color']['primary-tint'] = '#4c8dff';
}
if (!isset($themes['color']['secondary']))
{
    $themes['color']['secondary'] = '#0cd1e8';
}
if (!isset($themes['color']['secondary-rgb']))
{
    $themes['color']['secondary-rgb'] = '12, 209, 232';
}
if (!isset($themes['color']['secondary-contrast']))
{
    $themes['color']['secondary-contrast'] = '#ffffff';
}
if (!isset($themes['color']['secondary-contrast-rgb']))
{
    $themes['color']['secondary-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['secondary-shade']))
{
    $themes['color']['secondary-shade'] = '#0bb8cc';
}
if (!isset($themes['color']['secondary-tint']))
{
    $themes['color']['secondary-tint'] = '#24d6ea';
}
if (!isset($themes['color']['tertiary']))
{
    $themes['color']['tertiary'] = '#7044ff';
}
if (!isset($themes['color']['tertiary-rgb']))
{
    $themes['color']['tertiary-rgb'] = '112, 68, 255';
}
if (!isset($themes['color']['tertiary-contrast']))
{
    $themes['color']['tertiary-contrast'] = '#ffffff';
}
if (!isset($themes['color']['tertiary-contrast-rgb']))
{
    $themes['color']['tertiary-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['tertiary-shade']))
{
    $themes['color']['tertiary-shade'] = '#633ce0';
}
if (!isset($themes['color']['tertiary-tint']))
{
    $themes['color']['tertiary-tint'] = '#7e57ff';
}
if (!isset($themes['color']['success']))
{
    $themes['color']['success'] = '#10dc60';
}
if (!isset($themes['color']['success-rgb']))
{
    $themes['color']['success-rgb'] = '16, 220, 96';
}
if (!isset($themes['color']['success-contrast']))
{
    $themes['color']['success-contrast'] = '#ffffff';
}
if (!isset($themes['color']['success-contrast-rgb']))
{
    $themes['color']['success-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['success-shade']))
{
    $themes['color']['success-shade'] = '#0ec254';
}
if (!isset($themes['color']['success-tint']))
{
    $themes['color']['success-tint'] = '#28e070';
}
if (!isset($themes['color']['warning']))
{
    $themes['color']['warning'] = '#ffce00';
}
if (!isset($themes['color']['warning-rgb']))
{
    $themes['color']['warning-rgb'] = '255, 206, 0';
}
if (!isset($themes['color']['warning-contrast']))
{
    $themes['color']['warning-contrast'] = '#ffffff';
}
if (!isset($themes['color']['warning-contrast-rgb']))
{
    $themes['color']['warning-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['warning-shade']))
{
    $themes['color']['warning-shade'] = '#e0b500';
}
if (!isset($themes['color']['warning-tint']))
{
    $themes['color']['warning-tint'] = '#ffd31a';
}
if (!isset($themes['color']['danger']))
{
    $themes['color']['danger'] = '#f04141';
}
if (!isset($themes['color']['danger-rgb']))
{
    $themes['color']['danger-rgb'] = '245, 61, 61';
}
if (!isset($themes['color']['danger-contrast']))
{
    $themes['color']['danger-contrast'] = '#ffffff';
}
if (!isset($themes['color']['danger-contrast-rgb']))
{
    $themes['color']['danger-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['danger-shade']))
{
    $themes['color']['danger-shade'] = '#d33939';
}
if (!isset($themes['color']['danger-tint']))
{
    $themes['color']['danger-tint'] = '#f25454';
}
if (!isset($themes['color']['dark']))
{
    $themes['color']['dark'] = '#222428';
}
if (!isset($themes['color']['dark-rgb']))
{
    $themes['color']['dark-rgb'] = '34, 34, 34';
}
if (!isset($themes['color']['dark-contrast']))
{
    $themes['color']['dark-contrast'] = '#ffffff';
}
if (!isset($themes['color']['dark-contrast-rgb']))
{
    $themes['color']['dark-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['dark-shade']))
{
    $themes['color']['dark-shade'] = '#1e2023';
}
if (!isset($themes['color']['dark-tint']))
{
    $themes['color']['dark-tint'] = '#383a3e';
}
if (!isset($themes['color']['medium']))
{
    $themes['color']['medium'] = '#989aa2';
}
if (!isset($themes['color']['medium-rgb']))
{
    $themes['color']['medium-rgb'] = '152, 154, 162';
}
if (!isset($themes['color']['medium-contrast']))
{
    $themes['color']['medium-contrast'] = '#ffffff';
}
if (!isset($themes['color']['medium-contrast-rgb']))
{
    $themes['color']['medium-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['color']['medium-shade']))
{
    $themes['color']['medium-shade'] = '#86888f';
}
if (!isset($themes['color']['medium-tint']))
{
    $themes['color']['medium-tint'] = '#a2a4ab';
}
if (!isset($themes['color']['light']))
{
    $themes['color']['light'] = '#f4f5f8';
}
if (!isset($themes['color']['light-rgb']))
{
    $themes['color']['light-rgb'] = '244, 244, 244';
}
if (!isset($themes['color']['light-contrast']))
{
    $themes['color']['light-contrast'] = '#000000';
}
if (!isset($themes['color']['light-contrast-rgb']))
{
    $themes['color']['light-contrast-rgb'] = '0, 0, 0';
}
if (!isset($themes['color']['light-shade']))
{
    $themes['color']['light-shade'] = '#d7d8da';
}
if (!isset($themes['color']['light-tint']))
{
    $themes['color']['light-tint'] = '#f5f6f9';
}
if ($themes['color']['primary'] == '')
{
    $themes['color']['primary'] = '#3880ff';
}
if ($themes['color']['primary-rgb'] == '')
{
    $themes['color']['primary-rgb'] = '56, 128, 255';
}
if ($themes['color']['primary-contrast'] == '')
{
    $themes['color']['primary-contrast'] = '#ffffff';
}
if ($themes['color']['primary-contrast-rgb'] == '')
{
    $themes['color']['primary-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['primary-shade'] == '')
{
    $themes['color']['primary-shade'] = '#3171e0';
}
if ($themes['color']['primary-tint'] == '')
{
    $themes['color']['primary-tint'] = '#4c8dff';
}
if ($themes['color']['secondary'] == '')
{
    $themes['color']['secondary'] = '#0cd1e8';
}
if ($themes['color']['secondary-rgb'] == '')
{
    $themes['color']['secondary-rgb'] = '12, 209, 232';
}
if ($themes['color']['secondary-contrast'] == '')
{
    $themes['color']['secondary-contrast'] = '#ffffff';
}
if ($themes['color']['secondary-contrast-rgb'] == '')
{
    $themes['color']['secondary-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['secondary-shade'] == '')
{
    $themes['color']['secondary-shade'] = '#0bb8cc';
}
if ($themes['color']['secondary-tint'] == '')
{
    $themes['color']['secondary-tint'] = '#24d6ea';
}
if ($themes['color']['tertiary'] == '')
{
    $themes['color']['tertiary'] = '#7044ff';
}
if ($themes['color']['tertiary-rgb'] == '')
{
    $themes['color']['tertiary-rgb'] = '112, 68, 255';
}
if ($themes['color']['tertiary-contrast'] == '')
{
    $themes['color']['tertiary-contrast'] = '#ffffff';
}
if ($themes['color']['tertiary-contrast-rgb'] == '')
{
    $themes['color']['tertiary-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['tertiary-shade'] == '')
{
    $themes['color']['tertiary-shade'] = '#633ce0';
}
if ($themes['color']['tertiary-tint'] == '')
{
    $themes['color']['tertiary-tint'] = '#7e57ff';
}
if ($themes['color']['success'] == '')
{
    $themes['color']['success'] = '#10dc60';
}
if ($themes['color']['success-rgb'] == '')
{
    $themes['color']['success-rgb'] = '16, 220, 96';
}
if ($themes['color']['success-contrast'] == '')
{
    $themes['color']['success-contrast'] = '#ffffff';
}
if ($themes['color']['success-contrast-rgb'] == '')
{
    $themes['color']['success-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['success-shade'] == '')
{
    $themes['color']['success-shade'] = '#0ec254';
}
if ($themes['color']['success-tint'] == '')
{
    $themes['color']['success-tint'] = '#28e070';
}
if ($themes['color']['warning'] == '')
{
    $themes['color']['warning'] = '#ffce00';
}
if ($themes['color']['warning-rgb'] == '')
{
    $themes['color']['warning-rgb'] = '255, 206, 0';
}
if ($themes['color']['warning-contrast'] == '')
{
    $themes['color']['warning-contrast'] = '#ffffff';
}
if ($themes['color']['warning-contrast-rgb'] == '')
{
    $themes['color']['warning-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['warning-shade'] == '')
{
    $themes['color']['warning-shade'] = '#e0b500';
}
if ($themes['color']['warning-tint'] == '')
{
    $themes['color']['warning-tint'] = '#ffd31a';
}
if ($themes['color']['danger'] == '')
{
    $themes['color']['danger'] = '#f04141';
}
if ($themes['color']['danger-rgb'] == '')
{
    $themes['color']['danger-rgb'] = '245, 61, 61';
}
if ($themes['color']['danger-contrast'] == '')
{
    $themes['color']['danger-contrast'] = '#ffffff';
}
if ($themes['color']['danger-contrast-rgb'] == '')
{
    $themes['color']['danger-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['danger-shade'] == '')
{
    $themes['color']['danger-shade'] = '#d33939';
}
if ($themes['color']['danger-tint'] == '')
{
    $themes['color']['danger-tint'] = '#f25454';
}
if ($themes['color']['dark'] == '')
{
    $themes['color']['dark'] = '#222428';
}
if ($themes['color']['dark-rgb'] == '')
{
    $themes['color']['dark-rgb'] = '34, 34, 34';
}
if ($themes['color']['dark-contrast'] == '')
{
    $themes['color']['dark-contrast'] = '#ffffff';
}
if ($themes['color']['dark-contrast-rgb'] == '')
{
    $themes['color']['dark-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['dark-shade'] == '')
{
    $themes['color']['dark-shade'] = '#1e2023';
}
if ($themes['color']['dark-tint'] == '')
{
    $themes['color']['dark-tint'] = '#383a3e';
}
if ($themes['color']['medium'] == '')
{
    $themes['color']['medium'] = '#989aa2';
}
if ($themes['color']['medium-rgb'] == '')
{
    $themes['color']['medium-rgb'] = '152, 154, 162';
}
if ($themes['color']['medium-contrast'] == '')
{
    $themes['color']['medium-contrast'] = '#ffffff';
}
if ($themes['color']['medium-contrast-rgb'] == '')
{
    $themes['color']['medium-contrast-rgb'] = '255, 255, 255';
}
if ($themes['color']['medium-shade'] == '')
{
    $themes['color']['medium-shade'] = '#86888f';
}
if ($themes['color']['medium-tint'] == '')
{
    $themes['color']['medium-tint'] = '#a2a4ab';
}
if ($themes['color']['light'] == '')
{
    $themes['color']['light'] = '#f4f5f8';
}
if ($themes['color']['light-rgb'] == '')
{
    $themes['color']['light-rgb'] = '244, 244, 244';
}
if ($themes['color']['light-contrast'] == '')
{
    $themes['color']['light-contrast'] = '#000000';
}
if ($themes['color']['light-contrast-rgb'] == '')
{
    $themes['color']['light-contrast-rgb'] = '0, 0, 0';
}
if ($themes['color']['light-shade'] == '')
{
    $themes['color']['light-shade'] = '#d7d8da';
}
if ($themes['color']['light-tint'] == '')
{
    $themes['color']['light-tint'] = '#f5f6f9';
}

if (!isset($themes['dark-color']['primary']))
{
    $themes['dark-color']['primary'] = '#3880ff';
}
if (!isset($themes['dark-color']['primary-rgb']))
{
    $themes['dark-color']['primary-rgb'] = '56, 128, 255';
}
if (!isset($themes['dark-color']['primary-contrast']))
{
    $themes['dark-color']['primary-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['primary-contrast-rgb']))
{
    $themes['dark-color']['primary-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['primary-shade']))
{
    $themes['dark-color']['primary-shade'] = '#3171e0';
}
if (!isset($themes['dark-color']['primary-tint']))
{
    $themes['dark-color']['primary-tint'] = '#4c8dff';
}
if (!isset($themes['dark-color']['secondary']))
{
    $themes['dark-color']['secondary'] = '#0cd1e8';
}
if (!isset($themes['dark-color']['secondary-rgb']))
{
    $themes['dark-color']['secondary-rgb'] = '12, 209, 232';
}
if (!isset($themes['dark-color']['secondary-contrast']))
{
    $themes['dark-color']['secondary-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['secondary-contrast-rgb']))
{
    $themes['dark-color']['secondary-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['secondary-shade']))
{
    $themes['dark-color']['secondary-shade'] = '#0bb8cc';
}
if (!isset($themes['dark-color']['secondary-tint']))
{
    $themes['dark-color']['secondary-tint'] = '#24d6ea';
}
if (!isset($themes['dark-color']['tertiary']))
{
    $themes['dark-color']['tertiary'] = '#7044ff';
}
if (!isset($themes['dark-color']['tertiary-rgb']))
{
    $themes['dark-color']['tertiary-rgb'] = '112, 68, 255';
}
if (!isset($themes['dark-color']['tertiary-contrast']))
{
    $themes['dark-color']['tertiary-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['tertiary-contrast-rgb']))
{
    $themes['dark-color']['tertiary-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['tertiary-shade']))
{
    $themes['dark-color']['tertiary-shade'] = '#633ce0';
}
if (!isset($themes['dark-color']['tertiary-tint']))
{
    $themes['dark-color']['tertiary-tint'] = '#7e57ff';
}
if (!isset($themes['dark-color']['success']))
{
    $themes['dark-color']['success'] = '#10dc60';
}
if (!isset($themes['dark-color']['success-rgb']))
{
    $themes['dark-color']['success-rgb'] = '16, 220, 96';
}
if (!isset($themes['dark-color']['success-contrast']))
{
    $themes['dark-color']['success-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['success-contrast-rgb']))
{
    $themes['dark-color']['success-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['success-shade']))
{
    $themes['dark-color']['success-shade'] = '#0ec254';
}
if (!isset($themes['dark-color']['success-tint']))
{
    $themes['dark-color']['success-tint'] = '#28e070';
}
if (!isset($themes['dark-color']['warning']))
{
    $themes['dark-color']['warning'] = '#ffce00';
}
if (!isset($themes['dark-color']['warning-rgb']))
{
    $themes['dark-color']['warning-rgb'] = '255, 206, 0';
}
if (!isset($themes['dark-color']['warning-contrast']))
{
    $themes['dark-color']['warning-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['warning-contrast-rgb']))
{
    $themes['dark-color']['warning-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['warning-shade']))
{
    $themes['dark-color']['warning-shade'] = '#e0b500';
}
if (!isset($themes['dark-color']['warning-tint']))
{
    $themes['dark-color']['warning-tint'] = '#ffd31a';
}
if (!isset($themes['dark-color']['danger']))
{
    $themes['dark-color']['danger'] = '#f04141';
}
if (!isset($themes['dark-color']['danger-rgb']))
{
    $themes['dark-color']['danger-rgb'] = '245, 61, 61';
}
if (!isset($themes['dark-color']['danger-contrast']))
{
    $themes['dark-color']['danger-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['danger-contrast-rgb']))
{
    $themes['dark-color']['danger-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['danger-shade']))
{
    $themes['dark-color']['danger-shade'] = '#d33939';
}
if (!isset($themes['dark-color']['danger-tint']))
{
    $themes['dark-color']['danger-tint'] = '#f25454';
}
if (!isset($themes['dark-color']['dark']))
{
    $themes['dark-color']['dark'] = '#222428';
}
if (!isset($themes['dark-color']['dark-rgb']))
{
    $themes['dark-color']['dark-rgb'] = '34, 34, 34';
}
if (!isset($themes['dark-color']['dark-contrast']))
{
    $themes['dark-color']['dark-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['dark-contrast-rgb']))
{
    $themes['dark-color']['dark-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['dark-shade']))
{
    $themes['dark-color']['dark-shade'] = '#1e2023';
}
if (!isset($themes['dark-color']['dark-tint']))
{
    $themes['dark-color']['dark-tint'] = '#383a3e';
}
if (!isset($themes['dark-color']['medium']))
{
    $themes['dark-color']['medium'] = '#989aa2';
}
if (!isset($themes['dark-color']['medium-rgb']))
{
    $themes['dark-color']['medium-rgb'] = '152, 154, 162';
}
if (!isset($themes['dark-color']['medium-contrast']))
{
    $themes['dark-color']['medium-contrast'] = '#ffffff';
}
if (!isset($themes['dark-color']['medium-contrast-rgb']))
{
    $themes['dark-color']['medium-contrast-rgb'] = '255, 255, 255';
}
if (!isset($themes['dark-color']['medium-shade']))
{
    $themes['dark-color']['medium-shade'] = '#86888f';
}
if (!isset($themes['dark-color']['medium-tint']))
{
    $themes['dark-color']['medium-tint'] = '#a2a4ab';
}
if (!isset($themes['dark-color']['light']))
{
    $themes['dark-color']['light'] = '#f4f5f8';
}
if (!isset($themes['dark-color']['light-rgb']))
{
    $themes['dark-color']['light-rgb'] = '244, 244, 244';
}
if (!isset($themes['dark-color']['light-contrast']))
{
    $themes['dark-color']['light-contrast'] = '#000000';
}
if (!isset($themes['dark-color']['light-contrast-rgb']))
{
    $themes['dark-color']['light-contrast-rgb'] = '0, 0, 0';
}
if (!isset($themes['dark-color']['light-shade']))
{
    $themes['dark-color']['light-shade'] = '#d7d8da';
}
if (!isset($themes['dark-color']['light-tint']))
{
    $themes['dark-color']['light-tint'] = '#f5f6f9';
}
if ($themes['dark-color']['primary'] == '')
{
    $themes['dark-color']['primary'] = '#3880ff';
}
if ($themes['dark-color']['primary-rgb'] == '')
{
    $themes['dark-color']['primary-rgb'] = '56, 128, 255';
}
if ($themes['dark-color']['primary-contrast'] == '')
{
    $themes['dark-color']['primary-contrast'] = '#ffffff';
}
if ($themes['dark-color']['primary-contrast-rgb'] == '')
{
    $themes['dark-color']['primary-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['primary-shade'] == '')
{
    $themes['dark-color']['primary-shade'] = '#3171e0';
}
if ($themes['dark-color']['primary-tint'] == '')
{
    $themes['dark-color']['primary-tint'] = '#4c8dff';
}
if ($themes['dark-color']['secondary'] == '')
{
    $themes['dark-color']['secondary'] = '#0cd1e8';
}
if ($themes['dark-color']['secondary-rgb'] == '')
{
    $themes['dark-color']['secondary-rgb'] = '12, 209, 232';
}
if ($themes['dark-color']['secondary-contrast'] == '')
{
    $themes['dark-color']['secondary-contrast'] = '#ffffff';
}
if ($themes['dark-color']['secondary-contrast-rgb'] == '')
{
    $themes['dark-color']['secondary-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['secondary-shade'] == '')
{
    $themes['dark-color']['secondary-shade'] = '#0bb8cc';
}
if ($themes['dark-color']['secondary-tint'] == '')
{
    $themes['dark-color']['secondary-tint'] = '#24d6ea';
}
if ($themes['dark-color']['tertiary'] == '')
{
    $themes['dark-color']['tertiary'] = '#7044ff';
}
if ($themes['dark-color']['tertiary-rgb'] == '')
{
    $themes['dark-color']['tertiary-rgb'] = '112, 68, 255';
}
if ($themes['dark-color']['tertiary-contrast'] == '')
{
    $themes['dark-color']['tertiary-contrast'] = '#ffffff';
}
if ($themes['dark-color']['tertiary-contrast-rgb'] == '')
{
    $themes['dark-color']['tertiary-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['tertiary-shade'] == '')
{
    $themes['dark-color']['tertiary-shade'] = '#633ce0';
}
if ($themes['dark-color']['tertiary-tint'] == '')
{
    $themes['dark-color']['tertiary-tint'] = '#7e57ff';
}
if ($themes['dark-color']['success'] == '')
{
    $themes['dark-color']['success'] = '#10dc60';
}
if ($themes['dark-color']['success-rgb'] == '')
{
    $themes['dark-color']['success-rgb'] = '16, 220, 96';
}
if ($themes['dark-color']['success-contrast'] == '')
{
    $themes['dark-color']['success-contrast'] = '#ffffff';
}
if ($themes['dark-color']['success-contrast-rgb'] == '')
{
    $themes['dark-color']['success-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['success-shade'] == '')
{
    $themes['dark-color']['success-shade'] = '#0ec254';
}
if ($themes['dark-color']['success-tint'] == '')
{
    $themes['dark-color']['success-tint'] = '#28e070';
}
if ($themes['dark-color']['warning'] == '')
{
    $themes['dark-color']['warning'] = '#ffce00';
}
if ($themes['dark-color']['warning-rgb'] == '')
{
    $themes['dark-color']['warning-rgb'] = '255, 206, 0';
}
if ($themes['dark-color']['warning-contrast'] == '')
{
    $themes['dark-color']['warning-contrast'] = '#ffffff';
}
if ($themes['dark-color']['warning-contrast-rgb'] == '')
{
    $themes['dark-color']['warning-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['warning-shade'] == '')
{
    $themes['dark-color']['warning-shade'] = '#e0b500';
}
if ($themes['dark-color']['warning-tint'] == '')
{
    $themes['dark-color']['warning-tint'] = '#ffd31a';
}
if ($themes['dark-color']['danger'] == '')
{
    $themes['dark-color']['danger'] = '#f04141';
}
if ($themes['dark-color']['danger-rgb'] == '')
{
    $themes['dark-color']['danger-rgb'] = '245, 61, 61';
}
if ($themes['dark-color']['danger-contrast'] == '')
{
    $themes['dark-color']['danger-contrast'] = '#ffffff';
}
if ($themes['dark-color']['danger-contrast-rgb'] == '')
{
    $themes['dark-color']['danger-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['danger-shade'] == '')
{
    $themes['dark-color']['danger-shade'] = '#d33939';
}
if ($themes['dark-color']['danger-tint'] == '')
{
    $themes['dark-color']['danger-tint'] = '#f25454';
}
if ($themes['dark-color']['dark'] == '')
{
    $themes['dark-color']['dark'] = '#222428';
}
if ($themes['dark-color']['dark-rgb'] == '')
{
    $themes['dark-color']['dark-rgb'] = '34, 34, 34';
}
if ($themes['dark-color']['dark-contrast'] == '')
{
    $themes['dark-color']['dark-contrast'] = '#ffffff';
}
if ($themes['dark-color']['dark-contrast-rgb'] == '')
{
    $themes['dark-color']['dark-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['dark-shade'] == '')
{
    $themes['dark-color']['dark-shade'] = '#1e2023';
}
if ($themes['dark-color']['dark-tint'] == '')
{
    $themes['dark-color']['dark-tint'] = '#383a3e';
}
if ($themes['dark-color']['medium'] == '')
{
    $themes['dark-color']['medium'] = '#989aa2';
}
if ($themes['dark-color']['medium-rgb'] == '')
{
    $themes['dark-color']['medium-rgb'] = '152, 154, 162';
}
if ($themes['dark-color']['medium-contrast'] == '')
{
    $themes['dark-color']['medium-contrast'] = '#ffffff';
}
if ($themes['dark-color']['medium-contrast-rgb'] == '')
{
    $themes['dark-color']['medium-contrast-rgb'] = '255, 255, 255';
}
if ($themes['dark-color']['medium-shade'] == '')
{
    $themes['dark-color']['medium-shade'] = '#86888f';
}
if ($themes['dark-color']['medium-tint'] == '')
{
    $themes['dark-color']['medium-tint'] = '#a2a4ab';
}
if ($themes['dark-color']['light'] == '')
{
    $themes['dark-color']['light'] = '#f4f5f8';
}
if ($themes['dark-color']['light-rgb'] == '')
{
    $themes['dark-color']['light-rgb'] = '244, 244, 244';
}
if ($themes['dark-color']['light-contrast'] == '')
{
    $themes['dark-color']['light-contrast'] = '#000000';
}
if ($themes['dark-color']['light-contrast-rgb'] == '')
{
    $themes['dark-color']['light-contrast-rgb'] = '0, 0, 0';
}
if ($themes['dark-color']['light-shade'] == '')
{
    $themes['dark-color']['light-shade'] = '#d7d8da';
}
if ($themes['dark-color']['light-tint'] == '')
{
    $themes['dark-color']['light-tint'] = '#f5f6f9';
}


if (!isset($themes['custom-color']))
{
    $themes['custom-color'] = array();
}
if (!is_array($themes['custom-color']))
{
    $themes['custom-color'] = array();
}

$scss_code = null;
if (isset($themes['global']))
{
    $scss_code = $themes['global'];
}
$app_scss_code = null;
if (isset($themes['apps']))
{
    $app_scss_code = $themes['apps'];
}
// TODO: LAYOUT
$content .= '<form action="" method="post">';
$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-6">';


// TODO: LAYOUT --+-- COLOR VARIABLE
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-sun-o"></i> ' . __e('Light Color') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/theme/variables.scss</code></p>';

$content .= '<p>' . __e('Named colors makes it easy to reuse colors on various components') . '</p>';


$content .= '<div class="form-group"><input type="checkbox" class="themes-color-picker" checked="checked" /> ' . __e('Enable Color Picker') . '</div>';


// TODO: LAYOUT --+-- COLOR VARIABLE - PRIMARY
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-primary">' . ('Primary') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][primary]" id="themes-color-primary" placeholder="#000000" value="' . $themes['color']['primary'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-primary-contrast">' . ('Primary Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][primary-contrast]" id="themes-color-primary-contrast" placeholder="#000000" value="' . $themes['color']['primary-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-primary-shade">' . ('Primary Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][primary-shade]" id="themes-color-primary-shade" placeholder="#000000" value="' . $themes['color']['primary-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-primary-tint">' . ('Primary Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][primary-tint]" id="themes-color-primary-tint" placeholder="#000000" value="' . $themes['color']['primary-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - SECONDARY
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-secondary">' . ('Secondary') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][secondary]" id="themes-color-secondary" placeholder="#000000" value="' . $themes['color']['secondary'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-secondary-contrast">' . ('Secondary Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][secondary-contrast]" id="themes-color-secondary-contrast" placeholder="#000000" value="' . $themes['color']['secondary-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-secondary-shade">' . ('Secondary Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][secondary-shade]" id="themes-color-secondary-shade" placeholder="#000000" value="' . $themes['color']['secondary-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-secondary-tint">' . ('Secondary Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][secondary-tint]" id="themes-color-secondary-tint" placeholder="#000000" value="' . $themes['color']['secondary-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - TERTIARY
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-tertiary">' . ('Tertiary') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][tertiary]" id="themes-color-tertiary" placeholder="#000000" value="' . $themes['color']['tertiary'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-tertiary-contrast">' . ('Tertiary Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][tertiary-contrast]" id="themes-color-tertiary-contrast" placeholder="#000000" value="' . $themes['color']['tertiary-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-tertiary-shade">' . ('Tertiary Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][tertiary-shade]" id="themes-color-tertiary-shade" placeholder="#000000" value="' . $themes['color']['tertiary-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-tertiary-tint">' . ('Tertiary Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][tertiary-tint]" id="themes-color-tertiary-tint" placeholder="#000000" value="' . $themes['color']['tertiary-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - SUCCESS
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-success">' . ('Success') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][success]" id="themes-color-success" placeholder="#000000" value="' . $themes['color']['success'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-success-contrast">' . ('Success Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][success-contrast]" id="themes-color-success-contrast" placeholder="#000000" value="' . $themes['color']['success-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-success-shade">' . ('Success Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][success-shade]" id="themes-color-success-shade" placeholder="#000000" value="' . $themes['color']['success-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-success-tint">' . ('Success Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][success-tint]" id="themes-color-success-tint" placeholder="#000000" value="' . $themes['color']['success-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - WARNING
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-warning">' . ('Warning') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][warning]" id="themes-color-warning" placeholder="#000000" value="' . $themes['color']['warning'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-warning-contrast">' . ('Warning Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][warning-contrast]" id="themes-color-warning-contrast" placeholder="#000000" value="' . $themes['color']['warning-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-warning-shade">' . ('Warning Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][warning-shade]" id="themes-color-warning-shade" placeholder="#000000" value="' . $themes['color']['warning-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-warning-tint">' . ('Warning Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][warning-tint]" id="themes-color-warning-tint" placeholder="#000000" value="' . $themes['color']['warning-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - DANGER
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-danger">' . ('Danger') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][danger]" id="themes-color-danger" placeholder="#000000" value="' . $themes['color']['danger'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-danger-contrast">' . ('Danger Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][danger-contrast]" id="themes-color-danger-contrast" placeholder="#000000" value="' . $themes['color']['danger-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-danger-shade">' . ('Danger Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][danger-shade]" id="themes-color-danger-shade" placeholder="#000000" value="' . $themes['color']['danger-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-danger-tint">' . ('Danger Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][danger-tint]" id="themes-color-danger-tint" placeholder="#000000" value="' . $themes['color']['danger-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - DARK
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-dark">' . ('Dark') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][dark]" id="themes-color-dark" placeholder="#000000" value="' . $themes['color']['dark'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-dark-contrast">' . ('Dark Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][dark-contrast]" id="themes-color-dark-contrast" placeholder="#000000" value="' . $themes['color']['dark-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-dark-shade">' . ('Dark Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][dark-shade]" id="themes-color-dark-shade" placeholder="#000000" value="' . $themes['color']['dark-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-dark-tint">' . ('Dark Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][dark-tint]" id="themes-color-dark-tint" placeholder="#000000" value="' . $themes['color']['dark-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - MEDIUM
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-medium">' . ('Medium') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][medium]" id="themes-color-medium" placeholder="#000000" value="' . $themes['color']['medium'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-medium-contrast">' . ('Medium Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][medium-contrast]" id="themes-color-medium-contrast" placeholder="#000000" value="' . $themes['color']['medium-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-medium-shade">' . ('Medium Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][medium-shade]" id="themes-color-medium-shade" placeholder="#000000" value="' . $themes['color']['medium-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-medium-tint">' . ('Medium Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][medium-tint]" id="themes-color-medium-tint" placeholder="#000000" value="' . $themes['color']['medium-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- COLOR VARIABLE - LIGHT
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-light">' . ('Light') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][light]" id="themes-color-light" placeholder="#000000" value="' . $themes['color']['light'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-light-contrast">' . ('Light Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][light-contrast]" id="themes-color-light-contrast" placeholder="#000000" value="' . $themes['color']['light-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-light-shade">' . ('Light Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][light-shade]" id="themes-color-light-shade" placeholder="#000000" value="' . $themes['color']['light-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-color-light-tint">' . ('Light Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[color][light-tint]" id="themes-color-light-tint" placeholder="#000000" value="' . $themes['color']['light-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?theme=variables&type=scss">' . __e('View Source Code') . '</a>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="col-md-6"><!-- col-md-6 -->';

// TODO: LAYOUT --+-- COLOR VARIABLE
$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-moon-o"></i> ' . __e('Dark Color') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/theme/variables.scss</code></p>';
$content .= '<p>' . __e('Named colors makes it easy to reuse colors on various components') . '</p>';
$content .= '<div class="form-group"><input type="checkbox" class="themes-color-picker" checked="checked" /> ' . __e('Enable Color Picker') . '</div>';

// TODO: LAYOUT --+-- DARK COLOR VARIABLE - PRIMARY
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-primary">' . ('Primary') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][primary]" id="themes-dark-color-primary" placeholder="#000000" value="' . $themes['dark-color']['primary'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-primary-contrast">' . ('Primary Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][primary-contrast]" id="themes-dark-color-primary-contrast" placeholder="#000000" value="' . $themes['dark-color']['primary-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-primary-shade">' . ('Primary Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][primary-shade]" id="themes-dark-color-primary-shade" placeholder="#000000" value="' . $themes['dark-color']['primary-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-primary-tint">' . ('Primary Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][primary-tint]" id="themes-dark-color-primary-tint" placeholder="#000000" value="' . $themes['dark-color']['primary-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - SECONDARY
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-secondary">' . ('Secondary') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][secondary]" id="themes-dark-color-secondary" placeholder="#000000" value="' . $themes['dark-color']['secondary'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-secondary-contrast">' . ('Secondary Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][secondary-contrast]" id="themes-dark-color-secondary-contrast" placeholder="#000000" value="' . $themes['dark-color']['secondary-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-secondary-shade">' . ('Secondary Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][secondary-shade]" id="themes-dark-color-secondary-shade" placeholder="#000000" value="' . $themes['dark-color']['secondary-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-secondary-tint">' . ('Secondary Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][secondary-tint]" id="themes-dark-color-secondary-tint" placeholder="#000000" value="' . $themes['dark-color']['secondary-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - TERTIARY
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-tertiary">' . ('Tertiary') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][tertiary]" id="themes-dark-color-tertiary" placeholder="#000000" value="' . $themes['dark-color']['tertiary'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-tertiary-contrast">' . ('Tertiary Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][tertiary-contrast]" id="themes-dark-color-tertiary-contrast" placeholder="#000000" value="' . $themes['dark-color']['tertiary-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-tertiary-shade">' . ('Tertiary Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][tertiary-shade]" id="themes-dark-color-tertiary-shade" placeholder="#000000" value="' . $themes['dark-color']['tertiary-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-tertiary-tint">' . ('Tertiary Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][tertiary-tint]" id="themes-dark-color-tertiary-tint" placeholder="#000000" value="' . $themes['dark-color']['tertiary-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - SUCCESS
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-success">' . ('Success') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][success]" id="themes-dark-color-success" placeholder="#000000" value="' . $themes['dark-color']['success'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-success-contrast">' . ('Success Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][success-contrast]" id="themes-dark-color-success-contrast" placeholder="#000000" value="' . $themes['dark-color']['success-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-success-shade">' . ('Success Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][success-shade]" id="themes-dark-color-success-shade" placeholder="#000000" value="' . $themes['dark-color']['success-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-success-tint">' . ('Success Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][success-tint]" id="themes-dark-color-success-tint" placeholder="#000000" value="' . $themes['dark-color']['success-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - WARNING
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-warning">' . ('Warning') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][warning]" id="themes-dark-color-warning" placeholder="#000000" value="' . $themes['dark-color']['warning'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-warning-contrast">' . ('Warning Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][warning-contrast]" id="themes-dark-color-warning-contrast" placeholder="#000000" value="' . $themes['dark-color']['warning-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-warning-shade">' . ('Warning Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][warning-shade]" id="themes-dark-color-warning-shade" placeholder="#000000" value="' . $themes['dark-color']['warning-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-warning-tint">' . ('Warning Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][warning-tint]" id="themes-dark-color-warning-tint" placeholder="#000000" value="' . $themes['dark-color']['warning-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - DANGER
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-danger">' . ('Danger') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][danger]" id="themes-dark-color-danger" placeholder="#000000" value="' . $themes['dark-color']['danger'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-danger-contrast">' . ('Danger Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][danger-contrast]" id="themes-dark-color-danger-contrast" placeholder="#000000" value="' . $themes['dark-color']['danger-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-danger-shade">' . ('Danger Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][danger-shade]" id="themes-dark-color-danger-shade" placeholder="#000000" value="' . $themes['dark-color']['danger-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-danger-tint">' . ('Danger Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][danger-tint]" id="themes-dark-color-danger-tint" placeholder="#000000" value="' . $themes['dark-color']['danger-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - DARK
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-dark">' . ('Dark') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][dark]" id="themes-dark-color-dark" placeholder="#000000" value="' . $themes['dark-color']['dark'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-dark-contrast">' . ('Dark Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][dark-contrast]" id="themes-dark-color-dark-contrast" placeholder="#000000" value="' . $themes['dark-color']['dark-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-dark-shade">' . ('Dark Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][dark-shade]" id="themes-dark-color-dark-shade" placeholder="#000000" value="' . $themes['dark-color']['dark-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-dark-tint">' . ('Dark Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][dark-tint]" id="themes-dark-color-dark-tint" placeholder="#000000" value="' . $themes['dark-color']['dark-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - MEDIUM
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-medium">' . ('Medium') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][medium]" id="themes-dark-color-medium" placeholder="#000000" value="' . $themes['dark-color']['medium'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-medium-contrast">' . ('Medium Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][medium-contrast]" id="themes-dark-color-medium-contrast" placeholder="#000000" value="' . $themes['dark-color']['medium-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-medium-shade">' . ('Medium Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][medium-shade]" id="themes-dark-color-medium-shade" placeholder="#000000" value="' . $themes['dark-color']['medium-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-medium-tint">' . ('Medium Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][medium-tint]" id="themes-dark-color-medium-tint" placeholder="#000000" value="' . $themes['dark-color']['medium-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '<hr>';
// TODO: LAYOUT --+-- DARK COLOR VARIABLE - LIGHT
$content .= '<div class="row">';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-light">' . ('Light') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][light]" id="themes-dark-color-light" placeholder="#000000" value="' . $themes['dark-color']['light'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-light-contrast">' . ('Light Contrast') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][light-contrast]" id="themes-dark-color-light-contrast" placeholder="#000000" value="' . $themes['dark-color']['light-contrast'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-light-shade">' . ('Light Shade') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][light-shade]" id="themes-dark-color-light-shade" placeholder="#000000" value="' . $themes['dark-color']['light-shade'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="themes-dark-color-light-tint">' . ('Light Tint') . '</label>';
$content .= '<input type="color" class="form-control" name="themes[dark-color][light-tint]" id="themes-dark-color-light-tint" placeholder="#000000" value="' . $themes['dark-color']['light-tint'] . '" />';
$content .= '<p class="help-block">' . __e('color values in hexadecimal format') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-primary btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?theme=variables&type=scss">' . __e('View Source Code') . '</a>';

$content .= '</div>';
$content .= '</div>';

$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div> <!-- ./row -->'; //row

// TODO: LAYOUT --+-- CUSTOM COLOR
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-css3"></i> ' . __e('New Color') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/theme/variables.scss</code></p>';
$content .= '<br/>';
$content .= '<div class="form-group"><input type="checkbox" class="themes-color-picker" checked="checked" /> ' . __e('Enable Color Picker') . '</div>';

$content .= '<table class="table">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>' . __e('Name') . '</th>';
$content .= '<th>' . __e('Color') . '</th>';
$content .= '<th>' . ('Contrast') . '</th>';
$content .= '<th>' . ('Shade') . '</th>';
$content .= '<th>' . ('Tint') . '</th>';
$content .= '<th>' . __e('Action') . '</th>';
$content .= '</tr>';
$content .= '</thead>';
$new_index = count($themes['custom-color']) + 1;

$z = 0;
foreach ($themes['custom-color'] as $themes_custom_color)
{
    $z++;
    $content .= '<tr id="custom-color-' . $z . '">';
    $content .= '<td>';
    $content .= '<input type="text" class="form-control" name="themes[custom-color][' . $z . '][name]" placeholder="favorite" value="' . $themes_custom_color['name'] . '"/>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<input type="color" class="form-control" name="themes[custom-color][' . $z . '][color]" placeholder="#000000" value="' . $themes_custom_color['color'] . '" />';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<input required type="color" class="form-control" name="themes[custom-color][' . $z . '][contrast]" placeholder="#000000" value="' . $themes_custom_color['contrast'] . '" />';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<input required type="color" class="form-control" name="themes[custom-color][' . $z . '][shade]" placeholder="#000000" value="' . $themes_custom_color['shade'] . '" />';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<input required type="color" class="form-control" name="themes[custom-color][' . $z . '][tint]" placeholder="#000000" value="' . $themes_custom_color['tint'] . '" />';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<a href="#!_" data-target="#custom-color-' . $z . '" class="btn btn-danger btn-sm remove-item"><i class="fa fa-trash"></i></a>';
    $content .= '</td>';
    $content .= '</tr>';
}
$content .= '<tr>';
$content .= '<td>';
$content .= '<input type="text" class="form-control" name="themes[custom-color][' . $new_index . '][name]" id="themes-custom-color-name" placeholder="newcolor" />';
$content .= '</td>';
$content .= '<td>';
$content .= '<input type="color" class="form-control" name="themes[custom-color][' . $new_index . '][color]" id="themes-custom-color-color" placeholder="#000000" value="#ddeeff" />';
$content .= '</td>';
$content .= '<td>';
$content .= '<input type="color" class="form-control" name="themes[custom-color][' . $new_index . '][contrast]" id="themes-custom-color-contrast" placeholder="#000000" value="#cceeff" />';
$content .= '</td>';
$content .= '<td>';
$content .= '<input type="color" class="form-control" name="themes[custom-color][' . $new_index . '][shade]" id="themes-custom-color-shade" placeholder="#000000" value="#dddddd" />';
$content .= '</td>';
$content .= '<td>';
$content .= '<input type="color" class="form-control" name="themes[custom-color][' . $new_index . '][tint]" id="themes-custom-color-tint" placeholder="#000000" value="#cc00ff" />';
$content .= '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?theme=variables&type=scss">' . __e('View Source Code') . '</a>';

$content .= '</div>';
$content .= '</div>';


// TODO: LAYOUT --+-- GLOBAL.SCSS
$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-12">';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-css3"></i> ' . __e('Global Styles') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/global.scss</code></p>';
$content .= '<p>' . __e('Put style rules here that you want to apply globally. These styles are for the entire app and not just one component, for reference please look at: <a href="https://ionicframework.com/docs/theming/css-variables" target="_blank">IonicFramework - Docs</a>') . '</p>';
$content .= '<div class="form-group">';
$content .= '<textarea data-type="scss" id="themes-scss-global-styles" name="themes[global]" placeholder="Sassy CSS Code" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($scss_code) . '</textarea>';
$content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . ('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . ('Full Screen mode') . '</code></p>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?theme=global&type=scss">' . __e('View Source Code') . '</a>';

$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
// TODO: LAYOUT --+-- APP.SCSS
$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-12">';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-css3"></i> ' . __e('App Styles') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.scss</code></p>';

$content .= '<p>' . __e('Put style rules here that you want to apply to the entire application') . '</p>';
$content .= '<div class="form-group">';
$content .= '<textarea data-type="scss" id="themes-scss-app-styles" name="themes[apps]" placeholder="Sassy CSS Code" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($app_scss_code) . '</textarea>';
$content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-footer">';
$content .= '<input name="submit" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?theme=app&type=scss">' . __e('View Source Code') . '</a>';

$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</form>';

$page_js = '

$(".themes-color-picker").on("click",function(){
    
    // add new class
    $("input[type=\'color\']").addClass("themes-color");
    
    var current_status = $(this).prop("checked"); 
    console.log("current_status",current_status); 
    
    if(current_status){
       $(".themes-color").attr("type","color"); 
       $(".themes-color-picker").prop("checked",true);
    }else{
       $(".themes-color").attr("type","text");
       $(".themes-color-picker").prop("checked",false); 
    }
    
});

';

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = ('(IMAB) Themes');
$template->page_desc = ('Edit global and themes SCSS');
$template->page_content = $content;

?>