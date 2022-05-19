<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `disqus`
 */
defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$all_pages = $db->getPages();
$addons_settings = $db->getAddonsUsed("disqus");
$string = new jsmString();
$current_page_target = 'core';
if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('disqus', $current_page_target);
    header('Location: ./?p=addons&addons=disqus&' . time());
}
// TODO: POST
if (isset($_POST['save-disqus']))
{
    // save addons setting
    $addons = array();
    $addons['page-target'] = $current_page_target;
    // TODO: POST --|-- RESPONSE
    $addons['page-title'] = $current_page_target;
    $addons['page-header-color'] = trim($_POST['disqus']['page-header-color']);
    $addons['page-content-background'] = trim($_POST['disqus']['page-content-background']);
    //shortname
    if (!isset($_POST['disqus']['shortname']))
    {
        $_POST['disqus']['shortname'] = '';
    }
    $addons['shortname'] = $_POST['disqus']['shortname']; //text
    //comment-url
    if (!isset($_POST['disqus']['comment-url']))
    {
        $_POST['disqus']['comment-url'] = '';
    }
    $addons['comment-url'] = trim($_POST['disqus']['comment-url']); //text


    foreach ($_POST['disqus']['pages'] as $page)
    {
        $page_name = $page['prefix'];

        if (isset($_POST['disqus']['pages'][$page_name]['enable']))
        {
            $addons['pages'][$page_name]['enable'] = true;
            $addons['pages'][$page_name]['prefix'] = $page_name;
        } else
        {
            $addons['pages'][$page_name]['enable'] = false;
            $addons['pages'][$page_name]['prefix'] = $page_name;
        }
    }


    $db->saveAddOns('disqus', $addons);


    // TODO: DIRECTIVES --+-- APP-BROWSER
    $newDirectives = null;
    $newDirectives['name'] = 'Disqus';
    $newDirectives['var'] = 'disqus';
    $newDirectives['prefix'] = 'disqus';
    $newDirectives['directive'] = 'disqus';
    $newDirectives['input'][] = array('var' => 'url', 'type' => 'string');
    $newDirectives['code']['click'] = "" . 'this.runAppBrowser(this.url);';
    $newDirectives['code']['other'] = null;
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* Options for the Cordova InAppBrowser Plugin' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @reference: https://cordova.apache.org/docs/en/latest/reference/cordova-plugin-inappbrowser/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'appBrowserOption : InAppBrowserOptions = {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'location : "yes",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'hidden : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'zoom : "no", //android & windows' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'hardwareback : "yes", //android & windows' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'mediaPlaybackRequiresUserAction : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'shouldPauseOnSuspend : "no", //android' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'closebuttoncolor : "#03372D",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'toolbarcolor : "#066177",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'disallowoverscroll : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'toolbar : "yes", //ios only' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'enableViewportScale : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'allowInlineMediaPlayback : "no",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'presentationstyle : "pagesheet",' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'fullscreen : "yes", //windows' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '/**' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* runAppBrowser($url)' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '* @param string $url = "http://ihsana.com/disqus.html"' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '**/' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . 'private runAppBrowser(url: string){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'let urlAddr = url || "http://ihsana.com/disqus.html";' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . 'if (this.platform.is("ios")){' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'this.inAppBrowser.create(urlAddr,"_system");' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}else{' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'let browser = this.inAppBrowser.create(urlAddr,"_blank",this.appBrowserOption);' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . 'browser.on("loadstop").subscribe(event => {' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . 'browser.executeScript({' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t\t" . 'code: "var url = this.location.href;console.log(\'url:\',this.sessionStorage.discussionUrl);if (url.indexOf(\'disqus.com/next/login-success\') > -1 || url.indexOf(\'disqus.com/_ax/facebook/complete\') > -1 || url.indexOf(\'disqus.com/_ax/google/complete\') > -1 || url.indexOf(\'disqus.com/_ax/twitter/complete\') > -1) {window.location.href = this.sessionStorage.discussionUrl;}"' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t\t" . '});' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    $newDirectives['code']['other'] .= "\t\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '}' . "\r\n";
    $newDirectives['code']['other'] .= "\t" . '' . "\r\n";
    $newDirectives['desc'] = 'Open with Disqus Comment';
    $newDirectives['instruction'] = '<p>You can use this directive as an example:</p><pre>&lt;ion-button disqus ' . "\r\n\t" . 'url="http://ihsana.com/disqus.html" &gt;' . "\r\n\t" . 'Comments' . "\r\n" . '&lt;/ion-button&gt;</pre>';
    $newDirectives['status'] = 'protected';
    $v = 0;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowser';
    $newDirectives['modules']['angular'][$v]['var'] = 'inAppBrowser';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'InAppBrowserOptions';
    $newDirectives['modules']['angular'][$v]['cordova'] = 'cordova-plugin-inappbrowser';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic-native/in-app-browser/ngx';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $v++;
    $newDirectives['modules']['angular'][$v]['class'] = 'Platform';
    $newDirectives['modules']['angular'][$v]['var'] = 'platform';
    $newDirectives['modules']['angular'][$v]['cordova'] = '';
    $newDirectives['modules']['angular'][$v]['path'] = '@ionic/angular';
    $newDirectives['modules']['angular'][$v]['enable'] = true;
    $db->saveDirective($newDirectives);


    foreach ($addons['pages'] as $set_page)
    {
        $btn_comment = null;
        $btn_comment .= "\t" . '<ion-fab vertical="bottom" horizontal="end">' . "\r\n";
        $btn_comment .= "\t\t" . '<ion-fab-button disqus url="' . $addons['comment-url'] . '?page=' . $set_page['prefix'] . '">' . "\r\n";
        $btn_comment .= "\t\t\t" . '<ion-icon name="chatbubble-ellipses-outline"></ion-icon>' . "\r\n";
        $btn_comment .= "\t\t" . '</ion-fab-button>' . "\r\n";
        $btn_comment .= "\t" . '</ion-fab>' . "\r\n";
        $old_page = $db->getPage($set_page['prefix']);
        if ($set_page['enable'] == true)
        {
            $old_page['footer']['type'] = 'code';
            $old_page['footer']['code'] = $btn_comment;
        } else
        {
            $old_page['footer']['type'] = 'none';
            $old_page['footer']['code'] = '';
        }

        $db->savePage($old_page);

    }

    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=disqus&' . time());
}
// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('disqus', $current_page_target);
}
if (!isset($current_setting['page-header-color']))
{
    $current_setting['page-header-color'] = 'primary';
}
if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}
if (!isset($current_setting['shortname']))
{
    $current_setting['shortname'] = '';
}
if (!isset($current_setting['comment-url']))
{
    $current_setting['comment-url'] = 'https://yoursite.com/comment.html';
}
// TODO: LAYOUT --|-- FORM
$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';
$content .= '<form action="" method="post"><!-- ./form -->';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-default">' . __e('Please complete the form below to let us know how we can help you build code:') . '</div>';
$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-HEADER-COLOR
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-header-color">' . __e('Header Color') . '</label>';
$content .= '<select name="disqus[page-header-color]" class="form-control select-color" data-color="' . $current_setting['page-header-color'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['page-header-color'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
// TODO: LAYOUT --|-- FORM --|-- PAGE-CONTENT-BACKGROUND
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-background">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="page-content-background" type="text" name="disqus[page-content-background]" class="form-control" placeholder="assets/images/bg-01.png"  value="' . $current_setting['page-content-background'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#page-content-background" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div>';
// TODO: LAYOUT --|-- FORM --|-- SHORTNAME --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-shortname" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-shortname">' . __e('Website Shortname on Disqus Admin') . '</label>';
$content .= '<input id="page-shortname" type="text" name="disqus[shortname]" class="form-control" placeholder="my-app"  value="' . $current_setting['shortname'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Your website shortname get from disqus configuration') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '<hr>';
// TODO: LAYOUT --|-- FORM --|-- COMMENT-URL --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-comment-url" class="col-md-12"><!-- col-md-12 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-comment-url">' . __e('Comment URL') . '</label>';
$content .= '<input id="page-comment-url" type="text" name="disqus[comment-url]" class="form-control" placeholder="https://yoursite.com/comments.html"  value="' . $current_setting['comment-url'] . '"  ' . $disabled . ' requred />';
$content .= '<p class="help-block">' . __e('Fill in the <strong>comments.html</strong> link that you have uploaded') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '<hr>';

$comment_url = null;
$comment_url = '<ion-button disqus url="' . $current_setting['comment-url'] . '?page={{ pageName }}"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></ion-button>';

$content .= '<h3>' . __e('Insert Disqus') . '</h3>';

$content .= '<div class="callout callout-danger">' . __e('This action will overwrite the ion-footer code on the page, If an ion-footer has been used, please enter the directive code manually') . '. ' . __e('Goto: ') . ' <strong>(IMAB) Page</strong> -&raquo; <strong>Edit</strong> -&raquo; <strong>Page Footer</strong> -&raquo; <strong>Layout Type: Custom Code</strong></div>';

$content .= '<pre>';
$content .= htmlentities($comment_url);
$content .= '</pre>';


$content .= '<table class="table table-striped">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>';
$content .= '' . __e('Pages') . '';
$content .= '</th>';
$content .= '<th>';
$content .= '' . __e('Support') . '';
$content .= '</th>';
$content .= '<th>';
$content .= '' . __e('Enable Comment') . '';
$content .= '</th>';
$content .= '</tr>';
$content .= '</thead>';
foreach ($all_pages as $static_page)
{
    $page_name = $string->toFilename($static_page['name']);
    if (!isset($static_page['footer']['type']))
    {
        $static_page['footer']['type'] = 'title';
    }
    $content .= '<tr>';
    $content .= '<td>';
    $content .= $page_name;
    $content .= '</td>';
    $is_support = false;
    if ($static_page['footer']['type'] == 'code')
    {
        if (preg_match("/\bdisqus\b/i", $static_page['footer']['code']))
        {
            $is_support = true;
        }
        if ($static_page['footer']['code'] == '')
        {
            $is_support = true;
        }

    } else
    {
        $is_support = true;
    }
    $content .= '<td>';
    if ($is_support == true)
    {
        $content .= '<span class="label label-success">' . __e('Yes') . '</span>';
    } else
    {
        $content .= '<span class="label label-danger">' . __e('No') . '</span>';
    }
    $content .= '</td>';
    $content .= '<td>';
    if ($is_support == true)
    {
        $_checked = '';
        if (isset($current_setting['pages'][$page_name]['enable']))
        {
            if ($current_setting['pages'][$page_name]['enable'] == true)
            {
                $_checked = 'checked';
            }
        }
        $content .= '<input name="disqus[pages][' . $page_name . '][enable]" type="checkbox" class="flat-green" ' . $_checked . ' />';
        $content .= '<input type="hidden" name="disqus[pages][' . $page_name . '][prefix]" value="' . $page_name . '" />';
    } else
    {
        $content .= '<input  type="checkbox" class="flat-green" disabled/>';
    }
    $content .= '</td>';
    $content .= '</tr>';
}
$content .= '</table>';
$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-disqus" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-7 -->';
$content .= '<div class="col-md-5"><!-- col-md-5 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('How to use?') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<ol>';
$content .= '<li>' . __e('Login to <a target="_blank" href="https://disqus.com/admin/create/">Disqus Admin</a> and Create a Site') . '</li>';
$content .= '<li>' . __e('Write the <strong>Shortname</strong> field on the right box and then save it');
$content .= '<img class="img-thumbnail" src="data:image/png;base64,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" />';
$content .= '</li>';
$content .= '<li>';
$content .= '<p>Upload the code below to your server with the file name: <strong>comments.html</strong></p>';
if ($current_setting['shortname'] == '')
{
    $current_setting['shortname'] = 'my-app';
}
$disqus_code = null;
$disqus_code .= "<!DOCTYPE HTML>" . "\r\n";
$disqus_code .= "<html lang=\"en\">" . "\r\n";
$disqus_code .= "<head>" . "\r\n";
$disqus_code .= "<meta charset=\"utf-8\" />" . "\r\n";
$disqus_code .= "<meta http-equiv=\"content-type\" content=\"text/html\" />" . "\r\n";
$disqus_code .= "<meta name=\"viewport\" content=\"viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\" />" . "\r\n";
$disqus_code .= "<title>" . $current_app['apps']['app-name'] . "</title>" . "\r\n";
$disqus_code .= "</head>" . "\r\n";
$disqus_code .= "<body>" . "\r\n";
$disqus_code .= "<div id=\"disqus_thread\"></div>" . "\r\n";
$disqus_code .= "<script>" . "\r\n";
$disqus_code .= "var disqus_config = function(){" . "\r\n";
$disqus_code .= "this.page.url = window.location.href;" . "\r\n";
$disqus_code .= "this.page.identifier = window.location.href;" . "\r\n";
$disqus_code .= "};" . "\r\n";
$disqus_code .= "(function() { // DON'T EDIT BELOW THIS LINE" . "\r\n";
$disqus_code .= "var d = document, s = d.createElement('script');" . "\r\n";
$disqus_code .= "s.src = 'https://" . $current_setting['shortname'] . ".disqus.com/embed.js';" . "\r\n";
$disqus_code .= "s.setAttribute('data-timestamp', +new Date());" . "\r\n";
$disqus_code .= "(d.head || d.body).appendChild(s);" . "\r\n";
$disqus_code .= "})();" . "\r\n";
$disqus_code .= "</script>" . "\r\n";
$disqus_code .= "<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\">comments powered by Disqus.</a></noscript>" . "\r\n";
$disqus_code .= "</body>" . "\r\n";
$disqus_code .= "</html>" . "\r\n";
$content .= '<pre>';
$content .= htmlentities($disqus_code);
$content .= '</pre>';
$content .= '<p>Then write the <strong>Comment URL</strong> field on the right box</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>Finally, check the page where the comment will be inserted</p>';
$content .= '</li>';
$content .= '</ol>';
$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';
// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=disqus&page-target="+$("#page-target").val(),!1});';
