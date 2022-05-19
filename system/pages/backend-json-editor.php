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
$app_prefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];
$dirname = JSM_PATH . '/outputs/' . $app_prefix . '/src/assets/data';
$breadcrumb = $content = $page_js = null;
$lorem = new jsmLoremIpsum();
$check_tables = $db->getTables();
if (count($check_tables) == 0)
{
    $disable_button_save = 'disabled';
    $notice_backend = '<div class="alert alert-danger">You must create the <a href="./?p=backend-configuration">Back-End Configuration</a> before using this features</div>';
} else
{
    $disable_button_save = '';
    $notice_backend = '';
}

if (!file_exists($dirname))
{
    @mkdir($dirname, 0777, true);
}

if ($_GET['a'] == 'download')
{
    if (!isset($_GET['data']))
    {
        $_GET['data'] = 'all';
    }
    $arr_firebase = array();
    if ($_GET['data'] == 'all')
    {
        foreach (glob($dirname . "/*.json") as $filename)
        {
            $basename = pathinfo($filename, PATHINFO_FILENAME);
            $rawdata = file_get_contents($filename);
            $arr_firebase[$basename] = json_decode($rawdata, true);
        }
        file_put_contents(JSM_PATH . '/outputs/' . $app_prefix . '/src/assets/data.json', json_encode($arr_firebase));
        header('Content-type: application/json');
        header('Content-Disposition: attachment; filename="data.json"');
        echo json_encode($arr_firebase);
        die();
    } else
    {
        header('Content-type: application/json');
        header('Content-Disposition: attachment; filename="' . basename($_GET['data']) . '.json"');
        readfile($dirname . '/' . basename($_GET['data']) . '.json');
        die();
    }
}

if ($_GET['a'] == 'sample')
{
    $tables = $db->getTables();
    foreach ($tables as $table)
    {
        $json_sample = array();
        for ($i = 0; $i < 20; $i++)
        {
            $json_sample[$i] = array();
            foreach ($table['table-cols'] as $col)
            {


                $varName = $col['variable'];
                switch ($col['type'])
                {
                    case 'id':
                        $json_sample[$i][$varName] = $i;
                        break;
                    case 'varchar':
                        $json_sample[$i][$varName] = ucwords($lorem->words(3));
                        break;

                    case 'multi-text':
                        $text = array();
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));

                        $json_sample[$i][$varName] = $text;


                        break;
                    case 'multi-images':
                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/sandwich.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/espresso.jpg';
                        $json_sample[$i][$varName] = $img_cdn;
                        break;

                    case 'number-fixed-length':
                        $json_sample[$i][$varName] = "00" . rand(10, 99) . "";
                        break;

                    case 'image':
                        $json_sample[$i][$varName] = "";
                        break;
                    case 'thumbnail':
                        $json_sample[$i][$varName] = "";
                        break;
                    case 'file':
                        $json_sample[$i][$varName] = "";
                        break;
                    case 'select-table':
                        $json_sample[$i][$varName] = rand(1, 10); //"'" . ucwords($lorem->words(3)) . "'";
                        break;
                    case 'tinytext':
                        $json_sample[$i][$varName] = ucwords($lorem->words(16));
                        break;
                    case 'text':
                        $json_sample[$i][$varName] = ucwords($lorem->words(36));
                        break;
                    case 'longtext':
                        $text = null;
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $text .= $lorem->words(rand(1, 3), 'h3');
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $text .= $lorem->words(rand(1, 3), 'h4');
                        $text .= $lorem->sentences(1, 'blockquote');
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $json_sample[$i][$varName] = $text;
                        break;
                    case 'number':
                        $json_sample[$i][$varName] = rand(10, 999999);
                        break;
                    case 'date':
                        $json_sample[$i][$varName] = date('Y-m-d', (time() + rand(1000000, 9999999)));
                        break;
                    case 'time':
                        $json_sample[$i][$varName] = date('H:i:s', (time() + rand(1000000, 9999999)));
                        break;
                    case 'datetime':
                        $json_sample[$i][$varName] = date('Y-m-d H:i:s', (time() + rand(1000000, 9999999)));
                        break;
                    case 'boolean':
                        $json_sample[$i][$varName] = rand(0, 1);
                        break;
                    case 'select':
                        $json_sample[$i][$varName] = ucwords($lorem->words(1));
                        break;
                    case 'url':
                        $json_sample[$i][$varName] = "http://" . strtolower($lorem->words(1)) . ".com";
                        break;
                    case 'email':
                        $json_sample[$i][$varName] = strtolower($lorem->words(1)) . "@" . strtolower($lorem->words(1)) . ".com";
                        break;
                    case 'phone':
                        $json_sample[$i][$varName] = "0" . rand(812000000, 818900000);
                        break;
                }
            }

        }

        file_put_contents($dirname . '/' . $table['table-name'] . '.json', json_encode($json_sample));
    }


}


$content .= $notice_backend;

if (isset($_GET['table-name']))
{
    // TODO: EDIT --|-- BREADCRUMB
    $breadcrumb .= '<ol class="breadcrumb">';
    $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
    $breadcrumb .= '<li><a href="./?p=json-editor"><i class="fa fa-dashboard"></i> ' . __e('JSON Editor') . '</a></li>';
    $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
    $breadcrumb .= '</ol>';

    $current_table_name = $_GET['table-name'];
    $table = $db->getTables();

    if (isset($table[$current_table_name]))
    {
        $new_colums = $table[$current_table_name]['table-cols'];

        $filename = $dirname . '/' . $current_table_name . '.json';
        $raw_url_json = explode('outputs/', $filename);
        $url_json = 'outputs/' . $raw_url_json[1];
        $app_url_json = 'assets/data/' . $current_table_name . '.json';

        $array_json = $new_json = array();

        $var_id = $new_colums[0]['variable'];
        $no_id = 0;
        if (file_exists($filename))
        {
            $array_json = json_decode(file_get_contents($filename), true);
            foreach ($array_json as $item_json)
            {
                $new_json[] = $item_json;
            }
            $end_item = end($array_json);
            $no_id = (int)($end_item[$var_id]) + 1;
        }

        if (!file_exists($dirname))
        {
            mkdir($dirname, 0777, true);
        }

        if (!isset($_GET['col-id']))
        {
            if (isset($_POST['column']))
            {
                $new_json[$no_id] = $_POST['column'];
                $new_json[$no_id][$var_id] = (int)$no_id;
                file_put_contents($filename, json_encode($new_json));
                header('Location: ./?p=json-editor&table-name=' . $current_table_name);
            }
        } else
        {
            $no_id = (int)$_GET['col-id'];
            if ($_GET['a'] == 'edit')
            {
                if (isset($_POST['column']))
                {

                    $new_json = array();
                    $t = 0;
                    foreach ($array_json as $item_json)
                    {
                        if ($item_json[$var_id] != $no_id)
                        {
                            $new_json[$t] = $item_json;
                            $new_json[$t][$var_id] = (int)$item_json[$var_id];
                        } else
                        {
                            $new_json[$t] = $_POST['column'];
                            $new_json[$t][$var_id] = (int)$_POST['column'][$var_id];
                        }
                        $t++;
                    }
                    file_put_contents($filename, json_encode($new_json));
                    header('Location: ./?p=json-editor&table-name=' . $current_table_name . '&a=edit&col-id=' . $no_id);
                }

                foreach ($array_json as $item_json)
                {
                    if ($item_json[$var_id] == $no_id)
                    {
                        $raw_data = $item_json;
                    }
                }
            }elseif ($_GET['a'] == 'delete'){
                $new_json = array();
                $c = 0;
                foreach ($array_json as $item_json)
                {
                    if ($item_json[$var_id] != $no_id)
                    {
                        $new_json[$c] = $item_json;
                        $new_json[$c][$var_id] = (int)$item_json[$var_id];
                        $c++;
                    }
                }
                file_put_contents($filename, json_encode($new_json));
                header('Location: ./?p=json-editor&table-name=' . $current_table_name);
            }
        }


        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        $content .= '<form action="" method="post">';
        $content .= '<div class="box box-success">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-database"></i> ' . __e('Edit') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';

        // TODO: EDIT --|-- FORM

        foreach ($new_colums as $col)
        {
            $col_link = str_replace('_', '-', $col['variable']);
            if (isset($raw_data[$col['variable']]))
            {
                $current_value = $raw_data[$col['variable']];
            } else
            {
                $current_value = '';
            }
            switch ($col['type'])
            {
                case 'id':
                    $content .= '<input name="column[' . $col['variable'] . ']" type="hidden"  value="' . $no_id . '" />';
                    break;

                case 'multi-text':
                    if(!is_array($current_value)){
                        $current_value = array();
                    }
                    $tags_current_value = implode(', ', $current_value);
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input maxlength="128" name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($tags_current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'multi-images':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<p>Not support</p>';
                    $content .= '</div>';
                    break;

                case 'number-fixed-length':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input maxlength="128" name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'varchar':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input maxlength="128" name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'text':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<textarea name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '">' . htmlentities($current_value) . '</textarea>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'tinytext':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<textarea name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '">' . htmlentities($current_value) . '</textarea>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'longtext':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<textarea data-type="tinymce" name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '">' . htmlentities($current_value) . '</textarea>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'number':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input name="column[' . $col['variable'] . ']" id="" type="number" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'date':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<div class="input-group" data-type="date">';
                    $content .= '<input name="column[' . $col['variable'] . ']" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<span class="input-group-addon">';
                    $content .= '<span class="glyphicon glyphicon-calendar"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;
                case 'time':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<div class="input-group" data-type="time">';
                    $content .= '<input name="column[' . $col['variable'] . ']" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<span class="input-group-addon">';
                    $content .= '<span class="glyphicon glyphicon-time"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;
                case 'datetime':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<div class="input-group" data-type="datetime">';
                    $content .= '<input name="column[' . $col['variable'] . ']" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<span class="input-group-addon">';
                    $content .= '<span class="glyphicon glyphicon-calendar"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'boolean':
                    $opt = explode('|', $col['option']);
                    if (!isset($opt[0]))
                    {
                        $opt[0] = true;
                    }
                    if (!isset($opt[1]))
                    {
                        $opt[1] = false;
                    }
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';

                    if ($current_value == $opt[0])
                    {
                        $content .= '<div><label><input type="radio" name="column[' . $col['variable'] . ']" class="flat-blue" value="' . $opt[0] . '" checked> </label> &nbsp; ' . $opt[0] . '</div>';
                        $content .= '<div><label><input type="radio" name="column[' . $col['variable'] . ']" class="flat-blue" value="' . $opt[1] . '"> </label> &nbsp; ' . $opt[1] . '</div>';
                    } else
                    {
                        $content .= '<div><label><input type="radio" name="column[' . $col['variable'] . ']" class="flat-blue" value="' . $opt[0] . '" > </label> &nbsp; ' . $opt[0] . '</div>';
                        $content .= '<div><label><input type="radio" name="column[' . $col['variable'] . ']" class="flat-blue" value="' . $opt[1] . '" checked> </label> &nbsp; ' . $opt[1] . '</div>';
                    }
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';

                    break;
                case 'select':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<select name="column[' . $col['variable'] . ']" class="form-control">';
                    $opts = explode('|', $col['option']);
                    foreach ($opts as $opt)
                    {
                        $selected = '';
                        if ($current_value == $opt)
                        {
                            $selected = 'selected';
                        }
                        $content .= '<option value="' . $opt . '" ' . $selected . '>' . $opt . '</option>';
                    }
                    $content .= '</select>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;
                case 'thumbnail':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<div class="input-group">';
                    $content .= '<input name="column[' . $col['variable'] . ']" id="' . $col['variable'] . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<span class="input-group-addon" data-type="file-picker" data-target="#' . $col['variable'] . '">';
                    $content .= '<span class="glyphicon glyphicon-picture"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';

                    break;
                case 'image':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<div class="input-group">';
                    $content .= '<input name="column[' . $col['variable'] . ']" id="' . $col['variable'] . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<span class="input-group-addon" data-type="file-picker" data-target="#' . $col['variable'] . '">';
                    $content .= '<span class="glyphicon glyphicon-picture"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'file':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<div class="input-group">';
                    $content .= '<input name="column[' . $col['variable'] . ']" id="' . $col['variable'] . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<span class="input-group-addon" data-type="file-picker" data-target="#' . $col['variable'] . '">';
                    $content .= '<span class="glyphicon glyphicon-folder-open"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;

                case 'select-table':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<p>Not support</p>';
                    $content .= '</div>';
                    break;

                case 'url':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input name="column[' . $col['variable'] . ']" id="" type="url" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';

                    break;
                case 'email':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input name="column[' . $col['variable'] . ']" id="" type="email" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';

                    break;
                case 'phone':
                    $content .= '<div class="form-group">';
                    $content .= '<label>' . $col['label'] . '</label>';
                    $content .= '<input maxlength="16" name="column[' . $col['variable'] . ']" id="" type="text" class="form-control" placeholder="' . $col['option'] . '" value="' . htmlentities($current_value) . '" />';
                    $content .= '<p class="help-block">' . $col['info'] . '</p>';
                    $content .= '</div>';
                    break;
            }
        }


        $content .= '</div>';

        $content .= '<div class="box-footer">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '</form>';

        $content .= '</div>';
        $content .= '<div class="col-md-6">';


        $content .= '<div class="box box-primary">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-database"></i> ' . __e('Data') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<blockquote class="blockquote blockquote-default"><span class="label label-danger">JSON Url</span> : <a target="_blank" href="' . $url_json . '"><code>' . $app_url_json . '</code></a></blockquote>';

        $content .= '<div class="table-responsive">';
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>' . __e('Action') . '</th>';
        foreach ($new_colums as $new_colum)
        {
            if ($new_colum['item_list'] == true)
            {
                $content .= '<th>' . $new_colum['variable'] . '</th>';
            }
        }

        $content .= '</tr>';
        $content .= '</thead>';
        $content .= '<tbody>';
        foreach ($new_json as $item)
        {
            $content .= '<tr>';
            $content .= '<td style="text-align: center;">';
             $content .= '<div class="btn-toolbar" role="toolbar">';
            $content .= '<a class="btn btn-xs btn-success" href="?p=json-editor&table-name=' . $current_table_name . '&col-id=' . $item[$var_id] . '&a=edit"><i class="fa fa-pencil"></i>  ' . __e('Edit') . '</a>';
            $content .= '<a class="btn btn-xs btn-danger" href="?p=json-editor&table-name=' . $current_table_name . '&col-id=' . $item[$var_id] . '&a=delete"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
           $content .= '</div>';
           
            $content .= '</td>';
            foreach ($new_colums as $new_colum)
            {
                if ($new_colum['item_list'] == true)
                {
                    if (!isset($item[$new_colum['variable']]))
                    {
                        $item[$new_colum['variable']] = '<span class="label label-danger">error</span>';
                    }

                    if (is_array($item[$new_colum['variable']]))
                    {
                        $content .= '<td>' . implode(",", $item[$new_colum['variable']]) . '</td>';
                    } else
                    {
                        $content .= '<td>' . htmlentities($item[$new_colum['variable']]) . '</td>';
                    }

                }

            }

            $content .= '</tr>';
        }
        $content .= '</tbody>';
        $content .= '</table>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';
    } else
    {
        header('Location: ?p=json-editor');
    }
} else
{
    // TODO: LISTING --|--
    // TODO: LISTING --|-- BREADCRUMB

    $breadcrumb .= '<ol class="breadcrumb">';
    $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
    $breadcrumb .= '<li><a href="./?p=json-editor"><i class="fa fa-dashboard"></i> ' . __e('JSON Editor') . '</a></li>';
    $breadcrumb .= '<li class="active">' . __e('List') . '</li>';
    $breadcrumb .= '</ol>';

    $tables = $db->getTables();
    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="box box-success">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-database"></i> ' . __e('Database') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-12">';
    
    
    
    // TODO: LISTING --|-- TABLE
    $content .= '<div class="table-responsive">';
    $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
    $content .= '<thead>';
    $content .= '<th>' . __e('Name') . '</th>';
    //$content .= '<th>' . __e('Description') . '</th>';
    $content .= '<th>' . __e('JSON URL') . '</th>';
    $content .= '<th>' . __e('#') . '</th>';
    $content .= '</thead>';
    $content .= '<tbody>';
    foreach ($tables as $table)
    {
        $local_url = 'assets/data/' . $table['table-prefix'] . '.json';
        $content .= '<tr>';
        $content .= '<td>' . $table['table-name'] . '</td>';
        //$content .= '<td>' . $table['table-desc'] . '</td>';
        $content .= '<td><code>' . $local_url . '</code></td>';
        $content .= '<td>';
        $content .= '<a class="btn btn-xs btn-success" target="_blank" href="./outputs/' . $app_prefix . '/src/' . $local_url . '">' . __e('View Data') . '</a>&nbsp;';
        $content .= '<a class="btn btn-xs  btn-primary" target="_blank" href="?p=json-editor&a=download&data=' . $table['table-prefix'] . '">' . __e('Download Data') . '</a>&nbsp;';
        $content .= '<a class="btn btn-xs btn-danger" href="./?p=json-editor&table-name=' . $table['table-prefix'] . '">' . __e('Edit Data') . '</a>&nbsp;';
        $content .= '</td>';

        $content .= '</tr>';
    }
    $content .= '</tbody>';
    $content .= '</table>';
    $content .= '</div>';
    
    $content .= '</div>';
    $content .= '</div>';


    $content .= '<br/>';
    $content .= '<a target="_blank" class="pull-right btn btn-md btn-primary" href="./?p=json-editor&a=download&data=all">' . __e('Download All Data') . '</a>';
    $content .= '<a class="pull-left btn btn-md btn-default" href="./?p=json-editor&a=sample">' . __e('Create Sample Data') . '</a>';

    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="col-md-6">';

    $content .= '<div class="box box-primary">';
    $content .= '<div class="box-header with-border">';
    $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('URL and Parameter') . '</h3>';
    $content .= '<div class="pull-right box-tools">';
    $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
    $content .= '<i class="fa fa-minus"></i>';
    $content .= '</button>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="box-body">';
    $content .= '<h4>' . __e('Offline App') . '</h4>';
    $content .= '<ol>';
    $content .= '<li>';
    $content .= __e('This JSON Scraping settings can be used!');
    $content .= '<table class="table table-striped table-bordered">';
    $content .= '<thead>';
    $content .= '<tr>';
    $content .= '<th>JSON URL for List Item</th>';
    $content .= '<th>JSON URL for Single Item</th>';
    $content .= '</tr>';
    $content .= '</thead>';
    $content .= '<tbody>';
    foreach ($tables as $table)
    {
        $local_url = 'assets/data/' . $table['table-prefix'] . '.json';

        $content .= '<tr>';
        $content .= '<td>' . $local_url . '</td>';
        $content .= '<td>-</td>';
        $content .= '</tr>';
    }
    $content .= '</tbody>';
    $content .= '</table>';
    $content .= '</li>';
    $content .= '</ol>';

    $content .= '<hr/>';
    $content .= '<h4>' . __e('How to import to firebase?') . '</h4>';

    $content .= '<ol>';
    $content .= '<li>' . __e('Login to Your <a href="https://console.firebase.google.com/" target="_blank">Firebase Console</a>, then Create a project') . '</li>';
    $content .= '<li>' . __e('Go to <code>DEVELOP</code> -&gt; <code>Database</code> -&gt; Change to <code>Realtime Database</code>') . '</li>';
    $content .= '<li>' . __e('Click <strong>Icon More Vertical</strong> (&nbsp;<i class="fa fa-ellipsis-v"></i>&nbsp;) -&gt; <code>Import JSON</code>  -&gt; Browse -&gt; Upload JSON files, get the file to upload from Get the file to upload from <a target="_blank" href="./?p=json-editor&a=download&data=all">Download All Data</a>') . '</li>';
    $content .= '<li>' . __e('Then give access to <code>readonly</code> for avoid error <code>Permission denied</code>, click <code>Rules</code> Tabs, edit rules like this:') . '';
    $rules = array();
    foreach ($tables as $table)
    {
        $new_cols = array();
        foreach ($table['table-cols'] as $cols)
        {
            $new_cols[] = $cols['variable'];
        }
        $newdata = null;
        $newdata .= "\t\t" . '"' . $table['table-prefix'] . '" : {' . "\r\n";
        $newdata .= "\t\t\t" . '".read": true,' . "\r\n";
        $newdata .= "\t\t\t" . '".write": false,' . "\r\n";
        $newdata .= "\t\t\t" . '".indexOn": ["' . implode('","', $new_cols) . '"] ' . "\r\n";
        $newdata .= "\t\t" . '}' . "\r\n";
        $rules[] = $newdata;
    }


    $content .= '<pre>';
    $content .= "" . '{' . "\r\n";
    $content .= "\t" . '"rules": {' . "\r\n";
    $content .= implode(',', $rules);
    $content .= "\t" . '}' . "\r\n";
    $content .= '}' . "\r\n";
    $content .= '</pre>';
    $content .= __e('Then click <strong>Publish</strong>');
    $content .= '</li>';

    $content .= '<li>';
    $content .= __e('This JSON Scraping settings can be used!');
    $content .= '<table class="table table-striped table-bordered">';
    $content .= '<thead>';
    $content .= '<tr>';
    $content .= '<th>JSON URL for List Item</th>';
    $content .= '<th>JSON URL for Single Item</th>';
    $content .= '</tr>';
    $content .= '</thead>';
    $content .= '<tbody>';
    foreach ($tables as $table)
    {

        $content .= '<tr>';
        $content .= '<td>https://example.firebaseio.com/' . $table['table-prefix'] . '.json</td>';
        $content .= '<td>https://example.firebaseio.com/' . $table['table-prefix'] . '/{id}.json</td>';
        $content .= '</tr>';
    }
    $content .= '</tbody>';
    $content .= '</table>';
    $content .= '</li>';


    $content .= '</ol>';
    $content .= '</div><!-- ./box-body -->';
    $content .= '</div><!-- ./box -->';

    $content .= '</div>';
    $content .= '</div>';
}


$page_js .= '';


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) JSON Editor');
$template->page_desc = __e('Create, edit, or delete an item from JSON file');
$template->page_content = $content;

?>