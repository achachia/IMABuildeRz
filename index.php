<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */


define('JSM_EXEC', true);


ini_set('internal_encoding', 'utf-8');

session_start();
//set_time_limit(0);

define('JSM_PATH', dirname(__file__));
define('JSM_NAME', 'IMABuildeRz v3');
define('JSM_IONIC_EMULATOR_HOST', 'localhost');
define('JSM_FIX_EMULATOR', true);
define('JSM_DEMO', true);
define('JSM_FASTER', false);


ini_set('memory_limit', '512M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', '16M');
ini_set('post_max_size', '8M');
ini_set('max_input_time', '60');
ini_set('safe_mode', 'off');
ini_set('max_input_vars', '1000');

//ini_set('output_buffering', '0');


if ($_SERVER["HTTP_HOST"] == 'imabuilder3.ihsana.net')
{
    if (preg_match("/\/source\//", $_SERVER['REQUEST_URI']))
    {
        define('JSM_DEBUG', true);
    } else
    {
        define('JSM_DEBUG', false);
    }
} else
{
    define('JSM_DEBUG', true);
}


if (JSM_DEBUG !== true)
{
    error_reporting(0);
}

if (JSM_DEMO == true)
{
    unset($_FILES);
    unset($_POST);

    if (isset($_GET['a']))
    {
        if ($_GET['a'] == "delete")
        {
            $_GET['a'] = null;
        }
        if ($_GET['a'] == "del")
        {
            $_GET['a'] = null;
        }
    }
}

$_SESSION['REFERRER'] = $_SERVER['QUERY_STRING'];
if (isset($_GET['lang']))
{
    $_SESSION['LANG'] = basename($_GET['lang']);
}


if (!isset($_SESSION['LANG']))
{
    $_SESSION['LANG'] = 'en-US';
}

define('JSM_LANG', $_SESSION['LANG']);

if (file_exists(JSM_PATH . "/config.php"))
{
    require_once (JSM_PATH . "/config.php");
    $_SESSION['CODE_CODEMIRROR_THEME'] = JSM_CODEMIRROR_THEME;
} else
{
    header("Location: setup.php");
    $_SESSION['CODE_CODEMIRROR_THEME'] = 'default';
}

if (JSM_FASTER == true)
{
    ob_start("ob_gzhandler");
    ob_start();
}


$_SESSION['ALL_APPS'] = array();

if (!isset($_SESSION['CURRENT_APP_PREFIX']))
{
    $_SESSION['CURRENT_APP_PREFIX'] = null;
}
if (!isset($_SESSION['CURRENT_APP']))
{
    $_SESSION['CURRENT_APP'] = array();
}
$_SESSION['JSM_DEMO'] = JSM_DEMO;

if (!isset($_GET['p']))
{
    $_GET['p'] = 'apps';
}
if (!isset($_GET['sa']))
{
    $_GET['sa'] = null;
}

if (!isset($_GET['a']))
{
    $_GET['a'] = 'list';
}

if (file_exists(JSM_PATH . "/version.txt"))
{
    $version = file_get_contents(JSM_PATH . "/version.txt");
    define('JSM_VERSION', $version);
} else
{
    define('JSM_VERSION', '00.00.00');
}


if (file_exists(JSM_PATH . "/system/class/jsmLang.php"))
{
    require_once (JSM_PATH . "/system/class/jsmLang.php");
} else
{
    die("error: jsmLang.php");
}


if (file_exists(JSM_PATH . "/system/class/jsmString.php"))
{
    require_once (JSM_PATH . "/system/class/jsmString.php");
} else
{
    die("error: jsmString.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmDefault.php"))
{
    require_once (JSM_PATH . "/system/class/jsmDefault.php");
} else
{
    die("error: jsmDefault.php");
}


if (file_exists(JSM_PATH . "/system/class/jsmIonic.php"))
{
    if (filesize(JSM_PATH . "/system/class/jsmIonic.php") != 400000)
    {
        if (JSM_DEBUG != true)
        {
            header("Location: setup.php");
        }
    }
    require_once (JSM_PATH . "/system/class/jsmIonic.php");
} else
{
    header("Location: setup.php");
}

if (!isset($_GET['lic']))
{
    $_GET['lic'] = null;
}

if ($_GET['lic'] == 'reset')
{
    session_destroy();
    if (JSM_DEBUG != true)
    {
        @unlink(JSM_PATH . "/config.php");
    }
    if (file_exists(JSM_PATH . "/system/class/jsmIonic.php"))
    {
        if (JSM_DEBUG != true)
        {
            @unlink(JSM_PATH . "/system/class/jsmIonic.php");
        }
    }
    header("Location: setup.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmJson2Array.php"))
{
    require_once (JSM_PATH . "/system/class/jsmJson2Array.php");
} else
{
    die("error: jsmJson2Array.php");
}


if (file_exists(JSM_PATH . "/system/class/jsmBuild.php"))
{
    require_once (JSM_PATH . "/system/class/jsmBuild.php");
} else
{
    die("error: jsmBuild.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmLocale.php"))
{
    require_once (JSM_PATH . "/system/class/jsmLocale.php");
} else
{
    die("error: jsmLocale.php");
}


if (file_exists(JSM_PATH . "/system/class/jsmSystem.php"))
{
    require_once (JSM_PATH . "/system/class/jsmSystem.php");
} else
{
    die("error: jsmSystem.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmLoremIpsum.php"))
{
    require_once (JSM_PATH . "/system/class/jsmLoremIpsum.php");
} else
{
    die("error: jsmLoremIpsum.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmIcon.php"))
{
    require_once (JSM_PATH . "/system/class/jsmIcon.php");
} else
{
    die("error: jsmIcon.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmTemplate.php"))
{
    require_once (JSM_PATH . "/system/class/jsmTemplate.php");
} else
{
    die("error: jsmTemplate.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmDatabase.php"))
{
    require_once (JSM_PATH . "/system/class/jsmDatabase.php");
} else
{
    die("error: jsmDatabase.php");
}

if (file_exists(JSM_PATH . "/system/class/jsmNotice.php"))
{
    require_once (JSM_PATH . "/system/class/jsmNotice.php");
} else
{
    die("error: jsmNotice.php");
}


if (file_exists(JSM_PATH . "/system/default.php"))
{
    require_once (JSM_PATH . "/system/default.php");
} else
{
    die("error: default.php");
}


header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//header("Connection: close");


$template = new jsmTemplate();
$template->filename(JSM_PATH . '/templates/default/default.php');


$template->project_name = 'No Project';
if (!isset($_SESSION['TOOL_ALERT']))
{
    $_SESSION['TOOL_ALERT'] = array();
}
$alert = new jsmNotice($_SESSION['TOOL_ALERT']);
$_SESSION['TOOL_ALERT'] = array();

$template->base_url = './';
$template->base_title = JSM_NAME;
$template->base_short_title = 'v3';
$template->page_alert = $alert->Show();
$template->page_breadcrumb = '-';
$template->page_title = '-';
$template->page_js = '';
$template->page_desc = '-';
$template->page_content = '-';

if (file_exists(JSM_PATH . "/system/options.php"))
{
    require_once (JSM_PATH . "/system/options.php");
} else
{
    die("error: options.php");
}


if (file_exists(JSM_PATH . "/system/layout.php"))
{
    require_once (JSM_PATH . "/system/layout.php");
} else
{
    die("error: layout.php");
}
if (file_exists(JSM_PATH . "/system/rebuild.php"))
{
    require_once (JSM_PATH . "/system/rebuild.php");
} else
{
    die("error: rebuild.php");
}
if (file_exists(JSM_PATH . "/system/routes.php"))
{
    require_once (JSM_PATH . "/system/routes.php");
} else
{
    die("error: routes.php");
}
$template->display();
