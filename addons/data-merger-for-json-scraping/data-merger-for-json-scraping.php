<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `data-merger-for-json-scraping`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("data-merger-for-json-scraping");
$string = new jsmString();


if (!isset($_GET['page-target']))
{
    $_GET['page-target'] = '';
}
$current_page_target = $string->toFileName($_GET['page-target']);

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('data-merger-for-json-scraping', $current_page_target);
    header('Location: ./?p=addons&addons=data-merger-for-json-scraping&' . time());
}

// TODO: POST
if (isset($_POST['save-data-merger-for-json-scraping']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    $addons['page-title'] = trim($_POST['data-merger-for-json-scraping']['page-title']);
    $addons['page-header-color'] = trim($_POST['data-merger-for-json-scraping']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['data-merger-for-json-scraping']['page-content-background']);
    $z = 0;
    foreach ($_POST['data-merger-for-json-scraping']['data'] as $data)
    {
        if ($data['name'] !== '')
        {
            $addons['data'][$z] = $data;
        }

        $z++;
    }


    $db->saveAddOns('data-merger-for-json-scraping', $addons);


    // create properties for page
    // TODO: POST --|-- PAGE
    $newPage = null;
    $newPage['title'] = $addons['page-title'];
    $newPage['name'] = $current_page_target;
    $newPage['code-by'] = 'data-merger-for-json-scraping';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: POST --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    // TODO: POST --|-- MODULES - IMPORT MODULES
    $z++;
    foreach ($addons['data'] as $data)
    {
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = '' . $string->toClassName($data['service']) . 'Service';
        $newPage['modules']['angular'][$z]['var'] = $string->toUserClassName($data['service']) . 'Service';
        $newPage['modules']['angular'][$z]['path'] = './../../services/' . $string->toFileName($data['service']) . '/' . $string->toFileName($data['service']) . '.service';
        $z++;
    }


    // TODO: POST --|-- PAGE --|-- HTML
    $newPage['content']['html'] = null;

    foreach ($addons['data'] as $data)
    {
        $detail_addons = $db->getAddOns('json-scraping', $data['service']);
        $gotolink = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $string->toFileName($data['service']) . '-detail\',item[\'' . $detail_addons['var-id'] . '\']]"';
        if ($detail_addons['template-single-item'] == 'none')
        {
            $gotolink = null;
        }
        if (substr($detail_addons['template-single-item'], 0, 8) == 'link-to-')
        {
            $link_to_page = $string->toFilename(substr($detail_addons['template-single-item'], 8, strlen($detail_addons['template-single-item'])));
            $gotolink = 'button [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'' . $link_to_page . '\',item[\'' . $detail_addons['var-id'] . '\']]"';
        }


        switch ($data['layout'])
        {
            case 'ion-slides':
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ' . $string->toVar($data['service']) . ' -->' . "\r\n";
                if ($data['item-image'] == '')
                {
                    $data['item-image'] = 'none';
                }
                $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="data' . $string->toClassName($data['service']) . '">' . "\r\n";
                if ($data['title'] != '')
                {
                    $newPage['content']['html'] .= "\t\t" . '<ion-list-header>' . $data['title'] . '</ion-list-header>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t" . '<ion-slides pager="false" *ngIf="data' . $string->toClassName($data['service']) . '" >' . "\r\n";


                if ($data['item-image'] == 'none')
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-slide *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:5" [ngStyle]="{\'background\':\'#000\'}" >' . "\r\n";

                } else
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-slide *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:5" [ngStyle]="{\'background-image\':\'url(\' + item[\'' . $data['item-image'] . '\'] + \')\',\'background-size\':\'cover\',\'background-position\':\'center center\'}" >' . "\r\n";
                }

                $newPage['content']['html'] .= "\t\t\t" . '<div class="slide-container ratio-16x9">' . "\r\n";

                if ($data['item-heading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<h2 class="slide-title" [innerHTML]="item[\'' . $data['item-heading'] . '\']"></h2>' . "\r\n";
                }
                if ($data['item-subheading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<p class="slide-title">{{ item[\'' . $data['item-subheading'] . '\'] | stripTags | readMore:75}}</p>' . "\r\n";
                }
                if ($gotolink != null)
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button size="large" fill="clear" icon="end" color="primary" ' . $gotolink . '>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t" . 'More' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-icon name="arrow-forward"></ion-icon>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-slide>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-slides>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ./' . $string->toVar($data['service']) . ' -->' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                break;

            case 'ion-slides-2-items':
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ' . $string->toVar($data['service']) . ' -->' . "\r\n";
                if ($data['item-image'] == '')
                {
                    $data['item-image'] = 'none';
                }

                if ($data['title'] != '')
                {
                    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . $data['title'] . '</ion-list-header>' . "\r\n";
                }


                $newPage['content']['html'] .= "\t" . '<ion-slides pager="false" *ngIf="data' . $string->toClassName($data['service']) . '" [options]="{slidesPerView:2}">' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:5" [ngStyle]="{\'background\':\'transparent\'}" >' . "\r\n";

                $newPage['content']['html'] .= "\t\t\t" . '<ion-card [ngStyle]="{\'margin-top\':0,\'margin-bottom\':0}">' . "\r\n";

                if ($data['item-image'] == 'none')
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
                } else
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\' + item[\'' . $data['item-image'] . '\'] + \')\',\'background-size\':\'cover\',\'background-position\':\'center\'}">' . "\r\n";
                }

                if ($data['item-subheading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-subtitle [innerHTML]="item[\'' . $data['item-subheading'] . '\']"></ion-card-subtitle>' . "\r\n";
                }
                if ($data['item-heading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-title [innerHTML]="item[\'' . $data['item-heading'] . '\']"></ion-card-title>' . "\r\n";
                }


                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content>' . "\r\n";

                if ($data['item-note'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<p [innerHTML]="item[\'' . $data['item-note'] . '\']"></p>' . "\r\n";
                }
                if ($gotolink != null)
                {
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button size="small" color="primary" ' . $gotolink . '>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t\t" . 'More' . "\r\n";
                    //$newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon name="arrow-forward"></ion-icon>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-content>' . "\r\n";

                $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";


                //$newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ./' . $string->toVar($data['service']) . ' -->' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                break;

            case 'ion-segment':
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ' . $string->toVar($data['service']) . ' -->' . "\r\n";
                if ($data['title'] != '')
                {
                    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . $data['title'] . '</ion-list-header>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="data' . $string->toClassName($data['service']) . '">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-segment>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-segment-button *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:3">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-icon name="call"></ion-icon>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label [innerHTML]="item[\'' . $data['item-heading'] . '\']"></ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-segment-button>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-segment>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ./' . $string->toVar($data['service']) . ' -->' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                break;

            case 'ion-list':
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ' . $string->toVar($data['service']) . ' -->' . "\r\n";

                $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="data' . $string->toClassName($data['service']) . '">' . "\r\n";
                if ($data['title'] != '')
                {
                    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . $data['title'] . '</ion-list-header>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:5 " ' . $gotolink . '>' . "\r\n";
                if ($data['item-image'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="item.' . $data['item-image'] . '" src="{{ item.' . $data['item-image'] . ' }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text *ngIf="!item.' . $data['item-image'] . '" animated></ion-skeleton-text>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                }

                $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . "\r\n";
                if ($data['item-heading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<h3 [innerHTML]="item.' . $data['item-heading'] . '"></h3>' . "\r\n";
                }
                if ($data['item-subheading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{ item.' . $data['item-subheading'] . ' | stripTags | readMore:140}}</p>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ./' . $string->toVar($data['service']) . ' -->' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                break;
            case 'ion-card':

                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ' . $string->toVar($data['service']) . ' -->' . "\r\n";


                $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:5 " ' . $gotolink . '>' . "\r\n";

                if ($data['item-image'] != '')
                {
                    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<img *ngIf="item[\'' . $data['item-image'] . '\']" src="{{ item[\'' . $data['item-image'] . '\'] }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text *ngIf="!item[\'' . $data['item-image'] . '\']" animated></ion-skeleton-text>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
                }

                $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
                if ($data['item-heading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="item[\'' . $data['item-heading'] . '\']"></ion-card-title>' . "\r\n";
                }

                if ($data['item-subheading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ item[\'' . $data['item-subheading'] . '\'] | stripTags | readMore:140}}</ion-card-subtitle>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";


                if ($data['item-note'] != '')
                {
                    $newPage['content']['html'] .= "\t\t" . '<ion-card-content [innerHTML]="item[\'' . $data['item-note'] . '\']"></ion-card-content>' . "\r\n";
                }

                if ($gotolink != '')
                {
                    $newPage['content']['html'] .= "\t\t" . '<ion-item ' . $gotolink . ' >' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="more" slot="start"></ion-icon>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>more</ion-label>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                }

                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";


                $newPage['content']['html'] .= "\t" . '<!-- ./' . $string->toVar($data['service']) . ' -->' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";

                break;
            case 'ion-chip':

                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ' . $string->toVar($data['service']) . ' -->' . "\r\n";

                $newPage['content']['html'] .= "\t" . '<ion-list inset *ngIf="data' . $string->toClassName($data['service']) . '">' . "\r\n";
                if ($data['title'] != '')
                {
                    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . $data['title'] . '</ion-list-header>' . "\r\n";
                }
                $newPage['content']['html'] .= "\t\t" . '<ion-chip *ngFor="let item of data' . $string->toClassName($data['service']) . ' | slice:0:5 " ' . $gotolink . '>' . "\r\n";
                if ($data['item-image'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-avatar>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="item[\'' . $data['item-image'] . '\']" src="{{ item[\'' . $data['item-image'] . '\'] }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text *ngIf="!item[\'' . $data['item-image'] . '\']" animated></ion-skeleton-text>' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t" . '</ion-avatar>' . "\r\n";
                }
                if ($data['item-heading'] != '')
                {
                    $newPage['content']['html'] .= "\t\t\t" . '<ion-label [innerHTML]="item[\'' . $data['item-heading'] . '\']"></ion-label>' . "\r\n";
                }


                $newPage['content']['html'] .= "\t\t" . '</ion-chip>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<!-- ./' . $string->toVar($data['service']) . ' -->' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";


                break;
        }

    }


    // TODO: POST --|-- PAGE --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-slide {background-size:cover; display:block !important; min-height:150px}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-1x1 {width: 100%;padding-top: 100%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-16x9 {width: 100%;padding-top: 56.25%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-4x3 {width: 100%;padding-top: 75%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-3x2 {width: 100%;padding-top: 66.66%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide .ratio-8x5 {width: 100%;padding-top: 62.5%; position: relative;}' . "\r\n";

    $newPage['content']['scss'] .= "\t" . 'ion-slide > h2{padding-top:1em;padding-left:1em;padding-right:1em;padding-bottom:0;color: #fff;text-shadow: 1px 1px 1px #777;opacity: .9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slide > p{padding-top:0;padding-left:1em;color: #fff;opacity: .9;padding-right:1.8rem;text-shadow: 1px 1px 1px #777;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card {' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '--background: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity:1;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";

    // TODO: POST --|-- PAGE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    foreach ($addons['data'] as $data)
    {
        $fix_addons['data'][$data['service']] = $data;
    }


    foreach ($fix_addons['data'] as $data)
    {

        $detail_addons = $db->getAddOns('json-scraping', $data['service']);
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* Init for ' . $string->toClassName($data['service']) . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* api: ' . $detail_addons['url-list-item'] . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . $string->toVar($data['service']) . ': Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'data' . $string->toClassName($data['service']) . ': any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:get' . $string->toClassName($data['service']) . '();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'get' . $string->toClassName($data['service']) . '(){' . "\r\n";
        if (preg_match("/{id}/", $detail_addons['url-list-item']))
        {
            $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toVar($data['service']) . ' = this.' . $string->toUserClassName($data['service']) . 'Service.getItems("-1");' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toVar($data['service']) . ' = this.' . $string->toUserClassName($data['service']) . 'Service.getItems();' . "\r\n";
        }
        $newPage['code']['other'] .= "\t\t" . 'this.' . $string->toVar($data['service']) . '.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.data' . $string->toClassName($data['service']) . ' = data' . $detail_addons['var-list-item'] . ' ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    }

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($addons['page-target']) . 'Page:ngOnInit();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    foreach ($fix_addons['data'] as $data)
    {
        $newPage['code']['other'] .= "\t\t" . 'this.get' . $string->toClassName($data['service']) . '();' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";

    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=data-merger-for-json-scraping&page-target=' . $current_page_target . '&' . time());

}

// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('data-merger-for-json-scraping', $current_page_target);
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

if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}
if (!isset($current_setting['data']))
{
    $current_setting['data'] = array();
}


// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-9"><!-- col-md-9 -->';
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

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
// TODO: LAYOUT --|-- FORM

// TODO: LAYOUT --|-- FORM --|-- PAGE-TARGET
$content .= '<div class="form-group">';
$content .= '<label for="page-target">' . __e('Overwrite The Page') . '</label>';
$content .= '<select id="page-target" name="data-merger-for-json-scraping[page-target]" class="form-control" >';
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

// TODO: LAYOUT --|-- FORM --|-- PAGE-TITLE
$content .= '<div class="form-group">';
$content .= '<label for="page-title">' . __e('Page Title') . '</label>';
$content .= '<input  id="page-title" type="text" name="data-merger-for-json-scraping[page-title]" class="form-control" placeholder="My Pages"  value="' . $current_setting['page-title'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<hr/>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="data-merger-for-json-scraping[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="data-merger-for-json-scraping[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
if (isset($_SESSION['CURRENT_APP']['addons']['json-scraping']))
{
    $json_scraping = $_SESSION['CURRENT_APP']['addons']['json-scraping'];


    $content .= '<table class="table table-striped table-bordered no-margin no-padding" >' . "\r\n";
    $content .= '<thead>' . "\r\n";

    $content .= '<tr>' . "\r\n";
    $content .= '<th class="text-center v-center" rowspan="2">#</th>' . "\r\n";
    $content .= '<th class="text-center v-center" rowspan="2">' . __e('Name') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center" rowspan="2">' . __e('Source Data') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center" colspan="2">' . __e('Widget') . '</th>' . "\r\n";

    $content .= '<th class="text-center v-center" colspan="5">' . __e('Item') . '</th>' . "\r\n";

    $content .= '<th class="text-center v-center" rowspan="2">#</th>' . "\r\n";
    $content .= '</tr>' . "\r\n";

    $content .= '<tr>' . "\r\n";
    //$content .= '<th></th>' . "\r\n";
    //$content .= '<th>' . __e('Name') . '</th>' . "\r\n";
    //$content .= '<th>' . __e('Source<br/>Data') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Layout') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Title') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Heading') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Subheading') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Note') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Images') . '</th>' . "\r\n";
    $content .= '<th class="text-center v-center">' . __e('Ionicons') . '</th>' . "\r\n";
    //$content .= '<th></th>' . "\r\n";
    $content .= '</tr>' . "\r\n";

    $content .= '</thead>' . "\r\n";
    $content .= '<tbody id="var-lists">' . "\r\n";


    $hit = count($current_setting['data']) + 1;

    for ($z = 0; $z < $hit; $z++)
    {
        // TODO: LAYOUT --|-- FORM --|-- SERVICES

        $icon_move = '<i class="glyphicon glyphicon-move"></i>';
        $opt_service = $opt_type_id = $opt_type_id = $item_heading = $item_subheading = $item_note = $item_image = $item_icon = $opt_layout = null;


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - NAME
        if (!isset($current_setting['data'][$z]['name']))
        {
            $current_setting['data'][$z]['name'] = '';
        }
        $required = '';
        if ($z == ($hit - 2))
        {
            $required = 'required';
        }
        $opt_name = '<input ' . $required . ' type="text" class="form-control" placeholder="widget-' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][name]" value="' . htmlentities($current_setting['data'][$z]['name']) . '"/>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - SERVICE
        if (!isset($current_setting['data'][$z]['service']))
        {
            $current_setting['data'][$z]['service'] = '';
        }
        $opt_service .= '<select class="form-control data-service" name="data-merger-for-json-scraping[data][' . $z . '][service]" data-target=".item-line-' . $z . '">';
        foreach ($json_scraping as $scraping)
        {
            $selected = '';
            if ($current_setting['data'][$z]['service'] == $scraping['page-target'])
            {
                $selected = 'selected';
            }
            $opt_service .= '<option value="' . $scraping['page-target'] . '" ' . $selected . '>' . $scraping['page-target'] . '</option>';
        }
        $opt_service .= '</select>';


        $option_item_vars = '';

        $_service = $current_setting['data'][$z]['service'];
        if (!isset($json_scraping[$_service]['vars']))
        {
            $json_scraping[$_service]['vars'] = array();
        }
        foreach ($json_scraping[$_service]['vars'] as $item_var)
        {
            $option_item_vars .= '<option value="' . $item_var['var'] . '">' . $item_var['var'] . '</option>';
        }

        // TODO: LAYOUT --|-- FORM --|-- LAYOUT TYPE
        if (!isset($current_setting['data'][$z]['layout']))
        {
            $current_setting['data'][$z]['layout'] = 'ion-slides';
        }
        $layout_options = array();
        $layout_options[] = array('label' => 'Ion Slides', 'val' => 'ion-slides');
        $layout_options[] = array('label' => 'Ion Slides-Two-Items', 'val' => 'ion-slides-2-items');
        //$layout_options[] = array('label' => 'Ion Segment', 'val' => 'ion-segment');
        $layout_options[] = array('label' => 'Ion List', 'val' => 'ion-list');
        $layout_options[] = array('label' => 'Ion Card', 'val' => 'ion-card');
        $layout_options[] = array('label' => 'Ion Chip', 'val' => 'ion-chip');

        $opt_layout .= '<select class="form-control" name="data-merger-for-json-scraping[data][' . $z . '][layout]">';
        foreach ($layout_options as $layout_option)
        {
            $selected = '';
            if ($current_setting['data'][$z]['layout'] == $layout_option['val'])
            {
                $selected = 'selected';
            }
            $opt_layout .= '<option value="' . $layout_option['val'] . '" ' . $selected . '>' . $layout_option['label'] . '</option>';
        }
        $opt_layout .= '</select>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - TITLE
        if (!isset($current_setting['data'][$z]['title']))
        {
            $current_setting['data'][$z]['title'] = '';
        }

        $item_title = '<input type="text" class="form-control" placeholder="Widget ' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][title]" value="' . htmlentities($current_setting['data'][$z]['title']) . '"/>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - ITEM-HEADING
        if (!isset($current_setting['data'][$z]['item-heading']))
        {
            $current_setting['data'][$z]['item-heading'] = '';
        }
        $item_heading .= '<select class="autocomplete item-line-' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][item-heading]">';
        $item_heading .= '<option value="' . htmlentities($current_setting['data'][$z]['item-heading']) . '">' . htmlentities($current_setting['data'][$z]['item-heading']) . '</option>';
        $item_heading .= $option_item_vars;
        $item_heading .= '</select>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - ITEM-SUBHEADING
        if (!isset($current_setting['data'][$z]['item-subheading']))
        {
            $current_setting['data'][$z]['item-subheading'] = '';
        }
        $item_subheading .= '<select class="autocomplete item-line-' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][item-subheading]">';
        $item_subheading .= '<option value="' . htmlentities($current_setting['data'][$z]['item-subheading']) . '">' . htmlentities($current_setting['data'][$z]['item-subheading']) . '</option>';
        $item_subheading .= $option_item_vars;
        $item_subheading .= '</select>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - ITEM-NOTE
        if (!isset($current_setting['data'][$z]['item-note']))
        {
            $current_setting['data'][$z]['item-note'] = '';
        }

        $item_note .= '<select class="autocomplete item-line-' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][item-note]">';
        $item_note .= '<option value="' . htmlentities($current_setting['data'][$z]['item-note']) . '">' . htmlentities($current_setting['data'][$z]['item-note']) . '</option>';
        $item_note .= $option_item_vars;
        $item_note .= '</select>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - ITEM-IMAGE
        if (!isset($current_setting['data'][$z]['item-image']))
        {
            $current_setting['data'][$z]['item-image'] = '';
        }
        $item_image .= '<select class="autocomplete item-line-' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][item-image]">';
        $item_image .= '<option value="' . htmlentities($current_setting['data'][$z]['item-image']) . '">' . htmlentities($current_setting['data'][$z]['item-image']) . '</option>';
        $item_image .= $option_item_vars;
        $item_image .= '</select>';


        // TODO: LAYOUT --|-- FORM --|-- SERVICES - ITEM-ICON
        if (!isset($current_setting['data'][$z]['item-icon']))
        {
            $current_setting['data'][$z]['item-icon'] = '';
        }
        $item_icon .= '<select class="autocomplete item-line-' . $z . '" name="data-merger-for-json-scraping[data][' . $z . '][item-icon]">';
        $item_icon .= '<option value="' . htmlentities($current_setting['data'][$z]['item-icon']) . '">' . htmlentities($current_setting['data'][$z]['item-icon']) . '</option>';
        $item_icon .= $option_item_vars;
        $item_icon .= '</select>';

        $content .= '<tr class="var-item" id="item-var-' . $z . '">' . "\r\n";
        $content .= '<td class="text-align v-align move-cursor handle">' . $icon_move . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $opt_name . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $opt_service . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $opt_layout . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $item_title . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $item_heading . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $item_subheading . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $item_note . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $item_image . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . $item_icon . '</td>' . "\r\n";
        $content .= '<td class="text-align v-align">' . "\r\n";
        $content .= '<a class="btn btn-danger btn-xs remove-item" data-target="#item-var-' . $z . '" href="#!_"><i class="fa fa-trash"></i></a>' . "\r\n";
        $content .= '</td>' . "\r\n";
        $content .= '</tr>' . "\r\n";

    }
    $content .= '</tbody>' . "\r\n";
    $content .= '</table>' . "\r\n";
} else
{

    $content .= '<div class="alert alert-danger">';
    $content .= '<p>' . __e('You don\'t use JSON Scraping Addons') . '</p>';
    $content .= '</div>';
}
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-data-merger-for-json-scraping" type="submit" class="btn bg-purple btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';

$content .= '<div class="col-md-3"><!-- col-md-3 -->';
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
        $content .= '<a href="./?p=addons&amp;addons=data-merger-for-json-scraping&amp;page-target=' . $pageList['page-target'] . '&amp;a=edit#!_" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#!_./?p=addons&amp;addons=data-merger-for-json-scraping&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete#!_" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
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
        $modal_dialog .= '<a href="./?p=addons&amp;addons=data-merger-for-json-scraping&amp;page-target=' . $pageList['page-target'] . '&amp;a=delete" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=data-merger-for-json-scraping&page-target="+$("#page-target").val(),!1});';

$page_js .= 'function itemList(service){';
$page_js .= 'var item_vars = [];';
if (isset($_SESSION['CURRENT_APP']['addons']['json-scraping']))
{
    $page_js .= 'switch(service){';
    $json_scraping = $_SESSION['CURRENT_APP']['addons']['json-scraping'];
    foreach ($json_scraping as $scraping)
    {
        $vars = array();
        foreach ($scraping['vars'] as $var)
        {
            $vars[] = $var['var'];
        }
        $page_js .= 'case "' . $scraping['page-target'] . '":';
        $page_js .= 'item_vars = ' . json_encode($vars) . ';';
        $page_js .= 'break;';
    }
    $page_js .= '}';
}
$page_js .= 'return item_vars;';
$page_js .= '}';

$page_js .= '$(".data-service").click(function(){';
$page_js .= 'var service = $(this).val();';
$page_js .= 'var target = $(this).attr("data-target");';
$page_js .= 'var item_vars = itemList(service);';
$page_js .= 'console.log(target,item_vars);';
$page_js .= 'var $selectItem = $(target);';
$page_js .= '$(target + " option").replaceWith("");';
$page_js .= '$selectItem.append($("<option>", { value: "", html: "' . __e('None') . '" }));';
$page_js .= '$(item_vars).each(function(i, v){ ';
$page_js .= '$(target).append($("<option>", { value: v, html: v }));';
$page_js .= '});';
$page_js .= '});';
$page_js .= '$("#var-lists").sortable({opacity: 0.5, items: ".var-item",revert: true,placeholder: "sort-highlight",forcePlaceholderSize: false,zIndex: 999999,cancel: ".move-disabled",handle: ".handle",});';
