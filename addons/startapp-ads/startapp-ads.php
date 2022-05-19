<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `startapp-ads`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("startapp-ads");
$string = new jsmString();


if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('startapp-ads', 'core');
    $db->deleteGlobal('startapp-ads', 'core');
    header('Location: ./?p=addons&addons=startapp-ads&' . time());
}

// TODO: POST
if (isset($_POST['save-startapp-ads']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    $addons['page-title'] = 'core';

    //android-app-id
    if (!isset($_POST['startapp-ads']['android-app-id']))
    {
        $_POST['startapp-ads']['android-app-id'] = '';
    }
    $addons['android-app-id'] = trim($_POST['startapp-ads']['android-app-id']); //text

    if (isset($_POST['startapp-ads']['is-testing']))
    {
        $addons['is-testing'] = true;
    } else
    {
        $addons['is-testing'] = false;
    }

    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);

        if (isset($_POST['startapp-ads']['pages'][$page_name]['banner']))
        {
            $addons['pages'][$page_name]['banner'] = true;
        } else
        {
            $addons['pages'][$page_name]['banner'] = false;
        }

        if (isset($_POST['startapp-ads']['pages'][$page_name]['interstitial']))
        {
            $addons['pages'][$page_name]['interstitial'] = true;
        } else
        {
            $addons['pages'][$page_name]['interstitial'] = false;
        }

        if (isset($_POST['startapp-ads']['pages'][$page_name]['rewardvideo']))
        {
            $addons['pages'][$page_name]['rewardvideo'] = true;
        } else
        {
            $addons['pages'][$page_name]['rewardvideo'] = false;
        }
    }

    $db->saveAddOns('startapp-ads', $addons);

    // TODO: GENERATOR --|-- GLOBALS

    $global['name'] = 'core';
    $global['note'] = 'StartApp Ads';
    // TODO: GENERATOR --|-- GLOBALS  --|-- MODULES

    $z = 0;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = '';
    $global['modules'][$z]['var'] = '';
    $global['modules'][$z]['path'] = '';
    $global['modules'][$z]['native'] = '';
    //$global['modules'][$z]['cordova'] = 'https://github.com/Jasman/cordova-plugin-startapp-ads.git';
    $global['modules'][$z]['cordova'] = 'cordova-plugin-startapp-ads';
    $global['modules'][$z]['cordova-variable'][0]['var'] = 'APP_ID_ANDROID';
    $global['modules'][$z]['cordova-variable'][0]['val'] = $addons['android-app-id'];


    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'ToastController';
    $global['modules'][$z]['var'] = 'toastController';
    $global['modules'][$z]['path'] = '@ionic/angular';


    // TODO: GENERATOR --|-- GLOBALS  --|-- CODE
    $global['component'][0]['code']['export'] = "" . 'declare var StartAppAds:any;' . "\r\n";
    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['init'] .= "\t\t" . 'this.handlerStartAppAds();';


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
    if (count($page_banners) == 0)
    {
        $page_banners[] = '(pageName == "' . $current_app['apps']['rootPage'] . '")';
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
    if (count($page_interstitials) == 0)
    {
        $page_interstitials[] = '(pageName == "' . $current_app['apps']['rootPage'] . '")';
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
    if (count($page_videorewards) == 0)
    {
        $page_videorewards[] = '(pageName == "' . $current_app['apps']['rootPage'] . '")';
    }

    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showBanner()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private handlerStartAppAds(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() => {' . "\r\n";

    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if(this.platform.is("android") && this.platform.is("cordova")) {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'console.log(`StartAppAds`,`On`);' . "\r\n";
    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'StartAppAds.init(`' . $addons['android-app-id'] . '`,{ returnAd: true, splashAd: true, testAds: true });' . "\r\n";
    } else
    {
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'StartAppAds.init(`' . $addons['android-app-id'] . '`);' . "\r\n";
    }
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'console.log(`StartAppAds`,`Page`,pageName);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// show banner only for certain page' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t", $page_banners) . '){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'console.log(`StartAppAds`,`Banner`,pageName);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'StartAppAds.showBanner();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'StartAppAds.hideBanner();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// show interstitial only for certain page' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $page_interstitials) . '){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'console.log(`StartAppAds`,`Interstitial`,pageName);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'StartAppAds.showInterstitial();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '// show reward video only for certain page' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t", $page_videorewards) . '){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'console.log(`StartAppAds`,`RewardVideo`,pageName);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'StartAppAds.showRewardVideo();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";


    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.banner.load`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Banner has been loaded!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.banner.load_fail`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Banner load failed!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.banner.clicked`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Banner clicked!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.banner.hide`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Banner has been hide!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    }


    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.interstitial.closed`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Interstitial has been closed!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.interstitial.displayed`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Interstitial displayed!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.interstitial.clicked`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Interstitial Ad clicked!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.interstitial.not_displayed`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Interstitial Ad not displayed!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.interstitial.load_fail`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Failed to Receive Interstitial!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    }

    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.reward_video.reward`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Video Reward can be given now!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.reward_video.load`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Reward Video loaded!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.reward_video.closed`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Video Reward  has been closed!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.reward_video.clicked`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Video Reward  has been clicked!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t" . 'document.addEventListener(`startappads.reward_video.load_fail`, () => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.toastStartAppAds(`Failed to load Rewarded Video Ad!`);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    }

    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";

    if ($addons['is-testing'] == true)
    {
        $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':toastStartAppAds($message)' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . 'async toastStartAppAds(message: string){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    }
    $db->saveGlobal('startapp-ads', $global);

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=startapp-ads&' . time());

}

// TODO: INIT --|-- CURRENT SETTINGS
$current_setting = $db->getAddOns('startapp-ads', 'core');
if (!isset($current_setting['android-app-id']))
{
    $current_setting['android-app-id'] = '';
}


if (!isset($current_setting['is-testing']))
{
    $current_setting['is-testing'] = false;
}

$content .= '<form action="" method="post"><!-- ./form -->';

// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';

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

$content .= '<div class="notice notice-danger">This is only the code generator, please read the StartApp Ads rules as often as possible and apply as recommended. If you get banned/pending it\'s your mistake, use it at your own risk. If you do not agree, please do not use these addons</div>';


// TODO: LAYOUT --|-- FORM --|-- ANDROID-APP-ID --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-android-app-id" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-android-app-id">' . __e('Android App ID') . '</label>';
$content .= '<input id="page-android-app-id" type="text" name="startapp-ads[android-app-id]" class="form-control" placeholder=""  value="' . $current_setting['android-app-id'] . '" required />';
$content .= '<p class="help-block">' . __e('This app ID was obtained from: ') . '<a href="https://portal.startapp.com/#/pub/applications" target="_blank">Startapp Portal</a></p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<label for="page-is-testing">' . __e('Mode') . '</label>';
$content .= '</div><!-- ./col-md-12 -->';

// TODO: LAYOUT --|-- FORM --|-- IS-TESTING
$checked = '';
if ($current_setting['is-testing'] == true)
{
    $checked = 'checked';
}
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<div class="checkbox">';
$content .= '<label><input type="checkbox" ' . $checked . ' class="flat-blue" name="startapp-ads[is-testing]" /> ' . __e('Test Mode (To test your cordova)') . '</label>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-startapp-ads" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';

$content .= '</div>';

$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Ads Rules') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

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
    $content .= '<input name="startapp-ads[pages][' . $page_name . '][banner]" type="checkbox" ' . $banner_checked . ' class="flat-red" />';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input name="startapp-ads[pages][' . $page_name . '][interstitial]" type="checkbox" ' . $interstitial_checked . ' class="flat-blue" />';
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input name="startapp-ads[pages][' . $page_name . '][rewardvideo]" type="checkbox" ' . $rewardvideo_checked . ' class="flat-green" />';
    $content .= '</td>';

    $content .= '</tr>';

}
$content .= '</table>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-startapp-ads" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Technical Guide') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('You must run the following command:') . '</p>';
$content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-startapp-ads@latest --save  --variable  APP_ID_ANDROID="' . $current_setting['android-app-id'] . '"</pre>';
$content .= '<p>' . __e('References:') . '</p>';
$content .= '<ul>';
$content .= '<li><a target="_blank" href="https://portal.startapp.com/">https://portal.startapp.com/</a></li>';
$content .= '<li><a target="_blank" href="https://github.com/lreiner/cordova-plugin-startapp-ads">https://github.com/lreiner/cordova-plugin-startapp-ads</a></li>';
$content .= '</ul>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';
