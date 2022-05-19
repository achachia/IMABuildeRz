<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */


$string = new jsmString();
$item_types = array();
$item_types[] = array('label' => 'Devider', 'value' => 'devider');
$item_types[] = array('label' => 'Text', 'value' => 'text');
$item_types[] = array('label' => 'TextArea', 'value' => 'textarea');
$item_types[] = array('label' => 'HTML', 'value' => 'html');
$item_types[] = array('label' => 'Image', 'value' => 'image');
$item_types[] = array('label' => 'URL', 'value' => 'url');
$item_types[] = array('label' => 'Select', 'value' => 'select');
$item_types[] = array('label' => 'Checkbox', 'value' => 'checkbox');
if (isset($_POST['addons']))
{
    if (isset($_POST['addons']['service']))
    {
        $_POST['addons']['service'] = true;
    } else
    {
        $_POST['addons']['service'] = false;
    }
    if (isset($_POST['addons']['page']))
    {
        $_POST['addons']['page'] = true;
    } else
    {
        $_POST['addons']['page'] = false;
    }
    if (isset($_POST['addons']['component']))
    {
        $_POST['addons']['component'] = true;
    } else
    {
        $_POST['addons']['component'] = false;
    }
    if (isset($_POST['addons']['global']))
    {
        $_POST['addons']['global'] = true;
    } else
    {
        $_POST['addons']['global'] = false;
    }
    $new_form = array();
    if (isset($_POST['addons']['form']))
    {
        $old_form = $_POST['addons']['form'];
        $_POST['addons']['form'] = array();
        foreach ($old_form as $_form)
        {
            if ($_form['name'] != '')
            {
                $var = sha1($_form['name']);
                $new_form[$var]['name'] = str_replace(' ', '-', strtolower($_form['name']));
                $new_form[$var]['title'] = $_form['title'];
                $new_form[$var]['placeholder'] = $_form['placeholder'];
                $new_form[$var]['help'] = $_form['help'];
                $new_form[$var]['attributes'] = $_form['attributes'];
                $new_form[$var]['option'] = $_form['option'];
                $new_form[$var]['type'] = $_form['type'];
            }
        }
    }
    $_POST['addons']['form'] = array_values($new_form);
    file_put_contents('setting.json', json_encode($_POST['addons']));
    file_put_contents('settings/' . $string->toFileName($_POST['addons']['name']) . '.json', json_encode($_POST['addons']));
}


if (file_exists('setting.json'))
{
    $rawdata = json_decode(file_get_contents('setting.json'), true);
} else
{
    $rawdata = json_decode(file_get_contents('settings/test.json'), true);
}


$form = array();
if (isset($rawdata['form']))
{
    foreach ($rawdata['form'] as $_form)
    {
        if ($_form['name'] != '')
        {
            $var = sha1($_form['name']);
            $form[$var] = $_form;
        }
    }
}
$rawdata['form'] = array_values($form);
$rawdata['version'] = '1.0.0';
$rawdata['prefix'] = $string->toFileName($rawdata['name']);
$addons_dir = $rawdata['prefix'];
$code_php = null;
$code_php .= "<?php" . "\r\n";
$code_php .= "\r\n";
$code_php .= "/**" . "\r\n";
$code_php .= " * @author " . $rawdata['author'] . " <" . $rawdata['email'] . ">" . "\r\n";
$code_php .= " * @copyright " . $rawdata['company'] . " " . date("Y") . "\r\n";
$code_php .= " * @license Commercial License" . "\r\n";
$code_php .= " * " . "\r\n";
$code_php .= " * @package `" . $string->toFileName($rawdata['name']) . "`" . "\r\n";
$code_php .= " */" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\r\n";
$code_php .= "defined('JSM_EXEC') or die('Silence is golden');" . "\r\n";
$code_php .= "\$is_debug = false;" . "\r\n";
$code_php .= "\$prefix_addons = '" . $addons_dir . "' ;" . "\r\n";


$code_php .= "\r\n";
$code_php .= "// init class " . "\r\n";
$code_php .= '$db = new jsmDatabase();' . "\r\n";
$code_php .= '$current_app = $db->current();' . "\r\n";
$code_php .= '$static_pages = $db->getStaticPages();' . "\r\n";
$code_php .= '$addons_settings = $db->getAddonsUsed("' . $addons_dir . '");' . "\r\n";
$code_php .= '$string = new jsmString();' . "\r\n";
$code_php .= "\r\n";
if ($rawdata['page'] == true)
{
    $code_php .= "\r\n";
    $code_php .= "" . "if(!isset(\$_GET['page-target'])){" . "\r\n";
    $code_php .= "\t" . "\$_GET['page-target'] = '';" . "\r\n";
    $code_php .= "" . "}" . "\r\n";
    $code_php .= "" . "\$current_page_target = \$string->toFileName(\$_GET['page-target']);" . "\r\n";
} else
{
    $code_php .= "" . "\$current_page_target = 'core';" . "\r\n";
}
$code_php .= "\r\n";
$code_php .= "if(\$_GET['a'] === 'delete'){" . "\r\n";
$code_php .= "\t" . "\$db->deleteAddOns('" . $addons_dir . "',\$current_page_target);" . "\r\n";
$code_php .= "\t" . "header('Location: ./?p=addons&addons=" . $addons_dir . "&'.time());" . "\r\n";
$code_php .= "}" . "\r\n";
$code_php .= "\r\n";
$code_php .= "" . "// TO" . "DO: POST" . "\r\n";
$code_php .= "if(isset(\$_POST['save-" . $addons_dir . "'])){" . "\r\n";
$code_php .= "\t" . "\r\n";
$code_php .= "\t" . "// save addons setting " . "\r\n";
$code_php .= "\t" . "\$addons = array();" . "\r\n";
$code_php .= "\t" . "\$addons['page-target'] = \$current_page_target ;" . "\r\n";

$code_php .= "\t" . "// TO" . "DO: POST --|-- RESPONSE" . "\r\n";
if ($rawdata['page'] == true)
{
    $code_php .= "\t" . "\$addons['page-title'] = trim(\$_POST[\$prefix_addons]['page-title']) ;" . "\r\n";
} else
{
    $code_php .= "\t" . "\$addons['page-title'] =  \$current_page_target ;" . "\r\n";
}
$code_php .= "\t" . "\$addons['page-header-color'] = trim(\$_POST[\$prefix_addons]['page-header-color']) ;" . "\r\n";
$code_php .= "\t" . "\$addons['page-content-background'] = trim(\$_POST[\$prefix_addons]['page-content-background']) ;" . "\r\n";

if (isset($rawdata['form']))
{
    foreach ($rawdata['form'] as $input)
    {
        if (!isset($input['type']))
        {
            $input['type'] = 'text';
        }
        $code_php .= "\t" . "" . "\r\n";
        $code_php .= "\t" . "//" . $input['name'] . "\r\n";
        switch ($input['type'])
        {
            case 'devider':
                break;
            case 'text':
                $code_php .= "\t" . "if(!isset(\$_POST[\$prefix_addons]['" . $input['name'] . "'])){" . "\r\n";
                $code_php .= "\t\t" . "\$_POST[\$prefix_addons]['" . $input['name'] . "'] = '" . addslashes($input['option']) . "';" . "\r\n";
                $code_php .= "\t" . "}" . "\r\n";
                $code_php .= "\t" . "\$addons['" . $input['name'] . "'] = trim(\$_POST[\$prefix_addons]['" . addslashes($input['name']) . "']) ; //" . $input['type'] . "\r\n";

                break;
            case 'textarea':
                $code_php .= "\t" . "\$addons['" . $input['name'] . "'] = trim(\$_POST[\$prefix_addons]['" . addslashes($input['name']) . "']) ; //" . $input['type'] . "\r\n";
                break;
            case 'html':
                $code_php .= "\t" . "\$addons['" . $input['name'] . "'] = trim(\$_POST[\$prefix_addons]['" . addslashes($input['name']) . "']) ; //" . $input['type'] . "\r\n";
                break;
            case 'image':
                $code_php .= "\t" . "\$addons['" . $input['name'] . "'] = trim(\$_POST[\$prefix_addons]['" . addslashes($input['name']) . "']) ; //" . $input['type'] . "\r\n";
                break;
            case 'url':
                $code_php .= "\t" . "\$addons['" . $input['name'] . "'] = trim(\$_POST[\$prefix_addons]['" . addslashes($input['name']) . "']) ; //" . $input['type'] . "\r\n";
                break;
            case 'select':
                $code_php .= "\t" . "\$addons['" . $input['name'] . "'] = trim(\$_POST[\$prefix_addons]['" . addslashes($input['name']) . "']) ; //" . $input['type'] . "\r\n";
                break;
            case 'checkbox':
                $code_php .= "\t" . "// " . $input['type'] . "\r\n";
                $code_php .= "\t" . "if(isset(\$_POST[\$prefix_addons]['" . $input['name'] . "'])){" . "\r\n";
                $code_php .= "\t\t" . "\$addons['" . $input['name'] . "'] = true;" . "\r\n";
                $code_php .= "\t" . "}else{" . "\r\n";
                $code_php .= "\t\t" . "\$addons['" . $input['name'] . "'] = false;" . "\r\n";
                $code_php .= "\t" . "}" . "\r\n";
                break;
        }
    }
}
$code_php .= "\t" . "" . "\r\n";
$code_php .= "\t" . "" . "\r\n";
$code_php .= "\t" . "\$db->saveAddOns('" . $addons_dir . "',\$addons);" . "\r\n";
$code_php .= "\t" . "\r\n";


if ($rawdata['service'] == true)
{
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- SERVICES" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$service['name'] = \$current_page_target;" . "\r\n";
    $code_php .= "\t" . "\$service['instruction'] = 'Service for " . $rawdata['name'] . "';" . "\r\n";
    $code_php .= "\t" . "\$service['desc'] = 'Service for " . $rawdata['name'] . "';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z = 0;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'HttpClient';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = 'httpClient';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = '@angular/common/http';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'HttpErrorResponse';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = '@angular/common/http';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'Observable';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = 'rxjs';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'throwError';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = 'rxjs';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'of';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = 'rxjs';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'map';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = 'rxjs/operators';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'catchError';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = 'rxjs/operators';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'retry';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = 'rxjs/operators';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$z++;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['class'] = 'HttpHeaders';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$service['modules']['angular'][\$z]['path'] = '@angular/common/http';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$service['code']['other'] = null;" . "\r\n";
    $code_php .= "\t" . "\$db->saveService(\$service, \$current_page_target);" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\r\n";
}
if ($rawdata['global'] == true)
{
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- GLOBALS" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$global['name'] = \$current_page_target;" . "\r\n";
    $code_php .= "\t" . "\$global['note'] = '-';" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- GLOBALS  --|-- MODULES" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "//\$z = 0;" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['class'] = 'OneSignal';" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['var'] = 'oneSignal';" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['path'] = '@ionic-native/onesignal/ngx';" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['native'] = '@ionic-native/onesignal';" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['cordova'] = 'onesignal-cordova-plugin';" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['cordova-variable'][0]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "//\$global['modules'][\$z]['cordova-variable'][0]['val'] = '';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- GLOBALS  --|-- CODE" . "\r\n";
    $code_php .= "\t" . "\$global['component'][0]['code']['export'] = null;" . "\r\n";
    $code_php .= "\t" . "\$global['component'][0]['code']['init'] = null;" . "\r\n";
    $code_php .= "\t" . "\$global['component'][0]['code']['other'] = null;" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\$db->saveGlobal('" . $addons_dir . "', \$global);" . "\r\n";
    $code_php .= "\t" . "\r\n";
}
$page_readonly = 'readonly';
if ($rawdata['page'] == true)
{
    $page_readonly = '';
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- PAGE --|-- " . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// create properties for page" . "\r\n";
    $code_php .= "\t" . "\$newPage = null;" . "\r\n";
    $code_php .= "\t" . "\$newPage['title'] = \$addons['page-title'];" . "\r\n";
    $code_php .= "\t" . "\$newPage['name'] = \$current_page_target;" . "\r\n";
    $code_php .= "\t" . "\$newPage['code-by'] = '" . $addons_dir . "';" . "\r\n";
    $code_php .= "\t" . "\$newPage['icon-left'] = 'at';" . "\r\n";
    $code_php .= "\t" . "\$newPage['icon-right'] = '';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['color'] = \$addons['page-header-color'];" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['color'] = 'none';" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['custom-color'] = '#ffffff';" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['background'] = \$addons['page-content-background'];" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- PAGE --|-- HEADER" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['type'] = 'title';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['items'][0]['label'] = 'Tab 1';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['items'][0]['value'] = 'tab1';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['items'][1]['label'] = 'Tab 2';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['items'][1]['value'] = 'tab2';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['items'][2]['label'] = 'Tab 3';" . "\r\n";
    $code_php .= "\t" . "\$newPage['header']['mid']['items'][2]['value'] = 'tab3';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- PAGE --|-- MODULES" . "\r\n";
    $code_php .= "\t" . "\$newPage['modules']['angular'][0]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "\$newPage['modules']['angular'][0]['class'] = 'Observable';" . "\r\n";
    $code_php .= "\t" . "\$newPage['modules']['angular'][0]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "\$newPage['modules']['angular'][0]['path'] = 'rxjs';" . "\r\n";
    $code_php .= "\t" . "\r\n";
    if ($rawdata['service'] == true)
    {
        $code_php .= "\t" . "\r\n";
        $code_php .= "\t" . "\$newPage['modules']['angular'][1]['enable'] = true;" . "\r\n";
        $code_php .= "\t" . "\$newPage['modules']['angular'][1]['class'] = \$string->toClassName(\$current_page_target) .'Service';" . "\r\n";
        $code_php .= "\t" . "\$newPage['modules']['angular'][1]['var'] = \$string->toUserClassName(\$current_page_target) .'Service';" . "\r\n";
        $code_php .= "\t" . "\$newPage['modules']['angular'][1]['path'] = './../../services/' . \$current_page_target . '/' . \$current_page_target . '.service';" . "\r\n";
    }
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- PAGE --|-- CONTENT --|-- HTML" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['html'] = null;" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['html'] .= '<ion-card>'.\"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['html'] .= \"\\t\".'<ion-card-content>'.\"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['html'] .= \"\\t\\t\".'<p>This page is under construction. Please come back soon!</p>'.\"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['html'] .= \"\\t\".'</ion-card-content>'.\"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['html'] .= '</ion-card>'.\"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- PAGE --|-- CONTENT --|-- SCSS" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['scss'] = null;" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['scss'] .=  \"\\t\".'ion-card {'. \"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['scss'] .=  \"\\t\\t\".'--background: #fff;'. \"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['scss'] .=  \"\\t\\t\".'opacity:0.9;'. \"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\$newPage['content']['scss'] .=  \"\\t\".'}'. \"\\r\\n\";" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "// TO" . "DO: GENERATOR --|-- PAGE --|-- CODE --|-- OTHER" . "\r\n";
    $code_php .= "\t" . "\$newPage['code']['export'] = null;" . "\r\n";
    $code_php .= "\t" . "\$newPage['code']['constructor'] = null;" . "\r\n";
    $code_php .= "\t" . "\$newPage['code']['other'] = null;" . "\r\n";
    $code_php .= "\t" . "\$newPage['code']['init'] = null;" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "\r\n";
    $code_php .= "\t" . "//generate page code" . "\r\n";
    $code_php .= "\t" . "\$db->savePage(\$newPage);" . "\r\n";
}
if ($rawdata['component'] == true)
{
    $code_php .= "\t" . "\$component = null;" . "\r\n";
    $code_php .= "\t" . "\$component['name'] = '" . ($rawdata['name']) . "';" . "\r\n";
    $code_php .= "\t" . "\$component['var'] = '" . $string->toVar($rawdata['name']) . "';" . "\r\n";
    $code_php .= "\t" . "\$component['prefix'] = '" . $string->toFileName($rawdata['name']) . "';" . "\r\n";
    $code_php .= "\t" . "\$component['html'] = null;" . "\r\n";
    $code_php .= "\t" . "\$component['scss'] = null;" . "\r\n";
    $code_php .= "\t" . "//\$component['modules']['angular'][0]['enable'] = true;" . "\r\n";
    $code_php .= "\t" . "//\$component['modules']['angular'][0]['class'] = '';" . "\r\n";
    $code_php .= "\t" . "//\$component['modules']['angular'][0]['var'] = '';" . "\r\n";
    $code_php .= "\t" . "//\$component['modules']['angular'][0]['path'] = '';" . "\r\n";
    $code_php .= "\t" . "\$component['code']['other'] = null;" . "\r\n";
    $code_php .= "\t" . "\$component['code']['constructor'] = null;" . "\r\n";
    $code_php .= "\t" . "\$component['code']['init'] = null ;" . "\r\n";
    $code_php .= "\t" . "\$db->saveComponent(\$component);" . "\r\n";
}
$code_php .= "\t" . "\$db->current();" . "\r\n";
$code_php .= "\t" . "rebuild();" . "\r\n";
if ($rawdata['page'] == true)
{
    $code_php .= "\t" . "header('Location: ./?p=addons&addons=" . $addons_dir . "&page-target='.\$current_page_target . '&'.time());" . "\r\n";
} else
{
    $code_php .= "\t" . "header('Location: ./?p=addons&addons=" . $addons_dir . "&'.time());" . "\r\n";
}
$code_php .= "\t" . "\r\n";
$code_php .= "}" . "\r\n";
$code_php .= "\r\n";
$code_php .= "" . "// TO" . "DO: INIT --|-- CURRENT SETTINGS" . "\r\n";
$code_php .= "\$disabled = null;" . "\r\n";
$code_php .= "if(\$current_page_target == ''){" . "\r\n";
$code_php .= "\t" . "\$disabled = 'disabled';" . "\r\n";
$code_php .= "\t" . "\$current_setting = array();" . "\r\n";
$code_php .= "}else{" . "\r\n";
$code_php .= "\t" . "\$current_setting = \$db->getAddOns('" . $addons_dir . "',\$current_page_target);" . "\r\n";
$code_php .= "}" . "\r\n";
$code_php .= "\r\n";
if ($rawdata['page'] == true)
{
    $code_php .= "if(!isset(\$current_setting['page-target'])){" . "\r\n";
    $code_php .= "\t" . "\$current_setting['page-target'] = '';" . "\r\n";
    $code_php .= "}" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "if(!isset(\$current_setting['page-title'])){" . "\r\n";
    $code_php .= "\t" . "\$current_page_title = '';" . "\r\n";
    $code_php .= "\t" . "if(\$current_page_target != ''){" . "\r\n";
    $code_php .= "\t\t" . "\$current_page = \$db->getPage(\$current_page_target);" . "\r\n";
    $code_php .= "\t\t" . "\$current_page_title = \$current_page['title'];" . "\r\n";
    $code_php .= "\t" . "}" . "\r\n";
    $code_php .= "\t" . "\$current_setting['page-title'] = \$current_page_title;" . "\r\n";
    $code_php .= "}" . "\r\n";
    $code_php .= "\r\n";

}
$code_php .= "if(!isset(\$current_setting['page-header-color'])){" . "\r\n";
$code_php .= "\t" . "\$current_setting['page-header-color'] = 'primary';" . "\r\n";
$code_php .= "}" . "\r\n";
$code_php .= "\r\n";
$code_php .= "if(!isset(\$current_setting['page-content-background'])){" . "\r\n";
$code_php .= "\t" . "\$current_setting['page-content-background'] = 'assets/images/background/bg-01.png';" . "\r\n";
$code_php .= "}" . "\r\n";
$code_php .= "\r\n";


// TODO: INIT INPUT HTML
foreach ($form as $input)
{
    //$code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
    //$code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '';" . "\r\n";
    //$code_php .= "}" . "\r\n";
    //$code_php .= "\r\n";


    switch ($input['type'])
    {
        case 'devider':
            break;
        case 'text':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '" . addslashes($input['placeholder']) . "';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
        case 'textarea':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '" . addslashes($input['placeholder']) . "';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
        case 'html':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '" . addslashes($input['placeholder']) . "';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
        case 'image':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '" . addslashes($input['placeholder']) . "';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
        case 'url':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '" . addslashes($input['placeholder']) . "';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
        case 'select':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = '" . addslashes($input['placeholder']) . "';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
        case 'checkbox':
            $code_php .= "if(!isset(\$current_setting['" . $input['name'] . "'])){" . "\r\n";
            $code_php .= "\t" . "\$current_setting['" . $input['name'] . "'] = false;" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\r\n";
            break;
    }


}
$code_php .= "\r\n";
$code_php .= "" . "// TO" . "DO: LAYOUT --|-- FORM" . "\r\n";
$code_php .= "\$content .= '<div class=\"row\"><!-- row -->';" . "\r\n";
$code_php .= "\$content .= '<div class=\"col-md-7\"><!-- col-md-7 -->';" . "\r\n";
$code_php .= "\$content .= '<form action=\"\" method=\"post\"><!-- ./form -->';" . "\r\n";
$code_php .= "\$content .= '<div class=\"box box-danger\">';" . "\r\n";
$code_php .= "\$content .= '<div class=\"box-header with-border\">';" . "\r\n";
$code_php .= "\$content .= '<h3 class=\"box-title\"><i class=\"fa fa-magic\"></i> '.__e('General').'</h3>';" . "\r\n";
$code_php .= "\$content .= '<div class=\"pull-right box-tools\">';" . "\r\n";
$code_php .= "\$content .= '<button type=\"button\" class=\"btn btn-default btn-sm\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Collapse\" >';" . "\r\n";
$code_php .= "\$content .= '<i class=\"fa fa-minus\"></i>';" . "\r\n";
$code_php .= "\$content .= '</button>';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\$content .= '<div class=\"box-body\">';" . "\r\n";
$code_php .= "\r\n";
$code_php .= "//\$content .= '<div class=\"callout callout-default\">'.__e('Please complete the form below to let us know how we can help you build code:').'</div>';" . "\r\n";
$code_php .= "\$content .= '<div class=\"callout callout-danger\">'.__e('This plugin is not yet usable, still in the coding stage!').'</div>';" . "\r\n";
if ($rawdata['page'] == true)
{
    $code_php .= "\r\n";
    $code_php .= "" . "// TO" . "DO: LAYOUT --|-- FORM --|-- PAGE-TARGET" . "\r\n";
    $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
    $code_php .= "\$content .= '<label for=\"page-target\">'.__e('Overwrite The Page').'</label>';" . "\r\n";
    $code_php .= "\$content .= '<select id=\"page-target\" name=\"" . $addons_dir . "[page-target]\" class=\"form-control\" >';" . "\r\n";
    $code_php .= "\$content .= '<option value=\"\">'.__e('Page Target').'</option>';" . "\r\n";
    $code_php .= "foreach(\$static_pages as \$item_page){" . "\r\n";
    $code_php .= "\t" . "\$code_by = '';" . "\r\n";
    $code_php .= "\t" . "if(isset(\$item_page['code-by'])){" . "\r\n";
    $code_php .= "\t\t" . "\$code_by = ' - '.__e('by').': ' .  \$item_page['code-by'];" . "\r\n";
    $code_php .= "\t" . "}" . "\r\n";
    $code_php .= "\t" . "\$selected = '';" . "\r\n";
    $code_php .= "\t" . "if(\$current_setting['page-target'] == \$item_page[\"name\"]){" . "\r\n";
    $code_php .= "\t\t" . "\$selected = 'selected';" . "\r\n";
    $code_php .= "\t" . "}" . "\r\n";
    $code_php .= "\t" . "\$content .= '<option value=\"'. htmlentities(\$item_page[\"name\"]).' \" '.\$selected.'>- '.htmlentities(\$item_page[\"title\"]).' ('.htmlentities(\$item_page[\"name\"]).''.\$code_by.')</option>';" . "\r\n";
    $code_php .= "}" . "\r\n";
    $code_php .= "\$content .= '</select>';" . "\r\n";
    $code_php .= "\$content .= '<p class=\"help-block\">'.__e('Select the page to be overwritten').'</p>';" . "\r\n";
    $code_php .= "\$content .= '</div>';" . "\r\n";
    $code_php .= "\r\n";

    $code_php .= "" . "// TO" . "DO: LAYOUT --|-- FORM --|-- PAGE-TITLE" . "\r\n";
    $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
    $code_php .= "\$content .= '<label for=\"page-title\">'.__e('Page Title').'</label>';" . "\r\n";
    $code_php .= "\$content .= '<input " . $page_readonly . " id=\"page-title\" type=\"text\" name=\"" . $addons_dir . "[page-title]\" class=\"form-control\" placeholder=\"My Pages\"  value=\"'. \$current_setting['page-title'].'\" required '. \$disabled.' />';" . "\r\n";
    $code_php .= "\$content .= '<p class=\"help-block\">'.__e('The page title will be displayed').'</p>';" . "\r\n";
    $code_php .= "\$content .= '</div>';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\$content .= '<hr/>';" . "\r\n";
}
$code_php .= "\$content .= '<div class=\"row\"><!-- row -->';" . "\r\n";


$code_php .= "" . "// TO" . "DO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR" . "\r\n";
$code_php .= "\$content .= '<div class=\"col-md-6\"><!-- col-md-6 -->';" . "\r\n";
$code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
$code_php .= "\$content .= '<label for=\"page-header-color\">' . __e('Header Color') . '</label>';" . "\r\n";
$code_php .= "\$content .= '<select name=\"" . $addons_dir . "[page-header-color]\" class=\"form-control select-color\" data-color=\"'.\$current_setting['page-header-color'].'\">';" . "\r\n";
$code_php .= "foreach(\$color_names as  \$color_name){" . "\r\n";
$code_php .= "\t" . "\$selected = '';" . "\r\n";
$code_php .= "\t" . "if(\$color_name['value'] == \$current_setting['page-header-color'] ){" . "\r\n";
$code_php .= "\t\t" . "\$selected = 'selected' ;" . "\r\n";
$code_php .= "\t" . "}" . "\r\n";
$code_php .= "\t" . "\$content .= '<option value=\"' . \$color_name['value'] . '\" '.\$selected.'>' . \$color_name['label'] . '</option>';" . "\r\n";
$code_php .= "}" . "\r\n";
$code_php .= "\$content .= '</select>';" . "\r\n";
$code_php .= "\$content .= '<p class=\"help-block\">' . __e('Color variation from the header') . '</p>';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\$content .= '</div><!-- ./col-md-6 -->';" . "\r\n";

$code_php .= "" . "// TO" . "DO: LAYOUT --|-- FORM --|-- PAGE-CONTENT-BACKGROUND" . "\r\n";
$code_php .= "\$content .= '<div class=\"col-md-6\"><!-- col-md-6 -->';" . "\r\n";
$code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
$code_php .= "\$content .= '<label for=\"page-background\">' . __e('Background Image') . '</label>';" . "\r\n";
$code_php .= "\$content .= '<div class=\"input-group\">';" . "\r\n";
$code_php .= "\$content .= '<input id=\"page-content-background\" type=\"text\" name=\"" . $addons_dir . "[page-content-background]\" class=\"form-control\" placeholder=\"assets/images/bg-01.png\"  value=\"' . \$current_setting['page-content-background'] . '\"  ' . \$disabled . ' required />';" . "\r\n";
$code_php .= "\$content .= '<span class=\"input-group-btn\"><button type=\"button\" data-type=\"file-picker\" data-target=\"#page-content-background\" class=\"btn btn-info btn-flat\"><i class=\"fa fa-folder-open\"></i></button></span>';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\$content .= '<p class=\"help-block\">' . __e('The background image of content ') . '</p>';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\$content .= '</div><!-- ./col-md-6 -->';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";

// TODO: FORM INPUT HTML
$t = 0;

foreach ($form as $input)
{
    if (!isset($input['type']))
    {
        $input['type'] = 'text';
    }
        if (!isset($input['type']))
    {
        $input['type'] = 'text';
    }
    if (!isset($input['label']))
    {
        $input['label'] = '';
    }
    $code_php .= "" . "// TO" . "DO: LAYOUT --|-- FORM --|-- " . strtoupper($input['name']) . ' --|-- ' . strtoupper($input['type']) . "" . "\r\n";
    $code_php .= "\$content .= '<div class=\"row\"><!-- row -->';" . "\r\n";

    $input['title'] = addslashes($input['title']);
    $input['label'] = addslashes($input['label']);
    $input['placeholder'] = addslashes($input['placeholder']);
    $input['help'] = addslashes($input['help']);

    switch ($input['type'])
    {
        case 'devider':
            $code_php .= "\r\n";
            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<hr/>';" . "\r\n";
            $code_php .= "\$content .= '<h4>'.__e('" . $input['title'] . "').'</h4>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";
            break;
        case 'text':
            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-4\"><!-- col-md-4 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<label for=\"page-" . $input['name'] . "\">'.__e('" . $input['title'] . "').'</label>';" . "\r\n";
            $code_php .= "\$content .= '<input id=\"page-" . $input['name'] . "\" type=\"text\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" class=\"form-control\" placeholder=\"" . $input['placeholder'] . "\"  value=\"'. \$current_setting['" . $input['name'] . "'].'\"  '. \$disabled.' " . $input['attributes'] . " />';" . "\r\n";
            $code_php .= "\$content .= '<p class=\"help-block\">'.__e('" . $input['help'] . "').'</p>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-4 -->';" . "\r\n";
            break;
        case 'textarea':

            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<label for=\"page-" . $input['name'] . "\">'.__e('" . $input['title'] . "').'</label>';" . "\r\n";
            $code_php .= "\$content .= '<textarea id=\"page-" . $input['name'] . "\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" class=\"form-control\" placeholder=\"" . $input['placeholder'] . "\"  '. \$disabled.' " . $input['attributes'] . " >'. htmlentities(\$current_setting['" . $input['name'] . "']).'</textarea>';" . "\r\n";
            $code_php .= "\$content .= '<p class=\"help-block\">'.__e('" . $input['help'] . "').'</p>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";
            break;

        case 'html':
            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<label for=\"page-" . $input['name'] . "\">'.__e('" . $input['title'] . "').'</label>';" . "\r\n";
            $code_php .= "\$content .= '<textarea data-type=\"tinymce\" id=\"page-" . $input['name'] . "\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" class=\"form-control\" placeholder=\"" . $input['placeholder'] . "\"  '. \$disabled.' " . $input['attributes'] . " >'. htmlentities(\$current_setting['" . $input['name'] . "']).'</textarea>';" . "\r\n";
            $code_php .= "\$content .= '<p class=\"help-block\">'.__e('" . $input['help'] . "').'</p>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";
            break;
        case 'url':
            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<label for=\"page-" . $input['name'] . "\">'.__e('" . $input['title'] . "').'</label>';" . "\r\n";
            $code_php .= "\$content .= '<input id=\"page-" . $input['name'] . "\" type=\"url\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" class=\"form-control\" placeholder=\"" . $input['placeholder'] . "\"  value=\"'. \$current_setting['" . $input['name'] . "'].'\"  '. \$disabled.' " . $input['attributes'] . " />';" . "\r\n";
            $code_php .= "\$content .= '<p class=\"help-block\">'.__e('" . $input['help'] . "').'</p>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";
            break;
        case 'image':
            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<label for=\"page-" . $input['name'] . "\">'.__e('" . $input['title'] . "').'</label>';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"input-group\">';" . "\r\n";
            $code_php .= "\$content .= '<input id=\"page-" . $input['name'] . "\" type=\"text\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" class=\"form-control\" placeholder=\"" . $input['placeholder'] . "\"  value=\"'. \$current_setting['" . $input['name'] . "'].'\"  '. \$disabled.' " . $input['attributes'] . " />';" . "\r\n";
            $code_php .= "\$content .= '<span class=\"input-group-btn\"><button type=\"button\" data-type=\"file-picker\" data-target=\"#page-" . $input['name'] . "\" class=\"btn btn-info btn-flat\"><i class=\"fa fa-folder-open\"></i></button></span>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '<p class=\"help-block\">'.__e('" . $input['help'] . "').'</p>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";
            break;
        case 'select':
            $code_php .= "\r\n";
            $code_php .= "\$options = array();" . "\r\n";
            $_options = array();
            $_options = explode('|', $input['option']);
            $options = array();
            foreach ($_options as $_option)
            {
                $options[] = array('value' => $_option, 'label' => ucwords($_option));
            }
            foreach ($options as $option)
            {
                $code_php .= "\$options[] = array('value' => '" . $option['value'] . "','label' => '" . ucwords($option['label']) . "');" . "\r\n";
            }
            $code_php .= "\r\n";
            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<label for=\"page-" . $input['name'] . "\">'.__e('" . $input['title'] . "').'</label>';" . "\r\n";
            $code_php .= "\$content .= '<select id=\"page-" . $input['name'] . "\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" class=\"form-control\" ' . \$disabled.' >';" . "\r\n";
            $code_php .= "foreach(\$options as \$option) {" . "\r\n";
            $code_php .= "\t" . "\$selected = '';" . "\r\n";
            $code_php .= "\t" . "if(\$option['value'] == \$current_setting['" . $input['name'] . "']){" . "\r\n";
            $code_php .= "\t\t" . "\$selected = 'selected';" . "\r\n";
            $code_php .= "\t" . "}" . "\r\n";
            $code_php .= "\t" . "\$content .= '<option value=\"'.htmlentities(\$option['value']).'\" '.\$selected.'>'.htmlentities(\$option['label']).'</option>';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\$content .= '</select>';" . "\r\n";
            $code_php .= "\$content .= '<p class=\"help-block\">'.__e('" . htmlentities($input['help']) . "').'</p>';" . "\r\n";
            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";
            break;
        case 'checkbox':

            $code_php .= "\$content .= '<div id=\"field-" . $input['name'] . "\" class=\"col-md-12\"><!-- col-md-12 -->';" . "\r\n";
            $code_php .= "\$content .= '<div class=\"form-group\">';" . "\r\n";
            $code_php .= "\$content .= '<table class=\"table\">';" . "\r\n";

            $code_php .= "\$content .= '<tr>';" . "\r\n";
            $code_php .= "if(\$current_setting['" . $input['name'] . "'] == true){" . "\r\n";
            $code_php .= "\t" . "\$content .= '<td><input checked=\"checked\" class=\"flat-red\" type=\"checkbox\" id=\"page-" . $input['name'] . "\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" '. \$disabled.'/></td>';" . "\r\n";
            $code_php .= "}else{" . "\r\n";
            $code_php .= "\t" . "\$content .= '<td><input class=\"flat-red\" type=\"checkbox\" id=\"page-" . $input['name'] . "\" name=\"' . \$prefix_addons . '[" . $input['name'] . "]\" '. \$disabled.'/></td>';" . "\r\n";
            $code_php .= "}" . "\r\n";
            $code_php .= "\$content .= '<td>'.__e('" . $input['help'] . "').'</td>';" . "\r\n";
            $code_php .= "\$content .= '</tr>';" . "\r\n";


            $code_php .= "\$content .= '</table>';" . "\r\n";

            $code_php .= "\$content .= '</div>';" . "\r\n";
            $code_php .= "\$content .= '</div><!-- ./col-md-12 -->';" . "\r\n";


            break;
    }
    $code_php .= "\$content .= '</div><!-- ./row -->';" . "\r\n";
    $code_php .= "\r\n";
    $t++;
}

//$code_php .= "\$content .= '</div>';"."\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\$content .= '<div class=\"box-footer pad\">';" . "\r\n";
$code_php .= "\$content .= '<input name=\"save-" . $addons_dir . "\" type=\"submit\" class=\"btn btn-danger btn-flat pull-left\" value=\"'.__e('Save Changes').'\" '.\$disabled.'/>';" . "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\$content .= '</div>';" . "\r\n";
$code_php .= "\$content .= '</form><!-- ./form -->';" . "\r\n";
$code_php .= "\$content .= '</div><!-- ./col-md-7 -->';" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\$content .= '<div class=\"col-md-5\"><!-- col-md-5 -->';" . "\r\n";
if ($rawdata['page'] == true)
{
    $code_php .= "\$content .= '<div class=\"box box-warning\">';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"box-header with-border\">';" . "\r\n";
    $code_php .= "\$content .= '<h3 class=\"box-title\"><i class=\"fa fa-cubes\"></i> '.__e('Latest Used').'</h3>';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"pull-right box-tools\">';" . "\r\n";
    $code_php .= "\$content .= '<button type=\"button\" class=\"btn btn-default btn-sm\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Collapse\">';" . "\r\n";
    $code_php .= "\$content .= '<i class=\"fa fa-minus\"></i>';" . "\r\n";
    $code_php .= "\$content .= '</button>';" . "\r\n";
    $code_php .= "\$content .= '</div>';" . "\r\n";
    $code_php .= "\$content .= '</div>';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"box-body\">';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"callout callout-default\">'.__e('Some settings that you have made:').'</div>';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"table-responsive\">';" . "\r\n";
    $code_php .= "\$content .= '<table class=\"table table-striped\" id=\"latest-used\">';" . "\r\n";
    $code_php .= "\$content .= '<thead>';" . "\r\n";
    $code_php .= "\$content .= '<tr>';" . "\r\n";
    $code_php .= "\$content .= '<th>#</th>';" . "\r\n";
    $code_php .= "\$content .= '<th>'.__e('Target').'</th>';" . "\r\n";
    $code_php .= "\$content .= '<th>'.__e('Title').'</th>';" . "\r\n";
    $code_php .= "\$content .= '<th></th>';" . "\r\n";
    $code_php .= "\$content .= '</tr>';" . "\r\n";
    $code_php .= "\$content .= '</thead>';" . "\r\n";
    $code_php .= "\$content .= '<tbody>';" . "\r\n";
    $code_php .= "\$modal_dialog = null;" . "\r\n";
    $code_php .= "if(count(\$addons_settings) >= 1){" . "\r\n";
    $code_php .= "\t" . "\$no = 1;" . "\r\n";
    $code_php .= "\t" . "foreach(\$addons_settings as \$pageList){" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<tr>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<td>'.\$no.'</td>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<td><a target=\"_blank\" href=\"./?p=pages&amp;a=edit&amp;page-name='.\$pageList['page-target'].'\">'.\$pageList['page-target'].'</a></td>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<td>'.\$pageList['page-title'].'</td>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<td>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<a href=\"./?p=addons&amp;addons=" . $addons_dir . "&amp;page-target='.\$pageList['page-target'].'&amp;a=edit#!_\" class=\"btn btn-xs btn-flat btn-success\"><i class=\"fa fa-pencil-square-o\"></i> '.__e('Edit').'</a>&nbsp;';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '<a href=\"#!_./?p=addons&amp;addons=" . $addons_dir . "&amp;page-target='.\$pageList['page-target'].'&amp;a=delete#!_\" data-toggle=\"modal\" data-target=\"#trash-dialog-'.\$no.'\" class=\"btn btn-xs btn-flat btn-danger\"><i class=\"fa fa-trash\"></i> '.__e('Delete').'</a>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '</td>';" . "\r\n";
    $code_php .= "\t\t" . "\$content .= '</tr>';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"modal fade modal-default\" id=\"trash-dialog-'.\$no.'\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"trash-dialog-'.\$no.'\" aria-hidden=\"true\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"modal-dialog\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"modal-content\">';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"modal-header\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<h4 class=\"modal-title\" id=\"delete-app-label\">'.__e('Delete Adds-ons Settings').'</h4>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div><!-- ./modal-header -->';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"modal-body\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<p>'.__e('Deleting this add-ons setting will not delete the page code that you have created. Are you sure want to delete this settings?').'</p>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"row\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"col-md-3\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"icon icon-confirm text-center\"><i class=\"fa fa-5x fa-cogs\"></i></div>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"col-md-9 text-left\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<table class=\"table-confirm\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<tr>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<td>'.__e('Page Target').'</td>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<td>: <strong>'.\$pageList['page-target'].'</strong></td>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .=  '</tr>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .=  '<tr>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .=  '<td>'.__e('Page Title').'</td>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<td>: <strong>'.\$pageList['page-title'].'</strong></td>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .=  '</tr>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</table>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div><!-- ./modal-body -->';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<div class=\"modal-footer\">';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<a href=\"./?p=addons&amp;addons=" . $addons_dir . "&amp;page-target='.\$pageList['page-target'].'&amp;a=delete\" class=\"btn btn-danger\">'.__e('Yes').'</a>&nbsp;';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '<button type=\"button\" data-dismiss=\"modal\" class=\"btn\">'.__e('Cancel').'</button>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div>';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div><!-- ./modal-content -->';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div><!-- ./modal-dialog -->';" . "\r\n";
    $code_php .= "\t\t" . "\$modal_dialog .= '</div><!-- ./modal -->';" . "\r\n";
    $code_php .= "\t\t" . "\$no++;" . "\r\n";
    $code_php .= "\t" . "}" . "\r\n";
    $code_php .= "}else{" . "\r\n";
    $code_php .= "\t" . "\$content .= '<tr>';" . "\r\n";
    $code_php .= "\t" . "\$content .= '<td>&nbsp;</td>';" . "\r\n";
    $code_php .= "\t" . "\$content .= '<td>'.__e('no pages').'</td>';" . "\r\n";
    $code_php .= "\t" . "\$content .= '<td></td>';" . "\r\n";
    $code_php .= "\t" . "\$content .= '<td></td>';" . "\r\n";
    $code_php .= "\t" . "\$content .= '</tr>';" . "\r\n";
    $code_php .= "}" . "\r\n";
    $code_php .= "\$content .= '</tbody>';" . "\r\n";
    $code_php .= "\$content .= '</table>';" . "\r\n";
    $code_php .= "\$content .= '</div><!-- ./table-responsive -->';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\$content .= '<div class=\"trash-dialog\"><!-- trash-dialog -->';" . "\r\n";
    $code_php .= "\$content .= \$modal_dialog;" . "\r\n";
    $code_php .= "\$content .= '</div><!-- ./trash-dialog -->';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\$content .= '</div><!-- ./box-body -->';" . "\r\n";
    $code_php .= "\$content .= '</div><!-- ./box -->';" . "\r\n";
} else
{
    $code_php .= "\$content .= '<div class=\"box box-warning\">';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"box-header with-border\">';" . "\r\n";
    $code_php .= "\$content .= '<h3 class=\"box-title\"><i class=\"fa fa-cubes\"></i> '.__e('Docs').'</h3>';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"pull-right box-tools\">';" . "\r\n";
    $code_php .= "\$content .= '<button type=\"button\" class=\"btn btn-default btn-sm\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Collapse\">';" . "\r\n";
    $code_php .= "\$content .= '<i class=\"fa fa-minus\"></i>';" . "\r\n";
    $code_php .= "\$content .= '</button>';" . "\r\n";
    $code_php .= "\$content .= '</div>';" . "\r\n";
    $code_php .= "\$content .= '</div>';" . "\r\n";
    $code_php .= "\$content .= '<div class=\"box-body\">';" . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\$content .= '</div><!-- ./box-body -->';" . "\r\n";
    $code_php .= "\$content .= '</div><!-- ./box -->';" . "\r\n";
}
$code_php .= "\$content .= '</div><!-- ./col-md-5 -->';" . "\r\n";
$code_php .= "\$content .= '</div><!-- ./row -->';" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\r\n";
$code_php .= "" . "// TO" . "DO: JS" . "\r\n";
$code_php .= "\$page_js .= '$(\"#page-target\").on(\"change\",function(){return window.location=\"?p=addons&addons=" . $addons_dir . "&page-target=\"+$(\"#page-target\").val(),!1});';" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\r\n";
$code_addons_php = $code_php;
$code_php = null;
$code_php .= "<?php" . "\r\n";
$code_php .= "\r\n";
$code_php .= "/**" . "\r\n";
$code_php .= " * @author " . $rawdata['author'] . " <" . $rawdata['email'] . ">" . "\r\n";
$code_php .= " * @copyright " . $rawdata['company'] . " " . date("Y") . "\r\n";
$code_php .= " * @license Commercial License" . "\r\n";
$code_php .= " * " . "\r\n";
$code_php .= " * @package `" . $string->toFileName($rawdata['name']) . "`" . "\r\n";
$code_php .= " */" . "\r\n";
$code_php .= "\r\n";
$code_php .= "\r\n";
$code_php .= "defined('JSM_EXEC') or die('Silence is golden');" . "\r\n";
$code_index_php = $code_php;
$code_json = array();
$code_json['name'] = $rawdata['name'] . '';
$code_json['version'] = '1.0.0';
$code_json['desc'] = $rawdata['desc'];
$code_json['author'] = $rawdata['author'];
$code_json['email'] = $rawdata['email'];
$code_json['company'] = $rawdata['company'];
$code_json['prefix'] = $string->toFileName($rawdata['name']);
class jsmString
{
    /**
     * jsmString::toClassName()
     * 
     * @param mixed $string
     * @return
     */
    public function toClassName($string)
    {
        $string = trim($string);
        $Allow = null;
        $char = ' -_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        $Allow = ucwords(str_replace(array('-', '_'), ' ', strtolower($Allow)));
        return str_replace(' ', '', $Allow);
    }
    /**
     * jsmString::toVar()
     * 
     * @param mixed $string
     * @param string $allow
     * @return
     */
    public function toVar($string, $allow = ",")
    {
        $string = trim($string);
        $string = str_replace('-', '_', strtolower($string));
        $Allow = null;
        $char = ' abcdefghijklmnopqrstuvwxyz1234567890_' . $allow;
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        $Allow = str_replace(' ', '_', strtolower($Allow));
        return $Allow;
    }
    /**
     * jsmString::toFileName()
     * 
     * @param mixed $string
     * @return
     */
    public function toFileName($string)
    {
        $string = strtolower(trim($string));
        $Allow = null;
        $char = ' abcdefghijklmnopqrstuvwxyz1234567890-';
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        $Allow = str_replace(' ', '-', strtolower($Allow));
        return $Allow;
    }
}
if (!file_exists('./../addons/' . $addons_dir . '/'))
{
    @mkdir('./../addons/' . $addons_dir . '/');
}
file_put_contents('./../addons/' . $addons_dir . '/' . $addons_dir . '.php', $code_addons_php);
file_put_contents('./../addons/' . $addons_dir . '/' . $addons_dir . '.json', json_encode($code_json, JSON_PRETTY_PRINT));
$html_tags = null;
$html_tags .= '<div class="panel panel-default">';
$html_tags .= '<div class="panel-body">';
foreach (glob("settings/*.json") as $filename)
{
    $html_tags .= '<div class="col-xs-12"><a href="?get=' . $filename . '">' . $filename . '</a></div>';
}
$html_tags .= '</div>';
$html_tags .= '</div>';
$html_tags .= '<form method="post" action="">';
$html_tags .= '<div class="row">';
$html_tags .= '<div class="col-md-6">';
$html_tags .= '<div class="panel panel-default">';
$html_tags .= '<div class="panel-body">';
if (!isset($rawdata['name']))
{
    $rawdata['name'] = '';
}
$html_tags .= '<div class="form-group">';
$html_tags .= '<label>Your Addons Name</label>';
$html_tags .= '<input name="addons[name]" type="text" class="form-control" value="' . htmlentities($rawdata['name']) . '" placeholder="My Addons"/>';
$html_tags .= '<p class="help-block">Write your addons name!</p>';
$html_tags .= '</div>';
if (!isset($rawdata['desc']))
{
    $rawdata['desc'] = '';
}
$html_tags .= '<div class="form-group">';
$html_tags .= '<label>Description</label>';
$html_tags .= '<input name="addons[desc]" type="text" class="form-control" value="' . htmlentities($rawdata['desc']) . '" placeholder="My first Addons"/>';
$html_tags .= '<p class="help-block">A brief description of your addons?</p>';
$html_tags .= '</div>';
$html_tags .= '<hr/>';
if (!isset($rawdata['service']))
{
    $rawdata['service'] = false;
}
$html_tags .= '<div class="form-group">';
$html_tags .= '<label>Example Code</label>';
if ($rawdata['global'] == true)
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[global]" type="checkbox" checked/> Global</label></div>';
} else
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[global]" type="checkbox" /> Global</label></div>';
}
if ($rawdata['service'] == true)
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[service]" type="checkbox" checked/> Service</label></div>';
} else
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[service]" type="checkbox" /> Service</label></div>';
}
if ($rawdata['page'] == true)
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[page]" type="checkbox" checked/> Page</label></div>';
} else
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[page]" type="checkbox" /> Page</label></div>';
}
if ($rawdata['component'] == true)
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[component]" type="checkbox" checked/> Component</label></div>';
} else
{
    $html_tags .= '<div class="checkbox"><label><input name="addons[component]" type="checkbox" /> Component</label></div>';
}
$html_tags .= '</div>';
$html_tags .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> Save Changes</button>';
$html_tags .= '</div>';
$html_tags .= '</div>';
$html_tags .= '</div><!-- ./col-md-6 -->';
$html_tags .= '<div class="col-md-6">';
$html_tags .= '<div class="panel panel-default">';
$html_tags .= '<div class="panel-body">';
if (!isset($rawdata['author']))
{
    $rawdata['author'] = '';
}
$html_tags .= '<div class="form-group">';
$html_tags .= '<label>Author</label>';
$html_tags .= '<input name="addons[author]" type="text" class="form-control" value="' . htmlentities($rawdata['author']) . '" placeholder="M. Jasman"/>';
$html_tags .= '<p class="help-block">Your fullname</p>';
$html_tags .= '</div>';
if (!isset($rawdata['email']))
{
    $rawdata['email'] = '';
}
$html_tags .= '<div class="form-group">';
$html_tags .= '<label>Email</label>';
$html_tags .= '<input name="addons[email]" type="text" class="form-control" value="' . htmlentities($rawdata['email']) . '" placeholder="cs@ihsana.com" />';
$html_tags .= '<p class="help-block">Which email is used for your support?</p>';
$html_tags .= '</div>';
if (!isset($rawdata['company']))
{
    $rawdata['company'] = '';
}
$html_tags .= '<div class="form-group">';
$html_tags .= '<label>Your Company</label>';
$html_tags .= '<input name="addons[company]" type="text" class="form-control" value="' . htmlentities($rawdata['company']) . '" placeholder="Ihsana IT Solution"/>';
$html_tags .= '<p class="help-block">What is your company name?</p>';
$html_tags .= '</div>';
$html_tags .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> Save Changes</button>';
$html_tags .= '</div>';
$html_tags .= '</div>';
$html_tags .= '</div>';
$html_tags .= '</div><!-- ./row -->';
$max = count($rawdata['form']) + 1;
$html_tags .= '<div class="panel panel-default">';
$html_tags .= '<div class="panel-body">';
$html_tags .= '<label>Form Inputs</label>';
$html_tags .= '<table class="table table-striped">';
$html_tags .= '<thead>';
$html_tags .= '<tr>';
$html_tags .= '<th style="width:15%">';
$html_tags .= 'Name';
$html_tags .= '<th>';
$html_tags .= '<th style="width:15%">';
$html_tags .= 'Title';
$html_tags .= '<th>';
$html_tags .= '<th style="width:15%">';
$html_tags .= 'Placeholder';
$html_tags .= '<th>';
$html_tags .= '<th style="width:25%">';
$html_tags .= 'Help';
$html_tags .= '<th>';
$html_tags .= '<th style="width:10%">';
$html_tags .= 'Attributes';
$html_tags .= '<th>';
$html_tags .= '<th style="width:15%">';
$html_tags .= 'Option';
$html_tags .= '<th>';
$html_tags .= '<th style="width:15%">';
$html_tags .= 'Type';
$html_tags .= '<th>';
$html_tags .= '</tr>';
$html_tags .= '</thead>';
for ($i = 0; $i < $max; $i++)
{
    if (!isset($rawdata['form'][$i]['name']))
    {
        $rawdata['form'][$i]['name'] = '';
    }
    if (!isset($rawdata['form'][$i]['title']))
    {
        $rawdata['form'][$i]['title'] = '';
    }
    if (!isset($rawdata['form'][$i]['placeholder']))
    {
        $rawdata['form'][$i]['placeholder'] = '';
    }
    if (!isset($rawdata['form'][$i]['help']))
    {
        $rawdata['form'][$i]['help'] = '';
    }
    if (!isset($rawdata['form'][$i]['attributes']))
    {
        $rawdata['form'][$i]['attributes'] = '';
    }
    if (!isset($rawdata['form'][$i]['type']))
    {
        $rawdata['form'][$i]['type'] = 'text';
    }
    if (!isset($rawdata['form'][$i]['option']))
    {
        $rawdata['form'][$i]['option'] = '';
    }
    $html_tags .= '<tr>';
    $html_tags .= '<td>';
    $html_tags .= '<input type="text" name="addons[form][' . $i . '][name]" class="form-control" value="' . htmlentities($rawdata['form'][$i]['name']) . '" placeholder="my-option-' . ($i + 1) . '" />';
    $html_tags .= '<td>';
    $html_tags .= '<td>';
    $html_tags .= '<input type="text" name="addons[form][' . $i . '][title]" class="form-control" value="' . htmlentities($rawdata['form'][$i]['title']) . '" placeholder="My Option ' . ($i + 1) . '" />';
    $html_tags .= '<td>';
    $html_tags .= '<td>';
    $html_tags .= '<input type="text" name="addons[form][' . $i . '][placeholder]" class="form-control" value="' . htmlentities($rawdata['form'][$i]['placeholder']) . '" placeholder=""/>';
    $html_tags .= '<td>';
    $html_tags .= '<td>';
    $html_tags .= '<input type="text" name="addons[form][' . $i . '][help]" class="form-control" value="' . htmlentities($rawdata['form'][$i]['help']) . '" placeholder=""/>';
    $html_tags .= '<td>';
    $html_tags .= '<td>';
    $html_tags .= '<input type="text" name="addons[form][' . $i . '][attributes]" class="form-control" value="' . htmlentities($rawdata['form'][$i]['attributes']) . '" placeholder="required"/>';
    $html_tags .= '<td>';
    $html_tags .= '<td>';
    $html_tags .= '<input type="text" name="addons[form][' . $i . '][option]" class="form-control" value="' . htmlentities($rawdata['form'][$i]['option']) . '" placeholder="opt1|opt2"/>';
    $html_tags .= '<td>';
    $html_tags .= '<td>';
    $html_tags .= '<select class="form-control" name="addons[form][' . $i . '][type]">';
    foreach ($item_types as $item_type)
    {
        $selected = '';
        if ($rawdata['form'][$i]['type'] == $item_type['value'])
        {
            $selected = 'selected';
        }
        $html_tags .= '<option ' . $selected . ' value="' . $item_type['value'] . '">' . $item_type['label'] . '</option>';
    }
    $html_tags .= '</select>';
    $html_tags .= '<td>';
    $html_tags .= '</tr>';
}
$html_tags .= '</table>';
$html_tags .= '<button type="submit" class="btn btn-flat btn-danger" name="submit-menu"><i class="fa fa-floppy-o"></i> Save Changes</button>';
$html_tags .= '</div>';
$html_tags .= '</div>';
$html_tags .= '</form>';

echo '<!DOCTYPE HTML>';
echo '<html>';
echo '<head>';
echo '<meta http-equiv="content-type" content="text/html" />';
echo '<meta name="author" content="Jasman" />';
echo '<title>AddOns Generator</title>';
echo '<link rel="stylesheet" href="./../templates/default/bootstrap/css/bootstrap.min.css"/>';
echo '<link rel="stylesheet" href="./../templates/default/assets/css/imabuilder.css"/>';
echo '<link rel="stylesheet" href="./../templates/default/font-awesome/css/font-awesome.min.css"/>';
echo '</head>';
echo '<body>';
echo '<div class="container-fluid">';
echo '<h1>AddOns Generator</h1>';
echo $html_tags;
echo '<div class="panel panel-default">';
echo '<div class="panel-body">';
echo '<div style="overflow: scroll;">' . highlight_string($code_addons_php, true) . '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</body>';
echo '</html>';
