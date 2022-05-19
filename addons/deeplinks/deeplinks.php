<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `deeplinks`
 */


defined('JSM_EXEC') or die('Silence is golden');


// FIX PLUGIN ISSUE
$issue_plugin_path = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/plugins/ionic-plugin-deeplinks/www/deeplink.js';
$issue_platform_path = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/platforms/android/platform_www/plugins/ionic-plugin-deeplinks/www/deeplink.js';


if (file_exists($issue_plugin_path))
{
    $raw_content = file_get_contents($issue_plugin_path);
    $raw_content = str_replace("var matchedParams = self.routeMatch(pathData, realPath);", "var matchedParams = self.routeMatch(targetPath, realPath);", $raw_content);
    file_put_contents($issue_plugin_path, $raw_content);
}

if (file_exists($issue_platform_path))
{
    $raw_content = file_get_contents($issue_platform_path);
    $raw_content = str_replace("var matchedParams = self.routeMatch(pathData, realPath);", "var matchedParams = self.routeMatch(targetPath, realPath);", $raw_content);
    file_put_contents($issue_platform_path, $raw_content);
}


$is_debug = true;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("deeplinks");
$string = new jsmString();

$current_page_target = 'core';

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('deeplinks', 'core');
    $db->deleteGlobal('deeplinks', 'core');
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=deeplinks&' . time());
}

// TODO: POST
if (isset($_POST['save-deeplinks']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = $current_page_target;
    $addons['page-header-color'] = trim($_POST['deeplinks']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['deeplinks']['page-content-background']);
    $addons['url-scheme'] = trim($_POST['deeplinks']['url-scheme']);
    $addons['deeplink-scheme'] = trim($_POST['deeplinks']['deeplink-scheme']);
    $addons['deeplink-host'] = trim($_POST['deeplinks']['deeplink-host']);
    $db->saveAddOns('deeplinks', $addons);


    $global['name'] = $current_page_target;
    $global['note'] = 'This code is used for Deeplinks';

    $z = 0;

    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'Deeplinks';
    $global['modules'][$z]['var'] = 'deeplinks';
    $global['modules'][$z]['path'] = '@ionic-native/deeplinks/ngx';
    $global['modules'][$z]['native'] = 'deeplinks';
    $global['modules'][$z]['cordova'] = 'ionic-plugin-deeplinks';

    $global['modules'][$z]['cordova-variable'][0]['var'] = 'URL_SCHEME';
    $global['modules'][$z]['cordova-variable'][0]['val'] = $addons['url-scheme'];

    $global['modules'][$z]['cordova-variable'][1]['var'] = 'DEEPLINK_SCHEME';
    $global['modules'][$z]['cordova-variable'][1]['val'] = $addons['deeplink-scheme'];

    $global['modules'][$z]['cordova-variable'][2]['var'] = 'DEEPLINK_HOST';
    $global['modules'][$z]['cordova-variable'][2]['val'] = $addons['deeplink-host'];

    $global['modules'][$z]['cordova-variable'][3]['var'] = 'ANDROID_PATH_PREFIX';
    $global['modules'][$z]['cordova-variable'][3]['val'] = '/';

    //$z++;
    //$global['modules'][$z]['enable'] = true;
    //$global['modules'][$z]['class'] = 'NavController';
    //$global['modules'][$z]['var'] = 'NavController';
    //$global['modules'][$z]['path'] = '@ionic-native/deeplinks/ngx';


    $routes = null;
    $routes .= "\t\t\t\t\t" . '"/" : {},' . "\r\n";
    foreach ($db->getPages() as $page)
    {
        //$routes .= "\t\t\t\t\t" . '"/' . $string->toFileName($page['name']) . '" : ' . $string->toClassName($page['name']) . 'Page,' . "\r\n";
        $routes .= "\t\t\t\t\t" . '"/' . $string->toFileName($page['name']) . '" : {' . $string->toClassName($page['name']) . 'Page:true},' . "\r\n";
        if (isset($page['param']))
        {
            $params = $string->toArray($page['param']);
            if (count($params) != 0)
            {
                $param_pattern = '';
                foreach ($params as $param)
                {
                    $param_pattern .= '/:' . $string->toVar($param);
                    //$routes .= "\t\t\t\t\t" . '"/' . $string->toFileName($page['name']) . '' . $param_pattern . '" : ' . $string->toClassName($page['name']) . 'Page,' . "\r\n";
                    $routes .= "\t\t\t\t\t" . '"/' . $string->toFileName($page['name']) . '' . $param_pattern . '" : {' . $string->toClassName($page['name']) . 'Page:true},' . "\r\n";
                }
            }
        }
    }


    $global['component'][0]['code']['export'] = null;
    //foreach ($db->getPages() as $page)
    //{
    //    $global['component'][0]['code']['export'] .= "\t\t" . 'import { ' . $string->toClassName($page['name']) . 'Page } from "./pages/' . $string->toFileName($page['name']) . '/' . $string->toFileName($page['name']) . '.page";' . "\r\n";
    // }


    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['init'] = "\t\t" . 'this.handlerDeeplinks();';
    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerDeeplinks()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'public handlerDeeplinks(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if(this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.deeplinks.route({' . "\r\n";
    //$global['component'][0]['code']['other'] .= "\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= substr($routes, 0, (strlen($routes) - 3));
    $global['component'][0]['code']['other'] .= "\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}).subscribe(match =>  {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.log("matched route", match);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.log("goto", match.$link.path);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.router.navigate([match.$link.path]);' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.log("Successfully matched route", match);' . "\r\n";

    $global['component'][0]['code']['other'] .= "\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}, nomatch => {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.error("Got a deeplink that didn\'t match", nomatch);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";


    $db->saveGlobal('deeplinks', $global);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=deeplinks&' . time());

}

// TODO: INIT
$disabled = null;
$isExist = true;
$current_setting = $db->getAddOns('deeplinks', $current_page_target);


if (!isset($current_setting['url-scheme']))
{
    $isExist = false;
    $current_setting['url-scheme'] = strtolower(metaphone($current_app['apps']['app-name']));
}

if (!isset($current_setting['deeplink-scheme']))
{
    $current_setting['deeplink-scheme'] = 'https';
}

if (!isset($current_setting['deeplink-host']))
{
    $current_setting['deeplink-host'] = 'ihsana.com';
}


// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-danger">' . __e('Adding deeplinks to the app must be done at the last step in the application creation, then please complete the form below to let us know how we can help you build code:') . '</div>';
//$content .= '<div class="callout callout-danger">' . __e('This plugin is not yet usable, still in the coding stage!') . '</div>';
$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- URL-SCHEME
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-url-scheme">' . __e('URL Scheme') . '</label>';
$content .= '<input id="page-url-scheme" type="text" name="deeplinks[url-scheme]" class="form-control" placeholder="ihsana"  value="' . $current_setting['url-scheme'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('The custom URL scheme you\'d like to use for your app, This lets your app respond to links like <code>myapp://blah</code>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- DEEPLINK-SCHEME
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-deeplink-scheme">' . __e('Deeplink Scheme') . '</label>';

$option_schemes[] = 'https';
$option_schemes[] = 'http';

$content .= '<select id="page-deeplink-scheme" name="deeplinks[deeplink-scheme]" class="form-control">';
foreach ($option_schemes as $option_scheme)
{
    $selected = '';
    if ($current_setting['deeplink-scheme'] == $option_scheme)
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $option_scheme . '" ' . $selected . '>' . $option_scheme . '</option>';
}
$content .= '</select>';

//$content .= '<input id="page-deeplink-scheme" type="text" name="deeplinks[deeplink-scheme]" class="form-control" placeholder="https"  value="' . $current_setting['deeplink-scheme'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('The scheme to use for universal/app links. Defaults to <code>https</code> in 1.0.13. 99% of the time you\'ll use https here as iOS and Android require SSL for app links domains.') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- DEEPLINK-HOST
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-deeplink-host">' . __e('Deeplink Host') . '</label>';
$content .= '<input id="page-deeplink-host" type="text" name="deeplinks[deeplink-host]" class="form-control" placeholder="ihsana.net"  value="' . $current_setting['deeplink-host'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('The host that will respond to deeplinks. For example, if we want <code>example.com/product/cool-beans</code> to open in our app, we\'d use <code>example.com</code> here.') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-deeplinks" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
if ($isExist == true)
{
    $content .= '&nbsp;or&nbsp;<a class="btn btn-link btn-flat" href="./?p=addons&addons=deeplinks&a=delete">' . __e('Delete this Settings') . '</a>';
}
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Docs') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<ol>';

$content .= '<li>';
$content .= '<p>' . __e('Remove old plugins first:') . '</p>';
$content .= '<pre class="shell">ionic cordova plugin remove ionic-plugin-deeplinks</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('For deeplinks to work properly, please install the following support plugins:') . '</p>';
$content .= '<pre class="shell">ionic cordova plugin add ionic-plugin-deeplinks@latest --save  --variable  URL_SCHEME="' . $current_setting['url-scheme'] . '" --variable  DEEPLINK_SCHEME="' . $current_setting['deeplink-scheme'] . '" --variable  DEEPLINK_HOST="' . $current_setting['deeplink-host'] . '" --variable  ANDROID_PATH_PREFIX="/"</pre>';
$content .= '<pre class="shell">npm install --save @ionic-native/deeplinks@latest</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Refresh this page twice, so that this addon can fix bugs in the plugin') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then try to build your apk again') . '</p>';
$content .= '<pre class="shell">ionic cordova platform add android@latest</pre>';
$content .= '<p>' . __e('or') . '</p>';
$content .= '<pre class="shell">ionic cordova platform prepare android</pre>';
$content .= '<pre class="shell">ionic cordova build android</pre>';
$content .= '</li>';


$content .= '<li>';
$content .= '<p>' . __e('Upload this code to your website, use the link as below on your website for test:') . '</p>';

$example_link = null;
foreach ($db->getPages() as $page)
{
    $example_link .= "" . '<p><a target="_blank" href="' . $current_setting['url-scheme'] . '://' . $current_setting['deeplink-host'] . '/' . $string->toFileName($page['name']) . '">' . $page['name'] . '</a></p>' . "\r\n";
    if (isset($page['param']))
    {
        $params = $string->toArray($page['param']);
        if (count($params) != 0)
        {
            $param_pattern = '';
            foreach ($params as $param)
            {
                $param_pattern .= '/1';
                $example_link .= "" . '<p><a target="_blank" href="' . $current_setting['url-scheme'] . '://' . $current_setting['deeplink-host'] . '/' . $string->toFileName($page['name']) . '' . $param_pattern . '">' . $page['name'] . '</a></p>' . "\r\n";
            }
        }
    }
}
$content .= '<pre>';
$content .= htmlentities($example_link);
$content .= '</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('If still problem, refresh this page twice and try to build again') . '</p>';
$content .= '</li>';

$content .= '</ol>';


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=deeplinks&page-target="+$("#page-target").val(),!1});';
