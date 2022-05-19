<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 
 * @package No project loaded
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
$dirproject = JSM_PATH . '/projects/' . $current_app['apps']['app-prefix'] . '/';
$diroutput = JSM_PATH . '/outputs/' . $current_app['apps']['app-prefix'] . '/';

if (isset($_FILES['google-services']))
{
    $tmp_name = $_FILES['google-services']['tmp_name'];
    $error = $_FILES["google-services"]["error"];
    $file_name = $_FILES['google-services']['name'];
    print_r($file_name);

    if ($file_name == 'google-services.json')
    {
        if (move_uploaded_file($tmp_name, $dirproject . '/google-services.json'))
        {
            @copy($dirproject . '/google-services.json', $diroutput . '/google-services.json');

            $_SESSION['TOOL_ALERT']['type'] = 'success';
            $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
            $_SESSION['TOOL_ALERT']['message'] = __e('The `google-services.json` file has been successfully upload!');
        }
    } else
    {
        $_SESSION['TOOL_ALERT']['type'] = 'danger';
        $_SESSION['TOOL_ALERT']['title'] = __e('Error');
        $_SESSION['TOOL_ALERT']['message'] = __e('That is not an `google-services.json` file');
    }
    rebuild();
    header('Location: ./?p=google-services&' . time());
}

// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Google Services') . '</li>';
$breadcrumb .= '</ol>';


$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-life-bouy"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
 
 $content .= '<div class="panel panel-default">';
$content .= '<div class="panel-body">';
$content .= '<table class="table table-striped">';
$content .= '<tr>';
$content .= '<td>Project Name</td>';
$content .= '<td>' . $current_app['apps']['app-name'] . '</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td>Android Package Name</td>';
$content .= '<td>' . $current_app['apps']['app-id'] . '</td>';
$content .= '</tr>';
$content .= '<tr>';
 $content .= '</table>';
$content .= '</div>';
$content .= '</div>';

$content .= '<form action="" method="post" enctype="multipart/form-data">';
$content .= '<p>' . ('Upload file `<strong>google-services.json</strong>`') . '</p>';
$content .= '<div class="row">';
$content .= '<div class="col-md-10">';
$content .= '<div class="form-group">';
$content .= '<input name="google-services" type="file" class="form-control">';
$content .= '<p class="help-block">' . ('You can download `<code>google-services.json</code>` file from <a href="https://console.firebase.google.com/">Firebase console</a>') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-10 -->';
$content .= '<div class="col-md-2">';
$content .= '<input name="upload" type="submit" class="btn btn-danger btn-flat pull-left btn-block" value="' . __e('Upload') . '"/>';
$content .= '</div><!-- ./col-md-2 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form><!-- ./form -->';


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';

if (isset($current_app['google-services']))
{
    $info = $current_app['google-services'];
} else
{
    $info = array();
}


if (!isset($info['project_info']['project_number']))
{
    $info['project_info']['project_number'] = '?';
}
if (!isset($info['project_info']['firebase_url']))
{
    $info['project_info']['firebase_url'] = '?';
}
if (!isset($info['project_info']['project_number']))
{
    $info['project_info']['project_number'] = '?';
}
if (!isset($info['project_info']['storage_bucket']))
{
    $info['project_info']['storage_bucket'] = '?';
}
if (!isset($info['project_info']['project_id']))
{
    $info['project_info']['project_id'] = '?';
}
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-life-bouy"></i> ' . __e('Google Services Info') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<table class="table table-striped">';
$content .= '<tr>';
$content .= '<td>Project Number</td>';
$content .= '<td>' . $info['project_info']['project_number'] . '</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td>Firebase URL</td>';
$content .= '<td>' . $info['project_info']['firebase_url'] . '</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td>Project ID</td>';
$content .= '<td>' . $info['project_info']['project_id'] . '</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td>Storage Bucket</td>';
$content .= '<td>' . $info['project_info']['storage_bucket'] . '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '<div class="col-md-6">';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-life-bouy"></i> ' . __e('Client Info') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
if (!isset($info['client']))
{
    $info['client'] = array();
}
foreach ($info['client'] as $client)
{
    $content .= '<textarea class="form-control" data-type="json">';
    $content .= json_encode($client, JSON_PRETTY_PRINT);
    $content .= '</textarea>';
}


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Google Services');
$template->page_desc = __e('Setting some google or firebase products');
$template->page_content = $content;

?>