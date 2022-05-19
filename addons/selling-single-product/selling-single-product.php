<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `selling-single-product`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("selling-single-product");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('selling-single-product', $current_page_target);
    header('Location: ./?p=addons&addons=selling-single-product&' . time());
}

// TODO: POST
if (isset($_POST['save-selling-single-product']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['selling-single-product']['page-title']);
    $addons['page-header-color'] = trim($_POST['selling-single-product']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['selling-single-product']['page-content-background']);
    // text
    $addons['product-categories'] = trim($_POST['selling-single-product']['product-categories']);
    // text
    $addons['product-name'] = trim($_POST['selling-single-product']['product-name']);
    // text
    $addons['product-price'] = trim($_POST['selling-single-product']['product-price']);
    // text
    $addons['product-down-payment'] = trim($_POST['selling-single-product']['product-down-payment']);
    // text
    $addons['product-currency'] = trim($_POST['selling-single-product']['product-currency']);
    // html
    $addons['product-description'] = trim($_POST['selling-single-product']['product-description']);
    // image
    $addons['product-image-1'] = trim($_POST['selling-single-product']['product-image-1']);
    // image
    $addons['product-image-2'] = trim($_POST['selling-single-product']['product-image-2']);
    // image
    $addons['product-image-3'] = trim($_POST['selling-single-product']['product-image-3']);

    // text
    $addons['contact-call'] = trim($_POST['selling-single-product']['contact-call']);
    // text
    $addons['contact-sms'] = trim($_POST['selling-single-product']['contact-sms']);
    // text
    $addons['contact-whatsapp'] = trim($_POST['selling-single-product']['contact-whatsapp']);
    // text
    $addons['contact-email'] = trim($_POST['selling-single-product']['contact-email']);
    // text
    $addons['label-for-payment'] = trim($_POST['selling-single-product']['label-for-payment']);
    // text
    $addons['label-for-contact-us'] = trim($_POST['selling-single-product']['label-for-contact-us']);
    // text
    $addons['label-for-price'] = trim($_POST['selling-single-product']['label-for-price']);
    // text
    $addons['label-for-down-payment'] = trim($_POST['selling-single-product']['label-for-down-payment']);


    // checkbox
    if (isset($_POST['selling-single-product']['pay-with-paypal-enable']))
    {
        $addons['pay-with-paypal-enable'] = true;
    } else
    {
        $addons['pay-with-paypal-enable'] = false;
    }


    $db->saveAddOns('selling-single-product', $addons);


    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'selling-single-product';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: POST --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';


    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides>' . "\r\n";
    if ($addons['product-image-1'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<img src="' . $addons['product-image-1'] . '"/>  ' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    }
    if ($addons['product-image-2'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<img src="' . $addons['product-image-2'] . '"/>  ' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    }
    if ($addons['product-image-3'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<img src="' . $addons['product-image-3'] . '"/>  ' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    }

    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle>' . $addons['product-categories'] . '</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-title>' . $addons['product-name'] . '</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-label color="danger">{{ ' . $addons['product-price'] . ' | currency:"' . $addons['product-currency'] . '" }}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . $addons['product-description'] . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-item-divider>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . $addons['label-for-payment'] . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-item-divider>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-row>' . "\r\n";


    if ($addons['pay-with-paypal-enable'] == true)
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button expand="block" payWithPaypal price="' . $addons['product-price'] . '" info="' . $addons['product-name'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . ' Pay with Paypal ' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-col>' . "\r\n";
    }

    $newPage['content']['html'] .= "\t" . '</ion-row>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-item-divider>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . $addons['label-for-contact-us'] . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-item-divider>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-row>' . "\r\n";

    if ($addons['contact-call'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" expand="block" color="primary" callApp phoneNumber="' . $addons['contact-call'] . '" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="call"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . $addons['contact-call'] . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-col>' . "\r\n";
    }

    if ($addons['contact-sms'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" expand="block" color="danger" smsApp phoneNumber="' . $addons['contact-sms'] . '" shortMessage="' . $addons['product-name'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="send"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . $addons['contact-sms'] . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-col>' . "\r\n";
    }

    if ($addons['contact-whatsapp'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" expand="block" color="success" whatsappApp phoneNumber="' . $addons['contact-whatsapp'] . '" message="' . $addons['product-name'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . $addons['contact-whatsapp'] . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-col>' . "\r\n";
    }

    if ($addons['contact-email'] != '')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" expand="block" color="default" mailApp emailAddress="' . $addons['contact-email'] . '" emailMessage="" emailSubject="' . $addons['product-name'] . '">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="mail"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . $addons['contact-email'] . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-col>' . "\r\n";
    }
    $newPage['content']['html'] .= "\t" . '</ion-row>' . "\r\n";


    $newPage['content']['html'] .= '</ion-card>' . "\r\n";

    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-content p{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-top: 12px;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-bottom: 12px;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'text-align: justify;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    // TODO: POST --|-- PAGE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['init'] = null;


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=selling-single-product&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('selling-single-product', $current_page_target);
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

if (!isset($current_setting['product-categories']))
{
    $current_setting['product-categories'] = '';
}

if (!isset($current_setting['product-name']))
{
    $current_setting['product-name'] = '';
}

if (!isset($current_setting['product-name']))
{
    $current_setting['product-name'] = '';
}

if (!isset($current_setting['product-price']))
{
    $current_setting['product-price'] = '';
}

if (!isset($current_setting['product-price']))
{
    $current_setting['product-price'] = '';
}

if (!isset($current_setting['product-description']))
{
    $current_setting['product-description'] = '';
}

if (!isset($current_setting['product-description']))
{
    $current_setting['product-description'] = '';
}

if (!isset($current_setting['product-image-1']))
{
    $current_setting['product-image-1'] = '';
}

if (!isset($current_setting['product-image-1']))
{
    $current_setting['product-image-1'] = '';
}

if (!isset($current_setting['product-image-2']))
{
    $current_setting['product-image-2'] = '';
}

if (!isset($current_setting['product-image-2']))
{
    $current_setting['product-image-2'] = '';
}

if (!isset($current_setting['product-image-3']))
{
    $current_setting['product-image-3'] = '';
}

if (!isset($current_setting['product-image-3']))
{
    $current_setting['product-image-3'] = '';
}

if (!isset($current_setting['product-down-payment']))
{
    $current_setting['product-down-payment'] = '';
}

if (!isset($current_setting['product-currency']))
{
    $current_setting['product-currency'] = '$';
}

if (!isset($current_setting['contact-call']))
{
    $current_setting['contact-call'] = '';
}

if (!isset($current_setting['contact-sms']))
{
    $current_setting['contact-sms'] = '';
}

if (!isset($current_setting['contact-whatsapp']))
{
    $current_setting['contact-whatsapp'] = '';
}

if (!isset($current_setting['contact-email']))
{
    $current_setting['contact-email'] = '';
}

if (!isset($current_setting['label-for-payment']))
{
    $current_setting['label-for-payment'] = 'Payment';
}

if (!isset($current_setting['label-for-contact-us']))
{
    $current_setting['label-for-contact-us'] = 'Contact Us';
}

if (!isset($current_setting['label-for-price']))
{
    $current_setting['label-for-price'] = 'Price';
}

if (!isset($current_setting['label-for-down-payment']))
{
    $current_setting['label-for-down-payment'] = 'Down Payment';
}

if (!isset($current_setting['pay-with-paypal-enable']))
{
    $current_setting['pay-with-paypal-enable'] = false;
}


// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<form action="" method="post"><!-- ./form -->';

$content .= '<div class="box box-primary">';
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
$content .= '<select id="page-target" name="selling-single-product[page-target]" class="form-control" >';
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
$content .= '<input  id="page-title" type="text" name="selling-single-product[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="selling-single-product[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="selling-single-product[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '</div><!-- ./box-body -->';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-selling-single-product" type="submit" class="btn btn-primary btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div><!-- ./box-footer -->';

$content .= '</div><!-- ./box -->';

// TODO: -------------------------------------------------


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Product / Service') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


$content .= '<div class="row">';
// TODO: LAYOUT --|-- FORM --|-- PRODUCT-CATEGORIES
$content .= '<div id="field-product-categories" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-categories">' . __e('Categories') . '</label>';
$content .= '<input id="page-product-categories" type="text" name="selling-single-product[product-categories]" class="form-control" placeholder="Service"  value="' . $current_setting['product-categories'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the categories') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- PRODUCT-NAME
$content .= '<div id="field-product-name" class="col-md-8"><!-- col-md-8 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-name">' . __e('Product Name') . '</label>';
$content .= '<input id="page-product-name" type="text" name="selling-single-product[product-name]" class="form-control" placeholder="Air Conditioner Repair"  value="' . $current_setting['product-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the name of the product or service that you are offering') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-8 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row">';
// TODO: LAYOUT --|-- FORM --|-- PRODUCT-PRICE
$content .= '<div id="field-product-price" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-price">' . __e('Fixed Price') . '</label>';
$content .= '<input id="page-product-price" type="text" name="selling-single-product[product-price]" class="form-control" placeholder="500"  value="' . $current_setting['product-price'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Product prices that you offer') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- PRODUCT-DOWN-PAYMENT
//$content .= '<div id="field-product-down-payment" class="col-md-4"><!-- col-md-4 -->';
//$content .= '<div class="form-group">';
//$content .= '<label for="page-product-down-payment">' . __e('Down Payment (DP)') . '</label>';
//$content .= '<input id="page-product-down-payment" type="text" name="selling-single-product[product-down-payment]" class="form-control" placeholder="10"  value="' . $current_setting['product-down-payment'] . '"  ' . $disabled . ' />';
//$content .= '<p class="help-block">' . __e('Up-front partial payment for the purchase of expensive items') . '</p>';
//$content .= '</div>';
//$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- PRODUCT-CURRENCY
$content .= '<div id="field-product-currency" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-currency">' . __e('Currency Symbol') . '</label>';
$content .= '<input id="page-product-currency" type="text" name="selling-single-product[product-currency]" class="form-control" placeholder="$"  value="' . $current_setting['product-currency'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '</div><!-- ./row -->';

$content .= '<div class="row">';
// TODO: LAYOUT --|-- FORM --|-- PRODUCT-DESCRIPTION
$content .= '<div id="field-product-description" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-description">' . __e('Description') . '</label>';
$content .= '<textarea data-type="tinymce" id="page-product-description" name="selling-single-product[product-description]" class="form-control" placeholder=""  ' . $disabled . ' >' . htmlentities($current_setting['product-description']) . '</textarea>';
$content .= '<p class="help-block">' . __e('Write a description of the product you are selling') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

$content .= '<hr/>';
$content .= '<label>' . __e('Slidebox') . '</label>';

$content .= '<div class="row">';
// TODO: LAYOUT --|-- FORM --|-- PRODUCT-IMAGE-1
$content .= '<div id="field-product-image-1" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-image-1">' . __e('Images 1') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-product-image-1" type="text" name="selling-single-product[product-image-1]" class="form-control" placeholder=""  value="' . $current_setting['product-image-1'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-product-image-1" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- PRODUCT-IMAGE-2
$content .= '<div id="field-product-image-2" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-image-2">' . __e('Images 2') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-product-image-2" type="text" name="selling-single-product[product-image-2]" class="form-control" placeholder=""  value="' . $current_setting['product-image-2'] . '"  ' . $disabled . '  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-product-image-2" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- PRODUCT-IMAGE-3
$content .= '<div id="field-product-image-3" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-product-image-3">' . __e('Images 3') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-product-image-3" type="text" name="selling-single-product[product-image-3]" class="form-control" placeholder=""  value="' . $current_setting['product-image-3'] . '"  ' . $disabled . '  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-product-image-3" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '</div><!-- ./row -->';
$content .= '<hr/>';
$content .= '<label>' . __e('Contact Us') . '</label>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- CONTACT-CALL
$content .= '<div id="field-contact-call" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-call">' . __e('Call') . '</label>';
$content .= '<input id="page-contact-call" type="text" name="selling-single-product[contact-call]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-call'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the telephone number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTACT-SMS
$content .= '<div id="field-contact-sms" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-sms">' . __e('SMS') . '</label>';
$content .= '<input id="page-contact-sms" type="text" name="selling-single-product[contact-sms]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-sms'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the phone number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTACT-WHATSAPP
$content .= '<div id="field-contact-whatsapp" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-whatsapp">' . __e('WhatsApp ') . '</label>';
$content .= '<input id="page-contact-whatsapp" type="text" name="selling-single-product[contact-whatsapp]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-whatsapp'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the WhatsApp number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTACT-EMAIL
$content .= '<div id="field-contact-email" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-email">' . __e('Email') . '</label>';
$content .= '<input id="page-contact-email" type="text" name="selling-single-product[contact-email]" class="form-control" placeholder="cs@ihsana.com"  value="' . $current_setting['contact-email'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the email address') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

$content .= '</div><!-- ./row -->';

$content .= '<hr/>';
$content .= '<label>' . __e('Payment Gateway') . '</label>';

// TODO: LAYOUT --|-- FORM --|-- PAY-WITH-PAYPAL-ENABLE

$content .= '<table class="table table striped">';
$paypal_disabled = 'disabled';
if (isset($current_app['directives']['pay-with-paypal']))
{
    $paypal_disabled = '';
}

$content .= '<tr>';

$content .= '<td>';
$content .= '<div class="checkbox">';
if ($current_setting['pay-with-paypal-enable'] == true)
{
    $content .= '<label for="page-pay-with-paypal-enable"><input checked ' . $paypal_disabled . ' class="flat-red" type="checkbox" id="page-pay-with-paypal-enable" name="selling-single-product[pay-with-paypal-enable]" ' . $disabled . '/> ' . __e('') . '</label>';
} else
{
    $content .= '<label for="page-pay-with-paypal-enable"><input ' . $paypal_disabled . ' class="flat-red" type="checkbox" id="page-pay-with-paypal-enable" name="selling-single-product[pay-with-paypal-enable]" ' . $disabled . '/> ' . __e('') . '</label>';

}
$content .= '</div>';
$content .= '</td>';

$content .= '<td>';
$content .= '<label>' . __e('pay With Paypal') . '</label>';
$content .= '<p class="small">' . __e('To activate the pay with paypal menu, please activate <strong>payWithPaypal directive</strong> in the directives page') . '</p>';
$content .= '</td>';

$content .= '</tr>';


$content .= '</table>';


$content .= '<hr/>';
$content .= '<label>' . __e('Label') . '</label>';

$content .= '<div class="row">';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PAYMENT
$content .= '<div id="field-label-for-payment" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-payment">' . __e('Label for `Payment`') . '</label>';
$content .= '<input id="page-label-for-payment" type="text" name="selling-single-product[label-for-payment]" class="form-control" placeholder="Payment"  value="' . $current_setting['label-for-payment'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONTACT-US
$content .= '<div id="field-label-for-contact-us" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-contact-us">' . __e('Label for `Contact Us`') . '</label>';
$content .= '<input id="page-label-for-contact-us" type="text" name="selling-single-product[label-for-contact-us]" class="form-control" placeholder="Contact Us"  value="' . $current_setting['label-for-contact-us'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRICE
$content .= '<div id="field-label-for-price" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-price">' . __e('Label for `Price`') . '</label>';
$content .= '<input id="page-label-for-price" type="text" name="selling-single-product[label-for-price]" class="form-control" placeholder="Price"  value="' . $current_setting['label-for-price'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DOWN-PAYMENT
//$content .= '<div id="field-label-for-down-payment" class="col-md-3"><!-- col-md-3 -->';
//$content .= '<div class="form-group">';
//$content .= '<label for="page-label-for-down-payment">' . __e('Label for `Down Payment`') . '</label>';
//$content .= '<input id="page-label-for-down-payment" type="text" name="selling-single-product[label-for-down-payment]" class="form-control" placeholder="Down Payment"  value="' . $current_setting['label-for-down-payment'] . '"  ' . $disabled . '  />';
//$content .= '<p class="help-block">' . __e('') . '</p>';
//$content .= '</div>';
//$content .= '</div><!-- ./col-md-3 -->';

$content .= '</div><!-- ./row -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-selling-single-product" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div><!-- ./box -->';

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
        $content .= '<a href="./?p=addons&amp;addons=selling-single-product&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=selling-single-product&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=selling-single-product&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=selling-single-product&page-target="+$("#page-target").val(),!1});';
