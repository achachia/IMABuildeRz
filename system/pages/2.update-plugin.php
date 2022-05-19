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
$db = new jsmDatabase();
$current_app = $db->current();
$db->deleteLocalization('en-US');

$app_name = $_SESSION['CURRENT_APP']['apps']['app-name'];
$app_prefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];
$dir_path = realpath(JSM_PATH . '/outputs/');
$app_path = realpath(JSM_PATH . '/outputs/' . $app_prefix);
$dirproject = JSM_PATH . '/projects/' . $current_app['apps']['app-prefix'] . '/';
$diroutput = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/';
$OS = new jsmSystem();
$os_type = $OS->getOS();
$missing_command = array();
$fix_cmd = null;
$content = $breadcrumb = $page_js = null;
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


// TODO: ISSUE PRODUCTION
$angularConfigFile = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/angular.json';
if (file_exists($angularConfigFile))
{
    $angularConfigContent = file_get_contents($angularConfigFile);
    $angularConfigContent = str_replace('"aot": true,', '"aot": false,', $angularConfigContent);
    $angularConfigContent = str_replace(' "buildOptimizer": true,', ' "buildOptimizer": false,', $angularConfigContent);
    file_put_contents($angularConfigFile, $angularConfigContent);
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
if (!isset($_SESSION['CURRENT_APP']['apps']['ionic-storage']))
{
    $_SESSION['CURRENT_APP']['apps']['ionic-storage'] = false;
}
if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
{
    $ionic_natives[] = array(
        'native' => '',
        'cordova' => 'cordova-sqlite-storage',
        'cordova-variable' => '');
}
foreach ($ionic_natives as $ionic_native)
{
    $var = sha1($ionic_native['cordova']);
    $new_ionic_natives[$var] = $ionic_native;
}
$ionic_natives = $new_ionic_natives;

$dep_content = null;
if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    if (!file_exists($app_path . '/package.json'))
    {
        $dep_content .= '<div class="alert alert-danger"><strong><i class="fa fa-warning"></i> ' . __e('Error') . '</strong> : ' . __e('An ionic project hasn\'t been created. Create an ionic project now! click <a href="./?p=1.start-compiler">here</a>') . '</div>';
        $dep_content .= '<div id="alert-error" class="modal modal-danger fade">';
        $dep_content .= '<div class="modal-dialog">';
        $dep_content .= '<div class="modal-content">';
        $dep_content .= '<div class="modal-header">';
        $dep_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $dep_content .= '<h4 class="modal-title">' . __e('Ops..! Ionic Project Error') . '</h4>';
        $dep_content .= '</div>';
        $dep_content .= '<div class="modal-body">';
        $dep_content .= '<p>' . __e('An ionic project hasn\'t been created!') . '</p>';
        $dep_content .= '</div>';
        $dep_content .= '<div class="modal-footer">';
        $dep_content .= '<a class="btn btn-danger" href="./?p=1.start-compiler">Create An Ionic Project</a>';
        $dep_content .= '</div>';
        $dep_content .= '</div><!-- /.modal-content -->';
        $dep_content .= '</div><!-- /.modal-dialog -->';
        $dep_content .= '</div><!-- /.modal -->';
        $page_js .= "$('#alert-error').modal('show')";
    }
    $dependencies = array();
    if (file_exists($app_path . '/package.json'))
    {
        $package = json_decode(file_get_contents($app_path . '/package.json'), true);
        $dependencies = $package['dependencies'];
    }
    $dep_content .= '<div class="nav-tabs-custom">';
    $dep_content .= '<ul class="nav nav-tabs">';
    $dep_content .= '<li class="active"><a href="#dep-information" data-toggle="tab" aria-expanded="false">Information & Missing Command</a></li>';
    $dep_content .= '<li class=""><a href="#ionic-native" data-toggle="tab" aria-expanded="true">Ionic Natives</a></li>';
    $dep_content .= '<li class=""><a href="#cordova-plugin" data-toggle="tab" aria-expanded="false">Cordova Plugins</a></li>';
    $dep_content .= '<li class=""><a href="#dependencies" data-toggle="tab" aria-expanded="false">Dependencies</a></li>';
    $dep_content .= '</ul>';
    $dep_content .= '<div class="tab-content">';
    $dep_content .= '<div class="tab-pane" id="ionic-native">';
    $dep_content .= '<div class="panel">';
    $dep_content .= '<div class="panel-body">';
    $dep_content .= '<p>' . __e('The ionic-natives that have been installed are:') . '</p>';
    $dep_content .= '<table class="table table-striped">';
    $dep_content .= '<tr>';
    $dep_content .= '<th>';
    $dep_content .= __e('#');
    $dep_content .= '</th>';
    $dep_content .= '<th>';
    $dep_content .= __e('Ionic Natives');
    $dep_content .= '</th>';
    $dep_content .= '<th>';
    $dep_content .= __e('Version');
    $dep_content .= '</th>';
    $dep_content .= '</tr>';
    $z = 1;
    foreach (array_keys($dependencies) as $dependency)
    {
        if (substr($dependency, 0, 13) == '@ionic-native')
        {
            $dep_content .= '<tr>';
            $dep_content .= '<td>';
            $dep_content .= $z;
            $dep_content .= '</td>';
            $dep_content .= '<td>';
            $dep_content .= $dependency;
            $dep_content .= '</td>';
            $dep_content .= '<td>';
            $dep_content .= $dependencies[$dependency];
            $dep_content .= '</td>';
            $dep_content .= '</tr>';
            $z++;
        }
    }
    $dep_content .= '</table>';
    $native_missing = array();
    foreach ($ionic_natives as $ionic_native)
    {
        if ($ionic_native['native'] != '')
        {
            $preg_native_name = '';
            $missing = true;
            $native_name = $ionic_native['native'];
            if (substr($native_name, 0, 13) == '@ionic-native')
            {
                foreach (array_keys($dependencies) as $dependency)
                {
                    if (substr($dependency, 0, 13) == '@ionic-native')
                    {
                        $preg_native_name = str_replace("@ionic-native/", "", $native_name);
                        $new_dependency = str_replace("@ionic-native/", "", $dependency);
                        $new_preg_native_name = $preg_native_name;
                        if ($new_preg_native_name == $new_dependency)
                        {
                            $missing = false;
                        }
                        //echo '-' . $new_preg_native_name . '=>' . $new_dependency . '=' . $missing . '<br/>';
                    }
                }
            }
            if ($missing == true)
            {
                if ($preg_native_name != '')
                {
                    $native_missing[] = $preg_native_name;
                }
            }
        }
    }
    if (count($native_missing) != 0)
    {
        $dep_content .= '<span class="label label-danger">missing</span> : <code>' . implode(', ', $native_missing) . '</code>';
    }
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $new_cordova_plugins = array();
    foreach (glob($app_path . "/plugins/*") as $dir_plugin)
    {
        if (file_exists($dir_plugin . '/package.json'))
        {
            $cordova_plugins = json_decode(file_get_contents($dir_plugin . '/package.json'), true);
            $new_cordova_plugins[] = array('name' => $cordova_plugins['name'], 'version' => $cordova_plugins['version']);
        }
    }
    $dep_content .= '<div class="tab-pane" id="cordova-plugin">';
    $dep_content .= '<div class="panel">';
    $dep_content .= '<div class="panel-body">';
    $dep_content .= '<p>' . __e('The cordova plugins that have been installed are:') . '</p>';
    $z = 1;
    $dep_content .= '<table class="table table-striped">';
    $dep_content .= '<tr>';
    $dep_content .= '<th>';
    $dep_content .= __e('#');
    $dep_content .= '</th>';
    $dep_content .= '<th>';
    $dep_content .= __e('Cordova Plugins');
    $dep_content .= '</th>';
    $dep_content .= '<th>';
    $dep_content .= __e('Version');
    $dep_content .= '</th>';
    $dep_content .= '</tr>';
    foreach ($new_cordova_plugins as $new_cordova_plugin)
    {
        $dep_content .= '<tr>';
        $dep_content .= '<td>';
        $dep_content .= $z;
        $dep_content .= '</td>';
        $dep_content .= '<td>';
        $dep_content .= $new_cordova_plugin['name'];
        $dep_content .= '</td>';
        $dep_content .= '<td>';
        $dep_content .= $new_cordova_plugin['version'];
        $dep_content .= '</td>';
        $dep_content .= '</tr>';
        $z++;
    }
    $dep_content .= '</table>';
    $cordova_plugin_missing = array();
    foreach ($ionic_natives as $ionic_native)
    {
        if ($ionic_native['cordova'] != '')
        {
            $missing = true;
            $cordova_plugin_name = str_replace("/", "\/", $ionic_native['cordova']);
            foreach (glob($app_path . "/plugins/*") as $dir_plugin)
            {
                if (file_exists($dir_plugin . '/package.json'))
                {
                    $cordova_plugins = json_decode(file_get_contents($dir_plugin . '/package.json'), true);
                    if (preg_match("/$cordova_plugin_name/", $cordova_plugins['name']))
                    {
                        $missing = false;
                    }
                }
            }
            if ($missing == true)
            {
                $cordova_plugin_missing[$cordova_plugin_name] = $ionic_native;
            }
        }
    }
    $capasitor_plugin_missing = array();
    foreach ($ionic_natives as $ionic_native)
    {
        if ($ionic_native['cordova'] != '')
        {
            $missing = true;
            $cordova_plugin_name = str_replace("/", "\/", $ionic_native['cordova']);
            if (file_exists($app_path . '/node_modules/' . $cordova_plugin_name . '/plugin.xml'))
            {
                $missing = false;
            }
            if ($missing == true)
            {
                $capasitor_plugin_missing[$cordova_plugin_name] = $ionic_native;
            }
        }
    }
    if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
    {
        if (count($cordova_plugin_missing) != 0)
        {
            $dep_content .= '<span class="label label-danger">missing</span> : <code>' . implode(', ', array_keys($cordova_plugin_missing)) . '</code>';
        }
    } else
    {
        if (count($capasitor_plugin_missing) != 0)
        {
            $dep_content .= '<span class="label label-danger">missing</span> : <code>' . implode(', ', array_keys($capasitor_plugin_missing)) . '</code>';
        }
    }
    $dep_content .= '';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '<div class="tab-pane" id="dependencies">';
    $dep_content .= '<div class="panel">';
    $dep_content .= '<div class="panel-body">';
    $dep_content .= '<p>' . __e('All dependencies that have been installed are:') . '</p>';
    $dep_content .= '<table class="table table-striped" data-type="datatable">';
    $dep_content .= '<thead>';
    $dep_content .= '<tr>';
    $dep_content .= '<th>';
    $dep_content .= __e('#');
    $dep_content .= '</th>';
    $dep_content .= '<th>';
    $dep_content .= __e('Ionic Native');
    $dep_content .= '</th>';
    $dep_content .= '<th>';
    $dep_content .= __e('Version');
    $dep_content .= '</th>';
    $dep_content .= '</tr>';
    $dep_content .= '</thead>';
    $dep_content .= '<tbody>';
    $z = 1;
    foreach (array_keys($dependencies) as $dependency)
    {
        $dep_content .= '<tr>';
        $dep_content .= '<td>';
        $dep_content .= $z;
        $dep_content .= '</td>';
        $dep_content .= '<td>';
        $dep_content .= $dependency;
        $dep_content .= '</td>';
        $dep_content .= '<td>';
        $dep_content .= $dependencies[$dependency];
        $dep_content .= '</td>';
        $dep_content .= '</tr>';
        $z++;
    }
    $dep_content .= '</tbody>';
    $dep_content .= '</table>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '<div class="tab-pane active" id="dep-information">';
    $dep_content .= '<div class="panel">';
    $dep_content .= '<div class="panel-body">';
    $file_config = realpath($dir_path . '/' . $app_prefix . '/config.xml');
    $config_stat = stat($file_config);
    $dep_content .= '<div class="panel panel-default">';
    $dep_content .= '<div class="panel-body">';
    $dep_content .= '<h4>' . __e('Project Information') . '</h4>';
    $dep_content .= '<dl class="dl-horizontal">';
    $dep_content .= '<dt>UID Files</dt>';
    $dep_content .= '<dd>' . $config_stat['uid'] . '</dd>';
    $dep_content .= '<dt>NPM Configuration</dt>';
    $dep_content .= '<dd><a target="_blank" href="./outputs/' . $app_prefix . '/package.json">package.json</a></dd>';
    $dep_content .= '<dt>Cordova Configuration</dt>';
    $dep_content .= '<dd><a target="_blank" href="./outputs/' . $app_prefix . '/config.xml">config.xml</a></dd>';
    if (file_exists($google_services_dir . '/google-services.json'))
    {
        $dep_content .= '<dt>Google Services</dt>';
        $dep_content .= '<dd><a target="_blank" href="./outputs/' . $app_prefix . '/google-services.json">google-services.json</a></dd>';
    }
    $dep_content .= '</dl>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '<div class="panel panel-default">';
    $dep_content .= '<div class="panel-body">';
    $dep_content .= '<h4>' . __e('Missing or Error') . '</h4>';
    $dep_content .= '<p class="lead">' . __e('Below this is a command that has been missed/error/failed to execute, <ins>please try again</ins>!') . '</p>';
    $dep_content .= '<p>' . __e('Go to your ionic project:') . '</p>';
    switch ($os_type)
    {
        case 1:
            $dep_content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 2:
            //window
            $dep_content .= '<pre class="shell">cd /D "' . $app_path . '"</pre>';
            break;
        case 3:
            //linux
            $dep_content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
        case 4:
            //osx
            $dep_content .= '<pre class="shell">cd "' . $app_path . '"</pre>';
            break;
    }
    $dep_content .= '<p>' . __e('Try running the following command again:') . '</p>';
    $dep_content .= '<ol>';
    $is_missing = false;
    if (count($native_missing) != 0)
    {
        foreach ($native_missing as $native_error)
        {
            $dep_content .= '<li>You must install <em>ionic native</em> for <strong class="text-danger">' . $native_error . '</strong><br/>';
            $dep_content .= '<pre class="shell">npm install @ionic-native/' . $native_error . '@latest --save</pre>';
            $dep_content .= '</li>';
            $missing_command[] = 'npm install @ionic-native/' . $native_error . '@latest --save';
            $is_missing = true;
        }
    }

    // TODO: LAYOUT --|-- CORDOVA --|-- CORDOVA PLUGIN
    if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
    {
        if (count($cordova_plugin_missing) != 0)
        {
            foreach ($cordova_plugin_missing as $cordova_plugin_error)
            {
                $param = null;
                if (!isset($cordova_plugin_error['cordova-variable']))
                {
                    $cordova_plugin_error['cordova-variable'] = array();
                }
                if (!is_array($cordova_plugin_error['cordova-variable']))
                {
                    $cordova_plugin_error['cordova-variable'] = array();
                }
                if (count($cordova_plugin_error['cordova-variable']) != 0)
                {
                    foreach ($cordova_plugin_error['cordova-variable'] as $native_variable)
                    {
                        $param .= ' --variable ';
                        $param .= ' ' . $native_variable['var'] . '="' . $native_variable['val'] . '"';
                    }
                }
                $dep_content .= '<li>You must install <em>cordova plugin</em> for <strong class="text-danger">' . $cordova_plugin_error['cordova'] . '</strong><br/>';
                if (substr($cordova_plugin_error['cordova'], 0, 19) == "https://github.com/")
                {
                    $dep_content .= '<pre class="shell">ionic cordova plugin add ' . $cordova_plugin_error['cordova'] . ' --save ' . $param . '</pre>';
                } else
                {
                    $dep_content .= '<pre class="shell">ionic cordova plugin add ' . $cordova_plugin_error['cordova'] . '@latest --save ' . $param . '</pre>';
                }
                $dep_content .= '</li>';
                $is_missing = true;
                if (substr($cordova_plugin_error['cordova'], 0, 19) == "https://github.com/")
                {
                    $missing_command[] = 'ionic cordova plugin add ' . $cordova_plugin_error['cordova'] . ' --save ' . $param . '';
                } else
                {
                    $missing_command[] = 'ionic cordova plugin add ' . $cordova_plugin_error['cordova'] . '@latest --save ' . $param . '';
                }
            }
        }
    } else
    {
        // TODO: LAYOUT --|-- CAPASITOR --|-- CORDOVA PLUGIN
        if (count($capasitor_plugin_missing) != 0)
        {
            foreach ($capasitor_plugin_missing as $cordova_plugin_error)
            {
                if (substr($cordova_plugin_error['cordova'], 0, 19) == "https://github.com/")
                {
                    $dep_content .= '<pre class="shell">npm install ' . $cordova_plugin_error['cordova'] . ' --save</pre>';
                } else
                {
                    $dep_content .= '<pre class="shell">npm install ' . $cordova_plugin_error['cordova'] . '@latest --save</pre>';
                }


                $missing_command[] = 'npm install ' . $cordova_plugin_error['cordova'] . '@latest --save';
            }
        }

    }


    if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
    {
        if (!isset($dependencies['@ionic/storage-angular']))
        {
            $dep_content .= '<li>You must install <strong class="text-danger">ionic storage</strong><br/>';
            $dep_content .= '<pre class="shell">npm install --save @ionic/storage-angular@latest</pre>';
            $dep_content .= '</li>';
            $is_missing = true;
            $missing_command[] = 'npm install --save @ionic/storage-angular@latest';
        }
    }
    if (isset($_SESSION['CURRENT_APP']['localization']))
    {
        if (count($_SESSION['CURRENT_APP']['localization']) != 0)
        {
            if (!isset($dependencies['@ngx-translate/core']))
            {
                $dep_content .= '<li>Install <code>@ngx-translate/core</code> module<br/>';
                $dep_content .= '<pre class="shell">npm install @ngx-translate/core --save</pre>';
                $dep_content .= '</li>';
                $is_missing = true;
                $missing_command[] = 'npm install @ngx-translate/core --save';
            }
            if (!isset($dependencies['@ngx-translate/http-loader']))
            {
                $dep_content .= '<li>Install <code>@ngx-translate/core</code> module<br/>';
                $dep_content .= '<pre class="shell">npm install @ngx-translate/http-loader --save</pre>';
                $dep_content .= '</li>';
                $is_missing = true;
                $missing_command[] = 'npm install @ngx-translate/http-loader --save';
            }
        }
    }
    if ($is_missing == false)
    {
        $dep_content .= '<li>Ops! There are <strong>no errors</strong> in the ionic-native/cordova plugin</li>';
    }

    if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
    {
        $dep_content .= '<pre class="shell">ionic cap sync</pre>';
    }

    $dep_content .= '</ol>';
    $dep_content .= '<hr/>';
    $dep_content .= '<h4>' . __e('Clean Cache') . '</h4>';
    $dep_content .= '<p>' . __e('If it is caused by internet interruption or corrupt file, please run this command to clean the files that have been downloaded previously.') . '</p>';
    $dep_content .= '<pre class="shell">npm cache clean --force</pre>';
    $dep_content .= '<p>' . __e('And If you are a windows user, try deleting all files in this folder:') . '</p>';
    $dep_content .= '<pre>C:\Users\{{your-username}}\AppData\Roaming\npm-cache</pre>';
    $dep_content .= '<p>' . __e('Then run this command:') . '</p>';
    $dep_content .= '<pre class="shell">npm cache verify</pre>';
    $dep_content .= '<p>' . __e('After that run the missing command again.') . '</p>';
    
    $dep_content .= '<hr/>';
    $dep_content .= '<h4>' . __e('AndroidX Issue') . '</h4>';
    $dep_content .= '<p>' . __e('This Cordova/Phonegap plugin enables AndroidX in a Cordova project (AndroidX is the successor to the Android Support Library)') . '</p>';
    
        $dep_content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-androidx</pre>';
        $dep_content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-androidx-adapter</pre>';
        
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '</div>';
    $dep_content .= '';
    $dep_content .= '</div><!-- ./tab-content -->';
    $dep_content .= '</div><!-- ./nav-tabs-custom -->';
}
$fix_cmd .= '@ECHO OFF' . "\r\n";
$fix_cmd .= 'color 0a' . "\r\n";
$fix_cmd .= '' . "\r\n";
$i = 65;
foreach ($missing_command as $cmd)
{
    $fix_cmd .= 'GOTO Command' . chr($i) . "\r\n";
    $i++;
}
$fix_cmd .= '' . "\r\n";
$i = 65;
foreach ($missing_command as $cmd)
{
    $fix_cmd .= ':Command' . chr($i) . ':' . "\r\n";
    $fix_cmd .= 'ECHO ' . $cmd . "\r\n";
    $fix_cmd .= 'CALL ' . $cmd . "\r\n";
    $fix_cmd .= '' . "\r\n";
    $i++;
}


if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    $fix_cmd .= 'ECHO ionic cap sync' . "\r\n";
    $fix_cmd .= 'CALL ionic cap sync' . "\r\n";
}
file_put_contents($dir_path . '/' . $app_prefix . '/fix.cmd', $fix_cmd);
$content .= '<div class="alert alert-success alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('The code has been updated! Refresh this page or save something change to rebuild the code again') . '</div>';
$content .= $dep_content;
// TODO: UPDATE NATIVE AND CORDOVA
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Update Ionic Native and Cordova Plugin') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
if (JSM_IONIC_PROJECT_SAME_FOLDER == false)
{
    $xcopy_cmd = 'xcopy /Y /S "' . $dir_path . '\\' . $app_prefix . '\*"';
    $copy_cmd = 'yes | cp -rf "' . $dir_path . '/' . $app_prefix . '/" .';
    $content .= '<p>' . __e('Before copy the output code into your ionic project') . '</p>';
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
    $content .= '<br/>';
}
$content .= '<p>' . __e('You have to update every time a change is made on your app, the following are the plugins that must be updated on your app:') . '</p>';
$content .= '<ul>';
if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Go to your ionic project:') . '</p>';
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
    $content .= '<p>' . __e('Go to your ionic project:') . '</p>';
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
$content .= '<p>' . __e('You can run a shortcut command, or do it as usual. The shortcut command is:') . '</p>';
switch ($os_type)
{
    case 1:
        $content .= '<pre class="shell">"../update.sh"</pre>';
        break;
    case 2:
        //window
        $content .= '<pre class="shell">"../update.cmd"</pre>';
        break;
    case 3:
        //linux
        $content .= '<pre class="shell">"../update.sh"</pre>';
        break;
    case 4:
        //osx
        $content .= '<pre class="shell">"../update.sh"</pre>';
        break;
}
$content .= '</li>';
$content .= '<li>';
$content .= '<p>Install the cordova plugins:</p>';
$content .= '<ol>';
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
        $content .= '<p>' . __e('Install ') . ' <code>' . $ionic_native['cordova'] . '</code> ' . __e('plugin ') . '</p>';
        if (substr($ionic_native['cordova'], 0, 19) == "https://github.com/")
        {
            if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['cordova'] . ' --save ' . $param . '</pre>';
            } else
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['cordova'] . ' --save ' . $param . '</pre>';
            }
        } else
        {
            if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['cordova'] . '@latest --save ' . $param . '</pre>';
            } else
            {
                $content .= '<pre class="shell">npm install ' . $ionic_native['cordova'] . '@latest --save ' . $param . '</pre>';
            }
        }
        $content .= '</li>';
    }
}
$content .= '</ol>';
$content .= '</li>';
$content .= '<li>';
$content .= '<p>Install the Ionic Native and Angular Modules:</p>';
$content .= '<ol>';
if (isset($_SESSION['CURRENT_APP']['localization']))
{
    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Install <code>ngx-translate</code> module') . '</p>';
        $content .= '<pre class="shell">npm install @ngx-translate/core --save</pre>';
        $content .= '<pre class="shell">npm install @ngx-translate/http-loader --save</pre>';
        $content .= '</li>';
    }
}
if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Update the <code>@ionic/storage-angular</code> module') . '</p>';
    $content .= '<pre class="shell">npm install --save @ionic/storage-angular@latest</pre>';
    $content .= '</li>';
}
$content .= '<li>';
$content .= '<p>' . __e('Update the <code>@ionic-native/core</code> module') . '</p>';
$content .= '<pre class="shell">npm install --save @ionic-native/core@latest</pre>';
$content .= '</li>';
foreach ($ionic_natives as $ionic_native)
{
    if (substr($ionic_native['native'], 0, 13) == '@ionic-native')
    {
        if ($ionic_native['native'] != '')
        {
            $content .= '<li>';
            $content .= '<p>' . __e('Install ') . '<code>' . $ionic_native['native'] . '</code> ' . __e('module ') . '</p>';
            $content .= '<pre class="shell">npm install --save ' . $ionic_native['native'] . '@latest</pre>';
            $content .= '</li>';
        }
    }
}
$content .= '</ol>';
$content .= '</li>';
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == true)
{
    $content .= '<li>';
    $content .= '<p>' . __e('Then sync it with the project') . '</p>';
    $content .= '<pre class="shell">ionic cap sync</pre>';
    $content .= '</li>';
}
$content .= '<li>';
$content .= '<p>' . __e('Run web emulator') . '</p>';
$content .= '<pre class="shell">ionic serve --external --consolelogs</pre>';
$content .= '</li>';
$content .= '</ul>';
$content .= '</div><!-- ./box-body -->';
$content .= '</div>';
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    // TODO: GLOBAL UPDATE
    $content .= '<div class="box box-info">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('How to update the Android SDK, API levels,  and Target SDK?') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';
    $content .= '<ol>';
    $content .= '<li>';
    $content .= '<p>' . __e('Connect your internet') . '</p>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('Run your Android Studio -&raquo; File - Setting -&raquo; SDK Manager -&raquo; Appearance &amp; Bahavior -&raquo; System Setting -&raquo; Android SDK -&raquo; SDK Platform -&raquo; <strong>Update SDK Platform</strong>, checked <strong>Android 10.x</strong> or latest and delete the old version') . '</p>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('Then Update <strong>SDK Builds-Tools</strong>, checked <strong>SDK Build-Tools 29.x</strong> or latest') . '</p>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('For Windows user, go to <strong>Control Panel</strong> -&raquo; System -&raquo; Advanced System Setting -&raquo; Tab Advance -&raquo; <strong>Environment Variables</strong> Button, and edit environ for <code>PATH</code> according <strong>SDK Build-Tools</strong> path, for Linux/OSx user: you can edit ~/.bashrc, ~/.bash_profile, or similar shell startup scripts or using command export') . '</p>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('Then run <code>Node.js command prompt</code> or using <code>terminal/bash</code>') . '</p>';
    $content .= '</li>';
    if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
    {
        $content .= '<li>';
        $content .= '<p>' . __e('Go to your ionic project:') . '</p>';
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
        $content .= '<p>' . __e('Go to your ionic project:') . '</p>';
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
    $content .= '<p>' . __e('Install <code>cordova-check-plugins</code> module') . '</p>';
    $content .= '<pre class="shell">npm install -g cordova-check-plugins --save</pre>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('Update your cordova plugin') . '</p>';
    $content .= '<pre class="shell">cordova-check-plugins --update=auto</pre>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('Then deleted android platform then add it again') . '</p>';
    $content .= '<pre class="shell">ionic cordova platform remove android</pre>';
    $content .= '<pre class="shell">ionic cordova platform add android@latest</pre>';
    $content .= '</li>';
    $content .= '</ol>';
    $content .= '</div><!-- ./box-body -->';
    $content .= '</div>';
}
if ($_SESSION['CURRENT_APP']['apps']['capasitor'] == false)
{
    // TODO: REMOVE IONIC NATIVE
    $content .= '<div class="box box-info">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Remove Ionic Native and Cordova Plugin') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';
    $content .= '<ul>';
    $default_cordova_plugin = $remove_plugin = array();
    foreach ($ionicNatives as $cordova)
    {
        $default_cordova_plugin[] = $cordova['cordova'];
    }
    $default_cordova_plugin[] = 'cordova-sqlite-storage';
    foreach (glob($app_path . "/plugins/*/package.json") as $filename)
    {
        $plugin_name = basename(str_replace('package.json', '', $filename));
        if (!in_array($plugin_name, $default_cordova_plugin, true))
        {
            $content .= '<li>';
            $content .= '<p>' . __e('Remove') . ' `' . $plugin_name . '` ' . __e('plugin') . '</p>';
            $content .= '<pre class="shell">ionic cordova plugin remove ' . $plugin_name . ' --save</pre>';
            $remove_plugin[] = 'ionic cordova plugin remove ' . $plugin_name . ' --save';
            $content .= '</li>';
        }
    }
    $content .= '<li>';
    $content .= '<p>' . __e('Prepare your cordova plugin') . ':</p>';
    $content .= '<pre class="shell">cordova prepare</pre>';
    $content .= '</li>';
    $content .= '</ul>';
    $content .= '</div><!-- ./box-body -->';
    $content .= '</div>';
    $remove_cmd = null;
    $remove_cmd .= '@ECHO OFF' . "\r\n";
    $remove_cmd .= 'color 0a' . "\r\n";
    $remove_cmd .= '' . "\r\n";
    $i = 65;
    foreach ($remove_plugin as $cmd)
    {
        $remove_cmd .= 'GOTO Command' . chr($i) . "\r\n";
        $i++;
    }
    $remove_cmd .= '' . "\r\n";
    $i = 65;
    foreach ($remove_plugin as $cmd)
    {
        $remove_cmd .= ':Command' . chr($i) . ':' . "\r\n";
        $remove_cmd .= 'ECHO ' . $cmd . "\r\n";
        $remove_cmd .= 'CALL ' . $cmd . "\r\n";
        $remove_cmd .= '' . "\r\n";
        $i++;
    }
    file_put_contents($dir_path . '/' . $app_prefix . '/remove.cmd', $remove_cmd);
}
$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Update Plugins and Errors');
$template->page_desc = __e('Update your Ionic Native and Cordova Plugin');
$template->page_content = $content;
