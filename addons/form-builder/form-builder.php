<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `form-builder`
 */

defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("form-builder");
$string = new jsmString();

// TODO: INPUT TYPE
$input_types = array();
$input_types[] = array('value' => 'ion-item-divider', 'label' => 'Ion Divider');
$input_types[] = array('value' => 'hidden', 'label' => 'Hidden Value');
$input_types[] = array('value' => 'ion-input', 'label' => 'Ion Input : Text');
$input_types[] = array('value' => 'ion-input-email', 'label' => 'Ion Input : Email');
$input_types[] = array('value' => 'ion-input-number', 'label' => 'Ion Input : Number');
$input_types[] = array('value' => 'ion-input-tel', 'label' => 'Ion Input : Telphone');
$input_types[] = array('value' => 'ion-input-url', 'label' => 'Ion Input : URL');
$input_types[] = array('value' => 'ion-input-file', 'label' => 'Ion Input : File Upload');

$input_types[] = array('value' => 'ion-textarea', 'label' => 'Ion Textarea');
$input_types[] = array('value' => 'ion-select', 'label' => 'Ion Select');
$input_types[] = array('value' => 'ion-datetime-date', 'label' => 'Ion Date Time : Date');
$input_types[] = array('value' => 'ion-datetime-time', 'label' => 'Ion Date Time : Time');
$input_types[] = array('value' => 'ion-radio', 'label' => 'Ion Radio');
$input_types[] = array('value' => 'ion-range', 'label' => 'Ion Range');
$input_types[] = array('value' => 'ion-toggle', 'label' => 'Ion Toggle');
$input_types[] = array('value' => 'ion-button', 'label' => 'Ion Button');


// TODO: METHOD TYPE
$method_types = array();
$method_types[] = array('value' => 'POST', 'label' => 'POST');
$method_types[] = array('value' => 'GET', 'label' => 'GET');
//$method_types[] = array('value' => 'PUT', 'label' => 'PUT');

$response_types = array();
$response_types[] = array('value' => 'json', 'label' => 'JSON');
$response_types[] = array('value' => 'text', 'label' => 'Text');


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('form-builder', $current_page_target);
    header('Location: ./?p=addons&addons=form-builder&' . time());
}

// TODO: POST
if (isset($_POST['save-form-builder']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['form-builder']['page-title']);
    $addons['page-header-color'] = trim($_POST['form-builder']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['form-builder']['page-content-background']);
    $addons['method'] = trim($_POST['form-builder']['method']);
    $addons['action'] = trim($_POST['form-builder']['action']);

    $addons['response-type'] = trim($_POST['form-builder']['response-type']);
    $addons['message-variable'] = trim($_POST['form-builder']['message-variable']);
    $addons['title-variable'] = trim($_POST['form-builder']['title-variable']);

    $addons['regex-pattern'] = trim($_POST['form-builder']['regex-pattern']);
    $addons['success-message'] = trim($_POST['form-builder']['success-message']);
    $addons['error-message'] = trim($_POST['form-builder']['error-message']);


    $x = 0;
    foreach ($_POST['form-builder']['forms'] as $forms)
    {
        if ($forms['name'] != '')
        {
            $addons['forms'][$x]['type'] = $string->toFileName($forms['type']);
            $addons['forms'][$x]['name'] = $string->toFileName($forms['name']);
            $addons['forms'][$x]['label'] = $forms['label'];
            $addons['forms'][$x]['option'] = $forms['option'];
            $addons['forms'][$x]['default'] = $forms['default'];
            $x++;
        }
    }
    $db->saveAddOns('form-builder', $addons);

    // TODO: SERVICES
    $service['name'] = $current_page_target;
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get data';


    $z = 0;
    // TODO: SERVICES --|-- MODULES
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
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
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

    // TODO: SERVICES --|-- CODE - EXPORT
    $service['code']['export'] = null;


    $query = null;
    // TODO: SERVICES --|-- CODE - OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    switch (strtolower($addons['method']))
    {
        case 'post':
            $service['code']['other'] .= "\t" . 'apiURL: string = "' . $addons['action'] . '"; //' . "\r\n";
            break;
        case 'get':
            $fix_url = explode('?', $addons['action']);
            $query = parse_url($addons['action'], PHP_URL_QUERY);
            $service['code']['other'] .= "\t" . 'apiURL: string = "' . $fix_url[0] . '"; // ' . $query . '' . "\r\n";
            break;
    }

    $service['code']['other'] .= "\t" . '' . "\r\n";

    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    $inputs = null;
    foreach ($addons['forms'] as $form)
    {
        $var_input = $string->toUserClassName($form['name']);
        $name_input = $string->toFileName($form['name']);
        switch ($form['type'])
        {
            case 'ion-item-divider':
                break;
            case 'hidden':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-input':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-input-email':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-input-number':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-input-tel':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-input-url':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-input-file':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-textarea':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-select':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-datetime-date':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-datetime-time':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-radio':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-range':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
            case 'ion-toggle':
                $inputs .= "\t\t\t" . '"' . $name_input . '": field.' . $var_input . ',' . "\r\n";
                break;
        }
    }
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '/ ' . $string->toClassName($current_page_target) . 'Service.inputFields($obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'inputFields(field:any){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let inputs = {' . "\r\n";
    $service['code']['other'] .= substr($inputs, 0, (strlen($inputs) - 3)) . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpBuildQuery(inputs);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Service.httpBuildQuery(obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'httpBuildQuery(obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let k:any;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let str:any = [];' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'for (k in obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'str.push(encodeURIComponent(k) + "=" + encodeURIComponent(obj[k]));' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return str.join("&");' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    switch ($addons['response-type'])
    {
        case 'json':
            switch (strtolower($addons['method']))
            {
                case 'post':
                    $service['code']['other'] .= "\t" . '/**' . "\r\n";
                    $service['code']['other'] .= "\t" . '/ ' . $string->toClassName($current_page_target) . 'Service.postRequest()' . "\r\n";
                    $service['code']['other'] .= "\t" . '**/' . "\r\n";
                    $service['code']['other'] .= "\t" . 'postRequest(fields:any): Observable<any>{' . "\r\n";
                    $service['code']['other'] .= "\t\t" . '//console.log(fields);' . "\r\n";

                    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
                    $service['code']['other'] .= "\t\t" . '}' . "\r\n";

                    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
                    $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.apiURL,this.inputFields(fields), httpOptions)' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("RAW:",results);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast();' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("Handling error:", err);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,err.name,err.message);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("caught rethrown:", err);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
                    $service['code']['other'] .= "\t" . '}' . "\r\n";
                    $service['code']['other'] .= "\t" . '' . "\r\n";
                    $service['code']['other'] .= "\t" . '' . "\r\n";


                    break;
                case 'get':
                    $service['code']['other'] .= "\t" . '/**' . "\r\n";
                    $service['code']['other'] .= "\t" . '/ ' . $string->toClassName($current_page_target) . 'Service.getRequest()' . "\r\n";
                    $service['code']['other'] .= "\t" . '**/' . "\r\n";
                    $service['code']['other'] .= "\t" . 'getRequest(fields:any): Observable<any>{' . "\r\n";
                    $service['code']['other'] .= "\t\t" . '//console.log(fields);' . "\r\n";


                    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
                    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.apiURL + "?" + this.inputFields(fields) + "&' . $query . '")' . "\r\n";
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
                    $service['code']['other'] .= "\t\t" . '' . "\r\n";
                    $service['code']['other'] .= "\t" . '}' . "\r\n";
                    break;
                case 'put':
                    $service['code']['other'] .= "\t" . '/**' . "\r\n";
                    $service['code']['other'] .= "\t" . '/ ' . $string->toClassName($current_page_target) . 'Service.putRequest()' . "\r\n";
                    $service['code']['other'] .= "\t" . '**/' . "\r\n";
                    $service['code']['other'] .= "\t" . 'putRequest(fields:any){' . "\r\n";
                    $service['code']['other'] .= "\t\t" . 'console.log(fields);' . "\r\n";
                    $service['code']['other'] .= "\t\t" . '' . "\r\n";
                    $service['code']['other'] .= "\t" . '}' . "\r\n";
                    break;
            }
            break;
        case 'text':

            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '/**' . "\r\n";
            $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Service:stripTags()' . "\r\n";
            $service['code']['other'] .= "\t" . '**/' . "\r\n";
            $service['code']['other'] .= "\t" . 'stripTags(text:string,allowedTags:any[]): string{' . "\r\n";
            $service['code']['other'] .= "\t\t" . 'return allowedTags.length > 0' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . '? text.replace(new RegExp(`<(?!\/?(${allowedTags.join(\'|\')})\s*\/?)[^>]+>`, \'g\'), \'\')' . "\r\n";
            $service['code']['other'] .= "\t\t\t" . ': text.replace(/<(?:.|\s)*?>/g, \'\');' . "\r\n";
            $service['code']['other'] .= "\t" . '}' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            $service['code']['other'] .= "\t" . '' . "\r\n";
            switch (strtolower($addons['method']))
            {
                case 'post':
                    $service['code']['other'] .= "\t" . '/**' . "\r\n";
                    $service['code']['other'] .= "\t" . '/ ' . $string->toClassName($current_page_target) . 'Service.postRequest()' . "\r\n";
                    $service['code']['other'] .= "\t" . '**/' . "\r\n";
                    $service['code']['other'] .= "\t" . 'postRequest(fields:any){' . "\r\n";
                    $service['code']['other'] .= "\t\t" . '//console.log(fields);' . "\r\n";
                    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
                    $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.apiURL,this.inputFields(fields), {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'responseType:"text"' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . '}).subscribe( domHtml => {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'let text = this.stripTags(domHtml,[]);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '//console.log("text",text) ;' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'if (/' . $addons['regex-pattern'] . '/.test(text)) {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Successfully!","","' . $addons['success-message'] . '");' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}else{' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Fail!","","' . $addons['error-message'] . '");' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . '});' . "\r\n";
                    $service['code']['other'] .= "\t" . '}' . "\r\n";
                    $service['code']['other'] .= "\t" . '' . "\r\n";
                    $service['code']['other'] .= "\t" . '' . "\r\n";
                    break;
                case 'get':
                    $service['code']['other'] .= "\t" . '/**' . "\r\n";
                    $service['code']['other'] .= "\t" . '/ ' . $string->toClassName($current_page_target) . 'Service.getRequest()' . "\r\n";
                    $service['code']['other'] .= "\t" . '**/' . "\r\n";
                    $service['code']['other'] .= "\t" . 'getRequest(fields:any){' . "\r\n";
                    $service['code']['other'] .= "\t\t" . '//console.log(fields);' . "\r\n";

                    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
                    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.apiURL + "?" + this.inputFields(fields) + "&' . $query . '",{responseType:"text"})' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . '.subscribe( domHtml => {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'let text = this.stripTags(domHtml,[]);' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '//console.log("text",text) ;' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . 'if (/' . $addons['regex-pattern'] . '/.test(text)) {' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Successfully!","","' . $addons['success-message'] . '");' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}else{' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Fail!","","' . $addons['error-message'] . '");' . "\r\n";
                    $service['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                    $service['code']['other'] .= "\t\t\t" . '});' . "\r\n";
                    $service['code']['other'] .= "\t" . '}' . "\r\n";
                    $service['code']['other'] .= "\t" . '' . "\r\n";
                    $service['code']['other'] .= "\t" . '' . "\r\n";
                    break;
                case 'put':
                    break;
            }
            break;
    }

    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Service.presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: "Please wait...",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Service.dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Service.showToast()' . "\r\n";
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
    $service['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Service.showAlert()' . "\r\n";
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
    $service['code']['other'] .= "\t" . '' . "\r\n";


    $db->saveService($service, $current_page_target);


    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'form-builder';
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
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$z]['var'] = $string->toUserClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][$z]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';

    $z++;
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

    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '<form [formGroup]="form' . $string->toClassName($current_page_target) . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list>' . "\r\n";
    foreach ($addons['forms'] as $form)
    {

        $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<!-- ' . $form['type'] . ' -->' . "\r\n";

        $placeholder = null;
        if ($form['option'] != '')
        {
            $placeholder = 'placeholder="' . $form['option'] . '"';
        }

        switch ($form['type'])
        {
            case 'ion-item-divider':
                $newPage['content']['html'] .= "\t\t" . '<ion-item-divider>' . $form['label'] . '</ion-item-divider>' . "\r\n";
                break;
            case 'hidden':
                $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
                break;
            case 'ion-input':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-input formControlName="' . $string->toUserClassName($form['name']) . '" color="primary" type="text" clear-input ' . $placeholder . '></ion-input>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-input-email':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-input  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary" type="email" clear-input ' . $placeholder . '></ion-input>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-input-number':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-input  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary" type="number" clear-input ' . $placeholder . '></ion-input>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-input-tel':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-input  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary" type="tel" clear-input ' . $placeholder . '></ion-input>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-input-url':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-input formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary" type="url" clear-input ' . $placeholder . '></ion-input>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-input-file':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-input (change)="handleFileInput' . $string->toClassName($form['name']) . '($event)" color="primary" type="file" ' . $placeholder . '></ion-input>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-textarea':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-textarea  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary" clear-input></ion-textarea>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-select':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-select  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary">' . "\r\n";
                $opts = explode('|', $form['option']);
                foreach ($opts as $opt)
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-select-option value="' . $opt . '">' . $opt . '</ion-select-option>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t\t" . '</ion-select>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

                break;
            case 'ion-datetime-date':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-datetime  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary"></ion-datetime>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-datetime-time':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-datetime  formControlName="' . $string->toUserClassName($form['name']) . '"  color="primary" display-format="h:mm A" picker-format="h:mm A"></ion-datetime>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-radio':
                $newPage['content']['html'] .= "\t\t" . '<ion-radio-group formControlName="' . $string->toUserClassName($form['name']) . '">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-list-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-list-header>' . "\r\n";
                $opts = explode('|', $form['option']);
                foreach ($opts as $opt)
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $opt . '</ion-label>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-radio slot="start" value="' . $opt . '"></ion-radio>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t" . '</ion-radio-group>' . "\r\n";
                break;
            case 'ion-range':
                $range = '';
                if ($form['option'] !== '')
                {
                    $opts = explode('|', $form['option']);
                    if (isset($opts[1]))
                    {
                        $range = 'min="' . (int)$opts[0] . '" max="' . (int)$opts[1] . '" ';
                    }
                }
                $newPage['content']['html'] .= "\t\t" . '<ion-list-header>' . $form['label'] . '</ion-list-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<!--' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-icon slot="start" size="small" color="danger" name="thermometer"></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-icon slot="end" color="danger" name="thermometer"></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '-->' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-range formControlName="' . $string->toUserClassName($form['name']) . '" ' . $range . ' ></ion-range>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-toggle':
                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $form['label'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-toggle formControlName="' . $string->toUserClassName($form['name']) . '" color="primary"></ion-toggle>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                break;
            case 'ion-button':
                $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-button (click)="onSubmit()" color="primary" expand="block">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '' . $form['label'] . '' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
                break;
        }


    }


    //$newPage['content']['html'] .= "\t\t\t" . '<pre>{{ form' . $string->toClassName($current_page_target) . '.value | json }}</pre>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</form>' . "\r\n";

    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    // TODO: POST --|-- PAGE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;

    $init_field = null;
    foreach ($addons['forms'] as $form)
    {
        $var_iput = $string->toUserClassName($form['name']);
        switch ($form['type'])
        {
            case 'ion-item-divider':
                break;
            case 'hidden':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '"],' . "\r\n";
                break;

            case 'ion-input':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-input-email':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-input-number':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : [' . (int)($form['default']) . ', Validators.required],' . "\r\n";
                break;
            case 'ion-input-tel':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-input-url':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-input-file':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-textarea':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-select':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-datetime-date':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-datetime-time':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-radio':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : ["' . htmlentities($form['default']) . '", Validators.required],' . "\r\n";
                break;
            case 'ion-range':
                $init_field .= "\t\t\t" . '' . $var_iput . ' : [' . (int)($form['default']) . ', Validators.required],' . "\r\n";
                break;
            case 'ion-toggle':
                if ($form['default'] == 'true')
                {
                    $init_field .= "\t\t\t" . '' . $var_iput . ' : [true, Validators.required],' . "\r\n";
                } else
                {
                    $init_field .= "\t\t\t" . '' . $var_iput . ' : [false, Validators.required],' . "\r\n";
                }

                break;
        }
    }


    $newPage['code']['other'] = null;


    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'form' . $string->toClassName($current_page_target) . ': FormGroup;' . "\r\n";

    switch ($addons['response-type'])
    {
        case 'json':
            $newPage['code']['other'] .= "\t" . 'response' . $string->toClassName($addons['page-target']) . ': Observable<any>;' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'responseData' . $string->toClassName($addons['page-target']) . ': any = [];' . "\r\n";
            break;
        case 'text':
            break;
    }

    foreach ($addons['forms'] as $form)
    {
        $var_iput = $string->toUserClassName($form['name']);
        switch ($form['type'])
        {
            case 'ion-input-file':
                $newPage['code']['other'] .= "\t" . '' . "\r\n";
                $newPage['code']['other'] .= "\t" . '' . "\r\n";

                $newPage['code']['other'] .= "\t" . 'handleFileInput' . $string->toClassName($form['name']) . '(event) {' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . 'const reader = new FileReader();' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . 'if(event.target.files && event.target.files.length) {' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'const [file] = event.target.files;' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'reader.readAsDataURL(file);' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . 'reader.onload =()=>{' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . 'let filesize:number = reader.result.toString().length ; ' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . 'if(filesize< 512000){' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.form' . $string->toClassName($current_page_target) . '.patchValue({' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . $var_iput . ': reader.result.toString()' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . '});' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '}else{' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Error",null,"The file size is too large (" + filesize.toString() + " bytes) , the allowable file size is less than 512000 bytes");' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newPage['code']['other'] .= "\t\t\t" . '};' . "\r\n";
                $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";


                $newPage['code']['other'] .= "\t" . '}' . "\r\n";
                break;
        }
    }

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.resetFieldValues()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public resetFieldValues(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.form' . $string->toClassName($current_page_target) . ' = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= substr($init_field, 0, (strlen($init_field) - 3)) . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.onSubmit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public onSubmit(){' . "\r\n";
    switch ($addons['response-type'])
    {
        case 'json':
            switch (strtolower($addons['method']))
            {
                case 'post':
                    $newPage['code']['other'] .= "\t\t" . 'this.response' . $string->toClassName($addons['page-target']) . ' = this.' . $string->toUserClassName($current_page_target) . 'Service.postRequest(this.form' . $string->toClassName($current_page_target) . '.value);' . "\r\n";
                    $newPage['code']['other'] .= "\t\t" . 'this.response' . $string->toClassName($addons['page-target']) . '.subscribe(data =>{' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.responseData' . $string->toClassName($addons['page-target']) . ' = data ;' . "\r\n";
                    if ($addons['title-variable'] == '')
                    {
                        $newPage['code']['other'] .= "\t\t\t" . 'let title = "Information" ;' . "\r\n";
                    } else
                    {
                        $newPage['code']['other'] .= "\t\t\t" . 'let title = data.' . $addons['title-variable'] . ' ;' . "\r\n";
                    }
                    $newPage['code']['other'] .= "\t\t\t" . 'let message = data.' . $addons['message-variable'] . ' ;' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.showAlert(title,"",message);' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.resetFieldValues();' . "\r\n";
                    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
                    break;
                case 'get':
                    $newPage['code']['other'] .= "\t\t" . 'this.response' . $string->toClassName($addons['page-target']) . ' = this.' . $string->toUserClassName($current_page_target) . 'Service.getRequest(this.form' . $string->toClassName($current_page_target) . '.value);' . "\r\n";
                    $newPage['code']['other'] .= "\t\t" . 'this.response' . $string->toClassName($addons['page-target']) . '.subscribe(data =>{' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.responseData' . $string->toClassName($addons['page-target']) . ' = data ;' . "\r\n";
                    if ($addons['title-variable'] == '')
                    {
                        $newPage['code']['other'] .= "\t\t\t" . 'let title = "Information" ;' . "\r\n";
                    } else
                    {
                        $newPage['code']['other'] .= "\t\t\t" . 'let title = data.' . $addons['title-variable'] . ' ;' . "\r\n";
                    }
                    $newPage['code']['other'] .= "\t\t\t" . 'let message = data.' . $addons['message-variable'] . ' ;' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.showAlert(title,"",message);' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.resetFieldValues();' . "\r\n";
                    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
                    break;
                case 'put':
                    $newPage['code']['other'] .= "\t\t" . 'this.response' . $string->toClassName($addons['page-target']) . ' = this.' . $string->toUserClassName($current_page_target) . 'Service.putRequest(this.form' . $string->toClassName($current_page_target) . '.value);' . "\r\n";
                    $newPage['code']['other'] .= "\t\t" . 'this.response' . $string->toClassName($addons['page-target']) . '.subscribe(data =>{' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.responseData' . $string->toClassName($addons['page-target']) . ' = data ;' . "\r\n";
                    if ($addons['title-variable'] == '')
                    {
                        $newPage['code']['other'] .= "\t\t\t" . 'let title = "Information" ;' . "\r\n";
                    } else
                    {
                        $newPage['code']['other'] .= "\t\t\t" . 'let title = data.' . $addons['title-variable'] . ' ;' . "\r\n";
                    }
                    $newPage['code']['other'] .= "\t\t\t" . 'let message = data.' . $addons['message-variable'] . ' ;' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.showAlert(title,"",message);' . "\r\n";
                    $newPage['code']['other'] .= "\t\t\t" . 'this.resetFieldValues();' . "\r\n";
                    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
                    break;
            }
            break;
        case 'text':
            switch (strtolower($addons['method']))
            {
                case 'post':
                    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . 'Service.postRequest(this.form' . $string->toClassName($current_page_target) . '.value);' . "\r\n";
                    break;
                case 'get':
                    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . 'Service.getRequest(this.form' . $string->toClassName($current_page_target) . '.value);' . "\r\n";
                    break;
                case 'put':
                    $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toUserClassName($current_page_target) . 'Service.putRequest(this.form' . $string->toClassName($current_page_target) . '.value);' . "\r\n";
                    break;
            }
            break;
    }


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
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";


    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.resetFieldValues();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=form-builder&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('form-builder', $current_page_target);
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

if (!isset($current_setting['method']))
{
    $current_setting['method'] = '';
}

if (!isset($current_setting['action']))
{
    $current_setting['action'] = '';
}

if (!isset($current_setting['forms']))
{
    $current_setting['forms'] = array();
}


if (!isset($current_setting['response-type']))
{
    $current_setting['response-type'] = 'json';
}

if (!isset($current_setting['message-variable']))
{
    $current_setting['message-variable'] = 'message';
}

if (!isset($current_setting['title-variable']))
{
    $current_setting['title-variable'] = '';
}


if (!isset($current_setting['regex-pattern']))
{
    $current_setting['regex-pattern'] = 'successful';
}

if (!isset($current_setting['success-message']))
{
    $current_setting['success-message'] = '';
}

if (!isset($current_setting['error-message']))
{
    $current_setting['error-message'] = '';
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
if( parse_url($current_setting['action'],PHP_URL_SCHEME) == 'http' ){
    $content .= '<div class="callout callout-danger"><h4>Warning!</h4><p>' . __e('URL Action do not use ssl, This might not work normally in APK/IPA (Android/IOS Devices)') . '</p></div>' . "\r\n";
}
$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="form-builder[page-target]" class="form-control" >';
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
$content .= '<input  id="page-title" type="text" name="form-builder[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="form-builder[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="form-builder[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png" value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- METHOD
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-method">' . __e('Form Method') . '</label>';
$content .= '<select id="page-method" name="form-builder[method]" class="form-control" ' . $disabled . ' >';
foreach ($method_types as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['method'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select the method used?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- RESPONSE-TYPE
$content .= '<div class="col-md-3"><!-- col-md-3 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-response-type">' . __e('Response Type') . '</label>';
$content .= '<select id="page-response-type" name="form-builder[response-type]" class="form-control" ' . $disabled . ' >';
foreach ($response_types as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['response-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please select the request response type?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-3 -->';

// TODO: LAYOUT --|-- FORM --|-- ACTION
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-action">' . __e('URL Action') . '</label>';
$content .= '<input id="page-action" type="url" name="form-builder[action]" class="form-control" placeholder=""  value="' . $current_setting['action'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Response type JSON on the <strong>Online Server</strong>, you must use <strong>SSL</strong> (<code>https://</code>) and for method POST type allow CORS post with preflight request') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';


// TODO: LAYOUT --|-- FORM --|-- TITLE-VARIABLE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-title-variable">' . __e('Title Variable') . '</label>';
$content .= '<input id="page-title-variable" type="text" name="form-builder[title-variable]" class="form-control" placeholder="data.status"  value="' . $current_setting['title-variable'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write the message variable that will appear on?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- MESSAGE-VARIABLE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-message-variable">' . __e('Message Variable') . '</label>';
$content .= '<input id="page-message-variable" type="text" name="form-builder[message-variable]" class="form-control" placeholder="message"  value="' . $current_setting['message-variable'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write the message variable that will appear on?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';

$content .= '<div class="col-md-6"><!-- col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- REGEX-PATTERN

$content .= '<div class="form-group">';
$content .= '<label for="page-regex-pattern">' . __e('RegExp Pattern') . '</label>';
$content .= '<input id="page-regex-pattern" type="text" name="form-builder[regex-pattern]" class="form-control" placeholder="successful"  value="' . $current_setting['regex-pattern'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('The regexp test pattern used is only true and false') . '</p>';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- SUCCESS-MESSAGE
$content .= '<div class="form-group">';
$content .= '<label for="page-success-message">' . __e('Success Message') . '</label>';
$content .= '<input id="page-success-message" type="text" name="form-builder[success-message]" class="form-control" placeholder="Your request has been sent"  value="' . $current_setting['success-message'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('The message that appears when successfully sending a request') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- ERROR-MESSAGE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-error-message">' . __e('Error Message') . '</label>';
$content .= '<input id="page-error-message" type="text" name="form-builder[error-message]" class="form-control" placeholder="Please! complete the form provided"  value="' . $current_setting['error-message'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('The message that appears when fail sending a request') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-form-builder" type="submit" class="btn btn-primary btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Input fields') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="row"><!-- row -->';

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<table class="table table-striped no-margin no-padding" >' . "\r\n";
$content .= '<thead>' . "\r\n";
$content .= '<tr>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '<th>' . __e('Type') . '</th>' . "\r\n";
$content .= '<th>' . __e('Name') . '</th>' . "\r\n";
$content .= '<th>' . __e('Label') . '</th>' . "\r\n";
$content .= '<th>' . __e('Options/Placeholder') . '</th>' . "\r\n";
$content .= '<th>' . __e('Default Value') . '</th>' . "\r\n";
$content .= '<th></th>' . "\r\n";
$content .= '</tr>' . "\r\n";
$content .= '</thead>' . "\r\n";
$content .= '<tbody id="var-lists">' . "\r\n";
$max_vars = count($current_setting['forms']) + 1;
for ($z = 0; $z < $max_vars; $z++)
{
    if (!isset($current_setting['forms'][$z]['type']))
    {
        $current_setting['forms'][$z]['type'] = 'ion-input';
    }
    if (!isset($current_setting['forms'][$z]['name']))
    {
        $current_setting['forms'][$z]['name'] = '';
    }
    if (!isset($current_setting['forms'][$z]['label']))
    {
        $current_setting['forms'][$z]['label'] = '';
    }
    if (!isset($current_setting['forms'][$z]['option']))
    {
        $current_setting['forms'][$z]['option'] = '';
    }
    if (!isset($current_setting['forms'][$z]['default']))
    {
        $current_setting['forms'][$z]['default'] = '';
    }


    $html_input_name = $html_input_label = $html_input_type = $html_input_option = $html_input_default = null;
    $icon_move = '<i class="glyphicon glyphicon-move"></i>';


    $html_input_type .= '<select class="form-control forms-type" data-target="' . $z . '" name="form-builder[forms][' . $z . '][type]" >';
    foreach ($input_types as $input_type)
    {
        $selected = '';
        if ($current_setting['forms'][$z]['type'] == $input_type['value'])
        {
            $selected = 'selected';
        }
        $html_input_type .= '<option value="' . $input_type['value'] . '" ' . $selected . '>' . $input_type['label'] . '</option>';
    }
    $html_input_type .= '</select>';


    $html_input_name .= '<input class="form-control" id="forms-type-' . $z . '" name="form-builder[forms][' . $z . '][name]" placeholder="my-input-' . $z . '" value="' . htmlentities($current_setting['forms'][$z]['name']) . '" />';
    $html_input_label .= '<input class="form-control" id="forms-label-' . $z . '" name="form-builder[forms][' . $z . '][label]" placeholder="My Input ' . $z . '" value="' . htmlentities($current_setting['forms'][$z]['label']) . '" />';
    $html_input_option .= '<input class="form-control" id="forms-option-' . $z . '" name="form-builder[forms][' . $z . '][option]" placeholder="" value="' . htmlentities($current_setting['forms'][$z]['option']) . '" />';
    $html_input_default .= '<input class="form-control" id="forms-default-' . $z . '" name="form-builder[forms][' . $z . '][default]" placeholder="" value="' . htmlentities($current_setting['forms'][$z]['default']) . '" />';

    // TODO: LAYOUT --|-- FORM --|-- INPUT
    $content .= '<tr class="var-item" id="item-var-' . $z . '">' . "\r\n";
    $content .= '<td class="text-align v-align move-cursor handle">' . $icon_move . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_input_type . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_input_name . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_input_label . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_input_option . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . $html_input_default . '</td>' . "\r\n";
    $content .= '<td class="text-align v-align">' . "\r\n";
    $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#item-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
    $content .= '</td>' . "\r\n";
    $content .= '</tr>' . "\r\n";

}
$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";

$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-form-builder" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
        $content .= '<a href="./?p=addons&amp;addons=form-builder&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=form-builder&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=form-builder&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=form-builder&page-target="+$("#page-target").val(),!1});';
$page_js .= '$("#var-lists").sortable({opacity: 0.5, items: ".var-item",revert: true,placeholder: "sort-highlight",forcePlaceholderSize: false,zIndex: 999999,cancel: ".move-disabled",handle: ".handle",});';
$page_js .= '
$(".forms-type").click(function(){
    
    var valType = $(this).val();
    var OptID = $(this).attr("data-target");

    $("#forms-option-" + OptID).val("");
    $("#forms-default-" + OptID).val("");
       
    switch(valType){
        case "ion-input-number":
            $("#forms-option-" + OptID).val("");
            $("#forms-default-" + OptID).val("12345");
            break;
            
        case "ion-select":
            $("#forms-option-" + OptID).val("Option 1|Option 2");
            $("#forms-default-" + OptID).val("Option 1");
            break;
        
        case "ion-radio":
            $("#forms-option-" + OptID).val("Radio 1|Radio 2");
            $("#forms-default-" + OptID).val("Radio 1");
            break;

        case "ion-range":
            $("#forms-option-" + OptID).val("0|200");
            $("#forms-default-" + OptID).val("50");
            break;
            
        case "ion-toggle":
            $("#forms-option-" + OptID).val("");
            $("#forms-default-" + OptID).val("true");
            break;
            
        case "ion-datetime-date":
            $("#forms-option-" + OptID).val("");
            $("#forms-default-" + OptID).val("' . date("Y-m-d") . '");
            break;            
            
        case "ion-datetime-time":
            $("#forms-option-" + OptID).val("");
            $("#forms-default-" + OptID).val("' . date("H:i:s") . '");
            break;
                        
     }
    
});
';
