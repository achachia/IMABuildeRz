<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `json-scraping-for-single-data`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("json-scraping-for-single-data");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('json-scraping-for-single-data', $current_page_target);
    header('Location: ./?p=addons&addons=json-scraping-for-single-data&' . time());
}

// TODO: POST
if (isset($_POST['save-json-scraping-for-single-data']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['json-scraping-for-single-data']['page-title']);
    $addons['page-header-color'] = trim($_POST['json-scraping-for-single-data']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['json-scraping-for-single-data']['page-content-background']);
    $addons['json-url'] = trim($_POST['json-scraping-for-single-data']['json-url']);
    $addons['1st-var'] = trim($_POST['json-scraping-for-single-data']['1st-var']);
    $addons['template'] = trim($_POST['json-scraping-for-single-data']['template']);


    $z = 0;
    foreach ($_POST['json-scraping-for-single-data']['vars'] as $var)
    {
        if ($var['var'] !== '')
        {
            $addons['vars'][$z]['var'] = htmlentities($var['var']);
            $addons['vars'][$z]['type'] = htmlentities($var['type']);
            $addons['vars'][$z]['label'] = addslashes($var['label']);
            $z++;
        }
    }


    $db->saveAddOns('json-scraping-for-single-data', $addons);


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


    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'urlDetailItem : string = "' . $addons['json-url'] . '";' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* getItem()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getItem(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let apiUrl = this.urlDetailItem;' . "\r\n";
    $service['code']['other'] .= "\t\t" . '//console.log("apiUrl", apiUrl);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(apiUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
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


    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* presentLoading()' . "\r\n";
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
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* showToast()' . "\r\n";
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
    $service['code']['other'] .= "\t" . '* showAlert()' . "\r\n";
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
    $db->saveService($service, $current_page_target);


    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'json-scraping-for-single-data';
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

    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][1]['var'] = $string->toUserClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][1]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';
    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= '' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";


    $tags = null;
    foreach ($addons['vars'] as $item_var)
    {
        $rootVar = 'data' . $string->toClassName($addons['page-target']);
        $varName = $rootVar . '.' . $item_var['var'];

        $ngIf = '*ngIf="' . $varName . '"';
        $tags .= "\t\t\t" . '<!-- ' . strtolower(htmlentities($item_var['type'])) . ' : `' . $varName . '`  -->' . "\r\n";
        switch ($item_var['type'])
        {

                // TODO: POST --|-- PAGE -- ITEM DETAIL - TEXT
            case 'text':
                $tags .= "\t\t\t" . '{{ ' . $varName . ' }}' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - NUMBER
            case 'number':
                $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                $tags .= "\t\t\t" . '{{ ' . $varName . ' |number:\'1.0-3\' }}' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - DATE
            case 'date':
                $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                $tags .= "\t\t\t" . '{{ ' . $varName . ' |date:\'fullDate\' }}' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CURRENCY
            case 'currency':
                $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/CurrencyPipe -->' . "\r\n";
                $tags .= "\t\t\t" . '{{ ' . $varName . ' | currency:\'' . $addons['currency-symbol'] . '\' }}' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - IMAGE
            case 'image':
                $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '" />' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - LABEL-HEADING
            case 'label-heading':
                $tags .= "\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t" . '<h3 [innerHTML]="' . $varName . '"></h3>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - LABEL-PARAGRAPH
            case 'label-paragraph':
                $tags .= "\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t" . '<p [innerHTML]="' . $varName . '"></p>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - LABEL-NUMBER
            case 'label-number':
                $tags .= "\t\t\t" . '<ion-label>' . "\r\n";
                $tags .= "\t\t\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                $tags .= "\t\t\t\t" . '<p>{{ ' . $varName . '|number:\'1.0-3\' }}</p>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - LABEL-DATE
            case 'label-date':
                $tags .= "\t\t\t" . '<ion-label>' . "\r\n";
                $tags .= "\t\t\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                $tags .= "\t\t\t\t" . '<p>{{ ' . $varName . '|date:\'fullDate\' }}</p>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - LABEL-CURRENCY
            case 'label-currency':
                $tags .= "\t\t\t" . '<ion-label>' . "\r\n";
                $tags .= "\t\t\t\t" . '<!-- reference: https://angular.io/api/common/CurrencyPipe -->' . "\r\n";
                $tags .= "\t\t\t\t" . '<p>{{ ' . $varName . '|currency:\'USD\' }}</p>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - BADGE-START
            case 'badge-start':
                $tags .= "\t\t\t" . '<ion-badge slot="start" ' . $ngIf . '>{{ ' . $varName . ' }}</ion-badge>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - BADGE-END
            case 'badge-end':
                $tags .= "\t\t\t" . '<ion-badge slot="end" ' . $ngIf . '>{{ ' . $varName . ' }}</ion-badge>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - ICON-START
            case 'icon-start':
                $tags .= "\t\t\t" . '<ion-icon slot="start" color="primary" ' . $ngIf . ' [name]="' . $varName . '"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t" . '<ion-icon slot="start" color="primary" *ngIf="!' . $varName . '" name="star"></ion-icon>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - ICON-END
            case 'icon-end':
                $tags .= "\t\t\t" . '<ion-icon slot="end" color="primary" ' . $ngIf . ' [name]="' . $varName . '"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t" . '<ion-icon slot="end" color="primary" *ngIf="!' . $varName . '" name="star"></ion-icon>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - BADGE-START
            case 'note-start':
                $tags .= "\t\t\t" . '<ion-note slot="start" ' . $ngIf . '>{{ ' . $varName . ' }}</ion-note>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - BADGE-END
            case 'note-end':
                $tags .= "\t\t\t" . '<ion-note slot="end" ' . $ngIf . '>{{ ' . $varName . '}}</ion-note>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - AVATAR
            case 'avatar':
                $tags .= "\t\t\t" . '<ion-avatar>' . "\r\n";
                $tags .= "\t\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '" />' . "\r\n";
                $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - AVATAR-START
            case 'avatar-start':
                $tags .= "\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
                $tags .= "\t\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '" />' . "\r\n";
                $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - AVATAR-END
            case 'avatar-end':
                $tags .= "\t\t\t" . '<ion-avatar slot="end">' . "\r\n";
                $tags .= "\t\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '" />' . "\r\n";
                $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - THUMBNAIL-START
            case 'thumbnail-start':
                $tags .= "\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
                $tags .= "\t\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '" />' . "\r\n";
                $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - THUMBNAIL-END
            case 'thumbnail-end':
                $tags .= "\t\t\t" . '<ion-thumbnail slot="end">' . "\r\n";
                $tags .= "\t\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '" />' . "\r\n";
                $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-HEADER-TITLE
            case 'card-header-title':
                $tags .= "\t\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-card-title [innerHTML]="' . $varName . '"></ion-card-title>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-header>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-HEADER-SUBTITLE
            case 'card-header-subtitle':
                $tags .= "\t\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-card-subtitle [innerHTML]="' . $varName . '"></ion-card-subtitle>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-header>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-HEADER-SUBTITLE-DATE
            case 'card-header-subtitle-date':
                $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                $tags .= "\t\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-card-subtitle>{{ ' . $varName . '|date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-header>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-HEADER-SUBTITLE-NUMBER
            case 'card-header-subtitle-number':
                $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                $tags .= "\t\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-card-subtitle>{{ ' . $varName . '|number:\'1.0-3\' }}</ion-card-subtitle>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-header>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-HEADER-SUBTITLE-CURRENCY
            case 'card-header-subtitle-currency':
                $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                $tags .= "\t\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-card-subtitle>{{ ' . $varName . ' | currency:\'' . $addons['currency-symbol'] . '\' }}</ion-card-subtitle>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-header>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-CONTENT
            case 'card-content':
                $tags .= "\t\t\t" . '<ion-card-content ' . $ngIf . ' [innerHTML]="' . $varName . '"></ion-card-content>' . "\r\n";
                break;


                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-THUMBNAIL
            case 'card-item-thumbnail':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-thumbnail ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-THUMBNAIL-START
            case 'card-item-thumbnail-start':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-thumbnail slot="start" ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-THUMBNAIL-END
            case 'card-item-thumbnail-end':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-thumbnail slot="end" ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;


                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-AVATAR
            case 'card-item-avatar':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-avatar ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-AVATAR-START
            case 'card-item-avatar-start':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-avatar slot="start" ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-AVATAR-END
            case 'card-item-avatar-end':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-avatar slot="end" ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-LABEL
            case 'card-item-label':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '{{ ' . $varName . ' }}' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-ITEM-LABEL-HEADING
            case 'card-item-label-heading':
                $tags .= "\t\t\t" . '<ion-item>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<h3>{{ ' . $varName . ' }}</h3>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;


                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-CONTENT-IMAGE
            case 'card-content-image':
                $tags .= "\t\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t" . '<img [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-content>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-CONTENT-VIDEO
            case 'card-content-video':
                $tags .= "\t\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t" . '<video controls>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<source [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t\t" . 'Your browser does not support the video tag' . "\r\n";
                $tags .= "\t\t\t\t" . '</video>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-content>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-CONTENT-AUDIO
            case 'card-content-audio':
                $tags .= "\t\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t" . '<audio controls>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<source [src]="' . $varName . ' | trustResourceUrl" />' . "\r\n";
                $tags .= "\t\t\t\t\t" . 'Your browser does not support the audio element' . "\r\n";
                $tags .= "\t\t\t\t" . '</audio>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-content>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - CARD-CONTENT-IFRAME
            case 'card-content-iframe':
                $tags .= "\t\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                $tags .= "\t\t\t\t" . '<iframe [src]="' . $varName . ' | trustResourceUrl"></iframe> ' . "\r\n";
                $tags .= "\t\t\t" . '</ion-card-content>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-LIST-HEADER-LABEL
            case 'item-list-header-label':
                $tags .= "\t\t\t" . '<ion-list-header ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label [innerHTML]="' . $varName . '"></ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-list-header>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-LABEL
            case 'item-label':
                $tags .= "\t\t\t" . '<ion-item ' . $ngIf . ' >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label [innerHTML]="' . $varName . '"></ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-IN-APP-BROWSER
            case 'item-in-app-browser':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' appBrowser [url]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-APP-WEBVIEW
            case 'item-app-webview':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' appWebview [url]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-SYSTEM-BROWSER
            case 'item-system-browser':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' systemBrowser [url]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-EMAIL-APP
            case 'item-email-app':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' mailApp [emailAddress]="' . $varName . '" emailSubject="subject" emailMessage="' . ($item_var['label']) . '">' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="at" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>{{ ' . $varName . ' }}</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-SMS-APP
            case 'item-sms-app':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' smsApp [phoneNumber]="' . $varName . '" shortMessage="' . ($item_var['label']) . '">' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="mail" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>{{ ' . $varName . ' }}</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-CALL-APP
            case 'item-call-app':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' callApp [phoneNumber]="' . $varName . '">' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="call" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>{{ ' . $varName . ' }}</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-GEO-APP
            case 'item-geo-app':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' geoApp [location]="' . $varName . '" [query]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="locate" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-SOCIAL-SHARE
            case 'item-social-share':
                $tags .= "\t\t\t" . '<ion-row ' . $ngIf . '>' . "\r\n";

                $tags .= "\t\t\t\t" . '<!-- fb share - remove this line' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-col>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" facebookApp [url]="' . $varName . '"><ion-icon slot="icon-only" name="logo-facebook"></ion-icon></ion-button>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-col>' . "\r\n";
                $tags .= "\t\t\t\t" . 'fb share - remove this line -->' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-col>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" twitterApp message="{{ ' . $varName . ' }}"><ion-icon slot="icon-only" name="logo-twitter"></ion-icon></ion-button>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-col>' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-col>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="success" whatsappApp message="{{ ' . $varName . ' }}"><ion-icon slot="icon-only" name="logo-whatsapp"></ion-icon></ion-button>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-col>' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-col>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" lineApp message="{{ ' . $varName . ' }}"><ion-icon slot="icon-only" name="chatbubbles"></ion-icon></ion-button>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-col>' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-col>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="danger" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ ' . $varName . ' }}"><ion-icon slot="icon-only" name="mail-open"></ion-icon></ion-button>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-col>' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-col>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" smsApp phoneNumber="0123456789" [shortMessage]="' . $varName . '"><ion-icon slot="icon-only" name="send"></ion-icon></ion-button>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-col>' . "\r\n";


                $tags .= "\t\t\t" . '</ion-row>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-SOCIAL-SHARE-FAB
            case 'item-social-share-fab':

                $tags .= "\t\t\t" . '<ion-fab ' . $ngIf . ' horizontal="end" vertical="bottom" slot="fixed">' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-fab-button color="tertiary">' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-icon name="share"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                $tags .= "\t\t\t\t" . '<ion-fab-list side="top">' . "\r\n";

                $tags .= "\t\t\t\t\t" . '<!-- fb share - remove this line' . "\r\n";
                $tags .= "\t\t\t\t\t" . '<ion-fab-button color="primary" facebookApp [url]="' . $varName . '">' . "\r\n";
                $tags .= "\t\t\t\t\t\t" . '<ion-icon name="logo-facebook"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";
                $tags .= "\t\t\t\t\t" . 'fb share - remove this line -->' . "\r\n";

                $tags .= "\t\t\t\t\t" . '<ion-fab-button color="secondary" twitterApp [message]="' . $varName . '">' . "\r\n";
                $tags .= "\t\t\t\t\t\t" . '<ion-icon name="logo-twitter"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                $tags .= "\t\t\t\t\t" . '<ion-fab-button color="success" whatsappApp [message]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                $tags .= "\t\t\t\t\t" . '<ion-fab-button color="primary" lineApp [message]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t\t\t" . '<ion-icon name="chatbubbles"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                $tags .= "\t\t\t\t\t" . '<ion-fab-button color="secondary" mailApp emailAddress="user@domain.com" [emailSubject]="hi" [emailMessage]="' . $varName . '">' . "\r\n";
                $tags .= "\t\t\t\t\t\t" . '<ion-icon name="mail-open"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                $tags .= "\t\t\t\t\t" . '<ion-fab-button color="danger" smsApp phoneNumber="0123456789" [shortMessage]="' . $varName . '">' . "\r\n";
                $tags .= "\t\t\t\t\t\t" . '<ion-icon name="send"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                $tags .= "\t\t\t\t" . '</ion-fab-list>' . "\r\n";

                $tags .= "\t\t\t" . '</ion-fab>' . "\r\n";

                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - ITEM-TEXT-TO-SPEECH
            case 'native-text-to-speech':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' textToSpeech locale="' . $current_app['apps']['app-locale'] . '" [text]="' . $varName . '" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="megaphone" slot="start" color="primary"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;


                // TODO: POST --|-- PAGE -- ITEM DETAIL - STREAMING-MEDIA-VIDEO-PLAYER
            case 'native-streaming-media-video-player':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' streamingMedia format="video" orientation="landscape" controls="false" url="{{ ' . $varName . ' }}" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="arrow-dropright-circle" slot="start" color="primary"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - STREAMING-MEDIA-AUDIO-PLAYER
            case 'native-streaming-media-audio-player':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' streamingMedia format="audio" url="{{ ' . $varName . ' }}" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="arrow-dropright-circle" slot="start" color="primary"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - PLAY-WITH-YOUTUBE-APP
            case 'play-with-youtube-app':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' playWithYoutubeApp videoId="{{ ' . $varName . ' }}" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="logo-youtube" color="danger" slot="start"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;


                // TODO: POST --|-- PAGE -- ITEM DETAIL - PAY-WITH-PAYPAL
            case 'native-pay-with-paypal':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' payWithPaypal price="{{ ' . $varName . ' }}" info="{{ ' . $varName . '.' . $addons['search-by'] . ' | stripTags }}" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="cash" slot="start" color="tertiary"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

                // TODO: POST --|-- PAGE -- ITEM DETAIL - INSTAGRAM-APP
            case 'native-instagram-app':
                $tags .= "\t\t\t" . '<ion-item button ' . $ngIf . ' instagramApp image="{{ ' . $varName . ' }}" >' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-icon name="logo-instagram" slot="start" color="danger"></ion-icon>' . "\r\n";
                $tags .= "\t\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                $tags .= "\t\t\t" . '</ion-item>' . "\r\n";
                break;

        }
        $tags .= "\t\t" . '' . "\r\n";
    }

    // TODO: POST --|-- PAGE --|-- TEMPLATE
    switch ($addons['template'])
    {
        case 'print':

            $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<pre>{{ data' . $string->toClassName($addons['page-target']) . ' | json }}</pre>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

            $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '}' . "\r\n";


            break;
        case 'card':


            $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= $tags;
            $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

            $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

            break;

        case 'list':

            $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
            $newPage['content']['html'] .= $tags;
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


            break;

    }


    // TODO: POST --|-- PAGE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . $string->toUserClassName($current_page_target) . ': Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'data' . $string->toClassName($current_page_target) . ': any = [];' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE --|-- TS --|-- getItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:getItem()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getItem(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . ' = this.' . $string->toUserClassName($current_page_target) . 'Service.getItem();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . '.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.data' . $string->toClassName($current_page_target) . ' = data' . $addons['1st-var'] . ' ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE --|-- TS --|-- getItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";

    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . ' = this.' . $string->toUserClassName($current_page_target) . 'Service.getItem();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . '.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.data' . $string->toClassName($current_page_target) . ' = data' . $addons['1st-var'] . ' ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";

    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";

    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: POST --|-- PAGE --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItem();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['init'] = null;


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=json-scraping-for-single-data&page-target=' . $addons['page-target'] . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('json-scraping-for-single-data', $current_page_target);
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

if (!isset($current_setting['json-url']))
{
    $current_setting['json-url'] = '';
}

if (!isset($current_setting['1st-var']))
{
    $current_setting['1st-var'] = '';
}

if (!isset($current_setting['template']))
{
    $current_setting['template'] = '';
}

if (isset($_GET['varlist']))
{
    if (substr($current_setting['json-url'], 0, 4) == 'http')
    {

    } else
    {
        $current_setting['json-url'] = 'http://localhost:' . $current_app['apps']['imabuilder']['emulator-port'] . '/' . $current_setting['url-list-item'];
    }

    $json2array = new Json2Array();
    $url_test_json = str_replace('{id}', '1', $current_setting['json-url']);
    $varlists = $json2array->exec($url_test_json);
    $new_vars = array();
    foreach ($varlists as $varlist)
    {
        $new_vars[] = str_replace(substr($current_setting['1st-var'], 1, strlen($current_setting['1st-var'])) . '.', '', $varlist);
    }


    $_SESSION['CURRENT_APP_TEMP']['pages'][$current_page_target]['varslist'] = $new_vars;
    header('Location: ./?p=addons&addons=json-scraping-for-single-data&page-target=' . $current_page_target . '&' . time());
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
//$content .= '<div class="callout callout-danger">' . __e('This plugin is not yet usable, still in the coding stage!') . '</div>';
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="json-scraping-for-single-data[page-target]" class="form-control" >';
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
$content .= '<input  id="page-title" type="text" name="json-scraping-for-single-data[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="json-scraping-for-single-data[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="json-scraping-for-single-data[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- JSON URL
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-json-url">' . __e('JSON URL') . '</label>';
$content .= '<input id="page-json-url" type="url" name="json-scraping-for-single-data[json-url]" class="form-control" placeholder="https://ihsana.net/restapi.php?api=products&product-id=1"  value="' . $current_setting['json-url'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('For JSON installed on the Online Server, you must use SSL (https://) and for local (offline app) do not use https/http') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- 1ST VARIABLE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-1st-var">' . __e('1st Variable') . '</label>';
$content .= '<input id="page-1st1st-var" type="text" name="json-scraping-for-single-data[1st-var]" class="form-control" placeholder=""  value="' . $current_setting['1st-var'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Fill blank for default, <code>{item:{...}}</code> then you must fill <code>.item</code>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- TEMPLATE
$options = array();
$options[] = array('value' => 'print', 'label' => 'Print');
$options[] = array('value' => 'card', 'label' => 'Card');
$options[] = array('value' => 'list', 'label' => 'List');

$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-template">' . __e('Template') . '</label>';
$content .= '<select id="page-template" name="json-scraping-for-single-data[template]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['template'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . strtolower($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please delete the layout you want') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-json-scraping-for-single-data" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-danger">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Variables for Layout') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";
$content .= '<div class="row">' . "\r\n";

$content .= '<div class="col-md-12">' . "\r\n";

$content .= '<a class="btn btn-sm btn-flat btn-info" href="./?p=addons&amp;addons=json-scraping-for-single-data&amp;page-target=' . $current_page_target . '&amp;varlist">' . "\r\n";
$content .= '<i class="fa fa-globe"></i> ' . __e('Get All Variables ') . '' . "\r\n";
$content .= '</a>' . "\r\n";

if (!isset($current_setting['vars']))
{
    $max_vars = 1;
} else
{
    $max_vars = count($current_setting['vars']);
}


$option_var_types[] = array('label' => 'RAW : Text', 'value' => 'text');
$option_var_types[] = array('label' => 'RAW : Number', 'value' => 'number');
$option_var_types[] = array('label' => 'RAW : Date', 'value' => 'date');
$option_var_types[] = array('label' => 'RAW : Currency', 'value' => 'currency');
$option_var_types[] = array('label' => 'RAW : Image', 'value' => 'image');


$option_var_types[] = array('label' => 'Item : Label : Heading', 'value' => 'label-heading');
$option_var_types[] = array('label' => 'Item : Label : Paragraph', 'value' => 'label-paragraph');
$option_var_types[] = array('label' => 'Item : Label : Number', 'value' => 'label-number');
$option_var_types[] = array('label' => 'Item : Label : Date', 'value' => 'label-date');
$option_var_types[] = array('label' => 'Item : Label : Currency', 'value' => 'label-currency');

$option_var_types[] = array('label' => 'Item : Badge : Start', 'value' => 'badge-start');
$option_var_types[] = array('label' => 'Item : Badge : End', 'value' => 'badge-end');
$option_var_types[] = array('label' => 'Item : Note : Start', 'value' => 'note-start');
$option_var_types[] = array('label' => 'Item : Note : End', 'value' => 'note-end');
$option_var_types[] = array('label' => 'Item : Avatar', 'value' => 'avatar');
$option_var_types[] = array('label' => 'Item : Avatar : Start', 'value' => 'avatar-start');
$option_var_types[] = array('label' => 'Item : Avatar : End', 'value' => 'avatar-end');
$option_var_types[] = array('label' => 'Item : Icon : Start', 'value' => 'icon-start');
$option_var_types[] = array('label' => 'Item : Icon : End', 'value' => 'icon-end');
$option_var_types[] = array('label' => 'Item : Thumbnail : Start', 'value' => 'thumbnail-start');
$option_var_types[] = array('label' => 'Item : Thumbnail : End', 'value' => 'thumbnail-end');


$option_var_types[] = array('label' => 'Card : Header : Title', 'value' => 'card-header-title');
$option_var_types[] = array('label' => 'Card : Header : Subtitle', 'value' => 'card-header-subtitle');
$option_var_types[] = array('label' => 'Card : Header : Subtitle : Date', 'value' => 'card-header-subtitle-date');
$option_var_types[] = array('label' => 'Card : Header : Subtitle : Number', 'value' => 'card-header-subtitle-number');
$option_var_types[] = array('label' => 'Card : Header : Subtitle : Currency', 'value' => 'card-header-subtitle-currency');
$option_var_types[] = array('label' => 'Card : Content : HTML', 'value' => 'card-content');
$option_var_types[] = array('label' => 'Card : Content : HTML5 : Image', 'value' => 'card-content-image');
$option_var_types[] = array('label' => 'Card : Content : HTML5 : Video', 'value' => 'card-content-video');
$option_var_types[] = array('label' => 'Card : Content : HTML5 : Audio', 'value' => 'card-content-audio');
$option_var_types[] = array('label' => 'Card : Content : HTML5 : Iframe', 'value' => 'card-content-iframe');

$option_var_types[] = array('label' => '*Card : Item : Avatar', 'value' => 'card-item-avatar');
$option_var_types[] = array('label' => '*Card : Item : Avatar : Start', 'value' => 'card-item-avatar-start');
$option_var_types[] = array('label' => '*Card : Item : Avatar : End', 'value' => 'card-item-avatar-end');

$option_var_types[] = array('label' => '*Card : Item : Thumbnail', 'value' => 'card-item-thumbnail');
$option_var_types[] = array('label' => '*Card : Item : Thumbnail : Start', 'value' => 'card-item-thumbnail-start');
$option_var_types[] = array('label' => '*Card : Item : Thumbnail : End', 'value' => 'card-item-thumbnail-end');

$option_var_types[] = array('label' => '*Card : Item : Label', 'value' => 'card-item-label');
$option_var_types[] = array('label' => '*Card : Item : Label : Heading', 'value' => 'card-item-label-heading');


$option_var_types[] = array('label' => 'Card : Item : Open With : App Browser', 'value' => 'item-in-app-browser');
$option_var_types[] = array('label' => 'Card : Item : Open With : App Webview', 'value' => 'item-app-webview');
$option_var_types[] = array('label' => 'Card : Item : Open With : System Browser', 'value' => 'item-system-browser');
$option_var_types[] = array('label' => 'Card : Item : Open With : Email Apps', 'value' => 'item-email-app');
$option_var_types[] = array('label' => 'Card : Item : Open With : SMS Apps', 'value' => 'item-sms-app');
$option_var_types[] = array('label' => 'Card : Item : Open With : Call Apps', 'value' => 'item-call-app');
$option_var_types[] = array('label' => 'Card : Item : Open With : GEO Apps', 'value' => 'item-geo-app');

$option_var_types[] = array('label' => 'Card : Item : Open With : Social Share (Fab Button)', 'value' => 'item-social-share-fab');
$option_var_types[] = array('label' => 'Card : Item : Open With : Social Share', 'value' => 'item-social-share');


$current_directives = $_SESSION['CURRENT_APP']['directives'];

if (isset($current_directives['streaming-media']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Streaming Media : Video Player', 'value' => 'native-streaming-media-video-player');
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Streaming Media : Audio Player', 'value' => 'native-streaming-media-audio-player');
}

if (isset($current_directives['play-with-youtube-app']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Play With Youtube App', 'value' => 'play-with-youtube-app');
}

if (isset($current_directives['text-to-speech']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Text To Speak', 'value' => 'native-text-to-speech');
}

if (isset($current_directives['pay-with-paypal']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Pay With PayPal', 'value' => 'native-pay-with-paypal');
}

if (isset($current_directives['instagram-app']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Share Via Instagram App (Image: DataURL/Canvas)', 'value' => 'native-instagram-app');
}


$var_items = array();
if (isset($_SESSION['CURRENT_APP_TEMP']['pages'][$current_page_target]['varslist']))
{
    if (is_array($_SESSION['CURRENT_APP_TEMP']['pages'][$current_page_target]['varslist']))
    {
        foreach ($_SESSION['CURRENT_APP_TEMP']['pages'][$current_page_target]['varslist'] as $var)
        {
            $var_items[] = $var;
        }
    }
}

$content .= '<table class="table table-striped no-margin no-padding" >' . "\r\n";
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '<th>' . __e('Variable') . '</th>' . "\r\n";
$content .= '<th>' . __e('Label') . '</th>' . "\r\n";
$content .= '<th>' . __e('Type') . '</th>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody id="var-lists">' . "\r\n";
for ($z = 0; $z <= $max_vars; $z++)
{
    $var_value = '';
    if (isset($current_setting['vars'][$z]['var']))
    {
        $var_value = $current_setting['vars'][$z]['var'];
    }

    $disable_move = '';
    $icon_move = '<i class="glyphicon glyphicon-move"></i>';


    $html_var_name = null;
    $html_var_name .= '<select class="autocomplete" name="json-scraping-for-single-data[vars][' . $z . '][var]" >' . "\r\n";
    $is_custom_typing = true;
    foreach ($var_items as $var_item)
    {
        $selected = '';
        if ($var_value == $var_item)
        {
            $selected = 'selected';
            $is_custom_typing = false;
        }
        $html_var_name .= '<option value="' . $var_item . '" ' . $selected . '>' . $var_item . '</option>' . "\r\n";
    }
    if ($is_custom_typing == true)
    {
        $html_var_name .= '<option value="' . $var_value . '" selected>' . $var_value . '</option>' . "\r\n";
    }
    $html_var_name .= '</select>' . "\r\n";

    $label_value = '';
    if (isset($current_setting['vars'][$z]['label']))
    {
        $label_value = $current_setting['vars'][$z]['label'];
    }
    $html_var_label = null;
    $html_var_label = '<input type="text" class="form-control" name="json-scraping-for-single-data[vars][' . $z . '][label]" value="' . htmlentities($label_value) . '" />' . "\r\n";

    $var_type = 'text';
    if (isset($current_setting['vars'][$z]['type']))
    {
        $var_type = $current_setting['vars'][$z]['type'];
    }
    $html_var_type = null;
    $html_var_type .= '<select class="form-control" name="json-scraping-for-single-data[vars][' . $z . '][type]" >' . "\r\n";
    foreach ($option_var_types as $option_var_type)
    {
        $selected = '';
        if ($option_var_type['value'] == $var_type)
        {
            $selected = 'selected';
        }
        $html_var_type .= '<option value="' . $option_var_type['value'] . '" ' . $selected . '>' . $option_var_type['label'] . '</option>' . "\r\n";
    }
    $html_var_type .= '</select>' . "\r\n";


    // TODO: LAYOUT --|-- FORM --|-- VAR OPTION VARS --|-- VARTYPE
    $var_type = 'text';
    if (isset($current_setting['vars'][$z]['type']))
    {
        $var_type = $current_setting['vars'][$z]['type'];
    }
    $html_var_type = null;
    $html_var_type .= '<select class="form-control" name="json-scraping-for-single-data[vars][' . $z . '][type]">' . "\r\n";
    foreach ($option_var_types as $option_var_type)
    {
        $selected = '';
        if ($option_var_type['value'] == $var_type)
        {
            $selected = 'selected';
        }
        $html_var_type .= '<option value="' . $option_var_type['value'] . '" ' . $selected . '>' . $option_var_type['label'] . '</option>' . "\r\n";
    }
    $html_var_type .= '</select>' . "\r\n";

    // TODO: LAYOUT --|-- FORM --|-- VARS ITEM
    $content .= '<tr class="var-item" id="item-var-' . $z . '">' . "\r\n";
    $content .= '<td class="text-align v-align move-cursor handle ' . $disable_move . '">' . $icon_move . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_var_name . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_var_label . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_var_type . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . "\r\n";
    $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#item-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
    $content .= '</td>' . "\r\n";
    $content .= '</tr>' . "\r\n";

}
$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";

$content .= '</div>';

$content .= '</div>';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-json-scraping-for-single-data" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<a href="./?p=addons&amp;addons=json-scraping-for-single-data&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=json-scraping-for-single-data&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=json-scraping-for-single-data&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=json-scraping-for-single-data&page-target="+$("#page-target").val(),!1});';
$page_js .= '$("#var-lists").sortable({opacity: 0.5, items: ".var-item",revert: true,placeholder: "sort-highlight",forcePlaceholderSize: false,zIndex: 999999,cancel: ".move-disabled",handle: ".handle",});';
