<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `no-network`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("no-network");
$string = new jsmString();

$current_page_target = 'core';

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('no-network', $current_page_target);
    $db->deletePage('no-network');
    $db->deleteGlobal('no-network', 'core');
    header('Location: ./?p=addons&addons=no-network&' . time());
}

// TODO: POST
if (isset($_POST['delete-no-network']))
{
    $db->deleteAddOns('no-network', $current_page_target);
    $db->deletePage('no-network');
    $db->deleteGlobal('no-network', 'core');
    header('Location: ./?p=addons&addons=no-network&' . time());
}

if (isset($_POST['save-no-network']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = $current_page_target;
    $addons['no-network'] = trim($_POST['no-network']['no-network']);

    $addons['title-for-no-network-page'] = trim($_POST['no-network']['title-for-no-network-page']);
    $addons['header-color-for-no-network-page'] = trim($_POST['no-network']['header-color-for-no-network-page']);
    $addons['background-for-no-network-page'] = trim($_POST['no-network']['background-for-no-network-page']);
    $addons['content-for-no-network-page'] = trim($_POST['no-network']['content-for-no-network-page']);

    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);

        if (isset($_POST['no-network']['pages'][$page_name]))
        {
            $addons['pages'][$page_name] = true;
        } else
        {
            $addons['pages'][$page_name] = false;
        }
    }


    $db->saveAddOns('no-network', $addons);

    if ($addons['no-network'] == 'no-network-page')
    {
        $newPage = null;
        $newPage['title'] = $addons['title-for-no-network-page'];
        $newPage['name'] = 'no-network';
        $newPage['code-by'] = 'No Network';
        $newPage['icon-left'] = 'at';
        $newPage['icon-right'] = '';
        $newPage['header']['color'] = $addons['header-color-for-no-network-page'];

        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['background-for-no-network-page'];

        $newPage['content']['enable-fullscreen'] = true;
        $newPage['content']['enable-padding'] = true;

        $newPage['header']['mid']['type'] = 'title';
        $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
        $newPage['header']['mid']['items'][0]['value'] = 'tab1';
        $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
        $newPage['header']['mid']['items'][1]['value'] = 'tab2';
        $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
        $newPage['header']['mid']['items'][2]['value'] = 'tab3';

        // TODO: POST --|-- PAGE LOGIN --|-- MODULES

        // TODO: POST --|-- PAGE LOGIN --|-- HTML
        $newPage['content']['html'] = null;
        $newPage['content']['html'] .= "" . '<ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . $addons['content-for-no-network-page'] . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "" . '</ion-card>' . "\r\n";

        // TODO: POST --|-- PAGE LOGIN --|-- SCSS
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] .= "\t" . '' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-card{' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '' . "\r\n";


        // TODO: POST --|-- PAGE LOGIN --|-- OTHER
        $newPage['code']['export'] = null;
        $newPage['code']['constructor'] = null;
        $newPage['code']['other'] = null;
        $newPage['code']['init'] = null;

        //generate page code
        $db->savePage($newPage);

    } else
    {

    }

    $page_required = array();
    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        if (isset($addons['pages'][$page_name]))
        {
            if ($addons['pages'][$page_name] == true)
            {
                $page_required[] = '(currentPage == "' . $page_name . '")';
            }
        }
    }

    $global['name'] = $current_page_target;
    $global['note'] = 'This code is used for No Network';

    $z = 0;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'Network';
    $global['modules'][$z]['var'] = 'network';
    $global['modules'][$z]['path'] = '@ionic-native/network/ngx';
    $global['modules'][$z]['native'] = '@ionic-native/network';
    $global['modules'][$z]['cordova'] = 'cordova-plugin-network-information';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'ToastController';
    $global['modules'][$z]['var'] = 'toastController';
    $global['modules'][$z]['path'] = '@ionic/angular';


    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['init'] = "\t\t" . 'this.handlerNoNetwork();';

    $global['component'][0]['code']['other'] = null;

    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerNoNetwork()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'public handlerNoNetwork(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let isOnline:boolean = true; ' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let currentPage:string = "' . $current_app['apps']['rootPage'] . '"; ' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'currentPage = pageName;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'setInterval(() => {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if (isOnline == false) {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t", $page_required) . '){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.showToastNoNetwork("Network was disconnected :-(");' . "\r\n";
    if ($addons['no-network'] == 'no-network-page')
    {
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.router.navigate(["/no-network"]);' . "\r\n";
    }
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.log("internet",currentPage,isOnline);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}, 200);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '// watch network for a disconnection' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let disconnectSubscription = this.network.onDisconnect().subscribe(() => {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.showToastNoNetwork("Network was disconnected :-(");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'isOnline = false;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '// watch network for a connection' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let connectSubscription = this.network.onConnect().subscribe(() => {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.showToastNoNetwork("Network Connected!");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if (this.network.type == "wifi") {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToastNoNetwork("We got a wifi connection, woohoo!");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'isOnline = true;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";

    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showToast()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'async showToastNoNetwork(message:string){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";

    $db->saveGlobal('no-network', $global);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=no-network&' . time());

}

// TODO: INIT
$disabled = 'disabled';

$current_setting = $db->getAddOns('no-network', $current_page_target);
if (!isset($current_setting['no-network']))
{
    $current_setting['no-network'] = '';
}
if ($current_setting['no-network'] != '')
{
    $disabled = '';
}

if (!isset($current_setting['no-network']))
{
    $current_setting['no-network'] = '';
}

if (!isset($current_setting['title-for-no-network-page']))
{
    $current_setting['title-for-no-network-page'] = 'No Network!';
}

if (!isset($current_setting['header-color-for-no-network-page']))
{
    $current_setting['header-color-for-no-network-page'] = 'danger';
}

if (!isset($current_setting['background-for-no-network-page']))
{
    $current_setting['background-for-no-network-page'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['content-for-no-network-page']))
{

    $current_setting['content-for-no-network-page'] = 'There is no internet connection, please try again later!';
}


// TODO: LAYOUT
$content .= '<form action="" method="post"><!-- ./form -->';

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

//$content .= '<div class="callout callout-default">'.__e('Please complete the form below to let us know how we can help you build code:').'</div>';
$content .= '<div class="callout callout-danger">' . __e('These addons require the <strong>Cordova Plugin</strong> and <strong>Ionic Native</strong>, to be able to run the emulator you have to <a href="./?p=2.update-plugin">update it</a>') . '</div>';
$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- NO-NETWORK
$options = array();
$options[] = array('label' => 'Just a notification', 'value' => 'notification');
$options[] = array('label' => 'Goto No Network Page', 'value' => 'no-network-page');

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-no-network">' . __e('No Network') . '</label>';
$content .= '<select id="page-no-network" name="no-network[no-network]" class="form-control" >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['no-network'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Events when there is no internet') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-no-network" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" />';
if ($disabled !== 'disabled')
{
    $content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-no-network" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
}
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('No Network Page') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-12"><!-- col-md-12 -->';

$content .= '<div class="form-group">';
$content .= '<label for="title-for-no-network-page">' . __e('Page Title') . '</label>';
$content .= '<input id="title-for-no-network-page" type="text" name="no-network[title-for-no-network-page]" class="form-control" placeholder="No Network!"  value="' . $current_setting['title-for-no-network-page'] . '" />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./col-md-12 -->';
$content .= '<div class="col-md-6"><!-- col-md-6 -->';

$content .= '<div class="form-group">';
$content .= '<label for="header-color-for-no-network-page">' . __e('Header Color') . '</label>';
$content .= '<select name="no-network[header-color-for-no-network-page]" class="form-control select-color" data-color="' . $current_setting['header-color-for-no-network-page'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['header-color-for-no-network-page'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./col-md-6 -->';

$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="background-for-no-network-page">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="background-for-no-network-page" type="text" name="no-network[background-for-no-network-page]" class="form-control" placeholder="assets/images/background/bg-01.png"  value="' . $current_setting['background-for-no-network-page'] . '"  />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#background-for-no-network-page" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="content-for-no-network-page">' . __e('No Network Content') . '</label>';
$content .= '<textarea data-type="tinymce" id="content-for-no-network-page" name="no-network[content-for-no-network-page]" class="form-control" >' . htmlentities($current_setting['content-for-no-network-page']) . '</textarea>';

$content .= '<p class="help-block">' . __e('The message that appears if there is no internet') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';

$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-no-network" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" />';
if ($disabled !== 'disabled')
{
    $content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-no-network" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
}
$content .= '</div>';

$content .= '</div>';


$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-newspaper"></i> ' . __e('Rules') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="callout callout-default">' . __e('Please check the page that requires an internet connection') . '</div>';

$content .= '<table class="table table-striped">';

$content .= '<thead>';
$content .= '<tr>';

$content .= '<th>';
$content .= '' . __e('Pages') . '';
$content .= '</th>';

$content .= '<th>';
$content .= '' . __e('Required') . '';
$content .= '</th>';


$content .= '</tr>';
$content .= '</thead>';

foreach ($static_pages as $static_page)
{
    $page_name = $string->toFilename($static_page['name']);

    $page_checked = '';
    if (isset($current_setting['pages'][$page_name]))
    {
        if ($current_setting['pages'][$page_name] == true)
        {
            $page_checked = 'checked';
        }
    }


    $content .= '<tr>';

    $content .= '<td>';
    $content .= $page_name;
    $content .= '</td>';

    $content .= '<td>';
    $content .= '<input name="no-network[pages][' . $page_name . ']" type="checkbox" ' . $page_checked . ' class="flat-red" />';
    $content .= '</td>';

    $content .= '</tr>';
}
$content .= '</table>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-no-network" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
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
$content .= '<pre class="shell">ionic cordova plugin add cordova-plugin-network-information@latest --save </pre>';
$content .= '<pre class="shell">npm install @ionic-native/network@latest --save</pre>';
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
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=no-network&page-target="+$("#page-target").val(),!1});';
