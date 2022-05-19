<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `wordpress`
 */
defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("wordpress");
$string = new jsmString();
$disabled = false;
$page_prefix = 'posts';
function createBadge($page = "home")
{
    global $string;
    $pageClass = $string->toClassName($page) . 'Page';
    $code = null;
    $code .= '';
    $code .= "\t" . '//create badge on tab menu' . "\r\n";
    $code .= "\t" . 'count_bookmarks:number = 0;' . "\r\n";
    $code .= "\t" . 'temp_count_bookmarks:number = 0 ;' . "\r\n";
    $code .= "\t" . 'item_bookmarks : any = [];' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . 'runBadge: any;' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . ':createBadge()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'createBadge(){' . "\r\n";
    $code .= "\t\t" . 'this.runBadge = setInterval(()=>{' . "\r\n";
    $code .= "\t\t\t" . 'this.getBadges();' . "\r\n";
    $code .= "\t\t" . '},1000)' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . ':ionViewDidLeave()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'ionViewDidLeave(){' . "\r\n";
    $code .= "\t\t" . 'clearInterval(this.runBadge);' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '*  ' . $pageClass . '.getBookmark()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'public async getBookmark(){' . "\r\n";
    $code .= "\t\t" . 'this.count_bookmarks = this.temp_count_bookmarks;' . "\r\n";
    $code .= "\t\t" . 'this.temp_count_bookmarks = 0;' . "\r\n";
    $code .= "\t\t" . 'this.item_bookmarks = []; ' . "\r\n";
    $code .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $code .= "\t\t\t" . 'if(iKey.substring(0,10) ==  `bookmarks:`){' . "\r\n";
    $code .= "\t\t\t\t" . 'this.pushBookmark(iValue);' . "\r\n";
    $code .= "\t\t\t" . '}' . "\r\n";
    $code .= "\t\t" . '});' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . '.pushBookmark(item)' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'private pushBookmark(item){' . "\r\n";
    $code .= "\t\t" . 'this.temp_count_bookmarks++;' . "\r\n";
    $code .= "\t\t" . 'this.item_bookmarks.push(item);' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '/**' . "\r\n";
    $code .= "\t" . '* ' . $pageClass . ':getBadges()' . "\r\n";
    $code .= "\t" . '**/' . "\r\n";
    $code .= "\t" . 'getBadges(){' . "\r\n";
    $code .= "\t\t" . 'this.getBookmark();' . "\r\n";
    $code .= "\t" . '}' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    $code .= "\t" . '' . "\r\n";
    return $code;
}
function tabCode($addons, $page)
{
    $pipe_translate = '';
    if ($addons['multiple-language'] == true)
    {
        $pipe_translate = '| translate ';
    }

    if ($page == 'posts-by-tags')
    {
        $page = 'posts-by-categories';
    }
    if ($page == 'posts-by-author')
    {
        $page = 'posts-by-categories';
    }
    $page_footer = null;
    $page_footer['color'] = 'none';
    $page_footer['type'] = 'code';
    $page_footer['title'] = '';
    $page_footer['code'] = null;
    $home_disable = '';
    $posts_disable = '';
    $categories_disable = '';
    $bookmarks_disable = '';
    $users_disable = '';
    switch ($page)
    {
        case 'home':
            $home_disable = 'disabled="true"';
            break;
        case 'posts-by-categories':
            $posts_disable = 'disabled="true"';
            break;
        case 'categories':
            $categories_disable = 'disabled="true"';
            break;
        case 'bookmarks':
            $bookmarks_disable = 'disabled="true"';
            break;
        case 'users':
            $users_disable = 'disabled="true"';
            break;
    }
    $page_footer['code'] = '';
    $page_footer['code'] .= "\t" . '<ion-toolbar>' . "\r\n";
    $page_footer['code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
    $page_footer['code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $home_disable . ' [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-home'] . '"' . $pipe_translate . ' }}</ion-label>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $posts_disable . ' [routerDirection]="\'root\'" [routerLink]="[\'/posts-by-categories/\']">' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-posts'] . '"' . $pipe_translate . ' }}</ion-label>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="newspaper-outline"></ion-icon>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $categories_disable . ' [routerDirection]="\'root\'" [routerLink]="[\'/categories\']">' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-categories'] . '"' . $pipe_translate . ' }}</ion-label>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="trail-sign-outline"></ion-icon>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $bookmarks_disable . ' [routerDirection]="\'root\'" [routerLink]="[\'/bookmarks\']">' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-bookmarks'] . '"' . $pipe_translate . ' }}</ion-label>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="bookmarks-outline"></ion-icon>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t\t" . '<ion-badge *ngIf="count_bookmarks!=0" color="danger">{{ count_bookmarks }}</ion-badge>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    if ($addons['menu-users'] == true)
    {
        $page_footer['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $users_disable . ' [routerDirection]="\'root\'" [routerLink]="[\'/users\']">' . "\r\n";
        $page_footer['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-users'] . '"' . $pipe_translate . ' }}</ion-label>' . "\r\n";
        $page_footer['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="people-outline"></ion-icon>' . "\r\n";
        $page_footer['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
    }
    $page_footer['code'] .= "\t\t\t\t" . '' . "\r\n";
    $page_footer['code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
    $page_footer['code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
    $page_footer['code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $page_footer['code'] .= '';
    return $page_footer;
}

if (isset($_POST['save-wordpress']))
{
    // TODO: POST
    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    $addons['wp-url'] = str_replace("http://", "https://", trim($_POST['wordpress']['wp-url']));


    $addons['page-posts-per-page'] = (int)($_POST['wordpress']['page-posts-per-page']);
    $addons['page-posts-layout'] = trim($_POST['wordpress']['page-posts-layout']);

    $addons['page-home-layout-categories'] = trim($_POST['wordpress']['page-home-layout-categories']);
    $addons['page-home-show-number-posts-categories'] = trim($_POST['wordpress']['page-home-show-number-posts-categories']);
    $addons['page-home-show-description-categories'] = trim($_POST['wordpress']['page-home-show-description-categories']);

    $addons['page-categories-layout'] = trim($_POST['wordpress']['page-categories-layout']);
    $addons['page-categories-show-number-posts'] = trim($_POST['wordpress']['page-categories-show-number-posts']);
    $addons['page-categories-show-description'] = trim($_POST['wordpress']['page-categories-show-description']);

    $addons['ratio-slider'] = trim($_POST['wordpress']['ratio-slider']); //select
    $addons['label-categories'] = trim($_POST['wordpress']['label-categories']);
    $addons['label-posts'] = trim($_POST['wordpress']['label-posts']);
    $addons['label-users'] = trim($_POST['wordpress']['label-users']);
    $addons['label-all'] = trim($_POST['wordpress']['label-all']);
    $addons['label-readmore'] = trim($_POST['wordpress']['label-readmore']);
    $addons['label-search'] = trim($_POST['wordpress']['label-search']);
    $addons['label-dashboard'] = trim($_POST['wordpress']['label-dashboard']);
    $addons['label-bookmarks'] = trim($_POST['wordpress']['label-bookmarks']);
    $addons['label-help'] = trim($_POST['wordpress']['label-help']); //text
    $addons['label-rate-this-app'] = trim($_POST['wordpress']['label-rate-this-app']); //text
    $addons['label-privacy-policy'] = trim($_POST['wordpress']['label-privacy-policy']); //text
    $addons['label-about-us'] = trim($_POST['wordpress']['label-about-us']); //text
    $addons['label-administrator'] = trim($_POST['wordpress']['label-administrator']); //text
    $addons['label-no-bookmarks-found'] = trim($_POST['wordpress']['label-no-bookmarks-found']); //text
    $addons['label-delete'] = trim($_POST['wordpress']['label-delete']); //text
    $addons['label-clean-up'] = trim($_POST['wordpress']['label-clean-up']); //text
    $addons['label-please-wait'] = trim($_POST['wordpress']['label-please-wait']); //text
    $addons['label-home'] = trim($_POST['wordpress']['label-home']); //text
    $addons['label-latest-posts'] = trim($_POST['wordpress']['label-latest-posts']); //text
    $addons['label-bookmark-list'] = trim($_POST['wordpress']['label-bookmark-list']); //text
    $addons['label-sticky-posts'] = trim($_POST['wordpress']['label-sticky-posts']); //text
    $addons['label-tags'] = trim($_POST['wordpress']['label-tags']); //text
    $addons['label-comment-pending'] = trim($_POST['wordpress']['label-comment-pending']); //text\
    $addons['label-connection-lost'] = trim($_POST['wordpress']['label-connection-lost']); //text
    $addons['label-dark-mode'] = trim($_POST['wordpress']['label-dark-mode']); //text
    $addons['home-slider'] = trim($_POST['wordpress']['home-slider']); //select
    $addons['label-select-language'] = trim($_POST['wordpress']['label-select-language']); //text
    // checkbox
    //label-no-item
    if (!isset($_POST['wordpress']['label-no-item']))
    {
        $_POST['wordpress']['label-no-item'] = 'There are no items';
    }
    $addons['label-no-item'] = trim($_POST['wordpress']['label-no-item']); //text


    //latest-posts-layout-for-home
    $addons['latest-posts-layout-for-home'] = trim($_POST['wordpress']['latest-posts-layout-for-home']); //select

    //posts-by-categories-for-home
    if (!isset($_POST['wordpress']['posts-by-categories-for-home']))
    {
        $_POST['wordpress']['posts-by-categories-for-home'] = '';
    }
    $addons['posts-by-categories-for-home'] = trim($_POST['wordpress']['posts-by-categories-for-home']); //text

    //posts-by-categories-for-home
    if (!isset($_POST['wordpress']['slides-by-categories-for-home']))
    {
        $_POST['wordpress']['slides-by-categories-for-home'] = '';
    }
    $addons['slides-by-categories-for-home'] = trim($_POST['wordpress']['slides-by-categories-for-home']); //text

    //max-posts-for-home
    if (!isset($_POST['wordpress']['max-posts-for-home']))
    {
        $_POST['wordpress']['max-posts-for-home'] = '5';
    }
    $addons['max-posts-for-home'] = trim($_POST['wordpress']['max-posts-for-home']); //text


    // checkbox
    if (isset($_POST['wordpress']['home-tags']))
    {
        $addons['home-tags'] = true;
    } else
    {
        $addons['home-tags'] = false;
    }
    // checkbox
    if (isset($_POST['wordpress']['home-users']))
    {
        $addons['home-users'] = true;
    } else
    {
        $addons['home-users'] = false;
    }

    // checkbox
    if (isset($_POST['wordpress']['menu-users']))
    {
        $addons['menu-users'] = true;
    } else
    {
        $addons['menu-users'] = false;
    }

    // checkbox
    if (isset($_POST['wordpress']['enable-comment']))
    {
        $addons['enable-comment'] = true;
    } else
    {
        $addons['enable-comment'] = false;
    }

    //multiple-language
    // checkbox
    if (isset($_POST['wordpress']['multiple-language']))
    {
        $addons['multiple-language'] = true;
    } else
    {
        $addons['multiple-language'] = false;
    }


    $addons['label-comments'] = trim($_POST['wordpress']['label-comments']); //text
    $addons['label-no-comment'] = trim($_POST['wordpress']['label-no-comment']); //text
    $addons['page-header-color'] = trim($_POST['wordpress']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['wordpress']['page-content-background']);
    $addons['search-type'] = trim($_POST['wordpress']['search-type']);

    if (isset($_POST['wordpress']['auto-menu']))
    {
        $addons['auto-menu'] = true;
    } else
    {
        $addons['auto-menu'] = false;
    }
    $addons['helper'] = trim($_POST['wordpress']['helper']); //select
    $wp_url = $addons['wp-url'];
    $page_layout = $addons['page-posts-layout'];
    $per_page = $addons['page-posts-per-page'];
    //$cat_id = $addons['cat-id'];
    $db->saveAddOns('wordpress', $addons);

    if ($addons['multiple-language'] == true)
    {
        // TODO: LOCALIZATION
        //=======================================================
        $localization = null;
        $localization['prefix'] = 'en';
        $localization['name'] = 'English';
        $localization['desc'] = 'Auto create by WordPress App Addons';

        $v = 0;
        $localization['words'][$v]['text'] = $addons['label-categories'];
        $localization['words'][$v]['translate'] = 'Categories';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-posts'];
        $localization['words'][$v]['translate'] = 'Posts';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-users'];
        $localization['words'][$v]['translate'] = 'Users';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-all'];
        $localization['words'][$v]['translate'] = 'All';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-readmore'];
        $localization['words'][$v]['translate'] = 'Readmore';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-search'];
        $localization['words'][$v]['translate'] = 'Search';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-dashboard'];
        $localization['words'][$v]['translate'] = 'Dashboard';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-bookmarks'];
        $localization['words'][$v]['translate'] = 'Bookmarks';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-help'];
        $localization['words'][$v]['translate'] = 'Help';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-rate-this-app'];
        $localization['words'][$v]['translate'] = 'Rate This App';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-privacy-policy'];
        $localization['words'][$v]['translate'] = 'Privacy Policy';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-about-us'];
        $localization['words'][$v]['translate'] = 'About Us';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-administrator'];
        $localization['words'][$v]['translate'] = 'Administrator';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-no-bookmarks-found'];
        $localization['words'][$v]['translate'] = 'No bookmarks found';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-delete'];
        $localization['words'][$v]['translate'] = 'Delete';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-clean-up'];
        $localization['words'][$v]['translate'] = 'Clean Up';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-please-wait'];
        $localization['words'][$v]['translate'] = 'Please wait...';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-home'];
        $localization['words'][$v]['translate'] = 'Home';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-latest-posts'];
        $localization['words'][$v]['translate'] = 'Latest Posts';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-bookmark-list'];
        $localization['words'][$v]['translate'] = 'Bookmark List';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-sticky-posts'];
        $localization['words'][$v]['translate'] = 'Sticky Posts';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-tags'];
        $localization['words'][$v]['translate'] = 'Tags';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-comment-pending'];
        $localization['words'][$v]['translate'] = 'Comment Pending';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-connection-lost'];
        $localization['words'][$v]['translate'] = 'Connection Lost';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-dark-mode'];
        $localization['words'][$v]['translate'] = 'Dark Mode';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-select-language'];
        $localization['words'][$v]['translate'] = 'Select Language?';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-comments'];
        $localization['words'][$v]['translate'] = '';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-no-comment'];
        $localization['words'][$v]['translate'] = 'Comment';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-no-item'];
        $localization['words'][$v]['translate'] = 'There are no items';


        $db->saveLocalization($localization);

        //========================================================
        $localization = null;
        $localization['prefix'] = 'id';
        $localization['name'] = 'Bahasa Indonesia';
        $localization['desc'] = 'Auto create by WordPress App Addons';

        $v = 0;
        $localization['words'][$v]['text'] = $addons['label-categories'];
        $localization['words'][$v]['translate'] = 'Kategori';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-posts'];
        $localization['words'][$v]['translate'] = 'Postingan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-users'];
        $localization['words'][$v]['translate'] = 'Pengguna';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-all'];
        $localization['words'][$v]['translate'] = 'Semua';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-readmore'];
        $localization['words'][$v]['translate'] = 'Selengkapnya';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-search'];
        $localization['words'][$v]['translate'] = 'Cari';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-dashboard'];
        $localization['words'][$v]['translate'] = 'Beranda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-bookmarks'];
        $localization['words'][$v]['translate'] = 'Penanda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-help'];
        $localization['words'][$v]['translate'] = 'Bantuan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-rate-this-app'];
        $localization['words'][$v]['translate'] = 'Nilai App Ini';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-privacy-policy'];
        $localization['words'][$v]['translate'] = 'Kebijaksanaan Privasi';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-about-us'];
        $localization['words'][$v]['translate'] = 'Tentang Kami';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-administrator'];
        $localization['words'][$v]['translate'] = 'Pengelola';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-no-bookmarks-found'];
        $localization['words'][$v]['translate'] = 'Tidak ada penanda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-delete'];
        $localization['words'][$v]['translate'] = 'Hapis';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-clean-up'];
        $localization['words'][$v]['translate'] = 'Bersihkan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-please-wait'];
        $localization['words'][$v]['translate'] = 'Silahkan tunggu...';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-home'];
        $localization['words'][$v]['translate'] = 'Rumah';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-latest-posts'];
        $localization['words'][$v]['translate'] = 'Postingan Terbaru';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-bookmark-list'];
        $localization['words'][$v]['translate'] = 'Daftar Penanda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-sticky-posts'];
        $localization['words'][$v]['translate'] = 'Postingan Lengket';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-tags'];
        $localization['words'][$v]['translate'] = 'Penanda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-comment-pending'];
        $localization['words'][$v]['translate'] = 'Komentar ditangguhkan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-connection-lost'];
        $localization['words'][$v]['translate'] = 'Koneksi terputus';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-dark-mode'];
        $localization['words'][$v]['translate'] = 'Mode Gelap';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-select-language'];
        $localization['words'][$v]['translate'] = 'Pilih Bahasa?';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-comments'];
        $localization['words'][$v]['translate'] = 'Komentar';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-no-comment'];
        $localization['words'][$v]['translate'] = 'Tidak ada Komentar';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-no-item'];
        $localization['words'][$v]['translate'] = 'Tidak ada item';


        $v++;
        $localization['words'][$v]['text'] = 'years ago';
        $localization['words'][$v]['translate'] = 'tahun lalu';

        $v++;
        $localization['words'][$v]['text'] = 'months ago';
        $localization['words'][$v]['translate'] = 'bulan lalu';

        $v++;
        $localization['words'][$v]['text'] = 'days ago';
        $localization['words'][$v]['translate'] = 'hari lalu';

        $v++;
        $localization['words'][$v]['text'] = 'hours ago';
        $localization['words'][$v]['translate'] = 'jam lalu';

        $v++;
        $localization['words'][$v]['text'] = 'minutes ago';
        $localization['words'][$v]['translate'] = 'minit lalu';

        $v++;
        $localization['words'][$v]['text'] = 'seconds ago';
        $localization['words'][$v]['translate'] = 'detik lalu';

        $v++;
        $localization['words'][$v]['text'] = 'Do you want to exit App?';
        $localization['words'][$v]['translate'] = 'Apakah kamu ingin keluar aplikasi?';

        $v++;
        $localization['words'][$v]['text'] = 'Default';
        $localization['words'][$v]['translate'] = 'Biasa';

        $v++;
        $localization['words'][$v]['text'] = 'Cancel';
        $localization['words'][$v]['translate'] = 'Batal';

        $v++;
        $localization['words'][$v]['text'] = 'Ok';
        $localization['words'][$v]['translate'] = 'Baik';

        $v++;
        $localization['words'][$v]['text'] = 'Yes';
        $localization['words'][$v]['translate'] = 'Ya';

        $v++;
        $localization['words'][$v]['text'] = 'Readmore';
        $localization['words'][$v]['translate'] = 'Baca selanjutnya';

        $db->saveLocalization($localization);
    } else
    {
        $db->deleteLocalization('en');
        $db->deleteLocalization('id');
    }


 
    // TODO: UPDATE --|-- ENQUEUE
    $enqueue_css[] = array('url' => $addons['wp-url'] . '/wp-includes/css/dist/block-library/style.min.css', 'attr' => 'media="all"');
    $enqueue_css[] = array('url' => $addons['wp-url'] . '/wp-includes/css/dist/block-library/theme.min.css');
    $db->addEnqueues('styles', $enqueue_css);

    $pipe_translate = '';
    if ($addons['multiple-language'] == true)
    {
        $pipe_translate = '| translate ';
    }

    // TODO: PROJECT
    $new_project = $current_app['apps'];
    $new_project['ionic-storage'] = true;
    $new_project['statusbar']['style'] = 'lightcontent';
    $new_project['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $new_project['pref-orientation'] = 'portrait';
    $db->saveProject($new_project);

    // TODO: MENU
    $newMenu['side'] = 'start';
    $newMenu['type'] = 'overlay';
    $newMenu['ion-header'] = 'expanded-header';
    $newMenu['color-header'] = $addons['page-header-color'];
    $newMenu['text-header'] = $current_app['apps']['app-name'];
    $newMenu['text-subheader'] = $current_app['apps']['app-description'];
    $newMenu['expanded-background'] = 'assets/images/background/expanded-menu.png';
    $color_icon_left = $addons['page-header-color'];
    $color_label = 'dark';
    $z = 0;
    $newMenu['items'][$z]["type"] = "title";
    $newMenu['items'][$z]["label"] = $addons['label-dashboard'];
    $newMenu['items'][$z]["var"] = "dashboard";
    $newMenu['items'][$z]["page"] = "home";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-home'];
    $newMenu['items'][$z]["var"] = "home";
    $newMenu['items'][$z]["page"] = "home";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-posts'];
    $newMenu['items'][$z]["var"] = "posts-by-categories";
    $newMenu['items'][$z]["page"] = "posts-by-categories";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "newspaper";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-categories'];
    $newMenu['items'][$z]["var"] = "categories";
    $newMenu['items'][$z]["page"] = "categories";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "trail-sign-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-bookmarks'];
    $newMenu['items'][$z]["var"] = "bookmarks";
    $newMenu['items'][$z]["page"] = "bookmarks";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "bookmark-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    if ($addons['menu-users'] == true)
    {
        $z++;
        $newMenu['items'][$z]["type"] = "inlink";
        $newMenu['items'][$z]["label"] = $addons['label-users'];
        $newMenu['items'][$z]["var"] = "users";
        $newMenu['items'][$z]["page"] = "users";
        $newMenu['items'][$z]["value"] = "";
        $newMenu['items'][$z]["desc"] = "";
        $newMenu['items'][$z]["color-label"] = $color_label;
        $newMenu['items'][$z]["icon-left"] = "people";
        $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
        $newMenu['items'][$z]["icon-right"] = "";
        $newMenu['items'][$z]["color-icon-right"] = "default";
    }

    $z++;
    $newMenu['items'][$z]["type"] = "title";
    $newMenu['items'][$z]["label"] = $addons['label-help'];
    $newMenu['items'][$z]["var"] = "help";
    $newMenu['items'][$z]["page"] = "";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "help-circle";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "playstore";
    $newMenu['items'][$z]["label"] = $addons['label-rate-this-app'];
    $newMenu['items'][$z]["var"] = "rate_this_app";
    $newMenu['items'][$z]["page"] = "";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "logo-google-playstore";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-privacy-policy'];
    $newMenu['items'][$z]["var"] = "privacy-policy";
    $newMenu['items'][$z]["page"] = "privacy-policy";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "help-circle";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-about-us'];
    $newMenu['items'][$z]["var"] = "about-us";
    $newMenu['items'][$z]["page"] = "about-us";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "nuclear";
    $newMenu['items'][$z]["color-icon-left"] = $newMenu['color-header'];
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $db->saveMenu($newMenu);

    // TODO: POPOVERS
    $popovers = null;
    $popovers['icon'] = 'ellipsis-vertical';
    $popovers['title'] = '';
    $popovers['color'] = $newMenu['color-header'];
    $popovers['background'] = 'light';

    $v = 0;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-privacy-policy'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = 'privacy-policy';

    $v++;
    $popovers['items'][$v]['type'] = 'dark-mode';
    $popovers['items'][$v]['label'] = $addons['label-dark-mode'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = '';

    $v++;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-about-us'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = 'about-us';

    $v++;
    $popovers['items'][$v]['type'] = 'systembrowser';
    $popovers['items'][$v]['label'] = $addons['label-administrator'];
    $popovers['items'][$v]['value'] = $wp_url . '/wp-admin/';
    $popovers['items'][$v]['page'] = '';


    if ($addons['multiple-language'] == true)
    {
        $v++;
        $popovers['items'][$v]['type'] = 'language';
        $popovers['items'][$v]['label'] = $addons['label-select-language'];
        $popovers['items'][$v]['value'] = 'language';
        $popovers['items'][$v]['page'] = '';
    }


    $db->savePopover($popovers);

    if ($addons['auto-menu'] == true)
    {
        // TODO: GLOBALS
        $global['name'] = 'core';
        $global['note'] = 'update menu';
        $global['modules'][0]['enable'] = true;
        $global['modules'][0]['class'] = 'Observable';
        $global['modules'][0]['var'] = '';
        $global['modules'][0]['path'] = 'rxjs';
        $global['modules'][1]['enable'] = true;
        $global['modules'][1]['class'] = 'CategoriesService';
        $global['modules'][1]['var'] = 'categoriesService';
        $global['modules'][1]['path'] = './services/categories/categories.service';
        $global['modules'][1]['cordova'] = '';
        $global['component'][0]['code']['init'] = "\t\t" . 'this.updateMenu();';
        $global['component'][0]['code']['other'] = null;
        $global['component'][0]['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':updateMenu()' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . 'public updateMenu(){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus = [];' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.categories = this.categoriesService.getCategories({per_page:100,parent:0});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'this.dataCategories = data ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '(err)=>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.error(err);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '()=>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.updateCategories();' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':updateCategories()' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . 'private updateCategories(){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'let idx : number = 0 ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"title","item_icon_left":"home","item_label" : "' . htmlentities($addons['label-dashboard']) . '" , "item_link" : "" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"home","item_label" : "' . htmlentities($addons['label-home']) . '" , "item_link" : "/home" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"newspaper","item_label" : "' . htmlentities($addons['label-posts']) . '" , "item_link" : "/posts-by-categories/" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"trail-sign-outline","item_label" : "' . htmlentities($addons['label-categories']) . '" , "item_link" : "/categories/" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'for (let item of this.dataCategories){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"caret-forward-sharp","item_label" : `${item.name}`,"item_badge" : `${item.count}` , "item_link" : "/posts-by-categories/" + item.id } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"bookmark-outline","item_label" : "' . htmlentities($addons['label-bookmarks']) . '" , "item_link" : "/bookmarks/" } ;' . "\r\n";

        if ($addons['menu-users'] == true)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"people","item_label" : "' . htmlentities($addons['label-users']) . '" , "item_link" : "/users/" } ;' . "\r\n";
        }

        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"title","item_icon_left":"bulb","item_label" : "' . htmlentities($addons['label-help']) . '" , "item_link" : "" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"playstore","item_icon_left":"logo-google-playstore","item_label" : "' . htmlentities($addons['label-rate-this-app']) . '" , "item_link" : "" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"lock-closed-outline","item_label" : "' . htmlentities($addons['label-privacy-policy']) . '" , "item_link" : "/privacy-policy/" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.appMenus[idx] = {"item_color_icon_left": "' . $color_icon_left . '","item_type":"inlink","item_icon_left":"nuclear","item_label" : "' . htmlentities($addons['label-about-us']) . '" , "item_link" : "/about-us/" } ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'idx++;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
        $db->saveGlobal('wordpress', $global);
    } else
    {
        $db->deleteGlobal('wordpress', 'core');
    }
    // TODO: -----------------------------------
    // TODO: SERVICE --|-- USERS
    $service['name'] = 'users';
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get wordpress users data';
    // TODO: SERVICE --|-- USERS --|-- MODULES
    $z = 0;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpClient';
    $service['modules']['angular'][$z]['var'] = 'httpClient';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'Observable';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'throwError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'of';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'map';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'catchError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'retry';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'LoadingController';
    $service['modules']['angular'][$z]['var'] = 'loadingController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'ToastController';
    $service['modules']['angular'][$z]['var'] = 'toastController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'AlertController';
    $service['modules']['angular'][$z]['var'] = 'alertController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: SERVICE --|-- USERS --|-- CODE
    // TODO: SERVICE --|-- USERS --|-- CODE --|--- OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* UsersService:getUsers()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getUsers(): Observable<any>{' . "\r\n";

    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = this.translateService.instant(`' . $addons['label-connection-lost'] . '`);' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    }


    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(this.translateService.instant(`' . $addons['label-please-wait'] . '`));' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-please-wait'] . '`);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/users/?per_page=100`)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:","users",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully");' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("Handling error:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-users'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("caught rethrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* UsersService:presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading(message: string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* UsersService:dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* UsersService:showToast(string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* UsersService:showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, 'users');
    // TODO: -----------------------------------
    // TODO: SERVICE --|-- CATEGORIES
    $service['name'] = 'categories';
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get wordpress categories data';
    // TODO: SERVICE --|-- CATEGORIES --|-- MODULES
    $z = 0;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpClient';
    $service['modules']['angular'][$z]['var'] = 'httpClient';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'Observable';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'throwError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'of';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'map';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'catchError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'retry';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'LoadingController';
    $service['modules']['angular'][$z]['var'] = 'loadingController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'ToastController';
    $service['modules']['angular'][$z]['var'] = 'toastController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'AlertController';
    $service['modules']['angular'][$z]['var'] = 'alertController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: SERVICE --|-- CATEGORIES --|-- CODE
    // TODO: SERVICE --|-- CATEGORIES --|-- CODE --|--- OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: SERVICE --|-- CATEGORIES --|-- CODE --|--- OTHER --|-- getCategories()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* CategoriesService:getCategories(query)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getCategories(query): Observable<any>{' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = this.translateService.instant(`' . $addons['label-connection-lost'] . '`);' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    }

    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(this.translateService.instant(`' . $addons['label-please-wait'] . '`));' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-please-wait'] . '`);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/categories?${param}`)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:","categories",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully");' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("Handling error:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-categories'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("caught rethrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* CategoriesService:httpBuildQuery(obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private httpBuildQuery(obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let k, str;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'str = [];' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'for (k in obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'str.push(encodeURIComponent(k) + "=" + encodeURIComponent(obj[k]));' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return str.join("&");' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* CategoriesService:presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading(message:string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* CategoriesService:dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* CategoriesService:showToast()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* CategoriesService:showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, 'categories');
    // TODO: -----------------------------------
    // TODO: SERVICE --|-- TAGS
    $service['name'] = 'tags';
    $service['instruction'] = '-';
    $service['desc'] = 'This service is to get wordpress tags data';
    // TODO: SERVICE --|-- TAGS --|-- MODULES
    $z = 0;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpClient';
    $service['modules']['angular'][$z]['var'] = 'httpClient';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'Observable';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'throwError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'of';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'map';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'catchError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'retry';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'LoadingController';
    $service['modules']['angular'][$z]['var'] = 'loadingController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'ToastController';
    $service['modules']['angular'][$z]['var'] = 'toastController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'AlertController';
    $service['modules']['angular'][$z]['var'] = 'alertController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    // TODO: SERVICE --|-- TAGS --|-- CODE
    // TODO: SERVICE --|-- TAGS --|-- CODE --|--- OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TAGS --|-- CODE --|--- OTHER --|-- getTags()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* TagsService:getTags()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getTags(): Observable<any>{' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = this.translateService.instant(`' . $addons['label-connection-lost'] . '`);' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    }
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(this.translateService.instant(`' . $addons['label-please-wait'] . '`));' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-please-wait'] . '`);' . "\r\n";
    }

    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/tags?per_page=100`)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:","tags",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully");' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("Handling error:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-tags'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//console.log("caught rethrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TAGS --|-- CODE --|--- OTHER --|-- presentLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* TagsService:presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading(message:string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TAGS --|-- CODE --|--- OTHER --|-- dismissLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* TagsService:dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TAGS --|-- CODE --|--- OTHER --|-- showToast()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* TagsService:showToast()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE --|-- TAGS --|-- CODE --|--- OTHER --|-- showAlert()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* TagsService:showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, 'tags');
    function savePage($filterBy)
    {
        global $pipe_translate;
        global $addons;
        global $db;
        // TODO: -----------------------------------
        // create properties for page
        // TODO: PAGE LISTING
        $newPage = null;
        $newPage['title'] = '{{"' . $addons['label-posts'] . '"' . $pipe_translate . ' }}';
        $newPage['name'] = 'posts-by-' . $filterBy;
        $newPage['var'] = 'posts-by-' . $filterBy;
        $newPage['header']['color'] = $addons['page-header-color'];
        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['page-content-background'];
        $newPage['statusbar']['style'] = 'lightcontent';
        $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
        // TODO: PAGE LISTING --|-- HTML
        $newPage['code-by'] = 'wordpress';
        $newPage['icon-left'] = 'menu';
        $newPage['icon-right'] = '';
        $newPage['back-button'] = '/auto';
        $newPage['param'] = 'data_id';

        $newPage['header']['mid']['items'][0]['label'] = '';
        $newPage['header']['mid']['items'][0]['value'] = '';
        $newPage['header']['mid']['items'][1]['label'] = '';
        $newPage['header']['mid']['items'][1]['value'] = '';
        $newPage['header']['mid']['items'][2]['label'] = '';
        $newPage['header']['mid']['items'][2]['value'] = '';
        // TODO: PAGE LISTING --|-- CUSTOM-SEARCH
        $newPage['header']['mid']['type'] = 'custom-header';
        $newPage['header']['mid']['search-label'] = $addons['label-search'];
        $newPage['header']['mid']['custom-code'] = null;
        $newPage['header']['mid']['custom-code'] .= "" . '' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "" . '<ion-header page-posts-by-author-header class="page-posts-by-author-header">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="start">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-menu-button></ion-menu-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-back-button></ion-back-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-title>{{"' . $addons['label-posts'] . '"| translate  }}</ion-title>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button (click)="showPopover($event)"><ion-icon name="ellipsis-vertical"></ion-icon></ion-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar app-searchbar color="' . $addons['page-header-color'] . '">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-searchbar placeholder="" [(ngModel)]="filterQuery" ></ion-searchbar>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button fill="outline" (click)="filterItems()">{{ \'' . $addons['label-search'] . '\' | translate }}</ion-button>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
        $newPage['header']['mid']['custom-code'] .= "" . '</ion-header>' . "\r\n";


        // TODO: PAGE LISTING --|-- MODULES
        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'PostsService';
        $newPage['modules']['angular'][$z]['var'] = 'postsService';
        $newPage['modules']['angular'][$z]['path'] = './../../services/posts/posts.service';
        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'CategoriesService';
        $newPage['modules']['angular'][$z]['var'] = 'categoriesService';
        $newPage['modules']['angular'][$z]['path'] = './../../services/categories/categories.service';
        $newPage['content']['html'] = null;
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
        // TODO: PAGE LISTING --|-- HTML --|-- no-result
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataPosts.length == 0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '{{ "' . $addons['label-no-item'] . '"' . $pipe_translate . ' }}' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        switch ($addons['page-posts-layout'])
        {
            case 'showcase':
                // TODO: PAGE LISTING --|-- HTML --|-- content
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '<ion-card *ngFor="let post of dataPosts">' . "\r\n";
                $newPage['content']['html'] .= "\t" . '' . "\r\n";
                switch ($addons['helper'])
                {
                    case 'default':
                        $newPage['content']['html'] .= "\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" [ngStyle]="{\'width\':\'100%\'}"/>' . "\r\n";
                        break;
                    case 'rest-api-helper':
                        $newPage['content']['html'] .= "\t\t" . '<img *ngIf="post.x_featured_media_large" src="{{ post.x_featured_media_large }}" [ngStyle]="{\'width\':\'100%\'}"/>' . "\r\n";
                        break;
                    case 'jetpack':
                        $newPage['content']['html'] .= "\t\t" . '<img *ngIf="post.jetpack_featured_media_url" src="{{ post.jetpack_featured_media_url }}" [ngStyle]="{\'width\':\'100%\'}"/>' . "\r\n";
                        break;
                }
                $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ post.date | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="post.title.rendered"></ion-card-title>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '{{ post.content.rendered | stripTags | readMore:100}}' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

                $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-button slot="end" fill="clear" size="small" color="danger" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '{{ "' . $addons['label-readmore'] . '"' . $pipe_translate . ' }}' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-button>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";


                $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
                break;
            case 'item-list':
                // TODO: PAGE LISTING --|-- HTML --|-- content
                $newPage['content']['html'] .= "\t" . '<ion-list [ngStyle]="{\'margin-top\':\'1em\'}">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-item button *ngFor="let post of dataPosts" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="text-wrap">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h2 [innerHTML]="post.title.rendered"></h2>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h3>{{ post.date | date:\'fullDate\' }}</h3>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                break;
            case 'item-thumbnail':
                // TODO: PAGE LISTING --|-- HTML --|-- content
                $newPage['content']['html'] .= "\t" . '<ion-list [ngStyle]="{\'margin-top\':\'1em\'}">' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-item button *ngFor="let post of dataPosts" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-thumbnail slot="start" >' . "\r\n";
                switch ($addons['helper'])
                {
                    case 'default':
                        $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";
                        $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post[\'_embedded\'] || !post[\'_embedded\'][\'wp:featuredmedia\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                        break;
                    case 'rest-api-helper':
                        $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post.x_featured_media" src="{{ post.x_featured_media }}" />' . "\r\n";
                        $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post.x_featured_media" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                        break;
                    case 'jetpack':
                        $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post.jetpack_featured_media_url" src="{{ post.jetpack_featured_media_url }}" />' . "\r\n";
                        $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post.jetpack_featured_media_url" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                        break;
                }
                $newPage['content']['html'] .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="text-wrap">' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h2 [innerHTML]="post.title.rendered"></h2>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<h3>{{ post.date | date:\'fullDate\' }}</h3>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
                break;
            case 'grid':


                // TODO: PAGE LISTING --|-- HTML --|-- CONTENT --|-- GRID
                $newPage['content']['html'] .= "\t" . '<ion-grid>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let post of dataPosts" >' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
                switch ($addons['helper'])
                {
                    case 'default':
                        $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";
                        $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!post[\'_embedded\'] || !post[\'_embedded\'][\'wp:featuredmedia\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                        break;
                    case 'rest-api-helper':
                        $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="post.x_featured_media" src="{{ post.x_featured_media }}" />' . "\r\n";
                        $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!post.x_featured_media" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                        break;
                    case 'jetpack':
                        $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="post.jetpack_featured_media_url" src="{{ post.jetpack_featured_media_url }}" />' . "\r\n";
                        $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!post.jetpack_featured_media_url" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                        break;
                }
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-title>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-text [innerHTML]="post.title.rendered"></ion-text>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-title>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";

                $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
                $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
                $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";


                break;
        }
        // TODO: PAGE LISTING --|-- HTML --|-- content
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-infinite-scroll (ionInfinite)="loadMore($event)">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-infinite-scroll-content></ion-infinite-scroll-content>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-infinite-scroll>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- SCSS
        $newPage['content']['scss'] = null;
        $newPage['content']['scss'] .= "\t" . '' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-card{' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . '--background:#ffffff;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'opacity:0.9;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'p,li{' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'margin-top: 0;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'margin-bottom: 12px;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'color: #8e9093;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'font-size: 1.4rem;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'blockquote {' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'border-left: 5px solid #ddd;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'margin-left: 0;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'margin-right: 0;' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'padding-left: 1.4em;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'img {' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'height: auto;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-item h2 {' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'font-weight: 500 !important;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-item h3 {' . "\r\n";
        $newPage['content']['scss'] .= "\t\t" . 'color: #777;' . "\r\n";
        $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
        $newPage['content']['scss'] .= "\t" . 'ion-list-header{font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;}' . "\r\n";
        // TODO: PAGE LISTING --|-- TS
        $newPage['code']['other'] = null;
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'filterQuery: string = "";' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'posts: Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'dataPosts: any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'pageNumber: number = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'query = {};' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- getPosts()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* getPosts()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'getPosts(start: boolean){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.updateQuery();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.posts = this.postsService.getPosts(this.query);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.posts.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'let new_data:any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'new_data = data;' . "\r\n";
        if ($addons['search-type'] == 'title')
        {
            $newPage['code']['other'] .= "\t\t\t" . 'if(this.filterQuery != ``){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'new_data = data.filter((newItem) => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'if(newItem.title.rendered){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'return newItem.title.rendered.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        }
        if ($addons['search-type'] == 'content')
        {
            $newPage['code']['other'] .= "\t\t\t" . 'if(this.filterQuery != ``){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . 'new_data = data.filter((newItem) => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'if(newItem.content.rendered){' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'return newItem.content.rendered.toLowerCase().indexOf(this.filterQuery.toLowerCase()) > -1;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        }

        $newPage['code']['other'] .= "\t\t\t" . 'if(start == true){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = new_data ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPosts = this.dataPosts.concat(new_data);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- loadMore()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* loadMore(infiniteScroll)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* @param event $infiniteScroll' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public loadMore(infiniteScroll){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'let pageNumber = this.pageNumber;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'infiniteScroll.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '//infiniteScroll.target.enable = false;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 500);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- updateQuery()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* updateQuery()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public updateQuery(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["page"] = this.pageNumber;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["_embed"] = "true";' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["per_page"] = ' . $addons['page-posts-per-page'] . ' ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.query["search"] = this.filterQuery;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(this.dataId){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.query["' . $filterBy . '"] = this.dataId;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'console.log("parameter",this.query);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- doRefresh()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(false);' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- filterItems()
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* filterItems()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public filterItems(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(true);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- TS --|-- ngOnInit()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.dataPosts = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.pageNumber = 1;' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.getPosts(true);' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= createBadge('posts-by-' . $filterBy);
        $newPage['code']['constructor'] = null;
        $newPage['code']['constructor'] .= "\t\t" . '//badge for bookmarks' . "\r\n";
        $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
        $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
        // TODO: PAGE LISTING --|-- FOOTER
        $newPage['footer'] = tabCode($addons, 'posts-by-' . $filterBy);
        //save page
        $db->SavePage($newPage);
    }
    savePage('categories');
    savePage('tags');
    savePage('author');
    // TODO: -----------------------------------
    // TODO: SERVICE LISTING --|-- POSTS
    $service['name'] = 'Posts';
    $service['desc'] = 'This service is to get wordpress posts data';
    $z = 0;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpClient';
    $service['modules']['angular'][$z]['var'] = 'httpClient';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'Observable';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'throwError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'of';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'map';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'catchError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'retry';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'LoadingController';
    $service['modules']['angular'][$z]['var'] = 'loadingController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'ToastController';
    $service['modules']['angular'][$z]['var'] = 'toastController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'AlertController';
    $service['modules']['angular'][$z]['var'] = 'alertController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
    // TODO: SERVICE LISTING --|-- TS --|-- OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'wpUrl: string = "' . $wp_url . '";' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-connection-lost'] . '`;' . "\r\n";

    // TODO: SERVICE LISTING --|-- TS --|-- getPosts(query)
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:getPosts(query)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getPosts(query): Observable<any>{' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = this.translateService.instant(`' . $addons['label-connection-lost'] . '`);' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    }
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(this.translateService.instant(`' . $addons['label-please-wait'] . '`));' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-please-wait'] . '`);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/' . $page_prefix . '/?${param}&_embed`)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully!");' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("throwError:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-posts'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("reThrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICE LISTING --|-- TS --|-- getPost()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:getPost()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getPost(postId:string): Observable<any>{' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = this.translateService.instant(`' . $addons['label-connection-lost'] . '`);' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.connectionLost = `' . $addons['label-connection-lost'] . '`;' . "\r\n";
    }
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(this.translateService.instant(`' . $addons['label-please-wait'] . '`));' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-please-wait'] . '`);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(this.wpUrl + `/wp-json/wp/v2/' . $page_prefix . '/${postId}?_embed=true`)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:","posts",results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully!");' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("throwError:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-posts'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("reThrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['enable-comment'] == true)
    {
        // TODO: SERVICE LISTING --|-- TS --|-- addComment()
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '* PostsService:addComment(comment)' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'addComment(comment:any): Observable<any>{' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'this.presentLoading(`' . $addons['label-please-wait'] . '`);' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
        $service['code']['other'] .= "\t\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t\t" . '' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(comment);' . "\r\n";
        $service['code']['other'] .= "\t\t" . '//console.log(`comment`,param);' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.wpUrl + `/wp-json/wp/v2/comments/`,this.inputFields(comment), httpOptions)' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("RAW:",results);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . '//this.showToast("Successfully!");' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("Handling error:", err);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-comments'] . '`,this.connectionLost);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("caught rethrown:", err);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
        $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '/**' . "\r\n";
        $service['code']['other'] .= "\t" . '/ PostsServiceService.inputFields($obj)' . "\r\n";
        $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
        $service['code']['other'] .= "\t" . '**/' . "\r\n";
        $service['code']['other'] .= "\t" . 'inputFields(field:any){' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'let inputs = {' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '"post": field.post,' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '"author_email": field.author_email,' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '"author_name": field.author_name,' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '"author_url": field.author_url,' . "\r\n";
        $service['code']['other'] .= "\t\t\t" . '"content": field.content' . "\r\n";
        $service['code']['other'] .= "\t\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t\t" . 'return this.httpBuildQuery(inputs);' . "\r\n";
        $service['code']['other'] .= "\t" . '}' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
        $service['code']['other'] .= "\t" . '' . "\r\n";
    }
    // TODO: SERVICE LISTING --|-- TS --|-- httpBuildQuery()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:httpBuildQuery(obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private httpBuildQuery(obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let k, str;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'str = [];' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'for (k in obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'str.push(encodeURIComponent(k) + "=" + encodeURIComponent(obj[k]));' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return str.join("&");' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading(message:string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:showToast($message)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* PostsService:showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $db->saveService($service, 'posts');
    // TODO: -----------------------------------
    // TODO: PAGE DETAIL
    $newPage = null;
    $newPage['code-by'] = 'wordpress-post';
    $newPage['title'] = '<span *ngIf="dataPost.title" [innerHTML]="dataPost.title.rendered | stripTags | readMore:100"></span>';
    $newPage['name'] = 'post-detail';
    $newPage['var'] = 'post_detail';
    $newPage['icon-left'] = 'menu';
    $newPage['icon-right'] = '';
    $newPage['back-button'] = '/posts-by-categories';
    $newPage['header']['mid']['type'] = 'custom-header';
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['custom-code'] = '';
    $newPage['header']['mid']['custom-code'] .= "" . '<ion-header page-post-detail-header class="page-post-detail-header">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '<ion-toolbar color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="start">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-back-button></ion-back-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-title><span *ngIf="dataPost.title" [innerHTML]="dataPost.title.rendered"></span></ion-title>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '<ion-buttons slot="end">' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t\t" . '<ion-button (click)="showPopover($event)"><ion-icon name="ellipsis-vertical"></ion-icon></ion-button>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t\t" . '</ion-buttons>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "\t" . '</ion-toolbar>' . "\r\n";
    $newPage['header']['mid']['custom-code'] .= "" . '</ion-header>' . "\r\n";
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['header']['mid']['items'][0]['label'] = '';
    $newPage['header']['mid']['items'][0]['value'] = '';
    $newPage['header']['mid']['items'][1]['label'] = '';
    $newPage['header']['mid']['items'][1]['value'] = '';
    $newPage['header']['mid']['items'][2]['label'] = '';
    $newPage['header']['mid']['items'][2]['value'] = '';
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'PostsService';
    $newPage['modules']['angular'][$z]['var'] = 'postsService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/posts/posts.service';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'ToastController';
    $newPage['modules']['angular'][$z]['var'] = 'toastController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['class'] = 'InAppBrowser';
    $newPage['modules']['angular'][$z]['var'] = 'inAppBrowser';
    $newPage['modules']['angular'][$z]['cordova'] = 'cordova-plugin-inappbrowser';
    $newPage['modules']['angular'][$z]['path'] = '@ionic-native/in-app-browser/ngx';
    $newPage['modules']['angular'][$z]['enable'] = true;

    $z++;
    $newPage['modules']['angular'][$z]['class'] = 'HostListener';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/core';
    $newPage['modules']['angular'][$z]['enable'] = true;


    $newPage['param'] = 'post_id';
    // TODO: PAGE DETAIL --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!-- post-detail -->' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-posts'] . '"' . $pipe_translate . ' }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

    $previewAnyFile = 'imageZoom';
    if (isset($current_app['directives']['preview-any-file']['var']))
    {
        //    $previewAnyFile = 'previewAnyFile ';
    }

    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataPost" [ngStyle]="{\'margin-top\':\'.5em\'}">' . "\r\n";

    switch ($addons['helper'])
    {
        case 'default':
            $newPage['content']['html'] .= "\t\t" . '<div ' . $previewAnyFile . ' *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'][\'wp:featuredmedia\'] && dataPost[\'_embedded\'][\'wp:featuredmedia\'][0] && dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" image="{{ dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}"><img *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'][\'wp:featuredmedia\'] && dataPost[\'_embedded\'][\'wp:featuredmedia\'][0] && dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ dataPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" [ngStyle]="{\'width\':\'100%\'}"/></div>' .
                "\r\n";
            break;
        case 'rest-api-helper':
            $newPage['content']['html'] .= "\t\t" . '<div ' . $previewAnyFile . ' *ngIf="dataPost.x_featured_media_large" image="{{ dataPost.x_featured_media_large }}"><img *ngIf="dataPost.x_featured_media_large" src="{{ dataPost.x_featured_media_large }}" [ngStyle]="{\'width\':\'100%\'}"/></div>' . "\r\n";
            break;
        case 'jetpack':
            $newPage['content']['html'] .= "\t\t" . '<div ' . $previewAnyFile . ' *ngIf="dataPost.jetpack_featured_media_url" image="{{ dataPost.jetpack_featured_media_url }}"><img *ngIf="dataPost.jetpack_featured_media_url" src="{{ dataPost.jetpack_featured_media_url }}" [ngStyle]="{\'width\':\'100%\'}"/></div>' . "\r\n";
            break;
    }

    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header *ngIf="dataPost.title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{ dataPost.date | date:\'fullDate\' }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="dataPost.title.rendered"></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-header *ngIf="!dataPost.title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'].author && dataPost[\'_embedded\'].author[0]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon name="person" slot="start"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label>{{ dataPost[\'_embedded\'].author[0].name }}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" slot="end" [routerDirection]="\'root\'" [routerLink]="[ \'/\' , \'posts-by-author\' , dataPost[\'_embedded\'].author[0].id ]"><ion-icon name="newspaper"></ion-icon></ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none" *ngIf="dataPost.id">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button color="danger" *ngIf="!bookmark" fill="outline" (click)="addToBookmark()" slot="end">+ <ion-icon name="bookmark-outline"></ion-icon> ' . $addons['label-bookmarks'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button color="danger" *ngIf="bookmark" fill="solid" (click)="removeBookmark()" slot="end"><ion-icon name="bookmark-outline"></ion-icon> ' . $addons['label-bookmarks'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="dataPost.content" [innerHtml]="dataPost.content.rendered | trustHtml"></div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="!dataPost.content">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    // TODO: PAGE DETAIL --|-- HTML --|-- TAGS
    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'][\'wp:term\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<span *ngFor="let terms of dataPost[\'_embedded\'][\'wp:term\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<span *ngIf="terms && terms[0]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<span *ngFor="let term of terms" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text color="primary" *ngIf="term.taxonomy == \'post_tag\'" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'posts-by-tags\',term.id]">#{{ term.name }}&nbsp;</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    // TODO: PAGE DETAIL --|-- HTML --|-- CATEGORIES
    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'][\'wp:term\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<div *ngFor="let terms of dataPost[\'_embedded\'][\'wp:term\']">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<span *ngIf="terms && terms[0]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<span *ngFor="let term of terms" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-chip *ngIf="term.taxonomy == \'category\'" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'posts-by-categories\',term.id]">{{ term.name }}</ion-chip>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<!--./post-detail -->' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- HTML --|-- COMMENT LISTING
    if ($addons['enable-comment'] == true)
    {
        $newPage['content']['html'] .= "\t" . '<!-- comments -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-comments'] . '"' . $pipe_translate . ' }}</ion-text>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataPost[\'_embedded\'] && dataPost[\'_embedded\'][\'replies\']" [ngStyle]="{\'margin-top\':\'.5em\'}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-list *ngIf="dataPost.comment_status==\'open\'">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button fill="clear" (click)="addComment()" slot="end">+&nbsp;<ion-icon name="chatbox-outline"></ion-icon>&nbsp;' . $addons['label-comments'] . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '<ion-list *ngFor="let comments of dataPost[\'_embedded\'][\'replies\']" >' . "\r\n";

        $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="!comments.message">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<div *ngFor="let comment of comments">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-item *ngIf="comment.type == \'comment\'">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<img *ngIf="comment.author_avatar_urls[96]" [src]="comment.author_avatar_urls[96]" />' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-avatar>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<h2 [innerHTML]="comment.author_name"></h2> ' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<h3>{{ comment.date | date }}</h3>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-item lines="none" *ngIf="comment.type == \'comment\'">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<p [innerHTML]="comment.content.rendered"></p>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="comments.message">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item lines="none">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p [innerHTML]="comments.message"></p>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";

        $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";

        $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="!dataPost[\'_embedded\'] || !dataPost[\'_embedded\'][\'replies\']" [ngStyle]="{\'margin-top\':\'.5em\'}">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-list *ngIf="dataPost.comment_status==\'open\'">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button fill="fill" (click)="addComment()" slot="end">+&nbsp;<ion-icon name="chatbox-outline"></ion-icon>&nbsp;' . $addons['label-comments'] . '</ion-button>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-item lines="none">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>{{"' . $addons['label-no-comment'] . '"' . $pipe_translate . ' }}</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<!-- ./comments -->' . "\r\n";
    }
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- HTML --|-- LATEST POSTS
    $newPage['content']['html'] .= "\t" . '<!-- latest-posts -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-latest-posts'] . '"' . $pipe_translate . ' }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides  *ngIf="dataLatestPosts.length != 0" pager="false" [options]="{slidesPerView:3}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide button *ngFor="let latestPost of dataLatestPosts" [ngStyle]="{\'background\':\'transparent\'}"  [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',latestPost.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card [ngStyle]="{\'margin-top\':\'.5em\'}">' . "\r\n";
    switch ($addons['helper'])
    {
        case 'default':
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="latestPost[\'_embedded\'] && latestPost[\'_embedded\'][\'wp:featuredmedia\'] && latestPost[\'_embedded\'][\'wp:featuredmedia\'][0] && latestPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && latestPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ latestPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!latestPost[\'_embedded\'] || !latestPost[\'_embedded\'][\'wp:featuredmedia\'] || !latestPost[\'_embedded\'][\'wp:featuredmedia\'][0] || !latestPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !latestPost[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
            break;
        case 'rest-api-helper':
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="latestPost.x_featured_media_large" src="{{ latestPost.x_featured_media_large }}" />' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!latestPost.x_featured_media_large" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
            break;
        case 'jetpack':
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="latestPost.jetpack_featured_media_url" src="{{ latestPost.jetpack_featured_media_url }}" />' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!latestPost.jetpack_featured_media_url" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
            break;
    }
    $newPage['content']['html'] .= "\t\t\t\t" . '<div class="latestnews-title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<span [innerHTML]="latestPost.title.rendered  | stripTags | readMore:75"></span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataLatestPosts.length == 0" pager="false" [options]="{slidesPerView:3}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let latestPost of [1,2,3,4,5]" [ngStyle]="{\'background\':\'transparent\'}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card [ngStyle]="{\'margin-top\':\'.5em\'}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png"  ></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<div class="latestnews-title">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<span><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></span>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<!-- ./latest-posts -->' . "\r\n";


    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t" . '<!-- social-share -->' . "\r\n";
    $newPage['footer']['code'] .= "\t" . '<ion-fab *ngIf="dataPost.link" vertical="bottom" horizontal="end" slot="fixed">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-fab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-fab-list side="start">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="primary" facebookApp [url]="dataPost.link">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="logo-facebook"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="secondary" *ngIf="dataPost.title.rendered" twitterApp message="{{ dataPost.title.rendered | stripTags }} - {{ dataPost.link }}">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="logo-twitter"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="success" *ngIf="dataPost.title.rendered" whatsappApp message="{{ dataPost.title.rendered | stripTags }} - {{ dataPost.link }}">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="logo-whatsapp"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-fab-button color="danger" *ngIf="dataPost.title.rendered" mailApp emailAddress="change@email.com" emailSubject="hi, read this article" emailMessage="{{ dataPost.title.rendered | stripTags }} - {{ dataPost.link }}">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-icon name="mail-open"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-fab-list>' . "\r\n";
    $newPage['footer']['code'] .= "\t" . '</ion-fab>' . "\r\n";
    $newPage['footer']['code'] .= "\t" . '<!-- ./social-share -->' . "\r\n";
    // TODO: PAGE DETAIL --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "" . "\r\n";
    $newPage['content']['scss'] .= "" . 'ion-card{--background:#ffffff;opacity:0.9;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;}' . "\r\n";
    $newPage['content']['scss'] .= "" . '.latestnews-title{padding: 6px; font-size: 12px;}' . "\r\n";


    // TODO: PAGE DETAIL --|-- TS
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'post: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataPost: any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'bookmark:any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'latestPosts: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataLatestPosts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- showLatestPosts()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:showLatestPosts()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public showLatestPosts(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:5};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.latestPosts = this.postsService.getPosts(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.latestPosts.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataLatestPosts = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- getPost()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:getPost(postId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getPost(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.post = this.postsService.getPost(this.postId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.post.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataPost = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPost = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPost();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataLatestPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showLatestPosts();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- getItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:getItem(table:string,key:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async getItem(table:string,key:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.get(`${table}:${key}`).then((val) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.bookmark = val;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- setItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:setItem(table:string,key:string,val:any)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async setItem(table:string,key:string,value:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return await this.storage.set(`${table}:${key}`,value);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- removeItem()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:removeItem(table:string,key:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async removeItem(table:string,key:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return await this.storage.remove(`${table}:${key}`);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- addToBookmark()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:addToBookmark()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'addToBookmark(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let key = this.dataPost.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let val = this.dataPost;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.setItem(`bookmarks`,key,val);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- removeWhitelist()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:removeBookmark()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'removeBookmark(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let key = this.dataPost.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.removeItem(`bookmarks`,key);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage.showToast($message)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'color: "' . $addons['page-header-color'] . '",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- isBookmark()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:isBookmark()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'runBookmark:any ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'isBookmark(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setInterval(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let key = this.dataPost.id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.getItem(`bookmarks`,key);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//console.log("bookmarks",this.bookmark);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:ionViewDidLeave()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ionViewDidLeave(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'clearInterval(this.runBookmark);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['enable-comment'] == true)
    {
        // TODO: PAGE DETAIL --|-- TS --|-- addComment()
        $newPage['code']['other'] .= "\t" . 'newComment: Observable<any>;' . "\r\n";
        //$newPage['code']['other'] .= "\t" . 'dataNewComment: any = {};' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* PostDetailPage:addComment()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public addComment(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(this.dataPost){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'this.commentDialog();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        // TODO: PAGE DETAIL --|-- TS --|-- commentDialog()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* PostDetailPage.commentDialog()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async commentDialog(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'header: `' . $addons['label-comments'] . '`,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'subHeader: "",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'message: this.dataPost.title.rendered,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'inputs:[' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "author_email",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "author_email",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "email",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "your@domain.com"' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "author_name",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "author_name",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "text",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "Ahmed"' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "author_url",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "author_url",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "url",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: "https://ihsana.com/"' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'name: "content",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'id: "content",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'type: "textarea",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'value: "",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'placeholder: ""' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '],' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'buttons:[' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: "Cancel",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'role: "cancel",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'cssClass: "secondary",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: () => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("Confirm Cancel");' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '},' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: "Ok",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: (form_input) => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'let comment = {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'post: this.dataPost.id,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'author_email: form_input.author_email,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'author_name: form_input.author_name,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'author_url: form_input.author_url,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'content: form_input.content' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.newComment = this.postsService.addComment(comment);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.newComment.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . 'if( data.status && (data.status == `hold` )){;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'this.showAlert(`' . $addons['label-comments'] . '`,null,`' . $addons['label-comment-pending'] . '`);' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . ']' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
    }
    // TODO: PAGE DETAIL --|-- TS --|-- showAlert()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage.showAlert()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE DETAIL --|-- TS --|-- HostListener
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HostListener' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '@HostListener("click", ["$event"]) onClick(e){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(e.target.href && e.target.target){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if((e.target.target == `_blank`) || (e.target.target == `_system`)){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'let href = e.target.href;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.inAppBrowser.create(href,"_system");' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: PAGE DETAIL --|-- TS --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* PostDetailPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataPost = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getPost();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataLatestPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showLatestPosts();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//is bookmark?' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.isBookmark();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    //save page
    $db->SavePage($newPage);
    // TODO: -----------------------------------
    // TODO: PAGE HOME
    $newPage = null;
    $newPage['title'] = '{{ "' . $addons['label-home'] . '"' . $pipe_translate . ' }}';
    $newPage['name'] = 'home';
    $newPage['code-by'] = 'wordpress';
    $newPage['icon-left'] = 'home';
    $newPage['icon-right'] = '';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    //$newPage['content']['background'] = $addons['page-content-background'];
    $newPage['content']['enable-fullscreen'] = true;
    //$newPage['content']['enable-padding'] = true;
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: PAGE HOME --|-- MODULES
    $x = 0;
    $newPage['modules']['angular'][$x]['enable'] = true;
    $newPage['modules']['angular'][$x]['class'] = 'Observable';
    $newPage['modules']['angular'][$x]['var'] = '';
    $newPage['modules']['angular'][$x]['path'] = 'rxjs';
    $x++;
    $newPage['modules']['angular'][$x]['enable'] = true;
    $newPage['modules']['angular'][$x]['class'] = 'CategoriesService';
    $newPage['modules']['angular'][$x]['var'] = 'categoriesService';
    $newPage['modules']['angular'][$x]['path'] = './../../services/categories/categories.service';
    $x++;
    $newPage['modules']['angular'][$x]['enable'] = true;
    $newPage['modules']['angular'][$x]['class'] = 'TagsService';
    $newPage['modules']['angular'][$x]['var'] = 'tagsService';
    $newPage['modules']['angular'][$x]['path'] = './../../services/tags/tags.service';
    $x++;
    $newPage['modules']['angular'][$x]['enable'] = true;
    $newPage['modules']['angular'][$x]['class'] = 'PostsService';
    $newPage['modules']['angular'][$x]['var'] = 'postsService';
    $newPage['modules']['angular'][$x]['path'] = './../../services/posts/posts.service';
    // TODO: PAGE HOME --|--  HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: PAGE HOME --|--  HTML --|-- REFRESHER
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: PAGE HOME --|--  HTML --|-- SLIDE
    switch ($addons['home-slider'])
    {
        case 'sticky-posts':


            // TODO: PAGE HOME --|--  HTML --|-- SLIDE-STICKY
            $newPage['content']['html'] .= "\t" . '<!-- sticky-posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataStickyPosts.length != 0" class="stickypost-slides" pager="false" [options]="slideOption">' . "\r\n";

            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let post of dataStickyPosts" [ngStyle]="{\'background-image\':\'url(\' + post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'].source_url + \')\'}"  >' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let post of dataStickyPosts" [ngStyle]="{\'background-image\':\'url(\' + post.x_featured_media + \')\'}"  >' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let post of dataStickyPosts" [ngStyle]="{\'background-image\':\'url(\' + post.jetpack_featured_media_url + \')\'}"  >' . "\r\n";
                    break;
            }


            $newPage['content']['html'] .= "\t\t\t" . '<div class="slidepost-container ' . $addons['ratio-slider'] . '">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<div class="slidepost-content">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<div class="slidepost-text" routerDirection="forward" [routerLink]="[\'/\',\'post-detail\',post.id]" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<div class="slidepost-textbox">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<h2 [innerHTML]="post.title.rendered"></h2>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-button fill="clear" icon="end" color="primary" routerDirection="forward" [routerLink]="[\'/\',\'post-detail\',post.id]" >' . $addons['label-readmore'] . ' <ion-icon name="arrow-forward"></ion-icon></ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";


            $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataStickyPosts.length ==0" class="stickypost-slides" pager="false" [options]="slideOption">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let x of [1,2,3]" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-800x600.png\\\')\'}"  >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<div class="slidepost-container ' . $addons['ratio-slider'] . '">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<div class="slidepost-content">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<div class="slidepost-text">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<h2><ion-skeleton-text animated style="width: 100%; height:24px"></ion-skeleton-text></h2>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="clear" icon="end" color="primary" ><ion-skeleton-text animated style="width: 150px; height:28px"></ion-skeleton-text></ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./sticky-posts -->' . "\r\n";
            break;
        case 'latest-posts':
            // TODO: PAGE HOME --|--  HTML --|-- SLIDE-LATEST-POST
            $newPage['content']['html'] .= "\t" . '<!-- latest-posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataSlidePosts.length != 0" class="stickypost-slides" pager="false" [options]="slideOption">' . "\r\n";
            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let post of dataSlidePosts" [ngStyle]="{\'background-image\':\'url(\' + post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'].source_url + \')\'}"  >' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let post of dataSlidePosts" [ngStyle]="{\'background-image\':\'url(\' + post.x_featured_media + \')\'}"  >' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let post of dataSlidePosts" [ngStyle]="{\'background-image\':\'url(\' + post.jetpack_featured_media_url + \')\'}"  >' . "\r\n";
                    break;
            }

            $newPage['content']['html'] .= "\t\t\t" . '<div class="slidepost-container ' . $addons['ratio-slider'] . '">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<div class="slidepost-content">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<div class="slidepost-text">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<div class="slidepost-textbox">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<h2 [innerHTML]="post.title.rendered"></h2>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-button fill="clear" icon="end" color="primary" routerDirection="forward" [routerLink]="[\'/\',\'post-detail\',post.id]" >' . $addons['label-readmore'] . ' <ion-icon name="arrow-forward"></ion-icon></ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataSlidePosts.length == 0" class="stickypost-slides" pager="false" [options]="slideOption">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-slide class="slidepost-slide" *ngFor="let x of [1,2,3]" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-800x600.png\\\')\'}"  >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<div class="slidepost-container ' . $addons['ratio-slider'] . '">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<div class="slidepost-content">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<div class="slidepost-text">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<h2><ion-skeleton-text animated style="width: 100%; height:24px"></ion-skeleton-text></h2>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="clear" icon="end" color="primary" ><ion-skeleton-text animated style="width: 150px; height:28px"></ion-skeleton-text></ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./latest-posts -->' . "\r\n";

            break;
    }


    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: PAGE HOME --|--  HTML --|-- CATEGORIES
    $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-categories'] . '" ' . $pipe_translate . ' }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
    switch ($addons['page-home-layout-categories'])
    {
        case 'chip':
            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataCategories.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<p class="categories">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-chip outline="true" *ngFor="let catg of dataCategories" [color]="catg.color" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'posts-by-categories\',catg.id]" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label [innerHTML]="catg.name"></ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="chevron-forward-circle"></ion-icon>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</p>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataCategories.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<p class="categories">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-chip outline="true" *ngFor="let x of [1,2,3]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label><ion-skeleton-text animated style="width: 100px"></ion-skeleton-text></ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-chip>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</p>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            break;

        case 'grid':
            $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="dataCategories.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let catg of dataCategories">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card color="{{ catg.color }}" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'posts-by-categories\',catg.id]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="catg.name" [innerHTML]="catg.name"></ion-card-title>' . "\r\n";
            if ($addons['page-home-show-number-posts-categories'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle *ngIf="catg.count"><ion-text>{{ catg.count }} ' . $addons['label-posts'] . '</ion-text></ion-card-subtitle>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
            if ($addons['page-home-show-description-categories'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p *ngIf="catg.description" [innerHTML]="catg.description"></p>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-content>' . "\r\n";
            }

            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataCategories.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let catg of [1,2,3,4]" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 70%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
            break;
    }
    $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    // TODO: PAGE HOME --|--  HTML --|-- LATEST POST

    switch ($addons['latest-posts-layout-for-home'])
    {
        case 'item-thumbnail':

            $newPage['content']['html'] .= "\t" . '<!-- latest posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-latest-posts'] . '" ' . $pipe_translate . ' }}</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataLatestPosts.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let post of dataLatestPosts" routerDirection="forward" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'thumbnail\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'thumbnail\'].source_url }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post[\'_embedded\'] || !post[\'_embedded\'][\'wp:featuredmedia\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'thumbnail\']" src="assets/images/placeholder-480x480.png"/>' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post.x_featured_media" src="{{ post.x_featured_media }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post.x_featured_media" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post.jetpack_featured_media_url" src="{{ post.jetpack_featured_media_url }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post.jetpack_featured_media_url" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
                    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text *ngIf="!post.jetpack_featured_media_url" animated></ion-skeleton-text>' . "\r\n";
                    break;
            }
            $newPage['content']['html'] .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<h3 [innerHTML]="post.title.rendered"></h3>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{ post.content.rendered | stripTags | readMore:140}}</p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{ post.modified  | timeAgo }}</p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataLatestPosts.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let x of [1,2,3,4,5]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-thumbnail>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<h3><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></h3>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 50%"></ion-skeleton-text></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./latest posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            break;
        case 'showcase':


            $newPage['content']['html'] .= "\t" . '<!-- latest posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-latest-posts'] . '" ' . $pipe_translate . ' }}</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataLatestPosts.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let post of dataLatestPosts" routerDirection="forward" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";

            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'].source_url }}" />' . "\r\n";
                    //$newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post[\'_embedded\'] || !post[\'_embedded\'][\'wp:featuredmedia\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\']" src="assets/images/placeholder-480x480.png"/>' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post.x_featured_media" src="{{ post.x_featured_media }}" />' . "\r\n";
                    //$newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post.x_featured_media" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="post.jetpack_featured_media_url" src="{{ post.jetpack_featured_media_url }}" />' . "\r\n";
                    //$newPage['content']['html'] .= "\t\t\t\t" . '<img *ngIf="!post.jetpack_featured_media_url" src="assets/images/placeholder-480x480.png"  />' . "\r\n";
                    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text *ngIf="!post.jetpack_featured_media_url" animated></ion-skeleton-text>' . "\r\n";
                    break;
            }

            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle>{{ post.modified  | timeAgo }}</ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title [innerHTML]="post.title.rendered"></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{ post.content.rendered | stripTags | readMore:140}}</p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button slot="end" fill="clear" size="small" color="danger" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '' . $addons['label-readmore'] . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataLatestPosts.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let x of [1,2,3,4,5]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 50%"></ion-skeleton-text></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<h3><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></h3>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./latest posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";

            break;
        case 'grid':
            $newPage['content']['html'] .= "\t" . '<!-- latest posts -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-latest-posts'] . '" ' . $pipe_translate . ' }}</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<ion-grid>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let post of dataLatestPosts" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'post-detail\',post.id]">' . "\r\n";
            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="post[\'_embedded\'] && post[\'_embedded\'][\'wp:featuredmedia\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!post[\'_embedded\'] || !post[\'_embedded\'][\'wp:featuredmedia\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] || !post[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="post.x_featured_media" src="{{ post.x_featured_media }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!post.x_featured_media" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="post.jetpack_featured_media_url" src="{{ post.jetpack_featured_media_url }}" />' . "\r\n";
                    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!post.jetpack_featured_media_url" src="assets/images/placeholder-480x480.png" />' . "\r\n";
                    break;
            }
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-text [innerHTML]="post.title.rendered"></ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card-header>' . "\r\n";

            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";

            break;
    }


    if ($addons['home-tags'] == true)
    {
        // TODO: PAGE HOME --|--  HTML --|-- HASTAGS
        $newPage['content']['html'] .= "\t" . '<!-- tags -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ "' . $addons['label-tags'] . '" ' . $pipe_translate . ' }}</ion-text>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list class="tags" *ngIf="dataTags.length !=0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-text class="item-tag" *ngFor="let tag of dataTags" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'posts-by-tags\',tag.id]" [color]="tag.color" >#{{ tag.name }}</ion-text>&nbsp;' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<ion-list class="tags" *ngIf="dataTags.length ==0">' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none" >' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t\t" . '<ion-text *ngFor="let x of [1,2]" class="item-tag"><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></ion-text>&nbsp;' . "\r\n";
        $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
        $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
        $newPage['content']['html'] .= "\t" . '<!-- ./tags -->' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
        $newPage['content']['html'] .= "\t" . '' . "\r\n";
    }

    $newPage['content']['html'] .= "\t" . '<br/>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<br/>' . "\r\n";
    // TODO: PAGE HOME --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.slidepost-slide {background-size: cover !important; display: block !important; background-position: center center !important; min-height: 100px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.slidepost-content h2{padding-top:1em;padding-left:1em;padding-right:1em;padding-bottom:0;color: #fff;text-shadow: 1px 1px 1px #777;opacity: .9 !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.slidepost-content .slidepost-textbox{width: 100%;position: absolute; bottom: 12px;padding-left:1em;padding-right:1em;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.slidepost-content p{padding-top:0;padding-left:1em;color: #fff;opacity: .9;padding-right:1em;text-shadow: 1px 1px 1px #777;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.slidepost-content {position:absolute;top: 0;left: 0;bottom: 0;right: 0;};' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.slidepost-text {position: absolute;bottom:0;top:0;left: 0;right: 0;};' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.ratio-1x1 {width: 100%;padding-top: 100%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.ratio-16x9 {width: 100%;padding-top: 56.25%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.ratio-4x3 {width: 100%;padding-top: 75%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.ratio-3x2 {width: 100%;padding-top: 66.66%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.ratio-8x5 {width: 100%;padding-top: 62.5%; position: relative;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.categories {margin-top: 0px !important;padding-right: 1em !important;padding-left: 1em !important;padding-bottom: 0 !important;padding-top: 0 !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.tags{padding-top: 1em !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.item-tag{padding: 0.2em !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;}' . "\r\n";
    // TODO: PAGE HOME --|-- CODE - OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for bookmarks' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['home-tags'] == true)
    {
        $newPage['code']['other'] .= "\t" . 'tags: Observable<any>;' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'dataTags: any = [];' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
    }
    $newPage['code']['other'] .= "\t" . 'latestPosts: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataLatestPosts: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    switch ($addons['home-slider'])
    {
        case 'sticky-posts':
            $newPage['code']['other'] .= "\t" . 'stickyPosts: Observable<any>;' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'dataStickyPosts: any = [];' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            break;
        case 'latest-posts':
            $newPage['code']['other'] .= "\t" . 'slidePosts: Observable<any>;' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'dataSlidePosts: any = [];' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . 'colorName: any = ["primary","secondary","tertiary","success","warning","danger"];' . "\r\n";
    // TODO: PAGE HOME --|-- CODE --|-- OTHER -- slideOption
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'slideOption: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'initialSlide: 0,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'slidesPerView: 1,' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'autoplay:true' . "\r\n";
    $newPage['code']['other'] .= "\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE HOME --|-- CODE --|-- OTHER -- showCategories()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:showCategories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public showCategories(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories = this.categoriesService.getCategories({per_page:100,parent:0});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//this.dataCategories = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let itemId = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let colorId = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataCategories[itemId] = { name:item.name, id:item.id, color: this.colorName[colorId], count:item.count, description:item.description } ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'itemId++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'colorId++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(colorId==5){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'colorId=0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    if ($addons['home-tags'] == true)
    {
        // TODO: PAGE HOME --|-- CODE --|-- OTHER -- showTags()
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* HomePage:showTags()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'public showTags(){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.tags = this.tagsService.getTags();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.tags.subscribe(data => {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '//this.dataTags = data ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'let itemId = 0;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'let colorId = 0;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataTags[itemId] = { name:item.name, id:item.id, color: this.colorName[colorId] } ;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'itemId++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'colorId++;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . 'if(colorId==5){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t\t" . 'colorId=0;' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    }
    // TODO: PAGE HOME --|-- CODE --|-- OTHER -- showLatestPosts()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:showLatestPosts()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public showLatestPosts(){' . "\r\n";

    if ($addons['posts-by-categories-for-home'] == "")
    {
        $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:' . (int)$addons['max-posts-for-home'] . '};' . "\r\n";
    } else
    {
        $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:' . (int)$addons['max-posts-for-home'] . ',categories:`' . $addons['posts-by-categories-for-home'] . '`};' . "\r\n";
    }

    $newPage['code']['other'] .= "\t\t" . 'this.latestPosts = this.postsService.getPosts(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.latestPosts.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataLatestPosts = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    switch ($addons['home-slider'])
    {
        case 'sticky-posts':
            // TODO: PAGE HOME --|-- CODE --|-- OTHER -- showStickyPosts()
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* HomePage:showStickyPosts()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'public showStickyPosts(){' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:10,sticky:true};' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.stickyPosts = this.postsService.getPosts(param);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.stickyPosts.subscribe(data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '//this.dataStickyPosts = data ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'let idx = 0;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";

            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['code']['other'] .= "\t\t\t\t" . 'if( item[\'_embedded\'] && item[\'_embedded\'][\'wp:featuredmedia\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'] ) {' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['code']['other'] .= "\t\t\t\t" . 'if( item[\'x_featured_media\']) {' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['code']['other'] .= "\t\t\t\t" . 'if( item[\'jetpack_featured_media_url\']) {' . "\r\n";
                    break;
            }
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataStickyPosts[idx] = item ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'idx++;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            break;

        case 'latest-posts':
            // TODO: PAGE HOME --|-- CODE --|-- OTHER -- showLatestPosts()
            $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
            $newPage['code']['other'] .= "\t" . '* HomePage:showSlidePosts()' . "\r\n";
            $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
            $newPage['code']['other'] .= "\t" . 'public showSlidePosts(){' . "\r\n";
            if ($addons['slides-by-categories-for-home'] == "")
            {
                $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:10};' . "\r\n";
            } else
            {
                $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:10,categories:`' . $addons['slides-by-categories-for-home'] . '`};' . "\r\n";
            }
            $newPage['code']['other'] .= "\t\t" . 'this.slidePosts = this.postsService.getPosts(param);' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.slidePosts.subscribe(data => {' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '//this.dataSlidePosts = data ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'let idx = 0;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";

            switch ($addons['helper'])
            {
                case 'default':
                    $newPage['code']['other'] .= "\t\t\t\t" . 'if( item[\'_embedded\'] && item[\'_embedded\'][\'wp:featuredmedia\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\']&& item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'large\'] ) {' . "\r\n";
                    break;
                case 'rest-api-helper':
                    $newPage['code']['other'] .= "\t\t\t\t" . 'if( item[\'x_featured_media\']) {' . "\r\n";
                    break;
                case 'jetpack':
                    $newPage['code']['other'] .= "\t\t\t\t" . 'if( item[\'jetpack_featured_media_url\']) {' . "\r\n";
                    break;
            }
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.dataSlidePosts[idx] = item ;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t\t" . 'idx++;' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";


            $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
            $newPage['code']['other'] .= "\t" . '}' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            $newPage['code']['other'] .= "\t" . '' . "\r\n";
            break;
    }
    // TODO: PAGE HOME --|-- CODE --|-- OTHER -- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    if ($addons['home-tags'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . 'this.dataTags = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.showTags();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . 'this.dataLatestPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showLatestPosts();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    switch ($addons['home-slider'])
    {
        case 'sticky-posts':
            $newPage['code']['other'] .= "\t\t" . 'this.dataStickyPosts = [];' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.showStickyPosts();' . "\r\n";
            break;
        case 'latest-posts':
            $newPage['code']['other'] .= "\t\t" . 'this.dataSlidePosts = [];' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.showSlidePosts();' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE HOME --|-- CODE --|-- OTHER -- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    if ($addons['home-tags'] == true)
    {
        $newPage['code']['other'] .= "\t\t" . 'this.dataTags = [];' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.showTags();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t" . 'this.dataLatestPosts = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showLatestPosts();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
    switch ($addons['home-slider'])
    {
        case 'sticky-posts':
            $newPage['code']['other'] .= "\t\t" . 'this.dataStickyPosts = [];' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.showStickyPosts();' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . '' . "\r\n";
            break;
        case 'latest-posts':
            $newPage['code']['other'] .= "\t\t" . 'this.dataSlidePosts = [];' . "\r\n";
            $newPage['code']['other'] .= "\t\t" . 'this.showSlidePosts();' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge('home');
    $newPage['code']['init'] = null;
    $newPage['footer'] = tabCode($addons, 'home');
    //generate page code
    $db->savePage($newPage);
    // TODO: -----------------------------------
    // TODO: PAGE CATEGORIES --|--  HTML
    $newPage = null;
    $newPage['title'] = '{{"' . $addons['label-categories'] . '" ' . $pipe_translate . ' }}';
    $newPage['name'] = 'categories';
    $newPage['code-by'] = 'wordpress';
    $newPage['icon-left'] = 'trail-sign-outline';
    $newPage['icon-right'] = '';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
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
    // TODO: PAGE CATEGORIES --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';
    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = 'CategoriesService';
    $newPage['modules']['angular'][1]['var'] = 'categoriesService';
    $newPage['modules']['angular'][1]['path'] = './../../services/categories/categories.service';
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

    switch ($addons['page-categories-layout'])
    {
        case 'item-list':
            $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
            //$newPage['content']['html'] .= "\t" . '<ion-list-header>' . $addons['label-categories'] . '</ion-list-header>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list inset *ngIf="dataCategories.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item button *ngFor="let catg of dataCategories" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'posts-by-categories\',catg.id]" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<h3 *ngIf="catg.name" [innerHTML]="catg.name"></h3>' . "\r\n";
            if ($addons['page-categories-show-description'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t\t" . '<p *ngIf="catg.description" [innerHTML]="catg.description"></p>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
            if ($addons['page-categories-show-number-posts'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t" . '<ion-badge slot="end" color="' . $addons['page-header-color'] . '">{{ catg.count }}</ion-badge>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-list inset *ngIf="dataCategories.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-item *ngFor="let catg of [1,2,3,4]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="ion-text-wrap">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<h3><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></h3>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></p>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
            break;
        case 'showcase':
            $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataCategories.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card color="{{ catg.color }}" *ngFor="let catg of dataCategories" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'posts-by-categories\',catg.id]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title *ngIf="catg.name" [innerHTML]="catg.name"></ion-card-title>' . "\r\n";
            if ($addons['page-categories-show-number-posts'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle *ngIf="catg.count"><ion-text>{{ catg.count }} ' . $addons['label-posts'] . '</ion-text></ion-card-subtitle>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
            if ($addons['page-categories-show-description'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t" . '<p *ngIf="catg.description" [innerHTML]="catg.description"></p>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataCategories.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let catg of [1,2,3,4]" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 70%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
            break;
        case 'grid':
            $newPage['content']['html'] .= "\t" . '<!-- categories -->' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="dataCategories.length !=0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let catg of dataCategories">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card color="{{ catg.color }}" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'posts-by-categories\',catg.id]">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="catg.name" [innerHTML]="catg.name"></ion-card-title>' . "\r\n";
            if ($addons['page-categories-show-number-posts'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-subtitle *ngIf="catg.count"><ion-text>{{ catg.count }} ' . $addons['label-posts'] . '</ion-text></ion-card-subtitle>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
            if ($addons['page-categories-show-description'] == 'enable')
            {
                $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<p *ngIf="catg.description" [innerHTML]="catg.description"></p>' . "\r\n";
                $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-content>' . "\r\n";
            }
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";


            $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataCategories.length ==0">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let catg of [1,2,3,4]" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 70%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<!-- ./categories -->' . "\r\n";
            break;
    }


    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: PAGE CATEGORIES --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;}' . "\r\n";
    // TODO: PAGE CATEGORIES --|-- CODE - OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for bookmarks' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'colorName: any = ["primary","secondary","tertiary","success","warning","danger"];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':showCategories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public showCategories(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories = this.categoriesService.getCategories({per_page:100});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//this.dataCategories = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let itemId = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let colorId = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataCategories[itemId] = { name:item.name, id:item.id, color: this.colorName[colorId], count:item.count, description:item.description } ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'itemId++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'colorId++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(colorId==5){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'colorId=0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";


    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE CATEGORIES --|-- TS --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE CATEGORIES --|-- PAGE --|-- TS -- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge('categories');
    $newPage['code']['init'] = null;
    $newPage['footer'] = tabCode($addons, 'categories');
    //generate page code
    $db->savePage($newPage);
    // TODO: -----------------------------------
    // TODO: PAGE USERS --|--
    $newPage = null;

    $newPage['title'] = '{{"' . $addons['label-users'] . '" ' . $pipe_translate . ' }}';
    $newPage['name'] = 'users';
    $newPage['code-by'] = 'wordpress';
    $newPage['icon-left'] = 'people';
    $newPage['icon-right'] = '';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
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
    // TODO: PAGE USERS --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';
    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = 'UsersService';
    $newPage['modules']['angular'][1]['var'] = 'usersService';
    $newPage['modules']['angular'][1]['path'] = './../../services/users/users.service';
    // TODO: PAGE USERS --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '<ion-refresher slot="fixed" (ionRefresh)="doRefresh($event)">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<div *ngIf="dataUsers.length !=0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let user of dataUsers">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="user[\'avatar_urls\'] && user[\'avatar_urls\'][96]" src="{{ user[\'avatar_urls\'][96] }}" />' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h2 [innerHTML]="user.name"></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p [innerHTML]="user.slug"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button fill="outline" slot="end" [routerDirection]="\'root\'" [routerLink]="[ \'/\' , \'posts-by-author\' , user.id ]"><ion-icon name="newspaper"></ion-icon></ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<p [innerHTML]="user.description"></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-row no-padding *ngIf="user.url">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button fill="clear" color="danger" icon-start appBrowser [url]="user.url"  >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon name="globe"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . ' Website ' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<div *ngIf="dataUsers.length ==0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let user of [1,2]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="assets/images/placeholder-480x480.png" ></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h2><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></h2>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<p><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";


    // TODO: PAGE USERS --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;}' . "\r\n";
    // TODO: PAGE USERS --|-- CODE - OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'users: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataUsers: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* UsersPage:showUsers()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public showUsers(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.users = this.usersService.getUsers();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.users.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataUsers = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* UsersPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 100);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showUsers();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE USERS --|-- CODE - ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* UsersPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.showUsers();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge('users');
    // TODO: PAGE USERS --|-- FOOTER
    $newPage['footer'] = tabCode($addons, 'users');
    //generate page code
    $db->savePage($newPage);
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: PAGE BOOKMARKS --|--
    $newPage = null;

    $newPage['title'] = '{{"' . $addons['label-bookmarks'] . '" ' . $pipe_translate . ' }}';
    $newPage['name'] = "bookmarks";
    $newPage['code-by'] = 'wordpress';
    $newPage['icon-left'] = 'bookmark-outline';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    // TODO: PAGE BOOKMARKS --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';
    // TODO: PAGE BOOKMARKS --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';
    // TODO: PAGE BOOKMARKS --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list lines="none" class="empty-bookmarks-container" *ngIf="dataBookmarks.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label class="empty-bookmarks-wrapper">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon name="bookmark-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h3>{{ "' . $addons['label-no-bookmarks-found'] . '"' . $pipe_translate . ' }}</h3>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list *ngIf="dataBookmarks.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-list-header>{{ "' . $addons['label-bookmark-list'] . '"' . $pipe_translate . ' }}</ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item-sliding *ngFor="let item of dataBookmarks">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item [routerDirection]="\'root\'" [routerLink]="[\'/\',\'post-detail\',item.id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start">' . "\r\n";
    switch ($addons['helper'])
    {
        case 'default':
            $newPage['content']['html'] .= "\t\t" . '<ion-img *ngIf="item[\'_embedded\'] && item[\'_embedded\'][\'wp:featuredmedia\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'] && item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\']" src="{{ item[\'_embedded\'][\'wp:featuredmedia\'][0][\'media_details\'][\'sizes\'][\'full\'].source_url }}" [ngStyle]="{\'width\':\'100%\'}"></ion-img>' . "\r\n";
            break;
        case 'rest-api-helper':
            $newPage['content']['html'] .= "\t\t" . '<ion-img *ngIf="item.x_featured_media_large" src="{{ item.x_featured_media_large }}" [ngStyle]="{\'width\':\'100%\'}" ></ion-img>' . "\r\n";
            break;
        case 'jetpack':
            $newPage['content']['html'] .= "\t\t" . '<ion-img *ngIf="item.jetpack_featured_media_url" src="{{ item.jetpack_featured_media_url }}" [ngStyle]="{\'width\':\'100%\'}" ></ion-img>' . "\r\n";
            break;
    }
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<h3 *ngIf="item.title.rendered" [innerHTML]="item.title.rendered"></h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-note color="warning" slot="end"><ion-icon name="star-outline"></ion-icon> {{ item.average_rating }}</ion-note>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-options side="end">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-item-option color="danger" (click)="removeBookmark(item.id)">{{ "' . $addons['label-delete'] . '"' . $pipe_translate . ' }}</ion-item-option>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item-sliding>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item lines="none">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" size="default" (click)="clearBookmark()" slot="end" color="danger"><ion-icon name="reload-circle"></ion-icon> {{ "' . $addons['label-clean-up'] . '"' . $pipe_translate . ' }}</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    // TODO: PAGE BOOKMARKS --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '.empty-bookmarks-container{height: 100%;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-bookmarks-wrapper{text-align: center;padding-top: 50%;font-size: 72px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '.empty-bookmarks-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{font-variant: petite-caps;padding-top: 0;padding-bottom:0;font-size: 1.2em;}' . "\r\n";
    // TODO: PAGE BOOKMARKS --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['constructor'] .= "\t\t" . '//badge for bookmarks' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . 'this.createBadge();' . "\r\n";
    $newPage['code']['constructor'] .= "\t\t" . '' . "\r\n";
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataBookmarks : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.setItem(table,key,value)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async getItem(table:string,key:string,value:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return this.storage.get(`${table}:${key}`).then((data)=>{return data})' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.setItem(table,key,value)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public setItem(table:string,key:string,value:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return this.storage.set(`${table}:${key}`,value);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.getItems(table)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'items : any = []; ' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async getItems(table:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.items = []; ' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(iKey.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.pushItem(iValue);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.pushItem(item)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private pushItem(item){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.items.push(item);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.removeItem()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public async removeItem(table:string,key:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'return await this.storage.remove(`${table}:${key}`);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.clearItems(table:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public clearItems(table:string) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(iKey.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storage.remove(`${iKey}`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE BOOKMARKS --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems(`bookmarks`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBookmarks = this.items;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE BOOKMARKS --|-- CODE --|-- OTHER --|-- removeBookmark()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.removeBookmark()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeBookmark(id:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.removeItem(`bookmarks`,id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems(`bookmarks`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBookmarks = this.items;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE BOOKMARKS --|-- CODE --|-- OTHER --|-- clearBookmark()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.clearBookmark()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public clearBookmark(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.clearItems(`bookmarks`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.getItems(`bookmarks`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataBookmarks = this.items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: PAGE BOOKMARKS --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* BookmarksPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems(`bookmarks`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBookmarks = this.items;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= createBadge('bookmarks');
    $newPage['code']['init'] = null;
    // TODO: PAGE BOOKMARKS --|-- FOOTER
    $newPage['footer'] = tabCode($addons, 'bookmarks');
    //generate page code
    $db->savePage($newPage);
    $db->current();
    rebuild();
    //header('Location: ./?p=addons&addons=wordpress&' . time());
}
// TODO: -----------------------------------
$current_setting = $db->getAddOns('wordpress', 'core');
// TODO: INIT
if (!isset($current_setting['wp-url']))
{
    $current_setting['wp-url'] = '';
}

if (!isset($current_setting['page-posts-layout']))
{
    $current_setting['page-posts-layout'] = 'showcase';
}
if (!isset($current_setting['page-posts-per-page']))
{
    $current_setting['page-posts-per-page'] = '10';
}

if (!isset($current_setting['page-categories-show-number-posts']))
{
    $current_setting['page-categories-show-number-posts'] = 'enable';
}


if (!isset($current_setting['page-home-layout-categories']))
{
    $current_setting['page-home-layout-categories'] = 'chip';
}

if (!isset($current_setting['page-home-show-description-categories']))
{
    $current_setting['page-home-show-description-categories'] = 'none';
}

if (!isset($current_setting['page-home-show-number-posts-categories']))
{
    $current_setting['page-home-show-number-posts-categories'] = 'enable';
}


if ($current_setting['wp-url'] != '')
{
    $cat_link = $current_setting['wp-url'] . '/wp-json/wp/v2/categories?per_page=100';
} else
{
    $cat_link = 'https://yourwp/wp-json/wp/v2/categories?per_page=100';
}
if (!isset($current_setting['label-categories']))
{
    $current_setting['label-categories'] = 'Categories';
}
if (!isset($current_setting['label-posts']))
{
    $current_setting['label-posts'] = 'News';
}
if (!isset($current_setting['label-all']))
{
    $current_setting['label-all'] = 'All';
}
if (!isset($current_setting['label-readmore']))
{
    $current_setting['label-readmore'] = 'Readmore';
}
if (!isset($current_setting['label-search']))
{
    $current_setting['label-search'] = 'Search';
}
if (!isset($current_setting['label-dashboard']))
{
    $current_setting['label-dashboard'] = 'Dashboard';
}
if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}
if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = '';
}
if (!isset($current_setting['auto-menu']))
{
    $current_setting['auto-menu'] = false;
}
if (!isset($current_setting['label-help']))
{
    $current_setting['label-help'] = 'Help';
}
if (!isset($current_setting['label-rate-this-app']))
{
    $current_setting['label-rate-this-app'] = 'Rate This App';
}
if (!isset($current_setting['label-privacy-policy']))
{
    $current_setting['label-privacy-policy'] = 'Privacy Policy';
}
if (!isset($current_setting['label-about-us']))
{
    $current_setting['label-about-us'] = 'About Us';
}
if (!isset($current_setting['label-administrator']))
{
    $current_setting['label-administrator'] = 'Administrator';
}
if (!isset($current_setting['label-users']))
{
    $current_setting['label-users'] = 'Team';
}
if (!isset($current_setting['ratio-slider']))
{
    $current_setting['ratio-slider'] = 'ratio-16x9';
}
if (!isset($current_setting['helper']))
{
    $current_setting['helper'] = 'helper';
}
if (!isset($current_setting['label-bookmarks']))
{
    $current_setting['label-bookmarks'] = 'Bookmarks';
}
if (!isset($current_setting['label-no-bookmarks-found']))
{
    $current_setting['label-no-bookmarks-found'] = 'No bookmarks found!';
}
if (!isset($current_setting['label-delete']))
{
    $current_setting['label-delete'] = 'Delete';
}
if (!isset($current_setting['label-clean-up']))
{
    $current_setting['label-clean-up'] = 'Clean Up';
}
if (!isset($current_setting['label-please-wait']))
{
    $current_setting['label-please-wait'] = 'Please wait...!';
}
if (!isset($current_setting['label-home']))
{
    $current_setting['label-home'] = 'Home';
}
if (!isset($current_setting['label-latest-posts']))
{
    $current_setting['label-latest-posts'] = 'Latest News';
}
if (!isset($current_setting['label-bookmark-list']))
{
    $current_setting['label-bookmark-list'] = 'Bookmark List';
}
if (!isset($current_setting['label-sticky-posts']))
{
    $current_setting['label-sticky-posts'] = 'Highlighted';
}
if (!isset($current_setting['label-tags']))
{
    $current_setting['label-tags'] = 'Hashtags';
}
if (!isset($current_setting['enable-comment']))
{
    $current_setting['enable-comment'] = false;
}
if (!isset($current_setting['label-comments']))
{
    $current_setting['label-comments'] = 'Comments';
}
if (!isset($current_setting['label-no-comment']))
{
    $current_setting['label-no-comment'] = 'No comment';
}
if (!isset($current_setting['label-comment-pending']))
{
    $current_setting['label-comment-pending'] = 'Your comment is awaiting moderation';
}
if (!isset($current_setting['label-connection-lost']))
{
    $current_setting['label-connection-lost'] = 'Connection lost, please check your connection!';
}

if (!isset($current_setting['home-slider']))
{
    $current_setting['home-slider'] = '';
}

if (!isset($current_setting['home-tags']))
{
    $current_setting['home-tags'] = false;
}
if (!isset($current_setting['home-users']))
{
    $current_setting['home-users'] = false;
}
if (!isset($current_setting['menu-users']))
{
    $current_setting['menu-users'] = false;
}

if (!isset($current_setting['posts-by-categories-for-home']))
{
    $current_setting['posts-by-categories-for-home'] = '';
}

if (!isset($current_setting['slides-by-categories-for-home']))
{
    $current_setting['slides-by-categories-for-home'] = '';
}

if (!isset($current_setting['max-posts-for-home']))
{
    $current_setting['max-posts-for-home'] = '5';
}

if (!isset($current_setting['latest-posts-layout-for-home']))
{
    $current_setting['latest-posts-layout-for-home'] = 'list';
}

if (!isset($current_setting['label-dark-mode']))
{
    $current_setting['label-dark-mode'] = 'Dark Mode';
}

if (!isset($current_setting['label-select-language']))
{
    $current_setting['label-select-language'] = 'Select Language?';
}


if (!isset($current_setting['multiple-language']))
{
    $current_setting['multiple-language'] = false;
}
if (!isset($current_setting['label-no-item']))
{
    $current_setting['label-no-item'] = 'There are no items';
}

if (!isset($current_setting['search-type']))
{
    $current_setting['search-type'] = 'default';
}


$content .= '<form action="" method="post"><!-- ./form -->';
// TODO: LAYOUT
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
//$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
$content .= '<div class="callout callout-default">' . __e('To display the slider, please upload a <strong>Featured Image</strong> and check <strong>Stick to the top of the blog</strong> on your WordPress') . '</div>';
// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- WP-URL
$content .= '<div class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-wp-url">' . __e('WordPress URL') . '</label>';
$content .= '<input id="page-wp-url" type="text" name="wordpress[wp-url]" class="form-control" placeholder="https://demo.ihsana.net/wordpress/"  value="' . $current_setting['wp-url'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the link of your wordpress site, use ssl.') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div>';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="wordpress[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="wordpress[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
// TODO: LAYOUT --|-- FORM --|-- AUTO-MENU --|-- CHECKBOX
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-auto-menu" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Options') . '</label>';

$content .= '<table class="table">';

$content .= '<tr class="">';
if ($current_setting['auto-menu'] == true)
{
    $content .= '<td style="width:30px;" for="page-auto-menu">';
    $content .= '<input checked="checked" class="flat-red" type="checkbox" id="page-auto-menu" name="wordpress[auto-menu]" ' . $disabled . '/>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '' . __e('Automatically create menus by categories') . '';
    $content .= '</td>';
} else
{
    $content .= '<td style="width:30px;" for="page-auto-menu">';
    $content .= '<input class="flat-red" type="checkbox" id="page-auto-menu" name="wordpress[auto-menu]" ' . $disabled . '/>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '' . __e('Automatically create menus by categories') . '';
    $content .= '</td>';
}
$content .= '</tr>';

$content .= '<tr class="">';
if ($current_setting['enable-comment'] == true)
{
    $content .= '<td for="page-enable-comment">';
    $content .= '<input checked="checked" class="flat-red" type="checkbox" id="page-enable-comment" name="wordpress[enable-comment]" ' . $disabled . '/>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '' . __e('Enable Comments (required: <a target="_blank" href="https://wordpress.org/plugins/rest-api-helper/">REST API Helper</a> for enable anonymous comments)') . '';
    $content .= '</td>';
} else
{
    $content .= '<td for="page-enable-comment">';
    $content .= '<input class="flat-red" type="checkbox" id="page-enable-comment" name="wordpress[enable-comment]" ' . $disabled . '/>';
    $content .= '</td>';
    $content .= '<td>';
    $content .= '' . __e('Enable Comments (required: <a target="_blank" href="https://wordpress.org/plugins/rest-api-helper/">REST API Helper</a> for enable anonymous comments)') . '';
    $content .= '</td>';
}
$content .= '</tr>';


$content .= '<tr>';
if ($current_setting['menu-users'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-menu-users" name="wordpress[menu-users]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-menu-users" name="wordpress[menu-users]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Display <em>Users</em> on the side menu or tab menu') . '</td>';
$content .= '</tr>';

$content .= '<tr>';
if ($current_setting['multiple-language'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-multiple-language" name="wordpress[multiple-language]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-multiple-language" name="wordpress[multiple-language]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Multiple Language Support') . '</td>';
$content .= '</tr>';


$content .= '</table>';


$content .= '</div>';

$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- RATIO-SLIDER --|-- HELPER
$options = array();
$options[] = array('value' => 'default', 'label' => 'WordPress Core (Default)');
$options[] = array('value' => 'rest-api-helper', 'label' => 'REST-API Helper Plugin');
$options[] = array('value' => 'jetpack', 'label' => 'Jetpack');
$content .= '<div id="field-helper" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-helper">' . __e('Helper') . '</label>';
$content .= '<select id="page-helper" name="wordpress[helper]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['helper'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('please try and choose which settings are suitable for your WordPress') . '</p>';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- SEARCH BY
$options = array();
$options[] = array('value' => 'default', 'label' => 'All content (Default)');
$options[] = array('value' => 'title', 'label' => 'Only in the Title');
$options[] = array('value' => 'content', 'label' => 'Only in the Content');

$content .= '<div class="form-group">';
$content .= '<label for="page-search-type">' . __e('Search By') . '</label>';
$content .= '<select id="page-search-type" name="wordpress[search-type]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['search-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('The type of search to use') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

// TODO: -----------------------------------
// TODO: LAYOUT --|-- FORM --|-- HOME --|-- SLIDER-COMPONENT
$content .= '<hr/>';

$content .= '<div class="well">';
$content .= '<h3>' . __e('Home Page') . '</h3>';
// TODO: LAYOUT --|-- FORM --|-- HOME --|-- SLIDER-COMPONENT --|-- SOURCE
$content .= '<h4>' . __e('Slider Component') . '</h4>';
$content .= '<div class="row"><!-- row -->';
$options = array();
$options[] = array('value' => 'sticky-posts', 'label' => 'Only Sticky Posts');
$options[] = array('value' => 'latest-posts', 'label' => 'Posts');

$content .= '<div id="field-home-slider" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-home-slider">' . __e('Source') . '</label>';
$content .= '<select id="page-home-slider" name="wordpress[home-slider]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['home-slider'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please choose the method of taking slider based on what?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- HOME --|-- SLIDER-COMPONENT --|-- POSTS BY CATEGORIES
$content .= '<div id="field-slides-by-categories-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-slides-by-categories-for-home">' . __e('Posts by Categories') . '</label>';
$content .= '<input id="page-slides-by-categories-for-home" type="text" name="wordpress[slides-by-categories-for-home]" class="form-control" placeholder="12,35,66"  value="' . $current_setting['slides-by-categories-for-home'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('slides in what categories will be displayed on the homepage, leave blank if all categories') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- HOME --|-- SLIDER-COMPONENT --|-- RATIO
$options = array();
$options[] = array('value' => 'ratio-1x1', 'label' => 'Ratio 1x1');
$options[] = array('value' => 'ratio-16x9', 'label' => 'Ratio 16x9');
$options[] = array('value' => 'ratio-4x3', 'label' => 'Ratio 4x3');
$options[] = array('value' => 'ratio-3x2', 'label' => 'Ratio 3x2');
$options[] = array('value' => 'ratio-8x5', 'label' => 'Ratio 8x5');

$content .= '<div id="field-ratio-slider" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-ratio-slider">' . __e('Aspect Ratio For Slider') . '</label>';
$content .= '<select id="page-ratio-slider" name="wordpress[ratio-slider]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['ratio-slider'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Required: Posts must have <strong>featured images</strong> and be <strong>sticky</strong>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- HOME --|-- CATEGORIES-COMPONENT --|--
$content .= '<h4>' . __e('Categories Component') . '</h4>';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- HOME --|-- CATEGORIES-COMPONENT --|-- LAYOUT
$item_lists = array();
$item_lists[] = array('value' => 'chip', 'label' => 'Chip');
$item_lists[] = array('value' => 'grid', 'label' => 'Grid');

$content .= '<div class="form-group">';
$content .= '<label for="page-home-layout-categories">' . __e('Layout') . '</label>';
$content .= '<select name="wordpress[page-home-layout-categories]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-home-layout-categories'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Choose a layout for the categories component') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- HOME --|-- CATEGORIES-COMPONENT --|-- NUMBER-OF-POSTS
$content .= '<div class="col-md-4">';
$item_lists = array();
$item_lists[] = array('value' => 'enable', 'label' => 'Enable');
$item_lists[] = array('value' => 'none', 'label' => 'None');
$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Number of posts') . '</label>';
$content .= '<select name="wordpress[page-home-show-number-posts-categories]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-home-show-number-posts-categories'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Show total number of posts') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- HOME --|-- CATEGORIES-COMPONENT --|-- DESCRIPTION
$content .= '<div class="col-md-4">';

$item_lists = array();
$item_lists[] = array('value' => 'none', 'label' => 'None');
$item_lists[] = array('value' => 'enable', 'label' => 'Enable');

$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Description') . '</label>';
$content .= '<select name="wordpress[page-home-show-description-categories]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-home-show-description-categories'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Show category description') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div>';


// TODO: -----------------------------------
// TODO: LAYOUT --|-- FORM --|-- HOME --|-- LATEST-POST-COMPONENT
$content .= '<h4>' . __e('Latest Posts Component') . '</h4>';
$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- HOME --|-- LATEST-POST-COMPONENT --|-- LAYOUT

$options = array();
$options[] = array('value' => 'item-thumbnail', 'label' => 'Item Thumbnail');
$options[] = array('value' => 'showcase', 'label' => 'Showcase');
$options[] = array('value' => 'grid', 'label' => 'Grid');
$content .= '<div id="field-latest-posts-layout-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-latest-posts-layout-for-home">' . __e('Layout') . '</label>';
$content .= '<select id="page-latest-posts-layout-for-home" name="wordpress[latest-posts-layout-for-home]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['latest-posts-layout-for-home'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('What layout will be used?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- HOME --|-- LATEST-POST-COMPONENT --|-- POSTS-BY-CATEGORIES-FOR-HOME
$content .= '<div id="field-posts-by-categories-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-posts-by-categories-for-home">' . __e('Posts By Categories') . '</label>';
$content .= '<input id="page-posts-by-categories-for-home" type="text" name="wordpress[posts-by-categories-for-home]" class="form-control" placeholder="12,35,66"  value="' . $current_setting['posts-by-categories-for-home'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('Posts in what categories will be displayed on the main page, leave blank if all categories') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- HOME --|-- LATEST-POST-COMPONENT --|-- MAX-POSTS
$content .= '<div id="field-max-posts-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-max-posts-for-home">' . __e('Max Latest Posts') . '</label>';
$content .= '<input id="page-max-posts-for-home" type="text" name="wordpress[max-posts-for-home]" class="form-control" placeholder="5"  value="' . $current_setting['max-posts-for-home'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('The maximum posts displayed on the home page') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- HOME --|-- TAGS-COMPONENT
$content .= '<h4>' . __e('Tags Component') . '</h4>';
$content .= '<table class="table">';
$content .= '<tr>';
if ($current_setting['home-tags'] == true)
{
    $content .= '<td style="width:30px;"><input checked="checked" class="flat-red" type="checkbox" id="page-home-tags" name="wordpress[home-tags]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td style="width:30px;"><input class="flat-red" type="checkbox" id="page-home-tags" name="wordpress[home-tags]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Display <em>Tags</em> on the home page') . '</td>';
$content .= '</tr>';
$content .= '</table>';

$content .= '</div>';


// TODO: -----------------------------------
// TODO: LAYOUT --|-- FORM --|-- CATEGORIES PAGE
$content .= '<div class="well">';
$content .= '<h3>' . __e('Categories Page') . '</h3>';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- CATEGORIES PAGE --|-- LAYOUT
$item_lists = array();
$item_lists[] = array('value' => 'showcase', 'label' => 'Showcase');
$item_lists[] = array('value' => 'item-list', 'label' => 'Item List');
$item_lists[] = array('value' => 'grid', 'label' => 'Grid');

$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Layout') . '</label>';
$content .= '<select name="wordpress[page-categories-layout]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-categories-layout'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Choose a layout for the categories listing') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- CATEGORIES PAGE --|-- NUMBER-OF-POSTS
$content .= '<div class="col-md-4">';
$item_lists = array();
$item_lists[] = array('value' => 'enable', 'label' => 'Enable');
$item_lists[] = array('value' => 'none', 'label' => 'None');
$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Number of posts') . '</label>';
$content .= '<select name="wordpress[page-categories-show-number-posts]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-categories-show-number-posts'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Show total number of posts') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- CATEGORIES PAGE --|-- DESCRIPTION
$content .= '<div class="col-md-4">';

$item_lists = array();
$item_lists[] = array('value' => 'none', 'label' => 'None');
$item_lists[] = array('value' => 'enable', 'label' => 'Enable');

$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Description') . '</label>';
$content .= '<select name="wordpress[page-categories-show-description]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-categories-show-description'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Show category description') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->';


$content .= '</div>';
//$content .= '</div>';

// TODO: -----------------------------------
// TODO: LAYOUT --|-- FORM --|-- POSTS PAGE
$content .= '<div class="well">';
$content .= '<h3>' . __e('Posts Page') . '</h3>';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- POSTS PAGE --|-- LAYOUT
$item_lists = array();
$item_lists[] = array('value' => 'showcase', 'label' => 'Showcase');
$item_lists[] = array('value' => 'item-list', 'label' => 'Item List');
$item_lists[] = array('value' => 'item-thumbnail', 'label' => 'Item Thumbnail');
$item_lists[] = array('value' => 'grid', 'label' => 'Grid');

$content .= '<div class="form-group">';
$content .= '<label for="page-layout">' . __e('Layout') . '</label>';
$content .= '<select name="wordpress[page-posts-layout]" class="form-control">';
for ($i = 0; $i < count($item_lists); $i++)
{
    $selected = '';
    if ($item_lists[$i]['value'] == $current_setting['page-posts-layout'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $item_lists[$i]['value'] . '" ' . $selected . '>' . $item_lists[$i]['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Choose a layout for the post listing') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- POSTS PAGE --|-- PER-PAGE
$content .= '<div class="col-md-4">';
$content .= '<div class="form-group">';
$content .= '<label for="per-page">' . __e('Per Page') . '</label>';
$content .= '<input type="number" name="wordpress[page-posts-per-page]" class="form-control" placeholder="10" value="' . $current_setting['page-posts-per-page'] . '" required />';
$content .= '<p class="help-block">' . __e('Filter the number of items per page to show') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
// TODO: -----------------------------------
$content .= '</div>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-7 -->';
$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Text') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="label-categories">' . __e('Label for `Categories`') . '</label>';
$content .= '<input type="text" name="wordpress[label-categories]" class="form-control" placeholder="Categories" value="' . $current_setting['label-categories'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Write text for `categories`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="label-posts">' . __e('Label for `Posts`') . '</label>';
$content .= '<input type="text" name="wordpress[label-posts]" class="form-control" placeholder="News" value="' . $current_setting['label-posts'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Write text for `all`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="label-all">' . __e('Label for `All`') . '</label>';
$content .= '<input type="text" name="wordpress[label-all]" class="form-control" placeholder="All" value="' . $current_setting['label-all'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Write text for `all`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="label-search">' . __e('Label for `Search`') . '</label>';
$content .= '<input type="text" name="wordpress[label-search]" class="form-control" placeholder="Search" value="' . $current_setting['label-search'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Write text for `Search`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="label-readmore">' . __e('Label for `Readmore`') . '</label>';
$content .= '<input type="text" name="wordpress[label-readmore]" class="form-control" placeholder="More" value="' . $current_setting['label-readmore'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Write text for `Readmore`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="label-dashboard">' . __e('Label for `Dashboard`') . '</label>';
$content .= '<input type="text" name="wordpress[label-dashboard]" class="form-control" placeholder="Dashboard" value="' . $current_setting['label-dashboard'] . '" required ' . $disabled . '/>';
$content .= '<p class="help-block">' . __e('Write text for `dashboard`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-HELP --|-- TEXT
$content .= '<div id="field-label-help" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-help">' . __e('Label for `Help`') . '</label>';
$content .= '<input id="page-label-help" type="text" name="wordpress[label-help]" class="form-control" placeholder="Help"  value="' . $current_setting['label-help'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Help`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-RATE-THIS-APP --|-- TEXT
$content .= '<div id="field-label-rate-this-app" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-rate-this-app">' . __e('Label for `Rate This App`') . '</label>';
$content .= '<input id="page-label-rate-this-app" type="text" name="wordpress[label-rate-this-app]" class="form-control" placeholder="Rate This App"  value="' . $current_setting['label-rate-this-app'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Rate This App`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-PRIVACY-POLICY --|-- TEXT
$content .= '<div id="field-label-privacy-policy" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-privacy-policy">' . __e('Label for `Privacy Policy`') . '</label>';
$content .= '<input id="page-label-privacy-policy" type="text" name="wordpress[label-privacy-policy]" class="form-control" placeholder="Privacy Policy"  value="' . $current_setting['label-privacy-policy'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Privacy Policy`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-ABOUT-US --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-about-us" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-about-us">' . __e('Label for `About US`') . '</label>';
$content .= '<input id="page-label-about-us" type="text" name="wordpress[label-about-us]" class="form-control" placeholder="About US"  value="' . $current_setting['label-about-us'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `About US`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div id="field-label-administrator" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-administrator">' . __e('Label for `Administrator`') . '</label>';
$content .= '<input id="page-label-administrator" type="text" name="wordpress[label-administrator]" class="form-control" placeholder="Administrator"  value="' . $current_setting['label-administrator'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Administrator`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '<div id="field-label-users" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-users">' . __e('Label for `Users`') . '</label>';
$content .= '<input id="page-label-users" type="text" name="wordpress[label-users]" class="form-control" placeholder="Users"  value="' . $current_setting['label-users'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Users`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-BOOKMARKS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-bookmarks" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-bookmarks">' . __e('Label for `Bookmarks/Favorites`') . '</label>';
$content .= '<input id="page-label-bookmarks" type="text" name="wordpress[label-bookmarks]" class="form-control" placeholder="Bookmarks"  value="' . $current_setting['label-bookmarks'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Bookmarks` or `Favorites`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-NO-BOOKMARKS-FOUND --|-- TEXT
$content .= '<div id="field-label-no-bookmarks-found" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-no-bookmarks-found">' . __e('Label for `No bookmarks found!`') . '</label>';
$content .= '<input id="page-label-no-bookmarks-found" type="text" name="wordpress[label-no-bookmarks-found]" class="form-control" placeholder="No bookmarks found!"  value="' . $current_setting['label-no-bookmarks-found'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write text for `No bookmarks found!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-DELETE --|-- TEXT
$content .= '<div id="field-label-delete" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-delete">' . __e('Label for `Delete`') . '</label>';
$content .= '<input id="page-label-delete" type="text" name="wordpress[label-delete]" class="form-control" placeholder="Delete"  value="' . $current_setting['label-delete'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write text for `Delete`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-CLEAN-UP --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-clean-up" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-clean-up">' . __e('Label for `Clean Up`') . '</label>';
$content .= '<input id="page-label-clean-up" type="text" name="wordpress[label-clean-up]" class="form-control" placeholder="Clean Up"  value="' . $current_setting['label-clean-up'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('Write text for `Clean Up`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-PLEASE-WAIT --|-- TEXT
$content .= '<div id="field-label-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-please-wait" type="text" name="wordpress[label-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-HOME --|-- TEXT
$content .= '<div id="field-label-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-home">' . __e('Label for `Home`') . '</label>';
$content .= '<input id="page-label-home" type="text" name="wordpress[label-home]" class="form-control" placeholder="Home"  value="' . $current_setting['label-home'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Home`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-LATEST-POSTS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-latest-posts" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-latest-posts">' . __e('Label for `Latest Posts`') . '</label>';
$content .= '<input id="page-label-latest-posts" type="text" name="wordpress[label-latest-posts]" class="form-control" placeholder="Latest Posts"  value="' . $current_setting['label-latest-posts'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Latest Posts`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-BOOKMARK-LIST --|-- TEXT
$content .= '<div id="field-label-bookmark-list" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-bookmark-list">' . __e('Label for `Bookmark/Favorite list`') . '</label>';
$content .= '<input id="page-label-bookmark-list" type="text" name="wordpress[label-bookmark-list]" class="form-control" placeholder="Bookmark List"  value="' . $current_setting['label-bookmark-list'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Bookmark List`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-STICKY-POSTS --|-- TEXT
$content .= '<div id="field-label-sticky-posts" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-sticky-posts">' . __e('Label for `Sticky/Highlighted Post`') . '</label>';
$content .= '<input id="page-label-sticky-posts" type="text" name="wordpress[label-sticky-posts]" class="form-control" placeholder="Highlighted Post"  value="' . $current_setting['label-sticky-posts'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Highlighted Post`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-TAGS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-tags" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-tags">' . __e('Label for `Tags`') . '</label>';
$content .= '<input id="page-label-tags" type="text" name="wordpress[label-tags]" class="form-control" placeholder="Tags"  value="' . $current_setting['label-tags'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Tags`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-COMMENTS --|-- TEXT
$content .= '<div id="field-label-comments" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-comments">' . __e('Label for `Comments`') . '</label>';
$content .= '<input id="page-label-comments" type="text" name="wordpress[label-comments]" class="form-control" placeholder="Comments"  value="' . $current_setting['label-comments'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Comments`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-NO-COMMENT --|-- TEXT
$content .= '<div id="field-label-no-comment" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-no-comment">' . __e('Label for `No comment`') . '</label>';
$content .= '<input id="page-label-no-comment" type="text" name="wordpress[label-no-comment]" class="form-control" placeholder="No comment"  value="' . $current_setting['label-no-comment'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No comment`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-COMMENT-PENDING --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-comment-pending" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-comment-pending">' . __e('Label for `Comment Pending`') . '</label>';
$content .= '<input id="page-label-comment-pending" type="text" name="wordpress[label-comment-pending]" class="form-control" placeholder="Your comment is awaiting moderation"  value="' . $current_setting['label-comment-pending'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Your comment is awaiting moderation`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-CONNECTION-LOST --|-- TEXT

$content .= '<div id="field-label-connection-lost" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-connection-lost">' . __e('Label for `Connection lost`') . '</label>';
$content .= '<input id="page-label-connection-lost" type="text" name="wordpress[label-connection-lost]" class="form-control" placeholder="Connection lost, please check your connection!"  value="' . $current_setting['label-connection-lost'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Connection lost, please check your connection!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-DARK-MODE --|-- TEXT

$content .= '<div id="field-label-dark-mode" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-dark-mode">' . __e('Label for `Dark Mode`') . '</label>';
$content .= '<input id="page-label-dark-mode" type="text" name="wordpress[label-dark-mode]" class="form-control" placeholder="Dark Mode"  value="' . $current_setting['label-dark-mode'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Dark Mode`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-SELECT-LANGUAGE --|-- TEXT
$content .= '<div class="row">';
$content .= '<div id="field-label-select-language" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-field-label-select-language">' . __e('Label for `Select language?`') . '</label>';
$content .= '<input id="page-label-field-label-select-language" type="text" name="wordpress[label-select-language]" class="form-control" placeholder="Select language?"  value="' . $current_setting['label-select-language'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Select language?`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-NO-ITEM --|-- TEXT

$content .= '<div id="field-label-no-item" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-no-item">' . __e('Label for `There are no items`') . '</label>';
$content .= '<input id="page-label-no-item" type="text" name="wordpress[label-no-item]" class="form-control" placeholder="There are no items"  value="' . $current_setting['label-no-item'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `There are no items`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-wordpress" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';
// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=wordpress&page-target="+$("#page-target").val(),!1});';
