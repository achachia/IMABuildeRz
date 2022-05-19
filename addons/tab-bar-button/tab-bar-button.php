<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `tab-bar-button`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("tab-bar-button");
$string = new jsmString();
$icon = new jsmIcon();

if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('tab-bar-button', $current_page_target);
    header('Location: ./?p=addons&addons=tab-bar-button&' . time());
}

// TODO: POST
if (isset($_POST['save-tab-bar-button']))
{
    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['tab-bar-color'] = trim($_POST['tab-bar-button']['tab-bar-color']);
    $addons['tab-bar-bg'] = trim($_POST['tab-bar-button']['tab-bar-bg']);
    foreach ($_POST['tab-bar-button']['tab-pages'] as $tab_pages)
    {
        if ($tab_pages['page'] != '')
        {
            $addons['tab-pages'][] = $tab_pages;
        }
    }
    $db->saveAddOns('tab-bar-button', $addons);


    //DASHBOARD
    $tab_code = null;
    $tab_code .= "\t" . '<ion-toolbar>' . "\r\n";
    foreach ($addons['tab-pages'] as $page_tab)
    {

        $tab_code .= "\t\t" . '<!-- Tab Bar Button -->' . "\r\n";
        $tab_code .= "\t\t" . '<ion-tabs>' . "\r\n";
        $tab_code .= "\t\t\t" . '<ion-tab-bar slot="bottom" color="' . $addons['tab-bar-bg'] . '">' . "\r\n";
        foreach ($addons['tab-pages'] as $button_tab)
        {
            $tab_code .= "\t\t\t\t" . '<ion-tab-button [routerDirection]="\'root\'" [routerLink]="[\'/' . $button_tab['page'] . '\']">' . "\r\n";
            $tab_code .= "\t\t\t\t\t" . '<ion-label color="' . $addons['tab-bar-color'] . '">' . $button_tab['label'] . '</ion-label>' . "\r\n";
            $tab_code .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['tab-bar-color'] . '" name="' . $button_tab['icon'] . '"></ion-icon>' . "\r\n";
            $tab_code .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        }
        $tab_code .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
        $tab_code .= "\t\t" . '</ion-tabs>' . "\r\n";
    }
    $tab_code .= "\t" . '</ion-toolbar>' . "\r\n";

    $data_page = null;
    $data_page = $db->getPage($current_page_target);
    $data_page['footer']['type'] = 'code';
    $data_page['footer']['code'] = $tab_code;
    $db->savePage($data_page);


    foreach ($addons['tab-pages'] as $page_tab)
    {
        $tab_code = null;
        $tab_code .= "\t" . '<ion-toolbar>' . "\r\n";

        $tab_code .= "\t\t" . '<ion-tabs>' . "\r\n";
        $tab_code .= "\t\t\t" . '<ion-tab-bar slot="bottom" color="' . $addons['tab-bar-bg'] . '">' . "\r\n";
        foreach ($addons['tab-pages'] as $button_tab)
        {
            $attribute = '';
            if ($button_tab['page'] == $page_tab['page'])
            {
                $attribute = 'disabled="true" ';
            }
            $tab_code .= "\t\t\t\t" . '<ion-tab-button ' . $attribute . ' [routerDirection]="\'root\'" [routerLink]="[\'/' . $button_tab['page'] . '\']">' . "\r\n";
            $tab_code .= "\t\t\t\t\t" . '<ion-label color="' . $addons['tab-bar-color'] . '">' . $button_tab['label'] . '</ion-label>' . "\r\n";
            $tab_code .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['tab-bar-color'] . '" name="' . $button_tab['icon'] . '"></ion-icon>' . "\r\n";
            $tab_code .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        }
        $tab_code .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
        $tab_code .= "\t\t" . '</ion-tabs>' . "\r\n";
        $tab_code .= "\t" . '</ion-toolbar>' . "\r\n";

        $data_page = $db->getPage($page_tab['page']);
        $data_page['footer']['type'] = 'code';
        $data_page['footer']['code'] = $tab_code;

        $db->savePage($data_page);
    }


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=tab-bar-button&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('tab-bar-button', $current_page_target);
}

if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}


if (!isset($current_setting['tab-bar-color']))
{
    $current_setting['tab-bar-color'] = 'primary';
}

if (!isset($current_setting['tab-bar-bg']))
{
    $current_setting['tab-bar-bg'] = 'light';
}


if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}
if (!isset($current_setting['tab-pages']))
{
    $current_setting['tab-pages'] = array();
}


// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Home Page for Tab') . '</label>';
$content .= '<select id="page-target" name="tab-bar-button[page-target]" class="form-control" >';
$content .= '<option value="">' . __e('Page') . '</option>';
foreach ($static_pages as $item_page)
{
    $code_by = '';
    if (isset($item_page['code-by']))
    {
        $code_by = ' - ' . __e('by') . ': ' . $item_page['code-by'];
    }
    $selected = '';
    if ($current_setting['page-target'] == $item_page["name"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($item_page["name"]) . ' " ' . $selected . '>- ' . htmlentities($item_page["title"]) . ' (' . htmlentities($item_page["name"]) . '' . $code_by . ')</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select the page as home page tab') . '</p>';
$content .= '</div>';


$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- tab-bar-color
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="tab-bar-color">' . __e('Tab Bar Background') . '</label>';
$content .= '<select name="tab-bar-button[tab-bar-bg]" class="form-control select-color" data-color="' . $current_setting['tab-bar-bg'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['tab-bar-bg'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from tab background') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- tab-bar-color
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="tab-bar-color">' . __e('Tab Bar Color') . '</label>';
$content .= '<select name="tab-bar-button[tab-bar-color]" class="form-control select-color" data-color="' . $current_setting['tab-bar-color'] . '">';
$content .= '<option value="">' . __e('None') . '</option>';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['tab-bar-color'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from tab bar') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '</div>';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$max_vars = 2;

$content .= '<table class="table table-striped no-margin no-padding" >' . "\r\n";
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '<th>' . __e('Page') . '</th>' . "\r\n";
$content .= '<th>' . __e('Icon') . '</th>' . "\r\n";
$content .= '<th>' . __e('Label') . '</th>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody id="var-lists">' . "\r\n";

$max_vars = count($current_setting['tab-pages']);

for ($z = 0; $z <= $max_vars; $z++)
{

    $html_tab_page = $html_tab_icon = $html_tab_label = null;


    $page_value = '';
    if (isset($current_setting['tab-pages'][$z]['page']))
    {
        $page_value = $current_setting['tab-pages'][$z]['page'];
    }

    $html_tab_page .= '<select class="form-control" name="tab-bar-button[tab-pages][' . $z . '][page]">';
    $html_tab_page .= '<option value="">' . __e('None') . '</option>';
    foreach ($static_pages as $opt_page)
    {
        $selected = '';
        if ($page_value == $opt_page['name'])
        {
            $selected = 'selected';
        }
        $html_tab_page .= '<option value="' . $opt_page['name'] . '" ' . $selected . '>' . $opt_page['name'] . '</option>';
    }
    $html_tab_page .= '</select>';


    $icon_value = 'logo-buffer';
    if (isset($current_setting['tab-pages'][$z]['icon']))
    {
        $icon_value = $current_setting['tab-pages'][$z]['icon'];
    }
    if ($icon_value == "")
    {
        $icon_value = 'logo-buffer';
    }
    $html_tab_icon .= '<div class="input-group">' . "\r\n";
    $html_tab_icon .= '<input id="tab-pages-' . $z . '-icon" type="text" class="form-control" name="tab-bar-button[tab-pages][' . $z . '][icon]" value="' . htmlentities($icon_value) . '" />' . "\r\n";
    $html_tab_icon .= '<span class="input-group-addon" data-type="icon-picker" data-target="#tab-pages-' . $z . '-icon" data-dialog="#ion-icon-dialog" title="Click here for get icon list" data-toggle="tooltip">' . "\r\n";
    $html_tab_icon .= '<ion-icon name="' . $icon_value . '"></ion-icon>' . "\r\n";
    $html_tab_icon .= '</div>' . "\r\n";

    $label_value = '';
    if (isset($current_setting['tab-pages'][$z]['label']))
    {
        $label_value = $current_setting['tab-pages'][$z]['label'];
    }
    $html_tab_label = '<input type="text" class="form-control" name="tab-bar-button[tab-pages][' . $z . '][label]" value="' . htmlentities($label_value) . '" />' . "\r\n";


    $content .= '<tr class="var-item" id="item-var-' . $z . '">' . "\r\n";
    $content .= '<td class="text-align v-align move-cursor handle"><i class="glyphicon glyphicon-move"></i></td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_tab_page . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_tab_icon . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_tab_label . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . "\r\n";
    $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#item-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
    $content .= '</td>' . "\r\n";
    $content .= '</tr>' . "\r\n";
}

$content .= '</tbody>';
$content .= '</table>';

$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-tab-bar-button" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Latest Used') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Some settings that you have made:') . '</div>';
$content .= '<div class="table-responsive">';
$content .= '<table class="table table-striped" id="latest-used">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>#</th>';
$content .= '<th>' . __e('Tabs') . '</th>';
$content .= '<th>' . __e('Title') . '</th>';
$content .= '<th></th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';
$modal_dialog = null;
if (count($addons_settings) >= 1)
{
    $no = 1;
    foreach ($addons_settings as $pageList)
    {
        $content .= '<tr>';
        $content .= '<td>' . $no . '</td>';
        $content .= '<td><a target="_blank" href="./?p=pages&amp;a=edit&amp;page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>';

        $content .= '<td>';
        $content .= '<a href="./?p=addons&amp;addons=tab-bar-button&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=tab-bar-button&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
        $content .= '</td>';
        $content .= '</tr>';


        $modal_dialog .= '<div class="modal fade modal-default" id="trash-dialog-' . $no . '" tabindex="-1" role="dialog" aria-labelledby="trash-dialog-' . $no . '" aria-hidden="true">';
        $modal_dialog .= '<div class="modal-dialog">';
        $modal_dialog .= '<div class="modal-content">';

        $modal_dialog .= '<div class="modal-header">';
        $modal_dialog .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $modal_dialog .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete Adds-ons Settings') . '</h4>';
        $modal_dialog .= '</div><!-- ./modal-header -->';

        $modal_dialog .= '<div class="modal-body">';
        $modal_dialog .= '<p>' . __e('Deleting this add-ons setting will not delete the page code that you have created. Are you sure want to delete this settings?') . '</p>';
        $modal_dialog .= '<div class="row">';
        $modal_dialog .= '<div class="col-md-3">';
        $modal_dialog .= '<div class="icon icon-confirm text-center"><i class="fa fa-5x fa-cogs"></i></div>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '<div class="col-md-9 text-left">';
        $modal_dialog .= '<table class="table-confirm">';
        $modal_dialog .= '<tr>';
        $modal_dialog .= '<td>' . __e('Page Target') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $pageList['page-target'] . '</strong></td>';
        $modal_dialog .= '</tr>';
        $modal_dialog .= '<tr>';

        $modal_dialog .= '</tr>';
        $modal_dialog .= '</table>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div><!-- ./modal-body -->';
        $modal_dialog .= '<div class="modal-footer">';
        $modal_dialog .= '<a href="./?p=addons&amp;addons=tab-bar-button&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
        $modal_dialog .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div><!-- ./modal-content -->';
        $modal_dialog .= '</div><!-- ./modal-dialog -->';
        $modal_dialog .= '</div><!-- ./modal -->';
        $no++;
    }
} else
{
    $content .= '<tr>';
    $content .= '<td>&nbsp;</td>';
    $content .= '<td>' . __e('no pages') . '</td>';
    $content .= '<td></td>';
    $content .= '<td></td>';
    $content .= '</tr>';
}
$content .= '</tbody>';
$content .= '</table>';
$content .= '</div><!-- ./table-responsive -->';

$content .= '<div class="trash-dialog"><!-- trash-dialog -->';
$content .= $modal_dialog;
$content .= '</div><!-- ./trash-dialog -->';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';

$content .= $icon->display('ion');
// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=tab-bar-button&page-target="+$("#page-target").val(),!1});';
$page_js .= '$("#var-lists").sortable({opacity: 0.5, items: ".var-item",revert: true,placeholder: "sort-highlight",forcePlaceholderSize: false,zIndex: 999999,cancel: ".move-disabled",handle: ".handle",});';
