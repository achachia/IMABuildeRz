<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 
 * @package No project loaded
 */

session_start();
if (!isset($_SESSION['TEST-CODE']))
{
    $_SESSION['TEST-CODE'] = '';
}
$tags = null;
$tags .= '<!DOCTYPE html>';
$tags .= '<html lang="en">';
$tags .= '<head>';
$tags .= '<meta charset="utf-8" />';
$tags .= '<title>Ionic Components</title>';
$tags .= '<base href="/" />';
$tags .= '<meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />';
$tags .= '<meta name="format-detection" content="telephone=no" />';
$tags .= '<meta name="msapplication-tap-highlight" content="no" />';
$tags .= '<link rel="icon" type="image/png" href="assets/icon/logo.png" />';
$tags .= '<meta name="apple-mobile-web-app-capable" content="yes" />';
$tags .= '<meta name="apple-mobile-web-app-status-bar-style" content="black" />';
$tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ionic/core/css/ionic.bundle.css"/>';
$tags .= '</head>';
$tags .= '<body>';

$tags .= '<ion-app>';
$tags .= '<ion-header>';
$tags .= '<ion-toolbar color="danger">';
$tags .= '<ion-title>Ionic Components</ion-title>';
$tags .= '</ion-toolbar>';
$tags .= '</ion-header>';

$tags .= '<ion-content>';
$tags .= $_SESSION['TEST-CODE'];
$tags .= '</ion-content>';
$tags .= '</ion-app>';

$tags .= '<script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>';
$tags .= '<script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>';
$tags .= '<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@4.7.4/dist/ionicons/ionicons.esm.js"></script>';
$tags .= '<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@4.7.4/dist/ionicons/ionicons.js"></script>';
$tags .= '</body>';
$tags .= '</html>';

echo $tags;

?>