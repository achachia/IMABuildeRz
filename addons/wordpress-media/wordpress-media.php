<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package `wordpress-media`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("wordpress-media");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('wordpress-media', $current_page_target);
    header('Location: ./?p=addons&addons=wordpress-media&' . time());
}

// TODO: POST
if (isset($_POST['save-wordpress-media']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['wordpress-media']['page-title']);
    $addons['wp-url'] = trim($_POST['wordpress-media']['wp-url']);
    $addons['media-type'] = trim($_POST['wordpress-media']['media-type']);
    $addons['filter-by'] = trim($_POST['wordpress-media']['filter-by']);
    $addons['filter-value'] = trim($_POST['wordpress-media']['filter-value']);
    $addons['layout-type'] = trim($_POST['wordpress-media']['layout-type']);
    $addons['goto-page'] = trim($_POST['wordpress-media']['goto-page']);

    $db->saveAddOns('wordpress-media', $addons);

    $wp_url = $addons['wp-url'];
    $media_type = $addons['media-type'];
    $filter_by = $addons['filter-by'];
    $filter_value = $addons['filter-value'];
    $goto_page = $string->toFileName($addons['goto-page']);


    // TODO: SERVICE

    $service['name'] = $addons['page-target'];
    $service['desc'] = 'This service is to get wordpress posts data';

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


    // TODO: SERVICE LISTING - CODE - OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    //$service['code']['other'] .= "\t" . 'searchTerm = "" ;' . "\r\n";

    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* getMedias()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getMedias(query): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/media/?${param}&_embed`)' . "\r\n";
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


    // TODO: PAGE LISTING --|-- TS --|-- httpBuildQuery()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* httpBuildQuery(obj)' . "\r\n";
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
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, $current_page_target);


    // create properties for page
    // TODO: MEDIA
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $addons['page-target'];
    $newPage['code-by'] = 'wordpress-media';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = 'primary';
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    //$newPage['content']['disable-ion-content'] = true;

    // TODO: MEDIA --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $getClassName = $string->toClassName($current_page_target) . 'Service';
    $varName = $string->toUserClassName($current_page_target) . 'Service';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = $getClassName;
    $newPage['modules']['angular'][$z]['var'] = $varName;
    $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';


    // TODO: PAGE LISTING --|-- MODULES


    $newPage['content']['html'] = null;
    $newPage['content']['scss'] = null;
    $newPage['code']['other'] = null;

    switch ($addons['layout-type'])
    {
        case 'image-gallery-horizontal':
            // TODO: POST --|-- PAGE --|-- CONTENT --|-- GALLERY
            $newPage['content']['html'] = null;
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<ion-slides class="image-slider" loop="true" slidesPerView="2" [options]="{ slidesPerView:3 }">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of dataMedias" imageZoom image="{{ item.media_details.sizes.full.source_url }}">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card class="ion-no-padding ion-no-margin">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="item.media_details.sizes.thumbnail" [src]="item.media_details.sizes.thumbnail.source_url" class="thumb-img" />' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content class="ion-no-padding ion-no-margin">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<p *ngIf="item.title.rendered"><span [innerHTML]="item.title.rendered | readMore:28"></span></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";

            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";

            $newPage['content']['scss'] = null;
            $newPage['content']['scss'] .= 'ion-card{margin:6px}' . "\r\n";
            $newPage['content']['scss'] .= 'ion-card img{width: 100%;}' . "\r\n";
            $newPage['content']['scss'] .= 'ion-card-content{margin:6px}' . "\r\n";

            break;
        case 'image-gallery-vertical':
            // TODO: POST --|-- PAGE --|-- CONTENT --|-- GALLERY
            $newPage['content']['html'] = null;
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataMedias">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<div class="image-container" *ngFor="let item of dataMedias">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<a *ngIf="item.media_details.sizes.full" imageZoom image="{{ item.media_details.sizes.full.source_url }}"><img class="image" [src]="item.media_details.sizes.full.source_url" /></a>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";

            $newPage['content']['scss'] = null;
            $newPage['content']['scss'] .= '.image-container, .img{border: 0px !important;padding:0 !important;margin:0 !important;width: 100% !important;}' . "\r\n";

        case 'image-gallery-grid':
            // TODO: POST --|-- PAGE --|-- CONTENT --|-- GALLERY
            $newPage['content']['html'] = null;
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="dataMedias.length != 0" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-col class="ion-no-padding ion-no-margin" size="4" *ngFor="let item of dataMedias">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card class="ion-no-padding ion-no-margin" imageZoom image="{{ item.media_details.sizes.full.source_url }}" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="item.media_details.sizes.thumbnail" [src]="item.media_details.sizes.thumbnail.source_url" />' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content class="ion-no-padding ion-no-margin">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p *ngIf="item.title.rendered"><span [innerHTML]="item.title.rendered | readMore:28"></span></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";


            $newPage['content']['scss'] = null;
            $newPage['content']['scss'] .= 'ion-card{margin:6px}' . "\r\n";
            $newPage['content']['scss'] .= 'ion-card img{width: 100%;}' . "\r\n";
            $newPage['content']['scss'] .= 'ion-card-content{margin:6px}' . "\r\n";


            break;
        case 'slidebox':
            // TODO: POST --|-- PAGE --|-- CONTENT
            $newPage['content']['html'] = null;

            $newPage['content']['enable-fullscreen'] = 1;
            $newPage['content']['enable-padding'] = 1;
            $newPage['content']['disable-scroll'] = 1;

            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-slides pager="false" >' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let slide of dataMedias; let i = index" >' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-toolbar *ngIf="i != (( dataMedias | objectLength  ) -1)">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-buttons slot="end">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button color="primary" [routerDirection]="\'forward\'" [routerLink]="[\'/' . $goto_page . '\']" >Skip</ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-buttons>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-toolbar>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-toolbar *ngIf="i == (( dataMedias | objectLength  ) -1)"></ion-toolbar>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<img  *ngIf="slide.media_details.sizes.full" [src]="slide.media_details.sizes.full.source_url" class="slide-image"/>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<h2 class="slide-title" [innerHTML]="slide.title.rendered"></h2>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<div [innerHTML]="slide.caption.rendered"></div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-button *ngIf="i == (( dataMedias | objectLength  ) -1)" size="large" fill="clear" icon="end" color="primary" [routerDirection]="\'forward\'" [routerLink]="[\'/' . $goto_page . '\']" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . 'Continue' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="arrow-forward"></ion-icon>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";

            $newPage['content']['scss'] = null;
            $newPage['content']['scss'] .= "\t" . '.swiper-slide{' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'display: block;' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '' . "\r\n";
            $newPage['content']['scss'] .= "\t" . 'ion-slide > img {' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'max-height: 50%;' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'max-width: 80%;' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'margin: 18px 0;' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '' . "\r\n";
            $newPage['content']['scss'] .= "\t" . 'ion-slide > h2 {' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'margin-top: 2.8rem;' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
            $newPage['content']['scss'] .= "\t" . 'ion-slide > .swiper-pagination {' . "\r\n";
            $newPage['content']['scss'] .= "\t\t" . 'position: fixed !important;' . "\r\n";
            $newPage['content']['scss'] .= "\t" . '}' . "\r\n";


            break;
    }


    // TODO: POST --|-- PAGE --|-- TS
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . 'dataMedias: any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'medias: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'query = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'per_page:100,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'media_type:"' . $media_type . '",' . "\r\n";
    if ($filter_by != 'none')
    {
        $newPage['code']['other'] .= "\t\t" . '' . $filter_by . ':"' . $filter_value . '"' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '};' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: POST --|-- PAGE --|-- TS -- getMedias()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* getMedias()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getMedias(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.medias = this.' . $varName . '.getMedias(this.query);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.medias.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataMedias = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: POST --|-- PAGE --|-- TS -- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataMedias = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getMedias();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: POST --|-- PAGE --|-- TS -- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataMedias = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getMedias();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=wordpress-media&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('wordpress-media', $current_page_target);
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

if (!isset($current_setting['media-type']))
{
    $current_setting['media-type'] = '';
}

if (!isset($current_setting['filter-by']))
{
    $current_setting['filter-by'] = 'none';
}

if (!isset($current_setting['filter-value']))
{
    $current_setting['filter-value'] = '';
}

if (!isset($current_setting['layout-type']))
{
    $current_setting['layout-type'] = '';
}

if (!isset($current_setting['goto-page']))
{
    $current_setting['goto-page'] = '';
}


// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
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
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="wordpress-media[page-target]" class="form-control">';
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
$content .= '<input id="page-title" type="text" name="wordpress-media[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- WP-URL
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-wp-url">' . __e('WordPress URL') . '</label>';
$content .= '<input id="page-wp-url" type="text" name="wordpress-media[wp-url]" class="form-control" placeholder="http://my-wordpress.com/"  value="' . $current_setting['wp-url'] . '"  ' . $disabled . ' required/>';
$content .= '<p class="help-block">' . __e('Your wordpress site address') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- MEDIA-TYPE
$options = array();
$options[] = array('value' => 'image', 'label' => 'Image');
//$options[] = array('value' => 'audio','label' => 'Audio');

$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-media-type">' . __e('Media Type') . '</label>';
$content .= '<select id="page-media-type" name="wordpress-media[media-type]" class="form-control" ' . $disabled . '/>';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['media-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select the type of media to be displayed') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- FILTER-BY
$options = array();
$options[] = array('value' => 'none', 'label' => 'None');
$options[] = array('value' => 'include', 'label' => 'Include');
$options[] = array('value' => 'search', 'label' => 'Search');
$options[] = array('value' => 'author', 'label' => 'Author');
$options[] = array('value' => 'exclude', 'label' => 'Exclude');


$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-filter-by">' . __e('Filter By') . '</label>';
$content .= '<select id="page-filter-by" name="wordpress-media[filter-by]" class="form-control" ' . $disabled . '/>';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['filter-by'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('The filter used for the media displayed') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- FILTER-VALUE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-filter-value">' . __e('Filter Value') . '</label>';
$content .= '<input id="page-filter-value" type="text" name="wordpress-media[filter-value]" class="form-control" placeholder="12,14,45"  value="' . $current_setting['filter-value'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The filter value that will be used.') . ', <a target="_blank" href="' . $current_setting['wp-url'] . '/wp-json/wp/v2/media/?per_page=100">' . $current_setting['wp-url'] . '/wp-json/wp/v2/media/</a></p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- LAYOUT-TYPE
$options = array();
$options[] = array('value' => 'image-gallery-horizontal', 'label' => 'Image Gallery - Horizontal');
$options[] = array('value' => 'image-gallery-vertical', 'label' => 'Image Gallery - Vertical');
$options[] = array('value' => 'image-gallery-grid', 'label' => 'Image Gallery - Grid');
$options[] = array('value' => 'slidebox', 'label' => 'Slidebox');

$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-layout-type">' . __e('Type Layout') . '</label>';
$content .= '<select id="page-layout-type" name="wordpress-media[layout-type]" class="form-control" ' . $disabled . '/>';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['layout-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Choose the layout you want') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- GOTO-PAGE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Goto Page') . '</label>';
$content .= '<select id="page-target" name="wordpress-media[goto-page]" class="form-control">';
//$content .= '<option value="">'.__e('Goto Page').'</option>';
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
$content .= '<p class="help-block">' . __e('Only additional options') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress-media" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<td><a target="_blank" href="./?p=pages&a=edit&page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>';
        $content .= '<td>' . $pageList['page-title'] . '</td>';
        $content .= '<td>';
        $content .= '<a href="./?p=addons&addons=wordpress-media&page-target=' . $pageList['page-target'] . '&a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&addons=wordpress-media&page-target=' . $pageList['page-target'] . '&a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&addons=wordpress-media&page-target=' . $pageList['page-target'] . '&a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=wordpress-media&page-target="+$("#page-target").val(),!1});';
