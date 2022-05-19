<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `app-update`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("app-update");
$string = new jsmString();


if (isset($_POST['delete-app-update']))
{
    $db->deleteAddOns('app-update', 'core');
    $db->deleteGlobal('app-update', 'core');
    $db->current();
    header('Location: ./?p=addons&addons=app-update&' . time());
}

// TODO: POST
if (isset($_POST['save-app-update']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    $addons['page-title'] = 'core';
    $addons['page-header-color'] = trim($_POST['app-update']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['app-update']['page-content-background']);
    $addons['apk-url'] = trim($_POST['app-update']['apk-url']);
    $addons['update-url'] = trim($_POST['app-update']['update-url']);
    $db->saveAddOns('app-update', $addons);

    $cordova_config = null;
    $cordova_config .= "\t" . '<platform name="android">' . "\r\n";
    $cordova_config .= "\t\t" . '<config-file parent="/manifest/application" target="AndroidManifest.xml">' . "\r\n";
    $cordova_config .= "\t\t\t" . '<provider android:authorities="${applicationId}.appupdate.provider" android:exported="false" android:grantUriPermissions="true" android:name="com.vaenow.appupdate.android.GenericFileProvider">' . "\r\n";
    $cordova_config .= "\t\t\t\t" . '<meta-data android:name="android.support.FILE_PROVIDER_PATHS" android:resource="@xml/appupdate_paths" />' . "\r\n";
    $cordova_config .= "\t\t\t" . '</provider>' . "\r\n";
    $cordova_config .= "\t\t" . '</config-file>' . "\r\n";
    $cordova_config .= "\t" . '</platform>' . "\r\n";

    $global['name'] = 'core';
    $global['note'] = 'App Update';
    $z = 0;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'AppUpdate';
    $global['modules'][$z]['var'] = 'appUpdate';
    $global['modules'][$z]['path'] = '@ionic-native/app-update/ngx';
    $global['modules'][$z]['native'] = '@ionic-native/app-update';
    $global['modules'][$z]['cordova'] = 'cordova-plugin-app-update';
    $global['modules'][$z]['cordova-config'] = $cordova_config;


    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['export'] .= "" . '/**' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '* App Update Setting' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '**/' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . 'const appUpdateUrl = "' . $addons['update-url'] . '"; ' . "\r\n";
    $global['component'][0]['code']['init'] = "\t\t" . 'this.handlerAppUpdate();';

    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerAppUpdate()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'public handlerAppUpdate(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'if(this.platform.is("android")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.appUpdate.checkAppUpdate(appUpdateUrl).then(()=>{console.log("Update available")});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";


    $db->saveGlobal('app-update', $global);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=app-update&' . time());

}

// TODO: INIT
$disabled = null;
$current_setting = $db->getAddOns('app-update', 'core');


if (!isset($current_setting['apk-url']))
{
    $current_setting['apk-url'] = 'https://yoursite/update.apk';
}

if (!isset($current_setting['update-url']))
{
    $current_setting['update-url'] = 'https://yoursite/update.xml';
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

$content .= '<div class="callout callout-danger">' . __e('These addons require the <strong>Cordova Plugin</strong> and <strong>Ionic Native</strong>, to be able to run the emulator you have to <a href="./?p=2.update-plugin">update it</a>') . '</div>';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- APK-URL
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-apk-url">' . __e('APK Url') . '</label>';
$content .= '<input id="page-apk-url" type="url" name="app-update[apk-url]" class="form-control" placeholder="https://ihsana.com/app/update.apk"  value="' . $current_setting['apk-url'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('What is the apk link for automatic updates?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- UPDATE-URL
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-update-url">' . __e('Update XML') . '</label>';
$content .= '<input id="page-update-url" type="url" name="app-update[update-url]" class="form-control" placeholder="https://ihsana.com/app/config.xml"  value="' . $current_setting['update-url'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('What is the <code>update.xml</code> link for automatic update settings?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-app-update" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;or&nbsp;<input name="delete-app-update" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Technical Documents') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('The following is how to use these addons:') . '</p>';
$content .= '<ol>';
$content .= '<li>' . __e('Go to Apps -&raquo; Edit -&raquo; Version, change the version of your app, version value must be higher than before') . '</li>';
$content .= '<li>' . __e('Complete the form on the left') . '</li>';
$content .= '<li>';
$content .= '<p>' . __e('Create <code>update.xml</code> file and upload it to your server  with the following data in it') . '</p>';
$content .= '<pre>';
$content .= htmlentities('<update>') . "\r\n";
$content .= "\t" . htmlentities('<version>' . (int)str_replace(".", "", ($current_app['apps']['app-version'])) . '</version>') . "\r\n";
$content .= "\t" . htmlentities('<name>' . $current_app['apps']['app-name'] . '</name>') . "\r\n";
$content .= "\t" . htmlentities('<url>' . $current_setting['apk-url'] . '</url>') . "\r\n";
$content .= htmlentities('</update>') . "\r\n";
$content .= '</pre>';
$content .= '<p>' . __e('The plugin will compare the app version and update it automatically if the API has a newer version to install') . '</p>';
$content .= '</li>';
$content .= '<li>';
$content .= '<p> ' . __e('Command that must be run on Ionic CLI') . '</p>';
$content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-app-update@latest --save </pre>';
$content .= '<pre class="shell">npm install @ionic-native/app-update@latest --save</pre>';
$content .= '</li>';

$content .= '</ol>';

$content .= '<p>' . __e('The files affected by these addons are:') . '</p>';
$content .= '<ul>';
$content .= '<li>./config.xml</li>';
$content .= '<li>./src/app/app.component.ts</li>';
$content .= '<li>./src/app/app.module.ts</li>';
$content .= '<ul>';


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=app-update&page-target="+$("#page-target").val(),!1});';
