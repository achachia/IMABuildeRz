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
if (!isset($_SESSION['CURRENT_APP']['directives']))
{
    $_SESSION['CURRENT_APP']['directives'] = array();
}


$db = new jsmDatabase();
$current_app = $db->current();
$string = new jsmString();
if (isset($_POST['directive']))
{
    $data_post = $_POST['directive'];
    $db->saveDirective($data_post);
    $db->current();
    rebuild();
    if (isset($_GET['directive-name']))
    {
        header("Location: ./?p=directives&a=edit&directive-name=" . basename($_GET['directive-name']) . '&' . time());
    } else
    {
        header("Location: ./?p=directives&a=list" . '&' . time());
    }
}

$disable_capasitor = $disable_capasitor_alert = '';

if (!isset($current_app['apps']['capasitor']))
{
    $current_app['apps']['capasitor'] = false;
}
if ($current_app['apps']['capasitor'] == true)
{
    $disable_capasitor = 'disabled';
    $disable_capasitor_alert .= '<div class="help-dev-alert">' . __e('<strong>Support</strong>: Capacitors are not capable of using this plugin, please use cordova as compiler') . '</div>';
}

$ok_capasitor_alert = '<div class="help-dev-success">' . __e('<strong>Support</strong>: These directives support capacitor and cordova') . '</div>';

switch ($_GET['a'])
{
        // TODO: ADD --+--
    case 'new':
        if (!isset($directive_data['name']))
        {
            $directive_data['name'] = '';
        }
        if (!isset($directive_data['prefix']))
        {
            $directive_data['prefix'] = '';
        }
        if (!isset($directive_data['desc']))
        {
            $directive_data['desc'] = '';
        }
        if (!isset($directive_data['instruction']))
        {
            $directive_data['instruction'] = '';
        }
        if (!isset($directive_data['code']['constructor']))
        {
            $directive_data['code']['constructor'] = '';
        }
        if (!isset($directive_data['code']['mouseenter']))
        {
            $directive_data['code']['mouseenter'] = '';
        }
        if (!isset($directive_data['code']['mouseleave']))
        {
            $directive_data['code']['mouseleave'] = '';
        }
        if (!isset($directive_data['code']['click']))
        {
            $directive_data['code']['click'] = '';
        }
        if (!isset($directive_data['code']['other']))
        {
            $directive_data['code']['other'] = '';
        }
        if (!isset($directive_data['input'][0]['var']))
        {
            $directive_data['input'][0]['var'] = '';
        }
        if (!isset($directive_data['input'][0]['type']))
        {
            $directive_data['input'][0]['type'] = 'string';
        }
        if (!isset($directive_data['input'][1]['var']))
        {
            $directive_data['input'][1]['var'] = '';
        }
        if (!isset($directive_data['input'][1]['type']))
        {
            $directive_data['input'][1]['type'] = 'string';
        }
        if (!isset($directive_data['input'][2]['var']))
        {
            $directive_data['input'][2]['var'] = '';
        }
        if (!isset($directive_data['input'][2]['type']))
        {
            $directive_data['input'][2]['type'] = 'string';
        }
        if (!isset($directive_data['input'][3]['var']))
        {
            $directive_data['input'][3]['var'] = '';
        }
        if (!isset($directive_data['input'][3]['type']))
        {
            $directive_data['input'][3]['type'] = 'string';
        }
        if (!isset($directive_data['input'][3]['var']))
        {
            $directive_data['input'][3]['var'] = '';
        }
        if (!isset($directive_data['input'][3]['type']))
        {
            $directive_data['input'][3]['type'] = 'string';
        }
        if (!isset($directive_data['input'][4]['var']))
        {
            $directive_data['input'][4]['var'] = '';
        }
        if (!isset($directive_data['input'][4]['type']))
        {
            $directive_data['input'][4]['type'] = 'string';
        }
        if (!isset($directive_data['input'][5]['var']))
        {
            $directive_data['input'][5]['var'] = '';
        }
        if (!isset($directive_data['input'][5]['type']))
        {
            $directive_data['input'][5]['type'] = 'string';
        }
        // TODO: ADD --+-- ANGULAR MODULES
        $ionic_angular_html = null;
        $ionic_angular_html .= '<!-- modules -->' . "\r\n";
        $ionic_angular_html .= '<div class="table-responsive">' . "\r\n";
        $ionic_angular_html .= '<table class="table table-striped">' . "\r\n";
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
        $ionic_angular_html .= '<td>Directive</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td>HostListener</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td>Input</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td>ElementRef</td>' . "\r\n";
        $ionic_angular_html .= '<td>elementRef</td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $t = 0;
        $ionic_angular_html .= '<tr id="">' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][class]" value="" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][var]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][cordova]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][path]" value=""/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $ionic_angular_html .= '</tbody>' . "\r\n";
        $ionic_angular_html .= '</table>' . "\r\n";
        $ionic_angular_html .= '</div>' . "\r\n";
        $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";
        // TODO: ADD --+-- BREADCRUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=directives">' . __e('Directives') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Add') . '</li>';
        $breadcrumb .= '</ol>';
        // TODO: ADD --+-- FORM
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
        $content .= '<input type="text" name="directive[name]" class="form-control" value="' . $directive_data['name'] . '" placeholder="Run Mail App" />';
        $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
        $content .= '</div> ';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix') . '</label>';
        $content .= '<input type="text" name="directive[prefix]" class="form-control" value="' . $directive_data['prefix'] . '" placeholder="run-mail-app" readonly/>';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Description') . '</label>';
        $content .= '<input type="text" name="directive[desc]" class="form-control" value="' . $directive_data['desc'] . '" placeholder="" />';
        $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
        $content .= '</div>';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Instruction') . '</label>';
        $content .= '<textarea class="form-control" name="directive[instruction]">' . $directive_data['instruction'] . '</textarea>';
        $content .= '<p class="help-block">' . __e('Simple instructions on how to use it') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        // TODO: ADD --+-- FORM --+-- INPUT
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-list"></i> ' . __e('Inputs') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '<table class="table">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>' . __e('Input') . '</th>';
        $content .= '<th>' . __e('Variable') . '</th>';
        $content .= '<th>' . __e('Type') . '</th>';
        $content .= '<th></th>';
        $content .= '</tr>';
        $content .= '</thead>';
        $content .= '<tbody>';
        $option_type_var1 = null;
        $option_type_var1 = '<select name="directive[input][0][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $directive_data['input'][0]['type'])
            {
                $selected = 'selected';
            }
            $option_type_var1 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_var1 .= '</select>';
        $content .= '<tr id="">';
        $content .= '<td>' . __e('Variable 1') . '</td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-0-var" type="text" name="directive[input][0][var]" class="form-control" value="' . $directive_data['input'][0]['var'] . '" placeholder="input1" />';
        //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
        $content .= '</td>';
        $content .= '<td>' . $option_type_var1 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-0-var"><i class="fa fa-eraser"></i></a></td>';
        $content .= '</tr>';
        $option_type_var2 = null;
        $option_type_var2 = '<select name="directive[input][1][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $directive_data['input'][1]['type'])
            {
                $selected = 'selected';
            }
            $option_type_var2 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_var2 .= '</select>';
        $content .= '<tr id="">';
        $content .= '<td>' . __e('Variable 2') . '</td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-1-var" type="text" name="directive[input][1][var]" class="form-control" value="' . $directive_data['input'][1]['var'] . '" placeholder="input2" />';
        //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
        $content .= '</td>';
        $content .= '<td>' . $option_type_var2 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-1-var"><i class="fa fa-eraser"></i></a></td>';
        $content .= '</tr>';
        $option_type_var3 = null;
        $option_type_var3 = '<select name="directive[input][2][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $directive_data['input'][2]['type'])
            {
                $selected = 'selected';
            }
            $option_type_var3 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_var3 .= '</select>';
        $content .= '<tr id="">';
        $content .= '<td>' . __e('Variable 3') . '</td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-2-var" type="text" name="directive[input][2][var]" class="form-control" value="' . $directive_data['input'][2]['var'] . '" placeholder="input3" />';
        //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
        $content .= '</td>';
        $content .= '<td>' . $option_type_var3 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-2-var"><i class="fa fa-eraser"></i></a></td>';
        $content .= '</tr>';
        $option_type_var4 = null;
        $option_type_var4 = '<select name="directive[input][3][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $directive_data['input'][3]['type'])
            {
                $selected = 'selected';
            }
            $option_type_var4 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_var4 .= '</select>';
        $content .= '<tr id="">';
        $content .= '<td>' . __e('Variable 4') . '</td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-3-var" type="text" name="directive[input][3][var]" class="form-control" value="' . $directive_data['input'][3]['var'] . '" placeholder="input4" />';
        //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
        $content .= '</td>';
        $content .= '<td>' . $option_type_var4 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-3-var"><i class="fa fa-eraser"></i></a></td>';
        $content .= '</tr>';
        $option_type_var5 = null;
        $option_type_var5 = '<select name="directive[input][4][type]" class="form-control">';
        foreach ($angularTypes as $angularType)
        {
            $selected = '';
            if ($angularType['value'] == $directive_data['input'][4]['type'])
            {
                $selected = 'selected';
            }
            $option_type_var5 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
        }
        $option_type_var5 .= '</select>';
        $content .= '<tr id="">';
        $content .= '<td>' . __e('Variable 5') . '</td>';
        $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-4-var" type="text" name="directive[input][4][var]" class="form-control" value="' . $directive_data['input'][4]['var'] . '" placeholder="input5" />';
        $content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
        $content .= '</td>';
        $content .= '<td>' . $option_type_var5 . '</td>';
        $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-4-var"><i class="fa fa-eraser"></i></a></td>';
        $content .= '</tr>';
        $content .= '</tbody>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div><!--row-->';
        // TODO: ADD --+-- FORM --+-- CONSTRUCTOR
        $content .= '<div class="box box-success">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Constructor') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code for the constructor function') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
        $content .= '<textarea id="directive-constructor" data-type="ts"  name="directive[code][constructor]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['constructor']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: ADD --+-- FORM --+-- HOSTLISTENER --+-- CLICK
        $content .= '<div class="box box-primary">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('HostListener - Click') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code for handling mouse clicks') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
        $content .= '<textarea id="directive-click" data-type="ts"  name="directive[code][click]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['click']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: ADD --+-- FORM --+-- HOSTLISTENER --+-- MOUSE ENTER
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('HostListener - Mouse Enter') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code for handling mouse enter') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
        $content .= '<textarea id="directive-mouseenter" data-type="ts"  name="directive[code][mouseenter]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['mouseenter']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: ADD --+-- FORM --+-- HOSTLISTENER --+-- MOUSE LEAVE
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('HostListener - Mouse Leave') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code for handling mouse leave') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
        $content .= '<textarea id="directive-mouseleave" data-type="ts" name="directive[code][mouseleave]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['mouseleave']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: ADD --+-- FORM --+-- OTHER FUNCTIONS
        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Fuctions') . ' ';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';
        $content .= '<textarea id="directive-other" data-type="ts"  name="directive[code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['other']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: ADD --+-- FORM --+-- MODULES
        $content .= '<div class="box box-success">';
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
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/new-directive/new-directive.directive.ts</code></p>';
        $content .= '' . $ionic_angular_html . '';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '';
        $content .= '</div> ';
        $content .= '</form>';
        break;
    case 'edit':
        // TODO: EDIT --+--
        if (isset($_GET['directive-name']))
        {
            $directivename = basename($_GET['directive-name']);
            $directive_data = $db->getDirective($directivename);
            if (!isset($directive_data['name']))
            {
                $directive_data['name'] = '';
            }
            if (!isset($directive_data['prefix']))
            {
                $directive_data['prefix'] = '';
            }
            if (!isset($directive_data['desc']))
            {
                $directive_data['desc'] = '';
            }
            if (!isset($directive_data['instruction']))
            {
                $directive_data['instruction'] = '';
            }
            if (!isset($directive_data['code']['constructor']))
            {
                $directive_data['code']['constructor'] = '';
            }
            if (!isset($directive_data['code']['mouseenter']))
            {
                $directive_data['code']['mouseenter'] = '';
            }
            if (!isset($directive_data['code']['mouseleave']))
            {
                $directive_data['code']['mouseleave'] = '';
            }
            if (!isset($directive_data['code']['click']))
            {
                $directive_data['code']['click'] = '';
            }
            if (!isset($directive_data['code']['other']))
            {
                $directive_data['code']['other'] = '';
            }
            if (!isset($directive_data['input'][0]['var']))
            {
                $directive_data['input'][0]['var'] = '';
            }
            if (!isset($directive_data['input'][0]['type']))
            {
                $directive_data['input'][0]['type'] = 'string';
            }
            if (!isset($directive_data['input'][1]['var']))
            {
                $directive_data['input'][1]['var'] = '';
            }
            if (!isset($directive_data['input'][1]['type']))
            {
                $directive_data['input'][1]['type'] = 'string';
            }
            if (!isset($directive_data['input'][2]['var']))
            {
                $directive_data['input'][2]['var'] = '';
            }
            if (!isset($directive_data['input'][2]['type']))
            {
                $directive_data['input'][2]['type'] = 'string';
            }
            if (!isset($directive_data['input'][3]['var']))
            {
                $directive_data['input'][3]['var'] = '';
            }
            if (!isset($directive_data['input'][3]['type']))
            {
                $directive_data['input'][3]['type'] = 'string';
            }
            if (!isset($directive_data['input'][3]['var']))
            {
                $directive_data['input'][3]['var'] = '';
            }
            if (!isset($directive_data['input'][3]['type']))
            {
                $directive_data['input'][3]['type'] = 'string';
            }
            if (!isset($directive_data['input'][4]['var']))
            {
                $directive_data['input'][4]['var'] = '';
            }
            if (!isset($directive_data['input'][4]['type']))
            {
                $directive_data['input'][4]['type'] = 'string';
            }
            if (!isset($directive_data['input'][5]['var']))
            {
                $directive_data['input'][5]['var'] = '';
            }
            if (!isset($directive_data['input'][5]['type']))
            {
                $directive_data['input'][5]['type'] = 'string';
            }
            // TODO: EDIT --+-- ANGULAR MODULES
            if (!isset($directive_data['modules']['angular']))
            {
                $directive_data['modules']['angular'] = array();
            }
            $ionic_angular_html = null;
            $ionic_angular_html .= '<!-- modules -->' . "\r\n";
            $ionic_angular_html .= '<div class="table-responsive">' . "\r\n";
            $ionic_angular_html .= '<table class="table table-striped">' . "\r\n";
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
            $ionic_angular_html .= '<td>Directive</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $ionic_angular_html .= '<tr>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td>HostListener</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $ionic_angular_html .= '<tr>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td>Input</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $ionic_angular_html .= '<tr>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td>ElementRef</td>' . "\r\n";
            $ionic_angular_html .= '<td>elementRef</td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><code>@angular/core</code></td>' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $t = 0;
            foreach ($directive_data['modules']['angular'] as $_module_angular)
            {
                $label_cordova = null;
                if ($_module_angular['cordova'] !== '')
                {
                    $label_cordova .= '<span class="label label-danger">' . htmlentities($_module_angular['cordova']) . '</span>';
                }
                $ionic_angular_html .= '<tr class="item" id="modules-angular-' . $t . '">' . "\r\n";
                $ionic_angular_html .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="directive[modules][angular][' . $t . '][class]" value="' . htmlentities($_module_angular['class']) . '" />' . htmlentities($_module_angular['class']) . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="directive[modules][angular][' . $t . '][var]" value="' . htmlentities($_module_angular['var']) . '"/>' . htmlentities($_module_angular['var']) . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="directive[modules][angular][' . $t . '][cordova]" value="' . htmlentities($_module_angular['cordova']) . '"/>' . $label_cordova . '</td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><input type="hidden" name="directive[modules][angular][' . $t . '][path]" value="' . htmlentities($_module_angular['path']) . '"/><code>' . htmlentities($_module_angular['path']) . '</code></td>' . "\r\n";
                $ionic_angular_html .= '<td class="handle"><a href="#!" data-target="#modules-angular-' . $t . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>' . "\r\n";
                $ionic_angular_html .= '</tr>' . "\r\n";
                $t++;
            }
            $t++;
            $ionic_angular_html .= '<tr id="">' . "\r\n";
            $ionic_angular_html .= '<td></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][class]" value="" /></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][var]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][cordova]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input type="text" class="form-control" name="directive[modules][angular][' . $t . '][path]" value=""/></td>' . "\r\n";
            $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $ionic_angular_html .= '</tbody>' . "\r\n";
            $ionic_angular_html .= '</table>' . "\r\n";
            $ionic_angular_html .= '</div>' . "\r\n";
            $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";
            // TODO: EDIT --+-- BREADCRUMB
            $breadcrumb = null;
            $breadcrumb .= '<ol class="breadcrumb">';
            $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
            $breadcrumb .= '<li><a href="./?p=directives">' . __e('Directives') . '</a></li>';
            $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
            $breadcrumb .= '</ol>';
            // TODO: EDIT --+-- FORM
            $content .= '<form role="form" action="" method="post">';
            $content .= '<div class="row">';
            $content .= '<div class="col-md-6">';
            // TODO: EDIT --+-- FORM --|-- GENERAL
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
            $content .= '<input type="text" name="directive[name]" class="form-control" value="' . $directive_data['name'] . '" placeholder="Run Mail App" readonly/>';
            $content .= '<p class="help-block">' . __e('A nic name, only allowed: a-z characters and space') . '</p>';
            $content .= '</div> ';
            $content .= '</div>';
            $content .= '<div class="col-md-6">';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Prefix') . '</label>';
            $content .= '<input type="text" name="directive[prefix]" class="form-control" value="' . $directive_data['prefix'] . '" placeholder="run-mail-app" readonly/>';
            $content .= '<p class="help-block">' . __e('The unique name of the page, using a-z and - characters only') . '</p>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Description') . '</label>';
            $content .= '<input type="text" name="directive[desc]" class="form-control" value="' . $directive_data['desc'] . '" placeholder="" />';
            $content .= '<p class="help-block">' . __e('Descriptions are used for notes') . '</p>';
            $content .= '</div>';
            $content .= '<div class="form-group">';
            $content .= '<label>' . __e('Instruction') . '</label>';
            $content .= '<textarea class="form-control" name="directive[instruction]">' . $directive_data['instruction'] . '</textarea>';
            $content .= '<p class="help-block">' . __e('Simple instructions on how to use it') . '</p>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="col-md-6">';
            // TODO: EDIT --+-- FORM --|-- INPUTS
            $content .= '<div class="box box-warning">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-list"></i> ' . __e('Inputs') . '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body">';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '<table class="table">';
            $content .= '<thead>';
            $content .= '<tr>';
            $content .= '<th>' . __e('Input') . '</th>';
            $content .= '<th>' . __e('Variable') . '</th>';
            $content .= '<th>' . __e('Type') . '</th>';
            $content .= '<th></th>';
            $content .= '</tr>';
            $content .= '</thead>';
            $content .= '<tbody>';
            $option_type_var1 = null;
            $option_type_var1 = '<select name="directive[input][0][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $directive_data['input'][0]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_var1 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_var1 .= '</select>';
            $content .= '<tr id="">';
            $content .= '<td>' . __e('Variable 1') . '</td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-0-var" type="text" name="directive[input][0][var]" class="form-control" value="' . $directive_data['input'][0]['var'] . '" placeholder="input1" />';
            //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_var1 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-0-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';
            $option_type_var2 = null;
            $option_type_var2 = '<select name="directive[input][1][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $directive_data['input'][1]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_var2 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_var2 .= '</select>';
            $content .= '<tr id="">';
            $content .= '<td>' . __e('Variable 2') . '</td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-1-var" type="text" name="directive[input][1][var]" class="form-control" value="' . $directive_data['input'][1]['var'] . '" placeholder="input2" />';
            //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_var2 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-1-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';
            $option_type_var3 = null;
            $option_type_var3 = '<select name="directive[input][2][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $directive_data['input'][2]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_var3 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_var3 .= '</select>';
            $content .= '<tr id="">';
            $content .= '<td>' . __e('Variable 3') . '</td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-2-var" type="text" name="directive[input][2][var]" class="form-control" value="' . $directive_data['input'][2]['var'] . '" placeholder="input3" />';
            //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_var3 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-2-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';
            $option_type_var4 = null;
            $option_type_var4 = '<select name="directive[input][3][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $directive_data['input'][3]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_var4 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_var4 .= '</select>';
            $content .= '<tr id="">';
            $content .= '<td>' . __e('Variable 4') . '</td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-3-var" type="text" name="directive[input][3][var]" class="form-control" value="' . $directive_data['input'][3]['var'] . '" placeholder="input4" />';
            //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_var4 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-3-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';
            $option_type_var5 = null;
            $option_type_var5 = '<select name="directive[input][4][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $directive_data['input'][4]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_var5 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_var5 .= '</select>';
            $content .= '<tr id="">';
            $content .= '<td>' . __e('Variable 5') . '</td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-4-var" type="text" name="directive[input][4][var]" class="form-control" value="' . $directive_data['input'][4]['var'] . '" placeholder="input5" />';
            //$content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_var5 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-4-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';
            $option_type_var6 = null;
            $option_type_var6 = '<select name="directive[input][5][type]" class="form-control">';
            foreach ($angularTypes as $angularType)
            {
                $selected = '';
                if ($angularType['value'] == $directive_data['input'][5]['type'])
                {
                    $selected = 'selected';
                }
                $option_type_var6 .= '<option value="' . $angularType['value'] . '" ' . $selected . '>' . $angularType['label'] . '</option>';
            }
            $option_type_var6 .= '</select>';
            $content .= '<tr id="">';
            $content .= '<td>' . __e('Variable 6') . '</td>';
            $content .= '<td><input data-mask data-inputmask="\'mask\':\'C\',\'greedy\':false,\'repeat\':32" id="directive-input-5-var" type="text" name="directive[input][5][var]" class="form-control" value="' . $directive_data['input'][5]['var'] . '" placeholder="input5" />';
            $content .= '<p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>_</code> characters only') . '</p>';
            $content .= '</td>';
            $content .= '<td>' . $option_type_var6 . '</td>';
            $content .= '<td><a href="#!_" class="btn btn-link co-danger clear-item" data-target="#directive-input-5-var"><i class="fa fa-eraser"></i></a></td>';
            $content .= '</tr>';
            $content .= '</tbody>';
            $content .= '</table>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div><!--row-->';
            // TODO: EDIT --+-- FORM --|-- CONSTRUCTOR
            $content .= '<div class="box box-success">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Constructor') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body pad">';
            $content .= '<p> ' . __e('Write the code for the constructor function') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
            $content .= '<textarea id="directive-constructor" data-type="ts"  name="directive[code][constructor]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['constructor']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';
            // TODO: EDIT --+-- FORM --|-- HOSTLISTENER --+-- CLICK
            $content .= '<div class="box box-primary">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('HostListener - Click') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body pad">';
            $content .= '<p> ' . __e('Write the code for handling mouse clicks') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>this.handlerBlaBla();</pre></div>';
            $content .= '<textarea id="directive-click" data-type="ts"  name="directive[code][click]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['click']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';
            // TODO: EDIT --+-- FORM --|-- HOSTLISTENER --+-- MOUSE ENTER
            $content .= '<div class="box box-danger">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('HostListener - Mouse Enter') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body pad">';
            $content .= '<p> ' . __e('Write the code for handling mouse enter') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
            $content .= '<textarea id="directive-mouseenter" data-type="ts"  name="directive[code][mouseenter]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['mouseenter']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';
            // TODO: EDIT --+-- FORM --|-- HOSTLISTENER --+-- MOUSE LEAVE
            $content .= '<div class="box box-warning">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('HostListener - Mouse Leave') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body pad">';
            $content .= '<p> ' . __e('Write the code for handling mouse leave') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.handlerBlaBla();</pre></div>';
            $content .= '<textarea id="directive-mouseleave" data-type="ts"  name="directive[code][mouseleave]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['mouseleave']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';
            // TODO: EDIT --+-- FORM --|-- HOSTLISTENER --+-- OTHER FUNCTIONS
            $content .= '<div class="box box-info">';
            $content .= '<div class="box-header">';
            $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Fuctions') . ' ';
            $content .= '<small>' . __e('TypeScript') . '</small>';
            $content .= '</h3>';
            $content .= '<div class="pull-right box-tools">';
            $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
            $content .= '<i class="fa fa-minus"></i></button>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box-body pad">';
            $content .= '<p> ' . __e('Write your custom functions') . '</p>';
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '<div class="example-code">Example:<pre>bla:any = {}' . "\r\n" . 'handlerBlaBla(){....}</pre></div>';
            $content .= '<textarea id="directive-other" data-type="ts"  name="directive[code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($directive_data['code']['other']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '<div class="box box-success">';
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
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/directives/' . $directive_data['prefix'] . '/' . $directive_data['prefix'] . '.directive.ts</code></p>';
            $content .= '' . $ionic_angular_html . '';
            $content .= '</div>';
            $content .= '<div class="box-footer pad">';
            $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
            $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?directive=' . $directive_data['prefix'] . '&type=ts">' . __e('View Source Code') . '</a>';
            $content .= '</div>';
            $content .= '';
            $content .= '</div> ';
            $content .= '</form>';
        } else
        {
            header("Location: ?p=directives");
        }
        break;
    case 'list':
        // TODO: LIST --+--
        // TODO: LIST --+-- BREADCRUMB
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Directives') . '</li>';
        $breadcrumb .= '</ol>';
        // TODO: LIST --+-- GENERAL
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
        $content .= '<h1>Attribute Directives</h1>';
        $content .= '<p class="lead">An Attribute directive changes the appearance or behavior of a DOM element, read more: <a target="_blank" href="https://angular.io/guide/attribute-directives">Angular Guide</a></p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="row">';
        $content .= '<div class="col-md-8">';
        // TODO: LIST --+-- CUSTOM DIRECTIVES
        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Custom Directives') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('Angular allows you to create your own custom directives, here are the directives that have been created') . ':</p>';
        $_content = null;
        $content .= '<div class="table-responsive">';
        $content .= '<table class="table table-bordered table-striped" data-type="datatable">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>';
        $content .= __e('Name');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Directive');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Description');
        $content .= '</th>';
        $content .= '<th>';
        $content .= __e('Status');
        $content .= '</th>';
        $content .= '<th style="min-width: 150px !important;width: 200px !important;">';
        $content .= '</th>';
        $content .= '</tr>';
        $content .= '</thead>';
        $content .= '<tbody>';
        foreach ($_SESSION['CURRENT_APP']['directives'] as $directive)
        {
            if (!isset($directive['desc']))
            {
                $directive['desc'] = '-';
            }
            if (!isset($directive['status']))
            {
                $directive['status'] = 'user';
            }
            $content .= '<tr>';
            $content .= '<td>';
            $content .= $directive['name'];
            $content .= '</td>';
            $content .= '<td>';
            $content .= '<label class="label label-info">' . $directive['directive'] . '</label>';
            $content .= '</td>';
            $content .= '<td>';
            $content .= $directive['desc'];
            $content .= '</td>';
            $content .= '<td>';
            switch ($directive['status'])
            {
                case 'protected':
                    $content .= '<label class="label label-default">' . $directive['status'] . '</label>';
                    break;
                case 'additional':
                    $content .= '<label class="label label-warning">' . $directive['status'] . '</label>';
                    break;
                case 'user':
                    $content .= '<label class="label label-success">' . $directive['status'] . '</label>';
                    break;
            }
            $content .= '</td>';
            $content .= '<td style="width:270px">';
            $content .= '<a target="_blank" href="./system/plugin/viewsource/?directive=' . $directive['prefix'] . '&type=ts" class="btn btn-flat btn-xs btn-success"><i class="fa fa-file-code-o"></i> ' . __e('View Source') . '</a> ';
            $content .= '<a href="#!_" data-toggle="modal" data-target="#info-directive-dialog-' . $directive['prefix'] . '" class="btn btn-flat btn-xs btn-info"><i class="fa fa-info"></i> ' . __e('Info') . '</a> ';
            $content .= '<a href="./?p=directives&a=edit&directive-name=' . $directive['prefix'] . '" class="btn btn-flat btn-xs btn-warning"><i class="fa fa fa-pencil-square-o"></i> ' . __e('Edit') . '</a> ';
            $content .= '<a href="#!_" data-toggle="modal" data-target="#delete-directive-dialog-' . $directive['prefix'] . '" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a>';
            $content .= '</td>';
            $content .= '</tr>';
            // TODO: LIST --+-- DIALOG
            $_content .= '<div class="modal fade modal-default" id="info-directive-dialog-' . $directive['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="info-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content modal-lg">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title">Info <strong>' . $directive['name'] . '</strong> <small>directive</small></h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<div style="overflow-y:scroll;height:200px;padding: 12px;">';
            $_content .= '<div>' . $directive['instruction'] . '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>&nbsp;';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal modal-md fade modal-default" id="delete-directive-dialog-' . $directive['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $_content .= '<div class="modal-dialog">';
            $_content .= '<div class="modal-content">';
            $_content .= '<div class="modal-header">';
            $_content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $_content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This Directive') . '</h4>';
            $_content .= '</div>';
            $_content .= '<div class="modal-body">';
            $_content .= '<p>' . __e('Are you sure you want to delete this directive?') . '</p>';
            $_content .= '<div class="row">';
            $_content .= '<div class="col-md-3 text-right">';
            $_content .= '<div class="icon text-center icon-confirm"><i class="fa-5x fa fa-gg"></i></div>';
            $_content .= '</div>';
            $_content .= '<div class="col-md-9 text-left">';
            $_content .= '<table class="table-confirm">';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Directive Name') . '</td>';
            $_content .= '<td>: <strong>' . $directive['name'] . '</strong></td>';
            $_content .= '</tr>';
            $_content .= '<tr>';
            $_content .= '<td>' . __e('Example Code') . '</td>';
            $_content .= '<td>: <code></code></td>';
            $_content .= '</tr>';
            $_content .= '</table>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '</div>';
            $_content .= '<div class="modal-footer">';
            $_content .= '<a href="./?p=directives&a=delete&directive-name=' . $directive['prefix'] . '&ok" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
            $_content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';
            $_content .= '</div><!-- ./modal-footer -->';
            $_content .= '</div><!-- ./modal -->';
            $_content .= '</div>';
            $_content .= '</div>';
        }
        $content .= '</tbody>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= $_content;
        $content .= '</div>';
        $content .= '<div class="box-footer">';
        $content .= '<a href="./?p=directives&a=new" class="btn btn-flat btn-danger">' . __e('Create New Directives') . '</a>&nbsp;';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|--
        $current_directives = $_SESSION['CURRENT_APP']['directives'];
        $content .= '<div class="col-md-4">';
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Additional Directives') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';
        $content .= '<div class="callout callout-info">';
        $content .= __e('Additional Directives used to add item types to menus or addons.');
        $content .= '</div>';
        $content .= '<div class="additional-directives" style="overflow-y: scroll; height:640px;padding: 15px;">';
        $content .= '<div class="panel-group" id="accordion">';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- YOUTUBE PLAYER
        $youtube_api_key = null;
        if (isset($current_directives['play-with-youtube-app']['data']))
        {
            $youtube_data = json_decode($current_directives['play-with-youtube-app']['data'], true);
            $youtube_api_key = $youtube_data['apikey'];
        }
        $youtube_collapse = '';
        if (isset($current_directives['play-with-youtube-app']))
        {
            $youtube_collapse = 'in';
        }
        $content .= '<div class="panel box box-primary">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-youtube">';
        $content .= '<i class="fa fa-youtube"></i> ' . __e('Play With Youtube App') . ' <span class="label label-info">cordova</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-youtube" class="panel-collapse collapse ' . $youtube_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= $disable_capasitor_alert;
        $content .= '<form class="form-horizontal" action="./?p=directives&a=generate&directive-name=play-with-youtube-app" method="post">';
        $content .= '<div>';
        $content .= '<p>' . __e('Plays YouTube videos in Native YouTube App') . '</p>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-4 control-label">' . __e('API Key') . '</label>';
        $content .= '<div class="col-sm-8">';
        $content .= '<input type="text" class="form-control" name="play-with-youtube-app[apikey]" required value="' . $youtube_api_key . '" placeholder="aIraSyCC6zYllOUOpKpPa3Q1chJ-P5sRVMHOo1Q" />';
        $content .= '<p class="help-block">' . __e('For more information: <a href="https://developers.google.com/youtube/v3/getting-started" target="blank">https://developers.google.com/youtube/v3/getting-started</a>') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="pull-right">';
        $content .= '<button class="btn btn-primary btn-sm ' . $disable_capasitor . '" href=""><i class="fa fa-code"></i> ' . __e('Generate Code') . '</button> &nbsp;';
        if (isset($current_directives['play-with-youtube-app']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=play-with-youtube-app&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</form>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- INSTAGRAM APP
        $instagram_collapse = '';
        if (isset($current_directives['instagram-app']))
        {
            $instagram_collapse = 'in';
        }
        $content .= '<div class="panel box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-instagram">';
        $content .= '<i class="fa fa-instagram"></i> ' . __e('Share Via Instagram') . ' <span class="label label-info">cordova</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-instagram" class="panel-collapse collapse ' . $instagram_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= $disable_capasitor_alert;
        $content .= '<div>';

        $content .= '<p>' . __e('Share a photo with the instagram app') . '</p>';
        $content .= '<div class="help-dev">*** ' . __e('Maybe this directive requires plugins: <code>cordova-plugin-androidx</code> and <code>cordova-plugin-androidx-adapter</code>') . '</div>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm ' . $disable_capasitor . '" href="./?p=directives&a=generate&directive-name=instagram-app"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['instagram-app']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=instagram-app&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- BARCODE SCANNER
        $barcode_collapse = '';
        if (isset($current_directives['barcode-scanner']))
        {
            $barcode_collapse = 'in';
        }
        $content .= '<div class="panel box box-success">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-barcode">';
        $content .= '<i class="fa fa-qrcode"></i> ' . __e('Barcode Scanner') . ' <span class="label label-info">cordova</span> <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-barcode" class="panel-collapse collapse ' . $barcode_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= $ok_capasitor_alert;
        $content .= '<div>';
        $content .= '<p>' . __e('This directive is to add a barcode scanner menu on the menu and page') . '</p>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=barcode-scanner"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['barcode-scanner']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=barcode-scanner&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- STREAMING MEDIA
        $media_collapse = '';
        if (isset($current_directives['streaming-media']))
        {
            $media_collapse = 'in';
        }
        $content .= '<div class="panel box box-warning">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-media">';
        $content .= '<i class="fa fa-file-video-o"></i> ' . __e('Streaming Media') . ' <span class="label label-info">cordova</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-media" class="panel-collapse collapse ' . $media_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= '<div>';
        $content .= '<p>' . __e('This directive is to stream audio and video in a fullscreen, native player on iOS and Android') . '</p>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=streaming-media"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['streaming-media']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=streaming-media&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- TEXT TO SPEECH
        $tts_collapse = '';
        if (isset($current_directives['text-to-speech']))
        {
            $tts_collapse = 'in';
        }
        $content .= '<div class="panel box box-danger">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-tts">';
        $content .= '<i class="fa fa-bullhorn"></i> ' . __e('Text To Speech') . ' <span class="label label-info">cordova</span>  <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-tts" class="panel-collapse collapse ' . $tts_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= '<div>';
        $content .= '<p>' . __e('This directive is to create a spoken version of the text') . '</p>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=text-to-speech"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['text-to-speech']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=text-to-speech&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- PAY-WITH-PAYPAL
        $paypal_production_client_id = '';
        $paypal_sandbox_client_id = '';
        $paypal_environment = 'PayPalEnvironmentSandbox';
        $paypal_shipping_address = 0;
        $paypal_currency = 'USD';
        if (isset($current_directives['pay-with-paypal']['data']))
        {
            $paypal_data = json_decode($current_directives['pay-with-paypal']['data'], true);
            $paypal_production_client_id = $paypal_data['production-client-id'];
            $paypal_sandbox_client_id = $paypal_data['sandbox-client-id'];
            $paypal_environment = $paypal_data['environment'];
            $paypal_shipping_address = $paypal_data['shipping-address'];
            $paypal_currency = $paypal_data['currency'];
        }
        $paypal_collapse = '';
        if (isset($current_directives['pay-with-paypal']))
        {
            $paypal_collapse = 'in';
        }
        $content .= '<div class="panel box box-gray">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-paypal">';
        $content .= '<i class="fa fa-paypal"></i> ' . __e('Pay With PayPal') . ' <span class="label label-info">cordova</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-paypal" class="panel-collapse collapse ' . $paypal_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= $disable_capasitor_alert;

        $content .= '<form class="form-horizontal" action="./?p=directives&a=generate&directive-name=pay-with-paypal" method="post">';
        $content .= '<div>';
        $content .= '<div class="alert alert-danger alert-dismissible">' . __e('Important: PayPal Mobile SDKs are Deprecated') . '</div>';


        $content .= '<p>' . __e('This directive is to create a button for pay with paypal') . '</p>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-6 control-label">' . __e('Client ID for Production') . '</label>';
        $content .= '<div class="col-sm-6">';
        $content .= '<input type="text" class="form-control" name="paypal[production-client-id]" required value="' . $paypal_production_client_id . '"/>';
        $content .= '<p class="help-block">Get code from <a target="_blank" href="https://developer.paypal.com/developer/applications">My Apps & Credentials</a> on your Paypal Dashboard</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-6 control-label">' . __e('Client ID for Sandbox') . '</label>';
        $content .= '<div class="col-sm-6">';
        $content .= '<input type="text" class="form-control" name="paypal[sandbox-client-id]" required value="' . $paypal_sandbox_client_id . '"/>';
        $content .= '<p class="help-block">Get code from <a target="_blank" href="https://developer.paypal.com/developer/applications">My Apps & Credentials</a> on your Paypal Dashboard</p>';
        $content .= '</div>';
        $content .= '</div>';
        $paypal_environment_options = array();
        $paypal_environment_options[] = array('value' => 'PayPalEnvironmentSandbox', 'label' => 'Sandbox');
        $paypal_environment_options[] = array('value' => 'PayPalEnvironmentNoNetwork', 'label' => 'No Network');
        $paypal_environment_options[] = array('value' => 'PayPalEnvironmentProduction', 'label' => 'Production');
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-6 control-label">' . __e('PayPal Environment') . '</label>';
        $content .= '<div class="col-sm-6">';
        $content .= '<select class="form-control" name="paypal[environment]" >';
        foreach ($paypal_environment_options as $paypal_environment_option)
        {
            $selected = '';
            if ($paypal_environment == $paypal_environment_option['value'])
            {
                $selected = 'selected';
            }
            $content .= '<option value="' . $paypal_environment_option['value'] . '" ' . $selected . '>' . $paypal_environment_option['label'] . '</option>';
        }
        $content .= '</select>';
        $content .= '</div>';
        $content .= '</div>';
        $paypal_shipping_address_options = array();
        $paypal_shipping_address_options[] = array('value' => '0', 'label' => 'None');
        $paypal_shipping_address_options[] = array('value' => '2', 'label' => 'PayPal');
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-6 control-label">' . __e('Shipping Address') . '</label>';
        $content .= '<div class="col-sm-6">';
        $content .= '<select class="form-control" name="paypal[shipping-address]" >';
        foreach ($paypal_shipping_address_options as $paypal_shipping_address_option)
        {
            $selected = '';
            if ($paypal_shipping_address == $paypal_shipping_address_option['value'])
            {
                $selected = 'selected';
            }
            $content .= '<option value="' . $paypal_shipping_address_option['value'] . '" ' . $selected . '>' . $paypal_shipping_address_option['label'] . '</option>';
        }
        $content .= '</select>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-6 control-label">' . __e('Currency Code') . '</label>';
        $content .= '<div class="col-sm-6">';
        $content .= '<select class="form-control" name="paypal[currency]">';
        foreach ($paypal_currencies as $cur)
        {
            $selected = '';
            if ($paypal_currency == $cur['val'])
            {
                $selected = 'selected';
            }
            $content .= '<option value="' . $cur['val'] . '" ' . $selected . '>' . $cur['label'] . ' (' . $cur['val'] . ')</option>';
        }
        $content .= '</select>';
        $content .= '<p class="help-block">' . __e('please see the currency code here: <a href="https://developer.paypal.com/docs/api/reference/currency-codes/">here</a>') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="pull-right">';
        $content .= '<button class="btn btn-primary btn-sm ' . $disable_capasitor . '" href=""><i class="fa fa-code"></i> ' . __e('Generate Code') . '</button> &nbsp;';
        if (isset($current_directives['pay-with-paypal']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=pay-with-paypal&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</form>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- SAVE-ASSET
        $save_asset_collapse = '';
        if (isset($current_directives['save-asset']))
        {
            $save_asset_collapse = 'in';
        }
        $content .= '<div class="panel box box-primary">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-save-asset">';
        $content .= '<i class="fa fa-file-pdf-o"></i> ' . __e('Save Asset') . ' <span class="label label-info">cordova</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-save-asset" class="panel-collapse collapse ' . $save_asset_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= $disable_capasitor_alert;
        $content .= '<div>';
        $content .= '<p>' . __e('Save the asset files to an Android device (Only for android platform)') . '</p>';
        $content .= '<div class="help-dev">*** ' . __e('Maybe this directive requires plugins: <code>cordova-plugin-preview-any-file</code>, <code>cordova-plugin-androidx</code> and <code>cordova-plugin-androidx-adapter</code>') . '</div>';

        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm ' . $disable_capasitor . '" href="./?p=directives&a=generate&directive-name=save-asset"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['save-asset']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=save-asset&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- X-SOCIAL-SHARING
        $social_share_collapse = '';
        if (isset($current_directives['x-social-sharing']))
        {
            $social_share_collapse = 'in';
        }
        $content .= '<div class="panel box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-social-share">';
        $content .= '<i class="fa fa-share"></i> ' . __e('X - Social Sharing') . ' <span class="label label-info">cordova</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-social-share" class="panel-collapse collapse ' . $social_share_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= $disable_capasitor_alert;
        $content .= '<div>';
        $content .= '<p>' . __e('Share text, files, images, and links via social networks, sms, and email') . '</p>';
        $content .= '<div class="help-dev">*** ' . __e('Maybe this directive requires plugins: <code>cordova-plugin-androidx</code>') . '</div>';


        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm  ' . $disable_capasitor . '" href="./?p=directives&a=generate&directive-name=x-social-sharing"><i class="fa fa-code"></i> ' . __e('Generate Code') . ' [Problem]</a>&nbsp;';
        if (isset($current_directives['x-social-sharing']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=x-social-sharing&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- TAKE-SCREENSHOT
        $take_screenshot_collapse = '';
        if (isset($current_directives['take-screenshot']))
        {
            $take_screenshot_collapse = 'in';
        }
        $content .= '<div class="panel box box-success">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-take-screenshot">';
        $content .= '<i class="fa fa-file-image-o"></i> ' . __e('Take Screenshot') . ' <span class="label label-info">cordova</span> <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-take-screenshot" class="panel-collapse collapse ' . $take_screenshot_collapse . '">';
        $content .= '<div class="panel-body">';
        //$content .= $disable_capasitor_alert;
        $content .= '<div>';
        $content .= '<p>' . __e('Take screenshots of the current screen and save them into the phone') . '</p>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm "  href="./?p=directives&a=generate&directive-name=take-screenshot"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['take-screenshot']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=take-screenshot&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- DOCUMENT-SCANNER
        $take_screenshot_collapse = '';
        if (isset($current_directives['document-scanner']))
        {
            $take_screenshot_collapse = 'in';
        }
        $content .= '<div class="panel box box-warning">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-document-scanner">';
        $content .= '<i class="fa fa-file-o"></i> ' . __e('Document Scanner') . ' <span class="label label-info">cordova</span> <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-document-scanner" class="panel-collapse collapse ' . $take_screenshot_collapse . '">';
        $content .= '<div class="panel-body">';

        $content .= '<div>';
        $content .= '<p>' . __e('This directive processes images of documents, compensating for perspective') . '</p>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=document-scanner"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['document-scanner']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=document-scanner&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- PREVIEW-ANY-FILE
        $preview_any_file_collapse = '';
        if (isset($current_directives['preview-any-file']))
        {
            $preview_any_file_collapse = 'in';
        }
        $content .= '<div class="panel box box-danger">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-preview-any-file">';
        $content .= '<i class="fa fa-file-image-o"></i> ' . __e('Preview Any File') . ' <span class="label label-info">cordova</span> <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-preview-any-file" class="panel-collapse collapse ' . $preview_any_file_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= '<div>';
        $content .= '<p>' . __e('Whatever the file is PDF document, Word document, Excel, office document, archive file, image, text, html or anything else') . '</p>';
        $content .= '<div class="help-dev">*** ' . __e('Maybe this directive requires plugins: <code>cordova-plugin-androidx</code> and <code>cordova-plugin-androidx-adapter</code>') . '</div>';

        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=preview-any-file"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['preview-any-file']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=preview-any-file&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- APP-RATE
        $app_rate_collapse = '';
        if (isset($current_directives['app-rate']))
        {
            $app_rate_collapse = 'in';
        }
        $android_package_name = $current_app['apps']['app-id'];
        $ios_app_id = '';
        $windows_store_id = '';
        if (isset($current_directives['app-rate']['data']))
        {
            $app_rate_data = json_decode($current_directives['app-rate']['data'], true);
            $android_package_name = $app_rate_data['android'];
            $ios_app_id = $app_rate_data['ios'];
            $windows_store_id = $app_rate_data['windows'];
        }
        $content .= '<div class="panel box box-gray">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-app-rate">';
        $content .= '<i class="fa fa-file-image-o"></i> ' . __e('App Rate') . ' <span class="label label-info">cordova</span> <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-app-rate" class="panel-collapse collapse ' . $app_rate_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= '<form class="form-horizontal" action="./?p=directives&a=generate&directive-name=app-rate" method="post">';
        $content .= '<div>';
        $content .= '<p>' . __e('This directive makes it easy to prompt the user to rate your app, either now, later, or never') . '</p>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-4 control-label">' . __e('Android Package Name') . '</label>';
        $content .= '<div class="col-sm-8">';
        $content .= '<input type="text" class="form-control" name="app-rate[android]" value="' . $android_package_name . '" placeholder="com.your.app.id" />';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-4 control-label">' . __e('IOS App ID') . '</label>';
        $content .= '<div class="col-sm-8">';
        $content .= '<input type="text" class="form-control" name="app-rate[ios]" value="' . $ios_app_id . '" placeholder="12312433453" />';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-4 control-label">' . __e('Windows Store ID') . '</label>';
        $content .= '<div class="col-sm-8">';
        $content .= '<input type="text" class="form-control" name="app-rate[windows]" value="' . $windows_store_id . '" placeholder="9WZDNCRFHVJL" />';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="pull-right">';
        $content .= '<button class="btn btn-primary btn-sm" href=""><i class="fa fa-code"></i> ' . __e('Generate Code') . '</button> &nbsp;';
        if (isset($current_directives['app-rate']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=app-rate&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</form>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- CLIPBOARD
        $copy_to_clipboard_collapse = '';
        if (isset($current_directives['copy-to-clipboard']))
        {
            $copy_to_clipboard_collapse = 'in';
        }
        $content .= '<div class="panel box box-primary">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h4 class="box-title">';
        $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-copy-to-clipboard">';
        $content .= '<i class="fa fa-copy-to-clipboard"></i> ' . __e('Copy To Clipboard') . ' <span class="label label-info">cordova</span>  <span class="label label-success">capasitor</span>';
        $content .= '</a>';
        $content .= '</h4>';
        $content .= '</div>';
        $content .= '<div id="collapse-copy-to-clipboard" class="panel-collapse collapse ' . $copy_to_clipboard_collapse . '">';
        $content .= '<div class="panel-body">';
        $content .= '<div>';
        $content .= '<p>' . __e('Copy Text to Clipboard') . '</p>';
        $content .= '<div class="pull-right">';
        $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=copy-to-clipboard"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
        if (isset($current_directives['copy-to-clipboard']))
        {
            $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=copy-to-clipboard&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- FILE-OPENER
        /**
         * $file_opener_collapse = '';
         * if (isset($current_directives['file-opener']))
         * {
         * $file_opener_collapse = 'in';
         * }
         * $content .= '<div class="panel box box-gray">';
         * $content .= '<div class="box-header with-border">';
         * $content .= '<h4 class="box-title">';
         * $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-file-opener">';
         * $content .= '<i class="fa fa-file-image-o"></i> ' . __e('File Opener') . ' <label>[ fileOpener ]</label>';
         * $content .= '</a>';
         * $content .= '</h4>';
         * $content .= '</div>';
         * $content .= '<div id="collapse-file-opener" class="panel-collapse collapse ' . $file_opener_collapse . '">';
         * $content .= '<div class="panel-body">';
         * $content .= '<div>';
         * $content .= '<p>' . __e('This plugin will open a file on your device file system with its default application') . '</p>';
         * $content .= '<div class="pull-right">';
         * $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=file-opener"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
         * if (isset($current_directives['file-opener']))
         * {
         * $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=file-opener&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
         * }
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         **/
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- PHOTO-VIEWER
        /**
         * 
         * $photo_viewer_collapse = '';
         * if (isset($current_directives['photo-viewer']))
         * {
         * $photo_viewer_collapse = 'in';
         * }
         * $content .= '<div class="panel panel-default">';
         * $content .= '<div class="box-header with-border">';
         * $content .= '<h4 class="box-title">';
         * $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-photo-viewer">';
         * $content .= '<i class="fa fa-file-image-o"></i> ' . __e('Photo Viewer') . ' <label>[ photoViewer ] - ISSUE</label>';
         * $content .= '</a>';
         * $content .= '</h4>';
         * $content .= '</div>';
         * $content .= '<div id="collapse-photo-viewer" class="panel-collapse collapse ' . $photo_viewer_collapse . '">';
         * $content .= '<div class="panel-body">';
         * $content .= '<div>';
         * $content .= '<p>' . __e('This directive can display your image in full screen with the ability to pan, zoom, and share the image.') . '</p>';
         * $content .= '<div class="pull-right">';
         * $content .= '<a class="btn btn-primary btn-sm" href="./?p=directives&a=generate&directive-name=photo-viewer"><i class="fa fa-code"></i> ' . __e('Generate Code') . '</a>&nbsp;';
         * if (isset($current_directives['photo-viewer']))
         * {
         * $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=photo-viewer&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
         * }
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         **/
        // TODO: LIST --+-- ADDITIONAL --|-- FORM --+-- PAY-WITH-STRIPE
        /**
         * $stripe_collapse = '';
         * if (isset($current_directives['pay-with-stripe']))
         * {
         * $stripe_collapse = 'in';
         * }
         * $publishableKey = null;
         * if (isset($current_directives['pay-with-stripe']['data']))
         * {
         * $stripe_data = json_decode($current_directives['pay-with-stripe']['data'], true);
         * $publishableKey = trim($stripe_data['publishable-key']);
         * }
         * $content .= '<div class="panel panel-default">';
         * $content .= '<div class="box-header with-border">';
         * $content .= '<h4 class="box-title">';
         * $content .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-stripe">';
         * $content .= '<i class="fa fa-cc-stripe"></i> ' . __e('Pay With Stripe') . ' <label>[ payWithStripe ]</label>';
         * $content .= '</a>';
         * $content .= '</h4>';
         * $content .= '</div>';
         * $content .= '<div id="collapse-stripe" class="panel-collapse collapse ' . $stripe_collapse . '">';
         * $content .= '<div class="panel-body">';
         * $content .= '<form class="form-horizontal" action="./?p=directives&a=generate&directive-name=pay-with-stripe" method="post">';
         * $content .= '<div>';
         * $content .= '<p>' . __e('This directive is to create a button for pay with stripe') . '</p>';
         * $content .= '<div class="form-group">';
         * $content .= '<label class="col-sm-6 control-label">' . __e('Publishable key') . '</label>';
         * $content .= '<div class="col-sm-6">';
         * $content .= '<input type="text" class="form-control" name="stripe[publishable-key]" required value="' . $publishableKey . '"/>';
         * $content .= '<p class="help-block">Get key from <a target="_blank" href="https://dashboard.stripe.com/test/apikeys">Developers</a> on your Stripe Dashboard</p>';
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '<div class="help-dev">*** ' . __e('Support testing using the <a target="blank" href="https://ionicframework.com/docs/appflow/devapp/">Ionic devApp</a> for <a target="blank" href="https://itunes.apple.com/us/app/ionic-devapp/id1233447133?ls=1&mt=8">iOS</a> and <a target="blank" href="https://play.google.com/store/apps/details?id=io.ionic.devapp">android</a>') . '</div>';
         * $content .= '<div class="pull-right">';
         * $content .= '<button class="btn btn-primary btn-sm" href=""><i class="fa fa-code"></i> ' . __e('Generate Code') . '</button> &nbsp;';
         * if (isset($current_directives['pay-with-stripe']))
         * {
         * $content .= '<a class="btn btn-danger btn-xs" href="./?p=directives&a=delete&directive-name=pay-with-stripe&ok"><i class="fa fa-trash"></i> ' . __e('Remove Code') . '</a>';
         * }
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</form>';
         * $content .= '</div>';
         * $content .= '</div>';
         * $content .= '</div>';
         **/
        $content .= '</div><!-- ./panel-group -->';
        $content .= '</div><!-- ./additional-directives -->';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        break;
        // TODO: DELETE --|--
    case 'delete':
        if (isset($_GET['ok']))
        {
            $directive_name = basename($_GET['directive-name']);
            $db->deleteDirective($directive_name);
            $db->current();
            rebuild();
            header("Location: ./?p=directives&a=list" . '&' . time());
        }
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=directives">' . __e('Directives') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Delete') . '</li>';
        $breadcrumb .= '</ol>';
        break;
        // TODO: GENERATE
    case 'generate':
        switch ($_GET['directive-name'])
        {
                // TODO: GENERATE --+-- YOUTUBE VIDEO PLAYER
            case 'play-with-youtube-app':
                $youtube_data_apikey = '';
                if (isset($_POST['play-with-youtube-app']['apikey']))
                {
                    $youtube_data_apikey = htmlentities($_POST['play-with-youtube-app']['apikey']);
                }
                $newDirectives = null;
                $newDirectives['name'] = 'Play With Youtube App';
                $newDirectives['var'] = 'play_with_youtube_app';
                $newDirectives['directive'] = 'playWithYoutubeApp';
                $newDirectives['prefix'] = 'play-with-youtube-app';
                $newDirectives['data'] = json_encode($_POST['play-with-youtube-app']);
                $newDirectives['input'][] = array('var' => 'videoId', 'type' => 'string');
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.youtubeVideoPlayer.openVideo(this.videoId);' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Youtube Video Player",null,"Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $header = "header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $subHeader = "sub header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $message = "your message"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string,subHeader:string,message:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'keyboardClose: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'backdropDismiss: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subHeader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['desc'] = 'Plays YouTube videos in Native YouTube App';
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button playWithYoutubeApp ' . "\r\n\t" . 'videoId="BiBZxr3syfU" &gt;' . "\r\n\t" . 'Play This Video' . "\r\n" . '&lt;/ion-button&gt;</pre>';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'YoutubeVideoPlayer';
                $newDirectives['modules']['angular'][$v]['var'] = 'youtubeVideoPlayer';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-youtube-video-player';
                //$newDirectives['modules']['angular'][$v]['cordova-variable'][0]['var'] = 'YouTubeDataApiKey';
                //$newDirectives['modules']['angular'][$v]['cordova-variable'][0]['val'] = $youtube_data_apikey;
                $newDirectives['modules']['angular'][$v]['cordova-preference'][0]['var'] = 'YouTubeDataApiKey';
                $newDirectives['modules']['angular'][$v]['cordova-preference'][0]['val'] = $youtube_data_apikey;
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/youtube-video-player/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
                // TODO: GENERATE --+-- INSTAGRAM APP
            case 'instagram-app':
                $newDirectives = null;
                $newDirectives['name'] = 'Instagram App';
                $newDirectives['var'] = 'instagram_app';
                $newDirectives['directive'] = 'instagramApp';
                $newDirectives['prefix'] = 'instagram-app';
                $newDirectives['input'][] = array('var' => 'image', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'caption', 'type' => 'string');
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.runInstagram(this.image, this.caption);' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Share via Instagram","Error","Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* runInstagram($image,$caption)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $image = "data:image/png;uhduhf3hfif33"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $caption = "Caption"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private runInstagram(image: string, caption: string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let myImage = image || "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAADCAIAAAA7ljmRAAAAGElEQVQIW2P4DwcMDAxAfBvMAhEQMYgcACEHG8ELxtbPAAAAAElFTkSuQmCC";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if(myImage == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'myImage = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAADCAIAAAA7ljmRAAAAGElEQVQIW2P4DwcMDAxAfBvMAhEQMYgcACEHG8ELxtbPAAAAAElFTkSuQmCC";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let myCaption = caption || "caption";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if(myCaption == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'myCaption = "caption";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.instagram.share(myImage, myCaption).then(() => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.log("Shared!");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch((error: any) => { ' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.showAlert("Share via Instagram","Canceled!","The image doesn\'t get shared!");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.error(error); ' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $header = "header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $subHeader = "sub header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $message = "your message"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string,subHeader:string,message:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'keyboardClose: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'backdropDismiss: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subHeader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['desc'] = 'Open with Instagram App';
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button instagramApp ' . "\r\n\t" . 'image="data:image/png;uhduhf3hfif33" caption="Your Caption" &gt;' . "\r\n\t" . 'Share Via Instagram' . "\r\n" . '&lt;/ion-button&gt;</pre>';
                $newDirectives['status'] = 'additional';

                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'Instagram';
                $newDirectives['modules']['angular'][$v]['var'] = 'instagram';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-instagram-plugin';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/instagram/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;

                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['cordova'] = '';


                $db->saveDirective($newDirectives);
                break;
            case 'barcode-scanner':
                // TODO: GENERATE --+-- BARCODE SCANNER
                $newDirectives = null;
                $newDirectives['name'] = 'Barcode Scanner';
                $newDirectives['var'] = 'barcode_scanner';
                $newDirectives['prefix'] = 'barcode-scanner';
                $newDirectives['directive'] = 'barcodeScanner';
                $newDirectives['desc'] = 'Scan a bar/qr code to do a search, open a link, or open a page!';
                $newDirectives['input'][] = array('var' => 'action', 'type' => 'string');
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.scanBarcode(this.action);' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* scanBarcode($action)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $action = "inlink|extlink|alert"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'public scanBarcode(action: string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let scanAction = action || "alert";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.barcodeScanner.scan({orientation:"portrait"}).then(barcodeData => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'if(barcodeData.text != ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'switch(scanAction){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'case "inlink":{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t\t" . 'this.navController.navigateRoot(barcodeData.text);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'case "extlink":{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'this.inAppBrowser.create(barcodeData.text,"_system");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'case "alert":{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(barcodeData.text);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'break;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch(err => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.log("barcodescanner", err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($text)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $text = "hi..."' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(text:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: "Barcode",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: "Result",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: text,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button barcodeScanner ' . "\r\n\t" . 'action="inlink" &gt;' . "\r\n\t" . 'Scan!' . "\r\n" . '&lt;/ion-button&gt;</pre><p>action: inlink | extlink | alert</p>';
                $newDirectives['status'] = 'additional';

                $barcode_configuration .= null;
                //$barcode_configuration .= "\t" . '<platform name="android">' . "\r\n";
                //$barcode_configuration .= "\t\t" . '<config-file parent="/manifest/application" target="AndroidManifest.xml">' . "\r\n";
                //$barcode_configuration .= "\t\t\t" . '<activity android:clearTaskOnLaunch="true" android:configChanges="orientation|keyboardHidden" android:exported="false" android:name="com.google.zxing.client.android.CaptureActivity" android:screenOrientation="landscape" android:theme="@android:style/Theme.NoTitleBar.Fullscreen" android:windowSoftInputMode="stateAlwaysHidden">' . "\r\n";
                //$barcode_configuration .= "\t\t\t\t" . '<intent-filter>' . "\r\n";
                //$barcode_configuration .= "\t\t\t\t\t" . '<action android:name="com.phonegap.plugins.barcodescanner.SCAN" />' . "\r\n";
                //$barcode_configuration .= "\t\t\t\t\t" . '<category android:name="android.intent.category.DEFAULT" />' . "\r\n";
                //$barcode_configuration .= "\t\t\t\t" . '</intent-filter>' . "\r\n";
                //$barcode_configuration .= "\t\t\t" . '</activity>' . "\r\n";
                //$barcode_configuration .= "\t\t" . '</config-file>' . "\r\n";
                //$barcode_configuration .= "\t" . '</platform>' . "\r\n";
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
                $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'NavController';
                $newDirectives['modules']['angular'][$v]['var'] = 'navController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'BarcodeScanner';
                $newDirectives['modules']['angular'][$v]['var'] = 'barcodeScanner';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'phonegap-plugin-barcodescanner';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/barcode-scanner/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['cordova-config'] = $barcode_configuration;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'streaming-media':
                // TODO: GENERATE --+-- STREAMING-MEDIA
                $newDirectives = null;
                $newDirectives['name'] = 'Streaming Media';
                $newDirectives['var'] = 'streaming_media';
                $newDirectives['prefix'] = 'streaming-media';
                $newDirectives['directive'] = 'streamingMedia';
                $newDirectives['desc'] = 'Stream audio and video in a fullscreen, native player on iOS and Android';
                $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'format', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'orientation', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'controls', 'type' => 'boolean');
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.playMedia();' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* videoOption()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private videoOption(): StreamingVideoOptions{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let mediaControls = this.controls || false ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let mediaOrientation = this.orientation || "landscape" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (mediaOrientation == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'mediaOrientation = "landscape";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let options: StreamingVideoOptions = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'successCallback:()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log("Video played");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '},' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'errorCallback:(e)=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log("Error streaming");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '},' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'orientation: mediaOrientation,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'shouldAutoClose: true' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '};' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("android")){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'if (mediaControls == true){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'options.controls = true;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'options.controls = false;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'return options;' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* audioOption()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private audioOption(): StreamingAudioOptions{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let options: StreamingAudioOptions = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'bgImage: "assets/images/background/bg.jpg",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'bgColor: "#DEBDD6",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'bgImageScale: "stretch",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'keepAwake: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'initFullscreen: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'successCallback:()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log("Audio played");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '},' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'errorCallback:(e)=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log("Error streaming");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '},' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'return options;' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* playMedia()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private playMedia(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let mediaFormat = this.format || "video" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (mediaFormat !== "audio"){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'mediaFormat = "video";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if(mediaFormat == "video"){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let options:StreamingVideoOptions = this.videoOption();' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.streamingMedia.playVideo(this.url, options);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let options:StreamingAudioOptions = this.audioOption();' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.streamingMedia.playAudio(this.url, options);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($text)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $text = "hi..."' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(text:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: "Streaming Media",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: "Information!",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: text,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button streamingMedia' . "\r\n\t" . 'format="video"' . "\r\n\t" . 'orientation="landscape"' . "\r\n\t" . 'controls="false"' . "\r\n\t" . 'url="http://yourdomain.com/video.mp4" &gt;' . "\r\n\t" . 'Play This Video!' . "\r\n" . '&lt;/ion-button&gt;</pre><p>action: inlink | extlink | alert</p>';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'StreamingMedia';
                $newDirectives['modules']['angular'][$v]['var'] = 'streamingMedia';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-streaming-media';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/streaming-media/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'StreamingVideoOptions';
                $newDirectives['modules']['angular'][$v]['var'] = '';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-streaming-media';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/streaming-media/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'StreamingAudioOptions';
                $newDirectives['modules']['angular'][$v]['var'] = '';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-streaming-media';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/streaming-media/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'text-to-speech':
                // TODO: GENERATE --+-- TEXT-TO-SPEECH
                $newDirectives = null;
                $newDirectives['name'] = 'Text To Speech';
                $newDirectives['var'] = 'text_to_speech';
                $newDirectives['prefix'] = 'text-to-speech';
                $newDirectives['directive'] = 'textToSpeech';
                $newDirectives['desc'] = 'a spoken version of the text';
                $newDirectives['input'][] = array('var' => 'text', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'locale', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'rate', 'type' => 'number');
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.speakNow();' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* speakNow()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'speakNow(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let speakText:string = this.text || "There is nothing I can read!" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (speakText == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'speakText = "There is nothing I can read!";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let speakLocale:string = this.locale || "en-GB" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (speakLocale == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'speakLocale = "en-GB";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let speakRate:number = this.rate || 1;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let option:TTSOptions = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'text: speakText,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'locale: speakLocale,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'rate: speakRate' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.textToSpeech.speak(option).then(() => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.log("Success");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch((reason: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.showAlert("Initialize text to speech, please wait a moment!");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($text)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $text = "hi..."' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(text:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: "Text To Speech",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: "Information!",' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: text,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button textToSpeech' . "\r\n\t" . 'text="Hi, my name is jasman!"' . "\r\n\t" . 'locale="id-ID"' . "\r\n\t" . 'rate="0.5" &gt;' . "\r\n\t" . 'Speak Now!' . "\r\n" . '&lt;/ion-button&gt;</pre>';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'TextToSpeech';
                $newDirectives['modules']['angular'][$v]['var'] = 'textToSpeech';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-tts';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/text-to-speech/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'TTSOptions';
                $newDirectives['modules']['angular'][$v]['var'] = '';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-tts';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/text-to-speech/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'pay-with-paypal':
                // TODO: GENERATE --+-- PAY-WITH-PAYPAL
                //$paypal_production_client_id = 'AbdI0KDO9jz0wz5Dg7-So5pyH2CtMkbHBJLW1LAvvGG0GuBAEubYJH7Ip2UJeZiqUpZaHz30WiF0BzUr';
                //$paypal_sandbox_client_id = 'AbcI0KDO9jz0wz5Dg7-So5pyH2CtMkbHBJLW1LAvvGG0GuBAEubYJH7Ip2UJeZiqUpZaHz30WiF0BzUr';
                $paypal_production_client_id = 'YOUR_PRODUCTION_CLIENT_ID';
                if (isset($_POST['paypal']['production-client-id']))
                {
                    $paypal_production_client_id = htmlentities($_POST['paypal']['production-client-id']);
                }
                $paypal_sandbox_client_id = 'YOUR_SANDBOX_CLIENT_ID';
                if (isset($_POST['paypal']['sandbox-client-id']))
                {
                    $paypal_sandbox_client_id = htmlentities($_POST['paypal']['sandbox-client-id']);
                }
                $paypal_environment = 'PayPalEnvironmentSandbox';
                if (isset($_POST['paypal']['environment']))
                {
                    $paypal_environment = htmlentities($_POST['paypal']['environment']);
                }
                $paypal_shipping_address = 0;
                if (isset($_POST['paypal']['shipping-address']))
                {
                    $paypal_shipping_address = htmlentities($_POST['paypal']['shipping-address']);
                }
                $paypal_currency = 'USD';
                if (isset($_POST['paypal']['currency']))
                {
                    $paypal_currency = htmlentities($_POST['paypal']['currency']);
                }
                $newDirectives = null;
                $newDirectives['name'] = 'Pay With PayPal';
                $newDirectives['var'] = 'pay_with_paypal';
                $newDirectives['prefix'] = 'pay-with-paypal';
                $newDirectives['directive'] = 'payWithPaypal';
                $newDirectives['data'] = json_encode($_POST['paypal']);
                $newDirectives['desc'] = 'Create a button for pay with paypal';
                $newDirectives['input'][] = array('var' => 'price', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'currency', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'info', 'type' => 'string');
                $newDirectives['code']['constructor'] = null;
                $newDirectives['code']['constructor'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t\t" . '// change this settings' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t\t" . 'this.option = {' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t\t\t" . 'environment : "' . $paypal_environment . '",' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t\t\t" . 'sandbox_client_id : "' . $paypal_sandbox_client_id . '",' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t\t\t" . 'production_client_id : "' . $paypal_production_client_id . '"' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['constructor'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.payWithPayPal();' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Pay With PayPal","information","Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'option:any = {};' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* payWithPayPal()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'payWithPayPal(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let price:string = this.price || "0" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (price == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'price = "0";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let currency:string = this.currency || "' . $paypal_currency . '" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (currency == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'currency = "' . $paypal_currency . '";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let info:string = this.info || "Buy something" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (info == ""){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'info = "Buy something";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.payPal.init({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'PayPalEnvironmentProduction: this.option.production_client_id,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'PayPalEnvironmentSandbox: this.option.sandbox_client_id' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}).then(()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.payPal.prepareToRender(this.option.environment, new PayPalConfiguration({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'acceptCreditCards: true,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'payPalShippingAddressOption: ' . $paypal_shipping_address . ',' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '})).then(()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'let payment = new PayPalPayment( price, currency, info, "sale");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.payPal.renderSinglePaymentUI(payment).then((response) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'let transactionId = response.response.id;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Pay With PayPal","Successfully paid","Transaction ID: " + transactionId);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '},()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert("Pay With PayPal","Transaction failed!","Error or render dialog closed without being successful");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '},()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.showAlert("Pay With PayPal","Error","Error in configuration");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '},()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.showAlert("Pay With PayPal","Error","Error in initialization, maybe PayPal isn\'t supported or something else");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $header = "header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $subHeader = "sub header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $message = "your message"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string,subHeader:string,message:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'keyboardClose: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'backdropDismiss: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subHeader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button payWithPaypal' . "\r\n\t" . 'price="3.3"' . "\r\n\t" . 'currency="USD"' . "\r\n\t" . 'info="Buy something" &gt;' . "\r\n\t" . 'Pay Now!' . "\r\n" . '&lt;/ion-button&gt;</pre>';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'PayPal';
                $newDirectives['modules']['angular'][$v]['var'] = 'payPal';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'com.paypal.cordova.mobilesdk';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/paypal/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'PayPalPayment';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'com.paypal.cordova.mobilesdk';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/paypal/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'PayPalConfiguration';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'com.paypal.cordova.mobilesdk';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/paypal/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
                // TODO: GENERATE --+-- PAY-WITH-STRIPE
            case 'pay-with-stripe':
                $newDirectives = null;
                $newDirectives['name'] = 'Pay With Stripe';
                $newDirectives['var'] = 'pay_with_stripe';
                $newDirectives['prefix'] = 'pay-with-stripe';
                $newDirectives['directive'] = 'payWithStripe';
                $newDirectives['data'] = json_encode($_POST['stripe']);
                $newDirectives['desc'] = 'Create a button for pay with stripe';
                //$newDirectives['input'][] = array('var' => 'stripe', 'type' => 'string');
                $newDirectives['code']['constructor'] = null;
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button payWithStripe' . "\r\n\t" . 'price="3.3"' . "\r\n\t" . 'currency="USD"' . "\r\n\t" . 'info="Buy something" &gt;' . "\r\n\t" . 'Pay Now!' . "\r\n" . '&lt;/ion-button&gt;</pre>';
                $newDirectives['status'] = 'additional';
                $newDirectives['code']['constructor'] = null;
                $newDirectives['code']['constructor'] .= "\t\t" . 'this.stripe.setPublishableKey(`' . htmlentities(trim($_POST['stripe']['publishable-key'])) . '`);' . "\r\n";
                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t" . 'this.payWithStripe();' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private payWithStripe(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let card = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'number: `4242424242424242`,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'expMonth: 12,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'expYear: 2020,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'cvc: `220`' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.stripe.createCardToken(card).then((token:any)=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch((err:any)=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Stripe';
                $newDirectives['modules']['angular'][$v]['var'] = 'stripe';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-stripe';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/stripe/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'save-asset':
                // TODO: GENERATE --+-- SAVE-ASSET
                $newDirectives = null;
                $newDirectives['name'] = 'save Asset';
                $newDirectives['var'] = 'save_asset';
                $newDirectives['directive'] = 'saveAsset';
                $newDirectives['prefix'] = 'save-asset';
                $newDirectives['input'][] = array('var' => 'fileAsset', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'folderDownload', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.saveAsset(this.fileAsset,this.folderDownload);';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* saveAsset($file,$folder)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private saveAsset(fileAsset: string, folderDownload:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let myFileAsset:string = fileAsset || `assets/pdf/file.pdf`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let myFolderDownload:string = folderDownload || `' . $string->toFilename($_SESSION['CURRENT_APP']['apps']['app-name']) . '`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let myFileName:string = myFileAsset.split("/").pop();' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let myFolder:string = myFileAsset.replace(myFileName,"");' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("android")){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let dirApp:string = this.file.applicationDirectory + `www/${myFolder}`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let dirDev:string = this.file.externalRootDirectory + `/${myFolderDownload}`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let fileName:string = myFileName || `blank`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.file.checkDir(this.file.externalRootDirectory, `${myFolderDownload}`).then(data => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log(`Directory does exist`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}).catch(err =>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log(`Error`,`checkDir`,err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.file.createDir(this.file.externalRootDirectory,`${myFolderDownload}`, false).then(data => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Directory create :`+ dirApp);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '}).catch(err => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log(`Error`,`createDir`,err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(`Error`,`Permission`,`You have to check permission for this application!`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.file.copyFile(dirApp, fileName, dirDev, fileName).then(data=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'let localURL = data.nativeURL;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.previewAnyFile.preview(localURL).then((res: any) => { ' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log(`File is opened`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '}).catch(err => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'console.log("Error opening file", err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(`Information`,`File`,localURL);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}).catch(err=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log(`Error`,`copyFile`,err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.showAlert(`Error`,`Save`,err.message);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.showAlert(`Information`,`Device`,`Only for android device!`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header,$subheader,$message)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button saveAsset ' . "\r\n\t" . 'fileAsset="assets/contatcs/support.vcf" folderDownload="my-app" &gt;' . "\r\n\t" . 'Save My Contacts!' . "\r\n" . '&lt;/ion-button&gt;</pre>' . "\r\n";
                $newDirectives['desc'] = 'Download file assets move to your device;';
                $newDirectives['status'] = 'additional';

                $_configuration = null;
                $_configuration .= "\t" . '<platform name="android">' . "\r\n";
                $_configuration .= "\t\t" . '<preference name="AndroidPersistentFileLocation" value="Compatibility" />' . "\r\n";
                $_configuration .= "\t\t" . '<edit-config file="app/src/main/AndroidManifest.xml" mode="merge" target="/manifest/application" >' . "\r\n";
                $_configuration .= "\t\t\t" . '<application android:requestLegacyExternalStorage="true" />' . "\r\n";
                $_configuration .= "\t\t" . '</edit-config>' . "\r\n";
                $_configuration .= "\t" . '</platform>' . "\r\n";

                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
                $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;

                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;


                $v++;
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';

                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'PreviewAnyFile';
                $newDirectives['modules']['angular'][$v]['var'] = 'previewAnyFile';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-preview-any-file';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/preview-any-file/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;


                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'File';
                $newDirectives['modules']['angular'][$v]['var'] = 'file';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-file';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/file/ngx';
                $newDirectives['modules']['angular'][$v]['cordova-config'] = $_configuration;
                $newDirectives['modules']['angular'][$v]['enable'] = true;


                $db->saveDirective($newDirectives);
                break;
            case 'x-social-sharing':
                // TODO: GENERATE --+-- X-SOCIAL-SHARING
                $newDirectives = null;
                $newDirectives['name'] = 'X Social Sharing';
                $newDirectives['var'] = 'x_social_sharing';
                $newDirectives['directive'] = 'xSocialSharing';
                $newDirectives['prefix'] = 'x-social-sharing';
                $newDirectives['input'][] = array('var' => 'message', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'subject', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'file', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'title', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'appPackageName', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.socialShare();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* socialShare()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private socialShare(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let message = this.message || `Share This`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let subject = this.subject || `' . $_SESSION['CURRENT_APP']['apps']['app-name'] . '`;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let file = this.file || null;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let url = this.url || null;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let chooserTitle = this.title || null;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let options = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subject: subject,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'files: [file],' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'url: url,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'chooserTitle: chooserTitle,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '};' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.socialSharing.shareWithOptions(options).then(()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch(() =>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button xSocialSharing' . "\r\n\t" . ' message="Share This"' . "\r\n\t" . ' subject="The Subject"' . "\r\n\t" . ' file=""' . "\r\n\t" . ' url="https://www.website.com/foo/#bar?a=b"' . "\r\n\t" . ' title="Pick an app"' . "\r\n\t" . ' appPackageName="com.apple.social.facebook" >' . "\r\n\t" . 'Share This' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['desc'] = 'Share text, files, images, and links via social networks, sms, and email';
                $newDirectives['status'] = 'additional';

                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'SocialSharing';
                $newDirectives['modules']['angular'][$v]['var'] = 'socialSharing';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-x-socialsharing';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/social-sharing/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;


                $v++;
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';


                $db->saveDirective($newDirectives);
                break;
            case 'take-screenshot':
                // TODO: GENERATE --+-- TAKE-SCREENSHOT
                $newDirectives = null;
                $newDirectives['name'] = 'Take Screenshot';
                $newDirectives['var'] = 'take_screenshot';
                $newDirectives['directive'] = 'takeScreenshot';
                $newDirectives['prefix'] = 'take-screenshot';
                $newDirectives['input'][] = array('var' => 'fileName', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.takeScreenshot();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* takeScreenshot()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private takeScreenshot(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let name = `' . $string->toFileName($_SESSION['CURRENT_APP']['apps']['app-name']) . '-screenshot-` + Date.now();' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let fileName = this.fileName || name; ' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'setTimeout(()=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.screenshot.save("jpg", 80, fileName).then((data)=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.showAlert(`Successfully`,`filename:`,data.filePath,data.filePath);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}).catch((err) =>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'this.showAlert(`Error`,null,`This feature cannot run on your device, please use the Screenshot Button available on your device`,null);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'console.log(err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '},500);' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header,$subheader,$message,$url)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string, url:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const showAlert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: [{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'text: `Okay`,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'handler: () => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'if(url != null){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'this.previewAnyFile.preview(`file://${url}`).then((res: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t\t" . 'console.log(`File is opened`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . '}).catch(err => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t\t" . 'console.log("Error opening file", err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t\t" . 'alert(`Cannot open file!`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . '};' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await showAlert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button takeScreenshot>' . "\r\n\t" . 'Take Screenshot' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['desc'] = 'Captures a screen shot';

                $newDirectives['status'] = 'additional';
                $_configuration = null;
                $_configuration .= "\t" . '<platform name="android">' . "\r\n";
                $_configuration .= "\t\t" . '<edit-config file="app/src/main/AndroidManifest.xml" mode="merge" target="/manifest/application" >' . "\r\n";
                $_configuration .= "\t\t\t" . '<application android:requestLegacyExternalStorage="true" />' . "\r\n";
                $_configuration .= "\t\t" . '</edit-config>' . "\r\n";
                $_configuration .= "\t" . '</platform>' . "\r\n";

                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'Screenshot';
                $newDirectives['modules']['angular'][$v]['var'] = 'screenshot';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'com.darktalker.cordova.screenshot';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/screenshot/ngx';
                $newDirectives['modules']['angular'][$v]['cordova-config'] = $_configuration;
                $newDirectives['modules']['angular'][$v]['capasitor-note'] = 'Required to add this code to <code>AndroidManifest.xml</code> file, example: &lt;application ... <code>android:requestLegacyExternalStorage="true"</code> ... /&gt;';
                $newDirectives['modules']['angular'][$v]['enable'] = true;

                $v++;
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';


                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'PreviewAnyFile';
                $newDirectives['modules']['angular'][$v]['var'] = 'previewAnyFile';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-preview-any-file';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/preview-any-file/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;


                $db->saveDirective($newDirectives);
                break;
            case 'document-scanner':
                // TODO: GENERATE --+-- DOCUMENT-SCANNER
                $newDirectives = null;
                $newDirectives['name'] = 'Document Scanner';
                $newDirectives['var'] = 'document_scanner';
                $newDirectives['directive'] = 'documentScanner';
                $newDirectives['prefix'] = 'document-scanner';
                $newDirectives['input'][] = array('var' => 'fileName', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.takeScanner();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* takeScanner()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private takeScanner(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let name = `' . $string->toFileName($_SESSION['CURRENT_APP']['apps']['app-name']) . '-docscanner-` + Date.now();' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let fileName = this.fileName || name;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let options = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'sourceType : 1,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'fileName : fileName, // iOS only' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'quality : 1.0,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'returnBase64 :false' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '};' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.documentScanner.scanDoc(options).then((url: string)=>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.showAlert(`Successfully`,`filename:`,url,url);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch((err:any) =>{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.log(err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header,$subheader,$message,$url)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string, url:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: [{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'text: `Okay`,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'handler: () => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'this.previewAnyFile.preview(`file://${url}`).then((res: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'console.log(`File is opened`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . '}).catch(err => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t\t" . 'console.log("Error opening file", err);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button documentScanner fileName="myFile">' . "\r\n\t" . 'Scan!' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['instruction'] .= '<p>attributes fileName only for IOS</p>' . "\r\n";
                $newDirectives['desc'] = 'This directives processes images of documents, compensating for perspective';
                $newDirectives['status'] = 'additional';

                $_configuration = null;
                $_configuration .= "\t" . '<platform name="android">' . "\r\n";
                $_configuration .= "\t\t" . '<edit-config file="app/src/main/AndroidManifest.xml" mode="merge" target="/manifest/application" >' . "\r\n";
                $_configuration .= "\t\t\t" . '<application android:requestLegacyExternalStorage="true" />' . "\r\n";
                $_configuration .= "\t\t" . '</edit-config>' . "\r\n";
                $_configuration .= "\t" . '</platform>' . "\r\n";


                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'DocumentScanner';
                $newDirectives['modules']['angular'][$v]['var'] = 'documentScanner';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-document-scanner';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/document-scanner/ngx';
                $newDirectives['modules']['angular'][$v]['cordova-config'] = $_configuration;
                $newDirectives['modules']['angular'][$v]['capasitor-note'] = 'Required to add this code to <code>AndroidManifest.xml</code> file, example: &lt;application ... <code>android:requestLegacyExternalStorage="true"</code> ... /&gt;';

                $newDirectives['modules']['angular'][$v]['enable'] = true;

                $v++;
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';


                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'PreviewAnyFile';
                $newDirectives['modules']['angular'][$v]['var'] = 'previewAnyFile';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-preview-any-file';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/preview-any-file/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;


                $db->saveDirective($newDirectives);
                break;
            case 'photo-viewer':
                // TODO: GENERATE --+-- PHOTO-VIEWER
                $newDirectives = null;
                $newDirectives['name'] = 'Photo Viewer';
                $newDirectives['var'] = 'photo_viewer';
                $newDirectives['directive'] = 'photoViewer';
                $newDirectives['prefix'] = 'photo-viewer';
                $newDirectives['input'][] = array('var' => 'src', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.viewPhoto();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* viewPhoto()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private viewPhoto(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let source = this.src || "assets/images/placeholder-800x600.png" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'try {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.photoViewer.show(source);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.log(`photoViewer`,source);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}catch(error){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.log(`photoViewer`,error);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button photoViewer src="http://your/file/jpg">' . "\r\n\t" . 'view!' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['desc'] = 'This directives processes images of documents, compensating for perspective';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'PhotoViewer';
                $newDirectives['modules']['angular'][$v]['var'] = 'photoViewer';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'com-sarriaroman-photoviewer';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/photo-viewer/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'preview-any-file':
                // TODO: GENERATE --+-- PREVIEW-ANY-FILE
                $newDirectives = null;
                $newDirectives['name'] = 'Preview Any File';
                $newDirectives['var'] = 'preview_any_file';
                $newDirectives['directive'] = 'previewAnyFile';
                $newDirectives['prefix'] = 'preview-any-file';
                $newDirectives['input'][] = array('var' => 'src', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.preview();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* preview()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private preview(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let source = this.src || "assets/images/placeholder-800x600.png" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.previewAnyFile.preview(source).then((res: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.error(`directives`,`previewAnyFile`,res);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch((error: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.error(`directives`,`previewAnyFile`,error);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button previewAnyFile src="http://your/file/jpg">' . "\r\n\t" . 'view!' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['desc'] = 'Whatever the file is PDF document, Word document, Excel, office document,zip archive file, image, text, html or anything else';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'PreviewAnyFile';
                $newDirectives['modules']['angular'][$v]['var'] = 'previewAnyFile';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-preview-any-file';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/preview-any-file/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'file-opener':
                // TODO: GENERATE --+-- FILE-OPENER
                $newDirectives = null;
                $newDirectives['name'] = 'File Opener';
                $newDirectives['var'] = 'file_opener';
                $newDirectives['directive'] = 'fileOpener';
                $newDirectives['prefix'] = 'file-opener';
                $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'mimeType', 'type' => 'string');
                $newDirectives['code']['click'] = "" . 'this.openFile();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* openFile()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private openFile(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let url = this.url || "" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'let mimetype = this.mimeType || "application/pdf" ;' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.fileOpener.showOpenWithDialog(url,mimetype).then((res: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.error(`directives`,`fileOpener`,res);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}).catch((error: any) => {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'console.error(`directives`,`fileOpener`,error);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button fileOpener mimeType="application/pdf" url="http://your/file/pdf">' . "\r\n\t" . 'view!' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['desc'] = 'This directive will open a file on your device file system with its default application';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'File';
                $newDirectives['modules']['angular'][$v]['var'] = 'file';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-file';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/file/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'FileOpener';
                $newDirectives['modules']['angular'][$v]['var'] = 'fileOpener';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-file-opener2';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/file-opener/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'UrlSerializer';
                $newDirectives['modules']['angular'][$v]['path'] = '@angular/router';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'UrlTree';
                $newDirectives['modules']['angular'][$v]['path'] = '@angular/router';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'DefaultUrlSerializer';
                $newDirectives['modules']['angular'][$v]['path'] = '@angular/router';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);
                break;
            case 'app-rate':
                // TODO: GENERATE --+-- APP-RATE
                $newDirectives = null;
                $newDirectives['name'] = 'App Rate';
                $newDirectives['var'] = 'app_rate';
                $newDirectives['directive'] = 'appRate';
                $newDirectives['prefix'] = 'app-rate';
                $newDirectives['input'][] = array('var' => 'ios', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'android', 'type' => 'string');
                $newDirectives['input'][] = array('var' => 'windows', 'type' => 'string');
                if ($_POST['app-rate']['android'] == '')
                {
                    $_POST['app-rate']['android'] = $current_app['apps']['app-id'];
                }
                $newDirectives['data'] = json_encode($_POST['app-rate']);
                $newDirectives['code']['click'] = "" . 'this.rateApp();';
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* rateApp()' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private rateApp(){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let iosAppId = this.ios || "' . htmlentities($_POST['app-rate']['ios']) . '";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let androidAppId = this.android || "' . htmlentities($_POST['app-rate']['android']) . '";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'let windowsAppId = this.windows || "' . htmlentities($_POST['app-rate']['windows']) . '";' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.appRate.preferences = {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'usesUntilPrompt: 3,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . 'storeAppURL : {' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'ios: `${iosAppId}`,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'android: `market://details?id=${androidAppId}`,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'windows: `ms-windows-store://review/?ProductId=${windowsAppId}`' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.appRate.promptForRating(true);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'this.showAlert(`Information`,`Device`,`Only works on real devices!`);' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header,$subheader,$message)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p>' . "\r\n";
                $newDirectives['instruction'] .= '<pre>' . htmlentities('<ion-button appRate ios="" android="com.yourapp.id" windows="">' . "\r\n\t" . 'Rate this App!' . "\r\n" . '</ion-button>') . '</pre>' . "\r\n";
                $newDirectives['desc'] = 'The AppRate directive makes it easy to prompt the user to rate your app, either now, later, or never';
                $newDirectives['status'] = 'additional';
                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'AppRate';
                $newDirectives['modules']['angular'][$v]['var'] = 'appRate';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-apprate';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/app-rate/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $v++;
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $db->saveDirective($newDirectives);
                break;
                // TODO: GENERATE --+-- CLIPBOARD
            case 'copy-to-clipboard':
                $newDirectives = null;
                $newDirectives['name'] = 'Copy To Clipboard';
                $newDirectives['var'] = 'copy_to_clipboard';
                $newDirectives['directive'] = 'copyToClipboard';
                $newDirectives['prefix'] = 'copy-to-clipboard';
                $newDirectives['input'][] = array('var' => 'text', 'type' => 'string');

                $newDirectives['code']['click'] = null;
                $newDirectives['code']['click'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . 'if (this.platform.is("cordova")){' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.runClipboard(this.text);' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Copy Text To Clipboard","Successfully","You have successfully copied the text to the clipboard");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}else{' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t\t" . 'this.showAlert("Copy Text To Clipboard","Error","Only support on real Device!");' . "\r\n";
                $newDirectives['code']['click'] .= "\t\t" . '}' . "\r\n";
                $newDirectives['code']['other'] = null;
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* runClipboard($text)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $text = "lorem ipsum"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'private runClipboard(text:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'this.clipboard.copy(text);' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";

                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* showAlert($header)' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $header = "header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $subHeader = "sub header"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '* @param string $message = "your message"' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . 'async showAlert(header:string,subHeader:string,message:string){' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'keyboardClose: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'backdropDismiss: false,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'subHeader: subHeader,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t\t" . 'buttons: ["OK"]' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . '});' . "\r\n";
                $newDirectives['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
                $newDirectives['code']['other'] .= "\t" . '' . "\r\n";


                $newDirectives['desc'] = 'Copy text to clipboard';
                $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button copyToClipboard ' . "\r\n\t" . 'text="Lorem ipsum" &gt;' . "\r\n\t" . 'Copy' . "\r\n" . '&lt;/ion-button&gt;</pre>';
                $newDirectives['status'] = 'additional';

                $v = 0;
                $newDirectives['modules']['angular'][$v]['class'] = 'Clipboard';
                $newDirectives['modules']['angular'][$v]['var'] = 'clipboard';
                $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-clipboard';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/clipboard/ngx';
                $newDirectives['modules']['angular'][$v]['enable'] = true;

                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
                $newDirectives['modules']['angular'][$v]['var'] = 'platform';
                $newDirectives['modules']['angular'][$v]['cordova'] = '';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;

                $v++;
                $newDirectives['modules']['angular'][$v]['class'] = 'AlertController';
                $newDirectives['modules']['angular'][$v]['var'] = 'alertController';
                $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
                $newDirectives['modules']['angular'][$v]['enable'] = true;
                $db->saveDirective($newDirectives);

                break;
        }
        $db->current();
        rebuild();
        header("Location: ./?p=directives&a=list" . '&' . time());
        break;
}
// TODO: JS-CODE
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
$template->page_title = __e('(IMAB) Directives');
$template->page_desc = __e('Markers on a DOM element');
$template->page_content = $content;
$template->page_js = $page_js;

?>