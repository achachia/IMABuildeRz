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
$sql = $php_admin = $html_index = null;
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
$option_colors[] = 'blue';
$option_colors[] = 'yellow';
$option_colors[] = 'green';
$option_colors[] = 'purple';
$option_colors[] = 'red';
if (isset($_POST['submit']))
{
    if (isset($_POST['php_native']['onesignal_enable']))
    {
        $_POST['php_native']['onesignal_enable'] = true;
    } else
    {
        $_POST['php_native']['onesignal_enable'] = false;
    }

    if (isset($_POST['php_native']['db_backup']))
    {
        $_POST['php_native']['db_backup'] = true;
    } else
    {
        $_POST['php_native']['db_backup'] = false;
    }


    if (isset($_POST['php_native']['debugger_enable']))
    {
        $_POST['php_native']['debugger_enable'] = true;
    } else
    {
        $_POST['php_native']['debugger_enable'] = false;
    }

    if (isset($_POST['php_native']['api_protector_enable']))
    {
        $_POST['php_native']['api_protector_enable'] = true;
    } else
    {
        $_POST['php_native']['api_protector_enable'] = false;
    }

    if (isset($_POST['php_native']['gzip_enable']))
    {
        $_POST['php_native']['gzip_enable'] = true;
    } else
    {
        $_POST['php_native']['gzip_enable'] = false;
    }

    $_newPhpNative = $_POST['php_native'];
    $_SESSION['TOOL_ALERT']['type'] = 'success';
    $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
    $_SESSION['TOOL_ALERT']['message'] = __e('The PHP Native Generator settings has been successfully edited, click on Create Test Files to build the code.');
    $db->savePhpNative($_newPhpNative);
    $db->current();
    rebuild();
    header("Location: ./?p=php-native-generator");
}
$php_native = $db->getPhpNative();
$php_code_available = false;
if (isset($php_native['site_name']))
{
    $html_index = 'Silent is  golden';
    $php_code_available = true;
    $tables = $db->getTables();
    if (!isset($php_native['multiuser_enable']))
    {
        $php_native['multiuser_enable'] = false;
    }
    $sql_code = null;
    $sql_code .= "\r\n";
    $sql_code .= "\r\n-- DATE CREATED: " . date("d-m-Y H:i:s") . "" . "\r\n";
    $sql_code .= "\r\n-- CREATE DATABASE IF NOT EXISTS `" . $php_native['db_name'] . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
    $sql_code .= "\r\n-- USE `" . $php_native['db_name'] . "`;" . "\r\n";
    foreach ($tables as $table)
    {
        if (!isset($php_native['db_backup']))
        {
            $php_native['db_backup'] = false;
        }
        // TODO: SQL CODE -+- FINDING ID
        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $sql_code .= "\r\n";
        $sql_code .= "\r\n-- Backup " . $string->toSQL($table['table-name']) . " table";
        //CREATE TABLE new_table LIKE products
        $backup_name = $string->toSQL($table['table-name']) . '_backup_' . time();
        if ($php_native['db_backup'] == true)
        {
            $sql_code .= "\r\nCREATE TABLE IF NOT EXISTS `" . $backup_name . "` LIKE `" . $string->toSQL($table['table-name']) . "`;";
            $sql_code .= "\r\nINSERT INTO `" . $backup_name . "` SELECT * FROM `" . $string->toSQL($table['table-name']) . "`;";
        } else
        {
            $sql_code .= "\r\n-- CREATE TABLE IF NOT EXISTS `" . $backup_name . "` LIKE `" . $string->toSQL($table['table-name']) . "`;";
            $sql_code .= "\r\n-- INSERT INTO `" . $backup_name . "` SELECT * FROM `" . $string->toSQL($table['table-name']) . "`;";
        }
        $sql_code .= "\r\n";
        $sql_code .= "\r\n-- Delete " . $string->toSQL($table['table-name']) . " table";
        $sql_code .= "\r\nDROP TABLE IF EXISTS `" . $string->toSQL($table['table-name']) . "`;";
        $sql_code .= "\r\n";
        $sql_code .= "\r\n-- Create " . $string->toSQL($table['table-name']) . " table";
        $sql_code .= "\r\nCREATE TABLE IF NOT EXISTS `" . $string->toSQL($table['table-name']) . "` (";
        $new_colums = $table['table-cols'];
        foreach ($new_colums as $col)
        {
            // TODO: SQL CODE -+- COLUMN TYPE --+-- OK
            switch ($col['type'])
            {
                case 'id':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` int(11) NOT NULL AUTO_INCREMENT,";
                    break;
                case 'varchar':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` varchar(128) NOT NULL DEFAULT '',";
                    break;
                case 'number-fixed-length':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` varchar(256) NOT NULL DEFAULT '',";
                    break;

                case 'image':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` longtext NOT NULL,";
                    break;
                case 'file':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` longtext NOT NULL,";
                    break;
                case 'thumbnail':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` longtext NOT NULL,";
                    break;
                case 'select-table':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` varchar(128) NOT NULL DEFAULT '',";
                    break;
                case 'tinytext':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` text NOT NULL,";
                    break;
                case 'multi-images':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` text NOT NULL,";
                    break;
                case 'multi-text':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` text NOT NULL,";
                    break;

                case 'text':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` text NOT NULL,";
                    break;
                case 'longtext':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` longtext NOT NULL,";
                    break;
                case 'number':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` int(11) NOT NULL DEFAULT '0',";
                    break;
                case 'date':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` date NOT NULL DEFAULT '0000-00-00' ,";
                    break;
                case 'time':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` time NOT NULL DEFAULT '00:00:00',";
                    break;
                case 'datetime':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',";
                    break;
                case 'boolean':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` tinyint(1) NOT NULL DEFAULT '0',";
                    break;
                case 'select':
                    $opts = explode('|', $col['option']);
                    $new_opts = array();
                    foreach ($opts as $opt)
                    {
                        $new_opts[] = trim($opt);
                    }
                    $option_default = $new_opts[0];
                    foreach ($new_opts as $opt)
                    {
                        if ($opt == $col['default'])
                        {
                            $option_default = $opt;
                        }
                    }
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` enum('" . implode("','", $new_opts) . "') NOT NULL DEFAULT '" . htmlentities($option_default) . "',";
                    break;
                case 'url':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` text NOT NULL,";
                    break;
                case 'email':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` varchar(128) NOT NULL DEFAULT '',";
                    break;
                case 'phone':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` varchar(32) NOT NULL DEFAULT '',";
                    break;
                case 'blob':
                    $sql_code .= "\r\n\t`" . $string->toSQL($col['variable']) . "` blob NOT NULL,";
                    break;

            }
        }
        $sql_code .= "\r\n\tPRIMARY KEY (`" . $col_id . "`)";
        $sql_code .= "\r\n ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        $sql_code .= "\r\n\r\n" . "\r\n";
    }


    $sql_code .= "\r\n-- Delete users table";
    $sql_code .= "\r\nDROP TABLE IF EXISTS `users`;";
    $sql_code .= "\r\n";
    $sql_code .= "\r\n-- Create users table";
    $sql_code .= "\r\nCREATE TABLE IF NOT EXISTS `users` (";
    $sql_code .= "\r\n\t`user_id` int(11) NOT NULL AUTO_INCREMENT,";
    $sql_code .= "\r\n\t`user_name` varchar(32) NOT NULL,";
    $sql_code .= "\r\n\t`user_birthday` date NOT NULL DEFAULT '0000-00-00',";
    $sql_code .= "\r\n\t`user_first_name` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_last_name` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_company` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_email` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_website` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_level` ENUM('admin','user') NOT NULL DEFAULT 'user',";
    $sql_code .= "\r\n\t`user_password` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_token` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_address_1` varchar(256) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_address_2` varchar(256) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_city` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_state` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_postcode` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_country` varchar(128) NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_phone` text NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_note` text NOT NULL DEFAULT '',";
    $sql_code .= "\r\n\t`user_expired` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',";
    $sql_code .= "\r\n\t`user_status` ENUM('banned','active','pending') NOT NULL DEFAULT 'pending',";
    $sql_code .= "\r\n\tPRIMARY KEY (`user_id`)";
    $sql_code .= "\r\n) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $sql_code .= "\r\n";
    $sql_code .= "\r\n-- Insert default administrator user";
    $sql_code .= "\r\nINSERT INTO `users` (`user_id` ,`user_name`,`user_birthday`,`user_first_name`,`user_last_name`,`user_company` ,`user_email` ,`user_website`, `user_level` ,`user_password`,`user_token`,`user_address_1`,`user_address_2`,`user_city`,`user_state`,`user_postcode`,`user_country`,`user_phone`,`user_note`,`user_expired`,`user_status`) VALUES";

    if ($php_native['multiuser_enable'] == true)
    {
        $sql_code .= "\r\n(4 ,'jefri ','1990-03-30','Jefry','Anaski','','user1@test.com','' , 'user', '" . sha1("imabuilder123456") . "','','Jl. Simpang IV - Manggopoh','Silambau - Kinali','Pasaman Barat','Sumatera Barat','26567','Indonesia','628123456789','','" . date('Y-m-d H:i:s') . "','active'),";
        $sql_code .= "\r\n(3 ,'riziq','1995-03-30','Riziq','','','user2@test.com','' , 'user', '" . sha1("imabuilder123456") . "','','','','','','','','628123456789','','" . date('Y-m-d H:i:s') . "','pending'),";
        $sql_code .= "\r\n(2 ,'zikran','1965-03-30','Zikran','Marwan','','user3@test.com','' , 'user', '" . sha1("imabuilder123456") . "','','','','','','','','','Violate the rules','0000-00-00 00:00:00','banned'),";
    }
    $sql_code .= "\r\n(1 , '" . $string->toFileName(strtolower($php_native['user_name'])) . "','1990-03-30','" . addslashes(ucwords($php_native['user_name'])) . "', '','', '" . $php_native['user_email'] . "','" . $php_native['user_website'] . "' , 'admin', '" . sha1("imabuilder" . $php_native['user_password']) . "','','','','','','','','','','0000-00-00 00:00:00','active');";

    $sql_code .= "\r\n";
    // TODO: SQL CODE EXAMPLE
    $sql_example_code = null;

    $sql_example_code .= "\r\n-- DATE CREATED: " . date("d-m-Y H:i:s") . "" . "\r\n";
    foreach ($tables as $table)
    {
        $sql_example_code .= "" . "\r\n";
        $sql_example_code .= "-- Example data " . $string->toSQL($table['table-name']) . "" . "\r\n";
        $new_colums = $table['table-cols'];
        $insert_cols = array();
        foreach ($new_colums as $col)
        {
            $insert_cols[] = "`" . $string->toSQL($col['variable']) . "`";
        }
        $sql_example_code .= "INSERT INTO `" . $string->toSQL($table['table-name']) . "` (" . implode(',', $insert_cols) . ") VALUES" . "\r\n";
        $sql_row_example = array();


        for ($i = 0; $i < rand(20, 50); $i++)
        {
            $sql_column_example = $sql_column = array();
            // TODO: SQL CODE EXAMPLE -+- COLUMN TYPE --|-- OK
            foreach ($new_colums as $col)
            {
                switch ($col['type'])
                {
                    case 'id':
                        $sql_column[] = "NULL";
                        break;
                    case 'varchar':
                        $sql_column[] = "'" . ucwords($lorem->words(3)) . "'";
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
                        $sql_column[] = "'" . json_encode($text) . "'";
                        break;
                    case 'multi-images':
                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/sandwich.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/espresso.jpg';
                        $sql_column[] = "'" . json_encode($img_cdn) . "'";
                        break;
                    case 'image':

                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/sandwich.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg';
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/espresso.jpg';

                        $sql_column[] = "'" . $img_cdn[rand(0, count($img_cdn) - 1)] . "'";
                        break;
                    case 'thumbnail':
                        $img_cdn = array();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentytwenty/1.1/assets/images/2020-square-1.png?' . time();
                        $img_cdn[] = 'https://cdn.jsdelivr.net/wp/themes/twentytwenty/1.1/assets/images/2020-square-2.png?' . time();
                        $sql_column[] = "'" . $img_cdn[rand(0, count($img_cdn) - 1)] . "'";
                        //$sql_column[] = "'https://placehold.it/80x80'";
                        break;
                    case 'file':
                        $sql_column[] = "'https://placehold.it/80x80'";
                        break;
                    case 'select-table':
                        $sql_column[] = rand(1, 10); //"'" . ucwords($lorem->words(3)) . "'";
                        break;
                    case 'tinytext':
                        $sql_column[] = "'" . ucwords($lorem->words(16)) . "'";
                        break;
                    case 'text':
                        $sql_column[] = "'" . ucwords($lorem->words(36)) . "'";
                        break;
                    case 'longtext':
                        $text = null;
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $text .= $lorem->words(rand(1, 3), 'h3');
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $text .= $lorem->words(rand(1, 3), 'h4');
                        $text .= $lorem->sentences(1, 'blockquote');
                        $text .= $lorem->sentences(rand(1, 3), 'p');
                        $sql_column[] = "'" . $text . "'";
                        break;
                    case 'number':
                        $sql_column[] = rand(10, 999999);
                        break;

                    case 'number-fixed-length':
                        $sql_column[] = "'00" . rand(10, 99) . "'";
                        break;

                    case 'date':
                        $sql_column[] = "'" . date('Y-m-d', (time() + rand(1000000, 9999999))) . "'";
                        break;
                    case 'time':
                        $sql_column[] = "'" . date('H:i:s', (time() + rand(1000000, 9999999))) . "'";
                        break;
                    case 'datetime':
                        $sql_column[] = "'" . date('Y-m-d H:i:s', (time() + rand(1000000, 9999999))) . "'";
                        break;
                    case 'boolean':
                        $sql_column[] = rand(0, 1);
                        break;
                    case 'select':

                        $new_vals = array();
                        if ($col['option'] != '')
                        {
                            $vals = explode("|", $col['option']);
                            foreach ($vals as $val)
                            {
                                $new_vals[] = $val;
                            }
                            $rand_id = rand(0, (count($new_vals) - 1));

                            $sql_column[] = "'" . $new_vals[$rand_id] . "'";
                        } else
                        {
                            $sql_column[] = "'" . $col['default'] . "'";
                        }

                        break;
                    case 'url':
                        $sql_column[] = "'https://" . strtolower($lorem->words(1)) . ".com'";
                        break;
                    case 'email':
                        $sql_column[] = "'" . strtolower($lorem->words(1)) . "@" . strtolower($lorem->words(1)) . ".com'";
                        break;
                    case 'phone':
                        $sql_column[] = "'0" . rand(812000000, 818900000) . "'";
                        break;
                    case 'blob':
                        $sql_column[] = "''";
                        break;
                }
            }
            $sql_row_example[] = '(' . implode(',', $sql_column) . ')';
        }
        $sql_example_code .= implode(",\r\n", $sql_row_example) . ";";
        $sql_example_code .= "\r\n\r\n";
    }
    // TODO: PHP CODE
    if (!isset($php_native['php_timezone']))
    {
        $php_native['php_timezone'] = 'Asia/Jakarta';
    }
    $php_admin = null;
    $php_admin .= '<?php' . "\r\n\r";
    $php_admin .= "/**\r\n";
    $php_admin .= " * @author " . $_SESSION['CURRENT_APP']['apps']['author-name'] . " <" . $_SESSION['CURRENT_APP']['apps']['author-email'] . ">\r\n";
    $php_admin .= " * @copyright " . $_SESSION['CURRENT_APP']['apps']['author-organization'] . " " . date("Y") . "\r\n";
    $php_admin .= " * @package " . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . "\r\n";
    $php_admin .= " * @created " . date("d-m-Y H:i:s") . "\r\n";
    $php_admin .= " * \r\n";
    $php_admin .= " * \r\n";
    $php_admin .= " * Created using IMA BuildeRz v3\r\n";
    $php_admin .= " */\r\n";


    $php_admin .= "\r\n";
    $php_admin .= "\r\n";
    $php_admin .= "/** site **/" . "\r\n";
    $php_admin .= "" . '$config["app-name"]' . "\t\t\t" . '= "' . $php_native['site_name'] . '" ; //Write the name of your website' . "\r\n";
    $php_admin .= "" . '$config["app-desc"]' . "\t\t\t" . '= "' . $_SESSION['CURRENT_APP']['apps']['app-description'] . '" ; //Write a brief description of your website' . "\r\n";
    $php_admin .= "" . '$config["utf8"]' . "\t\t\t\t" . '= true; ' . "\r\n";
    $php_admin .= "" . '$config["background"]' . "\t\t" . '= "' . $php_native['site_bg'] . '"; ' . "\r\n";
    $php_admin .= "" . '$config["logo"]' . "\t\t" . '= "' . $php_native['site_logo'] . '"; ' . "\r\n";
    $php_admin .= "" . '$config["timezone"]' . "\t\t" . '= "' . $php_native['php_timezone'] . '" ; // check this site: http://php.net/manual/en/timezones.php' . "\r\n";
    $php_admin .= "" . '$config["color"]' . "\t\t\t" . '= "' . $php_native['site_color'] . '"; ' . "\r\n";


    if ($php_native['debugger_enable'] == true)
    {
        $php_admin .= "" . '$config["debug"]' . "\t\t\t" . '= true; ' . "\r\n";
    } else
    {
        $php_admin .= "" . '$config["debug"]' . "\t\t\t" . '= false; ' . "\r\n";
    }


    if ($php_native['gzip_enable'] == true)
    {
        $php_admin .= "" . '$config["gzip"]' . "\t\t\t" . '= true; //compressed page ' . "\r\n";
    } else
    {
        $php_admin .= "" . '$config["gzip"]' . "\t\t\t" . '= false; //compressed page ' . "\r\n";
    }


    $php_admin .= "\r\n";
    $php_admin .= "/** mysql **/" . "\r\n";
    $php_admin .= "" . '$config["db_host"]' . "\t\t\t\t" . '= "' . $php_native['db_host'] . '" ; //host' . "\r\n";
    $php_admin .= "" . '$config["db_user"]' . "\t\t\t\t" . '= "' . $php_native['db_user'] . '" ; //Username SQL' . "\r\n";
    $php_admin .= "" . '$config["db_pwd"]' . "\t\t\t\t" . '= "' . $php_native['db_pwd'] . '" ; //Password SQL' . "\r\n";
    $php_admin .= "" . '$config["db_name"]' . "\t\t\t" . '= "' . $php_native['db_name'] . '" ; //Database' . "\r\n";
    if (!isset($php_native['onesignal_enable']))
    {
        $php_native['onesignal_enable'] = false;
    }
    if ($php_native['onesignal_enable'] == true)
    {
        $php_admin .= "\r\n";
        $php_admin .= "/** onesignal **/" . "\r\n";
        $php_admin .= "" . '$config["onesignal_app_id"]' . "\t\t\t\t" . '= "' . $php_native['onesignal_app_id'] . '" ; //Your OneSignal AppId, available in OneSignal https://documentation.onesignal.com/docs/generate-a-google-server-api-key' . "\r\n";
        $php_admin .= "" . '$config["onesignal_api_key"]' . "\t\t\t" . '= "' . $php_native['onesignal_api_key'] . '" ; //Your OneSignal ApiKey, required for push notification sender' . "\r\n";
    }
    $php_admin .= "\r\n";
    $php_admin .= "\r\n/** DON'T EDIT THE CODE BELLOW **/";
    $php_admin .= "\r\n";
    $php_admin .= "" . 'session_start();' . "\r\n";
    $php_admin .= "" . 'if($config["gzip"]==true){' . "\r\n";
    $php_admin .= "\t" . 'ob_start("ob_gzhandler");' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "" . 'ini_set("internal_encoding", "utf-8");' . "\r\n";
    $php_admin .= "" . 'date_default_timezone_set($config["timezone"]);' . "\r\n";
    $php_admin .= "" . 'if(!isset($_SESSION["IS_LOGIN"])){' . "\r\n";
    $php_admin .= "\t" . '$_SESSION["IS_LOGIN"] = false;' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "" . '$app_name = $config["app-name"];' . "\r\n";
    $php_admin .= "" . '$app_desc = $config["app-desc"];' . "\r\n";
    $php_admin .= "" . '$page_title = "Welcome";' . "\r\n";
    $php_admin .= "" . '$content = $body_class = "";' . "\r\n";
    $php_admin .= "\r\n";
    $php_admin .= "" . 'if(!isset($_GET["page"])){' . "\r\n";
    $php_admin .= "\t" . '$_GET["page"] = "home";' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "" . 'if($_GET["page"]==""){' . "\r\n";
    $php_admin .= "\t" . '$_GET["page"] = "home";' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "" . 'if(!isset($_GET["action"])){' . "\r\n";
    $php_admin .= "\t" . '$_GET["action"] = "list";' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "" . 'if($config["debug"]==true){' . "\r\n";
    $php_admin .= "\t" . 'error_reporting(E_ALL);' . "\r\n";
    $php_admin .= "" . '}else{' . "\r\n";
    $php_admin .= "\t" . 'error_reporting(0);' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "\r\n";
    $php_admin .= "" . '/** connect to mysql **/' . "\r\n";
    $php_admin .= "" . '$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);' . "\r\n";
    $php_admin .= "" . 'if (mysqli_connect_errno()){' . "\r\n";
    $php_admin .= "\t" . 'die(mysqli_connect_error());' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "\r\n";
    $php_admin .= "" . 'if($config["utf8"]==true){' . "\r\n";
    $php_admin .= "\t" . '$mysql->set_charset("utf8");' . "\r\n";
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "\r\n";
    $php_admin .= "" . 'switch($_GET["page"]){' . "\r\n";
    $php_admin .= "\t" . '// TO' . 'DO: PAGE - HOME' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- HOME
    $php_admin .= "\t" . 'case "home":' . "\r\n";
    $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
    $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$page_title = "Dashboard";' . "\r\n";
    $php_admin .= "\t\t" . '$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";' . "\r\n";
    $php_admin .= "\t\t" . '$current_user = $_SESSION["CURRENT_USER"];' . "\r\n";
    $php_admin .= "\t\t" . '$content = null;' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="wrapper">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<header class="main-header">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?" class="logo">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="logo-mini"><b>PN</b>L</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="logo-lg"><b>\'.$app_name.\'</b> Panel</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<nav class="navbar navbar-static-top">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="sr-only">Toggle navigation</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="navbar-custom-menu">\';' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- HOME -+- TABLE - RIGHT MENU
    $php_admin .= "\t\t" . '$content .= \'<ul class="nav navbar-nav">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="dropdown user user-menu">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?" class="dropdown-toggle" data-toggle="dropdown">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="user-image" alt="User Image">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="hidden-xs">\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<ul class="dropdown-menu">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="user-header">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="User Image">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<small>\' . htmlentities(stripslashes($current_user[\'user_level\'])).\'</small>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="user-footer">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-left">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-right">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</nav>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</header>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<aside class="main-sidebar">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<section class="sidebar">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="user-panel">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-left image">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-left info">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p>\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?"><i class="fa fa-circle text-success"></i> \'.htmlentities(stripslashes($current_user[\'user_level\'])).\'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<ul class="sidebar-menu" data-widget="tree">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="header">DATA MANAGER</li>\';' . "\r\n";
    $z = 0;
    foreach ($tables as $menu)
    {
        $active = '';
        if ($z == 0)
        {
            $active = 'active';
        }
        $php_admin .= "\t\t" . '$content .= \'<li class="treeview ' . $active . '">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-' . $menu['table-icon-fontawesome'] . '"></i> <span>' . $menu['table-plural-name'] . '</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list"><i class="fa fa-list-ul"></i> All ' . $menu['table-plural-name'] . '</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $z++;
    }
    // TODO: PHP CODE -+- PAGE -+- HOME -+- TABLE - RIGHT MENU - ONESIGNAL MENU
    if ($php_native['onesignal_enable'] == true)
    {
        $php_admin .= "\t\t" . '$content .= \'<li class="header">TOOLS</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>\';' . "\r\n";
    }
    $php_admin .= "\t\t" . '$content .= \'<li class="header">USERS</li>\';' . "\r\n";
    if ($php_native['multiuser_enable'] == true)
    {
        $php_admin .= "\t\t" . '$content .= \'<li class="treeview">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-users"></i> <span>Users</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    }
    $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</aside>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="content-wrapper">\';' . "\r\n";
    $php_admin .= "\t\t" . '/** breadcrumb **/' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h1>Dashboard</h1>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="active">Dashboard</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ol>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
    $php_admin .= "\t\t" . '/** content **/' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h3 class="box-title">Welcome</h3>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- HOME -+- WELCOME
    $php_admin .= "\t\t" . '$content .= \'<div class="well">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h2>Welcome to</h2><h1>\'.$app_name.\'!</h1>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="lead">\'.$app_desc.\'</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- HOME -+- MENU
    $php_admin .= "\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
    $y = 0;
    foreach ($tables as $menu)
    {
        $php_admin .= "\t\t" . '' . "\r\n";
        $php_admin .= "\t\t" . '/** count ' . $menu['table-name'] . ' data **/' . "\r\n";
        $php_admin .= "\t\t" . '$sql_query = "SELECT COUNT(*) AS `total` FROM `' . $menu['table-name'] . '` LIMIT 0,1" ;' . "\r\n";
        $php_admin .= "\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t" . '$count = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="col-lg-3 col-xs-6">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="small-box bg-' . $option_colors[$y] . '">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="inner">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<h3>\'.$count["total"].\'<sup style="font-size: 20px">items</sup></h3>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>' . $menu['table-plural-name'] . '</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="icon">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-' . $menu['table-icon-fontawesome'] . '"></i>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list" class="small-box-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'More <i class="fa fa-arrow-circle-right"></i>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $y++;
        if ($y == (count($option_colors) - 1))
        {
            $y = 0;
        }
    }
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<footer class="main-footer">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-right hidden-xs">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<b>Version</b> ' . $_SESSION['CURRENT_APP']['apps']['app-version'] . '\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<strong>Copyright &copy; \'.date("Y").\' <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['author-organization'] . '</a>.</strong> All rights reserved.\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</footer>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . 'break;' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- LOGIN
    $php_admin .= "\t" . '// TO' . 'DO: PAGE - LOGIN' . "\r\n";
    $php_admin .= "\t" . 'case "login":' . "\r\n";
    $php_admin .= "\t\t" . '$page_title = "Login";' . "\r\n";
    $php_admin .= "\t\t" . '$body_class = "hold-transition login-page";' . "\r\n";
    $php_admin .= "\t\t" . '$notification = \'<p class="login-box-msg text-success">Sign in to start your session</p>\';' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- LOGIN -+- MYSQL
    $php_admin .= "\t\t" . 'if(isset($_POST["submit"])){' . "\r\n";
    $php_admin .= "\t\t\t" . 'if(filter_var($_POST["user"]["email"], FILTER_VALIDATE_EMAIL)) {' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$user_email = addslashes($_POST["user"]["email"]);' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$user_password = sha1("imabuilder" . $_POST["user"]["password"]);' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_email` = \'{$user_email}\' AND `user_password` = \'{$user_password}\' AND `user_level` = \'admin\' AND `user_status` = \'active\'" ;' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'if(isset($current_user["user_email"])){' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["IS_LOGIN"] = true;' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["CURRENT_USER"]["user_id"] = $current_user["user_id"];' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["CURRENT_USER"]["user_name"] = $current_user["user_name"];' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["CURRENT_USER"]["user_first_name"] = $current_user["user_first_name"];' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["CURRENT_USER"]["user_last_name"] = $current_user["user_last_name"];' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["CURRENT_USER"]["user_email"] = $current_user["user_email"];' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$_SESSION["CURRENT_USER"]["user_level"] = $current_user["user_level"];' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'header("Location: ?page=home");' . "\r\n";
    $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification =  \'<p class="login-box-msg text-danger">Incorrect email or password, please try again</p>\';' . "\r\n";
    $php_admin .= "\t\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$notification =  \'<p class="login-box-msg text-danger">Incorrect email or password, please try again!</p>\';' . "\r\n";
    $php_admin .= "\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$content = null;' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="login-box">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="login-logo">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="\'.$config["logo"].\'?' . time() . '" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<br/><a href="?"><b>\'. $app_name .\'</b> Panel</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="login-box-body">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h4 class="text-center">Admin</h4>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= $notification;' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<form action="" method="post" autocomplete="off">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="form-group has-feedback">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input type="email" name="user[email]" class="form-control" placeholder="Email" autocomplete="off">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="glyphicon glyphicon-envelope form-control-feedback"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="form-group has-feedback">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input type="password" name="user[password]" class="form-control" placeholder="Password" autocomplete="off">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="glyphicon glyphicon-lock form-control-feedback"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="col-xs-8">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="col-xs-4">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</form>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . 'break;' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- LOGOUT
    $php_admin .= "\t" . '// TO' . 'DO: PAGE - LOGOUT' . "\r\n";
    $php_admin .= "\t" . 'case "logout":' . "\r\n";
    $php_admin .= "\t\t" . 'unset($_SESSION["IS_LOGIN"]);' . "\r\n";
    $php_admin .= "\t\t" . 'unset($_SESSION["CURRENT_USER"]);' . "\r\n";
    $php_admin .= "\t\t" . '//session_destroy();' . "\r\n";
    $php_admin .= "\t\t" . 'header("Location: ?page=login");' . "\r\n";
    $php_admin .= "\t\t" . 'break;' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- TABLE
    foreach ($tables as $table)
    {
        /// TODO: PHP CODE -+- PAGE -+- TABLE - FINDING ID
        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $php_admin .= "\t" . '// TO' . 'DO: PAGE - ' . strtoupper($string->toFileName(str_replace('_', '-', $table['table-name']))) . '' . "\r\n";
        $php_admin .= "\t" . 'case "' . $string->toFilename(str_replace('_', '-', $table['table-name'])) . '":' . "\r\n";
        $php_admin .= "\t\t" . '$notification = null;' . "\r\n";
        $php_admin .= "\t\t" . 'if(isset($_GET["notice"])){' . "\r\n";
        $php_admin .= "\t\t\t" . 'switch($_GET["notice"]){' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "success-delete":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully deleted the item of the <strong>' . $table['table-plural-name'] . ' data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "success-edit":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully update the item of the <strong>' . $table['table-plural-name'] . ' data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "success-add":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully add new item to the <strong>' . $table['table-plural-name'] . ' data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "wrong-id":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You did not find ID of this item in <strong>' . $table['table-plural-name'] . '</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
        $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '$page_title = "' . $table['table-plural-name'] . '";' . "\r\n";
        $php_admin .= "\t\t" . '$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";' . "\r\n";
        $php_admin .= "\t\t" . '$current_user = $_SESSION["CURRENT_USER"];' . "\r\n";
        $php_admin .= "\t\t" . '$content = null;' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="wrapper">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<header class="main-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="logo">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="logo-mini"><b>PN</b>L</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="logo-lg"><b>\'.$app_name.\'</b> Panel</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<nav class="navbar navbar-static-top">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="sr-only">Toggle navigation</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="navbar-custom-menu">\';' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- TABLE - RIGHT MENU
        $php_admin .= "\t\t" . '$content .= \'<ul class="nav navbar-nav">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="dropdown user user-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="dropdown-toggle" data-toggle="dropdown">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="user-image" alt="User Image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="hidden-xs">\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="dropdown-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="user-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="User Image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<small>\' . htmlentities(stripslashes($current_user[\'user_level\'])).\'</small>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="user-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-right">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- TABLE - LEFT MENU
        $php_admin .= "\t\t" . '$content .= \'<li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</nav>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</header>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<aside class="main-sidebar">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<section class="sidebar">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="user-panel">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left info">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?"><i class="fa fa-circle text-success"></i> \'.htmlentities(stripslashes($current_user[\'user_level\'])).\'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="sidebar-menu" data-widget="tree">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="header">DATA MANAGER</li>\';' . "\r\n";
        foreach ($tables as $menu)
        {
            $active = '';
            if ($table['table-name'] == $menu['table-name'])
            {
                $active = 'active';
            }
            $php_admin .= "\t\t" . '$content .= \'<li class="treeview ' . $active . '">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-' . $menu['table-icon-fontawesome'] . '"></i> <span>' . $menu['table-plural-name'] . '</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list"><i class="fa fa-list-ul"></i> All ' . $menu['table-plural-name'] . '</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        }
        // TODO: PHP CODE -+- PAGE -+- HOME -+- TABLE - RIGHT MENU - ONESIGNAL MENU
        if ($php_native['onesignal_enable'] == true)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="header">TOOLS</li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>\';' . "\r\n";
        }
        $php_admin .= "\t\t" . '$content .= \'<li class="header">USERS</li>\';' . "\r\n";
        if ($php_native['multiuser_enable'] == true)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="treeview">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-users"></i> <span>Users</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        }
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</aside>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="content-wrapper">\';' . "\r\n";
        $php_admin .= "\t\t" . 'switch($_GET["action"]){' . "\r\n"; // TODO: PHP CODE -+- PAGE -+- TABLE - LIST
        $php_admin .= "\t\t\t" . 'case "list":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - ' . strtoupper($string->toFileName(str_replace('_', '-', $table['table-name']))) . ' - LIST' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $private_html = null;
        if (!isset($table['auth-enable']))
        {
            $table['auth-enable'] = false;
        }
        if ($table['auth-enable'] == true)
        {
            $private_html = ' <span class="text-danger">(Only for member)</span>';
        }

        $php_admin .= "\t\t\t\t" . '$content .= \'<h1>' . $table['table-plural-name'] . '<small>' . $table['table-desc'] . '' . $private_html . '</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list">' . $table['table-plural-name'] . '</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li class="active">List</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box box-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h3 class="box-title">All ' . $table['table-plural-name'] . '</h3>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="table-responsive">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<table class="datatable table table-striped table-hover">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<thead>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<tr>\';' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            // TODO: PHP CODE -+- PAGE -+- TABLE - LIST - COLUMN TYPE - HEADER TABLE --+-- OK
            if ($col['item_list'] == true)
            {
                switch ($col['type'])
                {
                    case 'id':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'varchar':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'multi-images':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'multi-text':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;

                    case 'thumbnail':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'image':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'file':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'select-table':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'tinytext':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'text':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'longtext':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'number':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;

                    case 'number-fixed-length':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;

                    case 'date':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'time':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'datetime':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'boolean':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'select':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'url':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'email':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;
                    case 'phone':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";
                        break;

                    case 'blob':
                        $php_admin .= "\t\t\t\t" . '$content .= \'<th>' . $col['label'] . '</th>\';' . "\r\n";

                        break;

                }
            }
        }
        $php_admin .= "\t\t\t\t" . '$content .= \'<th style="width:100px;">#</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</tr>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</thead>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<tbody>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** fetch data from mysql **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$sql_query = "SELECT * FROM `' . $table['table-name'] . '` ORDER BY `' . $col_id . '` DESC" ;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'while ($data = $result->fetch_array()){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<tr>\';' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            $col_var = $string->toVar($col['variable']);
            // TODO: PHP CODE -+- PAGE -+- TABLE - LIST - COLUMN TYPE - DATA TABLE --+-- OK
            $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
            $php_admin .= "\t\t\t\t\t\t" . '/** ' . $col['variable'] . ' **/' . "\r\n";
            if ($col['item_list'] == true)
            {
                switch ($col['type'])
                {
                    case 'id':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . (int)$data["' . $col_var . '"] . \'</td>\';' . "\r\n";
                        break;
                    case 'varchar':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes(substr(strip_tags($data["' . $col_var . '"]),0,64))) . \'</td>\';' . "\r\n";
                        break;

                    case 'number-fixed-length':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><code>\' . htmlentities(stripslashes(substr(strip_tags($data["' . $col_var . '"]),0,64))) . \'</code></td>\';' . "\r\n";
                        break;

                    case 'multi-images':
                        $php_admin .= "\t\t\t\t\t\t" . '$data_arrs = json_decode($data["' . $col_var . '"],true);' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$new_data_arrs = array();' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . 'if(is_array($data_arrs)){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$z=0;' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . 'foreach($data_arrs as $data_arr){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t" . '$new_data_arrs[] = \'<img class="img-thumbnail" width="80" src="\' . $data_arr . \'" />\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t" . '$z++;' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t" . 'if($z > 2){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-success">\' . count($data_arrs) . \' images</span><br/>\' . implode(" ",$new_data_arrs) . \'</td>\';' . "\r\n";
                        break;

                    case 'multi-text':

                        $php_admin .= "\t\t\t\t\t\t" . '$data_arrs = json_decode($data["' . $col_var . '"],true);' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$new_data_arrs = array();' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . 'if(is_array($data_arrs)){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . 'foreach($data_arrs as $data_arr){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t" . '$new_data_arrs[] = \'<span class="label label-default">\' . $data_arr . \'</span>\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . implode(" ",$new_data_arrs) . \'</td>\';' . "\r\n";
                        break;

                    case 'thumbnail':
                        $php_admin .= "\t\t\t\t\t\t" . 'if($data["' . $col_var . '"] ==""){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$data["' . $col_var . '"] ="https://placehold.it/80x80";' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><img class="img-thumbnail" width="80" height="80" src="\' . htmlentities(stripslashes(strip_tags($data["' . $col_var . '"]))) . \'" class="img-thumbnail" alt="..."/></td>\';' . "\r\n";
                        break;
                    case 'image':
                        $php_admin .= "\t\t\t\t\t\t" . 'if($data["' . $col_var . '"] ==""){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$data["' . $col_var . '"] ="https://placehold.it/800x640";' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><img class="img-thumbnail" width="160" height="120" src="\' . htmlentities(stripslashes(strip_tags($data["' . $col_var . '"]))) . \'" class="img-thumbnail" alt="..."/></td>\';' . "\r\n";
                        break;
                    case 'file':
                        $php_admin .= "\t\t\t\t\t\t" . 'if($data["' . $col_var . '"] ==""){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$data["' . $col_var . '"] = "";' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><a class="btn btn-primary" target="_blank" href="\' . htmlentities(stripslashes(strip_tags($data["' . $col_var . '"]))) . \'">Download</a></td>\';' . "\r\n";
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
                        $php_admin .= "\t\t\t\t\t\t" . '$' . $col['option'] . '_text = htmlentities(stripslashes($data["' . $col_var . '"]));' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$sql_' . $col['option'] . '_query = "SELECT * FROM `' . $col['option'] . '` WHERE `' . $get_table['table-variable-as-value'] . '`=\'{$' . $col['option'] . '_text}\'" ;' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '$' . $col['option'] . '_result = $mysql->query($sql_' . $col['option'] . '_query);' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . 'if($' . $col['option'] . '_result){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$' . $col['option'] . '_result_data = $' . $col['option'] . '_result->fetch_array();' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($' . $col['option'] . '_result_data["' . $get_table['table-variable-as-label'] . '"])){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-success">\' . htmlentities(stripslashes($' . $col['option'] . '_result_data["' . $get_table['table-variable-as-label'] . '"])) . \'</span></td>\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '}else{' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-danger">deleted</span></td>\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-danger">Not existing table</span></td>\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        break;
                    case 'tinytext':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes(substr(strip_tags($data["' . $col_var . '"]),0,64))) . \'</td>\';' . "\r\n";
                        break;
                    case 'text':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes(substr(strip_tags($data["' . $col_var . '"]),0,64))) . \'</td>\';' . "\r\n";
                        break;
                    case 'longtext':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes(substr(strip_tags($data["' . $col_var . '"]),0,64))) . \'</td>\';' . "\r\n";
                        break;
                    case 'number':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td class="text-right">\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</td>\';' . "\r\n";
                        break;
                    case 'date':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</td>\';' . "\r\n";
                        break;
                    case 'time':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</td>\';' . "\r\n";
                        break;
                    case 'datetime':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</td>\';' . "\r\n";
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
                        $php_admin .= "\t\t\t\t\t\t" . 'if($data["' . $col_var . '"]==true){' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-danger">' . $col_boolean[0] . '</span></td>\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-success">' . $col_boolean[1] . '</span></td>\';' . "\r\n";
                        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        break;
                    case 'select':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-default">\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</span></td>\';' . "\r\n";
                        break;
                    case 'url':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><a target="_blank" href="\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'">\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</a></td>\';' . "\r\n";
                        break;
                    case 'email':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><a target="_blank" href="mailto:\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'">\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</a></td>\';' . "\r\n";
                        break;
                    case 'phone':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><a target="_blank" href="tel:\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'">\' . htmlentities(stripslashes($data["' . $col_var . '"])) . \'</a></td>\';' . "\r\n";
                        break;
                    case 'blob':
                        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>Data Blob cannot be displayed</td>\';' . "\r\n";
                        break;

                }
            }
        }
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<a href="?page=' . $string->toFilename(str_replace('_', '-', $table['table-name'])) . '&amp;action=edit&amp;id=\'.$data["' . $col_id . '"].\'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\\\'Delete ' . $table['table-singular-name'] . '\\\',\\\'<div class=\\\\\\\'row\\\\\\\'><div class=\\\\\\\'col-md-3 text-center text-primary\\\\\\\'><i class=\\\\\\\'fa fa-5x fa-' . $table['table-icon-fontawesome'] . '\\\\\\\'></i></div><div class=\\\\\\\'col-md-9\\\\\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\\\',\\\'Ok\\\',\\\'danger\\\',\\\'window.location=\\\\\\\'?page=' . $string->toFilename(str_replace('_', '-', $table['table-name'])) . '&amp;action=delete&amp;id=\'.$data["' . $col_id . '"].\'\\\\\\\'\\\');"><i class="fa fa-trash"></i></a>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</tr>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</tbody>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</table>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t" . 'case "edit":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - ' . strtoupper($string->toFileName(str_replace('_', '-', $table['table-name']))) . ' - EDIT' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- TABLE - EDIT
        $php_admin .= "\t\t\t\t" . 'if(isset($_GET["id"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$entry_id= (int)$_GET["id"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '/** fetch current data **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$sql_query = "SELECT * FROM `' . $table['table-name'] . '` WHERE `' . $col_id . '`=$entry_id LIMIT 0,1" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$rowdata = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($rowdata["' . $col_id . '"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '/** default value **/' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] != 'id')
            {
                $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = "' . $col['default'] . '" ;' . "\r\n";
                if ($col['type'] == 'multi-images')
                {
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '-raw"] = "" ;' . "\r\n";
                }
            }
        }
        // TODO: PHP CODE -+- PAGE -+- TABLE - EDIT - RESPONSE - COLUMN TYPE --|-- OK
        $php_admin .= "\t\t\t\t\t\t" . '/** response postdata **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'if(isset($_POST["submit"])){' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            switch ($col['type'])
            {
                case 'id':
                    break;
                case 'varchar':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'number-fixed-length':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'multi-text':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$data_array = array() ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$data_arrs = explode(",",$_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . 'foreach($data_arrs as $data_arr){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . 'if(trim($data_arr)!=""){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . '$data_array[] = trim($data_arr) ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = json_encode($data_array);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = "[]";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'multi-images':
                    $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '-raw"] = "";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '-raw"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . 'if($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '-raw"] != ""){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$image_urls = explode("\n",$_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '-raw"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . 'foreach($image_urls as $image_url){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . 'if(trim($image_url) != ""){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t" . '$_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"][] = trim($image_url);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$new_data = array();' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . 'foreach($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"] as $data){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . 'if($data != ""){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . '$new_data[] = addslashes(trim($data));' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = json_encode($new_data);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'thumbnail':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'image':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'file':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'select-table':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'tinytext':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'text':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'longtext':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'number':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'date':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'time':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'datetime':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'boolean':
                    $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = false;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . 'if($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]== true ){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = true;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'select':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'url':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'email':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'phone':
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    break;
            }

        }
        $sql_cols = array();
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] != 'id')
            {
                $sql_cols[] = '`' . $col['variable'] . '` = \'{$postdata["' . str_replace('_', '-', $col['variable']) . '"]}\' ';
            }
        }
        $sql_update = implode(',', $sql_cols);
        $php_admin .= "\t\t\t\t\t\t\t" . '$sql_query = "UPDATE `' . $table['table-name'] . '` SET ' . $sql_update . ' WHERE `' . $col_id . '`=$entry_id" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'header("Location: ?page=' . str_replace('_', '-', $table['table-name']) . '&action=edit&id=".$entry_id."&notice=success-edit");' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '/** init variable field **/' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] != 'id')
            {
                $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = \'' . $col['default'] . '\';' . "\r\n";
                $php_admin .= "\t\t\t\t\t\t" . 'if(isset($rowdata["' . $col['variable'] . '"])){' . "\r\n";
                $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = stripslashes($rowdata["' . $col['variable'] . '"]);' . "\r\n";
                $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
            }
        }

        if (!isset($table['auth-enable']))
        {
            $table['auth-enable'] = false;
        }
        if ($table['auth-enable'] == true)
        {
            $private_html = ' <span class="text-danger">(Only for member)</span>';
        }

        $php_admin .= "\t\t\t\t\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<h1>' . $table['table-plural-name'] . ' <small>' . $table['table-desc'] . '' . $private_html . '</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li><a href="?">' . $table['table-plural-name'] . '</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li class="active">Edit</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<form action="" method="post">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box box-primary">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<h3 class="box-title">Edit ' . $table['table-singular-name'] . '</h3>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            // TODO: PHP CODE -+- PAGE -+- TABLE - EDIT - COLUMN TYPE - FIELD --+-- OK
            $col['info'] = addslashes($col['info']);
            $php_admin .= "\t\t\t\t\t\t" . '/** field ' . $col['variable'] . ':' . $col['type'] . ' **/' . "\r\n";
            switch ($col['type'])
            {
                case 'id':
                    break;
                case 'varchar':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input maxlength="128" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'number-fixed-length':
                    if ($col['option'] == '')
                    {
                        $col['option'] = 4;
                    }
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input maxlength="' . $col['option'] . '" minlength="' . $col['option'] . '" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . str_repeat('0', $col['option']) . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'multi-text':
                    $php_admin .= "\t\t\t\t\t\t" . '$data_' . $col['variable'] . '_array = json_decode($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'],true) ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$data_' . $col['variable'] . ' =  "";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'if(is_array($data_' . $col['variable'] . '_array)){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$data_' . $col['variable'] . ' =  implode(", ",$data_' . $col['variable'] . '_array);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group" >\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input data-type="tags" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($data_' . $col['variable'] . ')).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;


                case 'multi-images':
                    $php_admin .= "\t\t\t\t\t\t" . '$data_' . $col['variable'] . '_array = json_decode($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'],true) ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-12">\';' . "\r\n";

                    //$php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    //$php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    //$php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    //$php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="nav-tabs-custom">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<ul class="nav nav-tabs pull-right">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li class="active"><a href="#tab-' . $col['variable'] . '-single" data-toggle="tab" aria-expanded="true">Single</a></li>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li class=""><a href="#tab-' . $col['variable'] . '-multi" data-toggle="tab" aria-expanded="false">Multi</a></li>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li class="pull-left header"><i class="fa fa-file-image-o"></i> <label>' . $col['label'] . '</label></li>\';' . "\r\n";

                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</ul>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";


                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="tab-content">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="tab-pane" id="tab-' . $col['variable'] . '-multi">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<textarea class="form-control" name="postdata[' . str_replace('_', '-', $col['variable']) . '-raw]">\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '-raw\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write a collection of image links separated by `enter`</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="tab-pane active" id="tab-' . $col['variable'] . '-single">\';' . "\r\n";

                    $php_admin .= "\t\t\t\t\t\t" . '$z=0;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'if(!is_array($data_' . $col['variable'] . '_array)){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$data_' . $col['variable'] . '_array = array();' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'foreach($data_' . $col['variable'] . '_array as $data_' . $col['variable'] . '){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$no = $z + 1;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div id="box-' . str_replace('_', '-', $col['variable']) . '-\'.$z.\'">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div class="form-group" >\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<span class="input-group-addon">\'. $no .\'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . '][\'.$z.\']" id="postdata-' . str_replace('_', '-', $col['variable']) . '-\'.$z.\'" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($data_' . $col['variable'] . ')).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '-\'.$z.\'">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<a class="btn btn-success btn-flat" target="_blank" href="\'.htmlentities(stripslashes($data_' . $col['variable'] . ')).\'" ><i class="fa fa-eye"></i></a>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<a class="delete btn btn-danger btn-flat" href="#!_" data-target="#box-' . str_replace('_', '-', $col['variable']) . '-\'.$z.\'"><i class="fa fa-trash"></i></a>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$z++;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$no = $z + 1;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<span class="input-group-addon">\'. $no .\'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . '][\'.$z.\']" id="postdata-' . str_replace('_', '-', $col['variable']) . '-\'.$z.\'" type="text" class="form-control" placeholder="' . $col['option'] . '" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '-\'.$z.\'">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="submit" class="btn btn-success btn-flat" name="submit"><i class="fa fa-plus"></i></button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";


                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'thumbnail':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<a class="btn btn-default btn-flat" target="_blank" href="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" ><i class="fa fa-eye"></i></a>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'image':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i></button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<a class="btn btn-default btn-flat" target="_blank" href="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" ><i class="fa fa-eye"></i></a>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'file':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i></button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<a class="btn btn-default btn-flat" target="_blank" href="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" ><i class="fa fa-eye"></i></a>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'select-table':
                    $php_admin .= "\t\t\t\t\t\t" . '$options["' . $col['variable'] . '"] = array();' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$sql_option_query = "SELECT * FROM `' . $col['option'] . '`" ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$option_result = $mysql->query($sql_option_query);' . "\r\n";
                    $get_table = $db->getTable($col['option']);
                    if (!isset($get_table['table-variable-as-value']))
                    {
                        $get_table['table-variable-as-value'] = 'id';
                    }
                    if (!isset($get_table['table-variable-as-label']))
                    {
                        $get_table['table-variable-as-label'] = 'name';
                    }
                    $php_admin .= "\t\t\t\t\t\t" . 'if($option_result){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'while ($option_data = $option_result->fetch_array()){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=> $option_data["' . $get_table['table-variable-as-value'] . '"],"label"=>$option_data["' . $get_table['table-variable-as-label'] . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=> "","label"=>"Not existing table");' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<select class="form-control" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'foreach($options["' . $col['variable'] . '"] as $option) {' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$selected ="";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if($option["val"] == $postdata[\'' . str_replace('_', '-', $col['variable']) . '\'] ){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$selected ="selected";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<option value="\'.htmlentities($option["val"]).\'" \'.$selected.\'>\'.htmlentities($option["label"]).\'</option>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</select>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'tinytext':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<textarea name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" class="form-control" >\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'text':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-12">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<textarea name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" class="form-control" >\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'longtext':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-12">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<textarea name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" class="form-control" data-type="html5" >\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'number':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="number" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'date':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-calendar"></i></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="\'.date("Y-m-d").\'" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" data-type="date" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'time':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="\'.date("H:i:s").\'" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" data-type="time" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'datetime':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="\'.date("Y-m-d H:i:s").\'" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" data-type="datetime" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
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
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'if($postdata[\'' . str_replace('_', '-', $col['variable']) . '\']==true){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" class="flat-red" value="1" checked> ' . trim($col_boolean[0]) . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" class="flat-red" value="0"> ' . trim($col_boolean[1]) . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" class="flat-red" value="1"> ' . trim($col_boolean[0]) . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" class="flat-red" value="0" checked> ' . trim($col_boolean[1]) . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'select':
                    $php_admin .= "\t\t\t\t\t\t" . '$options = array();' . "\r\n";
                    $col_options = explode("|", $col['option']);
                    foreach ($col_options as $option)
                    {
                        $php_admin .= "\t\t\t\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=>"' . trim($option) . '","label"=>"' . ucwords(trim($option)) . '");' . "\r\n";
                    }
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<select class="form-control" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'foreach($options["' . $col['variable'] . '"] as $option) {' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$selected ="";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if($option["val"] == $postdata[\'' . str_replace('_', '-', $col['variable']) . '\'] ){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$selected ="selected";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<option value="\'.htmlentities($option["val"]).\'" \'.$selected.\'>\'.htmlentities($option["label"]).\'</option>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</select>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'url':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="url" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'email':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="email" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'phone':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

                case 'blob':
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p>Not support BLOB Data</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

            }
        }
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</form>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=' . $string->toFileName(str_replace('_', '-', $table['table-name'])) . '&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'header("Location: ?page=' . $string->toFileName(str_replace('_', '-', $table['table-name'])) . '&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- TABLE - ADD
        $php_admin .= "\t\t\t" . 'case "add":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - ' . strtoupper($string->toFileName(str_replace('_', '-', $table['table-name']))) . ' - ADD' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** default value **/' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] != 'id')
            {
                $php_admin .= "\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = "' . $col['default'] . '" ;' . "\r\n";
            }
        }
        // TODO: PHP CODE -+- PAGE -+- TABLE - ADD - COLUMN-TYPE - RESPONSE --|-- OK
        $php_admin .= "\t\t\t\t" . '/** response postdata **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if(isset($_POST["submit"])){' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {

            switch ($col['type'])
            {
                case 'id':
                    break;
                case 'varchar':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'number-fixed-length':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;

                case 'multi-text':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$data_array = array() ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$data_arrs = explode(",",$_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'foreach($data_arrs as $data_arr){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . 'if(trim($data_arr)!=""){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t\t" . '$data_array[] = trim($data_arr) ;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = json_encode($data_array);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = "[]";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'multi-images':

                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"][0])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$data[] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"][0]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = json_encode($data);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = "[]";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'thumbnail':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'image':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'file':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'select-table':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'tinytext':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'text':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'longtext':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'number':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'date':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'time':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'datetime':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'boolean':
                    $php_admin .= "\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = false;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . 'if($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]== true ){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = true;' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'select':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'url':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'email':
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'phone':
                    break;
                    $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"])){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$postdata["' . str_replace('_', '-', $col['variable']) . '"] = addslashes($_POST["postdata"]["' . str_replace('_', '-', $col['variable']) . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
            }


        }
        $colName = $colVal = array();
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] != 'id')
            {
                $colName[] = "`" . $col['variable'] . "`";
                $colVal[] = "'{\$postdata['" . str_replace('_', '-', $col['variable']) . "']}'";
            }
        }
        $add_sql_code = "INSERT INTO `" . $table["table-name"] . "` (" . implode(",", $colName) . ") VALUES (" . implode(",", $colVal) . ")";
        $php_admin .= "\t\t\t\t\t" . '$sql_query = "' . $add_sql_code . '" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$last_id = $mysql->insert_id;' . "\r\n";
        //$php_admin .= "\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'header("Location: ?page=' . str_replace('_', '-', $table['table-name']) . '&notice=success-add&action=edit&id=".$last_id);' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";

        if (!isset($table['auth-enable']))
        {
            $table['auth-enable'] = false;
        }
        if ($table['auth-enable'] == true)
        {
            $private_html = ' <span class="text-danger">(Only for member)</span>';
        }

        $php_admin .= "\t\t\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h1>' . $table['table-plural-name'] . ' <small>' . $table['table-desc'] . '' . $private_html . '</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li><a href="?">' . $table['table-plural-name'] . '</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li class="active">Add</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<form action="" method="post">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box box-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h3 class="box-title">Add new ' . $table['table-singular-name'] . '</h3>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        foreach ($table['table-cols'] as $col)
        {
            // TODO: PHP CODE -+- PAGE -+- TABLE - ADD - COLUMN TYPE --|-- OK
            $col['info'] = addslashes($col['info']);
            $php_admin .= "\t\t\t\t" . '/** field ' . $col['variable'] . ':' . $col['type'] . ' **/' . "\r\n";
            switch ($col['type'])
            {
                case 'id':
                    break;
                case 'varchar':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input maxlength="128" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

                case 'number-fixed-length':

                    if ($col['option'] == '')
                    {
                        $col['option'] = 4;
                    }

                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input minlength="' . $col['option'] . '" maxlength="' . $col['option'] . '" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . str_repeat('0', $col['option']) . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'multi-text':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group" >\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input data-type="tags" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

                case 'multi-images':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-12">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<span class="input-group-addon">1</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . '][0]" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<button type="submit" class="btn btn-success btn-flat" name="submit"><i class="fa fa-plus"></i></button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

                case 'thumbnail':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'image':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'file':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<span class="input-group-btn">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<i class="fa fa-folder-open"></i>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</button>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</span>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'select-table':
                    $php_admin .= "\t\t\t\t" . '$options["' . $col['variable'] . '"] = array();' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$sql_option_query = "SELECT * FROM `' . $col['option'] . '`" ;' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$option_result = $mysql->query($sql_option_query);' . "\r\n";
                    $get_table = $db->getTable($col['option']);
                    if (!isset($get_table['table-variable-as-value']))
                    {
                        $get_table['table-variable-as-value'] = 'id';
                    }
                    if (!isset($get_table['table-variable-as-label']))
                    {
                        $get_table['table-variable-as-label'] = 'name';
                    }
                    $php_admin .= "\t\t\t\t" . 'if($option_result){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . 'while ($option_data = $option_result->fetch_array()){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=> $option_data["' . $get_table['table-variable-as-value'] . '"],"label"=>$option_data["' . $get_table['table-variable-as-label'] . '"]);' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=> "","label"=>"Not existing table");' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<select class="form-control" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . 'foreach($options["' . $col['variable'] . '"] as $option) {' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$selected ="";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . 'if($option["val"] == $postdata[\'' . str_replace('_', '-', $col['variable']) . '\'] ){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$selected ="selected";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$content .= \'<option value="\'.htmlentities($option["val"]).\'" \'.$selected.\'>\'.htmlentities($option["label"]).\'</option>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</select>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'tinytext':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<textarea name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" class="form-control" >\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'text':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-12">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<textarea name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" class="form-control" >\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'longtext':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-12">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<textarea name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" class="form-control" data-type="html5" >\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'</textarea>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'number':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="number" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'date':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-calendar"></i></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="\'.date("Y-m-d").\'" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" data-type="date" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'time':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="\'.date("H:i:s").\'" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" data-type="time" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'datetime':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="\'.date("Y-m-d H:i:s").\'" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" data-type="datetime" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
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
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . 'if($postdata[\'' . str_replace('_', '-', $col['variable']) . '\']==true){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" value="1" class="flat-red" checked> ' . $col_boolean[0] . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" value="0" class="flat-red"> ' . $col_boolean[1] . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" value="1" class="flat-red"> ' . $col_boolean[0] . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$content .= \'<div class="col-md-6"><label><input type="radio" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" value="0" class="flat-red" checked> ' . $col_boolean[1] . '</label></div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'select':
                    $php_admin .= "\t\t\t\t" . '$options = array();' . "\r\n";
                    $col_options = explode("|", $col['option']);
                    foreach ($col_options as $option)
                    {
                        $php_admin .= "\t\t\t\t" . '$options["' . $col['variable'] . '"][] = array("val"=>"' . trim($option) . '","label"=>"' . ucwords(trim($option)) . '");' . "\r\n";
                    }
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<select class="form-control" name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . 'foreach($options["' . $col['variable'] . '"] as $option) {' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$selected ="";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . 'if($option["val"] == $postdata[\'' . str_replace('_', '-', $col['variable']) . '\'] ){' . "\r\n";
                    $php_admin .= "\t\t\t\t\t\t" . '$selected ="selected";' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t\t" . '$content .= \'<option value="\'.htmlentities($option["val"]).\'" \'.$selected.\'>\'.htmlentities($option["label"]).\'</option>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '}' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</select>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'url':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="url" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'email':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="email" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;
                case 'phone':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<input name="postdata[' . str_replace('_', '-', $col['variable']) . ']" id="postdata-' . str_replace('_', '-', $col['variable']) . '" type="text" class="form-control" placeholder="' . $col['option'] . '" value="\'.htmlentities(stripslashes($postdata[\'' . str_replace('_', '-', $col['variable']) . '\'])).\'" />\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

                case 'blob':
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<label>' . $col['label'] . '</label>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p>Not support BLOB Data</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'<p class="help-block">' . $col['info'] . '</p>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
                    break;

            }
        }
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new ' . $table['table-singular-name'] . '</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</form>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- TABLE - DELETE
        $php_admin .= "\t\t\t" . 'case "delete":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - ' . strtoupper($string->toFileName(str_replace('_', '-', $table['table-name']))) . ' - DELETE' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if(isset($_GET["id"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$entry_id= (int)$_GET["id"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '/** fetch current data **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$sql_query = "SELECT * FROM `' . $table['table-name'] . '` WHERE `' . $col_id . '`=$entry_id LIMIT 0,1" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$rowdata = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($rowdata["' . $col_id . '"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$sql_query = "DELETE FROM `' . $table['table-name'] . '` WHERE `' . $col_id . '`=$entry_id";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=' . $string->toFileName(str_replace('_', '-', $table['table-name'])) . '&notice=success-delete");' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=' . $string->toFileName(str_replace('_', '-', $table['table-name'])) . '&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'<footer class="main-footer">\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'<div class="pull-right hidden-xs">\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'<b>Version</b> ' . $_SESSION['CURRENT_APP']['apps']['app-version'] . '\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'<strong>Copyright &copy; \'.date("Y").\' <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['author-organization'] . '</a>.</strong> All rights reserved.\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'</footer>\';' . "\r\n";
        $php_admin .= "\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t" . 'break;' . "\r\n";
    }
    // TODO: PHP CODE -+- PAGE -+- PROFILE
    $php_admin .= "\t" . '// TO' . 'DO: PAGE - PROFILE' . "\r\n";
    $php_admin .= "\t" . 'case "profile":' . "\r\n";
    $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
    $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$page_title = "Profile";' . "\r\n";
    $php_admin .= "\t\t" . '$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";' . "\r\n";
    $php_admin .= "\t\t" . '$notification = null;' . "\r\n";
    $php_admin .= "\t\t" . 'if(isset($_GET["notice"])){' . "\r\n";
    $php_admin .= "\t\t\t" . 'switch($_GET["notice"]){' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'case "success-profile-update":' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully update your profile.\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'case "error-password-too-short":' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'The new password you wrote is too short, at least 6 characters or more\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'case "error-password-not-same":' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'The new password and new password again are not the same, please try again!\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'case "error-old-password":' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'Your old password is wrong, please try again!\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'case "success-password-update":' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'Your password has been changed, please logout!\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
    $php_admin .= "\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_id` = \'{$_SESSION["CURRENT_USER"]["user_id"]}\' AND `user_email` = \'{$_SESSION["CURRENT_USER"]["user_email"]}\'" ;' . "\r\n";
    $php_admin .= "\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
    $php_admin .= "\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
    $php_admin .= "\t\t" . 'if(!isset($current_user["user_email"])){' . "\r\n";
    $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '' . "\r\n";
    $php_admin .= "\t\t" . '/** resp update profile **/' . "\r\n";
    $php_admin .= "\t\t" . 'if(isset($_POST["user-data"])){' . "\r\n";
    $php_admin .= "\t\t\t" . '$user_first_name = addslashes($_POST["postdata"]["user-first-name"]) ;' . "\r\n";
    $php_admin .= "\t\t\t" . '$user_last_name = addslashes($_POST["postdata"]["user-last-name"]) ;' . "\r\n";
    $php_admin .= "\t\t\t" . '$user_website = addslashes($_POST["postdata"]["user-website"]) ;' . "\r\n";
    $php_admin .= "\t\t\t" . '$sql_query = "UPDATE `users` SET `user_first_name` = \'{$user_first_name}\', `user_last_name` = \'{$user_last_name}\',`user_website` = \'{$user_website}\' WHERE `user_id` ={$current_user["user_id"]};";' . "\r\n";
    $php_admin .= "\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
    $php_admin .= "\t\t\t" . '$stmt->execute();' . "\r\n";
    $php_admin .= "\t\t\t" . '$stmt->close();' . "\r\n";
    $php_admin .= "\t\t\t" . '$_SESSION["CURRENT_USER"]["user_first_name"] = $user_first_name;' . "\r\n";
    $php_admin .= "\t\t\t" . 'header("Location: ?page=profile&notice=success-profile-update");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '' . "\r\n";
    $php_admin .= "\t\t" . '/** resp update password **/' . "\r\n";
    $php_admin .= "\t\t" . 'if(isset($_POST["user-password"])){' . "\r\n";
    $php_admin .= "\t\t\t" . 'if(strlen($_POST["postdata"]["user-new-password"]) >= 6){' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'if($_POST["postdata"]["user-new-password"] == $_POST["postdata"]["user-new-password-again"]){' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '$old_password_hash = sha1("imabuilder".$_POST["postdata"]["user-old-password"]);' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'if($old_password_hash == $current_user["user_password"]){' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '$user_password = sha1("imabuilder".$_POST["postdata"]["user-new-password"]);' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '$sql_query = "UPDATE `users` SET `user_password` = \'{$user_password}\' WHERE `user_id` ={$current_user["user_id"]};";' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=profile&notice=success-password-update");' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=profile&notice=error-old-password");' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'header("Location: ?page=profile&notice=error-password-not-same");' . "\r\n";
    $php_admin .= "\t\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'header("Location: ?page=profile&notice=error-password-too-short");' . "\r\n";
    $php_admin .= "\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '' . "\r\n";
    $php_admin .= "\t\t" . '$content = null;' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="wrapper">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<header class="main-header">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?" class="logo">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="logo-mini"><b>PN</b>L</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="logo-lg"><b>\'.$app_name.\'</b> Panel</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<nav class="navbar navbar-static-top">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="sr-only">Toggle navigation</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="navbar-custom-menu">\';' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- PROFILE - RIGHT MENU
    $php_admin .= "\t\t" . '$content .= \'<ul class="nav navbar-nav">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="dropdown user user-menu">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?" class="dropdown-toggle" data-toggle="dropdown">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="user-image" alt="User Image">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<span class="hidden-xs">\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'</span>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<ul class="dropdown-menu">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="user-header">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="User Image">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<small>\' . htmlentities(stripslashes($current_user[\'user_level\'])).\'</small>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="user-footer">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-left">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-right">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</nav>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</header>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<aside class="main-sidebar">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<section class="sidebar">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="user-panel">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-left image">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-left info">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p>\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<a href="?"><i class="fa fa-circle text-success"></i> \'.htmlentities(stripslashes($current_user[\'user_level\'])).\'</a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<ul class="sidebar-menu" data-widget="tree">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="header">DATA MANAGER</li>\';' . "\r\n";
    $z = 0;
    foreach ($tables as $menu)
    {
        $php_admin .= "\t\t" . '$content .= \'<li class="treeview">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-' . $menu['table-icon-fontawesome'] . '"></i> <span>' . $menu['table-plural-name'] . '</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list"><i class="fa fa-list-ul"></i> All ' . $menu['table-plural-name'] . '</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $z++;
    }
    // TODO: PHP CODE -+- PAGE -+- HOME -+- TABLE - RIGHT MENU - ONESIGNAL MENU
    if ($php_native['onesignal_enable'] == true)
    {
        $php_admin .= "\t\t" . '$content .= \'<li class="header">TOOLS</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>\';' . "\r\n";
    }
    $php_admin .= "\t\t" . '$content .= \'<li class="header">USERS</li>\';' . "\r\n";
    if ($php_native['multiuser_enable'] == true)
    {
        $php_admin .= "\t\t" . '$content .= \'<li class="treeview">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-users"></i> <span>Users</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    }
    $php_admin .= "\t\t" . '$content .= \'<li class="active"><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</aside>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="content-wrapper">\';' . "\r\n";
    $php_admin .= "\t\t" . '/** breadcrumb **/' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h1>Profile <small>Your personal data</small></h1>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<li class="active">Profile</li>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</ol>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
    $php_admin .= "\t\t" . '/** content **/' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= $notification;' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="col-md-3">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box box-primary">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-body box-profile">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<img class="profile-user-img img-responsive img-circle" src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'?s=128" alt="User profile picture">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h3 class="profile-username text-center">\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'</h3>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="text-muted text-center">\' . htmlentities(stripslashes($current_user[\'user_level\'])).\'</p>\';' . "\r\n"; //box-body
    $php_admin .= "\t\t" . '$content .= \'<ul class="list-group list-group-unbordered">\';' . "\r\n"; //box-body
    foreach ($tables as $menu)
    {
        $php_admin .= "\t\t" . '' . "\r\n";
        $php_admin .= "\t\t" . '/** count ' . $menu['table-name'] . ' data **/' . "\r\n";
        $php_admin .= "\t\t" . '$sql_query = "SELECT COUNT(*) AS `total` FROM `' . $menu['table-name'] . '` LIMIT 0,1" ;' . "\r\n";
        $php_admin .= "\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t" . '$count = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="list-group-item">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<b>' . $menu['table-plural-name'] . '</b> <a class="pull-right">\'.$count["total"].\'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
    }
    $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n"; //box-body
    $php_admin .= "\t\t" . '$content .= \'<a href="https://en.gravatar.com/" target="_blank" class="btn btn-flat btn-primary btn-block"><b>Change Gravatar</b></a>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box-body
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //col-md-3
    // TODO: PHP CODE -+- PAGE -+- PROFILE - PROFILE
    $php_admin .= "\t\t" . '$content .= \'<div class="col-md-5">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<form action="" method="post">\';' . "\r\n"; //form
    $php_admin .= "\t\t" . '$content .= \'<div class="box box-success">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h3 class="box-title">About Yourself</h3>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";

    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>First Name</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-first-name]" id="postdata-user-first-name" type="text" class="form-control" placeholder="Regel" value="\'.htmlentities(stripslashes($current_user[\'user_first_name\'])).\'" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">What is your first name?</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";

    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>Last Name</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-last-name]" id="postdata-user-last-name" type="text" class="form-control" placeholder="Jambak" value="\'.htmlentities(stripslashes($current_user[\'user_last_name\'])).\'" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">What is your last name?</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";


    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>Email Address</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-email]" id="postdata-user-email" type="text" class="form-control" placeholder="regel@ihsana.com" value="\'.htmlentities(stripslashes($current_user[\'user_email\'])).\'" readonly/>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">What is the email address used to log in?</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>Website</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-website]" id="postdata-user-website" type="text" class="form-control" placeholder="http://ihsana.com" value="\'.htmlentities(stripslashes($current_user[\'user_website\'])).\'" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">What is the your website?</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box-body
    $php_admin .= "\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-success" name="user-data"><i class="fa fa-floppy-o"></i> Update Profile</button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box
    $php_admin .= "\t\t" . '$content .= \'</form>\';' . "\r\n"; //form
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //col-md-5
    // TODO: PHP CODE -+- PAGE -+- PROFILE - PASSWORD MENU
    $php_admin .= "\t\t" . '$content .= \'<div class="col-md-4">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<form action="" method="post">\';' . "\r\n"; //form
    $php_admin .= "\t\t" . '$content .= \'<div class="box box-danger">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<h3 class="box-title">Account Management</h3>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>Old Password</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-old-password]" id="postdata-user-old-password" type="password" class="form-control" autocomplete="off"/>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">What is old password have you used?</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>New Password</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-new-password]" id="postdata-user-new-password" type="password" class="form-control" autocomplete="off"/>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">What is your new password?</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<label>New Password Again</label>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<input name="postdata[user-new-password-again]" id="postdata-user-new-password-again" type="password" class="form-control" autocomplete="off"/>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<p class="help-block">Type again new password</p>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box-body
    $php_admin .= "\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-danger" name="user-password"><i class="fa fa-floppy-o"></i> Update</button>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //col-md-4
    $php_admin .= "\t\t" . '$content .= \'</form>\';' . "\r\n"; //form
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //row
    $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<footer class="main-footer">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div class="pull-right hidden-xs">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<b>Version</b> ' . $_SESSION['CURRENT_APP']['apps']['app-version'] . '\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<strong>Copyright &copy; \'.date("Y").\' <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['author-organization'] . '</a>.</strong> All rights reserved.\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</footer>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
    $php_admin .= "\t\t" . 'break;' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- FILE-BROWSER
    $php_admin .= "\t" . '// TO' . 'DO: PAGE - FILE-BROWSER' . "\r\n";
    $php_admin .= "\t" . 'case "file-browser":' . "\r\n";
    $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
    $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . 'if(!file_exists("./filebrowser/php/autoload.php")){' . "\r\n";
    $php_admin .= "\t\t\t" . 'die("elfinder not installed, please download <a target=\"blank\" href=\"https://studio-42.github.io/elFinder/\">elfinder</a> and extracted into `filebrowser` directory");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$site_url="";' . "\r\n";
    $php_admin .= "\t\t" . 'if(isset($_SERVER["HTTP_REFERER"])){' . "\r\n";
    $php_admin .= "\t\t\t" . '$parse_url = parse_url($_SERVER["HTTP_REFERER"]);' . "\r\n";
    $php_admin .= "\t\t\t" . '$site_url = $parse_url["scheme"] . "://" . $parse_url["host"] . "/" . dirname($parse_url["path"]) . "/";' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<!DOCTYPE HTML>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<html>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<head>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<meta charset="utf-8" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<link rel="stylesheet" href="./filebrowser/css/elfinder.min.css"/>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<link rel="stylesheet" href="./filebrowser/css/theme.css"/>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<title>elFinder</title>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<style type="text/css">\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'body {padding: 0 !important;margin: 0 !important;}\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'#elfinder{z-index:999999999;height: 100%; width: 100%;}\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'div{border-radius: 0 !important;}\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</style>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</head>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<body>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<div id="elfinder"></div>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<script src="./filebrowser/js/elfinder.min.js"></script>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'<script type="text/javascript">\';' . "\r\n";
    $php_admin .= "\t\t" . 'if(isset($_GET["CKEditor"])){' . "\r\n";
    $php_admin .= "\t\t\t" . '$content .= \'function getUrlParam(n){var a=new RegExp("(?:[?&]|&)"+n+"=([^&]+)","i"),e=window.location.search.match(a);return e&&1<e.length?e[1]:null}\';' . "\r\n";
    $php_admin .= "\t\t\t" . '$content .= \'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\\\\\/gi,"/");var t="\'.$site_url.\'"+i.replace(/src\//gi,"");window.opener.CKEDITOR.tools.callFunction(getUrlParam("CKEditorFuncNum"),t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});\';' . "\r\n";
    $php_admin .= "\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t" . '$content .= \'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\\\\\/gi,"/");var t="\'.$site_url.\'"+i.replace(/src\//gi,"");window.opener.fileBrowser.callBack(t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});\';' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</script>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</body>\';' . "\r\n";
    $php_admin .= "\t\t" . '$content .= \'</html>\';' . "\r\n";
    $php_admin .= "\t\t" . 'die($content);' . "\r\n";
    $php_admin .= "\t\t" . 'break;' . "\r\n";
    // TODO: PHP CODE -+- PAGE -+- FILE-CONNECTOR
    $php_admin .= "\t" . '// TO' . 'DO: PAGE - FILE-CONNECTOR' . "\r\n";
    $php_admin .= "\t" . 'case "file-connector":' . "\r\n";
    $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
    $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . 'if(file_exists("./filebrowser/php/autoload.php")){' . "\r\n";
    $php_admin .= "\t\t\t" . 'require "./filebrowser/php/autoload.php";' . "\r\n";
    $php_admin .= "\t\t\t" . 'elFinder::$netDrivers["ftp"] = "FTP";' . "\r\n";
    $php_admin .= "\t\t\t" . 'function access($attr, $path, $data, $volume, $isDir, $relpath){' . "\r\n";
    $php_admin .= "\t\t\t\t" . '$basename = basename($path);' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'return $basename[0] === "."' . "\r\n";
    $php_admin .= "\t\t\t\t" . '&& strlen($relpath) !== 1' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '? !($attr == "read" || $attr == "write")' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . ': null;' . "\r\n";
    $php_admin .= "\t\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t\t" . '$opts = array( // "debug" => true,' . "\r\n";
    $php_admin .= "\t\t\t\t" . '"roots" => array( // Items volume' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . 'array(' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"driver" => "LocalFileSystem", // driver for accessing file system (REQUIRED)' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"path" => "./userfiles/", // path to files (REQUIRED)' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"URL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/", // URL to files (REQUIRED)' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"trashHash" => "t1_Lw", // elFinder"s hash of trash folder' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"uploadDeny" => array("all"), // All Mimetypes not allowed to upload' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"uploadAllow" => array(' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/x-ms-bmp",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/gif",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/jpeg",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/png",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/x-icon",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"text/plain"), // Mimetype `image` and `text/plain` allowed to upload' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"uploadOrder" => array("deny", "allow"), // allowed Mimetype `image` and `text/plain` only' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"accessControl" => "access" // disable and hide dot starting files (OPTIONAL)' . "\r\n";
    $php_admin .= "\t\t\t\t" . '), // Trash volume' . "\r\n";
    $php_admin .= "\t\t\t\t" . 'array(' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"id" => "1",' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"driver" => "Trash",' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"path" => "./userfiles/.trash/",' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"tmbURL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/.trash/.tmb/",' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"uploadDeny" => array("all"), // Recomend the same settings as the original volume that uses the trash' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"uploadAllow" => array(' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/x-ms-bmp",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/gif",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/jpeg",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/png",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"image/x-icon",' . "\r\n";
    $php_admin .= "\t\t\t\t\t\t" . '"text/plain"), // Same as above' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"uploadOrder" => array("deny", "allow"), // Same as above' . "\r\n";
    $php_admin .= "\t\t\t\t\t" . '"accessControl" => "access", // Same as above' . "\r\n";
    $php_admin .= "\t\t\t\t" . ')));' . "\r\n";
    $php_admin .= "\t\t\t" . '$connector = new elFinderConnector(new elFinder($opts));' . "\r\n";
    $php_admin .= "\t\t\t" . '$connector->run();' . "\r\n";
    $php_admin .= "\t\t" . '}else{' . "\r\n";
    $php_admin .= "\t\t\t" . 'die("elfinder not installed");' . "\r\n";
    $php_admin .= "\t\t" . '}' . "\r\n";
    $php_admin .= "\t\t" . 'die($content);' . "\r\n";
    $php_admin .= "\t\t" . 'break;' . "\r\n";
    if ($php_native['multiuser_enable'] == true)
    {
        // TODO: PHP CODE -+- PAGE -+- USERS
        $php_admin .= "\t" . '// TO' . 'DO: PAGE - USERS' . "\r\n";
        $php_admin .= "\t" . 'case "users":' . "\r\n";
        $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
        $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '$notification = null;' . "\r\n";
        $php_admin .= "\t\t" . 'if(isset($_GET["notice"])){' . "\r\n";
        $php_admin .= "\t\t\t" . 'switch($_GET["notice"]){' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "success-delete":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully deleted the account of the <strong>users data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "success-edit":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully update the account of the <strong>users data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "success-add":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You have successfully add new account to the <strong>users data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'case "wrong-id":' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'You did not find ID of this account in <strong>users data</strong>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '$page_title = "Users";' . "\r\n";
        $php_admin .= "\t\t" . '$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";' . "\r\n";
        $php_admin .= "\t\t" . '$current_user = $_SESSION["CURRENT_USER"];' . "\r\n";
        $php_admin .= "\t\t" . '$content = null;' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="wrapper">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<header class="main-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="logo">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="logo-mini"><b>PN</b>L</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="logo-lg"><b>\'.$app_name.\'</b> Panel</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<nav class="navbar navbar-static-top">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="sr-only">Toggle navigation</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="navbar-custom-menu">\';' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS - RIGHT MENU
        $php_admin .= "\t\t" . '$content .= \'<ul class="nav navbar-nav">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="dropdown user user-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="dropdown-toggle" data-toggle="dropdown">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="user-image" alt="User Image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="hidden-xs">\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="dropdown-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="user-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="User Image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<small>\' . htmlentities(stripslashes($current_user[\'user_level\'])).\'</small>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="user-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-right">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</nav>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</header>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<aside class="main-sidebar">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<section class="sidebar">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="user-panel">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left info">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?"><i class="fa fa-circle text-success"></i> \'.htmlentities(stripslashes($current_user[\'user_level\'])).\'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="sidebar-menu" data-widget="tree">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="header">DATA MANAGER</li>\';' . "\r\n";
        $z = 0;
        foreach ($tables as $menu)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="treeview">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-' . $menu['table-icon-fontawesome'] . '"></i> <span>' . $menu['table-plural-name'] . '</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list"><i class="fa fa-list-ul"></i> All ' . $menu['table-plural-name'] . '</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
            $z++;
        }
        // TODO: PHP CODE -+- PAGE -+- USERS -+- TABLE - RIGHT MENU - ONESIGNAL MENU
        if ($php_native['onesignal_enable'] == true)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="header">TOOLS</li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li class=""><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>\';' . "\r\n";
        }
        $php_admin .= "\t\t" . '$content .= \'<li class="header">USERS</li>\';' . "\r\n";
        if ($php_native['multiuser_enable'] == true)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="treeview active">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-users"></i> <span>Users</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        }
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</aside>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="content-wrapper">\';' . "\r\n";
        $php_admin .= "\t\t" . 'switch($_GET["action"]){' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS -+- LIST
        $php_admin .= "\t\t\t" . 'case "list":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$page_title = "Users - List";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h1>Users <small>Add, edit and delete your users</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li class="active">Users</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li>List</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box box-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h3 class="box-title">Users</h3>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="table-responsive">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<table class="datatable table table-striped table-hover">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<thead>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<tr>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>User Name</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Full Name</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Email Address</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Birthday</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Phone</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Website</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Expired</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Level</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>Status</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<th>#</th>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</tr>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</thead>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<tbody>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** fetch data from mysql **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$sql_query = "SELECT * FROM `users`" ;' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'while ($data = $result->fetch_array()){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<tr>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><code>\' . htmlentities($data["user_name"]) . \'</code></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities(ucwords($data["user_first_name"])) . \' \' . htmlentities(ucwords($data["user_last_name"])) . \'</td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><a href="mailto:\' . htmlentities($data["user_email"]) . \'">\' . htmlentities($data["user_email"]) . \'</a></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities($data["user_birthday"]) . \'</td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'if($data["user_phone"] !== ""){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td><a href="tel:\' . htmlentities($data["user_phone"]) . \'">\' . htmlentities($data["user_phone"]) . \'</a></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td>-</td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'if($data["user_website"] !== ""){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td><a target="_blank" href="\' . htmlentities($data["user_website"]) . \'">\' . htmlentities($data["user_website"]) . \'</a></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'if($data["user_expired"] !== "0000-00-00 00:00:00"){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td>\' . htmlentities($data["user_expired"]) . \'</td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<td></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'switch($data["user_level"]){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "admin":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-warning"><i class="fa fa-fort-awesome"></i> \' . ucwords($data["user_level"]) . \'</span></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "user":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-default"><i class="fa fa-user"></i> \' . ucwords($data["user_level"]) . \'</span></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'switch($data["user_status"]){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "active":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-success">\' . ucwords($data["user_status"]) . \'</span></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "pending":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-default">\' . ucwords($data["user_status"]) . \'</span></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "banned":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<td><span class="label label-danger">\' . ucwords($data["user_status"]) . \'</span></td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<a href="?page=users&amp;action=edit&amp;id=\'.$data["user_id"].\'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'switch($data["user_level"]){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "user":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$content .= \'<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\\\'Delete user\\\',\\\'<div class=\\\\\\\'row\\\\\\\'><div class=\\\\\\\'col-md-3 text-center text-primary\\\\\\\'><i class=\\\\\\\'fa fa-5x fa-users\\\\\\\'></i></div><div class=\\\\\\\'col-md-9\\\\\\\'>You are about to permanently delete this user from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\\\',\\\'Ok\\\',\\\'danger\\\',\\\'window.location=\\\\\\\'?page=users&amp;action=delete&amp;id=\'.$data["user_id"].\'\\\\\\\'\\\');"><i class="fa fa-trash"></i></a>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'case "admin":' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '//$content .= \'<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\\\'Delete user\\\',\\\'<div class=\\\\\\\'row\\\\\\\'><div class=\\\\\\\'col-md-3 text-center text-primary\\\\\\\'><i class=\\\\\\\'fa fa-5x fa-users\\\\\\\'></i></div><div class=\\\\\\\'col-md-9\\\\\\\'>You are about to permanently delete this user from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\\\',\\\'Ok\\\',\\\'danger\\\',\\\'window.location=\\\\\\\'?page=users&amp;action=delete&amp;id=\'.$data["user_id"].\'\\\\\\\'\\\');"><i class="fa fa-trash"></i></a>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</td>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</tr>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</tbody>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</table>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div><!-- ./box-body -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div><!-- ./box -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS -+- EDIT
        $php_admin .= "\t\t\t" . 'case "edit":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - USERS - EDIT' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if(isset($_GET["id"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$entry_id = (int)$_GET["id"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '/** fetch current data **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_id`=$entry_id LIMIT 0,1" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$rowdata = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($rowdata["user_id"])){' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS -+- EDIT - RESPONSE
        $php_admin .= "\t\t\t\t\t\t" . '/** response postdata **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'if(isset($_POST["submit"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_name"] = $rowdata["user_name"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_first_name"] = $rowdata["user_first_name"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_last_name"] = $rowdata["user_last_name"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_birthday"] = $rowdata["user_birthday"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_email"] = $rowdata["user_email"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_website"] = $rowdata["user_website"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_company"] = $rowdata["user_company"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_level"] = $rowdata["user_level"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_token"] = $rowdata["user_token"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_address_1"] = $rowdata["user_address_1"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_address_2"] = $rowdata["user_address_2"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_city"] = $rowdata["user_city"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_state"] = $rowdata["user_state"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_postcode"] = $rowdata["user_postcode"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_country"] = $rowdata["user_country"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_phone"] = $rowdata["user_phone"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_note"] = $rowdata["user_note"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_expired"] = $rowdata["user_expired"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$postdata["user_status"] = $rowdata["user_status"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-name"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_name"] = addslashes($_POST["postdata"]["user-name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-first-name"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_first_name"] = addslashes($_POST["postdata"]["user-first-name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-last-name"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_last_name"] = addslashes($_POST["postdata"]["user-last-name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-birthday"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_birthday"] = addslashes($_POST["postdata"]["user-birthday"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-email"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_email"] = addslashes($_POST["postdata"]["user-email"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-website"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_website"] = addslashes($_POST["postdata"]["user-website"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-company"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_company"] = addslashes($_POST["postdata"]["user-company"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-address-1"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_address_1"] = addslashes($_POST["postdata"]["user-address-1"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-address-2"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_address_2"] = addslashes($_POST["postdata"]["user-address-2"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-city"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_city"] = addslashes($_POST["postdata"]["user-city"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-state"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_state"] = addslashes($_POST["postdata"]["user-state"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-postcode"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_postcode"] = addslashes($_POST["postdata"]["user-postcode"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-country"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_country"] = addslashes($_POST["postdata"]["user-country"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-phone"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_phone"] = addslashes($_POST["postdata"]["user-phone"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-note"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_note"] = addslashes($_POST["postdata"]["user-note"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-expired"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_expired"] = addslashes($_POST["postdata"]["user-expired"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-status"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_status"] = addslashes($_POST["postdata"]["user-status"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-password"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$postdata["user_password"] = sha1("imabuilder" . $_POST["postdata"]["user-password"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$_POST["postdata"]["user-password"]="";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_name` LIKE \'{$postdata["user_name"]}\' AND `user_id` !={$entry_id}";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$data = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'if($data["exist"] == 0){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_email` LIKE \'{$postdata["user_email"]}\' AND `user_id` !={$entry_id}";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . '$data = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . 'if($data["exist"] == 0){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query = null ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "UPDATE `users` SET ";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . 'if(strlen($_POST["postdata"]["user-password"]) > 5 ){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_password` = \'{$postdata["user_password"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_name` = \'{$postdata["user_name"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_first_name` = \'{$postdata["user_first_name"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_last_name` = \'{$postdata["user_last_name"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_birthday` = \'{$postdata["user_birthday"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_email` = \'{$postdata["user_email"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_phone` = \'{$postdata["user_phone"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_website` = \'{$postdata["user_website"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_company` = \'{$postdata["user_company"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_address_1` = \'{$postdata["user_address_1"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_address_2` = \'{$postdata["user_address_2"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_city` = \'{$postdata["user_city"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_state` = \'{$postdata["user_state"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_postcode` = \'{$postdata["user_postcode"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_country` = \'{$postdata["user_country"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_note` = \'{$postdata["user_note"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_expired` = \'{$postdata["user_expired"]}\', " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "`user_status` = \'{$postdata["user_status"]}\' " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$sql_query .= "WHERE `user_id`=$entry_id";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t\t" . 'header("Location: ?page=users&action=edit&id=".$entry_id."&notice=success-edit");' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t" . '$notification .= \'This <strong>email</strong> has already been used!\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'This <strong>username</strong> has already been used!\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$page_title = "Users - Edit " . htmlentities($rowdata["user_first_name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<h1>Users <small>Add, edit and delete your users</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li class="active">Users</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<li>Edit</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<form role="form" action="" method="post">\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box box-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<h3 class="box-title">Users <strong>\' . htmlentities($rowdata["user_first_name"]).\'</strong></h3>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Username</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-name]" placeholder="ahmad-dahlan" value="\' . htmlentities($rowdata["user_name"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the username</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Birthday</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" data-type="date" class="form-control" name="postdata[user-birthday]" placeholder="" value="\' . htmlentities($rowdata["user_birthday"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the birthday</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>First Name</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-first-name]" placeholder="Ahmad Dahlan" value="\' . htmlentities($rowdata["user_first_name"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s first name</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Last Name</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-last-name]" placeholder="Ahmad Dahlan" value="\' . htmlentities($rowdata["user_last_name"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s last name</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Phone</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-phone"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-phone]" placeholder="6281234568" value="\' . htmlentities($rowdata["user_phone"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s phone</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Company</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-company]" placeholder="" value="\' . htmlentities($rowdata["user_company"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s company</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Website</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="url" class="form-control" name="postdata[user-website]" placeholder="https://domain.com" value="\' . htmlentities($rowdata["user_website"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s website</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Address 1</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-address-1]" placeholder="" value="\' . htmlentities($rowdata["user_address_1"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s address 1</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Address 2</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-address-2]" placeholder="" value="\' . htmlentities($rowdata["user_address_2"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s address 2</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>City</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-city]" placeholder="Pasaman Barat" value="\' . htmlentities($rowdata["user_city"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s city</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>State</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-state]" placeholder="Sumatera Barat" value="\' . htmlentities($rowdata["user_state"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s state</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Postcode</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-postcode]" placeholder="26567" value="\' . htmlentities($rowdata["user_postcode"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s postcode</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Country</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-country]" placeholder="Indonesia" value="\' . htmlentities($rowdata["user_country"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s country</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./col-md-6 -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Note</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<textarea name="postdata[user-note]" class="form-control">\' . htmlentities($rowdata["user_note"]).\'</textarea>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write notes if needed</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Expired</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" data-type="datetime" class="form-control" name="postdata[user-expired]" placeholder="2019-11-08 14:00:09" value="\' . htmlentities($rowdata["user_expired"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the expiration time if it is needed</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$status_options[] = "pending" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$status_options[] = "active" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$status_options[] = "banned" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Status</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<select class="form-control" name="postdata[user-status]">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'foreach($status_options as $status_option){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$selected = "";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if($status_option==$rowdata["user_status"]){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$selected = "selected";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<option value="\'.$status_option.\'" \'.$selected.\'>\'.ucwords($status_option).\'</option>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</select>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">&nbsp;</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<hr/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Email</label>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="email" class="form-control" name="postdata[user-email]" placeholder="email@domain.com"  value="\' . htmlentities($rowdata["user_email"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the email used to log in</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Password</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-lock"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" minlength="6" class="form-control" name="postdata[user-password]" value="" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Leave this blank if you do not want to change the user\\\'s password</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./col-md-6 -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./row -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./box-body -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./box -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</form><!-- ./form -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=users&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'header("Location: ?page=users&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS -+- ADD
        $php_admin .= "\t\t\t" . 'case "add":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - USERS - ADD' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_name"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_birthday"] = "1990-01-01";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_first_name"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_last_name"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_email"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_company"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_website"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_level"] = "user";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_token"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_address_1"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_address_2"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_phone"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_note"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_expired"] = "0000-00-00 00:00:00";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_status"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_password"] = null;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_city"] = "";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_state"] = "";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_postcode"] = "";' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$postdata["user_country"] = "";' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS -+- ADD - RESPONSE
        $php_admin .= "\t\t\t\t" . '/** response postdata **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if(isset($_POST["submit"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-name"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_name"] = addslashes($_POST["postdata"]["user-name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-birthday"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_birthday"] = addslashes($_POST["postdata"]["user-birthday"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-first-name"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_first_name"] = addslashes($_POST["postdata"]["user-first-name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-last-name"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_last_name"] = addslashes($_POST["postdata"]["user-last-name"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-email"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_email"] = addslashes($_POST["postdata"]["user-email"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-website"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_website"] = addslashes($_POST["postdata"]["user-website"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-company"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_company"] = addslashes($_POST["postdata"]["user-company"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-address-1"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_address_1"] = addslashes($_POST["postdata"]["user-address-1"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-address-2"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_address_2"] = addslashes($_POST["postdata"]["user-address-2"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-city"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_city"] = addslashes($_POST["postdata"]["user-city"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-state"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_state"] = addslashes($_POST["postdata"]["user-state"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-postcode"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_postcode"] = addslashes($_POST["postdata"]["user-postcode"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-country"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_country"] = addslashes($_POST["postdata"]["user-country"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-phone"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_phone"] = addslashes($_POST["postdata"]["user-phone"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-note"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_note"] = addslashes($_POST["postdata"]["user-note"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-expired"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_expired"] = addslashes($_POST["postdata"]["user-expired"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-status"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_status"] = addslashes($_POST["postdata"]["user-status"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($_POST["postdata"]["user-password"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$postdata["user_password"] = sha1("imabuilder" . $_POST["postdata"]["user-password"]);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";

        $php_admin .= "\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_name` LIKE \'{$postdata["user_name"]}\' ";' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$data = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'if($data["exist"] == 0){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_email` LIKE \'{$postdata["user_email"]}\' ";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$data = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . 'if($data["exist"] == 0){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$sql_query = null ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$sql_query .= "INSERT INTO `users` (`user_name`,`user_birthday`,`user_first_name`,`user_last_name`,`user_email`,`user_company`,`user_website`,`user_level`,`user_password`,`user_token`,`user_address_1`,`user_address_2`,`user_city`,`user_state`,`user_postcode`,`user_country`,`user_phone`,`user_note`,`user_expired`,`user_status`) VALUES " ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$sql_query .= "(\'{$postdata["user_name"]}\',\'{$postdata["user_birthday"]}\',\'{$postdata["user_first_name"]}\',\'{$postdata["user_last_name"]}\', \'{$postdata["user_email"]}\',\'{$postdata["user_company"]}\', \'{$postdata["user_website"]}\', \'{$postdata["user_level"]}\', \'{$postdata["user_password"]}\', \'{$postdata["user_token"]}\', \'{$postdata["user_address_1"]}\',\'{$postdata["user_address_2"]}\', \'{$postdata["user_city"]}\',\'{$postdata["user_state"]}\',\'{$postdata["user_postcode"]}\',\'{$postdata["user_country"]}\', \'{$postdata["user_phone"]}\',\'{$postdata["user_note"]}\', \'{$postdata["user_expired"]}\', \'{$postdata["user_status"]}\');" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . 'header("Location: ?page=users&notice=success-add");' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'This <strong>email</strong> has already been used!\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$notification .= \'This <strong>username</strong> has already been used!\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";

        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$page_title = "Users - Add new User"; ' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h1>Users <small>Add, edit and delete your users</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li class="active">Users</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<li>Edit</li>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<form action="" method="post">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box box-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<h3 class="box-title">New user</h3>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Username</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-name]" placeholder="ahmad-dahlan" value="\' . htmlentities($postdata["user_name"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the username</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Birthday</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" data-type="date" class="form-control" name="postdata[user-birthday]" placeholder="" value="\' . htmlentities($postdata["user_birthday"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the birthday</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>First Name</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-first-name]" placeholder="Ahmad Dahlan" value="\' . htmlentities($postdata["user_first_name"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s first name</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Last Name</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-last-name]" placeholder="Ahmad Dahlan" value="\' . htmlentities($postdata["user_last_name"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s last name</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Phone</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-phone"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-phone]" placeholder="6281234568" value="\' . htmlentities($postdata["user_phone"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s phone</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Company</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-company]" placeholder="" value="\' . htmlentities($postdata["user_company"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s company</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Website</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="url" class="form-control" name="postdata[user-website]" placeholder="https://domain.com" value="\' . htmlentities($postdata["user_website"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s website</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Address 1</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-address-1]" placeholder="" value="\' . htmlentities($postdata["user_address_1"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s address 1</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Address 2</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-address-2]" placeholder="" value="\' . htmlentities($postdata["user_address_2"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s address 2</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>City</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-city]" placeholder="Pasaman Barat" value="\' . htmlentities($postdata["user_city"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s city</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>State</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-state]" placeholder="Sumatera Barat" value="\' . htmlentities($postdata["user_state"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s state</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Postcode</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-postcode]" placeholder="26567" value="\' . htmlentities($postdata["user_postcode"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s postcode</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Country</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" class="form-control" name="postdata[user-country]" placeholder="Indonesia" value="\' . htmlentities($postdata["user_country"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the user\\\'s country</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./col-md-6 -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Note</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<textarea name="postdata[user-note]" class="form-control">\' . htmlentities($postdata["user_note"]).\'</textarea>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write notes if needed</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Expired</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group date">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" data-type="datetime" class="form-control" name="postdata[user-expired]" placeholder="2019-11-08 14:00:09" value="\' . htmlentities($postdata["user_expired"]).\'" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the expiration time if it is needed</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$status_options[] = "pending" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$status_options[] = "active" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$status_options[] = "banned" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Status</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<select class="form-control" name="postdata[user-status]">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'foreach($status_options as $status_option){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$selected = "";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . 'if($status_option==$postdata["user_status"]){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t\t" . '$selected = "selected";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t\t" . '$content .= \'<option value="\'.$status_option.\'" \'.$selected.\'>\'.ucwords($status_option).\'</option>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</select>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">&nbsp;</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<hr/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="row">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Email</label>\';' . "\r\n";

        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="email" class="form-control" name="postdata[user-email]" placeholder="email@domain.com"  value="\' . htmlentities($postdata["user_email"]).\'" required/>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Write the email used to log in</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="col-md-6">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<label>Password</label>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group">\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<div class="input-group-addon"><i class="fa fa-lock"></i></div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<input type="text" minlength="6" class="form-control" name="postdata[user-password]" value="" />\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'<p class="help-block">Leave this blank if you do not want to change the user\\\'s password</p>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";


        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./col-md-6 -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$content .= \'</div><!-- ./row -->\';' . "\r\n";

        $php_admin .= "\t\t\t\t" . '$content .= \'</div><!-- ./box-body -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-user-plus"></i> Add User</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</div><!-- ./box -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</form><!-- ./form -->\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- USERS -+- DELETE
        $php_admin .= "\t\t\t" . 'case "delete":' . "\r\n";
        $php_admin .= "\t\t\t\t" . '// TO' . 'DO: PAGE - USERS - DELETE' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'if(isset($_GET["id"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$entry_id= (int)$_GET["id"];' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '/** fetch current data **/' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_id`=$entry_id AND `user_level` LIKE \'%user%\' LIMIT 0,1" ;' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '$rowdata = $result->fetch_array();' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'if(isset($rowdata["user_id"])){' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$sql_query = "DELETE FROM `users` WHERE `user_id`=$entry_id";' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=users&notice=success-delete");' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t\t" . 'header("Location: ?page=users&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}else{' . "\r\n";
        $php_admin .= "\t\t\t\t\t" . 'header("Location: ?page=users&notice=wrong-id");' . "\r\n";
        $php_admin .= "\t\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div><!-- ./content-wrapper -->\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<footer class="main-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-right hidden-xs">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<b>Version</b> ' . $_SESSION['CURRENT_APP']['apps']['app-version'] . '\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<strong>Copyright &copy; \'.date("Y").\' <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['author-organization'] . '</a>.</strong> All rights reserved.\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</footer>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div><!-- ./wrapper -->\';' . "\r\n";
        $php_admin .= "\t\t" . 'break;' . "\r\n";
    }
    if ($php_native['onesignal_enable'] == true)
    {
        // TODO: PHP CODE -+- PAGE -+- ONESIGNAL-SENDER
        $php_admin .= "\t" . '// TO' . 'DO: PAGE - ONESIGNAL-SENDER' . "\r\n";
        $php_admin .= "\t" . 'case "onesignal-sender":' . "\r\n";
        $php_admin .= "\t\t" . 'if($_SESSION["IS_LOGIN"]==false){' . "\r\n";
        $php_admin .= "\t\t\t" . 'header("Location: ?page=login");' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '$page_title = "Profile";' . "\r\n";
        $php_admin .= "\t\t" . '$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";' . "\r\n";
        $php_admin .= "\t\t" . '$current_user = $_SESSION["CURRENT_USER"];' . "\r\n";
        $php_admin .= "\t\t" . '$notification = null;' . "\r\n";
        $php_admin .= "\t\t" . 'if(isset($_POST["send-push"])){' . "\r\n";
        $php_admin .= "\t\t\t" . '$push_content = array("en" => $_POST["push-message"]);' . "\r\n";
        $php_admin .= "\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t" . '$fields = array(' . "\r\n";
        $php_admin .= "\t\t\t\t" . '"app_id" => $config["onesignal_app_id"],' . "\r\n";
        $php_admin .= "\t\t\t\t" . '"included_segments" => array("All"),' . "\r\n";
        $php_admin .= "\t\t\t\t" . '"data" => array("page" => ""),' . "\r\n";
        $php_admin .= "\t\t\t\t" . '"contents" => $push_content' . "\r\n";
        $php_admin .= "\t\t\t" . ');' . "\r\n";
        $php_admin .= "\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t" . '$fields = json_encode($fields);' . "\r\n";
        $php_admin .= "\t\t\t" . '$ch = curl_init();' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Authorization: Basic " . $config["onesignal_api_key"]));' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_HEADER, false);' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_POST, true);' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);' . "\r\n";
        $php_admin .= "\t\t\t" . '$response = json_decode(curl_exec($ch), true);' . "\r\n";
        $php_admin .= "\t\t\t" . 'curl_close($ch);' . "\r\n";
        $php_admin .= "\t\t" . '' . "\r\n";
        $php_admin .= "\t\t\t" . 'if (isset($response["errors"][0])){' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-danger">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .=  $response["errors"][0];' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t" . '} else{' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'<div id="notification" class="alert alert-success">\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'ID #\' . $response["id"] . \' with \' . $response["recipients"] . \' recipients\';' . "\r\n";
        $php_admin .= "\t\t\t\t" . '$notification .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '' . "\r\n";
        $php_admin .= "\t\t" . '}' . "\r\n";
        $php_admin .= "\t\t" . '$content = null;' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="wrapper">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<header class="main-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="logo">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="logo-mini"><b>PN</b>L</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="logo-lg"><b>\'.$app_name.\'</b> Panel</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<nav class="navbar navbar-static-top">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="sr-only">Toggle navigation</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="icon-bar"></span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="navbar-custom-menu">\';' . "\r\n";
        // TODO: PHP CODE -+- PAGE -+- PROFILE - RIGHT MENU
        $php_admin .= "\t\t" . '$content .= \'<ul class="nav navbar-nav">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="dropdown user user-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?" class="dropdown-toggle" data-toggle="dropdown">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="user-image" alt="User Image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<span class="hidden-xs">\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'</span>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="dropdown-menu">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="user-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="User Image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'\' . htmlentities(stripslashes($current_user[\'user_name\'])).\'\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<small>\' . htmlentities(stripslashes($current_user[\'user_level\'])).\'</small>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="user-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-right">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</nav>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</header>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<aside class="main-sidebar">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<section class="sidebar">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="user-panel">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left image">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<img src="https://www.gravatar.com/avatar/\' . md5(strtolower(trim($current_user[\'user_email\']))).\'" class="img-circle" alt="\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-left info">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<p>\'.htmlentities(stripslashes($current_user[\'user_name\'])).\'</p>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<a href="?"><i class="fa fa-circle text-success"></i> \'.htmlentities(stripslashes($current_user[\'user_level\'])).\'</a>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ul class="sidebar-menu" data-widget="tree">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="header">DATA MANAGER</li>\';' . "\r\n";
        $z = 0;
        foreach ($tables as $menu)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="treeview">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<a href="?">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-' . $menu['table-icon-fontawesome'] . '"></i> <span>' . $menu['table-plural-name'] . '</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<span class="pull-right-container">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<i class="fa fa-angle-left pull-right"></i>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</span>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</a>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<ul class="treeview-menu">\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=' . $string->toFilename(str_replace('_', '-', $menu['table-name'])) . '&amp;action=list"><i class="fa fa-list-ul"></i> All ' . $menu['table-plural-name'] . '</a></li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'</li>\';' . "\r\n";
            $z++;
        }
        // TODO: PHP CODE -+- PAGE -+- HOME -+- TABLE - RIGHT MENU - ONESIGNAL MENU
        if ($php_native['onesignal_enable'] == true)
        {
            $php_admin .= "\t\t" . '$content .= \'<li class="header">TOOLS</li>\';' . "\r\n";
            $php_admin .= "\t\t" . '$content .= \'<li class="active"><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>\';' . "\r\n";
        }
        $php_admin .= "\t\t" . '$content .= \'<li class="header">USERS</li>\';' . "\r\n";
        if ($php_native['multiuser_enable'] == true)
        {
            $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=users"><i class="fa fa-users"></i> <span>Users</span></a></li>\';' . "\r\n";
        }
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ul>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</aside>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="content-wrapper">\';' . "\r\n";
        $php_admin .= "\t\t" . '/** breadcrumb **/' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<section class="content-header">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<h1>OneSignal Sender <small>Send push notifications for your app</small></h1>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<ol class="breadcrumb">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<li class="active">OneSignal Sender</li>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</ol>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t" . '/** content **/' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<section class="content">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= $notification;' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<form action="" method="post">\';' . "\r\n"; //form
        $php_admin .= "\t\t" . '$content .= \'<div class="box box-danger">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="box-header with-border">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<h3 class="box-title">Push Notification</h3>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="box-tools pull-right">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="box-body">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="form-group">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<label class="">Message</label>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<textarea class="form-control" name="push-message"></textarea>\';' . "\r\n"; //form-group
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //form-group
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box-body
        $php_admin .= "\t\t" . '$content .= \'<div class="box-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<button type="submit" class="btn btn-flat btn-danger" name="send-push"><i class="fa fa-plane"></i> Send notification!</button>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n"; //box
        $php_admin .= "\t\t" . '$content .= \'</form>\';' . "\r\n"; //form
        $php_admin .= "\t\t" . '$content .= \'</section>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div><!-- ./content-wrapper -->\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<footer class="main-footer">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<div class="pull-right hidden-xs">\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<b>Version</b> ' . $_SESSION['CURRENT_APP']['apps']['app-version'] . '\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'<strong>Copyright &copy; \'.date("Y").\' <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['author-organization'] . '</a>.</strong> All rights reserved.\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</footer>\';' . "\r\n";
        $php_admin .= "\t\t" . '$content .= \'</div><!-- ./wrapper -->\';' . "\r\n";
        $php_admin .= "\t\t" . 'break;' . "\r\n";
    }
    $php_admin .= "" . '}' . "\r\n";
    $php_admin .= "\r\n";
    $php_admin .= '$mysql->close();' . "\r\n";

    // TODO: PHP CODE -+- PAGE -+- HTML
    $php_admin .= '$html_tags = null;' . "\r\n";
    $php_admin .= '$html_tags .= \'<!DOCTYPE html>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<html>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<head>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<meta charset="utf-8">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<meta http-equiv="X-UA-Compatible" content="IE=edge">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<meta name="generator" content="IMA-BuildeRz v' . JSM_VERSION . '" />\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<title>\'. htmlentities($app_name .\' | \'. $page_title) .\'</title>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/AdminLTE.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/skins/_all-skins.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/css/dataTables.bootstrap.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/css/bootstrap-datetimepicker.min.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck@1/skins/all.css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<!--[if lt IE 9]>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<![endif]-->\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton|Staatliches|Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<style type="text/css">\';' . "\r\n";
    $php_admin .= '$html_tags .= \'body{background: url(\\\'\'.$config["background"].\'\\\') no-repeat center center fixed !important; -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important; background-size: cover !important; }\';' . "\r\n";
    $php_admin .= '$html_tags .= \'.well h1 {font-weight:600;font-family:Anton;font-size:48px;}\';' . "\r\n";
    $php_admin .= '$html_tags .= \'.content-header h1 {font-size:32px;font-family:Anton;}\';' . "\r\n";
    $php_admin .= '$html_tags .= \'.login-logo img {width: 100px;height: 100px;}\';' . "\r\n";
    $php_admin .= '$html_tags .= \'.login-logo a, .register-logo a {color: #fff;text-shadow: 1px 1px 1px #333;-webkit-text-shadow: 1px 1px 1px #333;-moz-text-shadow: 1px 1px 1px #333;-o-text-shadow: 1px 1px 1px #333;}\';' . "\r\n";
    $php_admin .= '$html_tags .= \'hr {border-top: 1px solid #ddd;}\';' . "\r\n";

    $php_admin .= '$html_tags .= \'.bootstrap-tagsinput{display: block !important;border-radius: 0 !important;}\';' . "\r\n";
    $php_admin .= '$html_tags .= \'</style>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'</head>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<body class="\'.$body_class.\'">\';' . "\r\n";
    $php_admin .= '$html_tags .= $content ;' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/js/bootstrap.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/datatables.net@1/js/jquery.dataTables.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/js/dataTables.bootstrap.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/ckeditor.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/adapters/jquery.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/js/bootstrap-datetimepicker.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/icheck@1/icheck.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script src="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/js/adminlte.min.js"></script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'<script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$(document).ready(function(){\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$(".delete").on("click",function(){ var target = $(this).attr("data-target") ;$(target).replaceWith(""); });\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$(".sidebar-menu").tree();\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$(".datatable").length && $(".datatable").dataTable({"order":[[0,"desc"]]});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$("textarea[data-type=\\\'html5\\\']").length && $("textarea[data-type=\\\'html5\\\']").ckeditor({filebrowserBrowseUrl:"?page=file-browser"});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$("input[data-type=\\\'tags\\\']").length && $("input[data-type=\\\'tags\\\']").tagsinput();\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$("input[data-type=\\\'date\\\']").length && $("input[data-type=\\\'date\\\']").datetimepicker({format:\\\'YYYY-MM-DD\\\'});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$("input[data-type=\\\'datetime\\\']").length && $("input[data-type=\\\'datetime\\\']").datetimepicker({format:"YYYY-MM-DD HH:mm:ss"});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$("input[data-type=\\\'time\\\']").length && $("input[data-type=\\\'time\\\']").datetimepicker({format:"HH:mm:ss"});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'$("input[type=\\\'radio\\\'].flat-red").length && $("input[type=\\\'radio\\\'].flat-red").iCheck({checkboxClass:"icheckbox_flat-red",radioClass:"iradio_flat-red"});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'var fileBrowserTarget="undefined";window.fileBrowser={callBack:function(a){$(fileBrowserTarget).val(a)},open:function(a){var b=window.open("?page=file-browser","File Browser","scrollbars=no, width=1028, height=480, top="+((window.innerHeight?window.innerHeight:document.documentElement.clientHeight?document.documentElement.clientHeight:screen.height)/2-240+(void 0!=window.screenTop?window.screenTop:window.screenY))+", left="+((window.innerWidth?window.innerWidth:document.documentElement.clientWidth?document.documentElement.clientWidth:screen.width)/2-514+(void 0!=window.screenLeft?window.screenLeft:window.screenX)));fileBrowserTarget=a;window.focus&&b.focus()}};if($(\\\'*[data-type="file-picker"]\\\').length)$(\\\'*[data-type="file-picker"]\\\').on("click",function(){var a=$(this).attr("data-target");fileBrowser.open(a);return!1});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'});\';' . "\r\n";
    $php_admin .= '$html_tags .= \'function doModal(a,l,d,m,t){html=\\\'<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">\\\',html+=\\\'<div class="modal-dialog">\\\',html+=\\\'<div class="modal-content">\\\',html+=\\\'<div class="modal-header">\\\',html+=\\\'<a class="close" data-dismiss="modal">&times;</a>\\\',html+="<h4 class=\"modal-title\">"+a+"</h4>",html+="</div>",html+=\\\'<div class="modal-body">\\\',html+=l,html+="</div>",html+=\\\'<div class="modal-footer">\\\',""!=d&&(html+=\\\'<span class="btn btn-flat btn-\\\'+m+\\\'" onClick="\\\'+t+\\\'">\\\'+d+"</span>"),html+=\\\'<span class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</span>\\\',html+="</div>",html+="</div>",html+="</div>",html+="</div>",$("body").append(html),$("#dynamicModal").modal(),$("#dynamicModal").modal("show"),$("#dynamicModal").on("hidden.bs.modal",function(a){$(this).remove()})}\';' . "\r\n";
    $php_admin .= '$html_tags .= \'setTimeout(function(){$("#notification").fadeOut()},5e3);\';' . "\r\n";
    $php_admin .= '$html_tags .= \'</script>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'</body>\';' . "\r\n";
    $php_admin .= '$html_tags .= \'</html>\';' . "\r\n";
    $php_admin .= 'echo $html_tags;' . "\r\n";


    // TODO: PHP API CODE --+--
    if (!isset($php_native['php_timezone']))
    {
        $php_native['php_timezone'] = 'Asia/Jakarta';
    }
    if ($php_native['php_timezone'] == '')
    {
        $php_native['php_timezone'] = 'Asia/Jakarta';
    }
    $php_api = null;
    $php_api .= '<?php' . "\r\n\r";
    $php_api .= "/**\r\n";
    $php_api .= " * @author " . $_SESSION['CURRENT_APP']['apps']['author-name'] . " <" . $_SESSION['CURRENT_APP']['apps']['author-email'] . ">\r\n";
    $php_api .= " * @copyright " . $_SESSION['CURRENT_APP']['apps']['author-organization'] . " " . date("Y") . "\r\n";
    $php_api .= " * @package " . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . "\r\n";
    $php_api .= " * @created " . date("d-m-Y H:i:s") . "\r\n";
    $php_api .= " * \r\n";
    $php_api .= " * \r\n";
    $php_api .= " * Created using IMABuildeRz v3 (" . JSM_VERSION . ")\r\n";
    $php_api .= " */\r\n";
    $php_api .= "\r\n";
    $php_api .= "\r\n";
    $php_api .= "/** site **/" . "\r\n";
    $php_api .= "" . '$config["app-name"]' . "\t\t\t" . '= "' . $php_native['site_name'] . '" ; //Write the name of your website' . "\r\n";
    $php_api .= "" . '$config["app-desc"]' . "\t\t\t" . '= "' . $_SESSION['CURRENT_APP']['apps']['app-description'] . '" ; //Write a brief description of your website' . "\r\n";
    $php_api .= "" . '$config["utf8"]' . "\t\t\t\t" . '= true; ' . "\r\n";
    if ($php_native['debugger_enable'] == true)
    {
        $php_api .= "" . '$config["debug"]' . "\t\t\t" . '= true; ' . "\r\n";
    } else
    {
        $php_api .= "" . '$config["debug"]' . "\t\t\t" . '= false; ' . "\r\n";
    }
    if ($php_native['api_protector_enable'] == true)
    {
        $php_api .= "" . '$config["protect"]' . "\t\t\t" . '= true; ' . "\r\n";
    } else
    {
        $php_api .= "" . '$config["protect"]' . "\t\t\t" . '= false; ' . "\r\n";
    }
    $php_api .= "" . '$config["url"]' . "\t\t\t" . '= "' . $php_native['api_url'] . '"; ' . "\r\n";
    $php_api .= "" . '$config["userfile_url"]' . "\t\t\t" . '= "' . $php_native['userfile_url'] . '"; // leave blank for absolute urls' . "\r\n";
    $php_api .= "" . '$config["timezone"]' . "\t\t\t" . '= "' . $php_native['php_timezone'] . '" ; // check this site: http://php.net/manual/en/timezones.php' . "\r\n";


    if ($php_native['gzip_enable'] == true)
    {
        $php_api .= "" . '$config["gzip"]' . "\t\t\t" . '= true; //compressed page ' . "\r\n";
    } else
    {
        $php_api .= "" . '$config["gzip"]' . "\t\t\t" . '= false; //compressed page ' . "\r\n";
    }

    $php_api .= "\r\n";
    $php_api .= "/** mysql **/" . "\r\n";
    $php_api .= "" . '$config["db_host"]' . "\t\t\t\t" . '= "' . $php_native['db_host'] . '" ; //host' . "\r\n";
    $php_api .= "" . '$config["db_user"]' . "\t\t\t\t" . '= "' . $php_native['db_user'] . '" ; //Username SQL' . "\r\n";
    $php_api .= "" . '$config["db_pwd"]' . "\t\t\t\t" . '= "' . $php_native['db_pwd'] . '" ; //Password SQL' . "\r\n";
    $php_api .= "" . '$config["db_name"]' . "\t\t\t" . '= "' . $php_native['db_name'] . '" ; //Database' . "\r\n";
    $php_api .= "\r\n";
    $php_api .= "\r\n/** DON'T EDIT THE CODE BELLOW **/";
    $php_api .= "\r\n";
    $php_api .= "" . 'session_start();' . "\r\n";
    $php_api .= "" . 'if($config["gzip"]==true){' . "\r\n";
    $php_api .= "\t" . 'ob_start("ob_gzhandler");' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "" . 'ini_set("internal_encoding", "utf-8");' . "\r\n";
    $php_api .= "" . 'date_default_timezone_set($config["timezone"]);' . "\r\n";
    $php_api .= "" . 'if($config["debug"]==true){' . "\r\n";
    $php_api .= "\t" . 'error_reporting(E_ALL);' . "\r\n";
    $php_api .= "" . '}else{' . "\r\n";
    $php_api .= "\t" . 'error_reporting(0);' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "\r\n";
    $php_api .= "" . 'if($config["protect"]==true){' . "\r\n";
    $php_api .= "\t" . 'if(isset($_SERVER["HTTP_USER_AGENT"])){' . "\r\n";
    $php_api .= "\t\t" . 'if(!preg_match("/' . preg_quote($_SESSION['CURRENT_APP']['apps']['app-prefix']) . '/i",$_SERVER["HTTP_USER_AGENT"])){' . "\r\n";
    $php_api .= "\t\t\t" . 'die("Not allowed");' . "\r\n";
    $php_api .= "\t\t" . '}' . "\r\n";
    $php_api .= "\t" . '}else{' . "\r\n";
    $php_api .= "\t\t" . 'die("Not allowed");' . "\r\n";
    $php_api .= "\t" . '}' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "\r\n";

    $php_api .= "" . 'if(isset($_SERVER["HTTP_X_AUTHORIZATION"])){' . "\r\n";
    $php_api .= "\t" . '$_SERVER["HTTP_AUTHORIZATION"] = $_SERVER["HTTP_X_AUTHORIZATION"];' . "\r\n";
    $php_api .= "" . '}' . "\r\n";


    $php_api .= "" . '/** CONNECT TO MYSQL **/' . "\r\n";
    $php_api .= "" . '$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);' . "\r\n";
    $php_api .= "" . 'if (mysqli_connect_errno()){' . "\r\n";
    $php_api .= "\t" . 'die(mysqli_connect_error());' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "\r\n";
    $php_api .= "" . 'if($config["utf8"]==true){' . "\r\n";
    $php_api .= "\t" . '$mysql->set_charset("utf8");' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "" . 'if(!isset($_GET["api"])){' . "\r\n";
    $php_api .= "\t" . '$_GET["api"]= "route";' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "" . '$root_url = $config["url"];' . "\r\n";
    $php_api .= '$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Routes not found");' . "\r\n";
    $php_api .= "" . 'switch($_GET["api"]){' . "\r\n";
    $php_api .= "\t" . 'case "route":' . "\r\n";
    $php_api .= "\t\t" . '// TO' . 'DO: JSON --+-- ROUTES' . "\r\n";
    $php_api .= "\t\t" . '$rest_api=array();' . "\r\n";
    $php_api .= "\t\t" . '$rest_api["name"] = "' . $php_native['site_name'] . '" ;' . "\r\n";
    $php_api .= "\t\t" . '$rest_api["description"] = "' . $_SESSION['CURRENT_APP']['apps']['app-description'] . '" ;' . "\r\n";
    $php_api .= "\t\t" . '$rest_api["generator"] = "IMA-BuildeRz v' . JSM_VERSION . '" ;' . "\r\n";
    $z = 0;
    if ($php_native['multiuser_enable'] == true)
    {
        $php_api .= "\r\n\t\t" . '$rest_api["namespaces"][' . $z . '] = "jwt-auth/";';
    }
    $z++;
    foreach ($tables as $table)
    {
        $php_api .= "\r\n\t\t" . '$rest_api["namespaces"][' . $z . '] = "' . strtolower(str_replace('_', '-', $table['table-name'])) . '/";';
        $z++;
    }
    if ($php_native['multiuser_enable'] == true)
    {
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/"]["namespace"] = "jwt-auth/";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/"]["methods"][0] = "POST";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/"]["endpoints"]["methods"][0] = "POST";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/"]["endpoints"]["args"] = array();';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["namespace"] = "jwt-auth/";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["methods"][0] = "POST";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["methods"][0] = "POST";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["args"] = array();';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["namespace"] = "jwt-auth/";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["methods"][0] = "POST";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["methods"][0] = "POST";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["args"] = array();';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token-validate";';
    }
    $z = 0;
    foreach ($tables as $table)
    {
        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $php_api .= "\r\n";
        $route = strtolower(str_replace('_', '-', $table['table-name']));
        $namespace = $route . '/';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["namespace"] = "' . $namespace . '";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["methods"][0] = "GET";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["methods"][0] = "GET";';
        $new_colums = $table['table-cols'];
        $t = 0;
        foreach ($new_colums as $col)
        {
            if ($col['type'] != 'id')
            {
                $fixcol = strtolower(str_replace('_', '-', $col['variable']));
                switch ($col['type'])
                {
                    case 'id':
                        break;
                    case 'varchar':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'select-table':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'tinytext':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'text':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'longtext':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'number':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "integer";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'date':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'time':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'datetime':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'boolean':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "boolean";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][0] = "true";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][1] = "false";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'select':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'url':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'email':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                    case 'phone':
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                        break;
                }
                $t++;
            }
        }
        $z++;
        $php_api .= "\r\n";
        $fixcol = 'orderby';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col_id . '";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
        $t = 0;
        foreach ($new_colums as $col)
        {
            $val_col = strtolower(str_replace('_', '-', $col['variable']));
            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][' . $t . '] = "' . $val_col . '";';
            $t++;
        }
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Sort collection by object attribute";';
        $fixcol = 'sort';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "asc";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][0] = "asc";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][1] = "desc";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Order sort attribute ascending or descending";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["_links"][0] = $root_url . "?api=' . $route . '";';
        $php_api .= "\r\n";
        $single_col = '/' . $namespace . '(?P<' . str_replace('_', '-', $col_id) . '>[\d]+)';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["' . $single_col . '"]["namespace"] = "' . $namespace . '";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["' . $single_col . '"]["method"][0] = "GET";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["' . $single_col . '"]["endpoints"]["args"]["' . str_replace('_', '-', $col_id) . '"]["required"] = "true";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["' . $single_col . '"]["endpoints"]["args"]["' . str_replace('_', '-', $col_id) . '"]["type"] = "integer";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["' . $single_col . '"]["endpoints"]["args"]["' . str_replace('_', '-', $col_id) . '"]["description"] = "Unique identifier for the object";';
        $php_api .= "\r\n\t\t" . '$rest_api["routes"]["' . $single_col . '"]["endpoints"]["_links"][0] = $root_url . "?api=' . $route . '&' . str_replace('_', '-', $col_id) . '=<' . str_replace('_', '-', $col_id) . '>";';
        if (!isset($table['form-method']))
        {
            $table['form-method'] = 'none';
        }
        if (($table['form-method'] == 'post') || ($table['form-method'] == 'get') || ($table['form-method'] == 'put'))
        {
            $namespace = 'form-' . $route . '/';
            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["namespace"] = "' . $namespace . '";';
            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["methods"][0] = "' . strtoupper($table['form-method']) . '";';
            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["methods"][0] = "' . strtoupper($table['form-method']) . '";';
            foreach ($new_colums as $col)
            {
                if ($col['json_input'] == true)
                {
                    $fixcol = strtolower(str_replace('_', '-', $col['variable']));
                    switch ($col['type'])
                    {
                        case 'id':
                            break;
                        case 'varchar':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'select-table':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'tinytext':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'text':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'longtext':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'number':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "integer";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'date':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'time':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'datetime':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'boolean':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "boolean";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][0] = "true";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["enum"][1] = "false";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'select':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'url':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'email':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                        case 'phone':
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["required"] = false;';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["default"] = "' . $col['default'] . '";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["type"] = "string";';
                            $php_api .= "\r\n\t\t" . '$rest_api["routes"]["/' . $namespace . '"]["endpoints"][0]["args"]["' . $fixcol . '"]["description"] = "Limit result set to items with more specific by `' . $col['variable'] . '`.";';
                            break;
                    }
                    $t++;
                }
            }
        }
    }
    $php_api .= "\t\t" . 'break;' . "\r\n";
    if ($php_native['multiuser_enable'] == true)
    {
        $php_api .= "\t" . '' . "\r\n";
        $php_api .= "\t" . '' . "\r\n";
        // TODO: PHP API CODE --+-- JWT-AUTH
        $php_api .= "\t" . '// TO' . 'DO: JSON --+-- JWT-AUTH' . "\r\n";
        $php_api .= "\t" . 'case "jwt-auth":' . "\r\n";
        $php_api .= "\t\t" . '$rest_api = array();' . "\r\n";
        $php_api .= "\t\t" . 'if(!isset($_GET["action"])){' . "\r\n";
        $php_api .= "\t\t\t" . '$_GET["action"]="default";' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\t" . '' . "\r\n";
        $php_api .= "\t\t" . 'switch( filter_var($_GET["action"], FILTER_DEFAULT)){' . "\r\n";
        $php_api .= "\t\t\t" . 'case "default":' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["namespace"] = "jwt-auth/";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["methods"][0] = "POST";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["methods"][0] = "POST";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["args"] = array();' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["namespace"] = "jwt-auth/";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["methods"][0] = "POST";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["methods"][0] = "POST";' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["args"] = array();' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token-validate";' . "\r\n";
        $php_api .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t" . '' . "\r\n";
        // TODO: PHP API CODE --+-- JWT-AUTH --+-- TOKEN
        $php_api .= "\t\t\t" . '// TO' . 'DO: JSON --+-- JWT-AUTH --+-- TOKEN' . "\r\n";
        $php_api .= "\t\t\t" . 'case "token":' . "\r\n";
        $php_api .= "\t\t\t\t" . 'if(isset($_POST["username"]) && isset($_POST["password"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$user_email = filter_var($_POST["username"],FILTER_VALIDATE_EMAIL);' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$user_password = sha1("imabuilder" . $_POST["password"] );' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_email` = \'{$user_email}\' AND `user_password` = \'{$user_password}\'";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($current_user["user_email"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . 'switch($current_user["user_status"]){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'case "pending":' . "\r\n";
        //$php_api .= "\t\t\t\t\t\t\t\t" . 'header("HTTP/1.1 403 Forbidden");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: This account is currently being suspended/pending";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["status"] = 403;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 403;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'case "banned":' . "\r\n";
        //$php_api .= "\t\t\t\t\t\t\t\t" . 'header("HTTP/1.1 403 Forbidden");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: This account has been banned";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["status"] = 403;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 403;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'case "active":' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$user_token = sha1(session_id().$_SERVER["HTTP_USER_AGENT"].$_SERVER["REMOTE_ADDR"]);' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$sql_query = "UPDATE `users` SET `user_token` = \'{$user_token}\' WHERE `user_email` = \'{$user_email}\'";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . 'header("HTTP/1.1 200 OK");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["token"] = $user_token;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_id"] = $current_user["user_id"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_name"] = $current_user["user_name"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_birthday"] = $current_user["user_birthday"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_email"] = $current_user["user_email"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_first_name"] = $current_user["user_first_name"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_last_name"] = $current_user["user_last_name"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_company"] = $current_user["user_company"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_level"] = $current_user["user_level"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_website"] = $current_user["user_website"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_address_1"] = $current_user["user_address_1"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_address_2"] = $current_user["user_address_2"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_city"] = $current_user["user_city"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_state"] = $current_user["user_state"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_postcode"] = $current_user["user_postcode"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_country"] = $current_user["user_country"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_phone"] = $current_user["user_phone"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_note"] = $current_user["user_note"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["user_expired"] = $current_user["user_expired"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 200;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}else{' . "\r\n";
        //$php_api .= "\t\t\t\t\t\t" . 'header("HTTP/1.1 403 Forbidden");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: Username or password is incorrect!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["status"] = 403;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 403;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
        //$php_api .= "\t\t\t\t\t" . 'header("HTTP/1.1 404 Not found");' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["message"] = "400 Bad Request";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["status"] = 404;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["statusText"] = "Bad Request";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["data"]["status"] = 400;' . "\r\n";
        $php_api .= "\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t" . '' . "\r\n";
        // TODO: PHP API CODE --+-- JWT-AUTH --+-- TOKEN-VALIDATE
        $php_api .= "\t\t\t" . '// TO' . 'DO: JSON --+-- JWT-AUTH --+-- TOKEN-VALIDATE' . "\r\n";
        $php_api .= "\t\t\t" . 'case "token-validate":' . "\r\n";
        $php_api .= "\t\t\t\t" . 'if(isset($_SERVER["HTTP_AUTHORIZATION"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$user_token = trim(substr($_SERVER["HTTP_AUTHORIZATION"],6)) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(strlen($user_token) > 6 ){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_token` = \'{$user_token}\' AND `user_status` = \'active\'";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . 'if(isset($current_user["user_email"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'header("HTTP/1.1 200 OK");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 200;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["token"] = $user_token;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_email"] = $current_user["user_email"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_first_name"] = $current_user["user_first_name"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_website"] = $current_user["user_website"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_address"] = $current_user["user_address"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_phone"] = $current_user["user_phone"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_note"] = $current_user["user_note"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["user_expired"] = $current_user["user_expired"];' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '//header("HTTP/1.1 401 Unauthorized");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: Data Token invalid!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["status"] = 401;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 401;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '//header("HTTP/1.1 401 Unauthorized");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: Data Token not found!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["status"] = 401;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 401;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '//header("HTTP/1.1 401 Unauthorized");' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: Data Token not found!";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["status"] = 401;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["data"]["status"] = 401;' . "\r\n";
        $php_api .= "\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t\t\t\t" . '' . "\r\n";
        // TODO: PHP API CODE --+-- JWT-AUTH --+-- REGISTER
        $php_api .= "\t\t\t" . '// TO' . 'DO: JSON --+-- JWT-AUTH --+-- REGISTER' . "\r\n";
        $php_api .= "\t\t\t" . 'case "register":' . "\r\n";
        $php_api .= "\t\t\t\t" . '$_POST = json_decode(file_get_contents("php://input"),true);' . "\r\n";
        $php_api .= "\t\t\t\t" . 'if(isset($_POST["username"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_name"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_email"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_password"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_birthday"] = "1990-01-01";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_website"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_first_name"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_last_name"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_company"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_address_1"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_address_2"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_city"] = "";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_state"] = "";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_postcode"] = "";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_country"] = "";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_level"] = "user";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_token"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_phone"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_note"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_expired"] = "0000-00-00 00:00:00";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$postdata["user_status"] = null;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["username"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_name"] = $mysql->real_escape_string($_POST["username"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["email"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_email"] = $mysql->real_escape_string($_POST["email"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["password"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_password"] = $mysql->real_escape_string($_POST["password"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["birthday"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_birthday"] = $mysql->real_escape_string($_POST["birthday"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["url"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_website"] = $mysql->real_escape_string($_POST["url"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["first_name"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_first_name"] = $mysql->real_escape_string($_POST["first_name"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["last_name"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_last_name"] = $mysql->real_escape_string($_POST["last_name"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["last_name"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_company"] = $mysql->real_escape_string($_POST["last_name"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["address_1"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_address_1"] = $mysql->real_escape_string($_POST["address_1"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["address_2"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_address_2"] = $mysql->real_escape_string($_POST["address_2"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["city"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_city"] = $mysql->real_escape_string($_POST["city"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["state"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_state"] = $mysql->real_escape_string($_POST["state"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["postcode"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_postcode"] = $mysql->real_escape_string($_POST["postcode"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["country"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_country"] = $mysql->real_escape_string($_POST["country"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'if(isset($_POST["phone"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$postdata["user_phone"] = $mysql->real_escape_string($_POST["phone"]) ;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";

        $php_api .= "\t\t\t\t\t" . 'if(($postdata["user_name"] != "") && ($postdata["user_email"] != "") && ($postdata["user_password"] != "")){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_email` LIKE \'{$postdata["user_email"]}\'";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . 'if(isset($current_user["user_email"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'header("HTTP/1.1 400 Bad Request");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["message"] = "Email `{$postdata["user_email"]}` has been exist, please login!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["title"] = "Ops, error!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["code"] = 406;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 400;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_name` LIKE \'{$postdata["user_name"]}\'";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . 'if(isset($current_user["user_name"])){' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . 'header("HTTP/1.1 400 Bad Request");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["message"] = "Username: `{$postdata["user_name"]}` has been exist, please login!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["title"] = "Ops, error!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["code"] = 406;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 400;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '}else{' . "\r\n";

        $fields[] = 'user_name';
        $fields[] = 'user_email';
        $fields[] = 'user_password';
        $fields[] = 'user_birthday';
        $fields[] = 'user_website';
        $fields[] = 'user_first_name';
        $fields[] = 'user_last_name';
        $fields[] = 'user_company';
        $fields[] = 'user_address_1';
        $fields[] = 'user_address_2';
        $fields[] = 'user_city';
        $fields[] = 'user_state';
        $fields[] = 'user_postcode';
        $fields[] = 'user_country';
        $fields[] = 'user_phone';

        $vars = '`' . implode("`,`", $fields) . '`';
        $values = "'{\\\$postdata[\'" . implode("\']}','{\\\$postdata[\'", $fields) . "\']}'";

        $php_api .= "\t\t\t\t\t\t\t\t" . '$sql_query = "INSERT INTO `users` (' . $vars . ') VALUES (' . $values . ')" ;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$stmt = $mysql->prepare($sql_query);' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$stmt->execute();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$stmt->close();' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . 'header("HTTP/1.1 200 OK");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["message"] = "User \'{$postdata["user_name"]}\' Registration was Successful";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["title"] = "Successfully!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["code"] = 200;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 200;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '}' . "\r\n";


        $php_api .= "\t\t\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . 'header("HTTP/1.1 400 Bad Request");' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["message"] = "Username, Email and Password field are required!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["title"] = "Ops, error!";' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["code"] = 406;' . "\r\n";
        $php_api .= "\t\t\t\t\t\t" . '$rest_api["data"]["status"] = 400;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t\t" . 'header("HTTP/1.1 400 Bad Request");' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: Invalid method!";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["status"] = 400;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["statusText"] = "Bad Request";' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["code"] = 406;' . "\r\n";
        $php_api .= "\t\t\t\t\t" . '$rest_api["data"]["status"] = 400;' . "\r\n";
        $php_api .= "\t\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . 'break;' . "\r\n";
    }
    foreach ($tables as $table)
    {
        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $php_api .= "\t" . 'case "' . str_replace('_', '-', $table['table-name']) . '":' . "\r\n";
        $php_api .= "\t\t" . '$rest_api = array();' . "\r\n";
        if ($php_native['multiuser_enable'] == true)
        {
            // TODO: PHP API CODE --+-- TABLE --+-- AUTH
            if (!isset($table['auth-enable']))
            {
                $table['auth-enable'] = false;
            }
            if ($table['auth-enable'] == true)
            {
                $php_api .= "\t\t" . '/** required auth **/' . "\r\n";


                $php_api .= "\t\t" . '$user_token = trim(substr($_SERVER["HTTP_AUTHORIZATION"],6)) ;' . "\r\n";
                $php_api .= "\t\t" . 'if($user_token == ""){' . "\r\n";
                $php_api .= "\t\t\t" . '$user_token = "4ac8d9aa31d6988199c12cffebad4d84ad865afd";' . "\r\n";
                $php_api .= "\t\t" . '}' . "\r\n";
                $php_api .= "\t\t" . '$sql_query = "SELECT * FROM `users` WHERE `user_token` = \'{$user_token}\' AND `user_status` = \'active\'";' . "\r\n";
                $php_api .= "\t\t" . '$result = $mysql->query($sql_query);' . "\r\n";
                $php_api .= "\t\t" . '$current_user = $result->fetch_array();' . "\r\n";
                $php_api .= "\t\t" . 'if(isset($current_user["user_email"])){' . "\r\n";
                $php_api .= "\t\t\t" . '//ok' . "\r\n";
                $php_api .= "\t\t" . '}else{' . "\r\n";
                //$php_api .= "\t\t\t" . 'header("HTTP/1.1 401 Unauthorized");' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api["message"] = "<strong>ERROR</strong>: Data Token is invalid!";' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api["name"] = "HttpErrorResponse";' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api["status"] = 401;' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api["statusText"] = "Forbidden";' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api["token"] = $user_token;' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api["data"]["status"] = 401;' . "\r\n";
                $php_api .= "\t\t\t" . 'break;' . "\r\n";
                $php_api .= "\t\t" . '}' . "\r\n";
            }
        }

        // TODO: PHP API CODE --+-- TABLE --+--
        $php_api .= "\t\t" . '// TO' . 'DO: JSON --+-- ' . strtoupper(str_replace('_', '-', $table['table-name'])) . '' . "\r\n";
        $new_colums = $table['table-cols'];
        // TODO: PHP API CODE - FINDING ID
        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $php_api .= "\t\t" . '/** statement `where` **/' . "\r\n";
        foreach ($new_colums as $col)
        {
            $varGet = str_replace('_', '-', $col['variable']);
            $php_api .= "\r\n";
            $php_api .= "\t\t" . 'if(isset($_GET["' . $varGet . '"])){' . "\r\n";
            $php_api .= "\t\t\t" . 'if($_GET["' . $varGet . '"] != "-1"){' . "\r\n";
            // TODO: PHP API CODE - TABLE JSON - COLUMN TYPE - STATEMENT --|-- OK
            switch ($col['type'])
            {
                case 'id':
                    $php_api .= "\t\t\t\t" . 'if($_GET["' . str_replace('_', '-', $col_id) . '"]=="random"){' . "\r\n";
                    $php_api .= "\t\t\t\t\t" . '$_GET["orderby"] = "random";' . "\r\n";
                    $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
                    $php_api .= "\t\t\t\t\t" . '$id = (int)$_GET["' . $varGet . '"] ; ' . "\r\n";
                    $php_api .= "\t\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` =$id"; ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '}' . "\r\n";
                    break;
                case 'number-fixed-length':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'varchar':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'multi-images':
                    break;
                case 'multi-text':
                    break;
                case 'thumbnail':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'image':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'file':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'select-table':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'$value\'"; ' . "\r\n";
                    break;
                case 'tinytext':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'text':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'longtext':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'number':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` =$value"; ' . "\r\n";
                    break;
                case 'date':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'time':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'datetime':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'boolean':
                    $php_api .= "\t\t\t\t" . 'if(strtolower($_GET["' . $varGet . '"]) == "true"){' . "\r\n";
                    $php_api .= "\t\t\t\t\t" . '$_GET["' . $varGet . '"] = 1;' . "\r\n";
                    $php_api .= "\t\t\t\t" . '}' . "\r\n";
                    $php_api .= "\t\t\t\t" . 'if(strtolower($_GET["' . $varGet . '"]) == "false"){' . "\r\n";
                    $php_api .= "\t\t\t\t\t" . '$_GET["' . $varGet . '"] = 0;' . "\r\n";
                    $php_api .= "\t\t\t\t" . '}' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'select':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'$value\'"; ' . "\r\n";
                    break;
                case 'url':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'%$value%\'"; ' . "\r\n";
                    break;
                case 'email':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'$value\'"; ' . "\r\n";
                    break;
                case 'phone':
                    $php_api .= "\t\t\t\t" . '$value = $mysql->escape_string($_GET["' . $varGet . '"]); ' . "\r\n";
                    $php_api .= "\t\t\t\t" . '$statement[] = "`' . $col['variable'] . '` LIKE \'$value\'"; ' . "\r\n";
                    break;
                case 'blob':
                    $php_api .= "\t\t\t\t" . '' . "\r\n";
                    $php_api .= "\t\t\t\t" . '' . "\r\n";
                    break;
            }
            $php_api .= "\t\t\t" . '}' . "\r\n";
            $php_api .= "\t\t" . '}' . "\r\n";
        }
        $php_api .= "\r\n";
        $php_api .= "\t\t" . '$where ="" ;' . "\r\n";
        $php_api .= "\t\t" . 'if(isset($statement)){' . "\r\n";
        $php_api .= "\t\t\t" . '$where ="WHERE " . implode(" AND ",$statement);' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . '/** order by **/' . "\r\n";
        $php_api .= "\t\t" . '$order_by = "`' . $col_id . '`";' . "\r\n";
        $php_api .= "\t\t" . 'if(isset($_GET["orderby"])){' . "\r\n";
        $php_api .= "\t\t\t" . 'switch($_GET["orderby"]){' . "\r\n";
        foreach ($new_colums as $col)
        {
            $varGet = str_replace('_', '-', $col['variable']);
            $php_api .= "\t\t\t" . 'case "' . $varGet . '":' . "\r\n";
            $php_api .= "\t\t\t\t" . '$order_by = "`' . $col["variable"] . '`";' . "\r\n";
            $php_api .= "\t\t\t\t" . 'break;' . "\r\n";
        }
        $php_api .= "\t\t\t" . 'case "random":' . "\r\n";
        $php_api .= "\t\t\t\t" . '$order_by = "RAND()";' . "\r\n";
        $php_api .= "\t\t\t\t" . 'break;' . "\r\n";
        $php_api .= "\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\r\n";
        $php_api .= "\t\t" . '/** sort **/' . "\r\n";
        $php_api .= "\t\t" . '$sort = "ASC";' . "\r\n";
        $php_api .= "\t\t" . 'if(isset($_GET["sort"])){' . "\r\n";
        $php_api .= "\t\t\t" . 'if($_GET["sort"]=="asc"){' . "\r\n";
        $php_api .= "\t\t\t\t" . '$sort = "ASC";' . "\r\n";
        $php_api .= "\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t" . '$sort = "DESC";' . "\r\n";
        $php_api .= "\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\r\n";
        $php_api .= "\t\t" . '$sql_query = "SELECT * FROM `' . str_replace('-', '_', $table['table-name']) . '` ".$where." ORDER BY ".$order_by." ".$sort.";"; ' . "\r\n";
        $php_api .= "\t\t" . '$z=0;' . "\r\n";
        $php_api .= "\t\t" . 'if($result = $mysql->query($sql_query)){' . "\r\n";
        $php_api .= "\t\t\t" . 'while ($data = $result->fetch_array()){' . "\r\n";

        // TODO: PHP API CODE - TABLE JSON - COLUMN TYPE - LISTING - OK
        foreach ($new_colums as $col)
        {
            if ($col['type'] == 'id')
            {
                $col['json_list'] = true;
            }
            if ($col['json_list'] == true)
            {
                $php_api .= "\t\t\t\t" . 'if(isset($data["' . $col['variable'] . '"])){' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '$data_rest_api[$z] = $data;' . "\r\n";
                switch ($col['type'])
                {
                    case 'id':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = (int) $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'multi-images':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = json_decode($data["' . $col['variable'] . '"],true);' . "\r\n";
                        break;
                    case 'multi-text':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = json_decode($data["' . $col['variable'] . '"],true);' . "\r\n";
                        break;
                    case 'varchar':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'thumbnail':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $config["userfile_url"] . $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'image':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $config["userfile_url"] . $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'file':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $config["userfile_url"] . $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'select-table':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["id"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        $get_table = $db->getTable($col['option']);
                        if (!isset($get_table['table-variable-as-value']))
                        {
                            $get_table['table-variable-as-value'] = 'id';
                        }
                        if (!isset($get_table['table-variable-as-label']))
                        {
                            $get_table['table-variable-as-label'] = 'name';
                        }
                        $php_api .= "\t\t\t\t\t" . '$' . $col['option'] . '_id = htmlentities(stripslashes($data["' . $col['variable'] . '"]));' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$sql_' . $col['option'] . '_query = "SELECT * FROM `' . $col['option'] . '` WHERE `' . $get_table['table-variable-as-value'] . '`=\'{$' . $col['option'] . '_id}\'" ;' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$' . $col['option'] . '_result = $mysql->query($sql_' . $col['option'] . '_query);' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . 'if($' . $col['option'] . '_result){' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . '$' . $col['option'] . '_result_data = $' . $col['option'] . '_result->fetch_array();' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . 'if(isset($' . $col['option'] . '_result_data["' . $get_table['table-variable-as-label'] . '"])){' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["rendered"] = stripslashes($' . $col['option'] . '_result_data["' . $get_table['table-variable-as-label'] . '"]);' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["rendered"] = "";' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . '}' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '}else{' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["rendered"] = "";' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
                        break;
                    case 'tinytext':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'text':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'longtext':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'number':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] =(int) $data["' . $col['variable'] . '"];' . "\r\n";
                        break;

                    case 'number-fixed-length':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;

                    case 'date':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'time':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'datetime':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["default"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["rfc822"] = date(DATE_RFC822,strtotime($data["' . $col['variable'] . '"]));' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"]["atom"] = date(DATE_ATOM,strtotime($data["' . $col['variable'] . '"]));' . "\r\n";
                        break;
                    case 'boolean':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'select':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'url':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'email':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'phone':
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
                        break;

                    case 'blob':
                        $php_api .= "\t\t\t\t\t" . '$buffer = $data["' . $col['variable'] . '"];' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$filename = sha1($buffer);' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$finfo = new finfo(FILEINFO_MIME_TYPE);' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$mimetype = explode("/",$finfo->buffer($buffer));' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$ext = end($mimetype);' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . 'file_put_contents("userfiles/".$filename . ".".$ext,$data["' . $col['variable'] . '"]);' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$rest_api[$z]["' . $col['variable'] . '"] = $config["userfile_url"] ."/". $filename . ".".$ext;' . "\r\n";
                        break;

                }
                $php_api .= "\t\t\t\t" . '}' . "\r\n";
            } else
            {
                $php_api .= "\t\t\t\t" . '//$rest_api[$z]["' . $col['variable'] . '"] = $data["' . $col['variable'] . '"];' . "\r\n";
            }
        }
        $php_api .= "\t\t\t\t" . '$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=' . str_replace('_', '-', $table['table-name']) . '&' . str_replace('_', '-', $col_id) . '=". $data["' . $col_id . '"];' . "\r\n";
        $php_api .= "\t\t\t\t" . '$z++;' . "\r\n";
        $php_api .= "\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t\t" . '$result->close();' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . 'if(isset($_GET["' . str_replace('_', '-', $col_id) . '"])){' . "\r\n";
        $php_api .= "\t\t\t" . 'if(isset($data_rest_api[0])){' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api = array();' . "\r\n";

        // TODO: PHP API CODE - TABLE JSON - COLUMN TYPE - SINGLE - OK
        foreach ($new_colums as $col)
        {
            if ($col['json_detail'] == true)
            {
                switch ($col['type'])
                {
                    case 'id':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'varchar':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'multi-text':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = json_decode($data_rest_api[0]["' . $col['variable'] . '"],true);' . "\r\n";
                        break;
                    case 'multi-images':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = json_decode($data_rest_api[0]["' . $col['variable'] . '"],true);' . "\r\n";
                        break;
                    case 'thumbnail':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $config["userfile_url"] . $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'image':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $config["userfile_url"] . $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'file':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $config["userfile_url"] . $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'select-table':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"]["rendered"] = "Invalid ID";' . "\r\n";
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"]["id"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        $get_table = $db->getTable($col['option']);
                        if (!isset($get_table['table-variable-as-value']))
                        {
                            $get_table['table-variable-as-value'] = 'id';
                        }
                        if (!isset($get_table['table-variable-as-label']))
                        {
                            $get_table['table-variable-as-label'] = 'name';
                        }
                        $php_api .= "\t\t\t\t" . '$' . $col['option'] . '_id = htmlentities(stripslashes($data_rest_api[0]["' . $col['variable'] . '"]));' . "\r\n";
                        $php_api .= "\t\t\t\t" . '$sql_' . $col['option'] . '_query = "SELECT * FROM `' . $col['option'] . '` WHERE `' . $get_table['table-variable-as-value'] . '`=\'{$' . $col['option'] . '_id}\'" ;' . "\r\n";
                        $php_api .= "\t\t\t\t" . '$' . $col['option'] . '_result = $mysql->query($sql_' . $col['option'] . '_query);' . "\r\n";
                        $php_api .= "\t\t\t\t" . 'if($' . $col['option'] . '_result){' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$' . $col['option'] . '_result_data = $' . $col['option'] . '_result->fetch_array();' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . 'if(isset($' . $col['option'] . '_result_data["' . $get_table['table-variable-as-label'] . '"])){' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . '$rest_api["' . $col['variable'] . '"]["rendered"] = stripslashes($' . $col['option'] . '_result_data["' . $get_table['table-variable-as-label'] . '"]);' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '}else{' . "\r\n";
                        $php_api .= "\t\t\t\t\t\t" . '$rest_api["' . $col['variable'] . '"]["rendered"] = "Invalid ID";' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
                        $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
                        $php_api .= "\t\t\t\t\t" . '$rest_api["' . $col['variable'] . '"]["rendered"] = "Invalid ID";' . "\r\n";
                        $php_api .= "\t\t\t\t" . '}' . "\r\n";

                        break;
                    case 'tinytext':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'text':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'longtext':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'number':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'number-fixed-length':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;

                    case 'date':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'time':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'datetime':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'boolean':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'select':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'url':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'email':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'phone':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                    case 'blob':
                        $php_api .= "\t\t\t\t" . '$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
                        break;
                }


            } else
            {
                $php_api .= "\t\t\t\t" . '//$rest_api["' . $col['variable'] . '"] = $data_rest_api[0]["' . $col['variable'] . '"];' . "\r\n";
            }
        }
        $php_api .= "\t\t\t" . '}else{' . "\r\n";
        $php_api .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");' . "\r\n";
        $php_api .= "\t\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . '}' . "\r\n";
        $php_api .= "\t\t" . 'break;' . "\r\n";
        // TODO: PHP API CODE - JSON-INPUT
        if (!isset($table['form-method']))
        {
            $table['form-method'] = 'none';
        }
        if (($table['form-method'] == 'post') || ($table['form-method'] == 'get') || ($table['form-method'] == 'put'))
        {
            $php_api .= "\t" . 'case "form-' . $string->toFileName($table['table-name']) . '":' . "\r\n";
            $php_api .= "\t\t" . '// TO' . 'DO: JSON INPUT - ' . strtoupper(str_replace('_', '-', $table['table-name'])) . '' . "\r\n";
            $json_input_column = $json_input_value = $filter_input_value = array();
            foreach ($new_colums as $col)
            {
                $param_input = $string->toFileName($col['variable']);
                if ($col['json_input'] == true)
                {
                    // TODO: PHP API CODE - JSON-INPUT - COLUMN TYPE --|-- OK
                    $php_api .= "\t\t" . '// ' . $string->toVar($col['variable']) . ':' . $col['type'] . '' . "\r\n";
                    switch ($col['type'])
                    {
                        case 'id':
                            break;
                        case 'multi-text':
                            break;
                        case 'multi-images':
                            break;
                        case 'image':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    //$php_api .= "\t\t\t" . 'if(substr($postdata_' . $string->toVar($col['variable']) . ',0,11) =="data:image/"){' . "\r\n";
                                    //$php_api .= "\t\t\t" . '}' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'thumbnail':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'file':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;

                        case 'number-fixed-length':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;

                        case 'varchar':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'select-table':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'tinytext':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'text':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'longtext':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'number':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` = $postdata_' . $string->toVar($col['variable']) . '';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = (int) "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = (int)($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = (int)($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'date':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    if ($col['default'] == '')
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "0000-00-00";' . "\r\n";
                                    } else
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d",strtotime("' . $col['default'] . '"));' . "\r\n";
                                    }
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d",strtotime($_POST["' . $param_input . '"]));' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    if ($col['default'] == '')
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "0000-00-00";' . "\r\n";
                                    } else
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d",strtotime("' . $col['default'] . '"));' . "\r\n";
                                    }
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d",strtotime($_GET["' . $param_input . '"]));' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'time':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    if ($col['default'] == '')
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "00:00:00";' . "\r\n";
                                    } else
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("H:i:s",strtotime("' . $col['default'] . '"));' . "\r\n";
                                    }
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("H:i:s",strtotime($_POST["' . $param_input . '"]));' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    if ($col['default'] == '')
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "00:00:00";' . "\r\n";
                                    } else
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("H:i:s",strtotime("' . $col['default'] . '"));' . "\r\n";
                                    }
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("H:i:s",strtotime($_GET["' . $param_input . '"]));' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'datetime':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    if ($col['default'] == '')
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "0000-00-00 00:00:00";' . "\r\n";
                                    } else
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d H:i:s",strtotime("' . $col['default'] . '"));' . "\r\n";
                                    }
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d H:i:s",strtotime($_POST["' . $param_input . '"]));' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    if ($col['default'] == '')
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "0000-00-00 00:00:00";' . "\r\n";
                                    } else
                                    {
                                        $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d H:i:s",strtotime("' . $col['default'] . '"));' . "\r\n";
                                    }
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = date("Y-m-d H:i:s",strtotime($_GET["' . $param_input . '"]));' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'boolean':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` = $postdata_' . $string->toVar($col['variable']) . '';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = 0;' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . 'if($_POST["' . $param_input . '"]== "true"){' . "\r\n";
                                    $php_api .= "\t\t\t\t" . '$_POST["' . $param_input . '"]= 1 ;' . "\r\n";
                                    $php_api .= "\t\t\t" . '}' . "\r\n";
                                    $php_api .= "\t\t\t" . 'if((int)($_POST["' . $param_input . '"]) == 1){' . "\r\n";
                                    $php_api .= "\t\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = 1;' . "\r\n";
                                    $php_api .= "\t\t\t" . '}else{' . "\r\n";
                                    $php_api .= "\t\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = 0;' . "\r\n";
                                    $php_api .= "\t\t\t" . '}' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = 0;' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . 'if($_GET["' . $param_input . '"]== "true"){' . "\r\n";
                                    $php_api .= "\t\t\t\t" . '$_GET["' . $param_input . '"]= 1 ;' . "\r\n";
                                    $php_api .= "\t\t\t" . '}' . "\r\n";
                                    $php_api .= "\t\t\t" . 'if((int)($_GET["' . $param_input . '"]) == 1){' . "\r\n";
                                    $php_api .= "\t\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = 1;' . "\r\n";
                                    $php_api .= "\t\t\t" . '}else{' . "\r\n";
                                    $php_api .= "\t\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = 0;' . "\r\n";
                                    $php_api .= "\t\t\t" . '}' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'select':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'url':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'email':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                        case 'phone':
                            $json_input_column[] = '`' . $string->toSQL($col['variable']) . '`';
                            $json_input_value[] = '\'$postdata_' . $string->toVar($col['variable']) . '\'';
                            $var_input_value[] = '$postdata_' . $string->toVar($col['variable']) . '';
                            $filter_input_value[] = '`' . $string->toSQL($col['variable']) . '` LIKE \'%$postdata_' . $string->toVar($col['variable']) . '%\'';
                            switch ($table['form-method'])
                            {
                                case 'post':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_POST["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_POST["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                                case 'get':
                                    $php_api .= "\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = "' . $col['default'] . '";' . "\r\n";
                                    $php_api .= "\t\t" . 'if(isset($_GET["' . $param_input . '"])){' . "\r\n";
                                    $php_api .= "\t\t\t" . '$postdata_' . $string->toVar($col['variable']) . ' = $mysql->escape_string($_GET["' . $param_input . '"]);' . "\r\n";
                                    $php_api .= "\t\t" . '}' . "\r\n";
                                    break;
                            }
                            break;
                    }
                    $php_api .= "\t\t" . '' . "\r\n";
                }
            }
            $valid_var_input = array();
            if (!isset($var_input_value))
            {
                $var_input_value = array();
            }
            foreach ($var_input_value as $var_input)
            {
                $valid_var_input[] = $var_input . ' != ""';
            }
            if (!isset($table['form-filter-duplicate']))
            {
                $table['form-filter-duplicate'] = false;
            }
            if ($table['form-filter-duplicate'] == true)
            {
                $php_api .= "\t\t" . '$is_exist_query = "SELECT COUNT(*) AS exist FROM `' . $string->toSQL($table['table-name']) . '` WHERE ' . implode(' AND ', $filter_input_value) . '";' . "\r\n";
                $php_api .= "\t\t" . 'if($result = $mysql->query($is_exist_query)){' . "\r\n";
                $php_api .= "\t\t\t" . '$data = $result->fetch_array();' . "\r\n";
                $php_api .= "\t\t\t" . 'if($data["exist"] == 0){' . "\r\n";
                $php_api .= "\t\t\t\t" . 'if(' . implode(" || \r\n\t\t\t", $valid_var_input) . '){' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '$sql_query = "INSERT INTO `' . $string->toSQL($table['table-name']) . '` (' . implode(',', $json_input_column) . ') VALUES ";' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '$sql_query .= "(' . implode(',', $json_input_value) . ')";' . "\r\n";
                $php_api .= "\t\t\t\t\t" . 'if($query = $mysql->query($sql_query)){' . "\r\n";
                $php_api .= "\t\t\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Successfully!","message"=>"Your request has been sent");' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t\t\t" . 'if($mysql->errno == 2006){' . "\r\n";
                $php_api .= "\t\t\t\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Error!","message"=> "The maximum allowed data size is 512 kb" );' . "\r\n";
                $php_api .= "\t\t\t\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Error!","message"=> $mysql->error );' . "\r\n";
                $php_api .= "\t\t\t\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Empty Entry","message"=>"Please complete all information requested on this form");' . "\r\n";
                $php_api .= "\t\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=> "Duplicate entry","message"=>"The data you submitted already exists");' . "\r\n";
                $php_api .= "\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t" . 'if($mysql->errno == 2006){' . "\r\n";
                $php_api .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Error!","message"=> "The maximum allowed data size is 512 kb" );' . "\r\n";
                $php_api .= "\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=> "Error!","message"=> $mysql->error );' . "\r\n";
                $php_api .= "\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t" . '}' . "\r\n";
            } else
            {
                $php_api .= "\t\t" . 'if(' . implode(" || \r\n\t\t\t", $valid_var_input) . '){' . "\r\n";
                $php_api .= "\t\t\t" . '$sql_query = "INSERT INTO `' . $string->toSQL($table['table-name']) . '` (' . implode(',', $json_input_column) . ') VALUES ";' . "\r\n";
                $php_api .= "\t\t\t" . '$sql_query .= "(' . implode(',', $json_input_value) . ')";' . "\r\n";
                $php_api .= "\t\t\t" . 'if($query = $mysql->query($sql_query)){' . "\r\n";
                $php_api .= "\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Successfully!","message"=>"Your request has been sent");' . "\r\n";
                $php_api .= "\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t" . 'if($mysql->errno == 2006){' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Error!","message"=> "The maximum allowed data size is 512 kb" );' . "\r\n";
                $php_api .= "\t\t\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Error!","message"=> $mysql->error );' . "\r\n";
                $php_api .= "\t\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t\t" . '}' . "\r\n";
                $php_api .= "\t\t" . '}else{' . "\r\n";
                $php_api .= "\t\t\t" . '$rest_api=array("data"=>array("status"=>200,"title"=>"OK"),"title"=>"Empty Entry","message"=>"Please complete all information requested on this form");' . "\r\n";
                $php_api .= "\t\t" . '}' . "\r\n";
            }
            $php_api .= "\t\t" . 'break;' . "\r\n";
        }
    }
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "\r\n";
    $php_api .= '$mysql->close();' . "\r\n";
    $php_api .= "\r\n";
    $php_api .= "" . '// TO' . 'DO: JSON --+-- CROSSDOMAIN' . "\r\n";
    $php_api .= "" . 'header("Content-Type: application/json; charset=UTF-8");' . "\r\n";
    $php_api .= "" . 'if (isset($_SERVER["HTTP_ORIGIN"])){' . "\r\n";
    $php_api .= "\t" . 'header("Access-Control-Allow-Origin: {$_SERVER[\'HTTP_ORIGIN\']}");' . "\r\n";
    $php_api .= "\t" . 'header("Access-Control-Allow-Credentials: true");' . "\r\n";
    $php_api .= "\t" . 'header("Access-Control-Max-Age: 86400");' . "\r\n";
    $php_api .= "" . '}' . "\r\n";

    $php_api .= "" . 'if ($_SERVER["REQUEST_METHOD"] == "OPTIONS"){' . "\r\n";
    $php_api .= "\t" . 'header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");' . "\r\n";
    $php_api .= "" . '}' . "\r\n";

    $php_api .= "" . 'if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"])){' . "\r\n";
    $php_api .= "\t" . 'header("Access-Control-Allow-Headers: {$_SERVER[\'HTTP_ACCESS_CONTROL_REQUEST_HEADERS\']}");' . "\r\n";
    $php_api .= "" . '}' . "\r\n";


    //$php_api .= "" . 'header(\'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, X-Authorization\');' . "\r\n";

    $php_api .= "" . 'header(\'Connection: close\');' . "\r\n";
    $php_api .= "\r\n";
    $php_api .= "" . 'if (!isset($_GET["callback"])){' . "\r\n";
    $php_api .= "\t" . '// TO' . 'DO: OUTPUT --+-- JSON' . "\r\n";

    $php_api .= "\t" . 'if(defined("JSON_UNESCAPED_UNICODE")){' . "\r\n";
    $php_api .= "\t\t" . 'echo json_encode($rest_api,JSON_UNESCAPED_UNICODE);' . "\r\n";
    $php_api .= "\t" . '}else{' . "\r\n";
    $php_api .= "\t\t" . 'echo json_encode($rest_api);' . "\r\n";
    $php_api .= "\t" . '}' . "\r\n";
    $php_api .= "" . '}else{' . "\r\n";
    $php_api .= "\t" . '// TO' . 'DO: OUTPUT --+-- JSONP' . "\r\n";
    $php_api .= "\t" . 'if(defined("JSON_UNESCAPED_UNICODE")){' . "\r\n";
    $php_api .= "\t\t" . 'echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api,JSON_UNESCAPED_UNICODE). ");" ;' . "\r\n";
    $php_api .= "\t" . '}else{' . "\r\n";
    $php_api .= "\t\t" . 'echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api) . ");" ;' . "\r\n";
    $php_api .= "\t" . '}' . "\r\n";
    $php_api .= "" . '}' . "\r\n";
    $php_api .= "\r\n";
    // TODO: HTML DOCS
    $rest_api_url = '';
    if ($php_native['multiuser_enable'] == true)
    {
        $rest_api_url .= "" . '<a target="_blank" href="' . $php_native['api_url'] . '?api=jwt-auth"><h3 class="title">JWT Authentication</h3></a>' . "";
        $rest_api_url .= "" . '<pre>GET ' . $php_native['api_url'] . '?api=jwt-auth</pre>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<h4>Request Token</h4>' . "";
        $rest_api_url .= "" . '<pre>' . "";
        $rest_api_url .= "" . 'POST ' . $php_native['api_url'] . '?api=jwt-auth&amp;action=token' . "\r\n";
        $rest_api_url .= "" . '</pre>' . "";
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
        $rest_api_url .= "" . 'username' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . '<code>jasman</code>' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'username of user' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'String' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '</tr>' . "";


        $rest_api_url .= "" . '<tr>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'password' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . '<code>123456</code>' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'password of user' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'String' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '</tr>' . "";


        $rest_api_url .= "" . '</tbody>' . "";
        $rest_api_url .= "" . '</table>' . "";


        $rest_api_url .= "" . '<p>Validates the user credentials, username and password, and returns a token to use in a future request to the API if the authentication is correct or error if the authentication fails</p>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<h4>Token Validation</h4>' . "";
        $rest_api_url .= "" . '<pre>POST ' . $php_native['api_url'] . '?api=jwt-auth&amp;action=token-validate</pre>' . "";
        $rest_api_url .= "" . '<p>This is token validator; you only will need to make a POST request sending the Authorization header.</p>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
    }
    foreach ($tables as $table)
    {
        $new_colums = array();
        $new_colums = $table['table-cols'];
        $table_link = str_replace('_', '-', $table['table-name']);
        $col_id = 'id';
        foreach ($table['table-cols'] as $col)
        {
            if ($col['type'] == 'id')
            {
                $col_id = $col['variable'];
            }
        }
        $rest_api_url .= "" . '<a target="_blank" href="' . $php_native['api_url'] . '?api=' . $table_link . '"><h3 class="title">List ' . $table['table-plural-name'] . '</h3></a>' . "";
        $rest_api_url .= "" . '<pre>GET ' . $php_native['api_url'] . '?api=' . $table_link . '</pre>' . "";
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
        $val_col[] = "<code>random</code>";
        $rest_api_url .= "" . '<tr>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'sort' . "";
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
        $rest_api_url .= "" . '<tr>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'orderby' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . implode(' | <br/>', $val_col) . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'Sort collection by object attribute' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'String' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '</tr>' . "";
        $new_colums = $table['table-cols'];
        foreach ($new_colums as $col)
        {
            $col_link = str_replace('_', '-', $col['variable']);
            // TODO: HTML DOCS - COLUMN TYPE
            switch ($col['type'])
            {
                case 'id':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Integer' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'thumbnail':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'image':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'file':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'varchar':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'select-table':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'tinytext':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'text':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'longtext':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'number':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Integer' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'date':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'time':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'datetime':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'boolean':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>true</code> | <code>false</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Boolean' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'select':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'url':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'email':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
                case 'phone':
                    $rest_api_url .= "" . '<tr>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . $col_link . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . '<code>' . $col['default'] . '</code>' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'Limit result set to items with more specific by `' . $col['variable'] . '`' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '<td>' . "";
                    $rest_api_url .= "" . 'String' . "";
                    $rest_api_url .= "" . '</td>' . "";
                    $rest_api_url .= "" . '</tr>' . "";
                    break;
            }
        }
        $rest_api_url .= "" . '</tbody>' . "";
        $rest_api_url .= "" . '</table>' . "";
        $rest_api_url .= "" . '<h4>Example</h4>' . "";
        $rest_api_url .= "" . '<pre>' . "";
        $rest_api_url .= "- " . $php_native['api_url'] . '?api=' . $table_link . '' . "\r\n";
        $rest_api_url .= "- " . $php_native['api_url'] . '?api=' . $table_link . '&amp;orderby=' . $col_id . '' . "\r\n";
        $rest_api_url .= "- " . $php_native['api_url'] . '?api=' . $table_link . '&amp;orderby=random' . "\r\n";
        $rest_api_url .= "- " . $php_native['api_url'] . '?api=' . $table_link . '&amp;orderby=' . $col_id . '&amp;sort=desc' . "";
        $rest_api_url .= "" . '</pre>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $required_auth_text = '';
        if ($php_native['multiuser_enable'] == true)
        {
            // TODO: PHP API CODE - TABLE AUTH
            if (!isset($table['auth-enable']))
            {
                $table['auth-enable'] = false;
            }
            if ($table['auth-enable'] == true)
            {
                $required_auth_text = 'This JSON data requires login authorization.';
            }
        }

        $rest_api_url .= "" . '<a target="_blank" href="' . $php_native['api_url'] . '?api=' . $table_link . '&amp;' . str_replace('_', '-', $col_id) . '=1"><h3 class="title">Retrieve a ' . $table['table-singular-name'] . ' ' . $required_auth_text . '</h3></a>' . "";
        $rest_api_url .= "" . '<pre>GET ' . $php_native['api_url'] . '?api=' . $table_link . '&amp;' . str_replace('_', '-', $col_id) . '=&lt;' . str_replace('_', '-', $col_id) . '&gt;</pre>' . "";
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
        $rest_api_url .= "" . 'Unique identifier for the object and use random for random IDs' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '<td>' . "";
        $rest_api_url .= "" . 'Integer' . "";
        $rest_api_url .= "" . '</td>' . "";
        $rest_api_url .= "" . '</tr>' . "";
        $rest_api_url .= "" . '</tbody>' . "";
        $rest_api_url .= "" . '</table>' . "";
        $rest_api_url .= "" . '<h4>Example</h4>' . "";
        $rest_api_url .= "" . '<pre>' . "";
        $rest_api_url .= "- " . '' . $php_native['api_url'] . '?api=' . $table_link . '&amp;' . str_replace('_', '-', $col_id) . '=1' . "\r\n";
        $rest_api_url .= "- " . '' . $php_native['api_url'] . '?api=' . $table_link . '&amp;' . str_replace('_', '-', $col_id) . '=2' . "\r\n";
        $rest_api_url .= "- " . '' . $php_native['api_url'] . '?api=' . $table_link . '&amp;' . str_replace('_', '-', $col_id) . '=random' . "\r\n";
        $rest_api_url .= "" . '</pre>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        $rest_api_url .= "" . '<br/>' . "";
        if (!isset($table['form-method']))
        {
            $table['form-method'] = 'none';
        }
        if (($table['form-method'] == 'post') || ($table['form-method'] == 'get') || ($table['form-method'] == 'put'))
        {
            $rest_api_url .= "" . '<a target="_blank" href="' . $php_native['api_url'] . '?api=form-' . $table_link . '"><h3 class="title">Send a request for The ' . $table['table-plural-name'] . '</h3></a>' . "";
            $rest_api_url .= "" . '<pre>' . "";
            $rest_api_url .= "" . strtoupper($table['form-method']) . ' ' . $php_native['api_url'] . '?api=form-' . $table_link . '' . "\r\n";
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
                    $rest_api_url .= "<pre>" . 'curl -H "Content-type: application/x-www-form-urlencoded" -X POST -d "' . $http_build_query . '" "' . $php_native['api_url'] . '?api=form-' . $table_link . '"</pre>';
                    break;
                case 'get':
                    $rest_api_url .= "<pre>" . 'curl "' . $php_native['api_url'] . '?api=form-' . $table_link . '&amp;' . $http_build_query . '"</pre>';
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
    $html_docs .= "" . '<title>' . $php_native['site_name'] . ' - RESTful API</title>' . "";
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
    $html_docs .= "" . '<a class="blog-nav-item" href="restapi.php#" target="_blank">RESTful API</a>' . "";
    $html_docs .= "" . '<a class="blog-nav-item" href="admin.php" target="_blank">Admin</a>' . "";
    $html_docs .= "" . '</nav>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '<div class="container">' . "";
    $html_docs .= "" . '<div class="blog-header">' . "";
    $html_docs .= "" . '<h1 class="blog-title">' . $php_native['site_name'] . ' - RESTful API</h1>' . "";
    $html_docs .= "" . '<p class="lead blog-description">' . $_SESSION['CURRENT_APP']['apps']['app-description'] . '</p>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= $rest_api_url;
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '<div class="blog-footer">' . "";
    $html_docs .= "" . '<br><br><p>Built for <a href="' . $_SESSION['CURRENT_APP']['apps']['author-website'] . '">' . $_SESSION['CURRENT_APP']['apps']['app-name'] . '</a> by <a href="mailto:' . $_SESSION['CURRENT_APP']['apps']['author-email'] . '">@' . $_SESSION['CURRENT_APP']['apps']['author-name'] . '</a>.</p><p><a href="#">Back to top</a></p>' . "";
    $html_docs .= "" . '</div>' . "";
    $html_docs .= "" . '</body>' . "";
    $html_docs .= "" . '</html>' . "";
}
if (!isset($php_native['site_name']))
{
    $php_native['site_name'] = $_SESSION['CURRENT_APP']['apps']['app-name'];
}
if (!isset($php_native['site_bg']))
{
    $php_native['site_bg'] = 'https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg';
}
if (!isset($php_native['site_logo']))
{
    $php_native['site_logo'] = 'https://placehold.it/200x200';
}
if (!isset($php_native['api_url']))
{
    $php_native['api_url'] = '';
}
if (!isset($php_native['live_test']))
{
    $php_native['live_test'] = $_SERVER["DOCUMENT_ROOT"];
}
if (!isset($php_native['site_color']))
{
    $php_native['site_color'] = $_SESSION['CURRENT_APP']['apps']['app-color'];
}
if (!isset($php_native['db_host']))
{
    $php_native['db_host'] = 'localhost';
}
if (!isset($php_native['db_user']))
{
    $php_native['db_user'] = 'root';
}
if (!isset($php_native['db_pwd']))
{
    $php_native['db_pwd'] = '';
}
if (!isset($php_native['db_name']))
{
    $php_native['db_name'] = 'db_' . $string->toVar($_SESSION['CURRENT_APP']['apps']['app-prefix']);
}
if (!isset($php_native['user_email']))
{
    $php_native['user_email'] = 'root@ihsana.net';
}
if (!isset($php_native['user_website']))
{
    $php_native['user_website'] = 'https://ihsana.net';
}
if (!isset($php_native['api_link']))
{
    $php_native['api_link'] = 'https://ihsana.net/restapi.php';
}

if (!isset($php_native['userfile_url']))
{
    $php_native['userfile_url'] = '';
}


if (!isset($php_native['user_password']))
{
    $php_native['user_password'] = '123456';
}
if (!isset($php_native['user_name']))
{
    $php_native['user_name'] = 'Anaski';
}
if (!isset($php_native['php_timezone']))
{
    $php_native['php_timezone'] = 'Asia/Jakarta';
}
if (!isset($php_native['onesignal_enable']))
{
    $php_native['onesignal_enable'] = false;
}
if (!isset($php_native['onesignal_app_id']))
{
    $php_native['onesignal_app_id'] = '';
}
if (!isset($php_native['onesignal_api_key']))
{
    $php_native['onesignal_api_key'] = '';
}
if (isset($_POST['exec-sql']))
{
    $config["db_host"] = $php_native["db_host"];
    $config["db_user"] = $php_native["db_user"];
    $config["db_pwd"] = $php_native["db_pwd"];
    $config["db_name"] = $php_native["db_name"];
    $mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
    if (mysqli_connect_errno())
    {
        $_SESSION['TOOL_ALERT']['type'] = 'danger';
        $_SESSION['TOOL_ALERT']['title'] = __e('Error');
        $_SESSION['TOOL_ALERT']['message'] = __e('Error creating table, please do it manually');
    }
    $exec_sql = null;
    $exec_sql .= $sql_code;
    $exec_sql .= $sql_example_code;
    if ($mysql->multi_query($exec_sql) === true)
    {
        $_SESSION['TOOL_ALERT']['type'] = 'success';
        $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
        $_SESSION['TOOL_ALERT']['message'] = __e('Tables created successfully');
    } else
    {
        $_SESSION['TOOL_ALERT']['type'] = 'danger';
        $_SESSION['TOOL_ALERT']['title'] = __e('Error');
        $_SESSION['TOOL_ALERT']['message'] = __e('Error creating table, please do it manually');
    }
    $mysql->close();
    header("Location: ./?p=php-native-generator");
}
if (isset($_GET['exec-php']))
{
    if ($php_native['live_test'] != '')
    {
        if (!file_exists($php_native['live_test']))
        {
            @mkdir($php_native['live_test'], 0777, true);
        }
        if (!file_exists($php_native['live_test'] . '/userfiles'))
        {
            @mkdir($php_native['live_test'] . '/userfiles/', 0777, true);
        }
        if (!file_exists($php_native['live_test'] . '/filebrowser'))
        {
            @mkdir($php_native['live_test'] . '/filebrowser/', 0777, true);
        }
        file_put_contents($php_native['live_test'] . '/index.html', $html_docs);
        file_put_contents($php_native['live_test'] . '/userfiles/index.html', $html_index);
        file_put_contents($php_native['live_test'] . '/filebrowser/index.html', $html_index);
        file_put_contents($php_native['live_test'] . '/admin.php', $php_admin);
        file_put_contents($php_native['live_test'] . '/restapi.php', $php_api);
        file_put_contents($php_native['live_test'] . '/' . $string->toVar($_SESSION['CURRENT_APP']['apps']['app-prefix']) . '.sql', $sql_code);
        file_put_contents($php_native['live_test'] . '/sample.sql', $sql_example_code);
        $_SESSION['TOOL_ALERT']['type'] = 'success';
        $_SESSION['TOOL_ALERT']['title'] = __e('Successfully');
        $_SESSION['TOOL_ALERT']['message'] = __e('PHP Files created successfully');
    } else
    {
        $_SESSION['TOOL_ALERT']['type'] = 'danger';
        $_SESSION['TOOL_ALERT']['title'] = __e('Error');
        $_SESSION['TOOL_ALERT']['message'] = __e('Error creating php file, please do it manually by downloading it');
    }
    header("Location: ./?p=php-native-generator&hash=" . time());
}
if (isset($_GET['download']))
{
    $dir_output = JSM_PATH . '/outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/backend/php/';
    if (!is_dir($dir_output))
    {
        @mkdir($dir_output, 0777, true);
    }
    $file_zip = $dir_output . '/php-native.zip';
    if (file_exists($file_zip))
    {
        @unlink($file_zip);
    }
    $zip = new ZipArchive();
    if ($zip->open($file_zip, ZIPARCHIVE::CREATE) !== true)
    {
        exit("cannot open <$filezip>\n");
    }
    $zip->addFromString('index.html', $html_docs);
    $zip->addFromString('admin.php', $php_admin);
    $zip->addFromString('restapi.php', $php_api);
    $zip->addFromString('userfiles/index.html', $html_index);
    $zip->addFromString('filebrowser/index.html', $html_index);
    $zip->addFromString('' . $string->toVar($_SESSION['CURRENT_APP']['apps']['app-prefix']) . '.sql', $sql_code);
    $zip->addFromString('sample.mysql', $sql_example_code);
    $zip->close();
    $page_js = 'window.location = "./outputs/' . $_SESSION['CURRENT_APP']['apps']['app-prefix'] . '/backend/php/php-native.zip?' . time() . '";';
}
// TODO: LAYOUT HTML
$breadcrumb .= '<ol class="breadcrumb">';
$breadcrumb .= '<li><a href="./"><i class="fa fa-dashboard"></i> ' . __e('Home') . '</a></li>';
$breadcrumb .= '<li class="active">' . __e('PHP Native Generator') . '</li>';
$breadcrumb .= '</ol>';
$content .= $notice_backend;
$content .= '<form action="" method="post">';
$content .= '<div class="row">';
$content .= '<div class="col-md-4">';
// TODO: LAYOUT HTML - FORM SETTING
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
$content .= '<label>' . __e('Site Name') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[site_name]" class="form-control" value="' . htmlentities($php_native['site_name']) . '" placeholder="MyApp"/>';
$content .= '<p class="help-block">' . __e('A nice name, only allowed: a-z characters and space') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Site Background') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[site_bg]" class="form-control" value="' . htmlentities($php_native['site_bg']) . '" placeholder="https://ihsana.com/ima-project/assets/img/bg-01.png"/>';
$content .= '<p class="help-block">' . __e('Enter the image link for the background') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Site Logo') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[site_logo]" class="form-control" value="' . htmlentities($php_native['site_logo']) . '" placeholder="https://ihsana.com/ima-project/assets/img/logo.png"/>';
$content .= '<p class="help-block">' . __e('Enter the image link for logo') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Timezones') . '</label>';
//$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[php_timezone]" class="form-control" value="' . htmlentities($php_native['php_timezone']) . '" placeholder="Asia/Jakarta" required/>';
$content .= '<select ' . $disable_button_save . 'name="php_native[php_timezone]" class="form-control" >';
foreach ($php_timezones as $php_timezone)
{
    $selected = '';
    if ($php_timezone == $php_native['php_timezone'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $php_timezone . '" ' . $selected . '>' . $php_timezone . '</option>';
}
$content .= '</select>';
$content .= '<p class="help-block">' . __e('List of Supported Timezones, check this site: <a target="_blank" href="http://php.net/manual/en/timezones.php">http://php.net/manual/en/timezones.php</a>') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Site Color') . '</label>';
$content .= '<div class="form-group">';
foreach ($option_colors as $opt)
{
    if (!isset($php_native['site_color']))
    {
        $php_native['site_color'] = $option_colors[rand(0, 4)];
    }
    $checked = null;
    if ($opt == $php_native['site_color'])
    {
        $checked = 'checked';
    }
    $content .= '<label><input ' . $checked . ' type="radio" name="php_native[site_color]" class="flat-' . $opt . '" value="' . $opt . '"> </label> ' . __e(ucwords($opt)) . ' &nbsp; ';
}
$content .= '</div>';
$content .= '<p class="help-block">' . __e('The dominant color for your website') . '</p>';
$content .= '</div> ';
$content .= '<hr/> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Folder for Test') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[live_test]" class="form-control" value="' . htmlentities($php_native['live_test']) . '" placeholder="' . __dir__ . '/backend/"/>';
$content .= '<p class="help-block">' . __e('The folder to test your website on a local machine, leave it blank if you do not want to test') . '</p>';
$content .= '<p>' . __e('<span class="label label-danger">required</span> folder permissions: <code>chmod -R 777</code> or <code>write, read and executable</code>') . '</p>';
$content .= '</div> ';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('API URL') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[api_url]" class="form-control" value="' . htmlentities($php_native['api_url']) . '" placeholder="http://ihsana.com/backend/restapi.php" />';
$content .= '<p class="help-block">' . __e('The REST-API link that will be used') . ', default file: <code>restapi.php</code>, eg: http://ihsana.com/backend/restapi.php</p>';
$content .= '</div> ';

$content .= '<div class="form-group">';
$content .= '<label>' . __e('User File URL') . '</label>';
$content .= '<input ' . $disable_button_save . ' type="text" name="php_native[userfile_url]" class="form-control" value="' . htmlentities($php_native['userfile_url']) . '" placeholder="http://ihsana.com/backend/userfiles/" />';
$content .= '<p class="help-block">' . __e('Folder url of uploaded files, If using this backend and elFinder Filemanager, leave it <strong>blank</strong>. eg: https://ihsana.com/backend/userfiles/') . '</p>';
$content .= '</div> ';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-info btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<a href="./?p=php-native-generator&exec-php" ' . $disable_button_save . ' class="btn btn btn-default btn-flat pull-right" >' . __e('Create Test Files') . '</a>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="col-md-5">';
// TODO: LAYOUT HTML - FORM DATABASE
$content .= '<div class="box box-success">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-database"></i> ' . __e('MySQL Settings') . '</h3>';
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
$content .= '<label>' . __e('Database Name') . '</label>';
$content .= '<input type="text" name="php_native[db_name]" class="form-control" value="' . htmlentities($php_native['db_name']) . '" placeholder=""/>';
$content .= '<p class="help-block">' . __e('The name of the database you want to use') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Hostname') . '</label>';
$content .= '<input type="text" name="php_native[db_host]" class="form-control" value="' . htmlentities($php_native['db_host']) . '" placeholder="localhost"/>';
$content .= '<p class="help-block">' . __e('MySQL hostname') . '</p>';
$content .= '</div> ';
$content .= '</div> ';
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Username') . '</label>';
$content .= '<input type="text" name="php_native[db_user]" class="form-control" value="' . htmlentities($php_native['db_user']) . '" placeholder="root"/>';
$content .= '<p class="help-block">' . __e('Your database username') . '</p>';
$content .= '</div> ';
$content .= '<div class="form-group danger">';
$content .= '<label>' . __e('Password') . '</label>';
$content .= '<input type="text" name="php_native[db_pwd]" class="form-control" value="' . htmlentities($php_native['db_pwd']) . '" placeholder=""/>';
$content .= '<p class="help-block">' . __e('Your database password') . '</p>';
$content .= '</div> ';
$content .= '</div>';
$content .= '<div class="col-md-6">';
$content .= '<div class="checkbox">';
$content .= '<p>' . __e('Additional Command') . '</p>';

if (!isset($php_native['debugger_enable']))
{
    $php_native['debugger_enable'] = false;
}
if (!isset($php_native['api_protector_enable']))
{
    $php_native['api_protector_enable'] = false;
}
if (!isset($php_native['gzip_enable']))
{
    $php_native['gzip_enable'] = false;
}
if (!isset($php_native['db_backup']))
{
    $php_native['db_backup'] = false;
}
if ($php_native['db_backup'] == true)
{
    $content .= '<label><input type="checkbox" name="php_native[db_backup]" class="flat-red" checked/> ' . __e('Backup data that has been inputted') . '</label>';
} else
{
    $content .= '<label><input type="checkbox" name="php_native[db_backup]" class="flat-red" /> ' . __e('Backup data that has been inputted') . '</label>';
}
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- row -->';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-success btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '<input ' . $disable_button_save . ' name="exec-sql" type="submit" class="btn btn btn-default btn-flat pull-right" value="' . __e('Execution SQL') . '" />';
$content .= '</div>';
$content .= '</div>';
// TODO: LAYOUT HTML - FORM ADMINISTRATOR
$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-border">';
$content .= '<h3 class="box-title"><i class="fa fa-users"></i> ' . __e('Administrator') . '</h3>';
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
$content .= '<label>' . __e('Name') . '</label>';
$content .= '<input type="text" name="php_native[user_name]" class="form-control" value="' . htmlentities($php_native['user_name']) . '" placeholder="Regel Jambak"/>';
$content .= '<p class="help-block">' . __e('Your full name') . '</p>';
$content .= '</div>';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Email Address') . '</label>';
$content .= '<input type="email" name="php_native[user_email]" class="form-control" value="' . htmlentities($php_native['user_email']) . '" placeholder="admin@ihsana.net"/>';
$content .= '<p class="help-block">' . __e('Your email address for login') . '</p>';
$content .= '</div>';
$content .= '</div> ';
$content .= '<div class="col-md-6">';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('Website') . '</label>';
$content .= '<input type="url" name="php_native[user_website]" class="form-control" value="' . htmlentities($php_native['user_website']) . '" placeholder="http://ihsana.net"/>';
$content .= '<p class="help-block">' . __e('Your email address for login') . '</p>';
$content .= '</div>';
$content .= '<div class="form-group danger">';
$content .= '<label>' . __e('Password') . '</label>';
$content .= '<input type="text" name="php_native[user_password]" class="form-control" value="' . htmlentities($php_native['user_password']) . '" placeholder=""/>';
$content .= '<p class="help-block">' . __e('Your password for login') . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '</div><!-- row -->';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div><!-- ./box -->';
$content .= '</div>';
$content .= '<div class="col-md-3">';
$content .= '<div class="box box-warning">';
$content .= '<div class="box-header with-warning">';
$content .= '<h3 class="box-title"><i class="fa fa-users"></i> ' . __e('Multi User') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
$content .= '<p>' . __e('This feature will activate the roles: <strong>Guest</strong>, <strong>Member</strong> and <strong>Admin</strong>') . '</p>';
$content .= '<div class="form-group">';
if (!isset($php_native['multiuser_enable']))
{
    $php_native['multiuser_enable'] = false;
}
if ($php_native['multiuser_enable'] == true)
{
    $content .= '<label><input type="checkbox" name="php_native[multiuser_enable]" class="flat-blue" checked/>&nbsp;' . __e('Enable Users & JWT Auth') . '</label>';
} else
{
    $content .= '<label><input type="checkbox" name="php_native[multiuser_enable]" class="flat-blue"/>&nbsp;' . __e('Enable Users & JWT Auth') . '</label>';
}
$content .= '</div>';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-warning btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div><!-- ./box -->';

$content .= '<div class="box box-danger">';
$content .= '<div class="box-header with-danger">';
$content .= '<h3 class="box-title"><i class="fa fa-users"></i> ' . __e('Additional Features') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';
// TODO: LAYOUT HTML - FORM ONESIGNAL
$content .= '<h4>' . __e('OneSignal Sender') . '</h4>';
$content .= '<div class="form-group">';
if ($php_native['onesignal_enable'] == true)
{
    $content .= '<label><input type="checkbox" name="php_native[onesignal_enable]" class="flat-red" checked/>&nbsp;' . __e('Enable OneSignal Sender') . '</label>';
} else
{
    $content .= '<label><input type="checkbox" name="php_native[onesignal_enable]" class="flat-red"/>&nbsp;' . __e('Enable OneSignal Sender') . '</label>';
}
$content .= '</div>';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('App ID') . '</label>';
$content .= '<input type="text" name="php_native[onesignal_app_id]" class="form-control" value="' . htmlentities($php_native['onesignal_app_id']) . '" placeholder="48ceafc4-04ad-468d-94c9-19ec2f02d9c2"/>';
$content .= '<p class="help-block">' . __e('Your OneSignal AppId, available in <a target="_blank" href="https://documentation.onesignal.com/docs/generate-a-google-server-api-key">OneSignal</a>') . '</p>';
$content .= '</div>';
$content .= '<div class="form-group">';
$content .= '<label>' . __e('REST API Key') . '</label>';
$content .= '<input type="text" name="php_native[onesignal_api_key]" class="form-control" value="' . htmlentities($php_native['onesignal_api_key']) . '" placeholder="MGZhNjdkYmUtMWUyNi00OTZkLWE1NjQtMWUxMjYwOTk5MDUy"/>';
$content .= '<p class="help-block">' . __e('Your OneSignal ApiKey, required for push notification sender') . '</p>';
$content .= '</div>';
$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-danger btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div><!-- ./box -->';

// TODO: LAYOUT HTML - FORM PRODUCTION
$content .= '<div class="box box-default">';
$content .= '<div class="box-header with-danger">';
$content .= '<h3 class="box-title"><i class="fa fa-users"></i> ' . __e('Production') . '</h3>';
$content .= '<div class="pull-right box-tools">';
$content .= '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">';
$content .= '<i class="fa fa-minus"></i>';
$content .= '</button>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div class="box-body">';


$content .= '<table class="table">';
$content .= '<tr>';
if ($php_native['debugger_enable'] == true)
{
    $content .= '<td><input type="checkbox" name="php_native[debugger_enable]" class="flat-red" checked/></td><td>' . __e('Debugger (Show error message)') . '</label>';
} else
{
    $content .= '<td><input type="checkbox" name="php_native[debugger_enable]" class="flat-red"/></td><td>' . __e('Debugger (Show error message)') . '</label>';
}
$content .= '</tr>';
$content .= '<tr>';
if ($php_native['api_protector_enable'] == true)
{
    $content .= '<td><input type="checkbox" name="php_native[api_protector_enable]" class="flat-red" checked/></td><td>' . __e('RESTful-API Protector (JSON can only be accessed by real device)') . '</label>';
} else
{
    $content .= '<td><input type="checkbox" name="php_native[api_protector_enable]" class="flat-red"/></td><td>' . __e('RESTful-API Protector (JSON can only be accessed by real device)') . '</label>';
}
$content .= '</tr>';
$content .= '<tr>';
if ($php_native['gzip_enable'] == true)
{
    $content .= '<td><input type="checkbox" name="php_native[gzip_enable]" class="flat-red" checked/></td><td>' . __e('GZIP Compressed (Compress the size of the Webpage/RESTful-API so that it can run faster)') . '</label>';
} else
{
    $content .= '<td><input type="checkbox" name="php_native[gzip_enable]" class="flat-red"/></td><td>' . __e('GZIP Compressed (Compress the size of the Webpage/RESTful-API so that it can run faster)') . '</label>';
}
$content .= '</tr>';
$content .= '</table>';

$content .= '</div><!-- ./box-body -->';
$content .= '<div class="box-footer pad">';
$content .= '<input ' . $disable_button_save . ' name="submit" type="submit" class="btn btn btn-default btn-flat pull-left" value="' . __e('Save Changes') . '" />';
$content .= '</div>';
$content .= '</div><!-- ./box -->';


$content .= '</div><!-- ./col-md-3 -->';
$content .= '</div>';
$content .= '</form>';
if ($php_code_available == true)
{
    $content .= '<div class="nav-tabs-custom">';
    $content .= '<ul class="nav nav-tabs">';
    $content .= '<li class="active"><a href="#tab_sql_structure" data-toggle="tab">SQL - Structure</a></li>';
    $content .= '<li><a href="#tab_sql_sample" data-toggle="tab">SQL - Sample</a></li>';
    $content .= '<li><a href="#tab_php_admin" data-toggle="tab">PHP - Admin</a></li>';
    $content .= '<li><a href="#tab_php_restapi" data-toggle="tab">PHP - RESTful API</a></li>';
    $content .= '<li><a href="#tab_php_restapi_help" data-toggle="tab">URL and Parameter</a></li>';
    $content .= '</ul>';
    $content .= '<div class="tab-content">';
    $content .= '<div class="tab-pane active" id="tab_sql_structure">';
    $content .= '<div class="callout callout-default">' . __e('If you already have a table in SQL (using other CMS) do not use this sql codes, but you do not have a SQL database, log in to phpMyAdmin and create database then create tables using this code:') . '</div>';
    $content .= '<textarea id="sql-structure-code" data-type="sql">';
    $content .= $sql_code;
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a href="?p=php-native-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="tab-pane" id="tab_sql_sample">';
    $content .= '<div class="callout callout-default">' . __e('This is an sample data, you can use this sample data to speed up your work') . '</div>';
    $content .= '<textarea id="sql-sample-code" data-type="sql">';
    $content .= $sql_example_code;
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a href="?p=php-native-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="tab-pane" id="tab_php_admin">';
    $content .= '<div class="callout callout-default">' . __e('This code is used to create a web for managing data or a web administrator, You can save it with the file name <code>admin.php</code>, <code>root.php</code> or <code>cp.php</code>') . '</div>';
    $content .= '<textarea id="php-admin-code" data-type="php">';
    $content .= htmlentities($php_admin);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a href="?p=php-native-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="tab-pane" id="tab_php_restapi">';
    $content .= '<div class="callout callout-default">' . __e('This is the code that is used to create a RESTful-api, save this code with the file name: <code>restapi.php</code>') . '</div>';
    $content .= '<textarea id="php-restapi-code" data-type="php">';
    $content .= htmlentities($php_api);
    $content .= '</textarea>';
    $content .= '<div class="tab-footer">';
    $content .= '<a href="?p=php-native-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="tab-pane" id="tab_php_restapi_help">';
    $content .= '<div class="callout callout-default">' . __e('Here is the RESTful-API information and parameters that you can use.') . '</div>';
    $content .= $rest_api_url;
    $content .= '<div class="tab-footer">';
    $content .= '<a href="?p=php-native-generator&download=true" class="btn btn btn-primary btn-flat pull-left">Download</a>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div><!-- ./tab-content -->';
    $content .= '</div><!-- ./nav-tabs-custom -->';
}
// TODO: TEMPLATES
$template->page_js = $page_js;
$template->page_breadcrumb = $breadcrumb;
$template->page_title = __e('(IMAB) PHP Native Generator');
$template->page_desc = __e('Eazy create php and sql codes for a backend website for your apps');
$template->page_content = $content;

?>