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


if ($_SESSION['CURRENT_APP_PREFIX'] != null)
{
    // TODO: menu - page
    if (!isset($_SESSION['CURRENT_APP']['pages']))
    {
        $_SESSION['CURRENT_APP']['pages'] = array();
    }

    $item_menu_html = $page_hit_html = null;
    $page_hit = count($_SESSION['CURRENT_APP']['pages']);
    if ($page_hit !== 0)
    {
        $page_hit_html = '<span class="pull-right-container"><span class="label label-primary pull-right">' . $page_hit . '</span></span>';
    } else
    {
        $page_hit_html = '<span class="pull-right-container"><span class="label label-danger pull-right">new</span></span>';
    }
    // TODO: menu - menu

    if (!isset($_SESSION['CURRENT_APP']['menus']['items']))
    {
        $_SESSION['CURRENT_APP']['menus']['items'] = array();
    }

    $menu_hit = count($_SESSION['CURRENT_APP']['menus']['items']);
    if ($menu_hit !== 0)
    {
        $menu_hit_html = '<span class="pull-right-container"><span class="label label-primary pull-right">' . $menu_hit . '</span></span>';
    } else
    {
        $menu_hit_html = '<span class="pull-right-container"><span class="label label-danger pull-right">new</span></span>';
    }
    // TODO: menu - pipes
    if (!isset($_SESSION['CURRENT_APP']['pipes']))
    {
        $_SESSION['CURRENT_APP']['pipes'] = array();
    }

    $pipe_hit = count($_SESSION['CURRENT_APP']['pipes']);
    if ($pipe_hit !== 0)
    {
        $pipe_hit_html = '<span class="pull-right-container"><span class="label label-primary pull-right">' . $pipe_hit . '</span></span>';
    } else
    {
        $pipe_hit_html = '<span class="pull-right-container"><span class="label label-danger pull-right">new</span></span>';
    }


    $addons_hit_html = null;
    if (!isset($_SESSION['CURRENT_APP']['addons']))
    {
        $_SESSION['CURRENT_APP']['addons'] = array();
    }
    $addons_hit = 0;
    foreach ($_SESSION['CURRENT_APP']['addons'] as $page_addons)
    {
        foreach ($page_addons as $_page_addons)
        {
            $addons_hit++;
        }
    }


    if ($addons_hit !== 0)
    {
        $addons_hit_html = '<span class="pull-right-container"><span class="label label-primary pull-right">' . $addons_hit . '</span></span>';
    } else
    {
        $addons_hit_html = '';
    }


    $directive_hit_html = null;
    if (!isset($_SESSION['CURRENT_APP']['directives']))
    {
        $_SESSION['CURRENT_APP']['directives'] = array();
    }
    $directives_hit = count($_SESSION['CURRENT_APP']['directives']);

    if ($directives_hit !== 0)
    {
        $directive_hit_html = '<span class="pull-right-container"><span class="label label-primary pull-right">' . $directives_hit . '</span></span>';
    } else
    {
        $directive_hit_html = '';
    }


    $services_hit_html = null;
    if (!isset($_SESSION['CURRENT_APP']['services']))
    {
        $_SESSION['CURRENT_APP']['services'] = array();
    }
    $services_hit = count($_SESSION['CURRENT_APP']['services']);

    if ($services_hit !== 0)
    {
        $services_hit_html = '<span class="pull-right-container"><span class="label label-primary pull-right">' . $services_hit . '</span></span>';
    } else
    {
        $services_hit_html = '';
    }

    $appId = 'undefined';
    if (isset($_SESSION['CURRENT_APP']['apps']['app-id']))
    {
        $appId = $_SESSION['CURRENT_APP']['apps']['app-id'];
        if (substr($_SESSION['CURRENT_APP']['apps']['app-id'], 0, 17) == "com.imabuilder.v3")
        {
            $appId = str_replace("com.imabuilder.v3.", "", $appId);
        }
    }


    $items_menu_dashboard[] = array(
        'prefix' => 'apps',
        'icon' => 'fa-cubes',
        'label' => 'Apps');

    $items_menu_dashboard[] = array(
        'prefix' => 'pages',
        'icon' => 'fa-files-o',
        'label' => 'Pages',
        'badge' => $page_hit_html);


    $items_menu_dashboard[] = array(
        'prefix' => 'menus',
        'icon' => 'fa-list-alt',
        'label' => 'Menus<span class="small">**</span>',
        'badge' => $menu_hit_html);


    $items_menu_dashboard[] = array(
        'prefix' => 'addons',
        'icon' => 'fa-magic',
        'label' => 'Add-Ons<span class="small">**</span>',
        'badge' => $addons_hit_html);

    $items_menu_dashboard[] = array(
        'prefix' => 'services',
        'icon' => 'fa-houzz',
        'label' => 'Services',
        'badge' => $services_hit_html);


    $items_menu_dashboard[] = array(
        'prefix' => 'pipes',
        'icon' => 'fa-gg',
        'label' => 'Pipes',
        'badge' => $pipe_hit_html);

    $_items_menu_dashboard[] = array(
        'prefix' => 'providers',
        'icon' => 'fa-road',
        'label' => 'Providers');

    $items_menu_dashboard[] = array(
        'prefix' => 'directives',
        'icon' => 'fa-houzz',
        'label' => 'Directives <span class="small">**</span>',
        'badge' => $directive_hit_html);

    $items_menu_dashboard[] = array(
        'prefix' => 'popover',
        'icon' => 'fa-list-alt',
        'label' => 'Popover<span class="small">**</span>');

    $items_menu_dashboard[] = array(
        'prefix' => 'globals',
        'icon' => 'fa-file-code-o',
        'label' => 'Globals');

    $items_menu_dashboard[] = array(
        'prefix' => 'themes',
        'icon' => 'fa-file-code-o',
        'label' => 'Themes');

    $items_menu_dashboard[] = array(
        'prefix' => 'meta-tags',
        'icon' => 'fa-file-code-o',
        'label' => 'Meta Tags');

    $items_menu_dashboard[] = array(
        'prefix' => 'config',
        'icon' => 'fa-gear',
        'label' => 'Configuration');

    $items_menu_dashboard[] = array(
        'prefix' => 'environments',
        'icon' => 'fa-gear',
        'label' => 'Environments');

    $items_menu_dashboard[] = array(
        'prefix' => 'filemanager',
        'icon' => 'fa-picture-o',
        'label' => 'File Manager');


    $items_menu_dashboard[] = array(
        'prefix' => 'localization',
        'icon' => 'fa-list',
        'label' => 'Localization');

    $items_menu_dashboard[] = array(
        'prefix' => 'google-services',
        'icon' => 'fa-google',
        'label' => 'Google Services');

    $items_menu_dashboard[] = array(
        'prefix' => 'google-fonts',
        'icon' => 'fa-google',
        'label' => 'Google Fonts');
        
    $item_menu_html .= '<li class="treeview active">';
    $item_menu_html .= '
          <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>';
    $item_menu_html .= '<ul class="treeview-menu">';
    foreach ($items_menu_dashboard as $item_menu)
    {
        $active = null;
        if ($_GET['p'] == $item_menu['prefix'])
        {
            $active = 'class="active"';
        }
        if (!isset($item_menu['badge']))
        {
            $item_menu['badge'] = '';
        }
        $item_menu_html .= '<li ' . $active . '><a href="' . $template->base_url . './?p=' . $item_menu['prefix'] . '&package-name=' . $appId . '"><i class="fa ' . $item_menu['icon'] . '"></i> <span>' . $item_menu['label'] . '</span>' . $item_menu['badge'] . '</a></li>';
    }
    $item_menu_html .= '</ul>';
    $item_menu_html .= '</li>';

    $items_menu_emulator[] = array(
        'prefix' => '1.start-compiler',
        'icon' => 'fa-android',
        'label' => '1) Start Compiler');

    $items_menu_emulator[] = array(
        'prefix' => '2.update-plugin',
        'icon' => 'fa-android',
        'label' => '2) Update Plugins and Errors');

    $items_menu_emulator[] = array(
        'prefix' => '3.build',
        'icon' => 'fa-android',
        'label' => '3) Build and Signed');


    $item_menu_html .= '<li class="treeview active">';
    $item_menu_html .= '
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Compiler Instructions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>';
    $item_menu_html .= '<ul class="treeview-menu">';
    foreach ($items_menu_emulator as $item_menu)
    {
        $active = null;
        if ($_GET['p'] == $item_menu['prefix'])
        {
            $active = 'class="active"';
        }
        if (!isset($item_menu['badge']))
        {
            $item_menu['badge'] = '';
        }
        $item_menu_html .= '<li ' . $active . '><a href="' . $template->base_url . './?p=' . $item_menu['prefix'] . '&package-name=' . $appId . '"><i class="fa ' . $item_menu['icon'] . '"></i> <span>' . $item_menu['label'] . '</span>' . $item_menu['badge'] . '</a></li>';
    }
    $item_menu_html .= '</ul>';
    $item_menu_html .= '</li>';


    // TODO: MENU BACKEND
    $items_menu_backends[] = array(
        'prefix' => 'backend-configuration',
        'icon' => 'fa-gear',
        'label' => 'Back-End Configuration**');

    $items_menu_backends[] = array(
        'prefix' => 'php-native-generator',
        'icon' => 'fa-file-code-o',
        'label' => 'PHP Native Generator**');

    $items_menu_backends[] = array(
        'prefix' => 'wp-plugin-generator',
        'icon' => 'fa-wordpress',
        'label' => 'WP Plugin Generator**');

    $items_menu_backends[] = array(
        'prefix' => 'json-editor',
        'icon' => 'fa-file-code-o',
        'label' => 'JSON Editor');


    $_item_menu_html = null;
    $item_menu_html .= '<li class="treeview active">';
    $item_menu_html .= '
          <a href="#">
            <i class="fa fa-life-bouy"></i>
            <span>Back-End Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>';
    $item_menu_html .= '<ul class="treeview-menu">';
    foreach ($items_menu_backends as $item_menu)
    {
        $active = null;
        if ($_GET['p'] == $item_menu['prefix'])
        {
            $active = 'class="active"';
        }
        $item_menu_html .= '<li ' . $active . '><a href="' . $template->base_url . './?p=' . $item_menu['prefix'] . '&package-name=' . $appId . '"><i class="fa ' . $item_menu['icon'] . '"></i> <span>' . $item_menu['label'] . '</span></a></li>';
    }
    $item_menu_html .= '</ul>';
    $item_menu_html .= '</li>';


    // TODO: MENU HELP
    $items_menu_help[] = array(
        'prefix' => 'web-converter',
        'icon' => 'fa-globe',
        'label' => 'Website Converter');

    $items_menu_help[] = array(
        'prefix' => 'icon-generator',
        'icon' => 'fa-cubes',
        'label' => 'Icon Generator');

    $items_menu_help[] = array(
        'prefix' => 'splashscreen-generator',
        'icon' => 'fa-cubes',
        'label' => 'Splashscreen Generator');


    $items_menu_help[] = array(
        'prefix' => 'code-helper',
        'icon' => 'fa-cubes',
        'label' => 'Code Helper');

    $items_menu_help[] = array(
        'prefix' => 'components-tester',
        'icon' => 'fa-cubes',
        'label' => 'Components Tester');

    $items_menu_help[] = array(
        'prefix' => 'addons-developer',
        'icon' => 'fa-cubes',
        'label' => 'Add-ons Developer');

    $items_menu_help[] = array(
        'prefix' => 'export-import',
        'icon' => 'fa-cubes',
        'label' => 'Export/Import');

    $items_menu_help[] = array(
        'prefix' => 'youtube-channel',
        'icon' => 'fa-youtube',
        'label' => 'Youtube Channel');

    $items_menu_help[] = array(
        'prefix' => 'docs',
        'icon' => 'fa-question-circle',
        'label' => 'Documentation');


    $item_menu_html .= '<li class="treeview active">';
    $item_menu_html .= '
          <a href="#">
            <i class="fa fa-life-bouy"></i>
            <span>Helper Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>';
    $item_menu_html .= '<ul class="treeview-menu">';
    foreach ($items_menu_help as $item_menu)
    {
        $active = null;
        if ($_GET['p'] == $item_menu['prefix'])
        {
            $active = 'class="active"';
        }
        $item_menu_html .= '<li ' . $active . '><a href="' . $template->base_url . './?p=' . $item_menu['prefix'] . '&package-name=' . $appId . '"><i class="fa ' . $item_menu['icon'] . '"></i> <span>' . $item_menu['label'] . '</span></a></li>';
    }
    $item_menu_html .= '</ul>';
    $item_menu_html .= '</li>';


    $template->page_sidebar_menu = $item_menu_html;

} else
{
    $items_menu_dashboard[] = array(
        'prefix' => 'apps',
        'icon' => 'fa-cubes',
        'label' => 'Apps');

    $item_menu_html = null;
    $item_menu_html .= '<li class="treeview active">';
    $item_menu_html .= '
          <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>';
    $item_menu_html .= '<ul class="treeview-menu">';
    foreach ($items_menu_dashboard as $item_menu)
    {
        $active = null;
        if ($_GET['p'] == $item_menu['prefix'])
        {
            $active = 'class="active"';
        }
        if (!isset($item_menu['badge']))
        {
            $item_menu['badge'] = '';
        }
        $item_menu_html .= '<li ' . $active . '><a href="' . $template->base_url . './?p=' . $item_menu['prefix'] . '"><i class="fa ' . $item_menu['icon'] . '"></i> <span>' . $item_menu['label'] . '</span>' . $item_menu['badge'] . '</a></li>';
    }
    $item_menu_html .= '</ul>';
    $item_menu_html .= '</li>';


    $items_menu_help[] = array(
        'prefix' => 'export-import',
        'icon' => 'fa-cubes',
        'label' => 'Export/Import/Clone');

    $item_menu_html .= '<li class="treeview active">';
    $item_menu_html .= '
          <a href="#">
            <i class="fa fa-life-bouy"></i>
            <span>Helper Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>';

    $item_menu_html .= '<ul class="treeview-menu">';
    foreach ($items_menu_help as $item_menu)
    {
        $active = null;
        if ($_GET['p'] == $item_menu['prefix'])
        {
            $active = 'class="active"';
        }
        $item_menu_html .= '<li ' . $active . '><a href="' . $template->base_url . './?p=' . $item_menu['prefix'] . '"><i class="fa ' . $item_menu['icon'] . '"></i> <span>' . $item_menu['label'] . '</span></a></li>';
    }
    $item_menu_html .= '</ul>';
    $item_menu_html .= '</li>';


    $template->page_sidebar_menu = $item_menu_html;
}

?>