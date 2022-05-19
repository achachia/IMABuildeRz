<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

defined("JSM_EXEC") or die("Silence is golden");

if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
$breadcrumb = $content = $page_js = null;
$db = new jsmDatabase();
$icon = new jsmIcon();
$OS = new jsmSystem();
$os_type = $OS->getOS();

$current_app = $db->current();

$output = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/';
$dir_output = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/webconverter/';
$dir_www = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/webconverter/www/';
$url_output = 'outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/';


$app_dir = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/';
$google_services_dir = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/webconverter/';
$google_services_project = JSM_PATH . '/projects/' . $current_app['apps']['app-prefix'] . '/';

if (!file_exists($dir_www . '/html/'))
{
    @mkdir($dir_www . '/html/', 0777, true);
}


if (isset($_POST['submit']))
{

    if (isset($_FILES['google-services']))
    {
        $tmp_name = $_FILES['google-services']['tmp_name'];
        if (move_uploaded_file($tmp_name, $app_dir . '/google-services.json'))
        {
            copy($app_dir . '/google-services.json', $google_services_dir . '/google-services.json');
            copy($app_dir . '/google-services.json', $google_services_project . '/google-services.json');
        }
    }


    $data['url'] = trim($_POST['webconverter']['url']);
    $data['type'] = trim($_POST['webconverter']['type']);
    $data['push-type'] = trim($_POST['webconverter']['push-type']);

    $data['onesignal']['app-id'] = trim($_POST['webconverter']['onesignal']['app-id']);
    $data['onesignal']['firebase-sender-id'] = trim($_POST['webconverter']['onesignal']['firebase-sender-id']);

    $data['admobfree']['app-id'] = trim($_POST['webconverter']['admobfree']['app-id']);
    $data['admobfree']['banner'] = trim($_POST['webconverter']['admobfree']['banner']);
    $data['statusbar']['style'] = trim($_POST['webconverter']['statusbar']['style']);
    $data['statusbar']['backgroundcolor'] = trim($_POST['webconverter']['statusbar']['backgroundcolor']);


    $db->webConverter($data);
    rebuild();

    // TODO: GENERATE

    if (!file_exists($dir_www . '/resources/android/icon/'))
    {
        @mkdir($dir_www . '/resources/android/icon/', 0777, true);
        @mkdir($dir_www . '/resources/android/splash/', 0777, true);
    }
    if (!file_exists($dir_www . '/resources/ios/icon/'))
    {
        @mkdir($dir_www . '/resources/ios/icon/', 0777, true);
        @mkdir($dir_www . '/resources/ios/splash/', 0777, true);
    }
    if (!file_exists($dir_output . '/platforms/'))
    {
        @mkdir($dir_output . '/platforms/', 0777, true);
    }

    @copy($output . '/resources/icon.png', $dir_www . '/resources/icon.png');
    @copy($output . '/resources/splash.png', $dir_www . '/resources/splash.png');

    @copy($output . '/resources/android/icon/drawable-hdpi-icon.png', $dir_www . '/resources/android/icon/drawable-hdpi-icon.png');
    @copy($output . '/resources/android/icon/drawable-ldpi-icon.png', $dir_www . '/resources/android/icon/drawable-ldpi-icon.png');
    @copy($output . '/resources/android/icon/drawable-mdpi-icon.png', $dir_www . '/resources/android/icon/drawable-mdpi-icon.png');
    @copy($output . '/resources/android/icon/drawable-xhdpi-icon.png', $dir_www . '/resources/android/icon/drawable-xhdpi-icon.png');
    @copy($output . '/resources/android/icon/drawable-xxhdpi-icon.png', $dir_www . '/resources/android/icon/drawable-xxhdpi-icon.png');
    @copy($output . '/resources/android/icon/drawable-xxxhdpi-icon.png', $dir_www . '/resources/android/icon/drawable-xxxhdpi-icon.png');
    @copy($output . '/resources/android/splash/drawable-land-ldpi-screen.png', $dir_www . '/resources/android/splash/drawable-land-ldpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-land-mdpi-screen.png', $dir_www . '/resources/android/splash/drawable-land-mdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-land-hdpi-screen.png', $dir_www . '/resources/android/splash/drawable-land-hdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-land-xhdpi-screen.png', $dir_www . '/resources/android/splash/drawable-land-xhdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-land-xxhdpi-screen.png', $dir_www . '/resources/android/splash/drawable-land-xxhdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-land-xxxhdpi-screen.png', $dir_www . '/resources/android/splash/drawable-land-xxxhdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-port-ldpi-screen.png', $dir_www . '/resources/android/splash/drawable-port-ldpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-port-mdpi-screen.png', $dir_www . '/resources/android/splash/drawable-port-mdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-port-hdpi-screen.png', $dir_www . '/resources/android/splash/drawable-port-hdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-port-xhdpi-screen.png', $dir_www . '/resources/android/splash/drawable-port-xhdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-port-xxhdpi-screen.png', $dir_www . '/resources/android/splash/drawable-port-xxhdpi-screen.png');
    @copy($output . '/resources/android/splash/drawable-port-xxxhdpi-screen.png', $dir_www . '/resources/android/splash/drawable-port-xxxhdpi-screen.png');

    @copy($output . '/resources/ios/icon/icon.png', $dir_www . '/resources/ios/icon/icon.png');
    @copy($output . '/resources/ios/icon/icon@2x.png', $dir_www . '/resources/ios/icon/icon@2x.png');
    @copy($output . '/resources/ios/icon/icon-40.png', $dir_www . '/resources/ios/icon/icon-40.png');
    @copy($output . '/resources/ios/icon/icon-40@2x.png', $dir_www . '/resources/ios/icon/icon-40@2x.png');
    @copy($output . '/resources/ios/icon/icon-40@3x.png', $dir_www . '/resources/ios/icon/icon-40@3x.png');
    @copy($output . '/resources/ios/icon/icon-50.png', $dir_www . '/resources/ios/icon/icon-50.png');
    @copy($output . '/resources/ios/icon/icon-50@2x.png', $dir_www . '/resources/ios/icon/icon-50@2x.png');
    @copy($output . '/resources/ios/icon/icon-60.png', $dir_www . '/resources/ios/icon/icon-60.png');
    @copy($output . '/resources/ios/icon/icon-60@2x.png', $dir_www . '/resources/ios/icon/icon-60@2x.png');
    @copy($output . '/resources/ios/icon/icon-60@3x.png', $dir_www . '/resources/ios/icon/icon-60@3x.png');
    @copy($output . '/resources/ios/icon/icon-72.png', $dir_www . '/resources/ios/icon/icon-72.png');
    @copy($output . '/resources/ios/icon/icon-72@2x.png', $dir_www . '/resources/ios/icon/icon-72@2x.png');
    @copy($output . '/resources/ios/icon/icon-76.png', $dir_www . '/resources/ios/icon/icon-76.png');
    @copy($output . '/resources/ios/icon/icon-76@2x.png', $dir_www . '/resources/ios/icon/icon-76@2x.png');
    @copy($output . '/resources/ios/icon/icon-83.5@2x.png', $dir_www . '/resources/ios/icon/icon-83.5@2x.png');
    @copy($output . '/resources/ios/icon/icon-small.png', $dir_www . '/resources/ios/icon/icon-small.png');
    @copy($output . '/resources/ios/icon/icon-small@2x.png', $dir_www . '/resources/ios/icon/icon-small@2x.png');
    @copy($output . '/resources/ios/icon/icon-small@3x.png', $dir_www . '/resources/ios/icon/icon-small@3x.png');
    @copy($output . '/resources/ios/icon/icon-1024.png', $dir_www . '/resources/ios/icon/icon-1024.png');
    @copy($output . '/resources/ios/icon/icon-20.png', $dir_www . '/resources/ios/icon/icon-20.png');
    @copy($output . '/resources/ios/icon/icon-20@2x.png', $dir_www . '/resources/ios/icon/icon-20@2x.png');
    @copy($output . '/resources/ios/icon/icon-20@3x.png', $dir_www . '/resources/ios/icon/icon-20@3x.png');
    @copy($output . '/resources/ios/icon/icon-24@2x.png', $dir_www . '/resources/ios/icon/icon-24@2x.png');
    @copy($output . '/resources/ios/icon/icon-27.5@2x.png', $dir_www . '/resources/ios/icon/icon-27.5@2x.png');
    @copy($output . '/resources/ios/icon/icon-1024.png', $dir_www . '/resources/ios/icon/icon-1024.png');
    @copy($output . '/resources/ios/icon/icon-29.png', $dir_www . '/resources/ios/icon/icon-29.png');
    @copy($output . '/resources/ios/icon/icon-29@2x.png', $dir_www . '/resources/ios/icon/icon-29@2x.png');
    @copy($output . '/resources/ios/icon/icon-29@3x.png', $dir_www . '/resources/ios/icon/icon-29@3x.png');
    @copy($output . '/resources/ios/icon/icon-44@2x.png', $dir_www . '/resources/ios/icon/icon-44@2x.png');
    @copy($output . '/resources/ios/icon/icon-86@2x.png', $dir_www . '/resources/ios/icon/icon-86@2x.png');
    @copy($output . '/resources/ios/icon/icon-98@2x.png', $dir_www . '/resources/ios/icon/icon-98@2x.png');
    @copy($output . '/resources/ios/splash/Default-568h@2x~iphone.png', $dir_www . '/resources/ios/splash/Default-568h@2x~iphone.png');
    @copy($output . '/resources/ios/splash/Default-667h.png', $dir_www . '/resources/ios/splash/Default-667h.png');
    @copy($output . '/resources/ios/splash/Default-736h.png', $dir_www . '/resources/ios/splash/Default-736h.png');
    @copy($output . '/resources/ios/splash/Default-Landscape-736h.png', $dir_www . '/resources/ios/splash/Default-Landscape-736h.png');
    @copy($output . '/resources/ios/splash/Default-Landscape@2x~ipad.png', $dir_www . '/resources/ios/splash/Default-Landscape@2x~ipad.png');
    @copy($output . '/resources/ios/splash/Default-Landscape@~ipadpro.png', $dir_www . '/resources/ios/splash/Default-Landscape@~ipadpro.png');
    @copy($output . '/resources/ios/splash/Default-Landscape~ipad.png', $dir_www . '/resources/ios/splash/Default-Landscape~ipad.png');
    @copy($output . '/resources/ios/splash/Default-Portrait@2x~ipad.png', $dir_www . '/resources/ios/splash/Default-Portrait@2x~ipad.png');
    @copy($output . '/resources/ios/splash/Default-Portrait@~ipadpro.png', $dir_www . '/resources/ios/splash/Default-Portrait@~ipadpro.png');
    @copy($output . '/resources/ios/splash/Default-Portrait~ipad.png', $dir_www . '/resources/ios/splash/Default-Portrait~ipad.png');
    @copy($output . '/resources/ios/splash/Default@2x~iphone.png', $dir_www . '/resources/ios/splash/Default@2x~iphone.png');
    @copy($output . '/resources/ios/splash/Default~iphone.png', $dir_www . '/resources/ios/splash/Default~iphone.png');
    @copy($output . '/resources/ios/splash/Default@2x~universal~anyany.png', $dir_www . '/resources/ios/splash/Default@2x~universal~anyany.png');
    @copy($output . '/resources/ios/splash/Default-Landscape-2436h.png', $dir_www . '/resources/ios/splash/Default-Landscape-2436h.png');
    @copy($output . '/resources/ios/splash/Default-2436h.png', $dir_www . '/resources/ios/splash/Default-2436h.png');


    // TODO: GENERATE --|-- CONFIG.XML
    $xml = null;
    $xml .= '<?xml version=\'1.0\' encoding=\'utf-8\'?>' . "\r\n";
    $xml .= '<widget id="' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-id']) . '" android-versionCode="' . (int)str_replace(".", "", ($_SESSION['CURRENT_APP']['apps']['app-version'])) . '" version="' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-version']) . '"  xmlns="http://www.w3.org/ns/widgets" xmlns:android="http://schemas.android.com/apk/res/android" xmlns:cdv="http://cordova.apache.org/ns/1.0">' . "\r\n";
    $xml .= "\t" . '<name>' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-name']) . '</name>' . "\r\n";
    $xml .= "\t" . '<description>' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-description']) . '</description>' . "\r\n";
    $xml .= "\t" . '<author email="' . htmlentities($_SESSION['CURRENT_APP']['apps']['author-email']) . '" href="' . htmlentities($_SESSION['CURRENT_APP']['apps']['author-website']) . '">' . htmlentities($_SESSION['CURRENT_APP']['apps']['author-name']) . '</author>' . "\r\n";
    switch ($data['type'])
    {
        case 'default':
            $xml .= "\t" . '<content src="index.html" />' . "\r\n";
            break;

        case 'cordova-webview':
            $xml .= "\t" . '<content src="' . $data['url'] . '" />' . "\r\n";
            break;
        case 'html-app':
            $xml .= "\t" . '<content src="html/index.html" />' . "\r\n";
            break;
    }

    $xml .= "\t" . '<allow-navigation href="' . $data['url'] . '/*" />' . "\r\n";

    $xml .= "\t" . '<access origin="*" />' . "\r\n";
    $xml .= "\t" . '<access origin="cdvfile://*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="http://*/*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="https://*/*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="tel:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="sms:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="mailto:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="geo:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="rtsp://*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="rtmp://*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="rtp://*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="udp://*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="file://*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="mms:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="google.navigation:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="google.streetview:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="maps:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="map:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="googlemap:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="whatsapp:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="line:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="twitter:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="fb:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="fbapi20130214:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="skype:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="linkedin:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="googlegmail:*" />' . "\r\n";
    $xml .= "\t" . '<allow-intent href="youtube:*" />' . "\r\n";
    $xml .= "\t" . '' . "\r\n";
    $xml .= "\t" . '<allow-navigation href="http://*/*" />' . "\r\n";
    $xml .= "\t" . '<allow-navigation href="https://*/*" />' . "\r\n";
    $xml .= "\t" . '<allow-navigation href="data://*" />' . "\r\n";
    $xml .= "\t" . '<allow-navigation href="file://*" />' . "\r\n";
    $xml .= "\t" . '<allow-navigation href="http://localhost:8080/*" />' . "\r\n";
    $xml .= "\t" . '' . "\r\n";
    $xml .= "\t" . '<preference name="AppendUserAgent" value="' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-prefix']) . '" />' . "\r\n";
    $xml .= "\t" . '<preference name="ScrollEnabled" value="false" />' . "\r\n";
    $xml .= "\t" . '<preference name="android-minSdkVersion" value="22" />' . "\r\n";
    $xml .= "\t" . '<preference name="android-targetSdkVersion" value="28" />' . "\r\n";
    $xml .= "\t" . '<preference name="BackupWebStorage" value="none" />' . "\r\n";

    if (!isset($_SESSION['CURRENT_APP']['apps']['pref-orientation']))
    {
        $_SESSION['CURRENT_APP']['apps']['pref-orientation'] = 'default';
    }
    if ($_SESSION['CURRENT_APP']['apps']['pref-orientation'] != 'default')
    {
        $xml .= "\t" . '<preference name="Orientation" value="' . $_SESSION['CURRENT_APP']['apps']['pref-orientation'] . '"/>' . "\r\n";
    }
    $xml .= "\t" . '' . "\r\n";
    $xml .= "\t" . '<!-- cordova-plugin-splashscreen -->' . "\r\n";
    $xml .= "\t" . '<preference name="SplashMaintainAspectRatio" value="true" />' . "\r\n";
    $xml .= "\t" . '<preference name="FadeSplashScreenDuration" value="' . (int)($_SESSION['CURRENT_APP']['apps']['fade-splash-screen-duration']) . '" />' . "\r\n";
    $xml .= "\t" . '<preference name="SplashShowOnlyFirstTime" value="false" />' . "\r\n";
    $xml .= "\t" . '<preference name="SplashScreen" value="screen" />' . "\r\n";
    $xml .= "\t" . '<preference name="SplashScreenDelay" value="' . (int)($_SESSION['CURRENT_APP']['apps']['splash-screen-delay']) . '" />' . "\r\n";
    $xml .= "\t" . '<preference name="ShowSplashScreenSpinner" value="true"/>' . "\r\n";
    $xml .= "\t" . '<preference name="SplashScreenSpinnerColor" value="white"/>' . "\r\n";
    $xml .= "\t" . '<!-- ./cordova-plugin-splashscreen -->' . "\r\n";
    $xml .= "\t" . '' . "\r\n";

    $xml .= "\t" . '<!-- cordova-plugin-statusbar -->' . "\r\n";
    $xml .= "\t" . '<preference name="StatusBarOverlaysWebView" value="false" />' . "\r\n";
    $xml .= "\t" . '<preference name="StatusBarStyle" value="' . $data['statusbar']['style'] . '" />' . "\r\n";
    $xml .= "\t" . '<preference name="StatusBarBackgroundColor" value="' . $data['statusbar']['backgroundcolor'] . '" />' . "\r\n";
    $xml .= "\t" . '<!-- ./cordova-plugin-statusbar -->' . "\r\n";


    $xml .= "\t" . '' . "\r\n";
    $xml .= "\t" . '<platform name="android">' . "\r\n";
    $xml .= "\t\t" . '' . "\r\n";
    $xml .= "\t\t" . '<edit-config file="AndroidManifest.xml" mode="merge" target="/manifest/application">' . "\r\n";
    $xml .= "\t\t\t" . '<application android:usesCleartextTraffic="true" />' . "\r\n";
    $xml .= "\t\t" . '</edit-config>' . "\r\n";
    $xml .= "\t\t" . '<allow-intent href="market:*" />' . "\r\n";
    $xml .= "\t\t" . '<preference name="loadUrlTimeoutValue" value="20000" />' . "\r\n";
    $xml .= "\t\t" . '<preference name="LoadingDialog" value="Loading" />' . "\r\n";
    $xml .= "\t\t" . '<preference name="backgroundColor" value="0x00000000" />' . "\r\n";

    $xml .= "\t\t" . '<preference name="ErrorUrl" value="file:///android_asset/www/retry.html" />' . "\r\n";
    $xml .= "\t\t" . '' . "\r\n";
    $xml .= "\t\t" . '<icon density="ldpi" src="www/resources/android/icon/drawable-ldpi-icon.png" />' . "\r\n";
    $xml .= "\t\t" . '<icon density="mdpi" src="www/resources/android/icon/drawable-mdpi-icon.png" />' . "\r\n";
    $xml .= "\t\t" . '<icon density="hdpi" src="www/resources/android/icon/drawable-hdpi-icon.png" />' . "\r\n";
    $xml .= "\t\t" . '<icon density="xhdpi" src="www/resources/android/icon/drawable-xhdpi-icon.png" />' . "\r\n";
    $xml .= "\t\t" . '<icon density="xxhdpi" src="www/resources/android/icon/drawable-xxhdpi-icon.png" />' . "\r\n";
    $xml .= "\t\t" . '<icon density="xxxhdpi" src="www/resources/android/icon/drawable-xxxhdpi-icon.png" />' . "\r\n";
    $xml .= "\t\t" . '' . "\r\n";
    $xml .= "\t\t" . '<splash density="land-ldpi" src="www/resources/android/splash/drawable-land-ldpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="land-mdpi" src="www/resources/android/splash/drawable-land-mdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="land-hdpi" src="www/resources/android/splash/drawable-land-hdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="land-xhdpi" src="www/resources/android/splash/drawable-land-xhdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="land-xxhdpi" src="www/resources/android/splash/drawable-land-xxhdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="land-xxxhdpi" src="www/resources/android/splash/drawable-land-xxxhdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="port-ldpi" src="www/resources/android/splash/drawable-port-ldpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="port-mdpi" src="www/resources/android/splash/drawable-port-mdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="port-hdpi" src="www/resources/android/splash/drawable-port-hdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="port-xhdpi" src="www/resources/android/splash/drawable-port-xhdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="port-xxhdpi" src="www/resources/android/splash/drawable-port-xxhdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '<splash density="port-xxxhdpi" src="www/resources/android/splash/drawable-port-xxxhdpi-screen.png" />' . "\r\n";
    $xml .= "\t\t" . '' . "\r\n";
    $xml .= "\t" . '</platform>' . "\r\n";

    $xml .= "\t" . '<platform name="ios">' . "\r\n";
    $xml .= "\t\t" . '' . "\r\n";
    $xml .= "\t\t" . '<allow-intent href="itms:*" />' . "\r\n";
    $xml .= "\t\t" . '<allow-intent href="itms-apps:*" />' . "\r\n";
    $xml .= "\t\t" . '<preference name="WKWebViewOnly" value="true" />' . "\r\n";
    $xml .= "\t\t" . '<feature name="CDVWKWebViewEngine">' . "\r\n";
    $xml .= "\t\t\t" . '<param name="ios-package" value="CDVWKWebViewEngine" />' . "\r\n";
    $xml .= "\t\t" . '</feature>' . "\r\n";
    $xml .= "\t\t" . '<preference name="CordovaWebViewEngine" value="CDVWKWebViewEngine" />' . "\r\n";
    $xml .= "\t\t" . '<plugin name="cordova-plugin-wkwebview-engine" />' . "\r\n";

    $xml .= "\t\t" . '<icon height="57" src="resources/ios/icon/icon.png" width="57" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="114" src="resources/ios/icon/icon@2x.png" width="114" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="29" src="resources/ios/icon/icon-small.png" width="29" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="58" src="resources/ios/icon/icon-small@2x.png" width="58" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="87" src="resources/ios/icon/icon-small@3x.png" width="87" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="20" src="resources/ios/icon/icon-20.png" width="20" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="40" src="resources/ios/icon/icon-20@2x.png" width="40" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="60" src="resources/ios/icon/icon-20@3x.png" width="60" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="48" src="resources/ios/icon/icon-24@2x.png" width="48" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="55" src="resources/ios/icon/icon-27.5@2x.png" width="55" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="29" src="resources/ios/icon/icon-29.png" width="29" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="58" src="resources/ios/icon/icon-29@2x.png" width="58" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="87" src="resources/ios/icon/icon-29@3x.png" width="87" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="40" src="resources/ios/icon/icon-40.png" width="40" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="80" src="resources/ios/icon/icon-40@2x.png" width="80" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="120" src="resources/ios/icon/icon-40@3x.png" width="120" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="88" src="resources/ios/icon/icon-44@2x.png" width="88" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="50" src="resources/ios/icon/icon-50.png" width="50" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="100" src="resources/ios/icon/icon-50@2x.png" width="100" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="60" src="resources/ios/icon/icon-60.png" width="60" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="120" src="resources/ios/icon/icon-60@2x.png" width="120" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="180" src="resources/ios/icon/icon-60@3x.png" width="180" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="72" src="resources/ios/icon/icon-72.png" width="72" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="144" src="resources/ios/icon/icon-72@2x.png" width="144" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="76" src="resources/ios/icon/icon-76.png" width="76" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="152" src="resources/ios/icon/icon-76@2x.png" width="152" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="167" src="resources/ios/icon/icon-83.5@2x.png" width="167" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="172" src="resources/ios/icon/icon-86@2x.png" width="172" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="196" src="resources/ios/icon/icon-98@2x.png" width="196" />' . "\r\n";
    $xml .= "\t\t" . '<icon height="1024" src="resources/ios/icon/icon-1024.png" width="1024" />' . "\r\n";


    $xml .= "\t\t" . '' . "\r\n";
    $xml .= "\t\t" . '<splash height="1136" src="resources/ios/splash/Default-568h@2x~iphone.png" width="640" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="1334" src="resources/ios/splash/Default-667h.png" width="750" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="2208" src="resources/ios/splash/Default-736h.png" width="1242" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="1242" src="resources/ios/splash/Default-Landscape-736h.png" width="2208" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="1536" src="resources/ios/splash/Default-Landscape@2x~ipad.png" width="2048" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="2048" src="resources/ios/splash/Default-Landscape@~ipadpro.png" width="2732" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="768" src="resources/ios/splash/Default-Landscape~ipad.png" width="1024" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="2048" src="resources/ios/splash/Default-Portrait@2x~ipad.png" width="1536" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="2732" src="resources/ios/splash/Default-Portrait@~ipadpro.png" width="2048" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="1024" src="resources/ios/splash/Default-Portrait~ipad.png" width="768" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="960" src="resources/ios/splash/Default@2x~iphone.png" width="640" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="480" src="resources/ios/splash/Default~iphone.png" width="320" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="2732" src="resources/ios/splash/Default@2x~universal~anyany.png" width="2732" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="1125" src="resources/ios/splash/Default-Landscape-2436h.png" width="2436" />' . "\r\n";
    $xml .= "\t\t" . '<splash height="2436" src="resources/ios/splash/Default-2436h.png" width="1125" />' . "\r\n";
    $xml .= "\t\t" . '' . "\r\n";

    $xml .= "\t" . '</platform>' . "\r\n";


    $xml .= "\t" . '<preference name="CRIInjectFirstFiles" value="www/init.js" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-whitelist" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-inappbrowser" />' . "\r\n";
    //$xml .= "\t" . '<plugin name="cordova-plugin-dialogs" />' . "\r\n";
    //$xml .= "\t" . '<plugin name="cordova-plugin-device" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-ionic-webview" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-ionic-keyboard" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-statusbar" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-splashscreen" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-inappbrowser" />' . "\r\n";
    $xml .= "\t" . '<plugin name="cordova-plugin-remote-injection" />' . "\r\n";
    if ($data['admobfree']['app-id'] != "")
    {
        $xml .= "\t" . '<plugin name="cordova-plugin-admob-free" >' . "\r\n";
        $xml .= "\t\t" . '<variable name="ADMOB_APP_ID" value="' . $data['admobfree']['app-id'] . '" />' . "\r\n";
        $xml .= "\t" . '</plugin>' . "\r\n";
        $xml .= "\t" . '<plugin name="cordova-admob-sdk" />' . "\r\n";
        $xml .= "\t" . '<plugin name="cordova-promise-polyfill" />' . "\r\n";
    }

    switch ($data['push-type'])
    {
        case 'onesignal':
            $xml .= "\t" . '<plugin name="onesignal-cordova-plugin" />' . "\r\n";
            break;
        case 'fcm':
            $xml .= "\t" . '<platform name="android">' . "\r\n";
            $xml .= "\t\t" . '<resource-file src="google-services.json" target="app/google-services.json" />' . "\r\n";
            $xml .= "\t" . '</platform>' . "\r\n";
            $xml .= "\t" . '<plugin name="cordova-plugin-firebase-messaging" />' . "\r\n";
            $xml .= "\t" . '<plugin name="cordova-plugin-firebase-analytics" />' . "\r\n";
            $xml .= "\t" . '<plugin name="cordova-support-android-plugin" />' . "\r\n";
            $xml .= "\t" . '<plugin name="cordova-support-google-services" />' . "\r\n";


            break;
    }


    $xml .= "\t" . '<preference name="phonegap-version" value="cli-9.0.0" />' . "\r\n";
    $xml .= '</widget>';
    file_put_contents($dir_output . '/config.xml', $xml);

    // TODO: GENERATE --|-- INDEX.HTML
    $html = null;
    $html .= '<!DOCTYPE html>' . "\r\n";
    $html .= '<html>' . "\r\n";
    $html .= '<head>' . "\r\n";
    $html .= '<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>' . "\r\n";
    $html .= '<meta http-equiv="Refresh" content="0; url=' . $data['url'] . '" />' . "\r\n";
    $html .= '<title>' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-name']) . '</title>' . "\r\n";
    $html .= '</head>' . "\r\n";
    $html .= '<body>' . "\r\n";
    $html .= '<p><a href="' . $data['url'] . '">Enter</a></p>' . "\r\n";
    $html .= '</body>' . "\r\n";
    $html .= '</html>' . "\r\n";
    file_put_contents($dir_www . '/index.html', $html);

    // TODO: GENERATE --|-- RETRY.HTML
    $html = null;
    $html = '<!DOCTYPE HTML>' . "\r\n";
    $html .= '<html>' . "\r\n";
    $html .= '<head>' . "\r\n";
    $html .= '<meta charset="utf-8"/>' . "\r\n";
    $html .= '<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>' . "\r\n";
    $html .= '<title>Retry</title>' . "\r\n";
    $html .= '<style>html,body{height:100%}body{font-size:14px;line-height:1.25em;position:relative;background-color:#fff;font-family:Helvetica;-webkit-text-size-adjust:none;color:#000}a{color:#000;text-decoration:none}#content{height:100%}.error{position:absolute;top:50%;left:0;width:100%;margin-top:-22px;text-align:center}.error .btn_retry a{display:inline-block;width:136px;height:44px;background:' . $data['statusbar']['backgroundcolor'] . ';line-height:44px;font-size:16px;color:#fff}.error .desc{position:absolute;width:100%;bottom:62px;font-size:14px;line-height:17px;color:' . $data['statusbar']['backgroundcolor'] .
        '}@media all and (min-width:768px){.error .desc{font-size:20px;bottom:88px;line-height:24px}.error{margin-top:-32px}.error .btn_retry a{width:192px;height:63px;line-height:63px;font-size:22px}}</style>' . "\r\n";
    $html .= '</head>' . "\r\n";
    $html .= '<body>' . "\r\n";
    $html .= '<div id="content">' . "\r\n";
    $html .= '<div class="error">' . "\r\n";
    $html .= '<p class="desc">Unable to connect to the network.<br/>Please check the network connection.</p>' . "\r\n";
    $html .= '<div class="btn_retry"><a href="' . $data['url'] . '">Retry</a></div>' . "\r\n";
    $html .= '</div>' . "\r\n";
    $html .= '</div>' . "\r\n";
    $html .= '</body>' . "\r\n";
    $html .= '</html>';
    file_put_contents($dir_www . '/retry.html', $html);


    // TODO: GENERATE --|-- INIT.JS
    $js = null;

    $js .= "" . 'var app = {' . "\r\n";
    $js .= "\t" . 'initialize: function() {' . "\r\n";
    $js .= "\t\t" . 'document.addEventListener("deviceready", this.onDeviceReady.bind(this), false);' . "\r\n";
    $js .= "\t" . '},' . "\r\n";
    $js .= "\t" . 'onDeviceReady: function() {' . "\r\n";
    $js .= "\t\t" . 'document.onclick = function(e) {' . "\r\n";
    $js .= "\t\t\t" . 'e = e || window.event;' . "\r\n";
    $js .= "\t\t\t" . 'var element = e.target || e.srcElement;' . "\r\n";

    //$js .= "\t\t\t" . 'console.log("download",element.download);' . "\r\n";
    //$js .= "\t\t\t" . 'console.log("class",element.class);' . "\r\n";
    //$js .= "\t\t\t" . 'console.log("href",element.href);' . "\r\n";
    //$js .= "\t\t\t" . 'console.log("target",element.target);' . "\r\n";

    $js .= "\t\t\t" . 'var pattern = /download/g;' . "\r\n";
    $js .= "\t\t\t" . 'if(element.download){' . "\r\n";
    $js .= "\t\t\t\t" . 'if(pattern.test(element.download)){' . "\r\n";
    $js .= "\t\t\t\t\t" . 'window.open(element.href, "_system", "location=yes");' . "\r\n";
    $js .= "\t\t\t\t\t" . 'return false;' . "\r\n";
    $js .= "\t\t\t\t" . '}' . "\r\n";
    $js .= "\t\t\t" . '}' . "\r\n";

    $js .= "\t\t\t" . 'if(element.className){' . "\r\n";
    $js .= "\t\t\t\t" . 'if(pattern.test(element.className)){' . "\r\n";
    $js .= "\t\t\t\t\t" . 'window.open(element.href, "_system", "location=yes");' . "\r\n";
    $js .= "\t\t\t\t\t" . 'return false;' . "\r\n";
    $js .= "\t\t\t\t" . '}' . "\r\n";
    $js .= "\t\t\t" . '}' . "\r\n";


    $js .= "\t\t\t" . 'if (element.target == "_blank") {' . "\r\n";
    $js .= "\t\t\t\t" . 'window.open(element.href, "_blank", "location=yes");' . "\r\n";
    $js .= "\t\t\t\t" . 'return false;' . "\r\n";
    $js .= "\t\t\t" . '}' . "\r\n";
    $js .= "\t\t\t" . 'if (element.target == "_system") {' . "\r\n";
    $js .= "\t\t\t\t" . 'window.open(element.href, "_system", "location=yes");' . "\r\n";
    $js .= "\t\t\t\t" . 'return false;' . "\r\n";
    $js .= "\t\t\t" . '}' . "\r\n";
    $js .= "\t\t\t" . 'if (element.target == "_self") {' . "\r\n";
    $js .= "\t\t\t\t" . 'window.open(element.href, "_self");' . "\r\n";
    $js .= "\t\t\t\t" . 'return false;' . "\r\n";
    $js .= "\t\t\t" . '}' . "\r\n";
    $js .= "\t\t" . '};' . "\r\n";

    if ($data['admobfree']['app-id'] != "")
    {
        $js .= "\t\t" . '' . "\r\n";
        $js .= "\t\t" . '// admob' . "\r\n";
        $js .= "\t\t" . 'if (typeof admob !== "undefined"){' . "\r\n";
        $js .= "\t\t\t" . '// banner' . "\r\n";
        $js .= "\t\t\t" . 'admob.banner.config({id: "' . $data['admobfree']['banner'] . '"});' . "\r\n";
        $js .= "\t\t\t" . 'admob.banner.prepare();' . "\r\n";
        $js .= "\t\t\t" . 'admob.banner.show();' . "\r\n";
        $js .= "\t\t\t" . '' . "\r\n";
        $js .= "\t\t" . '}' . "\r\n";
    }
    switch ($data['push-type'])
    {
        case 'onesignal':
            $js .= "\t\t" . '' . "\r\n";
            $js .= "\t\t" . '' . "\r\n";
            $js .= "\t\t" . '// onesignal' . "\r\n";
            $js .= "\t\t" . 'if(window.plugins && window.plugins.OneSignal){' . "\r\n";
            $js .= "\t\t\t" . 'window.plugins.OneSignal.enableNotificationsWhenActive(true);' . "\r\n";
            $js .= "\t\t\t" . 'var notificationOpenedCallback = function(jsonData){};' . "\r\n";
            $js .= "\t\t\t" . 'window.plugins.OneSignal.startInit("' . $data['onesignal']['app-id'] . '","' . $data['onesignal']['firebase-sender-id'] . '").handleNotificationOpened(notificationOpenedCallback).endInit();' . "\r\n";
            $js .= "\t\t" . '}' . "\r\n";
            break;
        case 'fcm':
            $js .= "\t\t" . '' . "\r\n";
            $js .= "\t\t" . '' . "\r\n";
            $js .= "\t\t" . '// fcm' . "\r\n";

            break;
    }
    $js .= "\t" . '},' . "\r\n";
    $js .= "" . '};' . "\r\n";
    $js .= "" . 'app.initialize();' . "\r\n";
    file_put_contents($dir_www . '/init.js', $js);


    $package = null;
    $package .= "" . '{' . "\r\n";
    $package .= "\t" . '"name": "' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-id']) . '",' . "\r\n";
    $package .= "\t" . '"displayName": "' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-name']) . '",' . "\r\n";
    $package .= "\t" . '"version": "' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-version']) . '",' . "\r\n";
    $package .= "\t" . '"description": "' . htmlentities($_SESSION['CURRENT_APP']['apps']['app-description']) . '",' . "\r\n";
    $package .= "\t" . '"main": "index.js",' . "\r\n";
    $package .= "\t" . '"scripts": {' . "\r\n";
    $package .= "\t\t" . '"test": "echo \"Error: no test specified\" && exit 1"' . "\r\n";
    $package .= "\t" . '},' . "\r\n";
    $package .= "\t" . '"keywords": [' . "\r\n";
    $package .= "\t\t" . '"ecosystem:cordova"' . "\r\n";
    $package .= "\t" . '],' . "\r\n";
    $package .= "\t" . '"author": "' . htmlentities($_SESSION['CURRENT_APP']['apps']['author-name']) . '",' . "\r\n";
    $package .= "\t" . '"license": "Apache-2.0"' . "\r\n";
    $package .= "" . '}' . "\r\n";
    file_put_contents($dir_output . '/package.json', $package);

    // TODO: GENERATE --|-- ZIP
    $fileToZip = array();
    $path[] = $dir_output . '/*';
    while (count($path) != 0)
    {
        $v = array_shift($path);
        foreach (glob($v) as $item)
        {
            if (is_dir($item))
                $path[] = $item . '/*';
            elseif (is_file($item))
            {
                $fileToZip[] = $item;
            }
        }
    }
    $note = createZip($fileToZip, $output . '/web-converter.zip', '');


    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The site converter settings has been successfully edited');


    header("Location: ./?p=web-converter");

}

$db->current();


// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Site Converter') . '</li>';
$breadcrumb .= '</ol>';

if (isset($_SESSION['CURRENT_APP']['webconverter']))
{
    $site_converter = $_SESSION['CURRENT_APP']['webconverter'];
}

if (!isset($site_converter['url']))
{
    $site_converter['url'] = '';
}

if (!isset($site_converter['type']))
{
    $site_converter['type'] = 'cordova-webview';
}

if (!isset($site_converter['push-type']))
{
    $site_converter['push-type'] = 'none';
}


if (!isset($site_converter['onesignal']['app-id']))
{
    $site_converter['onesignal']['app-id'] = '';
}
if (!isset($site_converter['onesignal']['firebase-sender-id']))
{
    $site_converter['onesignal']['firebase-sender-id'] = '';
}

if (!isset($site_converter['admobfree']['app-id']))
{
    $site_converter['admobfree']['app-id'] = '';
}

if (!isset($site_converter['admobfree']['banner']))
{
    $site_converter['admobfree']['banner'] = '';
}


if (!isset($site_converter['statusbar']['style']))
{
    $site_converter['statusbar']['style'] = $_SESSION['CURRENT_APP']['apps']['statusbar']['style'];
}

if (!isset($site_converter['statusbar']['backgroundcolor']))
{
    $site_converter['statusbar']['backgroundcolor'] = $_SESSION['CURRENT_APP']['apps']['statusbar']['backgroundcolor'];
}


// TODO: LAYOUT
$content .= '<form action="" method="post" enctype="multipart/form-data">';

$content .= '<div class="row"> <!-- row -->';
$content .= '<div class="col-md-6">';

$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-globe"></i> ' . __e('WebSite Converter') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$disable = '';
if (!file_exists($output . '/resources/android/icon/drawable-hdpi-icon.png'))
{
    $disable = 'disabled';
    $content .= '<div class="alert alert-danger">' . __e('Icon not created yet, please create an icon using the <a href="./?p=icon-generator">Icon Generator</a>') . '</div>';
}

if (!file_exists($output . '/resources/android/splash/drawable-port-xxxhdpi-screen.png'))
{
    $disable = 'disabled';
    $content .= '<div class="alert alert-danger">' . __e('Splashscreen not created yet, please create an icon using the <a href="./?p=splashscreen">Splashscreen</a>') . '</div>';
}

$content .= '<div class="help-dev">' . __e('Site converter is configuring cordova so that it produces like a site converter, it does not use ionic or other code. You can compile using cordova or phonegap') . '</div>';

// TODO: LAYOUT --+-- TYPE
$content .= '<hr/>';
$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('Type') . '</label>';

$option_types[] = array('value' => 'default', 'label' => 'Default');
$option_types[] = array('value' => 'cordova-webview', 'label' => 'Cordova Webview (Recommended)');
$option_types[] = array('value' => 'html-app', 'label' => 'HTML5 ~ App / HTML5 ~ Games');
//$option_types[] = array('value' => 'iframe', 'label' => 'HTML5 ~ Iframe');

$content .= '<select class="form-control" id="webconverter-type" name="webconverter[type]" >';
foreach ($option_types as $option_type)
{
    $selected = '';
    if ($option_type['value'] == $site_converter['type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $option_type['value'] . '" ' . $selected . '>' . $option_type['label'] . '</option>';
}
$content .= '</select>';

$content .= '<p class="help-block">' . __e('Select type webview') . '</p>';
$content .= '</div>';

// TODO: LAYOUT --+-- SITE-URL
$content .= '<div class="form-group" id="box-site-url">';
$content .= '<label for="webconverter">' . __e('Site URL') . '</label>';
$content .= '<input ' . $disable . ' type="url" class="form-control" name="webconverter[url]" id="site-url" placeholder="https://cordova.apache.org/" value="' . $site_converter['url'] . '" />';
$content .= '<p class="help-block">' . __e('Write your site address') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group" id="box-html-data">';
$content .= '<label for="webconverter">' . __e('HTML Data') . '</label>';
$content .= '<p>' . __e('Copy all app/game files to the folder:') . '</p>';
$content .= '<pre>' . realpath($dir_www . '/html') . '</pre>';
$content .= '</div>';

// TODO: LAYOUT --+-- STATUSBAR
$content .= '<hr/>';
$content .= '<h3>StatusBar</h3>';
$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label for="webconverter-statusbar-style">' . __e('Style') . '</label>';
$statusbar_style_options[] = array('value' => 'lightcontent', 'label' => __e('Light Content'));
$statusbar_style_options[] = array('value' => 'blacktranslucent', 'label' => __e('Black Translucent'));
$statusbar_style_options[] = array('value' => 'blackopaque', 'label' => __e('Black Opaque'));
$content .= '<select class="form-control" id="webconverter-statusbar-style" name="webconverter[statusbar][style]" >';
foreach ($statusbar_style_options as $style_option)
{
    $selected = '';
    if ($style_option['value'] == $site_converter['statusbar']['style'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $style_option['value'] . '" ' . $selected . '>' . $style_option['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Set the status bar style') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label for="webconverter-statusbar-backgroundcolor">' . __e('Background Color') . '</label>';
$content .= '<input type="color" class="form-control" id="webconverter-statusbar-style" name="webconverter[statusbar][backgroundcolor]" value="' . $site_converter['statusbar']['backgroundcolor'] . '" >';
$content .= '<p class="help-block">' . __e('Set the background color of the statusbar') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


// TODO: LAYOUT --+-- NOTIFICATION
$content .= '<hr/>';
$content .= '<h3>Notification</h3>';
$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('Plugin') . '</label>';
$push_types[] = array('value' => 'none', 'label' => __e('None'));
$push_types[] = array('value' => 'onesignal', 'label' => 'OneSignal');
$push_types[] = array('value' => 'fcm', 'label' => 'Firebase Cloud Messaging [Not Support: Adobe Phonegap Build]');

$content .= '<select class="form-control" id="webconverter-push-type" name="webconverter[push-type]" >';
foreach ($push_types as $push_type)
{
    $selected = '';
    if ($push_type['value'] == $site_converter['push-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $push_type['value'] . '" ' . $selected . '>' . $push_type['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select <em>push notification</em> plugin') . '</p>';
$content .= '</div>';


// TODO: LAYOUT --+-- FIREBASE SENDER ID
$content .= '<div id="box-onesignal">';
$content .= '<h4>OneSignal Push Notification</h4>';
$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('Firebase Sender ID') . '</label>';
$content .= '<input ' . $disable . ' type="text" class="form-control" name="webconverter[onesignal][firebase-sender-id]" id="webconverter" placeholder="509652529505" value="' . $site_converter['onesignal']['firebase-sender-id'] . '" />';
$content .= '<p class="help-block">' . __e('Sender ID from your Cloud Messaging, available in <a target="_blank" href="https://console.firebase.google.com/">Firebase Console</a> also known as the Google Project Number') . '</p>';
$content .= '</div>';

// TODO: LAYOUT --+-- ONESIGNAL ID
$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('Your OneSignal AppId') . '</label>';
$content .= '<input ' . $disable . ' type="text" class="form-control" name="webconverter[onesignal][app-id]" id="webconverter" placeholder="5edfcc7a-f856-4b83-9006-6e33ecae4a19" value="' . $site_converter['onesignal']['app-id'] . '" />';
$content .= '<p class="help-block">' . __e('Your OneSignal AppId, available in <a target="_blank" href="https://documentation.onesignal.com/docs/generate-a-google-server-api-key">OneSignal</a>') . '</p>';
$content .= '</div>';

$content .= '</div>';

// TODO: LAYOUT --+-- FCM
$content .= '<div id="box-fcm">';
$content .= '<h4>Firebase Cloud Messaging</h4>';
$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('Upload file `<strong>google-services.json</strong>`') . '</label>';
$content .= '<input ' . $disable . ' type="file" class="form-control" name="google-services" />';
$content .= '<p class="help-block">' . __e('You can download `<code>google-services.json</code>` file from <a href="https://console.firebase.google.com/">Firebase console</a>') . '</p>';
$content .= '</div>';

$content .= '</div>';

$content .= '<hr/>';

$content .= '<h3>Advertisement</h3>';

// TODO: LAYOUT --+-- ADMOB-FREE --|-- APPID
$content .= '<h4>Admob Free</h4>';

$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('App ID') . '</label>';
$content .= '<input ' . $disable . ' type="text" class="form-control" name="webconverter[admobfree][app-id]" id="webconverter" placeholder="ca-app-pub-4855740622510094~5023399572" value="' . $site_converter['admobfree']['app-id'] . '" />';
$content .= '<p class="help-block">' . __e('Please see the App settings section on the <a target="blank" href="https://apps.admob.com/">AdMob portal</a>') . '</p>';
$content .= '</div>';

// TODO: LAYOUT --+-- ADMOB-FREE --|-- BANNER
$content .= '<div class="form-group">';
$content .= '<label for="webconverter">' . __e('Ad unit ID for Banner') . '</label>';
$content .= '<input ' . $disable . ' type="text" class="form-control" name="webconverter[admobfree][banner]" id="webconverter" placeholder="ca-app-pub-4855740622510094/3178807190" value="' . $site_converter['admobfree']['banner'] . '" />';
$content .= '<p class="help-block">' . __e('Please see the Ad units menu on the <a target="blank" href="https://apps.admob.com/">AdMob portal</a>') . '</p>';
$content .= '</div>';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<input ' . $disable . ' name="submit" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';


$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="col-md-6">';

$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-life-bouy"></i> ' . __e('Instructions') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<h3>How to use Web Converter</h3>';
$content .= '<ol>';
$content .= '<li>';
$content .= __e('Goto <strong>Dashboard</strong> -&raquo; <strong>App</strong>, then create new project');
$content .= '</li>';

$content .= '<li>';
$content .= __e('Then goto <strong>Helper Tools</strong> -&raquo; <strong>Icon Generator</strong>, then create <code>new icon</code> for your app');
$content .= '</li>';

$content .= '<li>';
$content .= __e('Then goto <strong>Helper Tools</strong> -&raquo; <strong>Splashscreen</strong>, then create <code>new splashscreens</code> for your app');
$content .= '</li>';

$content .= '<li>';
$content .= __e('Next, goto <strong>Helper Tools</strong> -&raquo; <strong>Website Converter</strong>, then complete the required fields');
$content .= '</li>';

$content .= '<li>';
$content .= __e('Run <strong>Node.JS command prompt</strong>, Then follow this commands below:');


$content .= '<ul>';
$content .= '<li>';
$content .= __e('Browse to the newly created folder:');
if ($os_type == 2)
{
    $content .= '<pre class="shell">cd /D "' . realpath($dir_output) . '"</pre>';
} else
{
    $content .= '<pre class="shell">cd "' . realpath($dir_output) . '"</pre>';
}
$content .= '</li>';

$content .= '<li>';
$content .= __e('Add platform do you need');
$content .= '<pre class="shell">cordova platform add android@latest</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= __e('Prepare whatever is needed');
$content .= '<pre class="shell">cordova prepare android</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= __e('Build your project');
$content .= '<pre class="shell">cordova build android</pre>';
$content .= '</li>';
if ($os_type == 2)
{
    $content .= '<li>';
    $content .= __e('Then open <strong>Windows Explorer</strong>');
    $content .= '<pre class="shell">explorer "platforms\\android\\app\\build\\outputs\\apk\\"</pre>';
    $content .= '</li>';
}
$content .= '</ul>';
$content .= '</li>';

$content .= '<li>';
$app_prefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];

 
$content .= '<p>' . __e('Create AAB File (Android App Bundle) to publish on Google Play Store, follow this command: ') . '</p>';

$content .= '<ol>';
$content .= '<li>';
$content .= __e('Just go to your project folder:');
if ($os_type == 2)
{
    $content .= '<pre class="shell">cd /D "' . realpath($dir_output) . '"</pre>';
} else
{
    $content .= '<pre class="shell">cd "' . realpath($dir_output) . '"</pre>';
}
$content .= '</li>';

$content .= '<li>';
$content .= __e('Then build your cordova project:');
$content .= '<pre class="shell">cordova build android --release -- --packageType=bundle</pre>';
$content .= '</li>';

 

$content .= '<li>';
$content .= '<p>' . __e('Let\'s generate our private key using the keytool command that comes with the JDK, For app already exist in playstore, you can use old key file rename to:') . ' <code>' . $app_prefix . '.keystore</code></p>';
$content .= '<pre class="shell">keytool -genkey -v -keystore "' . $app_prefix . '.keystore" -alias ' . $string->toVar($app_prefix) . ' -keyalg RSA -keysize 2048 -validity 10000</pre>';
$content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('To sign the unsigned Android App bundle (.aab), run the jarsigner tool which is also included in the JDK') . '</p>';
    $content .= '<pre class="shell">jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore "' . $app_prefix . '.keystore" "platforms/android/app/build/outputs/bundle/release/app-release.aab" ' . $string->toVar($app_prefix) . '</pre>';
    $content .= '</li>';
    
    
    if ($os_type == 2)
{
    $content .= '<li>';
    $content .= __e('Then open <strong>Windows Explorer</strong>');
    $content .= '<pre class="shell">explorer "platforms\\android\\app\\build\\outputs\\bundle\\release\\"</pre>';
    $content .= '</li>';
}
$content .= '</ol>';


$content .= '</li>';

$content .= '</ol>';
 


$content .= '<hr/>';
$content .= '<h3>' . __e('Link and URL Scheme') . '</h3>';

$content .= '<p>' . __e('You can use the code below on <ins>your website</ins>') . '</p>';
$content .= '<table class="table table-striped table-bordered">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>';
$content .= __e('Name');
$content .= '</th>';
$content .= '<th>';
$content .= __e('Example');
$content .= '</th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('AppBrowser');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="https://ihsana.com/imabuilder3/" target="_blank">AppBrowser</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Download');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="https://ihsana.com/imabuilder3/userfiles/documents.zip" target="_system">Link</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';


$content .= '<tr>';
$content .= '<td>';
$content .= __e('WhatsApp');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="https://api.whatsapp.com/send?phone=6285156056312&text=Hallo" target="_system">Whatsapp</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Twitter');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="twitter://post?message=Hallo" target="_system">Twitter</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('SMS');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="sms:6285156056312" target="_system">SMS</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Telp');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="tel:6285156056312" target="_system">Telp</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Email');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="mailto:info@ihsana.com" target="_system">Email</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Line');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="line://msg/text/Hello" target="_system">Line</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Playstore');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="market://details?id=com.imabuilder.ihsanaitsolution.testwebconverter" target="_system">Playstore</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('AppStore');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="https://apps.apple.com/us/app/xxxx/id123456" target="_system">AppStore</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('GEO/MAP (Android)');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="geo:?q=Jakarta" target="_system">GEO</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('GEO/MAP (iOS)');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="maps://?q=Jakarta" target="_system">GEO</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= __e('Facebook');
$content .= '</td>';
$content .= '<td>';
$content .= '<code>' . htmlentities('<a href="https://facebook.com/sharer/sharer.php?u=https://yourwebsite" target="_system">Facebook</a>') . '</code>';
$content .= '</td>';
$content .= '</tr>';


$content .= '</tbody>';
$content .= '</table>';


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';

$content .= '</div>';
$content .= '</div>';
$content .= '</form>';

// TODO: FUNCTION --+-- CREATE ZIP FILE
function createZip($files = array(), $destination = '')
{
    @unlink($destination);
    $note = 'Create new zip<br/>';
    $valid_files = array();
    if (is_array($files))
    {
        foreach ($files as $file)
        {
            if (file_exists($file))
            {
                $addFile = true;
                if (preg_match("/node_modules/i", $file))
                {
                    $addFile = false;
                }
                if (preg_match("/platforms/i", $file))
                {
                    $addFile = false;
                }
                if (preg_match("/plugins/i", $file))
                {
                    $addFile = false;
                }
                if (preg_match("/package\.json/i", $file))
                {
                    $addFile = false;
                }
                if (preg_match("/package\-lock\.json/i", $file))
                {
                    $addFile = false;
                }
                if ($addFile == true)
                {
                    $valid_files[] = str_replace("\\", "/", $file);
                }
            }
        }
    }
    if (count($valid_files))
    {
        $zip = new ZipArchive();
        if ($zip->open($destination, ZIPARCHIVE::CREATE))
        {
            foreach ($valid_files as $file)
            {
                $dir_zip = explode('/webconverter/', $file);
                $localname = $dir_zip[1];
                if (($localname[0] == "/") || ($localname[0] == "\\"))
                {
                    $localname = substr($localname, 1, strlen($localname));
                }
                $zip->addFile($file, $localname);
                $note .= 'Add File to Zip: ' . $file . '=> localname: ' . $localname . '<br/>';
            }
        }
        $note .= 'The zip archive contains ' . $zip->numFiles . ' files with a status of: ' . $zip->status;
        $zip->close();
        file_exists($destination);
    } else
    {
        $note .= 'Try to create zip: Failed bacause count files.<br/>';
    }
    return $note;
}
$page_js .= '
$(document).ready(function(){
    
    
    $("#webconverter-type").on("click",function(){
        webviewType();
    });
    webviewType();
    
    
    $("#webconverter-push-type").on("click",function(){
        pushType();
    });
    pushType();
    
    
    
    
    function webviewType(){
       var wType = $("#webconverter-type").val();
       $("#box-site-url").removeClass("hide");
       $("#box-html-data").removeClass("hide");
       
       switch(wType){
            case "cordova-webview":
                $("#box-site-url").removeClass("hide");
                $("#box-html-data").addClass("hide");
                break;
            case "html-app":
                $("#box-site-url").addClass("hide");
                $("#box-html-data").removeClass("hide");
                break;
            case "default":
                $("#box-site-url").removeClass("hide");
                $("#box-html-data").addClass("hide");
                break;
       }
    } 
    
    
    function pushType(){
        var pType = $("#webconverter-push-type").val();
        
       $("#box-onesignal").addClass("hide");
       $("#box-fcm").addClass("hide");
       
        switch(pType){
            case "onesignal":
                $("#box-onesignal").removeClass("hide");
                $("#box-fcm").addClass("hide");
                break;
            case "fcm":
                $("#box-onesignal").addClass("hide");
                $("#box-fcm").removeClass("hide");
                break;
        }
    }
    
    
});


';

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Website Converter';
$template->page_desc = __e('Convert your website to app');
$template->page_content = $content;

?>