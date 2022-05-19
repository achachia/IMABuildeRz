<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `quote`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = true;
$prefix_addons = 'quote';

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("quote");
$string = new jsmString();

$current_page_target = 'core';

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('quote', $current_page_target);
    header('Location: ./?p=addons&addons=quote&' . time());
}

// TODO: POST
if (isset($_POST['save-quote']))
{

    // save addons setting
    $addons = array();
    // TODO: POST --|-- RESPONSE
    $addons['page-title'] = 'core';
    $addons['page-target'] = 'core';
    $addons['page-header-color'] = trim($_POST[$prefix_addons]['page-header-color']);
    $addons['page-content-background'] = trim($_POST[$prefix_addons]['page-content-background']);

    //backend-used
    $addons['backend-used'] = trim($_POST[$prefix_addons]['backend-used']); //select
    //api-url
    $addons['api-url'] = trim($_POST[$prefix_addons]['api-url']); //url

    //multiple-language
    // checkbox
    if (isset($_POST[$prefix_addons]['multiple-language']))
    {
        $addons['multiple-language'] = true;
    } else
    {
        $addons['multiple-language'] = false;
    }

    //label-for-dashboard
    if (!isset($_POST[$prefix_addons]['label-for-dashboard']))
    {
        $_POST[$prefix_addons]['label-for-dashboard'] = 'Dashboard';
    }
    $addons['label-for-dashboard'] = trim($_POST[$prefix_addons]['label-for-dashboard']); //text

    //label-for-latest
    if (!isset($_POST[$prefix_addons]['label-for-latest']))
    {
        $_POST[$prefix_addons]['label-for-latest'] = 'Latest';
    }
    $addons['label-for-latest'] = trim($_POST[$prefix_addons]['label-for-latest']); //text

    //label-for-list
    if (!isset($_POST[$prefix_addons]['label-for-list']))
    {
        $_POST[$prefix_addons]['label-for-list'] = 'List';
    }
    $addons['label-for-list'] = trim($_POST[$prefix_addons]['label-for-list']); //text

    //label-for-help
    if (!isset($_POST[$prefix_addons]['label-for-help']))
    {
        $_POST[$prefix_addons]['label-for-help'] = 'Help';
    }
    $addons['label-for-help'] = trim($_POST[$prefix_addons]['label-for-help']); //text

    //label-for-rate-this-app
    if (!isset($_POST[$prefix_addons]['label-for-rate-this-app']))
    {
        $_POST[$prefix_addons]['label-for-rate-this-app'] = 'Rate This App';
    }
    $addons['label-for-rate-this-app'] = trim($_POST[$prefix_addons]['label-for-rate-this-app']); //text

    //label-for-privacy-policy
    if (!isset($_POST[$prefix_addons]['label-for-privacy-policy']))
    {
        $_POST[$prefix_addons]['label-for-privacy-policy'] = 'Privacy Policy';
    }
    $addons['label-for-privacy-policy'] = trim($_POST[$prefix_addons]['label-for-privacy-policy']); //text

    //label-for-about-us
    if (!isset($_POST[$prefix_addons]['label-for-about-us']))
    {
        $_POST[$prefix_addons]['label-for-about-us'] = 'About Us';
    }
    $addons['label-for-about-us'] = trim($_POST[$prefix_addons]['label-for-about-us']); //text


    //label-for-connection-lost
    if (!isset($_POST[$prefix_addons]['label-for-connection-lost']))
    {
        $_POST[$prefix_addons]['label-for-connection-lost'] = 'Connection lost, please check your connection!';
    }
    $addons['label-for-connection-lost'] = trim($_POST[$prefix_addons]['label-for-connection-lost']); //text

    //label-for-quote
    if (!isset($_POST[$prefix_addons]['label-for-quote']))
    {
        $_POST[$prefix_addons]['label-for-quote'] = 'Quote';
    }
    $addons['label-for-quote'] = trim($_POST[$prefix_addons]['label-for-quote']); //text

    //label-for-please-wait
    if (!isset($_POST[$prefix_addons]['label-for-please-wait']))
    {
        $_POST[$prefix_addons]['label-for-please-wait'] = 'Please wait...!';
    }
    $addons['label-for-please-wait'] = trim($_POST[$prefix_addons]['label-for-please-wait']); //text

    //label-for-ok
    if (!isset($_POST[$prefix_addons]['label-for-ok']))
    {
        $_POST[$prefix_addons]['label-for-ok'] = 'OK';
    }
    $addons['label-for-ok'] = trim($_POST[$prefix_addons]['label-for-ok']); //text

    //label-for-categories
    if (!isset($_POST[$prefix_addons]['label-for-categories']))
    {
        $_POST[$prefix_addons]['label-for-categories'] = 'Categories';
    }
    $addons['label-for-categories'] = trim($_POST[$prefix_addons]['label-for-categories']); //text

    //label-for-home
    if (!isset($_POST[$prefix_addons]['label-for-home']))
    {
        $_POST[$prefix_addons]['label-for-home'] = 'Home';
    }
    $addons['label-for-home'] = trim($_POST[$prefix_addons]['label-for-home']); //text


    //label-for-dark-mode
    if (!isset($_POST[$prefix_addons]['label-for-dark-mode']))
    {
        $_POST[$prefix_addons]['label-for-dark-mode'] = 'Dark Mode';
    }
    $addons['label-for-dark-mode'] = trim($_POST[$prefix_addons]['label-for-dark-mode']); //text

    //label-for-select-language
    if (!isset($_POST[$prefix_addons]['label-for-select-language']))
    {
        $_POST[$prefix_addons]['label-for-select-language'] = 'Select Language?';
    }
    $addons['label-for-select-language'] = trim($_POST[$prefix_addons]['label-for-select-language']); //text

    //label-for-search
    if (!isset($_POST[$prefix_addons]['label-for-search']))
    {
        $_POST[$prefix_addons]['label-for-search'] = 'Search';
    }
    $addons['label-for-search'] = trim($_POST[$prefix_addons]['label-for-search']); //text


    //label-for-favorite
    if (!isset($_POST[$prefix_addons]['label-for-favorite']))
    {
        $_POST[$prefix_addons]['label-for-favorite'] = 'Favorite';
    }
    $addons['label-for-favorite'] = trim($_POST[$prefix_addons]['label-for-favorite']); //text

    //label-for-favorites
    if (!isset($_POST[$prefix_addons]['label-for-favorites']))
    {
        $_POST[$prefix_addons]['label-for-favorites'] = 'Favorites';
    }
    $addons['label-for-favorites'] = trim($_POST[$prefix_addons]['label-for-favorites']); //text

    //label-for-share
    if (!isset($_POST[$prefix_addons]['label-for-share']))
    {
        $_POST[$prefix_addons]['label-for-share'] = 'Share!';
    }
    $addons['label-for-share'] = trim($_POST[$prefix_addons]['label-for-share']); //text

    //label-for-clipboard
    if (!isset($_POST[$prefix_addons]['label-for-clipboard']))
    {
        $_POST[$prefix_addons]['label-for-clipboard'] = 'Clipboard';
    }
    $addons['label-for-clipboard'] = trim($_POST[$prefix_addons]['label-for-clipboard']); //text

    //label-for-delete
    if (!isset($_POST[$prefix_addons]['label-for-delete']))
    {
        $_POST[$prefix_addons]['label-for-delete'] = 'Delete';
    }
    $addons['label-for-delete'] = trim($_POST[$prefix_addons]['label-for-delete']); //text

    //label-for-no-favorites
    if (!isset($_POST[$prefix_addons]['label-for-no-favorites']))
    {
        $_POST[$prefix_addons]['label-for-no-favorites'] = 'There are no quotes in favorites';
    }
    $addons['label-for-no-favorites'] = trim($_POST[$prefix_addons]['label-for-no-favorites']); //text

    //label-for-no-quotes
    if (!isset($_POST[$prefix_addons]['label-for-no-quotes']))
    {
        $_POST[$prefix_addons]['label-for-no-quotes'] = 'No quotes were found!';
    }
    $addons['label-for-no-quotes'] = trim($_POST[$prefix_addons]['label-for-no-quotes']); //text

    //label-for-recommended
    if (!isset($_POST[$prefix_addons]['label-for-recommended']))
    {
        $_POST[$prefix_addons]['label-for-recommended'] = ' Recommended for you';
    }
    $addons['label-for-recommended'] = trim($_POST[$prefix_addons]['label-for-recommended']); //text

    //label-for-more
    if (!isset($_POST[$prefix_addons]['label-for-more']))
    {
        $_POST[$prefix_addons]['label-for-more'] = 'More';
    }
    $addons['label-for-more'] = trim($_POST[$prefix_addons]['label-for-more']); //text


    $db->saveAddOns('quote', $addons);

    // TODO: ==================================================================================================================
    $pipe_translate = '';
    if ($addons['multiple-language'] == true)
    {
        $pipe_translate = '| translate ';
    }


    // TODO: POPOVERS
    $popovers = null;
    $popovers['icon'] = 'ellipsis-vertical';
    $popovers['title'] = '';
    $popovers['color'] = '';
    $popovers['background'] = '';

    $v = 0;
    $popovers['items'][$v]['type'] = 'dark-mode';
    $popovers['items'][$v]['label'] = $addons['label-for-dark-mode'];
    $popovers['items'][$v]['value'] = 'dark-mode';
    $popovers['items'][$v]['page'] = 'dark-mode';


    if ($addons['multiple-language'] == true)
    {
        $v++;
        $popovers['items'][$v]['type'] = 'language';
        $popovers['items'][$v]['label'] = $addons['label-for-select-language'];
        $popovers['items'][$v]['value'] = 'language';
        $popovers['items'][$v]['page'] = '';
    }
    $v++;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-for-privacy-policy'];
    $popovers['items'][$v]['value'] = 'privacy-policy';
    $popovers['items'][$v]['page'] = 'privacy-policy';

    $v++;
    $popovers['items'][$v]['type'] = 'inlink';
    $popovers['items'][$v]['label'] = $addons['label-for-about-us'];
    $popovers['items'][$v]['value'] = 'about-us';
    $popovers['items'][$v]['page'] = 'about-us';


    $db->savePopover($popovers);
    // TODO: ==================================================================================================================


    // TODO: GENERATOR --|-- TABLE --|-- QUOTES
    $newTable = null;
    $newTable['table-name'] = 'quotes';
    $newTable['table-singular-name'] = 'Quote';
    $newTable['table-plural-name'] = 'Quotes';

    $newTable['table-cols'] = array();

    $newTable['table-desc'] = 'List of quotes';
    $newTable['table-icon-fontawesome'] = 'quote-left';
    $newTable['table-icon-dashicons'] = 'format-quote';
    $newTable['table-icon-ionicons'] = 'quote';
    $newTable['table-variable-as-label'] = 'quote_title';
    $newTable['table-variable-as-value'] = 'quote_id';
    $newTable['form-filter-duplicate'] = true;
    $newTable['auth-enable'] = false;
    $newTable['form-method'] = 'post';

    $x = 0;
    $newTable['table-cols'][$x]['type'] = 'id';
    $newTable['table-cols'][$x]['label'] = 'ID';
    $newTable['table-cols'][$x]['variable'] = 'quote_id';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Title';
    $newTable['table-cols'][$x]['variable'] = 'quote_title';
    $newTable['table-cols'][$x]['option'] = 'Interdum Sed Duis';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the title of the quote';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;
    $newTable['table-cols'][$x]['json-input'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'boolean';
    $newTable['table-cols'][$x]['label'] = 'Stickly';
    $newTable['table-cols'][$x]['variable'] = 'quote_stickly';
    $newTable['table-cols'][$x]['option'] = 'Yes|No';
    $newTable['table-cols'][$x]['default'] = false;
    $newTable['table-cols'][$x]['info'] = 'Is this quote suggested to readers';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;
    $newTable['table-cols'][$x]['json-input'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Author Name';
    $newTable['table-cols'][$x]['variable'] = 'quote_author_name';
    $newTable['table-cols'][$x]['option'] = 'Feugiat';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the author of the quote';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['json-input'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Author Email';
    $newTable['table-cols'][$x]['variable'] = 'quote_author_email';
    $newTable['table-cols'][$x]['option'] = 'Feugiat';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the author\'s email';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['json-input'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Author URL';
    $newTable['table-cols'][$x]['variable'] = 'quote_author_url';
    $newTable['table-cols'][$x]['option'] = 'Feugiat';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the author\'s url';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['json-input'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'select-table';
    $newTable['table-cols'][$x]['label'] = 'Categories';
    $newTable['table-cols'][$x]['variable'] = 'quote_cat';
    $newTable['table-cols'][$x]['table-source'] = 'categories';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Please select a category';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'image';
    $newTable['table-cols'][$x]['label'] = 'Image Quote';
    $newTable['table-cols'][$x]['variable'] = 'quote_image';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write here if the quota uses an image';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'text';
    $newTable['table-cols'][$x]['label'] = 'Text Quote';
    $newTable['table-cols'][$x]['variable'] = 'quote_text';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['json-input'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'date';
    $newTable['table-cols'][$x]['label'] = 'Quote Released';
    $newTable['table-cols'][$x]['variable'] = 'quote_released';
    $newTable['table-cols'][$x]['option'] = '2015-06-30';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the date released of the quote';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;


    switch ($addons['backend-used'])
    {
        case 'php-native':
            $x++;
            $newTable['table-cols'][$x]['type'] = 'select';
            $newTable['table-cols'][$x]['label'] = 'Status';
            $newTable['table-cols'][$x]['variable'] = 'quote_status';
            $newTable['table-cols'][$x]['option'] = 'publish|draft';
            $newTable['table-cols'][$x]['default'] = 'draft';
            $newTable['table-cols'][$x]['info'] = 'Write the status of the quote';
            $newTable['table-cols'][$x]['json-list'] = true;
            $newTable['table-cols'][$x]['json-detail'] = true;
            $newTable['table-cols'][$x]['item-list'] = true;
            break;
        case 'wp-generator':
            break;
    }


    $db->saveTable($newTable);


    // TODO: GENERATOR --|-- TABLE --|-- CATEGORIES
    $newTable = null;
    $newTable['table-name'] = 'categories';
    $newTable['table-singular-name'] = 'Category';
    $newTable['table-plural-name'] = 'Categories';
    $newTable['table-cols'] = array();

    $newTable['table-desc'] = 'List of Categories';
    $newTable['table-icon-fontawesome'] = 'th';
    $newTable['table-icon-dashicons'] = 'editor-table';
    $newTable['table-icon-ionicons'] = 'categories';
    $newTable['table-variable-as-label'] = 'cat_name';
    $newTable['table-variable-as-value'] = 'cat_id';
    $newTable['form-filter-duplicate'] = true;
    $newTable['auth-enable'] = false;
    $newTable['form-method'] = 'none';

    $x = 0;
    $newTable['table-cols'][$x]['type'] = 'id';
    $newTable['table-cols'][$x]['label'] = 'ID';
    $newTable['table-cols'][$x]['variable'] = 'cat_id';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'thumbnail';
    $newTable['table-cols'][$x]['label'] = 'Thumbnail';
    $newTable['table-cols'][$x]['variable'] = 'cat_thumbnail';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Upload image for thumbnail categories';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Name';
    $newTable['table-cols'][$x]['variable'] = 'cat_name';
    $newTable['table-cols'][$x]['option'] = 'Lorem Ipsum';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the title of the categories';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $x++;
    $newTable['table-cols'][$x]['type'] = 'text';
    $newTable['table-cols'][$x]['label'] = 'Short Description';
    $newTable['table-cols'][$x]['variable'] = 'cat_desc';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Just additional information';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;

    $db->saveTable($newTable);


    // TODO: GENERATOR --|-- TABLE --|-- BANNERS
    $newTable = null;
    $newTable['table-name'] = 'banners';
    $newTable['table-singular-name'] = 'Banner';
    $newTable['table-plural-name'] = 'Banners';
    $newTable['table-cols'] = array();

    $newTable['table-desc'] = 'List of banner';
    $newTable['table-icon-fontawesome'] = 'th';
    $newTable['table-icon-dashicons'] = 'editor-table';
    $newTable['table-icon-ionicons'] = 'categories';
    $newTable['table-variable-as-label'] = 'banner_name';
    $newTable['table-variable-as-value'] = 'banner_id';
    $newTable['form-filter-duplicate'] = true;
    $newTable['auth-enable'] = false;
    $newTable['form-method'] = 'none';

    $x = 0;
    $newTable['table-cols'][$x]['type'] = 'id';
    $newTable['table-cols'][$x]['label'] = 'ID';
    $newTable['table-cols'][$x]['variable'] = 'banner_id';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = '';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'varchar';
    $newTable['table-cols'][$x]['label'] = 'Title';
    $newTable['table-cols'][$x]['variable'] = 'banner_title';
    $newTable['table-cols'][$x]['option'] = 'Lorem Ipsum';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Write the title of the banner';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;

    $x++;
    $newTable['table-cols'][$x]['type'] = 'image';
    $newTable['table-cols'][$x]['label'] = 'Image';
    $newTable['table-cols'][$x]['variable'] = 'cat_image';
    $newTable['table-cols'][$x]['option'] = '';
    $newTable['table-cols'][$x]['default'] = '';
    $newTable['table-cols'][$x]['info'] = 'Upload image for banner';
    $newTable['table-cols'][$x]['json-list'] = true;
    $newTable['table-cols'][$x]['json-detail'] = true;
    $newTable['table-cols'][$x]['item-list'] = true;


    $db->saveTable($newTable);


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
        $localization['words'][$v]['text'] = $addons['label-for-dashboard'];
        $localization['words'][$v]['translate'] = 'Dashboard';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-latest'];
        $localization['words'][$v]['translate'] = 'Latest';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-list'];
        $localization['words'][$v]['translate'] = 'List';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-categories'];
        $localization['words'][$v]['translate'] = 'Categories';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-home'];
        $localization['words'][$v]['translate'] = 'Home';


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
        $localization['words'][$v]['text'] = $addons['label-for-help'];
        $localization['words'][$v]['translate'] = 'Help';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-select-language'];
        $localization['words'][$v]['translate'] = 'Select Language?';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-search'];
        $localization['words'][$v]['translate'] = 'Search';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorite'];
        $localization['words'][$v]['translate'] = 'Favorite';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorites'];
        $localization['words'][$v]['translate'] = 'Favorites';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-share'];
        $localization['words'][$v]['translate'] = 'Share!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-clipboard'];
        $localization['words'][$v]['translate'] = 'Clipboard!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-delete'];
        $localization['words'][$v]['translate'] = 'Delete';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorites'];
        $localization['words'][$v]['translate'] = 'Favorites';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-quotes'];
        $localization['words'][$v]['translate'] = 'No quotes were found!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-recommended'];
        $localization['words'][$v]['translate'] = 'Recommended for you';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-more'];
        $localization['words'][$v]['translate'] = 'More';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-favorites'];
        $localization['words'][$v]['translate'] = 'There are no quotes in favorites';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
        $localization['words'][$v]['translate'] = 'Please wait!!!';


        $db->saveLocalization($localization);


        // TODO: LOCALIZATION --|-- ID
        $localization = null;
        $localization['prefix'] = 'id';
        $localization['name'] = 'Bahasa Indonesia';
        $localization['desc'] = 'Auto create by WordPress App Addons';

        $v = 0;
        $localization['words'][$v]['text'] = $addons['label-for-dashboard'];
        $localization['words'][$v]['translate'] = 'Beranda';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-latest'];
        $localization['words'][$v]['translate'] = 'Terbaru';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-list'];
        $localization['words'][$v]['translate'] = 'Daftar';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-categories'];
        $localization['words'][$v]['translate'] = 'Kategori';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-home'];
        $localization['words'][$v]['translate'] = 'Rumah';


        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-about-us'];
        $localization['words'][$v]['translate'] = 'Tentang Kami';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-privacy-policy'];
        $localization['words'][$v]['translate'] = 'Kebijaksanaan Privasi';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-rate-this-app'];
        $localization['words'][$v]['translate'] = 'Rating App Ini';


        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-help'];
        $localization['words'][$v]['translate'] = 'Bantuan';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-dark-mode'];
        $localization['words'][$v]['translate'] = 'Mode Gelap';


        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-select-language'];
        $localization['words'][$v]['translate'] = 'Pilih Bahasa?';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-search'];
        $localization['words'][$v]['translate'] = 'Cari';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorite'];
        $localization['words'][$v]['translate'] = 'Kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorites'];
        $localization['words'][$v]['translate'] = 'Kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-share'];
        $localization['words'][$v]['translate'] = 'Bagikan!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-clipboard'];
        $localization['words'][$v]['translate'] = 'Salin!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-delete'];
        $localization['words'][$v]['translate'] = 'Hapus';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-favorites'];
        $localization['words'][$v]['translate'] = 'Kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-quotes'];
        $localization['words'][$v]['translate'] = 'Kutipan tidak ditemukan!';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-recommended'];
        $localization['words'][$v]['translate'] = 'Disarankan Untuk Kamu';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-more'];
        $localization['words'][$v]['translate'] = 'Lebih banyak';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-no-favorites'];
        $localization['words'][$v]['translate'] = 'Tidak ada kutipan didalam kegemaran';

        $v++;
        $localization['words'][$v]['text'] = $addons['label-for-please-wait'];
        $localization['words'][$v]['translate'] = 'Silahkan tunggu!!!';

        $db->saveLocalization($localization);
    } else
    {
        $db->deleteLocalization('en');
        $db->deleteLocalization('id');
    }
    // TODO: ========================================================

    // TODO: GENERATOR --|-- PROJECT --|--
    $new_project = $current_app['apps'];
    $new_project['rootPage'] = 'home';
    $new_project['ionic-storage'] = true;
    $new_project['statusbar']['style'] = 'lightcontent';
    $new_project['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $new_project['pref-orientation'] = 'portrait';
    $db->saveProject($new_project);

    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- MENU --|--

    // TODO: GENERATOR --|-- MENU --|--
    $newMenu['side'] = 'start';
    $newMenu['type'] = 'overlay';
    $newMenu['ion-header'] = 'default-header';
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
    $newMenu['items'][$z]["page"] = "dashboard";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

    $z++;
    $newMenu['items'][$z]["type"] = "inlink";
    $newMenu['items'][$z]["label"] = $addons['label-for-home'];
    $newMenu['items'][$z]["var"] = "home";
    $newMenu['items'][$z]["page"] = "home";
    $newMenu['items'][$z]["value"] = "";
    $newMenu['items'][$z]["desc"] = "";
    $newMenu['items'][$z]["color-label"] = $color_label;
    $newMenu['items'][$z]["icon-left"] = "home-outline";
    $newMenu['items'][$z]["color-icon-left"] = $color_icon_left;
    $newMenu['items'][$z]["icon-right"] = "";
    $newMenu['items'][$z]["color-icon-right"] = "default";

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
    $newMenu['items'][$z]["label"] = $addons['label-for-categories'];
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

    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- SERVICES
    $prefix_wp = strtolower(metaphone($current_app['apps']['app-name']));

    $service['name'] = 'Quote';
    $service['instruction'] = 'Service for Quote App';
    $service['desc'] = 'Service for Quote App';

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


    $service['code']['other'] = null;
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'mainUrl: string = `' . $addons['api-url'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . 'connectionLost: string = `' . $addons['label-for-connection-lost'] . '`;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- getQuotes(query)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.getQuotes(query:any)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getQuotes(query:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}?api=quotes&${param}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}/wp-json/wp/v2/' . $prefix_wp . '_quotes/?${param}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(quoteUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getQuotes`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getQuotes`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-quote'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getQuotes`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- getQuote(quoteId)
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.getQuote(quoteId:string)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getQuote(quoteId:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}?api=quotes&quote-id=${quoteId}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}/wp-json/wp/v2/' . $prefix_wp . '_quotes/${quoteId}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(quoteUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getQuote`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getQuote`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-quote'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getQuote`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- getCategories()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.getCategories(query:any)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getCategories(query:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}?api=categories&${param}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}/wp-json/wp/v2/' . $prefix_wp . '_categories/?${param}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(quoteUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getCategories`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getCategories`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-quote'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getCategories`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- getBanners()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.getBanners(query:any)' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getBanners(query:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let param = this.httpBuildQuery(query);' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}?api=banners&${param}`;' . "\r\n";
            break;
        case 'wp-generator':
            $service['code']['other'] .= "\t\t" . 'let quoteUrl: string = `${this.mainUrl}/wp-json/wp/v2/' . $prefix_wp . '_banners/?${param}`;' . "\r\n";
            break;
    }
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.get(quoteUrl)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getBanners`,results);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getBanners`,`throwError`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,`' . $addons['label-for-quote'] . '`,this.connectionLost);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    if ($is_debug == true)
    {
        $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`QuoteService`,`getBanners`,`reThrown`, err);' . "\r\n";
    }
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- httpBuildQuery()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService:httpBuildQuery(obj)' . "\r\n";
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

    // TODO: GENERATOR --|-- SERVICES --|-- presentLoading()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.presentLoading()' . "\r\n";
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
    $service['code']['other'] .= "\t" . '* QuoteService.dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- SERVICES --|-- showToast()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.showToast($message)' . "\r\n";
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
    // TODO: GENERATOR --|-- SERVICES --|-- showAlert()
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* QuoteService.showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: ["' . $addons['label-for-ok'] . '"]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    $db->saveService($service, 'core');


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


    function codeTab($page = 'home')
    {
        global $addons;
        $disable_home = $disable_latest = $disable_categories = $disable_list = $disable_favorites = null;

        $pipe_translate = '';
        if ($addons['multiple-language'] == true)
        {
            $pipe_translate = '| translate ';
        }

        if ($page == 'home')
        {
            $disable_home = 'disabled="true"';
        }

        if ($page == 'latest')
        {
            $disable_latest = 'disabled="true"';
        }

        if ($page == 'categories')
        {
            $disable_categories = 'disabled="true"';
        }

        if ($page == 'list')
        {
            $disable_list = 'disabled="true"';
        }

        if ($page == 'favorites')
        {
            $disable_favorites = 'disabled="true"';
        }

        $newPage['footer'] = null;
        $newPage['footer']['color'] = 'none';
        $newPage['footer']['type'] = 'code';
        $newPage['footer']['title'] = '';
        $newPage['footer']['code'] = null;
        $newPage['footer']['code'] .= "\t" . '<ion-toolbar>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '<ion-tabs>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t" . '<ion-tab-bar slot="bottom">' . "\r\n";

        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $disable_home . ' [routerDirection]="\'root\'" [routerLink]="[\'/home\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{"' . $addons['label-for-home'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="home-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";

        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $disable_latest . ' [routerDirection]="\'root\'" [routerLink]="[\'/latest\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{"' . $addons['label-for-latest'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="time-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";

        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button  ' . $disable_favorites . ' [routerDirection]="\'root\'" [routerLink]="[\'/favorites\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{"' . $addons['label-for-favorites'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="heart-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";

        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button  ' . $disable_categories . ' [routerDirection]="\'root\'" [routerLink]="[\'/categories\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{"' . $addons['label-for-categories'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="trail-sign-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";


        $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-tab-button ' . $disable_list . ' [routerDirection]="\'root\'" [routerLink]="[\'/list\']">' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '">{{"' . $addons['label-for-list'] . '"' . $pipe_translate . '}}</ion-label>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-icon color="' . $addons['page-header-color'] . '" name="apps-outline"></ion-icon>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-tab-button>' . "\r\n";


        $newPage['footer']['code'] .= "\t\t\t" . '</ion-tab-bar>' . "\r\n";
        $newPage['footer']['code'] .= "\t\t" . '</ion-tabs>' . "\r\n";
        $newPage['footer']['code'] .= "\t" . '</ion-toolbar>' . "\r\n";
        $newPage['footer']['code'] .= '';
        return $newPage['footer'];
    }


    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- PAGE HOME --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = '{{"' . $addons['label-for-home'] . '"' . $pipe_translate . '}}';
    $newPage['name'] = 'home';
    $newPage['code-by'] = '';
    $newPage['icon-left'] = 'home';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);

    // TODO: GENERATOR --|-- PAGE HOME --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE HOME --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';


    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = 'QuoteService';
    $newPage['modules']['angular'][1]['var'] = 'quoteService';
    $newPage['modules']['angular'][1]['path'] = './../../services/quote/quote.service';

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


    // TODO: GENERATOR --|-- PAGE HOME --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;

    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";


    // TODO: GENERATOR --|-- PAGE HOME --|-- CONTENT --|-- BANNERS
    $newPage['content']['html'] .= "\t" . '<!-- banners -->' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataBanners.length != 0" [options]="{slidesPerView:1,autoplay:1}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let item of dataBanners">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="item && item[\'cat_image\']" [src]="item.cat_image"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-img *ngIf="!item || !item.cat_image" src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="!dataBanners || dataBanners.length == 0" [options]="{slidesPerView:1,autoplay:1}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-img src="assets/images/placeholder-800x600.png"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<!-- ./banners -->' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ \'' . $addons['label-for-categories'] . '\' ' . $pipe_translate . ' }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="dataCategories.length != 0" [options]="{slidesPerView:4}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide *ngFor="let cat of dataCategories" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<div [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'list\',cat.cat_id]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card color="' . $addons['page-header-color'] . '" *ngIf="cat.cat_thumbnail">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\' + cat.cat_thumbnail + \')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>{{ cat.cat_name }}</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card color="' . $addons['page-header-color'] . '" *ngIf="!cat.cat_thumbnail">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-content>{{ cat.cat_name }}</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-slides *ngIf="!dataCategories || dataCategories.length == 0" [options]="{slidesPerView:4}">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 76%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 88%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 48%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 98%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 38%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-header  class="ratio-1x1" [ngStyle]="{\'background-image\':\'url(\\\'assets/images/placeholder-480x480.png\\\')\',\'background-size\':\'cover\',\'background-position\':\'center\'}"></ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-content><ion-skeleton-text animated style="width: 48%"></ion-skeleton-text></ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-slide>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-slides>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<ion-list-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-text color="' . $addons['page-header-color'] . '">{{ \'' . $addons['label-for-recommended'] . '\'' . $pipe_translate . ' }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list-header>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<div id="data-quotes" *ngIf="dataQuotes.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let item of dataQuotes|slice:0:5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title *ngIf="item && item[\'quote_title\']">{{ item.quote_title }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle *ngIf="item && item[\'quote_cat\']">{{ item.quote_cat.rendered }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p [innerHTML]="item.quote_text">{{ item.quote_text }}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<footer>{{ item.quote_author_name }}</footer>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-fab vertical="bottom" horizontal="end" edge slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-list side="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button mailApp emailAddress="" emailMessage="{{ item.quote_text }}" color="tertiary"><ion-icon name="mail-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button smsApp phoneNumber="" shortMessage="{{ item.quote_text }}" color="medium"><ion-icon name="send-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button whatsappApp phoneNumber=""  message="{{ item.quote_text }}" color="success"><ion-icon name="logo-whatsapp"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button twitterApp message="{{ item.quote_text }}" color="secondary"><ion-icon name="logo-twitter"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-fab>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
 
    // TODO: GENERATOR --|-- PAGE HOME --|-- CONTENT --|-- FAVORITE BUTTON

    $newPage['content']['html'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" expand="block" size="small" *ngIf="!checkFavorite[item.quote_id]" (click)="addFavorite(item.quote_id,item)" color="danger">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="heart-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-favorite'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" expand="block" size="small" *ngIf="checkFavorite[item.quote_id]" (click)="removeFavorite(item.quote_id)" color="danger" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="heart"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-favorite'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" copyToClipboard text="{{ item.quote_text }}" expand="block" size="small" color="primary" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="copy"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-clipboard'] . '"| translate }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button fill="outline" expand="full" color="' . $addons['page-header-color'] . '" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'list\',\'-1\']">{{"' . $addons['label-for-more'] . '"| translate }}</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<div id="data-quotes" *ngIf="!dataQuotes || dataQuotes.length == 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let item of [1,2,3,4,5]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title><ion-skeleton-text animated style="width: 80%"></ion-skeleton-text></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle><ion-skeleton-text animated style="width: 90%"></ion-skeleton-text></ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 100%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-skeleton-text animated style="width: 80%"></ion-skeleton-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<footer><ion-skeleton-text animated style="width: 50%"></ion-skeleton-text></footer>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";


    // TODO: GENERATOR --|-- PAGE HOME --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";

    $newPage['content']['scss'] .= "\t" . 'ion-slides ion-card-header+.card-content-ios {font-size:80% !important;padding: 3px !important;text-overflow: ellipsis !important;white-space: nowrap !important;overflow: hidden !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slides ion-card-header+.card-content-md {font-size:80% !important;padding: 3px !important;text-overflow: ellipsis !important;white-space: nowrap !important;overflow: hidden !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slides ion-slide {display:block !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slides ion-slide .ratio-1x1 {width: 100% !important;padding-top: 100% !important; position: relative !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-slides ion-slide ion-card{ margin:0.5em;padding:0;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '#data-quotes ion-card{ margin: 0.5rem;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header{margin-top: .5em;padding-top: 0;padding-bottom:0;background-color: #fff;opacity:0.8;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-list-header ion-text{padding-top: 0.5em;padding-bottom: 0.5em;}' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'banners: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataBanners: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'quotes: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataQuotes: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'checkFavorite: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- getCategories()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:getCategories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCategories(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {sort:`asc`};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:100};' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.categories = this.quoteService.getCategories(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCategories = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- getBanners()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:getBanners()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getBanners(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {sort:`asc`,limit:10};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:10};' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.banners = this.quoteService.getBanners(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.banners.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataBanners = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- getQuotes()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:getQuotes()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getQuotes(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = { orderby:`quote-released`, \'quote-status\':`publish`, sort:`desc`, limit:10,\'quote-stickly\':`1` };' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = { orderby:`quote-released`, sort:`desc`, limit:10,\'quote-stickly\':`1` };;' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.quotes = this.quoteService.getQuotes(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.quotes.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataQuotes = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- addFavorite(quote_id:string,quote_data:any)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.addFavorite(quote_id:string,quote_data:any)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public addFavorite(quote_id:string,quote_data:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`favorites`,quote_id,quote_data).then((new_data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.checkFavorite = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`save`,new_data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- removeFavorite(quote_id:string)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.removeFavorite(quote_id:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeFavorite(quote_id:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`favorites`,quote_id).then((new_data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.checkFavorite = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`remove`,quote_id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- setFavorites()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.setFavorites()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public setFavorites(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let data:any = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((val,key,index) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let prefix : string = `favorites`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(key.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.checkFavorite[val.quote_id] = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- presentLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.presentLoading()' . "\r\n";
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
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE HOME --|-- CODE --|-- OTHER --|-- dismissLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.dismissLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBanners = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getBanners();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getQuotes();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setInterval(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.setFavorites();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* HomePage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataBanners = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getBanners();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getQuotes();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setInterval(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.setFavorites();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;

    // TODO: GENERATOR --|-- PAGE HOME --|-- CONTENT --|-- FOOTER
    $newPage['footer'] = codeTab('home');


    //generate page code
    $db->savePage($newPage);


    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- PAGE CATEGORIES --|--

    // create properties for page
    $newPage = null;

    $newPage['title'] = '{{"' . $addons['label-for-categories'] . '"' . $pipe_translate . '}}';
    $newPage['name'] = 'categories';
    $newPage['code-by'] = '';
    $newPage['icon-left'] = 'trail-sign-outline';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    // TODO: GENERATOR --|-- PAGE CATEGORIES --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['search-label'] = $addons['label-for-search'];
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE CATEGORIES --|-- MODULES
    $newPage['modules']['angular'][0]['enable'] = true;
    $newPage['modules']['angular'][0]['class'] = 'Observable';
    $newPage['modules']['angular'][0]['var'] = '';
    $newPage['modules']['angular'][0]['path'] = 'rxjs';


    $newPage['modules']['angular'][1]['enable'] = true;
    $newPage['modules']['angular'][1]['class'] = 'QuoteService';
    $newPage['modules']['angular'][1]['var'] = 'quoteService';
    $newPage['modules']['angular'][1]['path'] = './../../services/quote/quote.service';


    // TODO: GENERATOR --|-- PAGE CATEGORIES --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;


    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="dataCategories.length != 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let item of dataCategories">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'list\',item.cat_id]" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-img *ngIf="item && item.cat_thumbnail" [src]="item.cat_thumbnail"></ion-img>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title *ngIf="item.cat_name"><h3 [innerHTML]="item.cat_name"></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-grid *ngIf="!dataCategories || dataCategories.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-col size="6" size-sm *ngFor="let item of [1,2,3,4]">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-card-title><h3><ion-skeleton-text animated style="width: 100%"></ion-skeleton-text></h3></ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-grid>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE CATEGORIES --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card-header {padding: 12px !important;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card-header h3{margin: 0px !important;padding: 0px !important;font-size: 1rem;text-align: center;}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-grid ion-card{margin: .1rem;}' . "\r\n";


    // TODO: GENERATOR --|-- PAGE CATEGORIES --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'categories: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataCategories: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CategoriesPage:getCategories()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getCategories(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {sort:`asc`};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {per_page:100};' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.categories = this.quoteService.getCategories(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.categories.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataCategories = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CategoriesPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* CategoriesPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataCategories = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getCategories();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['init'] = null;
    // TODO: GENERATOR --|-- PAGE CATEGORIES --|-- CONTENT --|-- FOOTER
    $newPage['footer'] = codeTab('categories');

    //generate page code
    $db->savePage($newPage);

    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- PAGE LIST --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = '{{"' . $addons['label-for-list'] . '"' . $pipe_translate . '}}';
    $newPage['name'] = 'list';
    $newPage['code-by'] = '';
    $newPage['icon-left'] = 'apps-outline';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['param'] = 'cat_id';
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);
    $newPage['back-button'] = '/auto';

    // TODO: GENERATOR --|-- PAGE LIST --|-- HEADER
    $newPage['header']['mid']['type'] = 'search';
    $newPage['header']['mid']['search-label'] = $addons['label-for-search'];
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE LIST --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'QuoteService';
    $newPage['modules']['angular'][$z]['var'] = 'quoteService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/quote/quote.service';

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


    // TODO: GENERATOR --|-- PAGE LIST --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<div *ngIf="filterDataQuotes.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let item of filterDataQuotes">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title>{{ item.quote_title }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle *ngIf="item && item.quote_cat">{{ item.quote_cat.rendered }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";


    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p [innerHTML]="item.quote_text">{{ item.quote_text }}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<footer>{{ item.quote_author_name }}</footer>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-fab vertical="bottom" horizontal="end" edge slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-list side="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button mailApp emailAddress="" emailMessage="{{ item.quote_text }}" color="tertiary"><ion-icon name="mail-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button smsApp phoneNumber="" shortMessage="{{ item.quote_text }}" color="medium"><ion-icon name="send-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button whatsappApp phoneNumber=""  message="{{ item.quote_text }}" color="success"><ion-icon name="logo-whatsapp"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button twitterApp message="{{ item.quote_text }}" color="secondary"><ion-icon name="logo-twitter"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-fab>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" expand="block" size="small" *ngIf="!checkFavorite[item.quote_id]" (click)="addFavorite(item.quote_id,item)" color="danger">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="heart-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-favorite'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" expand="block" size="small" *ngIf="checkFavorite[item.quote_id]" (click)="removeFavorite(item.quote_id)" color="danger" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="heart"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-favorite'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" copyToClipboard text="{{ item.quote_text }}" expand="block" size="small" color="primary" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="copy"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-clipboard'] . '"| translate }}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-grid>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<div *ngIf="filterDataQuotes.length == 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{"' . $addons['label-for-no-quotes'] . '"' . $pipe_translate . '}}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE LIST --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'quotes: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataQuotes: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'filterDataQuotes: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'checkFavorite: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- getQuotes()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage:getQuotes()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getQuotes(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.catId == null){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.catId = "-1";' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";

    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {\'quote-cat\': this.catId, orderby:`quote-released`,\'quote-status\':`publish`,sort:`desc`};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {\'quote-cat\': this.catId,\'quote-status\':`publish`,sort:`desc`};' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.quotes = this.quoteService.getQuotes(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.quotes.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataQuotes = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterDataQuotes = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- filterItems(filterItems)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage:filterItems($event)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
    $newPage['code']['other'] .= "\t" . '*' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataQuotes = this.dataQuotes;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterDataQuotes = this.dataQuotes.filter((newItem) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(newItem.quote_text){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'return newItem.quote_text.toLowerCase().indexOf(filterVal.toLowerCase()) > -1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- doRefresh(refresher)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage:doRefresh(refresher)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getQuotes();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getQuotes();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setInterval(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.setFavorites();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";

    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- addFavorite(quote_id:string,quote_data:any)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage.addFavorite(quote_id:string,quote_data:any)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public addFavorite(quote_id:string,quote_data:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`favorites`,quote_id,quote_data).then((new_data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.checkFavorite = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`save`,new_data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- removeFavorite(quote_id:string)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage.removeFavorite(quote_id:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeFavorite(quote_id:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`favorites`,quote_id).then((new_data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.checkFavorite = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`remove`,quote_id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- setFavorites()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage.setFavorites()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public setFavorites(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let data:any = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((val,key,index) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let prefix : string = `favorites`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(key.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.checkFavorite[val.quote_id] = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- presentLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage.presentLoading()' . "\r\n";
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
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LIST --|-- CODE --|-- OTHER --|-- dismissLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* ListPage.dismissLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['init'] = null;
    // TODO: GENERATOR --|-- PAGE LIST --|-- CONTENT --|-- FOOTER
    $newPage['footer'] = codeTab('list');

    //generate page code
    $db->savePage($newPage);


    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- PAGE LATEST --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = '{{"' . $addons['label-for-latest'] . '"' . $pipe_translate . '}}';
    $newPage['name'] = 'latest';
    $newPage['code-by'] = '';
    $newPage['icon-left'] = 'time-outline';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);

    // TODO: GENERATOR --|-- PAGE LATEST --|-- HEADER
    $newPage['header']['mid']['type'] = 'search';
    $newPage['header']['mid']['search-label'] = $addons['label-for-search'];
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE LATEST --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'QuoteService';
    $newPage['modules']['angular'][$z]['var'] = 'quoteService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/quote/quote.service';

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

    // TODO: GENERATOR --|-- PAGE LATEST --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<div *ngIf="filterDataQuotes.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let item of filterDataQuotes">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title>{{ item.quote_title }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle *ngIf="item && item.quote_cat">{{ item.quote_cat.rendered }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p [innerHTML]="item.quote_text">{{ item.quote_text }}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<footer>{{ item.quote_author_name }}</footer>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-fab vertical="bottom" horizontal="end" edge slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-list side="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button mailApp emailAddress="" emailMessage="{{ item.quote_text }}" color="tertiary"><ion-icon name="mail-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button smsApp phoneNumber="" shortMessage="{{ item.quote_text }}" color="medium"><ion-icon name="send-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button whatsappApp phoneNumber=""  message="{{ item.quote_text }}" color="success"><ion-icon name="logo-whatsapp"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button twitterApp message="{{ item.quote_text }}" color="secondary"><ion-icon name="logo-twitter"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-fab>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" expand="block" size="small" *ngIf="!checkFavorite[item.quote_id]" (click)="addFavorite(item.quote_id,item)" color="danger">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="heart-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-favorite'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" expand="block" size="small" *ngIf="checkFavorite[item.quote_id]" (click)="removeFavorite(item.quote_id)" color="danger" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="heart"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-favorite'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="5">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" copyToClipboard text="{{ item.quote_text }}" expand="block" size="small" color="primary" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon slot="start" name="copy"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{"' . $addons['label-for-clipboard'] . '"' . $pipe_translate . '}}</ion-text>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<div *ngIf="filterDataQuotes.length == 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<p>{{"' . $addons['label-for-no-quotes'] . '"' . $pipe_translate . '}}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE LATEST --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'quotes: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataQuotes: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'filterDataQuotes: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'checkFavorite: any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- getQuotes()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage:getQuotes()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getQuotes(){' . "\r\n";
    switch ($addons['backend-used'])
    {
        case 'php-native':
            $newPage['code']['other'] .= "\t\t" . 'let param = {orderby:`quote-released`,\'quote-status\':`publish`,sort:`desc`};' . "\r\n";
            break;
        case 'wp-generator':
            $newPage['code']['other'] .= "\t\t" . 'let param = {orderby:`quote-released`,sort:`desc`};' . "\r\n";
            break;
    }
    $newPage['code']['other'] .= "\t\t" . 'this.quotes = this.quoteService.getQuotes(param);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.quotes.subscribe(data => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataQuotes = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterDataQuotes = data;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- filterItems($event)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage:filterItems($event)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
    $newPage['code']['other'] .= "\t" . '*' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataQuotes = this.dataQuotes;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== "") {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.filterDataQuotes = this.dataQuotes.filter((newItem) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(newItem.quote_text){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'return newItem.quote_text.toLowerCase().indexOf(filterVal.toLowerCase()) > -1;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getQuotes();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.filterDataQuotes = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getQuotes();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setInterval(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.setFavorites();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '},1000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- addFavorite(quote_id:string,quote_data:any)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.addFavorite(quote_id:string,quote_data:any)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public addFavorite(quote_id:string,quote_data:any){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.setItem(`favorites`,quote_id,quote_data).then((new_data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.checkFavorite = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`save`,new_data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- removeFavorite(quote_id:string)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.removeFavorite(quote_id:string)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeFavorite(quote_id:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`favorites`,quote_id).then((new_data)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.checkFavorite = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log(`storage`,`favorites`,`remove`,quote_id);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- setFavorites()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.setFavorites()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public setFavorites(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'let data:any = [] ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storage.forEach((val,key,index) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'let prefix : string = `favorites`;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(key.substring(0,prefix.length) ==  prefix){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.checkFavorite[val.quote_id] = true;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- presentLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.presentLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CODE --|-- OTHER --|-- dismissLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* LatestPage.dismissLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;
    // TODO: GENERATOR --|-- PAGE LATEST --|-- CONTENT --|-- FOOTER
    $newPage['footer'] = codeTab('latest');

    //generate page code
    $db->savePage($newPage);


    // TODO: ==================================================================================================================
    // TODO: GENERATOR --|-- PAGE FAVORITES --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = '{{"' . $addons['label-for-favorites'] . '"' . $pipe_translate . '}}';
    $newPage['name'] = 'favorites';
    $newPage['code-by'] = '';
    $newPage['icon-left'] = 'heart';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['page-content-background'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColorLevel($addons['page-header-color']);

    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['search-label'] = $addons['label-for-search'];
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'QuoteService';
    $newPage['modules']['angular'][$z]['var'] = 'quoteService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/quote/quote.service';

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

    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CONTENT --|-- HTML

    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-refresher (ionRefresh)="doRefresh($event)" slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-refresher-content></ion-refresher-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-refresher>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<div *ngIf="dataFavorites.length != 0" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card *ngFor="let item of dataFavorites">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-title>{{ item.quote_title }}</ion-card-title>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-card-subtitle *ngIf="item && item.quote_cat">{{ item.quote_cat.rendered }}</ion-card-subtitle>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-header>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<p [innerHTML]="item.quote_text">{{ item.quote_text }}</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<footer>{{ item.quote_author_name }}</footer>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</blockquote>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-fab vertical="bottom" horizontal="end" edge slot="fixed">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-icon name="share-social"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-fab-list side="start">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button mailApp emailAddress="" emailMessage="{{ item.quote_text }}" color="tertiary"><ion-icon name="mail-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button smsApp phoneNumber="" shortMessage="{{ item.quote_text }}" color="medium"><ion-icon name="send-outline"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button whatsappApp phoneNumber=""  message="{{ item.quote_text }}" color="success"><ion-icon name="logo-whatsapp"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-fab-button twitterApp message="{{ item.quote_text }}" color="secondary"><ion-icon name="logo-twitter"></ion-icon></ion-fab-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-fab-list>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-fab>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" (click)="removeFavorite(item.quote_id)" color="danger" expand="block" size="small">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon name="trash"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '{{"' . $addons['label-for-delete'] . '"' . $pipe_translate . '}}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="solid" copyToClipboard text="{{ item.quote_text }}" expand="block" size="small" color="primary" >' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '<ion-icon name="copy"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t\t" . '{{"' . $addons['label-for-clipboard'] . '"| translate }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-grid>' . "\r\n";


    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '' . "\r\n";
    $newPage['content']['html'] .= "\t" . '<ion-list class="empty-container" lines="none" *ngIf="dataFavorites.length == 0">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label color="' . $addons['page-header-color'] . '" class="empty-wrapper">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-icon class="empty-icon" name="heart-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<h3>{{"' . $addons['label-for-no-favorites'] . '"' . $pipe_translate . '}}</h3>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";

    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . '' . "\r\n";
    $newPage['content']['scss'] .= '.empty-container{height: 100%;}' . "\r\n";
    $newPage['content']['scss'] .= '.empty-wrapper{text-align: center;padding-top: 50%;}' . "\r\n";
    $newPage['content']['scss'] .= '.empty-icon{font-size: 72px;}' . "\r\n";
    $newPage['content']['scss'] .= '.empty-wrapper h3{font-variant-caps: petite-caps;font-size: 18px;}' . "\r\n";


    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'dataFavorites : any = [];' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER --|-- getItems(table)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* FavoritesPage:getItems(table)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public getItems(table:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.getItems(table).then(data=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataFavorites = data ;' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER --|-- removeFavorite(data_id)
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* FavoritesPage:removeFavorite(data_id)' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public removeFavorite(data_id:string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.storageService.removeItem(`favorites`,data_id).then(data=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dataFavorites = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.getItems(`favorites`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER --|-- doRefresh()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* FavoritesPage:doRefresh()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public doRefresh(refresher){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataFavorites = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems(`favorites`);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'setTimeout(() => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'refresher.target.complete();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}, 2000);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER --|-- ngOnInit()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* FavoritesPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.dataFavorites = [];' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.getItems(`favorites`);' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER --|-- presentLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* FavoritesPage.presentLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: "' . $addons['label-for-please-wait'] . '",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'duration: 2000' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CODE --|-- OTHER --|-- dismissLoading()
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* FavoritesPage.dismissLoading()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;

    // TODO: GENERATOR --|-- PAGE FAVORITES --|-- CONTENT --|-- FOOTER
    $newPage['footer'] = codeTab('favorites');

    //generate page code
    $db->savePage($newPage);


    $db->current();
    rebuild();
    //header('Location: ./?p=addons&addons=quote&' . time());

}
// TODO: ==================================================================================================================
// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
$current_setting = $db->getAddOns('quote', $current_page_target);


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

if (!isset($current_setting['api-url']))
{
    $current_setting['api-url'] = '';
}


if (!isset($current_setting['label-for-dashboard']))
{
    $current_setting['label-for-dashboard'] = 'Dashboard';
}

if (!isset($current_setting['label-for-latest']))
{
    $current_setting['label-for-latest'] = 'Latest';
}

if (!isset($current_setting['label-for-list']))
{
    $current_setting['label-for-list'] = 'List';
}

if (!isset($current_setting['label-for-help']))
{
    $current_setting['label-for-help'] = 'Help';
}

if (!isset($current_setting['label-for-rate-this-app']))
{
    $current_setting['label-for-rate-this-app'] = 'Rate This App';
}

if (!isset($current_setting['label-for-privacy-policy']))
{
    $current_setting['label-for-privacy-policy'] = 'Privacy Policy';
}

if (!isset($current_setting['label-for-about-us']))
{
    $current_setting['label-for-about-us'] = 'About Us';
}

if (!isset($current_setting['label-for-connection-lost']))
{
    $current_setting['label-for-connection-lost'] = 'Connection lost, please check your connection!';
}

if (!isset($current_setting['label-for-quote']))
{
    $current_setting['label-for-quote'] = 'Quote';
}

if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'OK';
}

if (!isset($current_setting['label-for-categories']))
{
    $current_setting['label-for-categories'] = 'Categories';
}

if (!isset($current_setting['label-for-home']))
{
    $current_setting['label-for-home'] = 'Home';
}

if (!isset($current_setting['multiple-language']))
{
    $current_setting['multiple-language'] = false;
}

if (!isset($current_setting['label-for-dark-mode']))
{
    $current_setting['label-for-dark-mode'] = 'Dark Mode';
}

if (!isset($current_setting['label-for-select-language']))
{
    $current_setting['label-for-select-language'] = 'Select Language?';
}

if (!isset($current_setting['label-for-search']))
{
    $current_setting['label-for-search'] = 'Search';
}

if (!isset($current_setting['label-for-favorite']))
{
    $current_setting['label-for-favorite'] = 'Favorite';
}

if (!isset($current_setting['label-for-favorites']))
{
    $current_setting['label-for-favorite'] = 'Favorites';
}

if (!isset($current_setting['label-for-share']))
{
    $current_setting['label-for-share'] = 'Share!';
}

if (!isset($current_setting['label-for-clipboard']))
{
    $current_setting['label-for-clipboard'] = 'Clipboard';
}

if (!isset($current_setting['label-for-delete']))
{
    $current_setting['label-for-delete'] = 'Delete';
}

if (!isset($current_setting['label-for-no-favorites']))
{
    $current_setting['label-for-no-favorites'] = 'No favorites';
}

if (!isset($current_setting['label-for-no-quotes']))
{
    $current_setting['label-for-no-quotes'] = 'No quotes were found!';
}

if (!isset($current_setting['label-for-favorites']))
{
    $current_setting['label-for-favorites'] = 'Favorites';
}

if (!isset($current_app['directives']['copy-to-clipboard']))
{
    $disabled = 'disabled';
}


$content .= '<form action="" method="post"><!-- ./form -->';
// TODO: ==================================================================================================================
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


if (!isset($current_app['directives']['copy-to-clipboard']))
{
    $content .= '<div class="callout callout-danger">';
    $content .= '<h4>' . __e('Ops, error!') . '</h4>';
    $content .= '<p>' . __e('This addons requires some Additional Directives, please do the following steps') . ': ' . __e('Go to <strong>(IMAB) Directives</strong> -&raquo;  <strong>Additional Directives</strong> -&raquo;  <strong>Copy To Clipboard</strong> -&raquo; Click <strong>Generate</strong> button') . '</p>';
    $content .= '</div>';
}

$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';


$content .= '<div class="row"><!-- row -->';

// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="quote[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
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
$content .= '<input id="page-content-background" type="text" name="quote[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
// TODO: LAYOUT --|-- FORM --|-- BACKEND-USED --|-- SELECT
$content .= '<div class="row"><!-- row -->';

$options = array();
$options[] = array('value' => 'php-native', 'label' => 'PHP Native Generator');
$options[] = array('value' => 'wp-generator', 'label' => 'WordPress Plugin Generator');

$content .= '<div id="field-backend-used" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-backend-used">' . __e('Backend Used') . '</label>';
$content .= '<select id="page-backend-used" name="quote[backend-used]" class="form-control" ' . $disabled . ' >';
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

// TODO: LAYOUT --|-- FORM --|-- API-URL --|-- URL

$content .= '<div id="field-api-url" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-api-url">' . __e('API URL') . '</label>';
$content .= '<input id="page-api-url" type="url" name="quote[api-url]" class="form-control" placeholder=""  value="' . $current_setting['api-url'] . '"  ' . $disabled . ' requred />';
$content .= '<p class="help-block">' . __e('Root end point address, such as: https://site/restapi.php or https://your-wp') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '<hr>';

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
    $content .= '<td style="width:30px"><input checked="checked" class="flat-red" type="checkbox" id="page-multiple-language" name="' . $prefix_addons . '[multiple-language]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td style="width:30px"><input class="flat-red" type="checkbox" id="page-multiple-language" name="' . $prefix_addons . '[multiple-language]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Multiple Language Support') . '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-quote" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('BackEnd App') . '</h3>';
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
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

// TODO: ==================================================================================================================
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DASHBOARD --|-- TEXT
$content .= '<div class="row"><!-- row -->';

$content .= '<div id="field-label-for-dashboard" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dashboard">' . __e('Label for `Dashboard`') . '</label>';
$content .= '<input id="page-label-for-dashboard" type="text" name="' . $prefix_addons . '[label-for-dashboard]" class="form-control" placeholder="Dashboard"  value="' . $current_setting['label-for-dashboard'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Dashboard`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LATEST --|-- TEXT
$content .= '<div id="field-label-for-latest" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-latest">' . __e('Label for `Latest`') . '</label>';
$content .= '<input id="page-label-for-latest" type="text" name="' . $prefix_addons . '[label-for-latest]" class="form-control" placeholder="Latest"  value="' . $current_setting['label-for-latest'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Latest`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LIST --|-- TEXT
$content .= '<div id="field-label-for-list" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-list">' . __e('Label for `List`') . '</label>';
$content .= '<input id="page-label-for-list" type="text" name="' . $prefix_addons . '[label-for-list]" class="form-control" placeholder="List"  value="' . $current_setting['label-for-list'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `List`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HELP --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-help" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-help">' . __e('Label for `Help`') . '</label>';
$content .= '<input id="page-label-for-help" type="text" name="' . $prefix_addons . '[label-for-help]" class="form-control" placeholder="Help"  value="' . $current_setting['label-for-help'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Help`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-RATE-THIS-APP --|-- TEXT

$content .= '<div id="field-label-for-rate-this-app" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-rate-this-app">' . __e('Label for `Rate This App`') . '</label>';
$content .= '<input id="page-label-for-rate-this-app" type="text" name="' . $prefix_addons . '[label-for-rate-this-app]" class="form-control" placeholder="Rate This App"  value="' . $current_setting['label-for-rate-this-app'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Rate This App`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PRIVACY-POLICY --|-- TEXT

$content .= '<div id="field-label-for-privacy-policy" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-privacy-policy">' . __e('Label for `Privacy Policy`') . '</label>';
$content .= '<input id="page-label-for-privacy-policy" type="text" name="' . $prefix_addons . '[label-for-privacy-policy]" class="form-control" placeholder="Privacy Policy"  value="' . $current_setting['label-for-privacy-policy'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Privacy Policy`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ABOUT-US --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-about-us" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-about-us">' . __e('Label for `About Us`') . '</label>';
$content .= '<input id="page-label-for-about-us" type="text" name="' . $prefix_addons . '[label-for-about-us]" class="form-control" placeholder="About Us"  value="' . $current_setting['label-for-about-us'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `About Us`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CONNECTION-LOST --|-- TEXT

$content .= '<div id="field-label-for-connection-lost" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-connection-lost">' . __e('Label for `Connection lost`') . '</label>';
$content .= '<input id="page-label-for-connection-lost" type="text" name="' . $prefix_addons . '[label-for-connection-lost]" class="form-control" placeholder="Connection lost, please check your connection!"  value="' . $current_setting['label-for-connection-lost'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Connection lost, please check your connection!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-QUOTE --|-- TEXT

$content .= '<div id="field-label-for-quote" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-quote">' . __e('Label for `Quote`') . '</label>';
$content .= '<input id="page-label-for-quote" type="text" name="' . $prefix_addons . '[label-for-quote]" class="form-control" placeholder="Quote"  value="' . $current_setting['label-for-quote'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Quote`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="' . $prefix_addons . '[label-for-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT

$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `OK`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="' . $prefix_addons . '[label-for-ok]" class="form-control" placeholder="OK"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `OK`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CATEGORIES --|-- TEXT

$content .= '<div id="field-label-for-categories" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-categories">' . __e('Label for `Categories`') . '</label>';
$content .= '<input id="page-label-for-categories" type="text" name="' . $prefix_addons . '[label-for-categories]" class="form-control" placeholder="Categories"  value="' . $current_setting['label-for-categories'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Categories`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-HOME --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-home" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-home">' . __e('Label for `Home`') . '</label>';
$content .= '<input id="page-label-for-home" type="text" name="' . $prefix_addons . '[label-for-home]" class="form-control" placeholder="Home"  value="' . $current_setting['label-for-home'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Home`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DARK-MODE --|-- TEXT

$content .= '<div id="field-label-for-dark-mode" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-dark-mode">' . __e('Label for `Dark Mode`') . '</label>';
$content .= '<input id="page-label-for-dark-mode" type="text" name="' . $prefix_addons . '[label-for-dark-mode]" class="form-control" placeholder="Dark Mode"  value="' . $current_setting['label-for-dark-mode'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Dark Mode`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SELECT-LANGUAGE --|-- TEXT

$content .= '<div id="field-label-for-select-language" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-select-language">' . __e('Label for `Select Language?`') . '</label>';
$content .= '<input id="page-label-for-select-language" type="text" name="' . $prefix_addons . '[label-for-select-language]" class="form-control" placeholder="Select Language?"  value="' . $current_setting['label-for-select-language'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Select Language?`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SEARCH --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-search" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-search">' . __e('Label for `Search`') . '</label>';
$content .= '<input id="page-label-for-search" type="text" name="' . $prefix_addons . '[label-for-search]" class="form-control" placeholder="Search"  value="' . $current_setting['label-for-search'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Search`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FAVORITE --|-- TEXT

$content .= '<div id="field-label-for-favorite" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-favorite">' . __e('Label for `Favorite`') . '</label>';
$content .= '<input id="page-label-for-favorite" type="text" name="' . $prefix_addons . '[label-for-favorite]" class="form-control" placeholder="Favorite"  value="' . $current_setting['label-for-favorite'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Favorite`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SHARE --|-- TEXT

$content .= '<div id="field-label-for-share" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-share">' . __e('Label for `Share!`') . '</label>';
$content .= '<input id="page-label-for-share" type="text" name="' . $prefix_addons . '[label-for-share]" class="form-control" placeholder="Share!"  value="' . $current_setting['label-for-share'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Share!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FAVORITES --|-- TEXT

$content .= '<div id="field-label-for-favorites" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-favorites">' . __e('Label for `Favorites`') . '</label>';
$content .= '<input id="page-label-for-favorites" type="text" name="' . $prefix_addons . '[label-for-favorites]" class="form-control" placeholder="Favorites"  value="' . $current_setting['label-for-favorites'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Favorites`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CLIPBOARD --|-- TEXT

$content .= '<div id="field-label-for-clipboard" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-clipboard">' . __e('Label for `Clipboard`') . '</label>';
$content .= '<input id="page-label-for-clipboard" type="text" name="' . $prefix_addons . '[label-for-clipboard]" class="form-control" placeholder="Clipboard"  value="' . $current_setting['label-for-clipboard'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Clipboard`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DELETE --|-- TEXT

$content .= '<div id="field-label-for-delete" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-delete">' . __e('Label for `Delete`') . '</label>';
$content .= '<input id="page-label-for-delete" type="text" name="' . $prefix_addons . '[label-for-delete]" class="form-control" placeholder="Delete"  value="' . $current_setting['label-for-delete'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Delete`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-FAVORITES --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-favorites" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-favorites">' . __e('Label for `No favorites`') . '</label>';
$content .= '<input id="page-label-for-no-favorites" type="text" name="' . $prefix_addons . '[label-for-no-favorites]" class="form-control" placeholder="No favorites"  value="' . $current_setting['label-for-no-favorites'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `No favorites`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-QUOTES --|-- TEXT

$content .= '<div id="field-label-for-no-quotes" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-quotes">' . __e('Label for `No Quotes`') . '</label>';
$content .= '<input id="page-label-for-no-quotes" type="text" name="' . $prefix_addons . '[label-for-no-quotes]" class="form-control" placeholder="No quotes were found!"  value="' . $current_setting['label-for-no-quotes'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `No Quotes`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-quote" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';


// TODO: ==================================================================================================================
// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=quote&page-target="+$("#page-target").val(),!1});';
