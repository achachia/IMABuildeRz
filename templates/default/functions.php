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
if (!defined('JSM_CORE_VERSION'))
{
    define('JSM_CORE_VERSION', 'error');
}

$OS = new jsmSystem();
$os_type = $OS->getOS();
$app_prefix = '';
if (isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    $app_prefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];
}
$app_path = realpath(JSM_PATH . '/outputs/' . $app_prefix);
$cmd_run_emulator = null;
$cmd_run_emulator .= '<p class="small">If there are no changes to the emulator, try to force quit kill a running command, you can use <kbd>Ctrl + C</kbd>. Then run the emulator again, by typing the command:</p>';
if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    switch ($os_type)
    {
        case 1:
            $cmd_run_emulator .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $cmd_run_emulator .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
            break;
        case 3:
            //linux
            $cmd_run_emulator .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $cmd_run_emulator .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
    }
} else
{
    $dir_path = realpath(JSM_PATH . '/outputs/');
    $app_path = realpath(JSM_PATH . '/outputs/' . $app_prefix);

    $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
    $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';


    $cmd_run_emulator .= '<p class="small">' . __e('Copy the output code into your ionic project') . '</p>';
    switch ($os_type)
    {
        case 1:
            $cmd_run_emulator .= '<p><pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre></p>';
            $cmd_run_emulator .= '<p><pre class="shell">' . $copy_cmd . '</pre></p>';
            break;
        case 2:
            //window
            $cmd_run_emulator .= '<p><pre class="shell">cd /D "' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '\\' . $app_prefix . '"</pre></p>';
            $cmd_run_emulator .= '<p><pre class="shell">' . $xcopy_cmd . '</pre></p>';
            break;
        case 3:
            //linux
            $cmd_run_emulator .= '<p><pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre></p>';
            $cmd_run_emulator .= '<p><pre class="shell">' . $copy_cmd . '</pre></p>';
            break;
        case 4:
            //osx
            $cmd_run_emulator .= '<p><pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER_OSX . '/' . $app_prefix . '"</pre></p>';
            $cmd_run_emulator .= '<p><pre class="shell">' . $copy_cmd . '</pre></p>';
            break;
    }

}

$cmd_run_emulator .= '<br/><p class="small">' . __e('Then run ionic emulator') . '</p>';
$cmd_run_emulator .= '<pre class="shell">ionic serve --port ' . JSM_IONIC_EMULATOR_PORT . ' --lab-port ' . JSM_IONIC_LAB_PORT . ' --dev-logger-port ' . JSM_IONIC_DEV_LOGGER_PORT . ' --lab --external --consolelogs</pre>';
$cmd_run_emulator .= '<p>' . __e('or ') . '</p>';
$cmd_run_emulator .= '<pre class="shell">ionic serve --external --consolelogs</pre>';


if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    if (!file_exists($app_path . '/ionic.config.json'))
    {
        $cmd_run_emulator = '<div class="alert alert-danger"><h4>Ionic-CLI</h4><p>' . __e('You can\'t run an emulator, because an ionic project hasn\'t been created. Create an ionic project now! click <a href="./?p=1.start-compiler">here</a> ') . '</p></div>';
    }
}


if (!isset($_SESSION['CURRENT_APP_PREFIX']))
{
    $_SESSION['CURRENT_APP_PREFIX'] = null;
}
if ($_SESSION['CURRENT_APP_PREFIX'] != null)
{
    $app_prefix = 'Undefined';
    $app_name = 'Undefined';
    $app_icon = 'times';
    $app_version = '00.00.00';
    $app_color = 'white';
    if (isset($_SESSION['CURRENT_APP']['apps']))
    {
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        $app_icon = $_SESSION['CURRENT_APP']['apps']['app-icon'];
        $app_name = $_SESSION['CURRENT_APP']['apps']['app-name'];
        $app_version = $_SESSION['CURRENT_APP']['apps']['app-version'];
        $app_color = $_SESSION['CURRENT_APP']['apps']['app-color'];
    }
} else
{
    $app_prefix = 'Undefined';
    $app_name = 'Undefined';
    $app_icon = 'times';
    $app_version = '00.00.00';
    $app_color = 'white';
}


if (JSM_IONIC_EMULATOR == true)
{
    $emulator_link_android = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT . '/?ionic:mode=md&ionic:persistConfig=true&ionic:_forceStatusbarPadding=false&' . time();
    $emulator_link_ios = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT . '/?ionic:mode=ios&ionic:persistConfig=true&ionic:_forceStatusbarPadding=false&' . time();
    if ($_GET['p'] == 'addons')
    {
        if (isset($_GET['page-target']))
        {
            $page_prefix = str_replace(array('-detail', 'core'), '', $_GET['page-target']);

            $emulator_link_android = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT . '/' . $page_prefix . '?ionic:mode=md&ionic:persistConfig=true&ionic:_forceStatusbarPadding=false&' . time();
            $emulator_link_ios = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT . '/' . $page_prefix . '?ionic:mode=ios&ionic:persistConfig=true&ionic:_forceStatusbarPadding=false&' . time();
        }
    }
    if ($_GET['p'] == 'pages')
    {
        if (isset($_GET['page-name']))
        {
            $page_prefix = str_replace(array('core', '-detail'), '', $_GET['page-name']);
            $emulator_link_android = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT . '/' . $page_prefix . '?ionic:mode=md&ionic:persistConfig=true&ionic:_forceStatusbarPadding=false&' . time();
            $emulator_link_ios = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT . '/' . $page_prefix . '?ionic:mode=ios&ionic:persistConfig=true&ionic:_forceStatusbarPadding=false&' . time();
        }
    }
} else
{
    $emulator_link_android = './outputs/' . $app_prefix . '/www/';
    $emulator_link_ios = './outputs/' . $app_prefix . '/www/';
}

$lab_link = 'http://localhost:' . JSM_IONIC_LAB_PORT;

$emulator_link = 'http://localhost:' . JSM_IONIC_EMULATOR_PORT;


$new_colors = array();
$color_names = $_SESSION['_COLOR_NAME'];
foreach ($color_names as $var_color)
{
    $var_name = $var_color['value'];
    $value = $var_color['default'];
    if ($value !== 'undefined')
    {
        $new_colors[$var_name] = array('val' => $value, 'var' => $var_name);
    }
}


if (isset($_SESSION['CURRENT_APP']['themes']['color']))
{
    $current_color = $_SESSION['CURRENT_APP']['themes']['color'];

    $_new_colors = array();
    foreach ($new_colors as $new_color)
    {
        if (isset($current_color[$new_color['var']]))
        {
            $_new_colors[] = array('val' => $current_color[$new_color['var']], 'var' => $new_color['var']);
        } else
        {
            $_new_colors[] = array('val' => $new_color['val'], 'var' => $new_color['var']);
        }
    }
    $new_colors = $_new_colors;
}


$dynamic_css = null;
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . 'option[value=\'' . $new_color['var'] . '\']{background:' . trim($new_color['val']) . ';color:#ffffff}';
    }
}
$dynamic_css .= "\r\n";
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . '.box-ima-' . $new_color['var'] . '{border: 1px solid ' . $new_color['val'] . '}';
    }
}
$dynamic_css .= "\r\n";
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . '.box.box-solid.box-ima-' . $new_color['var'] . ' > .box-header {color: #fff; background: ' . $new_color['val'] . '; background-color: ' . $new_color['val'] . '}';
    }
}

$dynamic_css .= "\r\n";
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . '.ima-bg-' . $new_color['var'] . '{background: ' . $new_color['val'] . ';color:#fff !important}';
    }
}

$dynamic_css .= "\r\n";
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . '.ima-co-' . $new_color['var'] . '{color: ' . $new_color['val'] . '}';
    }
}

$dynamic_css .= "\r\n";
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . '*[data-color="' . $new_color['var'] . '"]{background: ' . $new_color['val'] . ';color:#fff}';
    }
}

$dynamic_css .= "\r\n";
foreach ($new_colors as $new_color)
{
    if ($new_color['var'] !== 'undefined')
    {
        $dynamic_css .= "\r\n\t" . '.ima-btn-' . $new_color['var'] . '{background: ' . $new_color['val'] . ';border-color:' . $new_color['val'] . '}';
        $dynamic_css .= "\r\n\t" . '.ima-btn-' . $new_color['var'] . ':hover{background: ' . $new_color['val'] . ';opacity:0.5;border-color:' . $new_color['val'] . '}';
    }
}

$rand_color[] = 'red';
$rand_color[] = 'blue';
$rand_color[] = 'green';
$rand_color[] = 'purple';

require_once JSM_PATH . '/system/ionic_tags.php';
$code_ionic_tags = null;

$code_ionic_tags .= 'var ionic_tags = {' . "\r\n";
foreach ($ionic_tags as $ionic_tag)
{
    $code_ionic_tags .= "\t" . '"' . $ionic_tag['tag'] . '"' . ':{' . "\r\n";
    $code_ionic_tags .= "\t\t" . 'attrs:{' . "\r\n";
    if (isset($ionic_tag['props']))
    {
        foreach ($ionic_tag['props'] as $props)
        {
            if (isset($props['value'][0]))
            {
                $code_ionic_tags .= "\t\t\t" . '"' . $props['name'] . '"' . ':["' . implode('","', $props['value']) . '"],' . "\r\n";
                $code_ionic_tags .= "\t\t\t" . '"[' . $props['name'] . ']"' . ':[],' . "\r\n";
            } else
            {
                $code_ionic_tags .= "\t\t\t" . '"' . $props['name'] . '"' . ':[],' . "\r\n";
                $code_ionic_tags .= "\t\t\t" . '"[' . $props['name'] . ']"' . ':[],' . "\r\n";
            }
        }

        $code_ionic_tags .= "\t\t\t" . '"(click)"' . ':[],' . "\r\n";
        $code_ionic_tags .= "\t\t\t" . '"*ngIf"' . ':[],' . "\r\n";
        $code_ionic_tags .= "\t\t\t" . '"*ngFor"' . ':[],' . "\r\n";
        $code_ionic_tags .= "\t\t\t" . '"*ngSwitchCase"' . ':[],' . "\r\n";
        $code_ionic_tags .= "\t\t\t" . '"[routerDirection]"' . ':[],' . "\r\n";
        $code_ionic_tags .= "\t\t\t" . '"[ngSwitch]"' . ':[],' . "\r\n";


    }
    $code_ionic_tags .= "\t\t" . '},' . "\r\n";
    $code_ionic_tags .= "\t" . '},' . "\r\n";
}
$code_ionic_tags .= '}' . "\r\n";

$path_output = null;
if (isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    $path_output = 'var dir_output = "./outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/";' . "\r\n";
}

$code_mirror_theme = 'var codemirror_theme = "' . JSM_CODEMIRROR_THEME . '";' . "\r\n";


$valid_elements = null;
foreach ($ionic_tags as $ionic_tag)
{
    $_props = array();
    if (isset($ionic_tag['props']))
    {
        foreach ($ionic_tag['props'] as $props)
        {
            if (isset($ionic_tag['props']))
            {
                $_props[] = $props['name'];
            }
        }
    }
    $_valid_elements[] = $ionic_tag['tag'] . '[' . implode('|', $_props) . ']';
}

$valid_elements .= 'var valid_elements = "' . implode(',', $_valid_elements) . '";';

parse_str($_SERVER["QUERY_STRING"], $url_param);

$html_lang = '';
$translator['author'] = 'Ihsana Team';
$translator['url'] = 'https://ihsana.com/';
foreach (glob(JSM_PATH . "/languages/*.json") as $filename)
{
    $active = '';
    $langInfo = json_decode(file_get_contents($filename), true);
    if ($langInfo['prefix'] == $_SESSION['LANG'])
    {
        $active = 'active';
        $translator['author'] = $langInfo['author'];
        $translator['url'] =  $langInfo['url'];
    }
    $url_param['lang'] = $langInfo['prefix'];
    $html_lang .= '<li class="' . $active . '"><a href="./?' . http_build_query($url_param) . '"><img src="./languages/' . $langInfo['prefix'] . '.png" width="32" height="18" /></a></li>';
}

?>