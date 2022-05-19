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
if (!isset($_SESSION['CURRENT_APP']['apps']['app-prefix']))
{
    header('Location: ?');
}
$db = new jsmDatabase();
$icon = new jsmIcon();
$string = new jsmString();
$lorem = new jsmLoremIpsum();
$breadcrumb = $content = $html_header_color = $page_js = $html_header_type = null;
$check_tables = $db->getTables();
if (count($check_tables) == 0)
{
    $disable_button_save = 'disabled';
    $notice_backend = '<div class="alert alert-danger">You must create the <a href="./?p=backend-configuration">Back-End Configuration</a> before using this features</div>';
} else
{
    $disable_button_save = '';
    $notice_backend = '';
}

$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('WP Plugin Generator') . '</li>';
$breadcrumb .= '</ol>';
if (isset($_POST['submit']))
{
    $_newWpPlugin = $_POST['wp_plugin'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The WP Plugin Generator settings has been successfully edited');
    $db->saveWpPlugin($_newWpPlugin);
    $db->current();
    rebuild();
    header("Location: ./?p=wp-plugin-generator");
}
$app_project = $_SESSION['CURRENT_APP']['apps'];
$wp_plugin = $app_project;
$tables = $db->getTables();
$wp_plugin = $db->getWpPlugin();

$wp_plugin['app-version'] = $_SESSION['CURRENT_APP']['apps']['app-version'];
$wp_plugin['app-prefix'] = $_SESSION['CURRENT_APP']['apps']['app-prefix'];


$wp_plugin_available = true;
if (!isset($wp_plugin['app-name']))
{
    $wp_plugin_available = false;
    $wp_plugin['app-name'] = $_SESSION['CURRENT_APP']['apps']['app-name'];
}

if (!isset($wp_plugin['app-description']))
{
    $wp_plugin['app-description'] = $_SESSION['CURRENT_APP']['apps']['app-description'];
}

if (!isset($wp_plugin['live-test']))
{
    $wp_plugin['live-test'] = '';
}

if (!isset($wp_plugin['wp-url']))
{
    $wp_plugin['wp-url'] = 'https://your-wp.com/';
}


if (!isset($wp_plugin['installation']))
{
    $wp_plugin['installation'] = null;
    $wp_plugin['installation'] .= '1. Upload `' . $wp_plugin['app-prefix'] . '` to the `/wp-content/plugins/` directory.' . "\r\n";
    $wp_plugin['installation'] .= '2. Activate the plugin through the "Plugins" menu in WordPress.' . "\r\n";
}


if (!isset($wp_plugin['changelog']))
{
    $wp_plugin['changelog'] = null;
    $wp_plugin['changelog'] .= '= ' . htmlentities($wp_plugin['app-version']) . ' =' . "\r\n";
    $wp_plugin['changelog'] .= '* Release Date - ' . date('d F Y') . "\r\n";
}


$wp_plugin['author-name'] = $_SESSION['CURRENT_APP']['apps']['author-name'];
$wp_plugin['donate-link'] = $_SESSION['CURRENT_APP']['apps']['author-website'];
$wp_plugin['requires'] = '4.0';
$wp_plugin['requires-php'] = '5.6';
$wp_plugin['tested'] = '5.0';
$wp_plugin['stable-tag'] = '4.1';
$wp_plugin['license'] = 'GPLv2 or later';
$wp_plugin['license-uri'] = 'http://www.gnu.org/licenses/gpl-2.0.html';
$wp_plugin['tags'] = 'rest-api';
$wp_plugin['faqs'] = '';
$wp_plugin['screenshots'] = '';
$wp_plugin['upgrade-notice'] = '';
$wp_plugin['wp-prefix'] = $string->toVar(strtolower(metaphone($_SESSION['CURRENT_APP']['apps']['app-prefix'])));

$wp_plugin['author-website'] = $_SESSION['CURRENT_APP']['apps']['author-website'];

if ($wp_plugin_available == true)
{

    // TODO: README.TXT
    $code_readme = null;
    $code_readme .= '=== ' . htmlentities($wp_plugin['app-name']) . ' ===' . "\r\n";
    $code_readme .= 'Contributors: ' . htmlentities($wp_plugin['author-name']) . "\r\n";
    $code_readme .= 'Donate link: : ' . htmlentities($wp_plugin['donate-link']) . "\r\n";
    $code_readme .= 'Tags: ' . htmlentities($wp_plugin['tags']) . "\r\n";
    $code_readme .= 'Requires at least: ' . htmlentities($wp_plugin['requires']) . "\r\n";
    $code_readme .= 'Tested up to: ' . htmlentities($wp_plugin['tested']) . "\r\n";
    $code_readme .= 'Stable tag: ' . htmlentities($wp_plugin['stable-tag']) . "\r\n";
    $code_readme .= 'Requires PHP: ' . htmlentities($wp_plugin['requires-php']) . "\r\n";
    $code_readme .= 'License: ' . htmlentities($wp_plugin['license']) . "\r\n";
    $code_readme .= 'License URI: ' . htmlentities($wp_plugin['license-uri']) . "\r\n";
    $code_readme .= "\r\n";
    $code_readme .= '== Description ==' . "\r\n";
    $code_readme .= htmlentities($wp_plugin['app-description']) . "\r\n";
    $code_readme .= "\r\n";
    $code_readme .= '== Installation ==' . "\r\n";
    $code_readme .= htmlentities($wp_plugin['installation']) . "\r\n";
    $code_readme .= "\r\n";
    $code_readme .= '== Frequently Asked Questions ==' . "\r\n";
    $code_readme .= htmlentities($wp_plugin['faqs']) . "\r\n";
    $code_readme .= "\r\n";
    $code_readme .= '== Screenshots ==' . "\r\n";
    $code_readme .= htmlentities($wp_plugin['screenshots']) . "\r\n";
    $code_readme .= "\r\n";
    $code_readme .= '== Upgrade Notice ==' . "\r\n";
    $code_readme .= htmlentities($wp_plugin['upgrade-notice']) . "\r\n";
    $code_readme .= "\r\n";
    $code_readme .= '== Changelog ==' . "\r\n";
    $code_readme .= htmlentities($wp_plugin['changelog']) . "\r\n";
    $code_readme .= "\r\n";
    $wp_plugin_class_name = $string->toClassName($wp_plugin['app-prefix']);
    $wp_plugin_prefix_name = $string->toVar($wp_plugin['wp-prefix']);
    $wp_plugin_prefix_constant = strtoupper($wp_plugin_prefix_name);
    $tables = $db->getTables();
    // TODO: WP-PLUGIN.PHP
    $code_php = null;
    $code_php .= '<?php' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= 'Plugin Name: ' . htmlentities($wp_plugin['app-name']) . "\r\n";
    $code_php .= 'Plugin URI: ' . htmlentities($wp_plugin['author-website']) . "\r\n";
    $code_php .= 'Description: ' . htmlentities($wp_plugin['app-description']) . "\r\n";
    $code_php .= 'Version: ' . htmlentities($wp_plugin['app-version']) . "\r\n";
    $code_php .= 'Author: ' . htmlentities($wp_plugin['author-name']) . "\r\n";
    $code_php .= 'Author URI: ' . htmlentities($wp_plugin['author-website']) . "\r\n";
    $code_php .= 'Text Domain: ' . htmlentities($wp_plugin['app-prefix']) . "\r\n";
    $code_php .= 'Domain Path: /languages/' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    // TODO: WP-PLUGIN.PHP - CONSTANT
    $code_php .= '# Exit if accessed directly' . "\r\n";
    $code_php .= 'if (!defined("ABSPATH"))' . "\r\n";
    $code_php .= '{' . "\r\n";
    $code_php .= "\t" . 'exit;' . "\r\n";
    $code_php .= '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Exec Mode' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= 'define("' . $wp_plugin_prefix_constant . '_EXEC", true);' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Plugin Base File' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= 'define("' . $wp_plugin_prefix_constant . '_PATH", dirname(__FILE__));' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Plugin Base Directory' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= 'define("' . $wp_plugin_prefix_constant . '_DIR", basename(' . $wp_plugin_prefix_constant . '_PATH));' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Plugin Base URL' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= 'define("' . $wp_plugin_prefix_constant . '_URL", plugins_url("/", __FILE__));' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Plugin Version' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= 'define("' . $wp_plugin_prefix_constant . '_VERSION", "' . htmlentities($wp_plugin['app-version']) . '");' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Debug Mode' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= 'define("' . $wp_plugin_prefix_constant . '_DEBUG", false); //change false for distribution' . "\r\n";
    $code_php .= "\r\n";
    //$code_php .= '/**' . "\r\n";
    //$code_php .= '* Text Domain' . "\r\n";
    //$code_php .= '**/' . "\r\n";
    //$code_php .= 'define("' . $wp_plugin_prefix_constant . '_TEXTDOMAIN","' . $wp_plugin["app-prefix"] . '");' . "\r\n";
    $code_php .= '/**' . "\r\n";
    $code_php .= '* Base Class Plugin' . "\r\n";
    $code_php .= '* @author ' . $wp_plugin["author-name"] . ' ' . "\r\n";
    $code_php .= '*' . "\r\n";
    $code_php .= '* @access public' . "\r\n";
    $code_php .= '* @package ' . $wp_plugin["app-name"] . ' ' . "\r\n";
    $code_php .= '*' . "\r\n";
    $code_php .= '**/' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= 'class ' . $wp_plugin_class_name . '' . "\r\n";
    $code_php .= '{' . "\r\n";
    //$code_php .= "\t" . 'private $textdomain = ' . $wp_plugin_prefix_constant . '_TEXTDOMAIN;' . "\r\n";
    $code_php .= "\t" . 'private $options;' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    // TODO: WP-PLUGIN.PHP - CONSTRUCT
    $code_php .= "\t" . '/**' . "\r\n";
    $code_php .= "\t" . '* Instance of a class' . "\r\n";
    $code_php .= "\t" . '* @access public' . "\r\n";
    $code_php .= "\t" . '* @return void' . "\r\n";
    $code_php .= "\t" . '**/' . "\r\n";
    $code_php .= "\t" . 'function __construct()' . "\r\n";
    $code_php .= "\t" . '{' . "\r\n";
    $code_php .= "\t\t" . '$this->options = get_option("' . $wp_plugin_prefix_name . '_option"); // get current option' . "\r\n";
    $code_php .= "\t\t" . 'add_action("plugins_loaded", array($this, "' . $wp_plugin_prefix_name . '_textdomain")); //load language/textdomain' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\t\t" . '/** register new posttype **/' . "\r\n";
    foreach ($tables as $table)
    {
        $code_php .= "\t\t" . 'add_action("init", array($this, "' . $wp_plugin_prefix_name . '_register_posttype_' . $string->toVar($table["table-name"]) . '"));' . "\r\n";
    }

    $code_php .= "\r\n";
    $code_php .= "\t\t" . '/** filter restapi **/' . "\r\n";
    foreach ($tables as $table)
    {
        $code_php .= "\t\t" . 'add_action("rest_api_init",array($this,"' . $wp_plugin_prefix_name . '_register_rest_route_filter_' . $string->toVar($table["table-name"]) . '"));' . "\r\n";
    }


    if (!isset($table['form-method']))
    {
        $table['form-method'] = 'none';
    }

    $code_php .= "\r\n";
    $code_php .= "\t\t" . '/** prepare restapi for form request **/' . "\r\n";
    foreach ($tables as $table)
    {
        if (!isset($table['form-method']))
        {
            $table['form-method'] = 'none';
        }
        if (($table['form-method'] == 'post') || ($table['form-method'] == 'get') || ($table['form-method'] == 'put'))
        {
            $code_php .= "\t\t" . 'add_action("rest_api_init",array($this,"' . $wp_plugin_prefix_name . '_register_rest_route_form_' . $string->toVar($table["table-name"]) . '"));' . "\r\n";
        }
    }

    $code_php .= "\r\n";
    $code_php .= "\t\t" . 'if (is_admin())' . "\r\n";
    $code_php .= "\t\t" . '{' . "\r\n";
    $code_php .= "\t\t\t" . '/** add new metabox **/' . "\r\n";
    foreach ($tables as $table)
    {
        $code_php .= "\t\t\t" . 'add_action("add_meta_boxes", array($this, "' . $wp_plugin_prefix_name . '_add_metabox_' . $string->toVar($table["table-name"]) . '"));' . "\r\n";
    }
    $code_php .= "\r\n";
    $code_php .= "\t\t\t" . '/** response save metadata postdata **/' . "\r\n";
    foreach ($tables as $table)
    {
        $code_php .= "\t\t\t" . 'add_action("save_post", array($this, "' . $wp_plugin_prefix_name . '_save_metadata_' . $string->toVar($table["table-name"]) . '"));' . "\r\n";
    }
    $code_php .= "\r\n";
    $code_php .= "\t\t\t" . 'add_action("admin_enqueue_scripts", array($this, "' . $wp_plugin_prefix_name . '_enqueue_scripts"));' . "\r\n";
    $code_php .= "\t\t\t" . 'add_action("admin_enqueue_scripts", array($this, "' . $wp_plugin_prefix_name . '_enqueue_styles"));' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\t\t" . '}' . "\r\n";
    $code_php .= "\t" . '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";


    // TODO: WP-PLUGIN.PHP - REGISTER POST TYPE
    foreach ($tables as $table)
    {
        $new_colums = $table['table-cols'];

        $code_php .= "\t" . '/**' . "\r\n";
        $code_php .= "\t" . '* Register REST API (' . $string->toVar($table["table-name"]) . ')' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '* @access public' . "\r\n";
        $code_php .= "\t" . '* @return void' . "\r\n";
        $code_php .= "\t" . '**/' . "\r\n";
        $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_register_rest_route_filter_' . $string->toVar($table["table-name"]) . '()' . "\r\n";
        $code_php .= "\t" . '{' . "\r\n";
        $code_php .= "\t\t" . 'register_rest_route("wp/v2","' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '",array(' . "\r\n";
        $code_php .= "\t\t\t" . '"methods" => "GET",' . "\r\n";
        $code_php .= "\t\t\t" . '"callback" =>array($this, "' . $wp_plugin_prefix_name . '_json_' . $string->toVar($table["table-name"]) . '_filter"),' . "\r\n";
        $code_php .= "\t\t\t" . '"permission_callback" => function (WP_REST_Request $request){return true;}' . "\r\n";
        $code_php .= "\t\t" . '));' . "\r\n";
        $code_php .= "\t\t" . 'register_rest_route("wp/v2","' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '/(?P<id>\d+)",array(' . "\r\n";
        $code_php .= "\t\t\t" . '"methods" => "GET",' . "\r\n";
        $code_php .= "\t\t\t" . '"callback" =>array($this, "' . $wp_plugin_prefix_name . '_json_' . $string->toVar($table["table-name"]) . '_filter"),' . "\r\n";
        $code_php .= "\t\t\t" . '"permission_callback" => function (WP_REST_Request $request){return true;}' . "\r\n";
        $code_php .= "\t\t" . '));' . "\r\n";
        $code_php .= "\t" . '}' . "\r\n";

        $code_php .= "\t" . '/**' . "\r\n";
        $code_php .= "\t" . '* callback  ' . $wp_plugin_prefix_name . '' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '* @access public' . "\r\n";
        $code_php .= "\t" . '* @return void' . "\r\n";
        $code_php .= "\t" . '**/' . "\r\n";
        $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_json_' . $string->toVar($table["table-name"]) . '_filter($request)' . "\r\n";
        $code_php .= "\t" . '{' . "\r\n";
        $code_php .= "\t\t" . '$parameters = $request->get_query_params();' . "\r\n";
        $code_php .= "\t\t" . '$meta_query = array();' . "\r\n";
        $code_php .= "\t\t" . '$c=0;' . "\r\n";
        foreach ($new_colums as $col)
        {
            $col_name = str_replace('_', '-', $col['variable']);
            $col_meta_param = $string->toVar($col['variable']);
            $col_meta_param_alt = $string->toFilename($col['variable']);
            $col_meta_key = '_' . $string->toVar($col['variable']);


            switch ($col['type'])
            {
                case 'id':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;

                case 'varchar':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;

                case 'number-fixed-length':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;

                case 'multi-images':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'thumbnail':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;

                case 'image':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;

                case 'file':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;

                case 'tinytext':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'text':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'longtext':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'number':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'date':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'time':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'datetime':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";

                    break;
                case 'boolean':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = true;' . "\r\n";
                    $code_php .= "\t\t\t" . '}else{' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = false;' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = $parameters["' . $col_meta_param . '"];' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";


                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = true;' . "\r\n";
                    $code_php .= "\t\t\t" . '}else{' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = false;' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = $parameters["' . $col_meta_param_alt . '"];' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'select':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";

                    break;
                case 'select-table':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'url':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'email':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
                case 'phone':
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'if (isset($parameters["' . $col_meta_param_alt . '"])){' . "\r\n";
                    $code_php .= "\t\t\t" . 'if ($parameters["' . $col_meta_param_alt . '"] == "-1"){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$parameters["' . $col_meta_param_alt . '"] = "";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '$c++;' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["key"] = "' . $col_meta_key . '";' . "\r\n";
                    $code_php .= "\t\t\t" . '$meta_query[$c]["value"] = esc_sql($parameters["' . $col_meta_param_alt . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    break;
            }


        }
        $code_php .= "\t\t" . '' . "\r\n";
        $code_php .= "\t\t" . '$sort = "DESC";' . "\r\n";
        $code_php .= "\t\t" . 'if (isset($parameters["sort"])){' . "\r\n";
        $code_php .= "\t\t\t" . 'if ($parameters["sort"] == "desc"){' . "\r\n";
        $code_php .= "\t\t\t\t" . '$sort = "DESC";' . "\r\n";
        $code_php .= "\t\t\t" . '} else{' . "\r\n";
        $code_php .= "\t\t\t\t" . '$sort = "ASC";' . "\r\n";
        $code_php .= "\t\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '' . "\r\n";

        $code_php .= "\t\t" . '$orderby = "date";' . "\r\n";
        $code_php .= "\t\t" . 'if (isset($parameters["orderby"])){' . "\r\n";
        $code_php .= "\t\t\t" . 'if ($parameters["orderby"] == "random"){' . "\r\n";
        $code_php .= "\t\t\t\t" . '$orderby = "rand";' . "\r\n";
        $code_php .= "\t\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";


        $code_php .= "\t\t" . '$posts = get_posts(array(' . "\r\n";
        $code_php .= "\t\t\t" . '"post_type" => "' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '",' . "\r\n";
        $code_php .= "\t\t\t" . '"post_status" => "publish",' . "\r\n";
        $code_php .= "\t\t\t" . '"nopaging" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"numberposts" => 100,' . "\r\n";
        $code_php .= "\t\t\t" . '"meta_query" => $meta_query,' . "\r\n";
        $code_php .= "\t\t\t" . '"orderby" => $orderby,' . "\r\n";
        $code_php .= "\t\t\t" . '"order" => $sort,' . "\r\n";
        $code_php .= "\t\t" . '));' . "\r\n";

        $code_php .= "\t\t" . '$new_posts = array();' . "\r\n";
        $code_php .= "\t\t" . 'foreach ($posts as $post){' . "\r\n";
        $code_php .= "\t\t\t" . '$oldData["id"] = $post->ID ;' . "\r\n";

        // TODO: WP-PLUGIN.PHP - REGISTER POST TYPE - COLUMN TYPE --|-- OK
        foreach ($new_colums as $col)
        {
            $col_name = str_replace('_', '-', $col['variable']);
            $col_var = $string->toVar($col['variable']);
            $code_php .= "\t\t\t" . '' . "\r\n";
            $code_php .= "\t\t\t" . '/** input `' . $col_name . '` **/' . "\r\n";

            if (($col['json_detail'] == true) || ($col['json_list'] == true))
            {
                switch ($col['type'])
                {
                    case 'id':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = $oldData["id"];' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;

                    case 'varchar':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'varchar':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'number-fixed-length':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] =  $' . $col_var . '_value ;' . "\r\n";
                        break;

                    case 'multi-images':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . 'if($' . $col_var . '_value != ""){' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$' . $col_var . '_data = json_decode($' . $col_var . '_value,true);' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_data ;' . "\r\n";
                        $code_php .= "\t\t\t" . '}else{' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$newData["' . $col_var . '"] = null;' . "\r\n";
                        $code_php .= "\t\t\t" . '}' . "\r\n";
                        break;
                    case 'thumbnail':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;

                    case 'image':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;

                    case 'file':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;

                    case 'tinytext':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'text':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'longtext':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = html_entity_decode(get_post_meta($oldData["id"], "_' . $col_var . '", true));' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'number':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = (int) $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'date':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'time':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'datetime':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";

                        break;
                    case 'boolean':
                        $col_boolean = explode("|", $col['option']);
                        if (!isset($col_boolean[0]))
                        {
                            $col_boolean[0] = 'TRUE';
                        }
                        if (!isset($col_boolean[1]))
                        {
                            $col_boolean[1] = 'FALSE';
                        }

                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . 'if($' . $col_var . '_value == true){' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$newData["' . $col_var . '"] = __("' . $col_boolean[0] . '", "' . $wp_plugin["app-prefix"] . '");' . "\r\n";
                        $code_php .= "\t\t\t" . '}else{' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$newData["' . $col_var . '"] = __("' . $col_boolean[1] . '", "' . $wp_plugin["app-prefix"] . '");' . "\r\n";
                        $code_php .= "\t\t\t" . '}' . "\r\n";
                        break;
                    case 'select':
                        $code_php .= "\t\t\t" . '$options = array();' . "\r\n";
                        $col_options = explode("|", $col['option']);
                        foreach ($col_options as $option)
                        {
                            $code_php .= "\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=>"' . trim($option) . '","label"=> __("' . ucwords(trim($option)) . '","' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                        }
                        $code_php .= "\t\t\t" . '$' . $col_var . '_id = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$' . $col_var . '_rendered = $' . $col_var . '_id ; ' . "\r\n";
                        $code_php .= "\t\t\t" . 'foreach($options["' . $col['variable'] . '"] as $option) {' . "\r\n";
                        $code_php .= "\t\t\t\t" . 'if($option["val"] == $' . $col_var . '_id){' . "\r\n";
                        $code_php .= "\t\t\t\t\t" . '$' . $col_var . '_rendered = $option["label"];' . "\r\n";
                        $code_php .= "\t\t\t\t" . '}' . "\r\n";
                        $code_php .= "\t\t\t" . '}' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_rendered;' . "\r\n";

                        break;
                    case 'select-table':
                        $get_table = $db->getTable($col['option']);
                        if (!isset($get_table['table-variable-as-value']))
                        {
                            $get_table['table-variable-as-value'] = 'id';
                        }
                        if (!isset($get_table['table-variable-as-label']))
                        {
                            $get_table['table-variable-as-label'] = 'name';
                        }


                        $code_php .= "\t\t\t" . '$' . $col_var . '_id = (int) get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$' . $col_var . '_data = get_post($' . $col_var . '_id);' . "\r\n";


                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"]["id"] = $' . $col_var . '_id;' . "\r\n";
                        $code_php .= "\t\t\t" . 'if(isset($' . $col_var . '_data->post_title)){' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$' . $col_var . '_label = get_post_meta($' . $col_var . '_id,"_' . $get_table['table-variable-as-label'] . '");' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$newData["' . $col_var . '"]["rendered"] = $' . $col_var . '_label[0];' . "\r\n";
                        $code_php .= "\t\t\t" . '}else{' . "\r\n";
                        $code_php .= "\t\t\t\t" . '$newData["' . $col_var . '"]["rendered"] = "Invalid ID";' . "\r\n";
                        $code_php .= "\t\t\t" . '}' . "\r\n";

                        break;
                    case 'url':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'email':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                    case 'phone':
                        $code_php .= "\t\t\t" . '$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                        $code_php .= "\t\t\t" . '$newData["' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";
                        break;
                }

            } else
            {
                $code_php .= "\t\t\t" . '//$' . $col_var . '_value = get_post_meta($oldData["id"], "_' . $col_var . '", true);' . "\r\n";
                $code_php .= "\t\t\t" . '//$newData["' . $wp_plugin_prefix_name . '_' . $col_var . '"] = $' . $col_var . '_value ;' . "\r\n";

            }
        }
        $code_php .= "\t\t\t" . '$new_posts[$oldData["id"]] = $newData;' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";

        $code_php .= "\t\t" . 'if (isset($request["id"])){' . "\r\n";
        $code_php .= "\t\t\t" . 'return $new_posts[$request["id"]];' . "\r\n";
        $code_php .= "\t\t" . '}else{' . "\r\n";
        $code_php .= "\t\t\t" . 'return array_values($new_posts);' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";

        $code_php .= "\t" . '}' . "\r\n";


    }

    // TODO: WP-PLUGIN.PHP - REGISTER POST TYPE
    foreach ($tables as $table)
    {
        $code_php .= "\t" . '/**' . "\r\n";
        $code_php .= "\t" . '* Register custom post types (' . $string->toVar($table["table-name"]) . ')' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '* @link http://codex.wordpress.org/Function_Reference/register_post_type' . "\r\n";
        $code_php .= "\t" . '* @access public' . "\r\n";
        $code_php .= "\t" . '* @return void' . "\r\n";
        $code_php .= "\t" . '**/' . "\r\n";
        $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_register_posttype_' . $string->toVar($table["table-name"]) . '()' . "\r\n";
        $code_php .= "\t" . '{' . "\r\n";
        $code_php .= "\t\t" . '$labels = array(' . "\r\n";
        $code_php .= "\t\t\t" . '"name"               => _x( "' . ucwords($table['table-plural-name']) . '", "post type general name","' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"singular_name"      => _x( "' . ucwords($table['table-singular-name']) . '", "post type singular name", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"menu_name"          => _x( "' . ucwords($table['table-plural-name']) . '", "admin menu", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"name_admin_bar"     => _x( "' . ucwords($table['table-singular-name']) . '", "add new on admin bar", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"add_new"            => _x( "Add New", "' . strtolower($table['table-singular-name']) . '", "' . $wp_plugin["app-prefix"] . '"),' . "\r\n";
        $code_php .= "\t\t\t" . '"add_new_item"       => __( "Add New ' . $table['table-singular-name'] . '", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"new_item"           => __( "New ' . ucwords($table['table-singular-name']) . '", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"edit_item"          => __( "Edit ' . ucwords($table['table-singular-name']) . '", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"view_item"          => __( "View ' . ucwords($table['table-singular-name']) . '", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"all_items"          => __( "All ' . ucwords($table['table-plural-name']) . '", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"search_items"       => __( "Search ' . ucwords($table['table-plural-name']) . '", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"parent_item_colon"  => __( "Parent ' . ucwords($table['table-plural-name']) . ':", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"not_found"          => __( "No ' . strtolower($table['table-plural-name']) . ' found.", "' . $wp_plugin["app-prefix"] . '" ),' . "\r\n";
        $code_php .= "\t\t\t" . '"not_found_in_trash" => __( "No ' . strtolower($table['table-plural-name']) . ' found in Trash.", "' . $wp_plugin["app-prefix"] . '" )' . "\r\n";
        $code_php .= "\t\t" . ');' . "\r\n";
        $code_php .= "\t\t" . '$args = array(' . "\r\n";
        $code_php .= "\t\t\t" . '"labels" => $labels,' . "\r\n";
        $code_php .= "\t\t\t" . '"description" => __("' . $table['table-desc'] . '", "' . $wp_plugin["app-prefix"] . '"),' . "\r\n";
        $code_php .= "\t\t\t" . '"public" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"capability_type" => "post",' . "\r\n";
        $code_php .= "\t\t\t" . '"menu_icon" => "dashicons-' . $table['table-icon-dashicons'] . '",' . "\r\n";
        $code_php .= "\t\t\t" . '"show_ui" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"publicly_queryable" => false,' . "\r\n";
        $code_php .= "\t\t\t" . '"show_in_menu" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"has_archive" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"hierarchical" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"taxonomies" => array(),' . "\r\n";
        $code_php .= "\t\t\t" . '"menu_position" => null,' . "\r\n";
        $code_php .= "\t\t\t" . '"query_var" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"rewrite" => false,' . "\r\n";
        $code_php .= "\t\t\t" . '"show_in_rest" => true,' . "\r\n";
        $code_php .= "\t\t\t" . '"rest_base" => "' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '",' . "\r\n";
        $code_php .= "\t\t\t" . '"rest_controller_class" => "WP_REST_Posts_Controller",' . "\r\n";
        $code_php .= "\t\t\t" . '"supports" => array("title","author"),' . "\r\n";
        $code_php .= "\t\t" . ');' . "\r\n";
        $code_php .= "\t\t" . 'register_post_type("' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '", $args);' . "\r\n";
        $code_php .= "\t" . '}' . "\r\n";
        $code_php .= "\r\n";
        $code_php .= "\r\n";
    }


    // TODO: WP-PLUGIN.PHP - PREPARE RESTAPI POST TYPE - FORM
    foreach ($tables as $table)
    {
        $new_colums = $table['table-cols'];
        if (!isset($table['form-method']))
        {
            $table['form-method'] = 'none';
        }

        if (($table['form-method'] == 'post') || ($table['form-method'] == 'get') || ($table['form-method'] == 'put'))
        {
            $code_php .= "\t" . '/**' . "\r\n";
            $code_php .= "\t" . '* ' . $wp_plugin_prefix_name . '_register_rest_route_form_' . $string->toVar($table["table-name"]) . '' . "\r\n";
            $code_php .= "\t" . '* ' . "\r\n";
            $code_php .= "\t" . '* @link https://developer.wordpress.org/reference/functions/register_rest_route/' . "\r\n";
            $code_php .= "\t" . '* @access public' . "\r\n";
            $code_php .= "\t" . '* @return void' . "\r\n";
            $code_php .= "\t" . '**/' . "\r\n";
            $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_register_rest_route_form_' . $string->toVar($table["table-name"]) . '()' . "\r\n";
            $code_php .= "\t" . '{' . "\r\n";

            $code_php .= "\t\t" . 'register_rest_route("wp/v2","' . $wp_plugin_prefix_name . '_form_' . $string->toVar($table["table-name"]) . '",array(' . "\r\n";
            $code_php .= "\t\t\t" . '"methods" => "' . strtoupper($table['form-method']) . '",' . "\r\n";
            $code_php .= "\t\t\t" . '"callback" => array($this, "' . $wp_plugin_prefix_name . '_form_' . $string->toVar($table["table-name"]) . '_callback"),' . "\r\n";
            $code_php .= "\t\t\t" . '"permission_callback" => function (WP_REST_Request $request){return true;}' . "\r\n";
            $code_php .= "\t\t" . '));' . "\r\n";

            $code_php .= "\t" . '}' . "\r\n";
            $code_php .= "\r\n";
            $code_php .= "\r\n";

            $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_form_' . $string->toVar($table["table-name"]) . '_callback($request)' . "\r\n";
            $code_php .= "\t" . '{' . "\r\n";
            $code_php .= "\t\t" . '$rest_api = array();' . "\r\n";
            $code_php .= "\t\t" . 'if(isset($_' . strtoupper($table['form-method']) . ')){' . "\r\n";
            $code_php .= "\t\t\t" . '$parameters = $_' . strtoupper($table['form-method']) . ';' . "\r\n";
            $code_php .= "\t\t\t" . '$new_post_arg = array(' . "\r\n";
            $code_php .= "\t\t\t\t\t" . '"post_title" => date("Y-m-d h:i:s"),' . "\r\n";
            $code_php .= "\t\t\t\t\t" . '"post_content" => "",' . "\r\n";
            $code_php .= "\t\t\t\t\t" . '"post_status" => "pending", // (draft|publish|pending|future|private)' . "\r\n";
            $code_php .= "\t\t\t\t\t" . '"post_type" => "' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '",' . "\r\n";
            $code_php .= "\t\t\t\t" . ');' . "\r\n";
            $code_php .= "\t\t\t" . '//insert data post to database' . "\r\n";
            $code_php .= "\t\t\t" . '$new_post_id = wp_insert_post($new_post_arg);' . "\r\n";
            $code_php .= "\t\t\t" . 'if($new_post_id){' . "\r\n";

            foreach ($new_colums as $col)
            {
                $param_input = $string->toFileName($col['variable']);

                if ($col['json_input'] == true)
                {
                    // TODO: WP-PLUGIN.PHP - PREPARE RESTAPI POST TYPE - JSON INPUT - COLUMN TYPE --|-- OK
                    $code_php .= "\t\t\t\t" . '//' . $param_input . "\r\n";
                    switch ($col['type'])
                    {
                        case 'id':
                            break;
                        case 'multi-text':
                            break;
                        case 'multi-images':
                            break;
                        case 'image':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'thumbnail':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'file':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;

                        case 'number-fixed-length':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;

                        case 'varchar':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'select-table':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'tinytext':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_textarea_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'text':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_textarea_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'longtext':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = esc_html($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'number':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = (int)($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'date':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'time':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'datetime':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'boolean':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(($postdata_' . $string->toVar($param_input) . ' == "true") || ( (int)$postdata_' . $string->toVar($param_input) . ' == 1)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = true;' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'if($postdata_' . $string->toVar($param_input) . ' == true){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", true);' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", false);' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}else{' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", false);' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'select':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'url':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'email':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_email($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                        case 'phone':
                            $code_php .= "\t\t\t\t" . 'if(isset($parameters["' . $param_input . '"])){' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '$postdata_' . $string->toVar($param_input) . ' = sanitize_text_field($parameters["' . $param_input . '"]);' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . 'if(!add_post_meta($new_post_id ,"_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ', true)){' . "\r\n";
                            $code_php .= "\t\t\t\t\t\t" . 'update_post_meta($new_post_id , "_' . $string->toVar($param_input) . '", $postdata_' . $string->toVar($param_input) . ');' . "\r\n";
                            $code_php .= "\t\t\t\t\t" . '}' . "\r\n";
                            $code_php .= "\t\t\t\t" . '}' . "\r\n";
                            break;
                    }


                }
            }


            $code_php .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>__("Successfully!","' . $wp_plugin["app-prefix"] . '"),"message"=>__("Your request has been sent","' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
            $code_php .= "\t\t\t" . '}else{' . "\r\n";
            $code_php .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"Error"),"title"=>__("Failed!","' . $wp_plugin["app-prefix"] . '"),"message"=>__("Your request failed to save!","' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
            $code_php .= "\t\t\t" . '}' . "\r\n";
            $code_php .= "\t\t" . '}' . "\r\n";
            $code_php .= "\t\t" . 'return $rest_api;' . "\r\n";
            $code_php .= "\t" . '}' . "\r\n";
            $code_php .= "\r\n";
            $code_php .= "\r\n";


        }
    }

    // TODO: WP-PLUGIN.PHP - ADD METABOX
    foreach ($tables as $table)
    {
        $code_php .= "\t" . '/**' . "\r\n";
        $code_php .= "\t" . '* Add Metabox (' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . ')' . "\r\n";
        $code_php .= "\t" . '* ' . "\r\n";
        $code_php .= "\t" . '* @link http://codex.wordpress.org/Function_Reference/add_meta_box' . "\r\n";
        $code_php .= "\t" . '* @param mixed $hooks' . "\r\n";
        $code_php .= "\t" . '* @access public' . "\r\n";
        $code_php .= "\t" . '* @return void' . "\r\n";
        $code_php .= "\t" . '**/' . "\r\n";
        $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_add_metabox_' . $string->toVar($table["table-name"]) . '($hook)' . "\r\n";
        $code_php .= "\t" . '{' . "\r\n";
        $code_php .= "\t\t" . '$allowed_hook = array("' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '"); //limit meta box to certain page' . "\r\n";
        $code_php .= "\t\t" . 'if (in_array($hook, $allowed_hook))' . "\r\n";
        $code_php .= "\t\t" . '{' . "\r\n";
        $code_php .= "\t\t\t" . 'add_meta_box("' . $wp_plugin_prefix_name . '_metabox_' . $string->toVar($table["table-name"]) . '", __("' . $table["table-plural-name"] . '", "' . $wp_plugin["app-prefix"] . '"), array($this, "' . $wp_plugin_prefix_name . '_metabox_' . $string->toVar($table["table-name"]) . '_callback"), $hook, "normal", "high");' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
        $code_php .= "\t" . '}' . "\r\n";
        $code_php .= "\r\n";
        $code_php .= "\r\n";
    }
    // TODO: WP-PLUGIN.PHP - METABOX CALLBACK
    foreach ($tables as $table)
    {
        $code_php .= "\t" . '/**' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '* call for metabox' . "\r\n";
        $code_php .= "\t" . '* ' . $wp_plugin_prefix_name . '_metabox_' . $string->toVar($table["table-name"]) . '_callback($post)' . "\r\n";
        $code_php .= "\t" . '* @param mix $post' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '**/' . "\r\n";
        $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_metabox_' . $string->toVar($table["table-name"]) . '_callback($post)' . "\r\n";
        $code_php .= "\t" . '{' . "\r\n";
        $code_php .= "\t\t" . 'wp_enqueue_style("thickbox");' . "\r\n";
        //$code_php .= "\t\t".'wp_enqueue_script("jquery-ui-datepicker");'."\r\n";
        //$code_php .= "\t\t".'wp_register_style("jquery-ui", "https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css");'."\r\n";
        //$code_php .= "\t\t".'wp_enqueue_style("jquery-ui");'."\r\n";
        $code_php .= "\t\t" . 'wp_nonce_field("' . $wp_plugin_prefix_name . '_save_metadata_' . $string->toVar($table["table-name"]) . '","' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '_nonce");' . "\r\n";
        $code_php .= "\t\t" . 'printf("<table class=\"form-table\">");' . "\r\n";
        $new_colums = $table['table-cols'];
        foreach ($new_colums as $col)
        {
            // TODO: WP-PLUGIN.PHP - METABOX FORM - COLUMN TYPE --|-- OK
            $col_name = str_replace('_', '-', $col['variable']);
            $col_var = $string->toVar($col['variable']);
            $code_php .= "\t\t" . '/** input `' . $col_name . '` **/' . "\r\n";


            switch ($col['type'])
            {
                case 'id':
                    $code_php .= "\t\t" . '// using post-id' . "\r\n";
                    break;
                case 'varchar':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" maxlength=\"128\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;

                case 'number-fixed-length':
                    if ($col['option'] == '')
                    {
                        $col['option'] = 4;
                    }
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" maxlength=\"' . $col['option'] . '\" minlength=\"' . $col['option'] . '\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), "' . str_repeat('0', $col['option']) . '" , esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;

                case 'multi-text':
                    $code_php .= "\t\t" . '$' . $col_var . '_raw = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . '$' . $col_var . '_arr = json_decode($' . $col_var . '_raw,true);' . "\r\n";
                    $code_php .= "\t\t" . '$new_item = array();' . "\r\n";
                    $code_php .= "\t\t" . 'if(is_array($' . $col_var . '_arr)){' . "\r\n";
                    $code_php .= "\t\t\t" . 'foreach($' . $col_var . '_arr as $item){' . "\r\n";
                    $code_php .= "\t\t\t\t" . 'if($item != ""){' . "\r\n";
                    $code_php .= "\t\t\t\t\t" . '$new_item[] = $item;' . "\r\n";
                    $code_php .= "\t\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '$' . $col_var . '_value = implode(",",$new_item);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' large-text\" ' . $wp_plugin_prefix_name . '-type=\"tags\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p><td></td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'multi-images':
                    $code_php .= "\t\t" . '$' . $col_var . '_raw = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . '$' . $col_var . '_arr = json_decode($' . $col_var . '_raw,true);' . "\r\n";

                    $code_php .= "\t\t" . '$new_item = array();' . "\r\n";
                    $code_php .= "\t\t" . '$z=0;' . "\r\n";
                    $code_php .= "\t\t" . 'if(is_array($' . $col_var . '_arr)){' . "\r\n";
                    $code_php .= "\t\t\t" . 'foreach($' . $col_var . '_arr as $item){' . "\r\n";
                    $code_php .= "\t\t\t\t" . 'if($item != ""){' . "\r\n";
                    $code_php .= "\t\t\t\t\t" . '$no = $z + 1 ;' . "\r\n";
                    $code_php .= "\t\t\t\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\" id=\"box-' . $wp_plugin_prefix_name . '-{$z}\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s ({$no})</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' large-text\" type=\"text\" id=\"' . $col_name . '-{$z}\" name=\"' . $col_name . '[{$z}]\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td style=\\"vertical-align: top;\\"><a ' . $wp_plugin_prefix_name . '-type=\"media\" ' . $wp_plugin_prefix_name . '-target=\\"#' . $col_name . '-{$z}\\" class=\\"button button-primary\\" href=\\"#!_\\"><i class=\\"dashicons dashicons-format-image\\" style=\\"vertical-align: text-bottom;\\"></i></a> <a ' . $wp_plugin_prefix_name . '-type=\"delete\" ' .
                        $wp_plugin_prefix_name . '-target=\\"#box-' . $wp_plugin_prefix_name . '-{$z}\\" class=\\"button\\" href=\\"#!_\\"><i class=\\"dashicons dashicons-trash\\" style=\\"vertical-align: text-bottom;\\"></i></a></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($item), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    $code_php .= "\t\t\t\t\t" . '$z++;' . "\r\n";
                    $code_php .= "\t\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '$item = null;' . "\r\n";
                    $code_php .= "\t\t" . '$no = $z + 1 ;' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s ({$no})</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' large-text\" type=\"text\" id=\"' . $col_name . '-{$z}\" name=\"' . $col_name . '[{$z}]\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td style=\\"vertical-align: top;\\"><a ' . $wp_plugin_prefix_name . '-type=\"media\" ' . $wp_plugin_prefix_name . '-target=\\"#' . $col_name . '-{$z}\\" class=\\"button button-primary\\" href=\\"#!_\\"><i class=\\"dashicons dashicons-format-image\\" style=\\"vertical-align: text-bottom;\\"></i></a> <button class=\\"button button-default\\"><i class=\\"dashicons dashicons-plus\\" style=\\"vertical-align: text-bottom;\\"></i></button></td></tr>",__("' .
                        $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($item), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";


                    break;

                case 'thumbnail':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' large-text\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td style=\\"vertical-align: top;\\"><a ' . $wp_plugin_prefix_name . '-type=\"media\" ' . $wp_plugin_prefix_name . '-target=\\"#' . $col_name . '\\" class=\\"button button-primary\\" href=\\"#!_\\"><i class=\\"dashicons dashicons-format-image\\" style=\\"vertical-align: text-bottom;\\"></i></a></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] .
                        '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;

                case 'file':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' large-text\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td style=\\"vertical-align: top;\\"><a ' . $wp_plugin_prefix_name . '-type=\"media\" ' . $wp_plugin_prefix_name . '-target=\\"#' . $col_name . '\\" class=\\"button button-primary\\" href=\\"#!_\\"><i class=\\"dashicons dashicons-format-aside\\" style=\\"vertical-align: text-bottom;\\"></i></a></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] .
                        '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;

                case 'image':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' large-text\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td style=\\"vertical-align: top;\\"><a ' . $wp_plugin_prefix_name . '-type=\"media\" ' . $wp_plugin_prefix_name . '-target=\\"#' . $col_name . '\\" class=\\"button button-primary\\" href=\\"#!_\\"><i class=\\"dashicons dashicons-format-image\\" style=\\"vertical-align: text-bottom;\\"></i></a></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] .
                        '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;


                case 'tinytext':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><textarea class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" >%s</textarea><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>", __("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'text':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><textarea class=\"input-' . $wp_plugin_prefix_name . ' large-text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" >%s</textarea><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>", __("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'longtext':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr><th colspan=\"2\" scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th></tr>", __("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr><td colspan=\"2\">");' . "\r\n";
                    $code_php .= "\t\t" . 'wp_editor(html_entity_decode($' . $col_var . '_value),"' . $col_name . '",array("media_buttons"=>true));' . "\r\n";
                    $code_php .= "\t\t" . 'printf("</td><tr>");' . "\r\n";
                    break;
                case 'number':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' small-text\" type=\"number\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'date':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" type=\"text\" ' . $wp_plugin_prefix_name . '-type=\"date\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'time':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" type=\"text\" ' . $wp_plugin_prefix_name . '-type=\"time\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'datetime':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" type=\"text\" ' . $wp_plugin_prefix_name . '-type=\"datetime\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'boolean':
                    $col_boolean = explode("|", $col['option']);
                    if (!isset($col_boolean[0]))
                    {
                        $col_boolean[0] = 'TRUE';
                    }
                    if (!isset($col_boolean[1]))
                    {
                        $col_boolean[1] = 'FALSE';
                    }

                    $code_php .= "\t\t" . 'printf("<tr><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><fieldset>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";

                    $code_php .= "\t\t" . '$' . $col_var . '_value = (int) get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'if($' . $col_var . '_value == true){' . "\r\n";

                    $code_php .= "\t\t\t" . 'printf("<label><input type=\"radio\" name=\"' . $col_name . '\" value=\"1\" checked/> %s</label><br/>",__("' . $col_boolean[0] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    $code_php .= "\t\t\t" . 'printf("<label><input type=\"radio\" name=\"' . $col_name . '\" value=\"0\" /> %s</label>",__("' . $col_boolean[1] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";

                    $code_php .= "\t\t" . '}else{' . "\r\n";
                    $code_php .= "\t\t\t" . 'printf("<label><input type=\"radio\" name=\"' . $col_name . '\" value=\"1\" /> %s</label><br/>",__("' . $col_boolean[0] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    $code_php .= "\t\t\t" . 'printf("<label><input type=\"radio\" name=\"' . $col_name . '\" value=\"0\" checked/> %s</label>",__("' . $col_boolean[1] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";

                    $code_php .= "\t\t" . '}' . "\r\n";

                    $code_php .= "\t\t" . 'printf("<p>%s</p></fieldset></td></tr>",__("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";

                    break;
                case 'select':
                    $code_php .= "\t\t" . '$options = array();' . "\r\n";
                    $col_options = explode("|", $col['option']);
                    foreach ($col_options as $option)
                    {
                        $code_php .= "\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=>"' . trim($option) . '","label"=> __("' . ucwords(trim($option)) . '","' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    }
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><fieldset>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<select class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" >");' . "\r\n";
                    $code_php .= "\t\t" . 'foreach($options["' . $col['variable'] . '"] as $option) {' . "\r\n";
                    $code_php .= "\t\t\t" . '$selected ="";' . "\r\n";
                    $code_php .= "\t\t\t" . 'if($option["val"] == $' . $col_var . '_value ){' . "\r\n";
                    $code_php .= "\t\t\t\t" . '$selected ="selected";' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . 'printf("<option value=\"".$option["val"]."\" ". $selected . ">" . $option["label"] . "</option>");' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . 'printf("</select>");' . "\r\n";

                    $code_php .= "\t\t" . 'printf("<p>%s</p></fieldset></td><td></td></tr>",__("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";

                    break;
                case 'select-table':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";

                    $code_php .= "\t\t" . '$args = array(' . "\r\n";
                    $code_php .= "\t\t\t" . '"post_type" => "' . $wp_plugin_prefix_name . '_' . $string->toVar($col["option"]) . '",' . "\r\n";
                    $code_php .= "\t\t\t" . '"echo" => 0,' . "\r\n";
                    $code_php .= "\t\t\t" . '"name" => "' . $col_name . '",' . "\r\n";
                    $code_php .= "\t\t\t" . '"id" => "' . $col_name . '", // string' . "\r\n";
                    $code_php .= "\t\t\t" . '"class" => "regular-text input-' . $wp_plugin_prefix_name . '", // string' . "\r\n";
                    $code_php .= "\t\t\t" . '"selected" => $' . $col_var . '_value // string' . "\r\n";
                    $code_php .= "\t\t" . ');' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><fieldset>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    $code_php .= "\t\t" . 'printf(wp_dropdown_pages($args));' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<p>%s</p></fieldset></td><td></td></tr>",__("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";

                    break;
                case 'url':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" type=\"url\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'email':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" type=\"email\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
                case 'phone':
                    $code_php .= "\t\t" . '$' . $col_var . '_value = get_post_meta($post->ID, "_' . $col_var . '", true);' . "\r\n";
                    $code_php .= "\t\t" . 'printf("<tr class=\"box-' . $wp_plugin_prefix_name . '\"><th scope=\"row\"><label for=\"' . $col_name . '\">%s</label></th><td><input class=\"input-' . $wp_plugin_prefix_name . ' regular-text\" type=\"text\" id=\"' . $col_name . '\" name=\"' . $col_name . '\" placeholder=\"%s\" value=\"%s\" /><p class=\"description\" id=\"' . $col_name . '-description\">%s</p></td><td></td></tr>",__("' . $col['label'] . '", "' . $wp_plugin["app-prefix"] . '"), __("' . $col['option'] . '", "' . $wp_plugin["app-prefix"] . '"), esc_attr($' . $col_var . '_value), __("' . $col['info'] . '", "' . $wp_plugin["app-prefix"] . '"));' . "\r\n";
                    break;
            }
            $code_php .= "\t" . '' . "\r\n";
        }
        $code_php .= "\t\t" . 'printf("</table>");' . "\r\n";
        $code_php .= "\t" . '}' . "\r\n";
    }

    // TODO: WP-PLUGIN.PHP - SAVE POST METABOX
    foreach ($tables as $table)
    {
        $code_php .= "\t" . '/**' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '* Save the meta when the post is saved.' . "\r\n";
        $code_php .= "\t" . '* ' . $wp_plugin_class_name . '::' . $wp_plugin_prefix_name . '_save_metadata_' . $string->toVar($table["table-name"]) . '()' . "\r\n";
        $code_php .= "\t" . '* @param int $post_id The ID of the post being saved.' . "\r\n";
        $code_php .= "\t" . '*' . "\r\n";
        $code_php .= "\t" . '**/' . "\r\n";
        $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_save_metadata_' . $string->toVar($table["table-name"]) . '($post_id)' . "\r\n";
        $code_php .= "\t" . '{' . "\r\n";
        $code_php .= "\t\t" . '// Check if our nonce is set.' . "\r\n";
        $code_php .= "\t\t" . 'if (!isset($_POST["' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '_nonce"])){' . "\r\n";
        $code_php .= "\t\t\t" . 'return $post_id;' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '$nonce = $_POST["' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . '_nonce"];' . "\r\n";
        $code_php .= "\t\t" . '//verify that the nonce is valid' . "\r\n";
        $code_php .= "\t\t" . 'if(!wp_verify_nonce($nonce, "' . $wp_plugin_prefix_name . '_save_metadata_' . $string->toVar($table["table-name"]) . '")){' . "\r\n";
        $code_php .= "\t\t" . 'return $post_id;' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '// If this is an autosave, our form has not been submitted, so we don\'t want to do anything' . "\r\n";
        $code_php .= "\t\t" . 'if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){' . "\r\n";
        $code_php .= "\t\t\t" . 'return $post_id;' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . ' // Check the user\'s permissions' . "\r\n";
        $code_php .= "\t\t" . 'if("page" == $_POST["post_type"]){' . "\r\n";
        $code_php .= "\t\t\t" . 'if(!current_user_can("edit_page",$post_id)){' . "\r\n";
        $code_php .= "\t\t\t\t" . 'return $post_id;' . "\r\n";
        $code_php .= "\t\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '}else{' . "\r\n";
        $code_php .= "\t\t\t" . 'if(!current_user_can("edit_post",$post_id)){' . "\r\n";
        $code_php .= "\t\t\t\t" . 'return $post_id;' . "\r\n";
        $code_php .= "\t\t\t" . '}' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
        $new_colums = $table['table-cols'];
        foreach ($new_colums as $col)
        {
            // TODO: WP-PLUGIN.PHP - METABOX CALLBACK - COLUMN TYPE --|-- OK
            $col_name = str_replace('_', '-', $col['variable']);
            $col_var = $string->toVar($col['variable']);
            switch ($col['type'])
            {
                case 'id':
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '", $post_id);' . "\r\n";
                    break;

                case 'multi-text':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '$data_arrs = explode(",",$postdata_' . $col_var . ');' . "\r\n";
                    $code_php .= "\t\t" . '$new_data = array();' . "\r\n";
                    $code_php .= "\t\t" . 'if(is_array($data_arrs)){' . "\r\n";
                    $code_php .= "\t\t\t" . 'foreach($data_arrs as $data_arr){' . "\r\n";
                    $code_php .= "\t\t\t\t" . 'if($data_arr != ""){' . "\r\n";
                    $code_php .= "\t\t\t\t\t" . '$new_data[] = trim($data_arr);' . "\r\n";
                    $code_php .= "\t\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",json_encode($new_data) );' . "\r\n";
                    break;
                case 'multi-images':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$data_arrs = $_POST["' . $col_name . '"];' . "\r\n";
                    $code_php .= "\t\t" . '$new_data = array();' . "\r\n";
                    $code_php .= "\t\t" . 'if(is_array($data_arrs)){' . "\r\n";
                    $code_php .= "\t\t\t" . 'foreach($data_arrs as $data_arr){' . "\r\n";
                    $code_php .= "\t\t\t\t" . 'if($data_arr != ""){' . "\r\n";
                    $code_php .= "\t\t\t\t\t" . '$new_data[] = trim(sanitize_text_field($data_arr));' . "\r\n";
                    $code_php .= "\t\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '}' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",json_encode($new_data) );' . "\r\n";
                    break;

                case 'varchar':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;

                case 'number-fixed-length':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;

                case 'thumbnail':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;

                case 'image':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;

                case 'file':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;

                case 'tinytext':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_textarea_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'text':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_textarea_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'longtext':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_textarea_field(htmlentities($_POST["' . $col_name . '"]));' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'number':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = (int)($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'date':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'time':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'datetime':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'boolean':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = (int)($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'select':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'select-table':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'url':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'email':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_email($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
                case 'phone':
                    $code_php .= "\t\t" . '// Sanitize the user input' . "\r\n";
                    $code_php .= "\t\t" . '$postdata_' . $col_var . ' = sanitize_text_field($_POST["' . $col_name . '"]);' . "\r\n";
                    $code_php .= "\t\t" . '// Update the meta field.' . "\r\n";
                    $code_php .= "\t\t" . 'update_post_meta($post_id,"_' . $col_var . '",$postdata_' . $col_var . ');' . "\r\n";
                    break;
            }
        }
        $code_php .= "\t" . '}' . "\r\n";
    }
    $code_php .= "\r\n";
    $code_php .= "\r\n";


    // TODO: WP-PLUGIN.PHP - ENQUEUE-SCRIPT
    $code_php .= "\t" . '/**' . "\r\n";
    $code_php .= "\t" . '* Registers the script' . "\r\n";
    $code_php .= "\t" . '* @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/' . "\r\n";
    $code_php .= "\t" . '* @param object $hooks' . "\r\n";
    $code_php .= "\t" . '* @access public' . "\r\n";
    $code_php .= "\t" . '* @return void' . "\r\n";
    $code_php .= "\t" . '**/' . "\r\n";
    $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_enqueue_scripts($hooks)' . "\r\n";
    $code_php .= "\t" . '{' . "\r\n";
    $code_php .= "\t" . '' . "\r\n";
    $code_php .= "\t\t" . 'if (function_exists("get_current_screen")) {' . "\r\n";
    $code_php .= "\t\t\t" . '$screen = get_current_screen();' . "\r\n";
    $code_php .= "\t\t" . '}else{' . "\r\n";
    $code_php .= "\t\t\t" . '$screen = $hooks;' . "\r\n";
    $code_php .= "\t\t" . '}' . "\r\n";
    $code_php .= "\t" . '' . "\r\n";
    foreach ($tables as $table)
    {
        $code_php .= "\t\t" . '// limit page only ' . $string->toVar($table['table-name']) . '' . "\r\n";
        $code_php .= "\t\t" . 'if((in_array($hooks,array("' . $wp_plugin_prefix_name . '_' . $string->toVar($table['table-name']) . '")))||( in_array($screen->post_type,array("' . $wp_plugin_prefix_name . '_' . $string->toVar($table['table-name']) . '")))){' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_script("jquery-ui-datepicker");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_script("' . $wp_plugin_prefix_name . '-slider-access", "//cdn.jsdelivr.net/npm/jquery-ui-timepicker-addon@1.6.3/dist/jquery-ui-sliderAccess.min.js", array(),' . $wp_plugin_prefix_constant . '_VERSION,true);' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_script("' . $wp_plugin_prefix_name . '-timepicker", "//cdn.jsdelivr.net/npm/jquery-ui-timepicker-addon@1.6.3/dist/jquery-ui-timepicker-addon.min.js", array(),' . $wp_plugin_prefix_constant . '_VERSION,true);' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_script("' . $wp_plugin_prefix_name . '-tagsinput", "//cdn.jsdelivr.net/npm/jquery-tags-input@1.3.5/dist/jquery.tagsinput.min.js", array(),' . $wp_plugin_prefix_constant . '_VERSION,true);' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_script("' . $wp_plugin_prefix_name . '-main", ' . $wp_plugin_prefix_constant . '_URL . "assets/js/admin.js", array("jquery","thickbox"),' . $wp_plugin_prefix_constant . '_VERSION,true );' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
    }
    $code_php .= "\t" . '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    // TODO: WP-PLUGIN.PHP - ENQUEUE-STYLE
    $code_php .= "\t" . '/**' . "\r\n";
    $code_php .= "\t" . '* Registers the style' . "\r\n";
    $code_php .= "\t" . '* @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/' . "\r\n";
    $code_php .= "\t" . '* @param object $hooks' . "\r\n";
    $code_php .= "\t" . '* @access public' . "\r\n";
    $code_php .= "\t" . '* @return void' . "\r\n";
    $code_php .= "\t" . '**/' . "\r\n";
    $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_enqueue_styles($hooks)' . "\r\n";
    $code_php .= "\t" . '{' . "\r\n";
    $code_php .= "\t" . '' . "\r\n";
    $code_php .= "\t\t" . 'if (function_exists("get_current_screen")) {' . "\r\n";
    $code_php .= "\t\t\t" . '$screen = get_current_screen();' . "\r\n";
    $code_php .= "\t\t" . '}else{' . "\r\n";
    $code_php .= "\t\t\t" . '$screen = $hooks;' . "\r\n";
    $code_php .= "\t\t" . '}' . "\r\n";
    $code_php .= "\t" . '' . "\r\n";
    foreach ($tables as $table)
    {
        $code_php .= "\t\t" . '// limit page only ' . $string->toVar($table['table-name']) . '' . "\r\n";
        $code_php .= "\t\t" . 'if((in_array($hooks,array("' . $wp_plugin_prefix_name . '_' . $string->toVar($table['table-name']) . '")))||( in_array($screen->post_type,array("' . $wp_plugin_prefix_name . '_' . $string->toVar($table['table-name']) . '")))){' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_style("thickbox");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_media();' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_register_style("jquery-ui", "//code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.min.css");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_style("jquery-ui");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_register_style("jquery-timepicker", "//cdn.jsdelivr.net/npm/jquery-ui-timepicker-addon@1.6.3/dist/jquery-ui-timepicker-addon.min.css");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_style("jquery-timepicker");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_register_style("jquery-tagsinput", "//cdn.jsdelivr.net/npm/jquery-tags-input@1.3.5/dist/jquery.tagsinput.min.css");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_style("jquery-tagsinput");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_register_style("' . $wp_plugin_prefix_name . '-main", ' . $wp_plugin_prefix_constant . '_URL ."assets/css/admin.css");' . "\r\n";
        $code_php .= "\t\t\t" . 'wp_enqueue_style("' . $wp_plugin_prefix_name . '-main");' . "\r\n";
        $code_php .= "\t\t" . '}' . "\r\n";
    }
    $code_php .= "\t" . '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    // TODO: WP-PLUGIN.PHP - TEXTDOMAIN
    $code_php .= "\t" . '/**' . "\r\n";
    $code_php .= "\t" . '* Loads the plugin\'s translated strings' . "\r\n";
    $code_php .= "\t" . '* @link http://codex.wordpress.org/Function_Reference/load_plugin_textdomain' . "\r\n";
    $code_php .= "\t" . '* @access public' . "\r\n";
    $code_php .= "\t" . '* @return void' . "\r\n";
    $code_php .= "\t" . '**/' . "\r\n";
    $code_php .= "\t" . 'public function ' . $wp_plugin_prefix_name . '_textdomain()' . "\r\n";
    $code_php .= "\t" . '{' . "\r\n";
    $code_php .= "\t\t" . 'load_plugin_textdomain("' . $wp_plugin["app-prefix"] . '", false, ' . $wp_plugin_prefix_constant . '_DIR . "/languages");' . "\r\n";
    $code_php .= "\t" . '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    // TODO: WP-PLUGIN.PHP - ACTIVATION
    $code_php .= "\t" . '/**' . "\r\n";
    $code_php .= "\t" . '* Install Plugin' . "\r\n";
    $code_php .= "\t" . '* ' . "\r\n";
    $code_php .= "\t" . '* @access public' . "\r\n";
    $code_php .= "\t" . '* @return void' . "\r\n";
    $code_php .= "\t" . '**/' . "\r\n";
    $code_php .= "\t" . 'public static function ' . $wp_plugin_prefix_name . '_activation()' . "\r\n";
    $code_php .= "\t" . '{' . "\r\n";
    $code_php .= "\t\t" . '$default_option = array(' . "\r\n";
    $code_php .= "\t\t\t" . '"version" => ' . $wp_plugin_prefix_constant . '_VERSION' . "\r\n";
    $code_php .= "\t\t" . ');' . "\r\n";
    $code_php .= "\t\t" . 'update_option("' . $wp_plugin_prefix_name . '_option", $default_option);' . "\r\n";
    $code_php .= "\t" . '}' . "\r\n";
    // TODO: WP-PLUGIN.PHP - DEACTIVATION
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\t" . '/**' . "\r\n";
    $code_php .= "\t" . '* Un-install Plugin' . "\r\n";
    $code_php .= "\t" . '* ' . "\r\n";
    $code_php .= "\t" . '* @access public' . "\r\n";
    $code_php .= "\t" . '* @return void' . "\r\n";
    $code_php .= "\t" . '**/' . "\r\n";
    $code_php .= "\t" . 'public static function ' . $wp_plugin_prefix_name . '_deactivation()' . "\r\n";
    $code_php .= "\t" . '{' . "\r\n";
    $code_php .= "\t\t" . 'delete_option("' . $wp_plugin_prefix_name . '_option");' . "\r\n";
    $code_php .= "\t" . '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    $code_php .= '}' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";
    $code_php .= 'new ' . $wp_plugin_class_name . '();' . "\r\n";
    $code_php .= 'register_activation_hook(__FILE__, array("' . $wp_plugin_class_name . '", "' . $wp_plugin_prefix_name . '_activation"));' . "\r\n";
    $code_php .= 'register_deactivation_hook(__FILE__, array("' . $wp_plugin_class_name . '", "' . $wp_plugin_prefix_name . '_deactivation"));' . "\r\n";
    $code_php .= "\r\n";
    $code_php .= "\r\n";


    $code_js = null;
    $code_js .= "" . '(function($){' . "\r\n";
    // TODO: WP-PLUGIN.PHP - SAVE POST METABOX
    $code_js .= "\t" . '$("input[' . $wp_plugin_prefix_name . '-type=\'date\']").datepicker();' . "\r\n";
    $code_js .= "\t" . '$("input[' . $wp_plugin_prefix_name . '-type=\'time\']").timepicker();' . "\r\n";
    $code_js .= "\t" . '$("input[' . $wp_plugin_prefix_name . '-type=\'datetime\']").datetimepicker();' . "\r\n";
    $code_js .= "\t" . '$("input[' . $wp_plugin_prefix_name . '-type=\'tags\']").tagsInput();' . "\r\n";
    $code_js .= "\t" . '$("*[' . $wp_plugin_prefix_name . '-type=\'delete\']").click(function(){' . "\r\n";
    $code_js .= "\t\t" . 'var target = $(this).attr("' . $wp_plugin_prefix_name . '-target");' . "\r\n";
    $code_js .= "\t\t" . '$(target).replaceWith("");' . "\r\n";
    $code_js .= "\t" . '});' . "\r\n";

    $code_js .= "\t" . '$("*[' . $wp_plugin_prefix_name . '-type=\'media\']").click(function(){' . "\r\n";
    $code_js .= "\t\t" . 'window.images_picker = $(this).attr("' . $wp_plugin_prefix_name . '-target");' . "\r\n";
    $code_js .= "\t\t" . 'if(app_images) {' . "\r\n";
    $code_js .= "\t\t\t" . 'app_images.open();' . "\r\n";
    $code_js .= "\t\t\t" . 'return;' . "\r\n";
    $code_js .= "\t\t" . '}' . "\r\n";
    $code_js .= "\t\t" . 'var app_images = wp.media({' . "\r\n";
    $code_js .= "\t\t\t\t" . 'title: "Select or Upload Media Of Your Chosen Persuasion",' . "\r\n";
    $code_js .= "\t\t\t\t" . 'button: {' . "\r\n";
    $code_js .= "\t\t\t\t\t" . 'text: "Use this media"' . "\r\n";
    $code_js .= "\t\t\t\t" . '},' . "\r\n";
    $code_js .= "\t\t\t\t" . 'multiple: false' . "\r\n";
    $code_js .= "\t\t" . '});' . "\r\n";
    $code_js .= "\t\t" . 'app_images.on("select",function(){' . "\r\n";
    $code_js .= "\t\t\t" . 'var attachment = app_images.state().get("selection").first().toJSON();' . "\r\n";
    $code_js .= "\t\t\t" . 'var url = attachment.url ;' . "\r\n";
    $code_js .= "\t\t" . '$(window.images_picker).val(url);' . "\r\n";
    $code_js .= "\t\t" . '});' . "\r\n";
    $code_js .= "\t\t" . 'app_images.open();' . "\r\n";
    $code_js .= "\t\t" . 'return false;' . "\r\n";
    $code_js .= "\t" . '});' . "\r\n";

    $code_js .= "" . '})(jQuery);' . "\r\n";

    // TODO: CODE CSS
    $code_css = null;
    $code_css .= "" . '.input-' . $wp_plugin_prefix_name . '{border-radius:0 !important;}' . "\r\n";
    $code_css .= "" . '.box-' . $wp_plugin_prefix_name . ' div.tagsinput{width: 100% !important;border: 1px solid #7e8993 !important; height: auto !important;min-height: auto !important;}' . "\r\n";
    $code_css .= "" . '.box-' . $wp_plugin_prefix_name . ' .button{border-radius: 0 !important}' . "\r\n";
    $code_css .= "" . '.box-' . $wp_plugin_prefix_name . ' .dashicons{vertical-align: baseline !important;font-size: inherit !important;}' . "\r\n";

    $rest_api_url = null;

    // TODO: REST-API-URL
    $rest_api_url = '';
    foreach ($tables as $table)
    {
        $new_colums = $table['table-cols'];

        $table_link = str_replace('_', '-', $table['table-name']);
        $table_var = $string->toVar($table['table-name']);

        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $rest_api_url .= "" . '<a target="_blank" href="' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '"><h3 class="title">List ' . $table['table-plural-name'] . '</h3></a>' . "";
        $rest_api_url .= "" . '<pre>GET ' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '</pre>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<h4>Parameters</h4>' . "";
        $rest_api_url .= "" . '<table class="table table-striped">' . "";

        $rest_api_url .= "" . '<thead>' . "";
        $rest_api_url .= "" . '<tr>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Parameter' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Value' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Description' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Data Type' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '</tr>' . "";
        $rest_api_url .= "" . '</thead>' . "";

        $rest_api_url .= "" . '<tbody>' . "";

        $val_col = array();
        $t = 0;
        foreach ($new_colums as $col)
        {
            $val_col[] = "<code>" . strtolower(str_replace('_', '-', $col['variable'])) . "</code>";
            $t++;
        }


        $rest_api_url .= "" . '<tr>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'order' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . '<code>asc</code> | <code>asc</code>' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'Order sort attribute ascending or descending' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'String' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '</tr>' . "";


        $rest_api_url .= "" . '</tbody>' . "";
        $rest_api_url .= "" . '</table>' . "";

        $rest_api_url .= "" . '<h4>Example</h4>' . "";
        $rest_api_url .= "" . '<pre>' . "";
        $rest_api_url .= "- " . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '' . "\r\n";
        $rest_api_url .= "- " . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '?order=desc' . "\r\n";
        $rest_api_url .= "- " . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '' . "";

        $rest_api_url .= "" . '</pre>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<a target="_blank" href="' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '/1"><h3 class="title">Retrieve a ' . $table['table-singular-name'] . '</h3></a>' . "";
        $rest_api_url .= "" . '<pre>GET ' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_var . '/1</pre>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<h4>Parameters</h4>' . "";
        $rest_api_url .= "" . '<table class="table table-striped">' . "";

        $rest_api_url .= "" . '<thead>' . "";
        $rest_api_url .= "" . '<tr>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Parameter' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Value' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Description' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '<th>' . "";
        $rest_api_url .= "" . 'Data Type' . "";
        $rest_api_url .= "" . '</th>' . "";

        $rest_api_url .= "" . '</tr>' . "";
        $rest_api_url .= "" . '</thead>' . "";

        $rest_api_url .= "" . '<tbody>' . "";

        $rest_api_url .= "" . '<tr>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . str_replace('_', '-', $col_id) . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . '<code></code>' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'Unique identifier for the object' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'Integer' . "";
        $rest_api_url .= "" . '</td>' . "";

        $rest_api_url .= "" . '</tr>' . "";

        $rest_api_url .= "" . '</tbody>' . "";
        $rest_api_url .= "" . '</table>' . "";
        $rest_api_url .= "" . '<h4>Example</h4>' . "";
        $rest_api_url .= "" . '<pre>' . "";
        $rest_api_url .= "- " . '' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_link . '/1' . "\r\n";
        $rest_api_url .= "- " . '' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_' . $table_link . '/2' . "\r\n";

        $rest_api_url .= "" . '</pre>' . "";

        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";


        if (!isset($table['form-method']))
        {
            $table['form-method'] = 'none';
        }


        if (($table['form-method'] == 'post') || ($table['form-method'] == 'get') || ($table['form-method'] == 'put'))
        {

            $rest_api_url .= "" . '<a target="_blank" href="' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_form_' . $table_link . '"><h3 class="title">Send a request for The ' . $table['table-plural-name'] . '</h3></a>' . "";

            $rest_api_url .= "" . '<pre>' . "";
            $rest_api_url .= "" . strtoupper($table['form-method']) . ' ' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_form_' . $table_link . '' . "\r\n";
            $rest_api_url .= "" . '</pre>' . "";

            $rest_api_url .= "" . '<h4>Parameters</h4>' . "";
            $rest_api_url .= "" . '<table class="table table-striped">' . "";
            $rest_api_url .= "" . '<thead>' . "";
            $rest_api_url .= "" . '<tr>' . "";
            $rest_api_url .= "" . '<th>' . "";
            $rest_api_url .= "" . 'Parameter' . "";
            $rest_api_url .= "" . '</th>' . "";
            $rest_api_url .= "" . '<th>' . "";
            $rest_api_url .= "" . 'Default' . "";
            $rest_api_url .= "" . '</th>' . "";
            $rest_api_url .= "" . '<th>' . "";
            $rest_api_url .= "" . 'Data Type' . "";
            $rest_api_url .= "" . '</th>' . "";
            $rest_api_url .= "" . '</tr>' . "";
            $rest_api_url .= "" . '</thead>' . "";
            $rest_api_url .= "" . '<tbody>' . "";
            $postdata = array();
            foreach ($new_colums as $col)
            {
                if ($col['json_input'] == true)
                {
                    $col_link = str_replace('_', '-', $col['variable']);

                    // TODO: HTML DOCS - COLUMN TYPE

                    switch ($col['type'])
                    {
                        case 'id':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'Integer' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'image':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'thumbnail':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'file':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;

                        case 'number-fixed-length':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;

                        case 'varchar':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'select-table':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'tinytext':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'text':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'longtext':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'number':
                            $postdata[$col_link] = rand(100, 10000);
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'Integer' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'date':
                            $postdata[$col_link] = date('Y-m-d');
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'time':
                            $postdata[$col_link] = date('H:i:s');
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'datetime':
                            $postdata[$col_link] = date('Y-m-d H:i:s');
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'boolean':
                            $postdata[$col_link] = '1';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>true</code> | <code>false</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'Boolean' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'select':
                            $postdata[$col_link] = 'yourdata';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'url':
                            $postdata[$col_link] = 'http://ihsana.com/';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'email':
                            $postdata[$col_link] = 'info@ihsana.com';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                        case 'phone':
                            $postdata[$col_link] = '081223434343';
                            $rest_api_url .= "" . '<tr>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . $col_link . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '<td>' . "";
                            $rest_api_url .= "" . 'String' . "";
                            $rest_api_url .= "" . '</td>' . "";
                            $rest_api_url .= "" . '</tr>' . "";
                            break;
                    }
                }
            }
            $rest_api_url .= "" . '</tbody>' . "";
            $rest_api_url .= "" . '</table>' . "";

            $rest_api_url .= "" . '<h4>Example</h4>' . "";
            $http_build_query = http_build_query($postdata, '', '&amp;');
            switch (strtolower($table['form-method']))
            {
                case 'post':
                    $rest_api_url .= "<pre>" . 'curl -H "Content-type: application/x-www-form-urlencoded" -X POST -d "' . $http_build_query . '" "' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_form_' . $table_link . '"</pre>';
                    break;
                case 'get':
                    $rest_api_url .= "<pre>" . 'curl "' . $wp_plugin['wp-url'] . '/wp-json/wp/v2/' . $wp_plugin['wp-prefix'] . '_form_' . $table_link . '/?' . $http_build_query . '"</pre>';
                    break;
                case 'put':
                    break;
            }
        }


        $rest_api_url .= "" . '<hr>' . "";
    }

    // TODO: HTML DOCS
    $html_docs = null;
    $html_docs .= "" . '<!DOCTYPE html>' . "";
    $html_docs .= "" . '<html lang="en">' . "";
    $html_docs .= "" . '<head>' . "";
    $html_docs .= "" . '<meta charset="utf-8">' . "";
    $html_docs .= "" . '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "";
    $html_docs .= "" . '<meta name="viewport" content="width=device-width, initial-scale=1">' . "";
    $html_docs .= "" . '<title>' . $wp_plugin['app-name'] . ' - RESTful API</title>' . "";
    $html_docs .= "" . '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">' . "\r\n";
    $html_docs .= "" . '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton|Staatliches|Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">' . "\r\n";
    $html_docs .= "" . '<meta name="generator" content="IMA-BuildeRz v' . JSM_VERSION . '" />' . "";
    $html_docs .= "" . '<style type="text/css">' . "";
    $html_docs .= "" . 'pre{border-radius:0}' . "";
    $html_docs .= "" . 'h1,h2,h3,h4,h5{font-family: anton;}' . "";
    $html_docs .= "" . '.blog-footer {padding: 40px 0;color: #999;text-align: center;background-color: #f9f9f9;border-top: 1px solid #e5e5e5;}' . "";
    $html_docs .= "" . '.blog-masthead {background-color: #428bca;box-shadow: inset 0 -2px 5px rgba(0,0,0,.1);}' . "";
    $html_docs .= "" . '.blog-nav-item {position: relative;display: inline-block; padding: 10px;font-weight: 500;color: #cdddeb;}' . "";
    $html_docs .= "" . '.blog-nav-item:hover,.blog-nav-item:focus {color: #fff;text-decoration: none;}' . "";
    $html_docs .= "" . '.blog-nav .active {color: #fff;}' . "";
    $html_docs .= "" . '.blog-nav .active:after {position: absolute;bottom: 0;left: 50%;width: 0;height: 0;margin-left: -5px;vertical-align: middle;content: " "; border-right:  5px solid transparent;border-bottom: 5px solid;border-left:   5px solid transparent;}' . "";
    $html_docs .= "" . '.blog-header {padding-top: 20px; padding-bottom: 20px;}' . "";
    $html_docs .= "" . '.blog-title {margin-top: 30px;margin-bottom: 0;font-size:42px;font-weight: normal;}' . "";
    $html_docs .= "" . '.blog-description {font-size: 20px; color: #999;}' . "";
    $html_docs .= "" . '</style>' . "";
    $html_docs .= "" . '</head>' . "";
    $html_docs .= "" . '<body>' . "";
    // TODO: HTML DOCS - BODY
    $html_docs .= "" . '<div class="blog-masthead">' . "";
    $html_docs .= "" . '<div class="container">' . "";
    $html_docs .= "" . '<nav class="blog-nav">' . "";
    $html_docs .= "" . '<a class="blog-nav-item active" href="#" target="_blank">Home</a>' . "";
    $html_docs .= "" . '<a class="blog-nav-item" href="' . $wp_plugin['wp-url'] . '/wp-json/" target="_blank">RESTful API</a>' . "";
    $html_docs .= "" . '<a class="blog-nav-item" href="' . $wp_plugin['wp-url'] . '/wp-admin/" target="_blank">Admin</a>' . "";
    $html_docs .= "" . '</nav>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '<div class="container">' . "";
    $html_docs .= "" . '<div class="blog-header">' . "";
    $html_docs .= "" . '<h1 class="blog-title">' . $wp_plugin['app-name'] . ' - RESTful API</h1>' . "";
    $html_docs .= "" . '<p class="lead blog-description">' . $_SESSION['CURRENT_APP']['apps']['app-description'] . '</p>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= $rest_api_url;
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '<div class="blog-footer">' . "";
    $html_docs .= "" . '<br><br><p>Built for <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['app-name'] . '</a> by <a href="mailto:' . $_SESSION['CURRENT_APP']['apps']['author-email'] . '">@' . $_SESSION['CURRENT_APP']['apps']['author-name'] . '</a>.</p><p><a href="#">Back to top</a></p>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '</body>' . "";
    $html_docs .= "" . '</html>' . "";

    // TODO: DUMMY
    $dummy_xml = null;

    $dummy_xml .= "" . '<rss version="2.0"' . "\r\n";
    $dummy_xml .= "\t" . 'xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"' . "\r\n";
    $dummy_xml .= "\t" . 'xmlns:content="http://purl.org/rss/1.0/modules/content/"' . "\r\n";
    $dummy_xml .= "\t" . 'xmlns:wfw="http://wellformedweb.org/CommentAPI/"' . "\r\n";
    $dummy_xml .= "\t" . 'xmlns:dc="http://purl.org/dc/elements/1.1/"' . "\r\n";
    $dummy_xml .= "\t" . 'xmlns:wp="http://wordpress.org/export/1.2/"' . "\r\n";
    $dummy_xml .= "\t" . '>' . "\r\n";
    $dummy_xml .= "\t" . '<channel>' . "\r\n";
    $dummy_xml .= "\t\t" . '<wp:wxr_version>1.2</wp:wxr_version>' . "\r\n";
    foreach ($tables as $table)
    {
        for ($z = 0; $z < 100; $z++)
        {

            $dummy_xml .= "\t\t" . '<item>' . "\r\n";
            $dummy_xml .= "\t\t\t" . '<title><![CDATA[' . ucwords($lorem->words(3)) . ']]></title>' . "\r\n";
            $dummy_xml .= "\t\t\t" . '<wp:post_type><![CDATA[' . $wp_plugin_prefix_name . '_' . $string->toVar($table["table-name"]) . ']]></wp:post_type>' . "\r\n";
            $dummy_xml .= "\t\t\t" . '<wp:comment_status><![CDATA[closed]]></wp:comment_status>' . "\r\n";
            $dummy_xml .= "\t\t\t" . '<wp:ping_status><![CDATA[closed]]></wp:ping_status>' . "\r\n";
            $dummy_xml .= "\t\t\t" . '<wp:status><![CDATA[publish]]></wp:status>' . "\r\n";
            $dummy_xml .= "\t\t\t" . '<dc:creator><![CDATA[root@localhost]]></dc:creator>' . "\r\n";
            // TODO: DUMMY - COLUMN TYPE --|-- OK
            $new_colums = $table['table-cols'];
            foreach ($new_colums as $col)
            {
                $text = null;
                switch ($col['type'])
                {
                    case 'id':

                        break;
                    case 'varchar':
                        $text = ucwords($lorem->words(3));

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                    case 'number-fixed-length':
                        $text = '00' . rand(10, 99);

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";
                        break;
                    case 'multi-text':
                        $text = array();
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text[] = ucwords($lorem->words(1));
                        $text = json_encode($text);

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'multi-images':
                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/sandwich.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/espresso.jpg';
                        $text = json_encode($img_cdn);
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'image':

                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/sandwich.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/espresso.jpg';

                        $text = $img_cdn[rand(0, count($img_cdn) - 1)];
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'thumbnail':
                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentytwenty/1.1/assets/images/2020-square-1.png?' . time();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentytwenty/1.1/assets/images/2020-square-2.png?' . time();
                        $text = $img_cdn[rand(0, count($img_cdn) - 1)];
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'file':
                        $text = "https://placehold.it/80x80";

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'select-table':
                        $text = rand(5000, 5010); //"'" . ucwords($lorem->words(3)) . "'";
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'tinytext':
                        $text = ucwords($lorem->words(16));
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'text':
                        $text = ucwords($lorem->words(36));
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'longtext':
                        $text = null;
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $text .= $lorem->sentences(1, 'blockquote');
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'number':
                        $text = rand(10, 999999);

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";
                        break;
                    case 'date':
                        $text = date('Y-m-d', (time() + rand(1000000, 9999999)));

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'time':
                        $text = date('H:i:s', (time() + rand(1000000, 9999999)));

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'datetime':
                        $text = date('Y-m-d H:i:s', (time() + rand(1000000, 9999999)));

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'boolean':
                        $text = rand(0, 1);

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'select':
                        $text = $col['default'];

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'url':
                        $text = 'https://' . strtolower($lorem->words(1)) . '.com';

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'email':
                        $text = strtolower($lorem->words(1)) . "@" . strtolower($lorem->words(1)) . ".com";

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                    case 'phone':
                        $text = '0' . rand(812000000, 818900000);

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $col['variable'] . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $text . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";

                        break;
                }
                $dummy_xml .= "\t\t\t" . '' . "\r\n";
            }

            $dummy_xml .= "\t\t" . '</item>' . "\r\n";
        }
    }
    $dummy_xml .= "\t" . '</channel>' . "\r\n";
    $dummy_xml .= "" . '</rss>' . "\r\n";

    if (isset($_GET['exec-wp-plugin']))
    {
        if ($wp_plugin["live-test"] !== '')
        {
            if (!file_exists($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/languages/'))
            {
                @mkdir($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/languages/', 0777, true);
            }
            if (!file_exists($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/assets/js/'))
            {
                @mkdir($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/assets/js/', 0777, true);
            }
            if (!file_exists($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/assets/css/'))
            {
                @mkdir($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/assets/css/', 0777, true);
            }
            file_put_contents($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/api.html', $html_docs);
            file_put_contents($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/readme.txt', $code_readme);
            file_put_contents($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/' . $wp_plugin['app-prefix'] . '.php', $code_php);
            file_put_contents($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/assets/js/admin.js', $code_js);
            file_put_contents($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/assets/css/admin.css', $code_css);
            file_put_contents($wp_plugin["live-test"] . '/wp-content/plugins/' . $wp_plugin["app-prefix"] . '/dummy.xml', $dummy_xml);

            $_SESSION['TOOL_ALERT']['type'] = 'success';
            $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
            $_SESSION['TOOL_ALERT']['message'] = __e('WP Plugin created successfully');
            header('Location: ./?p=wp-plugin-generator&hash=' . time());
        } else
        {
            $_SESSION['TOOL_ALERT']['type'] = 'danger';
            $_SESSION['TOOL_ALERT']['title'] = __e('Error');
            $_SESSION['TOOL_ALERT']['message'] = __e('Error creating WP Plugin, please do it manually by downloading it');
        }
    }

    if (isset($_GET['download']))
    {
        $dir_output = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/backend/wp/';
        if (!is_dir($dir_output))
        {
            @mkdir($dir_output, 0777, true);
        }
        $file_zip = $dir_output . '/' . $wp_plugin['app-prefix'] . '.zip';
        if (file_exists($file_zip))
        {
            @unlink($file_zip);
        }
        $zip = new ZipArchive();
        if ($zip->open($file_zip, ZIPARCHIVE::CREATE) !== true)
        {
            exit("cannot open <$filezip>\n");
        }

        $zip->addFromString('index.php', '<?php // Silence is golden ?>');
        $zip->addFromString('languages/index.php', '<?php // Silence is golden ?>');
        $zip->addFromString('assets/css/index.php', '<?php // Silence is golden ?>');
        $zip->addFromString('assets/js/index.php', '<?php // Silence is golden ?>');
        $zip->addFromString('assets/js/admin.js', $code_js);
        $zip->addFromString('assets/css/admin.css', $code_css);
        $zip->addFromString('readme.txt', $code_readme);
        $zip->addFromString('api.html', $html_docs);
        $zip->addFromString('dummy.xml', $dummy_xml);
        $zip->addFromString('' . $wp_plugin['app-prefix'] . '.php', $code_php);
        $zip->close();

        $page_js = 'window.location = "./outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/backend/wp/' . $wp_plugin['app-prefix'] . '.zip?' . time() . '";';
    }


}
$content .= $notice_backend;
$content .= '<form action="" method="post">';
$content .= '<div class="row">';
$content .= '<div class="col-md-6">';


// TODO: HTML - FORM SETTING
$content .= '<div class="box box-info">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('General') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Plugin Name') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="wp_plugin[app-name]" class="form-control" value="' . $wp_plugin['app-name'] . '" placeholder="Plugin Name"/>';
$content .= '<p class="help-block">' . __e('A nice name, only allowed: a-z characters and space') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Plugin Description') . '</label>';
$content .= '<textarea ' . $disable_button_save . ' class="form-control" name="wp_plugin[app-description]" required>' . $wp_plugin['app-description'] . '</textarea>';
$content .= '<p class="help-block">' . __e('A brief description of this plugin') . '</p>';
$content .= '</div> ';

$content .= '<hr/> ';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Folder for Test') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="wp_plugin[live-test]" class="form-control" value="' . $wp_plugin['live-test'] . '" placeholder="D:\xampp\htdocs\mywp\"/>';
$content .= '<p class="help-block">' . __e('The folder to test your wordpress, leave it blank if you do not want to test') . '</p>';
$content .= '<p>' . __e('<span class="label label-danger">required</span> folder permissions: <code>chmod -R 777</code> or <code>write, read and executable</code>') . '</p>';

$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('WordPress URL') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="wp_plugin[wp-url]" class="form-control" value="' . htmlentities($wp_plugin['wp-url']) . '" placeholder="http://your-wp/" />';
$content .= '<p class="help-block">' . __e('Your wordpress url') . '</p>';
$content .= '</div> ';


$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a ' . $disable_button_save . '  class="btn btn btn-default btn-flat pull-right" href="./?p=wp-plugin-generator&exec-wp-plugin">' . __e('Test WP Plugin') . '</a>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="col-md-6">';
// TODO: HTML - FORM DATABASE
$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-gear"></i> ' . __e('Others') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('How to Install') . '</label>';
$content .= '<textarea ' . $disable_button_save . ' class="form-control" name="wp_plugin[installation]" >' . $wp_plugin['installation'] . '</textarea>';
$content .= '<p class="help-block">' . __e('How to installation your plugin') . '</p>';
$content .= '</div> ';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('Changelog') . '</label>';
$content .= '<textarea ' . $disable_button_save . ' class="form-control" name="wp_plugin[changelog]" >' . $wp_plugin['changelog'] . '</textarea>';
$content .= '<p class="help-block">' . __e('Changelog your plugin') . '</p>';
$content .= '</div> ';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-th"></i> ' . __e('Technical Guide') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . 'You can use WordPress translation files to change the language of this plugin. Use this plugin to edit it:' . '</p>';

$content .= '<a taget="_blank" href="https://wordpress.org/plugins/loco-translate/" target="_blank">Loco Translate</a>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';


$content .= '</form>';


if ($wp_plugin_available == true)
{
    $content .= '<div class="nav-tabs-custom">';
    $content .= '<ul class="nav nav-tabs">';
    $content .= '<li class="active"><a href="#tab_php_plugin" data-toggle="tab">PHP Code</a></li>';
    $content .= '<li><a href="#tab_readme_plugin" data-toggle="tab">Readme Code</a></li>';
    $content .= '<li><a href="#tab_js_plugin" data-toggle="tab">JS Code</a></li>';
    $content .= '<li><a href="#tab_css_plugin" data-toggle="tab">CSS Code</a></li>';
    $content .= '<li><a href="#tab_help_plugin" data-toggle="tab">URL and Parameter</a></li>';
    $content .= '<li><a href="#tab_sample_data" data-toggle="tab">' . __e('Sample Data') . '</a></li>';
    $content .= '</ul>';
    $content .= '<div class="tab-content">';

    $content .= '<div class="tab-pane active" id="tab_php_plugin">';
    $content .= '<div class="callout callout-default">' . __e('This is the main code for the plugin, it will be saved as:') . '<code>' . $wp_plugin['app-prefix'] . '.php</code></div>';
    $content .= '<textarea data-type="php">';
    $content .= htmlentities($code_php);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a target="_blank" href="?p=wp-plugin-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="tab_readme_plugin">';
    $content .= '<div class="callout callout-default">' . __e('To make your entry in the plugin browser most useful, each plugin should have a readme file named <code>readme.txt</code>') . '</div>';
    $content .= '<textarea data-type="php">';
    $content .= htmlentities($code_readme);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a target="_blank" href="?p=wp-plugin-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="tab_js_plugin">';
    $content .= '<div class="callout callout-default">' . __e('This is just the plugin user interface code') . '</div>';
    $content .= '<textarea data-type="ts">';
    $content .= htmlentities($code_js);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a target="_blank" href="?p=wp-plugin-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="tab_css_plugin">';
    $content .= '<div class="callout callout-default">' . __e('This is just the plugin user interface code') . '</div>';
    $content .= '<textarea data-type="scss">';
    $content .= htmlentities($code_css);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a target="_blank" href="?p=wp-plugin-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="tab_help_plugin">';
    $content .= '<div class="callout callout-default">' . __e('Here is the RESTful-API information and parameters that you can use.') . '</div>';
    $content .= ($rest_api_url);
    $content .= '<div class="tab-footer">';
    $content .= '<a target="_blank" href="?p=wp-plugin-generator&download=true" class="btn btn btn-primary btn-flat pull-left">' . __e('Download') . '</a>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="tab-pane" id="tab_sample_data">';
    $content .= '<div class="callout callout-default">Save with file name: <code>' . __e('dummy.xml') . '</code></div>';
    $content .= '<textarea data-type="html5">';
    $content .= htmlentities($dummy_xml);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a target="_blank" href="?p=wp-plugin-generator&download=true" class="btn btn btn-primary btn-flat pull-left">' . __e('Download') . '</a>';
    $content .= '</div>';
    $content .= '</div>';


    $content .= '</div><!-- ./tab-content -->';


    $content .= '</div><!-- ./nav-tabs-custom -->';
}

$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) WP Plugin Generator');
$template->page_desc = __e('Eazy create own wordpress plugin for a backend website for your apps');
$template->page_content = $content;

?>