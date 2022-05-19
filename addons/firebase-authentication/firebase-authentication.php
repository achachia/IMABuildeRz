<?php

/**
 * @author Ihsana Team <imabuilder@ihsana.com>
 * @copyright Ihsana IT Solution 2020
 * @license Commercial License
 * 
 * @package `firebase-authentication`
 */


defined('JSM_EXEC') or die('Silence is golden');
$is_debug = false;

// init class
$db = new jsmDatabase();
$current_app = $db->current();
$static_pages = $db->getStaticPages();
$addons_settings = $db->getAddonsUsed("firebase-authentication");
$string = new jsmString();
$all_pages = $db->getPages();

if ($_GET['a'] === 'delete')
{
    $db->deleteAddOns('firebase-authentication', "core");
    header('Location: ./?p=addons&addons=firebase-authentication&' . time());
}

// TODO: POST
if (isset($_POST['save-firebase-authentication']))
{

    // save addons setting
    $addons = array();
    $addons['page-target'] = "core";
    $addons['page-title'] = "core";
    $addons['after-login-goto-page'] = trim($_POST['firebase-authentication']['after-login-goto-page']);

    //api-key
    if (!isset($_POST['firebase-authentication']['api-key']))
    {
        $_POST['firebase-authentication']['api-key'] = '';
    }
    $addons['api-key'] = trim($_POST['firebase-authentication']['api-key']); //text

    //auth-domain
    if (!isset($_POST['firebase-authentication']['auth-domain']))
    {
        $_POST['firebase-authentication']['auth-domain'] = '';
    }
    $addons['auth-domain'] = trim($_POST['firebase-authentication']['auth-domain']); //text

    //database-url
    if (!isset($_POST['firebase-authentication']['database-url']))
    {
        $_POST['firebase-authentication']['database-url'] = '';
    }
    $addons['database-url'] = trim($_POST['firebase-authentication']['database-url']); //text

    //project-id
    if (!isset($_POST['firebase-authentication']['project-id']))
    {
        $_POST['firebase-authentication']['project-id'] = '';
    }
    $addons['project-id'] = trim($_POST['firebase-authentication']['project-id']); //text

    //storage-bucket
    if (!isset($_POST['firebase-authentication']['storage-bucket']))
    {
        $_POST['firebase-authentication']['storage-bucket'] = '';
    }
    $addons['storage-bucket'] = trim($_POST['firebase-authentication']['storage-bucket']); //text

    //messaging-sender-id
    if (!isset($_POST['firebase-authentication']['messaging-sender-id']))
    {
        $_POST['firebase-authentication']['messaging-sender-id'] = '';
    }
    $addons['messaging-sender-id'] = trim($_POST['firebase-authentication']['messaging-sender-id']); //text

    //app-id
    if (!isset($_POST['firebase-authentication']['app-id']))
    {
        $_POST['firebase-authentication']['app-id'] = '';
    }
    $addons['app-id'] = trim($_POST['firebase-authentication']['app-id']); //text

    //measurement-id
    // if (!isset($_POST['firebase-authentication']['measurement-id']))
    // {
    //    $_POST['firebase-authentication']['measurement-id'] = '';
    //}
    //$addons['measurement-id'] = trim($_POST['firebase-authentication']['measurement-id']); //text


    if (!isset($_POST['firebase-authentication']['terms-of-service-page']))
    {
        $_POST['firebase-authentication']['terms-of-service-page'] = 'terms-of-service';
    }
    $addons['terms-of-service-page'] = trim($_POST['firebase-authentication']['terms-of-service-page']);


    if (!isset($_POST['firebase-authentication']['privacy-policy-page']))
    {
        $_POST['firebase-authentication']['privacy-policy-page'] = 'privacy-policy';
    }
    $addons['privacy-policy-page'] = trim($_POST['firebase-authentication']['privacy-policy-page']);


    foreach ($_POST['firebase-authentication']['pages'] as $page)
    {
        $page_name = $page['prefix'];

        if (isset($_POST['firebase-authentication']['pages'][$page_name]['auth']))
        {
            $addons['pages'][$page_name]['auth'] = true;
            $addons['pages'][$page_name]['prefix'] = $page_name;
        } else
        {
            $addons['pages'][$page_name]['auth'] = false;
            $addons['pages'][$page_name]['prefix'] = $page_name;
        }
    }


    //email-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['email-auth-provider']))
    {
        $addons['email-auth-provider'] = true;
    } else
    {
        $addons['email-auth-provider'] = false;
    }

    //phone-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['phone-auth-provider']))
    {
        $addons['phone-auth-provider'] = true;
    } else
    {
        $addons['phone-auth-provider'] = false;
    }

    //google-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['google-auth-provider']))
    {
        $addons['google-auth-provider'] = true;
    } else
    {
        $addons['google-auth-provider'] = false;
    }

    //facebook-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['facebook-auth-provider']))
    {
        $addons['facebook-auth-provider'] = true;
    } else
    {
        $addons['facebook-auth-provider'] = false;
    }

    //twitter-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['twitter-auth-provider']))
    {
        $addons['twitter-auth-provider'] = true;
    } else
    {
        $addons['twitter-auth-provider'] = false;
    }

    //github-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['github-auth-provider']))
    {
        $addons['github-auth-provider'] = true;
    } else
    {
        $addons['github-auth-provider'] = false;
    }

    //anonymous-auth-provider
    // checkbox
    if (isset($_POST['firebase-authentication']['anonymous-auth-provider']))
    {
        $addons['anonymous-auth-provider'] = true;
    } else
    {
        $addons['anonymous-auth-provider'] = false;
    }


    //label-for-email
    if (!isset($_POST['firebase-authentication']['label-for-email']))
    {
        $_POST['firebase-authentication']['label-for-email'] = 'Email';
    }
    $addons['label-for-email'] = trim($_POST['firebase-authentication']['label-for-email']); //text

    //label-for-display-name
    if (!isset($_POST['firebase-authentication']['label-for-display-name']))
    {
        $_POST['firebase-authentication']['label-for-display-name'] = 'Display Name';
    }
    $addons['label-for-display-name'] = trim($_POST['firebase-authentication']['label-for-display-name']); //text

    //label-for-guest
    if (!isset($_POST['firebase-authentication']['label-for-guest']))
    {
        $_POST['firebase-authentication']['label-for-guest'] = 'Guest';
    }
    $addons['label-for-guest'] = trim($_POST['firebase-authentication']['label-for-guest']); //text

    //label-for-no-name
    if (!isset($_POST['firebase-authentication']['label-for-no-name']))
    {
        $_POST['firebase-authentication']['label-for-no-name'] = 'No Name';
    }
    $addons['label-for-no-name'] = trim($_POST['firebase-authentication']['label-for-no-name']); //text

    //label-for-sign-out
    if (!isset($_POST['firebase-authentication']['label-for-sign-out']))
    {
        $_POST['firebase-authentication']['label-for-sign-out'] = 'Sign Out';
    }
    $addons['label-for-sign-out'] = trim($_POST['firebase-authentication']['label-for-sign-out']); //text

    //label-for-sign-in
    if (!isset($_POST['firebase-authentication']['label-for-sign-in']))
    {
        $_POST['firebase-authentication']['label-for-sign-in'] = 'Sign In';
    }
    $addons['label-for-sign-in'] = trim($_POST['firebase-authentication']['label-for-sign-in']); //text

    //label-for-phone-number
    if (!isset($_POST['firebase-authentication']['label-for-phone-number']))
    {
        $_POST['firebase-authentication']['label-for-phone-number'] = 'Phone Number';
    }
    $addons['label-for-phone-number'] = trim($_POST['firebase-authentication']['label-for-phone-number']); //text

    //label-for-update
    if (!isset($_POST['firebase-authentication']['label-for-update']))
    {
        $_POST['firebase-authentication']['label-for-update'] = 'Update';
    }
    $addons['label-for-update'] = trim($_POST['firebase-authentication']['label-for-update']); //text


    $db->saveAddOns('firebase-authentication', $addons);

    $config_xml['content'] = null;
    $config_xml['content'] .= "\t" . '<platform name="android">' . "\r\n";
    $config_xml['content'] .= "\t\t" . '<preference name="OverrideUserAgent" value="Mozilla/5.0 Google" />' . "\r\n";
    $config_xml['content'] .= "\t" . '</platform>' . "\r\n";
    $db->saveConfig($config_xml);

    $current_menu = $current_app['menus'];
    $newMenu = $current_menu;
    $newMenu['ion-header'] = 'custom-header';
    $newMenu['custom-header'] = null;
    $newMenu['custom-header'] .= "\t\t\t" . '<ion-header app-sidemenu-header>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t" . '<ion-toolbar color="' . $current_menu['color-header'] . '">' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t" . '<div class="ion-padding" *ngIf="currentUser && currentUser.uid">' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '<div *ngIf="currentUser && currentUser.displayName">' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t\t" . '<h3>{{ currentUser.displayName }}</h3>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '</div>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '<p *ngIf="currentUser && currentUser.email">' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{ currentUser.email }}</ion-text>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '</p>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '<p *ngIf="currentUser && currentUser.phoneNumber">' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t\t" . '<ion-text>{{ currentUser.phoneNumber }}</ion-text>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '</p>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '<p>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t\t" . '<ion-button  size="small" (click)="signOut()">' . $addons['label-for-sign-out'] . '</ion-button>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '</p>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t" . '<div class="ion-padding" *ngIf="!currentUser || !currentUser.uid">' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '<div>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t\t" . '<h3>{{ appTitle }}</h3>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '</div>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '<p>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t\t" . '<ion-button size="small" (click)="gotoAuthPage()">' . $addons['label-for-sign-in'] . '</ion-button>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t\t" . '</p>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t\t" . '</ion-toolbar>' . "\r\n";
    $newMenu['custom-header'] .= "\t\t\t" . '</ion-header>' . "\r\n";


    $db->saveMenu($newMenu);


    $z = 0;
    $enqueue_css['styles'][$z]['url'] = 'https://cdn.firebase.com/libs/firebaseui/3.0.0/firebaseui.css';
    $db->saveEnqueues($enqueue_css);

    // TODO: GENERATOR --|-- SERVICES

    $service['name'] = "core";
    $service['instruction'] = 'Service for Firebase Authentication';
    $service['desc'] = 'Service for Firebase Authentication';

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
    $service['modules']['angular'][$z]['class'] = 'HttpHeaders';
    $service['modules']['angular'][$z]['var'] = '';
    $service['modules']['angular'][$z]['path'] = '@angular/common/http';

    $service['code']['other'] = null;
    $db->saveService($service, "core");


    // TODO: GENERATOR --|-- GLOBALS

    $global['name'] = "core";
    $global['note'] = 'Used for firebase auth';
    // TODO: GENERATOR --|-- GLOBALS  --|-- MODULES

    $z = 0;


    //$z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'firebase';
    $global['modules'][$z]['var'] = '';
    $global['modules'][$z]['path'] = 'firebaseui-angular';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'firebaseui';
    $global['modules'][$z]['var'] = '';
    $global['modules'][$z]['path'] = 'firebaseui-angular';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'AngularFireModule';
    $global['modules'][$z]['var'] = '';
    $global['modules'][$z]['path'] = '@angular/fire';
    $global['modules'][$z]['import'] = 'AngularFireModule.initializeApp(environment.firebase)';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'AngularFireAuthModule';
    $global['modules'][$z]['var'] = '';
    $global['modules'][$z]['path'] = '@angular/fire/auth';
    $global['modules'][$z]['import'] = 'AngularFireAuthModule';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'FirebaseUIModule';
    $global['modules'][$z]['var'] = '';
    $global['modules'][$z]['path'] = 'firebaseui-angular';
    $global['modules'][$z]['import'] = 'FirebaseUIModule.forRoot(firebaseUiAuthConfig)';

    $z++;
    $global['modules'][$z]['enable'] = true;
    $global['modules'][$z]['class'] = 'AngularFireAuth';
    $global['modules'][$z]['var'] = 'angularFireAuth';
    $global['modules'][$z]['path'] = '@angular/fire/auth';


    $global['module'][0]['code']['export'] = null;
    $global['module'][0]['code']['export'] .= "" . 'const firebaseUiAuthConfig: firebaseui.auth.Config = {' . "\r\n";
    $global['module'][0]['code']['export'] .= "\t" . 'signInFlow: `popup`,' . "\r\n";
    $global['module'][0]['code']['export'] .= "\t" . 'signInOptions: [' . "\r\n";

    if ($addons['email-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebase.auth.EmailAuthProvider.PROVIDER_ID,' . "\r\n";
    }

    if ($addons['phone-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebase.auth.PhoneAuthProvider.PROVIDER_ID,' . "\r\n";
    }

    if ($addons['google-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebase.auth.GoogleAuthProvider.PROVIDER_ID,' . "\r\n";
    }

    if ($addons['facebook-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebase.auth.FacebookAuthProvider.PROVIDER_ID,' . "\r\n";
    }

    if ($addons['twitter-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebase.auth.TwitterAuthProvider.PROVIDER_ID,' . "\r\n";
    }
    if ($addons['github-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebase.auth.GithubAuthProvider.PROVIDER_ID,' . "\r\n";
    }

    if ($addons['anonymous-auth-provider'] == true)
    {
        $global['module'][0]['code']['export'] .= "\t\t" . 'firebaseui.auth.AnonymousAuthProvider.PROVIDER_ID,' . "\r\n";
    }
    $global['module'][0]['code']['export'] .= "\t" . '],' . "\r\n";
    $global['module'][0]['code']['export'] .= "\t" . 'tosUrl: `' . $addons['terms-of-service-page'] . '`,' . "\r\n";
    $global['module'][0]['code']['export'] .= "\t" . 'privacyPolicyUrl: `' . $addons['privacy-policy-page'] . '`,' . "\r\n";
    $global['module'][0]['code']['export'] .= "\t" . 'credentialHelper: firebaseui.auth.CredentialHelper.ACCOUNT_CHOOSER_COM' . "\r\n";
    $global['module'][0]['code']['export'] .= "" . '}' . "\r\n";


    $global['component'][0]['code']['export'] = null;
    $global['component'][0]['code']['init'] = null;
    //$global['component'][0]['code']['init'] .= "\t\t" . '' . "\r\n";
    $global['component'][0]['code']['init'] .= "\t\t" . 'this.authStateChanged();' . "\r\n";
    $global['component'][0]['code']['init'] .= "\t\t" . 'this.protectPages();' . "\r\n";
    $global['component'][0]['code']['other'] = null;
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '// Firebase Auth' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'currentUser:any = {};' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'isLogin:boolean = false;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . $string->toClassName($current_app['apps']['app-name']) . ':gotoAuthPage();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'gotoAuthPage(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.router.navigate(["/authentication"]);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.menuController.close();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . $string->toClassName($current_app['apps']['app-name']) . ':signOut();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'signOut(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.angularFireAuth.signOut().then(()=>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'location.reload();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . $string->toClassName($current_app['apps']['app-name']) . ':authStateChanged();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'authStateChanged(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.angularFireAuth.onAuthStateChanged((currentUser)=>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'this.currentUser = currentUser;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if(currentUser && currentUser.providerData && currentUser.providerData[0]){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.isLogin = true;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.currentUser = {' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'displayName : currentUser.providerData[0].displayName,' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'email : currentUser.providerData[0].email,' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'phoneNumber : currentUser.providerData[0].phoneNumber,' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'photoURL : currentUser.providerData[0].photoURL,' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'uid : currentUser.providerData[0].uid' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}else{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'this.isLogin = false;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '/**' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . $string->toClassName($current_app['apps']['app-name']) . ':protectPages();' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '**/' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . 'protectPages(){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'let pageName = `' . $current_app['apps']['rootPage'] . '`;' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . 'this.router.events.subscribe((event: Event) =>{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t" . 'if(event instanceof NavigationStart){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'let getPage = event.url.toString().split("/");' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'pageName = getPage[1];' . "\r\n";

    $_page = array();
    foreach ($addons['pages'] as $page)
    {
        if ($page['auth'] == true)
        {
            $_page[] = 'pageName == `' . $page['prefix'] . '`';
        }
    }
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . 'if(';
    $global['component'][0]['code']['other'] .= implode(' || ', $_page);
    $global['component'][0]['code']['other'] .= '){' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . 'if(this.isLogin==true){' . "\r\n";

    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t\t" . 'this.router.navigate(["/authentication"]);' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";


    $global['component'][0]['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t\t" . '});' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '}' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";
    $global['component'][0]['code']['other'] .= "\t" . '' . "\r\n";


    $db->saveGlobal('firebase-authentication', $global);


    // TODO: GENERATOR --|-- PAGE --|--

    // create properties for page
    $newPage = null;
    $newPage['title'] = 'Authentication';
    $newPage['name'] = 'authentication';
    $newPage['code-by'] = 'firebase auth';
    $newPage['icon-left'] = 'at';
    $newPage['icon-right'] = '';
    //$newPage['header']['color'] = $addons['page-header-color'];
    $newPage['content']['color'] = 'none';
    $newPage['content']['custom-color'] = '#ffffff';
    //$newPage['content']['background'] = $addons['page-content-background'];

    // TODO: GENERATOR --|-- PAGE --|-- HEADER
    $newPage['header']['mid']['type'] = 'title';
    $newPage['header']['mid']['items'][0]['label'] = 'Tab 1';
    $newPage['header']['mid']['items'][0]['value'] = 'tab1';
    $newPage['header']['mid']['items'][1]['label'] = 'Tab 2';
    $newPage['header']['mid']['items'][1]['value'] = 'tab2';
    $newPage['header']['mid']['items'][2]['label'] = 'Tab 3';
    $newPage['header']['mid']['items'][2]['value'] = 'tab3';

    // TODO: GENERATOR --|-- PAGE --|-- MODULES
    $z = 0;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'FirebaseUIModule';
    $newPage['modules']['angular'][$z]['var'] = '';
    $newPage['modules']['angular'][$z]['path'] = 'firebaseui-angular';

    $z++;
    $newPage['modules']['angular'][$z]['enable'] = true;
    $newPage['modules']['angular'][$z]['class'] = 'AngularFireAuth';
    $newPage['modules']['angular'][$z]['var'] = 'angularFireAuth';
    $newPage['modules']['angular'][$z]['path'] = '@angular/fire/auth';


    //$z++;
    //$newPage['modules']['angular'][$z]['enable'] = true;
    //$newPage['modules']['angular'][$z]['class'] = 'Validators';
    //$newPage['modules']['angular'][$z]['var'] = '';
    //$newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    //$z++;
    //$newPage['modules']['angular'][$z]['enable'] = true;
    //$newPage['modules']['angular'][$z]['class'] = 'FormBuilder';
    //$newPage['modules']['angular'][$z]['var'] = 'formBuilder';
    //$newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    //$z++;
    //$newPage['modules']['angular'][$z]['enable'] = true;
    //$newPage['modules']['angular'][$z]['class'] = 'FormGroup';
    //$newPage['modules']['angular'][$z]['var'] = '';
    //$newPage['modules']['angular'][$z]['path'] = '@angular/forms';

    //$z++;
    //$newPage['modules']['angular'][$z]['enable'] = true;
    //$newPage['modules']['angular'][$z]['class'] = 'FormControl';
    //$newPage['modules']['angular'][$z]['var'] = '';
    //$newPage['modules']['angular'][$z]['path'] = '@angular/forms';


    // TODO: GENERATOR --|-- PAGE --|-- CONTENT --|-- HTML
    $newPage['content']['html'] = null;

    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="currentUser && currentUser.uid">' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<h1 class="text-center" *ngIf="currentUser && currentUser.displayName ">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '{{ currentUser.displayName }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</h1>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<h4 class="text-center" *ngIf="currentUser && currentUser.email ">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '{{ currentUser.email }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</h4>' . "\r\n";

    $newPage['content']['html'] .= "\t\t\t" . '<h4 class="text-center" *ngIf="currentUser  && currentUser.phoneNumber ">' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t\t" . '{{ currentUser.phoneNumber }}' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '</h4>' . "\r\n";


    $newPage['content']['html'] .= "\t\t\t" . '<ion-button color="secondary" size="small" expand="full" (click)="signOut()">' . $addons['label-for-sign-out'] . '</ion-button>' . "\r\n";

    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";

    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";


    $newPage['content']['html'] .= "\t" . '<ion-card *ngIf="!currentUser || !currentUser.uid">' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '<ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t\t\t" . '<firebase-ui></firebase-ui>' . "\r\n";
    $newPage['content']['html'] .= "\t\t" . '</ion-card-content>' . "\r\n";
    $newPage['content']['html'] .= "\t" . '</ion-card>' . "\r\n";

    //$newPage['content']['html'] .= "\t" . '<ion-list lines="full" class="ion-no-margin ion-no-padding" *ngIf="currentUser && currentUser.uid">' . "\r\n";

    //$newPage['content']['html'] .= "\t\t" . '<form [formGroup]="formUser">' . "\r\n";

    //$newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-display-name'] . '</ion-label>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="displayName" color="primary" type="text" clear-input></ion-input>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    //$newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-email'] . '</ion-label>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="email" color="primary" type="email" clear-input></ion-input>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    //$newPage['content']['html'] .= "\t\t\t" . '<ion-item>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-label position="stacked">' . $addons['label-for-phone-number'] . '</ion-label>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-input formControlName="phoneNumber" color="primary" type="text" clear-input></ion-input>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t" . '</ion-item>' . "\r\n";

    //$newPage['content']['html'] .= "\t\t" . '</form>' . "\r\n";

    //$newPage['content']['html'] .= "\t\t" . '<ion-grid>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t" . '<ion-row>' . "\r\n";

    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-col size="3">' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button color="secondary" size="small" expand="full" (click)="signOut()">' . $addons['label-for-sign-out'] . '</ion-button>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-col size="3">' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '<ion-col size="6">' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t\t" . '<ion-button  expand="full" (click)="updateUser()">' . $addons['label-for-update'] . '</ion-button>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t\t\t" . '</ion-col>' . "\r\n";

    //$newPage['content']['html'] .= "\t\t\t" . '</ion-row>' . "\r\n";
    //$newPage['content']['html'] .= "\t\t" . '</ion-grid>' . "\r\n";

    //$newPage['content']['html'] .= "\t" . '</ion-list>' . "\r\n";


    // TODO: GENERATOR --|-- PAGE --|-- CONTENT --|-- SCSS
    $newPage['content']['scss'] = null;
    $newPage['content']['scss'] .= "\t" . 'h1,h2,h3,h4{' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'margin: 6px !important;' . "\r\n";
    $newPage['content']['scss'] .= "\t\t" . 'padding: 6px !important;' . "\r\n";
    $newPage['content']['scss'] .= "\t" . '}' . "\r\n";
    // TODO: GENERATOR --|-- PAGE --|-- CODE --|-- OTHER
    $newPage['code']['export'] = null;
    $newPage['code']['constructor'] = null;
    $newPage['code']['other'] = null;
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    //$newPage['code']['other'] .= "\t" . 'formUser: FormGroup;' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'currentUser:any;' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '* AuthenticationPage:updateUser()' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    //$newPage['code']['other'] .= "\t" . 'updateUser(){' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . 'this.angularFireAuth.currentUser.then(user => user.updateProfile({' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'displayName: this.formUser.value.displayName,' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'photoURL: "https://example.com/jane-q-user/profile.jpg"' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . '})).then(()=>{' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'location.reload();' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . '})' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '}' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '* AuthenticationPage:resetField()' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    //$newPage['code']['other'] .= "\t" . 'resetField(){' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . 'let displayName = null;' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . 'if(this.currentUser && this.currentUser.displayName){' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'displayName = this.currentUser.displayName;' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . '}' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . 'this.formUser = this.formBuilder.group({' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'displayName : [displayName, Validators.required],' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'email : [this.currentUser.email, Validators.required],' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'phoneNumber : [this.currentUser.phoneNumber, Validators.required]' . "\r\n";
    //$newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '}' . "\r\n";
    //$newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* AuthenticationPage:signOut()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'signOut(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.angularFireAuth.signOut().then(()=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'location.reload();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";
    $newPage['code']['other'] .= "\t" . '/**' . "\r\n";
    $newPage['code']['other'] .= "\t" . '* AuthenticationPage:ngOnInit()' . "\r\n";
    $newPage['code']['other'] .= "\t" . '**/' . "\r\n";
    $newPage['code']['other'] .= "\t" . 'ngOnInit(){' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . 'this.angularFireAuth.onAuthStateChanged((currentUser)=>{' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'this.currentUser = currentUser;' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t" . 'if(currentUser && currentUser.providerData && currentUser.providerData[0]){' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . 'this.currentUser = {' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'displayName : currentUser.providerData[0].displayName,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'email : currentUser.providerData[0].email,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'phoneNumber : currentUser.providerData[0].phoneNumber,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'photoURL : currentUser.providerData[0].photoURL,' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t\t" . 'uid : currentUser.providerData[0].uid' . "\r\n";
    $newPage['code']['other'] .= "\t\t\t\t" . '}' . "\r\n";
    if ($addons['after-login-goto-page'] != 'none')
    {
        $newPage['code']['other'] .= "\t\t\t\t" . 'this.router.navigate(["/' . $addons['after-login-goto-page'] . '"]);' . "\r\n";
    }
    $newPage['code']['other'] .= "\t\t\t" . '}' . "\r\n";
    //$newPage['code']['other'] .= "\t\t\t" . 'this.resetField();' . "\r\n";
    $newPage['code']['other'] .= "\t\t" . '});' . "\r\n";
    $newPage['code']['other'] .= "\t" . '}' . "\r\n";
    $newPage['code']['other'] .= "\t" . '' . "\r\n";

    $newPage['code']['init'] = null;


    //generate page code
    $db->savePage($newPage);

    $env = null;

    $env .= "\t" . 'firebase : {' . "\r\n";
    $env .= "\t\t" . 'apiKey: "' . $addons['api-key'] . '",' . "\r\n";
    $env .= "\t\t" . 'authDomain: "' . $addons['auth-domain'] . '",' . "\r\n";
    $env .= "\t\t" . 'databaseURL: "' . $addons['database-url'] . '",' . "\r\n";
    $env .= "\t\t" . 'projectId: "' . $addons['project-id'] . '",' . "\r\n";
    $env .= "\t\t" . 'storageBucket: "' . $addons['storage-bucket'] . '",' . "\r\n";
    $env .= "\t\t" . 'messagingSenderId: "' . $addons['messaging-sender-id'] . '",' . "\r\n";
    $env .= "\t\t" . 'appId: "' . $addons['app-id'] . '",' . "\r\n";
    //$env .= "\t\t" . 'measurementId: "' . $addons['measurement-id'] . '"' . "\r\n";
    $env .= "\t" . '}' . "\r\n";


    $newEnvironment = null;
    $newEnvironment['name'] = 'Firebase';
    $newEnvironment['desc'] = 'Env for Firebase';
    $newEnvironment['code']['production'] = $env;
    $newEnvironment['code']['development'] = $env;
    $db->saveEnvironment($newEnvironment);


    $db->current();
    rebuild();
    header('Location: ./?p=addons&addons=firebase-authentication&' . time());

}

// TODO: INIT --|-- CURRENT SETTINGS
$disabled = null;
$current_setting = $db->getAddOns('firebase-authentication', "core");

if (!isset($current_setting['api-key']))
{
    $current_setting['api-key'] = '';
}

if (!isset($current_setting['auth-domain']))
{
    $current_setting['auth-domain'] = '';
}

if (!isset($current_setting['database-url']))
{
    $current_setting['database-url'] = '';
}

if (!isset($current_setting['project-id']))
{
    $current_setting['project-id'] = '';
}

if (!isset($current_setting['storage-bucket']))
{
    $current_setting['storage-bucket'] = '';
}

if (!isset($current_setting['messaging-sender-id']))
{
    $current_setting['messaging-sender-id'] = '';
}

if (!isset($current_setting['app-id']))
{
    $current_setting['app-id'] = '';
}

if (!isset($current_setting['measurement-id']))
{
    $current_setting['measurement-id'] = '';
}

if (!isset($current_setting['terms-of-service-page']))
{
    $current_setting['terms-of-service-page'] = 'https://youdomain.com/tos.html';
}

if (!isset($current_setting['privacy-policy-page']))
{
    $current_setting['privacy-policy-page'] = 'https://youdomain.com/privacy-policy.html';
}

if (!isset($current_setting['email-auth-provider']))
{
    $current_setting['email-auth-provider'] = false;
}

if (!isset($current_setting['phone-auth-provider']))
{
    $current_setting['phone-auth-provider'] = false;
}

if (!isset($current_setting['google-auth-provider']))
{
    $current_setting['google-auth-provider'] = false;
}

if (!isset($current_setting['facebook-auth-provider']))
{
    $current_setting['facebook-auth-provider'] = false;
}

if (!isset($current_setting['twitter-auth-provider']))
{
    $current_setting['twitter-auth-provider'] = false;
}

if (!isset($current_setting['github-auth-provider']))
{
    $current_setting['github-auth-provider'] = false;
}

if (!isset($current_setting['anonymous-auth-provider']))
{
    $current_setting['anonymous-auth-provider'] = false;
}

if (!isset($current_setting['label-for-email']))
{
    $current_setting['label-for-email'] = 'Email Address';
}

if (!isset($current_setting['label-for-display-name']))
{
    $current_setting['label-for-display-name'] = 'Display Name';
}

if (!isset($current_setting['label-for-guest']))
{
    $current_setting['label-for-guest'] = 'Guest';
}

if (!isset($current_setting['label-for-no-name']))
{
    $current_setting['label-for-no-name'] = 'No Name';
}

if (!isset($current_setting['label-for-sign-out']))
{
    $current_setting['label-for-sign-out'] = 'Sign Out';
}

if (!isset($current_setting['label-for-sign-in']))
{
    $current_setting['label-for-sign-in'] = 'Sign In';
}


if (!isset($current_setting['label-for-phone-number']))
{
    $current_setting['label-for-phone-number'] = 'Phone Number';
}

if (!isset($current_setting['label-for-update']))
{
    $current_setting['label-for-update'] = 'Update';
}

if (!isset($current_setting['after-login-goto-page']))
{
    $current_setting['after-login-goto-page'] = 'none';
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

//$content .= '<div class="callout callout-default">'.__e('Please complete the form below to let us know how we can help you build code:').'</div>';


$content .= '<div class="callout callout-danger">' . __e('Does not support IMA Emulator, please use Chrome Developer Tools, these addons are not tested on iOS applications.') . '</div>';

$content .= '<h3>' . __e('Firebase Configuration') . '</h3>';

// TODO: LAYOUT --|-- FORM --|-- API-KEY --|-- TEXT
$content .= '<div class="row"><!-- row -->';

$content .= '<div id="field-api-key" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-api-key">' . __e('Api Key') . '</label>';
$content .= '<input id="page-api-key" type="text" name="firebase-authentication[api-key]" class="form-control" placeholder="AIzaSyc05iZeFtmilwWdY1y66sE3_jklqgV0NA0"  value="' . $current_setting['api-key'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- AUTH-DOMAIN --|-- TEXT

$content .= '<div id="field-auth-domain" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-auth-domain">' . __e('Auth Domain') . '</label>';
$content .= '<input id="page-auth-domain" type="text" name="firebase-authentication[auth-domain]" class="form-control" placeholder="b04da.firebaseapp.com"  value="' . $current_setting['auth-domain'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- DATABASE-URL --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-database-url" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-database-url">' . __e('Database URL') . '</label>';
$content .= '<input id="page-database-url" type="text" name="firebase-authentication[database-url]" class="form-control" placeholder="https://b04da.firebaseio.com"  value="' . $current_setting['database-url'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- PROJECT-ID --|-- TEXT

$content .= '<div id="field-project-id" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-project-id">' . __e('Project Id') . '</label>';
$content .= '<input id="page-project-id" type="text" name="firebase-authentication[project-id]" class="form-control" placeholder="b04da"  value="' . $current_setting['project-id'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- STORAGE-BUCKET --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-storage-bucket" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-storage-bucket">' . __e('Storage Bucket') . '</label>';
$content .= '<input id="page-storage-bucket" type="text" name="firebase-authentication[storage-bucket]" class="form-control" placeholder="b04da.appspot.com"  value="' . $current_setting['storage-bucket'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- MESSAGING-SENDER-ID --|-- TEXT

$content .= '<div id="field-messaging-sender-id" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-messaging-sender-id">' . __e('Messaging Sender Id') . '</label>';
$content .= '<input id="page-messaging-sender-id" type="text" name="firebase-authentication[messaging-sender-id]" class="form-control" placeholder="1053486099481"  value="' . $current_setting['messaging-sender-id'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- APP-ID --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-app-id" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-app-id">' . __e('App Id') . '</label>';
$content .= '<input id="page-app-id" type="text" name="firebase-authentication[app-id]" class="form-control" placeholder="1:1053486099481:web:7fb6d06d7d4d370ed64e88"  value="' . $current_setting['app-id'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- MEASUREMENT-ID --|-- TEXT

$content .= '<div id="field-measurement-id" class="col-md-6"><!-- col-md-6 -->';

//$content .= '<div class="form-group">';
//$content .= '<label for="page-measurement-id">' . __e('Measurement Id') . '</label>';
//$content .= '<input id="page-measurement-id" type="text" name="firebase-authentication[measurement-id]" class="form-control" placeholder="G-DNH3B5PH15"  value="' . $current_setting['measurement-id'] . '"  ' . $disabled . '  />';
//$content .= '<p class="help-block">' . __e('') . '</p>';
//$content .= '</div>';

$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$content .= '<hr>';

// TODO: LAYOUT --|-- FORM --|-- TERMS-OF-SERVICE-PAGE --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-terms-of-service-page" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="terms-of-service-page">' . __e('Terms Of Service Url') . '</label>';
$content .= '<input id="page-target" name="firebase-authentication[terms-of-service-page]" class="form-control" placeholder="https://youdomain.com/tos.html"  value="' . $current_setting['terms-of-service-page'] . '"  ' . $disabled . '  />';
$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT --|-- FORM --|-- PRIVACY-POLICY-PAGE --|-- TEXT

$content .= '<div id="field-measurement-id" class="col-md-6"><!-- col-md-6 -->';
$content .= '<div class="form-group">';
$content .= '<label for="privacy-policy-page">' . __e('Privacy Policy Url') . '</label>';
$content .= '<input id="page-target" name="firebase-authentication[privacy-policy-page]" class="form-control" placeholder="https://youdomain.com/pricay.html"  value="' . $current_setting['privacy-policy-page'] . '"  ' . $disabled . '  />';

$content .= '<p class="help-block">' . __e('') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';


$content .= '<hr>';

$content .= '<label for="page-rules">' . __e('Sign-in providers') . '</label>';


$content .= '<div class="row">';
$content .= '<div class="col-md-6">';


$content .= '<table class="table table-striped">';

$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>' . __e('Enable') . '</th>';
$content .= '<th>' . __e('Provider') . '</th>';
$content .= '<th>' . __e('Support Platform') . '</th>';
$content .= '</tr>';
$content .= '</thead>';


// TODO: LAYOUT --|-- FORM --|-- EMAIL-AUTH-PROVIDER --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['email-auth-provider'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-email-auth-provider" name="firebase-authentication[email-auth-provider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-email-auth-provider" name="firebase-authentication[email-auth-provider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Email Auth') . '<p class="help-block">' . __e('Allow users to sign up using their email address and password') . '</p></td>';
$content .= '<td><span class="label label-primary">Android</span> <span class="label label-success">PWA</span></td>';
$content .= '</tr>';


// TODO: LAYOUT --|-- FORM --|-- PHONE-AUTH-PROVIDER --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['phone-auth-provider'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-phone-auth-provider" name="firebase-authentication[phone-auth-provider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-phone-auth-provider" name="firebase-authentication[phone-auth-provider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Phone Auth') . '<p class="help-block">' . __e('Allow users to sign in with a mobile phone number') . '</p></td>';
$content .= '<td><span class="label label-primary">Android</span> <span class="label label-success">PWA</span></td>';
$content .= '</tr>';


// TODO: LAYOUT --|-- FORM --|-- GOOGLE-AUTH-PROVIDER --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['google-auth-provider'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-google-auth-provider" name="firebase-authentication[google-auth-provider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-google-auth-provider" name="firebase-authentication[google-auth-provider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Google Auth') . '<p class="help-block">' . __e('Allow users to sign in with google account') . '</p></td>';
$content .= '<td><span class="label label-primary">Android</span> <span class="label label-success">PWA</span></td>';
$content .= '</tr>';

// TODO: LAYOUT --|-- FORM --|-- FACEBOOK-AUTH-PROVIDER --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['facebook-auth-provider'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-facebook-auth-provider" name="firebase-authentication[facebook-auth-provider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-facebook-auth-provider" name="firebase-authentication[facebook-auth-provider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Facebook Auth') . '<p class="help-block">' . __e('Your Facebook app configuration in firebase console must be correct') . '</p></td>';
$content .= '<td><span class="label label-success">PWA</span></td>';
$content .= '</tr>';


// TODO: LAYOUT --|-- FORM --|-- TWITTER-AUTH-PROVIDER --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['twitter-auth-provider'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-twitter-auth-provider" name="firebase-authentication[twitter-auth-provider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-twitter-auth-provider" name="firebase-authentication[twitter-auth-provider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Twitter Auth') . '<p class="help-block">' . __e('Your Twitter app configuration in firebase console must be correct') . '</p></td>';
$content .= '<td><span class="label label-primary">Android</span> <span class="label label-success">PWA</span></td>';
$content .= '</tr>';

// TODO: LAYOUT --|-- FORM --|-- GITHUB-AUTH-PROVIDER --|-- CHECKBOX
$content .= '<tr>';
if ($current_setting['github-auth-provider'] == true)
{
    $content .= '<td><input checked="checked" class="flat-red" type="checkbox" id="page-github-auth-provider" name="firebase-authentication[github-auth-provider]" ' . $disabled . '/></td>';
} else
{
    $content .= '<td><input class="flat-red" type="checkbox" id="page-github-auth-provider" name="firebase-authentication[github-auth-provider]" ' . $disabled . '/></td>';
}
$content .= '<td>' . __e('Github Auth') . '<p class="help-block">' . __e('Your Github app configuration in firebase console must be correct') . '</p></td>';
$content .= '<td><span class="label label-primary">Android</span> <span class="label label-success">PWA</span></td>';
$content .= '</tr>';


$content .= '</table>';
$content .= '<p>' . __e('For iOS App has not been tried') . '</p>';

$content .= '</div>';
$content .= '<div class="col-md-6">';


// TODO: LAYOUT --|-- FORM --|-- AFTER-LOGIN-GOTO-PAGE
$content .= '<div class="form-group">';
$content .= '<label for="after-login-goto-page">' . __e('After Login Goto Page') . '</label>';
$content .= '<select id="after-login-goto-page" name="firebase-authentication[after-login-goto-page]" class="form-control" >';
$content .= '<option value="none" >' . __e('None') . '</option>';
foreach ($static_pages as $item_page)
{
    $selected = '';
    if ($current_setting['after-login-goto-page'] == $item_page["name"])
    {
        $selected = 'selected';
    }
    if ($item_page["name"] != 'authentication')
    {
        $content .= '<option value="' . htmlentities($item_page["name"]) . ' " ' . $selected . '>- ' . htmlentities($item_page["title"]) . ' (' . htmlentities($item_page["name"]) . ')</option>';
    }
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('After successful login will redirect to the page?') . '</p>';
$content .= '</div>';


$content .= '</div>';

$content .= '</div>';


$content .= '<hr>';

$content .= '<label for="page-rules">' . __e('Page Rules') . '</label>';

$content .= '<p class="help-block">' . __e('Keep in mind this page can only be protected on the client side') . '</p>';
$content .= '<table class="table table-striped table-bordered">';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>';
$content .= '' . __e('Pages') . '';
$content .= '</th>';
$content .= '<th>';
$content .= '' . __e('Authorization Required') . '';
$content .= '</th>';
$content .= '</tr>';
$content .= '</thead>';

$content .= '<tbody>';
foreach ($all_pages as $static_page)
{
    $page_name = $string->toFilename($static_page['name']);

    if ($page_name != 'authentication')
    {
        $content .= '<tr>';

        $content .= '<td>';
        $content .= $page_name;
        $content .= '</td>';

        $content .= '<td>';


        $_checked = '';
        if (isset($current_setting['pages'][$page_name]['auth']))
        {
            if ($current_setting['pages'][$page_name]['auth'] == true)
            {
                $_checked = 'checked';
            }
        }

        $content .= '<input name="firebase-authentication[pages][' . $page_name . '][auth]" type="checkbox" class="flat-green" ' . $_checked . ' />';
        $content .= '<input type="hidden" name="firebase-authentication[pages][' . $page_name . '][prefix]" value="' . $page_name . '" />';

        $content .= '</td>';


        $content .= '</tr>';
    }
}
$content .= '</tbody>';
$content .= '</table>';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-firebase-authentication" type="submit" class="btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
$content .= '</div>';

$content .= '</div>';


$content .= '<div class="box box-primary">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-magic"></i> ' . __e('Labels') . '</h3>';
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
$content .= '<input id="page-label-for-email" type="text" name="firebase-authentication[label-for-email]" class="form-control" placeholder="info@ihsana.com"  value="' . $current_setting['label-for-email'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Email`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-DISPLAY-NAME --|-- TEXT

$content .= '<div id="field-label-for-display-name" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-display-name">' . __e('Label for `Display Name`') . '</label>';
$content .= '<input id="page-label-for-display-name" type="text" name="firebase-authentication[label-for-display-name]" class="form-control" placeholder="Display Name"  value="' . $current_setting['label-for-display-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Display Name`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-GUEST --|-- TEXT

$content .= '<div id="field-label-for-guest" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-guest">' . __e('Label for `Guest`') . '</label>';
$content .= '<input id="page-label-for-guest" type="text" name="firebase-authentication[label-for-guest]" class="form-control" placeholder="Guest"  value="' . $current_setting['label-for-guest'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Guest`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-NO-NAME --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-no-name" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-no-name">' . __e('Label for `No Name`') . '</label>';
$content .= '<input id="page-label-for-no-name" type="text" name="firebase-authentication[label-for-no-name]" class="form-control" placeholder="No Name"  value="' . $current_setting['label-for-no-name'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `No Name`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SIGN-OUT --|-- TEXT

$content .= '<div id="field-label-for-sign-out" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-sign-out">' . __e('Label for `Sign Out`') . '</label>';
$content .= '<input id="page-label-for-sign-out" type="text" name="firebase-authentication[label-for-sign-out]" class="form-control" placeholder="Sign Out"  value="' . $current_setting['label-for-sign-out'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Sign Out`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-SIGN-IN --|-- TEXT

$content .= '<div id="field-label-for-sign-in" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-sign-in">' . __e('Label for `Sign In`') . '</label>';
$content .= '<input id="page-label-for-sign-in" type="text" name="firebase-authentication[label-for-sign-in]" class="form-control" placeholder="Sign In"  value="' . $current_setting['label-for-sign-in'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Sign In`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';

// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-PHONE-NUMBER --|-- TEXT
$content .= '<div class="row"><!-- row -->';
$content .= '<div id="field-label-for-phone-number" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-phone-number">' . __e('Label for `Phone Number`') . '</label>';
$content .= '<input id="page-label-for-phone-number" type="text" name="firebase-authentication[label-for-phone-number]" class="form-control" placeholder="Phone Number"  value="' . $current_setting['label-for-phone-number'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Phone Number`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';


// TODO: LAYOUT --|-- FORM --|-- LABEL-FOR-UPDATE --|-- TEXT

$content .= '<div id="field-label-for-update" class="col-md-4"><!-- col-md-4 -->';
$content .= '<div class="form-group">';
$content .= '<label for="page-label-for-update">' . __e('Label for `Update`') . '</label>';
$content .= '<input id="page-label-for-update" type="text" name="firebase-authentication[label-for-update]" class="form-control" placeholder="Update"  value="' . $current_setting['label-for-update'] . '"  ' . $disabled . ' required />';
$content .= '<p class="help-block">' . __e('Write the label text for the `Update`') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./col-md-4 -->';
$content .= '</div><!-- ./row -->';


$content .= '</div>';

$content .= '<div class="box-footer pad">';
$content .= '<input name="save-firebase-authentication" type="submit" class="btn btn-primary btn-flat pull-left" value="' . __e('Save Changes') . '" ' . $disabled . '/>';
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

$content .= '<li>';
$content .= '<p>' . __e('Run Node.js Command prompt') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('To install this library, run:') . '</p>';
$content .= '<pre class="shell">npm install firebaseui-angular --save</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('To run this library you need to have <a target="_blank" href="https://github.com/angular/angularfire">AngularFire2</a>, <a target="_blank" href="https://firebase.google.com/docs/web/setup">Firebase</a>, <a target="_blank" href="https://github.com/firebase/firebaseui-web">FirebaseUI-Web</a> installed. Fast install:') . '</p>';
$content .= '<pre class="shell">npm install firebase --save</pre>';
$content .= '<pre class="shell">npm install firebaseui --save</pre>';
$content .= '<pre class="shell">npm install @angular/fire --save</pre>';
$content .= '<pre class="shell">npm install firebaseui-angular --save</pre>';
$content .= '<pre class="shell">npm install -g firebase-tools</pre>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>Add <strong>new Firebase projects</strong> in ' . __e('<a href="https://console.firebase.google.com/?pli=1">Firebase Console</a>, Create a project name:') . ' <code>' . $current_app['apps']['app-prefix'] . '</code> and Package Name: <code>' . $current_app['apps']['app-id'] . '</code></p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then add Firebase to your web app , click <i class="fa fa-gear" ></i> <strong>Gear Icon</strong> -&raquo; <strong>Project Settings</strong> -&raquo; <strong>General</strong>') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('In <strong>Your apps</strong> section, click <strong>Add app</strong> -&raquo; <i class="fa fa-code"></i> <strong>Icon Code</strong>, Enter your <strong>App nickname</strong> and click <strong>Register App</strong> button') . '</p>';
$content .= '</li>';


$content .= '<li>';
$content .= '<p>' . __e('Copy the configuration in: <strong>Your apps</strong> -&raquo; <strong>Firebase SDK snippet</strong> -&raquo; <strong>Config</strong>') . '</p>';
$content .= '<p>' . __e('Write the values into the fields provided') . '</p>';
$content .= '</li>';


$content .= '<li>';
$content .= '<p>' . __e('Select <strong>sign-in method</strong> providers click <strong>Develop</strong> Tab --&raquo; <strong>Authentication</strong>') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then create <strong>Could Firestore</strong>, click <strong>Database</strong> --&raquo; <strong>Could Firestore</strong>') . '</p>';
$content .= '</li>';


$content .= '<li>';
$content .= '<p>' . __e('Run Node.js Command prompt, then type this command:') . '</p>';
$content .= '<pre class="shell">firebase login</pre>';
$content .= '<p> ' . __e('then login to your account') . '</p>';
$content .= '</li>';

$content .= '<li>';
$content .= '<p>' . __e('Then initialize a Firebase project') . '</p>';
$content .= '<pre class="shell">firebase init</pre>';
$content .= '<p> ' . __e('select:') . ' <strong>(*) Firestore: Deploy rules and create indexes for Firestore</strong>,use <strong>SPACE</strong> for select<br> ';
$content .= '' . __e('then select:') . ' <strong>(*) Use an existing project</strong> ' . __e(' and your app: ') . '<code>' . $current_app['apps']['app-prefix'] . '</code>' . __e(' and press enter and enter') . '</p>';

$content .= '</li>';


$content .= '</ol>';


if ($current_setting['auth-domain'] != '')
{
    $content .= '<h3>Twitter</h3>';
    $content .= '<ul>';
    $content .= '<li>';
    $content .= '<p>' . __e('Go to ') . '<a href="https://developer.twitter.com/en/apps/">Twitter Developer</a> Website</p>';
    $content .= '</li>';
    $content .= '<li>';
    $content .= '<p>' . __e('Then Create new App, then edit go to <strong>Apps</strong> -&raquo; <strong>Detail</strong> -&raquo; <strong>App details</strong> -&raquo; <strong>Edit</strong> -&raquo; <strong>Callback URL</strong>') . '</p>';
    $content .= '<pre>https://' . $current_setting['auth-domain'] . '/__/auth/handler</pre>';
    $content .= '</li>';

    $content .= '<li>';
    $content .= '<p>' . __e('Go to <strong>Apps</strong>-&raquo; <strong>Detail</strong> -&raquo; <strong>Keys and tokens</strong>, Copy <strong>API key</strong> and <strong>API secret key</strong> to the <strong>Sign-in method</strong> -&raquo; <strong>Twitter</strong> on the firebase dashboard') . '</p>';
 
    $content .= '</li>';
    
    $content .= '</ul>';

}


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-5 -->';
$content .= '</div><!-- ./row -->';


// TODO: JS
$page_js .= '$("#page-target").on("change",function(){return window.location="?p=addons&addons=firebase-authentication&page-target="+$("#page-target").val(),!1});';
