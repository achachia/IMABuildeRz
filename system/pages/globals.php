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

if (!isset($_SESSION['CURRENT_APP']['global']))
{
    $_SESSION['CURRENT_APP']['global'] = array();
}

$db = new jsmDatabase();


// TODO: GLOBALS --|-- SAVE POST
if (isset($_POST['submit-global']))
{
    $prefix = basename($_POST['global']['prefix']);
    $target = basename($_POST['global']['target']);
    if (strlen($prefix) > 2)
    {
        $global['name'] = $target;
        $global['target'] = $target;
        $global['prefix'] = $prefix;
        $global['note'] = trim($_POST['global']['note']);
        $global['module'][0]['code']['export'] = trim($_POST['global']['module'][0]['code']['export']);
        $global['component'][0]['code']['export'] = trim($_POST['global']['component'][0]['code']['export']);
        $global['component'][0]['code']['init'] = trim($_POST['global']['component'][0]['code']['init']);
        $global['component'][0]['code']['other'] = trim($_POST['global']['component'][0]['code']['other']);

        $z = 0;
        foreach ($_POST['global']['modules'] as $module)
        {
            if (($module['cordova'] != '') || ($module['path'] != ''))
            {
                $global['modules'][$z]['enable'] = true;
                if ($module['class'] != '')
                {
                    $global['modules'][$z]['class'] = $module['class'];
                }

                if ($module['import'] != '')
                {
                    $global['modules'][$z]['import'] = $module['import'];
                }

                if ($module['var'] != '')
                {
                    $global['modules'][$z]['var'] = $module['var'];
                }

                if ($module['cordova'] != '')
                {
                    $global['modules'][$z]['cordova'] = $module['cordova'];
                }

                if ($module['path'] != '')
                {
                    $global['modules'][$z]['path'] = $module['path'];
                }

                if ($module['cordova-variable'][0]['val'] != '')
                {
                    $global['modules'][$z]['cordova-variable'][0] = $module['cordova-variable'][0];
                }

                if ($module['cordova-variable'][1]['val'] != '')
                {
                    $global['modules'][$z]['cordova-variable'][1] = $module['cordova-variable'][1];
                }

                if ($module['cordova-variable'][2]['val'] != '')
                {
                    $global['modules'][$z]['cordova-variable'][2] = $module['cordova-variable'][2];
                }

                if ($module['cordova-variable'][3]['val'] != '')
                {
                    $global['modules'][$z]['cordova-variable'][3] = $module['cordova-variable'][3];
                }

                $z++;
            }
        }

        $db->saveGlobal($prefix, $global);

        $db->current();
        rebuild();

        $param = null;
        if (isset($_GET['global-name']))
        {
            $param .= '&global-name=' . basename($_GET['global-name']);
        }
        if (isset($_GET['target']))
        {
            $param .= '&target=' . basename($_GET['target']);
        }
        if (isset($_GET['a']))
        {
            if ($_GET['a'] == 'edit')
            {
                $param .= '&a=edit';
            }
        }
        $param .= '&' . time();
        header('Location: ./?p=globals' . $param);
    }
}

switch ($_GET['a'])
{
    case 'delete':
        $prefix = basename($_GET['global-name']);
        $target = basename($_GET['target']);
        $db->deleteGlobal($prefix, $target);

        header('Location: ?p=globals&ok');
        break;
    case 'list':
        // TODO: GLOBALS --|-- LIST
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Globals') . '</li>';
        $breadcrumb .= '</ol>';

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
        $content .= '<h1>Globals</h1>';
        $content .= '<p class="lead">Application components that are executed globally</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Code') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('The following is a global component list') . ':</p>';

        $_content = null;
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';

        $content .= '<th>';
        $content .= __e('Name');
        $content .= '</th>';

        $content .= '<th>';
        $content .= __e('Type');
        $content .= '</th>';

        $content .= '<th>';
        $content .= __e('Description');
        $content .= '</th>';


        $content .= '<th>';
        $content .= '</th>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';

        $global_names = array_keys($_SESSION['CURRENT_APP']['global']);
        for ($i = 0; $i < count($global_names); $i++)
        {

            $prefix = $global_names[$i];
            $_target = array_keys($_SESSION['CURRENT_APP']['global'][$prefix]);
            $target = $_target[0];

            $info_class = $_SESSION['CURRENT_APP']['global'][$prefix][$target];


            $content .= '<tr>';

            $content .= '<td>';
            $content .= $prefix;
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<span class="label label-danger">' . $target . '</span>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<p>' . $info_class['note'] . '</p>';
            $content .= '</td>';


            $content .= '<td>';
            $content .= '<a target="_blank" href="./system/plugin/viewsource/?globals=' . $prefix . '&type=ts" class="btn btn-flat btn-xs btn-success"><i class="fa fa-file-code-o"></i> ' . __e('View Source') . '</a> ';
            $content .= '<a href="#!_" data-toggle="modal" data-target="#info-global-dialog-' . $prefix . '" class="btn btn-flat btn-xs btn-info"><i class="fa fa-info"></i> ' . __e('Info') . '</a> ';
            $content .= '<a href="./?p=globals&a=edit&global-name=' . $prefix . '&target=' . $target . '" class="btn btn-flat btn-xs btn-warning"><i class="fa fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a> ';
            $content .= '<a href="#!" data-toggle="modal" data-target="#delete-global-dialog-' . $prefix . '" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a> ';

            $content .= '</td>';
            $content .= '</tr>';


            // TODO: GLOBALS --|-- LIST - DIALOG
            $_content .= '<div class="modal fade modal-default" id="info-global-dialog-' . $prefix . '" tabindex="-1" role="dialog" aria-labelledby="info-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" >Info <strong>' . $prefix . '</strong> <small>global</small></h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<div style="overflow-y:scroll;height:120px;padding: 12px;">';
            $_content .= '<p>' . $info_class['note'] . '</p>';

            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';


            $_content .= '<div class="modal modal-md fade modal-default" id="delete-global-dialog-' . $prefix . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This global code') . '</h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<p>' . __e('Are you sure you want to delete this global code?') . '</p>';
            $_content .= '<div class="row">';
            $_content .= '<div class="col-md-3 text-right">';
            $_content .= '<div class="icon text-center icon-confirm"><i class="fa-5x fa fa-gg"></i></div>';
            $_content .= '</div>';
            $_content .= '<div class="col-md-9 text-left">';


            $_content .= '</div>';
            $_content .= '</div>';

            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<a href="./?p=globals&a=delete&global-name=' . $prefix . '&target=' . $target . '&ok" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
        $content .= '<a href="./?p=globals&a=new" class="btn btn-flat btn-danger">' . __e('Create New globals') . '</a>&nbsp;';
        $content .= '</div>';

        $content .= '</div>';
        break;

        // TODO: GLOBALS --|-- EDIT
    case 'edit':
        if (!isset($_GET['global-name']))
        {
            header('Location: ./?p=globals&' . time());
        }
        if (!isset($_GET['target']))
        {
            header('Location: ./?p=globals&' . time());
        }

        $prefix = basename($_GET['global-name']);
        $target = basename($_GET['target']);
        $data_class = $_SESSION['CURRENT_APP']['global'][$prefix][$target];

        // TODO: GLOBALS --|-- EDIT --|-- BREADCRUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pipes">' . __e('Globals') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
        $breadcrumb .= '</ol>';

        // TODO: GLOBALS --|-- EDIT --|-- FORM
        $content .= '<form role="form" action="" method="post">';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        // TODO: GLOBALS --|-- EDIT --|-- FORM --|-- GENERAL
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
        $content .= '<label>' . __e('Prefix') . '</label>';
        $content .= '<input type="text" name="global[prefix]" class="form-control" value="' . $prefix . '" placeholder="admob-free" readonly/>';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Type') . '</label>';
        $content .= '<input type="text" name="global[target]" class="form-control" value="' . $target . '" placeholder="core" readonly/>';
        $content .= '<p class="help-block">' . __e('') . '</p>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="col-md-12">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="global[note]" class="form-control" value="' . htmlentities($data_class['note']) . '" placeholder="" />';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?globals=component&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div><!--./box-->';


        // TODO: GLOBALS --|-- EDIT --|-- FORM --|-- OPTION COMPONENT
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Out Scope Component') . ' ';
        $content .= '<small>' . __e('Out of Object Scope') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        if (!isset($data_class['component'][0]['code']['export']))
        {
            $data_class['component'][0]['code']['export'] = '';
        }
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('This code is outside the class, can also be used to create a new class') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.component.ts</code></p>';

        $content .= '<div class="example-code">Example:<pre>declare var blaBla:any;</pre></div>';
        $content .= '<textarea id="global-code" data-type="ts"  name="global[component][0][code][export]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($data_class['component'][0]['code']['export']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?globals=component&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div><!--./box-->';


        $content .= '</div>';


        $content .= '<div class="col-md-6">';


        // TODO: GLOBALS --|-- EDIT --|-- FORM --|-- OPTION MODULE

        if (!isset($data_class['module'][0]['code']['export']))
        {
            $data_class['module'][0]['code']['export'] = '';
        }
        $content .= '<div class="box box-warning">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Out Scope Module') . ' ';
        $content .= '<small>' . __e('Out of Object Scope') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.module.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>const blaBla: any = {...}</pre></div>';
        $content .= '<textarea id="code-init" data-type="ts"  name="global[module][0][code][export]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($data_class['module'][0]['code']['export']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?globals=module&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';


        // TODO: GLOBALS --|-- EDIT --|-- FORM --|-- INIT COMPONENT
        $content .= '<div class="box box-warning">';


        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Initialize Component Function') . ' ';
        $content .= '<small>' . __e('Scope of Initialize function') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code to call the functions that you created') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.component.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>this.handlerBlaBla();</pre></div>';
        $content .= '<textarea id="code-init" data-type="ts"  name="global[component][0][code][init]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($data_class['component'][0]['code']['init']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?globals=component&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '</div>';

        // TODO: GLOBALS --|-- EDIT --|-- FORM --|-- OTHER COMPONENT
        $content .= '<div class="box box-success">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Component Functions') . ' ';
        $content .= '<small>' . __e('functions/properties inside the object') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.component.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';
        $content .= '<textarea id="code-other" data-type="ts"  name="global[component][0][code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($data_class['component'][0]['code']['other']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

        // TODO: GLOBALS --|-- EDIT --|-- FORM --|-- MODULES
        $content .= '<div class="table-responsive">';
        $content .= '<table class="table table-striped table-bordered ">';

        $content .= '<thead>' . "\r\n";
        $content .= '<tr>' . "\r\n";
        $content .= '<th style="min-width:30px">#</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Class</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Variable</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Cordova Plugin</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Path</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 1</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 1</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 2</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 2</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 3</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 3</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 4</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 4</th>' . "\r\n";

        $content .= '<th  style="vertical-align: middle;text-align: center;">Import</th>' . "\r\n";

        $content .= '<th></th>' . "\r\n";

        $content .= '</tr>' . "\r\n";
        $content .= '</thead>' . "\r\n";
        $content .= '<tbody class="item-list">' . "\r\n";
        $t = 0;
        if (!isset($data_class['modules']))
        {
            $data_class['modules'] = array();
        }
        foreach ($data_class['modules'] as $module)
        {
            if (!isset($module['class']))
            {
                $module['class'] = '';
            }
            if (!isset($module['var']))
            {
                $module['var'] = '';
            }
            if (!isset($module['cordova']))
            {
                $module['cordova'] = '';
            }

            if (!isset($module['path']))
            {
                $module['path'] = '';
            }
            if (!isset($module['import']))
            {
                $module['import'] = '';
            }

            if (!isset($module['cordova-variable'][0]['var']))
            {
                $module['cordova-variable'][0]['var'] = '';
            }
            if (!isset($module['cordova-variable'][1]['var']))
            {
                $module['cordova-variable'][1]['var'] = '';
            }
            if (!isset($module['cordova-variable'][2]['var']))
            {
                $module['cordova-variable'][2]['var'] = '';
            }
            if (!isset($module['cordova-variable'][3]['var']))
            {
                $module['cordova-variable'][3]['var'] = '';
            }

            if (!isset($module['cordova-variable'][0]['val']))
            {
                $module['cordova-variable'][0]['val'] = '';
            }
            if (!isset($module['cordova-variable'][1]['val']))
            {
                $module['cordova-variable'][1]['val'] = '';
            }
            if (!isset($module['cordova-variable'][2]['val']))
            {
                $module['cordova-variable'][2]['val'] = '';
            }
            if (!isset($module['cordova-variable'][3]['val']))
            {
                $module['cordova-variable'][3]['val'] = '';
            }

            $content .= '<tr class="item" id="modules-angular-' . $t . '">';

            $content .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>';

            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][class]" value="' . $module['class'] . '" placeholder="Device" /><code>' . $module['class'] . '</code></td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][var]" value="' . $module['var'] . '" placeholder="device" /><code>' . $module['var'] . '</code></td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova]" value="' . $module['cordova'] . '" placeholder="" /><span class="label label-danger">' . $module['cordova'] . '</span></td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][path]" value="' . $module['path'] . '" placeholder="" /><span class="label label-success">' . $module['path'] . '</span></td>' . "\r\n";


            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][0][var]" value="' . $module['cordova-variable'][0]['var'] . '" placeholder="" />' . $module['cordova-variable'][0]['var'] . '</td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][0][val]" value="' . $module['cordova-variable'][0]['val'] . '" placeholder="" />' . $module['cordova-variable'][0]['val'] . '</td>' . "\r\n";

            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][1][var]" value="' . $module['cordova-variable'][1]['var'] . '" placeholder="" />' . $module['cordova-variable'][1]['var'] . '</td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][1][val]" value="' . $module['cordova-variable'][1]['val'] . '" placeholder="" />' . $module['cordova-variable'][1]['val'] . '</td>' . "\r\n";

            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][2][var]" value="' . $module['cordova-variable'][2]['var'] . '" placeholder="" />' . $module['cordova-variable'][2]['var'] . '</td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][2][val]" value="' . $module['cordova-variable'][2]['val'] . '" placeholder="" />' . $module['cordova-variable'][2]['val'] . '</td>' . "\r\n";

            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][3][var]" value="' . $module['cordova-variable'][3]['var'] . '" placeholder="" />' . $module['cordova-variable'][3]['var'] . '</td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][cordova-variable][3][val]" value="' . $module['cordova-variable'][3]['val'] . '" placeholder="" />' . $module['cordova-variable'][3]['val'] . '</td>' . "\r\n";
            $content .= '<td><input type="hidden" class="form-control" name="global[modules][' . $t . '][import]" value="' . $module['import'] . '" placeholder="" /><code>' . $module['import'] . '</code></td>' . "\r\n";

            $content .= '<td class="handle"><a href="#!" data-target="#modules-angular-' . $t . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>';
            $content .= '</tr>';
            $t++;
        }


        $content .= '<tr class="item" id="modules-angular-' . $t . '">';

        $content .= '<td class="handle v-top" ></td>';

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][class]" value="" placeholder="Device" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][var]" value="" placeholder="device" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][path]" value="" placeholder="" /></td>' . "\r\n";


        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][0][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][0][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][1][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][1][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][2][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][2][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][3][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][3][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][import]" value="" placeholder="" /></td>' . "\r\n";


        $content .= '<td><button class="btn btn-primary btn-md" name="submit-global" ><i class="fa fa-plus"></i> ' . __e('Add') . '</button></td>';
        $content .= '</tr>';


        $content .= '</tbody>' . "\r\n";
        $content .= '</table>';
        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?globals=component&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</form>';
        break;


    case 'new':
        // TODO: GLOBALS --|-- NEW
        // TODO: GLOBALS --|-- NEW --|-- BREADCRUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pipes">' . __e('Globals') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('New') . '</li>';
        $breadcrumb .= '</ol>';


        // TODO: GLOBALS --|-- NEW --|-- FORM
        $content .= '<form role="form" action="" method="post">';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        // TODO: GLOBALS --|-- NEW --|-- FORM --|-- GENERAL
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
        $content .= '<label>' . __e('Prefix') . '</label>';
        $content .= '<input type="text" name="global[prefix]" class="form-control" value="" placeholder="admob-free" required />';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Type') . '</label>';
        $content .= '<input type="text" name="global[target]" class="form-control" value="core" placeholder="core" readonly />';
        $content .= '<p class="help-block">' . __e('') . '</p>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="col-md-12">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="global[note]" class="form-control" value="" placeholder="" />';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div><!--./box-->';


        // TODO: GLOBALS --|-- NEW --|-- FORM --|-- OPTION COMPONENT
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Out Scope Component') . ' ';
        $content .= '<small>' . __e('Out of Object Scope') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('This code is outside the class, can also be used to create a new class') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.component.ts</code></p>';

        $content .= '<div class="example-code">Example:<pre>declare var blaBla:any;</pre></div>';
        $content .= '<textarea id="global-code" data-type="ts"  name="global[component][0][code][export]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div><!--./box-->';


        $content .= '</div>';


        $content .= '<div class="col-md-6">';

        // TODO: GLOBALS --|-- NEW --|-- FORM --|-- OPTION MODULE

        $content .= '<div class="box box-warning">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Out Scope Module') . ' ';
        $content .= '<small>' . __e('Out of Object Scope') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.module.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>const blaBla: any = {...}</pre></div>';
        $content .= '<textarea id="code-init" data-type="ts"  name="global[module][0][code][export]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?globals=module&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';


        // TODO: GLOBALS --|-- NEW --|-- FORM --|-- INIT COMPONENT
        $content .= '<div class="box box-warning">';


        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Initialize Component Function') . ' ';
        $content .= '<small>' . __e('Scope of Initialize function') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code to call the functions that you created') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.component.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>this.handlerBlaBla();</pre></div>';
        $content .= '<textarea id="code-init" data-type="ts"  name="global[component][0][code][init]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</div>';

        $content .= '</div>';


        // TODO: GLOBALS --|-- NEW --|-- FORM --|-- OTHER COMPONENT
        $content .= '<div class="box box-success">';

        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Component Function') . ' ';
        $content .= '<small>' . __e('functions/properties inside the object') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/app.component.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';

        $content .= '<textarea id="code-other" data-type="ts"  name="global[component][0][code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        // TODO: GLOBALS --|-- NEW --|-- FORM --|-- MODULES
        $content .= '<div class="table-responsive">';
        $content .= '<table class="table taable-bordered table-striped">';

        $content .= '<thead>' . "\r\n";
        $content .= '<tr>' . "\r\n";
        $content .= '<th style="min-width:30px">#</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Class</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Variable</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Cordova Plugin</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Path</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 1</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 1</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 2</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 2</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 3</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 3</th>' . "\r\n";

        $content .= '<th style="vertical-align: middle;text-align: center;">Var 4</th>' . "\r\n";
        $content .= '<th style="vertical-align: middle;text-align: center;">Val 4</th>' . "\r\n";

        $content .= '<th  style="vertical-align: middle;text-align: center;">Import</th>' . "\r\n";

        $content .= '<th></th>' . "\r\n";

        $content .= '</tr>' . "\r\n";
        $content .= '</thead>' . "\r\n";
        $content .= '<tbody class="item-list">' . "\r\n";


        $t = 0;
        $content .= '<tr class="item" id="modules-angular-' . $t . '">';

        $content .= '<td class="handle v-top" ></td>';

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][class]" value="" placeholder="Device" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][var]" value="" placeholder="device" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][path]" value="" placeholder="" /></td>' . "\r\n";


        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][0][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][0][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][1][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][1][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][2][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][2][val]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][3][var]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][cordova-variable][3][val]" value="" placeholder="" /></td>' . "\r\n";
        $content .= '<td><input type="text" class="form-control" name="global[modules][' . $t . '][import]" value="" placeholder="" /></td>' . "\r\n";

        $content .= '<td><button class="btn btn-primary btn-md" name="submit-global" ><i class="fa fa-plus"></i> ' . __e('Add') . '</button></td>';
        $content .= '</tr>';


        $content .= '</tbody>' . "\r\n";
        $content .= '</table>';
        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-global"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</form>';
        break;
}
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


$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Globals');
$template->page_desc = __e('Application components that are executed globally');
$template->page_content = $content;
$template->page_js = $page_js;

?>