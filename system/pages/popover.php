<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package ionic4
 */


defined("JSM_EXEC") or die("Silence is golden");
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}

$page_js = $breadcrumb = $content = null;

$db = new jsmDatabase();
$icon = new jsmIcon();
$db->current();
$static_pages = $db->getStaticPages();

$menu_types = array();

$menu_types[] = array('val' => 'title', 'label' => __e('Title/Divider'));
$menu_types[] = array('val' => 'dark-mode', 'label' => __e('Dark Mode'));
$menu_types[] = array('val' => 'inlink', 'label' => __e('Goto Internal Link'));
$menu_types[] = array('val' => 'webview', 'label' => __e('Open With : In App Webview'));
$menu_types[] = array('val' => 'cordova-webview', 'label' => __e('Open With : Cordova Webview'));
$menu_types[] = array('val' => 'appbrowser', 'label' => __e('Open With : In App Browser'));
$menu_types[] = array('val' => 'systembrowser', 'label' => __e('Open With : System Browser'));
$menu_types[] = array('val' => 'mail', 'label' => __e('Open With : Email Apps'));
$menu_types[] = array('val' => 'sms', 'label' => __e('Open With : SMS Apps'));
$menu_types[] = array('val' => 'call', 'label' => __e('Open With : Call Apps'));
$menu_types[] = array('val' => 'geo', 'label' => __e('Open With : GEO Apps'));
$menu_types[] = array('val' => 'playstore', 'label' => __e('Open With : GooglePlay App'));
$menu_types[] = array('val' => 'exit', 'label' => __e('App : Exit/Minimize'));

if (!isset($_SESSION['CURRENT_APP']['apps']['ionic-storage']))
{
    $_SESSION['CURRENT_APP']['apps']['ionic-storage'] = false;
}

if ($_SESSION['CURRENT_APP']['apps']['ionic-storage'] == true)
{
    if (!isset($_SESSION['CURRENT_APP']['localization']))
    {
        $_SESSION['CURRENT_APP']['localization'] = array();
    }

    if (count($_SESSION['CURRENT_APP']['localization']) != 0)
    {
        $menu_types[] = array('val' => 'language', 'label' => __e('App : Language Option'));
    }


    $menu_types[] = array('val' => 'clear-storage', 'label' => __e('App : Clear Storage'));
}

if (isset($_POST['popover']))
{
    $_newPopovers = $_POST['popover'];

    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The popover settings has been successfully edited');


    $db->savePopover($_newPopovers);

    $db->current();
    rebuild();
    header("Location: ./?p=popover");
}

$popover = $db->getPopover();

if (!isset($popover['icon']))
{
    $popover['icon'] = 'ellipsis-vertical-outline';
}
if (!isset($popover['title']))
{
    $popover['title'] = '';
}

if (!isset($popover['color']))
{
    $popover['color'] = 'dark';
}
if (!isset($popover['background']))
{
    $popover['background'] = 'light';
}

if (!isset($popover['items']))
{
    $popover['items'] = array();
}

// TODO: BREADCUMB
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Popover') . '</li>';
$breadcrumb .= '</ol>';

$content .= '<form method="post" action="">';
$content .= '<div class="row">';
$content .= '<div class="col-md-6">';

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Header') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


$content .= '<div class="row">';
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label class="" for="icon-menu">' . __e('Menu Icon') . '</label>';
$content .= '<div class="input-group">';
$content .= '<label class="input-group-addon" for="icon-menu">' . __e('Icon') . '</label>';
$content .= '<input name="popover[icon]" type="text" class="form-control" id="icon-menu" placeholder="paper" value="' . $popover['icon'] . '" >';
$content .= '<span class="input-group-addon" data-type="icon-picker" data-target="#icon-menu" data-dialog="#ion-icon-dialog" title="Click here for get icon list" data-toggle="tooltip">';
$content .= '<ion-icon name="' . $popover['icon'] . '"></ion-icon>';
$content .= '</span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('This icon is required') . '</p>';
$content .= '</div>';

$content .= '</div>';
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label class="" for="icon-menu">' . __e('Menu Title') . '</label>';
$content .= '<input type="text" class="form-control" name="popover[title]" value="' . $popover['title'] . '" />';
$content .= '<p class="help-block">' . __e('Title is option, keep blank for default') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';

$content .= '</div><!-- ./col-md-6 -->';

$content .= '<div class="col-md-6">';

$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Color') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


$content .= '<div class="row">';

$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label class="" for="icon-menu">' . __e('Text Color') . '</label>';
$content .= '<select data-color="' . $popover['color'] . '" class="form-control ' . $popover['color'] . ' select-color" name="popover[color]" >';
foreach ($color_name as $_color)
{
    $selected = '';
    if ($popover['color'] == $_color['value'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please select text color') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label class="" for="icon-menu">' . __e('Background Color') . '</label>';
$content .= '<select data-color="' . $popover['background'] . '" class="form-control ' . $popover['background'] . ' select-color" name="popover[background]" >';
foreach ($color_name as $_color)
{
    $selected = '';
    if ($popover['background'] == $_color['value'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $_color['value'] . '" ' . $selected . '>' . $_color['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please select background color, <strong>Dark Mode</strong> only supports <code>undefined</code> and <code>transparent</code> color') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


$content .= '</div><!-- ./row -->';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-6 -->';

$content .= '</div><!-- ./row -->';


$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Menu') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<table id="popover-column" class="table table-striped">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th style="min-width:10px"></th>';
$content .= '<th style="min-width:120px">' . __e('Type') . '</th>';
$content .= '<th>' . __e('Label') . '</th>';
$content .= '<th>' . __e('Value') . '</th>';

$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody class="item-list">';
$max_menu = (count($popover['items']) + 1);


for ($i = 0; $i < $max_menu; $i++)
{
    if (!isset($popover['items'][$i]['label']))
    {
        $popover['items'][$i]['label'] = '';
    }
    if (!isset($popover['items'][$i]['value']))
    {
        $popover['items'][$i]['value'] = '';
    }
    if (!isset($popover['items'][$i]['type']))
    {
        $popover['items'][$i]['type'] = 'divider';
    }

    if (!isset($popover['items'][$i]['page']))
    {
        $popover['items'][$i]['page'] = '';
    }

    $content .= '<tr id="col-item-' . $i . '" class="item">';
    $content .= '<td class="handle v-top"><i class="glyphicon glyphicon-move"></i></td>';

    $content .= '<td class="v-top">';
    $content .= '<select class="form-control item-type" data-target="' . $i . '" name="popover[items][' . $i . '][type]">';
    foreach ($menu_types as $menu_type)
    {
        $selected = '';
        if ($popover['items'][$i]['type'] == $menu_type['val'])
        {
            $selected = 'selected';
        }
        $content .= '<option value="' . $menu_type['val'] . '" ' . $selected . '>' . $menu_type['label'] . '</option>';
    }
    $content .= '</select>';
    $content .= '</td>';


    $content .= '<td class="v-top"><input type="text" name="popover[items][' . $i . '][label]" value="' . $popover['items'][$i]['label'] . '" class="form-control" /></td>';


    $content .= '<td class="v-top">';
    if ($popover['items'][$i]['type'] == 'inlink')
    {
        $class_value_hide = 'hide';
        $class_page_hide = '';
    } else
    {
        $class_value_hide = '';
        $class_page_hide = 'hide';

    }

    $content .= '<div id="popover-value-' . $i . '" class="' . $class_value_hide . ' form-group">';
    $content .= '<input type="text" name="popover[items][' . $i . '][value]" value="' . $popover['items'][$i]['value'] . '" class="form-control popover-value" />';
    $content .= '<p class="help-block">' . __e('Write the value of the menu item, such as: email, url, geo or other') . '</p>';
    $content .= '</div>';

    $content .= '<div id="popover-page-' . $i . '" class="' . $class_page_hide . ' form-group">';
    $content .= '<select name="popover[items][' . $i . '][page]" class="form-control" >';
    $content .= '<option value="">' . __e('Page Target') . '</option>';
    foreach ($static_pages as $item_page)
    {
        $selected = '';
        if ($popover['items'][$i]['page'] == $item_page["name"])
        {
            $selected = 'selected';
        }
        $content .= '<option value="' . htmlentities($item_page["name"]) . '" ' . $selected . '>- ' . htmlentities($item_page["title"]) . ' (' . htmlentities($item_page["name"]) . ')</option>';
    }
    $content .= '</select>';
    $content .= '<p class="help-block">' . __e('Select the page target') . '</p>';
    $content .= '</div>';

    $content .= '</td>';


    $content .= '<td class="v-top">';
    $content .= '<a data-target="#col-item-' . $i . '" href="#!_" class="remove-item btn-flat btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
    $content .= '</td>';

    $content .= '</tr>';
}
$content .= '</tbody>';
$content .= '</table>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit-menu"><i class="fa fa-floppy-o"></i> ' . __e('Save Changes') . '</button>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '</form>';
$content .= $icon->display('ion');


$page_js .= '


$(".item-list").sortable({
    opacity: 0.5,
    items: ".item",
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: false,
    zIndex: 999999
});

$(".item-type").on("click", function(){
    
	var typeVal = $(this).val();
    var noIndex = $(this).attr("data-target");

    $("#popover-value-" + noIndex).removeClass("hide");
    $("#popover-page-" + noIndex).addClass("hide");         
    $("#popover-value-" + noIndex + " input").attr("readonly",false);
    $("#popover-value-" + noIndex + " p").html("' . __e('Write the value of the menu item, such as: email, url, geo or other') . '");
    $("#popover-value-" + noIndex + " input").val("");
               
    switch(typeVal) {
        
        case "title":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").attr("readonly",true);
            break;            
        case "inlink":
                $("#popover-value-"+noIndex).addClass("hide");
                $("#popover-page-"+noIndex).removeClass("hide"); 
            break;    
        case "webview":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("http://yourdomain.com");
            break;
            case "cordovawebview":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("http://yourdomain.com");
            break;
        case "appbrowser":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("http://yourdomain.com");
            break;
        case "systembrowser":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("http://yourdomain.com");
            break;
        case "mail":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("your@domain.com");          
            break;
        case "sms":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("08123456789");         
            break;
        case "call":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("08123456789");            
            break;
        case "geo":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("54,66");           
            break;
        case "playstore":
                $("#popover-value-"+noIndex).removeClass("hide");
                $("#popover-page-"+noIndex).addClass("hide"); 
                $("#popover-value-" + noIndex + " input").val("com.imabuilder.xxx");       
            break;                              
        default:
          
    } 
    console.log(typeVal);
});

';


$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) Popover Component');
$template->page_desc = 'Let\'s create an option menu for your app';
$template->page_content = $content;

?>