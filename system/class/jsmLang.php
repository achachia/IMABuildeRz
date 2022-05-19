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

$terms[] = 'Additional Directives';
$terms[] = 'Components';
$terms[] = '(IMAB) Directives';
$terms[] = 'Directives';
$terms[] = 'directives';
$terms[] = 'Directive';
$terms[] = 'Pipes';
$terms[] = 'Pipe';
$terms[] = 'Ionic';
$terms[] = 'Cordova';
$terms[] = 'Services';
$terms[] = 'Service';
$terms[] = 'Ionic Web Component';
$terms[] = 'Admob';
$terms[] = 'Adunit';
$terms[] = 'Database';
$terms[] = 'padding';
$terms[] = 'margin';
$terms[] = 'ion-content';
$terms[] = 'RTL';
$terms[] = 'LTR';
$terms[] = 'Storage';
$terms[] = 'storage';
$terms[] = 'Capasitor';
$terms[] = 'capasitor';
$terms[] = 'JSON objects';
$terms[] = 'StatusBar';
$terms[] = 'Statusbar';
$terms[] = 'platform';
$terms[] = 'Client ID';
$terms[] = 'Function';
$terms[] = 'auth basic';
$terms[] = 'password';
$terms[] = 'consumer secret';
$terms[] = 'Google Project Number';
$terms[] = 'Firebase Console';
$terms[] = 'Sender ID';
$terms[] = 'Cloud Messaging';
$terms[] = 'consumer key';
$terms[] = 'Fuctions';


if (file_exists(JSM_PATH . '/languages/' . JSM_LANG . '.php'))
{
    include_once JSM_PATH . '/languages/' . JSM_LANG . '.php';
}

function __e($text)
{

    global $lang;
    global $terms;

    $var = sha1($text);

    if (JSM_DEBUG == true)
    {
        //file_put_contents("../imalang/lang.txt", '$lang["' . $var . '"]["loc"] = \'' . $_SERVER["REQUEST_URI"] . '\';' . "\r\n", FILE_APPEND);
        //file_put_contents("../imalang/lang.txt", '$lang["' . $var . '"]["text"] = \'' . addslashes(str_replace("\r\n", " ", $text)) . '\';' . "\r\n", FILE_APPEND);
    }

    if (isset($lang[$var]))
    {
        $nice_text = $lang[$var];
    } else
    {
 
            //$nice_text = '' . $text . '(<small style="font-size: 7px;font-style: normal !important;">' . $var . '</small>';
            $nice_text = $text;
        
    }
 
    foreach ($terms as $term)
    {
        $nice_text = str_replace('' . $term . '', '<ins>' . $term . '</ins>', $nice_text);
    }
    return $nice_text;
}

?>