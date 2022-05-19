<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `ebook`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = true;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("ebook");
$string = new jsmString();


if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('ebook', 'core');
    header('Location: ./?p=addons&addons=ebook&' . time());
}

// TODO: POST
if (isset($_POST['save-ebook']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = 'core';
    // TODO: POST --|-- RESPONSE
    $addons['page-title'] = 'core';
    $addons['page-header-color'] = trim($_POST['ebook']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['ebook']['page-content-background']);


    //label-for-select-language
    if (!isset($_POST['ebook']['label-for-select-language']))
    {
        $_POST[$prefix_addons]['label-for-select-language'] = 'Select Language?';
    }
    $addons['label-for-select-language'] = trim($_POST['ebook']['label-for-select-language']); //text

    //backend-used
    $addons['backend-used'] = trim($_POST['ebook']['backend-used']); //select
    //label-for-connection-lost
    if (!isset($_POST['ebook']['label-for-connection-lost']))
    {
        $_POST['ebook']['label-for-connection-lost'] = 'Connection lost, please check your connection!';
    }
    $addons['label-for-connection-lost'] = trim($_POST['ebook']['label-for-connection-lost']); //text

    //label-for-books
    if (!isset($_POST['ebook']['label-for-books']))
    {
        $_POST['ebook']['label-for-books'] = 'Books';
    }
    $addons['label-for-books'] = trim($_POST['ebook']['label-for-books']); //text

    //label-for-chapters
    if (!isset($_POST['ebook']['label-for-chapters']))
    {
        $_POST['ebook']['label-for-chapters'] = 'Chapters';
    }
    $addons['label-for-chapters'] = trim($_POST['ebook']['label-for-chapters']); //text


    //label-for-please-wait
    if (!isset($_POST['ebook']['label-for-please-wait']))
    {
        $_POST['ebook']['label-for-please-wait'] = 'Please wait...!';
    }
    $addons['label-for-please-wait'] = trim($_POST['ebook']['label-for-please-wait']); //text

    //label-for-ok
    if (!isset($_POST['ebook']['label-for-ok']))
    {
        $_POST['ebook']['label-for-ok'] = 'Okey';
    }
    $addons['label-for-ok'] = trim($_POST['ebook']['label-for-ok']); //text

    //label-for-start-reading
    if (!isset($_POST['ebook']['label-for-start-reading']))
    {
        $_POST['ebook']['label-for-start-reading'] = 'Start Reading';
    }
    $addons['label-for-start-reading'] = trim($_POST['ebook']['label-for-start-reading']); //text

    //api-url
    if (!isset($_POST['ebook']['api-url']))
    {
        $_POST['ebook']['api-url'] = '';
    }
    $addons['api-url'] = trim($_POST['ebook']['api-url']); //text


    //label-for-info
    if (!isset($_POST['ebook']['label-for-info']))
    {
        $_POST['ebook']['label-for-info'] = 'Info';
    }
    $addons['label-for-info'] = trim($_POST['ebook']['label-for-info']); //text


    //label-for-complete-information
    if (!isset($_POST['ebook']['label-for-complete-information']))
    {
        $_POST['ebook']['label-for-complete-information'] = 'Complete Information';
    }
    $addons['label-for-complete-information'] = trim($_POST['ebook']['label-for-complete-information']); //text

    //label-for-synopsis
    if (!isset($_POST['ebook']['label-for-synopsis']))
    {
        $_POST['ebook']['label-for-synopsis'] = 'Synopsis';
    }
    $addons['label-for-synopsis'] = trim($_POST['ebook']['label-for-synopsis']); //text

    //label-for-title
    if (!isset($_POST['ebook']['label-for-title']))
    {
        $_POST['ebook']['label-for-title'] = 'Title';
    }
    $addons['label-for-title'] = trim($_POST['ebook']['label-for-title']); //text

    //label-for-alternative-title
    if (!isset($_POST['ebook']['label-for-alternative-title']))
    {
        $_POST['ebook']['label-for-alternative-title'] = 'Alternative Title';
    }
    $addons['label-for-alternative-title'] = trim($_POST['ebook']['label-for-alternative-title']); //text

    //label-for-author
    if (!isset($_POST['ebook']['label-for-author']))
    {
        $_POST['ebook']['label-for-author'] = 'Author';
    }
    $addons['label-for-author'] = trim($_POST['ebook']['label-for-author']); //text

    //label-for-status
    if (!isset($_POST['ebook']['label-for-status']))
    {
        $_POST['ebook']['label-for-status'] = 'Status';
    }
    $addons['label-for-status'] = trim($_POST['ebook']['label-for-status']); //text

    //label-for-date-released
    if (!isset($_POST['ebook']['label-for-date-released']))
    {
        $_POST['ebook']['label-for-date-released'] = 'Date Released';
    }
    $addons['label-for-date-released'] = trim($_POST['ebook']['label-for-date-released']); //text

    //label-for-publisher
    if (!isset($_POST['ebook']['label-for-publisher']))
    {
        $_POST['ebook']['label-for-publisher'] = 'Publisher';
    }
    $addons['label-for-publisher'] = trim($_POST['ebook']['label-for-publisher']); //text

    //label-for-search
    if (!isset($_POST['ebook']['label-for-search']))
    {
        $_POST['ebook']['label-for-search'] = 'Search';
    }
    $addons['label-for-search'] = trim($_POST['ebook']['label-for-search']); //text

    //label-for-dashboard
    if (!isset($_POST['ebook']['label-for-dashboard']))
    {
        $_POST['ebook']['label-for-dashboard'] = 'Dashboard';
    }
    $addons['label-for-dashboard'] = trim($_POST['ebook']['label-for-dashboard']); //text

    //label-for-home
    if (!isset($_POST['ebook']['label-for-home']))
    {
        $_POST['ebook']['label-for-home'] = 'Home';
    }
    $addons['label-for-home'] = trim($_POST['ebook']['label-for-home']); //text

    //label-for-latest
    if (!isset($_POST['ebook']['label-for-latest']))
    {
        $_POST['ebook']['label-for-latest'] = 'Latest';
    }
    $addons['label-for-latest'] = trim($_POST['ebook']['label-for-latest']); //text

    //label-for-favorites
    if (!isset($_POST['ebook']['label-for-favorites']))
    {
        $_POST['ebook']['label-for-favorites'] = 'Favorites';
    }
    $addons['label-for-favorites'] = trim($_POST['ebook']['label-for-favorites']); //text

    //label-for-histories
    if (!isset($_POST['ebook']['label-for-histories']))
    {
        $_POST['ebook']['label-for-histories'] = 'Histories';
    }
    $addons['label-for-histories'] = trim($_POST['ebook']['label-for-histories']); //text

    //label-for-list
    if (!isset($_POST['ebook']['label-for-list']))
    {
        $_POST['ebook']['label-for-list'] = 'List';
    }
    $addons['label-for-list'] = trim($_POST['ebook']['label-for-list']); //text

    //label-for-settings
    if (!isset($_POST['ebook']['label-for-settings']))
    {
        $_POST['ebook']['label-for-settings'] = 'Settings';
    }
    $addons['label-for-settings'] = trim($_POST['ebook']['label-for-settings']); //text

    //label-for-help
    if (!isset($_POST['ebook']['label-for-help']))
    {
        $_POST['ebook']['label-for-help'] = 'Help';
    }
    $addons['label-for-help'] = trim($_POST['ebook']['label-for-help']); //text

    //label-for-about-us
    if (!isset($_POST['ebook']['label-for-about-us']))
    {
        $_POST['ebook']['label-for-about-us'] = 'About Us';
    }
    $addons['label-for-about-us'] = trim($_POST['ebook']['label-for-about-us']); //text

    //label-for-privacy-policy
    if (!isset($_POST['ebook']['label-for-privacy-policy']))
    {
        $_POST['ebook']['label-for-privacy-policy'] = 'Privacy Policy';
    }
    $addons['label-for-privacy-policy'] = trim($_POST['ebook']['label-for-privacy-policy']); //text

    //label-for-rate-this-app
    if (!isset($_POST['ebook']['label-for-rate-this-app']))
    {
        $_POST['ebook']['label-for-rate-this-app'] = 'Rate This App';
    }
    $addons['label-for-rate-this-app'] = trim($_POST['ebook']['label-for-rate-this-app']); //text

    //label-for-chapter
    if (!isset($_POST['ebook']['label-for-chapter']))
    {
        $_POST['ebook']['label-for-chapter'] = 'Chapter';
    }
    $addons['label-for-chapter'] = trim($_POST['ebook']['label-for-chapter']); //text

    //label-for-delete
    if (!isset($_POST['ebook']['label-for-delete']))
    {
        $_POST['ebook']['label-for-delete'] = 'Delete';
    }
    $addons['label-for-delete'] = trim($_POST['ebook']['label-for-delete']); //text

    //label-for-clear
    if (!isset($_POST['ebook']['label-for-clear']))
    {
        $_POST['ebook']['label-for-clear'] = 'Clear';
    }
    $addons['label-for-clear'] = trim($_POST['ebook']['label-for-clear']); //text

    //label-for-removed-from-history
    if (!isset($_POST['ebook']['label-for-removed-from-history']))
    {
        $_POST['ebook']['label-for-removed-from-history'] = 'Item has been removed from history';
    }
    $addons['label-for-removed-from-history'] = trim($_POST['ebook']['label-for-removed-from-history']); //text

    //label-for-no-history
    if (!isset($_POST['ebook']['label-for-no-history']))
    {
        $_POST['ebook']['label-for-no-history'] = 'No History';
    }
    $addons['label-for-no-history'] = trim($_POST['ebook']['label-for-no-history']); //text

    //label-for-removed-from-favorite
    if (!isset($_POST['ebook']['label-for-removed-from-favorite']))
    {
        $_POST['ebook']['label-for-removed-from-favorite'] = 'Item has been removed from favorite';
    }
    $addons['label-for-removed-from-favorite'] = trim($_POST['ebook']['label-for-removed-from-favorite']); //text

    //label-for-no-favorite
    if (!isset($_POST['ebook']['label-for-no-favorite']))
    {
        $_POST['ebook']['label-for-no-favorite'] = 'No Favorite';
    }
    $addons['label-for-no-favorite'] = trim($_POST['ebook']['label-for-no-favorite']); //text

    //label-for-no-books
    if (!isset($_POST['ebook']['label-for-no-books']))
    {
        $_POST['ebook']['label-for-no-books'] = 'There are no books';
    }
    $addons['label-for-no-books'] = trim($_POST['ebook']['label-for-no-books']); //text

    //label-for-genre
    if (!isset($_POST['ebook']['label-for-genre']))
    {
        $_POST['ebook']['label-for-genre'] = 'Genre';
    }
    $addons['label-for-genre'] = trim($_POST['ebook']['label-for-genre']); //text


    //label-for-dark-mode
    if (!isset($_POST['ebook']['label-for-dark-mode']))
    {
        $_POST['ebook']['label-for-dark-mode'] = 'Dark Mode';
    }
    $addons['label-for-dark-mode'] = trim($_POST['ebook']['label-for-dark-mode']); //text

    //label-for-chapter-not-available
    if (!isset($_POST['ebook']['label-for-chapter-not-available']))
    {
        $_POST['ebook']['label-for-chapter-not-available'] = 'Chapters not yet available!';
    }
    $addons['label-for-chapter-not-available'] = trim($_POST['ebook']['label-for-chapter-not-available']); //text

    //multiple-language
    // checkbox
    if (isset($_POST['ebook']['multiple-language']))
    {
        $addons['multiple-language'] = true;
    } else
    {
        $addons['multiple-language'] = false;
    }


    //label-for-open
    if (!isset($_POST['ebook']['label-for-open']))
    {
        $_POST['ebook']['label-for-open'] = 'Open';
    }
    $addons['label-for-open'] = trim($_POST['ebook']['label-for-open']); //text

    //label-for-use-app
    if (!isset($_POST['ebook']['label-for-use-app']))
    {
        $_POST['ebook']['label-for-use-app'] = 'Use App:';
    }
    $addons['label-for-use-app'] = trim($_POST['ebook']['label-for-use-app']); //text

    $pipe_translate = '';
    if ($addons['multiple-language'] == true)
    {
        $pipe_translate = '| translate ';
    }

    //content-type
    $addons['content-type'] = trim($_POST['ebook']['content-type']); //select

    $db->saveAddOns('ebook', $addons);


    // TODO: ==================================================================================================================


    if ($addons['multiple-language'] == true)
    {

        // TODO: LOCALIZATION

        // TODO: LOCALIZATION --|-- EN
        $localization = null;
        $localization['prefix'] = 'en';
        $localization['name'] = 'English';
        $localization['desc'] = 'Auto create by WordPress App Addons';

        $v = 0;
        $localization['words'][$v]['text'] = $addons['label-for-connection-lost'];
        $localization['words'][$v]['translate'] = 'Your connection is lost!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-search'];
        $localization['words'][$v]['translate'] = 'Search';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-books'];
        $localization['words'][$v]['translate'] = 'Books';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-chapters'];
        $localization['words'][$v]['translate'] = 'Chapters';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
        $localization['words'][$v]['translate'] = 'Please wait...!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-ok'];
        $localization['words'][$v]['translate'] = 'OK';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-start-reading'];
        $localization['words'][$v]['translate'] = 'Start reading';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-info'];
        $localization['words'][$v]['translate'] = 'Info';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-complete-information'];
        $localization['words'][$v]['translate'] = 'Complete Information';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-synopsis'];
        $localization['words'][$v]['translate'] = 'Synopsis';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-title'];
        $localization['words'][$v]['translate'] = 'Title';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-alternative-title'];
        $localization['words'][$v]['translate'] = 'Alternative Title';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-author'];
        $localization['words'][$v]['translate'] = 'Author';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-status'];
        $localization['words'][$v]['translate'] = 'Status';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-date-released'];
        $localization['words'][$v]['translate'] = 'Date Released';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-publisher'];
        $localization['words'][$v]['translate'] = 'Publisher';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-dashboard'];
        $localization['words'][$v]['translate'] = 'Dashboard';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-home'];
        $localization['words'][$v]['translate'] = 'Home';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-latest'];
        $localization['words'][$v]['translate'] = 'Latest';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorites'];
        $localization['words'][$v]['translate'] = 'Favorites';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-histories'];
        $localization['words'][$v]['translate'] = 'Histories';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-list'];
        $localization['words'][$v]['translate'] = 'List';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-settings'];
        $localization['words'][$v]['translate'] = 'Settings';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-help'];
        $localization['words'][$v]['translate'] = 'Help';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-about-us'];
        $localization['words'][$v]['translate'] = 'About Us';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-privacy-policy'];
        $localization['words'][$v]['translate'] = 'Privacy Policy';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-rate-this-app'];
        $localization['words'][$v]['translate'] = 'Rate This App';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-chapter'];
        $localization['words'][$v]['translate'] = 'Chapter';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-delete'];
        $localization['words'][$v]['translate'] = 'Delete';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-clear'];
        $localization['words'][$v]['translate'] = 'Clear';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-removed-from-history'];
        $localization['words'][$v]['translate'] = 'Removed from History';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-history'];
        $localization['words'][$v]['translate'] = 'No History';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-removed-from-favorite'];
        $localization['words'][$v]['translate'] = 'Removed from favorite';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-favorite'];
        $localization['words'][$v]['translate'] = 'No Fovirate';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-books'];
        $localization['words'][$v]['translate'] = 'No Books';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-genre'];
        $localization['words'][$v]['translate'] = 'Genre';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-dark-mode'];
        $localization['words'][$v]['translate'] = 'Dark Mode';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-chapter-not-available'];
        $localization['words'][$v]['translate'] = 'Chapter not available';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-open'];
        $localization['words'][$v]['translate'] = 'Open';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-use-app'];
        $localization['words'][$v]['translate'] = 'Use App';


        $db->saveLocalization($localization);


        // TODO: LOCALIZATION --|-- ID
        $localization = null;
        $localization['prefix'] = 'id';
        $localization['name'] = 'Bahasa Indonesia';
        $localization['desc'] = 'Auto create by WordPress App Addons';

        $v = 0;
        $localization['words'][$v]['text'] = $addons['label-for-connection-lost'];
        $localization['words'][$v]['translate'] = 'Koneksi terputus';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-search'];
        $localization['words'][$v]['translate'] = 'Cari';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-books'];
        $localization['words'][$v]['translate'] = 'Buku-Buku';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-chapters'];
        $localization['words'][$v]['translate'] = 'Bab-bab';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
        $localization['words'][$v]['translate'] = 'Silahkan tunggu';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-ok'];
        $localization['words'][$v]['translate'] = 'Baiklah';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-start-reading'];
        $localization['words'][$v]['translate'] = 'Memulai membaca';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-info'];
        $localization['words'][$v]['translate'] = 'Info';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-complete-information'];
        $localization['words'][$v]['translate'] = 'Informasi';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-synopsis'];
        $localization['words'][$v]['translate'] = 'Sinopsis';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-title'];
        $localization['words'][$v]['translate'] = 'Judul';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-alternative-title'];
        $localization['words'][$v]['translate'] = 'Judul Alternatif';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-author'];
        $localization['words'][$v]['translate'] = 'Penulis';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-status'];
        $localization['words'][$v]['translate'] = 'Status';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-date-released'];
        $localization['words'][$v]['translate'] = 'Tanggal Rilis';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-publisher'];
        $localization['words'][$v]['translate'] = 'Penerbit';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-dashboard'];
        $localization['words'][$v]['translate'] = 'Beranda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-home'];
        $localization['words'][$v]['translate'] = 'Rumah';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-latest'];
        $localization['words'][$v]['translate'] = 'Terbaru';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorites'];
        $localization['words'][$v]['translate'] = 'Kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-histories'];
        $localization['words'][$v]['translate'] = 'Riwayat';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-list'];
        $localization['words'][$v]['translate'] = 'Daftar';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-settings'];
        $localization['words'][$v]['translate'] = 'Pengaturan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-help'];
        $localization['words'][$v]['translate'] = 'Bantuan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-about-us'];
        $localization['words'][$v]['translate'] = 'Tentang Kami';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-privacy-policy'];
        $localization['words'][$v]['translate'] = 'Kebijaksanaan Pribadi';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-rate-this-app'];
        $localization['words'][$v]['translate'] = 'Nilai Aplikasi Ini';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-chapter'];
        $localization['words'][$v]['translate'] = 'Bab';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-delete'];
        $localization['words'][$v]['translate'] = 'Hapus';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-clear'];
        $localization['words'][$v]['translate'] = 'Bersihkan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-removed-from-history'];
        $localization['words'][$v]['translate'] = 'Dihapus dari riwayat';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-history'];
        $localization['words'][$v]['translate'] = 'Tidak ada riwayat';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-removed-from-favorite'];
        $localization['words'][$v]['translate'] = 'Dihapus dari kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-favorite'];
        $localization['words'][$v]['translate'] = 'Tidak ada kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-books'];
        $localization['words'][$v]['translate'] = 'Tidak ada buku';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-genre'];
        $localization['words'][$v]['translate'] = 'Genre';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-dark-mode'];
        $localization['words'][$v]['translate'] = 'Mode Gelap';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-chapter-not-available'];
        $localization['words'][$v]['translate'] = 'Bab tidak tersedia';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-open'];
        $localization['words'][$v]['translate'] = 'Buka';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-use-app'];
        $localization['words'][$v]['translate'] = 'Gunakan Aplikasi';


        $db->saveLocalization($localization);
    } else
    {
        $db->deleteLocalization('en');
        $db->deleteLocalization('id');
    }


    // TODO: GENERATOR --|-- PROJECT --|--
    $new_project = $current_app['apps'];
    $new_project['rootPage'] = 'latest';
    $new_project['ionic-storage'] = true;
    $new_project['statusbar']['style'] = 'lightcontent';
    $new_project['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $new_project['pref-orientation'] = 'portrait';
    $db->saveProject($new_project);

    // TODO: GENERATOR --|-- MENU --|--
    $newMenu['side'] = 'start';
    $newMenu['type'] = 'overlay';
    $newMenu['ion-header'] = 'expanded-header';
    $newMenu['color-header'] = $addons['page-header-color'];
    $newMenu['text-header'] = $current_app['apps']['app-name'];
    $newMenu['text-subheader'] = $current_app['apps']['app-description'];
    $newMenu['expanded-background'] = 'assets/images/background/expanded-menu.png';
    $color_icon_left = $addons['page-header-color'];
    $color_label = 'dark';

    // TODO: GENERATOR --|-- MENU --|-- ITEMS
    $z = 0;
    $newMenu['items'][$z]["type"] = "title";
    $newMenu['items'][$z]["label"] = $addons['label-for-dashboard'];
    $newMenu['items'][$z]["var"] = "dashboard";
    $newMenu['items'][$z]["page"] = "home";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    //$z++;
    //$newMenu['items'][$z]["type"] = "inlink";
    //$newMenu['items'][$z]["label"] = $addons['label-for-home'];
    //$newMenu['items'][$z]["var"] = "home";
    //$newMenu['items'][$z]["page"] = "home";
    //$newMenu['items'][$z]["value"] = "";
    //$newMenu['items'][$z]["desc"] = "";
    //$newMenu['items'][$z]["color-label"] = $color_label;
    //$newMenu['items'][$z]["icon-left"] = "home-outline";
    //$newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    //$newMenu['items'][$z]["icon-right"] = "";
    //$newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-latest'];
    $newMenu['items'][$z]["var"] = "latest";
    $newMenu['items'][$z]["page"] = "latest";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "time-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-histories'];
    $newMenu['items'][$z]["var"] = "histories";
    $newMenu['items'][$z]["page"] = "histories";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "timer-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-favorites'];
    $newMenu['items'][$z]["var"] = "favorites";
    $newMenu['items'][$z]["page"] = "favorites";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "heart-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-list'];
    $newMenu['items'][$z]["var"] = "list";
    $newMenu['items'][$z]["page"] = "list";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "apps-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "title";
    $newMenu['items'][$z]["label"] = $addons['label-for-help'];
    $newMenu['items'][$z]["var"] = "help";
    $newMenu['items'][$z]["page"] = "";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "help-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "playstore";
    $newMenu['items'][$z]["label"] = $addons['label-for-rate-this-app'];
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
    $newMenu['items'][$z]["label"] = $addons['label-for-privacy-policy'];
    $newMenu['items'][$z]["var"] = "privacy-policy";
    $newMenu['items'][$z]["page"] = "privacy-policy";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "help-circle-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-about-us'];
    $newMenu['items'][$z]["var"] = "about-us";
    $newMenu['items'][$z]["page"] = "about-us";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "nuclear-outline";
    $newMenu['items'][$z]["color-icon-left"] = $newMenu['color-header'];
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";
    $db->saveMenu($newMenu);

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- POPOVERS --|--
    $popovers = null;
    $popovers['icon'] = 'ellipsis-vertical';
    $popovers['title'] = '';
    $popovers['color'] = $newMenu['color-header'];
    $popovers['background'] = 'light';
    // TODO: GENERATOR --|-- POPOVERS --|-- ITEMS

    $v = 0;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-for-privacy-policy'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = 'privacy-policy';

    if ($addons['multiple-language'] == true)
    {
        $v++;
        $popovers['items'][$v]['type'] = 'language';
        $popovers['items'][$v]['label'] = $addons['label-for-select-language'];
        $popovers['items'][$v]['value'] = 'language';
        $popovers['items'][$v]['page'] = '';
    }


    $v++;
    $popovers['items'][$v]['type'] = 'dark-mode';
    $popovers['items'][$v]['label'] = $addons['label-for-dark-mode'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = '';

    $v++;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-for-about-us'];
    $popovers['items'][$v]['value'] = '';
    $popovers['items'][$v]['page'] = 'about-us';
    $db->savePopover($popovers);


    // TODO: GENERATOR --|-- TABLE --|-- BOOKS
    $newTable = null;
    $newTable['table-name'] = 'books';
    $newTable['table-singular-name'] = 'Book';
    $newTable['table-plural-name'] = 'Books';
    $newTable['table-cols'] = array();

    $newTable['table-desc'] = 'List of books';
    $newTable['table-icon-fontawesome'] = 'book';
    $newTable['table-icon-dashicons'] = 'book';
    $newTable['table-icon-ionicons'] = 'book';
    $newTable['table-variable-as-label'] = 'book_title';
    $newTable['table-variable-as-value'] = 'book_id';
    $newTable['form-filter-duplicate'] = true;
    $newTable['auth-enable'] = false;
    $newTable['form-method'] = 'none';

    $x = 0;
    $newTable['table-cols'][$x]['type'] = 'id';
    $newTable['table-cols'][$x]['label'] = 'ID';
    $newTable['table-cols'][$x]['variable'] = 'book_id';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'thumbnail';
    $newTable['table-cols'][$x]['label'] = 'Thumbnail';
    $newTable['table-cols'][$x]['variable'] = 'book_thumbnail';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Upload thumbnail for ebook';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'image';
    $newTable['table-cols'][$x]['label'] = 'Cover';
    $newTable['table-cols'][$x]['variable'] = 'book_cover';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Upload cover for ebook';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Title';
    $newTable['table-cols'][$x]['variable'] = 'book_title';
    $newTable['table-cols'][$x]['option'] = 'Interdum Sed Duis';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the title of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Alternative Title';
    $newTable['table-cols'][$x]['variable'] = 'book_title_alt';
    $newTable['table-cols'][$x]['option'] = 'Interdum Sed Duis';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the alternative title of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'multi-text';
    $newTable['table-cols'][$x]['label'] = 'Genre';
    $newTable['table-cols'][$x]['variable'] = 'book_genre';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Author';
    $newTable['table-cols'][$x]['variable'] = 'book_author';
    $newTable['table-cols'][$x]['option'] = 'Feugiat';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the author of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Publisher';
    $newTable['table-cols'][$x]['variable'] = 'book_publisher';
    $newTable['table-cols'][$x]['option'] = 'Imperdiet';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the publisher of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'ISBN';
    $newTable['table-cols'][$x]['variable'] = 'book_isbn';
    $newTable['table-cols'][$x]['option'] = 'Interdum Sed Duis';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the ISBN of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'date';
    $newTable['table-cols'][$x]['label'] = 'Date Released';
    $newTable['table-cols'][$x]['variable'] = 'book_released';
    $newTable['table-cols'][$x]['option'] = '2015-06-30';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the date released of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'select';
    $newTable['table-cols'][$x]['label'] = 'Status';
    $newTable['table-cols'][$x]['variable'] = 'book_status';
    $newTable['table-cols'][$x]['option'] = 'Ongoing|End|Drop|Hiatus';
    $newTable['table-cols'][$x]['default'] = 'Ongoing';
    $newTable['table-cols'][$x]['info'] = 'Write the status of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'text';
    $newTable['table-cols'][$x]['label'] = 'Synopsis';
    $newTable['table-cols'][$x]['variable'] = 'book_synopsis';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the synopsis of the book';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;


    $db->saveTable($newTable);
    // ----------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- TABLE --|-- CHAPTER

    $newTable = null;
    $newTable['table-name'] = 'chapters';
    $newTable['table-singular-name'] = 'Chapter';
    $newTable['table-plural-name'] = 'Chapters';
    $newTable['table-cols'] = array();

    $newTable['table-desc'] = 'List of chapter';
    $newTable['table-icon-fontawesome'] = 'book';
    $newTable['table-icon-dashicons'] = 'book';
    $newTable['table-icon-ionicons'] = 'book';
    $newTable['table-variable-as-label'] = 'chapter_id';
    $newTable['table-variable-as-value'] = 'chapter_title';
    $newTable['form-filter-duplicate'] = true;
    $newTable['auth-enable'] = false;
    $newTable['form-method'] = 'none';

    $x = 0;
    $newTable['table-cols'][$x]['type'] = 'id';
    $newTable['table-cols'][$x]['label'] = 'ID';
    $newTable['table-cols'][$x]['variable'] = 'chapter_id';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'number-fixed-length';
    $newTable['table-cols'][$x]['label'] = 'Number';
    $newTable['table-cols'][$x]['variable'] = 'chapter_number';
    $newTable['table-cols'][$x]['option'] = '4';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the number of the chapter, chapter numbers will be useful for sorting chapters';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'date';
    $newTable['table-cols'][$x]['label'] = 'Date';
    $newTable['table-cols'][$x]['variable'] = 'chapter_date';
    $newTable['table-cols'][$x]['option'] = '2015-06-30';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the date released of the chapter';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Title';
    $newTable['table-cols'][$x]['variable'] = 'chapter_title';
    $newTable['table-cols'][$x]['option'] = 'Lorem Ipsum';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the title of the chapter';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'select-table';
    $newTable['table-cols'][$x]['label'] = 'Select Book';
    $newTable['table-cols'][$x]['variable'] = 'chapter_book';
    $newTable['table-cols'][$x]['table-source'] = 'books';
    $newTable['table-cols'][$x]['option'] = 'books';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    switch ($addons['content-type'])
    {
        case 'document':
            $x++;
            $newTable['table-cols'][$x]['type'] = 'file';
            $newTable['table-cols'][$x]['label'] = 'Document File';
            $newTable['table-cols'][$x]['variable'] = 'chapter_doc_url';
            $newTable['table-cols'][$x]['option'] = 'https://domain/userfiles/file.pdf';
            $newTable['table-cols'][$x]['default'] = '';
            $newTable['table-cols'][$x]['info'] = 'Write the url of pdf, docx or other file';
            $newTable['table-cols'][$x]['json-list'] = true;
            $newTable['table-cols'][$x]['json-detail'] = true;
            $newTable['table-cols'][$x]['item-list'] = true;
            break;

        case 'html':
            $x++;
            $newTable['table-cols'][$x]['type'] = 'longtext';
            $newTable['table-cols'][$x]['label'] = 'Content';
            $newTable['table-cols'][$x]['variable'] = 'chapter_content';
            $newTable['table-cols'][$x]['option'] = 'Lorem Ipsum';
            $newTable['table-cols'][$x]['default'] = '';
            $newTable['table-cols'][$x]['info'] = 'Write the content of the chapter';
            $newTable['table-cols'][$x]['json-list'] = true;
            $newTable['table-cols'][$x]['json-detail'] = true;
            $newTable['table-cols'][$x]['item-list'] = true;
            break;

        case 'images':
            $x++;
            $newTable['table-cols'][$x]['type'] = 'multi-images';
            $newTable['table-cols'][$x]['label'] = 'Pages';
            $newTable['table-cols'][$x]['variable'] = 'chapter_pages';
            $newTable['table-cols'][$x]['option'] = '';
            $newTable['table-cols'][$x]['default'] = '';
            $newTable['table-cols'][$x]['info'] = '';
            $newTable['table-cols'][$x]['json-list'] = true;
            $newTable['table-cols'][$x]['json-detail'] = true;
            $newTable['table-cols'][$x]['item-list'] = true;
            break;
    }

    $x++;
    $newTable['table-cols'][$x]['type'] = 'select';
    $newTable['table-cols'][$x]['label'] = 'Status';
    $newTable['table-cols'][$x]['variable'] = 'chapter_status';
    $newTable['table-cols'][$x]['option'] = 'draft|publish';
    $newTable['table-cols'][$x]['default'] = 'draft';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;
    $db->saveTable($newTable);


    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|--
    $service = null;
    $service['name'] = 'storage';
    $service['instruction'] = 'Service for Storage';
    $service['desc'] = 'Service for Storage Data';
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- MODULES


    $service['code']['other'] = null;
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- getItems(table:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.getItems(table:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async getItems(table:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let data:any = [] ;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.storage.forEach((val,key,index) => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'if(key.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'data.push(val);' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await data;' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- getItem(table:string,key:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.getItem(table:string,key:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async getItem(table:string,key:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await this.storage.get(`${table}:${key}`);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- setItem(table:string,key:string,val:any)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.setItem(table:string,key:string,val:any)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async setItem(table:string,key:string,value:any){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await this.storage.set(`${table}:${key}`,value);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- removeItem(table:string,key:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.removeItem(table:string,key:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async removeItem(table:string,key:string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return await this.storage.remove(`${table}:${key}`);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- clearItems(table:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.clearItems(table:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async clearItems(table:string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'if(iKey.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'this.storage.remove(`${iKey}`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- STORAGE --|-- CODE --|-- OTHER --|-- clearItemsWhere(table:string,key:string,val:string)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* StorageService.clearItemsWhere(table:string,key:string,val:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'public async clearItemsWhere(table:string,key:string,val:string) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.storage.forEach((iValue, iKey, iIndex) => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'let prefix : string = `${table}:`;' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'if(iKey.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'if( iValue[key] == val){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.storage.remove(`${iKey}`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";


    $db->saveService($service, 'core');

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|--
    $prefix_wp = strtolower(metaphone($current_app['apps']['app-name']));

    $service['name'] = 'ebook';
    $service['instruction'] = 'Service for eBook';
    $service['desc'] = 'Service for eBook';

    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- MODULES
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
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';
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

    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|--
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'mainUrl: string = `' . $addons['api-url'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-for-connection-lost'] . '`;' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t" . 'prefix: string = `' . $prefix_wp . '`;' . "\r\n";
            break;
    }

    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- getBooks()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.getBooks(query:any)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getBooks(query:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let ebookUrl: string = `${this.mainUrl}?api=books&${param}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let ebookUrl: string = `${this.mainUrl}/wp-json/wp/v2/${this.prefix}_books/?${param}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(ebookUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getBooks`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getBooks`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-books'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getBooks`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- getBook(bookId)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.getBook(bookId:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getBook(bookId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let ebookUrl: string = `${this.mainUrl}?api=books&book-id=${bookId}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let ebookUrl: string = `${this.mainUrl}/wp-json/wp/v2/${this.prefix}_books/${bookId}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(ebookUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getBook`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getBook`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-ebook'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getBook`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- getChapters()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.getChapters(query)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getChapters(query:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let chapterUrl: string = `${this.mainUrl}?api=chapters&chapter-status=publish&${param}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let chapterUrl: string = `${this.mainUrl}/wp-json/wp/v2/${this.prefix}_chapters/?chapter_status=publish&${param}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(chapterUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getChapters`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getChapters`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-chapters'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getChapters`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- getChapter()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.getChapter(chapterId)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getChapter(chapterId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let chapterUrl: string = `${this.mainUrl}?api=chapters&&chapter-id=${chapterId}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let chapterUrl: string = `${this.mainUrl}/wp-json/wp/v2/${this.prefix}_chapters/${chapterId}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(chapterUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getChapter`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getChapter`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-chapters'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Ebook`,`getChapters`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- httpBuildQuery()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook:httpBuildQuery(obj)' . "\r\n";
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

    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- presentLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t\t" . 'message: this.translateService.instant("' . $addons['label-for-please-wait'] . '"),' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- showToast()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.showToast($message)' . "\r\n";
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
    // TODO: GENERATOR --|-- SERVICES --|-- EBOOKS --|-- CODE --|-- OTHER --|-- showAlert()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* Ebook.showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";

    if ($addons['multiple-language'] == true)
    {
        $service['code']['other'] .= "\t\t\t" . 'buttons: [ this.translateService.instant("' . $addons['label-for-ok'] . '")]' . "\r\n";
    } else
    {
        $service['code']['other'] .= "\t\t\t" . 'buttons: ["' . $addons['label-for-ok'] . '"]' . "\r\n";
    }

    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    $db->saveService($service, 'core');


    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|--
    $createPages['latest'] = null;
    $createPages['latest']['name'] = 'latest';
    $createPages['latest']['title'] = '{{"' . $addons['label-for-latest'] . '"' . $pipe_translate . ' }}';
    $createPages['latest']['icon-left'] = 'time-outline';
    $createPages['latest']['header']['mid']['type'] = 'search';
    $createPages['latest']['header']['mid']['search-label'] = $addons['label-for-search'];

    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CONTENT --|-- HTML --|--
    $createPages['latest']['content']['html'] = null;
    $createPages['latest']['content']['html'] .= "\t" . '' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t" . '' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t" . '<ion-grid *ngIf="filterDataChapters.length != 0" >' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t" . '<ion-col class="ion-no-padding ion-no-margin" size="4" *ngFor="let item of filterDataChapters">' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t" . '<ion-card class="ion-no-padding ion-no-margin" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'detail\',item.id]" >' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t\t" . '<ion-badge color="' . $addons['page-header-color'] . '">{{ item.chapter_number | readMore:5 }}</ion-badge>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="item.thumbnail" [src]="item.thumbnail" />' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t\t" . '<img *ngIf="!item.thumbnail" src="assets/images/placeholder-480x480.png" />' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content class="ion-no-padding ion-no-margin">' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t\t\t" . '<p *ngIf="item.title"><span [innerHTML]="item.title | readMore:28"></span></p>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t\t" . '</ion-card-content>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";

    $createPages['latest']['content']['html'] .= "\t" . '<ion-list class="empty-container" lines="none" *ngIf="filterDataChapters.length == 0">' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '" class="empty-wrapper">' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t" . '<ion-icon class="empty-icon" name="book-outline"></ion-icon>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t\t" . '<h3>{{ "' . $addons['label-for-no-books'] . '"' . $pipe_translate . ' }}</h3>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $createPages['latest']['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


    $createPages['latest']['content']['scss'] = null;
    $createPages['latest']['content']['scss'] .= '.empty-container{height: 100%;}' . "\r\n";
    $createPages['latest']['content']['scss'] .= '.empty-wrapper{text-align: center;padding-top: 50%;}' . "\r\n";
    $createPages['latest']['content']['scss'] .= '.empty-icon{font-size: 72px;}' . "\r\n";
    $createPages['latest']['content']['scss'] .= '.empty-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";

    $createPages['latest']['content']['scss'] .= 'ion-card{margin:6px}' . "\r\n";
    $createPages['latest']['content']['scss'] .= 'ion-card img{width: 100%;}' . "\r\n";
    $createPages['latest']['content']['scss'] .= 'ion-card-content{margin:6px}' . "\r\n";
    $createPages['latest']['content']['scss'] .= 'ion-badge {position: absolute;border-bottom-left-radius: 0 !important;border-top-right-radius: 0 !important;}' . "\r\n";

    $createPages['latest']['code']['export'] = null;
    $createPages['latest']['code']['constructor'] = null;
    $createPages['latest']['code']['init'] = null;
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|--
    $createPages['latest']['code']['other'] = null;
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'books: Observable<any>;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'dataBooks: any = [];' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'chapters: Observable<any>;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'dataChapters: any = [];' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'filterDataChapters: any = [];' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|-- getThumbnail()
    $createPages['latest']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* LatestPage:getThumbnail()' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'private getThumbnail(id:number):string{' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'let src = `assets/images/placeholder-480x480.png`;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'for (let book of this.dataBooks){' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . 'if(id == book.book_id){' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t\t" . 'return book.book_thumbnail;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'return src;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|-- showBooks()
    $createPages['latest']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* LatestPage:showBooks()' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'public showBooks(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $createPages['latest']['code']['other'] .= "\t\t" . 'let param = {};' . "\r\n";
            break;
        case 'wp-generator':
            $createPages['latest']['code']['other'] .= "\t\t" . 'let param = {per_page: 100};' . "\r\n";
            break;
    }
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.books = this.ebookService.getBooks(param);' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.books.subscribe(data => {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'this.dataBooks = data ;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'this.dataChapters = [];' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'this.getChapters();' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|-- getChapters()
    $createPages['latest']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* LatestPage:getChapters()' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'public getChapters(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $createPages['latest']['code']['other'] .= "\t\t" . 'let param = {orderby:`chapter-date`,sort:`asc`};' . "\r\n";
            break;
        case 'wp-generator':
            $createPages['latest']['code']['other'] .= "\t\t" . 'let param = {per_page:100};' . "\r\n";
            break;
    }
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.chapters = this.ebookService.getChapters(param);' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.chapters.subscribe(data => {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'let itemId = 0;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . 'let thumbnail = this.getThumbnail(item.chapter_book.id);' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . 'this.dataChapters[itemId] = { id: item.chapter_book.id, chapter_number: item.chapter_number, title: item.chapter_book.rendered, thumbnail:thumbnail } ;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . 'itemId++;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'this.filterDataChapters = this.dataChapters;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|-- filterItems()
    $createPages['latest']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* LatestPage:filterItems($event)' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '*' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.filterDataChapters = this.dataChapters;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'this.filterDataChapters = this.dataChapters.filter((newItem) => {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . 'if(newItem.title){' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t\t" . 'return newItem.title.toLowerCase().indexOf(filterVal.toLowerCase()) > -1;' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|-- doRefresh()
    $createPages['latest']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* LatestPage:doRefresh()' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.dataBooks = [];' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.showBooks();' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LATEST --|-- CODE --|-- CODE --|-- OTHER --|-- ngOnInit()
    $createPages['latest']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '* LatestPage:ngOnInit()' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.dataBooks = [];' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t\t" . 'this.showBooks();' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['latest']['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- FAVORITES --|--
    $createPages['favorites'] = null;
    $createPages['favorites']['name'] = 'favorites';
    $createPages['favorites']['title'] = '{{"' . $addons['label-for-favorites'] . '"' . $pipe_translate . '}}';
    $createPages['favorites']['icon-left'] = 'heart-outline';


    $createPages['favorites']['content']['html'] = null;
    $createPages['favorites']['content']['html'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '<ion-grid *ngIf="dataFavorites.length != 0" >' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t" . '<ion-col class="ion-no-padding ion-no-margin" size="4" *ngFor="let item of dataFavorites">' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t" . '<ion-card class="ion-no-padding ion-no-margin" >' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t\t" . '<ion-button size="small" class="remove-btn ion-no-padding ion-no-margin" (click)="removeFavorite(item.book_id)" color="danger"><ion-icon name="trash-outline" ></ion-icon></ion-button>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item.book_thumbnail" [src]="item.book_thumbnail" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'detail\',item.book_id]"></ion-img>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="!item.book_thumbnail" src="assets/images/placeholder-480x480.png" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'detail\',item.book_id]"></ion-img>' . "\r\n";

    $createPages['favorites']['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content class="ion-no-padding ion-no-margin" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'detail\',item.book_id]">' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t\t\t" . '<p *ngIf="item.book_title"><span [innerHTML]="item.book_title | readMore:28"></span></p>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t\t" . '</ion-card-content>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '<ion-list class="empty-container" lines="none" *ngIf="dataFavorites.length == 0">' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '" class="empty-wrapper">' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t" . '<ion-icon class="empty-icon" name="heart-outline"></ion-icon>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t\t" . '<h3>{{"' . $addons['label-for-no-favorite'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $createPages['favorites']['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


    $createPages['favorites']['content']['scss'] = null;
    $createPages['favorites']['content']['scss'] .= '.empty-container{height: 100%;}' . "\r\n";
    $createPages['favorites']['content']['scss'] .= '.empty-wrapper{text-align: center;padding-top: 50%;}' . "\r\n";
    $createPages['favorites']['content']['scss'] .= '.empty-icon{font-size: 72px;}' . "\r\n";
    $createPages['favorites']['content']['scss'] .= '.empty-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";
    $createPages['favorites']['content']['scss'] .= '.remove-btn {position: absolute !important;right:3px !important;height: 24px !important;width: 24px !important;top: 3px !important;}' . "\r\n";

    $createPages['favorites']['content']['scss'] .= 'ion-card{margin:6px}' . "\r\n";
    $createPages['favorites']['content']['scss'] .= 'ion-card-content{margin:6px}' . "\r\n";

    $createPages['favorites']['code']['export'] = null;
    $createPages['favorites']['code']['constructor'] = null;
    $createPages['favorites']['code']['other'] = null;
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . 'dataFavorites:any = [];' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- FAVORITES --|-- CODE --|-- CODE --|-- OTHER --|-- getFavorites()
    $createPages['favorites']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '* FavoritesPage:getFavorites()' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . 'private getFavorites(){' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.storageService.getItems(`favorites`).then((items)=>{' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`get`,items);' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'this.dataFavorites = items;' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- FAVORITES --|-- CODE --|-- CODE --|-- OTHER --|-- removeHistory()
    $createPages['favorites']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '* FavoritesPage:removeFavorite(favId)' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . 'public removeFavorite(favId){' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`favorites`,favId).then((data)=>{' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`remove`,favId);' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'this.dataFavorites = [];' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'this.getFavorites();' . "\r\n";

    if ($addons['multiple-language'] == true)
    {
        $createPages['favorites']['code']['other'] .= "\t\t\t" . 'this.showToast(this.translateService.instant(`' . $addons['label-for-removed-from-favorite'] . '`));' . "\r\n";
    } else
    {
        $createPages['favorites']['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-removed-from-favorite'] . '`);' . "\r\n";
    }


    $createPages['favorites']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- FAVORITES --|-- CODE --|-- CODE --|-- OTHER --|-- doRefresh()
    $createPages['favorites']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '* FavoritesPage:doRefresh()' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.dataFavorites = [];' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.getFavorites();' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- FAVORITES --|-- CODE --|-- CODE --|-- OTHER --|-- ngOnInit()
    $createPages['favorites']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '* FavoritesPage:ngOnInit()' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.dataFavorites = [];' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t\t" . 'this.getFavorites();' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['favorites']['code']['other'] .= "\t" . '' . "\r\n";

    $createPages['favorites']['code']['init'] = null;

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- HISTORIES --|--
    $createPages['histories'] = null;
    $createPages['histories']['name'] = 'histories';
    $createPages['histories']['title'] = '{{"' . $addons['label-for-histories'] . '"' . $pipe_translate . '}}';
    $createPages['histories']['icon-left'] = 'timer-outline';
    $createPages['histories']['content']['html'] = null;

    // TODO: GENERATOR --|-- PAGE --|-- HISTORIES --|-- CONTENT --|-- HTML --|--
    $createPages['histories']['content']['html'] = null;
    $createPages['histories']['content']['html'] .= "\t" . '' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t" . '' . "\r\n";

    $createPages['histories']['content']['html'] .= "\t" . '<ion-list *ngIf="dataHistories.length != 0">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t" . '<ion-item-sliding *ngFor="let item of dataHistories.reverse()">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '<ion-item  [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'detail\',item.book_id]">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start" *ngIf="item && item.book_thumbnail">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t\t" . '<img [src]="item.book_thumbnail">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '<ion-thumbnail slot="start" *ngIf="!item || !item.book_thumbnail">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text></ion-skeleton-text>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '</ion-thumbnail>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t\t" . '<h3 [innerHTML]="item.book_title"></h3>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t\t" . '<p>{{"' . $addons['label-for-chapter'] . '"' . $pipe_translate . '}}: {{ item.last_chapter }}</p>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t\t" . '<p>{{ item.date_reading | timeAgo }}</p>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '<ion-item-options side="end">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '<ion-item-option (click)="removeHistory(item.histories_id)">{{"' . $addons['label-for-delete'] . '"' . $pipe_translate . '}}</ion-item-option>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '</ion-item-options>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t" . '</ion-item-sliding>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


    $createPages['histories']['content']['html'] .= "\t" . '<ion-list class="empty-container" lines="none" *ngIf="dataHistories.length == 0">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '" class="empty-wrapper">' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '<ion-icon class="empty-icon" name="timer-outline"></ion-icon>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t\t" . '<h3>{{"' . $addons['label-for-no-history'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $createPages['histories']['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


    $createPages['histories']['content']['scss'] = null;
    $createPages['histories']['content']['scss'] .= '.empty-container{height: 100%;}' . "\r\n";
    $createPages['histories']['content']['scss'] .= '.empty-wrapper{text-align: center;padding-top: 50%;}' . "\r\n";
    $createPages['histories']['content']['scss'] .= '.empty-icon{font-size: 72px;}' . "\r\n";
    $createPages['histories']['content']['scss'] .= '.empty-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";


    $createPages['histories']['code']['export'] = null;
    $createPages['histories']['code']['constructor'] = null;
    $createPages['histories']['code']['other'] = null;
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . 'dataHistories:any = [];' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HISTORIES --|-- CODE --|-- CODE --|-- OTHER --|-- getHistories()
    $createPages['histories']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '* HistoriesPage:getHistories()' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . 'private getHistories(){' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.storageService.getItems(`histories`).then((items)=>{' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t\t\t" . 'this.dataHistories = items;' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- HISTORIES --|-- CODE --|-- CODE --|-- OTHER --|-- removeHistory()
    $createPages['histories']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '* HistoriesPage:removeHistory(historyId)' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . 'public removeHistory(historyId:string){' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`histories`,historyId).then((data)=>{' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`histories`,`remove`,historyId);' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t\t" . 'this.dataHistories = [];' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t\t" . 'this.getHistories();' . "\r\n";
    if ($addons['multiple-language'] == true)
    {
        $createPages['histories']['code']['other'] .= "\t\t\t" . 'this.showToast(this.translateService.instant(`' . $addons['label-for-removed-from-history'] . '`));' . "\r\n";
    } else
    {
        $createPages['histories']['code']['other'] .= "\t\t\t" . 'this.showToast(`' . $addons['label-for-removed-from-history'] . '`);' . "\r\n";
    }
    $createPages['histories']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- HISTORIES --|-- CODE --|-- CODE --|-- OTHER --|-- doRefresh()
    $createPages['histories']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '* HistoriesPage:doRefresh()' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.dataHistories = [];' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.getHistories();' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- HISTORIES --|-- CODE --|-- CODE --|-- OTHER --|-- ngOnInit()
    $createPages['histories']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '* HistoriesPage:ngOnInit()' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.dataHistories = [];' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t\t" . 'this.getHistories();' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['histories']['code']['other'] .= "\t" . '' . "\r\n";

    $createPages['histories']['code']['init'] = null;

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- LIST --|--
    $createPages['list'] = null;
    $createPages['list']['name'] = 'list';
    $createPages['list']['header']['mid']['type'] = 'search';
    $createPages['list']['header']['mid']['search-label'] = $addons['label-for-search'];
    $createPages['list']['title'] = '{{"' . $addons['label-for-list'] . '"' . $pipe_translate . '}}';
    $createPages['list']['icon-left'] = 'apps-outline';
    $createPages['list']['content']['html'] = null;
    $createPages['list']['content']['html'] .= "\t" . '' . "\r\n";
    $createPages['list']['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t" . '' . "\r\n";

    $createPages['list']['content']['html'] .= "\t" . '<ion-list *ngIf="filterDataBooks.length != 0">' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t" . '<ion-item *ngFor="let item of filterDataBooks" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'detail\',item.book_id]">' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t\t" . '<ion-label [innerHTML]="item.book_title"></ion-label>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t\t" . '<ion-note slot="end" color="danger" [innerHTML]="item.book_status"></ion-note>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t" . '</ion-list>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t" . '<ion-list class="empty-container" lines="none" *ngIf="filterDataBooks.length == 0">' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '" class="empty-wrapper">' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t\t\t" . '<ion-icon class="empty-icon" name="book-outline"></ion-icon>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t\t\t" . '<h3>{{"' . $addons['label-for-no-books'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $createPages['list']['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


    $createPages['list']['content']['scss'] = null;
    $createPages['list']['content']['scss'] .= '.empty-container{height: 100%;}' . "\r\n";
    $createPages['list']['content']['scss'] .= '.empty-wrapper{text-align: center;padding-top: 50%;}' . "\r\n";
    $createPages['list']['content']['scss'] .= '.empty-icon{font-size: 72px;}' . "\r\n";
    $createPages['list']['content']['scss'] .= '.empty-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";


    $createPages['list']['code']['export'] = null;
    $createPages['list']['code']['constructor'] = null;
    $createPages['list']['code']['other'] = null;
    // TODO: GENERATOR --|-- PAGE --|-- LIST --|-- CODE --|-- CODE --|-- OTHER --|--
    $createPages['list']['code']['other'] = null;
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'books: Observable<any>;' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'dataBooks: any = [];' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'filterDataBooks: any = [];' . "\r\n";


    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LIST --|-- CODE --|-- CODE --|-- OTHER --|-- showBooks()
    $createPages['list']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '* ListPage:showBooks()' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'public showBooks(){' . "\r\n";


    switch ($addons['backend-used'])
    {
        case 'php-native':
            $createPages['list']['code']['other'] .= "\t\t" . 'let param = {sort :`asc`, orderby : `book-title` };' . "\r\n";
            break;
        case 'wp-generator':
            $createPages['list']['code']['other'] .= "\t\t" . 'let param = {per_page : 100 };' . "\r\n";
            break;

    }


    $createPages['list']['code']['other'] .= "\t\t" . 'this.books = this.ebookService.getBooks(param);' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.books.subscribe(data => {' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t" . 'this.dataBooks = data ;' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.filterDataBooks = this.dataBooks ;' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . '});' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LIST --|-- CODE --|-- CODE --|-- OTHER --|-- filterItems()
    $createPages['list']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '* ListPage:filterItems($event)' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '*' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.filterDataBooks = this.dataBooks ;' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t" . 'this.filterDataBooks = this.dataBooks.filter((newItem) => {' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t\t" . 'if(newItem.book_title){' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t\t\t" . 'return newItem.book_title.toLowerCase().indexOf(filterVal.toLowerCase()) > -1;' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . '}' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LIST --|-- CODE --|-- CODE --|-- OTHER --|-- doRefresh()
    $createPages['list']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '* ListPage:doRefresh()' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.dataBooks = [];' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.showBooks();' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- LIST --|-- CODE --|-- CODE --|-- OTHER --|-- ngOnInit()
    $createPages['list']['code']['other'] .= "\t" . '/**' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '* listPage:ngOnInit()' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '**/' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.dataBooks = [];' . "\r\n";
    $createPages['list']['code']['other'] .= "\t\t" . 'this.showBooks();' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '}' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";
    $createPages['list']['code']['other'] .= "\t" . '' . "\r\n";

    $createPages['list']['code']['init'] = null;

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- SETTINGS --|--
    //$createPages['settings'] = null;
    //$createPages['settings']['name'] = 'settings';
    //$createPages['settings']['title'] = 'Settings';
    //$createPages['settings']['icon-left'] = 'settings';
    //$createPages['settings']['content']['html'] = null;
    //$createPages['settings']['content']['scss'] = null;
    //$createPages['settings']['code']['export'] = null;
    //$createPages['settings']['code']['constructor'] = null;
    //$createPages['settings']['code']['other'] = null;
    //$createPages['settings']['code']['init'] = null;
    // TODO: ----------------------------------------------------------------------------------------------------
    foreach ($createPages as $createPage)
    {
        $var = $createPage['name'];
        // create properties for page
        $newPage = null;
        $newPage['title'] = $createPage['title'];
        $newPage['name'] = $createPage['name'];
        $newPage['code-by'] = 'ebook';
        $newPage['icon-left'] = $createPage['icon-left'];
        $newPage['icon-right'] = '';
        $newPage['header']['color'] = $addons['page-header-color'];
        $newPage['content']['color'] = 'none';
        $newPage['content']['custom-color'] = '#ffffff';
        $newPage['content']['background'] = $addons['page-content-background'];
        $newPage['statusbar']['style'] = 'lightcontent';
        $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);


        // TODO: GENERATOR --|-- PAGE --|-- LOOPS-TABS --|-- HEADER
        if (!isset($createPage['header']['mid']['type']))
        {
            $newPage['header']['mid']['type'] = 'title';
        } else
        {
            $newPage['header']['mid']['type'] = $createPage['header']['mid']['type'];
            $newPage['header']['mid']['search-label'] = $createPage['header']['mid']['search-label'];
        }

        $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
        $newPage['header']['mid']['items'][0]['value'] = 'tab1';
        $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
        $newPage['header']['mid']['items'][1]['value'] = 'tab2';
        $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
        $newPage['header']['mid']['items'][2]['value'] = 'tab3';

        // TODO: GENERATOR --|-- PAGE --|-- LOOPS-TABS --|-- MODULES
        $z = 0;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'Observable';
        $newPage['modules']['angular'][$z]['var'] = '';
        $newPage['modules']['angular'][$z]['path'] = 'rxjs';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'EbookService';
        $newPage['modules']['angular'][$z]['var'] = 'ebookService';
        $newPage['modules']['angular'][$z]['path'] = './../../services/ebook/ebook.service';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'StorageService';
        $newPage['modules']['angular'][$z]['var'] = 'storageService';
        $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';

        $z++;
        $newPage['modules']['angular'][$z]['enable'] = true;
        $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
        $newPage['modules']['angular'][$z]['var'] = 'loadingController';
        $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

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

        $newPage['footer'] = null;
        $newPage['footer']['color'] = 'none';
        $newPage['footer']['type'] = 'code';
        $newPage['footer']['title'] = '';
        $newPage['footer']['code'] = null;
        $newPage['footer']['code'] .= "\t" . '<ion-toolbar>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";
        foreach ($createPages as $tabPage)
        {
            $home_disable = '';
            if ($createPage['name'] == $tabPage['name'])
            {
                $home_disable = 'disabled="true"';
            }
            $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $home_disable . ' [routerDirection]="\'root\'" [routerLink]="[\'/' . $tabPage['name'] . '\']">' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">' . $tabPage['title'] . '</ion-label>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="' . $tabPage['icon-left'] . '"></ion-icon>' . "\r\n";
            $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";
        }

        $newPage['footer']['code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '</ion-toolbar>' . "\r\n";
        $newPage['footer']['code'] .= '';

        $newPage['content']['html'] = $createPage['content']['html'];
        $newPage['content']['scss'] = $createPage['content']['scss'];
        $newPage['code']['export'] = $createPage['code']['export'];
        $newPage['code']['constructor'] = $createPage['code']['constructor'];
        $newPage['code']['other'] = null;
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'loading:any;' . "\r\n";
        $newPage['code']['other'] .= $createPage['code']['other'];
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($createPage['name']) . 'Page.showToast($message)' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'position: `bottom`,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'color: `dark`,' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($createPage['name']) . 'Page.presentLoading()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
        if ($addons['multiple-language'] == true)
        {
            $newPage['code']['other'] .= "\t\t\t" . 'message: this.translateService.instant("' . $addons['label-for-please-wait'] . '"),' . "\r\n";
        } else
        {
            $newPage['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
        }
        $newPage['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'duration: 100' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
        $newPage['code']['other'] .= "\t" . '* ' . $string->toClassName($createPage['name']) . 'Page.dismissLoading()' . "\r\n";
        $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
        $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
        $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
        $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '}' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";
        $newPage['code']['other'] .= "\t" . '' . "\r\n";


        $newPage['code']['init'] = $createPage['code']['init'];


        //generate page code
        $db->savePage($newPage);
    }
    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|--
    // create properties for page
    $newPage = null;
    $newPage['title'] = '<span [innerHTML]="dataBook.book_title"></span>';
    $newPage['name'] = 'detail';
    $newPage['code-by'] = 'ebook';
    $newPage['icon-left'] = '';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['param'] = 'book_id';
    $newPage['back-button'] = '/auto';

    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'EbookService';
    $newPage['modules']['angular'][$z]['var'] = 'ebookService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/ebook/ebook.service';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';

    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CONTENT --|-- HTML

    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CONTENT --|-- HTML --|-- DETAIL
    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataBook">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-img *ngIf="dataBook && dataBook.book_cover" [src]="dataBook.book_cover"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-img *ngIf="!dataBook || !dataBook.book_cover" src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-segment [(ngModel)]="segmentMenu" class="segment" value="info" color="' . $addons['page-header-color'] . '" value="favorite">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-segment-button value="info">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>{{"' . $addons['label-for-info'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-segment-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-segment-button value="chapters">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-label>{{"' . $addons['label-for-chapters'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-segment-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-segment>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="segmentMenu==\'info\'">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h3 class="strong">{{"' . $addons['label-for-synopsis'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '<div *ngIf="dataBook && dataBook.book_synopsis">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<div [innerHTML]="dataBook.book_synopsis"></div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<div *ngIf="!dataBook || !dataBook.book_synopsis">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 88%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '<h3 class="strong">{{"' . $addons['label-for-genre'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<div *ngIf="dataBook && dataBook.book_genre">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-chip *ngFor="let item of dataBook.book_genre" >{{ item }}</ion-chip>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '<h3 class="strong">{{"' . $addons['label-for-complete-information'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<table class="table no-border">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>{{ "' . $addons['label-for-title'] . '"' . $pipe_translate . '}}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_title"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>{{ "' . $addons['label-for-alternative-title'] . '"' . $pipe_translate . '}}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_title_alt"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>{{ "' . $addons['label-for-author'] . '"' . $pipe_translate . '}}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_author"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>{{ "' . $addons['label-for-status'] . '"' . $pipe_translate . '}}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_status"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>{{ "' . $addons['label-for-date-released'] . '"' . $pipe_translate . '}}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_released | date:\'fullDate\'"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>{{ "' . $addons['label-for-publisher'] . '"' . $pipe_translate . '}}</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_publisher"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t\t" . '<tr>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>ISBN</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td>:</td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<td><ion-text class="strong" [innerHTML]="dataBook.book_isbn"></ion-text></td>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</tr>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '</table>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<div *ngIf="segmentMenu==\'chapters\'">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h4>{{ "' . $addons['label-for-chapters'] . '"' . $pipe_translate . '}}</h4>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-list *ngIf="dataChapters.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-item class="item-chapters" *ngFor="let item of dataChapters" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'chapter\',item.chapter_id]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-label class="item-chapters-label {{ checkAlreadyRead(item.chapter_id) }} ">{{ item.chapter_number | readMore:5 }} : <span [innerHTML]="item.chapter_title"></span></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-list>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-list *ngIf="dataChapters.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-item class="item-chapters">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-label class="">{{"' . $addons['label-for-chapter-not-available'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-list>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] = "\t" . 'td{padding-right: 0.5em !important;vertical-align: top !important;}' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t" . '<ion-footer *ngIf="dataBook && dataBook.book_title">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button *ngIf="isFavorite==false" color="medium" size="small" fill="outline" expand="block" (click)="addFavorite()" >' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="heart"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button *ngIf="isFavorite==true" color="danger" size="small" fill="outline" expand="block" (click)="removeFavorite()" >' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="heart"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-button *ngIf="dataChapters.length != 0" size="small" fill="outline" expand="block" color="' . $addons['page-header-color'] . '" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'chapter\',lastReadChapterId]">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t\t" . '<ion-label>{{"' . $addons['label-for-start-reading'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t" . '</ion-footer>' . "\r\n";

    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '//init' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'book: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataBook: any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'chapters: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataChapters: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'lastReadChapterId:string = ``;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'isFavorite:boolean = false;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'segmentMenu:string = `info`;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'alreadyRead: any = [];' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- addFavorite()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.addFavorite()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public addFavorite(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`favorites`,this.dataBook.book_id,this.dataBook).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`save`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- removeFavorite()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.removeFavorite()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeFavorite(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`favorites`,this.dataBook.book_id).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`remove`,this.dataBook.book_id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'checkFavorites:any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- ionViewDidEnter()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.ionViewDidEnter()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ionViewDidEnter(){' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// save the last read position' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`book-last-read`,this.bookId).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`book-last-read`,`get`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if( data && data.chapter_id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.lastReadChapterId = data.chapter_id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`read`,`continue`,this.lastReadChapterId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// check favorites regularly' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.checkFavorites = setInterval(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItem(`favorites`,this.bookId).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.isFavorite = false;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(data && data.book_id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.isFavorite = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},500);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '// chapter already read' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.getItems(`chapter-already-read`).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '//console.log(`storage`,`chapter-already-read`,`gets`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.alreadyRead = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- checkAlreadyRead(chapterId)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.checkAlreadyRead(chapterId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public checkAlreadyRead(chapterId:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let className:string = `visible strong`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.alreadyRead.forEach((val,key) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//console.log(chapterId,val.chapter_id);' . "\r\n";

    $newPage['code']['other'] .= "\t\t\t" . 'if(val && val.chapter_id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(chapterId == val.chapter_id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'className = `visible`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";

    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";

    $newPage['code']['other'] .= "\t\t" . 'return className;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- ionViewDidLeave()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.ionViewDidLeave()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ionViewDidLeave(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'clearInterval(this.checkFavorites);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- getBook()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.getBook()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getBook(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.book = this.ebookService.getBook(this.bookId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.book.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataBook = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.setItem(`books`,data.book_id,data).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'console.log(`storage`,`books`,`save`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- getChapters()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage:getChapters()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getChapters(){' . "\r\n";


    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {sort:`desc`,orderby:`chapter-number`,"chapter-book":this.bookId};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {"chapter-book" : this.bookId };' . "\r\n";
            break;
    }

    $newPage['code']['other'] .= "\t\t" . 'this.chapters = this.ebookService.getChapters(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.chapters.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataChapters = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data && data[0] && data[0].chapter_id){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(this.lastReadChapterId ==``){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.lastReadChapterId = data[0].chapter_id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'console.log(`read`,`start`,this.lastReadChapterId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBook = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getBook();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataChapters = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getChapters();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- DETAIL --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBook = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getBook();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataChapters = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getChapters();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    //generate page code
    $db->savePage($newPage);

    // TODO: ----------------------------------------------------------------------------------------------------
    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|--
    // create properties for page
    $newPage = null;
    $newPage['title'] = '' . $addons['label-for-chapter'] . ': <ion-text *ngIf="dataChapter && dataChapter.chapter_number ">{{ dataChapter.chapter_number | readMore:5 }}</ion-text>';
    $newPage['name'] = 'chapter';
    $newPage['code-by'] = 'ebook';
    $newPage['icon-left'] = '';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'dark';
    //$newPage['content']['custom-color'] = '#ffffff';
    //$newPage['content']['background'] = $addons['page-content-background'];
    $newPage['param'] = 'chapter_id';
    $newPage['back-button'] = '/auto';

    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- HEADER
    $newPage['header']['mid']['type'] = 'none';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'EbookService';
    $newPage['modules']['angular'][$z]['var'] = 'ebookService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/ebook/ebook.service';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'StorageService';
    $newPage['modules']['angular'][$z]['var'] = 'storageService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/storage/storage.service';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'LoadingController';
    $newPage['modules']['angular'][$z]['var'] = 'loadingController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

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

    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    switch ($addons['content-type'])
    {
        case 'html':

            $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="dataChapter && dataChapter.chapter_title">' . "\r\n";

            $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle>{{"' . $addons['label-for-chapter'] . '"' . $pipe_translate . '}} {{ dataChapter.chapter_number | readMore:5 }}</ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title [innerHTML]="dataChapter.chapter_title | trustHtml"></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";

            $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<div [innerHTML]="dataChapter.chapter_content | trustHtml"></div>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="!dataChapter || !dataChapter.chapter_title">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 20%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></ion-card-title>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-header>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 60%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-skeleton-text animated style="width: 90%"></ion-skeleton-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

            // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- FOOTER
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';
            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '' . "\r\n";
            break;
        case 'images':
            $newPage['content']['enable-fullscreen'] = true;
            $newPage['content']['disable-scroll'] = false;

            $newPage['content']['html'] .= "\t" . '<div *ngIf="dataChapter && dataChapter.chapter_number">' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '<div class="image-container" *ngFor="let image of dataChapter.chapter_pages">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<a *ngIf="image" imageZoom image="{{ image }}"><img class="image" [src]="image" /></a>' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</div>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";

            $newPage['content']['scss'] = null;
            $newPage['content']['scss'] .= '.image-container, .img{border: 0px !important;padding:0 !important;margin:0 !important;width: 100% !important;}' . "\r\n";

            // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- FOOTER
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';
            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '' . "\r\n";


            break;

        case 'document':


            $newPage['content']['enable-fullscreen'] = false;
            $newPage['content']['disable-scroll'] = false;

            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";

            $newPage['content']['html'] .= "\t\t" . '<ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-item-divider>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-use-app'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-item-divider>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-item button="true" lines="none" googlePlayApp app-id="com.google.android.apps.pdfviewer">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="https://play-lh.googleusercontent.com/u9ofV9e2diX3giScuXT46B4A0vxFw8tj5NzHQJVAqAKwL5b_o8CHnO-qiZZIZYHlTg=s180"></ion-img>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-text>Google PDF Viewer</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '<ion-item button="true" lines="none" googlePlayApp app-id="cn.wps.moffice_eng">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-avatar slot="start">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img src="https://play-lh.googleusercontent.com/7-CBOICJrtltP-Ndzq-c8Vugt1FTsy2vw-SZUZ5ov0BY7XgDrVeltTwtyhjVbxh943M=s180"></ion-img>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-avatar>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-text>WPS Office</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-label>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";

            $newPage['content']['html'] .= "\t\t\t" . '<ion-item lines="none" *ngIf="dataChapter && dataChapter.chapter_doc_url" >' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '<ion-button color="' . $addons['page-header-color'] . '" size="normal" slot="end" previewAnyFile src="{{ dataChapter.chapter_doc_url }}">' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-open'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-icon slot="end" name="arrow-forward-outline"></ion-icon>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t\t" . '</ion-button>' . "\r\n";
            $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t\t" . '</ion-list>' . "\r\n";
            $newPage['content']['html'] .= "\t" . '' . "\r\n";
            $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

            $newPage['content']['scss'] = null;
            $newPage['content']['scss'] .= '' . "\r\n";

            // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- FOOTER
            $newPage['footer']['color'] = 'none';
            $newPage['footer']['type'] = 'code';
            $newPage['footer']['title'] = '';
            $newPage['footer']['code'] = null;
            $newPage['footer']['code'] .= "\t" . '' . "\r\n";


            break;

    }


    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    switch ($addons['content-type'])
    {
        case 'html':
            break;
        case 'images':
            break;
    }


    $newPage['code']['other'] .= "\t" . 'chapter: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataChapter: any = {};' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'chapters: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataChapters: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['other'] .= "\t" . 'currChapter:string = null ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'nextChapter:string = null ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'backChapter:string = null ;' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- CODE --|-- OTHER --|-- saveHistories()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ChapterPage.saveHistories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private saveHistories(bookId:string,chapter:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let today: Date = new Date();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let timeReading:string  = today.getTime().toString();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItem(`books`,bookId).then((bookData)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`books`,bookId,`get`,bookData);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '// update histories' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let recentBookData: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'histories_id: timeReading,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_id: chapter.chapter_book.id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_title: bookData.book_title,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_thumbnail: bookData.book_thumbnail,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'last_chapter: chapter.chapter_number,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'date_reading: today.getTime()' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.clearItemsWhere(`histories`,`book_id`,bookId).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.storageService.setItem(`histories`,timeReading,recentBookData).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'console.log(`storage`,`histories`,`save`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//last chapter read' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let lastRead: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_id: bookId,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_title: bookData.book_title,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'chapter_id: chapter.chapter_id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.setItem(`book-last-read`,bookId,lastRead).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`storage`,`book-last-read`,`save`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '//already read' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let alreadyRead: any = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_id: bookId,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'book_title: bookData.book_title,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'chapter_id: chapter.chapter_id,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '};' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.storageService.setItem(`chapter-already-read`,chapter.chapter_id,alreadyRead).then((data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'console.log(`storage`,`chapter-already-read`,`save`,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- CODE --|-- OTHER --|-- getBackNextChapter()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* DetailPage:getBackNextChapter(bookId,CapterId)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getBackNextChapter(bookId,CapterId){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {sort:`asc`,orderby:`chapter-number`,"chapter-book":bookId};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {order: `asc`, "chapter-book" : bookId };' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.chapters = this.ebookService.getChapters(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.chapters.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.currChapter = CapterId ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let currIndex:number = 0;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let nextIndex:number =  1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let backIndex:number = -1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'for (let item of data) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'nextIndex = currIndex + 1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'backIndex = currIndex - 1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(item.chapter_id == CapterId){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'if(data[nextIndex]){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.nextChapter = data[nextIndex].chapter_id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'if(data[backIndex]){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.backChapter = data[backIndex].chapter_id ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'currIndex++;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`Chapter`,`Next`,this.nextChapter);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`Chapter`,`Current`,this.currChapter);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`Chapter`,`Back`,this.backChapter);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- CODE --|-- OTHER --|-- getChapter()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ChapterPage.getChapter()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'private getChapter(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.chapter = this.ebookService.getChapter(this.chapterId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.chapter.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataChapter = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.saveHistories(data.chapter_book.id,data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.dataChapters = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.getBackNextChapter(data.chapter_book.id,this.chapterId);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ChapterPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataChapter = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getChapter();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ChapterPage.doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataChapter = {};' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getChapter();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(refresher);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- CHAPTER --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid *ngIf="dataChapter && dataChapter.chapter_book && dataChapter.chapter_book.id">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="backChapter != null" [routerDirection]="\'forward\'" [routerLink]="[\'/chapter\',backChapter]" color="' . $addons['page-header-color'] . '" size="small" fill="solid" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button disabled="true" *ngIf="backChapter == null" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button [routerDirection]="\'forward\'" [routerLink]="[\'/detail/\',dataChapter.chapter_book.id]" color="' . $addons['page-header-color'] . '" size="small" fill="solid" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="list-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-text *ngIf="dataChapter && dataChapter.chapter_number ">{{ dataChapter.chapter_number | readMore:5 }}</ion-text>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button (click)="ngOnInit()" color="' . $addons['page-header-color'] . '" size="small" fill="solid" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="reload-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button *ngIf="nextChapter != null" [routerDirection]="\'forward\'" [routerLink]="[\'/chapter\',nextChapter]" color="' . $addons['page-header-color'] . '" size="small" fill="solid" expand="block">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-forward-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button disabled="true" *ngIf="nextChapter == null" size="small" fill="solid" expand="block" color="' . $addons['page-header-color'] . '">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t\t" . '<ion-icon slot="icon-only" name="arrow-forward-outline"></ion-icon>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '</ion-button>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";

    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";


    //generate page code
    $db->savePage($newPage);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=ebook&' . time());

}
// TODO: ----------------------------------------------------------------------------------------------------
// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
$current_setting = $db->getAddOns('ebook', 'core');
if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['backend-used']))
{
    $current_setting['backend-used'] = 'php-native';
}

if (!isset($current_setting['label-for-connection-lost']))
{
    $current_setting['label-for-connection-lost'] = 'Connection lost, please check your connection!';
}

if (!isset($current_setting['label-for-books']))
{
    $current_setting['label-for-books'] = 'Books';
}

if (!isset($current_setting['label-for-chapters']))
{
    $current_setting['label-for-chapters'] = 'Chapters';
}

if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'Okey';
}

if (!isset($current_setting['api-url']))
{
    $current_setting['api-url'] = '';
}

if (!isset($current_setting['label-for-info']))
{
    $current_setting['label-for-info'] = 'Info';
}

if (!isset($current_setting['label-for-start-reading']))
{
    $current_setting['label-for-start-reading'] = 'Start Reading';
}

if (!isset($current_setting['label-for-complete-information']))
{
    $current_setting['label-for-complete-information'] = 'Complete Information';
}

if (!isset($current_setting['label-for-synopsis']))
{
    $current_setting['label-for-synopsis'] = 'Synopsis';
}

if (!isset($current_setting['label-for-title']))
{
    $current_setting['label-for-title'] = 'Title';
}

if (!isset($current_setting['label-for-alternative-title']))
{
    $current_setting['label-for-alternative-title'] = 'Alternative Title';
}

if (!isset($current_setting['label-for-author']))
{
    $current_setting['label-for-author'] = 'Author';
}

if (!isset($current_setting['label-for-status']))
{
    $current_setting['label-for-status'] = 'Status';
}

if (!isset($current_setting['label-for-date-released']))
{
    $current_setting['label-for-date-released'] = 'Date Released';
}

if (!isset($current_setting['label-for-publisher']))
{
    $current_setting['label-for-publisher'] = 'Publisher';
}

if (!isset($current_setting['label-for-dashboard']))
{
    $current_setting['label-for-dashboard'] = 'Dashboard';
}

if (!isset($current_setting['label-for-home']))
{
    $current_setting['label-for-home'] = 'Home';
}

if (!isset($current_setting['label-for-latest']))
{
    $current_setting['label-for-latest'] = 'Latest';
}

if (!isset($current_setting['label-for-favorites']))
{
    $current_setting['label-for-favorites'] = 'Favorites';
}

if (!isset($current_setting['label-for-histories']))
{
    $current_setting['label-for-histories'] = 'Histories';
}
if (!isset($current_setting['label-for-list']))
{
    $current_setting['label-for-list'] = 'List';
}

if (!isset($current_setting['label-for-settings']))
{
    $current_setting['label-for-settings'] = 'Settings';
}

if (!isset($current_setting['label-for-help']))
{
    $current_setting['label-for-help'] = 'Help';
}

if (!isset($current_setting['label-for-about-us']))
{
    $current_setting['label-for-about-us'] = 'About Us';
}

if (!isset($current_setting['label-for-privacy-policy']))
{
    $current_setting['label-for-privacy-policy'] = 'Privacy Policy';
}

if (!isset($current_setting['label-for-rate-this-app']))
{
    $current_setting['label-for-rate-this-app'] = 'Rate This App';
}


if (!isset($current_setting['label-for-chapter']))
{
    $current_setting['label-for-chapter'] = 'Chapter';
}

if (!isset($current_setting['label-for-delete']))
{
    $current_setting['label-for-delete'] = 'Delete';
}

if (!isset($current_setting['label-for-clear']))
{
    $current_setting['label-for-clear'] = 'Clear';
}

if (!isset($current_setting['label-for-removed-from-history']))
{
    $current_setting['label-for-removed-from-history'] = 'Item has been removed from history';
}

if (!isset($current_setting['label-for-no-history']))
{
    $current_setting['label-for-no-history'] = 'No History';
}

if (!isset($current_setting['label-for-removed-from-favorite']))
{
    $current_setting['label-for-removed-from-favorite'] = 'Item has been removed from favorite';
}

if (!isset($current_setting['label-for-no-favorite']))
{
    $current_setting['label-for-no-favorite'] = 'No Favorite';
}
if (!isset($current_setting['label-for-no-books']))
{
    $current_setting['label-for-no-books'] = 'There are no books';
}


if (!isset($current_setting['content-type']))
{
    $current_setting['content-type'] = 'html';
}
if (!isset($current_setting['label-for-genre']))
{
    $current_setting['label-for-genre'] = 'Genre';
}

if (!isset($current_setting['label-for-dark-mode']))
{
    $current_setting['label-for-dark-mode'] = 'Dark Mode';
}
if (!isset($current_setting['label-for-chapter-not-available']))
{
    $current_setting['label-for-chapter-not-available'] = 'Chapters not yet available!';
}


if (!isset($current_setting['label-for-open']))
{
    $current_setting['label-for-open'] = 'Open';
}

if (!isset($current_setting['label-for-use-app']))
{
    $current_setting['label-for-use-app'] = 'Use apps:';
}

if (!isset($current_setting['multiple-language']))
{
    $current_setting['multiple-language'] = false;
}


if (!isset($current_setting['label-for-select-language']))
{
    $current_setting['label-for-select-language'] = 'Select Language?';
}

if (!isset($current_setting['label-for-search']))
{
    $current_setting['label-for-search'] = 'Search';
}

// TODO: LAYOUT --|-- FORM
$content .= '<form action="" method="post"><!-- ./form -->';
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

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="ebook[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="ebook[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
// TODO: LAYOUT --|-- FORM --|-- BACKEND-USED --|-- SELECT
$content .= '<div class="row"><!-- row -->';

$options = array();
$options[] = array('value' => 'wp-generator', 'label' => 'WordPress Plugin Generator');
$options[] = array('value' => 'php-native', 'label' => 'PHP Native Generator');


$content .= '<div id="field-backend-used" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-backend-used">' . __e('Backend Used') . '</label>';
$content .= '<select id="page-backend-used" name="ebook[backend-used]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['backend-used'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('What backend do you want to use?') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- API-URL --|-- TEXT

$content .= '<div id="field-api-url" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-api-url">' . __e('API URL') . '</label>';
$content .= '<input id="page-api-url" type="text" name="ebook[api-url]" class="form-control" placeholder="https://site/restapi.php"  value="' . $current_setting['api-url'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Root end point address, such as: https://site/restapi.php or https://your-wp') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- OPTIONS
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-auto-menu" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Options') . '</label>';

$content .= '<table class="table">';

// TODO: LAYOUT --|-- FORM --|-- OPTIONS --|-- MULTI-LANGUAGE
$content .= '<tr>';
if ($current_setting['multiple-language'] == true)
{
    $content .= '<td style="width:30px"><input checked="checked" class="flat-red" type="checkbox" id="page-multiple-language" name="ebook[multiple-language]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td style="width:30px"><input class="flat-red" type="checkbox" id="page-multiple-language" name="ebook[multiple-language]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Multiple Language Support') . '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- CONTENT-TYPE --|-- SELECT


$options = array();
$options[] = array('value' => 'html', 'label' => 'HTML Format (Stories App, Holy Book, Recipe Book, Prayer Book)');
$options[] = array('value' => 'images', 'label' => 'Images (Comics App, Manga App, Manhwa App or Manhua App)');
$options[] = array('value' => 'document', 'label' => 'Documents (Open PDF, Word, or other files using the Default App)');

$content .= '<div id="field-content-type" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-content-type">' . __e('Content Type') . '</label>';
$content .= '<select id="page-content-type" name="ebook[content-type]" class="form-control" ' . $disabled . ' >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['content-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('The type of content used') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-ebook" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';

$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('BackEnd') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('Addons will configure the table or database and backend codes automatically, after you save/upload the settings please install the backend on the desired server') . '</p>';
switch ($current_setting['backend-used'])
{
    case 'php-native':
        $content .= '<h4>PHP Native Generator</h4>';
        $content .= '<p><a class="btn btn-success" target="_blank" href="./?p=php-native-generator">Download</a></p>';
        break;
    case 'wp-generator':
        $content .= '<h4>WordPress Plugin Generator</h4>';
        $content .= '<p><a class="btn btn-success" target="_blank" href="./?p=wp-plugin-generator">Download</a></p>';
        break;
}


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-7 -->';


$content .= '<div class="col-md-5"><!-- col-md-5 -->';
//----------------------------------------------------------------------

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DASHBOARD --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-dashboard" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dashboard">' . __e('Label for `Dashboard`') . '</label>';
$content .= '<input id="page-label-for-dashboard" type="text" name="ebook[label-for-dashboard]" class="form-control" placeholder="Dashboard"  value="' . $current_setting['label-for-dashboard'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Dashboard`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HOME --|-- TEXT

$content .= '<div id="field-label-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-home">' . __e('Label for `Home`') . '</label>';
$content .= '<input id="page-label-for-home" type="text" name="ebook[label-for-home]" class="form-control" placeholder="Home"  value="' . $current_setting['label-for-home'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Home`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LATEST --|-- TEXT

$content .= '<div id="field-label-for-latest" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-latest">' . __e('Label for `Latest`') . '</label>';
$content .= '<input id="page-label-for-latest" type="text" name="ebook[label-for-latest]" class="form-control" placeholder="Latest"  value="' . $current_setting['label-for-latest'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Latest`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FAVORITES --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-favorites" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-favorites">' . __e('Label for `Favorites`') . '</label>';
$content .= '<input id="page-label-for-favorites" type="text" name="ebook[label-for-favorites]" class="form-control" placeholder="Favorites"  value="' . $current_setting['label-for-favorites'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Favorites`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HISTORIES --|-- TEXT

$content .= '<div id="field-label-for-histories" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-histories">' . __e('Label for `Histories`') . '</label>';
$content .= '<input id="page-label-for-histories" type="text" name="ebook[label-for-histories]" class="form-control" placeholder="Histories"  value="' . $current_setting['label-for-histories'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Histories`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LIST --|-- TEXT

$content .= '<div id="field-label-for-list" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-list">' . __e('Label for `List`') . '</label>';
$content .= '<input id="page-label-for-list" type="text" name="ebook[label-for-list]" class="form-control" placeholder="List"  value="' . $current_setting['label-for-list'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `List`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONNECTION-LOST --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-connection-lost" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-connection-lost">' . __e('Label for `Connection lost`') . '</label>';
$content .= '<input id="page-label-for-connection-lost" type="text" name="ebook[label-for-connection-lost]" class="form-control" placeholder="Connection lost, please check your connection!"  value="' . $current_setting['label-for-connection-lost'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Connection lost, please check your connection!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-BOOKS --|-- TEXT

$content .= '<div id="field-label-for-books" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-books">' . __e('Label for `Books`') . '</label>';
$content .= '<input id="page-label-for-books" type="text" name="ebook[label-for-books]" class="form-control" placeholder="Ebooks"  value="' . $current_setting['label-for-books'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Ebooks`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CHAPTERS --|-- TEXT

$content .= '<div id="field-label-for-books" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-chapters">' . __e('Label for `Chapters`') . '</label>';
$content .= '<input id="page-label-for-chapters" type="text" name="ebook[label-for-chapters]" class="form-control" placeholder="Chapters"  value="' . $current_setting['label-for-chapters'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Chapters`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT
$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="ebook[label-for-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT
$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `Okey`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="ebook[label-for-ok]" class="form-control" placeholder="Okey"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Okey`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-INFO --|-- TEXT

$content .= '<div id="field-label-for-info" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-info">' . __e('Label for `Info`') . '</label>';
$content .= '<input id="page-label-for-info" type="text" name="ebook[label-for-info]" class="form-control" placeholder="Info"  value="' . $current_setting['label-for-info'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Info`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-START-READING --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-start-reading" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-start-reading">' . __e('Label for `Start Reading`') . '</label>';
$content .= '<input id="page-label-for-start-reading" type="text" name="ebook[label-for-start-reading]" class="form-control" placeholder="Start Reading"  value="' . $current_setting['label-for-start-reading'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Start Reading`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COMPLETE-INFORMATION --|-- TEXT

$content .= '<div id="field-label-for-complete-information" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-complete-information">' . __e('Label for `Complete Information`') . '</label>';
$content .= '<input id="page-label-for-complete-information" type="text" name="ebook[label-for-complete-information]" class="form-control" placeholder="Complete Information"  value="' . $current_setting['label-for-complete-information'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Complete Information`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SYNOPSIS --|-- TEXT

$content .= '<div id="field-label-for-synopsis" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-synopsis">' . __e('Label for `Synopsis`') . '</label>';
$content .= '<input id="page-label-for-synopsis" type="text" name="ebook[label-for-synopsis]" class="form-control" placeholder="Synopsis"  value="' . $current_setting['label-for-synopsis'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Synopsis`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-TITLE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-title" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-title">' . __e('Label for `Title`') . '</label>';
$content .= '<input id="page-label-for-title" type="text" name="ebook[label-for-title]" class="form-control" placeholder="Title"  value="' . $current_setting['label-for-title'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Title`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ALTERNATIVE-TITLE --|-- TEXT

$content .= '<div id="field-label-for-alternative-title" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-alternative-title">' . __e('Label for `Alternative Title`') . '</label>';
$content .= '<input id="page-label-for-alternative-title" type="text" name="ebook[label-for-alternative-title]" class="form-control" placeholder="Alternative Title"  value="' . $current_setting['label-for-alternative-title'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Alternative Title`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-AUTHOR --|-- TEXT

$content .= '<div id="field-label-for-author" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-author">' . __e('Label for `Author`') . '</label>';
$content .= '<input id="page-label-for-author" type="text" name="ebook[label-for-author]" class="form-control" placeholder="Author"  value="' . $current_setting['label-for-author'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Author`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-STATUS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-status" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-status">' . __e('Label for `Status`') . '</label>';
$content .= '<input id="page-label-for-status" type="text" name="ebook[label-for-status]" class="form-control" placeholder="Status"  value="' . $current_setting['label-for-status'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Status`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DATE-RELEASED --|-- TEXT

$content .= '<div id="field-label-for-date-released" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-date-released">' . __e('Label for `Date Released`') . '</label>';
$content .= '<input id="page-label-for-date-released" type="text" name="ebook[label-for-date-released]" class="form-control" placeholder="Date Released"  value="' . $current_setting['label-for-date-released'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Date Released`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PUBLISHER --|-- TEXT

$content .= '<div id="field-label-for-publisher" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-publisher">' . __e('Label for `Publisher`') . '</label>';
$content .= '<input id="page-label-for-publisher" type="text" name="ebook[label-for-publisher]" class="form-control" placeholder="Publisher"  value="' . $current_setting['label-for-publisher'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Publisher`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SETTINGS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-settings" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-settings">' . __e('Label for `Settings`') . '</label>';
$content .= '<input id="page-label-for-settings" type="text" name="ebook[label-for-settings]" class="form-control" placeholder="Settings"  value="' . $current_setting['label-for-settings'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Settings`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HELP --|-- TEXT

$content .= '<div id="field-label-for-help" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-help">' . __e('Label for `Help`') . '</label>';
$content .= '<input id="page-label-for-help" type="text" name="ebook[label-for-help]" class="form-control" placeholder="Help"  value="' . $current_setting['label-for-help'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Help`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ABOUT-US --|-- TEXT

$content .= '<div id="field-label-for-about-us" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-about-us">' . __e('Label for `About Us`') . '</label>';
$content .= '<input id="page-label-for-about-us" type="text" name="ebook[label-for-about-us]" class="form-control" placeholder="About Us"  value="' . $current_setting['label-for-about-us'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `About Us`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRIVACY-POLICY --|-- TEXT

$content .= '<div id="field-label-for-privacy-policy" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-privacy-policy">' . __e('Label for `Privacy Policy`') . '</label>';
$content .= '<input id="page-label-for-privacy-policy" type="text" name="ebook[label-for-privacy-policy]" class="form-control" placeholder="Privacy Policy"  value="' . $current_setting['label-for-privacy-policy'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Privacy Policy`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-RATE-THIS-APP --|-- TEXT

$content .= '<div id="field-label-for-rate-this-app" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-rate-this-app">' . __e('Label for `Rate This App`') . '</label>';
$content .= '<input id="page-label-for-rate-this-app" type="text" name="ebook[label-for-rate-this-app]" class="form-control" placeholder="Rate This App"  value="' . $current_setting['label-for-rate-this-app'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Rate This App`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CHAPTER --|-- TEXT

$content .= '<div id="field-label-for-chapter" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-chapter">' . __e('Label for `Chapter`') . '</label>';
$content .= '<input id="page-label-for-chapter" type="text" name="ebook[label-for-chapter]" class="form-control" placeholder="Chapter"  value="' . $current_setting['label-for-chapter'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Chapter`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DELETE --|-- TEXT

$content .= '<div id="field-label-for-delete" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-delete">' . __e('Label for `Delete`') . '</label>';
$content .= '<input id="page-label-for-delete" type="text" name="ebook[label-for-delete]" class="form-control" placeholder="Delete"  value="' . $current_setting['label-for-delete'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Delete`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CLEAR --|-- TEXT

$content .= '<div id="field-label-for-clear" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-clear">' . __e('Label for `Clear`') . '</label>';
$content .= '<input id="page-label-for-clear" type="text" name="ebook[label-for-clear]" class="form-control" placeholder="Clear"  value="' . $current_setting['label-for-clear'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Clear`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-REMOVED-FROM-HISTORY --|-- TEXT

$content .= '<div id="field-label-for-removed-from-history" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-removed-from-history">' . __e('Label for `Item has been removed from history`') . '</label>';
$content .= '<input id="page-label-for-removed-from-history" type="text" name="ebook[label-for-removed-from-history]" class="form-control" placeholder="Item has been removed from history"  value="' . $current_setting['label-for-removed-from-history'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Item has been removed from history`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-HISTORY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-history" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-history">' . __e('Label for `No History`') . '</label>';
$content .= '<input id="page-label-for-no-history" type="text" name="ebook[label-for-no-history]" class="form-control" placeholder="No History"  value="' . $current_setting['label-for-no-history'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No History`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-REMOVED-FROM-FAVORITE --|-- TEXT

$content .= '<div id="field-label-for-removed-from-favorite" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-removed-from-favorite">' . __e('Label for `Item has been removed from favorite`') . '</label>';
$content .= '<input id="page-label-for-removed-from-favorite" type="text" name="ebook[label-for-removed-from-favorite]" class="form-control" placeholder="Item has been removed from favorite"  value="' . $current_setting['label-for-removed-from-favorite'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Item has been removed from favorite`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-FAVORITE --|-- TEXT

$content .= '<div id="field-label-for-no-favorite" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-favorite">' . __e('Label for `No Favorite`') . '</label>';
$content .= '<input id="page-label-for-no-favorite" type="text" name="ebook[label-for-no-favorite]" class="form-control" placeholder="No Favorite"  value="' . $current_setting['label-for-no-favorite'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `No Favorite`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-BOOKS --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-books" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-books">' . __e('Label for `There are no books`') . '</label>';
$content .= '<input id="page-label-for-no-books" type="text" name="ebook[label-for-no-books]" class="form-control" placeholder="There are no books"  value="' . $current_setting['label-for-no-books'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for  `There are no books`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-GENRE --|-- TEXT

$content .= '<div id="field-label-for-genre" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-genre">' . __e('Label for `Genre` or `Tags`') . '</label>';
$content .= '<input id="page-label-for-genre" type="text" name="ebook[label-for-genre]" class="form-control" placeholder="Genre"  value="' . $current_setting['label-for-genre'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Genre` or `Tags`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DARK-MODE --|-- TEXT

$content .= '<div id="field-label-for-dark-mode" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dark-mode">' . __e('Label for `Dark Mode`') . '</label>';
$content .= '<input id="page-label-for-dark-mode" type="text" name="ebook[label-for-dark-mode]" class="form-control" placeholder="Dark Mode"  value="' . $current_setting['label-for-dark-mode'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Dark Mode`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CHAPTER-NOT-AVAILABLE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-chapter-not-available" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-chapter-not-available">' . __e('Label for `Chapters not available!`') . '</label>';
$content .= '<input id="page-label-for-chapter-not-available" type="text" name="ebook[label-for-chapter-not-available]" class="form-control" placeholder="Chapters not yet available!"  value="' . $current_setting['label-for-chapter-not-available'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Chapters not yet available!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OPEN --|-- TEXT

$content .= '<div id="field-label-for-open" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-open">' . __e('Label for `Open`') . '</label>';
$content .= '<input id="page-label-for-open" type="text" name="ebook[label-for-open]" class="form-control" placeholder="Open"  value="' . $current_setting['label-for-open'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Open`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-USE-APPS--|-- TEXT

$content .= '<div id="field-label-for-use-app" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-use-app">' . __e('Label for `Use Apps:`') . '</label>';
$content .= '<input id="page-label-for-use-app" type="text" name="ebook[label-for-use-app]" class="form-control" placeholder="Use Apps:"  value="' . $current_setting['label-for-use-app'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Use Apps:`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SELECT-LANGUAGE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-select-language" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-select-language">' . __e('Label for `Select Language?`') . '</label>';
$content .= '<input id="page-label-for-select-language" type="text" name="ebook[label-for-select-language]" class="form-control" placeholder="Select Language?"  value="' . $current_setting['label-for-select-language'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Select Language?`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SEARCH --|-- TEXT

$content .= '<div id="field-label-for-search" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-search">' . __e('Label for `Search`') . '</label>';
$content .= '<input id="page-label-for-search" type="text" name="ebook[label-for-search]" class="form-control" placeholder="Search"  value="' . $current_setting['label-for-search'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Search`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-ebook" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=ebook&page-target="+$("#page-target").val(),!1});';
