<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `unityads`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("unityads");
$string = new jsmString();

// FIX PLUGIN ISSUE
//$issue_path = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/plugins/com-artemisoftnian-plugins-unityads2/afterPrepareScript.js';
//if (file_exists($issue_path))
//{
//    $raw_content = file_get_contents($issue_path);
//    $raw_content = str_replace("ctx.requireCordovaModule", "require", $raw_content);
//    file_put_contents($issue_path, $raw_content);
//}


if (isset($_POST['delete-unityads']))
{
    $db->deleteAddOns('unityads', 'core');
    $db->deleteGlobal('unityads', 'core');
    rebuild();
    header('Location: ./?p=addons&addons=unityads&' . time());
}


// TODO: POST
if (isset($_POST['save-unityads']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    $addons['page-title'] = 'core';

    //game-id
    if (!isset($_POST['unityads']['game-id']))
    {
        $_POST['unityads']['game-id'] = '';
    }
    $addons['game-id'] = trim($_POST['unityads']['game-id']); //text

    if (isset($_POST['unityads']['is-testing']))
    {
        $addons['is-testing'] = true;
    } else
    {
        $addons['is-testing'] = false;
    }

    if (isset($_POST['unityads']['is-debugging']))
    {
        $addons['is-debugging'] = true;
    } else
    {
        $addons['is-debugging'] = false;
    }

    //banner-position
    $addons['banner-position'] = trim($_POST['unityads']['banner-position']); //select

    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        $addons['pages'][$page_name]['name'] = $page_name;
        if (isset($_POST['unityads']['pages'][$page_name]))
        {
            $addons['pages'][$page_name]['ads'] = $_POST['unityads']['pages'][$page_name]['ads'];
        } else
        {
            $addons['pages'][$page_name]['ads'] = 'none';
        }
    }

    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        $addons['pages'][$page_name]['name'] = $page_name;
        if (isset($_POST['unityads']['pages'][$page_name]))
        {
            $addons['pages'][$page_name]['banner'] = $_POST['unityads']['pages'][$page_name]['banner'];
        } else
        {
            $addons['pages'][$page_name]['banner'] = 'none';
        }
    }

    $db->saveAddOns('unityads', $addons);


    $enqueue = null;
    $enqueue['styles'] = array();
    $enqueue['scripts'][0]['url'] = 'assets/unityads.js';
    $enqueue['scripts'][0]['attr'] = '';
    $db->saveEnqueues($enqueue);


    $show_video = $show_video_reward = $show_banner = array();

    foreach ($addons['pages'] as $page)
    {
        if ($page['ads'] == 'banner')
        {
            $show_banner[] = 'pageName == `' . $page['name'] . '`';
        }

        if ($page['ads'] == 'video')
        {
            $show_video[] = 'pageName == `' . $page['name'] . '`';
        }
        if ($page['ads'] == 'video-reward')
        {
            $show_video_reward[] = 'pageName == `' . $page['name'] . '`';
        }
    }

    foreach ($addons['pages'] as $page)
    {
        if ($page['banner'] == 'banner')
        {
            $show_banner[] = 'pageName == `' . $page['name'] . '`';
        }
    }

    $code = null;
    $code .= "" . '' . "\r\n";
    $code .= "" . 'var GAME_ID = "' . $addons['game-id'] . '";' . "\r\n";
    $code .= "" . 'var VIDEO_ADS_PLACEMENT_ID = "video";' . "\r\n";
    $code .= "" . 'var REWARD_VIDEO_ADS_PLACEMENT_ID = "rewardedVideo";' . "\r\n";
    $code .= "" . 'var BANNER_ADS_PLACEMENT_ID = "unityBanner";' . "\r\n";
    $code .= "" . 'var BANNER_POSITION = "' . $addons['banner-position'] . '";' . "\r\n";

    if ($addons['is-testing'] == true)
    {
        $code .= "" . 'var IS_TEST = true;' . "\r\n";
    } else
    {
        $code .= "" . 'var IS_TEST = false;' . "\r\n";
    }

    if ($addons['is-debugging'] == true)
    {
        $code .= "" . 'var IS_DEBUG = true;' . "\r\n";
    } else
    {
        $code .= "" . 'var IS_DEBUG = false;' . "\r\n";
    }
    $code .= "" . '' . "\r\n";
    $code .= "" . '' . "\r\n";
    $code .= "" . 'var app = {' . "\r\n";
    $code .= "\t" . 'initialize: function() {' . "\r\n";
    $code .= "\t\t" . 'document.addEventListener("deviceready", this.onDeviceReady.bind(this), false);' . "\r\n";
    $code .= "\t" . '},' . "\r\n";
    $code .= "\t" . 'onDeviceReady: function(){' . "\r\n";
    $code .= "\t\t" . 'if(cordova.plugins && cordova.plugins.UnityAds3){' . "\r\n";

    $code .= "\t\t\t\t" . 'cordova.plugins.UnityAds3.UnityAdsInit(GAME_ID, IS_TEST, IS_DEBUG, function callback(error, result){' . "\r\n";
    $code .= "\t\t\t\t\t" . 'if(error){' . "\r\n";
    $code .= "\t\t\t\t\t\t" . 'console.log(`UnityAdsInit`,`error:`, error)' . "\r\n";
    $code .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $code .= "\t\t\t\t\t\t" . 'console.log(`UnityAdsInit`,`result:`, result);' . "\r\n";
    $code .= "\t\t\t\t\t" . '}' . "\r\n";
    $code .= "\t\t\t\t" . '});' . "\r\n";


    $code .= "\t\t\t\t" . 'function hashHandler(){' . "\r\n";
    $code .= "\t\t\t\t\t" . 'this.oldUrl = window.location.href;' . "\r\n";
    $code .= "\t\t\t\t\t" . 'this.Check;' . "\r\n";
    $code .= "\t\t\t\t\t" . 'var that = this;' . "\r\n";
    $code .= "\t\t\t\t\t" . 'var detect = function(){' . "\r\n";
    $code .= "\t\t\t\t\t\t" . 'if(that.oldUrl != window.location.href){' . "\r\n";
    $code .= "\t\t\t\t\t\t\t" . 'var pageName = window.location.pathname.replace("/","");' . "\r\n";

    $code .= "\t\t\t\t\t\t\t" . 'console.log("UnityAds: Page:" + pageName);' . "\r\n";

    if (count($show_video) != 0)
    {
        $code .= "\t\t\t\t\t\t\t" . '// Show Video' . "\r\n";
        $code .= "\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $show_video) . '){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t" . 'cordova.plugins.UnityAds3.ShowVideoAd(VIDEO_ADS_PLACEMENT_ID, function callback(error, result){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . 'if(error){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t\t" . 'console.log(`ShowVideoAd`,`error:`,error)' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t\t" . 'console.log(`ShowVideoAd`,`result:`,result);' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t" . '});' . "\r\n";
        $code .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
    }

    if (count($show_video_reward) != 0)
    {
        $code .= "\t\t\t\t\t\t\t" . '// Show Rewarded Video' . "\r\n";
        $code .= "\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $show_video_reward) . '){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t" . 'cordova.plugins.UnityAds3.ShowVideoAd(REWARD_VIDEO_ADS_PLACEMENT_ID, function callback(error, result){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . 'if(error){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t\t" . 'console.log(`ShowVideoAd`,`error:`,error)' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t\t" . 'console.log(`ShowVideoAd`,`result:`,result);' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t" . '});' . "\r\n";
        $code .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
    }

    if (count($show_banner) != 0)
    {
        $code .= "\t\t\t\t\t\t\t" . '// Show Rewarded Video' . "\r\n";
        $code .= "\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $show_banner) . '){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t" . 'cordova.plugins.UnityAds3.ShowBannerAd(BANNER_ADS_PLACEMENT_ID, BANNER_POSITION, function callback(error, result){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . 'if(error){' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t\t" . 'console.log(`ShowBannerAd`,`error:`,error)' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t\t" . 'console.log(`ShowBannerAd`,`result:`,result);' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $code .= "\t\t\t\t\t\t\t\t" . '});' . "\r\n";
        $code .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
    }


    $code .= "\t\t\t\t\t\t\t" . 'that.oldUrl = window.location.href;' . "\r\n";
    $code .= "\t\t\t\t\t\t" . '}' . "\r\n";
    $code .= "\t\t\t\t\t" . '};' . "\r\n";
    $code .= "\t\t\t\t\t" . 'this.Check = setInterval(function(){ detect() }, 400);' . "\r\n";
    $code .= "\t\t\t\t" . '}' . "\r\n";
    $code .= "\t\t\t\t" . 'var hashDetection = new hashHandler();' . "\r\n";
    $code .= "\t\t\t\t" . '' . "\r\n";


    $code .= "\t\t" . '}' . "\r\n";

    $code .= "\t" . '}' . "\r\n";
    $code .= "" . '};' . "\r\n";
    $code .= "" . 'app.initialize();' . "\r\n";


    file_put_contents(JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/src/assets/unityads.js', $code);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=unityads&' . time());

}

// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
$current_setting = $db->getAddOns('unityads', 'core');

if (!isset($current_setting['game-id']))
{
    $current_setting['game-id'] = '';
}

if (!isset($current_setting['pages']))
{
    $current_setting['pages'] = array();
}


if (!isset($current_setting['is-testing']))
{
    $current_setting['is-testing'] = false;
}

if (!isset($current_setting['is-debugging']))
{
    $current_setting['is-debugging'] = false;
}

if (!isset($current_setting['banner-position']))
{
    $current_setting['banner-position'] = '';
}

// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


$content .= '<div class="notice notice-danger">This is only the code generator, please read the UnityAds rules as often as possible and apply as recommended. If you get banned/pending it\'s your mistake, use it at your own risk. If you do not agree, please do not use these addons</div>';

// TODO: LAYOUT --|-- FORM --|-- GAME-ID --|-- TEXT
$content .= '<div class="row"><!-- row -->';

$content .= '<div id="field-game-id" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-game-id">' . __e('Game ID') . '</label>';
$content .= '<input id="page-game-id" type="text" placeholder="12312334" name="unityads[game-id]" class="form-control" placeholder=""  value="' . $current_setting['game-id'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Get it from:') . ' <a href="https://dashboard.unity3d.com/" target="_blank">Unity Ads Website</a>, Go to ' . __e(' -&raquo; Monetization -&raquo; Placements') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- IS-TESTING
$checked = '';
if ($current_setting['is-testing'] == true)
{
    $checked = 'checked';
}
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-is-testing">' . __e('Mode') . '</label>';
$content .= '<div class="checkbox">';
$content .= '<label><input type="checkbox" ' . $checked . ' class="flat-blue" name="unityads[is-testing]" /> ' . __e('Test Mode (To test your cordova)') . '</label>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- IS-DEBUGGING
$checked = '';
if ($current_setting['is-debugging'] == true)
{
    $checked = 'checked';
}
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-is-testing">' . __e('') . '</label>';
$content .= '<div class="checkbox">';
$content .= '<label><input type="checkbox" ' . $checked . ' class="flat-blue" name="unityads[is-debugging]" /> ' . __e('Debug Mode') . '</label>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->';

$content .= '<p>' . __e('Please use the following Placements: ') . '<code>video</code>, <code>rewardedVideo</code> and <code>unityBanner</code></p>';


$content .= '<hr/>';

// TODO: LAYOUT --|-- FORM --|-- VIDEO-RULES
$content .= '<h3>' . __e('VideoAds Rules') . '</h3>';


$content .= '<table class="table table-striped table-bordered">';

$content .= '<thead>';
$content .= '<tr>';


$content .= '<th>';
$content .= '' . __e('Show on The Page?') . '';
$content .= '</th>';

$content .= '<th class="text-center">';
$content .= '' . __e('None') . '';
$content .= '</th>';


$content .= '<th class="text-center">';
$content .= '' . __e('Video') . '';
$content .= '</th>';

$content .= '<th class="text-center">';
$content .= '' . __e('rewardedVideo') . '';
$content .= '</th>';

$content .= '</tr>';
$content .= '</thead>';

foreach ($static_pages as $static_page)
{
    $video_checked = $video_reward_checked = '';

    $page_name = $string->toFilename($static_page['name']);

    if (!isset($current_setting['pages'][$page_name]['ads']))
    {
        $current_setting['pages'][$page_name]['ads'] = 'none';
    }

    $content .= '<tr>';

    $content .= '<td>';
    $content .= $page_name;
    $content .= '</td>';


    $content .= '<td class="text-center">';
    if ($current_setting['pages'][$page_name]['ads'] == 'none')
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][ads]" type="radio" value="none" checked="checked" class="flat-red" />';
    } else
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][ads]" type="radio" value="none" class="flat-red" />';
    }

    $content .= '</td>';


    $content .= '<td class="text-center">';
    if ($current_setting['pages'][$page_name]['ads'] == 'video')
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][ads]" type="radio" value="video" class="flat-green" checked="checked"/>';
    } else
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][ads]" type="radio" value="video" class="flat-green" />';
    }
    $content .= '</td>';

    $content .= '<td class="text-center">';
    if ($current_setting['pages'][$page_name]['ads'] == 'video-reward')
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][ads]" type="radio" value="video-reward" class="flat-blue" checked="checked"/>';
    } else
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][ads]" type="radio" value="video-reward" class="flat-blue" />';
    }
    $content .= '</td>';


    $content .= '</tr>';

}
$content .= '</table>';


// TODO: LAYOUT --|-- FORM --|-- BANNER-RULES

$content .= '<h3>' . __e('Banner Rules') . '</h3>';
// TODO: LAYOUT --|-- FORM --|-- BANNER-POSITION --|-- SELECT
$content .= '<div class="row"><!-- row -->';

$options = array();
$options[] = array('value' => 'TOP_LEFT', 'label' => 'TOP_LEFT');
$options[] = array('value' => 'TOP_CENTER', 'label' => 'TOP_CENTER');
$options[] = array('value' => 'TOP_RIGHT', 'label' => 'TOP_RIGHT');
$options[] = array('value' => 'BOTTOM_LEFT', 'label' => 'BOTTOM_LEFT');
$options[] = array('value' => 'BOTTOM_CENTER', 'label' => 'BOTTOM_CENTER');
$options[] = array('value' => 'BOTTOM_RIGHT', 'label' => 'BOTTOM_RIGHT');
$options[] = array('value' => 'CENTER', 'label' => 'CENTER');


$content .= '<div id="field-banner-position" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-banner-position">' . __e('Banner Position') . '</label>';
$content .= '<select id="page-banner-position" name="unityads[banner-position]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['banner-position'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';


$content .= '<table class="table table-striped table-bordered">';

$content .= '<thead>';
$content .= '<tr>';


$content .= '<th>';
$content .= '' . __e('Show on The Page?') . '';
$content .= '</th>';

$content .= '<th class="text-center">';
$content .= '' . __e('None') . '';
$content .= '</th>';


$content .= '<th class="text-center">';
$content .= '' . __e('Banner') . '';
$content .= '</th>';


$content .= '</tr>';
$content .= '</thead>';

foreach ($static_pages as $static_page)
{
    $video_checked = $video_reward_checked = '';

    $page_name = $string->toFilename($static_page['name']);

    if (!isset($current_setting['pages'][$page_name]['banner']))
    {
        $current_setting['pages'][$page_name]['banner'] = 'none';
    }

    $content .= '<tr>';

    $content .= '<td>';
    $content .= $page_name;
    $content .= '</td>';

    $content .= '<td class="text-center">';
    if ($current_setting['pages'][$page_name]['banner'] == 'none')
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][banner]" type="radio" value="none" checked="checked" class="flat-red" />';
    } else
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][banner]" type="radio" value="none" class="flat-red" />';
    }

    $content .= '</td>';

    $content .= '<td class="text-center">';
    if ($current_setting['pages'][$page_name]['banner'] == 'banner')
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][banner]" type="radio" value="banner" class="flat-green" checked="checked"/>';
    } else
    {
        $content .= '<input name="unityads[pages][' . $page_name . '][banner]" type="radio" value="banner" class="flat-green" />';
    }
    $content .= '</td>';


    $content .= '</tr>';

}
$content .= '</table>';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-unityads" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
if ($current_setting['game-id'] != "")
{
    $content .= '&nbsp;or&nbsp;<input name="delete-unityads" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
}
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Technical Documents') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<ol>';

$content .= '<li>';
$content .= '<p>' . __e('Install UnityAds cordova plugin:') . '</p>';
$content .= '<pre class="shell">ionic cordova plugin add com-artemisoftnian-plugins-unityads3</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Install cordova-check-plugins module:') . '</p>';
$content .= '<pre class="shell">npm install -g cordova-check-plugins --save</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Update your cordova plugin') . '</p>';
$content .= '<pre class="shell">cordova-check-plugins --update=auto</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then complete the form in the box on the left side') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Now, you can build your project!') . '</p>';
$content .= '<pre class="shell">ionic cordova build android</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('If you have trouble building the apk, try removing the platform and adding it again') . '</p>';
$content .= '<pre class="shell">ionic cordova platform remove android</pre>';
$content .= '<pre class="shell">ionic cordova platform add android@latest</pre>';
$content .= '</li>';

$content .= '</ol>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
