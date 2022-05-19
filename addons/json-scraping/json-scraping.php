<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package `json-scraping`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = true;
// init class
$db = new jsmDatabase();
$icon = new jsmIcon();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$list_pages = $db->getPages();
$addons_settings = $db->getAddonsUsed("json-scraping");
$string = new jsmString();
if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));
if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('json-scraping', $current_page_target);
    header('Location: ./?p=addons&addons=json-scraping&' . time());
}
// TODO: POST
if (isset($_POST['save-json-scraping']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['json-scraping']['page-title']);
    $addons['url-list-item'] = str_replace("http://", "https://", trim($_POST['json-scraping']['url-list-item']));
    $addons['url-single-item'] = str_replace("http://", "https://", trim($_POST['json-scraping']['url-single-item']));
    $addons['var-list-item'] = trim($_POST['json-scraping']['var-list-item']);
    $addons['var-single-item'] = trim($_POST['json-scraping']['var-single-item']);
    $addons['template-list-item'] = trim($_POST['json-scraping']['template-list-item']);
    $addons['template-single-item'] = trim($_POST['json-scraping']['template-single-item']);

    $addons['auth-type'] = trim($_POST['json-scraping']['auth-type']);
    $addons['auth-uname'] = trim($_POST['json-scraping']['auth-uname']);
    $addons['auth-pwd'] = trim($_POST['json-scraping']['auth-pwd']);


    $addons['items-1st-load'] = (int)($_POST['json-scraping']['items-1st-load']);
    $addons['per-page'] = (int)($_POST['json-scraping']['per-page']);
    $addons['date-modified'] = time();
    $addons['page-header-color'] = trim($_POST['json-scraping']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['json-scraping']['page-content-background']);

    //enable-bookmark
    // checkbox
    if (isset($_POST['json-scraping']['enable-bookmark']))
    {
        $addons['enable-bookmark'] = true;
    } else
    {
        $addons['enable-bookmark'] = false;
    }


    //page-title-for-bookmark-page
    if (!isset($_POST['json-scraping']['page-title-for-bookmark-page']))
    {
        $_POST['json-scraping']['page-title-for-bookmark-page'] = 'Bookmarks';
    }
    $addons['page-title-for-bookmark-page'] = trim($_POST['json-scraping']['page-title-for-bookmark-page']); //text

    //variable-bookmark-title
    if (!isset($_POST['json-scraping']['variable-bookmark-title']))
    {
        $_POST['json-scraping']['variable-bookmark-title'] = '';
    }
    $addons['variable-bookmark-title'] = trim($_POST['json-scraping']['variable-bookmark-title']); //text

    //variable-bookmark-subtitle
    if (!isset($_POST['json-scraping']['variable-bookmark-subtitle']))
    {
        $_POST['json-scraping']['variable-bookmark-subtitle'] = '';
    }
    $addons['variable-bookmark-subtitle'] = trim($_POST['json-scraping']['variable-bookmark-subtitle']); //text

    //label-for-please-wait
    if (!isset($_POST['json-scraping']['label-for-please-wait']))
    {
        $_POST['json-scraping']['label-for-please-wait'] = 'Please wait...';
    }
    $addons['label-for-please-wait'] = trim($_POST['json-scraping']['label-for-please-wait']); //text

    //label-for-ok
    if (!isset($_POST['json-scraping']['label-for-ok']))
    {
        $_POST['json-scraping']['label-for-ok'] = 'Okey';
    }
    $addons['label-for-ok'] = trim($_POST['json-scraping']['label-for-ok']); //text

    //label-for-no-item
    if (!isset($_POST['json-scraping']['label-for-no-item']))
    {
        $_POST['json-scraping']['label-for-no-item'] = 'No item';
    }
    $addons['label-for-no-item'] = trim($_POST['json-scraping']['label-for-no-item']); //text


    if (isset($_POST['json-scraping']['infinite-scroll']))
    {
        $addons['infinite-scroll'] = true;
    } else
    {
        $addons['infinite-scroll'] = false;
    }
    //label-for-detail
    if (!isset($_POST['json-scraping']['label-for-detail']))
    {
        $_POST['json-scraping']['label-for-detail'] = 'Detail';
    }
    $addons['label-for-detail'] = trim($_POST['json-scraping']['label-for-detail']); //text

    //label-for-delete
    if (!isset($_POST['json-scraping']['label-for-delete']))
    {
        $_POST['json-scraping']['label-for-delete'] = 'Delete';
    }
    $addons['label-for-delete'] = trim($_POST['json-scraping']['label-for-delete']); //text

    //label-for-clean-up
    if (!isset($_POST['json-scraping']['label-for-clean-up']))
    {
        $_POST['json-scraping']['label-for-clean-up'] = 'Clean Up';
    }
    $addons['label-for-clean-up'] = trim($_POST['json-scraping']['label-for-clean-up']); //text

    $z = 0;
    foreach ($_POST['json-scraping']['custom-http-header'] as $http_header)
    {
        if ($http_header['var'] !== '')
        {
            $addons['custom-http-header'][$z]['var'] = htmlentities($http_header['var']);
            $addons['custom-http-header'][$z]['val'] = htmlentities($http_header['val']);
            $z++;
        }
    }


    $z = 0;
    foreach ($_POST['json-scraping']['vars'] as $var)
    {
        if ($z == 0)
        {
            $var['type'] = 'id';
        }
        if ($var['var'] !== '')
        {
            $addons['vars'][$z]['var'] = htmlentities($var['var']);
            $addons['vars'][$z]['type'] = htmlentities($var['type']);
            $addons['vars'][$z]['label'] = addslashes($var['label']);
            if (isset($var['list']))
            {
                $addons['vars'][$z]['list'] = true;
            } else
            {
                $addons['vars'][$z]['list'] = false;
            }
            if (isset($var['detail']))
            {
                $addons['vars'][$z]['detail'] = true;
            } else
            {
                $addons['vars'][$z]['detail'] = false;
            }
            $z++;
        }
    }
    if (!isset($addons['vars'][1]['var']))
    {
        $addons['vars'][1]['var'] = 'text';
    }
    if ($_POST['json-scraping']['var-id'] == '')
    {
        $_POST['json-scraping']['var-id'] = $addons['vars'][0]['var'];
    }
    if ($_POST['json-scraping']['search-by'] == '')
    {
        $_POST['json-scraping']['search-by'] = $addons['vars'][1]['var'];
    }


    //label-for-successfully-added-to-bookmark-list
    if (!isset($_POST['json-scraping']['label-for-successfully-added-to-bookmark-list']))
    {
        $_POST['json-scraping']['label-for-successfully-added-to-bookmark-list'] = 'Item successfully added to bookmark list';
    }
    $addons['label-for-successfully-added-to-bookmark-list'] = trim($_POST['json-scraping']['label-for-successfully-added-to-bookmark-list']); //text

    //label-for-successfully-retrieved-data
    if (!isset($_POST['json-scraping']['label-for-successfully-retrieved-data']))
    {
        $_POST['json-scraping']['label-for-successfully-retrieved-data'] = 'Successfully retrieved data!';
    }
    $addons['label-for-successfully-retrieved-data'] = trim($_POST['json-scraping']['label-for-successfully-retrieved-data']); //text

    //label-for-failed-to-retrieve-data-from-server
    if (!isset($_POST['json-scraping']['label-for-failed-to-retrieve-data-from-server']))
    {
        $_POST['json-scraping']['label-for-failed-to-retrieve-data-from-server'] = 'Failed to retrieve data from server!';
    }
    $addons['label-for-failed-to-retrieve-data-from-server'] = trim($_POST['json-scraping']['label-for-failed-to-retrieve-data-from-server']); //text


    $addons['var-id'] = trim($_POST['json-scraping']['var-id']);
    $addons['search-by'] = trim($_POST['json-scraping']['search-by']);
    $addons['search-type'] = trim($_POST['json-scraping']['search-type']);
    $addons['icon-default'] = trim($_POST['json-scraping']['icon-default']);
    $addons['currency-symbol'] = trim($_POST['json-scraping']['currency-symbol']);

    $addons['readmore'] = trim($_POST['json-scraping']['readmore']);
    $addons['no-item'] = $addons['label-for-no-item'];

    $db->saveAddOns('json-scraping', $addons);

    // TODO: -----------------------------------------------
    // TODO: GENERATOR --|-- SERVICES --|-- RETRIEVED-DATA
    $cordova_social_xsharing = false;
    foreach ($addons['vars'] as $item_var)
    {
        if ($item_var['type'] == 'social-share')
        {
            $cordova_social_xsharing = true;
        }
    }
    $create_single_page = true;
    if ($addons['template-single-item'] == 'none')
    {
        $create_single_page = false;
    }
    if (substr($addons['template-single-item'], 0, 8) == 'link-to-')
    {
        $create_single_page = false;
    }

    $service['name'] = $addons['page-target'];
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get ' . $current_page_target . ' data (online)';
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


    switch ($addons['auth-type'])
    {
        case 'basic':
            break;
        case 'token':

            break;
    }


    $service['code']['other'] = null;

    $service['code']['other'] .= "\t" . 'urlListItem : string = "' . $addons['url-list-item'] . '";' . "\r\n";
    if ($create_single_page == true)
    {
        if ($addons['url-single-item'] != '')
        {
            $service['code']['other'] .= "\t" . 'urlDetailItem : string = "' . $addons['url-single-item'] . '";' . "\r\n";
        }
    }
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    switch ($addons['auth-type'])
    {
        case 'basic':
            $service['code']['other'] .= "\t" . 'authUname: string = "' . $addons['auth-uname'] . '" ;' . "\r\n";
            $service['code']['other'] .= "\t" . 'authPwd: string = "' . $addons['auth-pwd'] . '" ;' . "\r\n";
            break;
        case 'token':
            //$service['code']['other'] .= "\t" . 'authToken: string ;' . "\r\n";
            break;
    }

    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- RETRIEVED-DATA --|-- getItems

    if ($addons['auth-type'] == 'token')
    {
        if (preg_match("/{id}/", $addons['url-list-item']))
        {
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* getItems(paramId,useToken)' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'getItems(paramId:string,useToken:string): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let apiUrl = this.urlListItem.replace("{id}",paramId);' . "\r\n";
        } else
        {
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* getItems(useToken)' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'getItems(useToken:string): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let apiUrl = this.urlListItem;' . "\r\n";
        }

    } else
    {
        if (preg_match("/{id}/", $addons['url-list-item']))
        {
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* getItems(paramId)' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'getItems(paramId:string): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let apiUrl = this.urlListItem.replace("{id}",paramId);' . "\r\n";
        } else
        {
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* getItems()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'getItems(): Observable<any>{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'let apiUrl = this.urlListItem;' . "\r\n";
        }
    }
    $service['code']['other'] .= "\t\t" . '//console.log("apiUrl", apiUrl);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";


    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    switch ($addons['auth-type'])
    {
        case 'basic':
            $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.authUname + ":" + this.authPwd),' . "\r\n";
            break;
        case 'token':
            $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Bearer " + useToken,' . "\r\n";
            break;
    }
    if (!isset($addons['custom-http-header']))
    {
        $addons['custom-http-header'] = array();
    }
    foreach ($addons['custom-http-header'] as $http_header)
    {
        if ($http_header['var'] != '')
        {
            $service['code']['other'] .= "\t\t\t\t" . '"' . $http_header['var'] . '": "' . $http_header['val'] . '" ,' . "\r\n";
        }
    }
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";

    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(apiUrl,httpOptions)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getItems`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-retrieved-data'] . '`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getItems`,`catchError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,`' . $addons['label-for-failed-to-retrieve-data-from-server'] . '`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getItems`,`rethrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    if ($create_single_page == true)
    {
        if ($addons['url-single-item'] != '')
        {
            // TODO: GENERATOR --|-- SERVICES --|-- RETRIEVED-DATA --|-- getItem
            if ($addons['auth-type'] == 'token')
            {
                $service['code']['other'] .= "\t" . '/**' . "\r\n";
                $service['code']['other'] .= "\t" . '* getItem(paramId,useToken)' . "\r\n";
                $service['code']['other'] .= "\t" . '**/' . "\r\n";
                $service['code']['other'] .= "\t" . 'getItem(paramId:string,useToken:string): Observable<any>{' . "\r\n";
            } else
            {
                $service['code']['other'] .= "\t" . '/**' . "\r\n";
                $service['code']['other'] .= "\t" . '* getItem(paramId)' . "\r\n";
                $service['code']['other'] .= "\t" . '**/' . "\r\n";
                $service['code']['other'] .= "\t" . 'getItem(paramId:string): Observable<any>{' . "\r\n";
            }


            $service['code']['other'] .= "\t\t" . 'let apiUrl = this.urlDetailItem.replace("{id}",paramId);' . "\r\n";
            $service['code']['other'] .= "\t\t" . '//console.log("apiUrl", apiUrl);' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";

            $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
            switch ($addons['auth-type'])
            {
                case 'basic':
                    $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Basic " + btoa(this.authUname + ":" + this.authPwd),' . "\r\n";
                    break;
                case 'token':
                    $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Bearer " + useToken,' . "\r\n";
                    break;
            }
            if (!isset($addons['custom-http-header']))
            {
                $addons['custom-http-header'] = array();
            }
            foreach ($addons['custom-http-header'] as $http_header)
            {
                if ($http_header['var'] != '')
                {
                    $service['code']['other'] .= "\t\t\t\t" . '"' . $http_header['var'] . '": "' . $http_header['val'] . '" ,' . "\r\n";
                }
            }

            $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
            $service['code']['other'] .= "\t\t" . '}' . "\r\n";


            $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(apiUrl,httpOptions)' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
            if ($is_debug == true)
            {
                $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getItem`,results);' . "\r\n";
            }
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-retrieved-data'] . '`);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
            if ($is_debug == true)
            {
                $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getItem`,`catchError`, err);' . "\r\n";
            }
            $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,`' . $addons['label-for-failed-to-retrieve-data-from-server'] . '`);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
            if ($is_debug == true)
            {
                $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getItem`,`rethrown`, err);' . "\r\n";
            }
            $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
            $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
        }
    }


    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: `' . $addons['label-for-please-wait'] . '`,' . "\r\n";
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
    $service['code']['other'] .= "\t" . '* showToast(message)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message:string){' . "\r\n";
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
    $service['code']['other'] .= "\t" . '* showAlert(header,subheader,message)' . "\r\n";
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
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, $current_page_target);


    if ($addons['enable-bookmark'] == true)
    {
        // TODO: GENERATOR --|-- PROJECT --|--
        $new_project = $current_app['apps'];
        $new_project['ionic-storage'] = true;
        $db->saveProject($new_project);

        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|--
        $service = null;
        $service['name'] = $current_page_target . '-storage';
        $service['instruction'] = '';
        $service['desc'] = 'This service is to get ' . $current_page_target . ' data (local)';

        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- MODULES

        $service['code']['other'] = null;
        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- getItems(table:string)
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'StorageService.getItems(table:string)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'public async getItems(table:string){' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'let data:any = [] ;' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'this.storage.forEach((val,key,index) => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . 'if(key.substring(0,prefix.length) ==  prefix){' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'data.push(val);' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t\t" . '});' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return await data;' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- getItem(table:string,key:string)
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'StorageService.getItem(table:string,key:string)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'public async getItem(table:string,key:string){' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return await this.storage.get(`${table}:${key}`);' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- setItem(table:string,key:string,val:any)
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'StorageService.setItem(table:string,key:string,val:any)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'public async setItem(table:string,key:string,value:any){' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return await this.storage.set(`${table}:${key}`,value);' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- removeItem(table:string,key:string)
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'StorageService.removeItem(table:string,key:string)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'public async removeItem(table:string,key:string){' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return await this.storage.remove(`${table}:${key}`);' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- clearItems(table:string)
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'StorageService.clearItems(table:string)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'public async clearItems(table:string) {' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . 'if(iKey.substring(0,prefix.length) ==  prefix){' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'this.storage.remove(`${iKey}`);' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t\t" . '});' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";

        $db->saveService($service, $current_page_target . '-storage');
    } else
    {
        $db->deleteService($current_page_target . '-storage');
    }


    // TODO: -----------------------------------------------
    // create properties for page
    // TODO: POST --|-- PAGE LIST
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $addons['page-target'];
    $newPage['code-by'] = 'json-scraping';

    $newPage['date-modified'] = time();

    $newPage['icon-left'] = 'cube';
    $newPage['icon-right'] = 'cube';

    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['back-button'] = '/auto';

    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];

    if (!isset($addons['search-type']))
    {
        $addons['search-type'] = 'search';
    }
    $newPage['header']['mid']['type'] = $addons['search-type'];

    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    //$newPage['content']['disable-ion-content'] = true;


    if ($addons['enable-bookmark'] == true)
    {
        $newPage['header']['mid']['type'] = 'custom-header';
        $newPage['header']['mid']['custom-code'] = null;
        $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-header page-product-detail-header class="page-product-detail-header">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-buttons slot="start">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-menu-button></ion-menu-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-buttons>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-title>' . $addons['page-title'] . '</ion-title>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-buttons slot="end">' . "\r\n";
        if ($addons['search-type'] == 'search-with-barcode')
        {
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button (click)="scanBarcode()"><ion-icon name="barcode"></ion-icon></ion-button>' . "\r\n";
        }
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/' . $current_page_target . '-bookmarks\']">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="heart"></ion-icon>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-badge *ngIf="count_bookmarks!=0" color="danger">{{ count_bookmarks }}</ion-badge>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button (click)="showPopover($event)">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="ellipsis-vertical-outline"></ion-icon>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-buttons>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";

        if ($addons['search-type'] == 'search-with-barcode')
        {
            $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-toolbar app-searchbar color="primary">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-searchbar [(ngModel)]="filterQuery" (ionInput)="filterItems($event)" ></ion-searchbar>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
        }
        if ($addons['search-type'] == 'search')
        {
            $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-toolbar app-searchbar color="primary">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-searchbar [(ngModel)]="filterQuery" (ionInput)="filterItems($event)" ></ion-searchbar>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
        }

        $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-header>' . "\r\n";
    }


    // TODO: POST --|-- PAGE LIST --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $getClassName = $string->toClassName($current_page_target);
    $varName = strtolower($getClassName[0]) . substr($getClassName, 1, strlen($getClassName)) . 'Service';
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$z]['var'] = $varName;
    $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';

    if ($addons['enable-bookmark'] == true)
    {
        $z++;
        $varNameStorage = strtolower($getClassName[0]) . substr($getClassName, 1, strlen($getClassName)) . 'StorageService';
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'StorageService';
        $newPage['modules']['angular'][$z]['var'] = $varNameStorage;
        $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '-storage/' . $current_page_target . '-storage.service';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'ToastController';
        $newPage['modules']['angular'][$z]['var'] = 'toastController';
        $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    }

    if ($addons['infinite-scroll'] == true)
    {
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'ViewChild';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = '@angular/core';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'IonInfiniteScroll';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    }

    if ($addons['search-type'] == 'search-with-barcode')
    {
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'BarcodeScanner';
        $newPage['modules']['angular'][$z]['var'] = 'barcodeScanner';
        $newPage['modules']['angular'][$z]['path'] = '@ionic-native/barcode-scanner/ngx';
        $newPage['modules']['angular'][$z]['native'] = '@ionic-native/barcode-scanner';
        $newPage['modules']['angular'][$z]['cordova'] = 'phonegap-plugin-barcodescanner';
    }
    if (preg_match("/{id}/", $addons['url-list-item']))
    {
        $newPage['param'] = 'param_id';
    }


    // TODO: POST --|-- PAGE LIST --|-- HTML
    $newPage['content']['html'] = null;
    switch ($addons['template-list-item'])
    {
            // TODO: POST --|-- PAGE LIST --|-- HTML --|-- PRINT
        case "print":
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let item of data' . $string->toClassName($addons['page-target']) . '">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<pre>{{ item | json }}</pre>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
            if ($addons['template-single-item'] != 'none')
            {
                if (substr($addons['template-single-item'], 0, 8) != 'link-to-')
                {
                    $newPage['content']['html'] .= "\t\t" . '<ion-item button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($addons['page-target']) . '-detail\',item.' . htmlentities($addons['var-id']) . ']" >' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="more" slot="start"></ion-icon>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $addons['readmore'] . '</ion-label>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                }
            }
            if (substr($addons['template-single-item'], 0, 8) == 'link-to-')
            {
                $link_to_page = $string->toFilename(substr($addons['template-single-item'], 8, strlen($addons['template-single-item'])));
                $newPage['content']['html'] .= "\t\t" . '<ion-item button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $link_to_page . '\',item.' . htmlentities($addons['var-id']) . ']">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="more" slot="start"></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $addons['readmore'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            break;
        case 'card':
            // TODO: POST --|-- PAGE LIST --|-- HTML --|-- CARD
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="filterData' . $string->toClassName($addons['page-target']) . '.length == 0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . $addons['no-item'] . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let item of filterData' . $string->toClassName($addons['page-target']) . '" >' . "\r\n";
            $newPage['content']['html'] .= item_listing($addons);
            if ($addons['template-single-item'] != 'none')
            {
                if (substr($addons['template-single-item'], 0, 8) != 'link-to-')
                {
                    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-button size="normal" fill="clear" slot="end" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($addons['page-target']) . '-detail\',item.' . htmlentities($addons['var-id']) . ']"><ion-icon name="ellipsis-vertical-outline" slot="start"></ion-icon> ' . $addons['readmore'] . '</ion-button>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

                }
            }
            if (substr($addons['template-single-item'], 0, 8) == 'link-to-')
            {
                $link_to_page = $string->toFilename(substr($addons['template-single-item'], 8, strlen($addons['template-single-item'])));
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-button size="normal" fill="clear" slot="end" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $link_to_page . '\',item.' . htmlentities($addons['var-id']) . ']"><ion-icon name="ellipsis-vertical-outline" slot="start"></ion-icon> ' . $addons['readmore'] . '</ion-button>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            if ($addons['infinite-scroll'] == true)
            {
                $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll threshold="100px" id="infinite-scroll" (ionInfinite)="loadMore($event)">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content loading-spinner="bubbles" loading-text="Loading more data..."></ion-infinite-scroll-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
            }
            break;
        case 'list':
            // TODO: POST --|-- PAGE LIST --|-- HTML --|-- LIST
            $link_to_detail = null;
            if ($addons['template-single-item'] != 'none')
            {
                if (substr($addons['template-single-item'], 0, 8) != 'link-to-')
                {
                    $link_to_detail = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($addons['page-target']) . '-detail\',item.' . htmlentities($addons['var-id']) . ']" ';
                }
            }
            if (substr($addons['template-single-item'], 0, 8) == 'link-to-')
            {
                $link_to_page = $string->toFilename(substr($addons['template-single-item'], 8, strlen($addons['template-single-item'])));
                $link_to_detail = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $link_to_page . '\',item.' . htmlentities($addons['var-id']) . ']" ';
            }
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="filterData' . $string->toClassName($addons['page-target']) . '.length == 0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item>' . $addons['no-item'] . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let item of filterData' . $string->toClassName($addons['page-target']) . '" ' . $link_to_detail . ' >' . "\r\n";
            $newPage['content']['html'] .= item_listing($addons);
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            if ($addons['infinite-scroll'] == true)
            {
                $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll threshold="100px" id="infinite-scroll" (ionInfinite)="loadMore($event)">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content loading-spinner="bubbles" loading-text="Loading more data..."></ion-infinite-scroll-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
            }
            break;


        case 'group':
            // TODO: POST --|-- PAGE LIST --|-- HTML --|-- GROUP
            $link_to_detail = null;
            if ($addons['template-single-item'] != 'none')
            {
                if (substr($addons['template-single-item'], 0, 8) != 'link-to-')
                {
                    $link_to_detail = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($addons['page-target']) . '-detail\',item.' . htmlentities($addons['var-id']) . ']" ';
                }
            }
            if (substr($addons['template-single-item'], 0, 8) == 'link-to-')
            {
                $link_to_page = $string->toFilename(substr($addons['template-single-item'], 8, strlen($addons['template-single-item'])));
                $link_to_detail = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $link_to_page . '\',item.' . htmlentities($addons['var-id']) . ']" ';
            }
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="filterData' . $string->toClassName($addons['page-target']) . '.length == 0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item>' . $addons['no-item'] . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item-group>' . "\r\n";
            for ($c = 65; $c <= 90; $c++)
            {
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-item-divider>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . strtoupper(chr($c)) . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-item-divider>' . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-item *ngFor="let item of firstCharacter(filterData' . $string->toClassName($addons['page-target']) . ',\'' . strtolower(chr($c)) . '\')" ' . $link_to_detail . '>' . "\r\n";
                $newPage['content']['html'] .= item_listing($addons);
                $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label></ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";

            }
            $newPage['content']['html'] .= "\t\t" . '</ion-item-group>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            if ($addons['infinite-scroll'] == true)
            {
                $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll threshold="100px" id="infinite-scroll" (ionInfinite)="loadMore($event)">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content loading-spinner="bubbles" loading-text="Loading more data..."></ion-infinite-scroll-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
            }
            break;


        case 'chip':
            // TODO: POST --|-- PAGE LIST --|-- HTML --|-- CHIP
            $link_to_detail = null;
            if ($addons['template-single-item'] != 'none')
            {
                if (substr($addons['template-single-item'], 0, 8) != 'link-to-')
                {
                    $link_to_detail = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($addons['page-target']) . '-detail\',item.' . htmlentities($addons['var-id']) . ']" ';
                }
            }
            if (substr($addons['template-single-item'], 0, 8) == 'link-to-')
            {
                $link_to_page = $string->toFilename(substr($addons['template-single-item'], 8, strlen($addons['template-single-item'])));
                $link_to_detail = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $link_to_page . '\',item.' . htmlentities($addons['var-id']) . ']" ';
            }
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="filterData' . $string->toClassName($addons['page-target']) . '.length == 0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item>' . $addons['no-item'] . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-chip *ngFor="let item of filterData' . $string->toClassName($addons['page-target']) . '" ' . $link_to_detail . ' >' . "\r\n";
            $newPage['content']['html'] .= item_listing($addons);
            $newPage['content']['html'] .= "\t\t" . '</ion-chip>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . "\r\n";
            if ($addons['infinite-scroll'] == true)
            {
                $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll threshold="100px" id="infinite-scroll" (ionInfinite)="loadMore($event)">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content loading-spinner="bubbles" loading-text="Loading more data..."></ion-infinite-scroll-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
            }
            break;
    }
    // TODO: POST --|-- PAGE LIST --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.8;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    // TODO: POST --|-- PAGE LIST --|-- TS
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['enable-bookmark'] == true)
    {
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'filterQuery: string = "";' . "\r\n";
        if ($addons['search-type'] == 'search-with-barcode')
        {
            $newPage['code']['other'] .= "\t" . 'barcodeResult: string = "";' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:scanBarcode()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'public scanBarcode()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '{' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.barcodeScanner.scan({orientation:"portrait"}).then(barcodeData => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'this.filterQuery = barcodeData.text;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '}).catch(err => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'console.log("barcode", err);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        }
    }
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . $string->toUserClassName($addons['page-target']) . ': Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'data' . $string->toClassName($addons['page-target']) . ': any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'filterData' . $string->toClassName($addons['page-target']) . ': any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['enable-bookmark'] == true)
    {
        $newPage['code']['constructor'] = null;
        $newPage['code']['constructor'] .= "\t\t" . '//badge for bookmarks' . "\r\n";
        $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
        $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'count_bookmarks:number = 0;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'temp_count_bookmarks:number = 0 ;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'item_bookmarks : any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'runBadge: any;' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:createBadge()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'createBadge(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.runBadge = setInterval(()=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.getBadges();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '},1000)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:ionViewDidLeave()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'ionViewDidLeave(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'clearInterval(this.runBadge);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:getBadges()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'getBadges(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getBookmarks();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '*  ' . $string->toClassName($addons['page-target']) . '.getBookmarks()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public async getBookmarks(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.count_bookmarks = this.temp_count_bookmarks;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.temp_count_bookmarks = 0;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.item_bookmarks = []; ' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'let bookmarkKey = iKey.substring(0,' . strlen($current_page_target . '-bookmark:') . ');' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'console.log(`key`,bookmarkKey);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if( bookmarkKey ==  `' . $current_page_target . '-bookmark:`){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.pushBookmark(iValue);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $pageClass . '.pushBookmark(item)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'private pushBookmark(item){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.temp_count_bookmarks++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.item_bookmarks.push(item);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

    }


    if ($addons['infinite-scroll'] == true)
    {
        $newPage['code']['other'] .= "\t" . '//for infinite-scroll' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'lastId:number = 0;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'firstLoad:number = ' . (int)$addons['items-1st-load'] . ';' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'perPage:number = ' . (int)$addons['per-page'] . ';' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '@ViewChild("IonInfiniteScroll",{static: false}) infiniteScroll: IonInfiniteScroll;' . "\r\n";

        $newPage['code']['other'] .= "\t" . '' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    if ($addons['enable-bookmark'] == true)
    {
        // TODO: POST --|-- PAGE LIST --|-- TS --|-- saveBookmark()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:saveBookmark(data:any)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'saveBookmark(dataId:string,data:any){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.' . $varNameStorage . '.setItem(`' . $current_page_target . '-bookmark`,dataId,data).then(()=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-added-to-bookmark-list'] . '`);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:showToast(message:string)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async showToast(message:string){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

    }

    // TODO: POST --|-- PAGE LIST --|-- TS --|-- getItems()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:getItems()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'getItems(){' . "\r\n";

    if ($addons['auth-type'] == 'token')
    {
        $newPage['code']['other'] .= "\t\t" . 'this.storage.get("current_user").then((current_user) => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'console.log("storage","current_user", current_user);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if(current_user && current_user.token){' . "\r\n";
        if (preg_match("/{id}/", $addons['url-list-item']))
        {
            $newPage['code']['other'] .= "\t\t\t\t" . 'if(this.paramId == null){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.paramId = "-1";' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItems(this.paramId,current_user.token);' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItems(current_user.token);' . "\r\n";
        }
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . '.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = data' . $addons['var-list-item'] . ' ;' . "\r\n";
        if ($addons['infinite-scroll'] == true)
        {
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.lastId = 0;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'let newData : any = [];' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'for (let item of data' . $addons['var-list-item'] . ') {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'if(this.lastId <= (this.firstLoad -1) ) {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'newData[this.lastId] = item;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . '//console.log(this.lastId);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.lastId++;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = newData;' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = data' . $addons['var-list-item'] . ' ;' . "\r\n";
        }
        $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";

        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    } else
    {
        if (preg_match("/{id}/", $addons['url-list-item']))
        {
            $newPage['code']['other'] .= "\t\t" . 'if(this.paramId == null){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'this.paramId = "-1";' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItems(this.paramId);' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItems();' . "\r\n";
        }
        $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . '.subscribe(data => {' . "\r\n";

        if (preg_match("/{id}/", $addons['url-list-item']))
        {
            if (substr($addons['url-list-item'], 0, 4) != 'http')
            {
                if ($var_offline[0] == '')
                {
                    $var_offline[0] = 'cat_id';
                }
                $var_offline = explode("=", parse_url($addons['url-list-item'], PHP_URL_QUERY));
                $newPage['code']['other'] .= "\t\t\t" . '// replace query_id' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'let offLineId:number = 0;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'let offlineData : any = [];' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . 'if(item["' . $var_offline[0] . '"] == this.paramId){' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'offlineData[offLineId] = item;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'offLineId++;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'data = offlineData;' . "\r\n";
            }
        }

        $newPage['code']['other'] .= "\t\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = data' . $addons['var-list-item'] . ' ;' . "\r\n";
        if ($addons['infinite-scroll'] == true)
        {
            $newPage['code']['other'] .= "\t\t\t" . 'this.lastId = 0;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'let newData : any = [];' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data' . $addons['var-list-item'] . ') {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'if(this.lastId <= (this.firstLoad -1) ) {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'newData[this.lastId] = item;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . '//console.log(this.lastId);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.lastId++;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = newData;' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = data' . $addons['var-list-item'] . ' ;' . "\r\n";
        }
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    }


    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: POST --|-- PAGE LIST --|-- TS --|-- filterItems()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:filterItems($event)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
    $newPage['code']['other'] .= "\t" . '*' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = this.data' . $string->toClassName($addons['page-target']) . ';' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = this.data' . $string->toClassName($addons['page-target']) . '.filter((newItem) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(newItem.' . $addons['search-by'] . '){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'return newItem.' . $addons['search-by'] . '.toLowerCase().indexOf(filterVal.toLowerCase()) > -1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['infinite-scroll'] == true)
    {
        // TODO: POST --|-- PAGE LIST --|-- TS --|-- loadMore(event)
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:loadMore(event)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* @param event $event' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public loadMore(event){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let newData : any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let nextPage:number = this.perPage + this.lastId;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'for (let item of this.data' . $string->toClassName($addons['page-target']) . '){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if(this.lastId < this.data' . $string->toClassName($addons['page-target']) . '.length){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'if(this.lastId < nextPage){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . '[this.lastId] = this.data' . $string->toClassName($addons['page-target']) . '[this.lastId];' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . '//console.log("more data",this.lastId);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.lastId++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'event.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'if( this.lastId >= this.data' . $string->toClassName($addons['page-target']) . '.length){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'event.target.enable = false;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
    }
    // TODO: POST --|-- PAGE LIST --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 100);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE LIST --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterData' . $string->toClassName($addons['page-target']) . ' = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    switch ($addons['template-list-item'])
    {
        case "group":
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            // TODO: POST --|-- PAGE LIST --|-- TS --|-- firstCharacter()
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:firstCharacter(data:any,char:string)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'firstCharacter(data:any,char:string){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let newData:any = [] ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'for (let item of data){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'let title:string = item.' . $addons['search-by'] . '.toLowerCase() ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if(title.substring(0, 1) == char){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'newData = newData.concat(item);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'return newData;' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";

            break;
    }
    // TODO: -----------------------------------------------

    //generate page code
    $db->savePage($newPage);
    if ($create_single_page == true)
    {
        // TODO: POST --|-- PAGE DETAIL
        $newPage = null;
        $newPage['code-by'] = 'json-scraping';
        $newPage['title'] = 'Detail';
        $newPage['name'] = $current_page_target . '-detail';
        $newPage['var'] = $current_page_target . '_detail';
        $newPage['date-modified'] = time();
        $newPage['icon-left'] = 'menu';
        $newPage['icon-right'] = '';
        $newPage['header']['color'] = $addons['page-header-color'];
        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['page-content-background'];
        $newPage['back-button'] = '/auto';
        $newPage['header']['mid']['type'] = 'title';
        $newPage['header']['mid']['items'][0]['label'] = '';
        $newPage['header']['mid']['items'][0]['value'] = '';
        $newPage['header']['mid']['items'][1]['label'] = '';
        $newPage['header']['mid']['items'][1]['value'] = '';
        $newPage['header']['mid']['items'][2]['label'] = '';
        $newPage['header']['mid']['items'][2]['value'] = '';
        //$newPage['back-button'] = '/' . $current_page_target;
        if ($addons['enable-bookmark'] == true)
        {
            $newPage['header']['mid']['type'] = 'custom-header';
            $newPage['header']['mid']['custom-code'] = null;
            $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-header page-product-detail-header class="page-product-detail-header">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-buttons slot="start">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-back-button defaultHref="' . $addons['page-target'] . '"></ion-back-button>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-buttons>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-title>' . $addons['page-title'] . '</ion-title>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-buttons slot="end">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/' . $current_page_target . '-bookmarks\']">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="heart"></ion-icon>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-badge *ngIf="count_bookmarks!=0" color="danger">{{ count_bookmarks }}</ion-badge>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '<ion-button (click)="showPopover($event)">' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t\t" . '<ion-icon name="ellipsis-vertical-outline"></ion-icon>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '</ion-buttons>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-toolbar>' . "\r\n";
            $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-header>' . "\r\n";
        }


        $newPage['back-button'] = '/auto';

        // TODO: POST --|-- PAGE DETAIL --|-- MODULES
        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';

        $z++;
        $getClassName = $string->toClassName($current_page_target);
        $varName = strtolower($getClassName[0]) . substr($getClassName, 1, strlen($getClassName)) . 'Service';
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'Service';
        $newPage['modules']['angular'][$z]['var'] = $varName;
        $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';


        if ($addons['enable-bookmark'] == true)
        {
            $z++;
            $varNameStorage = strtolower($getClassName[0]) . substr($getClassName, 1, strlen($getClassName)) . 'StorageService';
            $newPage['modules']['angular'][$z]['enable'] = true;
            $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'StorageService';
            $newPage['modules']['angular'][$z]['var'] = $varNameStorage;
            $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '-storage/' . $current_page_target . '-storage.service';

            $z++;
            $newPage['modules']['angular'][$z]['enable'] = true;
            $newPage['modules']['angular'][$z]['class'] = 'ToastController';
            $newPage['modules']['angular'][$z]['var'] = 'toastController';
            $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

        }


        $newPage['param'] = $addons['vars'][0]['var'];
        // TODO: POST --|-- PAGE DETAIL --|-- HTML
        $newPage['content']['html'] = null;
        switch ($addons['template-single-item'])
        {
                // TODO: POST --|-- PAGE DETAIL --|-- HTML --|-- PRINT
            case "print":
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<pre>{{ ' . $string->toUserClassName($addons['var-id']) . ' | json }}</pre>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<pre>{{ data' . $string->toClassName($addons['page-target']) . ' | json }}</pre>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE DETAIL --|-- HTML --|-- CARD
            case 'card':
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="data' . $string->toClassName($addons['page-target']) . '">' . "\r\n";
                $newPage['content']['html'] .= item_detail($addons);
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                break;
                // TODO: POST --|-- PAGE DETAIL --|-- HTML --|-- LIST
            case 'list':
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-list inset *ngIf="data' . $string->toClassName($addons['page-target']) . '">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= item_detail($addons);
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                break;
        }
        /// TODO: POST --|-- PAGE DETAIL --|-- SCSS
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'opacity:0.8;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

        // TODO: POST --|-- PAGE DETAIL --|-- TS
        $newPage['code']['other'] = null;
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        if ($cordova_social_xsharing == true)
        {
        }
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . $string->toUserClassName($addons['page-target']) . ': Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'data' . $string->toClassName($addons['page-target']) . ': any = {};' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        if ($addons['enable-bookmark'] == true)
        {
            $newPage['code']['constructor'] = null;
            $newPage['code']['constructor'] .= "\t\t" . '//badge for bookmarks' . "\r\n";
            $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
            $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'count_bookmarks:number = 0;' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'temp_count_bookmarks:number = 0 ;' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'item_bookmarks : any = [];' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'runBadge: any;' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:createBadge()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'createBadge(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.runBadge = setInterval(()=>{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'this.getBadges();' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '},1000)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:ionViewDidLeave()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'ionViewDidLeave(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'clearInterval(this.runBadge);' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:getBadges()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'getBadges(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.getBookmarks();' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '*  ' . $string->toClassName($addons['page-target'] . '-detail') . '.getBookmarks()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'public async getBookmarks(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.count_bookmarks = this.temp_count_bookmarks;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.temp_count_bookmarks = 0;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.item_bookmarks = []; ' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'let bookmarkKey = iKey.substring(0,' . strlen($current_page_target . '-bookmark:') . ');' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'console.log(`key`,bookmarkKey);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if( bookmarkKey ==  `' . $current_page_target . '-bookmark:`){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.pushBookmark(iValue);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $pageClass . '.pushBookmark(item)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'private pushBookmark(item){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.temp_count_bookmarks++;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.item_bookmarks.push(item);' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";

            // TODO: POST --|-- PAGE DETAIL --|-- TS --|-- saveBookmark()
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:saveBookmark(data:any)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'saveBookmark(dataId:string,data:any){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.' . $varNameStorage . '.setItem(`' . $current_page_target . '-bookmark`,dataId,data).then(()=>{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-successfully-added-to-bookmark-list'] . '`);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";

            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:showToast(message:string)' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'async showToast(message:string){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";

        }

        // TODO: POST --|-- PAGE DETAIL --|-- TS --|-- getItem()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:getJSON(url: string)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public getItem(){' . "\r\n";

        if ($addons['auth-type'] == 'token')
        {


            $newPage['code']['other'] .= "\t\t" . 'this.storage.get("current_user").then((current_user) => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'console.log("storage","current_user", current_user);' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if(current_user && current_user.token){' . "\r\n";

            if ($addons['url-single-item'] == '')
            {
                $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItems(current_user.token);' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . '.subscribe(data => {' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'for (let item of data' . $addons['var-list-item'] . '){' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'if( item.' . $addons['var-id'] . '.toString() === this.' . $string->toUserClassName($addons['var-id']) . '.toString()){' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = item ;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t\t" . '//console.log(item.' . $addons['var-id'] . '.toString(),this.' . $string->toUserClassName($addons['var-id']) . '.toString());' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . '};' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
            } else
            {
                $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItem(this.' . $string->toUserClassName($addons['var-id']) . ',current_user.token);' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . '.subscribe(data => {' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = data' . $addons['var-single-item'] . ' ;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
            }

            //$newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";

            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";

        } else
        {
            if ($addons['url-single-item'] == '')
            {
                $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItems();' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . '.subscribe(data => {' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data' . $addons['var-list-item'] . '){' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . 'if( item.' . $addons['var-id'] . '.toString() === this.' . $string->toUserClassName($addons['var-id']) . '.toString()){' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = item ;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '//console.log(item.' . $addons['var-id'] . '.toString(),this.' . $string->toUserClassName($addons['var-id']) . '.toString());' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . '};' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            } else
            {
                $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . ' = this.' . $varName . '.getItem(this.' . $string->toUserClassName($addons['var-id']) . ');' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($addons['page-target']) . '.subscribe(data => {' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = data' . $addons['var-single-item'] . ' ;' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            }
        }
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: POST --|-- PAGE DETAIL --|-- TS --|-- doRefresh()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:doRefresh()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = {};' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 100);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getItem();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: POST --|-- PAGE DETAIL --|-- TS --|-- ngOnInit()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target'] . '-detail') . 'Page:ngOnInit()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.data' . $string->toClassName($addons['page-target']) . ' = {};' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getItem();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        //save page
        $db->SavePage($newPage);
    } else
    {
        $db->deletePage($current_page_target . '-detail');
    }

    if ($addons['enable-bookmark'] == true)
    {
        // TODO: ----------------------------------------------------------------------------------------------------
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS
        $newPage = null;
        $newPage['title'] = $addons['page-title-for-bookmark-page'];
        $newPage['name'] = $current_page_target . "-bookmarks";
        $newPage['code-by'] = 'woocommerce';
        $newPage['icon-left'] = 'heart-circle';
        $newPage['statusbar']['style'] = 'lightcontent';
        $newPage['statusbar']['backgroundcolor'] = $db->getRawColor($addons['page-header-color']);
        $newPage['icon-right'] = '';
        $newPage['header']['color'] = $addons['page-header-color'];
        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['page-content-background'];
        $newPage['back-button'] = '/auto';
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- HEADER
        $newPage['header']['mid']['type'] = 'title';
        $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
        $newPage['header']['mid']['items'][0]['value'] = 'tab1';
        $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
        $newPage['header']['mid']['items'][1]['value'] = 'tab2';
        $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
        $newPage['header']['mid']['items'][2]['value'] = 'tab3';
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- MODULES
        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';

        $z++;
        $varNameStorage = strtolower($getClassName[0]) . substr($getClassName, 1, strlen($getClassName)) . 'StorageService';
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'StorageService';
        $newPage['modules']['angular'][$z]['var'] = $varNameStorage;
        $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '-storage/' . $current_page_target . '-storage.service';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'ToastController';
        $newPage['modules']['angular'][$z]['var'] = 'toastController';
        $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
        $newPage['modules']['angular'][$z]['var'] = 'loadingController';
        $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CONTENT --|-- HTML
        $newPage['content']['html'] = null;
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list class="empty-bookmarks-container" lines="none" *ngIf="dataBookmarks.length == 0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="empty-bookmarks-wrapper">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="heart-outline"></ion-icon>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<h3>' . $addons['label-for-no-item'] . '</h3>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataBookmarks.length != 0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item-sliding *ngFor="let item of dataBookmarks">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-item [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $current_page_target . '-detail\',item.' . $addons['var-id'] . ']">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<h3 *ngIf="item.' . $addons['variable-bookmark-title'] . '" [innerHTML]="item.' . $addons['variable-bookmark-title'] . '"></h3>' . "\r\n";
        if ($addons['variable-bookmark-subtitle'] != '')
        {
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<p *ngIf="item.' . $addons['variable-bookmark-subtitle'] . '" [innerHTML]="item.' . $addons['variable-bookmark-subtitle'] . '"></p>' . "\r\n";
        }
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="end">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="danger" (click)="removeBookmark(item.id)">' . $addons['label-for-delete'] . '</ion-item-option>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="start">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="primary" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $current_page_target . '-detail\',item.' . $addons['var-id'] . ']">' . $addons['label-for-detail'] . '</ion-item-option>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '</ion-item-sliding>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" (click)="clearBookmarks()" slot="end" color="danger"><ion-icon name="reload-circle"></ion-icon> ' . $addons['label-for-clean-up'] . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CONTENT --|-- SCSS
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] .= "\t" . '.empty-bookmarks-container{height: 100%;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '.empty-bookmarks-wrapper{text-align: center;padding-top: 50%;font-size: 72px;}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '.empty-bookmarks-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";

        $newPage['code']['export'] = null;
        $newPage['code']['other'] = null;
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'dataBookmarks : any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'loading:any;' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CODE --|-- OTHER --|-- ngOnInit()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target . "-bookmarks") . 'Page.ngOnInit()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.' . $varNameStorage . '.getItems(`' . $current_page_target . '-bookmark`).then((items)=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataBookmarks = items;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CODE --|-- OTHER --|-- presentLoading()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target . "-bookmarks") . 'Page.presentLoading()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CODE --|-- OTHER --|-- dismissLoading()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target . "-bookmarks") . 'Page.dismissLoading()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CODE --|-- OTHER --|-- removeBookmark()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target . "-bookmarks") . 'Page.removeWishlist()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public removeBookmark(id:string){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.' . $varNameStorage . '.removeItem(`' . $current_page_target . '-bookmark`,id).then((items)=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.presentLoading();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.' . $varNameStorage . '.getItems(`' . $current_page_target . '-bookmark`).then((items)=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBookmarks = items;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CODE --|-- OTHER --|-- clearBookmarks()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target . "-bookmarks") . 'Page.clearWishlist()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public clearBookmarks(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.' . $varNameStorage . '.clearItems(`' . $current_page_target . '-bookmark`).then((items)=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.presentLoading();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.' . $varNameStorage . '.getItems(`' . $current_page_target . '-bookmark`).then((items)=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBookmarks = items;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 1000);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";

        // TODO: GENERATOR --|-- PAGE --|--  BOOKMARKS --|-- CODE --|-- OTHER --|-- doRefresh()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target . "-bookmarks") . 'Page.doRefresh()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.' . $varNameStorage . '.getItems(`' . $current_page_target . '-bookmark`).then((items)=>{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.dataBookmarks = items;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        //generate page code
        $db->savePage($newPage);
        $db->SavePage($newPage);
    } else
    {
        $db->deletePage($current_page_target . '-bookmarks');
    }


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=json-scraping&page-target=' . $current_page_target . '&' . time());
}
// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('json-scraping', $current_page_target);
}
if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}
if (!isset($current_setting['page-title']))
{
    $current_setting['page-title'] = '';
}
if (!isset($current_setting['url-list-item']))
{
    $current_setting['url-list-item'] = '';
}
if (!isset($current_setting['url-single-item']))
{
    $current_setting['url-single-item'] = '';
}
if (!isset($current_setting['var-list-item']))
{
    $current_setting['var-list-item'] = '';
}
if (!isset($current_setting['var-single-item']))
{
    $current_setting['var-single-item'] = '';
}
if (!isset($current_setting['template-list-item']))
{
    $current_setting['template-list-item'] = '';
}
if (!isset($current_setting['template-single-item']))
{
    $current_setting['template-single-item'] = '';
}
if (!isset($current_setting['var-id']))
{
    $current_setting['var-id'] = '';
}
if (!isset($current_setting['search-by']))
{
    $current_setting['search-by'] = '';
}
if (!isset($current_setting['icon-default']))
{
    $current_setting['icon-default'] = 'newspaper';
}
if (!isset($current_setting['readmore']))
{
    $current_setting['readmore'] = 'more';
}
if (!isset($current_setting['infinite-scroll']))
{
    $current_setting['infinite-scroll'] = true;
}

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['search-type']))
{
    $current_setting['search-type'] = 'search';
}

if (!isset($current_setting['currency-symbol']))
{
    $current_setting['currency-symbol'] = 'USD';
}

if (!isset($current_setting['enable-bookmark']))
{
    $current_setting['enable-bookmark'] = false;
}

if (!isset($current_setting['page-title-for-bookmark-page']))
{
    $current_setting['page-title-for-bookmark-page'] = 'Bookmarks';
}

if (!isset($current_setting['variable-bookmark-title']))
{
    $current_setting['variable-bookmark-title'] = '';
}

if (!isset($current_setting['variable-bookmark-subtitle']))
{
    $current_setting['variable-bookmark-subtitle'] = '';
}


if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['label-for-successfully-added-to-bookmark-list']))
{
    $current_setting['label-for-successfully-added-to-bookmark-list'] = 'Item successfully added to bookmark list';
}

if (!isset($current_setting['label-for-successfully-retrieved-data']))
{
    $current_setting['label-for-successfully-retrieved-data'] = 'Successfully retrieved data!';
}

if (!isset($current_setting['label-for-failed-to-retrieve-data-from-server']))
{
    $current_setting['label-for-failed-to-retrieve-data-from-server'] = 'Failed to retrieve data from server!';
}
if (!isset($current_setting['label-for-detail']))
{
    $current_setting['label-for-detail'] = 'Detail';
}

if (!isset($current_setting['label-for-delete']))
{
    $current_setting['label-for-delete'] = 'Delete';
}

if (!isset($current_setting['label-for-clean-up']))
{
    $current_setting['label-for-clean-up'] = 'Clean Up';
}

if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'Okey!';
}

if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-no-item']))
{
    $current_setting['label-for-no-item'] = 'No item!';
}

if (isset($_GET['varlist']))
{
    if (substr($current_setting['url-list-item'], 0, 4) == 'http')
    {

    } else
    {
        $current_setting['url-list-item'] = 'http://localhost:' . $current_app['apps']['imabuilder']['emulator-port'] . '/' . $current_setting['url-list-item'];
    }
    $new_vars = array();
    $json2array = new Json2Array();
    $url_test_json = str_replace('{id}', '1', $current_setting['url-list-item']);

    $url_test_json = str_replace('https://localhost/', 'http://localhost/', $url_test_json);

    $varlists = $json2array->exec($url_test_json);
    foreach ($varlists as $var)
    {
        if (substr($var, 0, 3) == '[0]')
        {
            $new_vars[] = substr($var, 4, strlen($var));
        }
    }

    if (strlen($current_setting['var-list-item']) > 2)
    {
        $varName = substr($current_setting['var-list-item'], 1, strlen($current_setting['var-list-item']));
        foreach ($varlists as $var)
        {
            if (substr($var, 0, (strlen($varName) + 3)) == $varName . '[0]')
            {
                $new_vars[] = substr($var, (strlen($varName . '[0]') + 1), strlen($var));
            }
        }
    }


    $_SESSION['CURRENT_APP_TEMP']['pages'][$current_page_target]['varslist'] = $new_vars;
    header('Location: ./?p=addons&addons=json-scraping&page-target=' . $current_page_target . '&' . time());
}


if (!isset($_GET['wizard']))
{
    $_GET['wizard'] = '';
}

if ($_GET['wizard'] !== '')
{
    $json_wizard = json_decode(file_get_contents(__dir__ . '/wizard/' . basename($_GET['wizard']) . '.json'), true);
    $current_setting = $json_wizard;
    $current_setting['page-target'] = $current_page_target;
}

// TODO: -----------------------------------------------

// TODO: LAYOUT
$content .= '<form action="" method="post"><!-- ./form -->' . "\r\n";

$content .= '<div class="row"><!-- row -->' . "\r\n";
$content .= '<div class="col-md-7"><!-- col-md-7 -->' . "\r\n";

$content .= '<div class="box box-info">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";
if (parse_url($current_setting['url-list-item'], PHP_URL_SCHEME) == 'http')
{
    $content .= '<div class="callout callout-danger"><h4>Warning!</h4><p>' . __e('JSON URL do not use ssl, This might not work normally in APK/IPA (Android/IOS Devices)') . '</p></div>' . "\r\n";
}

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>' . "\r\n";

// TODO: LAYOUT --|-- FORM
// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="json-scraping[page-target]" class="form-control">';
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
$content .= '<input id="page-title" type="text" name="json-scraping[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="json-scraping[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="json-scraping[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
$content .= '<hr/>';

$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- URL-LIST-ITEM
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-url-list-item">' . __e('JSON URL for List of Items') . '</label>';
$content .= '<input id="page-url-list-item" type="text" name="json-scraping[url-list-item]" class="form-control" placeholder="https://domain.com/rest-api.php" value="' . $current_setting['url-list-item'] . '"  ' . $disabled . ' required />';
$content .= '<div class="help-block">';
$content .= '<ul>';
$content .= '<li>' . __e('JSON array can contain <strong>multiple objects</strong>, eg: <code>[{id:1,name:...},{id:2,name:...},{id:3,name:...}]</code>') . '</li>';
$content .= '<li>' . __e('You can use dynamic parameter by changing the value with <code>{id}</code> for dynamic listings, eg: <code>https://domain.com/rest-api.php?books-categories={id}</code>') . '</li>';
$content .= '<li>' . __e('For JSON installed on the <strong>Online Server</strong>, you must use <strong>SSL</strong> (<code>https://</code>) and for offline app: upload file to folder: <code>src/assets/file.json</code> and write url: <code>assets/file.json</code>') . '</li>';
$content .= '</ul>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- URL-SINGLE-ITEM
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-url-single-item">' . __e('JSON URL for Single Item') . '</label>';
$content .= '<input id="page-url-single-item" type="text" name="json-scraping[url-single-item]" class="form-control" placeholder="https://domain.com/rest-api.php?id={id}"  value="' . $current_setting['url-single-item'] . '"  ' . $disabled . ' />';

$content .= '<div class="help-block">';
$content .= '<ul>';
$content .= '<li>' . __e('Leave blank to default') . '</li>';
$content .= '<li>' . __e('Value of paremeter ID in URL replace with: <code>{id}</code> eg: <code>https://domain.com/rest-api.php?books-id={id}</code>, required: JSON objects can contain <strong>multiple name/values</strong>, eg: <code>{id:1,name:...}</code>') . '</li>';
$content .= '<li>' . __e('For JSON installed on the <strong>Online Server</strong>, you must use <strong>SSL</strong> (<code>https://</code>) and for local (offline app) do not use https/http') . '</li>';
$content .= '</ul>';
$content .= '</div>';

$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- VAR-LIST-ITEM
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-var-list-item">' . __e('1st Variable for List of Items') . '</label>';
$content .= '<input id="page-var-list-item" type="text" name="json-scraping[var-list-item]" class="form-control" placeholder=""  value="' . $current_setting['var-list-item'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Fill blank for default, <code>{items:[{...},{...}]}</code> then you must fill <code>.items</code>') . '</p>';

$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- VAR-SINGLE-ITEM
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-var-single-item">' . __e('1st Variable for Single Item') . '</label>';
$content .= '<input id="page-var-single-item" type="text" name="json-scraping[var-single-item]" class="form-control" placeholder=""  value="' . $current_setting['var-single-item'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Fill blank for default, <code>{item:{...}}</code> then you must fill <code>.item</code>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- TEMPLATE-LIST-ITEM

$template_listing_options = array();
$template_listing_options[] = array('value' => 'print', 'label' => 'Layout : Print (Debug)');
$template_listing_options[] = array('value' => 'card', 'label' => 'Layout : Card');
$template_listing_options[] = array('value' => 'list', 'label' => 'Layout : List');
$template_listing_options[] = array('value' => 'group', 'label' => 'Layout : Group A-Z');
$template_listing_options[] = array('value' => 'chip', 'label' => 'Layout : Chip');


$template_listing['print'] = '';
$template_listing['list'] = '<span class="label label-danger">item component</span> item-label, item-avatar, item-thumbnail, item-note, etc';
$template_listing['card'] = '<span class="label label-danger">card component</span> card-header, card-content, card-item, etc';
$template_listing['chip'] = '<span class="label label-danger">item component</span> item-label, item-avatar, item-thumbnail, item-note, etc';
$template_listing['group'] = '<span class="label label-danger">item component</span> item-label, item-avatar, item-thumbnail, item-note, etc';

$content .= '<div class="col-md-6"><!-- col-md-6 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="page-template-list-item">' . __e('Template for List of Items') . '</label>' . "\r\n";
$content .= '<select id="page-template-list-item" name="json-scraping[template-list-item]" class="form-control" ' . $disabled . ' >' . "\r\n";
foreach ($template_listing_options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['template-list-item'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>' . "\r\n";
$content .= '<p class="help-block">' . __e('The basic template for list item') . '</p>' . "\r\n";
$content .= '<p id="page-template-list-item-note"></p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div><!-- ./col-md-6 -->' . "\r\n";
// TODO: LAYOUT --|-- FORM --|-- TEMPLATE-ITEM-DETAIL
$options = array();
$options[] = array('value' => 'none', 'label' => 'None');
$options[] = array('value' => 'print', 'label' => 'Layout : Print (Debug)');
$options[] = array('value' => 'card', 'label' => 'Layout : Card');
$options[] = array('value' => 'list', 'label' => 'Layout : List');


foreach ($list_pages as $pageLink)
{
    if (isset($pageLink['param']))
    {
        if (trim($pageLink['param']) != '')
        {
            if (!preg_match("/-detail/", $pageLink['name']))
            {
                $options[] = array('value' => 'link-to-' . $pageLink['name'] . '', 'label' => 'Link To : ' . $pageLink['title'] . ' (' . $pageLink['name'] . ')');
            }
        }
    }
}
$content .= '<div class="col-md-6"><!-- col-md-6 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="page-template-single-item">' . __e('Template for Single Item') . '</label>' . "\r\n";
$content .= '<select id="page-template-single-item" name="json-scraping[template-single-item]" class="form-control" ' . $disabled . ' >' . "\r\n";
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['template-single-item'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>' . "\r\n";
}
$content .= '</select>' . "\r\n";
$content .= '<p class="help-block">' . __e('The basic template for single item') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div><!-- ./col-md-6 -->' . "\r\n";
$content .= '</div><!-- ./row -->' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-footer pad">' . "\r\n";
$content .= '<input name="save-json-scraping" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";


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
$btn_wizard = array();
foreach (glob(__dir__ . '/wizard/*.json') as $wizard)
{
    $wizard_name = pathinfo($wizard, PATHINFO_FILENAME);
    $btn_wizard[] = '<a href="./?p=addons&amp;addons=json-scraping&amp;page-target=' . $current_page_target . '&amp;wizard=' . $wizard_name . '" class="btn text-danger btn-link">' . $wizard_name . '</a>';
}


$content .= '<div class="callout callout-success">' . "\r\n";
$content .= '<p><span class="blink">' . __e('Tips!') . '</span> ' . __e('Use the get all variables button to get a list of variables in your json') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<p>' . "\r\n";
$content .= '<a class="btn btn-sm btn-flat btn-info" href="./?p=addons&amp;addons=json-scraping&amp;page-target=' . $current_page_target . '&amp;varlist">' . "\r\n";
$content .= '<i class="fa fa-globe"></i> ' . __e('Get All Variables ') . '' . "\r\n";
$content .= '</a>' . "\r\n";
$content .= '' . __e(' or Use this setting') . '';

$content .= implode(',', $btn_wizard);
$content .= '<br/>Variables: <code>' . implode(', ', $var_items) . '</code>' . "\r\n";
$content .= '</p>' . "\r\n";
$content .= '<hr/>' . "\r\n";
// TODO: LAYOUT --|-- FORM --|-- INIT VARTYPE
$option_var_types = array();
$option_var_types[] = array('label' => 'RAW : ID', 'value' => 'id');
$option_var_types[] = array('label' => 'Raw : Text', 'value' => 'text');
$option_var_types[] = array('label' => 'Raw : Number', 'value' => 'number');
$option_var_types[] = array('label' => 'Raw : Date', 'value' => 'date');
$option_var_types[] = array('label' => 'Raw : Currency', 'value' => 'currency');
$option_var_types[] = array('label' => 'Raw : Image', 'value' => 'image');

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
if ($current_setting['enable-bookmark'] == true)
{
    $option_var_types[] = array('label' => 'Item : Bookmark', 'value' => 'item-bookmark');
}
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

$option_var_types[] = array('label' => 'Card : Item : Avatar', 'value' => 'card-item-avatar');
$option_var_types[] = array('label' => 'Card : Item : Avatar : Start', 'value' => 'card-item-avatar-start');
$option_var_types[] = array('label' => 'Card : Item : Avatar : End', 'value' => 'card-item-avatar-end');
$option_var_types[] = array('label' => 'Card : Item : Thumbnail', 'value' => 'card-item-thumbnail');
$option_var_types[] = array('label' => 'Card : Item : Thumbnail : Start', 'value' => 'card-item-thumbnail-start');
$option_var_types[] = array('label' => 'Card : Item : Thumbnail : End', 'value' => 'card-item-thumbnail-end');

$option_var_types[] = array('label' => 'Card : Item : Label', 'value' => 'card-item-label');
$option_var_types[] = array('label' => 'Card : Item : Label : Heading', 'value' => 'card-item-label-heading');
if ($current_setting['enable-bookmark'] == true)
{
    $option_var_types[] = array('label' => 'Card : Item : Bookmark', 'value' => 'card-item-bookmark');
}

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

if (isset($current_directives['preview-any-file']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Preview Any File', 'value' => 'native-preview-any-file');
}

if (isset($current_directives['x-social-sharing']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Social X-Sharing', 'value' => 'x-social-sharing');
}

if (isset($current_directives['take-screenshot']))
{
    $option_var_types[] = array('label' => '[Additional Directives] Card : Item : Take Screenshot', 'value' => 'take-screenshot');
}


$content .= '<table class="table table-striped no-margin no-padding" >' . "\r\n";
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '<th>' . __e('Variable') . '</th>' . "\r\n";
$content .= '<th>' . __e('Label') . '</th>' . "\r\n";
$content .= '<th>' . __e('Type') . '</th>' . "\r\n";
$content .= '<th>' . __e('List') . '</th>' . "\r\n";
$content .= '<th>' . __e('Detail') . '</th>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody id="var-lists">' . "\r\n";
if (!isset($current_setting['items-1st-load']))
{
    $current_setting['items-1st-load'] = 20;
}
if (!isset($current_setting['per-page']))
{
    $current_setting['per-page'] = 20;
}
if (!isset($current_setting['vars']))
{
    $max_vars = 1;
} else
{
    $max_vars = count($current_setting['vars']);
}

if (!isset($current_setting['auth-type']))
{
    $current_setting['auth-type'] = 'none';
}
if (!isset($current_setting['auth-uname']))
{
    $current_setting['auth-uname'] = '';
}
if (!isset($current_setting['auth-pwd']))
{
    $current_setting['auth-pwd'] = 'none';
}

for ($z = 0; $z <= $max_vars; $z++)
{
    //required
    $lock = '';
    if ($z == 0)
    {
        $current_setting['vars'][$z]['type'] = 'id';
        $lock = 'disabled';
    }
    // TODO: LAYOUT --|-- FORM --|-- VAR OPTION VARS --|-- VARNAME
    $var_value = '';
    if (isset($current_setting['vars'][$z]['var']))
    {
        $var_value = $current_setting['vars'][$z]['var'];
    }
    $html_var_name = null;
    $html_var_name .= '<select class="autocomplete" name="json-scraping[vars][' . $z . '][var]" >' . "\r\n";
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
    $html_var_label = '<input type="text" class="form-control" name="json-scraping[vars][' . $z . '][label]" value="' . htmlentities($label_value) . '" />' . "\r\n";
    // TODO: LAYOUT --|-- FORM --|-- VAR OPTION VARS --|-- VARTYPE
    $var_type = 'text';
    if (isset($current_setting['vars'][$z]['type']))
    {
        $var_type = $current_setting['vars'][$z]['type'];
    }
    $html_var_type = null;
    $html_var_type .= '<select class="form-control" name="json-scraping[vars][' . $z . '][type]" ' . $lock . '>' . "\r\n";
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
    // TODO: LAYOUT --|-- FORM --|-- VAR OPTION VARS --|-- LIST
    if (!isset($current_setting['vars'][$z]['list']))
    {
        $current_setting['vars'][$z]['list'] = false;
    }
    $show_list = '';
    if ($current_setting['vars'][$z]['list'] == true)
    {
        $show_list = 'checked';
    }
    $html_show_single = null;
    $html_show_single .= '<input type="checkbox" class="flat-green" name="json-scraping[vars][' . $z . '][list]" value="true" ' . $show_list . '/>' . "\r\n";
    // TODO: LAYOUT --|-- FORM --|-- VAR OPTION VARS --|-- DETAIL
    if (!isset($current_setting['vars'][$z]['detail']))
    {
        $current_setting['vars'][$z]['detail'] = false;
    }
    $show_detail = '';
    if ($current_setting['vars'][$z]['detail'] == true)
    {
        $show_detail = 'checked';
    }
    $html_show_detail = null;
    $html_show_detail .= '<input type="checkbox" class="flat-blue" name="json-scraping[vars][' . $z . '][detail]" value="true" ' . $show_detail . '/>' . "\r\n";
    $disable_move = '';
    $icon_move = '<i class="glyphicon glyphicon-move"></i>';
    if ($z == 0)
    {
        $disable_move = 'move-disabled';
        $icon_move = '';
    }
    // TODO: LAYOUT --|-- FORM --|-- VARS ITEM
    $content .= '<tr class="var-item" id="item-var-' . $z . '">' . "\r\n";
    $content .= '<td class="text-align v-align move-cursor handle ' . $disable_move . '">' . $icon_move . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_var_name . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_var_label . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_var_type . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_show_single . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_show_detail . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . "\r\n";
    $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#item-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
    $content .= '</td>' . "\r\n";
    $content .= '</tr>' . "\r\n";
}
$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";
$content .= '</div><!-- ./col-md-12 -->' . "\r\n";
$content .= '</div><!-- ./row -->' . "\r\n";
$content .= '<br/>' . "\r\n";
$content .= '<p class="note note-default">' . "\r\n";
$content .= __e('To add more <strong>Variable Type</strong> and <strong>Search Type</strong>, please add additional Directives to the <a href="?p=directives">Directives Menus</a> and To activate the <strong>bookmark button</strong> on the item type, please check <strong>Enable bookmarks/favorites</strong> on the right side panel.') . "\r\n";
$content .= '</p>' . "\r\n";

$content .= '<hr/>' . "\r\n";
$content .= '<div class="row">' . "\r\n";
// TODO: LAYOUT --|-- FORM --|-- VAR ID
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="var-id">' . __e('Variable as ID?') . '</label>';
$content .= '<select class="autocomplete" name="json-scraping[var-id]" >' . "\r\n";
$is_custom_typing = true;
foreach ($var_items as $var_item)
{
    $selected = '';
    if ($current_setting['var-id'] == $var_item)
    {
        $selected = 'selected';
        $is_custom_typing = false;
    }
    $content .= '<option value="' . $var_item . '" ' . $selected . '>' . $var_item . '</option>' . "\r\n";
}
if ($is_custom_typing == true)
{
    $content .= '<option value="' . $current_setting['var-id'] . '" selected>' . $current_setting['var-id'] . '</option>' . "\r\n";
}
$content .= '</select>' . "\r\n";
$content .= '<p class="help-block">' . __e('The variable used as an ID') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- VAR SEARCH TYPE
$search_types = array();
$search_types[] = array('label' => 'Search Bar', 'value' => 'search');
$search_types[] = array('label' => 'Search Bar + Barcode Scanner', 'value' => 'search-with-barcode');

$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="search-by">' . __e('Search Layout?') . '</label>';
$content .= '<select class="form-control" name="json-scraping[search-type]" >' . "\r\n";
$is_custom_typing = true;
foreach ($search_types as $search_type)
{

    $selected = '';
    if ($search_type['value'] == $current_setting['search-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $search_type['value'] . '" ' . $selected . '>' . $search_type['label'] . '</option>' . "\r\n";
}
$content .= '</select>' . "\r\n";
$content .= '<p class="help-block">' . __e('Select search type only search or search and scanner') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- VAR SEARCH BY
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="search-by">' . __e('Search by Variable?') . '</label>';
$content .= '<select class="autocomplete" name="json-scraping[search-by]" >' . "\r\n";
$is_custom_typing = true;
foreach ($var_items as $var_item)
{
    $selected = '';
    if ($current_setting['search-by'] == $var_item)
    {
        $selected = 'selected';
        $is_custom_typing = false;
    }
    $content .= '<option value="' . $var_item . '" ' . $selected . '>' . $var_item . '</option>' . "\r\n";
}
if ($is_custom_typing == true)
{
    $content .= '<option value="' . $current_setting['search-by'] . '" selected>' . $current_setting['search-by'] . '</option>' . "\r\n";
}
$content .= '</select>' . "\r\n";
$content .= '<p class="help-block">' . __e('The variable used for search') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->' . "\r\n";

$content .= '<div class="row">' . "\r\n";
// TODO: LAYOUT --|-- FORM --|-- DEFAULT ICON

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="icon-default">' . __e('Icon Default') . '</label>' . "\r\n";
$content .= '<div class="input-group">' . "\r\n";
$content .= '<input id="icon-default" name="json-scraping[icon-default]" class="form-control" placeholder=""  value="' . $current_setting['icon-default'] . '"  ' . $disabled . ' >' . "\r\n";
$content .= '<span class="input-group-addon" data-type="icon-picker" data-target="#icon-default" data-dialog="#ion-icon-dialog" title="Click here for get icon list" data-toggle="tooltip">' . "\r\n";
$content .= '<ion-icon name="' . $current_setting['icon-default'] . '"></ion-icon>' . "\r\n";

$content .= '</span>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<p class="help-block">' . __e('Default icon for item listing') . '</p>';
$content .= '</div>' . "\r\n";
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="readmore">' . __e('Readmore Text') . '</label>';
$content .= '<input id="readmore" type="text" name="json-scraping[readmore]" class="form-control" value="' . $current_setting['readmore'] . '"/>';
$content .= '<p class="help-block">' . __e('Label for readmore') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="readmore">' . __e('Currency Symbol') . '</label>';
$content .= '<input id="readmore" type="text" name="json-scraping[currency-symbol]" class="form-control" value="' . $current_setting['currency-symbol'] . '"/>';
$content .= '<p class="help-block">' . __e('Used for item type currency') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->' . "\r\n";


$content .= '<div class="row">' . "\r\n";

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="items-1st-load">' . __e('Scrolling') . '</label>';
$checked = '';
if ($current_setting['infinite-scroll'] == true)
{
    $checked = 'checked';
}
$content .= '<div class="checkbox"><input name="json-scraping[infinite-scroll]" type="checkbox" class="flat-red" ' . $checked . '> ' . __e('Enable Infinite Scroll') . '</div>';

$content .= '<p class="help-block">' . __e('To activate infinite scroll so that the app load is lighter') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="items-1st-load">' . __e('First loading') . '</label>';
$content .= '<input id="items-1st-load" type="number" name="json-scraping[items-1st-load]" class="form-control" value="' . $current_setting['items-1st-load'] . '"/>';
$content .= '<p class="help-block">' . __e('The number of items loaded for the first time') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="per-page">' . __e('Per Page') . '</label>';
$content .= '<input id="per-page" type="number" name="json-scraping[per-page]" class="form-control" value="' . $current_setting['per-page'] . '"/>';
$content .= '<p class="help-block">' . __e('Number of items per paging') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->' . "\r\n";


$content .= '<div class="row">' . "\r\n";


$auth_types[] = array('label' => 'None', 'value' => 'none');
$auth_types[] = array('label' => 'HTTP Basic', 'value' => 'basic');
$auth_types[] = array('label' => 'JSON Web Token / JWT Auth for WordPress', 'value' => 'token');

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="auth-type">' . __e('Authentication Type') . '</label>';
$content .= '<select name="json-scraping[auth-type]" class="form-control">';
foreach ($auth_types as $auth_type)
{
    $selected = '';
    if ($auth_type['value'] == $current_setting['auth-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $auth_type['value'] . '" ' . $selected . '>' . $auth_type['label'] . '</option>' . "\r\n";
}
$content .= '</select>';

$content .= '<p class="help-block">' . __e('Choose the type of authorization') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="auth-uname">' . __e('Username') . '</label>';
$content .= '<input id="auth-uname" type="text" name="json-scraping[auth-uname]" class="form-control" value="' . $current_setting['auth-uname'] . '" placeholder="ck_5c6d217ecdc1f9e5c3cee7ef4f55eb95ce41ec1c" />';
$content .= '<p class="help-block">' . __e('fill in the username or consumer key for auth basic') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '<div class="col-md-4"><!-- col-md-4 -->' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label for="auth-pwd">' . __e('Password') . '</label>';
$content .= '<input id="auth-pwd" type="text" name="json-scraping[auth-pwd]" class="form-control" value="' . $current_setting['auth-pwd'] . '" placeholder="cs_70ea25db8d2fd6f24271c9cec637c6b7341cc43e"/>';
$content .= '<p class="help-block">' . __e('fill in the password or consumer secret for auth basic') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->' . "\r\n";


$content .= '</div>' . "\r\n";
$content .= '<div class="box-footer pad">' . "\r\n";
$content .= '<input name="save-json-scraping" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</div><!-- ./box-footer -->' . "\r\n";
$content .= '</div>' . "\r\n";

// TODO: LAYOUT --|-- FORM --|-- CUSTOM HTTP HEADER

$content .= '<div class="box box-warning">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Custom HTTP Header') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";


$content .= '<table class="table table-striped">' . "\r\n";
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th>' . __e('Variable') . '</th>' . "\r\n";
$content .= '<th>' . __e('Value') . '</th>' . "\r\n";
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody>' . "\r\n";

$content .= '<tr>' . "\r\n";
$content .= '<td><input type="text" readonly class="form-control" value="Content-Type" /></td>' . "\r\n";
$content .= '<td><input type="text" readonly class="form-control" value="application/x-www-form-urlencoded"/></td>' . "\r\n";
$content .= '</tr>' . "\r\n";

if (!isset($current_setting['custom-http-header'][0]))
{
    $current_setting['custom-http-header'][0]['var'] = '';
    $current_setting['custom-http-header'][0]['val'] = '';
}
if (!isset($current_setting['custom-http-header'][1]))
{
    $current_setting['custom-http-header'][1]['var'] = '';
    $current_setting['custom-http-header'][1]['val'] = '';
}
if (!isset($current_setting['custom-http-header'][2]))
{
    $current_setting['custom-http-header'][2]['var'] = '';
    $current_setting['custom-http-header'][2]['val'] = '';
}
if (!isset($current_setting['custom-http-header'][3]))
{
    $current_setting['custom-http-header'][3]['var'] = '';
    $current_setting['custom-http-header'][3]['val'] = '';
}
if (!isset($current_setting['custom-http-header'][4]))
{
    $current_setting['custom-http-header'][4]['var'] = '';
    $current_setting['custom-http-header'][4]['val'] = '';
}

$content .= '<tr>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][0][var]" class="form-control" placeholder="x-rapidapi-host" value="' . htmlentities($current_setting['custom-http-header'][0]['var']) . '"/></td>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][0][val]" class="form-control" placeholder="gplaystore.p.rapidapi.com" value="' . htmlentities($current_setting['custom-http-header'][0]['val']) . '"/></td>' . "\r\n";
$content .= '</tr>' . "\r\n";

$content .= '<tr>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][1][var]" class="form-control" placeholder="x-rapidapi-key" value="' . htmlentities($current_setting['custom-http-header'][1]['var']) . '"/></td>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][1][val]" class="form-control" placeholder="b4c016ceedmshb680b129d3cf9d5p142124jsne690669e1fe9" value="' . htmlentities($current_setting['custom-http-header'][1]['val']) . '"/></td>' . "\r\n";
$content .= '</tr>' . "\r\n";

$content .= '<tr>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][2][var]" class="form-control" placeholder="" value="' . htmlentities($current_setting['custom-http-header'][2]['var']) . '"/></td>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][2][val]" class="form-control" placeholder="" value="' . htmlentities($current_setting['custom-http-header'][2]['val']) . '"/></td>' . "\r\n";
$content .= '</tr>' . "\r\n";

$content .= '<tr>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][3][var]" class="form-control" placeholder="" value="' . htmlentities($current_setting['custom-http-header'][3]['var']) . '"/></td>' . "\r\n";
$content .= '<td><input type="text" name="json-scraping[custom-http-header][3][val]" class="form-control" placeholder="" value="' . htmlentities($current_setting['custom-http-header'][3]['val']) . '"/></td>' . "\r\n";
$content .= '</tr>' . "\r\n";


$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";

$content .= '</div>' . "\r\n";
$content .= '<div class="box-footer pad">' . "\r\n";
$content .= '<input name="save-json-scraping" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</div><!-- ./box-footer -->' . "\r\n";
$content .= '</div>' . "\r\n";


$content .= '</div><!-- ./col-md-7 -->' . "\r\n";
$content .= '<div class="col-md-5"><!-- col-md-5 -->' . "\r\n";

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-bookmark"></i> ' . __e('Bookmarks/Favorites') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

// TODO: LAYOUT --|-- FORM --|-- ENABLE-BOOKMARK --|-- CHECKBOX
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-enable-bookmark" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<table>';
$content .= '<tr>';
if ($current_setting['enable-bookmark'] == true)
{
    $content .= '<td style="width: 30px;"><input type="checkbox" class="flat-red" name="json-scraping[enable-bookmark]" checked ' . $disabled . ' value="true"/></td>';
} else
{
    $content .= '<td style="width: 30px;"><input type="checkbox" class="flat-red" name="json-scraping[enable-bookmark]" ' . $disabled . ' value="true"/></td>';
}
$content .= '<td>' . __e('Enable bookmarks/favorites') . '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- TITLE-FOR-BOOKMARK-PAGE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-title-for-bookmark-page" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-title-for-bookmark-page">' . __e('Title For Bookmark Page') . '</label>';
$content .= '<input id="page-title-for-bookmark-page" type="text" name="json-scraping[page-title-for-bookmark-page]" class="form-control" placeholder="Bookmarks"  value="' . $current_setting['page-title-for-bookmark-page'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('The page title for bookmark page') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- BOOKMARK-TITLE --|-- TEXT

$var_value = $current_setting['variable-bookmark-title'];
$html_var_bookmark_title = null;
$html_var_bookmark_title .= '<select class="autocomplete" name="json-scraping[variable-bookmark-title]" >' . "\r\n";
$is_custom_typing = true;
foreach ($var_items as $var_item)
{
    $selected = '';
    if ($var_value == $var_item)
    {
        $selected = 'selected';
        $is_custom_typing = false;
    }
    $html_var_bookmark_title .= '<option value="' . $var_item . '" ' . $selected . '>' . $var_item . '</option>' . "\r\n";
}
if ($is_custom_typing == true)
{
    $html_var_bookmark_title .= '<option value="' . $var_value . '" selected>' . $var_value . '</option>' . "\r\n";
}
$html_var_bookmark_title .= '</select>' . "\r\n";

$content .= '<div id="field-bookmark-title" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-bookmark-title">' . __e('Variable for Bookmark Title') . '</label>';
$content .= $html_var_bookmark_title;
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- BOOKMARK-SUBTITLE --|-- TEXT

$var_value = $current_setting['variable-bookmark-subtitle'];
$html_var_bookmark_subtitle = null;
$html_var_bookmark_subtitle .= '<select class="autocomplete" name="json-scraping[variable-bookmark-subtitle]" >' . "\r\n";
$is_custom_typing = true;
foreach ($var_items as $var_item)
{
    $selected = '';
    if ($var_value == $var_item)
    {
        $selected = 'selected';
        $is_custom_typing = false;
    }
    $html_var_bookmark_subtitle .= '<option value="' . $var_item . '" ' . $selected . '>' . $var_item . '</option>' . "\r\n";
}
if ($is_custom_typing == true)
{
    $html_var_bookmark_subtitle .= '<option value="' . $var_value . '" selected>' . $var_value . '</option>' . "\r\n";
}
$html_var_bookmark_subtitle .= '</select>' . "\r\n";

$content .= '<div id="field-bookmark-subtitle" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-bookmark-subtitle">' . __e('Variable for Bookmark Subtitle') . '</label>';
$content .= $html_var_bookmark_subtitle;
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">' . "\r\n";
$content .= '<input name="save-json-scraping" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</div><!-- ./box-footer -->' . "\r\n";
$content .= '</div><!-- ./box -->';

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-bookmark"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY-ADDED-TO-BOOKMARK-LIST --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-successfully-added-to-bookmark-list" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully-added-to-bookmark-list">' . __e('Label for `Item successfully added to bookmark list`') . '</label>';
$content .= '<input id="page-label-for-successfully-added-to-bookmark-list" type="text" name="json-scraping[label-for-successfully-added-to-bookmark-list]" class="form-control" placeholder="Item successfully added to bookmark list"  value="' . $current_setting['label-for-successfully-added-to-bookmark-list'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Item successfully added to bookmark list`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY-RETRIEVED-DATA --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-successfully-retrieved-data" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully-retrieved-data">' . __e('Label for `Successfully retrieved data!`') . '</label>';
$content .= '<input id="page-label-for-successfully-retrieved-data" type="text" name="json-scraping[label-for-successfully-retrieved-data]" class="form-control" placeholder="Successfully retrieved data!"  value="' . $current_setting['label-for-successfully-retrieved-data'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Successfully retrieved data!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FAILED-TO-RETRIEVE-DATA-FROM-SERVER --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-failed-to-retrieve-data-from-server" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-failed-to-retrieve-data-from-server">' . __e('Label for `Failed to retrieve data from server!`') . '</label>';
$content .= '<input id="page-label-for-failed-to-retrieve-data-from-server" type="text" name="json-scraping[label-for-failed-to-retrieve-data-from-server]" class="form-control" placeholder="Failed to retrieve data from server!"  value="' . $current_setting['label-for-failed-to-retrieve-data-from-server'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Failed to retrieve data from server!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="json-scraping[label-for-please-wait]" class="form-control" placeholder="Please wait..."  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Please wait...`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT

$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `Okey`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="json-scraping[label-for-ok]" class="form-control" placeholder="Okey"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Okey`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-ITEM --|-- TEXT

$content .= '<div id="field-label-for-no-item" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-item">' . __e('Label for `No item`') . '</label>';
$content .= '<input id="page-label-for-no-item" type="text" name="json-scraping[label-for-no-item]" class="form-control" placeholder="No item"  value="' . $current_setting['label-for-no-item'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No item`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DETAIL --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-detail" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-detail">' . __e('Label for `Detail`') . '</label>';
$content .= '<input id="page-label-for-detail" type="text" name="json-scraping[label-for-detail]" class="form-control" placeholder="Detail"  value="' . $current_setting['label-for-detail'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Detail`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DELETE --|-- TEXT

$content .= '<div id="field-label-for-delete" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-delete">' . __e('Label for `Delete`') . '</label>';
$content .= '<input id="page-label-for-delete" type="text" name="json-scraping[label-for-delete]" class="form-control" placeholder="Delete"  value="' . $current_setting['label-for-delete'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Delete`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CLEAN-UP --|-- TEXT

$content .= '<div id="field-label-for-clean-up" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-clean-up">' . __e('Label for `Clean Up`') . '</label>';
$content .= '<input id="page-label-for-clean-up" type="text" name="json-scraping[label-for-clean-up]" class="form-control" placeholder="Clean Up"  value="' . $current_setting['label-for-clean-up'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Clean Up`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">' . "\r\n";
$content .= '<input name="save-json-scraping" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>' . "\r\n";
$content .= '</div><!-- ./box-footer -->' . "\r\n";
$content .= '</div><!-- ./box -->';


$content .= '<div class="box box-warning">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Latest Used') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";
$content .= '<div class="callout callout-default">' . __e('Some settings that you have made:') . '</div>' . "\r\n";
$content .= '<div class="table-responsive">' . "\r\n";
$content .= '<table class="table table-striped" id="latest-used">' . "\r\n";
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th>#</th>';
$content .= '<th>' . __e('Target') . '</th>' . "\r\n";
$content .= '<th>' . __e('Title') . '</th>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody>' . "\r\n";
$modal_dialog = null;
if (count($addons_settings) >= 1)
{
    $no = 1;
    foreach ($addons_settings as $pageList)
    {
        $content .= '<tr>' . "\r\n";
        $content .= '<td>' . $no . '</td>' . "\r\n";
        $content .= '<td><a target="_blank" href="./?p=pages&amp;a=edit&amp;page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>' . "\r\n";
        $content .= '<td>' . $pageList['page-title'] . '</td>' . "\r\n";
        $content .= '<td>' . "\r\n";
        $content .= '<a href="./?p=addons&amp;addons=json-scraping&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;' . "\r\n";
        $content .= '<a href="#!_./?p=addons&amp;addons=json-scraping&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>' . "\r\n";
        $content .= '</td>' . "\r\n";
        $content .= '</tr>' . "\r\n";
        $modal_dialog .= '<div class="modal fade modal-default" id="trash-dialog-' . $no . '" tabindex="-1" role="dialog" aria-labelledby="trash-dialog-' . $no . '" aria-hidden="true">' . "\r\n";
        $modal_dialog .= '<div class="modal-dialog">' . "\r\n";
        $modal_dialog .= '<div class="modal-content">' . "\r\n";
        $modal_dialog .= '<div class="modal-header">' . "\r\n";
        $modal_dialog .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' . "\r\n";
        $modal_dialog .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete Adds-ons Settings') . '</h4>' . "\r\n";
        $modal_dialog .= '</div><!-- ./modal-header -->' . "\r\n";
        $modal_dialog .= '<div class="modal-body">' . "\r\n";
        $modal_dialog .= '<p>' . __e('Deleting this add-ons setting will not delete the page code that you have created. Are you sure want to delete this settings?') . '</p>' . "\r\n";
        $modal_dialog .= '<div class="row">' . "\r\n";
        $modal_dialog .= '<div class="col-md-3">' . "\r\n";
        $modal_dialog .= '<div class="icon icon-confirm text-center"><i class="fa fa-5x fa-cogs"></i></div>' . "\r\n";
        $modal_dialog .= '</div>' . "\r\n";
        $modal_dialog .= '<div class="col-md-9 text-left">' . "\r\n";
        $modal_dialog .= '<table class="table-confirm">' . "\r\n";
        $modal_dialog .= '<tr>' . "\r\n";
        $modal_dialog .= '<td>' . __e('Page Target') . '</td>' . "\r\n";
        $modal_dialog .= '<td>: <strong>' . $pageList['page-target'] . '</strong></td>' . "\r\n";
        $modal_dialog .= '</tr>' . "\r\n";
        $modal_dialog .= '<tr>' . "\r\n";
        $modal_dialog .= '<td>' . __e('Page Title') . '</td>' . "\r\n";
        $modal_dialog .= '<td>: <strong>' . $pageList['page-title'] . '</strong></td>' . "\r\n";
        $modal_dialog .= '</tr>';
        $modal_dialog .= '</table>' . "\r\n";
        $modal_dialog .= '</div>' . "\r\n";
        $modal_dialog .= '</div>' . "\r\n";
        $modal_dialog .= '</div><!-- ./modal-body -->' . "\r\n";
        $modal_dialog .= '<div class="modal-footer">' . "\r\n";
        $modal_dialog .= '<a href="./?p=addons&amp;addons=json-scraping&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;' . "\r\n";
        $modal_dialog .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>' . "\r\n";
        $modal_dialog .= '</div>' . "\r\n";
        $modal_dialog .= '</div><!-- ./modal-content -->' . "\r\n";
        $modal_dialog .= '</div><!-- ./modal-dialog -->' . "\r\n";
        $modal_dialog .= '</div><!-- ./modal -->' . "\r\n";
        $no++;
    }
} else
{
    $content .= '<tr>' . "\r\n";
    $content .= '<td>&nbsp;</td>' . "\r\n";
    $content .= '<td>' . __e('no pages') . '</td>' . "\r\n";
    $content .= '<td></td>' . "\r\n";
    $content .= '<td></td>' . "\r\n";
    $content .= '</tr>' . "\r\n";
}
$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";
$content .= '</div><!-- ./table-responsive -->' . "\r\n";
$content .= '<div class="trash-dialog"><!-- trash-dialog -->' . "\r\n";
$content .= $modal_dialog;
$content .= '</div><!-- ./trash-dialog -->' . "\r\n";
$content .= '</div><!-- ./box-body -->' . "\r\n";
$content .= '</div><!-- ./box -->' . "\r\n";


$content .= '<div class="box box-primary">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-info"></i> ' . __e('Technical Guide') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";

$content .= '<h4>Additional Directives ' . __e('available') . ':</h4>' . "\r\n";
$content .= '<ol>' . "\r\n";
$content .= '<li>Streaming Media</li>' . "\r\n";
$content .= '<li>Play With Youtube App</li>' . "\r\n";
$content .= '<li>Text To Speech</li>' . "\r\n";
$content .= '<li>Pay With Paypal</li>' . "\r\n";
$content .= '<li>Instagram App</li>' . "\r\n";
$content .= '<li>Preview Any File</li>' . "\r\n";
$content .= '</ol>' . "\r\n";
$content .= '<p>' . __e('To add more item types, go to the <code>Directives</code> -&raquo; <code>Additional Directives</code>') . ':</p>' . "\r\n";

$content .= '<hr/>' . "\r\n";

$content .= '<h4>' . __e('Variables') . ':</h4>' . "\r\n";
$content .= '<div class="callout callout-default">There are some logic that auto coding can\'t handle:</div>' . "\r\n";
$content .= '<ol>' . "\r\n";

$content .= '<li>' . "\r\n";
$content .= '<p><strong>Multi-dimensional variables</strong> for <strong>numbers</strong> can only be one level, as follows:</p>' . "\r\n";
$content .= '<pre>' . "\r\n";
$content .= 'item[0].src = support' . "\r\n";
$content .= 'item[0].full.image[0] = not support' . "\r\n";
$content .= '</pre>' . "\r\n";
$content .= '</li>' . "\r\n";

$content .= '<li>' . "\r\n";
$content .= '<p>The <strong>Get All Variable</strong> button cannot be used for JSON that requires authorization</p>' . "\r\n";
$content .= '</li>' . "\r\n";

$content .= '</ol>' . "\r\n";

$content .= '</div><!-- ./box-body -->' . "\r\n";
$content .= '</div><!-- ./box -->' . "\r\n";


$content .= '</div><!-- ./col-md-5 -->' . "\r\n";
$content .= '</div><!-- ./row -->' . "\r\n";
$content .= '</form><!-- ./form -->' . "\r\n";

$content .= $icon->display('ion');
// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=json-scraping&page-target="+$("#page-target").val(),!1});';
$page_js .= '$("#var-lists").sortable({opacity: 0.5, items: ".var-item",revert: true,placeholder: "sort-highlight",forcePlaceholderSize: false,zIndex: 999999,cancel: ".move-disabled",handle: ".handle",});';
$page_js .= '$("#page-template-list-item").click(function(){';
$page_js .= 'switch($(this).val()){' . "\r\n";
foreach ($template_listing_options as $tpl)
{
    $var = $tpl['value'];
    $page_js .= 'case "' . $var . '":' . "\r\n";
    $page_js .= '$("#page-template-list-item-note").html(\'' . $template_listing[$var] . '\');' . "\r\n";
    $page_js .= 'break;' . "\r\n";
}
$page_js .= '}' . "\r\n";
$page_js .= '});';


// TODO: -----------------------------------------------
// TODO: ITEM LISTING
function item_listing($addons)
{
    global $string;
    global $current_app;
    $z = 1;
    $tags = null;
    foreach ($addons['vars'] as $item_var)
    {
        if ($item_var['list'] == true)
        {

            $ngIf = '*ngIf="item.' . $item_var['var'] . '"';
            if (preg_match("/\./i", $item_var['var']))
            {
                $new_all_var = $fix_new_all_var = array();
                $new_var = $fix_new_var = array();
                $exp = explode(".", $item_var['var']);

                foreach ($exp as $var)
                {
                    if (preg_match("/\[/i", $var))
                    {
                        $fix_new_var[] = preg_replace("/\[(\w+)\]/", "", $var);
                        $fix_new_all_var[] = 'item.' . implode('.', $fix_new_var);
                    }
                }

                foreach ($exp as $var)
                {
                    $new_var[] = $var;
                    $new_all_var[] = 'item.' . implode('.', $new_var);
                }
                $fix_var_error = null;
                if (count($fix_new_all_var) > 0)
                {
                    $fix_var_error = implode(' && ', $fix_new_all_var) . ' && ';
                }

                //$ngIf = '*ngIf="' . $fix_var_error . ' ' . implode(' && ', $new_all_var) . '"';
                $ngIf = '*ngIf="' . implode(' && ', $new_all_var) . '"';
            }

            $ngIf = '*ngIf="' . ngIf('item.' . $item_var['var']) . '"';

            switch ($item_var['type'])
            {
                    // TODO: ITEM LISTING - ID
                case 'id':
                    $tags .= "\t\t" . '{{ item.' . $item_var['var'] . ' }}' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - TEXT
                case 'text':
                    $tags .= "\t\t" . '{{ item.' . $item_var['var'] . ' }}' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - NUMBER
                case 'number':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t" . '{{ item.' . $item_var['var'] . '|number:\'1.0-3\' }}' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - DATE
                case 'date':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                    $tags .= "\t\t" . '{{ item.' . $item_var['var'] . '|date:\'fullDate\' }}' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CURRENCY
                case 'currency':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/CurrencyPipe -->' . "\r\n";
                    $tags .= "\t\t" . '{{ item.' . $item_var['var'] . '|currency:\'USD\' }}' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - IMAGE
                case 'image':
                    $tags .= "\t\t" . '<img ' . $ngIf . ' [src]="item.' . $item_var['var'] . '" />' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - LABEL-HEADING
                case 'label-heading':
                    $tags .= "\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<h3 [innerHTML]="item.' . $item_var['var'] . '"></h3>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - LABEL-PARAGRAPH
                case 'label-paragraph':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<p ' . $ngIf . ' [innerHTML]="item.' . $item_var['var'] . '"></p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - LABEL-NUMBER
                case 'label-number':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t\t" . '<p>{{ item.' . $item_var['var'] . '|number:\'1.0-3\' }}</p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - LABEL-DATE
                case 'label-date':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                    $tags .= "\t\t\t" . '<p>{{ item.' . $item_var['var'] . '|date:\'fullDate\' }}</p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - LABEL-CURRENCY
                case 'label-currency':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/CurrencyPipe -->' . "\r\n";
                    $tags .= "\t\t\t" . '<p>{{ item.' . $item_var['var'] . ' | currency:\'' . $addons['currency-symbol'] . '\' }}</p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - BADGE-START
                case 'badge-start':
                    $tags .= "\t\t" . '<ion-badge slot="start" ' . $ngIf . '>{{ item.' . $item_var['var'] . ' }}</ion-badge>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - BADGE-END
                case 'badge-end':
                    $tags .= "\t\t" . '<ion-badge slot="end" ' . $ngIf . '>{{ item.' . $item_var['var'] . ' }}</ion-badge>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - ICON-START
                case 'icon-start':
                    $tags .= "\t\t" . '<ion-icon slot="start" color="primary" ' . $ngIf . ' [name]="item.' . $item_var['var'] . '"></ion-icon>' . "\r\n";
                    $tags .= "\t\t" . '<ion-icon slot="start" color="primary" *ngIf="!item.' . $item_var['var'] . '" name="' . $addons['icon-default'] . '"></ion-icon>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - ICON-END
                case 'icon-end':
                    $tags .= "\t\t" . '<ion-icon slot="end" color="primary" ' . $ngIf . ' [name]="item.' . $item_var['var'] . '"></ion-icon>' . "\r\n";
                    $tags .= "\t\t" . '<ion-icon slot="end" color="primary" *ngIf="!item.' . $item_var['var'] . '" name="' . $addons['icon-default'] . '"></ion-icon>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - BADGE-START
                case 'note-start':
                    $tags .= "\t\t" . '<ion-note slot="start" ' . $ngIf . '>{{ item.' . $item_var['var'] . ' }}</ion-note>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - BADGE-END
                case 'note-end':
                    $tags .= "\t\t" . '<ion-note slot="end" ' . $ngIf . '>{{ item.' . $item_var['var'] . ' }}</ion-note>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - AVATAR
                case 'avatar':
                    $tags .= "\t\t" . '<ion-avatar>' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="item.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-avatar>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - AVATAR-START
                case 'avatar-start':
                    $tags .= "\t\t" . '<ion-avatar slot="start">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="item.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-avatar>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - AVATAR-END
                case 'avatar-end':
                    $tags .= "\t\t" . '<ion-avatar slot="end">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="item.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-avatar>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - THUMBNAIL-START
                case 'thumbnail-start':
                    $tags .= "\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="item.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-thumbnail>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - THUMBNAIL-END
                case 'thumbnail-end':
                    $tags .= "\t\t" . '<ion-thumbnail slot="end">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="item.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-thumbnail>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-HEADER-TITLE
                case 'card-header-title':
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-title [innerHTML]="item.' . $item_var['var'] . '"></ion-card-title>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-HEADER-SUBTITLE
                case 'card-header-subtitle':
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle [innerHTML]="item.' . $item_var['var'] . '"></ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-HEADER-SUBTITLE-DATE
                case 'card-header-subtitle-date':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle>{{ item.' . $item_var['var'] . '|date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-HEADER-SUBTITLE-NUMBER
                case 'card-header-subtitle-number':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle>{{ item.' . $item_var['var'] . '|number:\'1.0-3\' }}</ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-HEADER-SUBTITLE-CURRENCY
                case 'card-header-subtitle-currency':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle>{{ item.' . $item_var['var'] . ' | currency:\'' . $addons['currency-symbol'] . '\' }}</ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-CONTENT
                case 'card-content':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . ' [innerHTML]="item.' . $item_var['var'] . '"></ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-BOOKMARK
                case 'item-bookmark':
                    $tags .= "\t\t" . '<ion-button color="danger" fill="outline" slot="end" (click)="saveBookmark(item.' . $addons['var-id'] . ',item)">+ <ion-icon name="heart"></ion-icon></ion-button>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-LABEL
                case 'card-item-label':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '{{ item.' . $item_var['var'] . ' }}' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-LABEL
                case 'card-item-label-heading':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<h3>{{ item.' . $item_var['var'] . ' }}</h3>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-AVATAR
                case 'card-item-avatar':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-avatar ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-AVATAR-START
                case 'card-item-avatar-start':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-avatar ' . $ngIf . ' slot="start">' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-AVATAR-END
                case 'card-item-avatar-end':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-avatar ' . $ngIf . ' slot="end">' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM LISTING - CARD-ITEM-THUMBNAIL
                case 'card-item-thumbnail':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-thumbnail ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-THUMBNAIL-START
                case 'card-item-thumbnail-start':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-thumbnail ' . $ngIf . ' slot="start">' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-ITEM-THUMBNAIL-END
                case 'card-item-thumbnail-end':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-thumbnail ' . $ngIf . ' slot="end">' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM LISTING - CARD-CONTENT-IMAGE
                case 'card-content-image':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<img [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - CARD-CONTENT-VIDEO
                case 'card-content-video':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<video controls>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<source [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t\t" . 'Your browser does not support the video tag' . "\r\n";
                    $tags .= "\t\t\t" . '</video>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-CONTENT-AUDIO
                case 'card-content-audio':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<audio controls>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<source [src]="item.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t\t" . 'Your browser does not support the audio element' . "\r\n";
                    $tags .= "\t\t\t" . '</audio>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-CONTENT-IFRAME
                case 'card-content-iframe':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<iframe [src]="item.' . $item_var['var'] . ' | trustResourceUrl"></iframe> ' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-LIST-HEADER-LABEL
                case 'item-list-header-label':
                    $tags .= "\t\t" . '<ion-list-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label [innerHTML]="item.' . $item_var['var'] . '"></ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-list-header>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-LABEL
                case 'item-label':
                    $tags .= "\t\t" . '<ion-item ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label [innerHTML]="item.' . $item_var['var'] . '"></ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-IN-APP-BROWSER
                case 'item-in-app-browser':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' appBrowser [url]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-APP-WEBVIEW
                case 'item-app-webview':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' appWebview [url]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-SYSTEM-BROWSER
                case 'item-system-browser':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' systemBrowser [url]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-EMAIL-APP
                case 'item-email-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' mailApp [emailAddress]="item.' . $item_var['var'] . '" emailSubject="subject" emailMessage="' . ($item_var['label']) . '">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="at" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>{{ item.' . $item_var['var'] . ' }}</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-SMS-APP
                case 'item-sms-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' smsApp [phoneNumber]="item.' . $item_var['var'] . '" shortMessage="' . ($item_var['label']) . '">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="mail" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>{{ item.' . $item_var['var'] . ' }}</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-CALL-APP
                case 'item-call-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' callApp [phoneNumber]="item.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="call" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>{{ item.' . $item_var['var'] . ' }}</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - ITEM-GEO-APP
                case 'item-geo-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' geoApp [location]="item.' . $item_var['var'] . '" [query]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="locate" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - ITEM-SOCIAL-SHARE
                case 'item-social-share':

                    $tags .= "\t\t" . '<ion-row ' . $ngIf . '>' . "\r\n";

                    $tags .= "\t\t\t" . '<!-- fb share - remove this line' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" facebookApp [url]="item.' . $item_var['var'] . '"><ion-icon slot="icon-only" name="logo-facebook"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";
                    $tags .= "\t\t\t" . 'fb share - remove this line -->' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" twitterApp message="{{ item.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="logo-twitter"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="success" whatsappApp message="{{ item.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="logo-whatsapp"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" lineApp message="{{ item.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="chatbubbles"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="danger" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ item.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="mail-open"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" smsApp phoneNumber="0123456789" [shortMessage]="item.' . $item_var['var'] . '"><ion-icon slot="icon-only" name="send"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";


                    $tags .= "\t\t" . '</ion-row>' . "\r\n";

                    break;
                    // TODO: ITEM LISTING - ITEM-SOCIAL-SHARE-FAB
                case 'item-social-share-fab':

                    $tags .= "\t\t" . '<ion-fab ' . $ngIf . ' horizontal="end" vertical="bottom" slot="fixed" >' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-fab-button color="tertiary">' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-icon name="share"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-fab-button>' . "\r\n";


                    $tags .= "\t\t\t" . '<ion-fab-list side="start">' . "\r\n";

                    $tags .= "\t\t\t\t" . '<!-- fb share - remove this line' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-fab-button color="primary" facebookApp [url]="item.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="logo-facebook"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";
                    $tags .= "\t\t\t\t" . 'fb share - remove this line -->' . "\r\n";


                    $tags .= "\t\t\t\t" . '<ion-fab-button color="secondary" twitterApp [message]="item.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="logo-twitter"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="success" whatsappApp [message]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="primary" lineApp [message]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="chatbubbles"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="secondary" mailApp emailAddress="user@domain.com" [emailSubject]="hi" [emailMessage]="item.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="mail-open"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="danger" smsApp phoneNumber="0123456789" [shortMessage]="item.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="send"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t" . '</ion-fab-list>' . "\r\n";

                    $tags .= "\t\t" . '</ion-fab>' . "\r\n";

                    break;


                    // TODO: ITEM DETAIL - ITEM-TEXT-TO-SPEECH
                case 'native-text-to-speech':

                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' textToSpeech locale="' . $current_app['apps']['app-locale'] . '" [text]="item.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="megaphone" slot="start" color="primary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - STREAMING-MEDIA-VIDEO-PLAYER
                case 'native-streaming-media-video-player':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' streamingMedia format="video" orientation="landscape" controls="false" url="{{ item.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="arrow-dropright-circle" slot="start" color="primary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM LISTING - STREAMING-MEDIA-AUDIO-PLAYER
                case 'native-streaming-media-audio-player':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' streamingMedia format="audio" url="{{ item.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="arrow-dropright-circle" slot="start" color="primary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - PLAY-WITH-YOUTUBE-APP
                case 'play-with-youtube-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' playWithYoutubeApp videoId="{{ item.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="logo-youtube" color="danger" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM LISTING - PAY-WITH-PAYPAL
                case 'native-pay-with-paypal':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . '  payWithPaypal price="{{ item.' . $item_var['var'] . ' }}" info="{{ item.' . $addons['search-by'] . ' | stripTags }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="cash" slot="start" color="tertiary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: PREVIEW-ANY-FILE
                case 'native-pay-with-paypal':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . '  previewAnyFile src="{{ item.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM LISTING - INSTAGRAM-APP
                case 'native-instagram-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . '  instagramApp image="{{ item.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="logo-instagram" slot="start" color="danger"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM LISTING - CARD-ITEM-BOOKMARK
                case 'card-item-bookmark':
                    $tags .= "\t\t" . '<ion-item lines="none">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-button color="danger" fill="outline" slot="end" (click)="saveBookmark(item.' . $addons['var-id'] . ',item)">+ <ion-icon name="heart"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM LISTING - X-SOCIAL-SHARING
                case 'x-social-sharing':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . '  xSocialSharing message="{{ item.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="share" slot="start" color="danger"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM LISTING - TAKE-SCREENSHOT
                case 'take-screenshot':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . '  takeScreenshot >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="scan" slot="start" color="danger"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


            }
        }
        $z++;
    }
    $fix_tags = $tags;
    $fix_tags = str_replace("\r\n\t\t</ion-label>\r\n\t\t<ion-label>", "", $fix_tags);
    $fix_tags = str_replace("\r\n\t\t</ion-item>\r\n\t\t<ion-item>", "", $fix_tags);
    return $fix_tags;
}


// TODO: -----------------------------------------------
// TODO: ITEM DETAIL
function item_detail($addons)
{


    global $string;
    global $current_app;
    $varName = 'data' . $string->toClassName($addons['page-target']);
    $z = 1;
    $tags = null;
    foreach ($addons['vars'] as $item_var)
    {
        if ($item_var['detail'] == true)
        {
            $ngIf = '*ngIf="' . $varName . '.' . $item_var['var'] . '"';
            if (preg_match("/\./i", $item_var['var']))
            {
                $new_all_var = $fix_new_all_var = array();
                $new_var = $fix_new_var = array();
                $exp = explode(".", $item_var['var']);

                foreach ($exp as $var)
                {
                    if (preg_match("/\[/i", $var))
                    {
                        $fix_new_var[] = preg_replace("/\[(\w+)\]/", "", $var);
                        $fix_new_all_var[] = '' . $varName . '.' . implode('.', $fix_new_var);
                    }
                }

                foreach ($exp as $var)
                {
                    $new_var[] = $var;
                    $new_all_var[] = '' . $varName . '.' . implode('.', $new_var);
                }
                $fix_var_error = null;
                if (count($fix_new_all_var) > 0)
                {
                    $fix_var_error = implode(' && ', $fix_new_all_var) . ' && ';
                }

                $test = explode('[', $item_var['var']);
                if (count($test) == 2)
                {
                    $ngIf = '*ngIf="' . $fix_var_error . '' . implode(' && ', $new_all_var) . '"';
                } else
                {
                    $ngIf = '*ngIf="' . implode(' && ', $new_all_var) . '"';
                }


            }
            $ngIf = '*ngIf="' . ngIf($varName . '.' . $item_var['var']) . '"';

            switch ($item_var['type'])
            {
                    // TODO: ITEM DETAIL - ID
                case 'id':
                    $tags .= "\t\t" . '{{ ' . $varName . '.' . $item_var['var'] . ' }}' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - TEXT
                case 'text':
                    $tags .= "\t\t" . '{{ ' . $varName . '.' . $item_var['var'] . ' }}' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - NUMBER
                case 'number':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t" . '{{ ' . $varName . '.' . $item_var['var'] . '|number:\'1.0-3\' }}' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - DATE
                case 'date':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                    $tags .= "\t\t" . '{{ ' . $varName . '.' . $item_var['var'] . '|date:\'fullDate\' }}' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CURRENCY
                case 'currency':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/CurrencyPipe -->' . "\r\n";
                    $tags .= "\t\t" . '{{ ' . $varName . '.' . $item_var['var'] . ' | currency:\'' . $addons['currency-symbol'] . '\' }}' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - IMAGE
                case 'image':
                    $tags .= "\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '.' . $item_var['var'] . '" />' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - LABEL-HEADING
                case 'label-heading':
                    $tags .= "\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<h3 [innerHTML]="' . $varName . '.' . $item_var['var'] . '"></h3>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - LABEL-PARAGRAPH
                case 'label-paragraph':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<p ' . $ngIf . ' [innerHTML]="' . $varName . '.' . $item_var['var'] . '"></p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - LABEL-NUMBER
                case 'label-number':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t\t" . '<p>{{ ' . $varName . '.' . $item_var['var'] . '|number:\'1.0-3\' }}</p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - LABEL-DATE
                case 'label-date':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                    $tags .= "\t\t\t" . '<p>{{ ' . $varName . '.' . $item_var['var'] . '|date:\'fullDate\' }}</p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - LABEL-CURRENCY
                case 'label-currency':
                    $tags .= "\t\t" . '<ion-label>' . "\r\n";
                    $tags .= "\t\t\t" . '<!-- reference: https://angular.io/api/common/CurrencyPipe -->' . "\r\n";
                    $tags .= "\t\t\t" . '<p>{{ ' . $varName . '.' . $item_var['var'] . '|currency:\'USD\' }}</p>' . "\r\n";
                    $tags .= "\t\t" . '</ion-label>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - BADGE-START
                case 'badge-start':
                    $tags .= "\t\t" . '<ion-badge slot="start" ' . $ngIf . '>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-badge>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - BADGE-END
                case 'badge-end':
                    $tags .= "\t\t" . '<ion-badge slot="end" ' . $ngIf . '>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-badge>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - ICON-START
                case 'icon-start':
                    $tags .= "\t\t" . '<ion-icon slot="start" color="primary" ' . $ngIf . ' [name]="' . $varName . '.' . $item_var['var'] . '"></ion-icon>' . "\r\n";
                    $tags .= "\t\t" . '<ion-icon slot="start" color="primary" *ngIf="!' . $varName . '.' . $item_var['var'] . '" name="' . $addons['icon-default'] . '"></ion-icon>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - ICON-END
                case 'icon-end':
                    $tags .= "\t\t" . '<ion-icon slot="end" color="primary" ' . $ngIf . ' [name]="' . $varName . '.' . $item_var['var'] . '"></ion-icon>' . "\r\n";
                    $tags .= "\t\t" . '<ion-icon slot="end" color="primary" *ngIf="!' . $varName . '.' . $item_var['var'] . '" name="' . $addons['icon-default'] . '"></ion-icon>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - BADGE-START
                case 'note-start':
                    $tags .= "\t\t" . '<ion-note slot="start" ' . $ngIf . '>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-note>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - BADGE-END
                case 'note-end':
                    $tags .= "\t\t" . '<ion-note slot="end" ' . $ngIf . '>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-note>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - AVATAR
                case 'avatar':
                    $tags .= "\t\t" . '<ion-avatar>' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-avatar>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - AVATAR-START
                case 'avatar-start':
                    $tags .= "\t\t" . '<ion-avatar slot="start">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-avatar>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - AVATAR-END
                case 'avatar-end':
                    $tags .= "\t\t" . '<ion-avatar slot="end">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-avatar>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - THUMBNAIL-START
                case 'thumbnail-start':
                    $tags .= "\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-thumbnail>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - THUMBNAIL-END
                case 'thumbnail-end':
                    $tags .= "\t\t" . '<ion-thumbnail slot="end">' . "\r\n";
                    $tags .= "\t\t\t" . '<img ' . $ngIf . ' [src]="' . $varName . '.' . $item_var['var'] . '" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-thumbnail>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-HEADER-TITLE
                case 'card-header-title':
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-title [innerHTML]="' . $varName . '.' . $item_var['var'] . '"></ion-card-title>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-HEADER-SUBTITLE
                case 'card-header-subtitle':
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle [innerHTML]="' . $varName . '.' . $item_var['var'] . '"></ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-HEADER-SUBTITLE-DATE
                case 'card-header-subtitle-date':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DatePipe -->' . "\r\n";
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle>{{ ' . $varName . '.' . $item_var['var'] . '|date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-HEADER-SUBTITLE-NUMBER
                case 'card-header-subtitle-number':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle>{{ ' . $varName . '.' . $item_var['var'] . '|number:\'1.0-3\' }}</ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-HEADER-SUBTITLE-CURRENCY
                case 'card-header-subtitle-currency':
                    $tags .= "\t\t" . '<!-- reference: https://angular.io/api/common/DecimalPipe -->' . "\r\n";
                    $tags .= "\t\t" . '<ion-card-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-card-subtitle>{{ ' . $varName . '.' . $item_var['var'] . ' | currency:\'' . $addons['currency-symbol'] . '\' }}</ion-card-subtitle>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-header>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-CONTENT
                case 'card-content':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . ' [innerHTML]="' . $varName . '.' . $item_var['var'] . ' | trustHtml"></ion-card-content>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - CARD-ITEM-THUMBNAIL
                case 'card-item-thumbnail':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-thumbnail ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - CARD-ITEM-THUMBNAIL-START
                case 'card-item-thumbnail-start':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-thumbnail slot="start" ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - CARD-ITEM-THUMBNAIL-END
                case 'card-item-thumbnail-end':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-thumbnail slot="end" ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - CARD-ITEM-AVATAR
                case 'card-item-avatar':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-avatar ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - CARD-ITEM-AVATAR-START
                case 'card-item-avatar-start':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-avatar slot="start" ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - CARD-ITEM-AVATAR-END
                case 'card-item-avatar-end':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-avatar slot="end" ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - CARD-ITEM-LABEL
                case 'card-item-label':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '{{ ' . $varName . '.' . $item_var['var'] . ' }}' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - CARD-ITEM-LABEL-HEADING
                case 'card-item-label-heading':
                    $tags .= "\t\t" . '<ion-item>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<h3>{{ ' . $varName . '.' . $item_var['var'] . ' }}</h3>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - CARD-CONTENT-IMAGE
                case 'card-content-image':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<img [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-CONTENT-VIDEO
                case 'card-content-video':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<video controls>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<source [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t\t" . 'Your browser does not support the video tag' . "\r\n";
                    $tags .= "\t\t\t" . '</video>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-CONTENT-AUDIO
                case 'card-content-audio':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<audio controls>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<source [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl" />' . "\r\n";
                    $tags .= "\t\t\t\t" . 'Your browser does not support the audio element' . "\r\n";
                    $tags .= "\t\t\t" . '</audio>' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - CARD-CONTENT-IFRAME
                case 'card-content-iframe':
                    $tags .= "\t\t" . '<ion-card-content ' . $ngIf . '>' . "\r\n";
                    $tags .= "\t\t\t" . '<iframe [src]="' . $varName . '.' . $item_var['var'] . ' | trustResourceUrl"></iframe> ' . "\r\n";
                    $tags .= "\t\t" . '</ion-card-content>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-LIST-HEADER-LABEL
                case 'item-list-header-label':
                    $tags .= "\t\t" . '<ion-list-header ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label [innerHTML]="' . $varName . '.' . $item_var['var'] . '"></ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-list-header>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-LABEL
                case 'item-label':
                    $tags .= "\t\t" . '<ion-item ' . $ngIf . ' >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label [innerHTML]="' . $varName . '.' . $item_var['var'] . '"></ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-IN-APP-BROWSER
                case 'item-in-app-browser':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' appBrowser [url]="' . $varName . '.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-APP-WEBVIEW
                case 'item-app-webview':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' appWebview [url]="' . $varName . '.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-SYSTEM-BROWSER
                case 'item-system-browser':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' systemBrowser [url]="' . $varName . '.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="link" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-EMAIL-APP
                case 'item-email-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' mailApp [emailAddress]="' . $varName . '.' . $item_var['var'] . '" emailSubject="subject" emailMessage="' . ($item_var['label']) . '">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="at" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-SMS-APP
                case 'item-sms-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' smsApp [phoneNumber]="' . $varName . '.' . $item_var['var'] . '" shortMessage="' . ($item_var['label']) . '">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="mail" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-CALL-APP
                case 'item-call-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' callApp [phoneNumber]="' . $varName . '.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="call" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>{{ ' . $varName . '.' . $item_var['var'] . ' }}</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - ITEM-GEO-APP
                case 'item-geo-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' geoApp [location]="' . $varName . '.' . $item_var['var'] . '" [query]="[' . $varName . '.' . $item_var['var'] . ']" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="locate" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - ITEM-SOCIAL-SHARE
                case 'item-social-share':
                    $tags .= "\t\t" . '<ion-row ' . $ngIf . '>' . "\r\n";

                    $tags .= "\t\t\t" . '<!-- fb share - remove this line' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" facebookApp [url]="' . $varName . '.' . $item_var['var'] . '"><ion-icon slot="icon-only" name="logo-facebook"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";
                    $tags .= "\t\t\t" . 'fb share - remove this line -->' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" twitterApp message="{{ ' . $varName . '.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="logo-twitter"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="success" whatsappApp message="{{ ' . $varName . '.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="logo-whatsapp"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="secondary" lineApp message="{{ ' . $varName . '.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="chatbubbles"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="danger" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ ' . $varName . '.' . $item_var['var'] . ' }}"><ion-icon slot="icon-only" name="mail-open"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-col>' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-button expand="block" size="small" fill="outline" color="primary" smsApp phoneNumber="0123456789" [shortMessage]="' . $varName . '.' . $item_var['var'] . '"><ion-icon slot="icon-only" name="send"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-col>' . "\r\n";


                    $tags .= "\t\t" . '</ion-row>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - ITEM-SOCIAL-SHARE-FAB
                case 'item-social-share-fab':

                    $tags .= "\t\t" . '<ion-fab ' . $ngIf . ' horizontal="end" vertical="bottom" slot="fixed">' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-fab-button color="tertiary">' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-icon name="share"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t" . '<ion-fab-list side="top">' . "\r\n";

                    $tags .= "\t\t\t\t" . '<!-- fb share - remove this line' . "\r\n";
                    $tags .= "\t\t\t\t" . '<ion-fab-button color="primary" facebookApp [url]="' . $varName . '.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="logo-facebook"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";
                    $tags .= "\t\t\t\t" . 'fb share - remove this line -->' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="secondary" twitterApp [message]="' . $varName . '.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="logo-twitter"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="success" whatsappApp [message]="' . $varName . '.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="primary" lineApp [message]="' . $varName . '.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="chatbubbles"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="secondary" mailApp emailAddress="user@domain.com" [emailSubject]="hi" [emailMessage]="' . $varName . '.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="mail-open"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t\t" . '<ion-fab-button color="danger" smsApp phoneNumber="0123456789" [shortMessage]="' . $varName . '.' . $item_var['var'] . '">' . "\r\n";
                    $tags .= "\t\t\t\t\t" . '<ion-icon name="send"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t\t" . '</ion-fab-button>' . "\r\n";

                    $tags .= "\t\t\t" . '</ion-fab-list>' . "\r\n";

                    $tags .= "\t\t" . '</ion-fab>' . "\r\n";

                    break;

                    // TODO: ITEM DETAIL - ITEM-BOOKMARK
                case 'item-bookmark':
                    $tags .= "\t\t" . '<ion-button color="danger" fill="outline" slot="end" (click)="saveBookmark(' . $varName . '.' . $addons['var-id'] . ',' . $varName . ')">+ <ion-icon name="heart"></ion-icon></ion-button>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - ITEM-TEXT-TO-SPEECH
                case 'native-text-to-speech':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' textToSpeech locale="' . $current_app['apps']['app-locale'] . '" [text]="' . $varName . '.' . $item_var['var'] . '" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="megaphone" slot="start" color="primary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - STREAMING-MEDIA-VIDEO-PLAYER
                case 'native-streaming-media-video-player':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' streamingMedia format="video" orientation="landscape" controls="false" url="{{ ' . $varName . '.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="arrow-dropright-circle" slot="start" color="primary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - STREAMING-MEDIA-AUDIO-PLAYER
                case 'native-streaming-media-audio-player':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' streamingMedia format="audio" url="{{ ' . $varName . '.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="arrow-dropright-circle" slot="start" color="primary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - PLAY-WITH-YOUTUBE-APP
                case 'play-with-youtube-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' playWithYoutubeApp videoId="{{ ' . $varName . '.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="logo-youtube" color="danger" slot="start"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - PAY-WITH-PAYPAL
                case 'native-pay-with-paypal':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' payWithPaypal price="{{ ' . $varName . '.' . $item_var['var'] . ' }}" info="{{ ' . $varName . '.' . $addons['search-by'] . ' | stripTags }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="cash" slot="start" color="tertiary"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - PREVIEW-ANY-FILE
                case 'native-preview-any-file':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' previewAnyFile src="{{ ' . $varName . '.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - INSTAGRAM-APP
                case 'native-instagram-app':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' instagramApp image="{{ ' . $varName . '.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="logo-instagram" slot="start" color="danger"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;


                    // TODO: ITEM DETAIL - CARD-ITEM-BOOKMARK
                case 'card-item-bookmark':
                    $tags .= "\t\t" . '<ion-item lines="none">' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-button color="danger" fill="outline" slot="end" (click)="saveBookmark(' . $varName . '.' . $addons['var-id'] . ',' . $varName . ')">+ <ion-icon name="heart"></ion-icon></ion-button>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

                    // TODO: ITEM DETAIL - SOCIAL-X-SHARING
                case 'x-social-sharing':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' xSocialSharing message="{{ ' . $varName . '.' . $item_var['var'] . ' }}" >' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="share" slot="start" color="danger"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;
                    // TODO: ITEM DETAIL - TAKE-SCREENSHOT
                case 'take-screenshot':
                    $tags .= "\t\t" . '<ion-item button ' . $ngIf . ' takeScreenshot>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-icon name="scan" slot="start" color="danger"></ion-icon>' . "\r\n";
                    $tags .= "\t\t\t" . '<ion-label>' . ($item_var['label']) . '</ion-label>' . "\r\n";
                    $tags .= "\t\t" . '</ion-item>' . "\r\n";
                    break;

            }
        }
        $z++;
    }
    $fix_tags = $tags;
    $fix_tags = str_replace("\r\n\t\t</ion-label>\r\n\t\t<ion-label>", "", $fix_tags);
    $fix_tags = str_replace("\r\n\t\t</ion-item>\r\n\t\t<ion-item>", "", $fix_tags);

    return $fix_tags;
}

function ngIf($vars)
{
    $vars = explode('.', $vars);
    $new_var = array();
    foreach ($vars as $var)
    {
        if (preg_match("/\[/", $var))
        {
            $_var = explode('[', $var);
            $new_var[] = $_var[0];
            unset($_var[0]);
            foreach ($_var as $__var)
            {

                $new_var[] = '[' . $__var;
            }

        } else
        {
            $new_var[] = $var;
        }
    }


    $ngIf = array();
    $_var = null;
    foreach ($new_var as $code_var)
    {
        $_var .= $code_var . '.';
        $ngIf[] = substr($_var, 0, (strlen($_var) - 1));
    }

    $ngIfCode = implode(' && ', str_replace('.[', '[', $ngIf));
    return $ngIfCode;
}
