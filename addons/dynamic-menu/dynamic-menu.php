<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `dynamic-menu`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
$prefix_addons = 'dynamic-menu';

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("dynamic-menu");
$string = new jsmString();

$current_page_target = 'core';

if (isset($_POST['delete-dynamic-menu']))
{
    $db->deleteGlobal('dynamic-menu', 'core');
    $db->deleteAddOns('dynamic-menu', 'core');
    rebuild();
    header('Location: ./?p=addons&addons=dynamic-menu&' . time());
}

// TODO: POST
if (isset($_POST['save-dynamic-menu']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['rules'] = $_POST['dynamic-menu']['rules'];

    $db->saveAddOns('dynamic-menu', $addons);

    $menus = $current_app['menus']['items'];
    $pages = $current_app['pages'];

    $selected_menu = array();
    foreach ($menus as $menu)
    {
        $menu_var = $menu['var'];

        $selected_menu[$menu_var] = $menu;
    }

    // TODO: GENERATOR --|-- GLOBALS
    $global['name'] = $current_page_target;
    $global['note'] = 'dynamic menu';
    // TODO: GENERATOR --|-- GLOBALS  --|-- CODE
    $z = 0;
    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['init'] .= "\t\t" . 'this.dynamicMenus();' . "\r\n";

    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':dinamicMenus()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private dynamicMenus(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'console.log("dynamicMenus",pageName);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'switch (pageName){' . "\r\n";
    foreach ($pages as $page)
    {
        $page_name = $page['name'];
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'case "' . $page_name . '":' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// update menu for ' . $page_name . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'this.appMenus = []; //reset' . "\r\n";
        $y = 0;
        foreach (array_keys($addons['rules'][$page_name]) as $menu_var)
        {

            $new_menu['item_type'] = $selected_menu[$menu_var]['type'];
            $new_menu['item_label'] = $selected_menu[$menu_var]['label'];
            $new_menu['item_var'] = $selected_menu[$menu_var]['var'];
            $new_menu['item_link'] = '/' . $string->toFileName($selected_menu[$menu_var]['page']);
            $new_menu['item_value'] = $selected_menu[$menu_var]['value'];
            $new_menu['item_desc'] = $selected_menu[$menu_var]['desc'];
            $new_menu['item_color_label'] = $selected_menu[$menu_var]['color-label'];
            $new_menu['item_icon_left'] = $selected_menu[$menu_var]['icon-left'];
            $new_menu['item_color_icon_left'] = $selected_menu[$menu_var]['color-icon-left'];
            $new_menu['item_icon_right'] = $selected_menu[$menu_var]['icon-right'];
            $new_menu['item_color_icon_right'] = $selected_menu[$menu_var]['color-icon-right'];

            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'this.appMenus[' . $y . '] = ' . json_encode($new_menu) . ' ' . "\r\n";
            $y++;
        }

        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    }
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";

    $db->saveGlobal('dynamic-menu', $global);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=dynamic-menu&' . time());

}

// TODO: INIT --|-- CURRENT SETTINGS
$current_setting = $db->getAddOns('dynamic-menu', $current_page_target);


// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Please check the menu that will be displayed on the page you want') . '</div>';

$color[] = 'red';
$color[] = 'green';
$color[] = 'blue';


$menus = $current_app['menus']['items'];
$pages = $current_app['pages'];

$content .= '<table class="table table-striped table-bordered">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th rowspan="2">' . __e('Menu') . '</th>';
$content .= '<th colspan="' . count($pages) . '" class="text-center">' . __e('Pages') . '</th>';
$content .= '</tr>';
$content .= '<tr>';


foreach ($pages as $page)
{
    $content .= '<th class="text-center">' . $page['name'] . '</th>';
}
$content .= '</tr>';
$content .= '</thead>';

foreach ($menus as $menu)
{
    $menu_var = $menu['var'];

    $content .= '<tr>';
    $content .= '<td>' . $menu['label'] . '</td>';
    $z = 0;
    foreach ($pages as $page)
    {
        $page_name = $page['name'];
        $checked = 'checked';
        if (isset($current_setting['rules'][$page_name][$menu_var]))
        {
            $checked = 'checked';
        } else
        {
            $checked = '';
        }

        $content .= '<td class="text-center"><input ' . $checked . ' class="flat-' . $color[$z] . '" type="checkbox" name="dynamic-menu[rules][' . $page_name . '][' . $menu_var . ']" value="true" /></td>';
        $z++;
        if ($z == 3)
        {
            $z = 0;
        }
    }
    $content .= '</tr>';

}
$content .= '</table>';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-dynamic-menu" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
if (isset($current_setting['page-target']))
{
    $content .= '&nbsp;or&nbsp;<input name="delete-dynamic-menu" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
}
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=dynamic-menu&page-target="+$("#page-target").val(),!1});';
