<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package WordPress User
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("wordpress-user");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = trim(basename($_GET['page-target']));

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('wordpress-user', $current_page_target);
    header('Location: ./?p=addons&addons=wordpress-user&' . time());
}

// TODO: POST
if (isset($_POST['save-wordpress-user']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['wordpress-user']['page-title']);
    $addons['wp-url'] = trim($_POST['wordpress-user']['wp-url']);

    $addons['page-header-color'] = trim($_POST['wordpress-user']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['wordpress-user']['page-content-background']);

    $wp_url = $addons['wp-url'];
    $db->saveAddOns('wordpress-user', $addons);


    $service['name'] = $addons['page-target'];
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get wordpress user data';

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
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";

    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* getUsers()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getUsers(): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/users`)' . "\r\n";
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
    $db->saveService($service, $current_page_target);

    // create properties for page
    // TODO: USER
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $addons['page-target'];
    $newPage['code-by'] = 'wordpress-user';
    $newPage['icon-left'] = 'person';
    $newPage['icon-right'] = 'paper';
    
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


    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';

    $getClassName = $string->toClassName($current_page_target);
    $varName = strtolower($getClassName[0]) . substr($getClassName, 1, strlen($getClassName)) . 'Service';

    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = $string->toClassName($current_page_target) . 'Service';
    $newPage['modules']['angular'][1]['var'] = $varName;
    $newPage['modules']['angular'][1]['path'] = './../../services/' . $current_page_target . '/' . $current_page_target . '.service';

    // TODO: USER --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;

    $newPage['content']['html'] .= "\t" . '<ion-refresher slot="fixed" (ionRefresh)="doRefresh($event)">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'pullingIcon="arrow-dropdown"' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'pullingText="Pull to refresh"' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'refreshingSpinner="circles"' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'refreshingText="Refreshing..."' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let user of ( users | async )">' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="user[\'avatar_urls\'] && user[\'avatar_urls\'][96]" src="{{ user[\'avatar_urls\'][96] }}" />' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-avatar>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h2 [innerHTML]="user.name"></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<p [innerHTML]="user.slug"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<p [innerHTML]="user.description"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-row no-padding *ngIf="user.url">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col text-right>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button ion-button clear small color="danger" icon-start appBrowser [url]="user.url"  >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-icon name="share-alt"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . 'Website' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    // TODO: USER --|-- CONTENT --|-- NOT-RESULT
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataUsers.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . 'There are no users' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";


    // TODO: USER --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-refresher{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'position: static;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'p{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-top: 0;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin-bottom: 12px;' . "\r\n";
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


    // TODO: USER --|-- CODE --|-- OTHER --
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . 'users: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataUsers: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: USER --|-- CODE --|-- OTHER -- users()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* showUsers()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'showUsers(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.users = this.' . $varName . '.getUsers();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.users.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataUsers = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: USER --|-- CODE --|-- OTHER -- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 100);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showUsers();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: USER --|-- CODE --|-- OTHER -- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showUsers();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=wordpress-user&page-target=' . $current_page_target);

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('wordpress-user', $current_page_target);
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
if(!isset($current_setting['page-header-color'])){
	$current_setting['page-header-color'] = 'primary';
}

if(!isset($current_setting['page-content-background'])){
	$current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
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
$content .= '<select id="page-target" name="wordpress-user[page-target]" class="form-control">';
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


$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-TITLE
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input id="page-title" type="text" name="wordpress-user[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- WP-URL
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('WordPress URL') . '</label>';
$content .= '<input id="page-title" type="text" name="wordpress-user[wp-url]" class="form-control" placeholder="http://"  value="' . $current_setting['wp-url'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Your wordpress site address') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div><!-- ./row -->';



$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="wordpress-user[page-header-color]" class="form-control select-color" data-color="'.$current_setting['page-header-color'].'">';
foreach($color_names as  $color_name){
	$selected = '';
	if($color_name['value'] == $current_setting['page-header-color'] ){
		$selected = 'selected' ;
	}
	$content .= '<option value="' . $color_name['value'] . '" '.$selected.'>' . $color_name['label'] . '</option>';
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
$content .= '<input id="page-content-background" type="text" name="wordpress-user[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress-user" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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
$content .= '<table class="table table-striped" id="latest-used" >';
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
        $content .= '<a href="./?p=addons&addons=wordpress-user&page-target=' . $pageList['page-target'] . '&a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&addons=wordpress-user&page-target=' . $pageList['page-target'] . '&a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&addons=wordpress-user&page-target=' . $pageList['page-target'] . '&a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=wordpress-user&page-target="+$("#page-target").val(),!1});';
