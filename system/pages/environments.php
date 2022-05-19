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

if (!isset($_SESSION['CURRENT_APP']['environments']))
{
    $_SESSION['CURRENT_APP']['environments'] = array();
}

$db = new jsmDatabase();

if (isset($_POST['environment']))
{
    $data_post = $_POST['environment'];

    $db->saveEnvironment($data_post);
    $db->current();
    rebuild();
    if (isset($_GET['environment-name']))
    {
        header("Location: ./?p=environments&a=edit&environment-name=" . basename($_GET['environment-name']) . '&' . time());
    } else
    {
        header("Location: ./?p=environments&a=list" . '&' . time());
    }
}


switch ($_GET['a'])
{
    case 'list':
        // TODO: LIST

        // TODO: LIST --|-- BREADCUMB
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Environments') . '</li>';
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
        $content .= '<h1>Environments</h1>';
        $content .= '<p class="lead">' . __e('Angular allows you to create make environment, namely:<br/>development mode and production mode') . '</p>';
        ;
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Custom Environments') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('The following is the environment that was created:') . ':</p>';

        $_content = null;
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>';
        $content .= __e('Name');
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
        foreach ($_SESSION['CURRENT_APP']['environments'] as $environment)
        {
            if (!isset($environment['desc']))
            {
                $environment['desc'] = '-';
            }
            if (!isset($environment['status']))
            {
                $environment['status'] = '';
            }
            $content .= '<tr>';
            $content .= '<td>';
            $content .= $environment['name'];
            $content .= '</td>';

            $content .= '<td>';
            $content .= $environment['desc'];
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<label class="label label-default">' . $environment['status'] . '</label>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<a target="_blank" href="./system/plugin/viewsource/?environment=' . $environment['prefix'] . '&type=ts" class="btn btn-flat btn-xs btn-success"><i class="fa fa-file-code-o"></i> ' . __e('View Source') . '</a> ';
            $content .= '<a href="#!_" data-toggle="modal" data-target="#info-environment-dialog-' . $environment['prefix'] . '" class="btn btn-flat btn-xs btn-info"><i class="fa fa-info"></i> ' . __e('Info') . '</a> ';
            $content .= '<a href="./?p=environments&a=edit&environment-name=' . $environment['prefix'] . '" class="btn btn-flat btn-xs btn-warning"><i class="fa fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a> ';
            $content .= '<a href="#!" data-toggle="modal" data-target="#delete-environment-dialog-' . $environment['prefix'] . '" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a> ';
            $content .= '</td>';

            $content .= '</tr>';


            // TODO: LIST --|-- DIALOG
            $_content .= '<div class="modal fade modal-default" id="info-environment-dialog-' . $environment['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="info-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" >Info <strong>' . $environment['name'] . '</strong> <small>Environment</small></h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<div style="overflow-y:scroll;height:120px;padding: 12px;">';
            $_content .= '<p>' . $environment['desc'] . '</p>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal modal-md fade modal-default" id="delete-environment-dialog-' . $environment['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This environment') . '</h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<p>' . __e('Are you sure you want to delete this environment?') . '</p>';
            $_content .= '<div class="row">';
            $_content .= '<div class="col-md-3 text-right">';
            $_content .= '<div class="icon text-center icon-confirm"><i class="fa-5x fa fa-gg"></i></div>';
            $_content .= '</div>';
            $_content .= '<div class="col-md-9 text-left">';

            $_content .= '<table class="table-confirm">';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Environment Name') . '</td>';
            $_content .= '<td>: <strong>' . $environment['name'] . '</strong></td>';
            $_content .= '</tr>';
            $_content .= '</table>';

            $_content .= '</div>';
            $_content .= '</div>';

            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<a href="./?p=environments&a=delete&environment-name=' . $environment['prefix'] . '&ok" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
        $content .= '<a href="./?p=environments&a=new" class="btn btn-flat btn-danger">' . __e('Create New Environment') . '</a>&nbsp;';
        $content .= '</div>';

        $content .= '</div>';
        break;
    case 'edit':
        // TODO: EDIT
        if (isset($_GET['environment-name']))
        {

            $environmentname = basename($_GET['environment-name']);
            $environment_data = $db->getEnvironment($environmentname);
            if (!isset($environment_data['name']))
            {
                $environment_data['name'] = '';
            }
            if (!isset($environment_data['prefix']))
            {
                $environment_data['prefix'] = '';
            }

            if (!isset($environment_data['code']['development']))
            {
                $environment_data['code']['development'] = '';
            }
            if (!isset($environment_data['code']['production']))
            {
                $environment_data['code']['production'] = '';
            }


            // TODO: EDIT --|-- BREADCUMB
            $breadcrumb = null;
            $breadcrumb .= '<ol class="breadcrumb">';
            $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
            $breadcrumb .= '<li><a href="./?p=environments">' . __e('Environments') . '</a></li>';
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
            $content .= '<input type="text" name="environment[name]" class="form-control" value="' . $environment_data['name'] . '" placeholder="Trim HTML" readonly/>';
            $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
            $content .= '</div> ';
            $content .= '</div>';

            $content .= '<div class="col-md-6">';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Prefix') . '</label>';
            $content .= '<input type="text" name="environment[prefix]" class="form-control" value="' . $environment_data['prefix'] . '" placeholder="trim-html" readonly/>';
            $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';


            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Description') . '</label>';
            $content .= '<input type="text" name="environment[desc]" class="form-control" value="' . $environment_data['desc'] . '" placeholder="" />';
            $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
            $content .= '</div>';


            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '</div><!-- ./box-footer -->';

            $content .= '</div><!-- ./box -->';
            $content .= '</div><!-- ./col-md-6 -->';

            // TODO: EDIT --|-- FORM --|-- INFO
            $content .= '<div class="col-md-6">';

            $content .= '<div class="box box-warning">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Note') . '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';

            $content .= '<div class="example-code">Example:<pre>export const environment = {' . "\r\n\t" . 'production: false,' . "\r\n\t" . '// your code here' . "\r\n" . '}</pre></div>';

            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '</div><!-- ./box-footer -->';

            $content .= '</div><!-- ./box -->';

            $content .= '</div><!-- ./col-md-6 -->';
            $content .= '</div><!-- ./row -->';

            // TODO: EDIT --|-- FORM --|-- DEVELOPMENT
            $content .= '<div class="box box-success">';

            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Development') . ' ';
            $content .= '<small>' . __e('Mode') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="box-body pad">';

            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/environments/environment.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>blaBla1: false,' . "\r\n" . 'blabla2: { opt1: "loremispum", opt2: "loremispum" }</pre></div>';

            $content .= '<textarea id="environment-development" data-type="ts"  name="environment[code][development]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($environment_data['code']['development']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';

            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?environment=development&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';

            // TODO: EDIT --|-- FORM --|-- PRODUCTION
            $content .= '<div class="box box-danger">';

            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Production') . ' ';
            $content .= '<small>' . __e('Mode') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';

            $content .= '</div>';

            $content .= '<div class="box-body pad">';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/environments/environment.prod.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>blaBla1: false,' . "\r\n" . 'blabla2: { opt1: "loremispum", opt2: "loremispum" }</pre></div>';

            $content .= '<textarea id="environment-production" data-type="ts"  name="environment[code][production]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($environment_data['code']['production']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

            $content .= '</div>';

            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?environment=production&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';


            $content .= '</form>';
        } else
        {
            header('Location: ./?p=environments&&a=new');
        }
        break;
    case 'new':
        // TODO: NEW
        // TODO: NEW --|-- BREADCUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=environments">' . __e('Environments') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Add') . '</li>';
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
        $content .= '<input type="text" name="environment[name]" class="form-control" placeholder="" />';
        $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
        $content .= '</div> ';
        $content .= '</div>';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix') . '</label>';
        $content .= '<input type="text" name="environment[prefix]" class="form-control" placeholder="" />';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="environment[desc]" class="form-control" placeholder="" />';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
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
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Note') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';

        $content .= '<div class="example-code">Example:<pre>export const environment = {' . "\r\n\t" . 'production: false,' . "\r\n\t" . '// your code here' . "\r\n" . '}</pre></div>';

        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div><!-- ./box-footer -->';

        $content .= '</div><!-- ./box -->';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: NEW --|-- FORM --|-- DEVELOPMENT
        $content .= '<div class="box box-success">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Development') . ' ';
        $content .= '<small>' . __e('Mode') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="box-body pad">';

        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/environments/environment.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>blaBla1: false,' . "\r\n" . 'blabla2: { opt1: "loremispum", opt2: "loremispum" }</pre></div>';

        $content .= '<textarea id="environment-development" data-type="ts"  name="environment[code][development]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?environment=development&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: NEW --|-- FORM --|-- PRODUCTION
        $content .= '<div class="box box-danger">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Production') . ' ';
        $content .= '<small>' . __e('Mode') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/environments/environment.prod.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>blaBla1: false,' . "\r\n" . 'blabla2: { opt1: "loremispum", opt2: "loremispum" }</pre></div>';

        $content .= '<textarea id="environment-production" data-type="ts"  name="environment[code][production]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</form>';
        // TODO: DELETE
        break;
    case 'delete':
        if (isset($_GET['ok']))
        {
            $environment_name = basename($_GET['environment-name']);
            $db->deleteEnvironment($environment_name);
            $db->current();
            rebuild();
            header("Location: ./?p=environments&" . time());
        }
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=environments">' . __e('environments') . '</a></li>';
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
$template->page_title = __e('(IMAB) Environments');
$template->page_desc = __e('Production or Development mode');
$template->page_content = $content;
$template->page_js = $page_js;

?>