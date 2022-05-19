<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `demo`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("one-signal", "core");
$string = new jsmString();

if (isset($_POST['delete-onesignal']))
{
    $db->deleteAddOns('one-signal', 'core');
    $db->deleteGlobal('one-signal', 'core');

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=one-signal&' . time());

}

// TODO: POST
if (isset($_POST['save-onesignal']))
{

    // save addons setting
    $addons = array();
    $addons['sender-id'] = trim($_POST['one-signal']['sender-id']);
    $addons['app-id'] = trim($_POST['one-signal']['app-id']);
    $addons['app-key'] = trim($_POST['one-signal']['app-key']);
    $addons['page-target'] = 'core';
    $db->saveAddOns('one-signal', $addons);

    $global['name'] = 'core';
    $global['note'] = 'This code is used for One Signal';

    $global['modules'][0]['cordova'] = 'onesignal-cordova-plugin';
    $global['modules'][0]['native'] = '@ionic-native/onesignal';
    $global['modules'][0]['class'] = 'OneSignal';
    $global['modules'][0]['var'] = 'oneSignal';
    $global['modules'][0]['path'] = '@ionic-native/onesignal/ngx';
    $global['modules'][0]['enable'] = true;


    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['export'] .= "" . '/**' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '* OneSignal Setting' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '**/' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . 'const oneSignalAppId = "' . $addons['app-id'] . '"; ' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . 'const firebaseSenderID = "' . $addons['sender-id'] . '"; ' . "\r\n";

    $global['component'][0]['code']['init'] = "\t\t" . 'this.handlerNotifications();';
    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerNotifications()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'public handlerNotifications(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'if (this.platform.is("android")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.oneSignal.startInit(oneSignalAppId,firebaseSenderID);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}else{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.oneSignal.startInit(oneSignalAppId);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.oneSignal.endInit();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";

    $db->saveGlobal('one-signal', $global);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=one-signal&' . time());

}


$current_setting = $db->getAddOns('one-signal', 'core');


if (!isset($current_setting['sender-id']))
{
    $current_setting['sender-id'] = '';
}

if (!isset($current_setting['app-id']))
{
    $current_setting['app-id'] = '';
}
if (!isset($current_setting['app-key']))
{
    $current_setting['app-key'] = '';
}


if (isset($_POST['sender-btn']))
{
    $_content = array("en" => $_POST['one-signal']['sender-message']);
    $fields = array(
        "app_id" => $current_setting['app-id'],
        "included_segments" => array("All"),
        "data" => array("page" => ''),
        "contents" => $_content);

    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Authorization: Basic " . $current_setting['app-key']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    if (isset($response["errors"][0]))
    {
        $content .= "<div class=\"alert alert-dismissible alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $response["errors"][0] . "</div>";
    } else
    {
        $content .= "<div class=\"alert alert-dismissible alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>ID #" . $response["id"] . " with " . $response["recipients"] . " recipients</div>";
    }
}

// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';

$content .= '<form action="" method="post"><!-- form -->';

$content .= '<div class="box box-success">';
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

// TODO: LAYOUT --|-- FORM
$content .= '<dl class="dl-horizontal">';
$content .= '<dt>App Name</dt><dd><strong>' . $current_app['apps']['app-name'] . '</strong></dd>';
$content .= '<dt>Package Name</dt><dd><code>' . $current_app['apps']['app-id'] . '</code></dd>';
$content .= '</dl>';


// TODO: LAYOUT --|-- FORM --|-- SENDER-ID
$content .= '<div class="form-group">';
$content .= '<label for="sender-id">' . __e('Firebase Sender ID') . '</label>';
$content .= '<input id="sender-id" type="text" name="one-signal[sender-id]" class="form-control" placeholder="971549457471"  value="' . $current_setting['sender-id'] . '" />';
$content .= '<p class="help-block">' . __e('Sender ID from your Cloud Messaging, available in <a target="_blank" href="https://console.firebase.google.com/">Firebase Console</a> also known as the Google Project Number') . '</p>';
$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- APP-ID
$content .= '<div class="form-group">';
$content .= '<label for="app-id">' . __e('OneSignal App ID') . '</label>';
$content .= '<input id="app-id" type="text" name="one-signal[app-id]" class="form-control" placeholder="f313d3ab-76c6-445f-9c59-49bfb2555bcb"  value="' . $current_setting['app-id'] . '" required />';
$content .= '<p class="help-block">' . __e('Your OneSignal AppId, available in <a target="_blank" href="https://documentation.onesignal.com/docs/generate-a-google-server-api-key">OneSignal</a>') . '</p>';
$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- APP-KEY
$content .= '<div class="form-group danger">';
$content .= '<label for="app-key">' . __e('REST API Key') . '</label>';
$content .= '<input id="app-id" type="text" name="one-signal[app-key]" class="form-control" placeholder="ZThaNjNvOTctY2RjYi00ZjUxLTgxMTItNDg2NTRkNmY3MGVk"  value="' . $current_setting['app-key'] . '" />';
$content .= '<p class="help-block">' . __e('Your OneSignal ApiKey, required for push notification sender') . '</p>';
$content .= '</div>';


$content .= '<div class="help-dev">*** ' . __e('Only work on real device') . '</div>';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-onesignal" type="submit" class="btn btn-success btn-flat " value="' . __e('Save Changes') . '"  />';
if ($current_setting['sender-id'] !== '')
{
    $content .= '&nbsp;or&nbsp;<input name="delete-onesignal" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
}
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';


$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-plane"></i> ' . __e('OneSignal Sender') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-default">' . __e('Use this to send notifications') . '</div>';

$current_setting['sender-title'] = date('H:i:s') . ' - Message';
$current_setting['sender-message'] = 'This message was sent at ' . date('H:i:s');

// TODO: LAYOUT --|-- FORM --|-- MESSAGE BODY
$content .= '<div class="form-group">';
$content .= '<label for="sender-message">' . __e('Message') . '</label>';
$content .= '<textarea id="sender-message" type="text" name="one-signal[sender-message]" class="form-control">' . htmlentities($current_setting['sender-message']) . '</textarea>';
$content .= '<p class="help-block">' . __e('Write your message here') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./box-body -->';

$content .= '<div class="box-footer pad">';
$content .= '<input name="sender-btn" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Send Notification') . '"  />';
$content .= '</div>';


$content .= '</div><!-- ./box -->';
$content .= '</form>';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-bell"></i> ' . __e('Technical Documents') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>' . __e('Don\'t forget to add the onesignal plugin to your nodejs') . '</p>';
$content .= '<pre class="shell ready" id="shell-1582611215361">ionic cordova plugin add onesignal-cordova-plugin@latest --save </pre>';
$content .= '<pre class="shell">npm install --save @ionic-native/onesignal@latest</pre>';

$content .= '<h3>' . __e('OneSignal Sender') . '</h3>';
$content .= '<h4>' . __e('PHP Native Generator ') . '</h4>';
$content .= '<p>' . __e('Goto <code>PHP Native Generator</code>-&raquo;<code>Additional Features</code>-&raquo;<code>OneSignal Sender</code>  ') . '</p>';

$content .= '<h4>' . __e('WordPress') . '</h4>';
$content .= '<p>' . __e('Please use the following plugin as onesignal sender') . '</p>';
$content .= '<ul>';
$content .= '<li><a href="https://wordpress.org/plugins/onesignal-free-web-push-notifications/" rel="nofollow">https://wordpress.org/plugins/onesignal-free-web-push-notifications/</a></li>';
$content .= '<li><a href="https://wordpress.org/plugins/onesignal-sender/" rel="nofollow">https://wordpress.org/plugins/onesignal-sender/</a></li>';
$content .= '</ul>';

$content .= '<h3>' . __e('Icons') . '</h3>';
$content .= '<p>' . __e('To change the onesignal icon, just add the icon file to your SDK') . '</p>';
$content .= '<ul>';
$content .= '<li><code>platforms/android/app/src/main/res/drawable-mdpi/ic_stat_onesignal_default.png</code></li>';
$content .= '<li><code>platforms/android/app/src/main/res/drawable-hdpi/ic_stat_onesignal_default.png</code></li>';
$content .= '<li><code>platforms/android/app/src/main/res/drawable-xhdpi/ic_stat_onesignal_default.png</code></li>';
$content .= '<li><code>platforms/android/app/src/main/res/drawable-xxhdpi/ic_stat_onesignal_default.png</code></li>';
$content .= '<li><code>platforms/android/app/src/main/res/drawable-xxxhdpi/ic_stat_onesignal_default.png</code></li>';
$content .= '</ul>';
$content .= __e('For more information, please read: <a target="_blank" href="https://documentation.onesignal.com/docs/customize-notification-icons#section-2-create-project-paths">OneSignal Documentation</a>');


$content .= '</div><!-- ./box-body -->';


$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '';
