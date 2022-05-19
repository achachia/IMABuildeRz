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
$content = $breadcrumb = $page_js = null;
$string = new jsmString();
$OS = new jsmSystem();
$os_type = $OS->getOS();
$db = new jsmDatabase();


$dir_output = realpath(JSM_PATH . '/outputs/');
$dir_project = realpath(JSM_PATH . '/projects/');
$appDir = $appName = $appPrefix = $appPath = null;

$app_source = '';
$app_target = '';
$author_orgz = '';


$old_package_name = '';
$old_app_name = '';
$old_app_prefix = '';

$new_package_name = '';
$new_app_name = '';
$new_app_prefix = '';
$clone_notice = $import_notice = '';

// TODO: RESP-POST --|-- IMPORT --|--
if (isset($_FILES['import']['name']))
{
    if ($_FILES['import']['name'] != '')
    {
        if (strtolower(pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION)) == 'ima3proj')
        {
            $tmp_name = $_FILES["import"]["tmp_name"];
            $name = $_FILES["import"]["name"];
            move_uploaded_file($tmp_name, $dir_project . '/' . $name);
            $zip = new ZipArchive;
            if ($zip->open($dir_project . '/' . $name) === true)
            {
                $zip->extractTo($dir_project . '/temp');
                $app = json_decode(file_get_contents($dir_project . '/temp/apps.json'), true);
                if (!file_exists($dir_project . '/' . $app['app-prefix'] . '/apps.json'))
                {
                    $zip->extractTo($dir_project . '/' . $app['app-prefix']);
                    $zip->close();
                    foreach (glob($dir_project . "/temp/*") as $filename)
                    {
                        @unlink($filename);
                    }
                    $import_notice = '<div class="alert alert-success alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('You have successfully imported the project!') . '</div>';
                } else
                {
                    $import_notice = '<div class="alert alert-danger alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('Failed, project with the same name already exists!') . '</div>';
                }

            } else
            {
                $import_notice = '<div class="alert alert-danger alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('Uploaded file is corrupt!') . '</div>';
            }
        } else
        {
            $import_notice = '<div class="alert alert-danger alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('Invalid file, please upload a file that has *.ima3proj extension') . '</div>';
        }
    } else
    {
        $import_notice = '<div class="alert alert-danger alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('please select the file to upload!') . '</div>';
    }
}

// TODO: RESP-POST --|-- CLONE --|--
if (isset($_POST['clone']))
{
    $app_source = $_POST['clone']['app-source'];
    $app_target = $_POST['clone']['app-name'];
    $app_name = $string->toFileName($app_target);
    $author_orgz = $_POST['clone']['author-orgz'];

    $app_id = str_replace('_', '', $string->toVar($app_target));
    $organization = str_replace('_', '', $string->toVar($author_orgz));

    $dir_source = realpath($dir_project . '/' . $app_source);
    $dir_target = $dir_project . '/' . $app_name;

    if (!file_exists($dir_target . '/apps.json'))
    {

        if (!file_exists($dir_target))
        {
            @mkdir($dir_target, '0777');
        }

        $old_app = json_decode(file_get_contents($dir_source . '/apps.json'), true);


        $old_package_name = $old_app['app-id'];
        $new_package_name = JSM_PACKAGE_NAME . '.' . $organization . '.' . $app_id;

        $old_app_name = $old_app['app-name'];
        $new_app_name = $app_target;

        $old_app_prefix = $old_app['app-prefix'];
        $new_app_prefix = $app_name;

        // TODO: RESP-POST --|-- CLONE --|-- PROJECT
        foreach (glob($dir_source . "/*.json") as $file_source)
        {
            $basename = basename($file_source);
            $target = $dir_target . '/' . $basename;
            $json_content = null;
            $json_content = file_get_contents($file_source);
            $json_content = str_replace($old_package_name, $new_package_name, $json_content);
            $json_content = str_replace($old_app_name, $new_app_name, $json_content);
            $json_content = str_replace($old_app_prefix, $new_app_prefix, $json_content);
            file_put_contents($target, $json_content);

        }

        // TODO: RESP-POST --|-- CLONE --|-- ASSETS FILE
        $file_for_copies = array();
        $path[] = $dir_output . '/' . $app_source . '/src/assets/*';
        while (count($path) != 0)
        {
            $v = array_shift($path);
            foreach (glob($v) as $item)
            {
                if (is_dir($item))
                    $path[] = $item . '/*';
                elseif (is_file($item))
                {
                    if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                    {
                        $file_for_copies[] = $item;
                    }
                }
            }
        }
        $path[] = $dir_output . '/' . $app_source . '/resources/*';
        while (count($path) != 0)
        {
            $v = array_shift($path);
            foreach (glob($v) as $item)
            {
                if (is_dir($item))
                    $path[] = $item . '/*';
                elseif (is_file($item))
                {
                    if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                    {
                        $file_for_copies[] = $item;
                    }
                }
            }
        }

        foreach ($file_for_copies as $source_files)
        {
            $file_target = str_replace($app_source, $app_name, $source_files);

            $dir_target = pathinfo($file_target, PATHINFO_DIRNAME);
            //echo $dir_target .'=>'. $source_files ."\r\n" ;

            if (!file_exists($dir_target))
            {
                @mkdir($dir_target, 0777, true);
            }

            @copy($source_files, $file_target);
        }


        $clone_notice = '<div class="alert alert-success alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('The project has been successfully cloned!') . '</div>';
    } else
    {
        $clone_notice = '<div class="alert alert-danger alert-dismissible auto-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' . __e('Failed, project with the same name already exists!') . '</div>';

    }
}


if (isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{

    $appName = $_SESSION['CURRENT_APP']['apps']['app-name'];
    $appPrefix = $_SESSION['CURRENT_APP']['apps']['app-prefix'];
    $appFileName = $string->toFileName($_SESSION['CURRENT_APP']['apps']['app-name']);
    $appDir = realpath($dir_output);
    $appPath = realpath($dir_output . '/' . $_SESSION['CURRENT_APP']['apps']['app-prefix']);
    $projectPath = realpath($dir_project . '/' . $_SESSION['CURRENT_APP']['apps']['app-prefix']);
    $filesForZip = array();
    if (isset($_GET['download']))
    {

        switch ($_GET['download'])
        {
            case 'project':
                if (is_dir($projectPath))
                {
                    $path[] = $projectPath . '/*';
                    while (count($path) != 0)
                    {
                        $v = array_shift($path);
                        foreach (glob($v) as $item)
                        {
                            if (is_dir($item))
                                $path[] = $item . '/*';
                            elseif (is_file($item))
                            {
                                if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                                {
                                    $filesForZip[] = $item;
                                }
                            }
                        }
                    }
                    $fileName = $appFileName . '.' . time() . '.ima3proj';
                    $zipFile = $dir_project . '/' . $fileName;
                    $result = createZip($filesForZip, $zipFile, $appFileName);
                    echo '<script type="text/javascript">window.location="./projects/' . $fileName . '";</script>';
                }

                break;
            case 'source':
                if (is_dir($appPath . '/src/'))
                {

                    $filesForZip[] = $appPath . '/.gitignore';
                    $filesForZip[] = $appPath . '/angular.json';
                    $filesForZip[] = $appPath . '/browserlist';
                    $filesForZip[] = $appPath . '/config.xml';
                    $filesForZip[] = $appPath . '/ionic.config.json';
                    $filesForZip[] = $appPath . '/karma.conf.js';
                    $filesForZip[] = $appPath . '/package.json';
                    $filesForZip[] = $appPath . '/package-lock.json';
                    $filesForZip[] = $appPath . '/tsconfig.app.json';
                    $filesForZip[] = $appPath . '/tsconfig.json';
                    $filesForZip[] = $appPath . '/tsconfig.spec.json';
                    $filesForZip[] = $appPath . '/tslint.json';

                    $path[] = $appPath . '/src/' . '/*';
                    while (count($path) != 0)
                    {
                        $v = array_shift($path);
                        foreach (glob($v) as $item)
                        {
                            if (is_dir($item))
                                $path[] = $item . '/*';
                            elseif (is_file($item))
                            {
                                if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                                {
                                    $filesForZip[] = $item;
                                }
                            }
                        }
                    }

                    $path[] = $appPath . '/resources' . '/*';
                    while (count($path) != 0)
                    {
                        $v = array_shift($path);
                        foreach (glob($v) as $item)
                        {
                            if (is_dir($item))
                                $path[] = $item . '/*';
                            elseif (is_file($item))
                            {
                                if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                                {
                                    $filesForZip[] = $item;
                                }
                            }
                        }
                    }

                    $fileName = $appFileName . '[code].' . time() . '.zip';
                    $zipFile = $dir_output . '/' . $fileName;
                    $result = createZip($filesForZip, $zipFile, $appFileName);
                    echo '<script type="text/javascript">window.location="./outputs/' . $fileName . '";</script>';
                }
                break;
            case 'assets':
                if (is_dir($appPath . '/src/assets'))
                {
                    $path[] = $appPath . '/src/assets' . '/*';
                    while (count($path) != 0)
                    {
                        $v = array_shift($path);
                        foreach (glob($v) as $item)
                        {
                            if (is_dir($item))
                                $path[] = $item . '/*';
                            elseif (is_file($item))
                            {
                                if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                                {
                                    $filesForZip[] = $item;
                                }
                            }
                        }
                    }
                    $path[] = $appPath . '/resources' . '/*';
                    while (count($path) != 0)
                    {
                        $v = array_shift($path);
                        foreach (glob($v) as $item)
                        {
                            if (is_dir($item))
                                $path[] = $item . '/*';
                            elseif (is_file($item))
                            {
                                if (pathinfo($item, PATHINFO_EXTENSION) != '~tmp')
                                {
                                    $filesForZip[] = $item;
                                }
                            }
                        }
                    }

                    $fileName = $appFileName . '[assets].' . time() . '.zip';
                    $zipFile = $dir_output . '/' . $fileName;
                    $result = createZip($filesForZip, $zipFile, $appFileName);
                    echo '<script type="text/javascript">window.location="./outputs/' . $fileName . '";</script>';
                }
                break;

        }
        exit(0);
    }
}
$breadcrumb = null;
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-exchange"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('Export / Import') . '</li>';
$breadcrumb .= '</ol>';


$content .= '<div class="row">';

// TODO: LAYOUT IMPORT
$content .= '<div class="col-md-6">';
$content .= '<form action="" method="post" enctype="multipart/form-data">';
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-expand"></i> ' . __e('Import ') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= $import_notice;
$content .= '<div class="form-group">';
$content .= '<label>' . __e('IMA Project') . '</label>';
$content .= '<input type="file" class="form-control" value="' . $app_target . '" name="import" />';
$content .= '<p class="help-block">' . __e('Select the project file to import, it must be an extension:') . '<code>*.ima3proj</code></p>';
$content .= '</div>';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<button type="submit" class="btn btn-danger" name="import-app">' . __e('Import The Project') . '</button>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';
$content .= '</form><!-- ./form -->';
$content .= '</div><!-- ./col-md-6 -->';


// TODO: LAYOUT EXPORT


$content .= '<div class="col-md-6">';
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-compress"></i> ' . __e('Export') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
if (isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    if (JSM_IONIC_PROJECT_SAME_FOLDER == true)
    {
        $content .= __e('The source code that has been created is in the folder:');
        $content .= '<pre>' . $appPath . '</pre>';
        $content .= __e('You can copy it using <strong>Window Explorer</strong> for Windows or <strong>finder</strong> for OSx, if you want to use a command prompt or terminal you can run the command:');
        $xcopy_cmd = 'xcopy /Y /S "' . $appDir . '\\' . $appPrefix . '\*"';
        $copy_cmd = 'yes | cp -rf "' . $appDir . '/' . $appPrefix . '/" .';


        switch ($os_type)
        {
            case 1:
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 2:
                //window
                $content .= '<pre class="shell">' . $xcopy_cmd . '</pre>';
                break;
            case 3:
                //linux
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
            case 4:
                //osx
                $content .= '<pre class="shell">' . $copy_cmd . '</pre>';
                break;
        }
    }
    $content .= '<p>' . __e('You can download it using the button below:') . '</p>';

    $content .= '<a class="btn btn-primary" target="_blank" href="./?p=export-import&download=project">Download IMA Project</a>&nbsp;&nbsp;';
    $content .= '<a class="btn btn-success" target="_blank" href="./?p=export-import&download=source">Download Source Code</a>&nbsp;&nbsp;';
    $content .= '<a class="btn btn-danger" target="_blank" href="./?p=export-import&download=assets">Download Assets</a>';
} else
{
    $content .= __e('You have not activated the project, please activate the project first! click <a href="./?p=apps">here</a> to activate');
}


$content .= '</div><!-- ./box-body -->';
$content .= '</div><!-- ./box -->';
$content .= '</div><!-- ./col-md-6 -->';
$content .= '</div><!-- ./row -->';

$apps = $db->refresh();

// TODO: LAYOUT CLONE

$content .= '<form method="post" action="">';
$content .= '<div class="row">';
$content .= '<div class="col-md-12">';
$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-copy"></i> ' . __e('Clone Project') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= $clone_notice;
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Source App') . '</label>';
$content .= '<select class="form-control" name="clone[app-source]">';
foreach ($apps as $app)
{
    $selected = '';
    if ($app_source == $app['app-prefix'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $app['app-prefix'] . '" ' . $selected . '>' . $app['app-name'] . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('Select the source application to be cloned') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('New App Name') . '</label>';
$content .= '<input type="text" class="form-control" value="' . $app_target . '" placeholder="My App" name="clone[app-name]" autocomplete="off" data-inputmask="\'mask\':\'A\',\'greedy\':false,\'repeat\':32" data-mask="" required="" name="app[app-name]" />';
$content .= '<p class="help-block">' . __e('Select the source application to be cloned') . '</p>';
$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Organization') . '</label>';
$content .= '<input type="text" class="form-control" value="' . $author_orgz . '" placeholder="Ihsana IT Solution" name="clone[author-orgz]" autocomplete="off" data-inputmask="\'mask\':\'A\',\'greedy\':false,\'repeat\':32" data-mask="" required="" name="app[app-name]" />';
$content .= '<p class="help-block">' . __e('Write the name of our organization') . '</p>';
$content .= '</div>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer">';
$content .= '<button type="submit" class="btn btn-success" name="clone-app">' . __e('Clone This Project') . '</button>';
$content .= '</div>';
$content .= '</div><!-- ./box -->';

$content .= '</div><!-- ./col-md-12 -->';
$content .= '</div><!-- ./row -->';
$content .= '</form>';

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('Export / Import');
$template->page_desc = '';
$template->page_content = $content;

function createZip($files = array(), $destination = '', $prefix = '')
{
    echo '<span>Create new file</span><br/>';
    $valid_files = $invalid_files = array();
    if (is_array($files))
    {
        foreach ($files as $file)
        {
            if (file_exists($file))
            {
                $valid_files[] = $file;
            } else
            {
                $invalid_files[] = $file;
            }
        }
    }
    echo '<span>The file found is ' . count($valid_files) . ' and what is not found is ' . count($invalid_files) . '</span><br/>';
    foreach ($invalid_files as $file)
    {
        echo '<span style="color:red">Not found : ' . ($file) . '</span><br/>';
    }

    if (count($valid_files))
    {
        $zip = new ZipArchive();
        if ($zip->open($destination, ZIPARCHIVE::CREATE))
        {
            foreach ($valid_files as $file)
            {
                $_file = str_replace('\\', '/', $file);
                $split = explode($prefix . '/', $_file);
                $dir_zip = str_replace('//', '/', $split[1]);
                $zip->addFile(realpath($_file), $dir_zip);
                echo '<span style="color:green">Add file : ' . ($_file) . '=> ' . $dir_zip . '</span><br/>';
            }
        }
        echo 'The zip archive contains ', $zip->numFiles, ' files with a status of: ', $zip->status;
        $zip->close();
        return file_exists($destination);
    } else
    {
        echo 'Try to create zip: Failed bacause count files.<br/>';
        return false;
    }
}

?>