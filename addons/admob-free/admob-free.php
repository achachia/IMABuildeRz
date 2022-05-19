<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `admob-free`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getPages();
$addons_settings = $db->getAddonsUsed("admob-free");
$string = new jsmString();


if (isset($_POST['delete-admob-free']))
{
    $db->deleteAddOns('admob-free', 'core');
    $db->deleteGlobal('admob-free', 'core');
    rebuild();
    header('Location: ./?p=addons&addons=admob-free&' . time());
}

// TODO: POST
if (isset($_POST['save-admob-free']))
{
    //print_r($_POST['admob-free']);
    //die();
    // save addons setting
    $addons = array();
    $addons['app-id'] = trim($_POST['admob-free']['app-id']);
    $addons['adunit-banner'] = trim($_POST['admob-free']['adunit-banner']);
    $addons['adunit-interstitial'] = trim($_POST['admob-free']['adunit-interstitial']);
    $addons['adunit-rewardvideo'] = trim($_POST['admob-free']['adunit-rewardvideo']);

    if (isset($_POST['admob-free']['auto-banner']))
    {
        $addons['auto-banner'] = true;
    } else
    {
        $addons['auto-banner'] = false;
    }
    if (isset($_POST['admob-free']['auto-interstitial']))
    {
        $addons['auto-interstitial'] = true;
    } else
    {
        $addons['auto-interstitial'] = false;
    }
    if (isset($_POST['admob-free']['auto-rewardvideo']))
    {
        $addons['auto-rewardvideo'] = true;
    } else
    {
        $addons['auto-rewardvideo'] = false;
    }

    if (isset($_POST['admob-free']['is-testing']))
    {
        $addons['is-testing'] = true;
    } else
    {
        $addons['is-testing'] = false;
    }

    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);

        if (isset($_POST['admob-free']['pages'][$page_name]['banner']))
        {
            $addons['pages'][$page_name]['banner'] = true;
        } else
        {
            $addons['pages'][$page_name]['banner'] = false;
        }

        if (isset($_POST['admob-free']['pages'][$page_name]['interstitial']))
        {
            $addons['pages'][$page_name]['interstitial'] = true;
        } else
        {
            $addons['pages'][$page_name]['interstitial'] = false;
        }

        if (isset($_POST['admob-free']['pages'][$page_name]['rewardvideo']))
        {
            $addons['pages'][$page_name]['rewardvideo'] = true;
        } else
        {
            $addons['pages'][$page_name]['rewardvideo'] = false;
        }
    }

    $addons['page-target'] = 'core';
    $db->saveAddOns('admob-free', $addons);

    $global['name'] = 'core';
    $global['note'] = 'This code is used for Admob Free';

    $global['modules'][0]['enable'] = true;
    $global['modules'][0]['class'] = 'AdMobFree';
    $global['modules'][0]['var'] = 'adMobFree';
    $global['modules'][0]['path'] = '@ionic-native/admob-free/ngx';
    $global['modules'][0]['native'] = '@ionic-native/admob-free';
    $global['modules'][0]['cordova'] = 'cordova-plugin-admob-free';
    $global['modules'][0]['cordova-variable'][0]['var'] = 'ADMOB_APP_ID';
    $global['modules'][0]['cordova-variable'][0]['val'] = $addons['app-id'];

    $global['modules'][1]['enable'] = true;
    $global['modules'][1]['class'] = 'AdMobFreeBannerConfig';
    $global['modules'][1]['var'] = '';
    $global['modules'][1]['path'] = '@ionic-native/admob-free/ngx';
    $global['modules'][1]['native'] = '@ionic-native/admob-free';
    $global['modules'][1]['cordova'] = 'cordova-plugin-admob-free';
    $global['modules'][1]['cordova-variable'][0]['var'] = 'ADMOB_APP_ID';
    $global['modules'][1]['cordova-variable'][0]['val'] = $addons['app-id'];

    $global['modules'][2]['enable'] = true;
    $global['modules'][2]['class'] = 'AdMobFreeInterstitialConfig';
    $global['modules'][2]['var'] = '';
    $global['modules'][2]['path'] = '@ionic-native/admob-free/ngx';
    $global['modules'][2]['native'] = '@ionic-native/admob-free';
    $global['modules'][2]['cordova'] = 'cordova-plugin-admob-free';
    $global['modules'][2]['cordova-variable'][0]['var'] = 'ADMOB_APP_ID';
    $global['modules'][2]['cordova-variable'][0]['val'] = $addons['app-id'];

    $global['modules'][3]['enable'] = true;
    $global['modules'][3]['class'] = 'AdMobFreeRewardVideoConfig';
    $global['modules'][3]['var'] = '';
    $global['modules'][3]['path'] = '@ionic-native/admob-free/ngx';
    $global['modules'][3]['native'] = '@ionic-native/admob-free';
    $global['modules'][3]['cordova'] = 'cordova-plugin-admob-free';
    $global['modules'][3]['cordova-variable'][0]['var'] = 'ADMOB_APP_ID';
    $global['modules'][3]['cordova-variable'][0]['val'] = $addons['app-id'];

    $global['modules'][4]['enable'] = true;
    $global['modules'][4]['cordova'] = 'cordova-admob-sdk';

    $global['modules'][5]['enable'] = true;
    $global['modules'][5]['cordova'] = 'cordova-promise-polyfill';

    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['export'] .= "" . '/**' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '* Admob Option' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '**/' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . 'const bannerConfig: AdMobFreeBannerConfig = {' . "\r\n";
    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['export'] .= "\t" . '//id: "' . $addons['adunit-banner'] . '",' . "\r\n";
        $global['component'][0]['code']['export'] .= "\t" . 'isTesting: true,' . "\r\n";
    } else
    {
        $global['component'][0]['code']['export'] .= "\t" . 'id: "' . $addons['adunit-banner'] . '",' . "\r\n";
    }
    if ($addons['auto-banner'] == true)
    {
        $global['component'][0]['code']['export'] .= "\t" . 'autoShow: true' . "\r\n";
    } else
    {
        $global['component'][0]['code']['export'] .= "\t" . 'autoShow: false' . "\r\n";
    }
    $global['component'][0]['code']['export'] .= "" . '}' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '' . "\r\n";


    $global['component'][0]['code']['export'] .= "" . 'const interstitialConfig: AdMobFreeInterstitialConfig = {' . "\r\n";
    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['export'] .= "\t" . '//id: "' . $addons['adunit-interstitial'] . '",' . "\r\n";
        $global['component'][0]['code']['export'] .= "\t" . 'isTesting: true,' . "\r\n";
    } else
    {
        $global['component'][0]['code']['export'] .= "\t" . 'id: "' . $addons['adunit-interstitial'] . '",' . "\r\n";
    }
    if ($addons['auto-interstitial'] == true)
    {
        $global['component'][0]['code']['export'] .= "\t" . 'autoShow: true' . "\r\n";
    } else
    {
        $global['component'][0]['code']['export'] .= "\t" . 'autoShow: false' . "\r\n";
    }


    $global['component'][0]['code']['export'] .= "" . '}' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . '' . "\r\n";
    $global['component'][0]['code']['export'] .= "" . 'const rewardVideoConfig: AdMobFreeRewardVideoConfig = {' . "\r\n";
    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['export'] .= "\t" . '//id: "' . $addons['adunit-rewardvideo'] . '",' . "\r\n";
        $global['component'][0]['code']['export'] .= "\t" . 'isTesting: true,' . "\r\n";
    } else
    {
        $global['component'][0]['code']['export'] .= "\t" . 'id: "' . $addons['adunit-rewardvideo'] . '",' . "\r\n";
    }
    if ($addons['auto-rewardvideo'] == true)
    {
        $global['component'][0]['code']['export'] .= "\t" . 'autoShow: true' . "\r\n";
    } else
    {
        $global['component'][0]['code']['export'] .= "\t" . 'autoShow: false' . "\r\n";
    }
    $global['component'][0]['code']['export'] .= "" . '}' . "\r\n";

    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['init'] .= "\t\t" . 'this.handlerAdmobFree();';


    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showBanner()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private handlerAdmobFree(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.showBanner();' . "\r\n";
    if ($addons['adunit-interstitial'] != '')
    {
        $global['component'][0]['code']['other'] .= "\t\t" . 'this.showInterstitial();' . "\r\n";
    } else
    {
        $global['component'][0]['code']['other'] .= "\t\t" . '//this.showInterstitial();' . "\r\n";
    }
    if ($addons['adunit-rewardvideo'] != '')
    {
        $global['component'][0]['code']['other'] .= "\t\t" . 'this.showRewardVideo();' . "\r\n";
    } else
    {
        $global['component'][0]['code']['other'] .= "\t\t" . '//this.showRewardVideo();' . "\r\n";
    }

    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";

    $page_banners = array();
    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        if (isset($addons['pages'][$page_name]['banner']))
        {
            if ($addons['pages'][$page_name]['banner'] == true)
            {
                $page_banners[] = '(pageName == "' . $page_name . '")';
            }
        }
    }

    $page_interstitials = array();
    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        if (isset($addons['pages'][$page_name]['interstitial']))
        {
            if ($addons['pages'][$page_name]['interstitial'] == true)
            {
                $page_interstitials[] = '(pageName == "' . $page_name . '")';
            }
        }
    }

    $page_videorewards = array();
    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        if (isset($addons['pages'][$page_name]['rewardvideo']))
        {
            if ($addons['pages'][$page_name]['rewardvideo'] == true)
            {
                $page_videorewards[] = '(pageName == "' . $page_name . '")';
            }
        }
    }

    $global['component'][0]['code']['other'] .= "" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showBanner()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private showBanner(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.adMobFree.banner.config(bannerConfig);' . "\r\n";
    if (count($page_banners) != 0)
    {
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.adMobFree.banner.prepare().then(() => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}).catch(e => alert(e));' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("banner",pageName);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// show banner only for certain page' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t", $page_banners) . '){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.adMobFree.banner.show();' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.adMobFree.banner.hide();' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";

    }
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "" . '' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showInterstitial()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private showInterstitial(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.adMobFree.interstitial.config(interstitialConfig);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.adMobFree.interstitial.prepare().then(() => {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}).catch(e => alert(e));' . "\r\n";
    if (count($page_interstitials) != 0)
    {
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'console.log(pageName);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// show interstitial only for certain page' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $page_interstitials) . '){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.adMobFree.interstitial.show();' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    }
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "" . '' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showRewardVideo()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private showRewardVideo(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.adMobFree.rewardVideo.config(rewardVideoConfig);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.adMobFree.rewardVideo.prepare().then(() => {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}).catch(e => alert(e));' . "\r\n";
    if (count($page_videorewards))
    {
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("rewardVideo",pageName);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// show reward video only for certain page' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t", $page_videorewards) . '){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.adMobFree.rewardVideo.show();' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    }

    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "" . '' . "\r\n";

    $db->saveGlobal('admob-free', $global);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=admob-free&' . time());

}

// TODO: INIT

$current_setting = $db->getAddOns('admob-free', 'core');

if (!isset($current_setting['is-testing']))
{
    $current_setting['is-testing'] = false;
}

if (!isset($current_setting['app-id']))
{
    $current_setting['app-id'] = '';
}

if (!isset($current_setting['adunit']))
{
    $current_setting['adunit'] = '';
}

if (!isset($current_setting['adunit-banner']))
{
    $current_setting['adunit-banner'] = '';
}

if (!isset($current_setting['auto-banner']))
{
    $current_setting['auto-banner'] = false;
}

if (!isset($current_setting['adunit-interstitial']))
{
    $current_setting['adunit-interstitial'] = '';
}
if (!isset($current_setting['auto-interstitial']))
{
    $current_setting['auto-interstitial'] = false;
}

if (!isset($current_setting['adunit-rewardvideo']))
{
    $current_setting['adunit-rewardvideo'] = '';
}

if (!isset($current_setting['auto-rewardvideo']))
{
    $current_setting['auto-rewardvideo'] = false;
}

$content .= '<form action="" method="post"><!-- ./form -->';
// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
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



$content .= '<div class="notice notice-danger">' . __e('This is only the code generator, please read the admob rules as often as possible and apply as recommended. If your account get banned/pending, or your ad doesn\'t work, or your account has a problem  it\'s your mistake, use it at your own risk. If you do not agree, please do not use these addons') . '</div>';



$content .= '<div class="callout callout-danger">' . __e('These addons require the <strong>Cordova Plugin</strong> and <strong>Ionic Native</strong>, to be able to run the emulator you have to <a href="./?p=2.update-plugin">update it</a>') . '</div>';

// TODO: LAYOUT --|-- FORM

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- APP-ID
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-app-id">' . __e('App ID') . '</label>';
$content .= '<input id="page-app-id" type="text" name="admob-free[app-id]" class="form-control" placeholder="ca-app-pub-4855740622510094~1743954969"  value="' . $current_setting['app-id'] . '"  required />';
$content .= '<p class="help-block">' . __e('Please see the App settings section on the <a target="blank" href="https://apps.admob.com/">AdMob portal</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- IS-TESTING
$checked = '';
if ($current_setting['is-testing'] == true)
{
    $checked = 'checked';
}
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-app-id">' . __e('Mode') . '</label>';
$content .= '<div class="checkbox">';
$content .= '<label><input type="checkbox" ' . $checked . ' class="flat-blue" name="admob-free[is-testing]" /> ' . __e('Testing Mode (To test your cordova)') . '</label>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="callout callout-info">' . __e('For the Android platform: ads will appear if the app has been <strong>signed</strong> and <strong>published</strong> in the playstore, So please use <strong>Testing Mode</strong> for test') . '</div>';
$content .= '<hr/>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- ADUNIT-BANNER
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-adunit-banner">' . __e('Ad unit ID for Banner') . '</label>';
$content .= '<input id="page-adunit-banner" type="text" name="admob-free[adunit-banner]" class="form-control" placeholder="ca-app-pub-8094096715994524/6097141095"  value="' . $current_setting['adunit-banner'] . '"  required />';
$content .= '<p class="help-block">' . __e('Please see the Ad units menu on the <a target="blank" href="https://apps.admob.com/">AdMob portal</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- ADUNIT-INTERSTITIAL
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-adunit-interstitial">' . __e('Ad unit ID for Interstitial') . '</label>';
$content .= '<input id="page-adunit-interstitial" type="text" name="admob-free[adunit-interstitial]" class="form-control" placeholder="ca-app-pub-8094096715994524/6097141095"  value="' . $current_setting['adunit-interstitial'] . '"  />';
$content .= '<p class="help-block">' . __e('Please see the Ad units menu on the <a target="blank" href="https://apps.admob.com/">AdMob portal</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- ADUNIT-REWARDVIDEO
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-adunit-rewardvideo">' . __e('Ad unit ID for Reward Video') . '</label>';
$content .= '<input id="page-adunit-rewardvideo" type="text" name="admob-free[adunit-rewardvideo]" class="form-control" placeholder="ca-app-pub-3940256099942544/5224354917"  value="' . $current_setting['adunit-rewardvideo'] . '"  />';
$content .= '<p class="help-block">' . __e('Please see the Ad units menu on the <a target="blank" href="https://apps.admob.com/">AdMob portal</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

$content .= '</div><!-- ./row -->';

$content .= '<div class="help-dev">*** ' . __e('Support testing using the <a target="blank" href="https://ionicframework.com/docs/appflow/devapp/">Ionic devApp</a> for <a target="blank" href="https://itunes.apple.com/us/app/ionic-devapp/id1233447133?ls=1&mt=8">iOS</a> and for android use real device for testing it') . '</div>';

$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-admob-free" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '&nbsp;or&nbsp;<input name="delete-admob-free" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';

$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-newspaper"></i> ' . __e('Event') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-default">' . __e('Please read the admob rules, not all events allow. please use it according to your needs') . '</div>';

$content .= '<h4>' . __e('Auto Show') . '</h4>';

if ($current_setting['auto-banner'] == true)
{
    $content .= '<p><label><input name="admob-free[auto-banner]" type="checkbox" class="flat-red" checked/> ' . __e('Banner') . '</label></p>';
} else
{
    $content .= '<p><label><input name="admob-free[auto-banner]" type="checkbox" class="flat-red" /> ' . __e('Banner') . '</label></p>';
}
if ($current_setting['auto-interstitial'] == true)
{
    $content .= '<p><label><input name="admob-free[auto-interstitial]" type="checkbox" class="flat-green" checked/> ' . __e('Interstitial') . '</label></p>';
} else
{
    $content .= '<p><label><input name="admob-free[auto-interstitial]" type="checkbox" class="flat-green" /> ' . __e('Interstitial') . '</label></p>';
}
if ($current_setting['auto-rewardvideo'] == true)
{
    $content .= '<p><label><input name="admob-free[auto-rewardvideo]" type="checkbox" class="flat-blue" checked/> ' . __e('Reward Video') . '</label></p>';
} else
{
    $content .= '<p><label><input name="admob-free[auto-rewardvideo]" type="checkbox" class="flat-blue" /> ' . __e('Reward Video') . '</label></p>';
}

$content .= '<hr/>';
$content .= '<h4>' . __e('Register on Page') . '</h4>';
$content .= '<div class="callout callout-danger">For interstitial and rewardvideo ads will not be able to appear every page, it depends on the availability of advertisements and the complete data stored in the app.</div>';
$content .= '<table class="table table-striped">';

$content .= '<thead>';
$content .= '<tr>';

$content .= '<th>';
$content .= '' . __e('Pages') . '';
$content .= '</th>';

$content .= '<th>';
$content .= '' . __e('Banner') . '';
$content .= '</th>';

$content .= '<th>';
$content .= '' . __e('Interstitial') . '';
$content .= '</th>';

$content .= '<th>';
$content .= '' . __e('Reward Video') . '';
$content .= '</th>';

$content .= '</tr>';
$content .= '</thead>';

foreach ($static_pages as $static_page)
{
    $banner_checked = $interstitial_checked = $rewardvideo_checked = '';

    $page_name = $string->toFilename($static_page['name']);

    $banner_checked = '';
    if (isset($current_setting['pages'][$page_name]['banner']))
    {
        if ($current_setting['pages'][$page_name]['banner'] == true)
        {
            $banner_checked = 'checked';
        }
    }

    $interstitial_checked = '';
    if (isset($current_setting['pages'][$page_name]['interstitial']))
    {
        if ($current_setting['pages'][$page_name]['interstitial'] == true)
        {
            $interstitial_checked = 'checked';
        }
    }

    $rewardvideo_checked = '';
    if (isset($current_setting['pages'][$page_name]['rewardvideo']))
    {
        if ($current_setting['pages'][$page_name]['rewardvideo'] == true)
        {
            $rewardvideo_checked = 'checked';
        }
    }


    $content .= '<tr>';

    $content .= '<td>';
    $content .= $page_name;
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input name="admob-free[pages][' . $page_name . '][banner]" type="checkbox" ' . $banner_checked . ' class="flat-red" />';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input name="admob-free[pages][' . $page_name . '][interstitial]" type="checkbox" ' . $interstitial_checked . ' class="flat-blue" />';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input name="admob-free[pages][' . $page_name . '][rewardvideo]" type="checkbox" ' . $rewardvideo_checked . ' class="flat-green" />';
    $content .= '</td>';

    $content .= '</tr>';

}
$content .= '</table>';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-admob-free" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div><!-- ./box -->';

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
$content .= '<p> ' . __e('Command that must be run on Ionic CLI') . '</p>';
$content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-admob-free@latest --save  --variable  ADMOB_APP_ID="'.$current_setting['app-id'].'"</pre>';
$content .= '<pre class="shell">npm install @ionic-native/admob-free@latest --save</pre>';
$content .= '<p>' . __e('The files affected by these addons are:') . '</p>';
$content .= '<ul>';
$content .= '<li>./config.xml</li>';
$content .= '<li>./src/app/app.component.ts</li>';
$content .= '<li>./src/app/app.module.ts</li>';
$content .= '<ul>';
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';


$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=admob-free&page-target="+$("#page-target").val(),!1});';
