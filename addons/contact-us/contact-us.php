<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `contact-us`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("contact-us");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('contact-us', $current_page_target);
    header('Location: ./?p=addons&addons=contact-us&' . time());
}

// TODO: POST
if (isset($_POST['save-contact-us']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['contact-us']['page-title']);
    $addons['page-header-color'] = trim($_POST['contact-us']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['contact-us']['page-content-background']);

    if (isset($_POST['contact-us']['via-sms']))
    {
        $addons['via-sms'] = true;
    } else
    {
        $addons['via-sms'] = false;
    }

    if (isset($_POST['contact-us']['via-whatsapp']))
    {
        $addons['via-whatsapp'] = true;
    } else
    {
        $addons['via-whatsapp'] = false;
    }

    if (isset($_POST['contact-us']['via-email']))
    {
        $addons['via-email'] = true;
    } else
    {
        $addons['via-email'] = false;
    }


    $addons['sms-recipient'] = trim($_POST['contact-us']['sms-recipient']);
    $addons['whatsapp-recipient'] = trim($_POST['contact-us']['whatsapp-recipient']);
    $addons['email-recipient'] = trim($_POST['contact-us']['email-recipient']);

    $addons['label-submit'] = trim($_POST['contact-us']['label-submit']);
    $addons['label-via'] = trim($_POST['contact-us']['label-via']);
    $addons['label-content'] = trim($_POST['contact-us']['label-content']);
    $addons['label-empty-message'] = trim($_POST['contact-us']['label-empty-message']);
    $db->saveAddOns('contact-us', $addons);


    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'contact-us';
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
    $z = 0;

    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';


    $z++;
    $newPage['modules']['angular'][$z]['class'] = 'InAppBrowser';
    $newPage['modules']['angular'][$z]['var'] = 'inAppBrowser';
    $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-inappbrowser';
    $newPage['modules']['angular'][$z]['path'] = '@ionic-native/in-app-browser/ngx';
    $newPage['modules']['angular'][$z]['enable'] = true;

    $z++;
    $newPage['modules']['angular'][$z]['class'] = 'InAppBrowserOptions';
    $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-inappbrowser';
    $newPage['modules']['angular'][$z]['path'] = '@ionic-native/in-app-browser/ngx';
    $newPage['modules']['angular'][$z]['enable'] = true;

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Platform';
    $newPage['modules']['angular'][$z]['var'] = 'platform';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;


    $newPage['content']['html'] .= "" . '<form [formGroup]="form' . $string->toClassName($current_page_target) . '">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="stacked">' . $addons['label-via'] . '</ion-label>' . "\r\n";
    $option_selected = null;
    $selected = '';
    if ($addons['via-sms'] == true)
    {
        $selected = 'via-sms';
        $option_selected .= "\t\t\t\t" . '<ion-select-option value="via-sms">SMS</ion-select-option>' . "\r\n";
    }
    if ($addons['via-whatsapp'] == true)
    {
        $selected = 'via-whatsapp';
        $option_selected .= "\t\t\t\t" . '<ion-select-option value="via-whatsapp">WhatsApp</ion-select-option>' . "\r\n";
    }
    if ($addons['via-email'] == true)
    {
        $selected = 'via-email';
        $option_selected .= "\t\t\t\t" . '<ion-select-option value="via-email">Email</ion-select-option>' . "\r\n";
    }

    if ($addons['label-submit'] == '')
    {
        $addons['label-submit'] = 'Submit';
    }

    $newPage['content']['html'] .= "\t\t\t" . '<ion-select formControlName="via" ok-text="Okay" cancel-text="Dismiss">' . "\r\n";
    $newPage['content']['html'] .= $option_selected;
    $newPage['content']['html'] .= "\t\t\t" . '</ion-select>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="stacked">' . $addons['label-content'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-textarea formControlName="content" color="primary" clear-input ></ion-textarea>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<div class="ion-padding">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-button expand="block" type="submit" class="ion-no-margin" (click)="onSubmit()">' . $addons['label-submit'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "" . '</form>' . "\r\n";
    //$newPage['content']['html'] .= "" . '<pre>{{ form' . $string->toClassName($current_page_target) . '.value | json }}</pre>' . "\r\n";


    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-item {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    // TODO: POST --|-- PAGE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['other'] .= "\t" . 'smsRecipient: string = "' . $addons['sms-recipient'] . '";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'whatsappRecipient: string = "' . $addons['whatsapp-recipient'] . '";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'emailRecipient: string = "' . $addons['email-recipient'] . '";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'emailSubject: string = "' . $current_app['apps']['app-name'] . ' App";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'emptyMessage: string = "' . trim($addons['label-empty-message']) . '";' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'form' . $string->toClassName($current_page_target) . ': FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.resetFieldValues()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public resetFieldValues(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.form' . $string->toClassName($current_page_target) . ' = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'via : ["' . $selected . '", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'content : ["", Validators.required]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.runWhatsapp()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private runWhatsapp(phone_number: string, message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let myMessage = message || "Hi";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let phoneNumber = phone_number || "08123456789";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(myMessage == ""){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'myMessage = "Hi";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let urlSchema = "https://api.whatsapp.com/send?phone=" + encodeURIComponent(phoneNumber) + "&text=" + encodeURIComponent(myMessage) ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.runSmsApp()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private runSmsApp(phone_number: string, message : string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let phoneNumber = phone_number || "08123456789";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let textMessage = encodeURI(message) || "";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let urlSchema;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'urlSchema = "sms:" + phoneNumber + ";?&body=" + textMessage;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'urlSchema = "sms:" + phoneNumber + "?body=" + textMessage;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.runMailApp()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private runMailApp(email: string, subject : string, message : string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let emailAddr = email || "info@ihsana.com";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let textSubject = subject || "email subject";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let textMessage = encodeURI(message) || "write your message";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(textSubject == ""){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'textSubject = "email subject";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(textMessage == ""){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'textMessage = "your message";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let urlSchema = "mailto:" + emailAddr + "?subject=" + textSubject + "&body=" + textMessage;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.onSubmit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public onSubmit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let data:any = this.form' . $string->toClassName($current_page_target) . '.value; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(data.content !== "" ){ ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'switch(data.via){ ' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'case "via-sms":{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.runSmsApp(this.smsRecipient, data.content);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'case "via-whatsapp":{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.runWhatsapp(this.whatsappRecipient,data.content);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'case "via-email":{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.runMailApp(this.emailRecipient,this.emailSubject,data.content);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.resetFieldValues();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.showAlert(null,this.emptyMessage,null);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.showAlert()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.resetFieldValues();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['init'] = null;


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=contact-us&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('contact-us', $current_page_target);
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
    $current_setting['page-content-background'] = 'assets/images/background/bg-02.png';
}

if (!isset($current_setting['they-can-contact-us-via?']))
{
    $current_setting['they-can-contact-us-via?'] = '';
}

if (!isset($current_setting['via-sms']))
{
    $current_setting['via-sms'] = false;
}

if (!isset($current_setting['via-whatsapp']))
{
    $current_setting['via-whatsapp'] = false;
}

if (!isset($current_setting['via-email']))
{
    $current_setting['via-email'] = false;
}

if (!isset($current_setting['sms-recipient']))
{
    $current_setting['sms-recipient'] = '';
}

if (!isset($current_setting['whatsapp-recipient']))
{
    $current_setting['whatsapp-recipient'] = '';
}

if (!isset($current_setting['email-recipient']))
{
    $current_setting['email-recipient'] = '';
}

if (!isset($current_setting['label-via']))
{
    $current_setting['label-via'] = 'Via';
}

if (!isset($current_setting['label-content']))
{
    $current_setting['label-content'] = 'Your Message';
}

if (!isset($current_setting['label-empty-message']))
{
    $current_setting['label-empty-message'] = 'Your message cannot be empty!';
}

if (!isset($current_setting['label-submit']))
{
    $current_setting['label-submit'] = 'Submit';
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
//$content .= '<div class="callout callout-danger">' . __e('This plugin is not yet usable, still in the coding stage!') . '</div>';
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="contact-us[page-target]" class="form-control" >';
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
$content .= '<input  id="page-title" type="text" name="contact-us[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="contact-us[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="contact-us[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<hr/>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- VIA-SMS
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-background">' . __e('Users can contact you via?') . '</label>';
$content .= '</div>';

$content .= '<div class="checkbox">';
$checked = '';
if ($current_setting['via-sms'] == true)
{
    $checked = 'checked="checked"';
}
$content .= '<label for="page-via-sms"><input ' . $checked . ' class="flat-red" type="checkbox" id="page-via-sms" name="contact-us[via-sms]" ' . $disabled . '/> ' . __e('SMS') . '</label>';
$content .= '</div>';

$content .= '<div class="checkbox">';
$checked = '';
if ($current_setting['via-whatsapp'] == true)
{
    $checked = 'checked="checked"';
}
$content .= '<label for="page-via-whatsapp"><input ' . $checked . ' class="flat-red" type="checkbox" id="page-via-whatsapp" name="contact-us[via-whatsapp]" ' . $disabled . '/> ' . __e('WhatsApp') . '</label>';
$content .= '</div>';

$content .= '<div class="checkbox">';
$checked = '';
if ($current_setting['via-email'] == true)
{
    $checked = 'checked="checked"';
}
$content .= '<label for="page-via-email"><input ' . $checked . ' class="flat-red" type="checkbox" id="page-via-email" name="contact-us[via-email]" ' . $disabled . '/> ' . __e('Email') . '</label>';
$content .= '</div>';

$content .= '</div><!-- ./col-md-12 -->';

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<hr/>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- SMS-RECIPIENT
$content .= '<div id="field-sms-recipient" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-sms-recipient">' . __e('SMS Recipient') . '</label>';
$content .= '<input id="page-sms-recipient" type="text" name="contact-us[sms-recipient]" class="form-control" placeholder="081234567789"  value="' . $current_setting['sms-recipient'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Your mobile number used to receive incoming messages') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- WHATSAPP-RECIPIENT
$content .= '<div id="field-whatsapp-recipient" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-whatsapp-recipient">' . __e('WhatsApp Recipient') . '</label>';
$content .= '<input id="page-whatsapp-recipient" type="text" name="contact-us[whatsapp-recipient]" class="form-control" placeholder="081234567789"  value="' . $current_setting['whatsapp-recipient'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Your WhatsApp number used to receive incoming messages') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- EMAIL-RECIPIENT
$content .= '<div id="field-email-recipient" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-email-recipient">' . __e('Email Recipient') . '</label>';
$content .= '<input id="page-email-recipient" type="text" name="contact-us[email-recipient]" class="form-control" placeholder="info@ihsana.com"  value="' . $current_setting['email-recipient'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Your email address used to receive incoming messages') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<hr/>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-VIA
$content .= '<div id="field-message-title" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-via">' . __e('Label for `Via`') . '</label>';
$content .= '<input id="page-label-via" type="text" name="contact-us[label-via]" class="form-control" placeholder="Via"  value="' . $current_setting['label-via'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-CONTENT
$content .= '<div id="field-message-content" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-content">' . __e('Label for `Content`') . '</label>';
$content .= '<input id="page-label-content" type="text" name="contact-us[label-content]" class="form-control" placeholder="Your Message"  value="' . $current_setting['label-content'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- EMPTY-MESSAGE
$content .= '<div id="field-message-reply-to" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-empty-message">' . __e('Label for `Empty Message`') . '</label>';
$content .= '<input id="page-label-empty-message" type="text" name="contact-us[label-empty-message]" class="form-control" placeholder="Message cannot be empty!"  value="' . $current_setting['label-empty-message'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- SUBMIT
$content .= '<div id="field-message-reply-to" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-submit">' . __e('Label for `Submit`') . '</label>';
$content .= '<input id="page-label-submit" type="text" name="contact-us[label-submit]" class="form-control" placeholder="Send"  value="' . $current_setting['label-submit'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-contact-us" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<a href="./?p=addons&amp;addons=contact-us&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=contact-us&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=contact-us&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=contact-us&page-target="+$("#page-target").val(),!1});';
