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

class jsmDefault
{
    var $appInfo;
    /**
     * jsmDefault::__construct()
     * 
     * @return void
     */
    function __construct()
    {
        if (isset($_SESSION['CURRENT_APP']))
        {
            $this->appInfo = $_SESSION['CURRENT_APP']['apps'];
        }

    }

    /**
     * jsmDefault::menus()
     * 
     * @return void
     */
    public function menus()
    {

        $newMenu['side'] = 'start';
        $newMenu['type'] = 'overlay';
        $newMenu['ion-header'] = 'expanded-header';
        $newMenu['color-header'] = 'dark';
        $newMenu['text-header'] = $this->appInfo['app-name'];
        $newMenu['text-subheader'] = $this->appInfo['app-description'];
        $newMenu['expanded-background'] = 'assets/images/background/expanded-menu.png';

        $z = 0;

        $newMenu['items'][$z]["type"] = "title";
        $newMenu['items'][$z]["label"] = "Dashboard";
        $newMenu['items'][$z]["var"] = "dashboard";
        $newMenu['items'][$z]["page"] = "home";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "home";
        $newMenu['items'][$z]["color-icon-left"] = "default";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";

        $z++;
        $newMenu['items'][$z]["type"] = "inlink";
        $newMenu['items'][$z]["label"] = "Menu 1";
        $newMenu['items'][$z]["var"] = "menu_1";
        $newMenu['items'][$z]["page"] = "";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "color-filter-sharp";
        $newMenu['items'][$z]["color-icon-left"] = "secondary";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";

        $z++;
        $newMenu['items'][$z]["type"] = "title";
        $newMenu['items'][$z]["label"] = "Help";
        $newMenu['items'][$z]["var"] = "help";
        $newMenu['items'][$z]["page"] = "";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "help-circle";
        $newMenu['items'][$z]["color-icon-left"] = "default";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";


        $z++;
        $newMenu['items'][$z]["type"] = "playstore";
        $newMenu['items'][$z]["label"] = "Rate This App";
        $newMenu['items'][$z]["var"] = "rate_this_app";
        $newMenu['items'][$z]["page"] = "";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "logo-google-playstore";
        $newMenu['items'][$z]["color-icon-left"] = "primary";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";


        $z++;
        $newMenu['items'][$z]["type"] = "inlink";
        $newMenu['items'][$z]["label"] = "Privacy Policy";
        $newMenu['items'][$z]["var"] = "privacy-policy";
        $newMenu['items'][$z]["page"] = "privacy-policy";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "lock-closed-outline";
        $newMenu['items'][$z]["color-icon-left"] = "secondary";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";

        $z++;
        $newMenu['items'][$z]["type"] = "inlink";
        $newMenu['items'][$z]["label"] = "FAQs";
        $newMenu['items'][$z]["var"] = "faqs";
        $newMenu['items'][$z]["page"] = "faqs";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "help-circle";
        $newMenu['items'][$z]["color-icon-left"] = "secondary";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";

        $z++;
        $newMenu['items'][$z]["type"] = "inlink";
        $newMenu['items'][$z]["label"] = "About US";
        $newMenu['items'][$z]["var"] = "about-us";
        $newMenu['items'][$z]["page"] = "about-us";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = "default";
        $newMenu['items'][$z]["icon-left"] = "people-circle";
        $newMenu['items'][$z]["color-icon-left"] = "danger";
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";


        return $newMenu;

    }

    /**
     * jsmDefault::pages()
     * 
     * @return void
     */
    function pages($type = "home")
    {
        $newPage = array();
        $newPage['content']['html'] = null;

        switch ($type)
        {
            case 'home':
                $newPage['title'] = 'Home';
                $newPage['name'] = 'home';
                $newPage['var'] = 'home';
                $newPage['back-button'] = '/auto';
                $newPage['catg'] = '';
                $newPage['icon-left'] = 'home';
                $newPage['icon-right'] = '';
                $newPage['header']['color'] = 'primary';
                $newPage['header']['mid']['type'] = 'title';
                $newPage['content']['disable-ion-content'] = false;

                $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
                $newPage['header']['mid']['items'][0]['value'] = 'tab1';
                $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
                $newPage['header']['mid']['items'][1]['value'] = 'tab2';
                $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
                $newPage['header']['mid']['items'][2]['value'] = 'tab3';

                $newPage['content']['enable-fullscreen'] = true;
                $newPage['content']['disable-scroll'] = true;
                $newPage['content']['enable-padding'] = true;

                $newPage['content']['html'] = '';
                $newPage['content']['html'] .= "\t" . '<ion-slides pager="false">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of slideItems; last as isLast">' . "\r\n";

                $newPage['content']['html'] .= "\t\t\t" . '<ion-toolbar>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-buttons slot="end" *ngIf="!isLast">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button color="primary" [routerDirection]="\'root\'" [routerLink]="[\'/about-us\']" >Skip</ion-button>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-buttons>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-buttons *ngIf="isLast">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-buttons>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-toolbar>' . "\r\n";

                $newPage['content']['html'] .= "\t\t\t" . '<img [src]="item.image" class="slide-image"/>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<h2 class="slide-title" [innerHTML]="item.title"></h2>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<p *ngIf="!isLast" [innerHTML]="item.description"></p>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-button *ngIf="isLast" size="large" fill="clear" icon="end" color="primary" [routerDirection]="\'root\'" [routerLink]="[\'/about-us\']">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . 'Continue <ion-icon name="arrow-forward"></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";


                $newPage['content']['scss'] = null;
                //$newPage['content']['scss'] .= "\t" . '.swiper-pagination {display: none;}' . "\r\n";

                $newPage['content']['scss'] .= "\t" . 'ion-slide > ion-toolbar{--background: transparent;}' . "\r\n";
                $newPage['content']['scss'] .= "\t" . '.swiper-slide {display: block;}' . "\r\n";
                $newPage['content']['scss'] .= "\t" . 'ion-slide > h2 {margin-top: 2.8rem;}' . "\r\n";
                $newPage['content']['scss'] .= "\t" . 'ion-slide > img {max-height: 50%;max-width: 60%;margin: 16px 0;}' . "\r\n";


                $z = 0;
                $json[$z]['title'] = 'Welcome to <br/>' . $this->appInfo['app-name'] . '!';
                $json[$z]['description'] = '' . $this->appInfo['app-description'] . '';
                $json[$z]['image'] = 'assets/images/slides/image-1.png';

                $z++;
                $json[$z]['title'] = 'Like Magic!';
                $json[$z]['description'] = 'Suspendisse rhoncus neque quis neque luctus, sit amet dictum ex condimentum';
                $json[$z]['image'] = 'assets/images/slides/image-2.png';

                $z++;
                $json[$z]['title'] = 'Unlimited App!';
                $json[$z]['description'] = 'Aliquam imperdiet pharetra ligula ut ullamcorper. Maecenas pharetra imperdiet nunc';
                $json[$z]['image'] = 'assets/images/slides/image-2.png';

                $newPage['code']['other'] = null;
                $newPage['code']['other'] .= "" . 'slideItems: any;' . "\r\n";
                $newPage['code']['other'] .= "" . 'public ngOnInit(){' . "\r\n";
                $newPage['code']['other'] .= "\t" . '' . "\r\n";
                if (defined('JSON_PRETTY_PRINT'))
                {
                    $newPage['code']['other'] .= "\t" . 'this.slideItems = ' . "\r\n" . '' . json_encode($json, JSON_PRETTY_PRINT) . "\r\n";
                } else
                {
                    $newPage['code']['other'] .= "\t" . 'this.slideItems = ' . json_encode($json) . "\r\n";
                }
                $newPage['code']['other'] .= "\t" . '' . "\r\n";
                $newPage['code']['other'] .= "\t" . '}' . "\r\n";
                $newPage['code']['other'] .= "\t" . '' . "\r\n";

                $newPage['code']['export'] = '//export';
                $newPage['code']['constructor'] = '//constructor';

                break;

            case 'privacy-policy':
                $newPage['title'] = 'Privacy Policy';
                $newPage['name'] = 'privacy-policy';
                $newPage['var'] = 'privacy_policy';
                $newPage['back-button'] = '/auto';
                $newPage['catg'] = '';
                $newPage['icon-left'] = 'lock-closed';
                $newPage['icon-right'] = '';
                $newPage['header']['color'] = 'secondary';
                $newPage['header']['mid']['type'] = 'title';
                //$newPage['content']['disable-ion-content'] = false;
                //$newPage['content']['enable-fullscreen'] = true;

                $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
                $newPage['header']['mid']['items'][0]['value'] = 'tab1';
                $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
                $newPage['header']['mid']['items'][1]['value'] = 'tab2';
                $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
                $newPage['header']['mid']['items'][2]['value'] = 'tab3';


                //$newPage['content']['html'] .= '<ion-header collapse="condense">' . "\r\n";
                //$newPage['content']['html'] .= "\t" . '<ion-toolbar color="success">' . "\r\n";
                //$newPage['content']['html'] .= "\t\t" . '<ion-title size="large">Privacy Policy</ion-title>' . "\r\n";
                //$newPage['content']['html'] .= "\t" . '</ion-toolbar>' . "\r\n";
                //$newPage['content']['html'] .= '</ion-header>' . "\r\n";

                $newPage['content']['html'] .= '<ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ul>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<li>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</li>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<li>We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.</li>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<li>We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned.</li>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<li>Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date. </li>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<li>We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.</li>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<li>We will make readily available to customers information about our policies and practices relating to the management of personal information.</li>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ul>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<p>We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained</p>' . "\r\n";

                $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= '</ion-card>' . "\r\n";

                $newPage['content']['scss'] = null;
                $newPage['code']['other'] = '';
                break;

            case 'menu-1':
                $newPage['title'] = 'Menu 1';
                $newPage['name'] = 'menu-1';
                $newPage['var'] = 'menu_1';
                $newPage['back-button'] = '/auto';
                $newPage['catg'] = '';
                $newPage['icon-left'] = 'at';
                $newPage['icon-right'] = '';
                $newPage['header']['color'] = 'dark';
                $newPage['header']['mid']['type'] = 'title';
                $newPage['content']['disable-ion-content'] = false;
                $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
                $newPage['header']['mid']['items'][0]['value'] = 'tab1';
                $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
                $newPage['header']['mid']['items'][1]['value'] = 'tab2';
                $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
                $newPage['header']['mid']['items'][2]['value'] = 'tab3';

                $newPage['content']['html'] = null;

                $newPage['content']['html'] .= '<ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<p>This page is under construction. Please come back soon!</p>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= '</ion-card>' . "\r\n";

                $newPage['content']['scss'] = '';
                $newPage['code']['other'] = '';
                break;
            case 'faqs':
                $newPage['title'] = 'FAQs';
                $newPage['name'] = 'faqs';
                $newPage['var'] = 'faqs';
                $newPage['back-button'] = '/auto';
                $newPage['catg'] = '';
                $newPage['icon-left'] = 'help-circle';
                $newPage['icon-right'] = '';
                $newPage['header']['color'] = 'danger';
                $newPage['header']['mid']['type'] = 'title';
                $newPage['content']['disable-ion-content'] = false;
                $newPage['content']['enable-fullscreen'] = true;

                $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
                $newPage['header']['mid']['items'][0]['value'] = 'tab1';
                $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
                $newPage['header']['mid']['items'][1]['value'] = 'tab2';
                $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
                $newPage['header']['mid']['items'][2]['value'] = 'tab3';

                $newPage['content']['html'] .= '<ion-header collapse="condense">' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-toolbar color="primary">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-title size="large">FAQs</ion-title>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-toolbar>' . "\r\n";
                $newPage['content']['html'] .= '</ion-header>' . "\r\n";

                $newPage['content']['html'] .= '<ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<p>This page is under construction. Please come back soon!</p>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= '</ion-card>' . "\r\n";

                $newPage['content']['scss'] = null;


                $newPage['code']['other'] = '';
                break;
            case 'about-us':
                $newPage['title'] = 'About Us';
                $newPage['name'] = 'about-us';
                $newPage['var'] = 'about_us';
                $newPage['catg'] = '';
                $newPage['icon-left'] = 'people';
                $newPage['icon-right'] = '';
                $newPage['back-button'] = '/auto';
                $newPage['header']['color'] = 'tertiary';
                $newPage['header']['mid']['type'] = 'segment';
                $newPage['content']['disable-ion-content'] = false;
                $newPage['header']['mid']['items'][0]['label'] = 'About Us';
                $newPage['header']['mid']['items'][0]['value'] = 'about-us';
                $newPage['header']['mid']['items'][1]['label'] = 'Licenses';
                $newPage['header']['mid']['items'][1]['value'] = 'licenses';
                $newPage['header']['mid']['items'][2]['label'] = '';
                $newPage['header']['mid']['items'][2]['value'] = '';

                $newPage['content']['html'] = null;
                $newPage['content']['html'] .= '<ion-card  *ngIf="segmentTab==\'about-us\'">' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<img src="./assets/images/landscape/image-1.jpg" alt=""/>' . "\r\n";

                $newPage['content']['html'] .= "\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<h1><strong>' . $this->appInfo['app-name'] . '</strong> <small>v' . $this->appInfo['app-version'] . '</small></h1>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card-header>' . "\r\n";

                $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<p>' . $this->appInfo['app-description'] . '</p>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<p>by <strong>' . $this->appInfo['author-name'] . '</strong></p>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= '</ion-card>' . "\r\n";

                $newPage['content']['html'] .= '<ion-card  *ngIf="segmentTab==\'about-us\'">' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-list inset>' . "\r\n";

                $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . 'Contact Us' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '<ion-item appBrowser url="' . $this->appInfo['author-website'] . '" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-icon color="danger" name="help-buoy" item-start></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $this->appInfo['author-organization'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '<ion-item mailApp emailAddress="' . $this->appInfo['author-email'] . '" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-icon color="secondary" name="mail" item-start></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . $this->appInfo['author-email'] . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                $newPage['content']['html'] .= '</ion-card>' . "\r\n";

                $newPage['content']['html'] .= '<ion-card *ngIf="segmentTab==\'licenses\'">' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<h2>Licenses</h2>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ul><li><strong>IonicFramework</strong>,<br/>Copyright 2015-present Drifty Co</li></ul>';
                $newPage['content']['html'] .= "\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= '</ion-card>' . "\r\n";

                $newPage['content']['scss'] = null;
                $newPage['content']['scss'] .= "\r\n";
                $newPage['content']['scss'] .= 'ion-card img{width:100%;}'. "\r\n";
                $newPage['code']['other'] = '';
                break;

        }
        return $newPage;
    }


    /**
     * jsmDefault::addons()
     * 
     * @return void
     */
    function addons($type = 'about-us')
    {
        $addons = array();
        switch ($type)
        {
            case 'about-us':
                $addons['page-target'] = 'about-us';
                $addons['page-title'] = 'About Us';
                $addons['app-name'] = $this->appInfo['app-name'];
                $addons['app-version'] = $this->appInfo['app-version'];
                $addons['author-organization'] = $this->appInfo['author-organization'];
                $addons['author-name'] = $this->appInfo['author-name'];
                $addons['author-email'] = $this->appInfo['author-email'];
                $addons['author-website'] = $this->appInfo['author-website'];
                $addons['app-description'] = $this->appInfo['app-description'];
                $addons['app-licenses'] = '<ul><li><strong>IonicFramework</strong>,<br/>Copyright 2015-present Drifty Co</li></ul>';
                $addons['img-hero'] = 'assets/images/landscape/image-1.jpg';

                break;
            case 'step-wizard-slider':
                $addons['page-target'] = 'home';
                $addons['page-title'] = 'Welcome';
                $addons['max-slides'] = '3';
                $addons['goto'] = 'about-us';

                $addons['slides'][0]['slide-title'] = 'Welcome to<br/>' . $this->appInfo['app-name'];
                $addons['slides'][0]['slide-desc'] = $this->appInfo['app-description'];
                $addons['slides'][0]['slide-image'] = 'assets/images/slides/image-1.png';

                $addons['slides'][1]['slide-title'] = 'Like Magic!';
                $addons['slides'][1]['slide-desc'] = 'Suspendisse rhoncus neque quis neque luctus, sit amet dictum ex condimentum';
                $addons['slides'][1]['slide-image'] = 'assets/images/slides/image-2.png';

                $addons['slides'][2]['slide-title'] = 'Unlimited App!';
                $addons['slides'][2]['slide-desc'] = 'Aliquam imperdiet pharetra ligula ut ullamcorper. Maecenas pharetra imperdiet nunc';
                $addons['slides'][2]['slide-image'] = 'assets/images/slides/image-3.png';


                break;

        }
        return $addons;
    }

    /**
     * jsmDefault::savePopover()
     * 
     * @return void
     */
    function Popover()
    {
        $popover = null;
        $popover['icon'] = 'ellipsis-vertical-outline';
        $popover['title'] = '';
        $popover['color'] = 'dark';
        $popover['background'] = 'light';

        $z = 0;
        $popover['items'][$z]['type'] = 'dark-mode';
        $popover['items'][$z]['label'] = 'Dark Mode';
        $popover['items'][$z]['page'] = '';
        $popover['items'][$z]['value'] = '';

        $z++;
        $popover['items'][$z]['type'] = 'inlink';
        $popover['items'][$z]['label'] = 'Privacy Policy';
        $popover['items'][$z]['page'] = 'privacy-policy';
        $popover['items'][$z]['value'] = 'privacy-policy';

        $z++;
        $popover['items'][$z]['type'] = 'inlink';
        $popover['items'][$z]['label'] = 'About Us';
        $popover['items'][$z]['page'] = 'about-us';
        $popover['items'][$z]['value'] = 'about-us';

        $z++;
        $popover['items'][$z]['type'] = 'exit';
        $popover['items'][$z]['label'] = 'Exit';
        $popover['items'][$z]['page'] = '';
        $popover['items'][$z]['value'] = '';

        return $popover;
    }

    /**
     * jsmDefault::PopoverComponent()
     * 
     * @return
     */
    function PopoverComponent()
    {


        $newComponent = null;
        $newComponent['name'] = 'Popover';
        $newComponent['var'] = 'popover';
        $newComponent['prefix'] = 'popover';
        $newComponent['html'] = null;
        $newComponent['html'] .= '<ion-list>' . "\r\n";
        $newComponent['html'] .= "\t" . '<ion-item ><ion-text>Dark Mode</ion-text><ion-toggle [(ngModel)]="isDarkMode" (ionChange)="darkMode($event)" slot="end"></ion-toggle></ion-item>' . "\r\n";
        $newComponent['html'] .= "\t" . '<ion-item (click)="dismissPopover()" [routerDirection]="\'forward\'" [routerLink]="\'/about-us\'">About Us</ion-item>' . "\r\n";

        $newComponent['html'] .= '</ion-list>' . "\r\n";

        $newComponent['scss'] = null;


        $z = 0;
        $newComponent['modules']['angular'][$z]['enable'] = true;
        $newComponent['modules']['angular'][$z]['class'] = 'PopoverController';
        $newComponent['modules']['angular'][$z]['var'] = 'popoverController';
        $newComponent['modules']['angular'][$z]['path'] = '@ionic/angular';


        $newComponent['code']['other'] = null;
        $newComponent['code']['other'] .= "\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '* PopoverComponent:dismissPopover()' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
        $newComponent['code']['other'] .= "\t" . 'dismissPopover(){' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'this.popoverController.dismiss();' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '* PopoverComponent:exitApp()' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
        $newComponent['code']['other'] .= "\t" . 'exitApp(){' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'this.dismissPopover();' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'if(window.confirm("Do you want to exit App?")){' . "\r\n";
        $newComponent['code']['other'] .= "\t\t\t" . 'navigator["app"].exitApp();' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '/**' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '* PopoverComponent:darkMode(event)' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '**/' . "\r\n";
        $newComponent['code']['other'] .= "\t" . 'isDarkMode:boolean = true;' . "\r\n";
        $newComponent['code']['other'] .= "\t" . 'darkMode(event){' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'let systemDark = window.matchMedia("(prefers-color-scheme: dark)");' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'systemDark.addListener(this.colorTest);' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . 'if(event.detail.checked){' . "\r\n";
        $newComponent['code']['other'] .= "\t\t\t" . 'document.body.setAttribute("data-theme", "dark");' . "\r\n";
        $newComponent['code']['other'] .= "\t\t\t" . 'this.isDarkMode = true;' . "\r\n";
        $newComponent['code']['other'] .= "\t\t" . '}else{' . "\r\n";
        $newComponent['code']['other'] .= "\t\t\t" . 'document.body.setAttribute("data-theme", "light");' . "\r\n";
        $newComponent['code']['other'] .= "\t\t\t" . 'this.isDarkMode = false;' . "\r\n";
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
        $newComponent['code']['other'] .= "\t\t" . '' . "\r\n";
        $newComponent['code']['other'] .= "\t" . '}' . "\r\n";
        $newComponent['code']['constructor'] = "\t\t" . '// constructor';
        return $newComponent;
    }
}

?>