<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * @package No project loaded
 */


if (isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{


    $db = new jsmDatabase();
    $string = new jsmString();

    if (!isset($_SESSION['CURRENT_APP']['localization']))
    {
        $_SESSION['CURRENT_APP']['localization'] = array();
    }
    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        $is_localization = true;
    } else
    {
        $is_localization = false;
    }
    //TODO: -------------------------------------------------------------------------------------------------


    // TODO: COMPONENT --+-- POPOVER

    if (!isset($_SESSION['CURRENT_APP']['popover']))
    {
        $_SESSION['CURRENT_APP']['popover']['items'] = array();
    }
    if (!isset($_SESSION['CURRENT_APP']['apps']['ionic-storage']))
    {
        $_SESSION['CURRENT_APP']['apps']['ionic-storage'] = false;
    }
    if (!isset($_SESSION['CURRENT_APP']['localization']))
    {
        $_SESSION['CURRENT_APP']['localization'] = array();
    }

    $_newPopovers = $_SESSION['CURRENT_APP']['popover'];
    $newComponent = null;
    if (!isset($_newPopovers['background']))
    {
        $_newPopovers['background'] = 'light';
    }
    if (!isset($_newPopovers['color']))
    {
        $_newPopovers['color'] = 'dark';
    }
    $pipe_translate = '';
    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        $pipe_translate = ' | translate';
    }

    $bg_color = '';
    if ($_newPopovers['background'] != 'undefined')
    {
        $bg_color = ' color="' . htmlentities($_newPopovers['background']) . '" ';
    }
    $newComponent['name'] = 'Popover';
    $newComponent['var'] = 'popover';
    $newComponent['prefix'] = 'popover';
    $newComponent['html'] = null;
    $newComponent['html'] .= '<ion-list>' . "\r\n";

    foreach ($_newPopovers['items'] as $_item)
    {
        if ($_item['label'] != '')
        {
            if (!isset($_item['page']))
            {
                $_item['page'] = 'home';
            }


            switch ($_item['type'])
            {
                case 'title':
                    $newComponent['html'] .= "\t" . '<ion-list-header ' . $bg_color . '><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-list-header>' . "\r\n";
                    break;
                case 'inlink':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" [routerDirection]="\'forward\'" [routerLink]="\'/' . htmlentities($_item['page']) . '\'"><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'webview':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" appWebview [url]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'cordova-webview':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" cordovaWebview [url]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'appbrowser':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" appBrowser [url]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'systembrowser':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" systemBrowser [url]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'mail':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" mailApp [emailAddress]="\'' . htmlentities($_item['value']) . '\'" [emailSubject]="\'subject\'" [emailMessage]="\'write your message...\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'sms':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" smsApp [phoneNumber]="\'' . htmlentities($_item['value']) . '\'" [shortMessage]="\'write your message...\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'call':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" callApp [phoneNumber]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'geo':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" geoApp [location]="\'' . htmlentities($_item['value']) . '\'" [query]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'playstore':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="dismissPopover()" googlePlayApp [appId]="\'' . htmlentities($_item['value']) . '\'" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'clear-storage':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="clearStorage()" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'exit':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' (click)="exitApp()" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    break;
                case 'dark-mode':
                    $newComponent['html'] .= "\t" . '<ion-item button ' . $bg_color . ' ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text><ion-toggle [(ngModel)]="isDarkMode" (ionChange)="darkMode($event)" slot="end"></ion-toggle></ion-item>' . "\r\n";
                    break;

                case 'language':
                    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
                    {
                        $newComponent['html'] .= "\t" . '<ion-item button color="' . htmlentities($_newPopovers['background']) . '" (click)="switchLanguage()" ><ion-text color="' . htmlentities($_newPopovers['color']) . '">{{"' . $_item['label'] . '"' . $pipe_translate . '}}</ion-text></ion-item>' . "\r\n";
                    }
                    break;

            }
        }
    }
    $newComponent['html'] .= '</ion-list>' . "\r\n";
    //$newComponent['html'] .= '<ion-button (click)="dismissPopover()" expand="block" >Close</ion-button>' . "\r\n";


    $newComponent['scss'] = null;

    $z = 0;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'PopoverController';
    $newComponent['modules']['angular'][$z]['var'] = 'popoverController';
    $newComponent['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'Router';
    $newComponent['modules']['angular'][$z]['var'] = 'router';
    $newComponent['modules']['angular'][$z]['path'] = '@angular/router';

    $z++;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'AlertController';
    $newComponent['modules']['angular'][$z]['var'] = 'alertController';
    $newComponent['modules']['angular'][$z]['path'] = '@ionic/angular';


    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        $z++;
        $newComponent['modules']['angular'][$z]['enable'] = true;
        $newComponent['modules']['angular'][$z]['class'] = 'TranslateConfiguration';
        $newComponent['modules']['angular'][$z]['var'] = 'translateConfiguration';
        $newComponent['modules']['angular'][$z]['path'] = '../../class/translate-configuration/translate-configuration';
    }


    $newComponent['code']['other'] = null;
    $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '* PopoverComponent:dismissPopover()' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'dismissPopover(){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'this.popoverController.dismiss();' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";

    if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
    {
        $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '* PopoverComponent:clearStorage()' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
        $newComponent['code']['other'] .= "\t" . 'clearStorage(){' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'this.dismissPopover();' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'this.storage.clear();' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'this.router.navigate(["/"]);' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";

        if (count($_SESSION['CURRENT_APP']['localization']) != 0)
        {
            $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '* PopoverComponent:switchLanguage()' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
            $newComponent['code']['other'] .= "\t" . 'switchLanguage(){' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . 'this.dismissPopover();' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . 'this.languageOption();' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '* PopoverComponent:languageOption()' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
            $newComponent['code']['other'] .= "\t" . 'languageOption(){' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . 'let inputs:any = [' . "\r\n";
            foreach ($_SESSION['CURRENT_APP']['localization'] as $localization)
            {
                $newComponent['code']['other'] .= "\t\t\t" . '{' . "\r\n";
                $newComponent['code']['other'] .= "\t\t\t\t" . 'name: `language`,' . "\r\n";
                $newComponent['code']['other'] .= "\t\t\t\t" . 'type: `radio`,' . "\r\n";
                $newComponent['code']['other'] .= "\t\t\t\t" . 'label: `' . $localization['name'] . '`,' . "\r\n";
                $newComponent['code']['other'] .= "\t\t\t\t" . 'value: `' . $localization['prefix'] . '`,' . "\r\n";
                $newComponent['code']['other'] .= "\t\t\t" . '},' . "\r\n";
            }
            $newComponent['code']['other'] .= "\t\t" . ' ];' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . 'this.storage.get(`locale`).then(data=>{' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . 'let current_language:string = `' . $_SESSION['CURRENT_APP']['apps']['app-locale'] . '`;' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . 'if(data != null){' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . 'current_language = data;' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . 'console.log(`popover`,`current_language`,data);' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . 'let new_inputs:any = [];' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . 'inputs.forEach((item, key, index) => {' . "\r\n";

            $newComponent['code']['other'] .= "\t\t\t\t" . 'if(item.value == current_language){' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t" . 'new_inputs.push({name: item.name, type: item.type, label: item.label, value: item.value,checked:true});' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . '}else{' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t" . 'new_inputs.push({name: item.name, type: item.type, label: item.label, value: item.value});' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . '});' . "\r\n";

            $newComponent['code']['other'] .= "\t\t\t" . 'this.showLanguage(new_inputs);' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '' . "\r\n";

            $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '* PopoverComponent:showLanguage(data)' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
            $newComponent['code']['other'] .= "\t" . 'async showLanguage(data:any){' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
            if ($is_localization == true)
            {
                $newComponent['code']['other'] .= "\t\t\t" . 'header: this.translateService.instant(`Select Language?`),' . "\r\n";
            } else
            {
                $newComponent['code']['other'] .= "\t\t\t" . 'header: `Select Language?`,' . "\r\n";
            }
            $newComponent['code']['other'] .= "\t\t\t" . 'inputs: data,' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . 'buttons: [' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
            if ($is_localization == true)
            {
                $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: this.translateService.instant(`Cancel`),' . "\r\n";
            } else
            {
                $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: `Cancel`,' . "\r\n";
            }
            $newComponent['code']['other'] .= "\t\t\t\t\t" . 'role: `cancel`,' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t" . 'handler: () => {' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t\t" . '//console.log("Language Cancel");' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
            if ($is_localization == true)
            {
                $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: this.translateService.instant(`Ok`),' . "\r\n";
            } else
            {
                $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: `Ok`,' . "\r\n";
            }
            $newComponent['code']['other'] .= "\t\t\t\t\t" . 'handler: (locale) => {' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t\t" . 'console.log(`locale`,`set`,locale);' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t\t" . 'this.storage.set(`locale`,locale);' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t\t" . 'this.translateConfiguration.setLanguage(locale);' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t\t" . 'this.router.navigate(["/"]);' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
            $newComponent['code']['other'] .= "\t\t\t" . '],' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
            $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '' . "\r\n";
            $newComponent['code']['other'] .= "\t" . '' . "\r\n";


        }

    }

    $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '* PopoverComponent:exitApp()' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'async exitApp(){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'this.dismissPopover();' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    if ($is_localization == true)
    {
        $newComponent['code']['other'] .= "\t\t\t" . 'header: this.translateService.instant(`Do you want to exit App?`),' . "\r\n";
    } else
    {
        $newComponent['code']['other'] .= "\t\t\t" . 'header: `Do you want to exit App?`,' . "\r\n";
    }
    $newComponent['code']['other'] .= "\t\t\t" . 'buttons: [' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    if ($is_localization == true)
    {
        $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: this.translateService.instant(`Cancel`),' . "\r\n";
    } else
    {
        $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: `Cancel`,' . "\r\n";
    }
    $newComponent['code']['other'] .= "\t\t\t\t\t" . 'role: `cancel`,' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t\t\t" . '//console.log("Exit Cancel");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    if ($is_localization == true)
    {
        $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: this.translateService.instant(`Ok`),' . "\r\n";
    } else
    {
        $newComponent['code']['other'] .= "\t\t\t\t\t" . 'text: `Ok`,' . "\r\n";
    }
    $newComponent['code']['other'] .= "\t\t\t\t\t" . 'handler: (data) => {' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t\t\t" . 'navigator["app"].exitApp();' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . '],' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";


    $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '* PopoverComponent:darkMode(event)' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'isDarkMode:boolean = false;' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'darkMode(event){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'let systemDark = window.matchMedia("(prefers-color-scheme: dark)");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'systemDark.addListener(this.colorTest);' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'if(event.detail.checked){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'document.body.setAttribute("data-theme", "dark");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'document.body.setAttribute("data-theme", "light");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '* PopoverComponent:colorTest(systemInitiatedDark)' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'colorTest(systemInitiatedDark){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'if (systemInitiatedDark.matches) {' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'document.body.setAttribute("data-theme", "dark");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'document.body.setAttribute("data-theme", "light");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '* PopoverComponent:ngOnInit()' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'let getDarkMode = document.body.getAttribute("data-theme");' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'if(getDarkMode==`dark`){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'this.isDarkMode = true;' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'this.isDarkMode = false;' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['constructor'] = "\t\t" . '// constructor';
    $db->saveComponent($newComponent);

    // TODO: COMPONENT --+-- IMAGE ZOOM
    $newComponent = null;
    $newComponent['name'] = 'Image Zoom';
    $newComponent['var'] = 'imageZoom';
    $newComponent['prefix'] = 'image-zoom';

    $newComponent['scss'] = null;
    $newComponent['scss'] .= "" . "" . "\r\n";
    $newComponent['scss'] .= "" . "ion-slides{" . "\r\n";
    $newComponent['scss'] .= "\t" . "height: 100%;" . "\r\n";
    $newComponent['scss'] .= "" . "}" . "\r\n";
    $newComponent['scss'] .= "" . "" . "\r\n";
    $newComponent['scss'] .= "" . "ion-content{" . "\r\n";
    $newComponent['scss'] .= "\t" . "--background: rgba(0,0,0,.84);" . "\r\n";
    $newComponent['scss'] .= "" . "}" . "\r\n";
    $newComponent['scss'] .= "" . "" . "\r\n";
    $newComponent['scss'] .= "" . 'ion-buttons{' . "\r\n";
    $newComponent['scss'] .= "\t" . 'background: transparent;' . "\r\n";
    $newComponent['scss'] .= "\t" . 'position: fixed;' . "\r\n";
    $newComponent['scss'] .= "\t" . 'top: 0.5rem;' . "\r\n";
    $newComponent['scss'] .= "\t" . 'color: #ffffff;' . "\r\n";
    $newComponent['scss'] .= "" . '}' . "\r\n";


    $z = 0;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'NavParams';
    $newComponent['modules']['angular'][$z]['var'] = 'navParams';
    $newComponent['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'ModalController';
    $newComponent['modules']['angular'][$z]['var'] = 'modalController';
    $newComponent['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'ElementRef';
    $newComponent['modules']['angular'][$z]['var'] = '';
    $newComponent['modules']['angular'][$z]['path'] = '@angular/core';

    $z++;
    $newComponent['modules']['angular'][$z]['enable'] = true;
    $newComponent['modules']['angular'][$z]['class'] = 'ViewChild';
    $newComponent['modules']['angular'][$z]['var'] = '';
    $newComponent['modules']['angular'][$z]['path'] = '@angular/core';


    $newComponent['html'] = null;
    $newComponent['html'] .= "\t" . '' . "\r\n";
    $newComponent['html'] .= "\t" . '<ion-buttons slot="start">' . "\r\n";
    $newComponent['html'] .= "\t\t" . '<ion-button (click)="close($event)">' . "\r\n";
    $newComponent['html'] .= "\t\t\t" . '<ion-icon name="arrow-back"></ion-icon>' . "\r\n";
    $newComponent['html'] .= "\t\t" . '</ion-button>' . "\r\n";
    $newComponent['html'] .= "\t" . '</ion-buttons>' . "\r\n";

    $newComponent['html'] .= "\t" . '<ion-content fullscreen="true" scroll="false" >' . "\r\n";
    $newComponent['html'] .= "\t\t" . '<ion-slides [options]="sliderOpts" #slider>' . "\r\n";
    $newComponent['html'] .= "\t\t\t" . '<ion-slide>' . "\r\n";
    $newComponent['html'] .= "\t\t\t\t" . '<div class="swiper-zoom-container">' . "\r\n";
    $newComponent['html'] .= "\t\t\t\t\t" . '<img src="{{ img }}" />' . "\r\n";
    $newComponent['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
    $newComponent['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
    $newComponent['html'] .= "\t\t" . '</ion-slides>' . "\r\n";
    $newComponent['html'] .= "\t" . '</ion-content>' . "\r\n";
    $newComponent['html'] .= "\t" . '' . "\r\n";


    $newComponent['code']['other'] = null;
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'img:any;' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '@ViewChild("slider", { read : ElementRef , static : false }) slider:ElementRef;';
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'sliderOpts:any= {' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'passiveListners:true,' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'zoom:{' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'maxRatio: 3' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '},' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'this.img = this.navParams.get(`img`);' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'console.log(`Using a mouse is not recommended`);' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'zoom(ZoomIn:boolean){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'let zoom = this.slider.nativeElement.swiper.zoom ;' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'if(ZoomIn == true){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'zoom.in();' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newComponent['code']['other'] .= "\t\t\t" . 'zoom.out();' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '' . "\r\n";
    $newComponent['code']['other'] .= "\t" . 'close(ev){' . "\r\n";
    $newComponent['code']['other'] .= "\t\t" . 'this.modalController.dismiss();' . "\r\n";
    $newComponent['code']['other'] .= "\t" . '}' . "\r\n";


    $db->saveComponent($newComponent);

    //TODO: -------------------------------------------------------------------------------------------------

    // TODO: CLASS --+-- GLOBAL
    $newClass = null;
    $newClass['name'] = 'Globals';
    $newClass['class'] = 'Globals';
    $newClass['var'] = 'globals';
    $newClass['prefix'] = 'globals';
    $newClass['html'] = null;
    $newClass['scss'] = null;
    $newClass['code']['other'] = null;
    $newClass['code']['other'] .= "\t" . 'devInfo: any = {};';
    $newClass['code']['init'] = "\t\t" . '// init';

    $db->saveClass($newClass);


    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        // TODO: CLASS --+-- TRANSLATE CONFIGURATION
        $newClass = null;
        $newClass['name'] = 'Translate Configuration';
        $newClass['var'] = 'translateConfiguration';
        $newClass['class'] = 'TranslateConfiguration';
        $newClass['prefix'] = 'translate-configuration';
        $newClass['injectable']['provided-in'] = 'root';

        $v = 0;
        $newClass['modules']['angular'][$v]['class'] = 'TranslateService';
        $newClass['modules']['angular'][$v]['var'] = 'translateService';
        $newClass['modules']['angular'][$v]['cordova'] = '';
        $newClass['modules']['angular'][$v]['path'] = '@ngx-translate/core';
        $newClass['modules']['angular'][$v]['enable'] = true;

        $v++;
        $newClass['modules']['angular'][$v]['enable'] = true;
        $newClass['modules']['angular'][$v]['class'] = 'Storage';
        $newClass['modules']['angular'][$v]['var'] = 'storage';
        $newClass['modules']['angular'][$v]['path'] = '@ionic/storage-angular';

        $newClass['html'] = null;
        $newClass['scss'] = null;

        $newClass['code']['constructor'] = "\t\t" . '' . "\r\n";
        $newClass['code']['constructor'] .= "\t\t" . 'this.storageInit();' . "\r\n";
        $newClass['code']['constructor'] .= "\t\t" . 'this.setDefaultLanguage();' . "\r\n";

        $newClass['code']['other'] = null;
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . 'current_language:string = "' . $_SESSION['CURRENT_APP']['apps']['app-locale'] . '";' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";

        $newClass['code']['other'] .= "\t" . '/**' . "\r\n";
        $newClass['code']['other'] .= "\t" . '* init storage' . "\r\n";
        $newClass['code']['other'] .= "\t" . '**/' . "\r\n";
        $newClass['code']['other'] .= "\t" . 'async storageInit(){' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'await this.storage.create();' . "\r\n";
        $newClass['code']['other'] .= "\t" . '}' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";

        $newClass['code']['other'] .= "\t" . '/**' . "\r\n";
        $newClass['code']['other'] .= "\t" . '* Set Locale' . "\r\n";
        $newClass['code']['other'] .= "\t" . '**/' . "\r\n";
        $newClass['code']['other'] .= "\t" . 'set locale(value: string) {' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'this.current_language = value;' . "\r\n";
        $newClass['code']['other'] .= "\t" . '}' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '/**' . "\r\n";
        $newClass['code']['other'] .= "\t" . '* Get Locale' . "\r\n";
        $newClass['code']['other'] .= "\t" . '**/' . "\r\n";
        $newClass['code']['other'] .= "\t" . 'get locale(): string {' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'return this.current_language || "' . $_SESSION['CURRENT_APP']['apps']['app-locale'] . '";' . "\r\n";
        $newClass['code']['other'] .= "\t" . '}' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '/**' . "\r\n";
        $newClass['code']['other'] .= "\t" . '* TranslateService:setDefaultLanguage()' . "\r\n";
        $newClass['code']['other'] .= "\t" . '**/' . "\r\n";
        $newClass['code']['other'] .= "\t" . 'setDefaultLanguage(){' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'let language = this.current_language;' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'this.storage.get(`locale`).then(new_language=>{' . "\r\n";
        $newClass['code']['other'] .= "\t\t\t" . 'if(new_language != null){' . "\r\n";
        $newClass['code']['other'] .= "\t\t\t\t" . 'language = new_language;' . "\r\n";
        $newClass['code']['other'] .= "\t\t\t\t" . 'this.current_language = new_language;' . "\r\n";
        $newClass['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newClass['code']['other'] .= "\t\t\t" . 'console.log(`TranslateConfiguration`,`setDefaultLanguage`,language);' . "\r\n";
        $newClass['code']['other'] .= "\t\t\t" . 'this.translateService.setDefaultLang(language);' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newClass['code']['other'] .= "\t" . '}' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";
        $newClass['code']['other'] .= "\t" . '/**' . "\r\n";
        $newClass['code']['other'] .= "\t" . '* TranslateService:setLanguage(setLang:string)' . "\r\n";
        $newClass['code']['other'] .= "\t" . '**/' . "\r\n";
        $newClass['code']['other'] .= "\t" . 'setLanguage(setLang:string){' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'console.log(`TranslateConfiguration`,`setLanguage`,setLang);' . "\r\n";
        $newClass['code']['other'] .= "\t\t" . 'this.translateService.use(setLang);' . "\r\n";
        $newClass['code']['other'] .= "\t" . '}' . "\r\n";
        $newClass['code']['other'] .= "\t" . '' . "\r\n";


        $db->saveClass($newClass);
    } else
    {
        $db->deleteClass('translate-configuration');
    }


    //TODO: -------------------------------------------------------------------------------------------------

    // TODO: DIRECTIVES --+-- IMAGE ZOOM
    $newDirectives = null;
    $newDirectives['name'] = 'Image Zoom';
    $newDirectives['var'] = 'image_zoom';
    $newDirectives['prefix'] = 'image-zoom';
    $newDirectives['directive'] = 'imageZoom';
    $newDirectives['desc'] = 'Zoom in or out on the image';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button imageZoom ' . "\r\n\t" . 'image="your/image.png" &gt;' . "\r\n\t" . 'Zoom' . "\r\n" . '&lt;/ion-button&gt;</pre>';

    $newDirectives['input'][] = array('var' => 'image', 'type' => 'string');


    $newDirectives['code']['click'] = "" . 'this.viewZoom();';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* viewZoom()' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private viewZoom(){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let image = this.image || "";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.modalController.create({' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'component : ImageZoomComponent,' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'componentProps : {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'img: image' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}).then(modal=> modal.present());' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "" . '' . "\r\n";

    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'ModalController';
    $newDirectives['modules']['angular'][$v]['var'] = 'modalController';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Component';
    $newDirectives['modules']['angular'][$v]['var'] = '';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@angular/core';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'ImageZoomComponent';
    $newDirectives['modules']['angular'][$v]['var'] = '';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '../../components/image-zoom/image-zoom.component';
    $newDirectives['modules']['angular'][$v]['enable'] = true;


    $newDirectives['status'] = 'protected';
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- CONTACT-US
    $newDirectives = null;
    $newDirectives['name'] = 'Contact Us';
    $newDirectives['var'] = 'contact_us';
    $newDirectives['prefix'] = 'contact-us';
    $newDirectives['directive'] = 'contactUs';
    $newDirectives['desc'] = 'Contact as via Call, SMS, Email, and WhatsApp';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button contactUs ' . "\r\n\t" . 'phone="08123456789" ' . "\r\n\t" . 'sms="08123456789" ' . "\r\n\t" . 'whatsapp="08123456789" &gt;' . "\r\n\t" . 'Contact Us' . "\r\n" . '&lt;/ion-button&gt;</pre>';

    $newDirectives['input'][] = array('var' => 'phone', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'sms', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'whatsapp', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'email', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'message', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'title', 'type' => 'string');

    $newDirectives['code']['click'] = "" . 'this.runContactUs();';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runContactUs()' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runContactUs(){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let message = this.message || "";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let phone = this.phone || "" ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let sms = this.sms || "" ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let whatsapp = this.whatsapp || "" ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let email = this.email || "" ;' . "\r\n";

    $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let buttons = [];' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(phone != ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'let call_btn = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'text: "Phone Call",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'icon: "call",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log("Call number",phone);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'let urlSchema = "tel:" + phone ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'buttons = buttons.concat(call_btn);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(sms != ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'let sms_btn = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'text: "SMS",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'icon: "paper-plane",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log("SMS number",sms);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'let urlSchema;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'urlSchema = "sms:" + sms + ";?&body=" + message;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'urlSchema = "sms:" + sms + "?body=" + message;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'buttons = buttons.concat(sms_btn);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(whatsapp != ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'let whatsapp_btn = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'text: "WhatsApp",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'icon: "logo-whatsapp",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log("WhatsApp number",whatsapp);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'let urlSchema = "https://api.whatsapp.com/send?phone=" + encodeURIComponent(whatsapp) + "&text=" + encodeURIComponent(message) ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'buttons = buttons.concat(whatsapp_btn);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(email != ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'let email_btn = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'text: "Email",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'icon: "mail",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'handler: () => {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log("email address",email);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'let urlSchema = "mailto:" + email + "?subject=" + message;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'buttons = buttons.concat(email_btn);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";

    $newDirectives['code']['other'] .= "\t\t" . 'let cancel_btn = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'text: "Cancel",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'icon: "close",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'role: "cancel",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'handler: () => {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log("Cancel clicked");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '};' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'buttons = buttons.concat(cancel_btn);' . "\r\n";

    $newDirectives['code']['other'] .= "\t\t" . 'this.presentActionSheet(buttons);' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "" . '' . "\r\n";

    $newDirectives['code']['other'] .= "" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* presentActionSheet(buttons)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'async presentActionSheet(buttons){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let title = this.title || "Contact Us" ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'const actionSheet = await this.actionSheetController.create({' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'header: title,' . "\r\n";
    //$newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: "more information",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: buttons' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'await actionSheet.present();' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "" . '' . "\r\n";

    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'ActionSheetController';
    $newDirectives['modules']['angular'][$v]['var'] = 'actionSheetController';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $newDirectives['status'] = 'protected';
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- MAIL-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Mail App';
    $newDirectives['var'] = 'mail_app';
    $newDirectives['prefix'] = 'mail-app';
    $newDirectives['directive'] = 'mailApp';
    $newDirectives['desc'] = 'Open with Email App';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button mailApp ' . "\r\n\t" . 'emailAddress="jasman@ihsana.com" ' . "\r\n\t" . 'emailSubject="subject" ' . "\r\n\t" . 'emailMessage="your message" &gt;' . "\r\n\t" . 'Contact Us' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['input'][] = array('var' => 'emailAddress', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'emailSubject', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'emailMessage', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runMailApp(this.emailAddress,this.emailSubject,this.emailMessage);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runMailApp($email,$subject,$message)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $email = "jasman@ihsana.com"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $subject = "subject"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $message = "your message"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runMailApp(email: string, subject : string, message : string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let emailAddr = email || "info@ihsana.com";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let textSubject = subject || "email subject";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let textMessage = encodeURI(message) || "write your message";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(textSubject == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'textSubject = "email subject";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(textMessage == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'textMessage = "your message";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "mailto:" + emailAddr + "?subject=" + textSubject + "&body=" + textMessage;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "" . '' . "\r\n";
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $newDirectives['status'] = 'protected';
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- APP-BROWSER
    $newDirectives = null;
    $newDirectives['name'] = 'App Browser';
    $newDirectives['var'] = 'app_browser';
    $newDirectives['prefix'] = 'app-browser';
    $newDirectives['directive'] = 'appBrowser';
    $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runAppBrowser(this.url);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* Options for the Cordova InAppBrowser Plugin' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @reference: https://cordova.apache.org/docs/en/latest/reference/cordova-plugin-inappbrowser/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'appBrowserOption : InAppBrowserOptions = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'location : "yes",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'hidden : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'zoom : "no", //android & windows' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'hardwareback : "yes", //android & windows' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'mediaPlaybackRequiresUserAction : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'shouldPauseOnSuspend : "no", //android' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'closebuttoncolor : "#03372D",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'toolbarcolor : "#066177",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'disallowoverscroll : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'toolbar : "yes", //ios only' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'enableViewportScale : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'allowInlineMediaPlayback : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'presentationstyle : "pagesheet",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'fullscreen : "yes", //windows' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runAppBrowser($url)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $url = "http://ihsana.com"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runAppBrowser(url: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlAddr = url || "http://ihsana.com";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'this.inAppBrowser.create(urlAddr,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'this.inAppBrowser.create(urlAddr,"_blank",this.appBrowserOption);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with App Browser (Built-In Browser)';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button appBrowser ' . "\r\n\t" . 'url="http://ihsana.com" &gt;' . "\r\n\t" . 'My Website' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';

    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- CALL-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Call App';
    $newDirectives['var'] = 'call_app';
    $newDirectives['prefix'] = 'call-app';
    $newDirectives['directive'] = 'callApp';
    $newDirectives['desc'] = 'Open with dial App';
    $newDirectives['input'][] = array('var' => 'phoneNumber', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runDialApp(this.phoneNumber);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runDialApp($phone_number)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $phone_number = "082233333734"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'public runDialApp(phone_number: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let phoneNumber = phone_number || "08123456789";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "tel:" + phoneNumber ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button callApp ' . "\r\n\t" . 'phoneNumber="012345678" &gt;' . "\r\n\t" . 'Call Me' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);
    // TODO: DIRECTIVES --+-- SMS-APP
    $newDirectives = null;
    $newDirectives['name'] = 'SMS App';
    $newDirectives['var'] = 'sms_app';
    $newDirectives['prefix'] = 'sms-app';
    $newDirectives['directive'] = 'smsApp';
    $newDirectives['desc'] = 'Open with SMS App';
    $newDirectives['input'][] = array('var' => 'phoneNumber', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'shortMessage', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runSmsApp(this.phoneNumber,this.shortMessage);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runSmsApp($phone_number)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $phone_number = "082233333734"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'public runSmsApp(phone_number: string, message : string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let phoneNumber = phone_number || "08123456789";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let textMessage = encodeURI(message) || "";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'urlSchema = "sms:" + phoneNumber + ";?&body=" + textMessage;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'urlSchema = "sms:" + phoneNumber + "?body=" + textMessage;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button smsApp ' . "\r\n\t" . 'phoneNumber="012345678" ' . "\r\n\t" . 'shortMessage="your message" &gt;' . "\r\n\t" . 'SMS Me' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- APP-WEBVIEW
    $newDirectives = null;
    $newDirectives['name'] = 'App Webview';
    $newDirectives['var'] = 'app_webview';
    $newDirectives['prefix'] = 'app-webview';
    $newDirectives['directive'] = 'appWebview';
    $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runWebview(this.url);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* Options for the Cordova InAppBrowser Plugin' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @reference: https://cordova.apache.org/docs/en/latest/reference/cordova-plugin-inappbrowser/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'appWebviewOption : InAppBrowserOptions = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'location : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'hidden : "no",' . "\r\n";
    //$newDirectives['code']['other'] .= "\t\t" . 'clearcache : "no",' . "\r\n";
    //$newDirectives['code']['other'] .= "\t\t" . 'clearsessioncache : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'zoom : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'hardwareback : "yes",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'mediaPlaybackRequiresUserAction : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'shouldPauseOnSuspend : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '//closebuttoncaption : "Close",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'disallowoverscroll : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'toolbar : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'enableViewportScale : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'allowInlineMediaPlayback : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'presentationstyle : "pagesheet",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'fullscreen : "yes",' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runWebview($url)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $url = "http://ihsana.com"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runWebview(url: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlAddr = url || "http://ihsana.com";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'this.inAppBrowser.create(urlAddr,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'this.inAppBrowser.create(urlAddr,"_blank",this.appWebviewOption);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with Webview';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button appWebview ' . "\r\n\t" . 'url="http://ihsana.com" &gt;' . "\r\n\t" . 'My Website' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);

    // TODO: DIRECTIVES --+-- SYSTEM-BROWSER
    $newDirectives = null;
    $newDirectives['name'] = 'System Browser';
    $newDirectives['var'] = 'system_browser';
    $newDirectives['directive'] = 'systemBrowser';
    $newDirectives['prefix'] = 'system-browser';
    $newDirectives['desc'] = 'Open with system browser (External)';
    $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runSystemBrowser(this.url);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runSystemBrowser($url)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $url = "http://ihsana.com"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runSystemBrowser(url: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlAddr = url || "http://ihsana.com";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlAddr,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button systemBrowser ' . "\r\n\t" . 'url="http://ihsana.com" &gt;' . "\r\n\t" . 'My Website' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- CORDOVA-BROWSER
    $newDirectives = null;
    $newDirectives['name'] = 'Cordova Webview';
    $newDirectives['var'] = 'system_browser';
    $newDirectives['directive'] = 'cordovaWebview';
    $newDirectives['prefix'] = 'cordova_browser';
    $newDirectives['desc'] = 'Open with Cordova Webview';
    $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runCordovaWebview(this.url);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runCordovaWebview($url)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $url = "http://ihsana.com"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runCordovaWebview(url: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlAddr = url || "http://ihsana.com";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlAddr,"_self");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button cordovaWebview ' . "\r\n\t" . 'url="http://ihsana.com" &gt;' . "\r\n\t" . 'My Website' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- GEO-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Geo App';
    $newDirectives['var'] = 'geo_app';
    $newDirectives['prefix'] = 'geo-app';
    $newDirectives['directive'] = 'geoApp';
    $newDirectives['desc'] = 'Open with GEO App';
    $newDirectives['input'][] = array('var' => 'location', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'query', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runGeoApp(this.location,this.query);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runGeoApp($loc,$query)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $loc = "-0.0486027,99.888909"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runGeoApp(loc: string, query: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let MyLoc = loc || "-0.0486027,99.888909";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let MyQuery = query || "";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'urlSchema = "maps://?q=" + MyLoc;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'urlSchema = "geo:" + MyLoc + "?q=" + MyQuery;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button geoApp ' . "\r\n\t" . 'query="Jakarta, Indonesia"' . "\r\n\t" . 'location="-0.0486027,99.888909" &gt;' . "\r\n\t" . 'My Location' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- GOOGLE-PLAY-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Google Play App';
    $newDirectives['var'] = 'google_play_app';
    $newDirectives['directive'] = 'googlePlayApp';
    $newDirectives['prefix'] = 'google-play-app';
    $newDirectives['input'][] = array('var' => 'appId', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runGooglePlayApp(this.appId);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runGooglePlayApp($appId)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $appId = "com.imabuilder.myapp"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runGooglePlayApp(app_id: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let myAppID = app_id || "com.imabuilder.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['author-organization'])) . '.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['app-name'])) . '";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(myAppID == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'myAppID = "com.imabuilder.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['author-organization'])) . '.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['app-name'])) . '";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "market://details?id=" + myAppID;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with Google Play Store App';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button googlePlayApp ' . "\r\n\t" . 'appId="com.imabuilder.myapp" &gt;' . "\r\n\t" . 'Rate My App' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);

    // TODO: DIRECTIVES --+-- APPSTORE
    $newDirectives = null;
    $newDirectives['name'] = 'App Store';
    $newDirectives['var'] = 'app_store';
    $newDirectives['directive'] = 'appStore';
    $newDirectives['prefix'] = 'app-store';
    $newDirectives['input'][] = array('var' => 'appURL', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runAppStore(this.appURL);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runAppStore(appURL)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string appURL = "https://apps.apple.com/us/app/xxxx/id123456"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runAppStore(appURL: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(appURL,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with AppStore';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button appStore ' . "\r\n\t" . 'appId="https://apps.apple.com/us/app/xxxx/id123456" &gt;' . "\r\n\t" . 'Rate My App' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- WHATSAPP-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Whatsapp App';
    $newDirectives['var'] = 'whatsapp_app';
    $newDirectives['directive'] = 'whatsappApp';
    $newDirectives['prefix'] = 'whatsapp-app';

    $newDirectives['input'][] = array('var' => 'message', 'type' => 'string');
    $newDirectives['input'][] = array('var' => 'phoneNumber', 'type' => 'string');

    $newDirectives['code']['click'] = "" . 'this.runWhatsapp(this.phoneNumber,this.message);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runWhatsapp($phoneNumber,$message)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $phoneNumber = "08123435435"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $message = "hi there"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runWhatsapp(phoneNumber: string,message: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let myNumber = phoneNumber || "";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let myMessage = message || "Hi";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(myMessage == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'myMessage = "Hi";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "https://api.whatsapp.com/send?phone=" + encodeURIComponent(myNumber) + "&text=" + encodeURIComponent(myMessage) ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with Whatsapp App';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button whatsappApp phoneNumber="62812334343" ' . "\r\n\t" . 'message="Hi, there!" &gt;' . "\r\n\t" . 'Contact Us' . "\r\n" . '&lt;/ion-button&gt;</pre>';

    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- LINE-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Line App';
    $newDirectives['var'] = 'line_app';
    $newDirectives['directive'] = 'lineApp';
    $newDirectives['prefix'] = 'line-app';
    $newDirectives['input'][] = array('var' => 'message', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runLine(this.message);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runLine($message)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $message = "hi there"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runLine(message: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let myMessage = message || "Hi";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(myMessage == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'myMessage = "Hi";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "line://msg/text/" + encodeURIComponent(myMessage) ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['instruction'] = "\t" . '<p>You can use this directive as an example:</p><pre>&lt;ion-button lineApp ' . "\r\n\t" . 'message="Hi, there!" &gt;' . "\r\n\t" . 'Contact Us' . "\r\n" . '&lt;/ion-button&gt;</pre>' . "\r\n";
    $newDirectives['desc'] = 'Open with Line App';


    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- TWITTER-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Twitter App';
    $newDirectives['var'] = 'twitter_app';
    $newDirectives['directive'] = 'twitterApp';
    $newDirectives['prefix'] = 'twitter-app';
    $newDirectives['input'][] = array('var' => 'message', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runTwitter(this.message);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runTwitter($message)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $message = "hi there"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runTwitter(message: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let myMessage = message || "Hi";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(myMessage == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'myMessage = "Hi";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "twitter://post?message=" + encodeURIComponent(myMessage) ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with Twitter App';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button twitterApp ' . "\r\n\t" . 'message="Hi, there!" &gt;' . "\r\n\t" . 'Tweet!' . "\r\n" . '&lt;/ion-button&gt;</pre>';

    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    // TODO: DIRECTIVES --+-- FACEBOOK-APP
    $newDirectives = null;
    $newDirectives['name'] = 'Facebook App';
    $newDirectives['var'] = 'facebook_app';
    $newDirectives['directive'] = 'facebookApp';
    $newDirectives['prefix'] = 'facebook-app';
    $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runFacebook(this.url);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runFacebook($url)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $url = "http://ihsana.com/"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runFacebook(url: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let myUrl = url || "https://play.google.com/store/apps/details?id=com.imabuilder.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['author-organization'])) . '.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['app-name'])) . '";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if(myUrl == ""){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'myUrl = "https://play.google.com/store/apps/details?id=com.imabuilder.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['author-organization'])) . '.' . str_replace('_', '', $string->toVar($_SESSION['CURRENT_APP']['apps']['app-name'])) . '";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlSchema = "https://facebook.com/sharer/sharer.php?u=" + encodeURIComponent(myUrl);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("android")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'urlSchema = "fb://faceweb/f?href=https://facebook.com/sharer/sharer.php?u=" + encodeURIComponent(myUrl) ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'urlSchema = "fbapi20130214://dialog/share?app_id=966242223397117&version=20130410&method_args=%7B%22name%22%3Anull%2C%22description%22%3Anull%2C%22link%22%3A%22" + encodeURIComponent(myUrl) + "%22%7D" ;' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'this.inAppBrowser.create(urlSchema,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button facebookApp ' . "\r\n\t" . 'url="http://yourdomain" &gt;' . "\r\n\t" . 'Share URL!' . "\r\n" . '&lt;/ion-button&gt;</pre>' . "\r\n";
    $newDirectives['desc'] = 'Open with Facebook App';


    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;

    $db->saveDirective($newDirectives);


    //TODO: -------------------------------------------------------------------------------------------------
    // TODO: PIPES --+-- READMORE
    $newPipes = null;
    $newPipes['name'] = 'Read More';
    $newPipes['pipe'] = 'readMore';
    $newPipes['var'] = 'read_more';
    $newPipes['prefix'] = 'read-more';
    $newPipes['desc'] = 'Split text and give a trail';
    $newPipes['instruction'] = '<pre>{{ str | readMore:100 }}</pre>';
    $newPipes['return']['type'] = 'string';
    $newPipes['arg'][0]['type'] = 'string';
    $newPipes['arg'][0]['var'] = 'text';
    $newPipes['arg'][1]['type'] = 'number';
    $newPipes['arg'][1]['var'] = 'args';
    $newPipes['code']['transform'] = null;
    $newPipes['code']['transform'] .= "\t\t\t" . 'let trail = \'...\';' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'let limit = args > 0 ? args : 100;' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'return text.length > limit ? text.substring(0, limit) + trail : text;' . "\r\n";
    $newPipes['status'] = 'protected';
    $db->savePipe($newPipes);
    // TODO: PIPES --+-- STRIPTAGS
    $newPipes = null;
    $newPipes['name'] = 'Strip Tags';
    $newPipes['pipe'] = 'stripTags';
    $newPipes['var'] = 'strip_tags';
    $newPipes['prefix'] = 'strip-tags';
    $newPipes['desc'] = 'Used to strip HTML tags from a string';
    $newPipes['instruction'] = '<pre>{{ str | stripTags }}</pre>';
    $newPipes['return']['type'] = 'string';
    $newPipes['arg'][0]['type'] = 'string';
    $newPipes['arg'][0]['var'] = 'text';
    $newPipes['arg'][1]['type'] = 'any[]';
    $newPipes['arg'][1]['var'] = '...allowedTags';
    $newPipes['code']['transform'] = "\t\t\t" . 'return allowedTags.length > 0' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . '? text.replace(new RegExp(`<(?!\/?(${allowedTags.join(\'|\')})\s*\/?)[^>]+>`, \'g\'), \'\')' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . ': text.replace(/<(?:.|\s)*?>/g, \'\');' . "\r\n";
    $newPipes['status'] = 'protected';
    $db->savePipe($newPipes);
    // TODO: PIPES --+-- PHPTIME
    $newPipes = null;
    $newPipes['name'] = 'PHP Time';
    $newPipes['pipe'] = 'phpTime';
    $newPipes['var'] = 'php_time';
    $newPipes['prefix'] = 'php-time';
    $newPipes['desc'] = 'Used to change the php format timestamp to JavaScript format';
    $newPipes['instruction'] = '<pre>{{ num | phpTime | date }}</pre>';
    $newPipes['return']['type'] = 'number';
    $newPipes['arg'][0]['type'] = 'string';
    $newPipes['arg'][0]['var'] = 'num';
    $newPipes['code']['transform'] = "\t\t\t" . 'return parseInt(num) * 1000 ;';
    $newPipes['status'] = 'protected';
    $db->savePipe($newPipes);


    // TODO: PIPES --+-- OBJECTLENGTH
    $newPipes = null;
    $newPipes['name'] = 'Object Length';
    $newPipes['pipe'] = 'objectLength';
    $newPipes['var'] = 'obj_length';
    $newPipes['prefix'] = 'obj-length';
    $newPipes['desc'] = 'Get the object length';
    $newPipes['instruction'] = '<pre>{{ obj | objectLength }}</pre>';
    $newPipes['return']['type'] = 'number';
    $newPipes['arg'][0]['type'] = 'any';
    $newPipes['arg'][0]['var'] = 'obj';
    $newPipes['code']['transform'] = null;
    $newPipes['code']['transform'] .= "\t\t\t" . 'let keys = Object.keys(obj);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'return keys.length;' . "\r\n";
    $newPipes['status'] = 'protected';
    $db->savePipe($newPipes);


    // TODO: PIPES --+-- TRUST-URL
    $newPipes = null;
    $newPipes['name'] = 'Trust Url';
    $newPipes['pipe'] = 'trustUrl';
    $newPipes['var'] = 'trust_url';
    $newPipes['prefix'] = 'trust-url';
    $newPipes['desc'] = 'sanitizing URL';
    $newPipes['instruction'] = '<pre>{{ your_url | trustUrl }}</pre>';
    $newPipes['return']['type'] = 'SafeUrl';
    $newPipes['arg'][0]['type'] = 'any';
    $newPipes['arg'][0]['var'] = 'value';
    $newPipes['code']['transform'] = null;
    $newPipes['code']['transform'] .= "\t\t\t" . 'return this.domSanitizer.bypassSecurityTrustUrl(value);' . "\r\n";
    $newPipes['status'] = 'protected';

    $v = 0;
    $newPipes['modules']['angular'][$v]['class'] = 'DomSanitizer';
    $newPipes['modules']['angular'][$v]['var'] = 'domSanitizer';
    $newPipes['modules']['angular'][$v]['cordova'] = '';
    $newPipes['modules']['angular'][$v]['path'] = '@angular/platform-browser';
    $newPipes['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newPipes['modules']['angular'][$v]['class'] = 'SafeUrl';
    $newPipes['modules']['angular'][$v]['var'] = '';
    $newPipes['modules']['angular'][$v]['cordova'] = '';
    $newPipes['modules']['angular'][$v]['path'] = '@angular/platform-browser';
    $newPipes['modules']['angular'][$v]['enable'] = true;

    $db->savePipe($newPipes);


    // TODO: PIPES --+-- TRUST-URL
    $newPipes = null;
    $newPipes['name'] = 'Trust Resource Url';
    $newPipes['pipe'] = 'trustResourceUrl';
    $newPipes['var'] = 'trust_resource_url';
    $newPipes['prefix'] = 'trust-resource-url';
    $newPipes['desc'] = 'sanitizing Resource URL';
    $newPipes['instruction'] = '<pre>{{ your_url | trustResourceUrl }}</pre>';
    $newPipes['return']['type'] = 'SafeResourceUrl';
    $newPipes['arg'][0]['type'] = 'any';
    $newPipes['arg'][0]['var'] = 'value';
    $newPipes['code']['transform'] = null;
    $newPipes['code']['transform'] .= "\t\t\t" . 'return this.domSanitizer.bypassSecurityTrustResourceUrl(value);' . "\r\n";
    $newPipes['status'] = 'protected';

    $v = 0;
    $newPipes['modules']['angular'][$v]['class'] = 'DomSanitizer';
    $newPipes['modules']['angular'][$v]['var'] = 'domSanitizer';
    $newPipes['modules']['angular'][$v]['cordova'] = '';
    $newPipes['modules']['angular'][$v]['path'] = '@angular/platform-browser';
    $newPipes['modules']['angular'][$v]['enable'] = true;

    $v++;
    $newPipes['modules']['angular'][$v]['class'] = 'SafeResourceUrl';
    $newPipes['modules']['angular'][$v]['var'] = '';
    $newPipes['modules']['angular'][$v]['cordova'] = '';
    $newPipes['modules']['angular'][$v]['path'] = '@angular/platform-browser';
    $newPipes['modules']['angular'][$v]['enable'] = true;
    $db->savePipe($newPipes);


    // TODO: PIPES --+-- TRUST-HTML
    $newPipes = null;
    $newPipes['name'] = 'Trust HTML';
    $newPipes['pipe'] = 'trustHtml';
    $newPipes['var'] = 'trust_html';
    $newPipes['prefix'] = 'trust-html';
    $newPipes['desc'] = 'Display HTML without sanitizing/filtering';
    $newPipes['instruction'] = '<pre>&lt;div [innerHTML]="post.body | trustHtml" &gt;&lt;/div&gt;</pre>';
    $newPipes['return']['type'] = 'SafeHtml';
    $newPipes['arg'][0]['type'] = 'any';
    $newPipes['arg'][0]['var'] = 'value';
    $newPipes['code']['transform'] = null;
    $newPipes['code']['transform'] .= "\t\t\t" . 'return this.domSanitizer.bypassSecurityTrustHtml(value);' . "\r\n";
    $newPipes['status'] = 'protected';

    $v = 0;
    $newPipes['modules']['angular'][$v]['class'] = 'DomSanitizer';
    $newPipes['modules']['angular'][$v]['var'] = 'domSanitizer';
    $newPipes['modules']['angular'][$v]['cordova'] = '';
    $newPipes['modules']['angular'][$v]['path'] = '@angular/platform-browser';
    $newPipes['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newPipes['modules']['angular'][$v]['class'] = 'SafeHtml';
    $newPipes['modules']['angular'][$v]['var'] = '';
    $newPipes['modules']['angular'][$v]['cordova'] = '';
    $newPipes['modules']['angular'][$v]['path'] = '@angular/platform-browser';
    $newPipes['modules']['angular'][$v]['enable'] = true;

    $db->savePipe($newPipes);


    // TODO: PIPES --+-- TIME-AGO
    $newPipes = null;
    $newPipes['name'] = 'Time Ago';
    $newPipes['pipe'] = 'timeAgo';
    $newPipes['var'] = 'time_ago';
    $newPipes['prefix'] = 'time-ago';
    $newPipes['desc'] = 'Convert Date into time ago format';
    $newPipes['instruction'] = '<pre>{{ date | timeAgo }}</pre>';

    $newPipes['return']['type'] = 'any';

    $newPipes['arg'][0]['type'] = 'any';
    $newPipes['arg'][0]['var'] = 'value';

    $newPipes['arg'][1]['type'] = 'any';
    $newPipes['arg'][1]['var'] = 'args?';

    $newPipes['code']['transform'] = null;

    if ($is_localization == true)
    {
        $newPipes['code']['transform'] .= "\t\t\t" . 'let years_ago:string = this.translateService.instant(`years ago`) ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let months_ago:string = this.translateService.instant(`months ago`) ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let days_ago:string = this.translateService.instant(`days ago`) ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let hours_ago:string = this.translateService.instant(`hours ago`) ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let minutes_ago:string = this.translateService.instant(`minutes ago`) ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let seconds_ago:string = this.translateService.instant(`seconds ago`) ;' . "\r\n";

    } else
    {
        $newPipes['code']['transform'] .= "\t\t\t" . 'let years_ago:string = `years ago` ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let months_ago:string = `months ago` ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let days_ago:string = `days ago` ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let hours_ago:string = `hours ago` ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let minutes_ago:string = `minutes ago` ;' . "\r\n";
        $newPipes['code']['transform'] .= "\t\t\t" . 'let seconds_ago:string = `seconds ago` ;' . "\r\n";
    }

    $newPipes['code']['transform'] .= "\t\t\t" . 'let date: any = new Date(value);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'var seconds = Math.floor((Date.now() - date) / 1000);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'var interval = Math.floor(seconds / 31536000);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'if (interval > 1){' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . 'return `${interval} ${years_ago}`;' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '}' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'interval = Math.floor(seconds / 2592000);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'if (interval > 1){' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . 'return `${interval} ${months_ago}`;' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '}' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'interval = Math.floor(seconds / 86400);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'if (interval > 1) {' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . 'return `${interval} ${days_ago}`;' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '}' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'interval = Math.floor(seconds / 3600);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'if (interval > 1) {' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . 'return `${interval} ${hours_ago}`;' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '}' . "\r\n";

    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'interval = Math.floor(seconds / 60);' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'if (interval > 1) { ' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t\t" . 'return `${interval} ${minutes_ago}`; ' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '}' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . 'return Math.floor(seconds) + ` ${seconds_ago}`;' . "\r\n";
    $newPipes['code']['transform'] .= "\t\t\t" . '' . "\r\n";
    $newPipes['status'] = 'protected';

    $db->savePipe($newPipes);


    if (count($_SESSION['CURRENT_APP']['localization']) == 0)
    {
        $newPipes = null;
        $newPipes['name'] = 'Translate';
        $newPipes['pipe'] = 'translate';
        $newPipes['var'] = 'translate';
        $newPipes['prefix'] = 'translate';
        $newPipes['desc'] = 'Just error prevention';
        $newPipes['instruction'] = '<pre>{{ "no language" | translate }}</pre>';

        $newPipes['return']['type'] = 'string';
        $newPipes['arg'][0]['type'] = 'string';
        $newPipes['arg'][0]['var'] = 'value';
        $newPipes['code']['transform'] = null;
        $newPipes['code']['transform'] .= "\t\t\t" . 'return value;' . "\r\n";
        $newPipes['status'] = 'protected';
        $db->savePipe($newPipes);
    } else
    {
        $db->deletePipe('translate');
    }


    $newEnvironment = null;
    $newEnvironment['name'] = 'production';
    $newEnvironment['desc'] = 'For easier debugging';
    $newEnvironment['status'] = 'protected';

    $newEnvironment['code']['production'] = "\t" . 'production: true';
    $newEnvironment['code']['development'] = "\t" . 'production: false';

    $db->saveEnvironment($newEnvironment);


    $db->current();
}


$index_output = null;
$index_output .= "" . '<?php' . "\r\n";
$index_output .= "" . '' . "\r\n";
$index_output .= "" . 'echo \'<html>\';' . "\r\n";
$index_output .= "" . 'echo \'<head>\';' . "\r\n";
$index_output .= "" . 'echo \'<title>Outputs</title>\';' . "\r\n";
$index_output .= "" . 'echo \'</head>\';' . "\r\n";
$index_output .= "" . 'echo \'<body>\';' . "\r\n";

$index_output .= "" . 'echo \'<h4 style="padding: 12px;font-size: 36px;">Cordova</h4>\';' . "\r\n";
$index_output .= "" . 'echo \'<ol>\';' . "\r\n";
$index_output .= "" . 'foreach (glob("*/platforms/android/app/build/outputs/apk/debug/app-debug.apk") as $filename) {' . "\r\n";
$index_output .= "\t" . '$name = explode("/",$filename);' . "\r\n";
$index_output .= "\t" . 'echo \'<li style="padding: 12px;font-size: 24px;"><a href="\'.$filename.\'">\'. $name[0].\'</a></li>\';' . "\r\n";
$index_output .= "" . '}' . "\r\n";
$index_output .= "" . 'echo \'</ol>\';' . "\r\n";

$index_output .= "" . 'echo \'<h4 style="padding: 12px;font-size: 36px;">Capasitor</h4>\';' . "\r\n";
$index_output .= "" . 'echo \'<ol>\';' . "\r\n";
$index_output .= "" . 'foreach (glob("*/android/app/build/outputs/apk/debug/app-debug.apk") as $filename) {' . "\r\n";
$index_output .= "\t" . '$name = explode("/",$filename);' . "\r\n";
$index_output .= "\t" . 'echo \'<li style="padding: 12px;font-size: 24px;"><a href="\'.$filename.\'">\'. $name[0].\'</a></li>\';' . "\r\n";
$index_output .= "" . '}' . "\r\n";
$index_output .= "" . 'echo \'</ol>\';' . "\r\n";


$index_output .= "" . 'echo \'</body>\';' . "\r\n";
$index_output .= "" . 'echo \'</html>\';' . "\r\n";


file_put_contents(JSM_PATH . '/outputs/index.php', $index_output);

?>