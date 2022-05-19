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

$content = $breadcrumb = $form_content = $html_color_option = null;
$db = new jsmDatabase();
$icon = new jsmIcon();
$locale = new jsmLocale();

$db->current();
$option_colors[] = 'blue';
$option_colors[] = 'yellow';
$option_colors[] = 'green';
$option_colors[] = 'purple';
$option_colors[] = 'red';

//$statusbar_style_options[] = array('value' => 'default', 'label' => __e('Default'));
$statusbar_style_options[] = array('value' => 'lightcontent', 'label' => __e('Light Content'));
$statusbar_style_options[] = array('value' => 'blacktranslucent', 'label' => __e('Black Translucent'));
$statusbar_style_options[] = array('value' => 'blackopaque', 'label' => __e('Black Opaque'));


$darkModes[] = array('value' => 'light', 'label' => __e('Light'));
$darkModes[] = array('value' => 'dark', 'label' => __e('Dark'));


if (isset($_POST['submit-app']))
{
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Well done!');
    $_SESSION['TOOL_ALERT']['message'] = __e('You have successfully saved the application');

    $app_data = $_POST['app'];
    $db->saveProject($app_data);
    $db->current();
    rebuild();


    $jsmDefault = new jsmDefault();
    if (!isset($_SESSION['CURRENT_APP']['pages']['home']))
    {

        $defaultPages = $jsmDefault->pages('home');
        $db->savePage($defaultPages);

        $defaultAddons = $jsmDefault->addons('step-wizard-slider');
        $db->saveAddOns('step-wizard-slider', $defaultAddons);


        $defaultPages = $jsmDefault->pages('about-us');
        $db->savePage($defaultPages);

        $defaultAddons = $jsmDefault->addons('about-us');
        $db->saveAddOns('about-us', $defaultAddons);


        $defaultPages = $jsmDefault->pages('faqs');
        $db->savePage($defaultPages);


        $defaultPages = $jsmDefault->pages('privacy-policy');
        $db->savePage($defaultPages);


    }

    if (!isset($_SESSION['CURRENT_APP']['popover']))
    {
        $newComponent = $jsmDefault->PopoverComponent();
        $db->saveComponent($newComponent);

        $popover = $jsmDefault->Popover();
        $db->savePopover($popover);
    }


    if (!isset($_SESSION['CURRENT_APP']['menus']['items'][0]['label']))
    {
        $defaultMenus = $jsmDefault->menus();
        $db->saveMenu($defaultMenus);
    }

    if (!isset($_SESSION['CURRENT_APP']['themes']))
    {
        $themes = null;

        $themes["color"]["primary"] = "#3880ff";
        $themes["color"]["primary-contrast"] = "#ffffff";
        $themes["color"]["primary-shade"] = "#3171e0";
        $themes["color"]["primary-tint"] = "#4c8dff";
        $themes["color"]["secondary"] = "#0cd1e8";
        $themes["color"]["secondary-contrast"] = "#ffffff";
        $themes["color"]["secondary-shade"] = "#0bb8cc";
        $themes["color"]["secondary-tint"] = "#24d6ea";
        $themes["color"]["tertiary"] = "#7044ff";
        $themes["color"]["tertiary-contrast"] = "#ffffff";
        $themes["color"]["tertiary-shade"] = "#633ce0";
        $themes["color"]["tertiary-tint"] = "#7e57ff";
        $themes["color"]["success"] = "#10dc60";
        $themes["color"]["success-contrast"] = "#ffffff";
        $themes["color"]["success-shade"] = "#0ec254";
        $themes["color"]["success-tint"] = "#28e070";
        $themes["color"]["warning"] = "#ffce00";
        $themes["color"]["warning-contrast"] = "#ffffff";
        $themes["color"]["warning-shade"] = "#e0b500";
        $themes["color"]["warning-tint"] = "#ffd31a";
        $themes["color"]["danger"] = "#f04141";
        $themes["color"]["danger-contrast"] = "#ffffff";
        $themes["color"]["danger-shade"] = "#d33939";
        $themes["color"]["danger-tint"] = "#f25454";
        $themes["color"]["dark"] = "#222428";
        $themes["color"]["dark-contrast"] = "#ffffff";
        $themes["color"]["dark-shade"] = "#1e2023";
        $themes["color"]["dark-tint"] = "#383a3e";
        $themes["color"]["medium"] = "#989aa2";
        $themes["color"]["medium-contrast"] = "#ffffff";
        $themes["color"]["medium-shade"] = "#86888f";
        $themes["color"]["medium-tint"] = "#a2a4ab";
        $themes["color"]["light"] = "#f4f5f8";
        $themes["color"]["light-contrast"] = "#000000";
        $themes["color"]["light-shade"] = "#d7d8da";
        $themes["color"]["light-tint"] = "#f5f6f9";

        $themes["dark-color"]["primary"] = "#3880ff";
        $themes["dark-color"]["primary-contrast"] = "#ffffff";
        $themes["dark-color"]["primary-shade"] = "#3171e0";
        $themes["dark-color"]["primary-tint"] = "#4c8dff";
        $themes["dark-color"]["secondary"] = "#0cd1e8";
        $themes["dark-color"]["secondary-contrast"] = "#ffffff";
        $themes["dark-color"]["secondary-shade"] = "#0bb8cc";
        $themes["dark-color"]["secondary-tint"] = "#24d6ea";
        $themes["dark-color"]["tertiary"] = "#7044ff";
        $themes["dark-color"]["tertiary-contrast"] = "#ffffff";
        $themes["dark-color"]["tertiary-shade"] = "#633ce0";
        $themes["dark-color"]["tertiary-tint"] = "#7e57ff";
        $themes["dark-color"]["success"] = "#10dc60";
        $themes["dark-color"]["success-contrast"] = "#ffffff";
        $themes["dark-color"]["success-shade"] = "#0ec254";
        $themes["dark-color"]["success-tint"] = "#28e070";
        $themes["dark-color"]["warning"] = "#ffce00";
        $themes["dark-color"]["warning-contrast"] = "#ffffff";
        $themes["dark-color"]["warning-shade"] = "#e0b500";
        $themes["dark-color"]["warning-tint"] = "#ffd31a";
        $themes["dark-color"]["danger"] = "#f04141";
        $themes["dark-color"]["danger-contrast"] = "#ffffff";
        $themes["dark-color"]["danger-shade"] = "#d33939";
        $themes["dark-color"]["danger-tint"] = "#f25454";
        $themes["dark-color"]["dark"] = "#222428";
        $themes["dark-color"]["dark-contrast"] = "#ffffff";
        $themes["dark-color"]["dark-shade"] = "#1e2023";
        $themes["dark-color"]["dark-tint"] = "#383a3e";
        $themes["dark-color"]["medium"] = "#989aa2";
        $themes["dark-color"]["medium-contrast"] = "#ffffff";
        $themes["dark-color"]["medium-shade"] = "#86888f";
        $themes["dark-color"]["medium-tint"] = "#a2a4ab";
        $themes["dark-color"]["light"] = "#f4f5f8";
        $themes["dark-color"]["light-contrast"] = "#000000";
        $themes["dark-color"]["light-shade"] = "#d7d8da";
        $themes["dark-color"]["light-tint"] = "#f5f6f9";


        $themes["custom-color"] = array();
        $themes["global"] = "";
        $themes["apps"] = "";
        $db->saveThemes($themes);
    }


    $db->current();
    rebuild();

    $redirect_url = '';
    if (isset($_GET['app_id']))
    {
        $redirect_url = './?p=apps&a=edit&app_id=' . $_GET['app_id'];
    } else
    {
        $redirect_url = './?p=apps&a=list';
    }
    header("Location: " . $redirect_url);
}
if (!isset($_GET['a']))
{
    $_GET['a'] = 'list';
}

if (!isset($_GET['sa']))
{
    $_GET['sa'] = null;
}

if (!isset($_POST['submit-app']))
{
    if ($_GET['a'] == 'new')
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            session_destroy();
            header('Location: ./?p=apps&a=new&reset');
        }
    }
}

if (!isset($app['app-name']))
{
    $app['app-name'] = 'Untitled App';
}

if (!isset($app['app-version']))
{
    $app['app-version'] = '01.01.01';
}
if (!isset($app['app-description']))
{
    $app['app-description'] = 'Apache Cordova application';
}
if (!isset($app['app-direction']))
{
    $app['app-direction'] = 'ltr';
}
if (!isset($app['app-color']))
{
    $app['app-color'] = $option_colors[rand(0, 4)];
}
if (!isset($app['app-icon']))
{
    $app['app-icon'] = 'calendar';
}
if (!isset($app['splash-screen-delay']))
{
    $app['splash-screen-delay'] = '6000';
}
if (!isset($app['fade-splash-screen-duration']))
{
    $app['fade-splash-screen-duration'] = '6000';
}

if (!isset($app['rootPage']))
{
    $app['rootPage'] = 'home';
}

if (!isset($app['ionic-storage']))
{
    $app['ionic-storage'] = true;
}


switch ($_GET['a'])
{
        // TODO: APP - NEW
    case 'new':

        $app['app-color'] = 'green';
        $app['pref-orientation'] = 'default';
        $app['content'] = 'index.html';
        $app['statusbar']['style'] = 'default';
        $app['statusbar']['backgroundcolor'] = '#000000';

        // TODO: ----|-- BREADCUMB
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=apps">' . __e('Apps') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('New') . '</li>';
        $breadcrumb .= '</ol>';
        // TODO: ----|-- OPT - APP-COLOR
        $html_color_option = null;
        $html_color_option .= '<div class="form-group">';
        foreach ($option_colors as $opt)
        {
            $checked = null;
            if ($opt == $app['app-color'])
            {
                $checked = 'checked';
            }
            $html_color_option .= '<label><input ' . $checked . ' type="radio" name="app[app-color]" class="flat-' . $opt . '" value="' . $opt . '"> </label> ' . __e(ucwords($opt)) . ' &nbsp; ';
        }
        $html_color_option .= '</div>';

        // TODO: ----|-- OPT - INIT - ORIENTATION
        $orientation_options[] = array('value' => 'default', 'label' => __e('Default'));
        $orientation_options[] = array('value' => 'landscape', 'label' => __e('Landscape'));
        $orientation_options[] = array('value' => 'portrait', 'label' => __e('Portrait'));

        $html_orientation_option = null;
        $html_orientation_option .= '<select name="app[pref-orientation]" class="form-control" id="pref-orientation">';
        foreach ($orientation_options as $orientation_option)
        {
            $selected = null;
            if ($orientation_option['value'] == $app['pref-orientation'])
            {
                $selected = 'selected';
            }
            $html_orientation_option .= '<option ' . $selected . ' value="' . $orientation_option['value'] . '">' . $orientation_option['label'] . '</option>';
        }
        $html_orientation_option .= '</select>';

        $html_content_option = null;
        $content_options[] = array('value' => 'index.html', 'label' => 'index.html');


        $html_content_option = null;
        $html_content_option .= '<select name="app[content]" class="form-control" id="content">';
        foreach ($content_options as $content_option)
        {
            $selected = null;
            if ($content_option['value'] == $app['content'])
            {
                $selected = 'selected';
            }
            $html_content_option .= '<option ' . $selected . ' value="' . $content_option['value'] . '">' . $content_option['label'] . '</option>';
        }
        $html_content_option .= '</select>';

        // TODO: ----|-- OPT - STATUS-BAR-STYLE
        $html_statusbar_style = null;
        $html_statusbar_style .= '<select name="app[statusbar][style]" class="form-control" id="statusbar-style">';
        foreach ($statusbar_style_options as $statusbar_style_option)
        {
            $selected = null;
            if ($statusbar_style_option['value'] == $app['statusbar']['style'])
            {
                $selected = 'selected';
            }
            $html_statusbar_style .= '<option ' . $selected . ' value="' . $statusbar_style_option['value'] . '">' . $statusbar_style_option['label'] . '</option>';
        }
        $html_statusbar_style .= '</select>';


        // TODO: ----|-- OPT - APP-LOCALE
        $countries = $locale->getLang();
        $html_locale_option = null;
        $html_locale_option .= '<select name="app[app-locale]" class="form-control" id="app-locale">';
        if (!isset($app['app-locale']))
        {
            $app['app-locale'] = 'en-GB';
        }
        foreach ($countries as $country)
        {

            $selected = null;


            $label_country = '';
            $fix_country_prefix = explode('-', $country['prefix']);

            if (isset($fix_country_prefix[1]))
            {
                $label_country = '-' . strtoupper($fix_country_prefix[1]);
            }
            if (isset($fix_country_prefix[2]))
            {
                $label_country = '-' . strtoupper($fix_country_prefix[1]) . '-' . strtoupper($fix_country_prefix[2]);
            }

            $country_prefix = strtolower($fix_country_prefix[0]) . $label_country;

            $nice_label_country = $country_prefix;
            if ($country['label'] !== '')
            {
                $nice_label_country = $country_prefix . ' (' . $country['label'] . ')';
            }
            if ($country_prefix == $app['app-locale'])
            {
                $selected = 'selected';
            }
            $html_locale_option .= '<option ' . $selected . ' value="' . $country_prefix . '">' . $nice_label_country . '</option>';
        }
        $html_locale_option .= '</select>';

        // TODO: ----|-- OPT - IONIC-STORAGE
        $html_ionic_storage = '<p><label><input name="app[ionic-storage]" type="checkbox" class="flat-red" /> ' . __e('Enable storage') . '</label></p>';

        // TODO: ----|-- OPT - CAPASITOR
        $html_capasitor = '<p><label><input name="app[capasitor]" type="checkbox" class="flat-red" /> ' . __e('Enable Capasitor') . '</label></p>';


        $back_button_opts[] = array('value' => 'none', 'label' => 'None');
        $back_button_opts[] = array('value' => 'exit', 'label' => 'History and Exit App');

        $html_back_button_option = null;
        $html_back_button_option .= '<select name="app[app-back-button]" class="form-control" id="app-back-button">';
        if (!isset($app['app-back-button']))
        {
            $app['app-back-button'] = 'none';
        }
        foreach ($back_button_opts as $back_button_opt)
        {
            $html_back_button_option .= '<option value="' . $back_button_opt['value'] . '">' . $back_button_opt['label'] . '</option>';
        }
        $html_back_button_option .= '</select>';


        // TODO: ----|-- OPT - DARK-MODE
        if (!isset($app['dark-mode']))
        {
            $app['dark-mode'] = 'light';
        }
        $html_dark_option = null;
        $html_dark_option .= '<select name="app[dark-mode]" class="form-control" id="dark-mode">';
        foreach ($darkModes as $darkMode)
        {
            $selected = null;
            if ($darkMode['value'] == $app['dark-mode'])
            {
                $selected = 'selected';
            }
            $html_dark_option .= '<option ' . $selected . ' value="' . $darkMode['value'] . '">' . $darkMode['label'] . '</option>';
        }
        $html_dark_option .= '</select>';
        
        
        // TODO: ----|-- FORM
        $form_content = '
<form action="" method="post" name="form-submit" id="form-submit">
<div class="row">
<div class="col-md-7">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-cube"></i> ' . __e('New Project') . '</h3>
        <input type="hidden" name="app[rootPage]" value="home" />
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
    <p>' . __e('This creates the required information for your cordova app') . '</p>
    <div class="row">
        <!-- col-md-6 -->
        <div class="col-md-7">
            <div class="form-group">
              <label for="app-name">' . __e('App Name') . '</label>
              <input autocomplete="off" data-inputmask="\'mask\':\'A\',\'greedy\':false,\'repeat\':32" data-mask required="" name="app[app-name]" type="text" class="form-control" id="app-name" placeholder="Unititled App" value="" >
              <p class="help-block">' . __e('Specifies the app\'s formal name, as it appears on the device\'s home screen and within app-store interfaces, using <code>a-z</code>, <code>A-Z</code> and <code>space</code> characters only') . '</p>
            </div>
        </div>
        <!-- ./col-md-6 -->

        <!-- col-md-6 -->
        <div class="col-md-5">
            <div class="form-group">
              <label for="app-version">' . __e('App Version') . '</label>
              <input autocomplete="off" data-inputmask=\'"mask": "99.99.99"\' data-mask name="app[app-version]" type="text" class="form-control" id="app-version" placeholder="01.01.01" value="01.01.01" >
              <p class="help-block">' . __e('Specifies the app\'s version') . '</p>
            </div>
        </div>
        <!-- ./col-md-6 -->
    </div>


    <div class="row">
        <!-- col-md-12 -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="app-version">' . __e('App Description') . '</label>
                <input autocomplete="off" data-inputmask="\'mask\':\'D\',\'greedy\':false,\'repeat\':64" data-mask required="" type="text" name="app[app-description]" class="form-control" id="app-description" placeholder="Apache Cordova application" value="">
                <p class="help-block">' . __e('Specifies metadata that may appear within app-store listings, using <code>a-z</code>, <code>A-Z</code> and <code>space</code> characters only') . '</p>
            </div>
        </div>
        <!-- ./col-md-12 -->
    </div>

    <div class="row">
        <!-- col-md-4 -->
        <div class="col-md-4">
            <div class="form-group">
              <label for="app-direction">' . __e('Text Direction') . '</label>
              <select name="app[app-direction]" class="form-control" id="app-direction">
                  <option selected="" value="ltr">' . __e('LTR (Left To Right)') . '</option>
                  <option value="rtl">' . __e('RTL (Right To Left)') . '</option>
              </select>
                 <p class="help-block">' . __e('Use RTL for languages written from right to left (like Hebrew or Arabic), and LTR for those written from left to right (like English and most other languages)') . '</p>
            </div>
        </div>
        <!-- ./col-md-4 -->

        <!-- col-md-4 -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="app-icon">' . __e('Icon') . '</label>
                <div class="input-group">
                  <input name="app[app-icon]" type="text" class="form-control" id="app-icon" placeholder="red" value="android" >
                  <span class="input-group-addon">
                    <i id="preview-app-icon" class="pointer fa fa-android" data-type="icon-picker" data-target="#app-icon" data-dialog="#fa-icon-dialog">&nbsp;&nbsp;</i>
                  </span>
                </div>
                <p class="help-block">' . __e('Additional icons are needed to enhance your project') . '</p>
            </div>
        </div>
        <!-- ./col-md-4 -->
        
        
        <!-- col-md-4 -->
        <div class="col-md-4">
            <div class="form-group">
              <label for="app-locale">' . __e('Locale Settings') . '</label>
              ' . $html_locale_option . '
                 <p class="help-block">' . __e('Locale setting for angular (usually has an effect on language, date and time)') . '</p>
            </div>
        </div>
        <!-- ./col-md-4 -->
        
        
    </div>

    <div class="row">
    
        <!-- col-md-8 -->
        <div class="col-md-8">
            <div class="form-group">
              <label for="app-color">' . __e('Color') . '</label>
               ' . $html_color_option . '
              <p class="help-block">' . __e('Choose the dominant color for your application') . '</p>
            </div>
        </div>
        <!-- ./col-md-8 -->
        
        <div class="col-md-4">
            <div class="form-group">
              <label for="app-back-button">' . __e('Device\'s Back Button') . '</label>
              ' . $html_back_button_option . '
              <p class="help-block">' . __e('The event when pressing the Device\'s Back button on the <strong>home page</strong>') . '</p>
            </div>   
        </div>         
        <!-- ./col-md-4 -->
        
    </div>


    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-danger" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
  </div>

 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-users"></i> ' . __e('Author') . '</h3>
      <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
      </div>
    </div>
    <div class="box-body">
        <p>' . __e('Specifies contact information that may appear within app-store listings') . '</p>

        <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="author-name">' . __e('Author') . '</label>
                  <input autocomplete="off" data-inputmask="\'mask\':\'D\',\'greedy\':false,\'repeat\':32" data-mask type="text" class="form-control" name="app[author-name]" id="author-name" placeholder="Ihsana Team" value="" required>
                  <p class="help-block">' . __e('Name of the author, using <code>a-z</code>, <code>A-Z</code>, <code>dot</code>, <code>comma</code>, and <code>space</code> characters only') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->

            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="author-organization">' . __e('Organization') . '</label>
                    <input autocomplete="off" data-inputmask="\'mask\':\'D\',\'greedy\':false,\'repeat\':32" data-mask type="text" class="form-control" name="app[author-organization]" id="author-organization" placeholder="Ihsana IT Solution" value="" required>
                    <p class="help-block">' . __e('Name of company/organization, using <code>a-z</code>, <code>A-Z</code>, <code>dot</code>, <code>comma</code>, and <code>space</code> characters only') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->
        </div>


        <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="author-email">' . __e('Email') . '</label>
                  <input autocomplete="off" type="email" class="form-control" name="app[author-email]" id="author-email" placeholder="info@ihsana.com" value="" required>
                  <p class="help-block">' . __e('Email of the author') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->

            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="author-website">' . __e('Website') . '</label>
                  <input autocomplete="off" type="url" class="form-control" name="app[author-website]" id="author-website" placeholder="http://ihsana.com/" value="" required>
                  <p class="help-block">' . __e('Website of the author') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->
        </div>

    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-success" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
  </div>

</div>

<div class="col-md-5">

  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-gear"></i> ' . __e('Configuration') . '</h3>
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <p>' . __e('Global configuration file that controls many aspects of a cordova application behavior') . '</p>


        <div class="row">

            <div class="col-md-6">
                 <div class="form-group">
                    <label for="splash-screen-delay">' . __e('Splash Screen Delay') . '</label>
                    <input type="number" class="form-control" name="app[splash-screen-delay]" id="splash-screen-delay" placeholder="3000" value="3000" min="0" required>
                    <p class="help-block">' . __e('Amount of time in milliseconds to wait before automatically hide splash screen') . '</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="fade-splash-screen-duration">' . __e('Fade Splash Screen Duration') . '</label>
                    <input type="number" class="form-control" name="app[fade-splash-screen-duration]"  id="fade-splash-screen-duration" placeholder="300" min="0" value="300" required>
                    <p class="help-block">' . __e('Specifies the number of milliseconds for the splash screen fade effect to execute') . '</p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                  <label for="pref-orientation">' . __e('Orientation') . '</label>
                  ' . $html_orientation_option . '
                  <p class="help-block">' . __e('Allows you to lock orientation and prevent the interface from rotating in response to changes in orientation') . '</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="content">' . __e('Content') . '</label>
                  ' . $html_content_option . '
                  <p class="help-block">' . __e('Defines the app\'s starting page in the top-level web assets directory') . '</p>
                </div>
            </div>

        </div>


    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-warning" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
  </div>


   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tasks"></i> ' . __e('Other') . '</h3>
      <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
      </div>
    </div>
    <div class="box-body">
    
        <h3>' . __e('StatusBar') . '</h3>
        <p>' . __e('The StatusBar object provides some functions to customize the iOS and Android StatusBar') . '</p>
        <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="statusbar-style">' . __e('Style') . '</label>
                  ' . $html_statusbar_style . '
                  <p class="help-block">' . __e('Set the status bar style') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->

            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="statusbar-backgroundcolor">' . __e('Background Color') . '</label>
                  <input type="color" class="form-control" name="app[statusbar][backgroundcolor]" id="statusbar-backgroundcolor" placeholder="#dddddd" value="#a60009" />
                  <p class="help-block">' . __e('Set the background color of the statusbar') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->
        </div>

        <h3>' . __e('Ionic Storage') . '</h3>
        <p>' . __e('Storage is an easy way to store key/value pairs and JSON objects. Storage uses a variety of storage engines underneath, picking the best one available depending on the platform') . '</p>
        ' . $html_ionic_storage . '
        
        <h3>' . __e('Capasitor') . '</h3>
        <p>' . __e('Capacitor is a cross-platform app runtime that makes it easy to build web apps that run natively on iOS, Android, Electron, and the web') . '</p>
        ' . $html_capasitor . '
        <p>' . __e('Please do not `checked` if you don\'t understand more about the capacitors. because plugins that support and documentation is still poor') . '</p>
        
                <h3>' . __e('Dark Mode') . '</h3>
        <div class="form-group">
            <label for="statusbar-style">' . __e('Default Mode') . '</label>
            ' . $html_dark_option . '
            <p class="help-block">' . __e('Set default mode') . '</p>
        </div>
        
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
    </div>

</div>
</div>
</form>
';
        $content .= $form_content;
        break;
    case 'list':
        // TODO: APP - LIST
        // TODO: ----|-- breadcrumb
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Apps') . '</li>';
        $breadcrumb .= '</ol>';

        $apps = $db->refresh();
        // TODO: ----|-- table app
        $app_list = $hidden_btn_app = null;

        $app_list .= '
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-default">
                          <span class="info-box-icon">
                            <i class="fa fa-plus-circle"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">' . __e('Add Project') . '</span>
                            <span class="info-box-desc">' . __e('create an App') . '</span>

                            <div class="progress">
                              <div class="progress-bar" style="width:0%"></div>
                            </div>

                            <span class="progress-description">
                               <div class="btn-group btn-group-xs btn-group-justified">
                                    <a class="btn btn-sm btn-default btn-flat" href="./?p=apps&amp;a=new" >' . __e('Get Started') . '</a>
                               </div>
                            </span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                    ';


        foreach ($apps as $app)
        {
            if ($_SESSION['CURRENT_APP_PREFIX'] == $app['app-prefix'])
            {
                if (!isset($app['app-color']))
                {
                    $app['app-color'] = $option_colors[rand(0, 4)];
                }

                $project_active = __e('Deactivate');
                $icon_app = 'fa-dot-circle-o';
                $hidden_btn_app = '
                    <a href="./?p=apps&amp;a=edit&amp;app_id=' . $app['app-prefix'] . '" class="btn-flat btn bg-' . $app['app-color'] . '">
                        <i class="fa fa-pencil"></i>
                        ' . __e('Edit') . '
                    </a>
                    <a data-toggle="modal" data-target="#delete-app-dialog" href="#./?p=apps&amp;a=delete&amp;app_id=' . $app['app-prefix'] . '" class="btn-flat btn btn-zdefault bg-' . $app['app-color'] . '">
                        <i class="fa fa-trash"></i>
                        ' . __e('Delete') . '
                    </a>
                ';
            } else
            {
                $project_active = __e('Activate');
                $icon_app = 'fa-circle-o';
                $hidden_btn_app = '';
            }
            if (!isset($app['app-color']))
            {
                $app['app-color'] = 'green';
            }
            if (!isset($app['app-icon']))
            {
                $app['app-icon'] = 'bookmark-o';
            }
            $app_list .= '
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-' . $app['app-color'] . '">
                          <span class="info-box-icon">
                            <i class="fa fa-' . $app['app-icon'] . '"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">' . $app['app-name'] . ' <em>Ver.' . $app['app-version'] . '</em></span>
                            <span class="info-box-number"></span>
                            <small class="info-box-desc">' . $app['app-description'] . '</small>
                            <!-- The progress section is optional -->
                            <div class="progress">
                              <div class="progress-bar" style="width: 90%"></div>
                            </div>
                            <span class="progress-description">
                               <div class="btn-group btn-group-xs btn-group-justified">
                                   <a href="./?p=apps&amp;a=active&amp;app_id=' . $app['app-prefix'] . '" class="btn-flat btn bg-' . $app['app-color'] . '">
                                        <i class="fa ' . $icon_app . '"></i>
                                        ' . $project_active . '
                                   </a>
                                    ' . $hidden_btn_app . '
                               </div>
                            </span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                    ';
        }


        $content .= '
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-th"></i> ' . __e('List Projects') . '</h3>
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i>
                    </button>
                    </div>
            </div>

            <div class="box-body">
                <div class="well">
                    <h2>' . __e('Welcome to') . '</h2><h1>' . JSM_NAME . '!</h1>
                    <p class="lead">' . __e('Tools from Ihsana for developing your own hybrid Apps<br/> without coding') . '</p>
                </div>
               <h4>' . __e('Recent projects') . '</h4>

              <div class="row">
                ' . $app_list . '
              </div>

            </div>
            <div class="box-footer clearfix">
              <a href="./?p=apps&amp;a=reset" class="btn btn-lg btn-info btn-flat pull-right"><i class="fa fa-repeat"></i> ' . __e('Reset Session') . '</a>
            </div>
          </div>';

        $content .= '<form action="./?p=apps&amp;a=delete" method="post">';
        $content .= '<div class="modal fade modal-danger" id="delete-app-dialog" tabindex="-1" role="dialog" aria-labelledby="delete-app-label" aria-hidden="true">';
        $content .= '<div class="modal-dialog">';
        $content .= '<div class="modal-content">';
        $content .= '<div class="modal-header">';
        $content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete Project') . '</h4>';
        $content .= '</div>';
        $content .= '<div class="modal-body">';
        $content .= '<p>' . __e('When you delete a project, this immediately happens:') . '</p>';
        $content .= '<ul>';
        $content .= '<li>' . __e('You lose access to your entire project, including your project\'s apps') . '</li>';
        $content .= '</ul>';
        $content .= '<div class="form-group">';
        $content .= '<label for="app-id">' . __e('To delete your project, type your project\'s id:') . ' <code>' . $_SESSION['CURRENT_APP_PREFIX'] . '</code></label>';
        $content .= '<input name="app-id" type="text" class="form-control" placeholder="Project ID" />';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="modal-footer">';
        $content .= '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">' . __e('Close') . '</button>';
        $content .= '<input type="submit" class="btn btn-outline" value="' . __e('Delete Project') . '" />';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</form>';

        break;
    case 'reset':
        // TODO: APP - RESET
        session_destroy();
        header("Location: ./?p=apps&a=list");
        break;
    case 'active':
        // TODO: APP - ACTIVE
        $_SESSION['CURRENT_APP_PREFIX'] = $_GET['app_id'];
        $db->current();
        rebuild();
        header("Location: ./?p=apps&a=list");
        break;
    case 'edit':
        // TODO: APP - EDIT
        // TODO: ----|-- BREADCUMB
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>';
        $breadcrumb .= '<li><a href="./?p=apps">Apps</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
        $breadcrumb .= '</ol>';


        if (isset($_SESSION['CURRENT_APP']['apps']))
        {
            $app = $_SESSION['CURRENT_APP']['apps'];
        }
        if (!isset($_SESSION['CURRENT_APP']['apps']['content']))
        {
            header("Location: ./?p=apps&a=list");
        }

        // TODO: ----|-- OPT - APP-COLOR
        $html_color_option = null;
        $html_color_option .= '<div class="form-group">';
        foreach ($option_colors as $opt)
        {
            if (!isset($app['app-color']))
            {
                $app['app-color'] = $option_colors[rand(0, 4)];
            }
            $checked = null;
            if ($opt == $app['app-color'])
            {
                $checked = 'checked';
            }
            $html_color_option .= '<label><input ' . $checked . ' type="radio" name="app[app-color]" class="flat-' . $opt . '" value="' . $opt . '"> </label> ' . __e(ucwords($opt)) . ' &nbsp; ';
        }
        $html_color_option .= '</div>';

        // TODO: ----|-- OPT - APP-DIRECTION
        //$direction_options[] = array('value' => 'multi','label' => 'Both RTL and LTR (Left To Right)');
        $direction_options[] = array('value' => 'ltr', 'label' => __e('LTR (Left To Right)'));
        $direction_options[] = array('value' => 'rtl', 'label' => __e('RTL (Right To Left)'));
        $html_direction_option = null;
        $html_direction_option .= '<select name="app[app-direction]" class="form-control" id="app-direction">';
        foreach ($direction_options as $direction_option)
        {
            $selected = null;
            if ($direction_option['value'] == $app['app-direction'])
            {
                $selected = 'selected';
            }
            $html_direction_option .= '<option ' . $selected . ' value="' . $direction_option['value'] . '">' . $direction_option['label'] . '</option>';
        }
        $html_direction_option .= '</select>';


        // TODO: ----|-- OPT - APP-ORIENTATION
        $orientation_options = array();
        $orientation_options[] = array('value' => 'default', 'label' => __e('Default'));
        $orientation_options[] = array('value' => 'landscape', 'label' => __e('Landscape'));
        $orientation_options[] = array('value' => 'portrait', 'label' => __e('Portrait'));

        $html_orientation_option = null;
        $html_orientation_option .= '<select name="app[pref-orientation]" class="form-control" id="pref-orientation">';
        foreach ($orientation_options as $orientation_option)
        {
            $selected = null;
            if ($orientation_option['value'] == $app['pref-orientation'])
            {
                $selected = 'selected';
            }
            $html_orientation_option .= '<option ' . $selected . ' value="' . $orientation_option['value'] . '">' . $orientation_option['label'] . '</option>';
        }
        $html_orientation_option .= '</select>';


        // TODO: ----|-- OPT - CONTENT START
        $content_options[] = array('value' => 'index.html', 'label' => 'index.html');
        $html_content_option = null;
        $html_content_option .= '<select name="app[content]" class="form-control" id="content">';
        foreach ($content_options as $content_option)
        {
            $selected = null;
            if ($content_option['value'] == $app['content'])
            {
                $selected = 'selected';
            }
            $html_content_option .= '<option ' . $selected . ' value="' . $content_option['value'] . '">' . $content_option['label'] . '</option>';
        }
        $html_content_option .= '</select>';


        // TODO: ----|-- OPT - STATUS-BAR-STYLE
        $html_statusbar_style = null;
        $html_statusbar_style .= '<select name="app[statusbar][style]" class="form-control" id="statusbar-style">';
        foreach ($statusbar_style_options as $statusbar_style_option)
        {
            $selected = null;
            if ($statusbar_style_option['value'] == $app['statusbar']['style'])
            {
                $selected = 'selected';
            }
            $html_statusbar_style .= '<option ' . $selected . ' value="' . $statusbar_style_option['value'] . '">' . $statusbar_style_option['label'] . '</option>';
        }
        $html_statusbar_style .= '</select>';


        // TODO: ----|-- OPT - APP-LOCALE
        $countries = $locale->getLang();
        $html_locale_option = null;
        $html_locale_option .= '<select name="app[app-locale]" class="form-control" id="app-locale">';
        if (!isset($app['app-locale']))
        {
            $app['app-locale'] = 'en-GB';
        }
        foreach ($countries as $country)
        {

            $selected = null;


            $label_country = '';
            $fix_country_prefix = explode('-', $country['prefix']);

            if (isset($fix_country_prefix[1]))
            {
                $label_country = '-' . strtoupper($fix_country_prefix[1]);
            }

            if (isset($fix_country_prefix[2]))
            {
                $label_country = '-' . strtoupper($fix_country_prefix[1]) . '-' . strtoupper($fix_country_prefix[2]);
            }

            $country_prefix = strtolower($fix_country_prefix[0]) . $label_country;

            $nice_label_country = $country_prefix;
            if ($country['label'] !== '')
            {
                $nice_label_country = $country_prefix . ' (' . $country['label'] . ')';
            }
            if ($country_prefix == $app['app-locale'])
            {
                $selected = 'selected';
            }
            $html_locale_option .= '<option ' . $selected . ' value="' . $country_prefix . '">' . $nice_label_country . '</option>';
        }
        $html_locale_option .= '</select>';

        // TODO: ----|-- OPT - IONIC-STORAGE
        if (!isset($app['ionic-storage']))
        {
            $app['ionic-storage'] = false;
        }

        if ($app['ionic-storage'] == true)
        {
            $html_ionic_storage = '<p><label><input name="app[ionic-storage]" type="checkbox" class="flat-red" checked="checked"/> ' . __e('Enable storage') . '</label></p>';
        } else
        {
            $html_ionic_storage = '<p><label><input name="app[ionic-storage]" type="checkbox" class="flat-red" /> ' . __e('Enable storage') . '</label></p>';
        }


        // TODO: ----|-- OPT - CAPASITOR
        if (!isset($app['capasitor']))
        {
            $app['capasitor'] = false;
        }

        if ($app['capasitor'] == true)
        {
            $html_capasitor = '<p><label><input name="app[capasitor]" type="checkbox" class="flat-red" checked="checked"/> ' . __e('Enable Capasitor') . '</label></p>';
        } else
        {
            $html_capasitor = '<p><label><input name="app[capasitor]" type="checkbox" class="flat-red" /> ' . __e('Enable Capasitor') . '</label></p>';
        }


        $back_button_opts[] = array('value' => 'none', 'label' => 'None');
        $back_button_opts[] = array('value' => 'exit', 'label' => 'History and Exit App');

        $html_back_button_option = null;
        $html_back_button_option .= '<select name="app[app-back-button]" class="form-control" id="app-back-button">';
        if (!isset($app['app-back-button']))
        {
            $app['app-back-button'] = 'none';
        }
        foreach ($back_button_opts as $back_button_opt)
        {
            $selected = '';
            if ($app['app-back-button'] == $back_button_opt['value'])
            {
                $selected = 'selected';
            }
            $html_back_button_option .= '<option value="' . $back_button_opt['value'] . '" ' . $selected . '>' . $back_button_opt['label'] . '</option>';
        }
        $html_back_button_option .= '</select>';


        // TODO: ----|-- OPT - DARK-MODE
        if (!isset($app['dark-mode']))
        {
            $app['dark-mode'] = 'light';
        }
        $html_dark_option = null;
        $html_dark_option .= '<select name="app[dark-mode]" class="form-control" id="dark-mode">';
        foreach ($darkModes as $darkMode)
        {
            $selected = null;
            if ($darkMode['value'] == $app['dark-mode'])
            {
                $selected = 'selected';
            }
            $html_dark_option .= '<option ' . $selected . ' value="' . $darkMode['value'] . '">' . $darkMode['label'] . '</option>';
        }
        $html_dark_option .= '</select>';
        
        
        
        $form_content = '
<form action="" method="post" name="form-submit" id="form-submit">
<div class="row">
<div class="col-md-7">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-cube"></i> ' . __e('Edit Project') . '</h3>
        <input type="hidden" name="app[rootPage]" value="' . $app['rootPage'] . '" />
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
    <p>' . __e('This creates the required information for your cordova app') . '</p>
    <div class="row">
        <!-- col-md-6 -->
        <div class="col-md-7">
            <div class="form-group">
              <label for="app-name">' . __e('App Name') . '</label>
              <input name="app[app-name]" readonly type="text" class="form-control" id="app-name" placeholder="Unititled App" value="' . $app['app-name'] . '" >
              <p class="help-block">' . __e('Specifies the app\'s formal name, as it appears on the device\'s home screen and within app-store interfaces') . '</p>
            </div>
        </div>
        <!-- ./col-md-6 -->

        <!-- col-md-6 -->
        <div class="col-md-5">
            <div class="form-group">
              <label autocomplete="off" for="app-version">' . __e('App Version') . '</label>
              <input data-inputmask=\'"mask": "99.99.99"\' data-mask name="app[app-version]" type="text" class="form-control" id="app-version" placeholder="01.01.01" value="' . $app['app-version'] . '" >
              <p class="help-block">' . __e('Specifies the app\'s version') . '</p>
            </div>
        </div>
        <!-- ./col-md-6 -->
    </div>


    <div class="row">
        <!-- col-md-12 -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="app-description">' . __e('App Description') . '</label>
                <input autocomplete="off" data-inputmask="\'mask\':\'D\',\'greedy\':false,\'repeat\':64" data-mask type="text" name="app[app-description]" class="form-control" id="app-description" placeholder="Apache Cordova application" value="' . $app['app-description'] . '">
                <p class="help-block">' . __e('Specifies metadata that may appear within app-store listings, using <code>a-z</code>, <code>A-Z</code> and <code>space</code> characters only') . '</p>
            </div>
        </div>
        <!-- ./col-md-12 -->
    </div>

    <div class="row">
    
        <!-- col-md-4 -->
        <div class="col-md-4">
            <div class="form-group">
              <label for="app-direction">' . __e('Text Direction') . '</label>
              ' . $html_direction_option . '
                 <p class="help-block">' . __e('Use RTL for languages written from right to left (like Hebrew or Arabic), and LTR for those written from left to right (like English and most other languages)') . '</p>
            </div>
        </div>
        <!-- ./col-md-4 -->

        <!-- col-md-4 -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="app-icon">' . __e('Icon') . '</label>
                <div class="input-group">
                  <input name="app[app-icon]" type="text" class="form-control" id="app-icon" placeholder="red" value="' . $app['app-icon'] . '" >
                  <span class="input-group-addon">
                    <i id="preview-app-icon" class="pointer fa fa-' . $app['app-icon'] . '" data-type="icon-picker" data-target="#app-icon" data-dialog="#fa-icon-dialog">&nbsp;&nbsp;</i>
                  </span>
                </div>
                <p class="help-block">' . __e('Additional icons are needed to enhance your project') . '</p>
            </div>
        </div>
        <!-- ./col-md-4 -->
        
         <!-- col-md-4 -->
        <div class="col-md-4">
            <div class="form-group">
              <label for="app-locale">' . __e('Locale Settings') . '</label>
              ' . $html_locale_option . '
                 <p class="help-block">' . __e('Locale setting for angular (usually has an effect on language, date and time)') . '</p>
            </div>
        </div>
        <!-- ./col-md-4 -->
               
        
        
    </div>

    <div class="row">
        <!-- col-md-8 -->
        <div class="col-md-8">
            <div class="form-group">
              <label for="app-color">' . __e('Color') . '</label>
               ' . $html_color_option . '
              <p class="help-block">' . __e('Choose the dominant color for your application') . '</p>
            </div>
        </div>
        <!-- ./col-md-8 -->
        
                <div class="col-md-4">
            <div class="form-group">
              <label for="app-back-button">' . __e('Device\'s Back Button') . '</label>
              ' . $html_back_button_option . '
              <p class="help-block">' . __e('The event when pressing the Device\'s Back button on the <strong>home page</strong>') . '</p>
            </div>   
        </div>         
        <!-- ./col-md-4 -->
        
        
    </div>


    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-danger" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
  </div>

 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-users"></i>' . __e('Author') . '</h3>
      <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
      </div>
    </div>
    <div class="box-body">
        <p>' . __e('Specifies contact information that may appear within app-store listings') . '</p>

        <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="author-name">' . __e('Author') . '</label>
                  <input autocomplete="off" data-inputmask="\'mask\':\'D\',\'greedy\':false,\'repeat\':32" type="text" class="form-control" name="app[author-name]" id="author-name" placeholder="Ihsana Team" value="' . $app['author-name'] . '" required>
                  <p class="help-block">' . __e('Name of the author, using <code>a-z</code>, <code>A-Z</code>, <code>dot</code>, <code>comma</code>, and <code>space</code> characters only') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->

            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="author-organization">' . __e('Organization') . '</label>
                    <input autocomplete="off" data-inputmask="\'mask\':\'D\',\'greedy\':false,\'repeat\':32" type="text" class="form-control" name="app[author-organization]" id="author-organization" placeholder="Ihsana IT Solution" value="' . $app['author-organization'] . '" required>
                    <p class="help-block">' . __e('Name of company/organization, using <code>a-z</code>, <code>A-Z</code>, <code>dot</code>, <code>comma</code>, and <code>space</code> characters only') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->
        </div>


        <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="author-email">' . __e('Email') . '</label>
                  <input autocomplete="off" type="email" class="form-control" name="app[author-email]" id="author-email" placeholder="info@ihsana.com" value="' . $app['author-email'] . '" required>
                  <p class="help-block">' . __e('Email of the author') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->

            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="author-website">' . __e('Website') . '</label>
                  <input autocomplete="off" type="url" class="form-control" name="app[author-website]" id="author-website" placeholder="http://ihsana.com/" value="' . $app['author-website'] . '" required>
                  <p class="help-block">' . __e('Website of the author') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->
        </div>

    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-success" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
  </div>




</div>

<div class="col-md-5">

  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-gear"></i> ' . __e('Configuration') . '</h3>
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <p>' . __e('Global configuration file that controls many aspects of a cordova application behavior') . '</p>


        <div class="row">

            <div class="col-md-6">
                 <div class="form-group">
                    <label for="splash-screen-delay">' . __e('Splash Screen Delay') . '</label>
                    <input type="number" class="form-control" name="app[splash-screen-delay]" id="splash-screen-delay" placeholder="6000" value="' . $app['splash-screen-delay'] . '">
                    <p class="help-block">' . __e('Amount of time in milliseconds to wait before automatically hide splash screen') . '</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="fade-splash-screen-duration">' . __e('Fade Splash Screen Duration') . '</label>
                    <input type="number" class="form-control" name="app[fade-splash-screen-duration]"  id="fade-splash-screen-duration" placeholder="6000" value="' . $app['fade-splash-screen-duration'] . '">
                    <p class="help-block">' . __e('Specifies the number of milliseconds for the splash screen fade effect to execute') . '</p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                  <label for="pref-orientation">' . __e('Orientation') . '</label>
                  ' . $html_orientation_option . '
                  <p class="help-block">' . __e('Allows you to lock orientation and prevent the interface from rotating in response to changes in orientation') . '</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="content">' . __e('Content') . '</label>
                  ' . $html_content_option . '
                  <p class="help-block">' . __e('Defines the app\'s starting page in the top-level web assets directory') . '</p>
                </div>
            </div>

        </div>




    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-warning" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
  </div>


   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tasks"></i> ' . __e('Others') . '</h3>
      <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
      </div>
    </div>
    <div class="box-body">
        
        <h3>' . __e('StatusBar') . '</h3>
        <p>' . __e('The StatusBar object provides some functions to customize the iOS and Android StatusBar') . '</p>
        <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="statusbar-style">' . __e('Style') . '</label>
                  ' . $html_statusbar_style . '
                  <p class="help-block">' . __e('Set the status bar style') . '</p>
                </div>
            </div>
            <!-- ./col-md-6 -->

            <!-- col-md-6 -->
            <div class="col-md-6">
                <div class="form-group">
                
                  <label for="statusbar-backgroundcolor">' . __e('Background Color') . '</label>
                  <input type="color" class="form-control" name="app[statusbar][backgroundcolor]" placeholder="#dddddd" value="' . $app['statusbar']['backgroundcolor'] . '" />                    
                  <p class="help-block">' . __e('Set the background color of the statusbar') . '</p>
                    
                </div>
                
            </div>
            <!-- ./col-md-6 -->
            
        </div>
        
        <h3>' . __e('Ionic Storage') . '</h3>
        <p>' . __e('Storage is an easy way to store key/value pairs and JSON objects. Storage uses a variety of storage engines underneath, picking the best one available depending on the platform') . '</p>
        ' . $html_ionic_storage . '

        <h3>' . __e('Capasitor') . '</h3>
        <p>' . __e('Capacitor is a cross-platform app runtime that makes it easy to build web apps that run natively on iOS, Android, Electron, and the web') . '</p>
        ' . $html_capasitor . '
        <p>' . __e('Please do not `checked` if you don\'t understand more about the capacitors. because plugins that support and documentation is still poor') . '</p>
        
        
        <h3>' . __e('Dark Mode') . '</h3>
        <div class="form-group">
            <label for="statusbar-style">' . __e('Default Mode') . '</label>
            ' . $html_dark_option . '
            <p class="help-block">' . __e('Set default mode') . '</p>
        </div>
                
        
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary" name="submit-app">' . __e('Save Changes') . '</button>
    </div>
    </div>

</div>
</div>
</form>
';
        $content .= $form_content;
        break;
    case 'delete':
        // TODO: APP - DELETE
        function rrmdir($dir) {
            if (is_dir($dir))
            {
                $objects = @scandir($dir);
                foreach ($objects as $object)
                {
                    if ($object != "." && $object != "..")
                    {
                        if (filetype($dir . "/" . $object) == "dir")
                            rrmdir($dir . "/" . $object);
                        else
                            @unlink($dir . "/" . $object);
                    }
                }
                reset($objects);
                @rmdir($dir);
            }
        }
        if (isset($_POST['app-id']))
        {
            if ($_POST['app-id'] == $_SESSION['CURRENT_APP_PREFIX'])
            {
                @rrmdir('projects/' . $_SESSION['CURRENT_APP_PREFIX']);
                @rrmdir('outputs/' . $_SESSION['CURRENT_APP_PREFIX']);
                unset($_SESSION['CURRENT_APP_PREFIX']);
                unset($_SESSION['CURRENT_APP']);

                $_SESSION['TOOL_ALERT']['type'] = 'success';
                $_SESSION['TOOL_ALERT']['title'] = 'Well done!';
                $_SESSION['TOOL_ALERT']['message'] = 'You have successfully deleted the application';
                header("Location: ./?p=apps&a=list");
            } else
            {
                $_SESSION['TOOL_ALERT']['type'] = 'danger';
                $_SESSION['TOOL_ALERT']['title'] = 'Ops!';
                $_SESSION['TOOL_ALERT']['message'] = 'You wrote the wrong Project\'s ID, please try again.';
                header("Location: ./?p=apps&a=list&n=error&sn=code");
            }
        } else
        {
            header("Location: ./?p=apps&a=list&n=error&sn=post");
        }

        break;
}


$content .= $icon->display('fa');

$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Apps';
$template->page_desc = __e('Let\'s create or edit your app');
$template->page_content = $content;

?>