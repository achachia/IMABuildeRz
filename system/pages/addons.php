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
$content = $breadcrumb = $form_content = $page_js = null;
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ./?');
}

$db = new jsmDatabase();
$current_app = $db->current();
$addons_dir = JSM_PATH . '/addons';
$color_names = $_SESSION['_COLOR_NAME'];


if (isset($_GET['addons']))
{
    $current_addons = basename($_GET['addons']);
    $current_fileinfo = $addons_dir . '/' . $current_addons . '/' . $current_addons . '.json';
    if (file_exists($current_fileinfo))
    {
        $current_addons_info = json_decode(file_get_contents($current_fileinfo), true);
        if (!isset($current_addons_info['version']))
        {
            $current_addons_info['version'] = '0.0.0';
        }
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=addons">' . __e('Add-ons') . '</a></li>';
        $breadcrumb .= '<li class="active">' . $current_addons_info['name'] . '</li>';
        $breadcrumb .= '</ol>';

        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Extensions') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body">';


        $content .= '<div class="well">' . "\r\n";

        $content .= '<div class="row">' . "\r\n";
        $content .= '<div class="col-md-6">' . "\r\n";
        $content .= '<h1>' . ($current_addons_info['name']) . ' <small>v' . __e($current_addons_info['version']) . '</small></h1>' . "\r\n";
        $content .= '<p class="lead" style="width: 50%;">' . __e($current_addons_info['desc']) . '</p>' . "\r\n";
        $content .= '<address>' . "\r\n";
        $content .= 'by <a href="mailto:' . $current_addons_info['email'] . '"><strong>' . $current_addons_info['author'] . '</strong></a> ' . "\r\n";
        $content .= '(' . $current_addons_info['company'] . ')' . "\r\n";
        $content .= '</address>' . "\r\n";
        $content .= '</div>' . "\r\n";

        $content .= '<div class="col-md-6">' . "\r\n";

        $content .= '<div class="" style="text-align: right;">' . "\r\n";
        $x = 0;
        foreach (glob($addons_dir . '/' . $current_addons . "/screenshot*") as $img_src)
        {
            $content .= '<img style="height: 240px;" class="img-thumbnail" src="./addons/' . $current_addons . '/' . basename($img_src) . '" alt="#" />&nbsp;';
            $x++;
            if ($x == 3)
            {
                break;
            }
        }
        $content .= '</div>' . "\r\n";
        $content .= '</div>' . "\r\n";

        $content .= '</div>' . "\r\n"; //row


        $content .= '</div>' . "\r\n";

        $content .= '</div>' . "\r\n";
        $content .= '</div>' . "\r\n";

        $file_includes = $addons_dir . '/' . $current_addons . '/' . $current_addons . '.php';
        if (file_exists($file_includes))
        {
            require_once $file_includes;
        }

    } else
    {
        header('Location: ./?p=addons&n=error');
    }
} else
{
    $breadcrumb = null;
    $breadcrumb .= '<ol class="breadcrumb">';
    $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
    $breadcrumb .= '<li class="active">' . __e('Add-ons') . '</li>';
    $breadcrumb .= '</ol>';

    if (!file_exists($addons_dir))
    {
        if (!mkdir($addons_dir, 0777, true))
        {
            die("Permission denied");
        }
    }
    $_addons_html = null;
    $full_action = false;

    $_addons_html .= '<!-- addons -->' . "\r\n";
    foreach (glob($addons_dir . "/*") as $filename)
    {
        $basename = pathinfo($filename, PATHINFO_FILENAME);
        $addons_fileinfo = $filename . '/' . $basename . '.json';
        $addons_filelogo = $filename . '/logo.png';
        $addons_fileheader = $filename . '/header.png';

        if (file_exists($addons_fileinfo))
        {

            $addons_info = json_decode(file_get_contents($addons_fileinfo), true);
            $addons_logo = './templates/default/assets/img/addons-logo.png';
            $addons_header = './templates/default/assets/img/addons-header.png';
            if ($addons_info['version'] != '1.0.0')
            {
                if (file_exists($addons_filelogo))
                {
                    $addons_logo = './addons/' . $basename . '/logo.png';
                }
                if (file_exists($addons_fileheader))
                {
                    $addons_header = './addons/' . $basename . '/header.png';
                }

                if (!isset($addons_info['version']))
                {
                    $addons_info['version'] = '0.0.0';
                }
                if (!isset($addons_info['name']))
                {
                    $addons_info['name'] = 'Broken';
                }
                if (!isset($addons_info['author']))
                {
                    $addons_info['author'] = 'Unknow';
                }
                if (!isset($addons_info['prefix']))
                {
                    $addons_info['prefix'] = $basename;
                }
                if (!isset($addons_info['desc']))
                {
                    $addons_info['desc'] = 'Unknow';
                }
                if (!isset($addons_info['full-action']))
                {
                    $addons_info['full-action'] = false;
                }


                $full_action_html = '';
                if ($addons_info['full-action'] == true)
                {
                    $full_action_html = '<div class="full-action">' . __e('Full Action') . '</div>';
                }

                $_addons_html .= '<div class="col-md-4">' . "\r\n";
                $_addons_html .= '<div class="box-addons box box-widget widget-user">' . "\r\n";
                $_addons_html .= $full_action_html;
                $_addons_html .= '<div class="widget-user-header bg-aqua-active" style="background-image: url(\'' . $addons_header . '\');">' . "\r\n";
                $_addons_html .= '<h3 class="widget-user-username">' . $addons_info['name'] . '</h3>' . "\r\n";
                $_addons_html .= '<h5 class="widget-user-desc">' . __e('by') . ' ' . $addons_info['author'] . '</h5>' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";

                $_addons_html .= '<div class="widget-user-image">' . "\r\n";
                $_addons_html .= '<img class="img-circle" src="' . $addons_logo . '" alt="Logo Module">' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";


                $_addons_html .= '<div class="box-footer">' . "\r\n";


                if (isset($addons_info['categories']))
                {
                    $_addons_html .= '<h4 style="font-weight: 600;">' . "\r\n";
                    $_addons_html .= __e($addons_info['categories']) . "\r\n";
                    $_addons_html .= '</h4>' . "\r\n";

                }

                $_addons_html .= '<blockquote style="font-size: 14px;padding: 10px 10px;">' . "\r\n";
                $_addons_html .= '<p>' . "\r\n";
                $_addons_html .= substr(__e($addons_info['desc']), 0, 100) . '...' . "\r\n";
                $_addons_html .= '</p>' . "\r\n";
                $_addons_html .= '<footer>' . __e('Version') . ': <cite title="' . $addons_info['version'] . '">' . $addons_info['version'] . '</cite></footer>' . "\r\n";
                $_addons_html .= '</blockquote>' . "\r\n";

                $_addons_html .= '<a href="./?p=addons&addons=' . $addons_info['prefix'] . '" class="btn pull-left btn-flat bg-maroon"><i class="fa fa-crosshairs"></i> ' . __e('Choose') . '</a>' . "\r\n";
                $_addons_html .= '<div class="pull-right">' . "\r\n";
                $_addons_html .= '<div class="btn-group-sm btn-group">' . "\r\n";
                $_addons_html .= '<button class="btn btn-default" data-toggle="modal" data-target="#modal-' . $addons_info['prefix'] . '"><i class="fa fa-file-image-o"></i> ' . __e('Screenshot') . '</button>' . "\r\n";
                $_addons_html .= '<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">' . "\r\n";
                $_addons_html .= '<span class="caret"></span>' . "\r\n";
                $_addons_html .= '<span class="sr-only">Toggle Dropdown</span>' . "\r\n";
                $_addons_html .= '</button>' . "\r\n";
                $_addons_html .= '<ul class="dropdown-menu" role="menu">' . "\r\n";
                $_addons_html .= '<li><a href="#!_" data-toggle="modal" data-target="#modal-' . $addons_info['prefix'] . '">' . __e('Screenshot') . '</a></li>' . "\r\n";
                $_addons_html .= '</ul>' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";

                $_addons_html .= '<div class="modal-addons modal fade" id="modal-' . $addons_info['prefix'] . '" tabindex="-1" role="dialog" aria-labelledby="modal-' . $addons_info['prefix'] . '" aria-hidden="true">' . "\r\n";
                $_addons_html .= '<div class="modal-dialog">' . "\r\n";
                $_addons_html .= '<div class="modal-content">' . "\r\n";
                $_addons_html .= '<div class="modal-body">' . "\r\n";

                $_addons_html .= '<div id="carousel-' . $addons_info['prefix'] . '" class="carousel slide" data-ride="carousel">' . "\r\n";


                $_addons_html .= '<ol class="carousel-indicators">' . "\r\n";
                $c = 0;
                $no_screenshot = true;
                foreach (glob($filename . "/screenshot*") as $img_src)
                {
                    $no_screenshot = false;
                    $_active = '';
                    if ($c == 0)
                    {
                        $_active = 'active';
                    }
                    $_addons_html .= '<li data-target="#carousel-' . $addons_info['prefix'] . '" data-slide-to="' . $c . '" class="' . $_active . '"></li>' . "\r\n";
                    $c++;
                }
                if ($no_screenshot == true)
                {
                    $_addons_html .= '<li data-target="#carousel-' . $addons_info['prefix'] . '" data-slide-to="0" class="active"></li>' . "\r\n";
                }
                $_addons_html .= '</ol>' . "\r\n";


                $_addons_html .= '<div class="carousel-inner">' . "\r\n";
                $c = 0;
                foreach (glob($filename . "/screenshot*") as $img_src)
                {
                    $_active = '';
                    if ($c == 0)
                    {
                        $_active = 'active';
                    }
                    $_addons_html .= '<div class="item ' . $_active . '">' . "\r\n";
                    $_addons_html .= '<img src="./addons/' . $basename . '/' . basename($img_src) . '" alt="#" />';
                    $_addons_html .= '</div>' . "\r\n";
                    $c++;
                }
                if ($no_screenshot == true)
                {
                    $_addons_html .= '<div class="item active">' . "\r\n";
                    $_addons_html .= '<img src="./templates/default/assets/img/addons-screenshot.png" alt="#" />';
                    $_addons_html .= '</div>' . "\r\n";
                }
                $_addons_html .= '</div>' . "\r\n";


                $_addons_html .= '<a class="left carousel-control" href="#carousel-' . $addons_info['prefix'] . '" data-slide="prev">' . "\r\n";
                $_addons_html .= '<span class="glyphicon glyphicon-chevron-left"></span>' . "\r\n";
                $_addons_html .= '</a>' . "\r\n";
                $_addons_html .= '<a class="right carousel-control" href="#carousel-' . $addons_info['prefix'] . '" data-slide="next">' . "\r\n";
                $_addons_html .= '<span class="glyphicon glyphicon-chevron-right"></span>' . "\r\n";
                $_addons_html .= '</a>' . "\r\n";

                $_addons_html .= '</div>' . "\r\n";


                $_addons_html .= '</div><!-- ./modal-body -->' . "\r\n";
                $_addons_html .= '<div class="modal-footer">' . "\r\n";
                $_addons_html .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e('Close') . '</button>' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";

                $_addons_html .= '</div><!-- ./modal-content -->' . "\r\n";
                $_addons_html .= '</div><!-- ./modal-dialog -->' . "\r\n";
                $_addons_html .= '</div><!-- ./modal -->' . "\r\n";


                $_addons_html .= '</div>' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";
                $_addons_html .= '</div>' . "\r\n";
            }
        }
    }
    $_addons_html .= '<!-- ./addons -->' . "\r\n";
    if (!isset($_SESSION['CURRENT_APP']['addons']))
    {
        $_SESSION['CURRENT_APP']['addons'] = array();
    }
    $_recent_html = null;

    $_recent_html .= '<div class="responsive">';
    $_recent_html .= '<table class="table table-striped" data-type="datatable">';
    $_recent_html .= '<thead>';
    $_recent_html .= '<tr>';
    $_recent_html .= '<th>' . __e('Page Target') . '</th>';
    $_recent_html .= '<th>' . __e('Page Title') . '</th>';
    $_recent_html .= '<th>' . __e('Last Modified') . '</th>';
    $_recent_html .= '<th>' . __e('Add-ons Used') . '</th>';
    $_recent_html .= '<th>' . __e('') . '</th>';
    $_recent_html .= '</tr>';
    $_recent_html .= '</thead>';
    $_recent_html .= '<tbody>';
    foreach (array_keys($_SESSION['CURRENT_APP']['addons']) as $key_addons_used)
    {
        $addons_name_used = $key_addons_used;
        foreach ($_SESSION['CURRENT_APP']['addons'][$key_addons_used] as $page_used)
        {
            if (!isset($page_used['page-title']))
            {
                $page_used['page-title'] = 'core';
            }
            if (!isset($page_used['page-target']))
            {
                $page_used['page-target'] = 'core';
            }
            $page_target_used = $page_used['page-target'];
            $edit_link = '?p=addons&amp;addons=' . $addons_name_used . '&amp;page-target=' . $page_target_used . '&amp;a=edit';
            $_recent_html .= '<tr>';
            $_recent_html .= '<td><a class="btn btn-link" href="' . $edit_link . '">' . $page_used['page-target'] . '</a></td>';
            $_recent_html .= '<td><code>' . $page_used['page-title'] . '</code></td>';
            if (!isset($page_used['date-modified']))
            {
                $page_used['date-modified'] = 0;
            }

            $modified = date("Y-m-d H:i:s", $page_used['date-modified']);
            $_recent_html .= '<td><code>' . $modified . '</code></td>';

            $_recent_html .= '<td><span class="label label-success">' . $addons_name_used . '</span></td>';
            $_recent_html .= '<td><a class="btn btn-danger btn-flat btn-sm" href="' . $edit_link . '"><i class="fa fa-pencil"></i> ' . __e('Edit') . '</a></td>';
            $_recent_html .= '</tr>';
        }
    }
    $_recent_html .= '</tbody>';
    $_recent_html .= '</table>';
    $_recent_html .= '</div>';


    $_manage_html = null;
    $_manage_html .= '<div class="responsive">';
    $_manage_html .= '<table class="table table-striped" data-type="datatable">';

    $_manage_html .= '<thead>';
    $_manage_html .= '<tr>';
    $_manage_html .= '<th>' . __e('Name') . '</th>';
    $_manage_html .= '<th>' . __e('Version') . '</th>';
    $_manage_html .= '<th>' . __e('Desciption') . '</th>';
    $_manage_html .= '<th>' . __e('Author') . '</th>';
    $_manage_html .= '<th>' . __e('Company') . '</th>';
    $_manage_html .= '<th>' . __e('Email') . '</th>';
    $_manage_html .= '<th>' . __e('More') . '</th>';
    $_manage_html .= '</tr>';
    $_manage_html .= '</thead>';

    $_manage_html .= '<tbody>';
    foreach (glob($addons_dir . "/*") as $filename)
    {
        $basename = pathinfo($filename, PATHINFO_FILENAME);
        $addons_fileinfo = $filename . '/' . $basename . '.json';
        $addons_filelogo = $filename . '/logo.png';
        $addons_fileheader = $filename . '/header.png';
        if (file_exists($addons_fileinfo))
        {
            $addons_info = json_decode(file_get_contents($addons_fileinfo), true);


            $_manage_html .= '<tr>';

            $_manage_html .= '<td>';
            $_manage_html .= '<a href="./?p=addons&addons=' . $addons_info['prefix'] . '" class="">' . $addons_info['name'] . '</a>';
            $_manage_html .= '</td>';


            if ($addons_info['version'] == '1.0.0')
            {
                $_manage_html .= '<td>';
                $_manage_html .= '<label class="label label-danger">' . __e('Experimental') . '</label>';
                $_manage_html .= '</td>';
            } else
            {
                $_manage_html .= '<td>';
                $_manage_html .= '<label class="label label-success">' . $addons_info['version'] . '</label>';
                $_manage_html .= '</td>';
            }


            $_manage_html .= '<td>';
            $_manage_html .= $addons_info['desc'];
            $_manage_html .= '</td>';

            $_manage_html .= '<td>';
            $_manage_html .= $addons_info['author'];
            $_manage_html .= '</td>';

            $_manage_html .= '<td>';
            $_manage_html .= $addons_info['company'];
            $_manage_html .= '</td>';

            $_manage_html .= '<td>';
            $_manage_html .= $addons_info['email'];
            $_manage_html .= '</td>';

            $_manage_html .= '<td>';
            $_manage_html .= '<a class="btn btn-danger" target="_blank" href="https://ihsana.com/imabuilder3/?/addons/search/' . $addons_info['prefix'] . '/">' . __e('More') . '</a>';
            $_manage_html .= '</td>';

            $_manage_html .= '</tr>';

        }
    }
    $_manage_html .= '</tbody>';
    $_manage_html .= '</table>';
    $_manage_html .= '</div>';

    $content .= '<div class="nav-tabs-custom">';
    $content .= '<ul class="nav nav-tabs">';
    $content .= '<li class="active"><a href="#extensions" data-toggle="tab"><i class="fa fa-magic"></i> ' . __e('Extensions') . '</a></li>';
    $content .= '<li><a href="#recent" data-toggle="tab">' . __e('Recent Activity') . '</a></li>';
    $content .= '<li><a href="#manage" data-toggle="tab">' . __e('Manage Add-Ons') . '</a></li>';
    $content .= '</ul>';
    $content .= '<div class="tab-content">';

    $content .= '<div class="active tab-pane" id="extensions">';
    $content .= '<p>' . __e('By using the following add ons, you can easily create pages, notifications, admob or others, without having to know the programming language') . '</p>';
    $content .= '<div class="row">' . "\r\n";
    $content .= $_addons_html;
    $content .= '</div>' . "\r\n";
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="recent">';
    $content .= $_recent_html;
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="manage">';
    $content .= $_manage_html;
    $content .= '</div>';

    $content .= '</div>';

    $content .= '</div>';

}
$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Add-Ons';
$template->page_desc = __e('This menu might be you to create an page without the need for programming knowledge');
$template->page_content = $content;

?>