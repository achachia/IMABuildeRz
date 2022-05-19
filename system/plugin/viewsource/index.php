<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

error_reporting(0);


session_start();

if (!isset($_SESSION['CURRENT_APP_PREFIX']))
{
    die();
}

$theme = $_SESSION['CODE_CODEMIRROR_THEME'];

// TODO: PAGE

if (isset($_GET['page']))
{
    if (isset($_GET['type']))
    {
        $page = basename($_GET['page']);
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];

        switch ($_GET['type'])
        {
                // TODO: PAGE --|-- TS
            case 'ts':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/pages/' . $page . '/' . $page . '.page.ts');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true,mode: "application/typescript"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

                // TODO: PAGE --|-- HTML
            case 'html':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/pages/' . $page . '/' . $page . '.page.html');
                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/xml/xml.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

                // TODO: PAGE --|-- SCSS
            case 'scss':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/pages/' . $page . '/' . $page . '.page.scss');
                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/css/css.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true,mode: "text/x-scss"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;
        }
    }
}

// TODO: PIPE
if (isset($_GET['pipe']))
{
    if (isset($_GET['type']))
    {
        $pipe = basename($_GET['pipe']);
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];

        switch ($_GET['type'])
        {
            case 'ts':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/pipes/' . $pipe . '/' . $pipe . '.pipe.ts');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

        }
    }
}

// TODO: SERVICE
if (isset($_GET['service']))
{
    if (isset($_GET['type']))
    {
        $service = basename($_GET['service']);
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        switch ($_GET['type'])
        {
            case 'ts':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/services/' . $service . '/' . $service . '.service.ts');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

        }
    }
}

// TODO: DIRECTIVE
if (isset($_GET['directive']))
{
    if (isset($_GET['type']))
    {
        $directive = basename($_GET['directive']);
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        switch ($_GET['type'])
        {
            case 'ts':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/directives/' . $directive . '/' . $directive . '.directive.ts');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

        }
    }
}
// TODO: CONFIG
if (isset($_GET['config']))
{
    $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
    $filename = realpath('../../../outputs/' . $app_prefix . '/config.xml');
    echo '<!DOCTYPE HTML>';
    echo '<html>';
    echo '<head>';
    echo '<meta http-equiv="content-type" content="text/html" />';
    echo '<meta name="author" content="Jasman" />';
    echo '<title>View Source Code</title>';
    echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
    echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
    echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
    echo '</head>';
    echo '<body>';
    echo '<textarea id="code" name="code" rows="5">';
    echo htmlentities(file_get_contents($filename));
    echo '</textarea>';
    echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
    echo '<script src="../../../templates/default/plugins/codemirror/mode/xml/xml.js"></script>';
    echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
    echo '<script>';
    echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true});';
    echo '</script>';
    echo '</body>';
    echo '</html>';
}

// TODO: GLOBAL
if (isset($_GET['globals']))
{
    if ($_GET['globals'] == 'component')
    {
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/app.component.ts');
        echo '<!DOCTYPE HTML>';
        echo '<html>';
        echo '<head>';
        echo '<meta http-equiv="content-type" content="text/html" />';
        echo '<meta name="author" content="Jasman" />';
        echo '<title>View Source Code</title>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
        echo '</head>';
        echo '<body>';
        echo '<textarea id="code" name="code" rows="5">';
        echo htmlentities(file_get_contents($filename));
        echo '</textarea>';
        echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
        echo '<script>';
        echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
        echo '</script>';
        echo '</body>';
        echo '</html>';
    } else
    {
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/app.module.ts');
        echo '<!DOCTYPE HTML>';
        echo '<html>';
        echo '<head>';
        echo '<meta http-equiv="content-type" content="text/html" />';
        echo '<meta name="author" content="Jasman" />';
        echo '<title>View Source Code</title>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
        echo '</head>';
        echo '<body>';
        echo '<textarea id="code" name="code" rows="5">';
        echo htmlentities(file_get_contents($filename));
        echo '</textarea>';
        echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
        echo '<script>';
        echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
        echo '</script>';
        echo '</body>';
        echo '</html>';
    }
}

// TODO: THEME
if (isset($_GET['theme']))
{
    $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];

    // TODO: THEME --|-- VARIABLES
    if ($_GET['theme'] == 'variables')
    {
        $filename = realpath('../../../outputs/' . $app_prefix . '/src/theme/variables.scss');
        echo '<!DOCTYPE HTML>';
        echo '<html>';
        echo '<head>';
        echo '<meta http-equiv="content-type" content="text/html" />';
        echo '<meta name="author" content="Jasman" />';
        echo '<title>View Source Code</title>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
        echo '</head>';
        echo '<body>';
        echo '<textarea id="code" name="code" rows="5">';
        echo htmlentities(file_get_contents($filename));
        echo '</textarea>';
        echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/mode/css/css.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
        echo '<script>';
        echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true,mode: "text/x-scss"});';
        echo '</script>';
        echo '</body>';
        echo '</html>';
    }

    // TODO: THEME --|-- GLOBAL
    if ($_GET['theme'] == 'global')
    {

        $filename = realpath('../../../outputs/' . $app_prefix . '/src/global.scss');
        echo '<!DOCTYPE HTML>';
        echo '<html>';
        echo '<head>';
        echo '<meta http-equiv="content-type" content="text/html" />';
        echo '<meta name="author" content="Jasman" />';
        echo '<title>View Source Code</title>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
        echo '</head>';
        echo '<body>';
        echo '<textarea id="code" name="code" rows="5">';
        echo htmlentities(file_get_contents($filename));
        echo '</textarea>';
        echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/mode/css/css.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
        echo '<script>';
        echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true,mode: "text/x-scss"});';
        echo '</script>';
        echo '</body>';
        echo '</html>';


    }

    // TODO: THEME --|-- APP
    if ($_GET['theme'] == 'app')
    {
        $filename = realpath('../../../outputs/' . $app_prefix . '/src/app/app.scss');
        echo '<!DOCTYPE HTML>';
        echo '<html>';
        echo '<head>';
        echo '<meta http-equiv="content-type" content="text/html" />';
        echo '<meta name="author" content="Jasman" />';
        echo '<title>View Source Code</title>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
        echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
        echo '</head>';
        echo '<body>';
        echo '<textarea id="code" name="code" rows="5">';
        echo htmlentities(file_get_contents($filename));
        echo '</textarea>';
        echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/mode/css/css.js"></script>';
        echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
        echo '<script>';
        echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true,mode: "text/x-scss"});';
        echo '</script>';
        echo '</body>';
        echo '</html>';
    }
}


// TODO: INDEX
if (isset($_GET['index']))
{
    $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
    $filename = realpath('../../../outputs/' . $app_prefix . '/src/index.html');
    echo '<!DOCTYPE HTML>';
    echo '<html>';
    echo '<head>';
    echo '<meta http-equiv="content-type" content="text/html" />';
    echo '<meta name="author" content="Jasman" />';
    echo '<title>View Source Code</title>';
    echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
    echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
    echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>';
    echo '</head>';
    echo '<body>';
    echo '<textarea id="code" name="code" rows="5">';
    echo htmlentities(file_get_contents($filename));
    echo '</textarea>';
    echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
    echo '<script src="../../../templates/default/plugins/codemirror/mode/xml/xml.js"></script>';
    echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
    echo '<script>';
    echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"' . $theme . '",fullScreen: true});';
    echo '</script>';
    echo '</body>';
    echo '</html>';
}


// TODO: ENVIRONMENT
if (isset($_GET['environment']))
{
    if (isset($_GET['type']))
    {

        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        switch ($_GET['environment'])
        {
            case 'development':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/environments/environment.ts');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

        }
        switch ($_GET['environment'])
        {
            case 'production':
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/environments/environment.prod.ts');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/typescript"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

        }
    }
}


// TODO: LOCALIZAYION
if (isset($_GET['localization']))
{
    if (isset($_GET['type']))
    {
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        switch ($_GET['type'])
        {
            case 'json':
                $localization = basename($_GET['localization']);
                $filename = realpath('../../../outputs/' . $app_prefix . '/src/assets/i18n/' . $localization . '.json');

                echo '<!DOCTYPE HTML>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="content-type" content="text/html" />';
                echo '<meta name="author" content="Jasman" />';
                echo '<title>View Source Code</title>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/lib/codemirror.css"/>';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />';
                echo '<link rel="stylesheet" href="../../../templates/default/plugins/codemirror/theme/seti.css"/>';
                echo '</head>';
                echo '<body>';
                echo '<textarea id="code" name="code" rows="5">';
                echo htmlentities(file_get_contents($filename));
                echo '</textarea>';
                echo '<script src="../../../templates/default/plugins/codemirror/lib/codemirror.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>';
                echo '<script src="../../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>';
                echo '<script>';
                echo 'var editor = CodeMirror.fromTextArea(document.getElementById("code"),{lineNumbers: true, theme:"seti",fullScreen: true,mode: "application/x-json"});';
                echo '</script>';
                echo '</body>';
                echo '</html>';
                break;

        }

    }
}


 

?>