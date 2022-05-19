<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * 
 * @package `jwt-auth`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;
$color = 'light';
// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getPages();
$addons_settings = $db->getAddonsUsed("jwt-auth");
$string = new jsmString();

$current_page_target = 'core';
$themes = $db->getThemes();


if (isset($_POST['delete-jwt-auth']))
{
    $db->deleteAddOns('jwt-auth', 'core');
    $db->deleteGlobal('jwt-auth', 'core');
    $db->deleteService('jwt-auth');
    $db->deletePage('login');
    $db->deletePage('denied');
    $db->deletePage('profile');

    header('Location: ./?p=addons&addons=jwt-auth&' . time());
}

function ssl_required($url)
{
    return str_replace("http://", "https://", $url);
}

// TODO: POST
if (isset($_POST['save-jwt-auth']))
{
    // TODO: SAVE PROJECT
    $new_project = $current_app['apps'];
    $new_project['ionic-storage'] = true;
    $db->saveProject($new_project);

    // TODO: SAVE ADDONS
    $addons = array();

    $addons['page-target'] = 'core';
    $addons['page-title'] = 'core';

    $addons['title-for-page-login'] = trim($_POST['jwt-auth']['title-for-page-login']);
    $addons['header-color-for-page-login'] = trim($_POST['jwt-auth']['header-color-for-page-login']);
    $addons['content-background-for-page-login'] = trim($_POST['jwt-auth']['content-background-for-page-login']);
    $addons['app-logo-for-page-login'] = trim($_POST['jwt-auth']['app-logo-for-page-login']);
    $addons['after-login-goto-page'] = trim($_POST['jwt-auth']['after-login-goto-page']);

    $addons['title-for-page-register'] = trim($_POST['jwt-auth']['title-for-page-register']);
    $addons['content-background-for-page-register'] = trim($_POST['jwt-auth']['content-background-for-page-register']);
    $addons['header-color-for-page-register'] = trim($_POST['jwt-auth']['header-color-for-page-register']);

    $addons['title-for-page-denied'] = trim($_POST['jwt-auth']['title-for-page-denied']);
    $addons['content-for-page-denied'] = trim($_POST['jwt-auth']['content-for-page-denied']);
    $addons['header-color-for-page-denied'] = trim($_POST['jwt-auth']['header-color-for-page-denied']);
    $addons['content-background-for-page-denied'] = trim($_POST['jwt-auth']['content-background-for-page-denied']);

    $addons['title-for-page-profile'] = trim($_POST['jwt-auth']['title-for-page-profile']);
    $addons['header-color-for-page-profile'] = trim($_POST['jwt-auth']['header-color-for-page-profile']);
    $addons['content-background-for-page-profile'] = trim($_POST['jwt-auth']['content-background-for-page-profile']);

    $addons['url-token'] = ssl_required($_POST['jwt-auth']['url-token']);
    $addons['url-validate'] = ssl_required($_POST['jwt-auth']['url-validate']);
    $addons['url-register'] = ssl_required($_POST['jwt-auth']['url-register']);

    $addons['page-rules'] = $_POST['jwt-auth']['page-rules'];
    $addons['no-auth-goto'] = $_POST['jwt-auth']['no-auth-goto'];

    //jwt-auth-type
    $addons['jwt-auth-type'] = trim($_POST['jwt-auth']['jwt-auth-type']); //select

    //main-url
    if (!isset($_POST['jwt-auth']['main-url']))
    {
        $_POST['jwt-auth']['main-url'] = '';
    }
    $addons['main-url'] = ssl_required($_POST['jwt-auth']['main-url']); //text


    //label-for-login
    if (!isset($_POST['jwt-auth']['label-for-login']))
    {
        $_POST['jwt-auth']['label-for-login'] = 'Login';
    }
    $addons['label-for-login'] = trim($_POST['jwt-auth']['label-for-login']); //text

    //label-for-register
    if (!isset($_POST['jwt-auth']['label-for-register']))
    {
        $_POST['jwt-auth']['label-for-register'] = 'Register';
    }
    $addons['label-for-register'] = trim($_POST['jwt-auth']['label-for-register']); //text

    //label-for-username
    if (!isset($_POST['jwt-auth']['label-for-username']))
    {
        $_POST['jwt-auth']['label-for-username'] = 'Username';
    }
    $addons['label-for-username'] = trim($_POST['jwt-auth']['label-for-username']); //text

    //label-for-password
    if (!isset($_POST['jwt-auth']['label-for-password']))
    {
        $_POST['jwt-auth']['label-for-password'] = 'Password';
    }
    $addons['label-for-password'] = trim($_POST['jwt-auth']['label-for-password']); //text

    //label-for-please-wait
    if (!isset($_POST['jwt-auth']['label-for-please-wait']))
    {
        $_POST['jwt-auth']['label-for-please-wait'] = 'Please wait...!';
    }
    $addons['label-for-please-wait'] = trim($_POST['jwt-auth']['label-for-please-wait']); //text

    //label-for-email
    if (!isset($_POST['jwt-auth']['label-for-email']))
    {
        $_POST['jwt-auth']['label-for-email'] = 'Email';
    }
    $addons['label-for-email'] = trim($_POST['jwt-auth']['label-for-email']); //text

    //label-for-first-name
    if (!isset($_POST['jwt-auth']['label-for-first-name']))
    {
        $_POST['jwt-auth']['label-for-first-name'] = 'First Name';
    }
    $addons['label-for-first-name'] = trim($_POST['jwt-auth']['label-for-first-name']); //text

    //label-for-last-name
    if (!isset($_POST['jwt-auth']['label-for-last-name']))
    {
        $_POST['jwt-auth']['label-for-last-name'] = 'Last Name';
    }
    $addons['label-for-last-name'] = trim($_POST['jwt-auth']['label-for-last-name']); //text

    //label-for-company
    if (!isset($_POST['jwt-auth']['label-for-company']))
    {
        $_POST['jwt-auth']['label-for-company'] = 'Company';
    }
    $addons['label-for-company'] = trim($_POST['jwt-auth']['label-for-company']); //text

    //label-for-address-1
    if (!isset($_POST['jwt-auth']['label-for-address-1']))
    {
        $_POST['jwt-auth']['label-for-address-1'] = 'Address 1';
    }
    $addons['label-for-address-1'] = trim($_POST['jwt-auth']['label-for-address-1']); //text

    //label-for-address-2
    if (!isset($_POST['jwt-auth']['label-for-address-2']))
    {
        $_POST['jwt-auth']['label-for-address-2'] = 'Address 2';
    }
    $addons['label-for-address-2'] = trim($_POST['jwt-auth']['label-for-address-2']); //text

    //label-for-city
    if (!isset($_POST['jwt-auth']['label-for-city']))
    {
        $_POST['jwt-auth']['label-for-city'] = 'City';
    }
    $addons['label-for-city'] = trim($_POST['jwt-auth']['label-for-city']); //text

    //label-for-state
    if (!isset($_POST['jwt-auth']['label-for-state']))
    {
        $_POST['jwt-auth']['label-for-state'] = 'State';
    }
    $addons['label-for-state'] = trim($_POST['jwt-auth']['label-for-state']); //text

    //label-for-postcode
    if (!isset($_POST['jwt-auth']['label-for-postcode']))
    {
        $_POST['jwt-auth']['label-for-postcode'] = 'Postcode';
    }
    $addons['label-for-postcode'] = trim($_POST['jwt-auth']['label-for-postcode']); //text

    //label-for-country
    if (!isset($_POST['jwt-auth']['label-for-country']))
    {
        $_POST['jwt-auth']['label-for-country'] = 'Country';
    }
    $addons['label-for-country'] = trim($_POST['jwt-auth']['label-for-country']); //text

    //label-for-phone
    if (!isset($_POST['jwt-auth']['label-for-phone']))
    {
        $_POST['jwt-auth']['label-for-phone'] = 'Phone';
    }
    $addons['label-for-phone'] = trim($_POST['jwt-auth']['label-for-phone']); //text

    //label-for-successfully
    if (!isset($_POST['jwt-auth']['label-for-successfully']))
    {
        $_POST['jwt-auth']['label-for-successfully'] = 'Successfully';
    }
    $addons['label-for-successfully'] = trim($_POST['jwt-auth']['label-for-successfully']); //text


    //label-for-personal-data
    if (!isset($_POST['jwt-auth']['label-for-personal-data']))
    {
        $_POST['jwt-auth']['label-for-personal-data'] = 'Personal Data';
    }
    $addons['label-for-personal-data'] = trim($_POST['jwt-auth']['label-for-personal-data']); //text

    //label-for-login-data
    if (!isset($_POST['jwt-auth']['label-for-login-data']))
    {
        $_POST['jwt-auth']['label-for-login-data'] = 'Login Data';
    }
    $addons['label-for-login-data'] = trim($_POST['jwt-auth']['label-for-login-data']); //text

    //label-for-website
    if (!isset($_POST['jwt-auth']['label-for-website']))
    {
        $_POST['jwt-auth']['label-for-website'] = 'Website';
    }
    $addons['label-for-website'] = trim($_POST['jwt-auth']['label-for-website']); //text


    //label-for-registration-form
    if (!isset($_POST['jwt-auth']['label-for-registration-form']))
    {
        $_POST['jwt-auth']['label-for-registration-form'] = 'Registration Form';
    }
    $addons['label-for-registration-form'] = trim($_POST['jwt-auth']['label-for-registration-form']); //text

    //label-for-successfully-validate-the-token
    if (!isset($_POST['jwt-auth']['label-for-successfully-validate-the-token']))
    {
        $_POST['jwt-auth']['label-for-successfully-validate-the-token'] = 'Successfully validate the token!';
    }
    $addons['label-for-successfully-validate-the-token'] = trim($_POST['jwt-auth']['label-for-successfully-validate-the-token']); //text

    //label-for-birthday
    if (!isset($_POST['jwt-auth']['label-for-birthday']))
    {
        $_POST['jwt-auth']['label-for-birthday'] = 'Birthday';
    }
    $addons['label-for-birthday'] = trim($_POST['jwt-auth']['label-for-birthday']); //text

    //label-for-submit
    if (!isset($_POST['jwt-auth']['label-for-submit']))
    {
        $_POST['jwt-auth']['label-for-submit'] = 'Submit';
    }
    $addons['label-for-submit'] = trim($_POST['jwt-auth']['label-for-submit']); //text

    //label-for-ok
    if (!isset($_POST['jwt-auth']['label-for-ok']))
    {
        $_POST['jwt-auth']['label-for-ok'] = 'Okey!';
    }
    $addons['label-for-ok'] = trim($_POST['jwt-auth']['label-for-ok']); //text


    $db->saveAddOns('jwt-auth', $addons);
    // TODO: ---------------------------------------------------------------------------------------------------------------------

    $popovers = $db->getPopover();
    $new_popovers = $popovers;
    $i = 0;
    $clear_btn = true;
    foreach ($popovers['items'] as $item)
    {
        if ($item['type'] == 'clear-storage')
        {
            $clear_btn = false;
        }
        $new_popovers['items'][$i] = $item;
        $i++;
    }
    if ($clear_btn == true)
    {
        $new_popovers['items'][$i]['type'] = 'clear-storage';
        $new_popovers['items'][$i]['label'] = 'Clear Storage';
        $new_popovers['items'][$i]['value'] = '';
        $new_popovers['items'][$i]['page'] = '';
    }
    $db->savePopover($new_popovers);


    // TODO: ---------------------------------------------------------------------------------------------------------------------
    // TODO: SAVE GLOBAL
    $page_required_auth = array();
    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        if (isset($addons['page-rules'][$page_name]))
        {
            if ($addons['page-rules'][$page_name] == 'user')
            {
                $page_required_auth[] = '(pageName == "' . $page_name . '")';
            }
        }
    }

    $page_no_auth_goto_denied = array();
    $page_no_auth_goto_login = array();
    foreach ($static_pages as $static_page)
    {
        $page_name = $string->toFilename($static_page['name']);
        if (isset($addons['page-rules'][$page_name]))
        {
            if ($addons['page-rules'][$page_name] == 'user')
            {
                if (isset($addons['no-auth-goto'][$page_name]))
                {
                    if ($addons['no-auth-goto'][$page_name] == 'denied')
                    {
                        $page_no_auth_goto_denied[] = '(pageName == "' . $page_name . '")';
                    }
                    if ($addons['no-auth-goto'][$page_name] == 'login')
                    {
                        $page_no_auth_goto_login[] = '(pageName == "' . $page_name . '")';
                    }
                }
            }
        }
    }


    $global['name'] = 'core';
    $global['note'] = 'Authentication';
    // TODO: GLOBAL --+-- MODULES
    $z = 0;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'Observable';
    $global['modules'][$z]['path'] = 'rxjs';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'JwtAuthService';
    $global['modules'][$z]['var'] = 'jwtAuthService';
    $global['modules'][$z]['path'] = './services/jwt-auth/jwt-auth.service';

    // TODO: GLOBAL --+-- CODE --+-- EXPORT
    $global['component'][0]['code']['export'] = null;
    // TODO: GLOBAL --+-- CODE --+-- INIT
    $global['component'][0]['code']['init'] = null;
    $global['component'][0]['code']['init'] .= "\t\t" . 'this.handlerJWT();';
    // TODO: GLOBAL --+-- CODE --+-- OTHER
    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'validToken: Observable<any>;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'validDataToken: any = [];' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '* ' . $string->toClassName($current_app['apps']['app-name']) . ':handlerJWT()' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'private handlerJWT(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.platform.ready().then(() =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '' . "\r\n";
    //$global['component'][0]['code']['other'] .= "\t\t\t" . 'let is_user:boolean = false;' . "\r\n";

    if (count($page_required_auth) != 0)
    {
        $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'let pageName = getPage[1];' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(pageName ==""){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'pageName = `' . $current_app['apps']['rootPage'] . '`;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'console.log("pageName",pageName);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '// required auth' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t", $page_required_auth) . '){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'this.storage.get("current_user").then((current_user) => {' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'console.log(`storage`,`current_user`, current_user);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . 'if(current_user && current_user.token){' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'this.validToken = this.jwtAuthService.checkToken(current_user.token);' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'this.validToken.subscribe(dataToken =>{' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . 'this.validDataToken = dataToken ;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . 'console.log("online","validate", dataToken.data);' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . 'if(typeof(dataToken.data) == "undefined"){' . "\r\n";
        if (count($page_no_auth_goto_login) != 0)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '// goto login page' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t\t\t\t", $page_no_auth_goto_login) . '){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t\t" . 'this.router.navigate(["/login"]);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        }
        if (count($page_no_auth_goto_denied) != 0)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '// goto denied page' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t\t\t\t", $page_no_auth_goto_denied) . '){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t\t" . 'this.router.navigate(["/denied"]);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        }
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'return false;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";

        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . 'if(dataToken.data.status == 200){' . "\r\n";
        //$global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'is_user = true;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '// current user info' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'this.appSubTitle = current_user.user_email;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";

        if (count($page_no_auth_goto_login) != 0)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '// goto login page' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t\t\t\t", $page_no_auth_goto_login) . '){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t\t" . 'this.router.navigate(["/login"]);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        }
        if (count($page_no_auth_goto_denied) != 0)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '// goto denied page' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t\t\t\t", $page_no_auth_goto_denied) . '){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t\t" . 'this.router.navigate(["/denied"]);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        }
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t\t" . 'return false;' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . '}else{' . "\r\n";

        if (count($page_no_auth_goto_login) != 0)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '// goto login page' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $page_no_auth_goto_login) . '){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . 'this.router.navigate(["/login"]);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        }
        if (count($page_no_auth_goto_denied) != 0)
        {
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '// goto denied page' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . 'if(' . implode(' || ' . "\r\n\t\t\t\t\t\t\t\t", $page_no_auth_goto_denied) . '){' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t\t" . 'this.router.navigate(["/denied"]);' . "\r\n";
            $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        }
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t\t" . '}' . "\r\n";


        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '});' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";

        //$global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'if(is_user == false){' . "\r\n";


        //$global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . '' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
        $global['component'][0]['code']['other'] .= "\t\t\t" . '});' . "\r\n";
    }
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $db->saveGlobal('jwt-auth', $global);


    // TODO: ---------------------------------------------------------------------------------------------------------------------
    // TODO: SERVICES
    $service['name'] = 'jwt-auth';
    $service['instruction'] = 'Service for login page';
    $service['desc'] = 'This service is to get data';

    // TODO: SERVICES --|-- MODULES


    $z = 0;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpClient';
    $service['modules']['angular'][$z]['var'] = 'httpClient';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';

    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpErrorResponse';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';

    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';

    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'Observable';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'throwError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'of';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'map';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'catchError';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'retry';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = 'rxjs/operators';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'LoadingController';
    $service['modules']['angular'][$z]['var'] = 'loadingController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';
    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'ToastController';
    $service['modules']['angular'][$z]['var'] = 'toastController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $service['modules']['angular'][$z]['enable'] = true;
    $service['modules']['angular'][$z]['class'] = 'AlertController';
    $service['modules']['angular'][$z]['var'] = 'alertController';
    $service['modules']['angular'][$z]['path'] = '@ionic/angular';

    // TODO: SERVICES --|-- CODE - EXPORT
    $service['code']['export'] = null;
    // TODO: SERVICES --|-- CODE - OTHER
    $service['code']['other'] = null;
    $service['code']['other'] .= "\t" . '' . "\r\n";

    $service['code']['other'] .= "\t" . 'urlToken: string = "' . $addons['url-token'] . '"; // This is the entry point for the JWT Authentication' . "\r\n";
    $service['code']['other'] .= "\t" . 'urlValidate: string = "' . $addons['url-validate'] . '"; // This is a simple helper endpoint to validate a token' . "\r\n";
    $service['code']['other'] .= "\t" . 'urlRegister: string = "' . $addons['url-register'] . '"; // This is the entry point for register new user' . "\r\n";

    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . 'loading: any ;' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - inputFields
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '/ JwtAuthService.inputFields($obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param any $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private inputFields(field:any){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let inputs = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '"username": field.username,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '"password": field.password' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpBuildQuery(inputs);' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.httpBuildQuery(obj)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param object $obj' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private httpBuildQuery(obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let k:any;' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'let str:any = [];' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'for (k in obj) {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'str.push(encodeURIComponent(k) + "=" + encodeURIComponent(obj[k]));' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return str.join("&");' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: SERVICES --|-- CODE - OTHER - register
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.register(any)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param any $any' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'register(fields:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . '//console.log(fields);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/json"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.urlRegister,fields, httpOptions)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`register`,results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`Successfully register new user!`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err && err.error && err.error.message){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,null,err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.statusText);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("caught rethrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";


    // TODO: SERVICES --|-- CODE - OTHER - checkToken
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.checkToken(string)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param any $string' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'checkToken(token:string): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . '//console.log(fields);' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded",' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Authorization": "Bearer " + token' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.urlValidate,null,httpOptions)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`checkToken`,results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`Successfully validate the token!`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("Handling error:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(err.statusText);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("caught rethrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - getToken
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.getToken(any)' . "\r\n";
    $service['code']['other'] .= "\t" . '* @param any $any' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'getToken(fields:any): Observable<any>{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const httpOptions = {' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'headers: new HttpHeaders({' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '"Content-Type": "application/x-www-form-urlencoded"' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.presentLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return this.httpClient.post(this.urlToken,this.inputFields(fields), httpOptions)' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . '.pipe(' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'map(results => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log(`services`,`getToken`,results);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.dismissLoading();' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'this.showToast(`Successfully retrieve the token!`);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return results;' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("Handling error:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'if(err && err.error && err.error.code){' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showAlert(err.statusText,null,err.error.message);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t\t" . 'this.showToast(err.statusText);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return throwError(err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '}),' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . 'catchError(err => {' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'console.log("caught rethrown:", err);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t\t" . 'return of([]);' . "\r\n";
    $service['code']['other'] .= "\t\t\t\t" . '})' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . ');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - presentLoading
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.presentLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async presentLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'this.loading = await this.loadingController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: `' . $addons['label-for-please-wait'] . '`,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'spinner: "crescent",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await this.loading.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - dismissLoading
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.dismissLoading()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async dismissLoading() {' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'if(this.loading){' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'await this.loading.dismiss();' . "\r\n";
    $service['code']['other'] .= "\t\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - showToast
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.showToast()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showToast(message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const toast = await this.toastController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'position: "bottom",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'color: "dark",' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'duration: 500' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await toast.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - showAlert
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.showAlert()' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'message: this.stripTags(message),' . "\r\n";
    $service['code']['other'] .= "\t\t\t" . 'buttons: [`' . $addons['label-for-ok'] . '`]' . "\r\n";
    $service['code']['other'] .= "\t\t" . '});' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: SERVICES --|-- CODE - OTHER - stripTags
    $service['code']['other'] .= "\t" . '/**' . "\r\n";
    $service['code']['other'] .= "\t" . '* JwtAuthService.stripTags(text,any[])' . "\r\n";
    $service['code']['other'] .= "\t" . '**/' . "\r\n";
    $service['code']['other'] .= "\t" . 'private stripTags(text:string, ...allowedTags:any[]): string{' . "\r\n";
    $service['code']['other'] .= "\t\t" . 'return allowedTags.length > 0' . "\r\n";
    $service['code']['other'] .= "\t\t" . '? text.replace(new RegExp(`<(?!\/?(${allowedTags.join(\'|\')})\s*\/?)[^>]+>`, \'g\'), \'\')' . "\r\n";
    $service['code']['other'] .= "\t\t" . ': text.replace(/<(?:.|\s)*?>/g, \'\');' . "\r\n";
    $service['code']['other'] .= "\t" . '}' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";
    $service['code']['other'] .= "\t" . '' . "\r\n";

    $db->saveService($service, 'login');

    // TODO: ---------------------------------------------------------------------------------------------------------------------
    // create properties for page
    // TODO: POST --|-- PAGE LOGIN --|--

    if ($addons['title-for-page-login'] == '')
    {
        $addons['title-for-page-login'] = 'Login';
    }

    $newPage = null;
    $newPage['title'] = $addons['title-for-page-login'];
    $newPage['name'] = 'login';
    $newPage['code-by'] = 'JWT Auth';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['header-color-for-page-login'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColor($addons['header-color-for-page-login']);

    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';

    $newPage['content']['background'] = $addons['content-background-for-page-login'];

    $newPage['content']['enable-fullscreen'] = true;
    $newPage['content']['enable-padding'] = true;

    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: POST --|-- PAGE LOGIN --|-- MODULES
    $z = 0;

    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'JwtAuthService';
    $newPage['modules']['angular'][$z]['var'] = 'jwtAuthService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/jwt-auth/jwt-auth.service';


    // TODO: POST --|-- PAGE LOGIN --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "" . '<form [formGroup]="formLogin">' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<div content-logo>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<img [src]="\'' . $addons['app-logo-for-page-login'] . '\'" />' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<h1>' . $current_app['apps']['app-name'] . '</h1>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</div>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '<ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $addons['label-for-email'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-input placeholder="your@domain.com" formControlName="username" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-label position="floating">' . $addons['label-for-password'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-input placeholder="*******" formControlName="password" type="password" minlength="6" autocomplete="off" autocorrect="off" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-item class="no-padding no-margin" color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button fill="clear" expand="block" [routerDirection]="\'forward\'" [routerLink]="[\'/\',\'register\']">' . $addons['label-for-register'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-col size="8">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t\t" . '<ion-button color="danger" expand="block" fill="outline" (click)="onSubmit()">' . $addons['label-for-login'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-grid>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "" . '</form>' . "\r\n";

    // TODO: POST --|-- PAGE LOGIN --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "" . '[page-login-content]{' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '[content-logo]{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'text-align: center;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'img{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'width: 80px;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'height: 80px;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'margin-top: 12px;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '}' . "\r\n";

    $newPage['content']['scss'] .= "\t\t" . 'h1{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'color: #fff;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'opacity: 0.9;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'font-weight: 600;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'font-variant: petite-caps;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t\t" . 'text-shadow: 2px 2px 2px #333333;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "\t" . 'ion-card{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'opacity: 0.7;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    $newPage['content']['scss'] .= "" . '}' . "\r\n";


    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    // TODO: POST --|-- PAGE LOGIN --|-- CODE --|-- OTHER --|--
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'responseToken: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formLogin: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE LOGIN --|-- CODE --|-- OTHER --|-- onSubmit
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* loginPage.onSubmit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public onSubmit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.responseToken = this.jwtAuthService.getToken(this.formLogin.value);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.responseToken.subscribe(data =>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'console.log("online","current_user",data);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '// validate by token' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data && data.token){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.storage.set("current_user", data).then((val) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.router.navigate(["/' . $addons['after-login-goto-page'] . '"]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.resetFieldValues();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '// validate by data status' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data && data.data && data.data.status){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'if(data.data.status == `200`){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.storage.set("current_user", data).then((val) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.router.navigate(["/' . $addons['after-login-goto-page'] . '"]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.resetFieldValues();' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}else{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'this.showAlert(data.statusText,null,data.message);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    // TODO: POST --|-- PAGE LOGIN --|-- CODE --|-- OTHER --|-- resetFieldValues
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* loginPage.resetFieldValues()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public resetFieldValues(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formLogin = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'username : ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'password: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE LOGIN --|-- CODE --|-- OTHER --|-- ngOnInit
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* loginPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.resetFieldValues();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE LOGIN --|-- CODE --|-- OTHER --|-- showAlert
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* loginPage.showAlert()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons: [`' . $addons['label-for-ok'] . '`]' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['init'] = null;

    //generate page code
    $db->savePage($newPage);

    // TODO: ---------------------------------------------------------------------------------------------------------------------
    // TODO: POST --|-- PAGE DENIED --|--
    if ($addons['title-for-page-denied'] == '')
    {
        $addons['title-for-page-denied'] = 'denied';
    }
    $newPage = null;
    $newPage['title'] = $addons['title-for-page-denied'];
    $newPage['name'] = 'denied';
    $newPage['code-by'] = 'JWT Auth';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    $newPage['header']['color'] = $addons['header-color-for-page-denied'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColor($addons['header-color-for-page-denied']);
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = $themes['color']['dark'];
    $newPage['content']['background'] = $addons['content-background-for-page-denied'];
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: POST --|-- PAGE DENIED --|-- HTML
    $newPage['content']['html'] = null;

    $newPage['content']['html'] .= "\t" . '<ion-card color="dark">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-icon color="danger" class="align-center" [ngStyle]="{\'font-size\':\'72px\'}" name="alert-circle-outline"></ion-icon>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<p class="text-center" [ngStyle]="{\'font-size\':\'24px\'}">' . strip_tags( $addons['content-for-page-denied']) . '</p>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-button class="align-center" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'login\']" fill="outline">' . $addons['label-for-login'] . '</ion-button>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    // TODO: POST --|-- PAGE DENIED --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {opacity:0.7;}' . "\r\n";

    // TODO: POST --|-- PAGE DENIED --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;

    $newPage['code']['init'] = null;

    //generate page code
    $db->savePage($newPage);

    // TODO: ---------------------------------------------------------------------------------------------------------------------
    // TODO: POST --|-- PAGE REGISTER --|--

    $newPage = null;
    $newPage['title'] = $addons['title-for-page-register'];
    $newPage['name'] = 'register';
    $newPage['code-by'] = 'JWT Auth';
    $newPage['icon-left'] = 'at';
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    $newPage['content']['background'] = $addons['content-background-for-page-register'];
    $newPage['header']['color'] = $addons['header-color-for-page-register'];
    $newPage['statusbar']['style'] = 'lightcontent';
    $newPage['statusbar']['backgroundcolor'] = $db->getRawColor($addons['header-color-for-page-register']);

    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: POST --|-- PAGE REGISTER --|-- MODULES

    $z = 0;

    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Observable';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'rxjs';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AlertController';
    $newPage['modules']['angular'][$z]['var'] = 'alertController';
    $newPage['modules']['angular'][$z]['path'] = '@ionic/angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'Validators';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    $newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FormControl';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'JwtAuthService';
    $newPage['modules']['angular'][$z]['var'] = 'jwtAuthService';
    $newPage['modules']['angular'][$z]['path'] = './../../services/jwt-auth/jwt-auth.service';


    // TODO: POST --|-- PAGE REGISTER --|-- HTML
    $newPage['content']['html'] = null;
    $newPage['content']['html'] .= "\t" . "\r\n";
    $newPage['content']['html'] .= "\t" . '<form [formGroup]="formRegister">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-divider color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $addons['label-for-login-data'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-divider>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-username'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="regel123" formControlName="username" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-email'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="regel@ihsana.net" formControlName="email" type="email" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-password'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="******" formControlName="password" type="password" minlength="6" autocomplete="off" autocorrect="off" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item-divider color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label>' . $addons['label-for-personal-data'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item-divider>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-first-name'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Regel" formControlName="first_name" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-last-name'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Jambak" formControlName="last_name" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-birthday'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-datetime placeholder="31-12-1900" displayFormat="MM/DD/YYYY" formControlName="birthday" ></ion-datetime>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";


    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-company'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Ihsana IT Solution" formControlName="company" type="text" autocomplete="off" autocorrect="off" clear-input="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-website'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="http://ihsana.com/" formControlName="url" type="url" autocomplete="off" autocorrect="off" clear-input="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-address-1'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Silambau, Jor. Langgam" formControlName="address_1" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-address-2'] . '</ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Kinali" formControlName="address_2" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-city'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Pasaman Barat" formControlName="city" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-state'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Sumatera Barat" formControlName="state" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-postcode'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="26567" formControlName="postcode" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-country'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="Indonesia" formControlName="country" type="text" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<ion-item color="' . $color . '">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="floating">' . $addons['label-for-phone'] . ' <ion-text color="danger">*</ion-text></ion-label>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '<ion-input placeholder="6281234567890" formControlName="phone" type="tel" minlength="6" autocomplete="off" autocorrect="off" clear-input="true" required="true"></ion-input>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</form>' . "\r\n";
    $newPage['content']['html'] .= '' . "\r\n";

    // TODO: POST --|-- PAGE REGISTER --|-- FOOTER
    $newPage['footer']['color'] = 'none';
    $newPage['footer']['type'] = 'code';
    $newPage['footer']['title'] = '';
    $newPage['footer']['code'] = null;
    $newPage['footer']['code'] .= "\t\t" . '<ion-grid>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '<ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="2">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button color="medium" size="small" fill="outline" expand="block" [routerDirection]="\'root\'" [routerLink]="[\'/\',\'login\']"><ion-icon slot="icon-only" name="arrow-back-outline"></ion-icon></ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="4">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t\t" . '<ion-button fill="solid" expand="block" (click)="onSubmit()">' . $addons['label-for-submit'] . '</ion-button>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    $newPage['footer']['code'] .= "\t\t" . '</ion-grid>' . "\r\n";


    // TODO: POST --|-- PAGE REGISTER --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'ion-card {opacity:0.7;}' . "\r\n";

    // TODO: POST --|-- PAGE REGISTER --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'formRegister: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'responseToken: Observable<any>;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'responseDataToken: any = [];' . "\r\n";

    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE REGISTER --|-- OTHER --|-- initFields
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* RegisterPage.initFields()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public initFields(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.formRegister = this.formBuilder.group({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'username: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'email: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'password: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'birthday: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'url: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'first_name: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'last_name: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'company: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_1: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'address_2: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'city: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'state: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'postcode: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'country: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'phone: ["", Validators.required],' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE REGISTER --|-- OTHER --|-- onSubmit
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* RegisterPage.onSubmit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public onSubmit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.responseToken = this.jwtAuthService.register(this.formRegister.value);' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.responseToken.subscribe(data =>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(data && data.message && data.title ){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.showAlert(data.title,null,data.message);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE REGISTER --|-- OTHER --|-- ngOnInit
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* RegisterPage.ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'public ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.initFields();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    // TODO: POST --|-- PAGE REGISTER --|-- OTHER --|-- showAlert
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* RegisterPage.showAlert()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'async showAlert(header:string, subheader: string, message: string){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'const alert = await this.alertController.create({' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'header: header,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'subHeader: subheader,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'message: message,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'buttons: [' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'text: `' . $addons['label-for-ok'] . '`,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'handler: (data) => {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t\t" . 'this.router.navigate(["/login"]);' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . ']' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'await alert.present();' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['init'] = null;

    //generate page code
    $db->savePage($newPage);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=jwt-auth&' . time());

}
// TODO: ---------------------------------------------------------------------------------------------------------------------
// TODO: INIT
$disabled = null;
if ($current_page_target == '')
{
    $disabled = 'disabled';
    $current_setting = array();
} else
{
    $current_setting = $db->getAddOns('jwt-auth', $current_page_target);
}

if (!isset($current_setting['url-token']))
{
    $current_setting['url-token'] = '';
}

if (!isset($current_setting['url-validate']))
{
    $current_setting['url-validate'] = '';
}
if (!isset($current_setting['url-register']))
{
    $current_setting['url-register'] = '';
}

if (!isset($current_setting['app-logo-for-page-login']))
{
    $current_setting['app-logo-for-page-login'] = 'assets/icon/logo.png';
}

if (!isset($current_setting['title-for-page-login']))
{
    $current_setting['title-for-page-login'] = 'Login';
}

if (!isset($current_setting['content-background-for-page-login']))
{
    $current_setting['content-background-for-page-login'] = 'assets/images/landscape/image-1.jpg';
}

if (!isset($current_setting['content-background-for-page-register']))
{
    $current_setting['content-background-for-page-register'] = 'assets/images/landscape/image-1.jpg';
}

if (!isset($current_setting['header-color-for-page-login']))
{
    $current_setting['header-color-for-page-login'] = 'primary';
}

if (!isset($current_setting['header-color-for-page-register']))
{
    $current_setting['header-color-for-page-register'] = 'primary';
}

if (!isset($current_setting['after-login-goto-page']))
{
    $current_setting['after-login-goto-page'] = 'about-us';
}
if (!isset($current_setting['title-for-page-register']))
{
    $current_setting['title-for-page-register'] = 'Register';
}

if (!isset($current_setting['title-for-page-denied']))
{
    $current_setting['title-for-page-denied'] = 'Denied';
}

if (!isset($current_setting['content-for-page-denied']))
{
    $current_setting['content-for-page-denied'] = '<p>You do not have permission to access this page</p>';
}


if (!isset($current_setting['content-background-for-page-denied']))
{
    $current_setting['content-background-for-page-denied'] = 'assets/images/landscape/image-1.jpg';
}

if (!isset($current_setting['header-color-for-page-denied']))
{
    $current_setting['header-color-for-page-denied'] = 'danger';
}

if (!isset($current_setting['jwt-auth-type']))
{
    $current_setting['jwt-auth-type'] = 'other';
}

if (!isset($current_setting['main-url']))
{
    $current_setting['main-url'] = '';
}


if (!isset($current_setting['label-for-login']))
{
    $current_setting['label-for-login'] = 'Login';
}

if (!isset($current_setting['label-for-register']))
{
    $current_setting['label-for-register'] = 'Register';
}

if (!isset($current_setting['label-for-username']))
{
    $current_setting['label-for-username'] = 'Username';
}

if (!isset($current_setting['label-for-password']))
{
    $current_setting['label-for-password'] = 'Password';
}

if (!isset($current_setting['label-for-please-wait']))
{
    $current_setting['label-for-please-wait'] = 'Please wait...!';
}

if (!isset($current_setting['label-for-email']))
{
    $current_setting['label-for-email'] = 'Email';
}

if (!isset($current_setting['label-for-first-name']))
{
    $current_setting['label-for-first-name'] = 'First Name';
}

if (!isset($current_setting['label-for-last-name']))
{
    $current_setting['label-for-last-name'] = 'Last Name';
}

if (!isset($current_setting['label-for-company']))
{
    $current_setting['label-for-company'] = 'Company';
}

if (!isset($current_setting['label-for-address-1']))
{
    $current_setting['label-for-address-1'] = 'Address 1';
}

if (!isset($current_setting['label-for-address-2']))
{
    $current_setting['label-for-address-2'] = 'Address 2';
}

if (!isset($current_setting['label-for-city']))
{
    $current_setting['label-for-city'] = 'City';
}

if (!isset($current_setting['label-for-state']))
{
    $current_setting['label-for-state'] = 'State';
}

if (!isset($current_setting['label-for-postcode']))
{
    $current_setting['label-for-postcode'] = 'Postcode';
}

if (!isset($current_setting['label-for-country']))
{
    $current_setting['label-for-country'] = 'Country';
}

if (!isset($current_setting['label-for-phone']))
{
    $current_setting['label-for-phone'] = 'Phone';
}

if (!isset($current_setting['content-background-for-page-register']))
{
    $current_setting['content-background-for-page-register'] = 'assets/images/landscape/image-1.jpg';
}
if (!isset($current_setting['label-for-successfully']))
{
    $current_setting['label-for-successfully'] = 'Successfully';
}


if (!isset($current_setting['label-for-personal-data']))
{
    $current_setting['label-for-personal-data'] = 'Personal Data';
}

if (!isset($current_setting['label-for-login-data']))
{
    $current_setting['label-for-login-data'] = 'Login Data';
}

if (!isset($current_setting['label-for-website']))
{
    $current_setting['label-for-website'] = 'Website';
}

if (!isset($current_setting['page-content-background']))
{
    $current_setting['page-content-background'] = 'assets/images/background/bg-01.png';
}

if (!isset($current_setting['label-for-registration-form']))
{
    $current_setting['label-for-registration-form'] = 'Registration Form';
}

if (!isset($current_setting['label-for-successfully-validate-the-token']))
{
    $current_setting['label-for-successfully-validate-the-token'] = 'Successfully validate the token!';
}

if (!isset($current_setting['label-for-birthday']))
{
    $current_setting['label-for-birthday'] = 'Birthday';
}

if (!isset($current_setting['label-for-submit']))
{
    $current_setting['label-for-submit'] = 'Submit';
}

if (!isset($current_setting['label-for-ok']))
{
    $current_setting['label-for-ok'] = 'Okey!';
}

// TODO: ---------------------------------------------------------------------------------------------------------------------
// TODO: LAYOUT
$content .= '<form action="" method="post"><!-- ./form -->';


$content .= '<div class="row"><!-- row -->';
$content .= '<div class="col-md-7"><!-- col-md-7 -->';

$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="callout callout-danger">' . __e('These addons require the <strong>Cordova Plugin</strong> and <strong>Ionic Native</strong>, to be able to run the emulator you have to <a href="./?p=2.update-plugin">update it</a>') . '</div>';

if (parse_url($current_setting['url-token'], PHP_URL_SCHEME) == 'http')
{
    $content .= '<div class="callout callout-danger"><h4>Warning!</h4><p>' . __e('URL Token do not use ssl, This might not work normally in APK/IPA (Android/IOS Devices)') . '</p></div>' . "\r\n";
}
$content .= '<div class="callout callout-default">' . __e('These addons will make several pages as follows: <a href="./?p=pages&a=edit&page-name=login" target="_blank">login</a>, <a href="./?p=pages&a=edit&page-name=profile" target="_blank">profile</a> and <a href="./?p=pages&a=edit&page-name=denied" target="_blank">denied</a>') . '</div>';


// TODO: LAYOUT --|-- FORM --|-- JWT-AUTH-TYPE --|-- SELECT
$content .= '<div class="row"><!-- row -->';

$options = array();
$options[] = array('value' => 'jwt-auth-wp', 'label' => 'JWT-Auth - WordPress (JWT Authentication for WP REST API)');
$options[] = array('value' => 'php-native', 'label' => 'PHP Native Ganerator');
$options[] = array('value' => 'other', 'label' => 'Other');

$content .= '<div id="field-jwt-auth-type" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-jwt-auth-type">' . __e('JWT Auth Type') . '</label>';
$content .= '<select id="page-jwt-auth-type" name="jwt-auth[jwt-auth-type]" class="form-control" >';
foreach ($options as $option)
{
    $selected = '';
    if ($option['value'] == $current_setting['jwt-auth-type'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($option['value']) . '" ' . $selected . '>' . htmlentities($option['label']) . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Please select the type / plugin used for JWT Auth') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- MAIN-URL --|-- TEXT

$content .= '<div id="field-main-url" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-main-url">' . __e('Main URL') . '</label>';
$content .= '<input id="page-main-url" type="text" name="jwt-auth[main-url]" class="form-control" placeholder="Main URL"  value="' . $current_setting['main-url'] . '"  required />';
$content .= '<p class="help-block">' . __e('Root end point address, such as: http: //site/rest-api.php') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- URL-TOKEN
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="url-token">' . __e('URL Token') . '</label>';
$content .= '<input id="url-token" type="url" name="jwt-auth[url-token]" class="form-control" placeholder="http://yourwp/wp-json/jwt-auth/v1/token"  value="' . $current_setting['url-token'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('This is the entry point for the JWT Authentication') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';

// TODO: LAYOUT --|-- FORM --|-- URL-VALIDATE
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="url-validate">' . __e('URL Validation') . '</label>';
$content .= '<input id="url-validate" type="url" name="jwt-auth[url-validate]" class="form-control" placeholder="http://yourwp/wp-json/jwt-auth/v1/token/validate"  value="' . $current_setting['url-validate'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('This is a simple helper endpoint to validate a token') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- URL-TOKEN
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="url-register">' . __e('URL Register') . '</label>';
$content .= '<input id="url-register" type="url" name="jwt-auth[url-register]" class="form-control" placeholder=""  value="' . $current_setting['url-register'] . '"  ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('This is the entry point for new user') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-jwt-auth" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- PAGE LOGIN
$content .= '<div class="row">';

$content .= '<div class="col-md-6"><!-- col-md-6 -->';


$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-fa-file-o"></i> ' . __e('Login Page') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="form-group">';
$content .= '<label for="title-for-page-login">' . __e('Page Title') . '</label>';
$content .= '<input id="title-for-page-login" type="text" name="jwt-auth[title-for-page-login]" class="form-control" placeholder="Login"  value="' . $current_setting['title-for-page-login'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label for="header-color-for-page-login">' . __e('Header Color') . '</label>';
$content .= '<select name="jwt-auth[header-color-for-page-login]" class="form-control select-color" data-color="' . $current_setting['header-color-for-page-login'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['header-color-for-page-login'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';


$content .= '<div class="form-group">';
$content .= '<label for="content-background-for-page-login">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="content-background-for-page-login" type="text" name="jwt-auth[content-background-for-page-login]" class="form-control" placeholder="assets/images/background/bg-01.png"  value="' . $current_setting['content-background-for-page-login'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#content-background-for-page-login" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';

// TODO: LAYOUT --|-- FORM --|-- APP-LOGO
$content .= '<div class="form-group">';
$content .= '<label for="app-logo-for-page-login">' . __e('App Logo') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="app-logo-for-page-login" type="text" name="jwt-auth[app-logo-for-page-login]" class="form-control" placeholder="assets/images/icon/logo.png"  value="' . $current_setting['app-logo-for-page-login'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#app-logo-for-page-login" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';


// TODO: LAYOUT --|-- FORM --|-- AFTER-LOGIN-GOTO-PAGE
$content .= '<div class="form-group">';
$content .= '<label for="after-login-goto-page">' . __e('After Login Goto Page') . '</label>';
$content .= '<select id="after-login-goto-page" name="jwt-auth[after-login-goto-page]" class="form-control" >';
foreach ($static_pages as $item_page)
{
    $selected = '';
    if ($current_setting['after-login-goto-page'] == $item_page["name"])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . htmlentities($item_page["name"]) . ' " ' . $selected . '>- ' . htmlentities($item_page["title"]) . ' (' . htmlentities($item_page["name"]) . ')</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('After successful login will redirect to the page?') . '</p>';
$content .= '</div>';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-jwt-auth" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-fa-file-o"></i> ' . __e('Register Page') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="form-group">';
$content .= '<label for="title-for-page-register">' . __e('Page Title') . '</label>';
$content .= '<input id="title-for-page-register" type="text" name="jwt-auth[title-for-page-register]" class="form-control" placeholder="Register"  value="' . $current_setting['title-for-page-register'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label for="header-color-for-page-register">' . __e('Header Color') . '</label>';
$content .= '<select name="jwt-auth[header-color-for-page-register]" class="form-control select-color" data-color="' . $current_setting['header-color-for-page-register'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['header-color-for-page-register'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';


$content .= '<div class="form-group">';
$content .= '<label for="content-background-for-page-register">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="content-background-for-page-register" type="text" name="jwt-auth[content-background-for-page-register]" class="form-control" placeholder="assets/images/background/bg-01.png"  value="' . $current_setting['content-background-for-page-register'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#content-background-for-page-register" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-jwt-auth" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';


$content .= '</div><!-- ./col-md-6 -->';
// TODO: ---------------------------------------------------------------------------------------------------------------------
// TODO: LAYOUT --|-- FORM --|-- PAGE DENIED
$content .= '<div class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-fa-file-o"></i> ' . __e('Denied Page') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="form-group">';
$content .= '<label for="title-for-page-denied">' . __e('Page Title') . '</label>';
$content .= '<input id="title-for-page-denied" type="text" name="jwt-auth[title-for-page-denied]" class="form-control" placeholder="denied"  value="' . $current_setting['title-for-page-denied'] . '" required ' . $disabled . ' />';
$content .= '<p class="help-block">' . __e('The page title will be displayed') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label for="header-color-for-page-denied">' . __e('Header Color') . '</label>';
$content .= '<select name="jwt-auth[header-color-for-page-denied]" class="form-control select-color" data-color="' . $current_setting['header-color-for-page-denied'] . '">';
foreach ($color_names as $color_name)
{
    $selected = '';
    if ($color_name['value'] == $current_setting['header-color-for-page-denied'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $color_name['value'] . '" ' . $selected . '>' . $color_name['label'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Color variation from the header') . '</p>';
$content .= '</div>';


$content .= '<div class="form-group">';
$content .= '<label for="content-background-for-page-denied">' . __e('Background Image') . '</label>';
$content .= '<div class="input-group">';
$content .= '<input id="content-background-for-page-denied" type="text" name="jwt-auth[content-background-for-page-denied]" class="form-control" placeholder="assets/images/background/bg-01.png"  value="' . $current_setting['content-background-for-page-denied'] . '"  ' . $disabled . ' required />';
$content .= '<span class="input-group-btn"><button type="button" data-type="file-picker" data-target="#content-background-for-page-denied" class="btn btn-info btn-flat"><i class="fa fa-folder-open"></i></button></span>';
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The background image of content ') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label for="content-for-page-denied">' . __e('Content') . '</label>';
$content .= '<input id="content-for-page-denied" type="text" name="jwt-auth[content-for-page-denied]" class="form-control" class="form-control" placeholder="First Name"  value="' . htmlentities($current_setting['content-for-page-denied']) . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('The page content will be displayed') . '</p>';
$content .= '</div>';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-jwt-auth" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

// TODO: ---------------------------------------------------------------------------------------------------------------------
$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-fa-file-o"></i> ' . __e('Labels') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" >';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-EMAIL --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-email" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-email">' . __e('Label for `Email`') . '</label>';
$content .= '<input id="page-label-for-email" type="text" name="jwt-auth[label-for-email]" class="form-control" placeholder="Email"  value="' . $current_setting['label-for-email'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Email`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-FIRST-NAME --|-- TEXT

$content .= '<div id="field-label-for-first-name" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-first-name">' . __e('Label for `First Name`') . '</label>';
$content .= '<input id="page-label-for-first-name" type="text" name="jwt-auth[label-for-first-name]" class="form-control" placeholder="First Name"  value="' . $current_setting['label-for-first-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `First Name`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LAST-NAME --|-- TEXT

$content .= '<div id="field-label-for-last-name" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-last-name">' . __e('Label for `Last Name`') . '</label>';
$content .= '<input id="page-label-for-last-name" type="text" name="jwt-auth[label-for-last-name]" class="form-control" placeholder="Last Name"  value="' . $current_setting['label-for-last-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Last Name`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COMPANY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-company" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-company">' . __e('Label for `Company`') . '</label>';
$content .= '<input id="page-label-for-company" type="text" name="jwt-auth[label-for-company]" class="form-control" placeholder="Company"  value="' . $current_setting['label-for-company'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Company`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDRESS-1 --|-- TEXT

$content .= '<div id="field-label-for-address-1" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-address-1">' . __e('Label for `Address 1`') . '</label>';
$content .= '<input id="page-label-for-address-1" type="text" name="jwt-auth[label-for-address-1]" class="form-control" placeholder="Address 1"  value="' . $current_setting['label-for-address-1'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Address 1`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-ADDRESS-2 --|-- TEXT

$content .= '<div id="field-label-for-address-2" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-address-2">' . __e('Label for `Address 2`') . '</label>';
$content .= '<input id="page-label-for-address-2" type="text" name="jwt-auth[label-for-address-2]" class="form-control" placeholder="Address 2"  value="' . $current_setting['label-for-address-2'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Address 2`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-CITY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-city" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-city">' . __e('Label for `City`') . '</label>';
$content .= '<input id="page-label-for-city" type="text" name="jwt-auth[label-for-city]" class="form-control" placeholder="City"  value="' . $current_setting['label-for-city'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `City`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-STATE --|-- TEXT

$content .= '<div id="field-label-for-state" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-state">' . __e('Label for `State`') . '</label>';
$content .= '<input id="page-label-for-state" type="text" name="jwt-auth[label-for-state]" class="form-control" placeholder="State"  value="' . $current_setting['label-for-state'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `State`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-POSTCODE --|-- TEXT

$content .= '<div id="field-label-for-postcode" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-postcode">' . __e('Label for `Postcode`') . '</label>';
$content .= '<input id="page-label-for-postcode" type="text" name="jwt-auth[label-for-postcode]" class="form-control" placeholder="Postcode"  value="' . $current_setting['label-for-postcode'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Postcode`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-COUNTRY --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-country" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-country">' . __e('Label for `Country`') . '</label>';
$content .= '<input id="page-label-for-country" type="text" name="jwt-auth[label-for-country]" class="form-control" placeholder="Country"  value="' . $current_setting['label-for-country'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Country`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PHONE --|-- TEXT

$content .= '<div id="field-label-for-phone" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-phone">' . __e('Label for `Phone`') . '</label>';
$content .= '<input id="page-label-for-phone" type="text" name="jwt-auth[label-for-phone]" class="form-control" placeholder="Phone"  value="' . $current_setting['label-for-phone'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Phone`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LOGIN --|-- TEXT
$content .= '<div id="field-label-for-login" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-login">' . __e('Label for `Login`') . '</label>';
$content .= '<input id="page-label-for-login" type="text" name="jwt-auth[label-for-login]" class="form-control" placeholder="Login"  value="' . $current_setting['label-for-login'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Login`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

$content .= '</div><!-- ./row -->';

$content .= '<div class="row"><!-- row -->';
// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-REGISTER --|-- TEXT

$content .= '<div id="field-label-for-register" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-register">' . __e('Label for `Register`') . '</label>';
$content .= '<input id="page-label-for-register" type="text" name="jwt-auth[label-for-register]" class="form-control" placeholder="Register"  value="' . $current_setting['label-for-register'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Register`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-USERNAME --|-- TEXT

$content .= '<div id="field-label-for-username" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-username">' . __e('Label for `Username`') . '</label>';
$content .= '<input id="page-label-for-username" type="text" name="jwt-auth[label-for-username]" class="form-control" placeholder="Username"  value="' . $current_setting['label-for-username'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Username`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PASSWORD --|-- TEXT
$content .= '<div id="field-label-for-password" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-password">' . __e('Label for `Password`') . '</label>';
$content .= '<input id="page-label-for-password" type="text" name="jwt-auth[label-for-password]" class="form-control" placeholder="Password"  value="' . $current_setting['label-for-password'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Password`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PLEASE-WAIT --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-please-wait" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-please-wait">' . __e('Label for `Please wait...!`') . '</label>';
$content .= '<input id="page-label-for-please-wait" type="text" name="jwt-auth[label-for-please-wait]" class="form-control" placeholder="Please wait...!"  value="' . $current_setting['label-for-please-wait'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Please wait...!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY --|-- TEXT

$content .= '<div id="field-label-for-successfully" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully">' . __e('Label for `Successfully`') . '</label>';
$content .= '<input id="page-label-for-successfully" type="text" name="jwt-auth[label-for-successfully]" class="form-control" placeholder="Successfully"  value="' . $current_setting['label-for-successfully'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Successfully`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PERSONAL-DATA --|-- TEXT

$content .= '<div id="field-label-for-personal-data" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-personal-data">' . __e('Label for `Personal Data`') . '</label>';
$content .= '<input id="page-label-for-personal-data" type="text" name="jwt-auth[label-for-personal-data]" class="form-control" placeholder="Personal Data"  value="' . $current_setting['label-for-personal-data'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Personal Data`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-LOGIN-DATA --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-login-data" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-login-data">' . __e('Label for `Login Data`') . '</label>';
$content .= '<input id="page-label-for-login-data" type="text" name="jwt-auth[label-for-login-data]" class="form-control" placeholder="Login Data"  value="' . $current_setting['label-for-login-data'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Login Data`') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-WEBSITE --|-- TEXT

$content .= '<div id="field-label-for-website" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-website">' . __e('Label for `Website`') . '</label>';
$content .= '<input id="page-label-for-website" type="text" name="jwt-auth[label-for-website]" class="form-control" placeholder="Website"  value="' . $current_setting['label-for-website'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Website`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-REGISTRATION-FORM --|-- TEXT

$content .= '<div id="field-label-for-registration-form" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-registration-form">' . __e('Label for `Registration Form`') . '</label>';
$content .= '<input id="page-label-for-registration-form" type="text" name="jwt-auth[label-for-registration-form]" class="form-control" placeholder="Registration Form"  value="' . $current_setting['label-for-registration-form'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Registration Form`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUCCESSFULLY-VALIDATE-THE-TOKEN --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-successfully-validate-the-token" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-successfully-validate-the-token">' . __e('Label for `Successfully validate the token!`') . '</label>';
$content .= '<input id="page-label-for-successfully-validate-the-token" type="text" name="jwt-auth[label-for-successfully-validate-the-token]" class="form-control" placeholder="Successfully validate the token!"  value="' . $current_setting['label-for-successfully-validate-the-token'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Successfully validate the token!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-BIRTHDAY --|-- TEXT

$content .= '<div id="field-label-for-birthday" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-birthday">' . __e('Label for `Birthday`') . '</label>';
$content .= '<input id="page-label-for-birthday" type="text" name="jwt-auth[label-for-birthday]" class="form-control" placeholder="Birthday"  value="' . $current_setting['label-for-birthday'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Birthday`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SUBMIT --|-- TEXT

$content .= '<div id="field-label-for-submit" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-submit">' . __e('Label for `Submit`') . '</label>';
$content .= '<input id="page-label-for-submit" type="text" name="jwt-auth[label-for-submit]" class="form-control" placeholder="Submit"  value="' . $current_setting['label-for-submit'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Submit`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-OK --|-- TEXT

$content .= '<div id="field-label-for-ok" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-ok">' . __e('Label for `Okey!`') . '</label>';
$content .= '<input id="page-label-for-ok" type="text" name="jwt-auth[label-for-ok]" class="form-control" placeholder="Okey!"  value="' . $current_setting['label-for-ok'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write text for `Okey!`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-primary btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';
$content .= '</div>';


$content .= '</div><!-- ./col-md-7 -->';


$content .= '<div class="col-md-5"><!-- col-md-5 -->';

$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-cubes"></i> ' . __e('Page Rules') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<p>These rules are only in the app, if you want to be really safe please also activate the rules on the backend</p>';

$content .= '<table class="table table-borderedz table-striped">';

$content .= '<thead>';


$content .= '<tr>';

$content .= '<th rowspan="2" class="v-align text-center">';
$content .= '' . __e('Pages') . '';
$content .= '</th>';


$content .= '<th rowspan="2" class="v-align text-center">';
$content .= '' . __e('Guest') . '';
$content .= '</th>';

$content .= '<th rowspan="2" class="v-align text-center">';
$content .= '' . __e('User') . '';
$content .= '</th>';

$content .= '<th colspan="2" class="v-align text-center">';
$content .= '' . __e('If User Not Auth') . '';
$content .= '</th>';


$content .= '</tr>';


$content .= '<tr>';

$content .= '<th class="text-center">';
$content .= '' . __e('Go to Login Page') . '';
$content .= '</th>';

$content .= '<th class="text-center">';
$content .= '' . __e('Go to denied Page') . '';
$content .= '</th>';

$content .= '</tr>';


$content .= '</thead>';
$content .= '<tbody>';
foreach ($static_pages as $static_page)
{

    $page_name = $string->toFilename($static_page['name']);
    if (($page_name == 'login') || ($page_name == 'profile') || ($page_name == 'denied') || ($page_name == 'register'))
    {
    } else
    {
        $no_auth_rule_checked = $auth_rule_checked = $no_auth_goto_login_checked = $no_auth_goto_denied_checked = null;
        $no_auth_rule_checked = 'checked';
        $no_auth_disabled = 'disabled';

        $auth_rule_checked = '';
        if (isset($current_setting['page-rules'][$page_name]))
        {
            if ($current_setting['page-rules'][$page_name] == 'user')
            {
                $no_auth_rule_checked = '';
                $no_auth_disabled = '';
                $auth_rule_checked = 'checked';
            } else
            {
                $no_auth_rule_checked = 'checked';
                $no_auth_disabled = 'disabled';
                $auth_rule_checked = '';
            }
        }
        $no_auth_goto_login_checked = 'checked';
        $no_auth_goto_denied_checked = '';

        if (isset($current_setting['no-auth-goto'][$page_name]))
        {
            if ($current_setting['no-auth-goto'][$page_name] == 'denied')
            {
                $no_auth_goto_login_checked = '';
                $no_auth_goto_denied_checked = 'checked';
            } else
            {
                $no_auth_goto_login_checked = 'checked';
                $no_auth_goto_denied_checked = '';
            }
        }


        $content .= '<tr>';

        $content .= '<td>';
        $content .= $page_name;
        $content .= '</td>';

        $content .= '<td class="text-center">';
        $content .= '<input name="jwt-auth[page-rules][' . $page_name . ']" type="radio" ' . $no_auth_rule_checked . ' class="flat-blue" value="guest" />';
        $content .= '</td>';

        $content .= '<td class="text-center">';
        $content .= '<input name="jwt-auth[page-rules][' . $page_name . ']" type="radio" ' . $auth_rule_checked . ' class="flat-blue" value="user" />';
        $content .= '</td>';


        $content .= '<td class="text-center">';
        $content .= '<input name="jwt-auth[no-auth-goto][' . $page_name . ']" type="radio" ' . $no_auth_goto_login_checked . ' ' . $no_auth_disabled . ' class="flat-green" value="login" />';
        $content .= '</td>';


        $content .= '<td class="text-center">';
        $content .= '<input name="jwt-auth[no-auth-goto][' . $page_name . ']" type="radio" ' . $no_auth_goto_denied_checked . ' ' . $no_auth_disabled . ' class="flat-green" value="denied"/>';
        $content .= '</td>';

        $content .= '</tr>';
    }
}
$content .= '</tbody>';
$content .= '</table>';


$content .= '</div><!-- ./box-body -->';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-jwt-auth" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div><!-- ./box -->';


$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-help"></i> ' . __e('Technical Guide') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<h4>CORS Issue</h4>';
$content .= '<p>' . __e('Most of the shared hosting has disabled the HTTP Authorization Header by default. To enable this option you\'ll need to edit your <code>.htaccess</code> file adding the follow:');
$content .= '<pre>';
$content .= htmlentities('<IfModule mod_rewrite.c>') . "\r\n";
$content .= htmlentities('# Add this code') . "\r\n";
$content .= htmlentities('RewriteCond %{HTTP:Authorization} ^(.*)') . "\r\n";
$content .= htmlentities('RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]') . "\r\n";
$content .= htmlentities('</IfModule>') . "\r\n";
$content .= htmlentities('') . "\r\n";
$content .= htmlentities('# And this code') . "\r\n";
$content .= htmlentities('SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1') . "\r\n";
$content .= htmlentities('') . "\r\n";
$content .= '</pre>';
$content .= '<p>' . __e('And <code>your web must use SSL (https://)</code>, so it can\'t be tried on localhost.');

$content .= '<hr>';
$content .= '<h4>WordPress</h4>';
$content .= '<p>' . __e('You must install the following plugins:').'</p>';
$content .= '<ul>';
$content .= '<li><a href="https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/" target="_blank">' . __e('JWT Auth').'</a></li>';
$content .= '<li><a href="https://wordpress.org/plugins/rest-api-helper/" target="_blank">' . __e('REST-API Helper').'</a></li>';
$content .= '<li>' . __e('Edit the <strong>wp-config.php</strong> file and add the following code after: <code>&lt;?php</code>').'<br/>';
$content .= '<pre>';
$content .= 'define("IMH_ALLOW_PREFLIGHT_CORS",true);' . "\r\n";
$content .= 'define("IMH_RESTAPI_REGISTER",true);' . "\r\n";
$content .= 'define("JWT_AUTH_CORS_ENABLE", true);' . "\r\n";
$content .= '</pre>';

$content .= '</li>';
$content .= '</ul>';
$content .= '<hr>';
$content .= '<h4>PHP Native Generator</h4>';
$content .= '<ul>';
$content .= '<li>' . __e('Go to: ').' <a href="" target="_blank">' . __e('(IMAB) PHP Native Generator').'</a>, then checked <strong>Enable Users & JWT Auth</strong> on Multi User section</li>';
$content .= '</ul>';
$content .= '<hr>';
$content .= '<h4>Node.JS and Ionic CLI</h4>';
$content .= '<p>' . __e('and in ionic-cli you must run the following command:');
$content .= '<pre class="shell">npm install --save @ionic/storage@latest</pre>' . "\r\n";
$content .= '<pre class="shell">ionic cordova plugin add cordova-sqlite-storage@latest --save</pre>' . "\r\n";

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input name="save-jwt-auth" type="submit" class="btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '&nbsp;&nbsp;or&nbsp;<input name="delete-jwt-auth" type="submit" class="btn btn-link btn-flat" value="' . __e('Delete this Settings') . '"  />';
$content .= '</div>';

$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';

$content .= '</form><!-- ./form -->';

// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=jwt-auth&page-target="+$("#page-target").val(),!1});';
$page_js .= '
$(document).ready(function(){
  $("#page-main-url").keyup(function(){
        setApiUrl();
  });
    $("#page-main-url").click(function(){
        setApiUrl();
  });
  $("#page-jwt-auth-type").click(function(){
        setApiUrl();
  });
});

function setApiUrl(){
    var typeToken = $("#page-jwt-auth-type").val();
    var urlToken = "";
    var urlValidate = "";
    var urlRegister = "";
    console.log(typeToken);
    switch(typeToken) {
      case "jwt-auth-wp":
        urlToken = $("#page-main-url").val() + "/wp-json/jwt-auth/v1/token";
        urlValidate = $("#page-main-url").val() + "/wp-json/jwt-auth/v1/token/validate";
        urlRegister = $("#page-main-url").val() + "/wp-json/wp/v2/users/register";
        break;
      case "php-native":
        urlToken = $("#page-main-url").val() + "?api=jwt-auth&action=token";
        urlValidate = $("#page-main-url").val() + "?api=jwt-auth&action=token-validate";
        urlRegister = $("#page-main-url").val() + "?api=jwt-auth&action=register";
        break;
      default:
        // code block
    } 
   
    $("#url-token").val(urlToken);
    $("#url-validate").val(urlValidate);
     $("#url-register").val(urlRegister);
}

';
