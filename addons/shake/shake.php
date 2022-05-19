<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `shake`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("shake");
$string = new jsmString();


if (isset($_POST['delete-shake']))
{
    $db->deleteAddOns('shake', 'core');
    $db->deleteService('shake');
    $db->deleteGlobal('shake', 'core');
    $db->current();
    header('Location: ./?p=addons&addons=shake&' . time());
}

// TODO: POST
if (isset($_POST['save-shake']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    $addons['page-title'] = 'core';
    $addons['page-header-color'] = trim($_POST['shake']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['shake']['page-content-background']);
    $addons['detected'] = trim($_POST['shake']['detected']);
    $addons['title-dialog'] = trim($_POST['shake']['title-dialog']);
    $addons['content-dialog'] = trim($_POST['shake']['content-dialog']);
    $addons['goto-page'] = trim($_POST['shake']['goto-page']);


    $addons['api-url'] = trim($_POST['shake']['api-url']);
    $addons['var-title-dialog'] = trim($_POST['shake']['var-title-dialog']);
    $addons['var-content-dialog'] = trim($_POST['shake']['var-content-dialog']);
    $db->saveAddOns('shake', $addons);


    switch ($addons['detected'])
    {
        case 'goto-page':
            $db->deleteService('shake');
            break;
        case 'message-dialog':
            $db->deleteService('shake');
            break;
        case 'restful-api':
            break;
    }


    $global['name'] = 'core';
    $global['note'] = 'This code is used for Shake Detection';


    $z = 0;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'Shake';
    $global['modules'][$z]['var'] = 'shake';
    $global['modules'][$z]['path'] = '@ionic-native/shake/ngx';
    $global['modules'][$z]['native'] = '@ionic-native/shake';
    $global['modules'][$z]['cordova'] = 'cordova-plugin-shake';


    switch ($addons['detected'])
    {
        case 'message-dialog':
            $z++;
            $global['modules'][$z]['enable'] = true;
            $global['modules'][$z]['class'] = 'AlertController';
            $global['modules'][$z]['var'] = 'alertController';
            $global['modules'][$z]['path'] = '@ionic/angular';

            break;
        case 'restful-api':

            $z++;
            $global['modules'][$z]['enable'] = true;
            $global['modules'][$z]['class'] = 'AlertController';
            $global['modules'][$z]['var'] = 'alertController';
            $global['modules'][$z]['path'] = '@ionic/angular';

            $z++;
            $global['modules'][$z]['enable'] = true;
            $global['modules'][$z]['class'] = 'ShakeService';
            $global['modules'][$z]['var'] = 'shakeService';
            $global['modules'][$z]['path'] = './services/shake/shake.service';
            $z++;
            $global['modules'][$z]['enable'] = true;
            $global['modules'][$z]['class'] = 'Observable';
            $global['modules'][$z]['var'] = '';
            $global['modules'][$z]['path'] = 'rxjs';
            break;
    }

    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['init'] = "\t\t" . 'this.handlerShake();';
    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    switch ($addons['detected'])
    {
        case 'message-dialog':
            $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
            break;
        case 'restful-api':
            $global['component'][0]['code']['other'] .= "\t" . 'shakeData: Observable<any>;' . "\r\n";
            break;
    }


    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerShake()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'public handlerShake(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'const watch = this.shake.startWatch(60).subscribe(() => {' . "\r\n";

    switch ($addons['detected'])
    {
        case 'goto-page':
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.router.navigate(["/' . $addons['goto-page'] . '"]);' . "\r\n";
            break;
        case 'message-dialog':
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.shakeAlert("' . $addons['title-dialog'] . '","' . str_replace(array("\r\n", "\n"), " ", $addons['content-dialog']) . '");' . "\r\n";
            break;
        case 'restful-api':

            $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.shakeData = this.shakeService.getItem();' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.shakeData.subscribe(data => {' . "\r\n";
            if ($addons['var-title-dialog'] == "")
            {
                $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let title = "";' . "\r\n";
            } else
            {
                $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let title = data.' . $addons['var-title-dialog'] . ';' . "\r\n";
            }
            if ($addons['var-content-dialog'] == "")
            {
                $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let content = "";' . "\r\n";
            } else
            {
                $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let content = data.' . $addons['var-content-dialog'] . ';' . "\r\n";
            }

            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'this.shakeAlert(title,content);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '});' . "\r\n";
            break;
    }

    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";


    switch ($addons['detected'])
    {
        case 'message-dialog':
            $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':shakeAlert()' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . 'async shakeAlert(header:string, message: string){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . '//subHeader: subheader,' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
            break;
        case 'restful-api':
            $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':shakeAlert()' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . 'async shakeAlert(header:string, message: string){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . '//subHeader: subheader,' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
            break;
    }


    $db->saveGlobal('shake', $global);
    $global = null;


    switch ($addons['detected'])
    {
        case 'message-dialog':
            break;
        case 'restful-api':
            $service = null;
            $service['name'] = 'Shake';
            $service['instruction'] = '-';
            $service['desc'] = 'shake gesture handler';
            $z = 0;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'HttpClient';
            $service['modules']['angular'][$z]['var'] = 'httpClient';
            $service['modules']['angular'][$z]['path'] = '@angular/common/http';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = '@angular/common/http';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'Observable';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = 'rxjs';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'throwError';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = 'rxjs';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'of';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = 'rxjs';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'map';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'catchError';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'retry';
            $service['modules']['angular'][$z]['var'] = '';
            $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'LoadingController';
            $service['modules']['angular'][$z]['var'] = 'loadingController';
            $service['modules']['angular'][$z]['path'] = '@ionic/angular';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'ToastController';
            $service['modules']['angular'][$z]['var'] = 'toastController';
            $service['modules']['angular'][$z]['path'] = '@ionic/angular';
            $z++;
            $service['modules']['angular'][$z]['enable'] = true;
            $service['modules']['angular'][$z]['class'] = 'AlertController';
            $service['modules']['angular'][$z]['var'] = 'alertController';
            $service['modules']['angular'][$z]['path'] = '@ionic/angular';
            $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";

            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . 'apiUrl : string = "' . $addons['api-url'] . '";' . "\r\n";
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':getItem()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'getItem(): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let apiUrl = this.apiUrl;' . "\r\n";
            $service['code']['other'] .= "\t\t" . '//console.log("apiUrl", apiUrl);' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(apiUrl)' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("RAW:",results);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast();' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("Handling error:", err);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,err.message);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("caught rethrown:", err);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";


            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':presentLoading()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'message: "Shake Detected!",' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
            $service['code']['other'] .= "\t\t" . '});' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':dismissLoading()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
            $service['code']['other'] .= "\t\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showToast()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'async showToast(){' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'message: "Successfully",' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
            $service['code']['other'] .= "\t\t" . '});' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showAlert()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . '//message: message,' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
            $service['code']['other'] .= "\t\t" . '});' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";

            $db->saveService($service, 'global');
            break;
    }

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=shake&' . time());

}

// TODO: INIT
$disabled = null;
$current_setting = $db->getAddOns('shake', 'core');


if (!isset($current_setting['detected']))
{
    $current_setting['detected'] = '';
}

if (!isset($current_setting['content-dialog']))
{
    $current_setting['content-dialog'] = '';
}

if (!isset($current_setting['title-dialog']))
{
    $current_setting['title-dialog'] = '';
}


if (!isset($current_setting['api-url']))
{
    $current_setting['api-url'] = '';
}

if (!isset($current_setting['var-title-dialog']))
{
    $current_setting['var-title-dialog'] = '';
}

if (!isset($current_setting['var-content-dialog']))
{
    $current_setting['var-content-dialog'] = '';
}

if (!isset($current_setting['goto-page']))
{
    $current_setting['goto-page'] = 'about-us';
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

$content .= '<div class="callout callout-danger">' . __e('These addons require the <strong>Cordova Plugin</strong> and <strong>Ionic Native</strong>, to be able to run the emulator you have to <a href="./?p=2.update-plugin">update it</a>') . '</div>';

$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- detected
$options = array();
$options[] = array('value' => 'message-dialog', 'label' => 'Show Message Dialog');
$options[] = array('value' => 'goto-page', 'label' => 'Go To Page');
$options[] = array('value' => 'restful-api', 'label' => 'Fetching data from RESTful-API');

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="shake-detected">' . __e('if Shake detected?') . '</label>';
$content .= '<select id="shake-detected" name="shake[detected]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['detected'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('If a shake is detected?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- TITLE-DIALOG
$content .= '<div class="col-md-12" id="box-title-dialog"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="title-dialog">' . __e('Title') . '</label>';
$content .= '<input type="text" id="title-dialog" name="shake[title-dialog]" class="form-control" value="' . htmlentities($current_setting['title-dialog']) . '" placeholder="Write the title" />';
$content .= '<p class="help-block">' . __e('Write the title for the dialog that will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTENT-DIALOG
$content .= '<div class="col-md-12" id="box-content-dialog"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="content-dialog">' . __e('Content') . '</label>';
$content .= '<textarea id="content-dialog" name="shake[content-dialog]" class="form-control">' . htmlentities($current_setting['content-dialog']) . '</textarea>';
$content .= '<p class="help-block">' . __e('Write the content for the dialog that will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';


// TODO: LAYOUT --|-- FORM --|-- API-URL
$content .= '<div class="col-md-12" id="box-api-url"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="api-url">' . __e('API Url') . '</label>';
$content .= '<input id="api-url" type="url" name="shake[api-url]" class="form-control" placeholder=""  value="' . $current_setting['api-url'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';


// TODO: LAYOUT --|-- FORM --|-- VAR-CONTENT-TITLE
$content .= '<div class="col-md-12" id="box-var-title-dialog"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="var-title-dialog">' . __e('Variable for Title') . '</label>';
$content .= '<input id="var-title-dialog" type="text" name="shake[var-title-dialog]" class="form-control" placeholder="title"  value="' . $current_setting['var-title-dialog'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Variables that will be used for the title') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- VAR-CONTENT-DIALOG
$content .= '<div class="col-md-12" id="box-var-content-dialog"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="var-content-dialog">' . __e('Variable for Content') . '</label>';
$content .= '<input id="var-content-dialog" type="text" name="shake[var-content-dialog]" class="form-control" placeholder="content"  value="' . $current_setting['var-content-dialog'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Variables that will be used for the content') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';


// TODO: LAYOUT --|-- FORM --|-- GOTO-PAGE
$content .= '<div class="col-md-12" id="box-goto-page"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="goto-page">' . __e('Go To Page?') . '</label>';
//$content .= '<input id="goto-page" type="text" name="shake[goto-page]" class="form-control" placeholder="content"  value="' . $current_setting['goto-page'] . '"  ' . $disabled . '  />';

$content .= '<select id="goto-page" name="shake[goto-page]" class="form-control" >';
foreach ($static_pages as $item_page)
{
    $selected = '';
    if ($current_setting['goto-page'] == $item_page["name"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($item_page["name"]) . ' " ' . $selected . '>- ' . htmlentities($item_page["title"]) . ' (' . htmlentities($item_page["name"]) . ')</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Go to page when shake detected') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';


$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-shake" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;or&nbsp;<input name="delete-shake" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Docs') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>' . __e('You must use the json structure as follows:') . '</p>';
$example_json['title'] = 'Hi, congratulations!';
$example_json['message'] = 'Please use the following coupon code: IMAB';

$content .= '<pre>' . json_encode($example_json) . '</pre>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=shake&page-target="+$("#page-target").val(),!1});';
$page_js .= '
setOpt();
$("#shake-detected").click(function(){
  setOpt();
}); 
function setOpt(){
   var detected = $("#shake-detected").val();
   switch(detected){
        case "message-dialog":
            $("#box-content-dialog").css("display","block");
            $("#box-title-dialog").css("display","block");
            $("#box-api-url").css("display","none");
            $("#box-var-content-dialog").css("display","none");
            $("#box-var-title-dialog").css("display","none");
             $("#box-goto-page").css("display","none");
            break;
            
        case "restful-api":
            $("#box-title-dialog").css("display","none");
            $("#box-content-dialog").css("display","none");
            $("#box-api-url").css("display","block");
            $("#box-var-title-dialog").css("display","block");
            $("#box-var-content-dialog").css("display","block");
            $("#box-goto-page").css("display","none");
            
            break;
        case "goto-page":
            $("#box-goto-page").css("display","block");
            $("#box-title-dialog").css("display","none");
            $("#box-content-dialog").css("display","none");
            $("#box-api-url").css("display","none");
            $("#box-var-content-dialog").css("display","none");
            $("#box-var-title-dialog").css("display","none");
            
            break
   }
}

';

?>
 
