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

require_once JSM_PATH . '/system/pages/404.php';

switch ($_GET['p'])
{
        // TODO: APPS
    case 'dashboard':
        require_once JSM_PATH . '/system/pages/dashboard.php';
        break;
    case 'apps':
        require_once JSM_PATH . '/system/pages/apps.php';
        break;
    case 'menus':
        require_once JSM_PATH . '/system/pages/menus.php';
        break;
    case 'pages':
        require_once JSM_PATH . '/system/pages/pages.php';
        break;
    case 'themes':
        require_once JSM_PATH . '/system/pages/themes.php';
        break;
    case 'filemanager':
        require_once JSM_PATH . '/system/pages/filemanager.php';
        break;
    case 'addons':
        require_once JSM_PATH . '/system/pages/addons.php';
        break;
    case 'pipes':
        require_once JSM_PATH . '/system/pages/pipes.php';
        break;
    case 'directives':
        require_once JSM_PATH . '/system/pages/directives.php';
        break;
    case 'services':
        require_once JSM_PATH . '/system/pages/services.php';
        break;
    case 'providers':
        require_once JSM_PATH . '/system/pages/providers.php';
        break;

    case 'config':
        require_once JSM_PATH . '/system/pages/config.php';
        break;

        // TODO: HELPER
    case 'discuss':
        require_once JSM_PATH . '/system/pages/discuss.php';
        break;

        // TODO: BACKEND
    case 'php-native-generator':
        require_once JSM_PATH . '/system/pages/backend-php-native-generator.php';
        break;

        // TODO: BACKEND
    case 'wp-plugin-generator':
        require_once JSM_PATH . '/system/pages/backend-wp-plugin-generator.php';
        break;

        // TODO: BACKEND
    case 'json-editor':
        require_once JSM_PATH . '/system/pages/backend-json-editor.php';
        break;

        // TODO: BACKEND
    case 'backend-configuration':
        require_once JSM_PATH . '/system/pages/backend-configuration.php';
        break;

    case 'popover':
        require_once JSM_PATH . '/system/pages/popover.php';
        break;

    case 'setup':
        require_once JSM_PATH . '/system/pages/setup.php';
        break;

    case 'addons-developer':
        require_once JSM_PATH . '/system/pages/addons-developer.php';
        break;

    case 'icon-generator':
        require_once JSM_PATH . '/system/pages/icon-generator.php';
        break;
    case 'export-import':
        require_once JSM_PATH . '/system/pages/export-import.php';
        break;
    case 'globals':
        require_once JSM_PATH . '/system/pages/globals.php';
        break;
    case 'meta-tags':
        require_once JSM_PATH . '/system/pages/meta-tags.php';
        break;
    case 'code-helper':
        require_once JSM_PATH . '/system/pages/code-helper.php';
        break;

    case '1.start-compiler':
        require_once JSM_PATH . '/system/pages/1.start-compiler.php';
        break;

    case '2.update-plugin':
        require_once JSM_PATH . '/system/pages/2.update-plugin.php';
        break;

    case '3.build':
        require_once JSM_PATH . '/system/pages/3.build.php';
        break;
    case 'web-converter':
        require_once JSM_PATH . '/system/pages/web-converter.php';
        break;
    case 'google-services':
        require_once JSM_PATH . '/system/pages/google-services.php';
        break;
    case 'components-tester':
        require_once JSM_PATH . '/system/pages/components-tester.php';
        break;
    case 'youtube-channel':
        require_once JSM_PATH . '/system/pages/youtube-channel.php';
        break;
    case 'docs':
        require_once JSM_PATH . '/system/pages/docs.php';
        break;
    case 'splashscreen-generator':
        require_once JSM_PATH . '/system/pages/splashscreen-generator.php';
        break;
    case 'environments':
        require_once JSM_PATH . '/system/pages/environments.php';
        break;
    case 'localization':
        require_once JSM_PATH . '/system/pages/localization.php';
        break;

    case 'google-fonts':
        require_once JSM_PATH . '/system/pages/google-fonts.php';
        break;
}

?>