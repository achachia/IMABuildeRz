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


$breadcrumb = $content = $html_header_color = $page_js = $html_header_type = null;
$db = new jsmDatabase();
$icon = new jsmIcon();

$string = new jsmString();


// TODO: SAVE-TABLES
if (isset($_POST['submit-tables']))
{

    if ($_POST['tables']['name'] !== '')
    {
        $_newTable['table-name'] = $_POST['tables']['name'];
        $_newTable['table-singular-name'] = $_POST['tables']['singular-name'];
        $_newTable['table-plural-name'] = $_POST['tables']['plural-name'];
        $_newTable['table-cols'] = $_POST['tables']['cols'];
        $_newTable['table-desc'] = $_POST['tables']['desc'];
        $_newTable['table-icon-fontawesome'] = $_POST['tables']['icon-fontawesome'];
        $_newTable['table-icon-dashicons'] = $_POST['tables']['icon-dashicons'];
        $_newTable['table-icon-ionicons'] = 'book';
        if (!isset($_POST['tables']['variable-as-label']))
        {
            $_POST['tables']['variable-as-label'] = 'label';
        }
        if (!isset($_POST['tables']['variable-as-value']))
        {
            $_POST['tables']['variable-as-value'] = 'id';
        }
        $_newTable['table-variable-as-label'] = $_POST['tables']['variable-as-label'];
        $_newTable['table-variable-as-value'] = $_POST['tables']['variable-as-value'];

        $postfalse = false;
        foreach ($_POST['tables']['cols'] as $cols)
        {
            if (isset($cols['json-input']))
            {
                $postfalse = true;
            }
        }
        
        if ($postfalse == true)
        {
            $_newTable['form-method'] = $_POST['tables']['form-method'];
        } else
        {
            $_newTable['form-method'] = 'none';
        }


        if (isset($_POST['tables']['form-filter-duplicate']))
        {
            $_newTable['form-filter-duplicate'] = true;
        } else
        {
            $_newTable['form-filter-duplicate'] = false;
        }
        if (isset($_POST['tables']['auth-enable']))
        {
            $_newTable['auth-enable'] = true;
        } else
        {
            $_newTable['auth-enable'] = false;
        }

        $_SESSION['TOOL_ALERT']['type'] = 'success';
        $_SESSION['TOOL_ALERT']['title'] = __e('Well done!');
        $_SESSION['TOOL_ALERT']['message'] = __e('You have saved the tables successfully');
        $db->saveTable($_newTable);
        $db->current();
        rebuild();

        $table_prefix = $string->toFileName($_newTable['table-name']);
        // header("Location: ./?p=backend-configuration&a=edit&table-name=" . $table_prefix);

    } else
    {
        $_SESSION['TOOL_ALERT']['type'] = 'error';
        $_SESSION['TOOL_ALERT']['title'] = __e('Ops!');
        $_SESSION['TOOL_ALERT']['message'] = __e('Sorry, an error has occurred! table name cannot be empty');
    }
}
if (!isset($_GET['a']))
{
    $_GET['a'] = 'list';
}

$rawdata['table-name'] = '';
$rawdata['table-label'] = '';
$rawdata['table-desc'] = '';
$rawdata['table-icon-fontawesome'] = 'table';
$rawdata['table-icon-ionicons'] = 'grid';
$rawdata['table-icon-dashicons'] = 'sos';
$rawdata['table-singular-name'] = '';
$rawdata['table-plural-name'] = '';
$rawdata['table-varibale-as-label'] = '';
$rawdata['table-varibale-as-value'] = '';

$max_column = 3;
switch ($_GET['a'])
{
    case 'delete':
        $db->deleteTable($_GET['table-name']);
        header("Location: ./?p=backend-configuration&a=list&" . time());
        break;
    case 'edit':
        $rawdata = $db->getTable($_GET['table-name']);
        $max_column = count($rawdata['table-cols']) + 1;
        break;
    case 'list':
        break;
}
if (!isset($rawdata['table-varibale-as-value']))
{
    $rawdata['table-varibale-as-value'] = '';
}
if (!isset($rawdata['table-varibale-as-label']))
{
    $rawdata['table-varibale-as-label'] = '';
}
if (!isset($rawdata['table-cols']))
{
    $rawdata['table-cols'] = array();
}
if (!isset($rawdata['form-method']))
{
    $rawdata['form-method'] = 'none';
}
if (!is_array($rawdata['table-cols']))
{
    $rawdata['table-cols'] = array();
}


if (!isset($rawdata['form-filter-duplicate']))
{
    $rawdata['form-filter-duplicate'] = false;
}
// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Configuration') . '</li>';
$breadcrumb .= '</ol>';

$content .= '<form action="" method="post">';


$content .= '<div class="row"><!-- row -->';

$content .= '<div class="col-md-8">';

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
$content .= '<div class="callout callout-info">' . __e('Create tables and configuration for your backend app') . '</div>';

// TODO: GENERAL - FORM INPUT

$content .= '<div class="row">';
$content .= '<div class="col-md-4">';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Table Name') . '</label>';
$content .= '<input type="text" name="tables[name]" class="form-control" placeholder="book" value="' . htmlentities($rawdata['table-name']) . '" required/>';
$content .= '<p class="help-block">' . __e('You can use your sql table name') . '</p>';
$content .= '</div>';

$content .= '</div>';

$content .= '<div class="col-md-4">';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Singular Name') . '</label>';
$content .= '<input type="text" name="tables[singular-name]" class="form-control" placeholder="book" value="' . htmlentities($rawdata['table-singular-name']) . '" required/>';
$content .= '<p class="help-block">' . __e('Write a nice name using a singular word') . '</p>';
$content .= '</div>';

$content .= '</div>';

$content .= '<div class="col-md-4">';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Plural Name') . '</label>';
$content .= '<input type="text" name="tables[plural-name]" class="form-control" placeholder="books" value="' . htmlentities($rawdata['table-plural-name']) . '" required/>';
$content .= '<p class="help-block">' . __e('Write a nice name using a plural word') . '</p>';
$content .= '</div>';

$content .= '</div>';

$content .= '</div>';

// TODO: GENERAL - FORM INPUT - ICONS
$content .= '<div class="row">';
$content .= '<div class="col-md-4">';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Fontawesome') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input type="text" name="tables[icon-fontawesome]" id="tables-icon-fontawesome" class="form-control" value="' . htmlentities($rawdata['table-icon-fontawesome']) . '" required/>';
$content .= '<span class="input-group-addon">';
$content .= '<i id="preview-tables-icon-fontawesome" class="pointer fa fa-' . htmlentities($rawdata['table-icon-fontawesome']) . '" data-type="icon-picker" data-target="#tables-icon-fontawesome" data-dialog="#fa-icon-dialog">&nbsp;&nbsp;</i>';
$content .= '</span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('This icon is used for general site') . '</p>';
$content .= '</div>';

$content .= '</div>';
$content .= '<div class="col-md-4">';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Dashicons') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input type="text" name="tables[icon-dashicons]" id="tables-icon-dashicons" class="form-control" value="' . htmlentities($rawdata['table-icon-dashicons']) . '" required/>';
$content .= '<span class="input-group-addon">';
$content .= '<i id="preview-tables-icon-dashicons" class="pointer dashicons dashicons-' . htmlentities($rawdata['table-icon-dashicons']) . '" data-type="icon-picker" data-target="#tables-icon-dashicons" data-dialog="#dashicons-icon-dialog">&nbsp;&nbsp;</i>';
$content .= '</span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('This icon is used for WordPress site') . '</p>';
$content .= '</div>';

$content .= '</div>';
$content .= '<div class="col-md-4">';

/**
 * $content .= '<div class="form-group">';
 * $content .= '<label>' . __e('Ionicons') . '</label>';
 * $content .= '<div class="input-group">';
 * $content .= '<input type="text" name="tables[icon-ionicons]" id="tables-icon-ionicons" class="form-control" value="' . htmlentities($rawdata['table-icon-ionicons']) . '" required/>';
 * $content .= '<span class="input-group-addon">';
 * $content .= '<i id="preview-tables-icon-ionicons" class="pointer ion ion-' . htmlentities($rawdata['table-icon-ionicons']) . ' ion-md-' . htmlentities($rawdata['table-icon-ionicons']) . '" data-type="icon-picker" data-target="#tables-icon-ionicons" data-dialog="#ion-icon-dialog">&nbsp;&nbsp;</i>';
 * $content .= '</span>';
 * $content .= '</div>';
 * $content .= '<p class="help-block">' . __e('This icon is used for other site') . '</p>';
 * $content .= '</div>';
 **/

$content .= '</div>';
$content .= '</div>';

// TODO: GENERAL - FORM INPUT - DESC
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Description') . '</label>';
$content .= '<input type="text" name="tables[desc]" class="form-control" value="' . htmlentities($rawdata['table-desc']) . '" />';
$content .= '<p class="help-block">' . __e('a brief description of this table') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
switch ($_GET['a'])
{
    case 'delete':
        $content .= '<input name="submit-tables" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Add New Table') . '" />';
        break;
    case 'edit':
        $content .= '<input name="submit-tables" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
        $content .= '<div class="pull-right">' . "\r\n";
        $content .= '<a href="./?p=wp-plugin-generator&exec-wp-plugin" target="_blank" class="btn btn btn-default btn-flat" ><i class="fa fa-wordpress"></i> ' . __e('Generate Test files for WP Plugin') . '</a>';
        $content .= '&nbsp;&nbsp;' . "\r\n";
        $content .= '<a href="./?p=php-native-generator&exec-php" target="_blank" class="btn btn btn-default btn-flat" ><i class="fa fa-file-code-o"></i> ' . __e('Generate Test files for PHP Native Code') . '</a>';
        $content .= '</div>' . "\r\n";
        break;
    case 'list':
        $content .= '<input name="submit-tables" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Add New Table') . '" />';
        break;
}
$content .= '</div><!-- ./box-footer -->' . "\r\n";
$content .= '</div><!-- ./box -->' . "\r\n";

$content .= '</div>' . "\r\n";
$content .= '<div class="col-md-4">' . "\r\n";
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-table"></i> ' . __e('List Tables') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Some tables that you have made:') . '</div>';
$content .= '<div class="table-responsive">';
$content .= '<table class="table table-striped" id="table-used">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>#</th>';
$content .= '<th>' . __e('Table Name') . '</th>';
$content .= '<th></th>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';
$modal_dialog = null;
$tables = $db->getTables();

if (count($tables) >= 1)
{
    $no = 1;
    foreach ($tables as $item)
    {
        $content .= '<tr>';
        $content .= '<td>' . $no . '</td>';
        $content .= '<td><a href="./?p=backend-configuration&amp;a=edit&amp;table-name=' . $item['table-prefix'] . '&amp;' . time() . '">' . $item['table-name'] . '</a></td>';
        $content .= '<td>';
        $content .= '<a href="./?p=backend-configuration&amp;a=edit&amp;table-name=' . $item['table-prefix'] . '&amp;' . time() . '" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a>&nbsp;';
        $content .= '<a href="#./?p=backend-configuration&amp;a=delete&amp;table-name=' . $item['table-prefix'] . '&amp;' . time() . '" data-toggle="modal" data-target="#trash-dialog-' . $no . '" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
        $content .= '</td>';
        $content .= '</tr>';

        $modal_dialog .= '<div class="modal fade modal-default" id="trash-dialog-' . $no . '" tabindex="-1" role="dialog" aria-labelledby="trash-dialog-' . $no . '" aria-hidden="true">';
        $modal_dialog .= '<div class="modal-dialog">';
        $modal_dialog .= '<div class="modal-content">';
        $modal_dialog .= '<div class="modal-header">';
        $modal_dialog .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $modal_dialog .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete a table') . '</h4>';
        $modal_dialog .= '</div><!-- ./modal-header -->';
        $modal_dialog .= '<div class="modal-body">';
        $modal_dialog .= '<p>' . __e('Are you sure you want to delete this table from your backend?') . '</p>';
        $modal_dialog .= '<div class="row">';
        $modal_dialog .= '<div class="col-md-3">';
        $modal_dialog .= '<div class="icon icon-confirm text-center"><i class="fa fa-5x fa-' . $item['table-icon-fontawesome'] . '"></i></div>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '<div class="col-md-9 text-left">';
        $modal_dialog .= '<table class="table-confirm">';

        $modal_dialog .= '<tr>';
        $modal_dialog .= '<td>' . __e('Name ') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $item['table-name'] . '</strong></td>';
        $modal_dialog .= '</tr>';

        $modal_dialog .= '<tr>';
        $modal_dialog .= '<td>' . __e('Singular Name') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $item['table-singular-name'] . '</strong></td>';
        $modal_dialog .= '</tr>';

        $modal_dialog .= '<tr>';
        $modal_dialog .= '<td>' . __e('Plural Name') . '</td>';
        $modal_dialog .= '<td>: <strong>' . $item['table-plural-name'] . '</strong></td>';
        $modal_dialog .= '</tr>';

        $modal_dialog .= '</table>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div>';

        $modal_dialog .= '</div><!-- ./modal-body -->';


        $modal_dialog .= '<div class="modal-footer">';
        $modal_dialog .= '<a href="./?p=backend-configuration&amp;a=delete&amp;table-name=' . $item['table-prefix'] . '#!_" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
        $modal_dialog .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';
        $modal_dialog .= '</div>';
        $modal_dialog .= '</div><!-- ./modal-content -->';
        $modal_dialog .= '</div><!-- ./modal-dialog -->';
        $modal_dialog .= '</div><!-- ./modal -->';
        $no++;
    }
} else
{
    $content .= '<tr>' . "\r\n";
    $content .= '<td>&nbsp;</td>' . "\r\n";
    $content .= '<td>' . __e('no tables') . '</td>' . "\r\n";
    $content .= '<td></td>' . "\r\n";
    $content .= '<td></td>' . "\r\n";
    $content .= '</tr>' . "\r\n";
}


$content .= '</tbody>' . "\r\n";
$content .= '</table>' . "\r\n";
$content .= '</div>' . "\r\n";


$content .= '</div>' . "\r\n";
$content .= '<div class="box-footer">' . "\r\n";
$content .= '<a class="btn btn btn-danger btn-flat pull-left" href="./?p=backend-configuration"><i class="fa fa-plus-circle"></i> ' . __e('Add New Tables') . '</a>';
$content .= '</div>' . "\r\n";

$content .= '</div><!-- ./box -->' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";

// TODO: GENERAL - FORM INPUT - COLUMNS

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Columns in Tables') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-info">' . __e('Columns are fields in the form or columns in MySQL') . '</div>';


$content .= '<div class="form-group">';
$content .= '<div class="table-responsive">';
$content .= '<table id="backend-column" class="table table-striped table-bordered">';

$content .= '<thead>';

$content .= '<tr>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:10px"><strong>' . __e('Sort') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:120px"><strong>' . __e('Column Type') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:120px"><strong>' . __e('Label') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:200px"><strong>' . __e('Variable/ Name') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:100px"><strong>' . __e('Placeholder/ Options/ Select Table/ Text Length') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:100px"><strong>' . __e('Default/ Value') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2" style="min-width:100px"><strong>' . __e('Info/ Help') . '</strong></th>';
$content .= '<th class="text-center vcenter" colspan="4"><strong>' . __e('Used for?') . '</strong></th>';
$content .= '<th class="text-center vcenter" rowspan="2"><strong>' . __e('Delete') . '</strong></th>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<th class="text-center vcenter"><small>' . __e('JSON ~ List') . '</small></th>';
$content .= '<th class="text-center vcenter"><small>' . __e('JSON ~ Detail') . '</small></th>';
$content .= '<th class="text-center vcenter"><small>' . __e('JSON ~ Input') . '</small></th>';
$content .= '<th class="text-center vcenter"><small>' . __e('BackEnd ~ List') . '</small></th>';
$content .= '</tr>';
$content .= '</thead>';

//$column_types[] = array('label' => 'ID','value' => 'id');
$column_types[] = array('label' => 'Small Text (&lt; 128 Chars | HTML Input Text)', 'value' => 'varchar');
$column_types[] = array('label' => 'TinyText (HTML Textarea)', 'value' => 'tinytext');
$column_types[] = array('label' => 'Text (HTML Textarea)', 'value' => 'text');
$column_types[] = array('label' => 'LongText (HTML Editor)', 'value' => 'longtext');

$column_types[] = array('label' => 'Number', 'value' => 'number');
$column_types[] = array('label' => 'Number - Fixed Length (eg: 023)', 'value' => 'number-fixed-length');


$column_types[] = array('label' => 'Date (Date Picker)', 'value' => 'date');
$column_types[] = array('label' => 'Time (Time Picker)', 'value' => 'time');
$column_types[] = array('label' => 'Date/Time (Date Time Picker)', 'value' => 'datetime');
$column_types[] = array('label' => 'Boolean (True/False)', 'value' => 'boolean');

$column_types[] = array('label' => 'Thumbnail (Square Images)', 'value' => 'thumbnail');
$column_types[] = array('label' => 'Image Featured', 'value' => 'image');
$column_types[] = array('label' => 'File Upload', 'value' => 'file');

$column_types[] = array('label' => 'HTML5 Select (write a list of options in placeholder field)', 'value' => 'select');
$column_types[] = array('label' => 'Select Data From Other Table (write the table name in placeholder field)', 'value' => 'select-table');

$column_types[] = array('label' => 'Link/URL (HTML Input URL)', 'value' => 'url');
$column_types[] = array('label' => 'Email Address (HTML Input Email)', 'value' => 'email');
$column_types[] = array('label' => 'Phone Number (HTML Input)', 'value' => 'phone');

$column_types[] = array('label' => 'Multiplex Images (eg: Image1, Image2, Image3) *Not Support: JSON Input', 'value' => 'multi-images');
$column_types[] = array('label' => 'Multiplex Text (eg: Tags, Genre) *Not Support: JSON Input', 'value' => 'multi-text');

$column_types[] = array('label' => 'BLOB Data (*Only for rest-api.php)', 'value' => 'blob');

$i = 0;
$content .= '<tbody class="item-list">';
for ($i = 0; $i < $max_column; $i++)
{

    if (!isset($rawdata['table-cols'][$i]['label']))
    {
        $rawdata['table-cols'][$i]['label'] = '';
    }
    if (!isset($rawdata['table-cols'][$i]['variable']))
    {
        $rawdata['table-cols'][$i]['variable'] = '';
    }
    if (!isset($rawdata['table-cols'][$i]['option']))
    {
        $rawdata['table-cols'][$i]['option'] = '';
    }
    if (!isset($rawdata['table-cols'][$i]['default']))
    {
        $rawdata['table-cols'][$i]['default'] = '';
    }
    if (!isset($rawdata['table-cols'][$i]['info']))
    {
        $rawdata['table-cols'][$i]['info'] = '';
    }

    if (!isset($rawdata['table-cols'][$i]['type']))
    {
        $rawdata['table-cols'][$i]['type'] = 'text-short';
    }

    if (!isset($rawdata['table-cols'][$i]['json_list']))
    {
        $rawdata['table-cols'][$i]['json_list'] = false;
    }

    if (!isset($rawdata['table-cols'][$i]['json_detail']))
    {
        $rawdata['table-cols'][$i]['json_detail'] = false;
    }

    if (!isset($rawdata['table-cols'][$i]['item_list']))
    {
        $rawdata['table-cols'][$i]['item_list'] = false;
    }


    if (!isset($rawdata['table-cols'][$i]['json_input']))
    {
        $rawdata['table-cols'][$i]['json_input'] = false;
    }


    $readonly = '';
    if ($i == 0)
    {
        $readonly = 'readonly';
        $rawdata['table-cols'][$i]['id'] = 'id';
    }

    if ($i == 0)
    {
        $content .= '<tr id="col-item-' . $i . '" class="">';
    } else
    {
        $content .= '<tr id="col-item-' . $i . '" class="item">';
    }
    if ($i != 0)
    {
        $content .= '<td class="handle v-top">';
        $content .= '<i class="glyphicon glyphicon-move"></i>';
        $content .= '</td>';
    } else
    {
        $content .= '<td class="handle v-top">';
        $content .= '</td>';
    }


    $content .= '<td class="v-top">';
    $content .= '<select data-target="#tables-cols-' . $i . '" class="form-control tables-cols-type" name="tables[cols][' . $i . '][type]" ' . $readonly . '>';
    if ($i != 0)
    {
        foreach ($column_types as $type)
        {
            $selected = '';
            if ($rawdata['table-cols'][$i]['type'] == $type['value'])
            {
                $selected = 'selected';
            }
            $content .= '<option value="' . $type['value'] . '" ' . $selected . '>' . $type['label'] . '</option>';
        }
    } else
    {
        $content .= '<option value="id" selected>ID</option>';
    }
    $content .= '</select>';
    $content .= '</td>';


    $content .= '<td class="v-top">';
    $content .= '<input type="text" name="tables[cols][' . $i . '][label]" class="form-control" value="' . htmlentities($rawdata['table-cols'][$i]['label']) . '"  />';
    $content .= '<small class="help-block"><strong>format</strong>: <span id="label-helpder-0">text</span></small>';
    $content .= '</td>';

    $content .= '<td class="v-top">';
    $content .= '<input type="text" name="tables[cols][' . $i . '][variable]" class="form-control" value="' . htmlentities($rawdata['table-cols'][$i]['variable']) . '" />';
    $content .= '<small class="help-block"><strong>format</strong>: a-z, A-Z,0-9, and _<br/>Don\'t use the number in the first variable</small>';
    $content .= '</td>';


    $content .= '<td class="v-top">';
    if ($rawdata['table-cols'][$i]['type'] != 'select-table')
    {
        $option_table_show = 'show';
        $option_table_hide = 'hide';
    } else
    {
        $option_table_show = 'hide';
        $option_table_hide = 'show';
    }
    $content .= '<input type="text" id="tables-cols-' . $i . '-option" name="tables[cols][' . $i . '][option]" class="form-control ' . $option_table_show . '" value="' . htmlentities($rawdata['table-cols'][$i]['option']) . '" />';
    $content .= '<select id="tables-cols-' . $i . '-table-source" name="tables[cols][' . $i . '][table-source]" class="form-control ' . $option_table_hide . '">';
    $content .= '<option value="">Select a table</option>';

    if (count($tables) >= 1)
    {
        foreach ($tables as $item)
        {
            $tselected = '';
            if ($item['table-name'] == $rawdata['table-cols'][$i]['option'])
            {
                $tselected = 'selected';
            }
            $content .= '<option value="' . $item['table-name'] . '" ' . $tselected . '>' . $item['table-plural-name'] . '</option>';
        }
    }
    $content .= '</select>';

    $content .= '<small class="help-block">For the HTML Select use | as a separator</small>';
    $content .= '</td>';


    $content .= '<td class="v-top">';
    $content .= '<input type="text" id="tables-cols-' . $i . '-default" name="tables[cols][' . $i . '][default]" class="form-control" value="' . htmlentities($rawdata['table-cols'][$i]['default']) . '" />';
    $content .= '<small class="help-block"><strong>format</strong>: <span id="label-helpder-0">text</span></small>';
    $content .= '</td>';

    $content .= '<td class="v-top">';
    $content .= '<input type="text" id="tables-cols-' . $i . '-info" name="tables[cols][' . $i . '][info]" class="form-control" value="' . htmlentities($rawdata['table-cols'][$i]['info']) . '" />';
    $content .= '<small class="help-block"><strong>format</strong>: <span id="label-helpder-0">text</span></small>';
    $content .= '</td>';

    $content .= '<td class="v-top">';
    if ($rawdata['table-cols'][$i]['json_list'] == true)
    {
        $content .= '<input type="checkbox" class="flat-green" checked name="tables[cols][' . $i . '][json-list]" />';
    } else
    {
        $content .= '<input type="checkbox" class="flat-green" name="tables[cols][' . $i . '][json-list]" />';
    }
    $content .= '</td>';

    $content .= '<td class="v-top">';
    if ($rawdata['table-cols'][$i]['json_detail'] == true)
    {
        $content .= '<input type="checkbox" class="flat-blue" checked name="tables[cols][' . $i . '][json-detail]" />';
    } else
    {
        $content .= '<input type="checkbox" class="flat-blue" name="tables[cols][' . $i . '][json-detail]" />';
    }
    $content .= '</td>';


    $content .= '<td class="v-top">';
    if ($i != 0)
    {
        if ($rawdata['table-cols'][$i]['json_input'] == true)
        {
            $content .= '<input type="checkbox" class="flat-red" checked name="tables[cols][' . $i . '][json-input]" />';
        } else
        {
            $content .= '<input type="checkbox" class="flat-red" name="tables[cols][' . $i . '][json-input]" />';
        }
    } else
    {
        $content .= '<input type="checkbox" class="flat-red" name="tables[cols][' . $i . '][json-input]" disabled/>';
    }
    $content .= '</td>';

    $content .= '<td class="v-top">';
    if ($rawdata['table-cols'][$i]['item_list'] == true)
    {
        $content .= '<input type="checkbox" class="flat-red" checked name="tables[cols][' . $i . '][item-list]" />';
    } else
    {
        $content .= '<input type="checkbox" class="flat-red" name="tables[cols][' . $i . '][item-list]" />';
    }
    $content .= '</td>';


    $content .= '<td class="v-top">';
    if ($i != 0)
    {
        $content .= '<a data-target="#col-item-' . $i . '" href="#!_" class="remove-item btn-flat btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
    } else
    {
        $content .= '<a href="#!_" class="disabled btn-flat btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
    }
    $content .= '</td>';

    $content .= '</tr>';
}
$content .= '</tbody>';

$content .= '</table>';

$content .= '</div>';


// TODO: GENERAL - FORM INPUT - SELECT
$opt_var = array();
foreach ($rawdata['table-cols'] as $table_colums)
{
    if ($table_colums['variable'] != '')
    {
        $opt_var[] = array('value' => $table_colums['variable'], 'label' => $table_colums['variable']);
    }
}


$content .= '<div class="row">';


$content .= '<div class="col-md-3">';


$content .= '<div class="form-group">';
$content .= '<label>' . __e('Variable as Value?') . '</label>';

$content .= '<select name="tables[variable-as-value]" class="form-control select2">';
foreach ($opt_var as $opt)
{
    $selected = '';
    if ($opt['value'] == $rawdata['table-variable-as-value'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $opt['value'] . '" ' . $selected . '>' . $opt['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('The variable used for <code>value</code>, value must be unique or you can use <code>variable ID</code>') . '</p>';
$content .= '</div><!-- ./form-group -->';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Variable as Label?') . '</label>';
$content .= '<select name="tables[variable-as-label]" class="form-control select2">';
foreach ($opt_var as $opt)
{
    $selected = '';
    if ($opt['value'] == $rawdata['table-variable-as-label'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $opt['value'] . '" ' . $selected . '>' . $opt['label'] . '</option>';
}
$content .= '</select>';

$content .= '<p class="help-block">' . __e('The variable used for <code>label</code>') . '</p>';
$content .= '</div><!-- ./form-group -->';


$content .= '</div>';


$content .= '<div class="col-md-3">';
if (!isset($rawdata['auth-enable']))
{
    $rawdata['auth-enable'] = false;
}
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Auth Type') . '</label>';
$content .= '<div class="checkbox">';
$content .= '<label>';
if ($rawdata['auth-enable'] == true)
{
    $content .= '<input type="checkbox" name="tables[auth-enable]" class="flat-red" checked>&nbsp; ' . __e('Required Authorization');
} else
{
    $content .= '<input type="checkbox" name="tables[auth-enable]" class="flat-red">&nbsp; ' . __e('Required Authorization');
}
$content .= '<p class="help-block">' . __e('These tables must use a <code>login authorization</code>, this is the same as <code>private post</code> mode on WordPress') . '</p>';

$content .= '</label>';

$content .= '</div>';
$content .= '</div><!-- ./form-group -->';


$content .= '</div><!-- ./col-md-3 -->';

// TODO: GENERAL - FORM INPUT - JSON METHOD
$form_methods = array();
$form_methods[] = array('value' => 'none', 'label' => 'None');
$form_methods[] = array('value' => 'post', 'label' => 'Method POST');
$form_methods[] = array('value' => 'get', 'label' => 'Method GET');

$content .= '<div class="col-md-3">';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('JSON Input via?') . '</label>';

$content .= '<select name="tables[form-method]" class="form-control">';
foreach ($form_methods as $opt)
{
    $selected = '';
    if ($opt['value'] == $rawdata['form-method'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $opt['value'] . '" ' . $selected . '>' . $opt['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('What does the JSON accept input from the apps?') . ' ' . __e('If it can\'t be saved, please tick <code>JSON Input</code> in the column above') . '</p>';
$content .= '</div><!-- ./form-group -->';
$content .= '</div><!-- ./col-md-3 -->';


$content .= '<div class="col-md-3">';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Filter Input') . '</label>';
$content .= '<div class="checkbox">';
$content .= '<label>';
if ($rawdata['form-filter-duplicate'] == true)
{
    $content .= '<input type="checkbox" name="tables[form-filter-duplicate]" class="flat-red" checked>&nbsp; ' . __e('Duplicate values');
} else
{
    $content .= '<input type="checkbox" name="tables[form-filter-duplicate]" class="flat-red">&nbsp; ' . __e('Duplicate values');
}

$content .= '<p class="help-block">' . __e('Prevent the same data from being <code>sent twice or more</code>') . '</p>';
$content .= '</label>';
$content .= '</div>';
$content .= '</div><!-- ./form-group -->';
$content .= '</div><!-- ./col-md-3 -->';


$content .= '</div><!-- ./row -->';


$content .= '</div><!-- ./ -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
switch ($_GET['a'])
{
    case 'delete':
        $content .= '<input name="submit-tables" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Add New Table') . '" />';
        break;
    case 'edit':
        $content .= '<input name="submit-tables" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';

        $content .= '<div class="pull-right">' . "\r\n";
        $content .= '<a href="./?p=wp-plugin-generator&exec-wp-plugin" target="_blank" class="btn btn btn-default btn-flat" ><i class="fa fa-wordpress"></i> ' . __e('Generate Test files for WP Plugin') . '</a>';
        $content .= '&nbsp;&nbsp;' . "\r\n";
        $content .= '<a href="./?p=php-native-generator&exec-php" target="_blank" class="btn btn btn-default btn-flat" ><i class="fa fa-file-code-o"></i> ' . __e('Generate Test files for PHP Native Code') . '</a>';
        $content .= '</div>' . "\r\n";

        break;
    case 'list':
        $content .= '<input name="submit-tables" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Add New Table') . '" />';
        break;
}
$content .= '</div><!-- ./box-footer -->' . "\r\n";
$content .= '</div><!-- ./box -->' . "\r\n";


$content .= '</form>' . "\r\n";

$content .= $modal_dialog;

$content .= $icon->display('ion');
$content .= $icon->display('fa');
$content .= $icon->display('dashicons');

$page_js .= '
$(".tables-cols-type").click(function(){
    
    var valType = $(this).val();
    var OptID = $(this).attr("data-target");
    
    $(OptID + "-table-source").removeClass("show");
    $(OptID + "-option").removeClass("hide");   
    $(OptID + "-table-source").addClass("hide");
    $(OptID + "-option").addClass("show");

     
    switch(valType){
        
        case "varchar":
            $(OptID + "-option").val("");
            $(OptID + "-info").val("");
            break;
            
        case "tinytext":
            $(OptID + "-option").val("");
            $(OptID + "-info").val("");
            break;

        case "text":
            $(OptID + "-option").val("");
            $(OptID + "-info").val("");
            break;

        case "longtext":
            $(OptID + "-option").val("");
            $(OptID + "-info").val("");
            break;
                                    
        case "number":
            $(OptID + "-option").val("1234");
            $(OptID + "-info").val("");
            $(OptID + "-default").val("1234");
            break;
        
        case "date":
            $(OptID + "-option").val("' . date("Y-m-d") . '");
            $(OptID + "-info").val("Filled with date");
            $(OptID + "-default").val("");
            break;
 
       case "time":
            $(OptID + "-option").val("' . date("H:i:s") . '");
            $(OptID + "-info").val("Filled with time");
            $(OptID + "-default").val("");
            break;

       case "datetime":
            $(OptID + "-option").val("' . date("Y-m-d H:i:s") . '");
            $(OptID + "-info").val("Filled with time");
            $(OptID + "-default").val("");
            break;
                                                 
        case "select-table":
            $(OptID + "-table-source").removeClass("hide");
            $(OptID + "-option").removeClass("show");   
            $(OptID + "-table-source").addClass("show");
            $(OptID + "-option").addClass("hide");
            $(OptID + "-info").val("please select a value");
            
            break;
            
        case "boolean":
            $(OptID + "-option").val("Yes|No");
            $(OptID + "-default").val("Yes");
            $(OptID + "-info").val("");
            break;
            
           
        case "select":
            $(OptID + "-option").val("Option 1|Option 2|Option 3|Option 4");
            $(OptID + "-default").val("Option 1");
            $(OptID + "-info").val("please select");
            break;
               
       case "url":
            $(OptID + "-option").val("http://yourdomain.com/");
            $(OptID + "-info").val("Please enter the correct url");
            $(OptID + "-default").val("");
            break;
            
       case "email":
            $(OptID + "-option").val("info@yourdomain.com");
            $(OptID + "-info").val("Please enter the valid email");
            $(OptID + "-default").val("");
            break;
            
       case "phone":
            $(OptID + "-option").val("+628123456789");
            $(OptID + "-info").val("Please enter the your phone number");
            $(OptID + "-default").val("");
            break;
            
       case "thumbnail":
            $(OptID + "-option").val("image.jpg");
            $(OptID + "-info").val("");
            $(OptID + "-default").val("");
            break; 
            
       case "number-fixed-length":
                $(OptID + "-option").val("4");
                $(OptID + "-info").val("Write a number with a length of 4 digits");
                $(OptID + "-default").val("001");
            break;
                                    
    }
       
});


$(".item-list").sortable({
    opacity: 0.5,
    items: ".item",
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: false,
    zIndex: 999999
});


';


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Back-End Configuration');
$template->page_desc = __e('Create tables and configuration for your backend');
$template->page_content = $content;

?>