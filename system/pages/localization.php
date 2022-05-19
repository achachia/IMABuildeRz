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
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

$breadcrumb = $content = $page_js = null;
$db = new jsmDatabase();
$icon = new jsmIcon();
$current_app = $db->current();
$locale = new jsmLocale();
$countries = $locale->getLang();
rebuild();

$dir_lang = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/src/assets/i18n/';
if (!file_exists($dir_lang))
{
    @mkdir($dir_lang, 0777, true);
}




if (isset($_POST['submit']))
{
    $new_project = $current_app['apps'];
    $new_project['ionic-storage'] = true;
    $db->saveProject($new_project);
    if (isset($_GET['locale-name']))
    {
        $_POST['localization']['prefix'] = $_GET['locale-name'];
    }
    $data_post = $_POST['localization'];
    $db->saveLocalization($data_post);

    $db->current();
    if (isset($_GET['locale-name']))
    {
        header("Location: ./?p=localization&a=edit&locale-name=" . basename($_GET['locale-name']) . '&' . time());
    } else
    {
        header("Location: ./?p=localization&a=list" . '&' . time());
    }
    rebuild();
}

 

$new_word = array();
//menus
if (isset($current_app['menus']['items']))
{

    foreach ($current_app['menus']['items'] as $item)
    {
        $var = sha1($item['label']);
        $new_word[$var] = $item['label'];
    }
}
//popover
if (isset($current_app['popover']['items']))
{
    if ($current_app['popover']['title'] != '')
    {
        $var = sha1($current_app['popover']['title']);
        $new_word[$var] = $current_app['popover']['title'];
    }
    foreach ($current_app['popover']['items'] as $item)
    {
        $var = sha1($item['label']);
        $new_word[$var] = $item['label'];
    }
}


$text = 'Default';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'Cancel';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'Ok';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'Yes';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'Readmore';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'Select Language?';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'Do you want to exit App?';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'years ago';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'months ago';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'days ago';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'hours ago';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'minutes ago';
$var = sha1($text);
$new_word[$var] = $text;

$text = 'seconds ago';
$var = sha1($text);
$new_word[$var] = $text;


$texts = array();
$default_texts = array_values($new_word);
foreach ($default_texts as $default_text)
{
    $texts[$default_text] = $default_text;
}

$default_file = $dir_lang . '/' . $current_app['apps']['app-locale'] . '.json';

if (defined("JSON_PRETTY_PRINT"))
{
    //file_put_contents($default_file, json_encode($texts, JSON_PRETTY_PRINT));
} else
{
    //file_put_contents($default_file, json_encode($texts));
}

$z = 0;
$core_texts = array();
foreach ($default_texts as $default_text)
{

    $core_texts[$z]['text'] = $default_text;
    $core_texts[$z]['translate'] = '';
    $z++;
}


$intructions = null;
$intructions .= '<ol>';

$intructions .= '<li>';
$intructions .= '<p> ' . __e('First, You  must install <code>Ionic Storage</code>') . '</p>';
$intructions .= '<pre class="shell">ionic cordova plugin add cordova-sqlite-storage@latest --save</pre>';
$intructions .= '<pre class="shell">npm install --save @ionic/storage-angular@latest</pre>';
$intructions .= '</li>';

$intructions .= '<li>';
$intructions .= '<p> ' . __e('Then install <code>ngx-translate</code>') . '</p>';
$intructions .= '<pre class="shell">npm install @ngx-translate/core --save</pre>';
$intructions .= '<pre class="shell">npm install @ngx-translate/http-loader --save</pre>';
$intructions .= '</li>';

$intructions .= '<li>';
$intructions .= '<p> ' . __e('To write text on the content, it can be written as follows:') . '</p>';
$intructions .= '<pre>{{ "Lorem Ipsum" | translate }}</pre>';
$intructions .= '</li>';


$intructions .= '</ol>';


switch ($_GET['a'])
{
    case 'list':
        // TODO: LIST

        // TODO: LIST --|-- BREADCUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . ('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . ('Localization') . '</li>';
        $breadcrumb .= '</ol>';

        // TODO: LIST --|-- LAYOUT
        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('General') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<div class="well">';
        $content .= '<h1>Localization</h1>';
        $content .= '<p class="lead">' . __e('Allows you to create ionic projects with multiple language support') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Localization') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('Add or edit languages according to your needs') . ':</p>';

        $_content = null;
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>';
        $content .= __e('Localization');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Prefix');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Description');
        $content .= '</th>';

        $content .= '<th>';
        $content .= __e('Action');
        $content .= '</th>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        if (!isset($_SESSION['CURRENT_APP']['localization']))
        {
            $_SESSION['CURRENT_APP']['localization'] = array();
        }
        foreach ($_SESSION['CURRENT_APP']['localization'] as $localization)
        {
            if (!isset($localization['desc']))
            {
                $localization['desc'] = '-';
            }

            $content .= '<tr>';

            $content .= '<td>';
            $content .= $localization['name'];
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<label class="label label-info">' . $localization['prefix'] . '</label>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= $localization['desc'];
            $content .= '</td>';


            $content .= '<td>';
            $content .= '<a target="_blank" href="./system/plugin/viewsource/?localization=' . $localization['prefix'] . '&type=json" class="btn btn-flat btn-xs btn-success"><i class="fa fa-file-code-o"></i> ' . __e('View Source') . '</a> ';
            $content .= '<a href="./?p=localization&a=edit&locale-name=' . $localization['prefix'] . '" class="btn btn-flat btn-xs btn-warning"><i class="fa fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a> ';
            $content .= '<a href="#!" data-toggle="modal" data-target="#delete-locale-dialog-' . $localization['prefix'] . '" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a> ';
            $content .= '</td>';

            $content .= '</tr>';


            // TODO: LIST --|-- DIALOG
            $_content .= '<div class="modal fade modal-default" id="info-pipe-dialog-' . $localization['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="info-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" >Info <strong>' . $localization['name'] . '</strong> <small>Pipe</small></h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<div style="overflow-y:scroll;height:120px;padding: 12px;">';
            $_content .= '<p>' . $localization['desc'] . '</p>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';


            $_content .= '<div class="modal modal-md fade modal-default" id="delete-locale-dialog-' . $localization['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This language') . '</h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<p>' . __e('Are you sure you want to delete this language?') . '</p>';
            $_content .= '<div class="row">';
            $_content .= '<div class="col-md-3 text-right">';
            $_content .= '<div class="icon text-center icon-confirm"><i class="fa-5x fa fa-gg"></i></div>';
            $_content .= '</div>';
            $_content .= '<div class="col-md-9 text-left">';

            $_content .= '<table class="table-confirm">';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Language Name') . '</td>';
            $_content .= '<td>: <strong>' . $localization['name'] . '</strong></td>';
            $_content .= '</tr>';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Prefix') . '</td>';
            $_content .= '<td>: <strong>' . $localization['prefix'] . '</strong></td>';
            $_content .= '</tr>';
            $_content .= '</table>';

            $_content .= '</div>';
            $_content .= '</div>';

            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<a href="./?p=localization&a=delete&locale-name=' . $localization['prefix'] . '&ok" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';


        }
        $content .= '</tbody>';
        $content .= '</table>';

        $content .= $_content;
        $content .= '</div>';
        $content .= '<div class="box-footer">';
        $content .= '<a href="./?p=localization&a=new" class="btn btn-flat btn-danger">' . __e('Create new Language') . '</a>&nbsp;';
        $content .= '</div>';

        $content .= '</div>';
        break;

    case 'edit':

        // TODO: EDIT
        if (isset($_GET['locale-name']))
        {

            $locale_name = basename($_GET['locale-name']);
            $locale_data = $db->getLocalization($locale_name);


            // TODO: EDIT --|-- BREADCUMB
            $breadcrumb = null;
            $breadcrumb .= '<ol class="breadcrumb">';
            $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
            $breadcrumb .= '<li><a href="./?p=localization">' . __e('Localization') . '</a></li>';
            $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
            $breadcrumb .= '</ol>';


            // TODO: EDIT --|-- FORM
            $content .= '<form role="form" action="" method="post">';

            // TODO: EDIT --|-- FORM --|-- GENERAL

            $content .= '<div class="row">';
            $content .= '<div class="col-md-6">';
            $content .= '<div class="box box-primary">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('General') . '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';
            $content .= '<p class="output-file">Generated file: <code>src/assets/i18n/' . htmlentities($locale_data['prefix']) . '.json</code></p>';
            $content .= '<p>' . __e('Complete the fields below:') . '</p>';

            $content .= '<div class="row">';
            $content .= '<div class="col-md-6">';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Name') . '</label>';
            $content .= '<input type="text" name="localization[name]" class="form-control" value="' . htmlentities($locale_data['name']) . '" placeholder="Bahasa Indonesia" required/>';
            $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
            $content .= '</div> ';
            $content .= '</div>';
            $content .= '<div class="col-md-6">';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Prefix') . '</label>';


            $content .= '<select readonly="readonly" name="localization[prefix]" class="form-control" id="localization-prefix">';
            if (!isset($locale_data['prefix']))
            {
                $locale_data['prefix'] = 'en-GB';
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
                if ($country_prefix == $locale_data['prefix'])
                {
                    $selected = 'selected';
                }
                $content .= '<option ' . $selected . ' value="' . $country_prefix . '">' . $nice_label_country . '</option>';
            }
            $content .= '</select>';

            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Description') . '</label>';
            $content .= '<input type="text" name="localization[desc]" class="form-control" value="' . htmlentities($locale_data['desc']) . '" placeholder="" />';
            $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
            $content .= '</div>';


            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?localization=' . $locale_data['prefix'] . '&type=json">' . __e('View Source Code') . '</a>';

            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="col-md-6">';
            $content .= '<div class="box box-danger">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Instructions') . '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';

            $content .= $intructions;


            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?localization=' . $locale_data['prefix'] . '&type=json">' . __e('View Source Code') . '</a>';

            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>'; //col-md-6

            $content .= '</div>'; //row


            // TODO: EDIT --|-- FORM --|-- WORDS
            $content .= '<div class="row">';
            $content .= '<div class="col-md-12">';
            $content .= '<div class="box box-success">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Words') . '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';


            $content .= '<table class="table table-striped" >';

            $content .= '<thead>';
            $content .= '<tr>';
            $content .= '<th>';
            $content .= '' . __e('Text') . '';
            $content .= '</th>';
            $content .= '<th>';
            $content .= '' . __e('HTML Code') . '';
            $content .= '</th>';
            $content .= '<th>';
            $content .= '' . __e('Translate') . '';
            $content .= '</th>';
            $content .= '</tr>';
            $content .= '</thead>';

            $content .= '<tbody>';
            $new_core_texts = array();
            foreach ($core_texts as $check_text)
            {
                $var = sha1($check_text['text']);
                $new_core_texts[$var] = $check_text;
            }

            if (!isset($locale_data['words']))
            {
                $locale_data['words'] = $core_texts;
            }
            $z = 0;
            foreach ($locale_data['words'] as $word)
            {
                $content .= '<tr id="localization-words-' . $z . '"  >' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-text" name="localization[words][' . $z . '][text]" class="form-control" readonly="readonly" value="' . $word['text'] . '" />' . "\r\n";
                $content .= '</td>' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<pre>{{ "' . $word['text'] . '" | translate }}</pre>' . "\r\n";
                $content .= '</td>' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-translate" name="localization[words][' . $z . '][translate]" class="form-control" value="' . $word['translate'] . '" />' . "\r\n";
                $content .= '</td>' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<a href="#!_" class="btn btn-xs btn-danger remove-item" data-target="#localization-words-' . $z . '"><i class="fa fa-trash"></a></i>' . "\r\n";
                $content .= '</td>' . "\r\n";


                $content .= '</tr>' . "\r\n";

                $var = sha1($word['text']);
                unset($new_core_texts[$var]);

                $z++;
            }

            foreach ( array_values( $new_core_texts) as $word)
            {
                $content .= '<tr id="localization-words-' . $z . '"  >' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-text" name="localization[words][' . $z . '][text]" class="form-control" readonly="readonly" value="' . $word['text'] . '" />' . "\r\n";
                $content .= '</td>' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<pre>{{ "' . $word['text'] . '" | translate }}</pre>' . "\r\n";
                $content .= '</td>' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-translate" name="localization[words][' . $z . '][translate]" class="form-control" value="' . $word['translate'] . '" />' . "\r\n";
                $content .= '</td>' . "\r\n";

                $content .= '<td>' . "\r\n";
                $content .= '<a href="#!_" class="btn btn-xs btn-danger remove-item" data-target="#localization-words-' . $z . '"><i class="fa fa-trash"></a></i>' . "\r\n";
                $content .= '</td>' . "\r\n";
                $content .= '</tr>' . "\r\n";
                $z++;
            }


            $z++;
            $content .= '<tr>' . "\r\n";
            $content .= '<td>' . "\r\n";
            $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-text" name="localization[words][' . $z . '][text]" class="form-control" />' . "\r\n";
            $content .= '</td>' . "\r\n";
            $content .= '<td>' . "\r\n";
            $content .= '' . "\r\n";
            $content .= '</td>' . "\r\n";

            $content .= '<td>' . "\r\n";
            $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-translate" name="localization[words][' . $z . '][translate]" class="form-control" />' . "\r\n";
            $content .= '</td>' . "\r\n";

            $content .= '<td>' . "\r\n";
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-plus"></i> ' . __e('Add') . '</button>' . "\r\n";
            $content .= '</td>' . "\r\n";


            $content .= '</tr>' . "\r\n";


            $content .= '<tbody>';

            $content .= '</table>';

            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?localization=' . $locale_data['prefix'] . '&type=json">' . __e('View Source Code') . '</a>';

            $content .= '</div>';
            $content .= '</div>';

            $content .= '</div>'; //col-md-12
            $content .= '</div>'; //row


            $content .= '</form>'; //form
        }
        break;

    case 'new':
        // TODO: NEW --|-- BREADCUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=localization">' . __e('Localization') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('New') . '</li>';
        $breadcrumb .= '</ol>';

        // TODO: NEW --|-- FORM
        $content .= '<form role="form" action="" method="post">';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="box box-primary">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('General') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Name') . '</label>';
        $content .= '<input type="text" name="localization[name]" class="form-control" value="" placeholder="Bahasa Indonesia" required/>';
        $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
        $content .= '</div> ';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';

        // TODO: NEW --|-- FORM --|-- GENERAL

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix') . '</label>';

        $content .= '<select name="localization[prefix]" class="form-control" id="localization-prefix">';
        if (!isset($locale_default['prefix']))
        {
            $locale_default['prefix'] = 'en-GB';
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
            if ($country_prefix == $locale_default['prefix'])
            {
                $selected = 'selected';
            }
            $content .= '<option ' . $selected . ' value="' . $country_prefix . '">' . $nice_label_country . '</option>';
        }
        $content .= '</select>';

        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="localization[desc]" class="form-control" value="" placeholder="" />';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Instructions') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';


        $content .= $intructions;
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>'; //col-md-6
        $content .= '</div>'; //row


        $content .= '<div class="row">';
        $content .= '<div class="col-md-12">';
        $content .= '<div class="box box-primary">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Words') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">' . "\r\n";

        // TODO: NEW --|-- FORM --|-- WORDS
        $content .= '<table class="table table-striped">' . "\r\n";

        $content .= '<thead>' . "\r\n";
        $content .= '<tr>' . "\r\n";

        $content .= '<th>' . "\r\n";
        $content .= '' . __e('Text') . '';
        $content .= '</th>' . "\r\n";

        $content .= '<th>' . "\r\n";
        $content .= '' . __e('HTML Code') . '';
        $content .= '</th>' . "\r\n";

        $content .= '<th>' . "\r\n";
        $content .= '' . __e('Translate') . '';
        $content .= '</th>' . "\r\n";

        $content .= '<th>' . "\r\n";
        $content .= '' . __e('Action') . '';
        $content .= '</th>' . "\r\n";

        $content .= '</tr>' . "\r\n";
        $content .= '</thead>' . "\r\n";

        $content .= '<tbody>' . "\r\n";
        if (!isset($locale_data['words']))
        {
            $locale_data['words'] = $core_texts;
        }
        $z = 0;
        foreach ($locale_data['words'] as $word)
        {
            $content .= '<tr id="localization-words-' . $z . '"  >' . "\r\n";

            $content .= '<td>' . "\r\n";
            $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-text" name="localization[words][' . $z . '][text]" class="form-control" readonly="readonly" value="' . $word['text'] . '" />' . "\r\n";
            $content .= '</td>' . "\r\n";

            $content .= '<td>' . "\r\n";
            $content .= '<pre>{{ "' . $word['text'] . '" | translate }}</pre>' . "\r\n";
            $content .= '</td>' . "\r\n";

            $content .= '<td>' . "\r\n";
            $content .= '<input style="width:100%" type="text" id="localization-words-' . $z . '-translate" name="localization[words][' . $z . '][translate]" class="form-control" value="' . $word['translate'] . '" />' . "\r\n";
            $content .= '</td>' . "\r\n";

            $content .= '<td>' . "\r\n";
            $content .= '<a href="#!_" class="btn btn-xs btn-danger remove-item" data-target="#localization-words-' . $z . '"><i class="fa fa-trash"></a></i>' . "\r\n";
            $content .= '</td>' . "\r\n";


            $content .= '</tr>' . "\r\n";
            $z++;
        }


        $content .= '<tbody>' . "\r\n";

        $content .= '</table>' . "\r\n";

        $content .= '</div>' . "\r\n";
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>'; //col-md-12
        $content .= '</div>'; //row

        $content .= '</form>';

        break;
    case 'delete':
        if (isset($_GET['ok']))
        {
            $locale_name = basename($_GET['locale-name']);
            $db->deleteLocalization($locale_name);
            $db->current();
            rebuild();
            header("Location: ./?p=localization&" . time());
        }
        break;

}

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = ('(IMAB) Localization');
$template->page_desc = ('Adding Multi Language Translation');
$template->page_content = $content;

?>