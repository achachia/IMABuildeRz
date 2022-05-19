<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package About Us
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("about-us");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('about-us', $current_page_target);
    header('Location: ./?p=addons&addons=about-us&' . time());
}


if (isset($_POST['save-about-us']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['about-us']['page-title']);
    $addons['app-name'] = $current_app['apps']['app-name'];
    $addons['app-version'] = $current_app['apps']['app-version'];

    $addons['author-organization'] = $_POST['about-us']['author-organization'];
    $addons['author-name'] = $_POST['about-us']['author-name'];
    $addons['author-email'] = $_POST['about-us']['author-email'];
    $addons['author-website'] = $_POST['about-us']['author-website'];
    $addons['app-description'] = $_POST['about-us']['app-description'];
    $addons['app-licenses'] = $_POST['about-us']['app-licenses'];

    $addons['img-hero'] = trim($_POST['about-us']['img-hero']);

    $addons['page-header-color'] = trim($_POST['about-us']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['about-us']['page-content-background']);

    $db->saveAddOns('about-us', $addons);

    // create properties for page

    // TODO: PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $addons['page-target'];
    $newPage['code-by'] = 'about-us';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];

    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];

    $newPage['header']['mid']['type'] = 'segment';
    $newPage['header']['mid']['items'][0]['label'] = $addons['page-title'];
    $newPage['header']['mid']['items'][0]['value'] = 'about-us';
    $newPage['header']['mid']['items'][1]['label'] = 'Licenses';
    $newPage['header']['mid']['items'][1]['value'] = 'licenses';
    $newPage['header']['mid']['items'][2]['label'] = '';
    $newPage['header']['mid']['items'][2]['value'] = '';

    // TODO: PAGE --|-- HMTL
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= '<ion-card *ngIf="segmentTab==\'about-us\'">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<img src="' . $addons['img-hero'] . '" alt=""/>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<h2><strong>' . $addons['app-name'] . '</strong>&nbsp;&nbsp;<small>v' . $addons['app-version'] . '</small></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-header>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<div>' . $addons['app-description'] . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<p>by <strong>' . $addons['author-name'] . '</strong></p>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= '<ion-card *ngIf="segmentTab==\'about-us\'">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list inset="true" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>Contact Us</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list-header>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none" button appBrowser url="' . $addons['author-website'] . '" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon color="danger" name="help-buoy" slot="start"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $addons['author-organization'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none" button mailApp emailAddress="' . $addons['author-email'] . '" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon color="secondary" name="mail" slot="start"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $addons['author-email'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= '</ion-card>' . "\r\n";


    $newPage['content']['html'] .= '<ion-card *ngIf="segmentTab==\'licenses\'">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<h2>Licenses</h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . $addons['app-licenses'];
    $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= '</ion-card>' . "\r\n";

    // TODO: PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'img{width:100%;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    $newPage['code']['other'] = '';

    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=about-us&page-target=' . $current_page_target);

}

$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('about-us', $current_page_target);
}

if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}
if (!isset($current_setting['page-title']))
{
    $current_setting['page-title'] = '';
}
if (!isset($current_setting['app-description']))
{
    $current_setting['app-description'] = $current_app['apps']['app-description'];
}

if (!isset($current_setting['author-organization']))
{
    $current_setting['author-organization'] = $current_app['apps']['author-organization'];
}
if (!isset($current_setting['author-website']))
{
    $current_setting['author-website'] = $current_app['apps']['author-website'];
}
if (!isset($current_setting['author-name']))
{
    $current_setting['author-name'] = $current_app['apps']['author-name'];
}
if (!isset($current_setting['author-email']))
{
    $current_setting['author-email'] = $current_app['apps']['author-email'];
}
if (!isset($current_setting['img-hero']))
{
    $current_setting['img-hero'] = 'assets/images/landscape/image-1.jpg';
}

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}


if (!isset($current_setting['app-licenses']))
{
    $current_setting['app-licenses'] = null;
    $current_setting['app-licenses'] .= '<ul>';
    $current_setting['app-licenses'] .= '<li><strong>IonicFramework</strong>,<br/>Copyright 2015-present Drifty Co</li>';
    $current_setting['app-licenses'] .= '</ul>';
}


// TODO: LAYOUT
$content .= '<div class="row">';
$content .= '<div class="col-md-7"><!--general-->';
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';

// select : page-target
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="about-us[page-target]" class="form-control">';
$content .= '<option value="">' . __e('Page Target') . '</option>';
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
$content .= '<p class="help-block">' . __e('Select the page to be overwritten') . '</p>';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE TITLE
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input id="page-title" type="text" name="about-us[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- IMG-HERO
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Featured Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input type="text" id="about-us-img-hero" name="about-us[img-hero]" class="form-control" placeholder="./assets/images/landscape/image-1.jpg"  value="' . $current_setting['img-hero'] . '" required ' . $disabled . '/>';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#about-us-img-hero" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('Decorative pictures on the page about-us') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- PAGE-BACKGROUND


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="about-us[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['page-header-color'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-CONTENT-BACKGROUND
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-background">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-content-background" type="text" name="about-us[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
$content .= '<div class="row"><!-- row -->';
$content .= '</div><!-- ./row -->';


$content .= '<hr/>';

$content .= '<label for="">' . __e('Owner of the Apps') . '</label>';
$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
// input : author-name
$content .= '<div class="form-group">';
$content .= '<span for="author-name">' . __e('Name') . '</span>';
$content .= '<input id="author-name" type="text" name="about-us[author-name]" class="form-control" placeholder=""  value="' . $current_setting['author-name'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Name of the author') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="col-md-6">';
// input : author-email
$content .= '<div class="form-group">';
$content .= '<span for="author-email">' . __e('Email') . '</span>';
$content .= '<input id="author-email" type="email" name="about-us[author-email]" class="form-control" placeholder=""  value="' . $current_setting['author-email'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Email of the author') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="row">';

$content .= '<div class="col-md-6">';
// input : author-organization
$content .= '<div class="form-group">';
$content .= '<span for="author-organization">' . __e('Organization') . '</span>';
$content .= '<input id="author-organization" type="text" name="about-us[author-organization]" class="form-control" placeholder=""  value="' . $current_setting['author-organization'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Name of company/organization') . '</p>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="col-md-6">';
// input : author-website
$content .= '<div class="form-group">';
$content .= '<span for="author-website">' . __e('Website') . '</span>';
$content .= '<input id="author-website" type="url" name="about-us[author-website]" class="form-control" placeholder=""  value="' . $current_setting['author-website'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Website of your company') . '</p>';
$content .= '</div>';
$content .= '</div>';

$content .= '</div><!-- ./row -->';

// input : Content
$content .= '<div class="form-group">';
$content .= '<label for="app-description">' . __e('Description') . '</label>';
$content .= '<textarea class="form-control tinymce" name="about-us[app-description]" data-type="tinymce">' . htmlentities($current_setting['app-description']) . '</textarea>';
$content .= '<p class="help-block">' . __e('a brief description about us') . '</p>';
$content .= '</div>';

// input : Content
$content .= '<div class="form-group">';
$content .= '<label for="app-licenses">' . __e('Licenses') . '</label>';
$content .= '<textarea class="form-control tinymce" name="about-us[app-licenses]" data-type="tinymce">' . htmlentities($current_setting['app-licenses']) . '</textarea>';
$content .= '<p class="help-block">' . __e('Write the licenses that you use') . '</p>';
$content .= '</div>';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-about-us" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';

$content .= '</form><!-- ./form -->';
$content .= '</div><!--./col-md-7-->';

$content .= '<div class="col-md-5">';
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
$content .= '<th>' . __e('Target') . '</th>';
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
        $content .= '<td><a target="_blank" href="./?p=pages&a=edit&page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>';
        $content .= '<td>' . $pageList['page-title'] . '</td>';
        $content .= '<td>';
        $content .= '<a href="./?p=addons&addons=about-us&page-target=' . $pageList['page-target'] . '&a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&addons=about-us&page-target=' . $pageList['page-target'] . '&a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<td>' . __e('Page Title') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $pageList['page-title'] . '</strong></td>';
        $modal_dialog .= '</tr>';
        $modal_dialog .= '</table>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div><!-- ./modal-body -->';
        $modal_dialog .= '<div class="modal-footer">';
        $modal_dialog .= '<a href="./?p=addons&addons=about-us&page-target=' . $pageList['page-target'] . '&a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$content .= '</div>';
$content .= '<div>';
$content .= $modal_dialog;
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=about-us&page-target="+$("#page-target").val(),!1});';
