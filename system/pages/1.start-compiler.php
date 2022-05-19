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

$string = new jsmString();
$content = $breadcrumb = null;
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

if(!isset($_SESSION['CURRENT_APP']['apps']['capasitor'])){
    $_SESSION['CURRENT_APP']['apps']['capasitor'] = false;
}

rebuild();
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
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
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
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
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
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
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

                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
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

                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
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
                        $ionic_natives[] = array(
                            'native' => str_replace("/ngx", "", $current_native["path"]),
                            'cordova' => $current_native["cordova"],
                            'cordova-variable' => $current_native["cordova-variable"]);

                    }
                }
            }

        }
    }
}

foreach ($ionic_natives as $ionic_native)
{
    $var = $ionic_native['cordova'];
    $new_ionic_natives[$var] = $ionic_native;
}
$ionic_natives = $new_ionic_natives;


$app_name = $_SESSION['CURRENT_APP']['apps']['app-name'];
$app_prefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];

$dir_path = realpath(JSM_PATH . '/outputs/');
$app_path = realpath(JSM_PATH . '/outputs/' . $app_prefix);


$OS = new jsmSystem();
$os_type = $OS->getOS();


$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Compiler') . '</li>';
$breadcrumb .= '</ol>';

$content .= '<div class="row">';

// TODO: NEW IONIC PROJECT

$content .= '<div class="col-md-12">';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Create an Ionic Project') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<blockquote class="blockquote blockquote-default">';
$content .= __e('This is actually the ionic command as usual, so before running the commands below please <ins>test the ionic to build apk and running the emulator</ins>');
$content .= '</blockquote>';


$content .= '<ol>';
$content .= '<li>' . __e('Connect your internet, then run <code>Node.js command prompt</code> or using <code>terminal/bash</code>') . '</li>';
$content .= '<li>';
$content .= '<p>' . __e('Install or update the Ionic CLI globally with npm (If it has been updated, skip this step)') . '</p>';
$content .= '<pre class="shell">npm install -g @ionic/cli</pre>';
$content .= '</li>';

if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Then go to folder your project:') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd "' . $dir_path . '"</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">cd /D "' . $dir_path . '"</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd "' . $dir_path . '"</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">cd "' . $dir_path . '"</pre>';
            break;
    }
    $content .= '</li>';
} else
{
    $content .= '<li>';
    $content .= '<p>' . __e('Then create an ionic project folder') . '</p>';
    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">mkdir -m777 ' . JSM_IONIC_PROJECT_FOLDER . '</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">md ' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">mkdir -m777 ' . JSM_IONIC_PROJECT_FOLDER . '</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">mkdir -m777 ' . JSM_IONIC_PROJECT_FOLDER_OSX . '</pre>';
            break;
    }
    $content .= '<p>' . __e('Then go to folder your ionic project:') . '</p>';

    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">cd ' . JSM_IONIC_PROJECT_FOLDER . '</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">cd /D ' . JSM_IONIC_PROJECT_FOLDER_WINDOWS . '</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">cd ' . JSM_IONIC_PROJECT_FOLDER . '</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">cd ' . JSM_IONIC_PROJECT_FOLDER_OSX . '</pre>';
            break;
    }
    $content .= '</li>';
}


$content .= '<li>';
$content .= '<p>' . __e('Start your project with option blank template and run the following command:') . '</p>';
$content .= '<pre class="shell">ionic start "' . $app_name . '" blank --project-id="' . $app_prefix . '" --type=angular</pre>';
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    $content .= '<p class="text-danger">' . __e('Skip this command, only for those who are <u>expert in ionic</u>, You can use shortcut commands:') . '</p>';

    switch ($os_type)
    {
        case 1:
            $content .= '<pre class="shell">./start.sh</pre>';
            break;
        case 2:
            //window
            $content .= '<pre class="shell">start.cmd</pre>';
            break;
        case 3:
            //linux
            $content .= '<pre class="shell">./start.sh</pre>';
            break;
        case 4:
            //osx
            $content .= '<pre class="shell">./start.sh</pre>';
            break;
    }
    $content .= '<p>' . __e('But it\'s better to follow the usual step.') . '</p>';

}
$content .= '</li>';


if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Overwrite? Type <kbd>Y</kbd> to overwrite the directory') . '</p>';
    $content .= '<pre class="shell">y</pre>';
    $content .= '</li>';
}

if (!isset($_SESSION['CURRENT_APP']['apps']['capasitor']))
{
    $_SESSION['CURRENT_APP']['apps']['capasitor'] = false;
}
$content .= '<li>';
$content .= '<p>' . __e('Don\'t install capacitor') . ', <em>Integrate your new app with Capacitor to target native iOS and Android?</em></p>';
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    $content .= '<pre class="shell">Y</pre>';

} else
{
    $content .= '<pre class="shell">N</pre>';
    $content .= '<p>' . __e('If you are using <strong>capacitor</strong>, please do so later. Documentation is available at: <a target="_blank" href="./?p=3.build">Build and Signed</a>') . '</p>';
}
$content .= '</li>';


$content .= '<li>';
$content .= '<p>' . __e('Browse to the newly created folder:') . '</p>';
$content .= '<pre class="shell">cd "' . $app_prefix . '"</pre>';
$content .= '</li>';

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    //$content .= '<li>';
    //$content .= '<p>' . __e('Initialize Capacitor with your app information') . '</p>';
    //$content .= '<pre class="shell">npx cap init "' . $app_name . '" "' . $_SESSION['CURRENT_APP']['apps']['app-id'] . '"</pre>';
    //$content .= '</li>';

    //$content .= '<li>';
    //$content .= '<p>' . __e('You must build your Ionic project at least once before adding any native platforms') . '</p>';
    //$content .= '<pre class="shell">ionic build</pre>';
    //$content .= '</li>';
}


$content .= '<li>';
$content .= '<p>' . __e('Add Cordova Plugins, Ionic Natives and Angular Modules') . '</p>';

$content .= '<section class="widget" id="add-cordova-native-plugin">';
$content .= '<ul>';

if (isset($_SESSION['CURRENT_APP']['localization']))
{
    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Then install <code>ngx-translate</code> module') . '</p>';
        $content .= '<pre class="shell">npm install @ngx-translate/core --save</pre>';
        $content .= '<pre class="shell">npm install @ngx-translate/http-loader --save</pre>';
        $content .= '</li>';
    }
}

if (!isset($_SESSION['CURRENT_APP']['apps']['ionic-storage']))
{
    $_SESSION['CURRENT_APP']['apps']['ionic-storage'] = false;
}
if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Install the <code>ionic-storage</code> module') . '</p>';
    $content .= '<pre class="shell">npm install --save @ionic/storage-angular@latest</pre>';
    $content .= '<pre class="shell">ionic cordova plugin add cordova-sqlite-storage@latest --save</pre>';

    if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
    {
        //$content .= '<pre class="shell">npx cap sync</pre>';
    }
    $content .= '</li>';
}


foreach ($ionic_natives as $ionic_native)
{
    $param = null;
    if (!isset($ionic_native['cordova-variable']))
    {
        $ionic_native['cordova-variable'] = array();
    }
    if (!is_array($ionic_native['cordova-variable']))
    {
        $ionic_native['cordova-variable'] = array();
    }
    if (count($ionic_native['cordova-variable']) != 0)
    {

        foreach ($ionic_native['cordova-variable'] as $native_variable)
        {
            $param .= ' --variable ';
            $param .= ' ' . $native_variable['var'] . '="' . $native_variable['val'] . '"';
        }
    }
    if ($ionic_native['cordova'] != '')
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Install the plugin:') . ' <code>' . $ionic_native['cordova'] . '</code></p>';
        if (substr($ionic_native['cordova'], 0, 19) == "https://github.com/")
        {
            if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['cordova'] . ' --save ' . $param . '</pre>';
            } else
            {
                $content .= '<pre class="shell">ionic cordova plugin add ' . $ionic_native['cordova'] . ' --save ' . $param . '</pre>';

            }
        } else
        {
            if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['cordova'] . '@latest --save ' . $param . '</pre>';
            } else
            {
                $content .= '<pre class="shell">ionic cordova plugin add ' . $ionic_native['cordova'] . '@latest --save ' . $param . '</pre>';

            }
        }


        if ($ionic_native['native'] != '')
        {
            if (substr($ionic_native['native'], 0, 13) == '@ionic-native')
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['native'] . '@latest --save</pre>';
            }
        }


        $content .= '</li>';
    }

}


$content .= '</ul>';
$content .= '</section>';

$content .= '</li>';

if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Then sync it with the project') . '</p>';
    $content .= '<pre class="shell">ionic cap sync</pre>';
    $content .= '</li>';
}


if (JSM_IONIC_PROJECT_SAME_FOLDER == false)
{
    $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
    $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';

    $content .= '<li>';
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

$support_ios = '<p class="alert alert-danger">' . __e('Your computer does not support iOS Platform') . '</p>';
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
        $content .= '<li>';
        $content .= '<p>' . __e('If needed, please change all file and folder permissions to read, write, and execute (path: <strong>' . realpath($dir_path) . '</strong>)') . '</p>';
        $content .= '</li>';
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


$content .= '<li>';
$content .= '<p>' . __e('Run web emulator') . '</p>';
$content .= '<pre class="shell">ionic serve --external --consolelogs</pre>';
$content .= '</li>';
$content .= '</ol>';


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';


// TODO: POPULAR ISSUE


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Fix Popular Issue') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>' . __e('You are trying to create new ionic project, and you end up with an error message saying:') . '</p>';
$content .= '<pre>' . __e('npm ERR! Unexpected end of JSON input while parsing near ') . '</pre>';

$content .= '<p>' . __e('There\'s a high chance that your npm cache been damaged, please follow the following command:') . '</p>';

$content .= '<ol>';
$content .= '<li>';
$content .= '<p>' . __e('Run this command to clean the files that have been downloaded previously.') . '</p>';
$content .= '<pre class="shell">npm cache clean --force</pre>';
$content .= '</li>';

$content .= '<li>';
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
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then run this command:') . '</p>';
$content .= '<pre class="shell">npm cache verify</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('If that doesn\'t work, try updating to the lastest') . '</p>';
$content .= '<pre class="shell">npm i npm@latest -g</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('If the problem is not resolved either, please do it again a few hours / days later. most likely a global problem.') . '</p>';
$content .= '</li>';


$content .= '</ol>';


$content .= '<p>' . __e('After that run the missing command again, I hope this helps!') . '</p>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-12 -->';


$get_dir = explode("/", $_SERVER["PHP_SELF"]);
unset($get_dir[count($get_dir) - 1]);
$main_url = "http://" . $_SERVER["HTTP_HOST"] . implode("/", $get_dir);
$app_url = $main_url . '/outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'];


$content .= '</div><!-- ./row -->';
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Start Compiler');
$template->page_desc = __e('Export your app in real, clean HTML, CSS, JS or run emulator using ionic cli');
$template->page_content = $content;

?>