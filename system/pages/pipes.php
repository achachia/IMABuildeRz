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
$content = $breadcrumb = null;
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

if (!isset($_SESSION['CURRENT_APP']['pipes']))
{
    $_SESSION['CURRENT_APP']['pipes'] = array();
}
$db = new jsmDatabase();

if (isset($_POST['pipe']))
{
    $data_post = $_POST['pipe'];
    $db->savePipe($data_post);
    $db->current();
    rebuild();
    if (isset($_GET['pipe-name']))
    {
        header("Location: ./?p=pipes&a=edit&pipe-name=" . basename($_GET['pipe-name']) . '&' . time());
    } else
    {
        header("Location: ./?p=pipes&a=list" . '&' . time());
    }

}


switch ($_GET['a'])
{
    case 'list':
        // TODO: LIST

        // TODO: LIST --|-- BREADCUMB
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Pipes') . '</li>';
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
        $content .= '<h1>Pipes</h1>';
        $content .= '<p class="lead">Angular comes with a stock of pipes such as ';
        $content .= '<code><a href="https://angular.io/api/common/DatePipe" target="_blank">DatePipe</a></code>, ';
        $content .= '<code><a href="https://angular.io/api/common/UpperCasePipe" target="_blank">UpperCasePipe</a></code>, ';
        $content .= '<code><a href="https://angular.io/api/common/LowerCasePipe" target="_blank">LowerCasePipe</a></code>, ';
        $content .= '<code><a href="https://angular.io/api/common/CurrencyPipe" target="_blank">CurrencyPipe</a></code>, and ';
        $content .= '<code><a href="https://angular.io/api/common/PercentPipe" target="_blank">PercentPipe</a></code>.';
        $content .= 'They are all available for use in any template</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Custom Pipes') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('Angular allows you to create your own custom pipes, here are the pipes that have been created') . ':</p>';

        $_content = null;
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>';
        $content .= __e('Name');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Pipe');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Description');
        $content .= '</th>';

        $content .= '<th>';
        $content .= __e('Status');
        $content .= '</th>';

        $content .= '<th>';
        $content .= '</th>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        foreach ($_SESSION['CURRENT_APP']['pipes'] as $pipe)
        {
            if (!isset($pipe['desc']))
            {
                $pipe['desc'] = '-';
            }
            if (!isset($pipe['status']))
            {
                $pipe['status'] = '';
            }
            $content .= '<tr>';
            $content .= '<td>';
            $content .= $pipe['name'];
            $content .= '</td>';
            $content .= '<td>';
            $content .= '<label class="label label-info">' . $pipe['pipe'] . '</label>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= $pipe['desc'];
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<label class="label label-default">' . $pipe['status'] . '</label>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<a target="_blank" href="./system/plugin/viewsource/?pipe=' . $pipe['prefix'] . '&type=ts" class="btn btn-flat btn-xs btn-success"><i class="fa fa-file-code-o"></i> ' . __e('View Source') . '</a> ';
            $content .= '<a href="#!_" data-toggle="modal" data-target="#info-pipe-dialog-' . $pipe['prefix'] . '" class="btn btn-flat btn-xs btn-info"><i class="fa fa-info"></i> ' . __e('Info') . '</a> ';
            $content .= '<a href="./?p=pipes&a=edit&pipe-name=' . $pipe['prefix'] . '" class="btn btn-flat btn-xs btn-warning"><i class="fa fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a> ';
            $content .= '<a href="#!" data-toggle="modal" data-target="#delete-pipe-dialog-' . $pipe['prefix'] . '" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a> ';
            $content .= '</td>';

            $content .= '</tr>';


            // TODO: LIST --|-- DIALOG
            $_content .= '<div class="modal fade modal-default" id="info-pipe-dialog-' . $pipe['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="info-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" >Info <strong>' . $pipe['name'] . '</strong> <small>Pipe</small></h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<div style="overflow-y:scroll;height:120px;padding: 12px;">';
            $_content .= '<p>' . $pipe['desc'] . '</p>';
            $_content .= '<div>' . $pipe['instruction'] . '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';


            $_content .= '<div class="modal modal-md fade modal-default" id="delete-pipe-dialog-' . $pipe['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This Pipe') . '</h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<p>' . __e('Are you sure you want to delete this pipe?') . '</p>';
            $_content .= '<div class="row">';
            $_content .= '<div class="col-md-3 text-right">';
            $_content .= '<div class="icon text-center icon-confirm"><i class="fa-5x fa fa-gg"></i></div>';
            $_content .= '</div>';
            $_content .= '<div class="col-md-9 text-left">';

            $_content .= '<table class="table-confirm">';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Pipe Name') . '</td>';
            $_content .= '<td>: <strong>' . $pipe['name'] . '</strong></td>';
            $_content .= '</tr>';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Example Code') . '</td>';
            $_content .= '<td>: <code>{{ var | ' . $pipe['pipe'] . ' }} </code></td>';
            $_content .= '</tr>';
            $_content .= '</table>';

            $_content .= '</div>';
            $_content .= '</div>';

            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<a href="./?p=pipes&a=delete&pipe-name=' . $pipe['prefix'] . '&ok" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
        $content .= '<a href="./?p=pipes&a=new" class="btn btn-flat btn-danger">' . __e('Create New Pipes') . '</a>&nbsp;';
        $content .= '</div>';

        $content .= '</div>';
        break;
    case 'edit':
        // TODO: EDIT
        if (isset($_GET['pipe-name']))
        {

            $pipename = basename($_GET['pipe-name']);
            $pipe_data = $db->getPipe($pipename);
            if (!isset($pipe_data['name']))
            {
                $pipe_data['name'] = '';
            }
            if (!isset($pipe_data['prefix']))
            {
                $pipe_data['prefix'] = '';
            }

            if (!isset($pipe_data['arg'][0]['var']))
            {
                $pipe_data['arg'][0]['var'] = 'arg1';
            }
            if (!isset($pipe_data['arg'][0]['type']))
            {
                $pipe_data['arg'][0]['type'] = 'string';
            }

            if (!isset($pipe_data['arg'][1]['var']))
            {
                $pipe_data['arg'][1]['var'] = '';
            }
            if (!isset($pipe_data['arg'][1]['type']))
            {
                $pipe_data['arg'][1]['type'] = 'string';
            }

            if (!isset($pipe_data['arg'][2]['var']))
            {
                $pipe_data['arg'][2]['var'] = '';
            }
            if (!isset($pipe_data['arg'][2]['type']))
            {
                $pipe_data['arg'][2]['type'] = 'string';
            }

            if (!isset($pipe_data['arg'][3]['var']))
            {
                $pipe_data['arg'][3]['var'] = '';
            }
            if (!isset($pipe_data['arg'][3]['type']))
            {
                $pipe_data['arg'][3]['type'] = 'string';
            }


            if (!isset($pipe_data['arg'][4]['var']))
            {
                $pipe_data['arg'][4]['var'] = '';
            }
            if (!isset($pipe_data['arg'][4]['type']))
            {
                $pipe_data['arg'][4]['type'] = 'string';
            }

            if (!isset($pipe_data['desc']))
            {
                $pipe_data['desc'] = '';
            }
            if (!isset($pipe_data['instruction']))
            {
                $pipe_data['instruction'] = '';
            }
            if (!isset($pipe_data['code']['transform']))
            {
                $pipe_data['code']['transform'] = '';
            }
            if (!isset($pipe_data['code']['other-function']))
            {
                $pipe_data['code']['other-function'] = '';
            }
            if (!isset($pipe_data['return']['type']))
            {
                $pipe_data['return']['type'] = 'string';
            }

            if (!isset($pipe_data['modules']['angular']))
            {
                $pipe_data['modules']['angular'] = array();
            }

            $ionic_angular_html = null;
            $ionic_angular_html .= '<!-- modules -->' . "\r\n";
            $ionic_angular_html .= '<div class="table-responsive">' . "\r\n";
            $ionic_angular_html .= '<table class="table table-bordered table-striped">' . "\r\n";

            $ionic_angular_html .= '<thead>' . "\r\n";
            $ionic_angular_html .= '<tr>' . "\r\n";
            $ionic_angular_html .= '<th style="min-width:30px">#</th>' . "\r\n";
            $ionic_angular_html .= '<th>Class</th>' . "\r\n";
            $ionic_angular_html .= '<th>Variable</th>' . "\r\n";
            $ionic_angular_html .= '<th>Cordova</th>' . "\r\n";
            $ionic_angular_html .= '<th>Path</th>' . "\r\n";
            $ionic_angular_html .= '<th></th>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $ionic_angular_html .= '</thead>' . "\r\n";

            $ionic_angular_html .= '<tbody class="item-list">' . "\r\n";

            $ionic_angular_html .= '<tr>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td>Pipe</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";

            $ionic_angular_html .= '<tr>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td>PipeTransform</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";

            $t = 0;
            foreach ($pipe_data['modules']['angular'] as $_module_angular)
            {
                $label_cordova = null;
                if ($_module_angular['cordova'] !== '')
                {
                    $label_cordova .= '<span class="label label-danger">' . htmlentities($_module_angular['cordova']) . '</span>';
                }

                $ionic_angular_html .= '<tr class="item" id="modules-angular-' . $t . '">' . "\r\n";
                $ionic_angular_html .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pipe[modules][angular][' . $t . '][class]" value="' . htmlentities($_module_angular['class']) . '" />' . htmlentities($_module_angular['class']) . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pipe[modules][angular][' . $t . '][var]" value="' . htmlentities($_module_angular['var']) . '"/>' . htmlentities($_module_angular['var']) . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pipe[modules][angular][' . $t . '][cordova]" value="' . htmlentities($_module_angular['cordova']) . '"/>' . $label_cordova . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pipe[modules][angular][' . $t . '][path]" value="' . htmlentities($_module_angular['path']) . '"/><code>' . htmlentities($_module_angular['path']) . '</code></td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><a href="#!" data-target="#modules-angular-' . $t . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>' . "\r\n";
                $ionic_angular_html .= '</tr>' . "\r\n";
                $t++;
            }
            $t++;
            $ionic_angular_html .= '<tr id="">' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][class]" value="" /></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][var]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][cordova]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][path]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";

            $ionic_angular_html .= '</tbody>' . "\r\n";
            $ionic_angular_html .= '</table>' . "\r\n";
            $ionic_angular_html .= '</div>' . "\r\n";
            $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";

            // TODO: EDIT --|-- BREADCUMB
            $breadcrumb = null;
            $breadcrumb .= '<ol class="breadcrumb">';
            $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
            $breadcrumb .= '<li><a href="./?p=pipes">' . __e('Pipes') . '</a></li>';
            $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
            $breadcrumb .= '</ol>';

            // TODO: EDIT --|-- FORM
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
            $content .= '<input type="text" name="pipe[name]" class="form-control" value="' . $pipe_data['name'] . '" placeholder="Trim HTML" readonly/>';
            $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
            $content .= '</div> ';
            $content .= '</div>';

            $content .= '<div class="col-md-6">';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Prefix') . '</label>';
            $content .= '<input type="text" name="pipe[prefix]" class="form-control" value="' . $pipe_data['prefix'] . '" placeholder="trim-html" readonly/>';
            $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Description') . '</label>';
            $content .= '<input type="text" name="pipe[desc]" class="form-control" value="' . $pipe_data['desc'] . '" placeholder="" />';
            $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
            $content .= '</div>';

            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Instruction') . '</label>';
            $content .= '<textarea class="form-control" name="pipe[instruction]">' . $pipe_data['instruction'] . '</textarea>';
            $content .= '<p class="help-block">' . __e('Simple instructions on how to use it') . '</p>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="col-md-6">';
            $content .= '<div class="box box-warning">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Arguments and Return') . '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/' . $pipe_data['prefix'] . '/' . $pipe_data['prefix'] . '.pipe.ts</code></p>';

            $content .= '<table class="table">';
            $content .= '<thead>';
            $content .= '<tr>';
            $content .= '<th>' . __e('Data') . '</th>';
            $content .= '<th>' . __e('Variable') . '</th>';
            $content .= '<th>' . __e('Type') . '</th>';
            $content .= '</tr>';
            $content .= '</thead>';
            $content .= '<tbody>';

            $option_type_return = '<select name="pipe[return][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $pipe_data['return']['type'])
                {
                    $selected = 'selected';
                }
                $option_type_return .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_return .= '</select>';

            $content .= '<tr>';
            $content .= '<td>' . __e('Output') . ' <small>(return)</small></td>';
            $content .= '<td>-</td>';
            $content .= '<td>' . $option_type_return . '</td>';
            $content .= '<td></td>';
            $content .= '</tr>';

            // TODO: EDIT --|-- FORM --|-- ARG --|-- ARG1
            $option_type_arg1 = '<select name="pipe[arg][0][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $pipe_data['arg'][0]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_arg1 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_arg1 .= '</select>';

            $content .= '<tr>';
            $content .= '<td>' . __e('arg1') . ' <small>(default)</small></td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" type="text" name="pipe[arg][0][var]" class="form-control" value="' . $pipe_data['arg'][0]['var'] . '" placeholder="arg1" /></td>';
            $content .= '<td>' . $option_type_arg1 . '</td>';
            $content .= '<td></td>';
            $content .= '</tr>';

            // TODO: EDIT --|-- FORM --|-- ARG --|-- ARG2
            $option_type_arg2 = '<select name="pipe[arg][1][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $pipe_data['arg'][1]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_arg2 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_arg2 .= '</select>';

            $content .= '<tr>';
            $content .= '<td>' . __e('arg2') . ' <small>(option)</small></td>';
            $content .= '<td><input data-mask  data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="pipe-arg-1-var" type="text" name="pipe[arg][1][var]" class="form-control" value="' . $pipe_data['arg'][1]['var'] . '" placeholder="arg2" /></td>';
            $content .= '<td>' . $option_type_arg2 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#pipe-arg-1-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';

            // TODO: EDIT --|-- FORM --|-- ARG --|-- ARG3
            $option_type_arg3 = '<select name="pipe[arg][2][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $pipe_data['arg'][2]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_arg3 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_arg3 .= '</select>';

            $content .= '<tr id="arg3">';
            $content .= '<td>' . __e('arg3') . ' <small>(option)</small></td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="pipe-arg-2-var" type="text" name="pipe[arg][2][var]" class="form-control" value="' . $pipe_data['arg'][2]['var'] . '" placeholder="arg3" /></td>';
            $content .= '<td>' . $option_type_arg3 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#pipe-arg-2-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';

            // TODO: EDIT --|-- FORM --|-- ARG --|-- ARG4
            $option_type_arg3 = '<select name="pipe[arg][3][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $pipe_data['arg'][3]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_arg3 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_arg3 .= '</select>';

            $content .= '<tr id="arg4">';
            $content .= '<td>' . __e('arg4') . ' <small>(option)</small></td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="pipe-arg-3-var" type="text" name="pipe[arg][3][var]" class="form-control" value="' . $pipe_data['arg'][3]['var'] . '" placeholder="arg4" />';
            $content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>-</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_arg3 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#pipe-arg-3-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';

            $content .= '</tbody>';
            $content .= '</table>';


            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?pipe=' . $pipe_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';

            $content .= '</div>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '</div>';

            // TODO: EDIT --|-- FORM --|-- TRANSFORM
            $content .= '<div class="box box-success">';

            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Transform Function') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="box-body pad">';
            $content .= '<p>' . __e('Write the code for transform function') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/' . $pipe_data['prefix'] . '/' . $pipe_data['prefix'] . '.pipe.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>let blaBla = `...` ;' . "\r\n" . 'return blaBla;</pre></div>';
            $content .= '<textarea id="pipe-transform" data-type="ts"  name="pipe[code][transform]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($pipe_data['code']['transform']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';


            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?pipe=' . $pipe_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';

            // TODO: EDIT --|-- FORM --|-- OTHERS
            $content .= '<div class="box box-danger">';

            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Functions') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';

            $content .= '</div>';

            $content .= '<div class="box-body pad">';
            $content .= '<p> ' . __e('Write your custom functions') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/' . $pipe_data['prefix'] . '/' . $pipe_data['prefix'] . '.pipe.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';

            $content .= '<textarea id="pipe-other" data-type="ts"  name="pipe[code][other-function]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($pipe_data['code']['other-function']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

            $content .= '</div>';

            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?pipe=' . $pipe_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';


            $content .= '<div class="box box-info">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Modules') . '';
            $content .= '<small>' . __e('Angular/Ionic-Native/Cordova') . '</small>';
            $content .= '</h3>';
            $content .= '<!-- tools box -->';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '<!-- /. tools -->';
            $content .= '</div>';
            $content .= '<!-- /.box-header -->';
            $content .= '<div class="box-body">';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/' . $pipe_data['prefix'] . '/' . $pipe_data['prefix'] . '.pipe.ts</code></p>';

            $content .= '' . $ionic_angular_html . '';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?pipe=' . $pipe_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '';
            $content .= '</div> ';

            $content .= '</form>';
        } else
        {
            header('Location: ./?p=pipes&&a=new');
        }
        break;
    case 'new':
        // TODO: NEW


        if (!isset($pipe_data['modules']['angular']))
        {
            $pipe_data['modules']['angular'] = array();
        }

        $ionic_angular_html = null;
        $ionic_angular_html .= '<!-- modules -->' . "\r\n";
        $ionic_angular_html .= '<div class="table-responsive">' . "\r\n";
        $ionic_angular_html .= '<table class="table table-bordered table-striped" >' . "\r\n";

        $ionic_angular_html .= '<thead>' . "\r\n";
        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<th style="min-width:30px">#</th>' . "\r\n";
        $ionic_angular_html .= '<th>Class</th>' . "\r\n";
        $ionic_angular_html .= '<th>Variable</th>' . "\r\n";
        $ionic_angular_html .= '<th>Cordova</th>' . "\r\n";
        $ionic_angular_html .= '<th>Path</th>' . "\r\n";
        $ionic_angular_html .= '<th></th>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $ionic_angular_html .= '</thead>' . "\r\n";

        $ionic_angular_html .= '<tbody class="item-list">' . "\r\n";

        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td>Pipe</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td>PipeTransform</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $t = 0;
        $ionic_angular_html .= '<tr id="">' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][class]" value="" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][var]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][cordova]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pipe[modules][angular][' . $t . '][path]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '</tbody>' . "\r\n";
        $ionic_angular_html .= '</table>' . "\r\n";
        $ionic_angular_html .= '</div>' . "\r\n";
        $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";

        // TODO: NEW --|-- BREADCUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pipes">' . __e('Pipes') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('New') . '</li>';
        $breadcrumb .= '</ol>';


        if (!isset($pipe_data['name']))
        {
            $pipe_data['name'] = '';
        }
        if (!isset($pipe_data['prefix']))
        {
            $pipe_data['prefix'] = '';
        }

        if (!isset($pipe_data['arg'][0]['var']))
        {
            $pipe_data['arg'][0]['var'] = 'arg1';
        }
        if (!isset($pipe_data['arg'][0]['type']))
        {
            $pipe_data['arg'][0]['type'] = 'string';
        }

        if (!isset($pipe_data['arg'][1]['var']))
        {
            $pipe_data['arg'][1]['var'] = '';
        }
        if (!isset($pipe_data['arg'][1]['type']))
        {
            $pipe_data['arg'][1]['type'] = 'string';
        }

        if (!isset($pipe_data['arg'][2]['var']))
        {
            $pipe_data['arg'][2]['var'] = '';
        }
        if (!isset($pipe_data['arg'][2]['type']))
        {
            $pipe_data['arg'][2]['type'] = 'string';
        }

        if (!isset($pipe_data['arg'][3]['var']))
        {
            $pipe_data['arg'][3]['var'] = '';
        }
        if (!isset($pipe_data['arg'][3]['type']))
        {
            $pipe_data['arg'][3]['type'] = 'string';
        }


        if (!isset($pipe_data['arg'][4]['var']))
        {
            $pipe_data['arg'][4]['var'] = '';
        }
        if (!isset($pipe_data['arg'][4]['type']))
        {
            $pipe_data['arg'][4]['type'] = 'string';
        }

        if (!isset($pipe_data['desc']))
        {
            $pipe_data['desc'] = '';
        }
        if (!isset($pipe_data['instruction']))
        {
            $pipe_data['instruction'] = '';
        }
        if (!isset($pipe_data['code']['transform']))
        {
            $pipe_data['code']['transform'] = '';
        }
        if (!isset($pipe_data['code']['other-function']))
        {
            $pipe_data['code']['other-function'] = '';
        }
        if (!isset($pipe_data['return']['type']))
        {
            $pipe_data['return']['type'] = 'string';
        }


        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pipes">' . __e('Pipes') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
        $breadcrumb .= '</ol>';

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
        $content .= '<input type="text" name="pipe[name]" class="form-control" value="' . $pipe_data['name'] . '" placeholder="Trim HTML" required/>';
        $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
        $content .= '</div> ';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix') . '</label>';
        $content .= '<input data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" data-mask type="text" name="pipe[prefix]" class="form-control" value="' . $pipe_data['prefix'] . '" placeholder="" readonly/>';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using <code>a-z</code>, <code>0-9</code> and <code>-</code> characters only or blank = auto') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="pipe[desc]" class="form-control" value="' . $pipe_data['desc'] . '" placeholder="" required/>';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
        $content .= '</div>';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Instruction') . '</label>';
        $content .= '<textarea class="form-control" name="pipe[instruction]" required>' . $pipe_data['instruction'] . '</textarea>';
        $content .= '<p class="help-block">' . __e('Simple instructions on how to use it') . '</p>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: NEW --|-- FORM --|-- ARG --|--
        $content .= '<div class="col-md-6">';
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Arguments and Return') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/new-pipe/new-pipe.pipe.ts</code></p>';
        $content .= '<table class="table">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>' . __e('Data') . '</th>';
        $content .= '<th>' . __e('Variable') . '</th>';
        $content .= '<th>' . __e('Type') . '</th>';
        $content .= '</tr>';


        $option_type_return = '<select name="pipe[return][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $pipe_data['return']['type'])
            {
                $selected = 'selected';
            }
            $option_type_return .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_return .= '</select>';

        $content .= '<tr>';
        $content .= '<td>' . __e('Output') . ' <small>(return)</small></td>';
        $content .= '<td>-</td>';
        $content .= '<td>' . $option_type_return . '</td>';
        $content .= '<td></td>';
        $content .= '</tr>';

        // TODO: NEW --|-- FORM --|-- ARG --|-- ARG1
        $option_type_arg1 = '<select name="pipe[arg][0][type]" class="form-control" >';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $pipe_data['arg'][0]['type'])
            {
                $selected = 'selected';
            }
            $option_type_arg1 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_arg1 .= '</select>';

        $content .= '<tr>';
        $content .= '<td>' . __e('arg1') . ' <small>(default)</small></td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" data-mask type="text" name="pipe[arg][0][var]" class="form-control" value="' . $pipe_data['arg'][0]['var'] . '" placeholder="arg1" required/></td>';
        $content .= '<td>' . $option_type_arg1 . '</td>';
        $content .= '<td></td>';
        $content .= '</tr>';

        // TODO: NEW --|-- FORM --|-- ARG --|-- ARG2
        $option_type_arg2 = '<select name="pipe[arg][1][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $pipe_data['arg'][1]['type'])
            {
                $selected = 'selected';
            }
            $option_type_arg2 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_arg2 .= '</select>';

        $content .= '<tr>';
        $content .= '<td>' . __e('arg2') . ' <small>(option)</small></td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="pipe-arg-1-var" type="text" name="pipe[arg][1][var]" class="form-control" value="' . $pipe_data['arg'][1]['var'] . '" placeholder="arg2" /></td>';
        $content .= '<td>' . $option_type_arg2 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-danger btn-flat clear-item" data-target="#pipe-arg-1-var"><i class="fa fa-trash-o"></i></a></td>';
        $content .= '</tr>';

        // TODO: NEW --|-- FORM --|-- ARG --|-- ARG3
        $option_type_arg3 = '<select name="pipe[arg][2][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $pipe_data['arg'][2]['type'])
            {
                $selected = 'selected';
            }
            $option_type_arg3 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_arg3 .= '</select>';

        $content .= '<tr id="arg3">';
        $content .= '<td>' . __e('arg3') . ' <small>(option)</small></td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="pipe-arg-2-var" type="text" name="pipe[arg][2][var]" class="form-control" value="' . $pipe_data['arg'][2]['var'] . '" placeholder="arg3" /></td>';
        $content .= '<td>' . $option_type_arg3 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-danger btn-flat clear-item" data-target="#pipe-arg-2-var"><i class="fa fa-trash-o"></i></a></td>';
        $content .= '</tr>';

        // TODO: NEW --|-- FORM --|-- ARG --|-- ARG4
        $option_type_arg3 = '<select name="pipe[arg][3][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $pipe_data['arg'][3]['type'])
            {
                $selected = 'selected';
            }
            $option_type_arg3 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_arg3 .= '</select>';

        $content .= '<tr id="arg4">';
        $content .= '<td>' . __e('arg4') . ' <small>(option)</small></td>';
        $content .= '<td>';
        $content .= '<input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="pipe-arg-3-var" type="text" name="pipe[arg][3][var]" class="form-control" value="' . $pipe_data['arg'][3]['var'] . '" placeholder="arg4" />';
        $content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>-</code> characters only') . '</p>';
        $content .= '</td>';
        $content .= '<td>' . $option_type_arg3 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-danger btn-flat clear-item" data-target="#pipe-arg-3-var"><i class="fa fa-trash-o"></i></a></td>';
        $content .= '</tr>';

        $content .= '</tbody>';
        $content .= '</table>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '</div>';

        // TODO: NEW --|-- FORM --|-- TRANSFORM


        $content .= '<div class="box box-success">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Transform Function') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';


        $content .= '<p>' . __e('Write the code for transform function') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/new-pipe/new-pipe.pipe.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>let blaBla = `...` ;' . "\r\n" . 'return blaBla;</pre></div>';

        $content .= '<textarea id="pipe-transform" data-type="ts"  name="pipe[code][transform]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($pipe_data['code']['transform']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';

        $content .= '</div>';
        $content .= '</div>';


        // TODO: NEW --|-- FORM --|-- OTHERS
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Functions') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/new-pipe/new-pipe.pipe.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';

        $content .= '<textarea id="pipe-other" data-type="ts"  name="pipe[code][other-function]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($pipe_data['code']['other-function']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Modules') . '';
        $content .= '<small>' . __e('Angular/Ionic-Native/Cordova') . '</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';
        $content .= '<div class="box-body">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pipes/new-pipe/new-pipe.pipe.ts</code></p>';
        $content .= '' . $ionic_angular_html . '';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?pipe=' . $pipe_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '';
        $content .= '</div> ';
        $content .= '</form>';
        // TODO: DELETE
        break;
    case 'delete':
        if (isset($_GET['ok']))
        {
            $pipe_name = basename($_GET['pipe-name']);
            $db->deletePipe($pipe_name);
            $db->current();
            rebuild();
            header("Location: ./?p=pipes&" . time());
        }
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pipes">' . __e('Pipes') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Delete') . '</li>';
        $breadcrumb .= '</ol>';
        break;
}

// TODO: JS
$page_js = '
$(document).ready(function() {   
    $(".item-list").sortable({
        opacity: 0.5,
        items: ".item",
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: false,
        zIndex: 999999
    });    
    
}); ';

// TODO: TEMPLATE
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Pipes');
$template->page_desc = __e('Pipes take some data, modify it in some way, and return it');
$template->page_content = $content;
$template->page_js = $page_js;

?>