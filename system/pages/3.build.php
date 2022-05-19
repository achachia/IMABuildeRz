<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package No project loaded
 */


defined("JSM_EXEC") or die("Silence is golden");
$db = new jsmDatabase();
$current_app = $db->current();
$string = new jsmString();
$OS = new jsmSystem();
$os_type = $OS->getOS();

$app_name = $_SESSION['CURRENT_APP']['apps']['app-name'];
$app_prefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];
$dirproject = JSM_PATH . '/projects/' . $current_app['apps']['app-prefix'] . '/';
$diroutput = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/';

$dir_path = realpath(JSM_PATH . '/outputs/');
$app_path = realpath(JSM_PATH . '/outputs/' . $app_prefix);

$content = $breadcrumb = null;
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
if (!isset($_SESSION['CURRENT_APP']['apps']['capasitor']))
{
    $_SESSION['CURRENT_APP']['apps']['capasitor'] = false;
}

rebuild();


$google_services_dir = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/platforms/android/app/';
if (file_exists($google_services_dir))
{
    if (file_exists($dirproject . '/google-services.json'))
    {
        copy($dirproject . '/google-services.json', $google_services_dir . '/google-services.json');
        copy($dirproject . '/google-services.json', $diroutput . '/google-services.json');
    }
}


$ionic_natives = $ionicNatives;
if (isset($_SESSION["CURRENT_APP"]["pages"]))
{
    foreach ($_SESSION["CURRENT_APP"]["pages"] as $_page)
    {
        if (isset($_page['modules']['angular']))
        {
            if (is_array($_page['modules']['angular']))
            {
                foreach ($_page['modules']['angular'] as $current_native)
                {
                    if (substr($current_native["path"], 0, 13) == '@ionic-native')
                    {
                        if (!isset($current_native["cordova"]))
                        {
                            $current_native["cordova"] = '';
                        }
                        if (!isset($current_native["cordova-variable"]))
                        {
                            $current_native["cordova-variable"] = '';
                        }
                        if (!isset($current_native["capasitor-note"]))
                        {
                            $current_native["capasitor-note"] = '';
                        }
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'capasitor-note' => $current_native["capasitor-note"],
                            'cordova-variable' => $current_native["cordova-variable"]);
                    }
                }
            }
        }
    }
}
if (isset($_SESSION["CURRENT_APP"]["pipes"]))
{
    foreach ($_SESSION["CURRENT_APP"]["pipes"] as $_pipe)
    {
        if (isset($_pipe['modules']['angular']))
        {
            if (is_array($_pipe['modules']['angular']))
            {
                foreach ($_pipe['modules']['angular'] as $current_native)
                {
                    if (substr($current_native["path"], 0, 13) == '@ionic-native')
                    {
                        if (!isset($current_native["cordova"]))
                        {
                            $current_native["cordova"] = '';
                        }
                        if (!isset($current_native["cordova-variable"]))
                        {
                            $current_native["cordova-variable"] = '';
                        }
                        if (!isset($current_native["capasitor-note"]))
                        {
                            $current_native["capasitor-note"] = '';
                        }
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'capasitor-note' => $current_native["capasitor-note"],
                            'cordova-variable' => $current_native["cordova-variable"]);
                    }
                }
            }
        }
    }
}
if (isset($_SESSION["CURRENT_APP"]["directives"]))
{
    foreach ($_SESSION["CURRENT_APP"]["directives"] as $_directive)
    {
        if (isset($_directive['modules']['angular']))
        {
            if (is_array($_directive['modules']['angular']))
            {
                foreach ($_directive['modules']['angular'] as $current_native)
                {
                    if (substr(strtolower($current_native["path"]), 0, 13) == '@ionic-native')
                    {
                        if (!isset($current_native["cordova"]))
                        {
                            $current_native["cordova"] = '';
                        }
                        if (!isset($current_native["cordova-variable"]))
                        {
                            $current_native["cordova-variable"] = '';
                        }
                        if (!isset($current_native["capasitor-note"]))
                        {
                            $current_native["capasitor-note"] = '';
                        }
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'capasitor-note' => $current_native["capasitor-note"],
                            'cordova-variable' => $current_native["cordova-variable"]);
                    }
                }
            }
        }
    }
}
if (isset($_SESSION["CURRENT_APP"]["services"]))
{
    foreach ($_SESSION["CURRENT_APP"]["services"] as $_service)
    {
        if (isset($_service['modules']['angular']))
        {
            if (is_array($_service['modules']['angular']))
            {
                foreach ($_service['modules']['angular'] as $current_native)
                {
                    if (substr($current_native["path"], 0, 13) == '@ionic-native')
                    {
                        if (!isset($current_native["cordova"]))
                        {
                            $current_native["cordova"] = '';
                        }
                        if (!isset($current_native["cordova-variable"]))
                        {
                            $current_native["cordova-variable"] = '';
                        }
                        if (!isset($current_native["capasitor-note"]))
                        {
                            $current_native["capasitor-note"] = '';
                        }
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'capasitor-note' => $current_native["capasitor-note"],
                            'cordova-variable' => $current_native["cordova-variable"]);
                    }
                }
            }
        }
    }
}
if (isset($_SESSION["CURRENT_APP"]["components"]))
{
    foreach ($_SESSION["CURRENT_APP"]["components"] as $_component)
    {
        if (isset($_component['modules']['angular']))
        {
            if (is_array($_component['modules']['angular']))
            {
                foreach ($_component['modules']['angular'] as $current_native)
                {
                    if (substr($current_native["path"], 0, 13) == '@ionic-native')
                    {
                        if (!isset($current_native["cordova"]))
                        {
                            $current_native["cordova"] = '';
                        }
                        if (!isset($current_native["cordova-variable"]))
                        {
                            $current_native["cordova-variable"] = '';
                        }
                        if (!isset($current_native["capasitor-note"]))
                        {
                            $current_native["capasitor-note"] = '';
                        }
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'capasitor-note' => $current_native["capasitor-note"],
                            'cordova-variable' => $current_native["cordova-variable"]);
                    }
                }
            }
        }
    }
}
if (isset($_SESSION["CURRENT_APP"]["global"]))
{
    foreach ($_SESSION["CURRENT_APP"]["global"] as $globals)
    {
        foreach ($globals as $_global)
        {
            if (isset($_global['modules']))
            {
                if (is_array($_global['modules']))
                {
                    foreach ($_global['modules'] as $current_native)
                    {
                        if (!isset($current_native["cordova"]))
                        {
                            $current_native["cordova"] = '';
                        }
                        if (!isset($current_native["cordova-variable"]))
                        {
                            $current_native["cordova-variable"] = '';
                        }
                        if (!isset($current_native["path"]))
                        {
                            $current_native["path"] = '';
                        }

                        if (!isset($current_native["capasitor-note"]))
                        {
                            $current_native["capasitor-note"] = '';
                        }

                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'capasitor-note' => $current_native["capasitor-note"],
                            'cordova-variable' => $current_native["cordova-variable"]);
                    }
                }
            }
        }
    }
}
if (!isset($_SESSION['CURRENT_APP']['apps']['ionic-storage']))
{
    $_SESSION['CURRENT_APP']['apps']['ionic-storage'] = false;
}
if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
{
    $ionic_natives[] = array(
        'native' => '',
        'capasitor-note' => '',
        'cordova' => 'cordova-sqlite-storage',
        'cordova-variable' => '');
}
foreach ($ionic_natives as $ionic_native)
{
    $var = sha1($ionic_native['cordova']);
    $new_ionic_natives[$var] = $ionic_native;
}
$ionic_natives = $new_ionic_natives;


$breadcrumb = $page_js = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Build and Signed') . '</li>';
$breadcrumb .= '</ol>';


$content .= '<div class="row">';
$content .= '<div class="col-md-7">';

// TODO: BUILD IONIC PROJECT
if (!file_exists($app_path . '/package.json'))
{
    $content .= '<div class="alert alert-danger"><strong><i class="fa fa-warning"></i> ' . __e('Error') . '</strong> : ' . __e('An ionic project hasn\'t been created. Create an ionic project now! click <a href="./?p=1.start-compiler">here</a>') . '</div>';

    $content .= '<div id="alert-error" class="modal modal-danger fade">';
    $content .= '<div class="modal-dialog">';
    $content .= '<div class="modal-content">';
    $content .= '<div class="modal-header">';
    $content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    $content .= '<h4 class="modal-title">' . __e('Ops..! Ionic Project Error') . '</h4>';
    $content .= '</div>';
    $content .= '<div class="modal-body">';
    $content .= '<p>' . __e('An ionic project hasn\'t been created!') . '</p>';
    $content .= '</div>';
    $content .= '<div class="modal-footer">';
    $content .= '<a class="btn btn-danger" href="./?p=1.start-compiler">Create An Ionic Project</a>';
    $content .= '</div>';
    $content .= '</div><!-- /.modal-content -->';
    $content .= '</div><!-- /.modal-dialog -->';
    $content .= '</div><!-- /.modal -->';

    $page_js .= "$('#alert-error').modal('show')";
}

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Build an Ionic Project') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


$support_ios = '<p class="alert alert-danger">' . __e('Your computer does not support iOS Platform, please use Mac OSX') . '</p>';
$support_win = '<p class="alert alert-danger">' . __e('Your computer does not support iOS Platform') . '</p>';
switch ($os_type)
{
    case 1:

        break;
    case 2:
        //window
        $support_win = '';
        break;
    case 3:
        //linux

        break;
    case 4:
        //osx
        $support_ios = '';
        break;
}


$content .= '<h3>' . __e('Fix Popular Issues') . '</h3>';
$content .= '<p>' . __e('If an error occurs while adding the platform, follow these steps:') . '</p>';
$content .= '<pre class="shell">npm cache clean --force</pre>';
$content .= '<p>' . __e('And If you are a windows user, try deleting all files in this folder:') . '</p>';
$content .= '<pre>C:\Users\{{your-username}}\AppData\Roaming\npm-cache</pre>';
switch ($os_type)
{
    case 1:
        //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
        break;
    case 2:
        //window
        $content .= '<pre class="shell">rmdir /S /Q "C:\Users\%USERNAME%\AppData\Roaming\npm-cache"</pre>';
        break;
    case 3:
        //linux
        //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
        break;
    case 4:
        //osx
        //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
        break;
}

$content .= '<p>' . __e('And delete all the platforms that have been added in this folder:') . '</p>';
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    $content .= '<pre>' . $app_path . DIRECTORY_SEPARATOR . 'android</pre>';
    switch ($os_type)
    {
        case 1:
            //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">rmdir /S /Q "' . realpath($app_path) . DIRECTORY_SEPARATOR . 'android' . '"</pre>';
            break;
        case 3:
            //linux
            //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
    }
} else
{
    $content .= '<pre>' . $app_path . DIRECTORY_SEPARATOR . 'platforms</pre>';
    $content .= '<pre class="shell">ionic cordova platform remove android</pre>';

    switch ($os_type)
    {
        case 1:
            //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">rmdir /S /Q "' . realpath($app_path) . DIRECTORY_SEPARATOR . 'platforms' . '"</pre>';
            break;
        case 3:
            //linux
            //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            //$content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
    }
}

$content .= '<p>' . __e('Then run this command:') . '</p>';
$content .= '<pre class="shell">npm cache verify</pre>';
$content .= '<p>' . __e('After that run the command below') . '</p>';
$content .= '<hr/>';


$content .= '<h3>' . __e('Build an Ionic Project') . '</h3>';
$content .= '<ol>';

$content .= '<li>';
$content .= '<p>' . __e('Connect your internet, then run <code>Node.js command prompt</code> or using <code>terminal/bash</code>') . '</p>';
$content .= '</li>';

if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
    }
    $content .= '</li>';
} else
{

    $content .= '<li>';
    $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">cd /D "' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '\\' . $app_prefix . '"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER_OSX . '/' . $app_prefix . '"</pre>';
            break;
    }

    $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
    $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';


    $content .= '<p>' . __e('Copy the output code into your ionic project') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">' . $xcopy_cmd . '</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
            break;
    }
    $content .= '</li>';
}


$content .= '<li>';
$content .= '<p>' . __e('Add platform to your ionic project') . '</p>';


if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    $content .= '<p>' . __e('Android Platform') . '</p>';
    $content .= '<pre class="shell">ionic cordova platform add android@latest</pre>';
    $content .= '<p>' . __e('or for ios platform:') . '</p>';
    $content .= $support_ios;
    //$content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-wkwebview-engine@latest</pre>';
    //$content .= '<pre class="shell">ionic cordova platform add ios@5.1.1</pre>';
    $content .= '<pre class="shell">ionic cordova platform add ios@latest</pre>';
    $content .= '<p>' . __e('It is recommended to upgrade the cordova-ios platform to version 5.1.1 or latest') . '</p>';
    $content .= '<p>' . __e('or for browser platform') . '</p>';
    $content .= '<pre class="shell">ionic cordova platform add browser@latest</pre>';
} else
{
    $content .= '<p>' . __e('Android Platform') . '</p>';
    $content .= '<pre class="shell">ionic cap add android</pre>';
    $content .= '<p>' . __e('or for ios platform:') . '</p>';
    $content .= '<pre class="shell">ionic cap add ios</pre>';
}

$content .= '</li>';

$chmod_cmd = 'chmod -R 777 ' . realpath($dir_path) . '/*';

switch ($os_type)
{
    case 1:
        $content .= '<li>';
        $content .= '<p>' . __e('Change all file and folder permissions to read, write, and execute <code>chmod -R 777</code>') . '</p>';
        $content .= '<pre class="shell">' . $chmod_cmd . '</pre>';
        $content .= '</li>';
        break;
    case 2:
        //window
        //$content .= '<pre class="shell">' . $chmod_cmd . '</pre>';
        break;
    case 3:
        //linux
        $content .= '<li>';
        $content .= '<p>' . __e('Change all file and folder permissions to read, write, and execute <code>chmod -R 777</code>') . '</p>';
        $content .= '<pre class="shell">' . $chmod_cmd . '</pre>';
        $content .= '</li>';
        break;
    case 4:
        //osx
        $content .= '<li>';
        $content .= '<p>' . __e('Change all file and folder permissions to read, write, and execute <code>chmod -R 777</code>') . '</p>';
        $content .= '<pre class="shell">' . $chmod_cmd . '</pre>';
        $content .= '</li>';
        break;
}
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Try to resync your ionic project') . '</p>';
    $content .= '<pre class="shell">ionic cap sync</pre>';
    $content .= '</li>';


}

$content .= '<li>';
$content .= '<p>' . __e('Then build your ionic project') . '</p>';

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    $content .= '<pre class="shell">ionic cordova build android</pre>';
    $content .= '<p>' . __e('or') . '</p>';
    $content .= '<pre class="shell">ionic cordova build ios</pre>';
} else
{
    $content .= '<pre class="shell">ionic cap open android</pre>';
    $content .= '<p>' . __e('or') . '</p>';
    $content .= '<pre class="shell">ionic cap open ios</pre>';

    $content .= '<p>' . __e('Please edit the configuration using your compiler, such as Android Studio and some of the configurations below may be mandatory.') . '</p>';
    $content .= '<ol>';
    foreach ($ionic_natives as $ionic_native)
    {
        if (isset($ionic_native['capasitor-note']))
        {
            if ($ionic_native['capasitor-note'] != '')
            {
                $content .= '<li>';
                $content .= '<h4>' . $ionic_native['cordova'] . '</h4>';
                $content .= '<div class="dev-note">' . $ionic_native['capasitor-note'] . '</div>';
                $content .= '</li>';
            }
        }
    }
    $content .= '</ol>';
}
$content .= '</li>';


if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Then open file browser (Windows Explorer for Windows or Finder for OSX)') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">explorer "platforms\android\app\build\outputs\apk"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">finder "platforms\android\app\build\outputs\apk"</pre>';
            break;
    }

    $content .= '</li>';
}

$content .= '</ol>';
$content .= '</div>';
$content .= '</div>';
//$content .= '</div>';

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    // TODO: BUILD APK + SIGNED
    $content .= '<div class="box box-warning">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-android"></i> ' . __e('Create APK File to publish on self-hosting or other') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';
    $content .= '<blockquote class="blockquote blockquote-default">';
    $content .= __e('Please! make sure the keytool, jarsigner and zipalign are set up the path/environment variables in Windows');
    $content .= '</blockquote>';

    $content .= '<ol>';

    $content .= '<li>';
    $content .= '<p>' . __e('Connect your internet, then run <code>Node.js command prompt</code> or using <code>terminal/bash</code>') . '</p>';
    $content .= '</li>';

    if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
        }
        $content .= '</li>';
    } else
    {

        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">cd /D "' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '\\' . $app_prefix . '"</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER_OSX . '/' . $app_prefix . '"</pre>';
                break;
        }

        $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
        $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';


        $content .= '<p>' . __e('Copy the output code into your ionic project') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">' . $xcopy_cmd . '</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
        }
        $content .= '</li>';
    }

    $content .= '<li>';
    $content .= '<p>' . __e('Build your project') . '</p>';
    $content .= '<pre class="shell">ionic cordova build android --prod --release</pre>';
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('Let\'s generate our private key using the keytool command that comes with the JDK, For app already exist in playstore, you can use old key file rename to:') . ' <code>' . $app_prefix . '.keystore</code></p>';
    $content .= '<pre class="shell">keytool -genkey -v -keystore "' . $app_prefix . '.keystore" -alias ' . $string->toVar($app_prefix) . ' -keyalg RSA -keysize 2048 -validity 10000</pre>';
    $content .= '</li>';


    $xcopy_cmd = 'echo f | xcopy /F /Y "platforms/android/app/build/outputs/apk/release/app-release-unsigned.apk" "platforms/android/app/build/outputs/apk/release/app-for-signed.apk"';
    $copy_cmd = 'cp "platforms/android/app/build/outputs/apk/release/app-release-unsigned.apk" "platforms/android/app/build/outputs/apk/release/app-for-signed.apk"';

    $content .= '<li>';
    $content .= '<p>' . __e('Copying and rename APK filename') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">' . $xcopy_cmd . '</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
            break;
    }
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('To sign the unsigned APK, run the jarsigner tool which is also included in the JDK') . '</p>';
    $content .= '<pre class="shell">jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore "' . $app_prefix . '.keystore" "platforms/android/app/build/outputs/apk/release/app-for-signed.apk" ' . $string->toVar($app_prefix) . '</pre>';
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('we need to run the zip align tool to optimize the APK') . '</p>';
    $content .= '<pre class="shell">zipalign -v 4 "platforms/android/app/build/outputs/apk/release/app-for-signed.apk" "platforms/android/app/build/outputs/apk/release/app-release-signed.apk"</pre>';
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('Then open filebrowser, use <code>app-release-signed.apk</code> for production') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">explorer platforms\android\app\build\outputs\apk</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">finder platforms\android\app\build\outputs\apk</pre>';
            break;
    }
    $content .= '</li>';


    $content .= '</ol>';
    $content .= '</div>';
    $content .= '</div>';
}

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    // TODO: BUILD AAB + SIGNED
    $content .= '<div class="box box-warning">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-android"></i> ' . __e('Create AAB File (Android App Bundle) to publish on Google Play Store') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';


    $content .= '<blockquote class="blockquote blockquote-default">';
    $content .= __e('Please! make sure the keytool, jarsigner and zipalign are set up the path/environment variables in Windows');
    $content .= '</blockquote>';

    $content .= '<ol>';
    $content .= '<li>';
    $content .= '<p>' . __e('Connect your internet, then run <code>Node.js command prompt</code> or using <code>terminal/bash</code>') . '</p>';
    $content .= '</li>';
    if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
        }
        $content .= '</li>';
    } else
    {

        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">cd /D "' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '\\' . $app_prefix . '"</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER_OSX . '/' . $app_prefix . '"</pre>';
                break;
        }

        $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
        $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';


        $content .= '<p>' . __e('Copy the output code into your ionic project') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">' . $xcopy_cmd . '</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
        }
        $content .= '</li>';
    }
    $content .= '<li>';
    $content .= '<p>' . __e('Build your ionic project') . '</p>';
    $content .= '<pre class="shell">ionic cordova build android --prod --release -- -- --packageType=bundle</pre>';
    $content .= '</li>';


    $content .= '<li>';
    $content .= '<p>' . __e('Let\'s generate our private key using the keytool command that comes with the JDK, For app already exist in playstore, you can use old key file rename to:') . ' <code>' . $app_prefix . '.keystore</code></p>';
    $content .= '<pre class="shell">keytool -genkey -v -keystore "' . $app_prefix . '.keystore" -alias ' . $string->toVar($app_prefix) . ' -keyalg RSA -keysize 2048 -validity 10000</pre>';
    $content .= 'and for encrypted private key: <pre class="shell">java -jar pepk.jar --keystore=' . ($app_prefix) . '.keystore --alias=' . $string->toVar($app_prefix) . '  --output=' . ($app_prefix) . '.pem --encryptionkey=yourkey</pre>' . "\r\n";
    $content .= '</li>';


    $content .= '<li>';
    $content .= '<p>' . __e('To sign the unsigned Android App bundle (.aab), run the jarsigner tool which is also included in the JDK') . '</p>';
    $content .= '<pre class="shell">jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore "' . $app_prefix . '.keystore" "platforms/android/app/build/outputs/bundle/release/app-release.aab" ' . $string->toVar($app_prefix) . '</pre>';
    $content .= '</li>';


    $content .= '<li>';
    $content .= '<p>' . __e('Then open file browser (window explorer or finder), use <code>app-release.aab</code> for production') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">explorer "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">finder "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
    }
    $content .= '</li>';


    $content .= '</ol>';
    $content .= '</div>';
    $content .= '</div>';
}

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    // TODO: BUILD AAB + SIGNED FOR UPDATE
    $content .= '<div class="box box-warning">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-android"></i> ' . __e('Create AAB File to update the app on Google Play Store') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';

    $content .= '<blockquote class="blockquote blockquote-default">';

    $content .= '<p>' . __e('Prepare your updates') . ':</p>';
    $content .= '<ul>';
    $content .= '<li>' . __e('The package name of the updated APK or app bundle needs to be the same as the current version') . '<br/>(' . __e('current') . ': <strong>' . $current_app['apps']['app-id'] . '</strong>)</li>';
    $content .= '<li>' . __e('The version code needs to be greater than the current version. Learn more about versioning your app') . '<br/>(' . __e('current') . ': <strong>' . str_replace('.', '', $current_app['apps']['app-version']) . '</strong>)</li>';
    $content .= '<li>' . __e('The updated APK or app bundle needs to be signed with the same signature as the current version') . '<br/>(' . __e('keystore') . ': <strong>' . $app_prefix . '.keystore</strong>)</li>';
    $content .= '</ul>';

    $content .= '</blockquote>';

    $content .= '<ol>';

    $content .= '<li>';
    $content .= '<p>' . __e('Go to the <strong>Apps -&raquo; Edit</strong>, then edit the <strong>App Version</strong>, the version code needs to be greater than the app version on Google Play Store') . '</p>';
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('Copy <strong>' . $app_prefix . '.keystore</strong> to the root of the ionic project folder') . ' (' . __e('current') . ':<strong> ' . $app_path . '</strong>)</p>';
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('Connect your internet, then run <code>Node.js command prompt</code> or using <code>terminal/bash</code>') . '</p>';
    $content .= '</li>';

    if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
                break;
        }
        $content .= '</li>';
    } else
    {

        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">cd /D "' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '\\' . $app_prefix . '"</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER_OSX . '/' . $app_prefix . '"</pre>';
                break;
        }

        $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
        $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';


        $content .= '<p>' . __e('Copy the output code into your ionic project') . '</p>';
        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">' . $xcopy_cmd . '</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
        }
        $content .= '</li>';
    }
    $content .= '<li>';
    $content .= '<p>' . __e('Build your ionic project') . '</p>';
    $content .= '<pre class="shell">ionic cordova build android --prod --release -- -- --packageType=bundle</pre>';
    $content .= '</li>';


    $content .= '<li>';
    $content .= '<p>' . __e('To sign the unsigned Android App bundle (.aab), run the jarsigner tool which is also included in the JDK') . '</p>';
    $content .= '<pre class="shell">jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore "' . $app_prefix . '.keystore" "platforms/android/app/build/outputs/bundle/release/app-release.aab" ' . $string->toVar($app_prefix) . '</pre>';
    $content .= '</li>';


    $content .= '<li>';
    $content .= '<p>' . __e('Then open file browser (window explorer or finder), use <code>app-release.aab</code> for production') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">explorer "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">finder "platforms\android\app\build\outputs\bundle\release\"</pre>';
            break;
    }
    $content .= '</li>';


    $content .= '</ol>';
    $content .= '</div>';
    $content .= '</div>';
}

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    // TODO: BUILD IONIC CAPASITOR
    $content .= '<div class="box box-danger">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Plugin Incompatible With Capacitor') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';

    $content .= '<table class="table table-striped table-bordered">';

    $content .= '<thead>';
    $content .= '<tr>';
    $content .= '<th>Name</th>';
    $content .= '<th>Ionic Native</th>';
    $content .= '<th>Cordova Plugin</th>';
    $content .= '</tr>';
    $content .= '</thead>';

    $content .= '<tbody>';
    $content .= '<tr>';
    $content .= '<td>SaveAsset Directive</td>';
    $content .= '<td>@ionic-native/file-opener</td>';
    $content .= '<td>cordova-plugin-file-opener2</td>';
    $content .= '</tr>';


    $content .= '<tr>';
    $content .= '<td>X - Social Sharing Directive</td>';
    $content .= '<td>@ionic-native/social-sharing</td>';
    $content .= '<td>cordova-plugin-x-socialsharing</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td>Pay With Paypal Directive</td>';
    $content .= '<td>@ionic-native/paypal</td>';
    $content .= '<td>com.paypal.cordova.mobilesdk</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td>Share Via Instagram Directive</td>';
    $content .= '<td>@ionic-native/instagram</td>';
    $content .= '<td>cordova-instagram-plugin</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td>Play With Youtube App Directive</td>';
    $content .= '<td>@ionic-native/youtube-video-player</td>';
    $content .= '<td>cordova-plugin-youtube-video-player</td>';
    $content .= '</tr>';


    $content .= '</tbody>';

    $content .= '</table>';


    $content .= '</div><!-- ./box-body -->';
    $content .= '</div><!-- ./box -->';
    //$content .= '</div>';
}

$content .= '</div>';
$content .= '<div class="col-md-5">';
// TODO: INTRUCTIONS
$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Official Instructions') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<ol>';
$content .= '<li><a target="_blank" href="https://ionicframework.com/docs/developing/android">Android Development</a></li>';
$content .= '<li><a target="_blank" href="https://ionicframework.com/docs/deployment/play-store">Android Play Store Deployment</a></li>';
$content .= '<li><a target="_blank" href="https://ionicframework.com/docs/developing/ios">iOS Development</a></li>';
$content .= '<li><a target="_blank" href="https://ionicframework.com/docs/deployment/app-store">iOS App Store Deployment</a></li>';
$content .= '<li><a target="_blank" href="https://ionicframework.com/docs/deployment/desktop-app">Deploying a Desktop App</a></li>';
$content .= '</ol>';


$content .= '</div>'; //box-body
$content .= '</div>'; //box

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Showcase Your App') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="alert alert-info">' . __e('If you have successfully made an application, please send us your application data so we can post on our website and social media!') . '</div>';


$content .= '<div class="form-group">';
$content .= '<p>' . __e('App Name') . '</p>';
$content .= '<input type="text" name="app-name" id="app-name" class="form-control" value="' . $current_app['apps']['app-name'] . '" />';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<p>' . __e('Description') . '</p>';
$content .= '<input type="text" name="app-name" id="app-desc" class="form-control" value="' . $current_app['apps']['app-description'] . '"/>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<p>' . __e('PlayStore URL (Android)') . '</p>';
$content .= '<input type="text" name="playstore" id="url-playstore" class="form-control" value="https://play.google.com/store/apps/details?id=' . $current_app['apps']['app-id'] . '"/>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<p>' . __e('AppStore URL (IOs)') . '</p>';
$content .= '<input type="text" name="playstore" id="url-appstore" class="form-control" value=""/>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<p>' . __e('Self-Publishing (APK Link)') . '</p>';
$content .= '<input type="text" name="url-apk" id="url-apk" class="form-control" value=""/>';
$content .= '<p class="help-block">' . __e('If you are publishing on your own hosting, please fill in the fields above.') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<input type="button" id="app-publish" class="btn btn-danger" value="' . __e('Publish') . '" />';
$content .= '</div>';

$content .= '</div>';
$content .= '</div>';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('How to build PWAs (Progressive Web Apps)') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>' . __e('Required to use a hosting that has domain/subdomain or ROOT folder') . '</p>';

$content .= '<ol>';


if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
    }
    $content .= '</li>';
} else
{

    $content .= '<li>';
    $content .= '<p>' . __e('Go to your ionic project folder:') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">cd /D "' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '\\' . $app_prefix . '"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER . '/' . $app_prefix . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">cd "' . JSM_IONIC_PROJECT_FOLDER_OSX . '/' . $app_prefix . '"</pre>';
            break;
    }
    $content .= '</li>';
}
$content .= '<li>';
$content .= '<p>' . __e('Build your ionic project') . '</p>';
$content .= '<pre class="shell">ionic build</pre>';
$content .= '<p>' . __e('or') . '</p>';
$content .= '<pre class="shell">ionic build --prod</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('REFRESH this page twice to make the configuration run automatically') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Login to your server or cPanel and create a subdomain, must use a domain or subdomain (ROOT folder).') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then upload all files in the folder:') . ' <code>' . realpath( $app_path . '/www') . '</code></p>';
//$content .= '<pre>' . $app_path . '/www' . '</pre>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">explorer "' . $app_path . '"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">finder "' . $app_path . '"</pre>';
            break;
    }
$content .= '</li>';

$content .= '</ol>';


$content .= '</div>';
$content .= '</div>';


$content .= '</div>';
$content .= '</div>';


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Build and Signed App');
$template->page_desc = __e('Export your app in real, clean HTML, CSS, JS or run emulator using ionic cli');
$template->page_content = $content;

?>