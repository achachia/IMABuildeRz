<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `woocommerce-products`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("woocommerce-products");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('woocommerce-products', $current_page_target);
    header('Location: ./?p=addons&addons=woocommerce-products&' . time());
}

// TODO: POST
if (isset($_POST['save-woocommerce-products']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['woocommerce-products']['page-title']);
    $addons['page-header-color'] = trim($_POST['woocommerce-products']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['woocommerce-products']['page-content-background']);
    // url
    $addons['wordpress-url'] = trim(str_replace('http://', 'https://', $_POST['woocommerce-products']['wordpress-url']));
    // text
    $addons['consumer-key'] = trim($_POST['woocommerce-products']['consumer-key']);
    // text
    $addons['consumer-secret'] = trim($_POST['woocommerce-products']['consumer-secret']);
    // text
    $addons['per-page'] = trim($_POST['woocommerce-products']['per-page']);
    // text
    $addons['category-id'] = trim($_POST['woocommerce-products']['category-id']);
    // select
    $addons['order-via'] = trim($_POST['woocommerce-products']['order-via']);
    // text
    $addons['contact-call'] = trim($_POST['woocommerce-products']['contact-call']);
    // text
    $addons['contact-sms'] = trim($_POST['woocommerce-products']['contact-sms']);
    // text
    $addons['contact-whatsapp'] = trim($_POST['woocommerce-products']['contact-whatsapp']);
    // text
    $addons['contact-email'] = trim($_POST['woocommerce-products']['contact-email']);

    $db->saveAddOns('woocommerce-products', $addons);

    $varServiceName = $string->toClassName($current_page_target) . 'Service';
    $varPageName = $string->toClassName($current_page_target) . 'Page';

    $varUserServiceName = $string->toUserClassName($current_page_target) . 'Service';
    $varUserPageName = $string->toUserClassName($current_page_target) . 'Page';

    if ($addons['per-page'] == '')
    {
        $addons['per-page'] = '10';
    }


    if ($addons['category-id'] == '')
    {
        $addons['category-id'] = '-1';
    }


    $service['name'] = $current_page_target;
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get data';

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

    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';

    // TODO: SERVICE - CODE - OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $addons['wordpress-url'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'consumerKey: string = "' . $addons['consumer-key'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'consumerSecret: string = "' . $addons['consumer-secret'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getProducts()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getProducts(query): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/?${param}`,httpOptions)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast("Successfully!");' . "\r\n";
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
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TS --|-- getProduct()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.getProduct(productId)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getProduct(productId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.consumerKey + ":" + this.consumerSecret),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wc/v3/products/${productId}/?_embed=true`,httpOptions)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast("Successfully!");' . "\r\n";
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
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: SERVICE --|-- TS --|-- httpBuildQuery()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.httpBuildQuery(obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private httpBuildQuery(obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let k, str;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'str = [];' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'for (k in obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'str.push(encodeURIComponent(k) + "=" + encodeURIComponent(obj[k]));' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return str.join("&");' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: SERVICE --|-- TS --|-- presentLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: "Please wait...",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TS --|-- showToast()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.showToast($message)' . "\r\n";
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
    // TODO: SERVICE --|-- TS --|-- showAlert()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $varServiceName . '.showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    $db->saveService($service, $current_page_target);


    // create properties for page
    // TODO: PRODUCTS --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'woocommerce-products';
    $newPage['icon-left'] = 'cart';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['param'] = 'cat_id';
    $newPage['header']['mid']['type'] = 'search';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: PRODUCTS --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';

    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][1]['var'] = $string->toUserClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][1]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';


    // TODO: PRODUCTS --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

    // TODO: PRODUCTS --|-- HTML --|-- no-result
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataProducts.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'There are no products' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="12" size-sm *ngFor="let item of dataProducts">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($current_page_target) . '-detail\',item.id]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.images && item.images[0] && item.images[0].src" [src]="item.images[0].src"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="item.name" [innerHTML]="item.name"></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle color="danger" *ngIf="item.name" [innerHTML]="item.price_html"></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";


    // TODO: PRODUCTS --|-- HTML --|-- content
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll (ionInfinite)="loadMore($event)">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content></ion-infinite-scroll-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";


    // TODO: PRODUCTS --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'p,li{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-top: 0;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-bottom: 12px;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'color: #8e9093;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'font-size: 1.4rem;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'blockquote {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'border-left: 5px solid #ddd;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-left: 0;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-right: 0;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'padding-left: 1.4em;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'img {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'height: auto;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-item h2 {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'font-weight: 500 !important;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-item h3 {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'color: #777;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    // TODO: PRODUCTS --|-- TS
    $newPage['code']['export'] = null;

    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'products: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataProducts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'pageNumber: number = 1;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'defaultCatId: string = "' . $addons['category-id'] . '";' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'query = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . '.getProducts()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getProducts(start: boolean){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.updateQuery();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.products = this.' . $varUserServiceName . '.getProducts(this.query);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.products.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(start == true){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProducts = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProducts = this.dataProducts.concat(data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PRODUCTS --|-- TS --|-- updateQuery()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . '.updateQuery()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public updateQuery(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.query["page"] = this.pageNumber;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.query["_embed"] = "true";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.query["per_page"] = ' . (int)$addons['per-page'] . ' ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.query["search"] = this.filterQuery;' . "\r\n";

    $newPage['code']['other'] .= "\t\t" . 'if((this.catId == "") || (this.catId == null)){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.catId = this.defaultCatId;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.catId != "0"){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.query["category"] = this.catId;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'console.log("parameter",this.query);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PRODUCTS --|-- TS --|-- filterItems()
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . '.filterItems($event)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = filterVal;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = "";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if((this.filterQuery.length == 0 ) || (this.filterQuery.length >= 3 )){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataProducts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.pageNumber = 1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.getProducts(true);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PRODUCTS --|-- TS --|-- loadMore()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . '.loadMore(infiniteScroll)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @param event $infiniteScroll' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public loadMore(infiniteScroll){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let pageNumber = this.pageNumber;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.pageNumber++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProducts(false);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'infiniteScroll.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//infiniteScroll.target.enable = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PRODUCTS --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . '.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProducts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProducts(false);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . '.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProducts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.pageNumber = 1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProducts(true);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['init'] = null;

    //generate page code
    $db->savePage($newPage);


    // TODO: PRODUCTS DETAIL --+--
    $newPage = null;
    $newPage['title'] = '{{ dataProduct.name }}';
    $newPage['name'] = $current_page_target . '-detail';
    $newPage['code-by'] = 'woocommerce';
    $newPage['icon-left'] = 'cart';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['param'] = 'product_id';
    $newPage['content']['disable-ion-content'] = false;
    $newPage['content']['enable-fullscreen'] = false;
    $newPage['back-button'] = '/' . $current_page_target;

    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: PRODUCTS DETAIL --+-- MODULES
    $z = 0;


    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$z]['var'] = $string->toUserClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
    $newPage['modules']['angular'][$z]['var'] = 'loadingController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';


    // TODO: PRODUCTS DETAIL --+-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "" . '' . "\r\n";
    $newPage['content']['html'] .= "" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "" . '' . "\r\n";

    $newPage['content']['html'] .= "" . '<ion-card *ngIf="dataProduct && dataProduct.name">' . "\r\n";
    $newPage['content']['html'] .= "" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides pager="true" *ngIf="dataProduct.images && dataProduct.images[0] && dataProduct.images[0].src" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of dataProduct.images | slice:0:5" [ngStyle]="{\'background-image\':\'url(\' + item.src + \')\',\'background-size\':\'cover\',\'background-position\':\'center center\'}" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div class="slide-container ratio-1x1"></div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= "" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-title *ngIf="dataProduct.name" [innerHTML]="dataProduct.name"></ion-card-title>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle color="danger" *ngIf="dataProduct.name" [innerHTML]="dataProduct.price_html"></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label color="danger" *ngIf="dataProduct.name" [innerHTML]="dataProduct.price_html"></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-badge slot="end" color="warning"><ion-icon name="star"></ion-icon> {{ dataProduct.average_rating }}</ion-badge>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";

    $newPage['content']['html'] .= "" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-content [innerHTML]="dataProduct.description"></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataProduct.dimensions && dataProduct.weight">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'Additional Information' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataProduct.dimensions.width">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>Dimensions</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-note slot="end" color="primary">{{ dataProduct.dimensions.length }} x {{ dataProduct.dimensions.width }} x {{ dataProduct.dimensions.height }} cm</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataProduct.weight">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>Weight</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-note slot="end" color="secondary">{{ dataProduct.weight }} kg</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<ion-card-content *ngIf="dataProduct.categories && dataProduct.categories[0]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-chip outline color="primary" *ngFor="let cat of dataProduct.categories" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($current_page_target) . '\',cat.id]">{{ cat.name }}</ion-chip>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "" . '</ion-card>' . "\r\n";


    switch ($addons['order-via'])
    {
        case 'coding':
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';

            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '<ion-footer>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '<ion-grid>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button contactUs phone="' . $addons['contact-call'] . '" phone="' . $addons['contact-call'] . '" sms="' . $addons['contact-sms'] . '" whatsapp="' . $addons['contact-whatsapp'] . '" email="' . $addons['contact-email'] . '" message="{{ dataProduct.name }}" size="small" fill="outline" expand="block" color="primary">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="chatbox-ellipses"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button (click)="buyNow(dataProduct.id, dataProduct.name,dataProduct.price)" size="small" fill="outline" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>Buy</ion-label>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="6">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button (click)="addToCart(dataProduct.id, dataProduct.name,dataProduct.price)" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="add-circle"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>Add to Cart</ion-label>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
            $newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
            break;
        case 'browser':
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';

            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '<ion-footer>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '<ion-grid>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button contactUs phone="' . $addons['contact-call'] . '" phone="' . $addons['contact-call'] . '" sms="' . $addons['contact-sms'] . '" whatsapp="' . $addons['contact-whatsapp'] . '" email="' . $addons['contact-email'] . '" message="{{ dataProduct.name }}" size="small" fill="outline" expand="block" color="primary">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="chatbox-ellipses"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="6">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button systemBrowser [url]="dataProduct.permalink" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="globe"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>Open Via Browser</ion-label>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
            $newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
            break;

        case 'appbrowser':
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';

            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '<ion-footer>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '<ion-grid>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button contactUs phone="' . $addons['contact-call'] . '" phone="' . $addons['contact-call'] . '" sms="' . $addons['contact-sms'] . '" whatsapp="' . $addons['contact-whatsapp'] . '" email="' . $addons['contact-email'] . '" message="{{ dataProduct.name }}" size="small" fill="outline" expand="block" color="primary">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="chatbox-ellipses"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="6">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button appBrowser [url]="dataProduct.permalink" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="globe"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>More</ion-label>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
            $newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";
            break;
        case 'paypal':
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';

            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '<ion-footer>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '<ion-grid>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button contactUs phone="' . $addons['contact-call'] . '" phone="' . $addons['contact-call'] . '" sms="' . $addons['contact-sms'] . '" whatsapp="' . $addons['contact-whatsapp'] . '" email="' . $addons['contact-email'] . '" message="{{ dataProduct.name }}" size="small" fill="outline" expand="block" color="primary">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="chatbox-ellipses"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="6">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button payWithPaypal price="{{ dataProduct.price }}" info="{{ dataProduct.name }}" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="globe"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>Buy Now</ion-label>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";

            $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
            $newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";

            break;
    }


    // TODO: PRODUCTS DETAIL --+-- SCSS
    $newPage['content']['scss'] = null;

    $newPage['content']['scss'] .= "\t" . 'ion-slide {background-size:cover; display:block !important; min-height:150px}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-1x1 {width: 100%;padding-top: 100%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-16x9 {width: 100%;padding-top: 56.25%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-4x3 {width: 100%;padding-top: 75%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-3x2 {width: 100%;padding-top: 66.66%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-8x5 {width: 100%;padding-top: 62.5%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > h2{padding-top:1em;padding-left:1em;padding-right:1em;padding-bottom:0;color: #fff;text-shadow: 1px 1px 1px #777;opacity: .9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > p{padding-top:0;padding-left:1em;color: #fff;opacity: .9;padding-right:1.8rem;text-shadow: 1px 1px 1px #777;}' . "\r\n";

    // TODO: PRODUCTS DETAIL --+-- OTHER
    $newPage['code']['init'] = null;
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '//init' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'product: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataProduct: any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PRODUCTS DETAIL --|-- TS --|-- getProduct()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . 'Detail.getProduct(productId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getProduct(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.product = this.' . $varUserServiceName . '.getProduct(this.productId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.product.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataProduct = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PRODUCTS DETAIL --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . 'Detail.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProduct = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProduct();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PRODUCTS DETAIL --|-- TS --|-- showAlert()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . 'Detail.showAlert()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    switch ($addons['order-via'])
    {
        case 'coding':
            // TODO: PRODUCTS DETAIL --|-- TS --|-- addToCart()
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $varPageName . 'Detail.addToCart(id,name,price)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'addToCart(id,name,price){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let header = name ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let subheader = "Please write the code manually!" ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let message = "The product has been successfully added to the shopping cart!<br/>Price: " + price ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.showAlert(header,subheader,message);' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            // TODO: PRODUCTS DETAIL --|-- TS --|-- addToCart()
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $varPageName . 'Detail.buyNow(id,name,price)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'buyNow(id,name,price){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let header = name ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let subheader = "Please write the code manually!" ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let message = "You will buy this product!<br/>Price: " + price ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.showAlert(header,subheader,message);' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            break;
    }


    // TODO: PRODUCTS DETAIL --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $varPageName . 'Detail.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataProduct = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getProduct();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    //generate page code
    $db->savePage($newPage);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=woocommerce-products&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('woocommerce-products', $current_page_target);
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
    $current_setting['page-content-background'] = 'assets/images/background/bg.jpg';
}

if (!isset($current_setting['wordpress-url']))
{
    $current_setting['wordpress-url'] = '';
}

if (!isset($current_setting['consumer-key']))
{
    $current_setting['consumer-key'] = '';
}

if (!isset($current_setting['consumer-secret']))
{
    $current_setting['consumer-secret'] = '';
}

if (!isset($current_setting['per-page']))
{
    $current_setting['per-page'] = '10';
}

if (!isset($current_setting['category-id']))
{
    $current_setting['category-id'] = '0';
}

if (!isset($current_setting['order-via']))
{
    $current_setting['order-via'] = 'browser';
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

$content .= '<div class="callout callout-default">'.__e('Please complete the form below to let us know how we can help you build code:').'</div>';
 // TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="woocommerce-products[page-target]" class="form-control" >';
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
$content .= '<input  id="page-title" type="text" name="woocommerce-products[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="woocommerce-products[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="woocommerce-products[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- WORDPRESS-URL
$content .= '<div id="field-wordpress-url" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-wordpress-url">' . __e('WordPress URL') . '</label>';
$content .= '<input id="page-wordpress-url" type="url" name="woocommerce-products[wordpress-url]" class="form-control" placeholder="https://yourwordpress.com/"  value="' . $current_setting['wordpress-url'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Your wordpress site address, only works on websites that have ssl <code>https://</code>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- CONSUMER-KEY
$content .= '<div id="field-consumer-key" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-consumer-key">' . __e('Consumer Key') . '</label>';
$content .= '<input id="page-consumer-key" type="text" name="woocommerce-products[consumer-key]" class="form-control" placeholder="ck_d89859096d0cbec7dca675ca61e78dee675c0e32"  value="' . $current_setting['consumer-key'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('This value is obtained from WooCommerce -&raquo; Settings -&raquo; Advanced -&raquo; REST API, readmore: <a target="_blank" href="https://docs.woocommerce.com/document/woocommerce-rest-api/">WooCommerce REST API</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- CONSUMER-SECRET
$content .= '<div id="field-consumer-secret" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-consumer-secret">' . __e('Consumer Secret') . '</label>';
$content .= '<input id="page-consumer-secret" type="text" name="woocommerce-products[consumer-secret]" class="form-control" placeholder="cs_b3e7c815725fb9d5dc899b524053d1bf23aaa060"  value="' . $current_setting['consumer-secret'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('This value is obtained from WooCommerce -&raquo; Settings -&raquo; Advanced -&raquo; REST API, readmore: <a target="_blank" href="https://docs.woocommerce.com/document/woocommerce-rest-api/">WooCommerce REST API</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PER-PAGE
$content .= '<div id="field-per-page" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-per-page">' . __e('Per Page') . '</label>';
$content .= '<input id="page-per-page" type="text" name="woocommerce-products[per-page]" class="form-control" placeholder="10"  value="' . $current_setting['per-page'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Filter the number of items per page to show') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- CATEGORY-ID
$content .= '<div id="field-category-id" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-category-id">' . __e('Category ID') . '</label>';
$content .= '<input id="page-category-id" type="text" name="woocommerce-products[category-id]" class="form-control" placeholder="-1"  value="' . $current_setting['category-id'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Category ID from <strong>WooCommerce Categories</strong> : https://yourwp/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product, you can see on tag_ID on the URL') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- ORDER-VIA
$options = array();
$options[] = array('value' => 'coding', 'label' => 'Manual Coding');
$options[] = array('value' => 'browser', 'label' => 'System Browser');
$options[] = array('value' => 'appbrowser', 'label' => 'AppBrowser');
$options[] = array('value' => 'paypal', 'label' => 'PayPal (required: `Pay With PayPal` Directives)');

$content .= '<div id="field-order-via" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-order-via">' . __e('Order Via') . '</label>';
$content .= '<select id="page-order-via" name="woocommerce-products[order-via]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['order-via'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('To activate the pay with paypal menu, please activate <strong>payWithPaypal directive</strong> in the directives page') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div><!-- ./row -->';

$content .= '<hr/>';
$content .= '<label>' . __e('Contact Us') . '</label>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- CONTACT-CALL
$content .= '<div id="field-contact-call" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-call">' . __e('Call') . '</label>';
$content .= '<input id="page-contact-call" type="text" name="woocommerce-products[contact-call]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-call'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the telephone number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTACT-SMS
$content .= '<div id="field-contact-sms" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-sms">' . __e('SMS') . '</label>';
$content .= '<input id="page-contact-sms" type="text" name="woocommerce-products[contact-sms]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-sms'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the phone number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTACT-WHATSAPP
$content .= '<div id="field-contact-whatsapp" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-whatsapp">' . __e('WhatsApp') . '</label>';
$content .= '<input id="page-contact-whatsapp" type="text" name="woocommerce-products[contact-whatsapp]" class="form-control" placeholder="628123456789"  value="' . $current_setting['contact-whatsapp'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the WhatsApp number') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- CONTACT-EMAIL
$content .= '<div id="field-contact-email" class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-contact-email">' . __e('Email') . '</label>';
$content .= '<input id="page-contact-email" type="text" name="woocommerce-products[contact-email]" class="form-control" placeholder="cs@ihsana.com"  value="' . $current_setting['contact-email'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write down the email address') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

$content .= '</div><!-- ./row -->';

$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-woocommerce-products" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<a href="./?p=addons&amp;addons=woocommerce-products&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=woocommerce-products&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=woocommerce-products&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=woocommerce-products&page-target="+$("#page-target").val(),!1});';
