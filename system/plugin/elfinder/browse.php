<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['CURRENT_APP_PREFIX']))
{
    $_SESSION['CURRENT_APP_PREFIX'] = '';
}
if($_SESSION['CURRENT_APP_PREFIX'] == '')
{
    die("please activate IMA Project before.");
    exit(0);
}
if($_SESSION['JSM_DEMO'] == true){
die("Demo version should not use browser file");
    exit(0);
}

require './autoload.php';
elFinder::$netDrivers['ftp'] = 'FTP';
function access($attr,$path,$data,$volume,$isDir,$relpath)
{
    $basename = basename($path);
    return $basename[0] === '.'
        && strlen($relpath) !== 1
        ?!($attr == 'read' || $attr == 'write')
        : null;
}
$app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
$opts = array(
        'debug' => true,
        'roots' => array(
            array(
                    'driver' => 'LocalFileSystem',
                    'path' => '../../../outputs/'.$app_prefix.'/src/',
                    'URL' => (dirname($_SERVER['PHP_SELF']).'../../../outputs/'.$app_prefix.'/src/'),
                    'tmbPath' => '../../../outputs/'.$app_prefix.'/.thumbnail/',
                    'tmbURL' => (dirname($_SERVER['PHP_SELF']).'../../../../outputs/'.$app_prefix.'/.thumbnail/'),
                    'trashHash' => 't1_Lw',
                    'winHashFix' => DIRECTORY_SEPARATOR !== '/',
                    'uploadDeny' => array('all'),
                    'uploadAllow' => array('image','text/plain'),
                    'uploadOrder' => array('deny','allow'),
                    'accessControl' => 'access'
            ),
            array(
                    'id' => '1',
                    'driver' => 'Trash',
                    'path' => '../../../outputs/'.$app_prefix.'/.trash/',
                    'tmbURL' => (dirname($_SERVER['PHP_SELF']).'../../../outputs/'.$app_prefix.'/.trash/.thumbnail'),
                    'winHashFix' => DIRECTORY_SEPARATOR !== '/',
                    'uploadDeny' => array('all'),
                    'uploadAllow' => array('image','text/plain'),
                    'uploadOrder' => array('deny','allow'),
                    'accessControl' => 'access',
            )));
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();