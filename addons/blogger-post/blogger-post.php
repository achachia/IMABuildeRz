<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `blogger-post`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
$prefix_addons = 'blogger-post';

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("blogger-post");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('blogger-post', $current_page_target);
    header('Location: ./?p=addons&addons=blogger-post&' . time());
}

// TODO: POST
if (isset($_POST['save-blogger-post']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    // TODO: POST --|-- RESPONSE
    $addons['page-title'] = trim($_POST[$prefix_addons]['page-title']);
    $addons['page-header-color'] = trim($_POST[$prefix_addons]['page-header-color']);
    $addons['page-content-background'] = trim($_POST[$prefix_addons]['page-content-background']);
    //social-share-layout
    $addons['social-share-layout'] = trim($_POST[$prefix_addons]['social-share-layout']); //select
    //blog-id
    if (!isset($_POST[$prefix_addons]['blog-id']))
    {
        $_POST[$prefix_addons]['blog-id'] = '906156264990799016';
    }
    $addons['blog-id'] = trim($_POST[$prefix_addons]['blog-id']); //text

    //max-result
    if (!isset($_POST[$prefix_addons]['max-result']))
    {
        $_POST[$prefix_addons]['max-result'] = '100';
    }
    $addons['max-result'] = trim($_POST[$prefix_addons]['max-result']); //text

    //api-key
    if (!isset($_POST[$prefix_addons]['api-key']))
    {
        $_POST[$prefix_addons]['api-key'] = '';
    }
    $addons['api-key'] = trim($_POST[$prefix_addons]['api-key']); //text


    //label-for-readmore
    if (!isset($_POST[$prefix_addons]['label-for-readmore']))
    {
        $_POST[$prefix_addons]['label-for-readmore'] = 'Readmore';
    }
    $addons['label-for-readmore'] = trim($_POST[$prefix_addons]['label-for-readmore']); //text

    //label-for-share
    if (!isset($_POST[$prefix_addons]['label-for-share']))
    {
        $_POST[$prefix_addons]['label-for-share'] = 'Share!';
    }
    $addons['label-for-share'] = trim($_POST[$prefix_addons]['label-for-share']); //text

    //label-for-please-wait
    if (!isset($_POST[$prefix_addons]['label-for-please-wait']))
    {
        $_POST[$prefix_addons]['label-for-please-wait'] = 'Please wait...!';
    }
    $addons['label-for-please-wait'] = trim($_POST[$prefix_addons]['label-for-please-wait']); //text

    //label-for-successfully
    if (!isset($_POST[$prefix_addons]['label-for-successfully']))
    {
        $_POST[$prefix_addons]['label-for-successfully'] = 'Successfully';
    }
    $addons['label-for-successfully'] = trim($_POST[$prefix_addons]['label-for-successfully']); //text

    //label-for-connection-lost
    if (!isset($_POST[$prefix_addons]['label-for-connection-lost']))
    {
        $_POST[$prefix_addons]['label-for-connection-lost'] = 'Internet connection lost!';
    }
    $addons['label-for-connection-lost'] = trim($_POST[$prefix_addons]['label-for-connection-lost']); //text

    //label-for-ok
    if (!isset($_POST[$prefix_addons]['label-for-ok']))
    {
        $_POST[$prefix_addons]['label-for-ok'] = 'Okey';
    }
    $addons['label-for-ok'] = trim($_POST[$prefix_addons]['label-for-ok']); //text

    //label-for-no-posts-found
    if (!isset($_POST[$prefix_addons]['label-for-no-posts-found']))
    {
        $_POST[$prefix_addons]['label-for-no-posts-found'] = 'No posts found!';
    }
    $addons['label-for-no-posts-found'] = trim($_POST[$prefix_addons]['label-for-no-posts-found']); //text

    //label-for-load-more
    if (!isset($_POST[$prefix_addons]['label-for-load-more']))
    {
        $_POST[$prefix_addons]['label-for-load-more'] = 'Loading more data';
    }
    $addons['label-for-load-more'] = trim($_POST[$prefix_addons]['label-for-load-more']); //text

    //multiple-language
    // checkbox
    if (isset($_POST[$prefix_addons]['multiple-language']))
    {
        $addons['multiple-language'] = true;
    } else
    {
        $addons['multiple-language'] = false;
    }


    $db->saveAddOns('blogger-post', $addons);


    $pipe_translate = '';
    if ($addons['multiple-language'] == true)
    {
        $pipe_translate = '| translate ';
    }
    // TODO: ------------------------------------------------------------------------------------------------------------------------------

    // TODO: GENERATOR --|-- SERVICES

    $service['name'] = $current_page_target;
    $service['instruction'] = 'Service for Blogger Post';
    $service['desc'] = 'Service for Blogger Post';

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

    // TODO: GENERATOR --|-- SERVICES --|-- CODE --|-- OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . "\r\n";
    $service['code']['other'] .= "\t" . 'APIKey:string = `' . $addons['api-key'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . 'bloggerID:string = `' . $addons['blog-id'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . 'maxResults:string = `' . $addons['max-result'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- CODE --|-- OTHER --|-- getPosts(keyword)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* getPosts(keyword)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getPosts(keyword:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'console.log("keyword:",keyword);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-for-please-wait'] . '`);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let APIKey = this.APIKey;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let bloggerID = this.bloggerID;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let maxResults = this.maxResults;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let apiUrl = `https://www.googleapis.com/blogger/v3/blogs/${bloggerID}/posts/?maxResults=${maxResults}&key=${APIKey}`;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(keyword !== ``){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'apiUrl = `https://www.googleapis.com/blogger/v3/blogs/${bloggerID}/posts/search/?q=${keyword}&maxResults=${maxResults}&key=${APIKey}`;' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(apiUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully'] . '`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("throwError:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,`' . $addons['label-for-connection-lost'] . '`);' . "\r\n";
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
    // TODO: GENERATOR --|-- SERVICES --|-- CODE --|-- OTHER --|-- getPost()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* getPost()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getPost(postId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-for-please-wait'] . '`);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let APIKey = this.APIKey;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let bloggerID = this.bloggerID;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(`https://www.googleapis.com/blogger/v3/blogs/${bloggerID}/posts/${postId}?key=${APIKey}`)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully'] . '`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("throwError:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,`' . $addons['label-for-connection-lost'] . '`);' . "\r\n";
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
    // TODO: GENERATOR --|-- SERVICES --|-- CODE --|-- OTHER --|-- presentLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading(message: string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 1000' . "\r\n";
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
    // TODO: GENERATOR --|-- SERVICES --|-- CODE --|-- OTHER --|-- showToast()
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
    // TODO: GENERATOR --|-- SERVICES --|-- CODE --|-- OTHER --|-- showAlert()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["' . $addons['label-for-ok'] . '"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, $current_page_target);

    // TODO: ------------------------------------------------------------------------------------------------------------------------------

    // TODO: GENERATOR --|-- PAGE-POSTS --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'blogger-post';
    $newPage['icon-left'] = 'newspaper';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColor($addons['page-header-color']);
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['param'] = 'label_text';

    // TODO: GENERATOR --|-- PAGE-POSTS --|-- HEADER
    $newPage['header']['mid']['type'] = 'search';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    $newPage['content']['disable-ion-content'] = false;
    $newPage['content']['enable-fullscreen'] = true;

    // TODO: GENERATOR --|-- PAGE-POSTS --|-- MODULES
    $c = 0;
    $newPage['modules']['angular'][$c]['enable'] = true;
    $newPage['modules']['angular'][$c]['class'] = 'Observable';
    $newPage['modules']['angular'][$c]['var'] = '';
    $newPage['modules']['angular'][$c]['path'] = 'rxjs';

    $c++;
    $newPage['modules']['angular'][$c]['enable'] = true;
    $newPage['modules']['angular'][$c]['class'] = 'Observable';
    $newPage['modules']['angular'][$c]['var'] = '';
    $newPage['modules']['angular'][$c]['path'] = 'rxjs';

    $c++;
    $newPage['modules']['angular'][$c]['enable'] = true;
    $newPage['modules']['angular'][$c]['class'] = 'ViewChild';
    $newPage['modules']['angular'][$c]['var'] = '';
    $newPage['modules']['angular'][$c]['path'] = '@angular/core';

    $c++;
    $newPage['modules']['angular'][$c]['enable'] = true;
    $newPage['modules']['angular'][$c]['class'] = 'IonInfiniteScroll';
    $newPage['modules']['angular'][$c]['var'] = '';
    $newPage['modules']['angular'][$c]['path'] = '@ionic/angular';


    $c++;
    $varName = $string->toUserClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$c]['enable'] = true;
    $newPage['modules']['angular'][$c]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$c]['var'] = $string->toUserClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$c]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';


    // TODO: GENERATOR --|-- PAGE-POSTS --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="filterDataPosts.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '{{ "' . $addons['label-for-no-posts-found'] . '"' . $pipe_translate . ' }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let post of filterDataPosts">' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ post.published | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="post.title"></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '{{ post.content | stripTags | readMore:100}}' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-row class="ion-no-padding">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col class="text-left">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col class="ion-text-center">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button expand="full" fill="clear" size="small" color="' . $addons['page-header-color'] . '" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($current_page_target) . '-detail\',post.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '{{ "' . $addons['label-for-readmore'] . '"' . $pipe_translate . ' }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon slot="end" name="arrow-forward"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll threshold="100px" id="infinite-scroll" (ionInfinite)="loadMore($event)">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content loading-spinner="bubbles" loading-text="' . $addons['label-for-load-more'] . '"></ion-infinite-scroll-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE-POSTS --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;


    // TODO: GENERATOR --|-- PAGE-POSTS --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'posts: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataPosts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'filterDataPosts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '//for infinite-scroll' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'lastId:number = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'firstLoad:number = 10;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'perPage:number = 10;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '@ViewChild("IonInfiniteScroll",{static: true}) infiniteScroll: IonInfiniteScroll;' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE-POSTS --|-- CODE --|-- OTHER --|-- getPosts()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* getPosts()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getPosts(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let keyword:string = ``;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.labelText != null){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'keyword = `label:${this.labelText}`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.posts = this.' . $varName . '.getPosts(keyword);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.posts.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data.items){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = data.items ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`getPosts`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.lastId = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'let newData : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'for (let item of data.items) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'if(this.lastId <= (this.firstLoad -1) ) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'newData[this.lastId] = item;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.lastId++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.filterDataPosts = newData;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* filterItems()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataPosts = this.dataPosts;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterDataPosts = this.dataPosts.filter((newItem) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(newItem.title !=""){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'return newItem.title.toLowerCase().indexOf(filterVal.toLowerCase()) > -1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* loadMore(event)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @param event $event' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public loadMore(event){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let newData : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let nextPage:number = this.perPage + this.lastId;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'for (let item of this.dataPosts){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(this.lastId < this.dataPosts.length){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(this.lastId < nextPage){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.filterDataPosts[this.lastId] = this.dataPosts[this.lastId];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.lastId++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'event.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if( this.lastId >= this.dataPosts.length){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'event.target.enable = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";


    // TODO: GENERATOR --|-- PAGE-POSTS --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPosts();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE-POSTS --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPosts();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    //generate page code
    $db->savePage($newPage);


    // TODO: ------------------------------------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE DETAIL
    $newPage = null;
    $newPage['name'] = $current_page_target . '-detail';
    $newPage['code-by'] = 'blogger-post';

    $newPage['title'] = '<span *ngIf="dataPost && dataPost.title" [innerHTML]="dataPost.title"></span>';
    $newPage['name'] = $current_page_target . '-detail';
    $newPage['var'] = $current_page_target . '_detail';
    $newPage['icon-left'] = 'newspaper';
    $newPage['icon-right'] = '';

    $newPage['back-button'] = '/' . $current_page_target;
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColor($addons['page-header-color']);
    $newPage['statusbar']['style'] = 'lightcontent';

    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];


    $newPage['header']['mid']['type'] = 'title';


    $newPage['header']['mid']['items'][0]['label'] = '';
    $newPage['header']['mid']['items'][0]['value'] = '';
    $newPage['header']['mid']['items'][1]['label'] = '';
    $newPage['header']['mid']['items'][1]['value'] = '';
    $newPage['header']['mid']['items'][2]['label'] = '';
    $newPage['header']['mid']['items'][2]['value'] = '';


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

    $z++;
    $newPage['modules']['angular'][$z]['class'] = 'InAppBrowser';
    $newPage['modules']['angular'][$z]['var'] = 'inAppBrowser';
    $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-inappbrowser';
    $newPage['modules']['angular'][$z]['path'] = '@ionic-native/in-app-browser/ngx';
    $newPage['modules']['angular'][$z]['enable'] = true;

    $z++;
    $newPage['modules']['angular'][$z]['class'] = 'HostListener';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/core';
    $newPage['modules']['angular'][$z]['enable'] = true;


    $newPage['param'] = 'post_id';

    $newPage['content']['disable-ion-content'] = false;
    $newPage['content']['enable-fullscreen'] = false;
    // TODO: GENERATOR --|-- PAGE DETAIL --|-- HTML
    $newPage['content']['html'] = null;

    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="!dataPost || !dataPost.title">' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 75%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 68%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 58%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataPost">' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-header *ngIf="dataPost.title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ dataPost.published | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="dataPost.title"></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.author && dataPost.author.displayName">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="dataPost.author && dataPost.author.image && dataPost.author.image.url" src="{{ dataPost.author && dataPost.author.image.url }}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-avatar>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>{{ dataPost.author.displayName }}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button *ngIf="dataPost.author.url" fill="outline" appBrowser [url]="dataPost.author.url"><ion-icon name="globe"></ion-icon></ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";

    $current_directives = $_SESSION['CURRENT_APP']['directives'];
    if (isset($current_directives['text-to-speech']))
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.content" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="pulse" slot="start"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-label>Speech!</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button textToSpeech locale="' . $current_app['apps']['app-locale'] . '" text="{{ dataPost.content | stripTags }}" ><ion-icon name="megaphone"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    }

    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataPost.content">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div [innerHtml]="dataPost.content | trustHtml"></div>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="dataPost.labels">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-chip *ngFor="let label of dataPost.labels" button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . ($current_page_target) . '\',label]" color="' . $addons['page-header-color'] . '" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '{{ label }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-chip>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";

    if ($addons['social-share-layout'] == 'list')
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-row *ngIf="dataPost.url">' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" facebookApp [url]="dataPost.url"><ion-icon slot="icon-only" name="logo-facebook"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col *ngIf="dataPost.title">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" twitterApp message="{{ dataPost.title | stripTags }} - {{ dataPost.url }}"><ion-icon slot="icon-only" name="logo-twitter"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col *ngIf="dataPost.title">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="success" whatsappApp message="{{ dataPost.title | stripTags }} - {{ dataPost.url }}"><ion-icon slot="icon-only" name="logo-whatsapp"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col *ngIf="dataPost.title">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="danger" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ dataPost.title | stripTags }} - {{ dataPost.url }}"><ion-icon slot="icon-only" name="mail-open"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    }
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    if ($addons['social-share-layout'] == 'fab')
    {
        $newPage['footer']['color'] = 'none';
        $newPage['footer']['type'] = 'code';
        $newPage['footer']['title'] = '';
        $newPage['footer']['code'] = null;
        $newPage['footer']['code'] .= "\t" . '' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '<!-- social-share -->' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '<ion-fab *ngIf="dataPost.title" vertical="bottom" horizontal="end" slot="fixed">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-fab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '</ion-fab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-fab-list side="start">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="primary" facebookApp [url]="dataPost.url">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="logo-facebook"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="secondary" *ngIf="dataPost.title" twitterApp message="{{ dataPost.title | stripTags }} - {{ dataPost.url }}">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="logo-twitter"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="success" *ngIf="dataPost.title" whatsappApp message="{{ dataPost.title | stripTags }} - {{ dataPost.url }}">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="danger" *ngIf="dataPost.title" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ dataPost.title | stripTags }} - {{ dataPost.url }}">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="mail-open"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '</ion-fab-list>' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '</ion-fab>' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '<!-- ./social-share -->' . "\r\n";
    }

    // TODO: GENERATOR --|-- PAGE DETAIL --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS
    $newPage['code']['other'] = null;

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'post: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataPost: any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS --|-- getPost()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* getPost(postId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getPost(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.post = this.' . $varName . '.getPost(this.postId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.post.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPost = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPost = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPost();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS --|-- HostListener
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HostListener' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '@HostListener("click", ["$event"]) onClick(e){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(e.target.href && e.target.target){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if((e.target.target == `_blank`) || (e.target.target == `_system`)){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'let href = e.target.href;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.inAppBrowser.create(href,"_system");' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPost = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPost();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS --|-- openWithSocialShare()

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE DETAIL --|-- TS --|-- getJSON()

    //save page
    $db->SavePage($newPage);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=blogger-post&page-target=' . $current_page_target . '&' . time());

}
// TODO: ------------------------------------------------------------------------------------------------------------------------------

// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('blogger-post', $current_page_target);
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

if (!isset($current_setting['blog-id']))
{
    $current_setting['blog-id'] = '906156264990799016';
}

if (!isset($current_setting['max-result']))
{
    $current_setting['max-result'] = '100';
}

if (!isset($current_setting['api-key']))
{
    $current_setting['api-key'] = '';
}

if (!isset($current_setting['label-for-readmore']))
{
    $current_setting['label-for-readmore'] = 'Readmore';
}

if (!isset($current_setting['label-for-share']))
{
    $current_setting['label-for-share'] = 'Share!';
}

if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-successfully']))
{
    $current_setting['label-for-successfully'] = 'Successfully';
}

if (!isset($current_setting['label-for-connection-lost']))
{
    $current_setting['label-for-connection-lost'] = 'Connection lost!';
}

if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'Okey';
}

if (!isset($current_setting['label-for-no-posts-found']))
{
    $current_setting['label-for-no-posts-found'] = 'There are no posts';
}


if (!isset($current_setting['label-for-load-more']))
{
    $current_setting['label-for-load-more'] = 'Loading more data';
}

if (!isset($current_setting['social-share-layout']))
{
    $current_setting['social-share-layout'] = 'fab';
}

if (!isset($current_setting['multiple-language']))
{
    $current_setting['multiple-language'] = false;
}
// TODO: ------------------------------------------------------------------------------------------------------------------------------

// TODO: LAYOUT --|-- FORM
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';

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
$content .= '<select id="page-target" name="blogger-post[page-target]" class="form-control" >';
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
$content .= '<input  id="page-title" type="text" name="blogger-post[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="blogger-post[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="blogger-post[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
// TODO: LAYOUT --|-- FORM --|-- BLOG-ID --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-blog-id" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-blog-id">' . __e('Blog ID') . '</label>';
$content .= '<input id="page-blog-id" type="text" name="' . $prefix_addons . '[blog-id]" class="form-control" placeholder="906156264990799016"  value="' . $current_setting['blog-id'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Get from dashboard admin, example: https://www.blogger.com/blogger.g?blogID=<code>906156264990799016</code>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- API-KEY --|-- TEXT

$content .= '<div id="field-api-key" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-api-key">' . __e('API Key') . '</label>';
$content .= '<input id="page-api-key" type="text" name="' . $prefix_addons . '[api-key]" class="form-control" placeholder="AIzaSyCC6zYllOUOpKpPa3Q1chJ-45sRVMHOo1Q"  value="' . $current_setting['api-key'] . '"  ' . $disabled . ' requred />';
$content .= '<p class="help-block">' . __e('<code>Enable Blogger API v3</code> on <strong>API Library</strong> and get the <code>API Key</code> from the <a target="_blank" href="https://console.developers.google.com/apis/credentials">Google Console</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- MAX-RESULT --|-- TEXT
$content .= '<div id="field-max-result" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-max-result">' . __e('Max Result') . '</label>';
$content .= '<input id="page-max-result" type="number" maxlength="3" min="5" max="500" name="' . $prefix_addons . '[max-result]" class="form-control" placeholder="100"  value="' . $current_setting['max-result'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Number of posts to display, maximum 500.') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- SOCIAL-SHARE-LAYOUT --|-- SELECT
$options = array();
$options[] = array('value' => 'none', 'label' => 'None');
$options[] = array('value' => 'fab', 'label' => 'Fab');
$options[] = array('value' => 'list', 'label' => 'List');

$content .= '<div id="field-social-share-layout" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-social-share-layout">' . __e('Social Share') . '</label>';
$content .= '<select id="page-social-share-layout" name="' . $prefix_addons . '[social-share-layout]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['social-share-layout'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Choose a social sharing style') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<label>' . __e('Options') . '</label>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<table class="table">';
$content .= '<tr>';
if ($current_setting['multiple-language'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-multiple-language" name="' . $prefix_addons . '[multiple-language]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-multiple-language" name="' . $prefix_addons . '[multiple-language]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Multiple Language Support') . '</td>';
$content .= '</tr>';
$content .= '</table>';

$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-blogger-post" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';


$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-READMORE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-readmore" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-readmore">' . __e('Label for `Readmore`') . '</label>';
$content .= '<input id="page-label-for-readmore" type="text" name="' . $prefix_addons . '[label-for-readmore]" class="form-control" placeholder="Readmore"  value="' . $current_setting['label-for-readmore'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Readmore`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SHARE --|-- TEXT

$content .= '<div id="field-label-for-share" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-share">' . __e('Label for `Share!`') . '</label>';
$content .= '<input id="page-label-for-share" type="text" name="' . $prefix_addons . '[label-for-share]" class="form-control" placeholder="Share!"  value="' . $current_setting['label-for-share'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Share!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT

$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="' . $prefix_addons . '[label-for-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-successfully" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully">' . __e('Label for `Successfully`') . '</label>';
$content .= '<input id="page-label-for-successfully" type="text" name="' . $prefix_addons . '[label-for-successfully]" class="form-control" placeholder="Successfully"  value="' . $current_setting['label-for-successfully'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Successfully`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONNECTION-LOST --|-- TEXT

$content .= '<div id="field-label-for-connection-lost" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-connection-lost">' . __e('Label for `Internet connection lost!`') . '</label>';
$content .= '<input id="page-label-for-connection-lost" type="text" name="' . $prefix_addons . '[label-for-connection-lost]" class="form-control" placeholder="Internet connection lost!"  value="' . $current_setting['label-for-connection-lost'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Internet connection lost!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT

$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `Okey`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="' . $prefix_addons . '[label-for-ok]" class="form-control" placeholder="Okey"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Okey`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-POSTS-FOUND --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-posts-found" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-posts-found">' . __e('Label for `No posts found!`') . '</label>';
$content .= '<input id="page-label-for-no-posts-found" type="text" name="' . $prefix_addons . '[label-for-no-posts-found]" class="form-control" placeholder="No posts found!"  value="' . $current_setting['label-for-no-posts-found'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `No posts found!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LOAD-MORE --|-- TEXT

$content .= '<div id="field-label-for-load-more" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-load-more">' . __e('Label for `Loading more data`') . '</label>';
$content .= '<input id="page-label-for-load-more" type="text" name="' . $prefix_addons . '[label-for-load-more]" class="form-control" placeholder="Loading more data"  value="' . $current_setting['label-for-load-more'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Loading more data`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-blogger-post" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<a href="./?p=addons&amp;addons=blogger-post&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=blogger-post&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=blogger-post&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=blogger-post&page-target="+$("#page-target").val(),!1});';
