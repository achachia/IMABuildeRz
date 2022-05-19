<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package WordPress Page
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
$prefix_addons = 'wordpress-page';

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("wordpress-page");
$string = new jsmString();
if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));
if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('wordpress-page', $current_page_target);
    header('Location: ./?p=addons&addons=wordpress-page&' . time());
}
// TODO: POST
if (isset($_POST['save-wordpress-page']))
{
    // TODO: SAVE --|-- SETTINGS
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['wordpress-page']['page-title']);
    $addons['wp-url'] = trim($_POST['wordpress-page']['wp-url']);
    $addons['page-id'] = trim($_POST['wordpress-page']['page-id']);
    $addons['page-header-color'] = trim($_POST['wordpress-page']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['wordpress-page']['page-content-background']);
    $addons['http-module'] = trim($_POST['wordpress-page']['http-module']); //select
    if (isset($_POST['wordpress-page']['multiple-language']))
    {
        $addons['multiple-language'] = true;
    } else
    {
        $addons['multiple-language'] = false;
    }


    //label-for-please-wait
    if (!isset($_POST[$prefix_addons]['label-for-please-wait']))
    {
        $_POST[$prefix_addons]['label-for-please-wait'] = 'Please wait...!';
    }
    $addons['label-for-please-wait'] = trim($_POST[$prefix_addons]['label-for-please-wait']); //text

    //label-for-successfully
    if (!isset($_POST[$prefix_addons]['label-for-successfully']))
    {
        $_POST[$prefix_addons]['label-for-successfully'] = 'Successfully retrieved data!';
    }
    $addons['label-for-successfully'] = trim($_POST[$prefix_addons]['label-for-successfully']); //text

    //label-for-ok
    if (!isset($_POST[$prefix_addons]['label-for-ok']))
    {
        $_POST[$prefix_addons]['label-for-ok'] = 'Ok';
    }
    $addons['label-for-ok'] = trim($_POST[$prefix_addons]['label-for-ok']); //text

    $wp_url = $addons['wp-url'];
    $db->saveAddOns('wordpress-page', $addons);


    // TODO: ------------------------------------------------------------------------------------------------------------------------------
    // TODO: UPDATE --|-- ENQUEUE
    $enqueue_css[] = array('url' => $addons['wp-url'] . '/wp-includes/css/dist/block-library/style.min.css', 'attr' => 'media="all"');
    $enqueue_css[] = array('url' => $addons['wp-url'] . '/wp-includes/css/dist/block-library/theme.min.css');
    $db->addEnqueues('styles', $enqueue_css);


    if ($addons['multiple-language'] == true)
    {


        // TODO: UPDATE --|-- PROJECT
        $new_project = $current_app['apps'];
        $new_project['ionic-storage'] = true;
        $new_project['pref-orientation'] = 'portrait';
        $db->saveProject($new_project);

        // TODO: UPDATE --|-- LOCALIZATION
        //=======================================================
        $localization = null;
        $localization['prefix'] = 'en';
        $localization['name'] = 'English';
        $localization['desc'] = 'Auto create by WordPress Page Addons';

        $v = 0;
        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-ok'];
        $localization['words'][$v]['translate'] = 'Ok';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
        $localization['words'][$v]['translate'] = 'please-wait...';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-successfully'];
        $localization['words'][$v]['translate'] = 'Successfully retrieved data!';

        $v++;
        $localization['words'][$v]['text'] = 'years ago';
        $localization['words'][$v]['translate'] = 'years ago';

        $v++;
        $localization['words'][$v]['text'] = 'months ago';
        $localization['words'][$v]['translate'] = 'months ago';

        $v++;
        $localization['words'][$v]['text'] = 'days ago';
        $localization['words'][$v]['translate'] = 'days ago';

        $v++;
        $localization['words'][$v]['text'] = 'hours ago';
        $localization['words'][$v]['translate'] = 'hours ago';

        $v++;
        $localization['words'][$v]['text'] = 'minutes ago';
        $localization['words'][$v]['translate'] = 'minutes ago';

        $v++;
        $localization['words'][$v]['text'] = 'seconds ago';
        $localization['words'][$v]['translate'] = 'seconds ago';

        $v++;
        $localization['words'][$v]['text'] = 'Do you want to exit App?';
        $localization['words'][$v]['translate'] = 'Do you want to exit App?';

        $v++;
        $localization['words'][$v]['text'] = 'Default';
        $localization['words'][$v]['translate'] = 'Default';

        $v++;
        $localization['words'][$v]['text'] = 'Cancel';
        $localization['words'][$v]['translate'] = 'Cancel';

        $v++;
        $localization['words'][$v]['text'] = 'Ok';
        $localization['words'][$v]['translate'] = 'Ok';

        $v++;
        $localization['words'][$v]['text'] = 'Yes';
        $localization['words'][$v]['translate'] = 'Yes';


        $db->updateLocalization($localization);


        $localization = null;
        $localization['prefix'] = 'id';
        $localization['name'] = 'Indonesia';
        $localization['desc'] = 'Auto create by WordPress Page Addons';

        $v = 0;

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-ok'];
        $localization['words'][$v]['translate'] = 'Baiklah';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
        $localization['words'][$v]['translate'] = 'Silahkan tunggu!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-successfully'];
        $localization['words'][$v]['translate'] = 'Berhasil mengambil data!';

        $v++;
        $localization['words'][$v]['text'] = 'years ago';
        $localization['words'][$v]['translate'] = 'tahun lalu';

        $v++;
        $localization['words'][$v]['text'] = 'months ago';
        $localization['words'][$v]['translate'] = 'bulan lalu';

        $v++;
        $localization['words'][$v]['text'] = 'days ago';
        $localization['words'][$v]['translate'] = 'hari lalu';

        $v++;
        $localization['words'][$v]['text'] = 'hours ago';
        $localization['words'][$v]['translate'] = 'jam lalu';

        $v++;
        $localization['words'][$v]['text'] = 'minutes ago';
        $localization['words'][$v]['translate'] = 'minit lalu';

        $v++;
        $localization['words'][$v]['text'] = 'seconds ago';
        $localization['words'][$v]['translate'] = 'detik lalu';

        $v++;
        $localization['words'][$v]['text'] = 'Do you want to exit App?';
        $localization['words'][$v]['translate'] = 'Apakah kamu ingin keluar aplikasi?';

        $v++;
        $localization['words'][$v]['text'] = 'Default';
        $localization['words'][$v]['translate'] = 'Biasa';

        $v++;
        $localization['words'][$v]['text'] = 'Cancel';
        $localization['words'][$v]['translate'] = 'Batal';

        $v++;
        $localization['words'][$v]['text'] = 'Ok';
        $localization['words'][$v]['translate'] = 'Baik';

        $v++;
        $localization['words'][$v]['text'] = 'Yes';
        $localization['words'][$v]['translate'] = 'Ya';


        $db->updateLocalization($localization);


    }


    // TODO: SERVICES --|--
    $service['name'] = $addons['page-target'];
    $service['desc'] = 'This service is to get wordpress posts data';

    $z = 0;

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

    if ($addons['http-module'] == 'cordova')
    {
        $z++;
        $service['modules']['angular'][$z]['enable'] = true;
        $service['modules']['angular'][$z]['class'] = 'HTTP';
        $service['modules']['angular'][$z]['var'] = 'http';
        $service['modules']['angular'][$z]['path'] = '@ionic-native/http/ngx';
        $service['modules']['angular'][$z]['cordova'] = 'cordova-plugin-advanced-http';

        $z++;
        $service['modules']['angular'][$z]['enable'] = true;
        $service['modules']['angular'][$z]['class'] = 'from';
        $service['modules']['angular'][$z]['var'] = '';
        $service['modules']['angular'][$z]['path'] = 'rxjs';

        $z++;
        $service['modules']['angular'][$z]['enable'] = true;
        $service['modules']['angular'][$z]['class'] = 'finalize';
        $service['modules']['angular'][$z]['var'] = '';
        $service['modules']['angular'][$z]['path'] = 'rxjs/operators';


    } else
    {
        $z++;
        $service['modules']['angular'][$z]['enable'] = true;
        $service['modules']['angular'][$z]['class'] = 'HttpClient';
        $service['modules']['angular'][$z]['var'] = 'httpClient';
        $service['modules']['angular'][$z]['path'] = '@angular/common/http';

        $z++;
        $service['modules']['angular'][$z]['enable'] = true;
        $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
        $service['modules']['angular'][$z]['var'] = '';
        $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    }


    // TODO: SERVICES --|-- CODE - OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    //$service['code']['other'] .= "\t" . 'searchTerm = "" ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* getPage()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";


    if ($addons['http-module'] == 'cordova')
    {
        $service['code']['other'] .= "\t" . 'getPage(postId:string): Observable<any>{' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'let nativeHTTP = this.http.get(this.wpUrl + `/wp-json/wp/v2/pages/${postId}?_embed=true`, {}, {' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '"Content-Type": "application/json"' . "\r\n";
        $service['code']['other'] .= "\t\t" . '});' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'from(nativeHTTP).pipe(' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . 'finalize(()=>{' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
        $service['code']['other'] .= "\t\t" . ');' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return from(nativeHTTP);' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t" . 'getPage(postId:string): Observable<any>{' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/pages/${postId}?_embed=true`)' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
        if ($addons['multiple-language'] == true)
        {
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(this.translateService.instant(`' . $addons['label-for-successfully'] . '`));' . "\r\n";
        } else
        {
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully'] . '`);' . "\r\n";
        }
        $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("throwError:", err);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,err.message);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("reThrown:", err);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
    }

    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t\t" . 'message: this.translateService.instant(`' . $addons['label-for-please-wait'] . '`),' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t\t" . 'message: `' . $addons['label-for-please-wait'] . '`,' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* showToast($message)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t\t" . 'buttons: [this.translateService.instant(`' . $addons['label-for-ok'] . '`)]' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t\t" . 'buttons: ["' . $addons['label-for-ok'] . '"]' . "\r\n";
    }
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, $current_page_target);


    // TODO: PAGE DETAIL
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $addons['page-target'];
    $newPage['code-by'] = 'wordpress-page';
    $newPage['icon-left'] = 'paper';
    $newPage['icon-right'] = 'menu';

    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);

    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';


    //$newPage['content']['disable-ion-content'] = true;
    // TODO: PAGE DETAIL --|-- MODULES
    $getClassName = $string->toClassName($current_page_target) . 'Service';
    $varName = $string->toUserClassName($current_page_target) . 'Service';
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$z]['var'] = $varName;
    $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';

    if ($addons['http-module'] == 'cordova')
    {
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'HTTP';
        $newPage['modules']['angular'][$z]['var'] = 'http';
        $newPage['modules']['angular'][$z]['path'] = '@ionic-native/http/ngx';
        $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-advanced-http';
    }

    // TODO: PAGE DETAIL --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataPage">' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<img *ngIf="dataPage[\'_embedded\'] && dataPage[\'_embedded\'][\'wp:featuredmedia\'] && dataPage[\'_embedded\'][\'wp:featuredmedia\'][0] && dataPage[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& dataPage[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ dataPage[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-header class="text-wrap" *ngIf="dataPage.title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="dataPage.title.rendered"></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ dataPage.date | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-content class="text-wrap" *ngIf="dataPage.content">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div class="page-content" [innerHtml]="dataPage.content.rendered | trustHtml"></div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    // TODO: PAGE DETAIL --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";


    // TODO: PAGE DETAIL --|-- TS

    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'pageId: string = "' . (int)$addons['page-id'] . '";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'page: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataPage: any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- getPage()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* getPage()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getPage(){' . "\r\n";
    if ($addons['http-module'] == 'cordova')
    {
        $newPage['code']['other'] .= "\t\t" . 'this.page = this.' . $varName . '.getPage(this.pageId);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.page.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataPage = JSON.parse(data.data) ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    } else
    {
        $newPage['code']['other'] .= "\t\t" . 'this.page = this.' . $varName . '.getPage(this.pageId);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.page.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataPage = data ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPage = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPage();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPage = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPage();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    //header('Location: ./?p=addons&addons=wordpress-page&page-target=' . $current_page_target);
}
// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('wordpress-page', $current_page_target);
}
if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}
if (!isset($current_setting['page-title']))
{
    $current_setting['page-title'] = '';
}
if (!isset($current_setting['wp-url']))
{
    $current_setting['wp-url'] = '';
}
if (!isset($current_setting['page-id']))
{
    $current_setting['page-id'] = '';
}

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}


if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-successfully']))
{
    $current_setting['label-for-successfully'] = 'Successfully retrieved data!';
}

if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'Ok';
}
if (!isset($current_setting['multiple-language']))
{
    $current_setting['multiple-language'] = false;
}
if (!isset($current_setting['http-module']))
{
    $current_setting['http-module'] = 'angular';
}
$content .= '<form action="" method="post"><!-- ./form -->';
// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
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
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="wordpress-page[page-target]" class="form-control">';
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

$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
// TODO: LAYOUT --|-- FORM --|-- PAGE-TITLE
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input id="page-title" type="text" name="wordpress-page[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="col-md-6">';
// TODO: LAYOUT --|-- FORM --|-- WP-URL
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('WordPress URL') . '</label>';
$content .= '<input id="page-title" type="text" name="wordpress-page[wp-url]" class="form-control" placeholder="http://"  value="' . $current_setting['wp-url'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="wordpress-page[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="wordpress-page[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row">';
$content .= '<div class="col-md-6">';

// TODO: LAYOUT --|-- FORM --|-- PAGE-ID
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page ID') . '</label>';
$content .= '<input id="page-title" type="number" name="wordpress-page[page-id]" class="form-control" placeholder="12"  value="' . $current_setting['page-id'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('The page id can be seen in the wordpress url when you edit the page') . '</p>';
$content .= '</div><!-- ./form-group -->';
$content .= '</div><!-- ./col-md-6 -->';


$options = array();
$options[] = array('value' => 'angular', 'label' => 'Angular (HTTP Client)');
$options[] = array('value' => 'cordova', 'label' => 'HTTP Advanced Cordova Plugin (Only Work on Real Device)');

$content .= '<div id="field-http-module" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-http-module">' . __e('HTTP Module') . '</label>';
$content .= '<select id="page-http-module" name="wordpress-page[http-module]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['http-module'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please select the http module to be used?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- AUTO-MENU --|-- CHECKBOX
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-auto-menu" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Options') . '</label>';
$content .= '<table class="table">';
$content .= '<tr>';
if ($current_setting['multiple-language'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-multiple-language" name="wordpress-page[multiple-language]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-multiple-language" name="wordpress-page[multiple-language]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Multiple Language Support') . '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div><!-- ./form-group -->';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress-page" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- LABEL

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

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="' . $prefix_addons . '[label-for-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY --|-- TEXT

$content .= '<div id="field-label-for-successfully" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully">' . __e('Label for `Successfully retrieved data!`') . '</label>';
$content .= '<input id="page-label-for-successfully" type="text" name="' . $prefix_addons . '[label-for-successfully]" class="form-control" placeholder="Successfully retrieved data!"  value="' . $current_setting['label-for-successfully'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Successfully retrieved data!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT

$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `Ok`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="' . $prefix_addons . '[label-for-ok]" class="form-control" placeholder="Ok"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Ok`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress-page" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';

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
        $content .= '<td><a target="_blank" href="./?p=pages&a=edit&page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>';
        $content .= '<td>' . $pageList['page-title'] . '</td>';
        $content .= '<td>';
        $content .= '<a href="./?p=addons&addons=wordpress-page&page-target=' . $pageList['page-target'] . '&a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&addons=wordpress-page&page-target=' . $pageList['page-target'] . '&a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&addons=wordpress-page&page-target=' . $pageList['page-target'] . '&a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=wordpress-page&page-target="+$("#page-target").val(),!1});';
