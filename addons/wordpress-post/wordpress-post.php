<?php

/**
 * @author Ihsana Team <Ihsana Team@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

defined("JSM_EXEC") or die("Silence is golden");

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("wordpress-post");
$string = new jsmString();
$cordova_social_xsharing = true;

$is_debug = false;
if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('wordpress-post', $current_page_target);
    header('Location: ./?p=addons&addons=wordpress-post&' . time());
}
$cordova_social_xsharing = false;

if (isset($_POST['save-wordpress-post']))
{
    $page_target = $current_page_target;
    if ($page_target != '')
    {
        $page_title = trim($_POST['addons']['page-title']);
        $wp_url = trim($_POST['addons']['wp-url']);
        $cat_id = trim($_POST['addons']['cat-id']);
        $per_page = trim($_POST['addons']['per-page']);
        $page_layout = trim($_POST['addons']['page-layout']);


        $className = $string->toClassName($page_target);
        // TODO: ------------------------------------------------------------------------------------------------------------------------------
        // TODO: ADDONS
        $addons = array();
        $addons['page-target'] = $page_target;
        $addons['page-title'] = $page_title;
        $addons['wp-url'] = $wp_url;
        $addons['cat-id'] = (int)$cat_id;
        $addons['per-page'] = (int)$per_page;
        $addons['page-layout'] = $page_layout;
        $addons['page-header-color'] = trim($_POST['addons']['page-header-color']);
        $addons['page-content-background'] = trim($_POST['addons']['page-content-background']);
        //http-module
        $addons['http-module'] = trim($_POST['addons']['http-module']); //select

        //label-for-there-are-no-items
        if (!isset($_POST['addons']['label-for-there-are-no-items']))
        {
            $_POST['addons']['label-for-there-are-no-items'] = 'There are no items';
        }
        $addons['label-for-there-are-no-items'] = trim($_POST['addons']['label-for-there-are-no-items']); //text

        //label-for-readmore
        if (!isset($_POST['addons']['label-for-readmore']))
        {
            $_POST['addons']['label-for-readmore'] = 'Readmore';
        }
        $addons['label-for-readmore'] = trim($_POST['addons']['label-for-readmore']); //text

        //label-for-please-wait
        if (!isset($_POST['addons']['label-for-please-wait']))
        {
            $_POST['addons']['label-for-please-wait'] = 'Please wait...!';
        }
        $addons['label-for-please-wait'] = trim($_POST['addons']['label-for-please-wait']); //text

        //label-for-connection-lost
        if (!isset($_POST['addons']['label-for-connection-lost']))
        {
            $_POST['addons']['label-for-connection-lost'] = 'Connection lost, please check your connection!';
        }
        $addons['label-for-connection-lost'] = trim($_POST['addons']['label-for-connection-lost']); //text

        //label-for-successfully
        if (!isset($_POST['addons']['label-for-successfully']))
        {
            $_POST['addons']['label-for-successfully'] = 'Successfully retrieved data!';
        }
        $addons['label-for-successfully'] = trim($_POST['addons']['label-for-successfully']); //text

        //multiple-language
        // checkbox
        if (isset($_POST['addons']['multiple-language']))
        {
            $addons['multiple-language'] = true;
        } else
        {
            $addons['multiple-language'] = false;
        }


        $db->saveAddOns('wordpress-post', $addons);
        //==============================================================


        if ($addons['multiple-language'] == true)
        {
            // TODO: PROJECT
            $new_project = $current_app['apps'];
            $new_project['ionic-storage'] = true;
            $new_project['pref-orientation'] = 'portrait';
            $db->saveProject($new_project);

            // TODO: LOCALIZATION
            //=======================================================
            $localization = null;
            $localization['prefix'] = 'en';
            $localization['name'] = 'English';
            $localization['desc'] = 'Auto create by WordPress Post Addons';

            $v = 0;
            $localization['words'][$v]['text'] = $addons['label-for-there-are-no-items'];
            $localization['words'][$v]['translate'] = 'There are no items';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-readmore'];
            $localization['words'][$v]['translate'] = 'readmore';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
            $localization['words'][$v]['translate'] = 'please-wait...';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-connection-lost'];
            $localization['words'][$v]['translate'] = 'Connection lost, please check your connection!';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-successfully'];
            $localization['words'][$v]['translate'] = 'Successfully retrieved data!';


            $db->updateLocalization($localization);

            //========================================================
            $localization = null;
            $localization['prefix'] = 'id';
            $localization['name'] = 'Bahasa Indonesia';
            $localization['desc'] = 'Auto create by WordPress Post Addons';

            $v = 0;
            $localization['words'][$v]['text'] = $addons['label-for-there-are-no-items'];
            $localization['words'][$v]['translate'] = 'Tidak ada item';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-readmore'];
            $localization['words'][$v]['translate'] = 'Selengkapnya';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
            $localization['words'][$v]['translate'] = 'Silahkan tunggu...';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-connection-lost'];
            $localization['words'][$v]['translate'] = 'Koneksi terputus';

            $v++;
            $localization['words'][$v]['text'] = $addons['label-for-successfully'];
            $localization['words'][$v]['translate'] = 'Berhasil';


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

            $v++;
            $localization['words'][$v]['text'] = 'Readmore';
            $localization['words'][$v]['translate'] = 'Baca selanjutnya';

            $db->updateLocalization($localization);
        }  


        $pipe_translate = '';
        if ($addons['multiple-language'] == true)
        {
            $pipe_translate = '| translate ';
        }


        $api_wp_url = $wp_url . '/wp-json/wp/v2/posts?categories=' . $cat_id . '&_embed';

        // TODO: ------------------------------------------------------------------------------------------------------------------------------
        // TODO: UPDATE --|-- ENQUEUE
        $enqueue_css[] = array('url' => $addons['wp-url'] . '/wp-includes/css/dist/block-library/style.min.css', 'attr' => 'media="all"');
        $enqueue_css[] = array('url' => $addons['wp-url'] . '/wp-includes/css/dist/block-library/theme.min.css');
        $db->addEnqueues('styles', $enqueue_css);

        // TODO: ------------------------------------------------------------------------------------------------------------------------------
        // TODO: SERVICE

        $service['name'] = $addons['page-target'];
        $service['desc'] = 'This service is to get wordpress posts data';

        $z = 0;

        $service['modules']['angular'][$z]['enable'] = true;
        $service['modules']['angular'][$z]['class'] = 'Observable';
        $service['modules']['angular'][$z]['var'] = '';
        $service['modules']['angular'][$z]['path'] = 'rxjs';

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


        // TODO: SERVICE --|-- CODE - OTHER
        $service['code']['other'] = null;
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
        $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: SERVICE --|-- CODE --|-- getPosts()
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* getPosts()' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        if ($addons['http-module'] == 'cordova')
        {
            $service['code']['other'] .= "\t" . 'getPosts(query): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let nativeHTTP = this.http.get(this.wpUrl + `/wp-json/wp/v2/posts/?${param}&_embed`, {}, {' . "\r\n";
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
            $service['code']['other'] .= "\t" . 'getPosts(query): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/posts/?${param}&_embed`)' . "\r\n";
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
        }

        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: SERVICE --|-- CODE --|-- getPost(postId)
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* getPost(postId)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        if ($addons['http-module'] == 'cordova')
        {
            $service['code']['other'] .= "\t" . 'getPost(postId:string){' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let nativeHTTP = this.http.get(this.wpUrl + `/wp-json/wp/v2/posts/${postId}?_embed=true`, {}, {' . "\r\n";
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
            $service['code']['other'] .= "\t" . 'getPost(postId:string): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/posts/${postId}?_embed=true`)' . "\r\n";
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
            if ($addons['multiple-language'] == true)
            {
                $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,this.translateService.instant(`' . $addons['label-for-connection-lost'] . '`));' . "\r\n";
            } else
            {
                $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,`' . $addons['label-for-connection-lost'] . '`);' . "\r\n";
            }
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
        // TODO: SERVICE --|-- CODE --|-- httpBuildQuery()
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
        // TODO: SERVICE --|-- CODE --|-- showAlert()
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
        // TODO: SERVICE --|-- CODE --|-- showAlert()
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
        // TODO: ------------------------------------------------------------------------------------------------------------------------------
        // TODO: PAGE LISTING
        $newPage = null;
        $newPage['title'] = $page_title;
        $newPage['name'] = $page_target;
        $newPage['var'] = $page_target;

        // TODO: PAGE LISTING --|-- HTML
        $newPage['code-by'] = 'wordpress-post';
        $newPage['icon-left'] = 'menu';
        $newPage['icon-right'] = '';
        $newPage['header']['color'] = $addons['page-header-color'];
        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['page-content-background'];
        $newPage['statusbar']['style'] = 'lightcontent';
        $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);

        $newPage['header']['mid']['type'] = 'search';
        $newPage['header']['mid']['items'][0]['label'] = '';
        $newPage['header']['mid']['items'][0]['value'] = '';
        $newPage['header']['mid']['items'][1]['label'] = '';
        $newPage['header']['mid']['items'][1]['value'] = '';
        $newPage['header']['mid']['items'][2]['label'] = '';
        $newPage['header']['mid']['items'][2]['value'] = '';

        // TODO: PAGE LISTING --|-- MODULES
        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';


        if ($addons['http-module'] == 'cordova')
        {
            $z++;
            $newPage['modules']['angular'][$z]['enable'] = true;
            $newPage['modules']['angular'][$z]['class'] = 'HTTP';
            $newPage['modules']['angular'][$z]['var'] = 'http';
            $newPage['modules']['angular'][$z]['path'] = '@ionic-native/http/ngx';
            $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-advanced-http';
        }


        $getClassName = $string->toClassName($current_page_target) . 'Service';
        $varName = $string->toUserClassName($current_page_target) . 'Service';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = $getClassName;
        $newPage['modules']['angular'][$z]['var'] = $varName;
        $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';

        $newPage['content']['disable-ion-content'] = false;
        $newPage['content']['enable-fullscreen'] = false;

        $newPage['content']['html'] = null;


        $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

        // TODO: PAGE LISTING --|-- HTML --|-- no-result
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataPosts.length == 0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '{{ "' . $addons['label-for-there-are-no-items'] . '" | translate }}' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";

        switch ($page_layout)
        {
            case 'showcase':
                // TODO: PAGE LISTING --|-- HTML --|-- content
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let post of dataPosts">' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ post.date | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="post.title.rendered"></ion-card-title>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '{{ post.content.rendered | stripTags | readMore:100}}' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-row class="ion-no-padding">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-col class="text-left">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-col class="ion-text-center">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button fill="clear" size="small" color="danger" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($page_target) . '-detail\',post.id]">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon slot="start" name="arrow-round-forward"></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '{{ "' . $addons['label-for-readmore'] . '" | translate }}' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                break;
            case 'item-list':
                // TODO: PAGE LISTING --|-- HTML --|-- content
                $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let post of dataPosts" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($page_target) . '-detail\',post.id]">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label text-wrap>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h2 [innerHTML]="post.title.rendered"></h2>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h3>{{ post.date | date:\'fullDate\' }}</h3>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                break;
            case 'item-thumbnail':
                // TODO: PAGE LISTING --|-- HTML --|-- content
                $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let post of dataPosts" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($page_target) . '-detail\',post.id]">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-thumbnail slot="start" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'thumbnail\'] ; else imgBlank" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'thumbnail\'].source_url }}" />' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ng-template #imgBlank>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<img src="https://placehold.it/80x80" />' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ng-template>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label text-wrap>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h2 [innerHTML]="post.title.rendered"></h2>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h3>{{ post.date | date:\'fullDate\' }}</h3>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                break;
        }


        // TODO: PAGE LISTING --|-- HTML --|-- content
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll (ionInfinite)="loadMore($event)">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content></ion-infinite-scroll-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";

        // TODO: PAGE LISTING --|-- SCSS
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
        $newPage['content']['scss'] .= "\t" . 'img,video{' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'width:100%;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        // TODO: PAGE LISTING --|-- TS
        $newPage['code']['other'] = null;
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        $newPage['code']['other'] .= "\t" . 'posts: Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'dataPosts: any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'pageNumber: number = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'catID: number = ' . $cat_id . ';' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'query = {};' . "\r\n";

        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- getPosts()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* getPosts()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'getPosts(start: boolean){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.updateQuery();' . "\r\n";
        if ($addons['http-module'] == 'cordova')
        {
            $newPage['code']['other'] .= "\t\t" . 'this.posts = this.' . $varName . '.getPosts(this.query);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.posts.subscribe(data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'console.log(`RAW:`,data);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if(start == true){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = JSON.parse(data.data) ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = this.dataPosts.concat(JSON.parse(data.data));' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";

        } else
        {
            $newPage['code']['other'] .= "\t\t" . 'this.posts = this.' . $varName . '.getPosts(this.query);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.posts.subscribe(data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if(start == true){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = data ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = this.dataPosts.concat(data);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        }
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        // TODO: PAGE LISTING --|-- TS --|-- loadMore()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* loadMore(infiniteScroll)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* @param event $infiniteScroll' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public loadMore(infiniteScroll){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let pageNumber = this.pageNumber;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'infiniteScroll.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '//infiniteScroll.target.enable = false;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";


        // TODO: PAGE LISTING --|-- TS --|-- updateQuery()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* updateQuery()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public updateQuery(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["page"] = this.pageNumber;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["_embed"] = "true";' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["per_page"] = ' . $per_page . ' ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["search"] = this.filterQuery;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(this.catID){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.query["categories"] = this.catID;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'console.log("parameter",this.query);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        // TODO: PAGE LISTING --|-- TS --|-- doRefresh()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";


        // TODO: PAGE LISTING --|-- TS --|-- filterItems()
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* filterItems($event)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = filterVal;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}else{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = "";' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if((this.filterQuery.length == 0 ) || (this.filterQuery.length >= 4 )){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataPosts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.pageNumber = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.getPosts(true);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";


        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(true);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        //save page
        $db->SavePage($newPage);

        // TODO: ------------------------------------------------------------------------------------------------------------------------------
        // TODO: PAGE DETAIL
        $newPage = null;
        $newPage['code-by'] = 'wordpress-post';
        $newPage['title'] = '<span *ngIf="dataPost && dataPost.title" [innerHTML]="dataPost.title.rendered"></span>';
        $newPage['name'] = $page_target . '-detail';
        $newPage['var'] = $page_target . '_detail';
        $newPage['icon-left'] = 'menu';
        $newPage['icon-right'] = '';

        $newPage['back-button'] = '/' . $page_target;
        $newPage['statusbar']['style'] = 'lightcontent';
        $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);

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

        // TODO: PAGE DETAIL --|-- MODULES
        if ($cordova_social_xsharing == true)
        {
            $newPage['modules']['ionic-native'][0]['enable'] = true;
            $newPage['modules']['ionic-native'][0]['class'] = 'SocialSharing';
            $newPage['modules']['ionic-native'][0]['var'] = 'socialSharing';
            $newPage['modules']['ionic-native'][0]['path'] = '@ionic-native/social-sharing/ngx';
            $newPage['modules']['ionic-native'][0]['native'] = '@ionic-native/social-sharing';
            $newPage['modules']['ionic-native'][0]['cordova'] = 'cordova-plugin-x-socialsharing';
        }


        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';

        if ($addons['http-module'] == 'cordova')
        {
            $z++;
            $newPage['modules']['angular'][$z]['enable'] = true;
            $newPage['modules']['angular'][$z]['class'] = 'HTTP';
            $newPage['modules']['angular'][$z]['var'] = 'http';
            $newPage['modules']['angular'][$z]['path'] = '@ionic-native/http/ngx';
            $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-advanced-http';
        }

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
        // TODO: PAGE DETAIL --|-- HTML
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
        $newPage['content']['html'] .= "\t\t" . '<img *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'][\'wp:featuredmedia\'] && dataPost[\'_embedded\'][\'wp:featuredmedia\'][0] && dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-card-header *ngIf="dataPost.title">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ dataPost.date | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="dataPost.title.rendered"></ion-card-title>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'].author && dataPost[\'_embedded\'].author[0]">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="person" slot="start"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-label>{{ dataPost[\'_embedded\'].author[0].name }}</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button *ngIf="dataPost[\'_embedded\'].author[0].link" fill="outline" appBrowser [url]="dataPost[\'_embedded\'].author[0].link"><ion-icon name="globe"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";

        $current_directives = $_SESSION['CURRENT_APP']['directives'];
        if (isset($current_directives['text-to-speech']))
        {
            $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.content" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="pulse" slot="start"></ion-icon>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-label>Speech!</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-button textToSpeech locale="' . $current_app['apps']['app-locale'] . '" text="{{ dataPost.content.rendered | stripTags }}" ><ion-icon name="megaphone"></ion-icon></ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        }

        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-card-content *ngIf="dataPost.content">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<div [innerHtml]="dataPost.content.rendered | trustHtml"></div>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.x_metadata && dataPost.x_metadata.download">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button systemBrowser url="{{ dataPost.x_metadata.download }}"><ion-icon name="arrow-down"></ion-icon> Download</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.x_metadata && dataPost.x_metadata.pdf">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button systemBrowser url="{{ dataPost.x_metadata.pdf }}"><ion-icon name="arrow-down"></ion-icon> PDF</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.video">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<video controls>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<source src="{{ dataPost.x_metadata.video }}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</video>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.mp4">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<video controls>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<source src="{{ dataPost.x_metadata.mp4 }}" type="video/mp4">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</video>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.ogg">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<video controls>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<source src="{{ dataPost.x_metadata.ogg }}" type="video/ogg">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . 'Your browser does not support the video tag' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</video>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.audio">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<audio controls>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<source src="{{ dataPost.x_metadata.audio }}" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . 'Your browser does not support the audio element' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</audio>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.mp3">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<audio controls>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<source src="{{ dataPost.x_metadata.mp3 }}" type="audio/mp3">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . 'Your browser does not support the audio element' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</audio>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.iframe">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<iframe [src]="dataPost.x_metadata.iframe | trustResourceUrl">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</iframe>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item class="ion-text-wrap" *ngIf="dataPost.x_metadata && dataPost.x_metadata.youtube">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<iframe [src]="dataPost.x_metadata.youtube | trustResourceUrl">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</iframe>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.x_metadata && dataPost.x_metadata.geo">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button geoApp location="{{ dataPost.x_metadata.geo }}" query="">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="map"></ion-icon> MAP' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost.x_metadata && dataPost.x_metadata.map">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button geoApp location="" query="{{ dataPost.x_metadata.map }}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="map"></ion-icon> MAP' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '<ion-row *ngIf="dataPost.link">' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" facebookApp [url]="dataPost.link"><ion-icon slot="icon-only" name="logo-facebook"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col *ngIf="dataPost.title.rendered">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" twitterApp message="{{ dataPost.title.rendered | stripTags }} - {{ dataPost.link }}"><ion-icon slot="icon-only" name="logo-twitter"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col *ngIf="dataPost.title.rendered">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="success" whatsappApp message="{{ dataPost.title.rendered | stripTags }} - {{ dataPost.link }}"><ion-icon slot="icon-only" name="logo-whatsapp"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-col *ngIf="dataPost.title.rendered">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="danger" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ dataPost.title.rendered | stripTags }} - {{ dataPost.link }}"><ion-icon slot="icon-only" name="mail-open"></ion-icon></ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";

        $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";


        // TODO: PAGE DETAIL --|-- SCSS
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'img,video{' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'width:100%;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        // TODO: PAGE DETAIL --|-- TS
        $newPage['code']['other'] = null;

        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'post: Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'dataPost: any = {};' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE DETAIL --|-- TS --|-- getPost()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* getPost(postId)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public getPost(){' . "\r\n";
        if ($addons['http-module'] == 'cordova')
        {
            $newPage['code']['other'] .= "\t\t" . 'this.post = this.' . $varName . '.getPost(this.postId);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.post.subscribe(data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'console.log(`RAW:`,data);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPost = JSON.parse(data.data) ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t" . 'this.post = this.' . $varName . '.getPost(this.postId);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.post.subscribe(data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPost = data ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        }
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        // TODO: PAGE DETAIL --|-- TS --|-- doRefresh()
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

        // TODO: PAGE DETAIL --|-- TS --|-- HostListener
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

        // TODO: PAGE DETAIL --|-- TS --|-- ngOnInit()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataPost = {};' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPost();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE DETAIL --|-- TS --|-- openWithSocialShare()

        if ($cordova_social_xsharing == true)
        {

        }

        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE DETAIL --|-- TS --|-- getJSON()

        //save page
        $db->SavePage($newPage);


        $db->Current();
        rebuild();

        header('Location: ./?p=addons&addons=wordpress-post&page-target=' . $page_target);
    }
}

// TODO: INIT


$disabled = '';
if ($current_page_target == '')
{
    $disabled = 'disabled';
}

$current_setting = $db->getAddOns('wordpress-post', $current_page_target);
if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}

if (!isset($current_setting['wp-url']))
{
    $current_setting['wp-url'] = '';
}
if (!isset($current_setting['cat-id']))
{
    $current_setting['cat-id'] = '1';
}

if (!isset($current_setting['page-title']))
{
    $current_setting['page-title'] = '';
}

if (!isset($current_setting['per-page']))
{
    $current_setting['per-page'] = '10';
}

if (!isset($current_setting['page-layout']))
{
    $current_setting['page-layout'] = 'showcase';
}

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['label-for-there-are-no-items']))
{
    $current_setting['label-for-there-are-no-items'] = 'There are no items';
}

if (!isset($current_setting['label-for-readmore']))
{
    $current_setting['label-for-readmore'] = 'Readmore';
}

if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-connection-lost']))
{
    $current_setting['label-for-connection-lost'] = 'Connection lost, please check your connection!';
}

if (!isset($current_setting['label-for-successfully']))
{
    $current_setting['label-for-successfully'] = 'Successfully retrieved data!';
}

if (!isset($current_setting['http-module']))
{
    $current_setting['http-module'] = 'angular';
}

if (!isset($current_setting['multiple-language']))
{
    $current_setting['multiple-language'] = false;
}


// TODO: LAYOUT
$content .= '<div class="row">';

$content .= '<div class="col-md-7">';
$content .= '<form action="" method="post">';

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Complete the fields below') . '</div>';
// TODO: LAYOUT --|-- FORM


$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="addons[page-target]" class="form-control">';
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
if ($current_setting['wp-url'] != '')
{
    $cat_link = $current_setting['wp-url'] . '/wp-json/wp/v2/categories?per_page=100';
} else
{
    $cat_link = 'https://yourwp/wp-json/wp/v2/categories?per_page=100';
}


$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select the page to be overwritten') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input type="text" name="addons[page-title]" class="form-control" placeholder="News" value="' . $current_setting['page-title'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="row">';
$content .= '<div class="col-md-8">';
$content .= '<div class="form-group">';
$content .= '<label for="wp-url">' . __e('WordPress URL') . '</label>';
$content .= '<input type="text" name="addons[wp-url]" class="form-control" placeholder="http://your_wordpress.org/"  value="' . $current_setting['wp-url'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Your wordpress site address') . '</p>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="col-md-4">';
$item_lists[] = array('value' => 'showcase', 'label' => 'Showcase');
$item_lists[] = array('value' => 'item-list', 'label' => 'Item List');
$item_lists[] = array('value' => 'item-thumbnail', 'label' => 'Item Thumbnail');

$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Layout Listing') . '</label>';
$content .= '<select name="addons[page-layout]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-layout'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Choose a layout for the post listing') . '</p>';
$content .= '</div>';

$content .= '</div>';
$content .= '</div>';

$content .= '<div class="row">';

$content .= '<div class="col-md-4">';
$content .= '<div class="form-group">';
$content .= '<label for="cat-id">' . __e('Category ID') . '</label>';
$content .= '<input type="number" name="addons[cat-id]" class="form-control" placeholder="12" value="' . $current_setting['cat-id'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('ID from Categories : <a target="blank" href="' . $cat_link . '">' . $cat_link . '</a>') . '</p>';
$content .= '</div>';
$content .= '</div>';

$content .= '<div class="col-md-4">';
$content .= '<div class="form-group">';
$content .= '<label for="cat-id">' . __e('Per Page') . '</label>';
$content .= '<input type="number" name="addons[per-page]" class="form-control" placeholder="10" value="' . $current_setting['per-page'] . '" required />';
$content .= '<p class="help-block">' . __e('Filter the number of items per page to show') . '</p>';
$content .= '</div>';
$content .= '</div>';


$options = array();
$options[] = array('value' => 'angular', 'label' => 'Angular (HTTP Client)');
$options[] = array('value' => 'cordova', 'label' => 'HTTP Advanced Cordova Plugin (Only Work on Real Device)');

$content .= '<div id="field-http-module" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-http-module">' . __e('HTTP Module') . '</label>';
$content .= '<select id="page-http-module" name="addons[http-module]" class="form-control" ' . $disabled . ' >';
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
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div>';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="addons[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="addons[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
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
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-multiple-language" name="addons[multiple-language]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-multiple-language" name="addons[multiple-language]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Multiple Language Support') . '</td>';
$content .= '</tr>';

$content .= '</table>';
$content .= '</div><!-- ./form-group -->';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress-post" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-THERE-ARE-NO-ITEMS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-there-are-no-items" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-there-are-no-items">' . __e('Label for `There are no items`') . '</label>';
$content .= '<input id="page-label-for-there-are-no-items" type="text" name="addons[label-for-there-are-no-items]" class="form-control" placeholder="There are no items"  value="' . $current_setting['label-for-there-are-no-items'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `There are no items`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-READMORE --|-- TEXT

$content .= '<div id="field-label-for-readmore" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-readmore">' . __e('Label for `Readmore`') . '</label>';
$content .= '<input id="page-label-for-readmore" type="text" name="addons[label-for-readmore]" class="form-control" placeholder="Readmore"  value="' . $current_setting['label-for-readmore'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Readmore`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT

$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="addons[label-for-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONNECTION-LOST --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-connection-lost" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-connection-lost">' . __e('Label for `Connection lost`') . '</label>';
$content .= '<input id="page-label-for-connection-lost" type="text" name="addons[label-for-connection-lost]" class="form-control" placeholder="Connection lost, please check your connection!"  value="' . $current_setting['label-for-connection-lost'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Connection lost, please check your connection!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY --|-- TEXT

$content .= '<div id="field-label-for-successfully" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully">' . __e('Label for `Successfully retrieved data!`') . '</label>';
$content .= '<input id="page-label-for-successfully" type="text" name="addons[label-for-successfully]" class="form-control" placeholder="Successfully retrieved data!"  value="' . $current_setting['label-for-successfully'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Successfully retrieved data!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress-post" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';


$content .= '</form>';
$content .= '</div>';

$content .= '<div class="col-md-5">';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Latest Used') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
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
        $content .= '<a href="./?p=addons&addons=wordpress-post&page-target=' . $pageList['page-target'] . '&a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&addons=wordpress-post&page-target=' . $pageList['page-target'] . '&a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&addons=wordpress-post&page-target=' . $pageList['page-target'] . '&a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$content .= '</div>';
$content .= '<div>';
$content .= $modal_dialog;
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Technical Guidelines') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('Some code will not run in the app, so to send data to the app use custom fields (Goto WordPress Dashboard -&raquo; Posts -&raquo; Options -&raquo; Advanced Panels -&raquo; Custom Fields)') . '</p>';
$content .= '<p>' . __e('Then install the plugin: <a href="https://wordpress.org/plugins/rest-api-helper/" target="_blank">rest-api-helper</a>') . '</p>';

$content .= '<h4>' . __e('Custom Fields') . '</h4>';

$content .= '<table class="table table-striped">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>Name</th>';
$content .= '<th>Example Value</th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';

$content .= '<tr>';
$content .= '<td>download</td>';
$content .= '<td>http://archive.ihsana.net/pdf/apk-push-notification.pdf</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>pdf</td>';
$content .= '<td>http://archive.ihsana.net/pdf/apk-push-notification.pdf</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>video</td>';
$content .= '<td>https://www.w3schools.com/html/mov_bbb.mp4</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>mp4</td>';
$content .= '<td>https://www.w3schools.com/html/mov_bbb.mp4</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>ogg</td>';
$content .= '<td>https://www.w3schools.com/html/mov_bbb.ogg</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>audio</td>';
$content .= '<td>https://www.w3schools.com/html/horse.mp3</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>mp3</td>';
$content .= '<td>https://www.w3schools.com/html/horse.mp3</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>iframe</td>';
$content .= '<td>https://www.youtube.com/embed/tgbNymZ7vqY</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>youtube</td>';
$content .= '<td>https://www.youtube.com/embed/tgbNymZ7vqY</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>geo</td>';
$content .= '<td>3,4</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>map</td>';
$content .= '<td>Silambau, Kinali, Pasaman Barat, Sumatera Barat, Indonesia</td>';
$content .= '</tr>';

$content .= '</tbody>';
$content .= '</table>';

$content .= '</div>';
$content .= '</div>';


$content .= '</div>';
$content .= '</div>';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){';
$page_js .= 'window.location= "?p=addons&addons=wordpress-post&page-target=" +  $("#page-target").val() ;';
$page_js .= 'return false;';
$page_js .= '});';
