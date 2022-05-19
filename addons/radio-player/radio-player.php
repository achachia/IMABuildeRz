<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `radio-player`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("radio-player");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('radio-player', $current_page_target);
    header('Location: ./?p=addons&addons=radio-player&' . time());
}

// TODO: POST
if (isset($_POST['save-radio-player']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['radio-player']['page-title']);

    $addons['radio-name'] = trim($_POST['radio-player']['radio-name']);
    $addons['radio-url'] = trim($_POST['radio-player']['radio-url']);
    $addons['radio-logo'] = trim($_POST['radio-player']['radio-logo']);
    $addons['song-title'] = trim($_POST['radio-player']['song-title']);
    $addons['code-used'] = trim($_POST['radio-player']['code-used']);
    //$addons['radio-background'] = trim($_POST['radio-player']['radio-background']);
    $addons['page-header-color'] = trim($_POST['radio-player']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['radio-player']['page-content-background']);
    //label-for-no-information
    if (!isset($_POST['radio-player']['label-for-no-information']))
    {
        $_POST['radio-player']['label-for-no-information'] = 'No information is available';
    }
    $addons['label-for-no-information'] = trim($_POST['radio-player']['label-for-no-information']); //text

    //label-for-media-retrieved
    if (!isset($_POST['radio-player']['label-for-media-retrieved']))
    {
        $_POST['radio-player']['label-for-media-retrieved'] = 'Media resource has been retrieved';
    }
    $addons['label-for-media-retrieved'] = trim($_POST['radio-player']['label-for-media-retrieved']); //text

    //label-for-data-available
    if (!isset($_POST['radio-player']['label-for-data-available']))
    {
        $_POST['radio-player']['label-for-data-available'] = 'Data is available';
    }
    $addons['label-for-data-available'] = trim($_POST['radio-player']['label-for-data-available']); //text

    //label-for-current-playback
    if (!isset($_POST['radio-player']['label-for-current-playback']))
    {
        $_POST['radio-player']['label-for-current-playback'] = 'Data for the current playback position ';
    }
    $addons['label-for-current-playback'] = trim($_POST['radio-player']['label-for-current-playback']); //text

    //label-for-enough-data
    if (!isset($_POST['radio-player']['label-for-enough-data']))
    {
        $_POST['radio-player']['label-for-enough-data'] = 'Enough data is available';
    }
    $addons['label-for-enough-data'] = trim($_POST['radio-player']['label-for-enough-data']); //text

    //label-for-nothing
    if (!isset($_POST['radio-player']['label-for-nothing']))
    {
        $_POST['radio-player']['label-for-nothing'] = 'Nothing';
    }
    $addons['label-for-nothing'] = trim($_POST['radio-player']['label-for-nothing']); //text
    //label-for-stopped
    if (!isset($_POST['radio-player']['label-for-stopped']))
    {
        $_POST['radio-player']['label-for-stopped'] = 'Stopped';
    }
    $addons['label-for-stopped'] = trim($_POST['radio-player']['label-for-stopped']); //text

    //label-for-paused
    if (!isset($_POST['radio-player']['label-for-paused']))
    {
        $_POST['radio-player']['label-for-paused'] = 'Paused';
    }
    $addons['label-for-paused'] = trim($_POST['radio-player']['label-for-paused']); //text

    //label-for-played
    if (!isset($_POST['radio-player']['label-for-played']))
    {
        $_POST['radio-player']['label-for-played'] = 'Played';
    }
    $addons['label-for-played'] = trim($_POST['radio-player']['label-for-played']); //text

    //label-for-offline
    if (!isset($_POST['radio-player']['label-for-offline']))
    {
        $_POST['radio-player']['label-for-offline'] = 'Offline';
    }
    $addons['label-for-offline'] = trim($_POST['radio-player']['label-for-offline']); //text

    //label-for-starting
    if (!isset($_POST['radio-player']['label-for-starting']))
    {
        $_POST['radio-player']['label-for-starting'] = 'Starting';
    }
    $addons['label-for-starting'] = trim($_POST['radio-player']['label-for-starting']); //text

    //label-for-running
    if (!isset($_POST['radio-player']['label-for-running']))
    {
        $_POST['radio-player']['label-for-running'] = 'Running';
    }
    $addons['label-for-running'] = trim($_POST['radio-player']['label-for-running']); //text

    //label-for-aborted
    if (!isset($_POST['radio-player']['label-for-aborted']))
    {
        $_POST['radio-player']['label-for-aborted'] = 'Aborted';
    }
    $addons['label-for-aborted'] = trim($_POST['radio-player']['label-for-aborted']); //text

    //label-for-network-error
    if (!isset($_POST['radio-player']['label-for-network-error']))
    {
        $_POST['radio-player']['label-for-network-error'] = 'Network error';
    }
    $addons['label-for-network-error'] = trim($_POST['radio-player']['label-for-network-error']); //text

    //label-for-decoding-error
    if (!isset($_POST['radio-player']['label-for-decoding-error']))
    {
        $_POST['radio-player']['label-for-decoding-error'] = 'Decoding error';
    }
    $addons['label-for-decoding-error'] = trim($_POST['radio-player']['label-for-decoding-error']); //text

    //label-for-no-supported
    if (!isset($_POST['radio-player']['label-for-no-supported']))
    {
        $_POST['radio-player']['label-for-no-supported'] = 'No Supported';
    }
    $addons['label-for-no-supported'] = trim($_POST['radio-player']['label-for-no-supported']); //text

    //label-for-unknow-error
    if (!isset($_POST['radio-player']['label-for-unknow-error']))
    {
        $_POST['radio-player']['label-for-unknow-error'] = 'Unknow error';
    }
    $addons['label-for-unknow-error'] = trim($_POST['radio-player']['label-for-unknow-error']); //text

    //minimize-button
    // checkbox
    if (isset($_POST['radio-player']['minimize-button']))
    {
        $addons['minimize-button'] = true;
    } else
    {
        $addons['minimize-button'] = false;
    }

    //label-for-minimize
    if (!isset($_POST['radio-player']['label-for-minimize']))
    {
        $_POST['radio-player']['label-for-minimize'] = 'Minimize';
    }
    $addons['label-for-minimize'] = trim($_POST['radio-player']['label-for-minimize']); //text

    $db->saveAddOns('radio-player', $addons);


    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'radio-player';
    $newPage['icon-left'] = 'radio';
    $newPage['icon-right'] = '';

    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    $i = 0;
    // TODO: POST --|-- MODULES
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'interval';
    $newPage['modules']['angular'][$i]['var'] = '';
    $newPage['modules']['angular'][$i]['path'] = 'rxjs';


    $i++;
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'take';
    $newPage['modules']['angular'][$i]['var'] = '';
    $newPage['modules']['angular'][$i]['path'] = 'rxjs/operators';

    if ($addons['code-used'] == 'cordova-plugin-media')
    {
        $i++;
        $newPage['modules']['angular'][$i]['enable'] = true;
        $newPage['modules']['angular'][$i]['class'] = 'Media';
        $newPage['modules']['angular'][$i]['var'] = 'media';
        $newPage['modules']['angular'][$i]['path'] = '@ionic-native/media/ngx';
        $newPage['modules']['angular'][$i]['cordova'] = 'cordova-plugin-media';

        $i++;
        $newPage['modules']['angular'][$i]['enable'] = true;
        $newPage['modules']['angular'][$i]['class'] = 'MediaObject';
        $newPage['modules']['angular'][$i]['var'] = '';
        $newPage['modules']['angular'][$i]['path'] = '@ionic-native/media/ngx';
        $newPage['modules']['angular'][$i]['cordova'] = 'cordova-plugin-media';
    }

    $i++;
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'HttpClient';
    $newPage['modules']['angular'][$i]['var'] = 'httpClient';
    $newPage['modules']['angular'][$i]['path'] = '@angular/common/http';

    $i++;
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'HttpErrorResponse';
    $newPage['modules']['angular'][$i]['var'] = '';
    $newPage['modules']['angular'][$i]['path'] = '@angular/common/http';

    $i++;
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'HttpClientJsonpModule';
    $newPage['modules']['angular'][$i]['var'] = '';
    $newPage['modules']['angular'][$i]['path'] = '@angular/common/http';

    $i++;
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'Insomnia';
    $newPage['modules']['angular'][$i]['var'] = 'insomnia';
    $newPage['modules']['angular'][$i]['path'] = '@ionic-native/insomnia/ngx';
    $newPage['modules']['angular'][$i]['cordova'] = 'cordova-plugin-insomnia';
    if ($addons['minimize-button'] == true)
    {
        $i++;
        $newPage['modules']['angular'][$i]['enable'] = true;
        $newPage['modules']['angular'][$i]['class'] = 'AppMinimize';
        $newPage['modules']['angular'][$i]['var'] = 'appMinimize';
        $newPage['modules']['angular'][$i]['path'] = '@ionic-native/app-minimize/ngx';
        $newPage['modules']['angular'][$i]['cordova'] = 'cordova-plugin-appminimize';
    }


    $i++;
    $newPage['modules']['angular'][$i]['enable'] = true;
    $newPage['modules']['angular'][$i]['class'] = 'Platform';
    $newPage['modules']['angular'][$i]['var'] = 'platform';
    $newPage['modules']['angular'][$i]['path'] = '@ionic/angular';


    $newPage['header']['color'] = $addons['page-header-color'];

    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];


    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<img src="' . $addons['radio-logo'] . '" />' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-header text-center="">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle>{{ radioStatus }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-title>' . $addons['radio-name'] . '</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-header>' . "\r\n";
    switch ($addons['song-title'])
    {
        case 'shoutcast':
            $newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle *ngIf="dataStats.servergenre" [innerHTML]="dataStats.servergenre"></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-title *ngIf="dataStats.songtitle" [innerHTML]="dataStats.songtitle"></ion-card-title>' . "\r\n";

            $newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle *ngIf="!dataStats || !dataStats.servergenre"><ion-skeleton-text style="width: 100%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-title *ngIf="!dataStats || !dataStats.songtitle"><ion-skeleton-text style="width: 100%"></ion-skeleton-text></ion-card-title>' . "\r\n";


            break;
        case 'icecast':
            $newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle *ngIf="dataStats.icestats && dataStats.icestats.source && dataStats.icestats.source[0] && dataStats.icestats.source[0].genre" [innerHTML]="dataStats.icestats.source[0].genre"></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-title *ngIf="dataStats.icestats && dataStats.icestats.source && dataStats.icestats.source[0] && dataStats.icestats.source[0].title" [innerHTML]="dataStats.icestats.source[0].title"></ion-card-title>' . "\r\n";
            break;
    }
    $newPage['content']['html'] .= "\t\t" . '<ion-card-subtitle text-center="">{{ radioPlaybackPosition | number:\'1.0-0\'}} sec</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-button *ngIf="!isPlay" expand="block" size="large" shape="round" (click)="play()"><ion-icon name="play"></ion-icon></ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-button *ngIf="isPlay" expand="block" size="large" shape="round" (click)="stop()"><ion-icon name="square"></ion-icon></ion-button>' . "\r\n";
    if ($addons['minimize-button'] == true)
    {
        $newPage['content']['html'] .= "\t\t" . '<ion-button fill="outline" (click)="hideMe()">' . $addons['label-for-minimize'] . '</ion-button>' . "\r\n";
    }
    $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= '</ion-card>' . "\r\n";

    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {text-align: center;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-title {text-align: center;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-subtitle {text-align: center;}' . "\r\n";
    // TODO: POST --|-- PAGE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['init'] = null;


    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'radioUrl: string = `' . $addons['radio-url'] . '`;' . "\r\n";

    switch ($addons['song-title'])
    {
        case 'shoutcast':
            $parse_url = parse_url($addons['radio-url']);
            $api_current_song = '' . $parse_url['scheme'] . '://' . $parse_url['host'] . ':' . $parse_url['port'] . '/stats?json=1&callback=info';
            $newPage['code']['other'] .= "\t" . 'urlSong: string = `' . $api_current_song . '`;' . "\r\n";
            break;
        case 'icecast':
            $parse_url = parse_url($addons['radio-url']);
            $api_current_song = '' . $parse_url['scheme'] . '://' . $parse_url['host'] . ':' . $parse_url['port'] . '/status-json.xsl';
            $newPage['code']['other'] .= "\t" . 'corsProxy: string = `https://api.codetabs.com/v1/proxy?quest=`;' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'urlSong: string = `' . $api_current_song . '`;' . "\r\n";
            break;
    }


    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t" . 'radioPlayer: MediaObject ;' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t" . 'radioPlayer: any ;' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . 'radioStatus: string = `' . $addons['label-for-stopped'] . '`;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'isPlay: boolean = false;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'radioPlaybackPosition: number = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['minimize-button'] == true)
    {
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:hideMe()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'hideMe(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.appMinimize.minimize();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    }

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer = this.media.create(this.radioUrl);' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer = new Audio(this.radioUrl);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.id = "radio-player-' . time() . '";' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '//console.log("1st",this.radioPlayer);' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.updateStatus();' . "\r\n";
    switch ($addons['song-title'])
    {
        case 'shoutcast':
            $newPage['code']['other'] .= "\t\t" . 'this.updateSongTitle();' . "\r\n";
            break;
        case 'icecast':
            $newPage['code']['other'] .= "\t\t" . 'this.updateSongTitle();' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t" . 'ionViewWillLeave(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.pause();' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            break;
    }

    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:play()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'play(){' . "\r\n";
    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.play();' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t\t" . 'this.isPlay = true;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioStatus = `' . $addons['label-for-played'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.play();' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.insomnia.keepAwake().then(' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '() => console.log("keepAwake: success"),' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '() => console.log("keepAwake: error")' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:pause()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'pause(){' . "\r\n";
    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.pause();' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t\t" . 'this.isPlay = false;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioStatus = `' . $addons['label-for-paused'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.pause();' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:stop()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'stop(){' . "\r\n";
    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.stop();' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t\t" . 'this.isPlay = false;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioStatus = `' . $addons['label-for-stopped'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.pause();' . "\r\n";
            break;
    }

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.insomnia.allowSleepAgain().then(' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '() => console.log("allowSleep: success"),' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '() => console.log("allowSleep: error")' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    $newPage['code']['other'] .= "\t" . '}' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:updateStatus()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'updateStatus(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// playback position' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const numbers_playback = interval(1000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'numbers_playback.pipe().subscribe(num => {' . "\r\n";
    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t\t\t" . 'this.radioPlayer.getCurrentPosition().then((position) => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.radioPlaybackPosition = position ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t\t\t" . 'this.radioPlaybackPosition = this.radioPlayer.currentTime ;' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";


    switch ($addons['code-used'])
    {
        case 'cordova-plugin-media':
            $newPage['code']['other'] .= "\t\t" . '// event error' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.onError.subscribe(err => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'this.isPlay = false;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'switch(err){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 1:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-aborted'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 2:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-network-error'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 3:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-decoding-error'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 4:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-no-supported'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'default :{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-unknow-error'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";

            $newPage['code']['other'] .= "\t\t" . '// event status update' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.radioPlayer.onStatusUpdate.subscribe(status => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'switch(status){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 0:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-offline'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isPlay = true;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 1:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-starting'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isPlay = true;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 2:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-running'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isPlay = true;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 3:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-paused'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isPlay = false;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 4:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-stopped'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isPlay = false;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'default :{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-stopped'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isPlay = false;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            break;
        case 'html5-audio':
            $newPage['code']['other'] .= "\t\t" . 'const numbers_state = interval(1000);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'numbers_state.pipe().subscribe(num => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '// event status update' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'let status = this.radioPlayer.readyState;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'switch(status){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 0:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-no-information'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 1:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-media-retrieved'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 2:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-data-available'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 3:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-current-playback'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'case 4:{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-enough-data'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'default :{' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.radioStatus = `' . $addons['label-for-nothing'] . '`;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'break;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
            break;
    }


    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    switch ($addons['song-title'])
    {
        case 'shoutcast':
            $newPage['code']['other'] .= "\t" . 'dataStats:any = {};' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:updateSongTitle()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'updateSongTitle(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'const numbers = interval(10000);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'numbers.pipe().subscribe(num => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if(this.isPlay ==true){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.httpClient.jsonp( this.urlSong,`callback`).subscribe( jsonp => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'console.log("stats",jsonp) ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataStats = jsonp;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            break;
        case 'icecast':
            $newPage['code']['other'] .= "\t" . 'dataStats:any = {};' . "\r\n";
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_page_target) . 'Page:updateSongTitle()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'updateSongTitle(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'const numbers = interval(10000);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'numbers.pipe().subscribe(num => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'if(this.isPlay ==true){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'this.httpClient.get(this.corsProxy + this.urlSong).subscribe( data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'console.log("stats",data) ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataStats = data;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            break;
    }


    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=radio-player&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('radio-player', $current_page_target);
}
if (!isset($current_setting['page-target']))
{
    $current_setting['page-target'] = '';
}
if (!isset($current_setting['page-title']))
{
    $current_page_title = '';
    if ($current_page_target != '')
    {
        $current_page = $db->getPage($current_page_target);
        $current_page_title = $current_page['title'];
    }
    $current_setting['page-title'] = $current_page_title;
}

if (!isset($current_setting['radio-url']))
{
    $current_setting['radio-url'] = 'http://119.82.232.83:80/;stream.mp3';
}

if (!isset($current_setting['radio-url']))
{
    $current_setting['radio-url'] = 'http://119.82.232.83:80/;stream.mp3';
}

if (!isset($current_setting['code-used']))
{
    $current_setting['code-used'] = 'html5-audio';
}


if (!isset($current_setting['radio-logo']))
{
    $current_setting['radio-logo'] = 'assets/images/landscape/image-3.jpg';
}

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['radio-name']))
{
    $current_setting['radio-name'] = 'My Radio 63 FM';
}

if (!isset($current_setting['song-title']))
{
    $current_setting['song-title'] = 'none';
}
if (!isset($current_setting['label-for-no-information']))
{
    $current_setting['label-for-no-information'] = 'No information is available';
}

if (!isset($current_setting['label-for-media-retrieved']))
{
    $current_setting['label-for-media-retrieved'] = 'Media resource has been retrieved';
}

if (!isset($current_setting['label-for-data-available']))
{
    $current_setting['label-for-data-available'] = 'Data is available';
}

if (!isset($current_setting['label-for-current-playback']))
{
    $current_setting['label-for-current-playback'] = 'Data for the current playback position';
}

if (!isset($current_setting['label-for-enough-data']))
{
    $current_setting['label-for-enough-data'] = 'Enough data is available';
}

if (!isset($current_setting['label-for-nothing']))
{
    $current_setting['label-for-nothing'] = 'Nothing';
}


if (!isset($current_setting['label-for-stopped']))
{
    $current_setting['label-for-stopped'] = 'Stopped';
}

if (!isset($current_setting['label-for-paused']))
{
    $current_setting['label-for-paused'] = 'Paused';
}

if (!isset($current_setting['label-for-played']))
{
    $current_setting['label-for-played'] = 'Played';
}

if (!isset($current_setting['label-for-offline']))
{
    $current_setting['label-for-offline'] = 'Offline';
}

if (!isset($current_setting['label-for-starting']))
{
    $current_setting['label-for-starting'] = 'Starting';
}

if (!isset($current_setting['label-for-running']))
{
    $current_setting['label-for-running'] = 'Running';
}

if (!isset($current_setting['label-for-aborted']))
{
    $current_setting['label-for-aborted'] = 'Aborted';
}

if (!isset($current_setting['label-for-network-error']))
{
    $current_setting['label-for-network-error'] = 'Network error';
}

if (!isset($current_setting['label-for-decoding-error']))
{
    $current_setting['label-for-decoding-error'] = 'Decoding error';
}

if (!isset($current_setting['label-for-no-supported']))
{
    $current_setting['label-for-no-supported'] = 'No Supported';
}

if (!isset($current_setting['label-for-unknow-error']))
{
    $current_setting['label-for-unknow-error'] = 'Unknow error';
}

if (!isset($current_setting['minimize-button']))
{
    $current_setting['minimize-button'] = false;
}

if (!isset($current_setting['label-for-minimize']))
{
    $current_setting['label-for-minimize'] = 'Minimize';
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
$content .= '<div class="callout callout-danger">' . __e('These addons require the <strong>Cordova Plugin</strong> and <strong>Ionic Native</strong>, to be able to run the emulator you have to <a href="./?p=2.update-plugin">update it</a>') . '</div>';


if (parse_url($current_setting['radio-url'], PHP_URL_SCHEME) == 'http')
{
    $content .= '<div class="callout callout-danger"><h4>Warning!</h4><p>' . __e('Radio URL do not use ssl, This might not work normally in APK/IPA (Android/IOS Devices)') . '</p></div>' . "\r\n";
}
$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="radio-player[page-target]" class="form-control" >';
$content .= '<option value="">' . __e('Page Target') . '</option>';
foreach ($static_pages as $item_page)
{
    $code_by = '';
    if (isset($item_page['code-by']))
    {
        $code_by = ' - ' . __e('by') . ': ' . $item_page['code-by'];
    }
    $selected = '';
    if ($current_setting['page-target'] == $item_page["name"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($item_page["name"]) . ' " ' . $selected . '>- ' . htmlentities($item_page["title"]) . ' (' . htmlentities($item_page["name"]) . '' . $code_by . ')</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select the page to be overwritten') . '</p>';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-6"><!-- col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- PAGE-TITLE
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input  id="page-title" type="text" name="radio-player[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';
$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- RADIO-NAME
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Radio Name') . '</label>';
$content .= '<input  id="page-title" type="text" name="radio-player[radio-name]" class="form-control" placeholder="My Radio"  value="' . $current_setting['radio-name'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Your radio name') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- RADIO-URL
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-url">' . __e('URL Radio') . '</label>';
$content .= '<input id="page-url" type="url" name="radio-player[radio-url]" class="form-control" placeholder="http://125.160.17.21:8200/;stream.mp3"  value="' . $current_setting['radio-url'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Please enter your icecast or shoutcast url') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- RADIO-LOGO
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-logo">' . __e('Featured Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-logo" type="text" name="radio-player[radio-logo]" class="form-control" placeholder="assets/images/logo.png"  value="' . $current_setting['radio-logo'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-logo" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('Rectangular image used for radio header') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- RADIO-BACKGROUND
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="radio-player[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['page-header-color'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- PAGE-CONTENT-BACKGROUND
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-background">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-content-background" type="text" name="radio-player[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- CURRENT-SONG

$option_song_titles[] = array('value' => 'shoutcast', 'label' => 'SHOUTcast');
$option_song_titles[] = array('value' => 'icecast', 'label' => 'Icecast');

$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Song Title') . '</label>';
$content .= '<select id="page-target" name="radio-player[song-title]" class="form-control" >';
$content .= '<option value="">' . __e('None') . '</option>';
foreach ($option_song_titles as $option_song_title)
{
    $selected = '';
    if ($current_setting['song-title'] == $option_song_title["value"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option_song_title["value"]) . ' " ' . $selected . '>' . htmlentities($option_song_title["label"]) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select song title source') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- CODE
$option_codes[] = array('value' => 'cordova-plugin-media', 'label' => 'Corova Plugin Media');
$option_codes[] = array('value' => 'html5-audio', 'label' => 'HTML5 Audio');

$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Code Used?') . '</label>';
$content .= '<select id="page-target" name="radio-player[code-used]" class="form-control" >';
foreach ($option_codes as $option_code)
{
    $selected = '';
    if ($current_setting['code-used'] == $option_code["value"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option_code["value"]) . ' " ' . $selected . '>' . htmlentities($option_code["label"]) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select code used for radio, HTML5 Audio only support for Icecast 2.4.x or SHOUTcast 2.5.x or latest') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- MINIMIZE-BUTTON --|-- CHECKBOX
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-minimize-button" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Options') . '</label>';
$content .= '<table class="table">';
$content .= '<tr>';
if ($current_setting['minimize-button'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-minimize-button" name="radio-player[minimize-button]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-minimize-button" name="radio-player[minimize-button]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Add the Minimize button, this only works in the Android platform') . '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="help-dev">*** ' . __e('Support testing using the <a target="blank" href="https://ionicframework.com/docs/appflow/devapp/">Ionic devApp</a> for <a target="blank" href="https://itunes.apple.com/us/app/ionic-devapp/id1233447133?ls=1&mt=8">iOS</a> and <a target="blank" href="https://play.google.com/store/apps/details?id=io.ionic.devapp">android</a>') . '</div>';

$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-radio-player" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';

$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-5"><!-- col-md-5 -->';

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-INFORMATION --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-information" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-information">' . __e('Label for `No information is available`') . '</label>';
$content .= '<input id="page-label-for-no-information" type="text" name="radio-player[label-for-no-information]" class="form-control" placeholder="No information is available"  value="' . $current_setting['label-for-no-information'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No information is available`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-MEDIA-RETRIEVED --|-- TEXT

$content .= '<div id="field-label-for-media-retrieved" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-media-retrieved">' . __e('Label for `Media resource has been retrieved`') . '</label>';
$content .= '<input id="page-label-for-media-retrieved" type="text" name="radio-player[label-for-media-retrieved]" class="form-control" placeholder="Media resource has been retrieved"  value="' . $current_setting['label-for-media-retrieved'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Media resource has been retrieved`') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DATA-AVAILABLE --|-- TEXT

$content .= '<div id="field-label-for-data-available" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-data-available">' . __e('Label for `Data is available`') . '</label>';
$content .= '<input id="page-label-for-data-available" type="text" name="radio-player[label-for-data-available]" class="form-control" placeholder="Data is available"  value="' . $current_setting['label-for-data-available'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Data is available`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CURRENT-PLAYBACK --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-current-playback" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-current-playback">' . __e('Label for `Data for the current playback position`') . '</label>';
$content .= '<input id="page-label-for-current-playback" type="text" name="radio-player[label-for-current-playback]" class="form-control" placeholder="Data for the current playback position"  value="' . $current_setting['label-for-current-playback'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Data for the current playback position`') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ENOUGH-DATA --|-- TEXT

$content .= '<div id="field-label-for-enough-data" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-enough-data">' . __e('Label for `Enough data is available`') . '</label>';
$content .= '<input id="page-label-for-enough-data" type="text" name="radio-player[label-for-enough-data]" class="form-control" placeholder="Enough data is available"  value="' . $current_setting['label-for-enough-data'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Enough data is available`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NOTHING --|-- TEXT

$content .= '<div id="field-label-for-nothing" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-nothing">' . __e('Label for `Nothing`') . '</label>';
$content .= '<input id="page-label-for-nothing" type="text" name="radio-player[label-for-nothing]" class="form-control" placeholder="Nothing"  value="' . $current_setting['label-for-nothing'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Nothing`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-STOPPED --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-stopped" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-stopped">' . __e('Label for `Stopped`') . '</label>';
$content .= '<input id="page-label-for-stopped" type="text" name="radio-player[label-for-stopped]" class="form-control" placeholder="Stopped"  value="' . $current_setting['label-for-stopped'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Stopped`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PAUSED --|-- TEXT

$content .= '<div id="field-label-for-paused" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-paused">' . __e('Label for `Paused`') . '</label>';
$content .= '<input id="page-label-for-paused" type="text" name="radio-player[label-for-paused]" class="form-control" placeholder="Paused"  value="' . $current_setting['label-for-paused'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Paused`') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLAYED --|-- TEXT

$content .= '<div id="field-label-for-played" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-played">' . __e('Label for `Played`') . '</label>';
$content .= '<input id="page-label-for-played" type="text" name="radio-player[label-for-played]" class="form-control" placeholder="Played"  value="' . $current_setting['label-for-played'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Played`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OFFLINE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-offline" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-offline">' . __e('Label for `Offline`') . '</label>';
$content .= '<input id="page-label-for-offline" type="text" name="radio-player[label-for-offline]" class="form-control" placeholder="Offline"  value="' . $current_setting['label-for-offline'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Stopped`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-STARTING --|-- TEXT

$content .= '<div id="field-label-for-starting" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-starting">' . __e('Label for `Starting`') . '</label>';
$content .= '<input id="page-label-for-starting" type="text" name="radio-player[label-for-starting]" class="form-control" placeholder="Starting"  value="' . $current_setting['label-for-starting'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Starting`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-RUNNING --|-- TEXT

$content .= '<div id="field-label-for-running" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-running">' . __e('Label for `Running`') . '</label>';
$content .= '<input id="page-label-for-running" type="text" name="radio-player[label-for-running]" class="form-control" placeholder="Running"  value="' . $current_setting['label-for-running'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Running`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ABORTED --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-aborted" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-aborted">' . __e('Label for `Aborted`') . '</label>';
$content .= '<input id="page-label-for-aborted" type="text" name="radio-player[label-for-aborted]" class="form-control" placeholder="Aborted"  value="' . $current_setting['label-for-aborted'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Aborted`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NETWORK-ERROR --|-- TEXT

$content .= '<div id="field-label-for-network-error" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-network-error">' . __e('Label for `Network error`') . '</label>';
$content .= '<input id="page-label-for-network-error" type="text" name="radio-player[label-for-network-error]" class="form-control" placeholder="Network error"  value="' . $current_setting['label-for-network-error'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Network error`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DECODING-ERROR --|-- TEXT

$content .= '<div id="field-label-for-decoding-error" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-decoding-error">' . __e('Label for `Decoding error`') . '</label>';
$content .= '<input id="page-label-for-decoding-error" type="text" name="radio-player[label-for-decoding-error]" class="form-control" placeholder="Decoding error"  value="' . $current_setting['label-for-decoding-error'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Decoding error`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-SUPPORTED --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-supported" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-supported">' . __e('Label for `No Supported`') . '</label>';
$content .= '<input id="page-label-for-no-supported" type="text" name="radio-player[label-for-no-supported]" class="form-control" placeholder="No Supported"  value="' . $current_setting['label-for-no-supported'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No Supported`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-UNKNOW-ERROR --|-- TEXT

$content .= '<div id="field-label-for-unknow-error" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-unknow-error">' . __e('Label for `Unknow error`') . '</label>';
$content .= '<input id="page-label-for-unknow-error" type="text" name="radio-player[label-for-unknow-error]" class="form-control" placeholder="Unknow error"  value="' . $current_setting['label-for-unknow-error'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Unknow error`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-MINIMIZE --|-- TEXT

$content .= '<div id="field-label-for-minimize" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-minimize">' . __e('Label for `Minimize`') . '</label>';
$content .= '<input id="page-label-for-minimize" type="text" name="radio-player[label-for-minimize]" class="form-control" placeholder="Minimize"  value="' . $current_setting['label-for-minimize'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Minimize`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-radio-player" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Latest Used') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Some settings that you have made:') . '</div>';
$content .= '<div class="table-responsive">';
$content .= '<table class="table table-striped" id="latest-used">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>#</th>';
$content .= '<th>' . __e('Target') . '</th>';
$content .= '<th>' . __e('Title') . '</th>';
$content .= '<th></th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';
$modal_dialog = null;
if (count($addons_settings) >= 1)
{
    $no = 1;
    foreach ($addons_settings as $pageList)
    {
        $content .= '<tr>';
        $content .= '<td>' . $no . '</td>';
        $content .= '<td><a target="_blank" href="./?p=pages&amp;a=edit&amp;page-name=' . $pageList['page-target'] . '">' . $pageList['page-target'] . '</a></td>';
        $content .= '<td>' . $pageList['page-title'] . '</td>';
        $content .= '<td>';
        $content .= '<a href="./?p=addons&amp;addons=radio-player&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=radio-player&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
        $content .= '</td>';
        $content .= '</tr>';


        $modal_dialog .= '<div class="modal fade modal-default" id="trash-dialog-' . $no . '" tabindex="-1" role="dialog" aria-labelledby="trash-dialog-' . $no . '" aria-hidden="true">';
        $modal_dialog .= '<div class="modal-dialog">';
        $modal_dialog .= '<div class="modal-content">';

        $modal_dialog .= '<div class="modal-header">';
        $modal_dialog .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $modal_dialog .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete Adds-ons Settings') . '</h4>';
        $modal_dialog .= '</div><!-- ./modal-header -->';

        $modal_dialog .= '<div class="modal-body">';
        $modal_dialog .= '<p>' . __e('Deleting this add-ons setting will not delete the page code that you have created. Are you sure want to delete this settings?') . '</p>';
        $modal_dialog .= '<div class="row">';
        $modal_dialog .= '<div class="col-md-3">';
        $modal_dialog .= '<div class="icon icon-confirm text-center"><i class="fa fa-5x fa-cogs"></i></div>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '<div class="col-md-9 text-left">';
        $modal_dialog .= '<table class="table-confirm">';
        $modal_dialog .= '<tr>';
        $modal_dialog .= '<td>' . __e('Page Target') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $pageList['page-target'] . '</strong></td>';
        $modal_dialog .= '</tr>';
        $modal_dialog .= '<tr>';
        $modal_dialog .= '<td>' . __e('Page Title') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $pageList['page-title'] . '</strong></td>';
        $modal_dialog .= '</tr>';
        $modal_dialog .= '</table>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div><!-- ./modal-body -->';
        $modal_dialog .= '<div class="modal-footer">';
        $modal_dialog .= '<a href="./?p=addons&amp;addons=radio-player&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
        $modal_dialog .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div><!-- ./modal-content -->';
        $modal_dialog .= '</div><!-- ./modal-dialog -->';
        $modal_dialog .= '</div><!-- ./modal -->';
        $no++;
    }
} else
{
    $content .= '<tr>';
    $content .= '<td>&nbsp;</td>';
    $content .= '<td>' . __e('no pages') . '</td>';
    $content .= '<td></td>';
    $content .= '<td></td>';
    $content .= '</tr>';
}
$content .= '</tbody>';
$content .= '</table>';
$content .= '</div><!-- ./table-responsive -->';

$content .= '<div class="trash-dialog"><!-- trash-dialog -->';
$content .= $modal_dialog;
$content .= '</div><!-- ./trash-dialog -->';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-support"></i> ' . __e('Technical Guide') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('You must install the dependencies plugin below:') . '</p>';
$content .= '<ol>';
$content .= '<li><p>cordova-plugin-insomnia</p><pre class="shell">ionic cordova plugin add cordova-plugin-insomnia@latest --save</pre></li>';
$content .= '<li><p>@ionic-native/insomnia</p><pre class="shell">npm install --save @ionic-native/insomnia@latest</pre></li>';
if ($current_setting['minimize-button'] == true)
{
    $content .= '<li><p>cordova-plugin-appminimize</p><pre class="shell">ionic cordova plugin add cordova-plugin-appminimize@latest --save</pre></li>';
    $content .= '<li><p>@ionic-native/app-minimize</p><pre class="shell">npm install --save @ionic-native/app-minimize@latest</pre></li>';
}
if ($current_setting['code-used'] == 'cordova-plugin-media')
{
    $content .= '<li><p>cordova-plugin-media</p><pre class="shell">ionic cordova plugin add cordova-plugin-media@latest --save</pre></li>';
    $content .= '<li><p>@ionic-native/media</p><pre class="shell" >npm install --save @ionic-native/media@latest</pre></li>';
}
$content .= '</ol>';

$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=radio-player&page-target="+$("#page-target").val(),!1});';
