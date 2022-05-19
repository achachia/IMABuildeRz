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

$statusbar_style_options[] = array('value' => 'default', 'label' => __e('Default'));
$statusbar_style_options[] = array('value' => 'lightcontent', 'label' => __e('Light Content'));
$statusbar_style_options[] = array('value' => 'blacktranslucent', 'label' => __e('Black Translucent'));
$statusbar_style_options[] = array('value' => 'blackopaque', 'label' => __e('Black Opaque'));

if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

if ($_SESSION['CURRENT_APP_PREFIX'] == '')
{
    header('Location: ?');
}

$content = $breadcrumb = $form_content = $html_color_option = null;
$db = new jsmDatabase();
$icon = new jsmIcon();


$db->current();
$breadcrumb = $content = null;
$page_title = '(IMAB) Pages';
if (!isset($_SESSION['CURRENT_APP']['pages']))
{
    $_SESSION['CURRENT_APP']['pages'] = array();
}


$ionic_angular_html = null;

// TODO: PAGE - NEW | OPTION --|-- HEADER TYPE
$header_type = array();
$header_type[] = array('value' => 'title', 'label' => 'Title');
$header_type[] = array('value' => 'search', 'label' => 'Search Bar');
$header_type[] = array('value' => 'search-with-barcode', 'label' => 'Search Bar + Barcode Scanner');
$header_type[] = array('value' => 'segment', 'label' => 'Segment/Tab');
$header_type[] = array('value' => 'custom-header', 'label' => 'Custom Code');
$header_type[] = array('value' => 'none', 'label' => 'Without Header');


switch ($_GET['a'])
{
    case 'clear':
        // TODO: PAGE - CLEAR |
        $db->clearPage();
        rebuild();
        header("Location: ./?p=pages&" . time());
        break;
    case 'reset':
        // TODO: PAGE - RESET |
        $jsmDefault = new jsmDefault();

        $defaultPages = $jsmDefault->pages('home');
        $db->savePage($defaultPages);

        $defaultAddons = $jsmDefault->addons('step-wizard-slider');
        $db->saveAddOns('step-wizard-slider', $defaultAddons);


        $defaultPages = $jsmDefault->pages('about-us');
        $db->savePage($defaultPages);

        $defaultAddons = $jsmDefault->addons('about-us');
        $db->saveAddOns('about-us', $defaultAddons);


        $defaultPages = $jsmDefault->pages('faqs');
        $db->savePage($defaultPages);

        //$defaultPages = $jsmDefault->pages('privacy-policy');
        //$db->savePage($defaultPages);

        $defaultPages = $jsmDefault->pages('privacy-policy');
        $db->savePage($defaultPages);

        $_SESSION['TOOL_ALERT']['type'] = 'success';
        $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
        $_SESSION['TOOL_ALERT']['message'] = __e('The pages has been successfully reseted');
        $db->current();

        rebuild();
        header("Location: ./?p=pages&" . time());
        break;
    case 'list':
        // TODO: PAGE - LIST |
        // TODO: PAGE - LIST | BREADCRUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Page') . '</li>';
        $breadcrumb .= '</ol>';

        $content .= '<div class="box box-info">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('List Pages') . '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-body well">';

        // TODO: PAGE - LIST | BTN NEW
        $content .= '<div class="col-lg-3 col-xs-6">';
        $content .= '<div class="bg-default small-box">';
        $content .= '<div class="inner">';
        $content .= '<h3 class="page-list-title text-dark">' . __e('New Page') . '</h3>';
        $content .= '<p class="text-dark">' . __e('Add a new page') . '</p>';
        $content .= '</div>';
        $content .= '<div class="icon">';
        $content .= '<i class="fa fa fa-plus-circle"></i>';
        $content .= '</div>';
        $content .= '<span class="btn-group btn-group-justified small-box-footer" >';
        $content .= '<a class="btn text-dark" href="./?p=pages&a=edit" data-toggle="tooltip" title="' . __e('Click this button to add a new page to your app') . '">';
        $content .= '' . __e('New Page') . ' <i class="fa fa-arrow-circle-right"></i>';
        $content .= '</a>';
        $content .= '</span>';
        $content .= '</div>';
        $content .= '</div>';


        foreach ($_SESSION['CURRENT_APP']['pages'] as $page)
        {
            if (!isset($page['header']['color']))
            {
                $page['header']['color'] = 'primary';
            }
            $page_color = $page['header']['color'];
            if (!isset($page['header']['color']))
            {
                $page_color = 'primary';
            }
            if ($page_color == 'undefined')
            {
                $page_color = 'primary';
            }

            $icon_index = 'fa-star-o';
            $delete_btn = '<a class="btn ima-btn-' . $page_color . '" data-toggle="modal" data-target="#delete-page-dialog-' . $page['name'] . '" href="#!_" data-href="#/?p=pages&a=delete&page-name=' . $page['name'] . '" title="Delete ' . htmlentities(strip_tags($page['name'])) . ' page">' . __e('Delete') . ' <i class="fa fa-trash"></i></a>';

            if ($_SESSION['CURRENT_APP']['apps']['rootPage'] == $page['name'])
            {
                $icon_index = 'fa-star';
                $delete_btn = '';
            }
            if (!isset($page['param']))
            {
                $page['param'] = '';
            }
            $btn_index = '';
            if ($page['param'] == '')
            {
                $btn_index = '<a class="btn ima-btn-' . $page_color . '" href="./?p=pages&a=index&page-name=' . $page['name'] . '" title="Use ' . htmlentities(strip_tags($page['name'])) . ' page as index">' . __e('Home') . ' <i class="fa ' . $icon_index . '"></i></a>';
            }

            // TODO: PAGE - LIST | LIST PAGES

            $content .= '
            <div class="col-lg-3 col-xs-6">
                <div class="small-box ima-bg-' . $page_color . '">
                    <div class="inner">
                        <h3 class="page-list-title">' . htmlentities(strip_tags($page['name'])) . '</h3>
                        <p>' . $page['name'] . '</p>
                    </div>
                    
                    <div class="icon">
                      <ion-icon class="ion" name="' . $page['icon-left'] . '"></ion-icon>
                    </div>
            
                     
                    <div class="btn-group btn-group-justified small-box-footer" >
                  
                        <a class="btn ima-btn-' . $page_color . '" href="./?p=pages&a=edit&page-name=' . $page['name'] . '" title="Edit `' . htmlentities(strip_tags($page['name'])) . '` page">
                            ' . __e('Edit') . ' <i class="fa fa-arrow-circle-right"></i>
                        </a>
                                                 
                        ' . $delete_btn . '
                        
                        ' . $btn_index . '
                        
                    </div>                    
                                       
                </div>
            </div>
                        
            ';


            $content .= '<div class="modal fade modal-default" id="delete-page-dialog-' . $page['name'] . '" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
            $content .= '<div class="modal-dialog">';
            $content .= '<div class="modal-content">';
            $content .= '<div class="modal-header">';
            $content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Delete This Page') . '</h4>';
            $content .= '</div>';
            $content .= '<div class="modal-body">';
            $content .= '<p>' . __e('Are you sure you want to delete this page?') . '</p>';
            $content .= '<div class="row">';
            $content .= '<div class="col-md-3 text-right">';
            $content .= '<div class="icon icon-confirm text-center"><ion-icon class="fa-5x" name="' . $page['icon-left'] . '"></ion-icon></div>';
            $content .= '</div>';
            $content .= '<div class="col-md-9 text-left">';

            $content .= '<table class="table-confirm">';
            $content .= '<tr>';
            $content .= '<td>' . __e('Page Title') . '</td>';
            $content .= '<td>: <strong>' . $page['title'] . '</strong></td>';
            $content .= '</tr>';
            $content .= '<tr>';
            $content .= '<td>' . __e('Page Name') . '</td>';
            $content .= '<td>: <strong>' . $page['name'] . '</strong></td>';
            $content .= '</tr>';
            $content .= '</table>';

            $content .= '</div>';
            $content .= '</div>';

            $content .= '</div>';
            $content .= '<div class="modal-footer">';
            $content .= '<a href="./?p=pages&a=delete&page-name=' . $page['name'] . '" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
            $content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';

            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';


        }
        $content .= '</div>';


        $content .= '<div class="box-footer pad">' . "\r\n";
        $content .= '<a class="btn btn btn-success btn-flat pull-left" href="?p=pages&a=clear" title="' . __e('Clean History') . '"><i class="fa fa-rotate-right"></i> ' . __e('Clean Temporary') . '</a>&nbsp;' . "\r\n";

        $content .= '<a class="btn btn btn-default btn-flat pull-right" data-toggle="modal" data-target="#reset-page-dialog" href="#!_" data-href="#/?p=pages&a=reset" title="' . __e('Reset all pages on this app') . '"><i class="fa fa-exclamation-triangle"></i> ' . __e('Reset to Default') . '</a>&nbsp;' . "\r\n";
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - LIST | ALERT RESET
        $content .= '<div class="modal fade modal-default" id="reset-page-dialog" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
        $content .= '<div class="modal-dialog">';
        $content .= '<div class="modal-content">';
        $content .= '<div class="modal-header">';
        $content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        $content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Reset to Default') . '</h4>';
        $content .= '</div>';
        $content .= '<div class="modal-body">';
        $content .= '<p>' . __e('You will lose all pages on this app, Are you sure want to reset the pages?') . '</p>';
        $content .= '</div>';
        $content .= '<div class="modal-footer">';
        $content .= '<a href="./?p=pages&a=reset" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
        $content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        break;
    case 'new':
        // TODO: PAGE - NEW |
        $breadcrumb = $html_header_color = $html_header_type = null;
        if (isset($_POST['pages']))
        {

            if ($_POST['pages']['title'] == '')
            {
                $_POST['pages']['title'] = 'Untitled';
            }

            if ($_POST['pages']['name'] == '')
            {
                $_POST['pages']['name'] = $_POST['pages']['title'];
            }
            $_newPage = $_POST['pages'];
            $_SESSION['TOOL_ALERT']['type'] = 'success';
            $_SESSION['TOOL_ALERT']['title'] = __e('Well done!');
            $_SESSION['TOOL_ALERT']['message'] = __e('You have saved the page successfully');
            $db->savePage($_newPage);
            $db->current();
            rebuild();
            header("Location: ./?p=pages&a=list");
        }

        $page_data['title'] = 'Untitled ' . time();
        $page_data['name'] = '';
        $page_data['icon-left'] = 'paper';
        $page_data['icon-right'] = 'arrow-dropright';
        $page_data['icon-right'] = 'arrow-dropright';
        $page_data['content']['html'] = null;
        $page_data['content']['html'] .= '<ion-card>' . "\r\n";
        $page_data['content']['html'] .= "\t" . '<ion-card-content>This page is under construction. Please come back soon!</ion-card-content>' . "\r\n";
        $page_data['content']['html'] .= '</ion-card>' . "\r\n";

        $page_data['code']['other'] = '';

        $page_data['content']['scss'] = '';
        $page_data['header']['mid']['items'][0]['label'] = 'tab1';
        $page_data['header']['mid']['items'][0]['value'] = '';
        $page_data['header']['mid']['items'][1]['label'] = 'tab2';
        $page_data['header']['mid']['items'][1]['value'] = '';
        $page_data['header']['mid']['items'][2]['label'] = 'tab3';
        $page_data['header']['mid']['items'][2]['value'] = '';
        $page_data['header']['mid']['search-label'] = 'Search';

        // TODO: PAGE - NEW | INIT - HEADER COLOR
        if (!isset($page_data['header']['color']))
        {
            $page_data['header']['color'] = 'default';
        }


        $html_header_color = '<select class="form-control" name="pages[header][color]">';
        foreach ($color_name as $_color)
        {
            $selected = '';
            if ($page_data['header']['color'] == $_color['value'])
            {
                $selected = 'selected';
            }
            $html_header_color .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
        }
        $html_header_color .= '</select>';

        // TODO: PAGE - NEW | INIT - HEADER TYPE
        $html_header_type = '<select class="form-control" name="pages[header][mid][type]" id="pages_header_mid_type">';
        foreach ($header_type as $_type)
        {
            $selected = '';
            if (!isset($page_data['header']['mid']['type']))
            {
                $page_data['header']['mid']['type'] = 'title';
            }
            if ($page_data['header']['mid']['type'] == $_type['value'])
            {
                $selected = 'selected';
            }
            $html_header_type .= '<option value="' . $_type['value'] . '" ' . $selected . '>' . $_type['label'] . '</option>';
        }
        $html_header_type .= '</select>';


        // TODO: PAGE - NEW | INIT - CONTENT COLOR
        if (!isset($page_data['content']['color']))
        {
            $page_data['content']['color'] = 'default';
        }
        $html_content_color = '<select data-color="' . $page_data['content']['color'] . '" class="form-control select-color" name="pages[content][color]">';


        $new_color_name = array();
        $new_color_name[] = array('value' => 'none', 'label' => 'None');
        $new_color_name[] = array('value' => 'custom-color', 'label' => 'Custom Color');


        foreach (array_merge($new_color_name, $color_name) as $_color)
        {
            $selected = '';
            if ($page_data['content']['color'] == $_color['value'])
            {
                $selected = 'selected';
            }
            $html_content_color .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
        }
        $html_content_color .= '</select>';
        //-------------------------------------


        // TODO: PAGE - NEW | INIT - CORNER BUTTON
        if (!isset($page_data['corner-button']))
        {
            $page_data['corner-button'] = 'popover';
        }

        $option_corner_menu = array();
        $option_corner_menu[] = array('value' => 'none', 'label' => 'None');
        $option_corner_menu[] = array('value' => 'popover', 'label' => 'Popover');

        $html_corner_button_pages = '';
        $html_corner_button_pages .= '<select class="form-control" name="pages[corner-button]" id="pages_corner_button">';
        foreach ($option_corner_menu as $menu)
        {
            $selected = '';
            if ($menu['value'] == $page_data['corner-button'])
            {
                $selected = 'selected';
            }
            $html_corner_button_pages .= '<option ' . $selected . ' value="' . $menu['value'] . '">' . $menu['label'] . '</option>';
        }
        $html_corner_button_pages .= '</select>';


        //-------------------------------------
        // TODO: PAGE - NEW | INIT - FOOTER - COLOR
        if (!isset($page_data['footer']['color']))
        {
            $page_data['footer']['color'] = 'default';
        }
        $html_footer_color = '<select data-color="' . $page_data['footer']['color'] . '" class="form-control select-color" name="pages[footer][color]">';

        $new_color_name = array();
        $new_color_name[] = array('value' => 'none', 'label' => 'None');
        foreach (array_merge($new_color_name, $color_name) as $_color)
        {
            $selected = '';
            if ($page_data['footer']['color'] == $_color['value'])
            {
                $selected = 'selected';
            }
            $html_footer_color .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
        }
        $html_footer_color .= '</select>';
        //-------------------------------------
        // TODO: PAGE - NEW | INIT - FOOTER - TYPE
        $footer_type = array();
        $footer_type[] = array('value' => 'none', 'label' => __e('Without Footer'));
        $footer_type[] = array('value' => 'title', 'label' => __e('Title'));
        $footer_type[] = array('value' => 'code', 'label' => __e('Custom Code'));
        //$footer_type[] = array('value' => 'seqments', 'label' => __e('Seqments/Tabs'));


        $html_footer_type = '<select id="pages-footer-type" class="form-control" name="pages[footer][type]" id="pages_footer_type">';
        foreach ($footer_type as $_type)
        {
            $selected = '';
            if (!isset($page_data['footer']['type']))
            {
                $page_data['footer']['type'] = 'none';
            }
            if ($page_data['footer']['type'] == $_type['value'])
            {
                $selected = 'selected';
            }
            $html_footer_type .= '<option value="' . $_type['value'] . '" ' . $selected . '>' . $_type['label'] . '</option>';
        }
        $html_footer_type .= '</select>';

        // TODO: PAGE - NEW | INIT - FOOTER - TITLE
        if (!isset($page_data['footer']['title']))
        {
            $page_data['footer']['title'] = 'Copyright &copy; ' . date('Y') . ' ' . htmlentities($_SESSION['CURRENT_APP']['apps']['author-organization']) . '. All rights reserved';
        }
        // TODO: PAGE - NEW | INIT - FOOTER - CODE
        if (!isset($page_data['footer']['code']))
        {
            $page_data['footer']['code'] = '';
        }


        // TODO: PAGE - NEW | BREADCRUMB
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pages">' . __e('Pages') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('New') . '</li>';
        $breadcrumb .= '</ol>';

        // TODO: PAGE - NEW | MODULES
        if (!isset($page_data['modules']['angular']))
        {
            $page_data['modules']['angular'] = array();
        }

        if (!isset($page_data['modules']['ionic-angular']))
        {
            $page_data['modules']['ionic-angular'] = array();
        }

        if (!isset($page_data['modules']['ionic-native']))
        {
            $page_data['modules']['ionic-native'] = array();
        }

        if (!isset($page_data['param']))
        {
            $page_data['param'] = '';
        }

        if (!isset($page_data['header']['bg-statusbar']))
        {
            $page_data['header']['bg-statusbar'] = '';
        }

        $ionic_angular_html .= '<!-- modules -->' . "\r\n";
        $ionic_angular_html .= '<div class="table-responsive">' . "\r\n";
        $ionic_angular_html .= '<table class="table table-bordered table-striped">' . "\r\n";

        $ionic_angular_html .= '<thead>' . "\r\n";
        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<th style="min-width:30px">#</th>' . "\r\n";
        $ionic_angular_html .= '<th>Class</th>' . "\r\n";
        $ionic_angular_html .= '<th>Variable</th>' . "\r\n";
        $ionic_angular_html .= '<th>Cordova Plugin</th>' . "\r\n";
        $ionic_angular_html .= '<th>Path</th>' . "\r\n";
        $ionic_angular_html .= '<th></th>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";
        $ionic_angular_html .= '</thead>' . "\r\n";

        $ionic_angular_html .= '<tbody class="item-list">' . "\r\n";

        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>Component</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><span class="label label-success">@angular/core</span></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>OnInit</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><span class="label label-success">@angular/core</span></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";


        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>Router</code></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>router</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><span class="label label-success">@angular/router</span></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";


        $t = 0;
        $ionic_angular_html .= '<tr id="">' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][class]" value="" placeholder="Device" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][var]" value="" placeholder="device"/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][cordova]" value="" placeholder="cordova-plugin-device"/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][path]" value="" placeholder="@ionic-native/device/ngx"/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '</tbody>' . "\r\n";
        $ionic_angular_html .= '</table>' . "\r\n";
        $ionic_angular_html .= '</div>' . "\r\n";
        $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";


        // TODO: PAGE - NEW | BACK BTN
        $html_inlink_pages = null;
        $html_inlink_pages = '<select class="form-control" name="pages[back-button]">';
        $html_inlink_pages .= '<option value="">' . __e('None') . '</option>';
        $html_inlink_pages .= '<option value="auto">' . __e('Auto') . '</option>';
        foreach ($_SESSION['CURRENT_APP']['pages'] as $list_page)
        {
            $html_inlink_pages .= '<option value="/' . $list_page['var'] . '">' . htmlentities($list_page['title']) . ' (' . $list_page['var'] . ')</option>';
        }
        $html_inlink_pages .= '</select>';


        // TODO: PAGE - NEW | FORM
        $content .= '<form role="form" action="" method="post">';
        $content .= '<div class="row">';

        $content .= '<!-- left column -->';
        $content .= '<div class="col-md-6">';
        $content .= '<!-- general form elements -->';
        $content .= '<div class="box box-success">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title">';
        $content .= '<i class="fa fa-file-text"></i> ' . __e('New Page') . '';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div><!-- /.box-header -->';


        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('The page used for your application') . '</p>';
        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<!-- title -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Page Title') . '</label>';
        $content .= '<input type="text" name="pages[title]" class="form-control" value="' . $page_data['title'] . '" />';
        $content .= '<p class="help-block">' . __e('The title of the page that will be displayed') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<!-- name -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix Page') . '</label>';
        $content .= '<input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" data-mask name="pages[name]" class="form-control" value="' . $page_data['name'] . '"  />';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using <code>a-z</code> and <code>0-9</code> characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';

        $content .= '<div class="input-group">';
        $content .= '<label class="input-group-addon" for="icon-left">' . __e('Left Icon') . '</label>';
        $content .= ' <input name="pages[icon-left]" type="text" class="form-control" id="icon-left" placeholder="paper" value="newspaper" >';
        $content .= '<span class="input-group-addon" data-type="icon-picker" data-target="#icon-left" data-dialog="#ion-icon-dialog" title="Click here for get icon list" data-toggle="tooltip">';
        $content .= '<ion-icon name="newspaper"></ion-icon>';
        $content .= '</span>';
        $content .= '</div>';
        $content .= '<p class="help-block">' . __e('Just an additional icon') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="col-md-6">';


        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Parameters') . '</label>';
        $content .= '<input type="text" class="form-control" name="pages[param]" value="' . $page_data['param'] . '" placeholder="page_id"/>';
        $content .= '<p class="help-block">' . __e('Parameters used for dynamic pages that require an id, separated by <code>commas</code> and using <code>a-z</code>, <code>A-Z</code>, and <code>_</code> characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Default Back Button') . '</label>';
        $content .= '' . $html_inlink_pages . '';
        $content .= '<p class="help-block">' . __e('When back button is clicked will return to the page?') . '</p>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '</div>';


        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Corner Button') . '</label>';
        $content .= '' . $html_corner_button_pages . '';
        $content .= '<p class="help-block">' . __e('The button commonly used to display options') . '</p>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '</div>';


        $content .= '<div class="col-md-6">';

        $content .= '<div class="nav-tabs-custom">';
        $content .= '<ul class="nav nav-tabs pull-right">';
        $content .= '<li><a href="#tab_4" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('StatusBar') . '</a></li>';
        $content .= '<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('Page Footer') . '</a></li>';
        $content .= '<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('Page Content') . '</a></li>';
        $content .= '<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('Page Header') . '</a></li>';
        $content .= '<li class="pull-left header"><i class="fa fa-gear"></i> ' . __e('Option') . '</li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';

        // TODO: PAGE - NEW | FORM - HEADER
        $content .= '<div class="tab-pane active" id="tab_1">';

        $content .= '<p>' . __e('Headers are fixed regions at the top of a screen') . '</p>';
        $content .= '<div class="row">';

        $content .= '<div class="col-md-6">';
        $content .= '<!-- color -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Colors') . '</label>';
        $content .= '' . $html_header_color . '';
        $content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<!-- header[mid][type] -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Layout Type') . '</label>';
        $content .= '' . $html_header_type . '';
        $content .= '<p class="help-block">' . __e('The type of header used') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        // TODO: PAGE - NEW | FORM - HEADER - CUSTOM
        if (!isset($page_data['header']['mid']['custom-code']))
        {
            $page_data['header']['mid']['custom-code'] = '';
        }
        $content .= '<div id="pages_header_custom">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Custom Code') . '</label>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.html</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>&lt;ion-header&gt;' . "\r\n\t" . '&lt;ion-toolbar&gt;Hello World&lt;/ion-toolbar&gt;' . "\r\n" . '&lt;/ion-header&gt;</pre></div>';
        $content .= '<textarea class="form-control" data-type="html5" name="pages[header][mid][custom-code]" >' . htmlentities($page_data['header']['mid']['custom-code']) . '</textarea>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div id="pages_header_search">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Search Label') . '</label>';
        $content .= '<input type="text" name="pages[header][mid][search-label]" class="form-control" value="' . $page_data['header']['mid']['search-label'] . '" /></td>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<!-- header[mid][items] -->';
        $content .= '<div id="pages_header_segment">';
        $content .= '<div class="form-group">';
        $content .= '<label>Items for Segments</label>';
        $content .= '<p class="help-block">' . __e('Segment is a collection of buttons that are displayed in line, The fields below are required for segments') . '</p>';
        $content .= '<table class="table table-striped">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>Label</th>';
        $content .= '<th>Value</th>';
        $content .= '</tr>';
        $content .= '</thead>';
        $content .= '<tbody>';
        $content .= '<tr>';
        $content .= '<td><input type="text" name="pages[header][mid][items][0][label]" class="form-control" value="' . $page_data['header']['mid']['items'][0]['label'] . '" /></td>';
        $content .= '<td><input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" data-mask  name="pages[header][mid][items][0][value]" class="form-control" value="' . $page_data['header']['mid']['items'][0]['value'] . '" /></td>';
        $content .= '</tr>';
        $content .= '<tr>';
        $content .= '<td><input type="text" name="pages[header][mid][items][1][label]" class="form-control" value="' . $page_data['header']['mid']['items'][1]['label'] . '"/></td>';
        $content .= '<td><input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" name="pages[header][mid][items][1][value]" class="form-control" value="' . $page_data['header']['mid']['items'][1]['value'] . '" /></td>';
        $content .= '</tr>';
        $content .= '<tr>';
        $content .= '<td><input type="text" name="pages[header][mid][items][2][label]" class="form-control" value="' . $page_data['header']['mid']['items'][2]['label'] . '"/></td>';
        $content .= '<td><input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" name="pages[header][mid][items][2][value]" class="form-control" value="' . $page_data['header']['mid']['items'][2]['value'] . '" /></td>';
        $content .= '</tr>';
        $content .= '<tr>';
        $content .= '<td></td>';
        $content .= '<td><p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>-</code> characters only') . '</p></td>';
        $content .= '</tr>';
        $content .= '</tbody>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div><!-- ./tab-pane -->';

        // TODO: PAGE - NEW | FORM - CONTENT OPTION
        $content .= '<div class="tab-pane" id="tab_2">';
        $content .= '<p>' . __e('You can set background color, image for content') . '</p>';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Background Color') . '</small></label>';
        $content .= $html_content_color;
        $content .= '<p class="help-block">' . __e('Color variation from the content') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Custom Color') . '</label>';
        $content .= '<input type="color" class="form-control" name="pages[content][custom-color]" id="content-custom-colors" placeholder="#dddddd"  >';
        $content .= '<p class="help-block">' . __e('Color variation from the content') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';

        $content .= '</div><!-- ./row -->';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Background Image') . '</label>';
        $content .= '<div class="input-group">';
        $content .= '<input type="text" id="content-background" class="form-control" name="pages[content][background]" />';
        $content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
        $content .= '</div>';
        $content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
        $content .= '</div>';

        $content .= '</div><!-- ./tab-pane -->';

        // TODO: PAGE - NEW | FORM - FOOTER
        $content .= '<div class="tab-pane" id="tab_3">';

        $content .= '<div class="row">';
        // TODO: PAGE - NEW | FORM - FOOTER - COLORS
        $content .= '<div class="col-md-6">';
        $content .= '<!-- color -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Colors') . '</label>';
        $content .= '' . $html_footer_color . '';
        $content .= '<p class="help-block">' . __e('Background color for footer') . '</p>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="col-md-6">';
        // TODO: PAGE - NEW | FORM - FOOTER - TYPE
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Layout Type') . '</label>';
        $content .= '' . $html_footer_type . '';
        $content .= '<p class="help-block">' . __e('The type of footer used') . '</p>';
        $content .= '</div><!-- ./form-group -->';
        $content .= '</div><!-- ./col-md-6 -->';
        $content .= '</div><!-- ./row -->';

        // TODO: PAGE - NEW | FORM - FOOTER - TITLE

        $content .= '<div id="pages-footer-title">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Text') . '</label>';
        $content .= '<input type="text" name="pages[footer][title]" class="form-control" value="' . htmlentities($page_data['footer']['title']) . '" />';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - NEW | FORM - FOOTER - CUSTOM-CODE
        $content .= '<div id="pages-footer-code">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Code') . '</label>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.html</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>&lt;ion-footer&gt;' . "\r\n\t" . '&lt;ion-toolbar&gt;Hello World&lt;/ion-toolbar&gt;' . "\r\n" . '&lt;/ion-footer&gt;</pre></div>';

        $content .= '<textarea  class="form-control" data-type="html5" name="pages[footer][code]" >' . htmlentities($page_data['footer']['code']) . '</textarea>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</div><!-- ./tab-pane -->';


        if (!isset($page_data['statusbar']['style']))
        {
            $page_data['statusbar']['style'] = 'default';
        }
        if (!isset($page_data['statusbar']['backgroundcolor']))
        {
            $page_data['statusbar']['backgroundcolor'] = '#ddd';
        }

        // TODO: PAGE - NEW | FORM - STATUSBAR
        $content .= '<div class="tab-pane" id="tab_4">';
        $html_statusbar_style = null;
        $html_statusbar_style .= '<select name="pages[statusbar][style]" class="form-control" id="statusbar-style">';
        foreach ($statusbar_style_options as $statusbar_style_option)
        {
            $selected = null;
            if ($statusbar_style_option['value'] == $page_data['statusbar']['style'])
            {
                $selected = 'selected';
            }
            $html_statusbar_style .= '<option ' . $selected . ' value="' . $statusbar_style_option['value'] . '">' . $statusbar_style_option['label'] . '</option>';
        }
        $html_statusbar_style .= '</select>';


        $content .= '<div class="row">';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label for="statusbar-style">' . __e('Style') . '</label>';
        $content .= '' . $html_statusbar_style . '';
        $content .= '<p class="help-block">' . __e('Set the status bar style') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';


        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label for="statusbar-backgroundcolor">' . __e('Background Color') . '</label>';
        $content .= '<input type="color" class="form-control" name="pages[statusbar][backgroundcolor]" placeholder="#dddddd" value="' . $page_data['statusbar']['backgroundcolor'] . '" />';
        $content .= '<p class="help-block">' . __e('Set the background color of the statusbar') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';

        $content .= '</div>';


        $content .= '</div><!-- ./tab-pane -->';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';


        $content .= '</div><!-- ./tab-content -->';
        $content .= '</div><!-- ./nav-tabs-custom -->';


        $content .= '</div><!-- col-md-6 -->';

        $content .= '</div><!-- row -->';


        // TODO: PAGE - NEW | FORM - CONTENT
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-html5"></i> ' . __e('Page Content') . '';
        $content .= '<small>' . __e('HTML5') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div><!-- /. tools -->';
        $content .= '</div><!-- /.box-header -->';
        $content .= '<div class="box-body pad">';

        $link_wysiwyg_editor = './?p=pages&a=new&wysiwyg';
        $link_code_editor = './?p=pages&a=new';

        $content .= '<div class="pull-right">';
        $content .= '<div class="btn-group">';
        if (isset($_GET['wysiwyg']))
        {
            $content .= '<a class="btn btn-success" href="' . $link_code_editor . '"><i class="glyphicon glyphicon-edit"></i> ' . __e('Code Editor') . '</a>';
            $content .= '<a class="btn btn-success disabled"><i class="glyphicon glyphicon-edit"></i> ' . __e('WYSIWYG') . '</a>';
        } else
        {
            $content .= '<a class="btn btn-success disabled" ><i class="glyphicon glyphicon-edit"></i> ' . __e('Code Editor') . '</a>';
            $content .= '<a class="btn btn-success" href="' . $link_wysiwyg_editor . '"><i class="glyphicon glyphicon-edit"></i> ' . __e('WYSIWYG') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="clearfix"></div><br/>';

        if (isset($_GET['wysiwyg']))
        {
            $content .= '<textarea id="page-content-html5" data-type="tinymce"  name="pages[content][html]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['content']['html']) . '</textarea>';
        } else
        {
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.html</code></p>';
            $content .= '<div class="example-code">' . __e('Example') . ':<pre>&lt;ion-list&gt;' . "\r\n\t" . '&lt;ion-item&gt;Hello World&lt;/ion-item&gt;' . "\r\n" . '&lt;/ion-list&gt;</pre></div>';
            $content .= '<textarea id="page-content-html5" data-type="html5"  name="pages[content][html]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['content']['html']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        }
        $content .= '<br/>';
        $content .= '<div class="row">';
        $content .= '<div class="col-md-4">';
        $content .= '<table class="table no-margin">';
        $content .= '<tr>';
        $content .= '<td><input type="checkbox" class="flat-red" name="pages[content][fullscreen]"/></td>';
        $content .= '<td>' . __e('Add fullscreen attributes to ion-content') . '<br/><span class="help-block">' . __e('Easy way to add fullscreen to ion-content') . '</span></td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= '<div class="col-md-4">';
        $content .= '<table class="table no-margin">';
        $content .= '<tr>';
        $content .= '<td><input type="checkbox" class="flat-red" name="pages[content][enable-padding]" /></td>';
        $content .= '<td>' . __e('Add padding attributes to ion-content') . '<br/><span class="help-block">' . __e('Easy way to add padding to ion-content') . '</span></td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= '<div class="col-md-4">';
        $content .= '<table class="table no-margin">';
        $content .= '<tr>';
        $content .= '<td><input type="checkbox" class="flat-red" name="pages[content][disable-scroll]"/></td>';
        $content .= '<td>' . __e('Disable scroll') . '<br/><span class="help-block">' . __e('Set ion-content has non scrollable ') . '</span></td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-info" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - NEW | FORM - STYLES
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-css3"></i> ' . __e('Page Styles') . '';
        $content .= '<small>' . __e('SCSS') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div><!-- /. tools -->';
        $content .= '</div><!-- /.box-header -->';
        $content .= '<div class="box-body pad">';
        $content .= '<p>' . __e('Ionic Web Component using Shadow DOM, please read <a target="_blank" href="https://ionicframework.com/blog/shadow-dom-in-ionic-and-why-its-awesome/">here</a>') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.scss</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>ion-content{' . "\r\n\t" . '--background: #dddddd;' . "\r\n" . '}</pre></div>';
        $content .= '<textarea id="page-content-scss" data-type="scss"  name="pages[content][scss]" placeholder="Sassy CSS Code" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['content']['scss']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - NEW | FORM - OUT-SCOPE
        $content .= '<div class="box box-default">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Out Scope') . ' <small>TypeScript</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('This code is outside the class/object, can also be used to create a new class/object/declare') . ' </p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>declare var blaBla:any;</pre></div>';


        $content .= '<textarea data-type="ts" id="page-code-export" name="pages[code][export]" placeholder="" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - NEW | FORM - CONSTRUCTOR
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Constructor') . ' <small>TypeScript</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write the code for the constructor function') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.blaBla();</pre></div>';
        $content .= '<textarea data-type="ts" id="page-code-constructor" name="pages[code][constructor]" placeholder="" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '</div>';
        $content .= '</div>';
        // TODO: PAGE - NEW | FORM - OTHERS
        $content .= '<div class="box box-success">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Functions') . '';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div><!-- /. tools -->';
        $content .= '</div><!-- /.box-header -->';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>blaBla1(){....}' . "\r\n" . 'blaBla2(){....}</pre></div>';

        $content .= '<textarea id="page-code-other"  data-type="ts"  name="pages[code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['code']['other']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - NEW | FORM - MODULES
        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Modules') . '';
        $content .= '<small>' . __e('Angular/Cordova/Ionic-Native') . '</small>';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div><!-- /. tools -->';
        $content .= '</div><!-- /.box-header -->';
        $content .= '<div class="box-body">';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/new-page/new-page.page.ts</code></p>';
        $content .= '' . $ionic_angular_html . '';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>  ';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</form>';

        break;
    case 'edit':
        // TODO: PAGE - EDIT |
        if (!isset($_GET['page-name']))
        {
            $_GET['page-name'] = '';
        }
        if ($_GET['page-name'] == '')
        {
            header('Location: ./?p=pages&a=new');
        }
        $string = new jsmString();
        $page_selected = $string->toFileName($_GET['page-name']);

        if (isset($_POST['pages']))
        {

            $_current_prefix_page = $_GET['page-name'];
            if ($_POST['pages']['title'] == '')
            {
                $_POST['pages']['title'] = 'Untitled';
            }

            if ($_POST['pages']['name'] == '')
            {
                $_POST['pages']['name'] = $_POST['pages']['title'];
            }

            $_newPage = $_POST['pages'];
            $_SESSION['TOOL_ALERT']['type'] = 'success';
            $_SESSION['TOOL_ALERT']['title'] = 'Well done! ';
            $_SESSION['TOOL_ALERT']['message'] = 'You have saved the page successfully.';
            $db->savePage($_newPage);
            $db->current();
            rebuild();
            header("Location: ./?p=pages&a=edit&page-name=" . $_current_prefix_page);
        }


        $page_data = $db->getPage($_GET['page-name']);
        if (!isset($page_data['title']))
        {
            header('Location: ./?p=pages&a=new');
        }
        //-------------------------------------
        // TODO: PAGE - EDIT | INIT - HEADER COLOR
        if (!isset($page_data['code']['other']))
        {
            $page_data['code']['other'] = '';
        }
        if (!isset($page_data['header']['color']))
        {
            $page_data['header']['color'] = 'default';
        }
        $html_header_color = '<select data-color="' . $page_data['header']['color'] . '" class="form-control select-color" name="pages[header][color]">';
        foreach ($color_name as $_color)
        {
            $selected = '';
            if ($page_data['header']['color'] == $_color['value'])
            {
                $selected = 'selected';
            }
            $html_header_color .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
        }
        $html_header_color .= '</select>';
        //-------------------------------------

        // TODO: PAGE - EDIT | INIT - CONTENT COLOR
        if (!isset($page_data['content']['color']))
        {
            $page_data['content']['color'] = 'default';
        }
        $html_content_color = '<select data-color="' . $page_data['content']['color'] . '" class="form-control select-color" name="pages[content][color]">';


        $new_color_name = array();
        $new_color_name[] = array('value' => 'none', 'label' => 'None');
        $new_color_name[] = array('value' => 'custom-color', 'label' => 'Custom Color');


        foreach (array_merge($new_color_name, $color_name) as $_color)
        {
            $selected = '';
            if ($page_data['content']['color'] == $_color['value'])
            {
                $selected = 'selected';
            }
            $html_content_color .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
        }
        $html_content_color .= '</select>';
        //-------------------------------------

        $html_header_type = '<select class="form-control" name="pages[header][mid][type]" id="pages_header_mid_type">';
        foreach ($header_type as $_type)
        {
            $selected = '';
            if (!isset($page_data['header']['mid']['type']))
            {
                $page_data['header']['mid']['type'] = 'title';
            }
            if ($page_data['header']['mid']['type'] == $_type['value'])
            {
                $selected = 'selected';
            }
            $html_header_type .= '<option value="' . $_type['value'] . '" ' . $selected . '>' . $_type['label'] . '</option>';
        }
        $html_header_type .= '</select>';

        if (!isset($page_data['header']['mid']['items'][0]['label']))
        {
            $page_data['header']['mid']['items'][0]['label'] = '';
        }
        if (!isset($page_data['header']['mid']['items'][0]['value']))
        {
            $page_data['header']['mid']['items'][0]['value'] = '';
        }
        if (!isset($page_data['header']['mid']['items'][1]['label']))
        {
            $page_data['header']['mid']['items'][1]['label'] = '';
        }
        if (!isset($page_data['header']['mid']['items'][1]['value']))
        {
            $page_data['header']['mid']['items'][1]['value'] = '';
        }

        if (!isset($page_data['header']['mid']['items'][2]['label']))
        {
            $page_data['header']['mid']['items'][2]['label'] = '';
        }
        if (!isset($page_data['header']['mid']['items'][2]['value']))
        {
            $page_data['header']['mid']['items'][2]['value'] = '';
        }
        if (!isset($page_data['provider'][0]))
        {
            $page_data['provider'][0] = '';
        }
        if (!isset($page_data['catg']))
        {
            $page_data['catg'] = '';
        }

        if (!isset($page_data['content']['scss']))
        {
            $page_data['content']['scss'] = '';
        }

        if (!isset($page_data['content']['ts']))
        {
            $page_data['content']['ts'] = '';
        }

        if (!isset($page_data['content']['background']))
        {
            $page_data['content']['background'] = '';
        }

        if (!isset($page_data['content']['enable-fullscreen']))
        {
            $page_data['content']['enable-fullscreen'] = false;
        }

        if (!isset($page_data['content']['enable-padding']))
        {
            $page_data['content']['enable-padding'] = false;
        }

        if (!isset($page_data['content']['disable-scroll']))
        {
            $page_data['content']['disable-scroll'] = false;
        }


        if ($page_data['content']['enable-fullscreen'] == true)
        {
            $enable_fullscreen = 'checked';
        } else
        {
            $enable_fullscreen = '';
        }

        if ($page_data['content']['enable-padding'] == true)
        {
            $enable_padding = 'checked';
        } else
        {
            $enable_padding = '';
        }

        if ($page_data['content']['disable-scroll'] == true)
        {
            $disable_scroll = 'checked';
        } else
        {
            $disable_scroll = '';
        }

        // TODO: PAGE - EDIT | MODULES
        if (!isset($page_data['modules']['angular']))
        {
            $page_data['modules']['angular'] = array();
        }


        if (!isset($page_data['param']))
        {
            $page_data['param'] = '';
        }
        if (!isset($page_data['header']['bg-statusbar']))
        {
            $page_data['header']['bg-statusbar'] = $_SESSION['CURRENT_APP']['apps']['statusbar']['backgroundcolor'];
        }

        if (!isset($page_data['corner-button']))
        {
            $page_data['corner-button'] = 'popover';
        }

        // TODO: PAGE - EDIT | INIT - CORNER MENU
        $option_corner_menu = array();
        $option_corner_menu[] = array('value' => 'none', 'label' => 'None');
        $option_corner_menu[] = array('value' => 'popover', 'label' => 'Popover');

        $html_corner_button_pages = '';
        $html_corner_button_pages .= '<select class="form-control" name="pages[corner-button]" id="pages_corner_button">';
        foreach ($option_corner_menu as $menu)
        {
            $selected = '';
            if ($menu['value'] == $page_data['corner-button'])
            {
                $selected = 'selected';
            }
            $html_corner_button_pages .= '<option ' . $selected . ' value="' . $menu['value'] . '">' . $menu['label'] . '</option>';
        }
        $html_corner_button_pages .= '</select>';

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
        $ionic_angular_html .= '<td><code>Component</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><span class="label label-success">@angular/core</span></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>OnInit</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><span class="label label-success">@angular/core</span></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";


        $ionic_angular_html .= '<tr>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>Router</code></td>' . "\r\n";
        $ionic_angular_html .= '<td><code>router</code></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><span class="label label-success">@angular/router</span></td>' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";


        $t = 0;
        foreach ($page_data['modules']['angular'] as $_module_angular)
        {
            $u = $t + 3;
            $ionic_angular_html .= '<tr class="item" id="modules-angular-' . $t . '">' . "\r\n";
            $ionic_angular_html .= '<td class="handle v-top" ><i class="glyphicon glyphicon-move"></i></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pages[modules][angular][' . $t . '][class]" value="' . htmlentities($_module_angular['class']) . '" /><code>' . htmlentities($_module_angular['class']) . '</code></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pages[modules][angular][' . $t . '][var]" value="' . htmlentities($_module_angular['var']) . '"/><code>' . htmlentities($_module_angular['var']) . '</code></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pages[modules][angular][' . $t . '][cordova]" value="' . htmlentities($_module_angular['cordova']) . '"/><span class="label label-danger">' . htmlentities($_module_angular['cordova']) . '</span></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><input type="hidden" name="pages[modules][angular][' . $t . '][path]" value="' . htmlentities($_module_angular['path']) . '"/><span class="label label-success">' . htmlentities($_module_angular['path']) . '</span></td>' . "\r\n";
            $ionic_angular_html .= '<td class="handle"><a href="#!" data-target="#modules-angular-' . $t . '" class="remove-item btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>' . "\r\n";
            $ionic_angular_html .= '</tr>' . "\r\n";
            $t++;
        }
        $t++;
        $ionic_angular_html .= '<tr id="">' . "\r\n";
        $ionic_angular_html .= '<td></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][class]" value="" placeholder="Device" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][var]" value="" placeholder="device" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][cordova]" value="" placeholder="cordova-plugin-device" /></td>' . "\r\n";
        $ionic_angular_html .= '<td><input type="text" class="form-control" name="pages[modules][angular][' . $t . '][path]" value="" placeholder="@ionic-native/device/ngx"/></td>' . "\r\n";
        $ionic_angular_html .= '<td><input name="submit" type="submit" class="btn btn-sm btn-primary" value="' . __e('Add') . '" /></td>' . "\r\n";
        $ionic_angular_html .= '</tr>' . "\r\n";

        $ionic_angular_html .= '</tbody>' . "\r\n";
        $ionic_angular_html .= '</table>' . "\r\n";
        $ionic_angular_html .= '</div>' . "\r\n";
        $ionic_angular_html .= '<!-- ./modules -->' . "\r\n";

        // TODO: PAGE - EDIT | BREADCRUMB
        $breadcrumb = null;
        $breadcrumb .= '<ol class="breadcrumb">';
        $breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
        $breadcrumb .= '<li><a href="./?p=pages">' . __e('Pages') . '</a></li>';
        $breadcrumb .= '<li class="active">' . __e('Edit') . '</li>';
        $breadcrumb .= '</ol>';

        if (!isset($page_data['icon-left']))
        {
            $page_data['icon-left'] = '';
        }
        if (!isset($page_data['icon-right']))
        {
            $page_data['icon-right'] = '';
        }

        if (!isset($page_data['back-button']))
        {
            $page_data['back-button'] = '';
        }

        if (!isset($page_data['content']['custom-color']))
        {
            $page_data['content']['custom-color'] = '#eeeeee';
        }
        $html_inlink_pages = null;
        $html_inlink_pages = '<select class="form-control" name="pages[back-button]">';
        $html_inlink_pages .= '<option value="">' . __e('None') . '</option>';

        $page_for_back_button = $_SESSION['CURRENT_APP']['pages'];
        $page_for_back_button[] = array('title' => 'Auto', 'var' => 'auto');
        foreach ($page_for_back_button as $list_page)
        {
            $selected = '';
            if ($page_data['back-button'] == '/' . $list_page['var'])
            {
                $selected = 'selected';
            }
            if (!isset($list_page['param']))
            {
                $list_page['param'] = '';
            }
            if ($list_page['param'] == '')
            {
                $html_inlink_pages .= '<option value="/' . $list_page['var'] . '" ' . $selected . '>' . htmlentities($list_page['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . ' (' . $list_page['var'] . ')</option>';
            }
        }
        $html_inlink_pages .= '</select>';


        //-------------------------------------
        // TODO: PAGE - EDIT | INIT - FOOTER - COLOR
        if (!isset($page_data['footer']['color']))
        {
            $page_data['footer']['color'] = 'default';
        }
        $html_footer_color = '<select data-color="' . $page_data['footer']['color'] . '" class="form-control select-color" name="pages[footer][color]">';

        $new_color_name = array();
        $new_color_name[] = array('value' => 'none', 'label' => 'None');
        foreach (array_merge($new_color_name, $color_name) as $_color)
        {
            $selected = '';
            if ($page_data['footer']['color'] == $_color['value'])
            {
                $selected = 'selected';
            }
            $html_footer_color .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
        }
        $html_footer_color .= '</select>';
        //-------------------------------------
        // TODO: PAGE - EDIT | INIT - FOOTER - TYPE
        $footer_type = array();
        $footer_type[] = array('value' => 'none', 'label' => __e('Without Footer'));
        $footer_type[] = array('value' => 'title', 'label' => __e('Title'));
        $footer_type[] = array('value' => 'code', 'label' => __e('Custom Code'));
        //$footer_type[] = array('value' => 'seqments', 'label' => __e('Seqments/Tabs'));


        $html_footer_type = '<select id="pages-footer-type" class="form-control" name="pages[footer][type]" id="pages_footer_type">';
        foreach ($footer_type as $_type)
        {
            $selected = '';
            if (!isset($page_data['footer']['type']))
            {
                $page_data['footer']['type'] = 'none';
            }
            if ($page_data['footer']['type'] == $_type['value'])
            {
                $selected = 'selected';
            }
            $html_footer_type .= '<option value="' . $_type['value'] . '" ' . $selected . '>' . $_type['label'] . '</option>';
        }
        $html_footer_type .= '</select>';

        // TODO: PAGE - EDIT | INIT - FOOTER - TITLE
        if (!isset($page_data['footer']['title']))
        {
            $page_data['footer']['title'] = 'Copyright &copy; ' . date('Y') . ' ' . htmlentities($_SESSION['CURRENT_APP']['apps']['author-organization']) . '. All rights reserved';
        }
        // TODO: PAGE - EDIT | INIT - FOOTER - CODE
        if (!isset($page_data['footer']['code']))
        {
            $page_data['footer']['code'] = '';
        }
        if (!isset($page_data['code']['constructor']))
        {
            $page_data['code']['constructor'] = '';
        }
        if (!isset($page_data['code']['export']))
        {
            $page_data['code']['export'] = '';
        }
        // TODO: PAGE - EDIT | FORM
        $content .= '<form role="form" action="" method="post">';
        $content .= '<div class="row">';

        $content .= '<!-- left column -->';
        $content .= '<div class="col-md-6">';

        $content .= '<!-- general form elements -->';
        $content .= '<div class="box box-success">';
        $content .= '<div class="box-header with-border">';
        $content .= '<h3 class="box-title">';
        $content .= '<i class="fa fa-file-text"></i> ' . __e('Edit Page') . '';
        $content .= '</h3>';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i>';
        $content .= '</button>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<!-- /.box-header -->';
        $content .= '<!-- form start -->';

        $content .= '<div class="box-body">';
        $content .= '<p>' . __e('The page used for your application') . '</p>';

        $content .= '<div class="row">';

        $content .= '<div class="col-md-6">';
        $content .= '<!-- title -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Page Title') . '</label>';
        $content .= '<input type="text" name="pages[title]" class="form-control" value="' . htmlentities($page_data['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '" />';
        $content .= '<p class="help-block">' . __e('The title of the page that will be displayed') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="col-md-6">';
        $content .= '<!-- name -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Prefix Page') . '</label>';
        $content .= '<input type="text" name="pages[name]" class="form-control" value="' . htmlentities($page_data['name']) . '" readonly />';
        $content .= '<p class="help-block">' . __e('The unique name of the page, using <code>a-z</code> and <code>0-9</code> characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<div class="input-group">';
        $content .= '<label class="input-group-addon" for="icon-left">' . __e('Left Icon') . '</label>';
        $content .= '<input name="pages[icon-left]" type="text" class="form-control" id="icon-left" placeholder="paper" value="' . $page_data['icon-left'] . '" >';
        $content .= '<span class="input-group-addon" data-type="icon-picker" data-target="#icon-left" data-dialog="#ion-icon-dialog" title="Click here for get icon list" data-toggle="tooltip">';
        $content .= '<ion-icon name="' . $page_data['icon-left'] . '"></ion-icon>';
        $content .= '</span>';
        $content .= '</div>';
        $content .= '<p class="help-block">' . __e('Just an additional icon') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';


        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Parameters') . '</label>';
        $content .= '<input type="text" class="form-control" name="pages[param]" value="' . $page_data['param'] . '" placeholder="page_id"/>';
        $content .= '<p class="help-block">' . __e('Parameters used for dynamic pages that require an id, separated by <code>commas</code> and using <code>a-z</code>, <code>A-Z</code>, and <code>_</code> characters only') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Default Back Button') . '</label>';
        $content .= '' . $html_inlink_pages . '';
        $content .= '<p class="help-block">' . __e('When back button is clicked will return to the page?') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Corner Button') . '</label>';
        $content .= '' . $html_corner_button_pages . '';
        $content .= '<p class="help-block">' . __e('The button commonly used to display options') . '</p>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '<div class="col-md-6">';
        $content .= '<img src="./system/plugin/qrcode/?text=' . base64_encode('/' . $page_data['name']) . '" width="80" height="80" />';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '</div>';


        $content .= '<div class="col-md-6">';


        $content .= '<div class="nav-tabs-custom">';
        $content .= '<ul class="nav nav-tabs pull-right">';
        $content .= '<li><a href="#tab_4" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('StatusBar') . '</a></li>';
        $content .= '<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('Page Footer') . '</a></li>';
        $content .= '<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('Page Content') . '</a></li>';
        $content .= '<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-caret-right"></i> ' . __e('Page Header') . '</a></li>';
        $content .= '<li class="pull-left header"><i class="fa fa-gear"></i> ' . __e('Option') . '</li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        // TODO: PAGE - EDIT | FORM - HEADER
        $content .= '<div class="tab-pane active" id="tab_1">';
        $content .= '<p>' . __e('Headers are fixed regions at the top of a screen') . '</p>';
        $content .= '<div class="row">';


        $content .= '<div class="col-md-6">';
        $content .= '<!-- color -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Colors') . '</label>';
        $content .= '' . $html_header_color . '';
        $content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="col-md-6">';
        $content .= '<!-- header[mid][type] -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Layout Type') . '</label>';
        $content .= '' . $html_header_type . '';
        $content .= '<p class="help-block">' . __e('The type of header used') . '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - HEADER - CUSTOM
        if (!isset($page_data['header']['mid']['custom-code']))
        {
            $page_data['header']['mid']['custom-code'] = '';
        }
        $content .= '<div id="pages_header_custom">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Custom Code') . '</label>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.html</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>&lt;ion-header&gt;' . "\r\n\t" . '&lt;ion-toolbar&gt;Hello World&lt;/ion-toolbar&gt;' . "\r\n" . '&lt;/ion-header&gt;</pre></div>';
        $content .= '<textarea class="form-control" data-type="html5" name="pages[header][mid][custom-code]" >' . htmlentities($page_data['header']['mid']['custom-code']) . '</textarea>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - HEADER - SEARCH
        if (!isset($page_data['header']['mid']['search-label']))
        {
            $page_data['header']['mid']['search-label'] = '';
        }
        $content .= '<div id="pages_header_search">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Search Label') . '</label>';
        $content .= '<input type="text" name="pages[header][mid][search-label]" class="form-control" value="' . htmlentities($page_data['header']['mid']['search-label']) . '" /></td>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - HEADER - SEGMENT
        $content .= '<!-- header[mid][items] -->';
        $content .= '<div id="pages_header_segment">';
        $content .= '<div class="form-group">';
        $content .= '<label>Items for Segments</label>';
        $content .= '<p class="help-block">' . __e('Segment is a collection of buttons that are displayed in line, The fields below are required for segments') . '</p>';
        $content .= '<table class="table table-striped">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<th>Label</th>';
        $content .= '<th>Value</th>';
        $content .= '</tr>';
        $content .= '</thead>';
        $content .= '<tbody>';

        $content .= '<tr>';
        $content .= '<td><input type="text" name="pages[header][mid][items][0][label]" class="form-control" value="' . $page_data['header']['mid']['items'][0]['label'] . '" /></td>';
        $content .= '<td><input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" data-mask name="pages[header][mid][items][0][value]" class="form-control" value="' . $page_data['header']['mid']['items'][0]['value'] . '" /></td>';
        $content .= '</tr>';
        $content .= '<tr>';
        $content .= '<td><input type="text" name="pages[header][mid][items][1][label]" class="form-control" value="' . $page_data['header']['mid']['items'][1]['label'] . '"/></td>';
        $content .= '<td><input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" data-mask name="pages[header][mid][items][1][value]" class="form-control" value="' . $page_data['header']['mid']['items'][1]['value'] . '" /></td>';
        $content .= '</tr>';

        $content .= '<tr>';
        $content .= '<td><input type="text" name="pages[header][mid][items][2][label]" class="form-control" value="' . $page_data['header']['mid']['items'][2]['label'] . '"/></td>';
        $content .= '<td><input type="text" data-inputmask="\'mask\':\'B\',\'greedy\':false,\'repeat\':32" data-mask name="pages[header][mid][items][2][value]" class="form-control" value="' . $page_data['header']['mid']['items'][2]['value'] . '" /></td>';
        $content .= '</tr>';

        $content .= '<tr>';
        $content .= '<td></td>';
        $content .= '<td><p class="help-block">' . __e('Using <code>a-z</code>, <code>0-9</code> and <code>-</code> characters only') . '</p></td>';
        $content .= '</tr>';

        $content .= '</tbody>';
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '</div><!-- ./tab-pane -->';

        // TODO: PAGE - EDIT | FORM - CONTENT OPTION
        $content .= '<div class="tab-pane" id="tab_2">';
        $content .= '<p>' . __e('You can set background color, image for content') . '</p>';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-6">';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Background Color') . '</small></label>';
        $content .= $html_content_color;
        $content .= '<p class="help-block">' . __e('Color variation from the content') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Custom Color') . '</label>';
        $content .= '<input type="color" class="form-control" name="pages[content][custom-color]" id="content-custom-colors" placeholder="#dddddd" value="' . htmlentities($page_data['content']['custom-color']) . '" >';
        $content .= '<p class="help-block">' . __e('Color variation from the content') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';

        $content .= '</div><!-- ./row -->';

        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Background Image') . '</label>';
        $content .= '<div class="input-group">';
        $content .= '<input type="text" id="content-background" class="form-control" name="pages[content][background]" value="' . $page_data['content']['background'] . '" />';
        $content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
        $content .= '</div>';
        $content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
        $content .= '</div>';

        $content .= '</div><!-- ./tab-pane -->';


        // TODO: PAGE - EDIT | FORM - FOOTER
        $content .= '<div class="tab-pane" id="tab_3">';

        $content .= '<div class="row">';
        // TODO: PAGE - EDIT | FORM - FOOTER - COLORS
        $content .= '<div class="col-md-6">';
        $content .= '<!-- color -->';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Colors') . '</label>';
        $content .= '' . $html_footer_color . '';
        $content .= '<p class="help-block">' . __e('Background color for footer') . '</p>';
        $content .= '</div>';
        $content .= '</div>';


        $content .= '<div class="col-md-6">';
        // TODO: PAGE - EDIT | FORM - FOOTER - TYPE
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Layout Type') . '</label>';
        $content .= '' . $html_footer_type . '';
        $content .= '<p class="help-block">' . __e('The type of footer used') . '</p>';
        $content .= '</div><!-- ./form-group -->';
        $content .= '</div><!-- ./col-md-6 -->';
        $content .= '</div><!-- ./row -->';

        // TODO: PAGE - EDIT | FORM - FOOTER - TITLE

        $content .= '<div id="pages-footer-title">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Text') . '</label>';
        $content .= '<input type="text" name="pages[footer][title]" class="form-control" value="' . htmlentities($page_data['footer']['title']) . '" />';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - FOOTER - CUSTOM-CODE
        $content .= '<div id="pages-footer-code">';
        $content .= '<div class="form-group">';
        $content .= '<label>' . __e('Code') . '</label>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.html</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>&lt;ion-footer&gt;' . "\r\n\t" . '&lt;ion-toolbar&gt;Hello World&lt;/ion-footer&gt;' . "\r\n" . '&lt;/ion-footer&gt;</pre></div>';

        $content .= '<textarea  class="form-control" data-type="html5" name="pages[footer][code]" >' . htmlentities($page_data['footer']['code']) . '</textarea>';
        $content .= '</div>';
        $content .= '</div>';

        $content .= '</div><!-- ./tab-pane -->';

        if (!isset($page_data['statusbar']['style']))
        {
            $page_data['statusbar']['style'] = 'default';
        }
        if (!isset($page_data['statusbar']['backgroundcolor']))
        {
            $page_data['statusbar']['backgroundcolor'] = '#ddd';
        }

        // TODO: PAGE - EDIT | FORM - STATUSBAR
        $content .= '<div class="tab-pane" id="tab_4">';
        $html_statusbar_style = null;
        $html_statusbar_style .= '<select name="pages[statusbar][style]" class="form-control" id="statusbar-style">';
        foreach ($statusbar_style_options as $statusbar_style_option)
        {
            $selected = null;
            if ($statusbar_style_option['value'] == $page_data['statusbar']['style'])
            {
                $selected = 'selected';
            }
            $html_statusbar_style .= '<option ' . $selected . ' value="' . $statusbar_style_option['value'] . '">' . $statusbar_style_option['label'] . '</option>';
        }
        $html_statusbar_style .= '</select>';


        $content .= '<div class="row">';

        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label for="statusbar-style">' . __e('Style') . '</label>';
        $content .= '' . $html_statusbar_style . '';
        $content .= '<p class="help-block">' . __e('Set the status bar style') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';


        $content .= '<div class="col-md-6">';
        $content .= '<div class="form-group">';
        $content .= '<label for="statusbar-backgroundcolor">' . __e('Background Color') . '</label>';
        $content .= '<input type="color" class="form-control" name="pages[statusbar][backgroundcolor]" placeholder="#dddddd" value="' . $page_data['statusbar']['backgroundcolor'] . '" />';
        $content .= '<p class="help-block">' . __e('Set the background color of the statusbar') . '</p>';
        $content .= '</div>';
        $content .= '</div><!-- ./col-md-6 -->';

        $content .= '</div>';


        $content .= '</div><!-- ./tab-pane -->';

        $content .= '</div><!-- ./tab-content -->';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=html">' . __e('View Source Code') . '</a>';

        $content .= '</div><!-- ./box-footer-->';

        $content .= '</div><!-- ./nav nav-tabs -->';

        $content .= '</div><!-- ./col-md-6 -->';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - CONTENT

        $content .= '<div class="box box-danger">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-html5"></i> ' . __e('Page Content') . '';
        $content .= '<small> ' . __e('HTML5') . '</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';

        $content .= '<div class="box-body pad">';

        $link_wysiwyg_editor = './?p=pages&a=edit&wysiwyg&page-name=' . $page_selected;
        $link_code_editor = './?p=pages&a=edit&page-name=' . $page_selected;

        $content .= '<div class="pull-right">';
        $content .= '<div class="btn-group">';
        if (isset($_GET['wysiwyg']))
        {
            $content .= '<a class="btn btn-success" href="' . $link_code_editor . '"><i class="glyphicon glyphicon-edit"></i> ' . __e('Code Editor') . '</a>';
            $content .= '<a class="btn btn-success disabled"><i class="glyphicon glyphicon-edit"></i> ' . __e('WYSIWYG') . '</a>';
        } else
        {
            $content .= '<a class="btn btn-success disabled" ><i class="glyphicon glyphicon-edit"></i> ' . __e('Code Editor') . '</a>';
            $content .= '<a class="btn btn-success" href="' . $link_wysiwyg_editor . '"><i class="glyphicon glyphicon-edit"></i> ' . __e('WYSIWYG') . '</a>';
        }
        $content .= '</div>';
        $content .= '</div>';

        $content .= '<div class="pull-left">';

        $histories = $db->historyPage($page_selected);
        $content .= '<div class="btn-group">';
        $content .= '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">';
        $content .= '<i class="glyphicon glyphicon-repeat"></i> ' . __e('History') . ' <span class="caret"></span>';
        $content .= '</button>';
        $content .= '<ul class="dropdown-menu" role="menu">';
        foreach ($histories as $history)
        {
            $content .= '<li><a href="?p=pages&a=history&page-name=' . $page_selected . '&timestap=' . $history['timestap'] . '">' . date('Y-m-d H:i:s', $history['timestap']) . '</a></li>';
        }

        $content .= '</ul>';
        $content .= '</div>';

        $content .= '</div>';

        $content .= '<div class="clearfix"></div><br/>';
        $content .= '';
        if (isset($_GET['wysiwyg']))
        {
            $content .= '<textarea data-type="tinymce" id="page-content-html5" name="pages[content][html]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['content']['html']) . '</textarea>';
        } else
        {
            $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.html</code></p>';
            $content .= '<div class="example-code">' . __e('Example') . ':<pre>&lt;ion-list&gt;' . "\r\n\t" . '&lt;ion-item&gt;Hello World&lt;/ion-item&gt;' . "\r\n" . '&lt;/ion-list&gt;</pre></div>';
            $content .= '<textarea data-type="html5" id="page-content-html5" name="pages[content][html]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['content']['html']) . '</textarea>';
            $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        }

        $content .= '<br/>';

        $content .= '<div class="row">';
        $content .= '<div class="col-md-4">';
        $content .= '<table class="table no-margin">';
        $content .= '<tr>';
        $content .= '<td><input type="checkbox" class="flat-red" name="pages[content][enable-fullscreen]" ' . $enable_fullscreen . '/></td>';
        $content .= '<td>' . __e('Add fullscreen attributes to ion-content') . '<br/><span class="help-block">' . __e('Easy way to add fullscreen to ion-content') . '</span></td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '</div>';

        $content .= '<div class="col-md-4">';
        $content .= '<table class="table no-margin">';
        $content .= '<tr>';
        $content .= '<td><input type="checkbox" class="flat-red" name="pages[content][enable-padding]" ' . $enable_padding . '/></td>';
        $content .= '<td>' . __e('Add padding attributes to ion-content') . '<br/><span class="help-block">' . __e('Easy way to add padding to ion-content') . '</span></td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '</div>';

        $content .= '<div class="col-md-4">';
        $content .= '<table class="table no-margin">';
        $content .= '<tr>';
        $content .= '<td><input type="checkbox" class="flat-red" name="pages[content][disable-scroll]" ' . $disable_scroll . '/></td>';
        $content .= '<td>' . __e('Disable scroll') . '<br/><span class="help-block">' . __e('Set ion-content has non scrollable ') . '</span></td>';
        $content .= '</tr>';
        $content .= '</table>';
        $content .= '</div>';

        $content .= '</div>';


        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '<a class="btn btn-flat btn-info" href="./?p=pages&a=edit&page-name=' . $page_data['name'] . '" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=html">' . __e('View Source Code') . '</a>';
        $content .= '</div>';

        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - STYLES

        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-css3"></i> ' . __e('Page Styles') . '';
        $content .= '<small>' . __e('SCSS') . '</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';

        $content .= '<div class="box-body pad">';

        $content .= '<p>' . __e('Ionic Web Component using Shadow DOM, please read <a target="_blank" href="https://ionicframework.com/blog/shadow-dom-in-ionic-and-why-its-awesome/">here</a>') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.scss</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>ion-content{' . "\r\n\t" . '--background: #dddddd;' . "\r\n" . '}</pre></div>';

        $content .= '<textarea data-type="scss" id="page-content-scss" name="pages[content][scss]" placeholder="Sassy CSS Code" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['content']['scss']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-warning" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '<a class="btn btn-flat btn-info" href="./?p=pages&a=edit&page-name=' . $page_data['name'] . '" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=scss">' . __e('View Source Code') . '</a>';
        $content .= '</div>';

        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - SCRIPT

        // TODO: PAGE - EDIT | FORM - OUT-SCOPE
        $content .= '<div class="box box-default">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Out Scope') . ' <small>TypeScript</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';
        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('This code is outside the class/object, can also be used to create a new class/object/declare') . ' </p>';

        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>declare var blaBla:any;</pre></div>';
        $content .= '<textarea data-type="ts" id="page-code-export" name="pages[code][export]" placeholder="" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['code']['export']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '<a class="btn btn-flat btn-info" href="./?p=pages&a=edit&page-name=' . $page_data['name'] . '" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - CONSTRUCTOR
        $content .= '<div class="box box-warning">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Constructor') . ' <small>TypeScript</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';
        $content .= '<div class="box-body pad">';
                $content .= '<p> ' . __e('Write the code for the constructor function') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>this.blaBla();</pre></div>';
        $content .= '<textarea data-type="ts" id="page-code-constructor" name="pages[code][constructor]" placeholder="" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['code']['constructor']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';
        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '<a class="btn btn-flat btn-info" href="./?p=pages&a=edit&page-name=' . $page_data['name'] . '" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';
        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - OTHERS
        $content .= '<div class="box box-success">';
        $content .= '<div class="box-header">';
        $content .= '<h3 class="box-title"><i class="fa fa-code"></i> ' . __e('Other Functions') . '';
        $content .= '<small>' . __e('TypeScript') . '</small>';
        $content .= '</h3>';
        $content .= '<!-- tools box -->';
        $content .= '<div class="pull-right box-tools">';
        $content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
        $content .= '<i class="fa fa-minus"></i></button>';
        $content .= '</div>';
        $content .= '<!-- /. tools -->';
        $content .= '</div>';
        $content .= '<!-- /.box-header -->';

        $content .= '<div class="box-body pad">';
        $content .= '<p> ' . __e('Write your custom functions') . '</p>';
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.ts</code></p>';
        $content .= '<div class="example-code">' . __e('Example') . ':<pre>blaBla1(){....}' . "\r\n" . 'blaBla2(){....}</pre></div>';
        $content .= '<textarea data-type="ts" id="page-code-other" name="pages[code][other]" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">' . htmlentities($page_data['code']['other']) . '</textarea>';
        $content .= '<p class="note note-default">Press <kbd>CTRL + Space</kbd> for <code>' . __e('Auto-Completion') . '</code> and <kbd>F11</kbd> for <code>' . __e('Full Screen mode') . '</code></p>';
        $content .= '</div>';


        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '<a class="btn btn-flat btn-info" href="./?p=pages&a=edit&page-name=' . $page_data['name'] . '" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';

        $content .= '</div>';

        // TODO: PAGE - EDIT | FORM - MODULES
        $content .= '<div class="box box-danger">';
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
        $content .= '<p class="output-file">' . __e('Generated file') . ': <code>src/app/pages/' . $page_data['name'] . '/' . $page_data['name'] . '.page.scss</code></p>';

        $content .= '' . $ionic_angular_html . '';
        $content .= '</div>';

        $content .= '<div class="box-footer pad">';
        $content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;';
        $content .= '<a class="btn btn-flat btn-info" href="./?p=pages&a=edit&page-name=' . $page_data['name'] . '" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;';
        $content .= '<a class="btn btn btn-default btn-flat pull-right" target="blank" href="./system/plugin/viewsource/?page=' . $page_data['name'] . '&type=ts">' . __e('View Source Code') . '</a>';
        $content .= '</div>';

        $content .= '</div>';
        $content .= '</form>';

        break;
    case 'index':
        // TODO: PAGE - INDEX |
        if (!isset($_GET['page-name']))
        {
            $_GET['page-name'] = '';
        }
        if ($_GET['page-name'] == '')
        {
            header('Location: ./?p=pages&a=new');
        }
        $_SESSION['CURRENT_APP']['apps']['rootPage'] = htmlentities(trim($_GET['page-name']));
        $app_data = $_SESSION['CURRENT_APP']['apps'];
        $db->saveProject($app_data);
        $db->current();
        rebuild();
        $ref = $_SERVER["HTTP_REFERER"];
        header('Location: ' . $ref . '');
        break;
    case 'delete':
        // TODO: PAGE - DELETE |
        if (!isset($_GET['page-name']))
        {
            $_GET['page-name'] = '';
        }
        if ($_GET['page-name'] == '')
        {
            header('Location: ./?p=pages&a=new');
        }
        $db->deletePage($_GET['page-name']);
        $db->current();
        rebuild();
        header('Location: ./?p=pages&a=list');
        break;

        // TODO: PAGE - HISTORY |
    case 'history':
        if (!isset($_GET['page-name']))
        {
            $_GET['page-name'] = '';
        }

        if (!isset($_GET['timestap']))
        {
            $_GET['timestap'] = '';
        }

        if ($_GET['page-name'] == '')
        {
            header('Location: ./?p=pages&a=new');
        }

        $page_name = $string->toFileName($_GET['page-name']);
        $timestamp = $_GET['timestap'];

        if ($timestamp == '')
        {
            header('Location: ./?p=pages&a=edit&page-name=' . $page_name);
        }


        $db->restorePage($page_name, $timestamp);
        $db->current();
        rebuild();
        header('Location: ./?p=pages&a=edit&page-name=' . $page_name);
        break;
}


$content .= '';
$content .= $icon->display('ion');
$page_js = null;
// TODO: JS
$page_js = '
var layoutForm = function(){
    var LayoutType = $("#pages_header_mid_type").val();
    
    // hidden all form
    $("#pages_header_segment").attr("class","hide");
    $("#pages_header_search").attr("class","hide");
    $("#pages_header_custom").attr("class","hide");
     
    switch(LayoutType){
        case "segment":
            $("#pages_header_segment").attr("class","");
            break
        case "search":
            $("#pages_header_search").attr("class","");
            break
        case "search-with-barcode":
            $("#pages_header_search").attr("class","");
            break
        case "custom-header":
            $("#pages_header_custom").attr("class","");
            break
    }

                
};



$(document).ready(function() {
    $("#pages_header_mid_type").click(function(){
        layoutForm();
    });
    
    $("#pages-footer-type").click(function(){
        layoutFooter();
    });
    
    
    $(".item-list").sortable({
        opacity: 0.5,
        items: ".item",
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: false,
        zIndex: 999999
    });    
    
});



var layoutFooter = function(){
    var LayoutType = $("#pages-footer-type").val();
    
    // hidden all form
    $("#pages-footer-title").attr("class","hide");
    $("#pages-footer-code").attr("class","hide");
    
    switch(LayoutType){
        case "title":
                $("#pages-footer-title").attr("class","");
                $("#pages-footer-code").attr("class","hide");
            break
        case "code":
                $("#pages-footer-title").attr("class","hide");
                $("#pages-footer-code").attr("class","");
            break;
    }
        
}

// init
layoutForm();
layoutFooter();
';

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = $page_title;
$template->page_desc = __e('Create or edit your pages');
$template->page_content = $content;

?>