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

if (!isset($_SESSION['CURRENT_APP']['services']))
{
    $_SESSION['CURRENT_APP']['services'] = array();
}
$db = new jsmDatabase();

if (isset($_POST['service']))
{
    $data_post = $_POST['service'];
    $db->saveService($data_post);
    $db->current();
    rebuild();
    if (isset($_GET['service-name']))
    {
        header("Location: ./?p=services&a=edit&service-name=" . basename($_GET['service-name']) . '&' . time());
    } else
    {
        header("Location: ./?p=services&a=list&" . time());
    }
}


switch ($_GET['a'])
{
    case 'list':
        // TODO: SERVICES --+-- LIST
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Services') . '</li>';
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
        $content .= '<h1>Services</h1>';
        $content .= '<p class="lead">Components shouldn\'t fetch or save data directly and they certainly shouldn\'t knowingly present fake data. They should focus on presenting data and delegate data access to a service, read more: <a href="https://angular.io/tutorial/toh-pt4" target="_blank">Angular Guide</a></p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Custom <em>Services</em>') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('Angular allows you to create your own custom <em>services</em>, here are the <em>services</em> that have been created') . ':</p>';

        $_content = null;
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>';
        $content .= __e('Name');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Services');
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
        foreach ($_SESSION['CURRENT_APP']['services'] as $service)
        {
            if (!isset($service['desc']))
            {
                $service['desc'] = '-';
            }
            if (!isset($service['status']))
            {
                $service['status'] = '';
            }

            if (!isset($service['instruction']))
            {
                $service['instruction'] = '';
            }

            $content .= '<tr>';
            $content .= '<td>';
            $content .= $service['name'];
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<label class="label label-info">' . $service['service'] . '</label>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= $service['desc'];
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<label class="label label-default">' . $service['status'] . '</label>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<a target="_blank" href="./system/plugin/viewsource/?service=' . $service['prefix'] . '&type=ts" class="btn btn-flat btn-xs btn-success"><i class="fa fa-file-code-o"></i> ' . __e('View Source') . '</a> ';
            $content .= '<a href="#!_" data-toggle="modal" data-target="#info-service-dialog-' . $service['prefix'] . '" class="btn btn-flat btn-xs btn-info"><i class="fa fa-info"></i> ' . __e('Info') . '</a> ';
            $content .= '<a href="./?p=services&a=edit&service-name=' . $service['prefix'] . '" class="btn btn-flat btn-xs btn-warning"><i class="fa fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a> ';
            $content .= '<a href="#!" data-toggle="modal" data-target="#delete-service-dialog-' . $service['prefix'] . '" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a> ';
            $content .= '</td>';

            $content .= '</tr>';


            // TODO: SERVICES --+-- LIST --+-- DIALOG INFO
            $_content .= '<div class="modal fade modal-default" id="info-service-dialog-' . $service['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="info-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" >Info <strong>' . $service['name'] . '</strong> <small>Service</small></h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<div style="overflow-y:scroll;height:120px;padding: 12px;">';
            $_content .= '<p>' . $service['desc'] . '</p>';
            $_content .= '<div>' . $service['instruction'] . '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';

            // TODO: SERVICES --+-- LIST --+-- DIALOG DELETE
            $_content .= '<div class="modal modal-md fade modal-default" id="delete-service-dialog-' . $service['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This Service') . '</h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<p>' . __e('Are you sure you want to delete this service?') . '</p>';
            $_content .= '<div class="row">';
            $_content .= '<div class="col-md-3 text-right">';
            $_content .= '<div class="icon text-center icon-confirm"><i class="fa-5x fa fa-gg"></i></div>';
            $_content .= '</div>';
            $_content .= '<div class="col-md-9 text-left">';

            $_content .= '<table class="table-confirm">';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Service Name') . '</td>';
            $_content .= '<td>: <strong>' . $service['name'] . '</strong></td>';
            $_content .= '</tr>';
            $_content .= '</table>';

            $_content .= '</div>';
            $_content .= '</div>';

            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<a href="./?p=services&a=delete&service-name=' . $service['prefix'] . '&ok" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
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
        $content .= '<a href="./?p=services&a=new" class="btn btn-flat btn-danger">' . __e('Create New Service') . '</a>&nbsp;';
        $content .= '</div>';

        $content .= '</div>';
        break;
    case 'edit':
        // TODO: SERVICES --+-- EDIT
        if (isset($_GET['service-name']))
        {

            $servicename = basename($_GET['service-name']);

            $service_data = $db->getService($servicename);

            if (!isset($service_data['name']))
            {
                $service_data['name'] = '';
            }
            if (!isset($service_data['prefix']))
            {
                $service_data['prefix'] = '';
            }

            if (!isset($service_data['desc']))
            {
                $service_data['desc'] = '';
            }

            if (!isset($service_data['instruction']))
            {
                $service_data['instruction'] = '';
            }


            if (!isset($service_data['modules']['angular']))
            {
                $service_data['modules']['angular'] = array();
            }

            if (!isset($service_data['code']['export']))
            {
                $service_data['code']['export'] = '';
            }

            // TODO: SERVICES --+-- EDIT --+-- MODULES
            $ionic_angular_html = null;
            $ionic_angular_html .= '<!-- modules -->' . "\r\n";
            $ionic_angular_html .= '<div class="responsive">' . "\r\n";
            $ionic_angular_html .= '<table class="table table-striped" >' . "\r\n";

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
            $ionic_angular_html .= '<td>Injectable</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";


            $t = 0;
            foreach ($service_data['modules']['angular'] as $_module_angular)
            {
                $label_cordova = null;
                if (!isset($_module_angular['cordova']))
                {
                    $_module_angular['cordova'] = '';
                }

                if ($_module_angular['cordova'] !== '')
                {
                    $label_cordova .= '<span class="label label-danger">' . htmlentities($_module_angular['cordova']) . '</span>';
                }

                $ionic_angular_html .= '<tr class="item" id="modules-angular-' . $t . '">' . "\r\n";
                $ionic_angular_html .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][class]" value="' . htmlentities($_module_angular['class']) . '" />' . htmlentities($_module_angular['class']) . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][var]" value="' . htmlentities($_module_angular['var']) . '"/>' . htmlentities($_module_angular['var']) . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][cordova]" value="' . htmlentities($_module_angular['cordova']) . '"/>' . $label_cordova . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][path]" value="' . htmlentities($_module_angular['path']) . '"/><code>' . htmlentities($_module_angular['path']) . '</code></td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><a href="#!" data-target="#modules-angular-' . $t . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>' . "\r\n";
                $ionic_angular_html .= '</tr>' . "\r\n";
                $t++;
            }
            $t++;
            $ionic_angular_html .= '<tr id="">' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][class]" value="" /></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][var]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][cordova]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][path]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";

            $ionic_angular_html .= '</tbody>' . "\r\n";
            $ionic_angular_html .= '</table>' . "\r\n";
            $ionic_angular_html .= '</div>' . "\r\n";
            $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";

            // TODO: SERVICES --+-- EDIT --+-- BREADCUMB
            $breadcrumb = null;
            $breadcrumb .= '<ol class="breadcrumb">';
            $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
            $breadcrumb .= '<li><a href="./?p=services">' . __e('Services') . '</a></li>';
            $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
            $breadcrumb .= '</ol>';

            // TODO: SERVICES --+-- EDIT --+-- FORM --+--
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
            $content .= '<input type="text" name="service[name]" class="form-control" value="' . $service_data['name'] . '" placeholder="Users" readonly/>';
            $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
            $content .= '</div> ';
            $content .= '</div>';
            $content .= '<div class="col-md-6">';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Prefix') . '</label>';
            $content .= '<input type="text" name="service[prefix]" class="form-control" value="' . $service_data['prefix'] . '" placeholder="users" readonly/>';
            $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Description') . '</label>';
            $content .= '<input type="text" name="service[desc]" class="form-control" value="' . $service_data['desc'] . '" placeholder="" />';
            $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
            $content .= '</div>';

            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Instruction') . '</label>';
            $content .= '<textarea class="form-control" name="service[instruction]">' . $service_data['instruction'] . '</textarea>';
            $content .= '<p class="help-block">' . __e('Simple instructions on how to use it') . '</p>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="col-md-6">';

            // TODO: SERVICES --+-- EDIT --+-- FORM --+-- OUT-SCOPE
            $content .= '<div class="box box-warning">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Out Scope') . '<small>Typescript</small></h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';
            $content .= '<p> ' . __e('This code is outside the class, can also be used to create a new class/declare') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/services/' . $service_data['prefix'] . '/' . $service_data['prefix'] . '.service.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>declare var blaBla:any;</pre></div>';
            $content .= '<textarea class="form-control" data-type="ts" name="service[code][export]" >' . htmlentities($service_data['code']['export']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?service=' . $service_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';

            $content .= '</div>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '</div>';


            $content .= '<div class="box box-danger">';
            // TODO: SERVICES --+-- NEW --+-- FORM --+-- OTHER-FUNCTIONS
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
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/services/' . $service_data['prefix'] . '/' . $service_data['prefix'] . '.service.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';
            $content .= '<textarea id="pipe-other" data-type="ts"  name="service[code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($service_data['code']['other']) . '</textarea>';

            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';

            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?service=' . $service_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';

            $content .= '<div class="box box-info">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Modules') . '';
            $content .= '<small>' . __e('Angular/Ionic-Native') . '</small>';
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
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/services/' . $service_data['prefix'] . '/' . $service_data['prefix'] . '.service.ts</code></p>';

            $content .= '' . $ionic_angular_html . '';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?service=' . $service_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
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
        // TODO: SERVICES --+-- NEW --+-- 

        if (!isset($service_data['name']))
        {
            $service_data['name'] = '';
        }
        if (!isset($service_data['prefix']))
        {
            $service_data['prefix'] = '';
        }

        if (!isset($service_data['desc']))
        {
            $service_data['desc'] = '';
        }

        if (!isset($service_data['instruction']))
        {
            $service_data['instruction'] = '';
        }


        if (!isset($service_data['modules']['angular']))
        {
            $service_data['modules']['angular'] = array();
        }

        if (!isset($service_data['code']['export']))
        {
            $service_data['code']['export'] = '';
        }
        if (!isset($service_data['code']['other']))
        {
            $service_data['code']['other'] = '';
        }
        // TODO: SERVICES --+-- NEW --+-- MODULES
        $ionic_angular_html = null;
        $ionic_angular_html .= '<!-- modules -->' . "\r\n";
        $ionic_angular_html .= '<div class="responsive">' . "\r\n";
        $ionic_angular_html .= '<table class="table table-striped" >' . "\r\n";

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
        $ionic_angular_html .= '<td>Injectable</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";


        $t = 0;
        foreach ($service_data['modules']['angular'] as $_module_angular)
        {
            $label_cordova = null;
            if (!isset($_module_angular['cordova']))
            {
                $_module_angular['cordova'] = '';
            }

            if ($_module_angular['cordova'] !== '')
            {
                $label_cordova .= '<span class="label label-danger">' . htmlentities($_module_angular['cordova']) . '</span>';
            }

            $ionic_angular_html .= '<tr class="item" id="modules-angular-' . $t . '">' . "\r\n";
            $ionic_angular_html .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][class]" value="' . htmlentities($_module_angular['class']) . '" />' . htmlentities($_module_angular['class']) . '</td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][var]" value="' . htmlentities($_module_angular['var']) . '"/>' . htmlentities($_module_angular['var']) . '</td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][cordova]" value="' . htmlentities($_module_angular['cordova']) . '"/>' . $label_cordova . '</td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="service[modules][angular][' . $t . '][path]" value="' . htmlentities($_module_angular['path']) . '"/><code>' . htmlentities($_module_angular['path']) . '</code></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><a href="#!" data-target="#modules-angular-' . $t . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $t++;
        }
        $t++;
        $ionic_angular_html .= '<tr id="">' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][class]" value="" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][var]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][cordova]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="service[modules][angular][' . $t . '][path]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '</tbody>' . "\r\n";
        $ionic_angular_html .= '</table>' . "\r\n";
        $ionic_angular_html .= '</div>' . "\r\n";
        $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";

        // TODO: SERVICES --+-- NEW --+-- BREADCUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=services">' . __e('Services') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('New') . '</li>';
        $breadcrumb .= '</ol>';

        // TODO: SERVICES --+-- NEW --+-- FORM --+--
        $content .= '<form role="form" action="" method="post">';

        // TODO: SERVICES --+-- NEW --+-- FORM --+-- GENERAL
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
        $content .= '<input type="text" name="service[name]" class="form-control" value="' . $service_data['name'] . '" placeholder="Users" />';
        $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
        $content .= '</div> ';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix') . '</label>';
        $content .= '<input type="text" name="service[prefix]" class="form-control" value="' . $service_data['prefix'] . '" placeholder="users" readonly/>';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="service[desc]" class="form-control" value="' . $service_data['desc'] . '" placeholder="" />';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
        $content .= '</div>';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Instruction') . '</label>';
        $content .= '<textarea class="form-control" name="service[instruction]">' . $service_data['instruction'] . '</textarea>';
        $content .= '<p class="help-block">' . __e('Simple instructions on how to use it') . '</p>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '</div>';

        // TODO: SERVICES --+-- NEW --+-- FORM --+-- OUT-SCOPE
        $content .= '<div class="col-md-6">';
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Out Scope') . ' <small>TypeScript</small></h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p> ' . __e('This code is outside the class, can also be used to create a new class/declare') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/services/new-service/new-service.service.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>declare var blaBla:any;</pre></div>';
        $content .= '<textarea class="form-control" data-type="ts" name="service[code][export]" >' . htmlentities($service_data['code']['export']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '</div>';

        // TODO: SERVICES --+-- NEW --+-- FORM --+-- OTHER-FUNCTIONS
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

        $content .= '<div class="box-body">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/services/new-service/new-service.service.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';
        $content .= '<textarea id="pipe-other" data-type="ts"  name="service[code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($service_data['code']['other']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';

        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?service=' . $service_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Modules') . '';
        $content .= '<small>' . __e('Angular/Ionic-Native') . '</small>';
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
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/services/new-service/new-service.service.ts</code></p>';

        $content .= '' . $ionic_angular_html . '';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?service=' . $service_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '';
        $content .= '</div> ';

        $content .= '</form>';

        // TODO: SERVICES - DELETE
        break;
    case 'delete':
        if (isset($_GET['ok']))
        {
            $service_name = basename($_GET['service-name']);
            $db->deleteService($service_name);
            $db->current();
            rebuild();
            header("Location: ./?p=services&" . time());
        }
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=services">' . __e('Services') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Delete') . '</li>';
        $breadcrumb .= '</ol>';
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
$template->page_title = __e('(IMAB) Services');
$template->page_desc = __e('Service is a broad category encompassing any value, function, or feature that an app needs');
$template->page_content = $content;
$template->page_js = $page_js;

?>