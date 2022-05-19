<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `step-wizard-slider`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("step-wizard-slider");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('step-wizard-slider', $current_page_target);
    header('Location: ./?p=addons&addons=step-wizard-slider&' . time());
}

// TODO: POST
if (isset($_POST['save-step-wizard-slider']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['step-wizard-slider']['page-title']);
    $addons['max-slides'] = trim($_POST['step-wizard-slider']['max-slides']);
    $addons['goto'] = trim($_POST['step-wizard-slider']['goto']);
    $addons['slides'] = $_POST['step-wizard-slider']['slides'];

    // checkbox
    if (isset($_POST['step-wizard-slider']['dont-show-again']))
    {
        $addons['dont-show-again'] = true;
    } else
    {
        $addons['dont-show-again'] = false;
    }

    // checkbox
    if (isset($_POST['step-wizard-slider']['as-home-app']))
    {
        $addons['as-home-app'] = true;
    } else
    {
        $addons['as-home-app'] = false;
    }

    //label-for-donot-show-again
    if (!isset($_POST['step-wizard-slider']['label-for-donot-show-again']))
    {
        $_POST['step-wizard-slider']['label-for-donot-show-again'] = 'Don\'t show again';
    }
    $addons['label-for-donot-show-again'] = trim($_POST['step-wizard-slider']['label-for-donot-show-again']); //text


    //label-for-skip
    if (!isset($_POST['step-wizard-slider']['label-for-skip']))
    {
        $_POST['step-wizard-slider']['label-for-skip'] = 'SKIP';
    }
    $addons['label-for-skip'] = trim($_POST['step-wizard-slider']['label-for-skip']); //text

    $db->saveAddOns('step-wizard-slider', $addons);

    // TODO : ============================================================================
    // TODO: GENERATOR --|-- PROJECT --|--
    $new_project = $current_app['apps'];


    if ($addons['dont-show-again'] == true)
    {
        $new_project['ionic-storage'] = true;
    }

    if ($addons['as-home-app'] == true)
    {
        $new_project['rootPage'] = $current_page_target;
    }


    $db->saveProject($new_project);
    // TODO : ============================================================================

    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $addons['page-target'];
    $newPage['code-by'] = 'step-wizard-slider';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = 'tertiary';
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    //$newPage['content']['disable-ion-content'] = true;

    $newPage['content']['enable-fullscreen'] = true;
    $newPage['content']['enable-padding'] = true;
    $newPage['content']['disable-scroll'] = true;

    // TODO: POST --|-- MODULES

    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = '';
    $newPage['content']['html'] .= "\t" . '<ion-slides pager="false">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of slideItems; last as isLast">' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<ion-toolbar>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-buttons slot="end" *ngIf="!isLast">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button  color="primary" [routerDirection]="\'root\'" [routerLink]="[\'/' . $string->toFileName($addons['goto']) . '\']" >' . $addons['label-for-skip'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-buttons *ngIf="isLast">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-toolbar>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<img [src]="item.image" class="slide-image"/>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<h2 class="slide-title" [innerHTML]="item.title"></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<p *ngIf="!isLast" [innerHTML]="item.description"></p>' . "\r\n";


    $newPage['content']['html'] .= "\t\t\t" . '<ion-button *ngIf="isLast" size="large" fill="clear" icon="end" color="primary" [routerDirection]="\'root\'" [routerLink]="[\'/' . $string->toFileName($addons['goto']) . '\']" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . 'Continue <ion-icon name="arrow-forward"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";


    if ($addons['dont-show-again'] == true)
    {

        // TODO: GENERATOR --|-- PAGE --|-- PRODUCTS-DETAIL --|-- FOOTER
        $newPage['footer']['color'] = 'none';
        $newPage['footer']['type'] = 'code';
        $newPage['footer']['title'] = '';
        $newPage['footer']['code'] = null;
        $newPage['footer']['code'] .= "\t" . '<ion-item lines="none">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-checkbox checked="true" *ngIf="isShowAgain==true"  color="danger" (click)="setDontShowAgain(false)"></ion-checkbox>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-checkbox  *ngIf="isShowAgain!=true" color="danger" (click)="setDontShowAgain(true)"></ion-checkbox>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-label>'. $addons['label-for-donot-show-again'] .'</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '</ion-item>' . "\r\n";
    }


    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;


    $newPage['content']['scss'] .= "\t" . 'ion-toolbar {--background:transparant}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.swiper-slide {display: block;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > h2 {margin-top: 2.8rem;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > img {max-height: 50%;max-width: 60%;margin: 16px 0;}' . "\r\n";


    // TODO: POST --|-- PAGE --|-- TS
    $z = 0;
    foreach ($addons['slides'] as $slide)
    {
        if ($slide['slide-title'] !== '')
        {
            $json[$z]['title'] = $slide['slide-title'];
            $json[$z]['description'] = $slide['slide-desc'];
            $json[$z]['image'] = $slide['slide-image'];
            $z++;
        }
    }


    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['dont-show-again'] == true)
    {
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'isShowAgain:boolean = true;' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:setDontShowAgain()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'setDontShowAgain(action:boolean){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(action == true){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.storage.set(`slider-dont-show-again`,true).then(data=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.checkShowAgain(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.storage.set(`slider-dont-show-again`,false).then(data=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.checkShowAgain(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:checkShowAgain(boolean)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'checkShowAgain(redirect:boolean){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.storage.get(`slider-dont-show-again`).then(data=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'console.log(`slider-dont-show-again`,data);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if(data == null){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.setDontShowAgain(true);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if(redirect==true){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'if(data == false){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.router.navigate([`/' . $string->toFileName($addons['goto']) . '`], { replaceUrl: true });' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.isShowAgain = data;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'slideItems: any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.slideItems = ' . json_encode($json) . ';' . "\r\n";
    if ($addons['dont-show-again'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . 'this.checkShowAgain(true);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=step-wizard-slider&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('step-wizard-slider', $current_page_target);
}
if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}
if (!isset($current_setting['page-title']))
{
    $current_setting['page-title'] = '';
}

if (!isset($current_setting['max-slides']))
{
    $current_setting['max-slides'] = 3;
}

if (!isset($current_setting['slides']))
{
    $current_setting['slides'] = array();
}

if (!isset($current_setting['goto']))
{
    $current_setting['goto'] = 'error';
}


if (!isset($current_setting['as-home-app']))
{
    $current_setting['as-home-app'] = false;
}

if (!isset($current_setting['dont-show-again']))
{
    $current_setting['dont-show-again'] = false;
}

if (!isset($current_setting['label-for-donot-show-again']))
{
    $current_setting['label-for-donot-show-again'] = 'Don\'t show again';
}

if (!isset($current_setting['label-for-skip']))
{
    $current_setting['label-for-skip'] = 'Skip';
}

// TODO: LAYOUT
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';

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
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="step-wizard-slider[page-target]" class="form-control" >';
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
$content .= '<div class="col-md-8"><!-- col-md-8 -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-TITLE
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input id="page-title" type="text" name="step-wizard-slider[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-8 -->';
// TODO: LAYOUT --|-- FORM --|-- MAX-SLIDES
$options = array();
$options[] = array('value' => '2', 'label' => '2 slides');
$options[] = array('value' => '3', 'label' => '3 slides');
$options[] = array('value' => '4', 'label' => '4 slides');
$options[] = array('value' => '5', 'label' => '5 slides');
$options[] = array('value' => '6', 'label' => '6 slides');
$options[] = array('value' => '7', 'label' => '7 slides');
$options[] = array('value' => '8', 'label' => '8 slides');
$options[] = array('value' => '9', 'label' => '9 slides');

$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-max-slides">' . __e('Max Slides') . '</label>';
$content .= '<select id="page-max-slides" name="step-wizard-slider[max-slides]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['max-slides'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('The number of slides needed?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';


$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="">' . __e('Options') . '</label>';

$content .= '<table class="table">';

$content .= '<tr>';
if ($current_setting['as-home-app'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-as-home-app" name="step-wizard-slider[as-home-app]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-as-home-app" name="step-wizard-slider[as-home-app]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Make this page as a home page') . '</td>';
$content .= '</tr>';

$content .= '<tr>';
if ($current_setting['dont-show-again'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-dont-show-again" name="step-wizard-slider[dont-show-again]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-dont-show-again" name="step-wizard-slider[dont-show-again]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Don\'t show again') . '</td>';
$content .= '</tr>';


$content .= '</table>';


$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="step-wizard-slider-goto">' . __e('Go To Page') . '</label>';
$content .= '<select id="step-wizard-slider-goto" name="step-wizard-slider[goto]" class="form-control" ' . $disabled . ' >';
foreach ($static_pages as $item_page)
{
    $selected = '';
    if ($current_setting['goto'] == $item_page["name"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($item_page["name"]) . ' " ' . $selected . '>- ' . htmlentities($item_page["title"]) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Where is the link to if you click the skip/continue button') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '<hr/>';


for ($no = 0; $no <= ($current_setting['max-slides'] - 1); $no++)
{
    if (!isset($current_setting['slides'][$no]['slide-title']))
    {
        $current_setting['slides'][$no]['slide-title'] = '';
    }
    if (!isset($current_setting['slides'][$no]['slide-image']))
    {
        $current_setting['slides'][$no]['slide-image'] = '';
    }

    if (!isset($current_setting['slides'][$no]['slide-desc']))
    {
        $current_setting['slides'][$no]['slide-desc'] = '';
    }

    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-heading">';
    $content .= '<h4 class="panel-title">Slide ' . ($no + 1) . '</h4>';
    $content .= '</div>';
    $content .= '<div class="panel-body">';

    $content .= '<div class="row">';

    // TODO: LAYOUT --|-- FORM --|-- SLIDE-TITLE
    $content .= '<div class="col-md-6"><!-- col-md-6 -->';
    $content .= '<div class="form-group">';
    $content .= '<label for="page-slide-title">' . __e('Slide Title') . '</label>';
    $content .= '<input type="text" name="step-wizard-slider[slides][' . $no . '][slide-title]" class="form-control" placeholder="Like Magic" value="' . $current_setting['slides'][$no]['slide-title'] . '"  ' . $disabled . ' />';
    $content .= '<p class="help-block">' . __e('Write the title of the slide') . '</p>';
    $content .= '</div>';
    $content .= '</div><!-- ./col-md-6 -->';

    // TODO: LAYOUT --|-- FORM --|-- SLIDE-IMAGE
    $content .= '<div class="col-md-6"><!-- col-md-6 -->';
    $content .= '<div class="form-group">';
    $content .= '<label for="page-slide-image">' . __e('Slide Image') . '</label>';
    $content .= '<div class="input-group">';
    $content .= '<input type="text" name="step-wizard-slider[slides][' . $no . '][slide-image]" id="slides-' . $no . '-slide-image" class="form-control" placeholder=""  value="' . $current_setting['slides'][$no]['slide-image'] . '"  ' . $disabled . ' />';
    $content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#slides-' . $no . '-slide-image" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
    $content .= '</div>';
    $content .= '<p class="help-block">' . __e('You can use image ratio is 1:1') . '</p>';
    $content .= '</div>';
    $content .= '</div><!-- ./col-md-6 -->';

    $content .= '</div>';

    $content .= '<div class="row">';
    // TODO: LAYOUT --|-- FORM --|-- SLIDE-DESC
    $content .= '<div class="col-md-12"><!-- col-md-12 -->';
    $content .= '<div class="form-group">';
    $content .= '<label for="page-slide-desc">' . __e('Slide Description') . '</label>';
    $content .= '<input type="text" name="step-wizard-slider[slides][' . $no . '][slide-desc]" class="form-control" placeholder="Build app like using magic"  value="' . $current_setting['slides'][$no]['slide-desc'] . '"  ' . $disabled . ' />';
    $content .= '<p class="help-block">' . __e('Write a description of the slides') . '</p>';
    $content .= '</div>';
    $content .= '</div><!-- ./col-md-12 -->';
    $content .= '</div>';

    $content .= '</div>';
    $content .= '</div>';
}


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-step-wizard-slider" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';

$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DONOT-SHOW-AGAIN --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-donot-show-again" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-donot-show-again">' . __e('Label for `Don\'t show again`') . '</label>';
$content .= '<input id="page-label-for-donot-show-again" type="text" name="step-wizard-slider[label-for-donot-show-again]" class="form-control" placeholder="Don\'t show again"  value="' . $current_setting['label-for-donot-show-again'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Don\'t show again`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
 

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SKIP --|-- TEXT
 
$content .= '<div id="field-label-for-skip" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-skip">' . __e('Label for `Don\'t show again`') . '</label>';
$content .= '<input id="page-label-for-skip" type="text" name="step-wizard-slider[label-for-skip]" class="form-control" placeholder="SKIP"  value="' . $current_setting['label-for-skip'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Skip`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';



$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-step-wizard-slider" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


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
        $content .= '<a href="./?p=addons&amp;addons=step-wizard-slider&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=step-wizard-slider&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=step-wizard-slider&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$content .= '</form><!-- ./form -->';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=step-wizard-slider&page-target="+$("#page-target").val(),!1});';
