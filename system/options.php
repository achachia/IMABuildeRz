<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

$paypal_currencies[] = array("label" => "Australian dollar", "val" => "AUD");
$paypal_currencies[] = array("label" => "Brazilian real 2", "val" => "BRL");
$paypal_currencies[] = array("label" => "Canadian dollar", "val" => "CAD");
$paypal_currencies[] = array("label" => "Czech koruna", "val" => "CZK");
$paypal_currencies[] = array("label" => "Danish krone", "val" => "DKK");
$paypal_currencies[] = array("label" => "Euro", "val" => "EUR");
$paypal_currencies[] = array("label" => "Hong Kong dollar", "val" => "HKD");
$paypal_currencies[] = array("label" => "Hungarian forint 1", "val" => "HUF");
$paypal_currencies[] = array("label" => "Indian rupee 3", "val" => "INR");
$paypal_currencies[] = array("label" => "Israeli new shekel", "val" => "ILS");
$paypal_currencies[] = array("label" => "Japanese yen 1", "val" => "JPY");
$paypal_currencies[] = array("label" => "Malaysian ringgit 2", "val" => "MYR");
$paypal_currencies[] = array("label" => "Mexican peso", "val" => "MXN");
$paypal_currencies[] = array("label" => "New Taiwan dollar 1", "val" => "TWD");
$paypal_currencies[] = array("label" => "New Zealand dollar", "val" => "NZD");
$paypal_currencies[] = array("label" => "Norwegian krone", "val" => "NOK");
$paypal_currencies[] = array("label" => "Philippine peso", "val" => "PHP");
$paypal_currencies[] = array("label" => "Polish zloty", "val" => "PLN");
$paypal_currencies[] = array("label" => "Pound sterling", "val" => "GBP");
$paypal_currencies[] = array("label" => "Russian ruble", "val" => "RUB");
$paypal_currencies[] = array("label" => "Singapore dollar", "val" => "SGD");
$paypal_currencies[] = array("label" => "Swedish krona", "val" => "SEK");
$paypal_currencies[] = array("label" => "Swiss franc", "val" => "CHF");
$paypal_currencies[] = array("label" => "Thai baht", "val" => "THB");
$paypal_currencies[] = array("label" => "United States dollar", "val" => "USD");
        
// TODO: IONIC-NATIVE
$native_plugins[] = array(
    'name' => 'Social Sharing',
    'class' => 'SocialSharing',
    'var' => 'socialSharing',
    'path' => '@ionic-native/social-sharing/ngx',
    'native' => '@ionic-native/social-sharing',
    'cordova' => 'cordova-plugin-x-socialsharing',
    'ref' => 'https://ionicframework.com/docs/native/social-sharing/',
    'desc' => __e('This plugin allows you to use the native sharing window of your mobile device.'));

$native_plugins[] = array(
    'name' => 'Barcode Scanner',
    'class' => 'BarcodeScanner',
    'var' => 'barcodeScanner',
    'path' => '@ionic-native/barcode-scanner/ngx',
    'native' => '@ionic-native/barcode-scanner',
    'cordova' => 'phonegap-plugin-barcodescanner',
    'ref' => 'https://ionicframework.com/docs/native/barcode-scanner/',
    'desc' => 'The Barcode Scanner Plugin opens a camera view and automatically scans a barcode, returning the data back to you.',
    );

$native_plugins[] = array(
    'name' => 'AdMob Free',
    'class' => 'AdMobFree',
    'var' => 'adMobFree',
    'path' => '@ionic-native/admob-free/ngx',
    'native' => '@ionic-native/admob-free',
    'cordova' => 'cordova-plugin-admob-free',
    'ref' => 'https://ionicframework.com/docs/native/admob-free/',
    'desc' => 'A free, no ad-sharing version of Google AdMob plugin for Cordova.',
    );

$native_plugins[] = array(
    'name' => 'AdMob Free Config',
    'class' => 'AdMobFreeBannerConfig',
    'var' => '',
    'path' => '@ionic-native/admob-free/ngx',
    'native' => '@ionic-native/admob-free',
    'cordova' => 'cordova-plugin-admob-free',
    'ref' => 'https://ionicframework.com/docs/native/admob-free/',
    'desc' => 'A free, no ad-sharing version of Google AdMob plugin for Cordova.',
    );


$native_plugins[] = array(
    'name' => 'AdMob Pro',
    'class' => 'AdMobPro',
    'var' => 'adMobPro',
    'path' => '@ionic-native/admob-pro/ngx',
    'native' => '@ionic-native/admob-pro',
    'cordova' => 'cordova-plugin-admobpro',
    'ref' => 'https://ionicframework.com/docs/native/admob-pro/',
    'desc' => 'Plugin for Google Ads, including AdMob / DFP (DoubleClick for publisher) and mediations to other Ad networks.',
    );


$native_plugins[] = array(
    'name' => 'Email Composer',
    'class' => 'EmailComposer',
    'var' => 'emailComposer',
    'path' => '@ionic-native/email-composer/ngx',
    'native' => '@ionic-native/email-composer',
    'cordova' => 'cordova-plugin-email-composer',
    'ref' => 'https://ionicframework.com/docs/native//email-composer',
    'desc' => 'The plugin provides access to the standard interface that manages the editing and sending an email message.',
    );

// TODO: IONIC-ANGULAR
$ionic_angulars[] = array(
    'name' => 'ActionSheet',
    'class' => 'ActionSheetController',
    'var' => 'actionSheetController',
    'desc' => 'An Action Sheet is a dialog that lets the user choose from a set of options');

$ionic_angulars[] = array(
    'name' => 'Alert',
    'class' => 'AlertController',
    'var' => 'alertController',
    'desc' => 'An Alert is a dialog that presents users with information or collects information from the user using inputs');

$ionic_angulars[] = array(
    'name' => 'Toast',
    'class' => 'ToastController',
    'var' => 'toastController',
    'desc' => 'A Toast is a subtle notification commonly used in modern applications');


$ionic_angulars[] = array(
    'name' => 'Loading',
    'class' => 'LoadingController',
    'var' => 'loadingController',
    'desc' => 'An overlay that can be used to indicate activity while blocking user interaction');


$angulars[] = array(
    'name' => 'HttpClient (Angular &gt; 4.3.x)',
    'class' => 'HttpClient',
    'var' => 'httpClient',
    'path' => '@angular/common/http',
    'desc' => 'Implements an HTTP client API for Angular apps that relies on the XMLHttpRequest interface exposed by browsers');

$angulars[] = array(
    'name' => 'HttpErrorResponse (Angular &gt; 4.3.x)',
    'class' => 'HttpErrorResponse',
    'var' => '',
    'path' => '@angular/common/http',
    'desc' => 'Get more specific information about the HTTP Client error');


$_angulars[] = array(
    'name' => 'Observable',
    'class' => 'Observable',
    'var' => '',
    'path' => 'rxjs/Observable',
    'desc' => '');


// TODO: COLOR

$color_name[] = array(
    'value' => 'undefined',
    'label' => 'Undefined',
    'default' => '#ffffff');
    
$color_name[] = array(
    'value' => 'primary',
    'label' => 'Primary',
    'default' => '#3880ff');

$color_name[] = array(
    'value' => 'secondary',
    'label' => 'Secondary',
    'default' => '#0cd1e8');


$color_name[] = array(
    'value' => 'tertiary',
    'label' => 'Tertiary',
    'default' => '#7044ff');

$color_name[] = array(
    'value' => 'success',
    'label' => 'Success',
    'default' => '#10dc60');

$color_name[] = array(
    'value' => 'warning',
    'label' => 'Warning',
    'default' => '#ffce00');


$color_name[] = array(
    'value' => 'danger',
    'label' => 'Danger',
    'default' => '#f04141');

$color_name[] = array(
    'value' => 'dark',
    'label' => 'Dark',
    'default' => '#222428');

$color_name[] = array(
    'value' => 'medium',
    'label' => 'Medium',
    'default' => '#989aa2');

$color_name[] = array(
    'value' => 'light',
    'label' => 'Light',
    'default' => '#f4f5f8');

$color_name[] = array(
    'value' => 'transparent',
    'label' => 'Transparent',
    'default' => 'transparent');
    
    
if (isset($_SESSION['CURRENT_APP']['themes']['custom-color']))
{
    if (is_array($_SESSION['CURRENT_APP']['themes']['custom-color']))
    {
        foreach ($_SESSION['CURRENT_APP']['themes']['custom-color'] as $custom_color)
        {
            $color_name[] = array(
                'value' => $custom_color['name'],
                'label' => '' . ucwords($custom_color['name']) . ' (by User)',
                'default' => $custom_color['color']);
        }
    }
}


// TODO: ANGULAR TYPE DATA
$angularTypes[] = array('value' => 'string', 'label' => 'String');
$angularTypes[] = array('value' => 'number', 'label' => 'Number');
$angularTypes[] = array('value' => 'boolean', 'label' => 'Boolean');
$angularTypes[] = array('value' => 'any', 'label' => 'Any');
$angularTypes[] = array('value' => 'any[]', 'label' => 'Any[]');

$angularTypes[] = array('value' => 'SafeHtml', 'label' => 'SafeHtml');
$angularTypes[] = array('value' => 'SafeStyle', 'label' => 'SafeStyle');
$angularTypes[] = array('value' => 'SafeScript', 'label' => 'SafeScript');
$angularTypes[] = array('value' => 'SafeUrl', 'label' => 'SafeUrl');
$angularTypes[] = array('value' => 'SafeResourceUrl', 'label' => 'SafeResourceUrl');


// TODO: IONIC NATIVE

//$ionicNatives[] = array('native' => '', 'cordova' => 'cordova-plugin-whitelist');
$ionicNatives[] = array('native' => '@ionic-native/in-app-browser', 'cordova' => 'cordova-plugin-inappbrowser');
$ionicNatives[] = array('native' => '@ionic-native/dialogs', 'cordova' => 'cordova-plugin-dialogs');
$ionicNatives[] = array('native' => '@ionic-native/device', 'cordova' => 'cordova-plugin-device');
$ionicNatives[] = array('native' => '@ionic-native/ionic-webview', 'cordova' => 'cordova-plugin-ionic-webview');
$ionicNatives[] = array('native' => '@ionic-native/keyboard', 'cordova' => 'cordova-plugin-ionic-keyboard');
$ionicNatives[] = array('native' => '@ionic-native/status-bar', 'cordova' => 'cordova-plugin-statusbar');
$ionicNatives[] = array('native' => '@ionic-native/splash-screen', 'cordova' => 'cordova-plugin-splashscreen');


$php_timezones[] = "Africa/Abidjan";
$php_timezones[] = "Africa/Asmara";
$php_timezones[] = "Africa/Bissau";
$php_timezones[] = "Africa/Cairo";
$php_timezones[] = "Africa/Dakar";
$php_timezones[] = "Africa/El_Aaiun";
$php_timezones[] = "Africa/Johannesburg";
$php_timezones[] = "Africa/Kigali";
$php_timezones[] = "Africa/Lome";
$php_timezones[] = "Africa/Malabo";
$php_timezones[] = "Africa/Mogadishu";
$php_timezones[] = "Africa/Niamey";
$php_timezones[] = "Africa/Sao_Tome";
$php_timezones[] = "Africa/Accra";
$php_timezones[] = "Africa/Bamako";
$php_timezones[] = "Africa/Blantyre";
$php_timezones[] = "Africa/Casablanca";
$php_timezones[] = "Africa/Dar_es_Salaam";
$php_timezones[] = "Africa/Freetown";
$php_timezones[] = "Africa/Juba";
$php_timezones[] = "Africa/Kinshasa";
$php_timezones[] = "Africa/Luanda";
$php_timezones[] = "Africa/Maputo";
$php_timezones[] = "Africa/Monrovia";
$php_timezones[] = "Africa/Nouakchott";
$php_timezones[] = "Africa/Tripoli";
$php_timezones[] = "Africa/Addis_Ababa";
$php_timezones[] = "Africa/Bangui";
$php_timezones[] = "Africa/Brazzaville";
$php_timezones[] = "Africa/Ceuta";
$php_timezones[] = "Africa/Djibouti";
$php_timezones[] = "Africa/Gaborone";
$php_timezones[] = "Africa/Kampala";
$php_timezones[] = "Africa/Lagos";
$php_timezones[] = "Africa/Lubumbashi";
$php_timezones[] = "Africa/Maseru";
$php_timezones[] = "Africa/Nairobi";
$php_timezones[] = "Africa/Ouagadougou";
$php_timezones[] = "Africa/Tunis";
$php_timezones[] = "Africa/Algiers";
$php_timezones[] = "Africa/Banjul";
$php_timezones[] = "Africa/Bujumbura";
$php_timezones[] = "Africa/Conakry";
$php_timezones[] = "Africa/Douala";
$php_timezones[] = "Africa/Harare";
$php_timezones[] = "Africa/Khartoum";
$php_timezones[] = "Africa/Libreville";
$php_timezones[] = "Africa/Lusaka";
$php_timezones[] = "Africa/Mbabane";
$php_timezones[] = "Africa/Ndjamena";
$php_timezones[] = "Africa/Porto-Novo";
$php_timezones[] = "Africa/Windhoek";
$php_timezones[] = "America/Adak";
$php_timezones[] = "America/Araguaina";
$php_timezones[] = "America/Argentina/Jujuy";
$php_timezones[] = "America/Argentina/Salta";
$php_timezones[] = "America/Argentina/Ushuaia";
$php_timezones[] = "America/Bahia";
$php_timezones[] = "America/Belize";
$php_timezones[] = "America/Boise";
$php_timezones[] = "America/Caracas";
$php_timezones[] = "America/Chihuahua";
$php_timezones[] = "America/Curacao";
$php_timezones[] = "America/Denver";
$php_timezones[] = "America/Eirunepe";
$php_timezones[] = "America/Glace_Bay";
$php_timezones[] = "America/Grenada";
$php_timezones[] = "America/Guyana";
$php_timezones[] = "America/Indiana/Indianapolis";
$php_timezones[] = "America/Indiana/Tell_City";
$php_timezones[] = "America/Inuvik";
$php_timezones[] = "America/Kentucky/Louisville";
$php_timezones[] = "America/Lima";
$php_timezones[] = "America/Managua";
$php_timezones[] = "America/Matamoros";
$php_timezones[] = "America/Metlakatla";
$php_timezones[] = "America/Monterrey";
$php_timezones[] = "America/New_York";
$php_timezones[] = "America/North_Dakota/Beulah";
$php_timezones[] = "America/Panama";
$php_timezones[] = "America/Port-au-Prince";
$php_timezones[] = "America/Punta_Arenas";
$php_timezones[] = "America/Regina";
$php_timezones[] = "America/Santiago";
$php_timezones[] = "America/Sitka";
$php_timezones[] = "America/St_Lucia";
$php_timezones[] = "America/Tegucigalpa";
$php_timezones[] = "America/Toronto";
$php_timezones[] = "America/Winnipeg";
$php_timezones[] = "America/Anchorage";
$php_timezones[] = "America/Argentina/Buenos_Aires";
$php_timezones[] = "America/Argentina/La_Rioja";
$php_timezones[] = "America/Argentina/San_Juan";
$php_timezones[] = "America/Aruba";
$php_timezones[] = "America/Bahia_Banderas";
$php_timezones[] = "America/Blanc-Sablon";
$php_timezones[] = "America/Cambridge_Bay";
$php_timezones[] = "America/Cayenne";
$php_timezones[] = "America/Costa_Rica";
$php_timezones[] = "America/Danmarkshavn";
$php_timezones[] = "America/Detroit";
$php_timezones[] = "America/El_Salvador";
$php_timezones[] = "America/Godthab";
$php_timezones[] = "America/Guadeloupe";
$php_timezones[] = "America/Halifax";
$php_timezones[] = "America/Indiana/Knox";
$php_timezones[] = "America/Indiana/Vevay";
$php_timezones[] = "America/Iqaluit";
$php_timezones[] = "America/Kentucky/Monticello";
$php_timezones[] = "America/Los_Angeles";
$php_timezones[] = "America/Manaus";
$php_timezones[] = "America/Mazatlan";
$php_timezones[] = "America/Mexico_City";
$php_timezones[] = "America/Montevideo";
$php_timezones[] = "America/Nipigon";
$php_timezones[] = "America/North_Dakota/Center";
$php_timezones[] = "America/Pangnirtung";
$php_timezones[] = "America/Port_of_Spain";
$php_timezones[] = "America/Rainy_River";
$php_timezones[] = "America/Resolute";
$php_timezones[] = "America/Santo_Domingo";
$php_timezones[] = "America/St_Barthelemy";
$php_timezones[] = "America/St_Thomas";
$php_timezones[] = "America/Thule";
$php_timezones[] = "America/Tortola";
$php_timezones[] = "America/Yakutat";
$php_timezones[] = "America/Anguilla";
$php_timezones[] = "America/Argentina/Catamarca";
$php_timezones[] = "America/Argentina/Mendoza";
$php_timezones[] = "America/Argentina/San_Luis";
$php_timezones[] = "America/Asuncion";
$php_timezones[] = "America/Barbados";
$php_timezones[] = "America/Boa_Vista";
$php_timezones[] = "America/Campo_Grande";
$php_timezones[] = "America/Cayman";
$php_timezones[] = "America/Creston";
$php_timezones[] = "America/Dawson";
$php_timezones[] = "America/Dominica";
$php_timezones[] = "America/Fort_Nelson";
$php_timezones[] = "America/Goose_Bay";
$php_timezones[] = "America/Guatemala";
$php_timezones[] = "America/Havana";
$php_timezones[] = "America/Indiana/Marengo";
$php_timezones[] = "America/Indiana/Vincennes";
$php_timezones[] = "America/Jamaica";
$php_timezones[] = "America/Kralendijk";
$php_timezones[] = "America/Lower_Princes";
$php_timezones[] = "America/Marigot";
$php_timezones[] = "America/Menominee";
$php_timezones[] = "America/Miquelon";
$php_timezones[] = "America/Montserrat";
$php_timezones[] = "America/Nome";
$php_timezones[] = "America/North_Dakota/New_Salem";
$php_timezones[] = "America/Paramaribo";
$php_timezones[] = "America/Porto_Velho";
$php_timezones[] = "America/Rankin_Inlet";
$php_timezones[] = "America/Rio_Branco";
$php_timezones[] = "America/Sao_Paulo";
$php_timezones[] = "America/St_Johns";
$php_timezones[] = "America/St_Vincent";
$php_timezones[] = "America/Thunder_Bay";
$php_timezones[] = "America/Vancouver";
$php_timezones[] = "America/Yellowknife";
$php_timezones[] = "America/Antigua";
$php_timezones[] = "America/Argentina/Cordoba";
$php_timezones[] = "America/Argentina/Rio_Gallegos";
$php_timezones[] = "America/Argentina/Tucuman";
$php_timezones[] = "America/Atikokan";
$php_timezones[] = "America/Belem";
$php_timezones[] = "America/Bogota";
$php_timezones[] = "America/Cancun";
$php_timezones[] = "America/Chicago";
$php_timezones[] = "America/Cuiaba";
$php_timezones[] = "America/Dawson_Creek";
$php_timezones[] = "America/Edmonton";
$php_timezones[] = "America/Fortaleza";
$php_timezones[] = "America/Grand_Turk";
$php_timezones[] = "America/Guayaquil";
$php_timezones[] = "America/Hermosillo";
$php_timezones[] = "America/Indiana/Petersburg";
$php_timezones[] = "America/Indiana/Winamac";
$php_timezones[] = "America/Juneau";
$php_timezones[] = "America/La_Paz";
$php_timezones[] = "America/Maceio";
$php_timezones[] = "America/Martinique";
$php_timezones[] = "America/Merida";
$php_timezones[] = "America/Moncton";
$php_timezones[] = "America/Nassau";
$php_timezones[] = "America/Noronha";
$php_timezones[] = "America/Ojinaga";
$php_timezones[] = "America/Phoenix";
$php_timezones[] = "America/Puerto_Rico";
$php_timezones[] = "America/Recife";
$php_timezones[] = "America/Santarem";
$php_timezones[] = "America/Scoresbysund";
$php_timezones[] = "America/St_Kitts";
$php_timezones[] = "America/Swift_Current";
$php_timezones[] = "America/Tijuana";
$php_timezones[] = "America/Whitehorse";
$php_timezones[] = "Antarctica/Casey";
$php_timezones[] = "Antarctica/Mawson";
$php_timezones[] = "Antarctica/Syowa";
$php_timezones[] = "Antarctica/Davis";
$php_timezones[] = "Antarctica/McMurdo";
$php_timezones[] = "Antarctica/Troll";
$php_timezones[] = "Antarctica/DumontDUrville";
$php_timezones[] = "Antarctica/Palmer";
$php_timezones[] = "Antarctica/Vostok";
$php_timezones[] = "Antarctica/Macquarie";
$php_timezones[] = "Antarctica/Rothera";
$php_timezones[] = "Arctic/Longyearbyen";
$php_timezones[] = "Asia/Aden";
$php_timezones[] = "Asia/Aqtau";
$php_timezones[] = "Asia/Baghdad";
$php_timezones[] = "Asia/Barnaul";
$php_timezones[] = "Asia/Chita";
$php_timezones[] = "Asia/Dhaka";
$php_timezones[] = "Asia/Famagusta";
$php_timezones[] = "Asia/Hong_Kong";
$php_timezones[] = "Asia/Jayapura";
$php_timezones[] = "Asia/Karachi";
$php_timezones[] = "Asia/Krasnoyarsk";
$php_timezones[] = "Asia/Macau";
$php_timezones[] = "Asia/Muscat";
$php_timezones[] = "Asia/Omsk";
$php_timezones[] = "Asia/Pyongyang";
$php_timezones[] = "Asia/Riyadh";
$php_timezones[] = "Asia/Shanghai";
$php_timezones[] = "Asia/Tashkent";
$php_timezones[] = "Asia/Tokyo";
$php_timezones[] = "Asia/Ust-Nera";
$php_timezones[] = "Asia/Yangon";
$php_timezones[] = "Asia/Almaty";
$php_timezones[] = "Asia/Aqtobe";
$php_timezones[] = "Asia/Bahrain";
$php_timezones[] = "Asia/Beirut";
$php_timezones[] = "Asia/Choibalsan";
$php_timezones[] = "Asia/Dili";
$php_timezones[] = "Asia/Gaza";
$php_timezones[] = "Asia/Hovd";
$php_timezones[] = "Asia/Jerusalem";
$php_timezones[] = "Asia/Kathmandu";
$php_timezones[] = "Asia/Kuala_Lumpur";
$php_timezones[] = "Asia/Magadan";
$php_timezones[] = "Asia/Nicosia";
$php_timezones[] = "Asia/Oral";
$php_timezones[] = "Asia/Qatar";
$php_timezones[] = "Asia/Sakhalin";
$php_timezones[] = "Asia/Singapore";
$php_timezones[] = "Asia/Tbilisi";
$php_timezones[] = "Asia/Tomsk";
$php_timezones[] = "Asia/Vientiane";
$php_timezones[] = "Asia/Yekaterinburg";
$php_timezones[] = "Asia/Amman";
$php_timezones[] = "Asia/Ashgabat";
$php_timezones[] = "Asia/Baku";
$php_timezones[] = "Asia/Bishkek";
$php_timezones[] = "Asia/Colombo";
$php_timezones[] = "Asia/Dubai";
$php_timezones[] = "Asia/Hebron";
$php_timezones[] = "Asia/Irkutsk";
$php_timezones[] = "Asia/Kabul";
$php_timezones[] = "Asia/Khandyga";
$php_timezones[] = "Asia/Kuching";
$php_timezones[] = "Asia/Makassar";
$php_timezones[] = "Asia/Novokuznetsk";
$php_timezones[] = "Asia/Phnom_Penh";
$php_timezones[] = "Asia/Qostanay";
$php_timezones[] = "Asia/Samarkand";
$php_timezones[] = "Asia/Srednekolymsk";
$php_timezones[] = "Asia/Tehran";
$php_timezones[] = "Asia/Ulaanbaatar";
$php_timezones[] = "Asia/Vladivostok";
$php_timezones[] = "Asia/Yerevan";
$php_timezones[] = "Asia/Anadyr";
$php_timezones[] = "Asia/Atyrau";
$php_timezones[] = "Asia/Bangkok";
$php_timezones[] = "Asia/Brunei";
$php_timezones[] = "Asia/Damascus";
$php_timezones[] = "Asia/Dushanbe";
$php_timezones[] = "Asia/Ho_Chi_Minh";
$php_timezones[] = "Asia/Jakarta";
$php_timezones[] = "Asia/Kamchatka";
$php_timezones[] = "Asia/Kolkata";
$php_timezones[] = "Asia/Kuwait";
$php_timezones[] = "Asia/Manila";
$php_timezones[] = "Asia/Novosibirsk";
$php_timezones[] = "Asia/Pontianak";
$php_timezones[] = "Asia/Qyzylorda";
$php_timezones[] = "Asia/Seoul";
$php_timezones[] = "Asia/Taipei";
$php_timezones[] = "Asia/Thimphu";
$php_timezones[] = "Asia/Urumqi";
$php_timezones[] = "Asia/Yakutsk";
$php_timezones[] = "Atlantic/Azores";
$php_timezones[] = "Atlantic/Faroe";
$php_timezones[] = "Atlantic/St_Helena";
$php_timezones[] = "Atlantic/Bermuda";
$php_timezones[] = "Atlantic/Madeira";
$php_timezones[] = "Atlantic/Stanley";
$php_timezones[] = "Atlantic/Canary";
$php_timezones[] = "Atlantic/Reykjavik";
$php_timezones[] = "Atlantic/Cape_Verde";
$php_timezones[] = "Atlantic/South_Georgia";
$php_timezones[] = "Australia/Adelaide";
$php_timezones[] = "Australia/Darwin";
$php_timezones[] = "Australia/Lord_Howe";
$php_timezones[] = "Australia/Brisbane";
$php_timezones[] = "Australia/Eucla";
$php_timezones[] = "Australia/Melbourne";
$php_timezones[] = "Australia/Broken_Hill";
$php_timezones[] = "Australia/Hobart";
$php_timezones[] = "Australia/Perth";
$php_timezones[] = "Europe/Amsterdam";
$php_timezones[] = "Europe/Belgrade";
$php_timezones[] = "Europe/Bucharest";
$php_timezones[] = "Europe/Copenhagen";
$php_timezones[] = "Europe/Helsinki";
$php_timezones[] = "Europe/Kaliningrad";
$php_timezones[] = "Europe/Ljubljana";
$php_timezones[] = "Europe/Malta";
$php_timezones[] = "Europe/Moscow";
$php_timezones[] = "Europe/Prague";
$php_timezones[] = "Europe/San_Marino";
$php_timezones[] = "Europe/Skopje";
$php_timezones[] = "Europe/Tirane";
$php_timezones[] = "Europe/Vatican";
$php_timezones[] = "Europe/Warsaw";
$php_timezones[] = "Europe/Andorra";
$php_timezones[] = "Europe/Berlin";
$php_timezones[] = "Europe/Budapest";
$php_timezones[] = "Europe/Dublin";
$php_timezones[] = "Europe/Isle_of_Man";
$php_timezones[] = "Europe/Kiev";
$php_timezones[] = "Europe/London";
$php_timezones[] = "Europe/Mariehamn";
$php_timezones[] = "Europe/Oslo";
$php_timezones[] = "Europe/Riga";
$php_timezones[] = "Europe/Sarajevo";
$php_timezones[] = "Europe/Sofia";
$php_timezones[] = "Europe/Ulyanovsk";
$php_timezones[] = "Europe/Vienna";
$php_timezones[] = "Europe/Zagreb";
$php_timezones[] = "Europe/Astrakhan";
$php_timezones[] = "Europe/Bratislava";
$php_timezones[] = "Europe/Busingen";
$php_timezones[] = "Europe/Gibraltar";
$php_timezones[] = "Europe/Istanbul";
$php_timezones[] = "Europe/Kirov";
$php_timezones[] = "Europe/Luxembourg";
$php_timezones[] = "Europe/Minsk";
$php_timezones[] = "Europe/Paris";
$php_timezones[] = "Europe/Rome";
$php_timezones[] = "Europe/Saratov";
$php_timezones[] = "Europe/Stockholm";
$php_timezones[] = "Europe/Uzhgorod";
$php_timezones[] = "Europe/Vilnius";
$php_timezones[] = "Europe/Zaporozhye";
$php_timezones[] = "Europe/Athens";
$php_timezones[] = "Europe/Brussels";
$php_timezones[] = "Europe/Chisinau";
$php_timezones[] = "Europe/Guernsey";
$php_timezones[] = "Europe/Jersey";
$php_timezones[] = "Europe/Lisbon";
$php_timezones[] = "Europe/Madrid";
$php_timezones[] = "Europe/Monaco";
$php_timezones[] = "Europe/Podgorica";
$php_timezones[] = "Europe/Samara";
$php_timezones[] = "Europe/Simferopol";
$php_timezones[] = "Europe/Tallinn";
$php_timezones[] = "Europe/Vaduz";
$php_timezones[] = "Europe/Volgograd";
$php_timezones[] = "Europe/Zurich";
$php_timezones[] = "Indian/Antananarivo";
$php_timezones[] = "Indian/Comoro";
$php_timezones[] = "Indian/Mauritius";
$php_timezones[] = "Indian/Chagos";
$php_timezones[] = "Indian/Kerguelen";
$php_timezones[] = "Indian/Mayotte";
$php_timezones[] = "Indian/Christmas";
$php_timezones[] = "Indian/Mahe";
$php_timezones[] = "Indian/Reunion";
$php_timezones[] = "Pacific/Apia";
$php_timezones[] = "Pacific/Chuuk";
$php_timezones[] = "Pacific/Fakaofo";
$php_timezones[] = "Pacific/Gambier";
$php_timezones[] = "Pacific/Kiritimati";
$php_timezones[] = "Pacific/Marquesas";
$php_timezones[] = "Pacific/Norfolk";
$php_timezones[] = "Pacific/Pitcairn";
$php_timezones[] = "Pacific/Saipan";
$php_timezones[] = "Pacific/Wake";
$php_timezones[] = "Pacific/Auckland";
$php_timezones[] = "Pacific/Easter";
$php_timezones[] = "Pacific/Fiji";
$php_timezones[] = "Pacific/Guadalcanal";
$php_timezones[] = "Pacific/Kosrae";
$php_timezones[] = "Pacific/Midway";
$php_timezones[] = "Pacific/Noumea";
$php_timezones[] = "Pacific/Pohnpei";
$php_timezones[] = "Pacific/Tahiti";
$php_timezones[] = "Pacific/Wallis";
$php_timezones[] = "Pacific/Bougainville";
$php_timezones[] = "Pacific/Efate";
$php_timezones[] = "Pacific/Funafuti";
$php_timezones[] = "Pacific/Guam";
$php_timezones[] = "Pacific/Kwajalein";
$php_timezones[] = "Pacific/Nauru";
$php_timezones[] = "Pacific/Pago_Pago";
$php_timezones[] = "Pacific/Port_Moresby";
$php_timezones[] = "Pacific/Tarawa";
$php_timezones[] = "Pacific/Chatham";
$php_timezones[] = "Pacific/Enderbury";
$php_timezones[] = "Pacific/Galapagos";
$php_timezones[] = "Pacific/Honolulu";
$php_timezones[] = "Pacific/Majuro";
$php_timezones[] = "Pacific/Niue";
$php_timezones[] = "Pacific/Palau";
$php_timezones[] = "Pacific/Rarotonga";
$php_timezones[] = "Pacific/Tongatapu";



$_SESSION['_COLOR_NAME'] = $color_name;

?>