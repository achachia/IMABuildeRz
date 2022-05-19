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

$max_menu = 25;
$content = $breadcrumb = $form_content = $html_color_option = null;
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
if (!isset($_SESSION['CURRENT_MENU']))
{
    $_SESSION['CURRENT_MENU'] = 'box';
}

if (isset($_GET['item']))
{
    if ($_GET['item'] == 'list')
    {
        $_SESSION['CURRENT_MENU'] = 'list';
    } else
    {
        $_SESSION['CURRENT_MENU'] = 'box';
    }
    header("Location: ./?p=menus&" . time());
}

$db = new jsmDatabase();
$icon = new jsmIcon();
$db->current();
$breadcrumb = $content = $list_item_menu = $_list_item_menu = null;
$page_title = '(IMAB) Menus';
if (!isset($_SESSION['CURRENT_APP']['pages']))
{
    $_SESSION['CURRENT_APP']['pages'] = array();
}
if (!isset($_SESSION['CURRENT_APP']['menus']['items']))
{
    $_SESSION['CURRENT_APP']['menus']['items'] = array();
}
// TODO: SAVE MENU
if (isset($_POST['menus']))
{
    $_newMenus = $_POST['menus'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The menus has been successfully edited');
    $db->saveMenu($_newMenus);
    $db->current();
    rebuild();
    header("Location: ./?p=menus&" . time());
}

// TODO: RESET ACTION
if ($_GET['a'] == 'reset')
{
    $jsmDefault = new jsmDefault();
    $defaultMenus = $jsmDefault->menus();
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The menus has been successfully reseted');
    $db->saveMenu($defaultMenus);
    $db->current();
    rebuild();
    header("Location: ./?p=menus");
}

$current_items_menu = array();
$current_menu = $_SESSION['CURRENT_APP']['menus'];
$current_app = $_SESSION['CURRENT_APP']['apps'];
$current_directives = $_SESSION['CURRENT_APP']['directives'];


// TODO: MENU -> ITEMS -> TYPE
$option_item_types[] = array('val' => 'title', 'label' => __e('Title/Divider'));
$option_item_types[] = array('val' => 'inlink', 'label' => __e('Goto : Internal Link'));
$option_item_types[] = array('val' => 'inlink-param', 'label' => __e('Goto : Internal Link + Parameter'));

$option_item_types[] = array('val' => 'webview', 'label' => __e('Open With : In App Webview (Android Only)'));
$option_item_types[] = array('val' => 'appbrowser', 'label' => __e('Open With : In App Browser (Android Only)'));
$option_item_types[] = array('val' => 'systembrowser', 'label' => __e('Open With : System Browser'));
$option_item_types[] = array('val' => 'mail', 'label' => __e('Open With : Email Apps'));
$option_item_types[] = array('val' => 'sms', 'label' => __e('Open With : SMS Apps'));
$option_item_types[] = array('val' => 'call', 'label' => __e('Open With : Call Apps'));
$option_item_types[] = array('val' => 'geo', 'label' => __e('Open With : MAP/GEO Apps'));
$option_item_types[] = array('val' => 'playstore', 'label' => __e('Open With : GooglePlay App / Rate This App (Android Only)'));
$option_item_types[] = array('val' => 'appstore', 'label' => __e('Open With : AppStore / Rate This App (iOS Only)'));


if (isset($current_directives['barcode-scanner']))
{
    $option_item_types[] = array('val' => 'barcode-inlink', 'label' => __e('[Additional Directives] Scan Barcode : Goto Internal Link'));
    $option_item_types[] = array('val' => 'barcode-extlink', 'label' => __e('[Additional Directives] Scan Barcode : Open External Link'));
    $option_item_types[] = array('val' => 'barcode-alert', 'label' => __e('[Additional Directives] Scan Barcode : Show in Alert'));
}

if (isset($current_directives['play-with-youtube-app']))
{
    $option_item_types[] = array('val' => 'youtube-app', 'label' => __e('[Additional Directives] Play With : Youtube App'));
}

if (isset($current_directives['streaming-media']))
{
    //$option_item_types[] = array('val' => 'streaming-media', 'label' => __e('[Additional Directives] Play With : Native Streaming Media (Video)'));
}


if (isset($current_directives['x-social-sharing']))
{
    $option_item_types[] = array('val' => 'x-social-sharing', 'label' => __e('[Additional Directives] X - Social Sharing'));
}

if (isset($current_directives['text-to-speech']))
{
    $option_item_types[] = array('val' => 'text-to-speech', 'label' => __e('[Additional Directives] Text To Speech'));
}

if (isset($current_directives['take-screenshot']))
{
    $option_item_types[] = array('val' => 'take-screenshot', 'label' => __e('[Additional Directives] Take Screenshot'));
}

if (isset($current_directives['pay-with-paypal']))
{
    $option_item_types[] = array('val' => 'pay-with-paypal', 'label' => __e('[Additional Directives] Pay With Paypal'));
}

if (isset($current_directives['instagram-app']))
{
    //$option_item_types[] = array('val' => 'instagram-app', 'label' => __e('[Additional Directives] Share With Instagram App'));
}

if (isset($current_directives['document-scanner']))
{
    $option_item_types[] = array('val' => 'document-scanner', 'label' => __e('[Additional Directives] Document Scanner'));
}

if (isset($current_directives['app-rate']))
{
    $option_item_types[] = array('val' => 'app-rate', 'label' => __e('[Additional Directives] App Rate With Dialog'));
}

foreach ($_SESSION['CURRENT_APP']['menus']['items'] as $item)
{
    $current_items_menu[] = $item;
}
if (!isset($_GET['max']))
{
    $max_menu = count($current_items_menu);
} else
{
    $max_menu = (int)$_GET['max'];
}

// TODO: MENU -> ITEMS -> ADD NEW ITEM
if (isset($_POST['max-item']))
{
    $get_max_item = (int)$_POST['max-item'];
    if ($get_max_item != 0)
    {
        $new_max_item = $get_max_item + $max_menu;
        header("Location: ./?p=menus&max=" . $new_max_item . "#new-item");
    }
}


$list_item_menu = '<div class="btn-group">';
if ($_SESSION['CURRENT_MENU'] == 'list')
{
    $class_menu_list = 'item col-md-12 col-sm-12 col-xs-12';
    $list_item_menu .= '<a href="./?p=menus&item=box" class="btn btn-default "><i class="fa fa-th"></i> Grid</a>';
    $list_item_menu .= '<a href="./?p=menus&item=list" class="btn btn-default disabled"><i class="fa fa-navicon"></i> List</a>';
} else
{
    $class_menu_list = 'item col-md-4 col-sm-6 col-xs-12';
    $list_item_menu .= '<a href="./?p=menus&item=box" class="btn btn-default disabled"><i class="fa fa-th"></i> Grid</a>';
    $list_item_menu .= '<a href="./?p=menus&item=list" class="btn btn-default "><i class="fa fa-navicon"></i> List</a>';
}

$list_item_menu .= '</div>';
$list_item_menu .= '<hr/>';

$list_item_menu .= '<div class="item-list">';

for ($i = 0; $i < $max_menu; $i++)
{
    $no = $i + 1;
    $item_desc = null;
    if (isset($current_items_menu[$i]))
    {
        $item_desc = $current_items_menu[$i]['desc'];
    }
    $item_label = 'New Item ' . $no;
    if (isset($current_items_menu[$i]))
    {
        $item_label = $current_items_menu[$i]['label'];
    }
    $item_var = null;
    if (isset($current_items_menu[$i]))
    {
        $item_var = $current_items_menu[$i]['var'];
    }


    $item_value = null;
    if (isset($current_items_menu[$i]))
    {
        $item_value = $current_items_menu[$i]['value'];
    }

    $item_icon_left = 'menu';
    if (isset($current_items_menu[$i]))
    {
        $item_icon_left = $current_items_menu[$i]['icon-left'];
    }

    $item_icon_right = null;
    if (isset($current_items_menu[$i]))
    {
        if (!isset($current_items_menu[$i]['icon-right']))
        {
            $current_items_menu[$i]['icon-right'] = '';
        }
        $item_icon_right = $current_items_menu[$i]['icon-right'];
    }
    $menu_item_type = null;
    if (isset($current_items_menu[$i]))
    {
        $menu_item_type = $current_items_menu[$i]['type'];
    }
    $html_list_item_type = null;
    $html_list_item_type .= '<select id="item-type-' . $no . '" name="menus[items][' . $i . '][type]" class="form-control item-type" data-target="' . $no . '">';
    foreach ($option_item_types as $opt_item_type)
    {
        $item_selected = '';
        if (trim($opt_item_type['val']) == trim($menu_item_type))
        {
            $item_selected = ' selected ';
        }
        $html_list_item_type .= '<option value="' . $opt_item_type['val'] . '"' . $item_selected . '>';
        $html_list_item_type .= $opt_item_type['label'];
        $html_list_item_type .= '</option>';
    }
    $html_list_item_type .= '</select>';


    $item_color_label = '';
    if (isset($current_items_menu[$i]['color-label']))
    {
        $item_color_label = $current_items_menu[$i]['color-label'];
    }

    $html_color_label = '<select class="form-control select-color" data-color="' . $item_color_label . '" name="menus[items][' . $i . '][color-label]" >';
    foreach ($color_name as $_color)
    {
        $selected = '';
        if ($item_color_label == $_color['value'])
        {
            $selected = 'selected';
        }
        $html_color_label .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
    }
    $html_color_label .= '</select>';


    $item_color_bg = 'light';
    if (isset($current_items_menu[$i]['color-bg']))
    {
        $item_color_bg = $current_items_menu[$i]['color-bg'];
    }
    $html_color_bg = '<select class="form-control select-color" data-color="' . $item_color_bg . '" name="menus[items][' . $i . '][color-bg]" >';
    foreach ($color_name as $_color)
    {
        $selected = '';
        if ($item_color_bg == $_color['value'])
        {
            $selected = 'selected';
        }
        $html_color_bg .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
    }
    $html_color_bg .= '</select>';


    $item_color_icon_left = '';
    if (isset($current_items_menu[$i]['color-icon-left']))
    {
        $item_color_icon_left = $current_items_menu[$i]['color-icon-left'];
    }
    $html_color_icon_left = '<select data-color="' . $item_color_icon_left . '" class="form-control ' . $item_color_icon_left . ' select-color" name="menus[items][' . $i . '][color-icon-left]" >';
    foreach ($color_name as $_color)
    {
        $selected = '';
        if ($item_color_icon_left == $_color['value'])
        {
            $selected = 'selected';
        }
        $html_color_icon_left .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
    }
    $html_color_icon_left .= '</select>';


    $item_color_icon_right = '';
    if (isset($current_items_menu[$i]['color-icon-right']))
    {
        $item_color_icon_right = $current_items_menu[$i]['color-icon-right'];
    }
    $html_color_icon_right = '<select data-color="' . $item_color_icon_right . '" class="form-control select-color" name="menus[items][' . $i . '][color-icon-right]" >';
    foreach ($color_name as $_color)
    {
        $selected = '';
        if ($item_color_icon_right == $_color['value'])
        {
            $selected = 'selected';
        }
        $html_color_icon_right .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
    }
    $html_color_icon_right .= '</select>';

    $html_inlink_pages = '<select class="form-control" name="menus[items][' . $i . '][page]">';
    $html_inlink_pages .= '<option value="">' . __e('None') . '</option>';
    foreach ($_SESSION['CURRENT_APP']['pages'] as $list_page)
    {
        $selected = '';
        if ($item_var == $list_page['var'])
        {
            $selected = 'selected';
        }
        $html_inlink_pages .= '<option value="' . $list_page['var'] . '" ' . $selected . '>' . strip_tags($list_page['title']) . ' (' . $list_page['var'] . ')</option>';
    }
    $html_inlink_pages .= '</select>';

    $item_icon_hide = 'hide';
    $item_var_page_hide = 'hide';
    $item_var_value_hide = 'hide';

    switch ($menu_item_type)
    {
        case "title":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = 'hide';
            break;
        case "inlink":
            $item_var_page_hide = '';
            $item_var_value_hide = 'hide';
            break;

        case "inlink-param":
            $item_var_page_hide = '';
            $item_var_value_hide = '';
            break;

        case "webview":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "appbrowser":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "systembrowser":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "mail":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "sms":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "call":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "geo":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "playstore":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "appstore":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "youtube-app":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;
        case "streaming-media":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        case "text-to-speech":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        case "instagram-app":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        case "pay-with-paypal":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        case "x-social-sharing":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        case "take-screenshot":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        case "document-scanner":
            $item_var_page_hide = 'hide';
            $item_var_value_hide = '';
            break;

        default:

    }

    if ($menu_item_type != 'title')
    {
        $item_icon_hide = '';
    }

    // TODO: FORM --|-- ITEMS

    $list_item_menu .= '
     <div class="' . $class_menu_list . '" id="menu-item-' . $no . '"> <!-- item -->    
     
        <div class="">
            <div class="info-box bg-default">
                <span class="handle cursor-move info-box-icon" data-toggle="tooltip" title="' . __e('Click on and drag an item to another spot within this list.') . '">        
                    <ion-icon class="icon ima-co-' . $item_color_icon_left . '" name="' . $item_icon_left . '"></ion-icon>
                </span>
                <div class="info-box-content">
                    
                    <!-- Split button -->
                    
                    <div class="btn-group pull-right">
                    
                      <button type="button" class="btn btn-flat btn-sm btn-default" data-toggle="modal" onClick="openDialog(' . $no . ');" data-target="#item-dialog-edit-' . $no . '"><i class="fa fa-edit"></i></button>
                      
                      <button type="button" class="btn btn-flat btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle</span>
                      </button>
                      
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#" data-toggle="modal" data-target="#item-dialog-edit-' . $no . '"><i class="fa fa-edit"></i> ' . __e('Edit') . '</a></li>
                        <li><a class="remove-item" href="#" data-target="#menu-item-' . $no . '"><i class="fa fa-trash"></i> ' . __e('Delete') . '</a></li>
                      </ul>
                      
                    </div>

                    <span class="info-box-text ima-co-' . $item_color_label . '">' . htmlentities($menu_item_type) . '</span>
                    <span class="info-box-number ima-co-' . $item_color_label . '">' . htmlentities(strip_tags($item_label)) . '</span>
                    
                </div>
                
                <!-- /.info-box-content -->
                
            </div>
        </div>
       
                   
        
       <div class="modal fade" id="item-dialog-edit-' . $no . '" tabindex="-1" role="dialog" aria-labelledby="item-dialog-' . $no . '" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-default">
            <div class="modal-content">
            
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">' . __e('Item') . ' ' . strip_tags($item_label) . '</h4>
              </div>
      
                <div class="modal-body">
                
                
                        <div class="row">
                        
                            <div class="col-md-6">
                                
                              <div class="form-group">
                                <label for="" class="col-sm-3 control-label">' . __e('Item Type') . '</label>
                                <div class="col-sm-9"> 
                                    ' . $html_list_item_type . '
                                    <span class="help-block">' . __e('Menu type to be used, To add more item types, go to the <code>Directives</code> -&raquo; <code>Additional Directives</code>') . '</span>
                                </div>
                              </div>
                               
                              <div class="form-group">
                                <label for="" class="col-sm-3 control-label">' . __e('Label') . ' <span class="red">***</span></label>
                                <div class="col-sm-9"> 
                                    <input dir="' . $current_app['app-direction'] . '" required name="menus[items][' . $i . '][label]" value="' . htmlentities($item_label) . '" type="text" class="form-control" placeholder="Menu ' . $no . '"/>
                                    <span class="help-block">' . __e('Text that appears on the menu') . '</span>
                                </div>
                              </div>
                            
                            <hr/>                
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">' . __e('Variable') . '</label>
                                <div class="col-sm-9"> 
                                    <input name="menus[items][' . $i . '][var]" value="' . htmlentities($item_var) . '" type="text" class="form-control" placeholder="menu_' . $no . '"/>
                                    <span class="help-block">' . __e('the variables used are only a-z and _') . '</span>
                                </div>
                            </div>
                            
                            <div class="' . $item_var_page_hide . '" id="item-var-page-' . $no . '">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">' . __e('Page') . '</label>
                                    <div class="col-sm-9"> 
                                        ' . $html_inlink_pages . '
                                        <span class="help-block">' . __e('Link to page') . '</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="' . $item_var_value_hide . '" id="item-var-value-' . $no . '">                            
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label"><span id="field-item-value-label-' . $no . '">' . __e('Value') . '</span></label>
                                    <div class="col-sm-9"> 
                                        <input id="field-item-value-' . $no . '" name="menus[items][' . $i . '][value]" value="' . htmlentities($item_value) . '" type="text" class="form-control" placeholder="http://ihsana.com/"/>
                                        <span id="field-item-value-help-' . $no . '" class="help-block">' . __e('Used for values like: URL, Phone, Email, Geo or App ID') . '</span>
                                    </div>
                                </div>
                            </div>

                           <hr/>                                              
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label"><span id="field-item-desc-label-' . $no . '">' . __e('Description') . '</span></label>
                                <div class="col-sm-9"> 
                                   <input id="field-item-desc-' . $no . '" type="text" name="menus[items][' . $i . '][desc]" value="' . htmlentities($item_desc) . '" class="form-control" placeholder=""/>
                                   <span id="field-item-desc-help-' . $no . '" class="help-block">' . __e('This is just additional information') . '</span>
                                </div>
                            </div>             
                              
                        </div>
                        
                        <div class="col-md-6">  
                        
                           
                            <div class="form-group">
                                <label for="" class="col-sm-5 control-label">' . __e('Color for Label') . '</label>
                                <div class="col-sm-7"> 
                                    ' . $html_color_label . '
                                    <span class="help-block">' . __e('The color used for the label') . '</span>
                                </div>
                            </div>
                            
                            <hr/>
                            
                            <div class="form-group"> 
                                <label for="" class="col-sm-5 control-label">' . __e('Left Icon') . '</label>
                                <div class="col-sm-7"> 
                                    <div class="input-group">
                                        <input name="menus[items][' . $i . '][icon-left]" id="menus-items-' . $i . '-icon-left" value="' . htmlentities($item_icon_left) . '" type="text" class="form-control" placeholder="bulb"/>
                                        <span class="input-group-addon pointer" data-toggle="tooltip" data-placement="top" title="click here to pick the icon" data-type="icon-picker" data-dialog="#ion-icon-dialog" data-target="#menus-items-' . $i . '-icon-left">
                                            <ion-icon class="" name="' . htmlentities($item_icon_left) . '"></ion-icon>
                                        </span>
                                    </div>
                                    <span class="help-block">' . __e('Icons in the left position of the label') . '</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="col-sm-5 control-label">' . __e('Color for Left Icon') . '</label>
                                <div class="col-sm-7"> 
                                ' . $html_color_icon_left . '
                                <span class="help-block">' . __e('The color used for the icon on the left') . '</span>
                                </div>
                            </div>
                            
                         <div class="' . $item_icon_hide . '" id="item-icon-hide-' . $no . '">   
                            
                            
                            <hr/>
                            
                                           
                            <div class="form-group"> 
                                <label for="" class="col-sm-5 control-label">' . __e('Right Icon') . '</label>
                                <div class="col-sm-7"> 
                                    <div class="input-group">
                                        <input name="menus[items][' . $i . '][icon-right]" id="menus-items-' . $i . '-icon-right" value="' . htmlentities($item_icon_right) . '" type="text" class="form-control" placeholder="arrow-dropright"/>
                                        <span class="pointer input-group-addon" data-toggle="tooltip" data-placement="top" title="click here to pick the icon" data-type="icon-picker" data-dialog="#ion-icon-dialog" data-target="#menus-items-' . $i . '-icon-right">
                                            <!--i id="preview-menus-items-' . $i . '-icon-right" class="pointer icon ion-' . htmlentities($item_icon_right) . ' ion-md-' . htmlentities($item_icon_right) . '" data-type="icon-picker" data-dialog="#ion-icon-dialog" data-target="#menus-items-' . $i . '-icon-right">&nbsp;&nbsp;</i-->
                                            <ion-icon class="" name="' . htmlentities($item_icon_right) . '"></ion-icon>
                                        </span>
                                    </div>
                                    <span class="help-block">' . __e('Icons in the right position of the label') . '</span>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="col-sm-5 control-label">' . __e('Color for Right Icon') . '</label>
                                <div class="col-sm-7"> 
                                    ' . $html_color_icon_right . '
                                    <span class="help-block">' . __e('The color used for the icon on the right') . '</span>
                                </div>
                            </div>
                             
                            
                            </div>
                            
                            
                        </div>
                           
                       </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>
                        
                    </div>
                </div>
            </div>
       </div>   
        
     </div>
     <!-- /.item -->    
        ';


}
$list_item_menu .= '</div>';

$list_item_menu .= '<div id="new-item" class="col-md-12"></div>';

// TODO: FORM --|-- HEADER COLOR
$item_color_header = '';
if (isset($current_menu['color-header']))
{
    $item_color_header = $current_menu['color-header'];
}
$html_color_header = '<select class="form-control select-color " name="menus[color-header]" data-color="' . $item_color_header . '">';
foreach ($color_name as $_color)
{
    $selected = '';
    if ($item_color_header == $_color['value'])
    {
        $selected = 'selected';
    }
    $html_color_header .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
}
$html_color_header .= '</select>';

// TODO: FORM --|-- BACKGROUND CONTENT COLOR
$item_color_content = '';
if (isset($current_menu['color-content-bg']))
{
    $item_color_content = $current_menu['color-content-bg'];
}
$html_color_content_bg = '<select class="form-control select-color " name="menus[color-content-bg]" data-color="' . $item_color_content . '">';
$_color_name = $color_name;
$_color_name[] = array('value' => 'image', 'label' => 'Image Background');
foreach ($_color_name as $_color)
{
    $selected = '';
    if ($item_color_content == $_color['value'])
    {
        $selected = 'selected';
    }
    $html_color_content_bg .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
}

$html_color_content_bg .= '</select>';


$item_image_content_bg = '';
if (isset($current_menu['image-content-bg']))
{
    $item_image_content_bg = $current_menu['image-content-bg'];
}


if (!isset($current_menu['text-header']))
{
    $current_menu['text-header'] = 'Menu';
}

if (!isset($current_menu['text-subheader']))
{
    $current_menu['text-subheader'] = '';
}

if (!isset($current_menu['expanded-background']))
{
    $current_menu['expanded-background'] = 'assets/images/background/expanded-menu.png';
}


if (!isset($current_menu['ion-header']))
{
    $current_menu['ion-header'] = 'default-header';
}


if (!isset($current_menu['side']))
{
    $current_menu['side'] = 'start';
}

$side_menus[] = 'start';
$side_menus[] = 'end';
$html_side_menu = '<select class="form-control" name="menus[side]">';
foreach ($side_menus as $side_menu)
{
    $selected = '';
    if ($current_menu['side'] == $side_menu)
    {
        $selected = 'selected';
    }
    $html_side_menu .= '<option value="' . $side_menu . '" ' . $selected . '>' . ucwords($side_menu) . '</option>';
}
$html_side_menu .= '</select>';


if (!isset($current_menu['type']))
{
    $current_menu['type'] = 'push';
}


if (!isset($current_menu['custom-header']))
{
    $current_menu['custom-header'] = '';
}


$type_menus[] = 'overlay';
$type_menus[] = 'reveal';
$type_menus[] = 'push';

$html_type_menu = '<select class="form-control" name="menus[type]">';
foreach ($type_menus as $type_menu)
{
    $selected = '';
    if ($current_menu['type'] == $type_menu)
    {
        $selected = 'selected';
    }
    $html_type_menu .= '<option value="' . $type_menu . '" ' . $selected . '>' . ucwords($type_menu) . '</option>';
}
$html_type_menu .= '</select>';


$html_lines = null;
$ion_lines[] = 'undefined';
$ion_lines[] = 'inset';
$ion_lines[] = 'full';
$ion_lines[] = 'none';

$html_lines = '<select class="form-control" name="menus[lines]">';
foreach ($ion_lines as $ion_line)
{
    $selected = '';
    if (!isset($current_menu['lines']))
    {
        $current_menu['lines'] = 'inset';
    }
    if ($current_menu['lines'] == $ion_line)
    {
        $selected = 'selected';
    }
    $html_lines .= '<option value="' . $ion_line . '" ' . $selected . '>' . ucwords($ion_line) . '</option>';
}
$html_lines .= '</select>';


$option_ion_header[] = array('value' => 'default-header', 'label' => 'Default Header');
$option_ion_header[] = array('value' => 'remove-header', 'label' => 'Remove Header');
$option_ion_header[] = array('value' => 'expanded-header', 'label' => 'Expanded Header');
$option_ion_header[] = array('value' => 'custom-header', 'label' => 'Custom Code');

$ion_header = '<select class="form-control" id="menus-ion-header" name="menus[ion-header]">' . "\r\n";
foreach ($option_ion_header as $option)
{
    $selected = '';
    if ($current_menu['ion-header'] == $option['value'])
    {
        $selected = 'selected';
    }
    $ion_header .= '<option value="' . $option['value'] . '" ' . $selected . '>' . $option['label'] . '</option>' . "\r\n";
}
$ion_header .= '</select>' . "\r\n";


// TODO: LAYOUT --|-- BREADCRUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Menu') . '</li>';
$breadcrumb .= '</ol>';

// TODO: LAYOUT --|-- CONTENT
$content .= '<form action="" method="post" >' . "\r\n";
$content .= '<div class="row"><!--row-top-menu-->' . "\r\n";

$content .= '<div class="col-md-6"><!--general-->' . "\r\n";
$content .= '<div class="box box-info">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-th"></i>  ' . __e('General') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";

$content .= '<div class="row">' . "\r\n";

$content .= '<div class="col-xs-4 col-md-4">' . "\r\n";
$content .= '<label>' . __e('New Item') . '</label>' . "\r\n";
$content .= '<div class="input-group">';
$content .= '<input value="0" type="number" max="100" min="0" class="form-control" name="max-item">' . "\r\n";
$content .= '<span class="input-group-btn">' . "\r\n";
$content .= '<input type="submit" class="btn btn-flat btn-success" value="' . __e('Add Item') . '" />' . "\r\n";
$content .= '</span>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<p class="help-block">' . __e('Write the number of the many menus added') . '</p>' . "\r\n";
$content .= '</div><!-- ./col-md-4 -->' . "\r\n";

$content .= '<div class="col-xs-4 col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Menu Position') . '</label>' . "\r\n";
$content .= $html_side_menu;
$content .= '<p class="help-block">' . __e('Which side of the view the menu should be placed') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div> <!-- ./col-md-4 -->' . "\r\n";


$content .= '<div class="col-xs-4 col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Menu Type') . '</label>' . "\r\n";
$content .= $html_type_menu;
$content .= '<p class="help-block">' . __e('The display type of the menu') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div> <!-- ./col-md-4 -->' . "\r\n";
$content .= '</div>' . "\r\n";

$content .= '<div class="row">' . "\r\n";
$content .= '<div class="col-xs-4 col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Lines of Items') . '</label>' . "\r\n";
$content .= $html_lines;
$content .= '<p class="help-block">' . __e('How the bottom border should be displayed on the item') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div> <!-- ./col-md-4 -->' . "\r\n";


$content .= '<div class="col-xs-4 col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Color Background') . '</label>' . "\r\n";
$content .= $html_color_content_bg;
$content .= '<p class="help-block">' . __e('The color that will be used for background of content in the sidebar') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div> <!-- ./col-md-4 -->' . "\r\n";

$content .= '<div class="col-xs-4 col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Image Background') . '</label>' . "\r\n";
$content .= '<div class="input-group">';
$content .= '<input type="text" class="form-control" name="menus[image-content-bg]" id="menus-image-content-bg" placeholder="./assets/images/background/menu.jpg"  value="' . htmlentities($item_image_content_bg) . '" />' . "\r\n";
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#menus-image-content-bg" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The image for expanded background') . '</p>' . "\r\n";
$content .= '</div><!-- ./form-group -->' . "\r\n";
$content .= '</div><!-- ./col-md-4 -->' . "\r\n";

$content .= '</div>' . "\r\n";


$content .= '</div><!--./box-body-->' . "\r\n";
$content .= '</div><!--./box-info-->' . "\r\n";
$content .= '</div><!--./general-->' . "\r\n";

$content .= '<div class="col-md-6"><!--header-->' . "\r\n";
$content .= '<div class="box box-warning">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-header"></i>  ' . __e('Header') . '</h3>' . "\r\n";
$content .= '<div class="pull-right box-tools">' . "\r\n";
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">' . "\r\n";
$content .= '<i class="fa fa-minus"></i>' . "\r\n";
$content .= '</button>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '<div class="box-body">' . "\r\n";

$content .= '<div class="row">' . "\r\n";

$content .= '<div class="col-md-4">' . "\r\n";

$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Ion Header') . '</label>' . "\r\n";
$content .= $ion_header;
$content .= '<p class="help-block">' . __e('Select the header layout needed?') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div>' . "\r\n";


$content .= '<div class="col-md-4">' . "\r\n";

$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Text Header') . '</label>' . "\r\n";
$content .= '<input type="text" dir="' . $current_app['app-direction'] . '" class="form-control" name="menus[text-header]" value="' . htmlentities($current_menu['text-header']) . '" placeholder="Kid<br>Stories"/>' . "\r\n";
$content .= '<p class="help-block">' . __e('The text that will appear on the header title in the sidebar') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div> <!-- ./col-md-4 -->' . "\r\n";

$content .= '<div class="col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Color') . '</label>' . "\r\n";
$content .= $html_color_header;
$content .= '<p class="help-block">' . __e('The color that will be used for the header in the sidebar') . '</p>' . "\r\n";
$content .= '</div>' . "\r\n";
$content .= '</div> <!-- ./col-md-4 -->' . "\r\n";

$content .= '</div><!-- ./row -->' . "\r\n";


$content .= '<div id="menus-expanded-option" class="row">' . "\r\n";

$content .= '<div class="col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Text Sub Header') . '</label>' . "\r\n";
$content .= '<input type="text" dir="' . $current_app['app-direction'] . '" class="form-control" name="menus[text-subheader]" value="' . htmlentities($current_menu['text-subheader']) . '" placeholder="Collection of stories for children"/>' . "\r\n";
$content .= '<p class="help-block">' . __e('The text that will appear on the sub header title in the sidebar') . '</p>' . "\r\n";
$content .= '</div><!-- ./col-md-4 -->' . "\r\n";
$content .= '</div> <!-- ./form-group -->' . "\r\n";

$content .= '<div class="col-md-4">' . "\r\n";
$content .= '<div class="form-group">' . "\r\n";
$content .= '<label>' . __e('Expanded Background') . '</label>' . "\r\n";
$content .= '<div class="input-group">';
$content .= '<input type="text" class="form-control" name="menus[expanded-background]" id="menus-expanded-background" placeholder="./assets/images/background/menu.jpg"  value="' . htmlentities($current_menu['expanded-background']) . '" />' . "\r\n";
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#menus-expanded-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The image for expanded background') . '</p>' . "\r\n";
$content .= '</div><!-- ./form-group -->' . "\r\n";
$content .= '</div><!-- ./col-md-4 -->' . "\r\n";
$content .= '</div><!-- ./row -->' . "\r\n";

$content .= '<div id="menus-custom-header" class="row">' . "\r\n";
$content .= '<div class="col-md-12">' . "\r\n";
$content .= '<textarea data-type="html5" name="menus[custom-header]">' . htmlentities($current_menu['custom-header']) . '</textarea>' . "\r\n";
$content .= '</div><!-- ./col-md-12 -->' . "\r\n";
$content .= '</div><!-- ./row -->' . "\r\n";

$content .= '</div><!--./box-body-->' . "\r\n";
$content .= '</div><!--./box-info-->' . "\r\n";


$content .= '</div>' . "\r\n";


$content .= '<div class="col-md-0"><!--main-menu-->' . "\r\n";

$content .= '</div><!--./main-menu-->' . "\r\n";
$content .= '</div><!--./row-top-menu-->' . "\r\n";


$content .= '<div class="row"><!--./row-items-->' . "\r\n";
$content .= '<div class="col-md-12">' . "\r\n";

$content .= '<div class="box box-danger">' . "\r\n";
$content .= '<div class="box-header with-border">' . "\r\n";
$content .= '<h3 class="box-title"><i class="fa fa-navicon"></i> ' . __e('Items') . '</h3>' . "\r\n";
$content .= '</div>' . "\r\n";

$content .= '<div class="box-body well">' . "\r\n";
$content .= $list_item_menu;
$content .= '</div>' . "\r\n";

$content .= '<div class="box-footer">' . "\r\n";
$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>&nbsp;' . "\r\n";
$content .= '<a class="btn btn-flat btn-info" href="./?p=menus" ><i class="fa fa-rotate-right"></i> ' . __e('Reload') . '</a>&nbsp;' . "\r\n";

$content .= '<a class="btn btn btn-default btn-flat pull-right" data-toggle="modal" data-target="#reset-menu-dialog" href="#!_" data-href="#/?p=menus&a=reset" title="' . __e('Reset all items of menus') . '"><i class="fa fa-exclamation-triangle"></i> ' . __e('Reset to Default') . '</a>&nbsp;' . "\r\n";
$content .= '</div>' . "\r\n";

$content .= '</div>' . "\r\n";

$content .= '</div><!--./col-md-12-->' . "\r\n";

$content .= '</div><!--./row-items-->' . "\r\n";
$content .= '</form>' . "\r\n";


// TODO: MODAL ALERT RESET
$content .= '<div class="modal fade modal-default" id="reset-menu-dialog" tabindex="-1" role="dialog" aria-labelledby="delete-page-label" aria-hidden="true">';
$content .= '<div class="modal-dialog">';
$content .= '<div class="modal-content">';
$content .= '<div class="modal-header">';
$content .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
$content .= '<h4 class="modal-title" id="delete-app-label">' . __e('Reset to Default') . '</h4>';
$content .= '</div>';
$content .= '<div class="modal-body">';
$content .= '<p>' . __e('You will lose the previous menu settings, Are you sure want to reset the menu?') . '</p>';
$content .= '</div>';
$content .= '<div class="modal-footer">';
$content .= '<a href="./?p=menus&a=reset" class="btn btn-danger">' . __e('Yes') . '</a>&nbsp;';
$content .= '<button type="button" data-dismiss="modal" class="btn">' . __e('Cancel') . '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$page_js = null;
$page_js = '

var ion_header = $("#menus-ion-header").val();
switch(ion_header) {
    case "default-header":
        $("#menus-expanded-option").addClass("hide");
        $("#menus-custom-header").addClass("hide");
        break;
    case "remove-header":
         $("#menus-expanded-option").addClass("hide");
         $("#menus-custom-header").addClass("hide");
        break;
    case "expanded-header":
         $("#menus-expanded-option").removeClass("hide");
         $("#menus-custom-header").addClass("hide");
        break;
    case "custom-header":
         $("#menus-expanded-option").addClass("hide");
         $("#menus-custom-header").removeClass("hide");
        break;
}

$("#menus-ion-header").on("click", function(){
    var ion_header = $(this).val();
    switch(ion_header) {
        case "default-header":
            $("#menus-expanded-option").addClass("hide");
            $("#menus-custom-header").addClass("hide");
            break;
        case "remove-header":
             $("#menus-expanded-option").addClass("hide");
             $("#menus-custom-header").addClass("hide");
            break;
        case "expanded-header":
             $("#menus-expanded-option").removeClass("hide");
             $("#menus-custom-header").addClass("hide");
            break;
        case "custom-header":
             $("#menus-expanded-option").addClass("hide");
             $("#menus-custom-header").removeClass("hide");
            break;
    }
});  
 

$(".item-list").sortable({
    opacity: 0.5,
    items: ".item",
    //revert: true,
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: false,
    zIndex: 999999
});


function openDialog(itemId){
	var typeVal = $("#item-type-"+itemId).val();
    var noIndex = itemId;
    initLayout(typeVal,noIndex);
}

 
$(".item-type").on("click", function(){
	var typeVal = $(this).val();
    var noIndex = $(this).attr("data-target");
    
    initLayout(typeVal,noIndex);

});

function initLayout(typeVal,noIndex){
    
    $("#item-var-page-"+noIndex).addClass("hide");
    $("#item-var-value-"+noIndex).addClass("hide");
    $("#item-icon-hide-"+noIndex).addClass("hide");
    $("#field-item-value-" + noIndex).attr("placeholder","");    
    $("#field-item-value-label-" + noIndex).html("Value");    
    $("#field-item-value-help-" + noIndex).html("Used for values like: URL, Phone, Email, Geo or App ID"); 
    
    $("#field-item-desc-" + noIndex).attr("placeholder",""); 
    $("#field-item-desc-label-" + noIndex).html("Description"); 
    $("#field-item-desc-help-" + noIndex).html("This is just additional information");
               
    switch(typeVal) {
        
        case "title":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).addClass("hide");
                $("#item-icon-hide-"+noIndex).addClass("hide");
            break;
            
        case "inlink":
                 $("#item-var-page-"+noIndex).removeClass("hide");
                 $("#item-var-value-"+noIndex).addClass("hide");
                 $("#item-icon-hide-"+noIndex).removeClass("hide");
            break;
            
        case "inlink-param":
                 $("#item-var-page-"+noIndex).removeClass("hide");
                 $("#item-var-value-"+noIndex).removeClass("hide");
                 $("#item-icon-hide-"+noIndex).removeClass("hide");
                 
                 $("#field-item-value-label-" + noIndex).html("Parameter");
                 $("#field-item-value-" + noIndex).attr("placeholder","12");   
                 $("#field-item-value-help-" + noIndex).html("The value of the parameter, usually ID");  
                
            break;
            
        case "webview":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide");
                $("#field-item-value-label-" + noIndex).html("URL");
                $("#field-item-value-" + noIndex).attr("placeholder","http://ihsana.com/");   
                $("#field-item-value-help-" + noIndex).html("Please write the url to be addressed");  
            break;
        case "appbrowser":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");   
                $("#item-icon-hide-"+noIndex).removeClass("hide");    
                $("#field-item-value-label-" + noIndex).html("URL");  
                $("#field-item-value-" + noIndex).attr("placeholder","http://ihsana.com/");   
                $("#field-item-value-help-" + noIndex).html("Please write the url to be addressed");  
            break;
        case "systembrowser":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");    
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("URL"); 
                $("#field-item-value-" + noIndex).attr("placeholder","http://ihsana.com/");  
                $("#field-item-value-help-" + noIndex).html("Please write the url to be addressed");     
            break;
            
        case "mail":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("Email"); 
                $("#field-item-value-" + noIndex).attr("placeholder","jasman@ihsana.com"); 
                $("#field-item-value-help-" + noIndex).html("Write your e-mail address");   
                $("#field-item-desc-" + noIndex).attr("placeholder","Bug Report"); 
                $("#field-item-desc-label-" + noIndex).html("Email Subject"); 
                $("#field-item-desc-help-" + noIndex).html("Write the subject of the message here");
              
            break;
            
        case "sms":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");  
                $("#item-icon-hide-"+noIndex).removeClass("hide");  
                
                $("#field-item-value-label-" + noIndex).html("Phone Number"); 
                $("#field-item-value-" + noIndex).attr("placeholder","081234567890");
                $("#field-item-value-help-" + noIndex).html("Write your phone number");
                
                $("#field-item-desc-" + noIndex).attr("placeholder","Hi, can you tell us..."); 
                $("#field-item-desc-label-" + noIndex).html("Message"); 
                $("#field-item-desc-help-" + noIndex).html("Write example of the message here");
                                
            break;
            
        case "call":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("Phone Number");  
                $("#field-item-value-" + noIndex).attr("placeholder","081234567890"); 
                $("#field-item-value-help-" + noIndex).html("Write your phone number");            
            break;
            
        case "geo":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                
                $("#field-item-value-label-" + noIndex).html("Coordinates"); 
                $("#field-item-value-" + noIndex).attr("placeholder","567,23"); 
                $("#field-item-value-help-" + noIndex).html("Write your location in the form of coordinates");  
                
                $("#field-item-desc-" + noIndex).attr("placeholder","Silambau, Kinali, Pasaman Barat"); 
                $("#field-item-desc-label-" + noIndex).html("Address"); 
                $("#field-item-desc-help-" + noIndex).html("Write your location in the form of full address");
                              
            break;
            
        case "playstore":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");   
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("App ID");    
                $("#field-item-value-help-" + noIndex).html("Write your AppID");   
                $("#field-item-value-" + noIndex).attr("placeholder","com.imabuilder.xxx.xx");     
            break;
            
        case "appstore":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");   
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("App URL");    
                $("#field-item-value-help-" + noIndex).html("Write your App URL");   
                $("#field-item-value-" + noIndex).attr("placeholder","https://apps.apple.com/us/app/xxxx/id123456");     
            break;
            
        case "youtube-app":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide");
                $("#field-item-value-label-" + noIndex).html("Youtube ID"); 
                $("#field-item-value-help-" + noIndex).html("Write the video id that will be shown");   
                $("#field-item-value-" + noIndex).attr("placeholder","asHGHghsd");             
            break; 
        
        case "streaming-media":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("Video URL");   
                $("#field-item-value-help-" + noIndex).html("Write the video url");   
                $("#field-item-value-" + noIndex).attr("placeholder","http://ihsana.com/file.mp4");           
            break; 
            
        case "text-to-speech":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                $("#field-item-value-label-" + noIndex).html("Text");   
                $("#field-item-value-help-" + noIndex).html("Write the text here");   
                $("#field-item-value-" + noIndex).attr("placeholder","Hello!");           
            break;             
            
        case "instagram-app":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                
                $("#field-item-value-label-" + noIndex).html("Caption"); 
                $("#field-item-value-" + noIndex).attr("placeholder","My Images"); 
                $("#field-item-value-help-" + noIndex).html("Write the caption");  
                
                $("#field-item-desc-" + noIndex).attr("placeholder","data:image/png;uhduhf3hfif33"); 
                $("#field-item-desc-label-" + noIndex).html("Images"); 
                $("#field-item-desc-help-" + noIndex).html("You must use images in base64 format");              
            break;
                        
                        
        case "pay-with-paypal":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide"); 
                
                $("#field-item-value-label-" + noIndex).html("Price"); 
                $("#field-item-value-" + noIndex).attr("placeholder","4.2"); 
                $("#field-item-value-help-" + noIndex).html("Write the price to be paid");  
                
                $("#field-item-desc-" + noIndex).attr("placeholder","Buy My Product"); 
                $("#field-item-desc-label-" + noIndex).html("Info"); 
                $("#field-item-desc-help-" + noIndex).html("Write the name of the item or information needed");              
            break;                        
                        
        case "document-scanner":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).addClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide");          
            break; 
            
        
        case "take-screenshot":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).addClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide");          
            break;         
       
       case "x-social-sharing":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).removeClass("hide");
                $("#item-icon-hide-"+noIndex).removeClass("hide");   
                
                $("#field-item-value-label-" + noIndex).html("URL"); 
                $("#field-item-value-" + noIndex).attr("placeholder","http://ihsana.com/"); 
                $("#field-item-value-help-" + noIndex).html("Write the url");  
                
                $("#field-item-desc-" + noIndex).attr("placeholder","Your message here!"); 
                $("#field-item-desc-label-" + noIndex).html("Message"); 
                $("#field-item-desc-help-" + noIndex).html("Write the message you want to share!");   
                                       
            break;  
             
       case "app-rate":
                $("#item-var-page-"+noIndex).addClass("hide");
                $("#item-var-value-"+noIndex).addClass("hide");
                $("#item-icon-hide-"+noIndex).addClass("hide");
            break;
        
                                                         
        default:
             
    } 
    console.log(typeVal);
}

     
';

// TODO: LAYOUT
$content .= $icon->display('ion');
$template->page_breadcrumb = $breadcrumb;
$template->page_title = '(IMAB) Menus';
$template->page_desc = __e('Create and connect menu with page or other');
$template->page_content = $content;
$template->page_js = $page_js;

?>