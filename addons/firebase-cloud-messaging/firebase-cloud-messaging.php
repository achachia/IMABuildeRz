<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `firebase-cloud-messaging`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("firebase-cloud-messaging");
$string = new jsmString();

$app_dir = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/';
$google_services_dir = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/platforms/android/app/';
$google_services_project = JSM_PATH . '/projects/' . $current_app['apps']['app-prefix'] . '/';

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('firebase-cloud-messaging', 'core');
    $db->deleteGlobal('firebase-cloud-messaging', 'core');
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=firebase-cloud-messaging&' . time());
}

// TODO: POST
if (isset($_POST['save-firebase-cloud-messaging']))
{


    if (!is_dir($google_services_dir))
    {
        mkdir($google_services_dir, 0777, true);
    }
    if (isset($_FILES['google-services']))
    {
        $tmp_name = $_FILES['google-services']['tmp_name'];
        move_uploaded_file($tmp_name, $app_dir . '/google-services.json');
        copy($app_dir . '/google-services.json', $google_services_dir . '/google-services.json');
        copy($app_dir . '/google-services.json', $google_services_project . '/google-services.json');
    }


    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    $db->saveAddOns('firebase-cloud-messaging', $addons);

    // TODO: GENERATOR --|-- GLOBALS

    $global['name'] = 'core';
    $global['note'] = 'Firebase Messaging';
    // TODO: GENERATOR --|-- GLOBALS  --|-- MODULES

    $z = 0;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'FirebaseMessaging';
    $global['modules'][$z]['var'] = 'firebaseMessaging';
    $global['modules'][$z]['path'] = '@ionic-native/firebase-messaging/ngx';
    $global['modules'][$z]['native'] = '@ionic-native/firebase-messaging/';
    $global['modules'][$z]['cordova'] = 'cordova-plugin-firebase-messaging';

    //$z++;
    //$global['modules'][$z]['enable'] = true;
    //$global['modules'][$z]['cordova'] = 'cordova-plugin-firebase-analytics';

    //$z++;
    //$global['modules'][$z]['enable'] = true;
    //$global['modules'][$z]['cordova'] = 'cordova-support-android-plugin';

    //$z++;
    //$global['modules'][$z]['enable'] = true;
    //$global['modules'][$z]['cordova'] = 'cordova-support-google-services';


    // TODO: GENERATOR --|-- GLOBALS  --|-- CODE
    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['init'] = "\t\t" . 'this.handlerNotifications();';
    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerNotifications()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'public handlerNotifications(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";

    $db->saveGlobal('firebase-cloud-messaging', $global);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=firebase-cloud-messaging&' . time());

}

// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
$current_setting = $db->getAddOns('firebase-cloud-messaging', 'core');
if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}

// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';

$content .= '<form action="" method="post" enctype="multipart/form-data">';
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
// TODO: LAYOUT --|-- FORM
$content .= '<dl class="dl-horizontal">';
$content .= '<dt>App Name</dt><dd><strong>' . $current_app['apps']['app-name'] . '</strong></dd>';
$content .= '<dt>Package Name</dt><dd><code>' . $current_app['apps']['app-id'] . '</code></dd>';
$content .= '</dl>';
$content .= '<hr/>';

if (!file_exists($google_services_dir . '/google-services.json'))
{
    $content .= '<p class="alert alert-danger">' . ('please upload file: `<strong>google-services.json</strong>`') . '</p>';
}

$content .= '<div class="form-group">';
$content .= '<label>' . ('Upload file `<strong>google-services.json</strong>`') . '</label>';
$content .= '<input name="google-services" type="file" class="form-control">';
$content .= '<p class="help-block">' . ('You can download `<code>google-services.json</code>` file from <a href="https://console.firebase.google.com/">Firebase console</a>') . '</p>';
$content .= '</div>';

$content .= '<div class="help-dev">*** ' . __e('Only work on real device') . '</div>';
$content .= '';
$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-firebase-cloud-messaging" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '"/>';
if ($current_setting['page-target'] == 'core')
{
    $content .= '&nbsp;or&nbsp;<a class="btn btn-link btn-flat" href="./?p=addons&addons=firebase-cloud-messaging&a=delete">' . __e('Delete this Settings') . '</a>';
}
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
$content .= '<h4>' . ('NodeJS') . '</h4>';

$content .= '<pre class="shell">' . ('npm install --save @ionic-native/firebase-messaging@latest') . '</pre>';
$content .= '<pre class="shell">' . ('ionic cordova plugin add cordova-plugin-firebase-messaging@latest --save ') . '</pre>';
$content .= '<p>' . ('If the androidx library error, try installing the following plugins:') . '</p>';
$content .= '<pre class="shell">' . ('ionic cordova plugin add cordova-plugin-androidx@latest --save ') . '</pre>';
$content .= '<pre class="shell">' . ('ionic cordova plugin add cordova-plugin-androidx-adapter@latest --save ') . '</pre>';


$content .= '<h4>' . ('Reference:') . '</h4>';
$content .= '<ul>';
$content .= '<li><a href="https://ionicframework.com/docs/native/firebase-messaging" target="_blank">https://ionicframework.com/docs/native/firebase-messaging</a></li>';
$content .= '<li><a href="https://github.com/chemerisuk/cordova-plugin-firebase-messaging" target="_blank">https://github.com/chemerisuk/cordova-plugin-firebase-messaging</a></li>';
$content .= '</ul>';

$content .= '<h4>' . ('Issue:') . '</h4>';
$content .= '<p>' . ('<em>Cordova Firebase Cloud Messaging Plugin</em> usually does not match <strong>Cordova AdmobFree Plugin</strong>, due to Google Play Services differences. So you want to use <em>AdmobFree Addons</em>, you should use <em>OneSignal Addons</em>.') . '</p>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
