<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2019
 * @license Commercial License
 * @package No project loaded
 */


define('JSM_PATH', dirname(__file__));

if (file_exists(JSM_PATH . "/version.txt"))
{
    $version = file_get_contents(JSM_PATH . "/version.txt");
    define('JSM_VERSION', $version);
} else
{
    define('JSM_VERSION', '00.00.00');
}

if (!isset($_GET['p']))
{
    $_GET['p'] = 'test-server';
}
$test_result = null;
$test_result .= '<div class="panel panel-default">';
$test_result .= '<div class="panel-body">';
$test_result .= '<h3>TEST RESULTS</h3>';

$path = __dir__ . "/../";
$stat = fileperms($path);
$chmod = substr(sprintf('%o', fileperms($path)), -4);


$test_result .= '<div class="alert alert-info">Please check the results below, If there are no errors, please go to the <strong>Activation</strong> Tab</div>';
$test_result .= '<pre>ROOT: ' . $chmod . '</pre>';
$test_result .= '<table class="table table-striped">';

//$test_result .= '<tr>';
//$test_result .= '<td>Memory Limit</td>';
//$test_result .= '<td>' . ini_get('memory_limit') . '</td>';
//$test_result .= '<td></td>' . "\r\n";
//$test_result .= '</tr>';

//$test_result .= '<tr>';
//$test_result .= '<td>Execution Time</td>';
//$test_result .= '<td>' . ini_get('max_execution_time') . '</td>';
//$test_result .= '<td></td>' . "\r\n";
//$test_result .= '</tr>';

$test_result .= '<tr>';
$test_result .= '<td>Output Buffering</td>';
$test_result .= '<td>' . ini_get('output_buffering') . '</td>';
$test_result .= '<td></td>' . "\r\n";
$test_result .= '</tr>';


$test_result .= '<tr>';
$test_result .= '<td>Write a file to <strong>root</strong> directory</td>';
$test_result .= '<td><code>WRITE: root/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
@file_put_contents('test.file', 'test');
if (file_exists('test.file'))
{
    $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';

$test_result .= '<tr>';
$test_result .= '<td>Write a file to <strong>class</strong> directory</td>';
$test_result .= '<td><code>WRITE: root/system/class/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
@file_put_contents('system/class/test.file', 'test');
if (file_exists('system/class/test.file'))
{
    $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';


$test_result .= '<tr>';
$test_result .= '<td>Write a file to <strong>outputs</strong> directory</td>';
$test_result .= '<td><code>WRITE: root/outputs/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
@file_put_contents('outputs/test.file', 'test');
if (file_exists('outputs/test.file'))
{
    $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';

// TODO: TEST OUTPUTS
$test_result .= '<tr>';
$test_result .= '<td>Make <strong>outputs</strong> directory</td>';
$test_result .= '<td><code>MD: root/outputs/test/folder/</code><pre>Filesystem: mkdir</pre></td>';
@mkdir('outputs/test/folder/', 0777, true);
if (file_exists('outputs/test/folder/'))
{
    if (is_dir('outputs/test/folder/'))
    {
        $test_result .= '<td><span class="label label-success">OK</span></td>';
    } else
    {
        $test_result .= '<td><span class="label label-danger">failed</span></td>';
    }
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';

$test_result .= '<tr>';
$test_result .= '<td>Write a file to <strong>outputs</strong> directory</td>';
$test_result .= '<td><code>WRITE: root/outputs/test/folder/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
@file_put_contents('outputs/test/folder/test.file', 'test');
if (file_exists('outputs/test/folder/test.file'))
{
    $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';
// TODO: TEST PROJECTS
$test_result .= '<tr>';
$test_result .= '<td>Make <strong>projects</strong> directory</td>';
$test_result .= '<td><code>MD: root/projects/test/folder/</code><pre>Filesystem: mkdir</pre></td>';
@mkdir('projects/test/folder/', 0777, true);
if (file_exists('projects/test/folder/'))
{
    if (is_dir('projects/test/folder/'))
    {
        $test_result .= '<td><span class="label label-success">OK</span></td>';
    } else
    {
        $test_result .= '<td><span class="label label-danger">failed</span></td>';
    }
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';
$test_result .= '<tr>';
$test_result .= '<td>Write a file to <strong>projects</strong> directory</td>';
$test_result .= '<td><code>WRITE: root/projects/test/folder/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
@file_put_contents('projects/test/folder/test.file', 'test');
if (file_exists('projects/test/folder/test.file'))
{
    $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';
// TODO: TEST PHP GD
$test_result .= '<tr>';
$test_result .= '<td>Create <strong>a image</strong> file</td>';
$test_result .= '<td><code>GD: root/outputs/test/folder/test.jpg</code><pre>GD: imagecreatefrompng, imagepng, etc</pre></td>';
$im = imagecreatetruecolor(20, 20);
$text_color = imagecolorallocate($im, 233, 14, 91);
@imagestring($im, 1, 5, 5, 'OK', $text_color);
@imagepng($im, 'outputs/test/folder/test.jpg');
@imagedestroy($im);
if (file_exists('outputs/test/folder/test.jpg'))
{
    if (is_file('outputs/test/folder/test.jpg'))
    {
        $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
    } else
    {
        $test_result .= '<td><span class="label label-danger">failed</span></td>';
    }
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';
// TODO: TEST ZIP
$test_result .= '<tr>';
$test_result .= '<td>Create <strong>Zip</strong> file</td>';
$test_result .= '<td><code>ZIP: root/outputs/test/folder/test.zip</code><pre>Zip: ZipArchive</pre></td>';
$file_zip = 'UEsDBBQAAAAAAJ14D0tGlR1CAwAAAAMAAAAMAAAAemlwL3Rlc3QudHh0emlwUEsBAhQAFAAAAAAAnXgPS0aVHUIDAAAAAwAAAAwAAAAAAAAAAQAgAAAAAAAAAHppcC90ZXN0LnR4dFBLBQYAAAAAAQABADoAAAAtAAAAAAA';
@file_put_contents('outputs/test/folder/test.zip', base64_decode($file_zip));
$zip = new ZipArchive;
if ($zip->open('outputs/test/folder/test.zip') === true)
{
    $zip->extractTo('outputs/test/');
    $zip->close();
    $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';
$test_result .= '<tr>';
$test_result .= '<td>Unzip a file to <strong>Zip</strong> folder</td>';
$test_result .= '<td><code>UNZIP: root/outputs/test/zip/test.txt</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
if (file_exists('outputs/test/zip/test.txt'))
{
    if (is_file('outputs/test/zip/test.txt'))
    {
        $test_result .= '<td><span class="label label-success">OK</span></td>' . "\r\n";
    } else
    {
        $test_result .= '<td><span class="label label-danger">failed</span></td>';
    }
} else
{
    $test_result .= '<td><span class="label label-danger">failed</span></td>';
}
$test_result .= '</tr>';
$test_result .= '</table>';
$test_result .= '</div>';
$test_result .= '</div>';

@unlink('test.file');
@unlink('system/class/test.file');
@unlink('outputs/test/zip/test.txt');
@unlink('outputs/test/folder/test.zip');
@unlink('outputs/test/folder/test.jpg');
@unlink('outputs/test/folder/test.file');
@unlink('outputs/test.file');

@rmdir('outputs/test/zip');
@rmdir('outputs/test/folder');
@rmdir('outputs/test');

@unlink('projects/test/folder/test.file');
@rmdir('projects/test/folder');
@rmdir('projects/test');

if (isset($_POST['register']))
{
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_purchase_code = $_POST['purchase_code'];

    $php_config = null;
    $php_config .= '<?php' . "\r\n";
    $php_config .= '' . "\r\n";

    $php_config .= '/**' . "\r\n";
    $php_config .= ' * @author Jasman <jasman@ihsana.com>' . "\r\n";
    $php_config .= ' * @copyright Ihsana IT Solution 2019' . "\r\n";
    $php_config .= ' * @license Commercial License' . "\r\n";
    $php_config .= ' *' . "\r\n";
    $php_config .= ' * @package Ihsana Mobile App Builder' . "\r\n";
    $php_config .= ' *' . "\r\n";
    $php_config .= '*/' . "\r\n";
    $php_config .= '' . "\r\n";
    $php_config .= '/** imabuilder setting **/' . "\r\n";
    $php_config .= 'define("JSM_PACKAGE_NAME","com.imabuilder.v3");' . "\r\n";
    $php_config .= 'define("JSM_CODEMIRROR_THEME","dracula");' . "\r\n";
    $php_config .= 'define("JSM_IONIC_EMULATOR", true);' . "\r\n";
    $php_config .= 'define("JSM_IONIC_EMULATOR_PORT", 8100);' . "\r\n";
    $php_config .= 'define("JSM_IONIC_LAB_PORT", 8101);' . "\r\n";
    $php_config .= 'define("JSM_IONIC_DEV_LOGGER_PORT", 8102);' . "\r\n";
    $php_config .= 'define("JSM_IONIC_PROJECT_SAME_FOLDER", true);' . "\r\n";

    $php_config .= '// If the ionic project is not the same as the imabuilder output' . "\r\n";
    $php_config .= 'define("JSM_IONIC_PROJECT_FOLDER", "~/ionic-apps");' . "\r\n";
    $php_config .= 'define("JSM_IONIC_PROJECT_FOLDER_OSX", "~/Documents/ionic-apps");' . "\r\n";
    $php_config .= 'define("JSM_IONIC_PROJECT_FOLDER_WINDOWS", "D:\\ionic-apps");' . "\r\n";

    $php_config .= '' . "\r\n";
    $php_config .= '' . "\r\n";
    $php_config .= '' . "// Do Not Delete Below Part" . "\r\n";
    $php_config .= '$version = file_get_contents(JSM_PATH . "/version.txt");' . "\r\n";
    $php_config .= 'define("JSM_CORE_VERSION", $version);' . "\r\n";
    $php_config .= '' . "class jsmIonic{ }". "\r\n";  
    file_put_contents('config.php', $php_config);

    //$class_code = base64_decode(strrev(str_rot13($_POST['activation_code'])));
    $class_code = "";
    file_put_contents('system/class/jsmIonic.php', $class_code);
    header('Location: ./?p=apps');
}

$form_content = null;

$form_content .= '<div class="row">';
$form_content .= '<div class="col-md-6">';
$form_content .= '<div class="panel panel-default">';
$form_content .= '<div class="panel-body">';

$form_content .= '<h3>ACTIVATION</h3>';

$form_content .= '<form action="" method="post">';

$form_content .= '<div class="form-group">';
$form_content .= '<label>Server Activation Used?</label>';
$form_content .= '<select class="form-control" id="server" name="server">';
$form_content .= '<option value="ihsana.com">ihsana.com</option>';
$form_content .= '<option value="ihsana.net">ihsana.net</option>';
$form_content .= '</select>';
$form_content .= '</div>';


$form_content .= '<div class="form-group">';
$form_content .= '<label>Envato Username</label>';
$form_content .= '<input type="text" class="form-control" name="user_name" placeholder="Jasman Jambak" required="">';
$form_content .= '<p class="help-block">please enter your envato username</p>';
$form_content .= '</div>';

$form_content .= '<div class="form-group">';
$form_content .= '<label>Email</label>';
$form_content .= '<input type="email" class="form-control" id="user_email" name="user_email" placeholder="you@domain.com" required="">';
$form_content .= '<p class="help-block">Your email will be used to contact us and <code>wrong email</code> are the same as losing our support (excludes: Extended License).</p>';
$form_content .= '</div>';

$form_content .= '<div class="form-group">';
$form_content .= '<label>Purchase Code</label>';
$form_content .= '<div class="input-group">';
$form_content .= '<input type="text" class="form-control" maxlength="36" id="purchase_code" name="purchase_code" placeholder="758b0a8b-c595-4b2a-8129-0be1bc5b073c">';
$form_content .= '<span class="input-group-btn"><button class="btn btn-info" id="activation_btn" type="button">Get Activation Code!</button></span>';
$form_content .= '</div>';
$form_content .= '<p class="help-block">Please enter the correct purchase code, get it <a href="http://codecanyon.net/downloads/">here</a>.</p>';
$form_content .= '</div>';

$form_content .= '<p id="loading" class="alert alert-danger" style="display:none"><i class="fa fa-circle-o-notch fa-2x fa-spin fa-fw"></i> please wait...!</p>';

$form_content .= '<div class="form-group">';
$form_content .= '<label>Activation Code</label>';
$form_content .= '<textarea name="activation_code" class="form-control" id="activation_code" required minlength="1"></textarea>';
$form_content .= '<p class="help-block">Get code activation by clicking the <strong>Get Activation Code</strong> button</p>';
$form_content .= '</div>';

$form_content .= '<div class="form-group">';
$form_content .= '<input type="submit" name="register" value="Register" class="btn btn-danger"/>';
$form_content .= '</div>';

$form_content .= '</form>';

$form_content .= '</div><!--./panel-body-->';
$form_content .= '</div><!--./panel-->';
$form_content .= '</div><!--./col-md-6-->';
$form_content .= '<div class="col-md-6">';
$form_content .= '<div class="panel panel-default">';
$form_content .= '<div class="panel-body">';

$form_content .= '<h2>NOTE</h2>';
$form_content .= '<h3>The correct Version</h3>';
$form_content .= '<img class="img-thumbnail" src="./templates/default/assets/img/version.png" width="399" height="200" />';

$form_content .= '<h3>Changing Permission Files/Folder</h3>';
$form_content .= '<h4>Linux/OSX</h4>';
$form_content .= '<p class="small">Permissions are used 777 by including folder and subfolders (<strong>option -R / recursive</strong>). Run your terminal or ssh, type this command:</p>';
$form_content .= '<pre>$ sudo su' . "\r\n" . '$ cd ' . realpath(__dir__ . '/../') . "\r\n" . '$ chmod -R 777 *</pre>';


$form_content .= '<h4>Windows</h4>';
$form_content .= '<p class="small">Run Window Explorer, go to <code>' . __dir__ . '</code>. ';
$form_content .= 'Normally, you would access the properties of a file or folder by <strong>right-clicking</strong> it. ';
$form_content .= 'Then selecting <strong>Properties</strong> from the appearing context menu.';
$form_content .= 'in Tab <strong>General</strong>, unchecked <strong>read-only</strong> then click <strong>OK</strong>';
$form_content .= '</p>';


$form_content .= '</div><!--./panel-body-->';
$form_content .= '</div><!--./panel-->';
$form_content .= '</div><!--./col-md-6-->';

$form_content .= '</div><!--./row-->';

$content = null;
$content .= '<!DOCTYPE html>';
$content .= '<html>';
$content .= '<meta charset="utf-8">';
$content .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$content .= '<title>IMABuildeRz v3 | Activation</title>';
$content .= '<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
$content .= '<link href="./templates/default/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />';
$content .= '<link rel="stylesheet" href="./templates/default/AdminLTE/css/AdminLTE.min.css"/>';
$content .= '<link rel="stylesheet" href="./templates/default/AdminLTE/css/all-skins.min.css"/>';
$content .= '<link rel="stylesheet" href="./templates/default/assets/css/fonts.css"/>';
$content .= '<link rel="stylesheet" href="./templates/default/font-awesome/css/font-awesome.min.css"/>';
$content .= '<link rel="stylesheet" href="./templates/default/assets/css/imabuilder.css"/>';
$content .= '</head>';
$content .= '<body class="hold-transition app-setup">';
$content .= '<div class="container-fluid">';
$content .= '<h1>IMABuildeRz v3 <small>' . JSM_VERSION . '</small></h1>';

$content .= '<div class="panel panel-default">';
$content .= '<div class="panel-body">';

$content .= '<ul class="nav nav-tabs">';
if ($_GET['p'] == 'test-server')
{
    $content .= '<li class="active"><a href="?p=test-server">1. Test My Server</a></li>';
    $content .= '<li><a href="?p=activation">2. Activation</a></li>';
} else
{
    $content .= '<li><a href="?p=test-server">1. Test My Server</a></li>';
    $content .= '<li class="active"><a href="?p=activation" >2. Activation</a></li>';
}

$content .= '</ul>';
$content .= '<br/>';

$content .= '<div class="tab-content">';

if ($_GET['p'] == 'test-server')
{
    $content .= '<div class="tab-pane active" id="test-server">';
    $content .= $test_result;
    $content .= '</div>';
    $content .= '<div class="tab-pane" id="activation">';
    $content .= $form_content;
    $content .= '</div>';
    $content .= '</div>';
} else
{
    $content .= '<div class="tab-pane" id="test-server">';
    $content .= $test_result;
    $content .= '</div>';
    $content .= '<div class="tab-pane active" id="activation">';
    $content .= $form_content;
    $content .= '</div>';
    $content .= '</div>';
}
$content .= '</div>';


$content .= '</div><!-- ./panel -->';

$content .= '</div><!-- ./container -->';

$content .= '<script src="./templates/default/jQuery/jquery-2.2.3.min.js"></script>';
$content .= '<script src="./templates/default/bootstrap/js/bootstrap.min.js"></script>';
$content .= '<script type="text/javascript">';
$content .= '$(document).ready(function(){';
$content .= '$("#activation_btn").click(function(){';
$content .= 'var server = $("#server").val();';
$content .= 'var purchase_code = $("#purchase_code").val().trim();';
$content .= 'var user_email = $("#user_email").val();';
//$content .= 'if((purchase_code.length == 36) && (user_email.length !== 0)){';
$content .= '$("#loading").css("display","block");';
$content .= 'var param = { VERSION: "' . JSM_VERSION . '", PHP_OS:"' . PHP_OS . '(TEST)", PHP_VERSION: "' . PHP_VERSION . '", PURCHASE_CODE: purchase_code, USER_EMAIL: user_email };';
$content .= 'var jqxhr = $.get( "https://" + server + "/imabuilder3/activation/' . JSM_VERSION . '.php",param).done(function(data){';
$content .= '$("#activation_code").val(data);';
$content .= '$("#loading").css("display","none");';
$content .= '}).fail(function(e) {';
$content .= 'alert(e.statusText);';
$content .= '$("#loading").css("display","none");';
$content .= '})';
$content .= '.always(function() {';
$content .= 'console.log("finished");';
$content .= '});';
//$content .= '}else{';
//$content .= 'alert("Please enter your email and purchase code correctly!");';
//$content .= '}';
$content .= '});';


$content .= '});';
$content .= '</script>';
$content .= '</body>';
$content .= '</html>';
echo $content;

?>