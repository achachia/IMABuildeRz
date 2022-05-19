<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `grid-box-menu`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("grid-box-menu");
$string = new jsmString();

$item_types[] = array('value' => 'inlink-forward', 'label' => 'Goto Page: ...? (mode:forward)');
$item_types[] = array('value' => 'inlink-root', 'label' => 'Goto Page: ...? (mode:root)');
$item_types[] = array('value' => 'appbrowser', 'label' => 'Open With : AppBrowser');
$item_types[] = array('value' => 'systembrowser', 'label' => 'Open With : SystemBrowser');


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('grid-box-menu', $current_page_target);
    header('Location: ./?p=addons&addons=grid-box-menu&' . time());
}

// TODO: POST
if (isset($_POST['save-grid-box-menu']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    // TODO: POST --|-- RESPONSE
    $addons['page-title'] = trim($_POST['grid-box-menu']['page-title']);
    $addons['page-header-color'] = trim($_POST['grid-box-menu']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['grid-box-menu']['page-content-background']);

    $z = 0;
    foreach ($_POST['grid-box-menu']['items'] as $item)
    {
        if ($item['label'] != '')
        {
            $addons['items'][$z] = $item;
            $z++;
        }
    }

    $z = 0;
    foreach ($_POST['grid-box-menu']['sliders'] as $item)
    {
        if ($item['label'] != '')
        {
            $addons['sliders'][$z] = $item;
            $z++;
        }
    }

    $z = 0;
    foreach ($_POST['grid-box-menu']['featured-items'] as $item)
    {
        if ($item['label'] != '')
        {
            $addons['featured-items'][$z] = $item;
            $z++;
        }
    }

    //hero-slider
    // checkbox
    if (isset($_POST['grid-box-menu']['hero-slider']))
    {
        $addons['hero-slider'] = true;
    } else
    {
        $addons['hero-slider'] = false;
    }

    //featured-menu
    // checkbox
    if (isset($_POST['grid-box-menu']['featured-menu']))
    {
        $addons['featured-menu'] = true;
    } else
    {
        $addons['featured-menu'] = false;
    }


    $db->saveAddOns('grid-box-menu', $addons);

    // TODO: GENERATOR --|-- PAGE --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'grid-box-menu';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];

    // TODO: GENERATOR --|-- PAGE --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';


    // TODO: GENERATOR --|-- PAGE --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;


    if ($addons['hero-slider'] == true)
    {
        $newPage['content']['html'] .= "" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-slides pager="false">' . "\r\n";
        foreach ($addons['sliders'] as $item)
        {
            $newPage['content']['html'] .= "\t\t" . '<ion-slide [ngStyle]="{\'background-image\':\'url(\\\'' . $item['image'] . '\\\')\',\'background-size\':\'cover\',\'background-position\':\'center center\'}">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<div class="slide-container ratio-16x9">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
        }
        $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
        $newPage['content']['html'] .= "" . '</ion-card>' . "\r\n";
    }


    if ($addons['featured-menu'] == true)
    {
        $newPage['content']['html'] .= "" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-grid>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="4">' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-chip [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $addons['featured-items'][0]['page'] . '\']">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<img src="' . $addons['featured-items'][0]['image'] . '" />' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['featured-items'][0]['label'] . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-chip>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="4">' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-chip [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $addons['featured-items'][1]['page'] . '\']">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<img src="' . $addons['featured-items'][1]['image'] . '" />' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['featured-items'][1]['label'] . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-chip>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="4">' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-chip [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $addons['featured-items'][2]['page'] . '\']">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<img src="' . $addons['featured-items'][2]['image'] . '" />' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $addons['featured-items'][2]['label'] . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-chip>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";
        $newPage['content']['html'] .= "" . '</ion-card>' . "\r\n";
    }

    $newPage['content']['html'] .= '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-row>' . "\r\n";

    foreach ($addons['items'] as $item)
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-col size="3">' . "\r\n";

        switch ($item['type'])
        {
            case 'inlink-root':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card color="' . $item['color'] . '" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'' . $item['page'] . '\']" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="' . $item['image'] . '"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $item['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
                break;
            case 'inlink-forward':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card color="' . $item['color'] . '" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $item['page'] . '\']" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="' . $item['image'] . '"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $item['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
                break;


            case 'appbrowser':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card color="' . $item['color'] . '" appBrowser url="' . $item['value'] . '" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="' . $item['image'] . '"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $item['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
                break;
            case 'systembrowser':
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card color="' . $item['color'] . '" systemBrowser url="' . $item['value'] . '" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="' . $item['image'] . '"></ion-img>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>' . $item['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
                break;
        }


        $newPage['content']['html'] .= "\t\t" . '</ion-col>' . "\r\n";
    }


    $newPage['content']['html'] .= "\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= '</ion-grid>' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "" . 'ion-grid ion-card{margin:0.3em !important}' . "\r\n";
    $newPage['content']['scss'] .= "" . 'ion-card-header{margin: 0.1em !important;padding: 0.1em !important;text-align: center !important;}' . "\r\n";
    $newPage['content']['scss'] .= "" . 'ion-slide .ratio-16x9 {width: 100%;padding-top: 56.25%; position: relative;}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['init'] = null;


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=grid-box-menu&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('grid-box-menu', $current_page_target);
}

if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}

if (!isset($current_setting['page-title']))
{
    $current_page_title = '';
    if ($current_page_target != '')
    {
        $current_page = $db->getPage($current_page_target);
        $current_page_title = $current_page['title'];
    }
    $current_setting['page-title'] = $current_page_title;
}

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['hero-slider']))
{
    $current_setting['hero-slider'] = false;
}

if (!isset($current_setting['featured-menu']))
{
    $current_setting['featured-menu'] = false;
}


// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
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

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';


// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="grid-box-menu[page-target]" class="form-control" >';
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

// TODO: LAYOUT --|-- FORM --|-- PAGE-TITLE
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input  id="page-title" type="text" name="grid-box-menu[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="grid-box-menu[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="grid-box-menu[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- HERO-SLIDER --|-- CHECKBOX
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-hero-slider" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-background">' . __e('Options') . '</label>';
$content .= '<table class="table">';
$content .= '<tr>';
if ($current_setting['hero-slider'] == true)
{
    $content .= '<td style="width: 36px;"><input checked="checked" class="flat-red" type="checkbox" id="page-hero-slider" name="grid-box-menu[hero-slider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td style="width: 36px;"><input class="flat-red" type="checkbox" id="page-hero-slider" name="grid-box-menu[hero-slider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Hero Slider') . '</td>';
$content .= '</tr>';

$content .= '<tr>';
if ($current_setting['featured-menu'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-hide-divider" name="grid-box-menu[featured-menu]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-hide-divider" name="grid-box-menu[featured-menu]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Featured Menu') . '</td>';
$content .= '</tr>';

$content .= '</table>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-grid-box-menu" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- HERO-SLIDERS
$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-image"></i> ' . __e('Hero Slider') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<table class="table table-striped no-margin no-padding">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>' . __e('Label/Text') . '</th>';
$content .= '<th>' . __e('Image') . '</th>';
$content .= '<th>' . __e('Action') . '</th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody id="var-lists">' . "\r\n";
if (!isset($current_setting['sliders']))
{
    $current_setting['sliders'] = array();
}
$max_sliders = count($current_setting['sliders']);
$sliders = $current_setting['sliders'];
for ($z = 0; $z < $max_sliders; $z++)
{
    $image_value = $sliders[$z]['image'];
    $label_value = $sliders[$z]['label'];
    $content .= '<tr id="slide-var-' . $z . '">';
    $content .= '<td>';
    $content .= '<input type="text" class="form-control" name="grid-box-menu[sliders][' . $z . '][label]" value="' . htmlentities($label_value) . '"/>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '<div class="input-group">';
    $content .= '<input id="grid-box-menu-items-' . $z . '-image" type="text" name="grid-box-menu[sliders][' . $z . '][image]" class="form-control" placeholder=""  value="' . htmlentities($image_value) . '"  />';
    $content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-items-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
    $content .= '</div>';
    $content .= '</td>';

    $content .= '<td class="text-align v-align">' . "\r\n";
    $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#slide-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
    $content .= '</td>' . "\r\n";


    $content .= '</tr>';
}
$z = $max_sliders + 1;
$content .= '<tr>';

$content .= '<td>';
$content .= '<input type="text" class="form-control" name="grid-box-menu[sliders][' . $z . '][label]" />';
$content .= '</td>';

$content .= '<td>';
$content .= '<div class="input-group">';
$content .= '<input id="grid-box-menu-sliders-' . $z . '-image" type="text" name="grid-box-menu[sliders][' . $z . '][image]" class="form-control" placeholder=""  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-sliders-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '</td>';

$content .= '<td>' . "\r\n";
$content .= '<input name="save-grid-box-menu" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Add') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</td>' . "\r\n";

$content .= '</tr>';

$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";

$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-grid-box-menu" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- FEATURED-MENU
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Featured Menu') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<table class="table table-striped no-margin no-padding">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>' . __e('Text') . '</th>';
$content .= '<th>' . __e('Page') . '</th>';
$content .= '<th>' . __e('Image') . '</th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>' . "\r\n";

$z = 0;
if (!isset($current_setting['featured-items'][$z]['label']))
{
    $current_setting['featured-items'][$z]['label'] = 'Menu ' . $z;
}
if (!isset($current_setting['featured-items'][$z]['image']))
{
    $current_setting['featured-items'][$z]['image'] = '';
}
if (!isset($current_setting['featured-items'][$z]['page']))
{
    $current_setting['featured-items'][$z]['page'] = '';
}
$content .= '<tr>';
$content .= '<td>';
$content .= '<input type="text" class="form-control" name="grid-box-menu[featured-items][' . $z . '][label]" value="' . htmlentities($current_setting['featured-items'][$z]['label']) . '" placeholder="Menu ' . $z . '"/>';
$content .= '</td>';

$content .= '<td>';
$content .= '<select class="form-control" name="grid-box-menu[featured-items][' . $z . '][page]" >';
foreach ($static_pages as $page)
{
    $selected = '';
    if ($page['name'] == $current_setting['featured-items'][$z]['page'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $page['name'] . '" ' . $selected . '>' . $page['name'] . '</option>';
}
$content .= '</select>';
$content .= '</td>';


$content .= '<td>';
$content .= '<div class="input-group">';
$content .= '<input id="grid-box-menu-featured-items-' . $z . '-image" type="text" name="grid-box-menu[featured-items][' . $z . '][image]" class="form-control" placeholder="assets/images/background/menu-' . $z . '.png"  value="' . htmlentities($current_setting['featured-items'][$z]['image']) . '"  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-featured-items-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '</td>';
$content .= '</tr>';


$z++;
if (!isset($current_setting['featured-items'][$z]['label']))
{
    $current_setting['featured-items'][$z]['label'] = 'Menu ' . $z;
}
if (!isset($current_setting['featured-items'][$z]['image']))
{
    $current_setting['featured-items'][$z]['image'] = '';
}
if (!isset($current_setting['featured-items'][$z]['page']))
{
    $current_setting['featured-items'][$z]['page'] = '';
}
$content .= '<tr>';
$content .= '<td>';
$content .= '<input type="text" class="form-control" name="grid-box-menu[featured-items][' . $z . '][label]" value="' . htmlentities($current_setting['featured-items'][$z]['label']) . '" placeholder="Menu ' . $z . '"/>';
$content .= '</td>';

$content .= '<td>';
$content .= '<select class="form-control" name="grid-box-menu[featured-items][' . $z . '][page]" >';
foreach ($static_pages as $page)
{
    $selected = '';
    if ($page['name'] == $current_setting['featured-items'][$z]['page'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $page['name'] . '" ' . $selected . '>' . $page['name'] . '</option>';
}
$content .= '</select>';
$content .= '</td>';

$content .= '<td>';
$content .= '<div class="input-group">';
$content .= '<input id="grid-box-menu-featured-items-' . $z . '-image" type="text" name="grid-box-menu[featured-items][' . $z . '][image]" class="form-control" placeholder="assets/images/background/menu-' . $z . '.png"  value="' . htmlentities($current_setting['featured-items'][$z]['image']) . '"  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-featured-items-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '</td>';
$content .= '</tr>';


$z++;
if (!isset($current_setting['featured-items'][$z]['label']))
{
    $current_setting['featured-items'][$z]['label'] = 'Menu ' . $z;
}
if (!isset($current_setting['featured-items'][$z]['image']))
{
    $current_setting['featured-items'][$z]['image'] = '';
}
if (!isset($current_setting['featured-items'][$z]['page']))
{
    $current_setting['featured-items'][$z]['page'] = '';
}
$content .= '<tr>';
$content .= '<td>';
$content .= '<input type="text" class="form-control" name="grid-box-menu[featured-items][' . $z . '][label]" value="' . htmlentities($current_setting['featured-items'][$z]['label']) . '" placeholder="Menu ' . $z . '"/>';
$content .= '</td>';

$content .= '<td>';
$content .= '<select class="form-control" name="grid-box-menu[featured-items][' . $z . '][page]" >';
foreach ($static_pages as $page)
{
    $selected = '';
    if ($page['name'] == $current_setting['featured-items'][$z]['page'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $page['name'] . '" ' . $selected . '>' . $page['name'] . '</option>';
}
$content .= '</select>';
$content .= '</td>';


$content .= '<td>';
$content .= '<div class="input-group">';
$content .= '<input id="grid-box-menu-items-' . $z . '-image" type="text" name="grid-box-menu[featured-items][' . $z . '][image]" class="form-control" placeholder="assets/images/background/menu-' . $z . '.png"  value="' . htmlentities($current_setting['featured-items'][$z]['image']) . '"  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-items-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '</td>';
$content .= '</tr>';


$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";

$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-grid-box-menu" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- ITEMS
$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Menu') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

if (!isset($current_setting['items']))
{
    $current_setting['items'] = array();
}
$max_items = count($current_setting['items']);
$items = $current_setting['items'];

$content .= '<table class="table table-striped no-margin no-padding">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th></th>';
$content .= '<th>' . __e('Type') . '</th>';
$content .= '<th>' . __e('Label/Text') . '</th>';
//$content .= '<th>' . __e('Description') . '</th>';
$content .= '<th>' . __e('Value') . '</th>';
$content .= '<th>' . __e('Image') . '</th>';
$content .= '<th>' . __e('Color') . '</th>';
$content .= '<th>' . __e('Action') . '</th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody id="var-lists">' . "\r\n";
for ($z = 0; $z < $max_items; $z++)
{
    $label_value = $desc_value = $value_value = $image_value = '';
    $disable_move = '';
    $icon_move = '<i class="glyphicon glyphicon-move"></i>';

    $type_value = $items[$z]['type'];
    $label_value = $items[$z]['label'];
    //$desc_value = $items[$z]['desc'];
    $value_value = $items[$z]['value'];
    $image_value = $items[$z]['image'];
    $page_value = $items[$z]['page'];
    $color_value = $items[$z]['color'];

    $content .= '<tr class="var-item" id="item-var-' . $z . '">';
    $content .= '<td class="text-align v-align move-cursor handle ' . $disable_move . '">' . $icon_move . '</td>' . "\r\n";

    $content .= '<td>';
    $content .= '<select class="form-control item-type" data-id="' . $z . '" name="grid-box-menu[items][' . $z . '][type]" >';

    foreach ($item_types as $item_type)
    {
        $selected = '';
        if ($item_type['value'] == $items[$z]['type'])
        {
            $selected = 'selected';
        }
        $content .= '<option value="' . $item_type['value'] . '" ' . $selected . '>' . $item_type['label'] . '</option>';
    }
    $content .= '</select>';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input type="text" class="form-control" name="grid-box-menu[items][' . $z . '][label]" value="' . htmlentities($label_value) . '"/>';
    $content .= '</td>';

    // TODO: LAYOUT --|-- FORM --|-- ITEMS --|-- PAGE

    $page_class = "";
    $value_class = "";
    switch ($type_value)
    {
        case "inlink-forward":
            $page_class = "";
            $value_class = "hide";
            break;
        case "inlink-root":
            $page_class = "";
            $value_class = "hide";
            break;
        case "appbrowser":
            $page_class = "hide";
            $value_class = "";
            break;
        case "systembrowser":
            $page_class = "hide";
            $value_class = "";
            break;
    }


    $content .= '<td>';
    $content .= '<input id="grid-box-menu-items-' . $z . '-value"  type="text" class="form-control ' . $value_class . '" name="grid-box-menu[items][' . $z . '][value]" value="' . htmlentities($value_value) . '"/>';
    $content .= '<select id="grid-box-menu-items-' . $z . '-page" class="form-control ' . $page_class . '" name="grid-box-menu[items][' . $z . '][page]" >';
    foreach ($static_pages as $page)
    {
        $selected = '';
        if ($page['name'] == $page_value)
        {
            $selected = 'selected';
        }
        $content .= '<option value="' . $page['name'] . '" ' . $selected . '>' . $page['name'] . '</option>';
    }
    $content .= '</select>';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<div class="input-group">';
    $content .= '<input id="grid-box-menu-items-' . $z . '-image" type="text" name="grid-box-menu[items][' . $z . '][image]" class="form-control" placeholder=""  value="' . htmlentities($image_value) . '"  />';
    $content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-items-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
    $content .= '</div>';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<select name="grid-box-menu[items][' . $z . '][color]" class="form-control select-color" data-color="' . $color_value . '">';
    foreach ($color_names as $color_name)
    {
        $selected = '';
        if ($color_name['value'] == $color_value)
        {
            $selected = 'selected';
        }
        $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
    }
    $content .= '</select>';
    $content .= '</td>';

    $content .= '<td class="text-align v-align">' . "\r\n";
    $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#item-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
    $content .= '</td>' . "\r\n";


    $content .= '</tr>';

}
$z = $max_items + 1;

$content .= '<tr class="var-item" id="item-var-' . $z . '">';
$content .= '<td class=""></td>' . "\r\n";

$content .= '<td>';
$content .= '<select class="form-control item-type" data-id="' . $z . '" name="grid-box-menu[items][' . $z . '][type]" >';
foreach ($item_types as $item_type)
{
    $selected = '';
    $content .= '<option value="' . $item_type['value'] . '" ' . $selected . '>' . $item_type['label'] . '</option>';
}
$content .= '</select>';
$content .= '</td>';

$content .= '<td>';
$content .= '<input type="text" class="form-control" name="grid-box-menu[items][' . $z . '][label]" />';
$content .= '</td>';


$content .= '<td>';
$content .= '<input id="grid-box-menu-items-' . $z . '-value" class="hide form-control" type="text" class="form-control" name="grid-box-menu[items][' . $z . '][value]" />';
$content .= '<select id="grid-box-menu-items-' . $z . '-page" class="form-control" name="grid-box-menu[items][' . $z . '][page]" >';
foreach ($static_pages as $page)
{
    $selected = '';

    $content .= '<option value="' . $page['name'] . '" ' . $selected . '>' . $page['name'] . '</option>';
}
$content .= '</select>';
$content .= '</td>';


$content .= '<td>';
$content .= '<div class="input-group">';
$content .= '<input id="grid-box-menu-items-' . $z . '-image" type="text" name="grid-box-menu[items][' . $z . '][image]" class="form-control" placeholder=""  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#grid-box-menu-items-' . $z . '-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '</td>';

$content .= '<td>';
$content .= '<select class="form-control" name="grid-box-menu[items][' . $z . '][color]" >';
foreach ($color_names as $color_name)
{
    $selected = '';
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}

$content .= '</select>';
$content .= '</td>';

$content .= '<td>' . "\r\n";
$content .= '<input name="save-grid-box-menu" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Add') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</td>' . "\r\n";


$content .= '</tr>';


$content .= '</tbody>';
$content .= '</table>';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-grid-box-menu" type="submit" class="btn btn-primary btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<td><a target="_blank" href="./?p=pages&amp;a=edit&amp;page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>';
        $content .= '<td>' . $pageList['page-title'] . '</td>';
        $content .= '<td>';
        $content .= '<a href="./?p=addons&amp;addons=grid-box-menu&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=grid-box-menu&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=grid-box-menu&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=grid-box-menu&page-target="+$("#page-target").val(),!1});';
$page_js .= '$(".item-type").on("change",function(){';
$page_js .= 'var typeSelected = $(this).val();';
$page_js .= 'var seletedId = $(this).attr("data-id");';


$page_js .= 'var pageName = "#grid-box-menu-items-" + seletedId + "-page";';
$page_js .= 'var valueName = "#grid-box-menu-items-" + seletedId + "-value";';

$page_js .= 'switch(typeSelected){';
$page_js .= 'case "inlink-forward":';
$page_js .= '$(pageName).removeClass("hide");';
$page_js .= '$(valueName).addClass("hide");';
$page_js .= 'break;';
$page_js .= 'case "inlink-root":';
$page_js .= '$(pageName).removeClass("hide");';
$page_js .= '$(valueName).addClass("hide");';
$page_js .= 'break;';
$page_js .= 'case "appbrowser":';
$page_js .= '$(pageName).addClass("hide");';
$page_js .= '$(valueName).removeClass("hide");';
$page_js .= 'break;';
$page_js .= 'case "systembrowser":';
$page_js .= '$(pageName).addClass("hide");';
$page_js .= '$(valueName).removeClass("hide");';
$page_js .= 'break;';
$page_js .= '}';

$page_js .= 'console.log(typeSelected,pageName,valueName);';


$page_js .= '});';
