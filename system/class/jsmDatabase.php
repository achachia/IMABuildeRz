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

class jsmDatabase
{
    var $app_prefix = 'test';
    /**
     * jsmDatabase::__construct()
     * 
     * @return
     */
    function __construct()
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $this->app_prefix = $app_prefix;

            if (!file_exists(JSM_PATH . '/outputs/' . $app_prefix))
            {
                if (!mkdir(JSM_PATH . '/outputs/' . $app_prefix, 0777, true))
                {
                    die("Permission denied, please use: <pre>chmod -R 777 " . JSM_PATH . '/outputs/' . "*</pre>");
                }
            }
            if (!file_exists(JSM_PATH . '/projects/' . $app_prefix))
            {
                if (!mkdir(JSM_PATH . '/projects/' . $app_prefix, 0777, true))
                {
                    die("Permission denied, please use: <pre>chmod -R 777 " . JSM_PATH . '/projects/' . "*</pre>");
                }
            }
        }
    }

    /**
     * jsmDatabase::toClassName()
     * 
     * @param mixed $string
     * @return
     */
    private function toClassName($string)
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
        return trim(str_replace(' ', '', $Allow));
    }

    /**
     * jsmDatabase::toFileName()
     * 
     * @param mixed $string
     * @return
     */
    private function toFileName($string)
    {
        $string = strtolower(trim($string));
        $Allow = null;
        $char = ' abcdefghijklmnopqrstuvwxyz1234567890-_';
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        $Allow = str_replace(array('_', ' '), '-', strtolower($Allow));
        return trim($Allow);
    }

    /**
     * jsmDatabase::toVar()
     * 
     * @param mixed $string
     * @return
     */
    private function toVar($string, $allow = ",")
    {
        $string = str_replace('-', '_', strtolower(trim($string)));
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
        return trim($Allow);
    }


    /**
     * jsmDatabase::saveProject()
     * 
     * @param mixed $data
     * @return
     */
    function saveProject($data)
    {
        $app_prefix = $this->toFileName($data['app-name']);
        if ($app_prefix == '')
        {
            $app_prefix = 'app-' . crc32($data['app-name']);
        }
        $app_id = str_replace('_', '', $this->toVar($data['app-name']));
        $organization = str_replace('_', '', $this->toVar($data['author-organization']));

        $data['app-prefix'] = $app_prefix;
        $data['app-id'] = JSM_PACKAGE_NAME . '.' . $organization . '.' . $app_id;
        $data['app-lang'] = $data['app-locale'];
        $data['app-locale'] = $data['app-locale'];


        if (isset($data['ionic-storage']))
        {
            if ($data['ionic-storage'] == '')
            {
                unset($data['ionic-storage']);
            }
        }

        if (isset($data['ionic-storage']))
        {
            $data['ionic-storage'] = true;
        } else
        {
            $data['ionic-storage'] = false;
        }

        if (isset($data['capasitor']))
        {
            if ($data['capasitor'] == '')
            {
                unset($data['capasitor']);
            }
        }

        if (isset($data['capasitor']))
        {
            $data['capasitor'] = true;
        } else
        {
            $data['capasitor'] = false;
        }

        $data['imabuilder']['url'] = 'http://' . $_SERVER["HTTP_HOST"] . '/' . $_SERVER["REQUEST_URI"];


        $data['imabuilder']['version'] = JSM_VERSION;
        //$data['imabuilder']['author'] = JSM_USERNAME;
        $data['imabuilder']['emulator-port'] = JSM_IONIC_EMULATOR_PORT;
        $data['imabuilder']['lab-port'] = JSM_IONIC_LAB_PORT;
        $data['imabuilder']['logger-port'] = JSM_IONIC_DEV_LOGGER_PORT;


        if (!file_exists(JSM_PATH . '/projects/' . $app_prefix))
        {
            mkdir(JSM_PATH . '/projects/' . $app_prefix, 0777, true);
        }

        $_SESSION['CURRENT_APP_PREFIX'] = $app_prefix;


        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/apps.json';
        $this->put_contents($file_name, json_encode($data));

    }

    /**
     * jsmDatabase::webConverter()
     * 
     * @param mixed $data
     * @return void
     */
    function webConverter($data)
    {
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        if ($app_prefix != '')
        {
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/webconverter.json';
            $this->put_contents($file_name, json_encode($data));
        }
    }


    /**
     * jsmDatabase::savePopover($data)
     * 
     * @param mixed $data
     * @return void
     */
    function savePopover($data)
    {
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        if ($app_prefix != '')
        {
            $new_items = array();
            foreach ($data['items'] as $item)
            {
                if ($item['label'] !== '')
                {
                    $new_items[] = $item;
                }
            }
            $data['items'] = $new_items;
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/popover.json';
            $this->put_contents($file_name, json_encode($data));
        }
    }


    /**
     * jsmDatabase::savePopover()
     * 
     * @return void
     */
    function getPopover()
    {
        $popover = array();
        $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/popover.json';
        if (file_exists($file_name))
        {
            $popover = json_decode(file_get_contents($file_name), true);
        }

        return $popover;
    }

    /**
     * jsmDatabase::getRawColor($color)
     * 
     * @param string $color
     * @return void
     */
    function getRawColor($color = 'primary')
    {
        $hex_color = '#000000';
        $new_color = array();
        if (isset($_SESSION['_COLOR_NAME']))
        {
            foreach ($_SESSION['_COLOR_NAME'] as $_color)
            {
                $new_color[$_color['value']] = $_color;
            }
        }
        if (isset($new_color[$color]))
        {
            $hex_color = $new_color[$color]['default'];
        }
        return $hex_color;
    }


    function getRawColorLevel($color = 'primary', $level = -25)
    {
        $hexcolor = $this->getRawColor($color);

        list($co['r'], $co['g'], $co['b']) = sscanf($hexcolor, "#%02x%02x%02x");

        $r = (int)($co['r']) + $level;
        if ($r > 254)
        {
            $r = 254;
        }
        if ($r < 0)
        {
            $r = 0;
        }

        $rh = dechex($r);
        if (strlen($rh) == 1)
        {
            $rh = '0' . $rh;
        }

        $g = (int)($co['g']) + $level;
        if ($g > 254)
        {
            $g = 254;
        }
        if ($g < 0)
        {
            $g = 0;
        }
        $gh = dechex($g);
        if (strlen($gh) == 1)
        {
            $gh = '0' . $gh;
        }


        $b = (int)($co['b']) + $level;
        if ($b > 254)
        {
            $b = 254;
        }
        if ($b < 0)
        {
            $b = 0;
        }
        $bh = dechex($b);
        if (strlen($bh) == 1)
        {
            $bh = '0' . $bh;
        }
        $new_color = '#' . $rh . $gh . $bh;

        return $new_color;
    }


    /**
     * jsmDatabase::saveMenus()
     * 
     * @param mixed $settings
     * @return void
     */
    function saveMenu($input_data)
    {
        $data['items'] = array();
        $data['text-header'] = 'My Menu';

        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {


            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/menus.json';
            $data = $input_data;
            if (!isset($data['lines']))
            {
                $data['lines'] = '';
            }
            if (!isset($data['custom-header']))
            {
                $data['custom-header'] = '';
            }
            $data['items'] = array();
            $data['side'] = $this->toVar($data['side']);
            $data['type'] = $this->toVar($data['type']);
            $data['lines'] = $this->toVar($data['lines']);
            $data['custom-header'] = $data['custom-header'];

            foreach ($input_data['items'] as $item)
            {
                if ($item['var'] == '')
                {
                    $item['var'] = $this->toVar($item['label']);
                }

                if ($item['type'] == 'inlink')
                {
                    if ($item['page'] != '')
                    {
                        $item['var'] = $this->toVar($item['page']);
                    }
                }

                if ($item['icon-left'] == '')
                {
                    $item['icon-left'] = '';
                }

                $data['items'][sha1($item['var'])] = $item;

            }
            $data['items'] = array_values($data['items']);
            $this->put_contents($file_name, json_encode($data));
        }
    }

    /**
     * jsmDatabase::saveService()
     * 
     * @param mixed $data
     * @return
     */
    function saveService($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $service_prefix = $this->toFileName($data['name']);
            if ($service_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $data['prefix'] = $service_prefix;
                $data['var'] = $this->toVar($service_prefix);

                $new_name = array();
                $z = 0;
                foreach (explode(' ', $data['name']) as $_name)
                {

                    if ($z == 0)
                    {
                        $new_name[] = strtolower($_name);
                    } else
                    {
                        $new_name[] = ucwords(strtolower($_name));
                    }
                    $z++;
                }

                $data['service'] = implode($new_name);
                $new_angular = array();
                if (isset($data['modules']['angular']))
                {
                    foreach ($data['modules']['angular'] as $angular)
                    {
                        if (isset($angular['path']))
                        {
                            if ($angular['path'] !== '')
                            {
                                if (!isset($angular['cordova']))
                                {
                                    $angular['cordova'] = '';
                                }

                                $new_angular[] = array(
                                    'class' => trim($angular['class']),
                                    'var' => trim($angular['var']),
                                    'cordova' => trim($angular['cordova']),
                                    'path' => trim($angular['path']),
                                    'enable' => true);
                            }
                        }
                    }
                }
                $data['modules']['angular'] = $new_angular;

                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/services.' . $service_prefix . '.json';
                $this->put_contents($file_name, json_encode($data));
            }
        }
    }

    /**
     * jsmDatabase::saveClass()
     * 
     * @param mixed $data
     * @return
     */
    function saveClass($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $component_prefix = $this->toFileName($data['name']);
            if ($component_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $data['prefix'] = $component_prefix;
                //$data['var'] = $this->toVar($component_prefix);


                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/other-class.' . $component_prefix . '.json';
                $this->put_contents($file_name, json_encode($data));
            }
        }
    }


    /**
     * jsmDatabase::saveComponent()
     * 
     * @param mixed $data
     * @return
     */
    function saveComponent($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $component_prefix = $this->toFileName($data['name']);
            if ($component_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $data['prefix'] = $component_prefix;
                $data['var'] = $this->toVar($component_prefix);


                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/components.' . $component_prefix . '.json';
                $this->put_contents($file_name, json_encode($data));
            }
        }
    }

    /**
     * jsmDatabase::saveDirective()
     * 
     * @param mixed $data
     * @return
     */
    function saveDirective($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $directive_prefix = $this->toFileName($data['name']);
            if ($directive_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $data['prefix'] = $directive_prefix;
                $data['var'] = $this->toVar($directive_prefix);

                $new_name = array();
                $z = 0;
                foreach (explode(' ', $data['name']) as $_name)
                {

                    if ($z == 0)
                    {
                        $new_name[] = strtolower($_name);
                    } else
                    {
                        $new_name[] = ucwords(strtolower($_name));
                    }
                    $z++;
                }
                $data['directive'] = implode($new_name);
                $new_angular = array();
                if (isset($data['modules']['angular']))
                {
                    foreach ($data['modules']['angular'] as $angular)
                    {
                        if (isset($angular['path']))
                        {
                            if (!isset($angular['var']))
                            {
                                $angular['var'] = '';
                            }

                            if (!isset($angular['cordova']))
                            {
                                $angular['cordova'] = '';
                            }

                            if (!isset($angular['cordova-variable']))
                            {
                                $angular['cordova-variable'] = array();
                            }

                            if (!isset($angular['cordova-preference']))
                            {
                                $angular['cordova-preference'] = array();
                            }
                            if (!isset($angular['cordova-config']))
                            {
                                $angular['cordova-config'] = '';
                            }
                            if (!isset($angular['capasitor-note']))
                            {
                                $angular['capasitor-note'] = '';
                            }

                            if ($angular['path'] !== '')
                            {
                                $new_angular[] = array(
                                    'class' => trim($angular['class']),
                                    'var' => trim($angular['var']),
                                    'cordova' => trim($angular['cordova']),
                                    'cordova-variable' => $angular['cordova-variable'],
                                    'cordova-preference' => $angular['cordova-preference'],
                                    'cordova-config' => $angular['cordova-config'],
                                    'capasitor-note' => $angular['capasitor-note'],
                                    'path' => trim($angular['path']),
                                    'enable' => true);
                            }
                        }
                    }
                }
                $data['modules']['angular'] = $new_angular;


                $new_input = array();
                if (isset($data['input']))
                {
                    foreach ($data['input'] as $inp)
                    {
                        if ($inp['var'] != '')
                        {
                            $new_input[] = $inp;
                        }
                    }
                }


                $data['input'] = $new_input;

                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/directives.' . $directive_prefix . '.json';
                $this->put_contents($file_name, json_encode($data));
            }
        }
    }


    /**
     * jsmDatabase::getDirective()
     * 
     * @param mixed $directive_name
     * @return void
     */
    function getDirective($directive_name)
    {
        $directive_data = null;
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/directives.' . $directive_name . '.json';
        if (file_exists($file_name))
        {
            $directive_data = json_decode(file_get_contents($file_name), true);
        }
        return $directive_data;
    }


    /**
     * jsmDatabase::saveEnvironment()
     * 
     * @param mixed $data
     * @return
     */
    function saveEnvironment($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $environment_prefix = $this->toFileName($data['name']);

            $data['name'] = $data['name'];
            $data['prefix'] = $environment_prefix;


            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/environments.' . $environment_prefix . '.json';
            $this->put_contents($file_name, json_encode($data));
        }
    }


    /**
     * jsmDatabase::saveLocalization()
     * 
     * @param mixed $data
     * @return
     */
    function saveLocalization($data)
    {

        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $_prefix = $data['prefix'];
            if ($_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $new_data = $data;
                $new_data['words'] = array();
                $z = 0;
                foreach ($data['words'] as $word)
                {
                    $text = trim($word['text']);
                    if ($text != '')
                    {
                        $new_data['words'][$z]['text'] = $text;
                        $new_data['words'][$z]['translate'] = trim($word['translate']);
                        $z++;
                    }
                }
                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/localization.' . $_prefix . '.json';
                $this->put_contents($file_name, json_encode($new_data));
            }
        }
    }


    /**
     * jsmDatabase::savePipe()
     * 
     * @param mixed $data
     * @return
     */
    function savePipe($data)
    {
        $old_data = $data;
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $pipe_prefix = $this->toFileName($data['name']);
            if ($pipe_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $data['prefix'] = $pipe_prefix;
                $data['var'] = $this->toVar($pipe_prefix);

                $new_name = array();
                $z = 0;
                foreach (explode(' ', $data['name']) as $_name)
                {

                    if ($z == 0)
                    {
                        $new_name[] = strtolower($_name);
                    } else
                    {
                        $new_name[] = ucwords(strtolower($_name));
                    }
                    $z++;
                }
                $data['pipe'] = implode($new_name);

                $new_angular = array();
                if (isset($data['modules']['angular']))
                {
                    foreach ($data['modules']['angular'] as $angular)
                    {
                        if (isset($angular['path']))
                        {
                            if ($angular['path'] !== '')
                            {
                                $new_angular[] = array(
                                    'class' => trim($angular['class']),
                                    'var' => trim($angular['var']),
                                    'cordova' => trim($angular['cordova']),
                                    'path' => trim($angular['path']),
                                    'enable' => true);
                            }
                        }
                    }
                }
                $new_arg = array();
                if (isset($data['arg']))
                {
                    foreach ($data['arg'] as $arg)
                    {
                        if ($arg['var'] != '')
                        {
                            $new_arg[] = $arg;
                        }
                    }
                }
                $data['arg'] = $new_arg;
                $data['modules']['angular'] = $new_angular;

                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/pipes.' . $pipe_prefix . '.json';
                $this->put_contents($file_name, json_encode($data));
            }
        }
    }

    /**
     * jsmDatabase::deleteDirective()
     * 
     * @param mixed $directive_name
     * @return
     */
    function deleteDirective($directive_name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/directives.' . $directive_name . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }

    }

    /**
     * jsmDatabase::deleteService()
     * 
     * @param mixed $service_name
     * @return
     */
    function deleteService($service_name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/services.' . $service_name . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }

    }

    /**
     * jsmDatabase::deletePipe()
     * 
     * @param mixed $pipe_name
     * @return
     */
    function deletePipe($pipe_name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/pipes.' . $pipe_name . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }

    }

    /**
     * jsmDatabase::deleteClass()
     * 
     * @param mixed $class_prefix
     * @return
     */
    function deleteClass($class_prefix)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/other-class.' . $class_prefix . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }

    }

    /**
     * jsmDatabase::deleteLocalization()
     * 
     * @param mixed $name
     * @return
     */
    function deleteLocalization($name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/localization.' . $name . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }
    }


    /**
     * jsmDatabase::deleteEnvironment()
     * 
     * @param mixed $name
     * @return
     */
    function deleteEnvironment($name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/environments.' . $name . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }

    }

    /**
     * jsmDatabase::getLocalization()
     * 
     * @param mixed $locale_name
     * @return void
     */
    function getLocalization($locale_name)
    {
        $locale_data = null;
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/localization.' . $locale_name . '.json';
        if (file_exists($file_name))
        {
            $locale_data = json_decode(file_get_contents($file_name), true);
        }
        return $locale_data;
    }

    /**
     * jsmDatabase::updateLocalization($data)
     * 
     * @param mixed $data
     * @return void
     */
    function updateLocalization($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $_prefix = $data['prefix'];
            if ($_prefix != '')
            {
                $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
                $oldData = $this->getLocalization($_prefix);

                $new_data = $oldData;
                if (!isset($oldData['prefix']))
                {
                    $new_data['prefix'] = $data['prefix'];
                    $new_data['name'] = $data['name'];
                }
                $new_data['words'] = array();

                foreach ($data['words'] as $word)
                {
                    $text = trim($word['text']);
                    $translate = trim($word['translate']);

                    if (($text != '') && ($translate != ''))
                    {
                        $var = sha1($text);
                        $new_data['words'][$var]['text'] = $text;
                        $new_data['words'][$var]['translate'] = trim($word['translate']);
                    }
                }
                if (!isset($oldData['words']))
                {
                    $oldData['words'] = array();
                }
                foreach ($oldData['words'] as $word)
                {
                    $text = trim($word['text']);
                    $translate = trim($word['translate']);
                    if (($text != '') && ($translate != ''))
                    {
                        $var = sha1($text);
                        $new_data['words'][$var]['text'] = $text;
                        $new_data['words'][$var]['translate'] = trim($word['translate']);
                    }
                }

                $new_data['words'] = array_values($new_data['words']);


                $file_name = JSM_PATH . '/projects/' . $app_prefix . '/localization.' . $_prefix . '.json';
                $this->put_contents($file_name, json_encode($new_data));
            }
        }

    }

    /**
     * jsmDatabase::getPipe()
     * 
     * @param mixed $pipe_name
     * @return void
     */
    function getPipe($pipe_name)
    {
        $pipe_data = null;
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/pipes.' . $pipe_name . '.json';
        if (file_exists($file_name))
        {
            $pipe_data = json_decode(file_get_contents($file_name), true);
        }
        return $pipe_data;
    }


    /**
     * jsmDatabase::getService()
     * 
     * @param mixed $service_name
     * @return void
     */
    function getService($service_name)
    {
        $service_data = null;
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/services.' . $service_name . '.json';
        if (file_exists($file_name))
        {
            $service_data = json_decode(file_get_contents($file_name), true);
        }
        return $service_data;
    }


    /**
     * jsmDatabase::saveAddOns($addons,$data)
     * 
     * @param mixed $addons
     * @param mixed $data
     * @return
     */
    function saveAddOns($addons, $data)
    {
        $new_data = array();
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $new_data = $data;
            $new_data['page-target'] = $data['page-target'];
            $new_data['date-modified'] = time();
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/addons.' . $addons . '.' . $new_data['page-target'] . '.json';
            $this->put_contents($file_name, json_encode($new_data));
        }
    }


    /**
     * jsmDatabase::saveConfig($data)
     * 
     * @param mixed $data
     * @return
     */
    function saveConfig($data)
    {
        $new_data = array();
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $new_data = $data;
            $new_data['content'] = $data['content'];

            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/config.json';
            $this->put_contents($file_name, json_encode($new_data));
        }
    }


    /**
     * jsmDatabase::savePhpNative($data)
     * 
     * @param mixed $data
     * @return
     */
    function savePhpNative($data)
    {
        $new_data = array();
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $new_data = $data;
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/php_native_generator.json';
            $this->put_contents($file_name, json_encode($new_data));
        }
    }

    /**
     * jsmDatabase::saveGlobal($data)
     * 
     * @param mixed $data
     * @return
     */
    function saveGlobal($prefix, $data)
    {
        $new_data = array();
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $new_data['name'] = $this->toFileName($data['name']);
            $new_data = $data;
            $new_data['prefix'] = $this->toFileName($prefix);
            $new_data['target'] = $this->toFileName($new_data['name']);
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/global.' . $this->toFileName($prefix) . '.' . $this->toFileName($new_data['name']) . '.json';
            $this->put_contents($file_name, json_encode($new_data));
        }
    }


    /**
     * jsmDatabase::saveWpPlugin($data)
     * 
     * @param mixed $data
     * @return
     */
    function saveWpPlugin($data)
    {
        $new_data = array();
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
            $new_data = $data;
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/wp_plugin_generator.json';
            $this->put_contents($file_name, json_encode($new_data));
        }
    }

    /**
     * jsmDatabase::getWpPlugin()
     * 
     * @return array();
     */
    function getWpPlugin()
    {
        $setting_data = array();
        $current = $this->current();
        if (isset($current['wp_plugin_generator']))
        {
            $setting_data = $current['wp_plugin_generator'];
        }
        return $setting_data;
    }


    /**
     * jsmDatabase::getEnvironment()
     * 
     * @param mixed $pipe_name
     * @return void
     */
    function getEnvironment($name)
    {
        $_data = null;
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/environments.' . $name . '.json';
        if (file_exists($file_name))
        {
            $_data = json_decode(file_get_contents($file_name), true);
        }
        return $_data;
    }

    /**
     * jsmDatabase::getPhpNative()
     * 
     * @return array();
     */
    function getPhpNative()
    {
        $setting_data = array();
        $current = $this->current();
        if (isset($current['php_native_generator']))
        {
            $setting_data = $current['php_native_generator'];
        }
        return $setting_data;
    }


    /**
     * jsmDatabase::getAddOns($addons,$target)
     * 
     * @param mixed $addons
     * @param mixed $target
     * @return
     */
    public function getAddOns($addons, $target)
    {
        $data_addons = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/addons.' . $addons . '.' . $target . '.json';
        if (file_exists($file_name))
        {
            $data_addons = json_decode(file_get_contents($file_name), true);
        }
        return $data_addons;
    }
    /**
     * jsmDatabase::getAddOns($addons,$target)
     * 
     * @param mixed $addons
     * @param mixed $target
     * @return
     */
    public function getAddonsUsed($addons)
    {
        $addons_settings = array();
        $current = $this->current();
        if (isset($current['addons'][$addons]))
        {
            $addons_settings = $current['addons'][$addons];
        }
        return $addons_settings;
    }

    /**
     * jsmDatabase::deleteGlobal($ts,$target)
     * 
     * @param mixed $ts
     * @param mixed $target
     * @return
     */
    function deleteGlobal($ts, $page_target)
    {

        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/global.' . $ts . '.' . basename($page_target) . '.json';
        if (file_exists($file_name))
        {
            unlink($file_name);
            return true;
        } else
        {
            return false;
        }
    }


    /**
     * jsmDatabase::deleteAddOns($addons,$target)
     * 
     * @param mixed $addons
     * @param mixed $target
     * @return
     */
    function deleteAddOns($addons, $target)
    {

        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/addons.' . $addons . '.' . basename($target) . '.json';
        if (file_exists($file_name))
        {
            unlink($file_name);
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * jsmDatabase::deleteTable()
     * 
     * @param mixed $table_name
     * @return
     */
    function deleteTable($table_name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/tables.' . basename($table_name) . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
            return true;
        } else
        {
            return false;
        }
    }


    /**
     * jsmDatabase::saveTable()
     * 
     * @param mixed $data
     * @return void
     */
    function saveTable($data)
    {
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {

            $table_name = $this->toFileName(str_replace('_', ' ', $data['table-name']));

            $table_prefix = $this->toVar($data['table-name']);
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];

            $new_data['app-prefix'] = $app_prefix;
            $new_data['date-modified'] = time();
            $new_data['table-prefix'] = $table_name;
            $new_data['table-var'] = $this->toVar($table_prefix);
            $new_data['table-name'] = ($table_prefix);
            $new_data['table-singular-name'] = $data['table-singular-name'];
            $new_data['table-plural-name'] = $data['table-plural-name'];
            $new_data['table-desc'] = $data['table-desc'];
            $new_data['table-icon-fontawesome'] = $data['table-icon-fontawesome'];
            $new_data['table-icon-dashicons'] = $data['table-icon-dashicons'];
            $new_data['table-icon-ionicons'] = $data['table-icon-ionicons'];
            $new_data['table-variable-as-value'] = $data['table-variable-as-value'];
            $new_data['table-variable-as-label'] = $data['table-variable-as-label'];
            $new_data['form-method'] = $data['form-method'];
            if (!isset($data['form-filter-duplicate']))
            {
                $data['form-filter-duplicate'] = false;
            }
            $new_data['form-filter-duplicate'] = $data['form-filter-duplicate'];

            if (!isset($data['auth-enable']))
            {
                $data['auth-enable'] = false;
            }
            $new_data['auth-enable'] = $data['auth-enable'];

            $new_data['table-cols'] = array();
            //$z = 0;
            foreach ($data['table-cols'] as $table_cols)
            {
                $col_prefix = $table_cols['variable'];
                if ($col_prefix == '')
                {
                    $col_prefix = $this->toVar($table_cols['label']);
                }
                if ($col_prefix != '')
                {
                    $var_id = $this->toVar(trim($col_prefix));

                    $new_data['table-cols'][$var_id]['type'] = trim($table_cols['type']);
                    $new_data['table-cols'][$var_id]['label'] = trim($table_cols['label']);
                    $new_data['table-cols'][$var_id]['variable'] = $this->toVar(trim($col_prefix));
                    $new_data['table-cols'][$var_id]['option'] = trim($table_cols['option']);
                    $new_data['table-cols'][$var_id]['default'] = trim($table_cols['default']);
                    $new_data['table-cols'][$var_id]['info'] = trim($table_cols['info']);


                    //$new_data['table-cols'][$var_id]['json_list'] = @$table_cols['json-list'];

                    if (isset($table_cols['json-list']))
                    {
                        $new_data['table-cols'][$var_id]['json_list'] = true;
                    } else
                    {
                        $new_data['table-cols'][$var_id]['json_list'] = false;
                    }

                    if (isset($table_cols['json-detail']))
                    {
                        $new_data['table-cols'][$var_id]['json_detail'] = true;
                    } else
                    {
                        $new_data['table-cols'][$var_id]['json_detail'] = false;
                    }

                    if (isset($table_cols['item-list']))
                    {
                        $new_data['table-cols'][$var_id]['item_list'] = true;
                    } else
                    {
                        $new_data['table-cols'][$var_id]['item_list'] = false;
                    }

                    if (isset($table_cols['json-input']))
                    {
                        $new_data['table-cols'][$var_id]['json_input'] = true;
                    } else
                    {
                        $new_data['table-cols'][$var_id]['json_input'] = false;
                    }


                    if ($table_cols['type'] == 'select-table')
                    {
                        $new_data['table-cols'][$var_id]['option'] = trim($table_cols['table-source']);
                        $new_data['table-cols'][$var_id]['table_source'] = trim($table_cols['table-source']);
                    } else
                    {
                        $new_data['table-cols'][$var_id]['table_source'] = '';
                    }

                    //$z++;
                }
            }
            $new_data['table-cols'] = array_values($new_data['table-cols']);
            $file_name = JSM_PATH . '/projects/' . $app_prefix . '/tables.' . $table_name . '.json';
            $this->put_contents($file_name, json_encode($new_data));
        }
    }

    /**
     * jsmDatabase::getTable()
     * 
     * @param mixed $table_name
     * @return
     */
    function getTable($table_name)
    {
        $table_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/tables.' . basename($table_name) . '.json';
        if (file_exists($file_name))
        {
            $table_data = json_decode(file_get_contents($file_name), true);
        }

        return $table_data;
    }

    /**
     * jsmDatabase::getTables()
     * 
     * @return array();
     */
    function getTables()
    {
        $tables_data = array();
        $current = $this->current();
        if (isset($current['tables']))
        {
            $tables_data = $current['tables'];
        }
        return $tables_data;
    }

    /**
     * jsmDatabase::clearPage()
     * 
     * @return
     */
    function clearPage()
    {
        foreach (glob(JSM_PATH . '/projects/' . $this->app_prefix . '/pages.*.~tmp') as $filename)
        {
            @unlink($filename);
        }
        return true;
    }

    /**
     * jsmDatabase::historyPage()
     * 
     * @return
     */
    function historyPage($page_name)
    {
        $page_history = array();
        $z = 0;
        foreach (glob(JSM_PATH . '/projects/' . $this->app_prefix . '/pages.' . $page_name . '.*.~tmp') as $filename)
        {
            $timestamp = str_replace(array('pages.' . $page_name . '.', '.~tmp'), '', basename($filename));

            $page_history[$z]['timestap'] = (int)$timestamp;
            $page_history[$z]['file'] = basename($filename);
            $z++;
        }
        return $page_history;
    }


    /**
     * jsmDatabase::restorePage()
     * 
     * @param mixed $page_name
     * @param mixed $timestamp
     * @return void
     */
    function restorePage($page_name, $timestamp)
    {
        $file_temp = realpath(JSM_PATH . '/projects/' . $this->app_prefix . '/pages.' . $page_name . '.' . $timestamp . '.~tmp');
        $file_target = realpath(JSM_PATH . '/projects/' . $this->app_prefix . '/pages.' . $page_name . '.json');
        @unlink($file_target);
        copy($file_temp, $file_target);
        return true;
    }

    /**
     * jsmDatabase::saveChildPage($data)
     * 
     * @param mixed $data
     * @return
     */
    function saveChildPage($data)
    {
        $page_prefix = $this->toFileName($data['name']);
        $page_var = $this->toVar($data['name']);
        $class_page = $this->toClassName($data['name']) . 'Page';
        $app_prefix = $this->app_prefix;
        $root_page = $this->toFileName($data['root']);

        $data['root'] = $root_page;
        $data['name'] = $page_prefix;
        $data['var'] = $page_var;
        $data['date-modified'] = time();

        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/childpages.' . $root_page . '.' . $page_prefix . '.json';
        $temp_file_name = JSM_PATH . '/projects/' . $app_prefix . '/childpages.' . $root_page . '.' . $page_prefix . '.' . time() . '.~tmp';

        if (file_exists($file_name))
        {
            copy($file_name, $temp_file_name);
        }
        $this->put_contents($file_name, json_encode($data));
    }


    /**
     * jsmDatabase::savePage()
     * 
     * @param mixed $data
     * @return
     */


    function savePage($data)
    {

        $page_prefix = trim($this->toFileName($data['name']));
        $page_var = $this->toVar($data['name']);
        $class_page = $this->toClassName($data['name']) . 'Page';
        $data['name'] = $page_prefix;
        $data['var'] = $page_var;
        $data['date-modified'] = time();
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }

        if (!isset($data['header']['mid']['items'][0]['value']))
        {
            $data['header']['mid']['items'][0]['value'] = '';
        }
        if (!isset($data['header']['mid']['items'][1]['value']))
        {
            $data['header']['mid']['items'][1]['value'] = '';
        }
        if (!isset($data['header']['mid']['items'][2]['value']))
        {
            $data['header']['mid']['items'][2]['value'] = '';
        }

        if (!isset($data['header']['mid']['items'][0]['label']))
        {
            $data['header']['mid']['items'][0]['label'] = '';
        }
        if (!isset($data['header']['mid']['items'][1]['label']))
        {
            $data['header']['mid']['items'][1]['label'] = '';
        }
        if (!isset($data['header']['mid']['items'][2]['label']))
        {
            $data['header']['mid']['items'][2]['label'] = '';
        }

        if ($data['header']['mid']['items'][0]['value'] == '')
        {
            $data['header']['mid']['items'][0]['value'] = $this->toVar($data['header']['mid']['items'][0]['label']);
        }
        if ($data['header']['mid']['items'][1]['value'] == '')
        {
            $data['header']['mid']['items'][1]['value'] = $this->toVar($data['header']['mid']['items'][1]['label']);
        }
        if ($data['header']['mid']['items'][2]['value'] == '')
        {
            $data['header']['mid']['items'][2]['value'] = $this->toVar($data['header']['mid']['items'][2]['label']);
        }

        if (!isset($data['back-button']))
        {
            $data['back-button'] = '';
        }

        if (!isset($data['content']['ts']))
        {
            $data['content']['ts'] = '';
        }


        if (!isset($data['param']))
        {
            $data['param'] = '';
        } else
        {
            $data['param'] = $this->toVar($data['param'], ',');
        }

        if (!isset($data['content']['scss']))
        {
            $data['content']['scss'] = '';
        }
        if (!isset($data['header']['mid']['type']))
        {
            $data['header']['mid']['type'] = 'title';
        }

        if (!isset($data['header']['bg-statusbar']))
        {
            $data['header']['bg-statusbar'] = '';
        }

        $data['content']['html'] = str_replace('<ion-card *ngIf="segmentTab" ><ion-card-content>{{ segmentTab }}</ion-card-content></ion-card>', '', $data['content']['html']);
        if ($data['header']['mid']['type'] == 'segment')
        {
            if (!preg_match("/segmentTab/i", $data['content']['html']))
            {
                $data['content']['html'] .= '<ion-card *ngIf="segmentTab" ><ion-card-content>{{ segmentTab }}</ion-card-content></ion-card>';
            }
        }

        if (!isset($data['content']['enable-fullscreen']))
        {
            $data['content']['enable-fullscreen'] = false;
        } else
        {
            if ($data['content']['enable-fullscreen'] != false)
            {
                $data['content']['enable-fullscreen'] = true;
            }
        }


        if (isset($data['content']['enable-padding']))
        {
            $data['content']['enable-padding'] = true;
        } else
        {
            $data['content']['enable-padding'] = false;
        }


        if (isset($data['content']['disable-scroll']))
        {
            $data['content']['disable-scroll'] = true;
        } else
        {
            $data['content']['disable-scroll'] = false;
        }


        //fix angular
        $new_angular = array();
        if (isset($data['modules']['angular']))
        {
            foreach ($data['modules']['angular'] as $angular)
            {
                if (isset($angular['path']))
                {
                    if ($angular['path'] !== '')
                    {
                        if (!isset($angular['cordova']))
                        {
                            $angular['cordova'] = '';
                        }
                        $new_angular[] = array(
                            'class' => trim($angular['class']),
                            'var' => trim($angular['var']),
                            'cordova' => trim($angular['cordova']),
                            'path' => trim($angular['path']),
                            'enable' => true);
                    }
                }
            }
        }


        if ($data['header']['mid']['type'] == 'search')
        {
            if (!preg_match("/filterItems/i", $data['code']['other']))
            {
                $data['code']['other'] .= "\t" . "\r\n";
                $data['code']['other'] .= "\t" . '/**' . "\r\n";
                $data['code']['other'] .= "\t" . '* ' . $class_page . ':filterItems($event)' . "\r\n";
                $data['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
                $data['code']['other'] .= "\t" . '*' . "\r\n";
                $data['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
                $data['code']['other'] .= "\t" . '**/' . "\r\n";
                $data['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
                $data['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
                $data['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== ""){' . "\r\n";
                $data['code']['other'] .= "\t\t\t" . '// your code here' . "\r\n";
                $data['code']['other'] .= "\t\t\t" . 'this.filterQuery = filterVal.toLowerCase();' . "\r\n";
                $data['code']['other'] .= "\t\t" . '}' . "\r\n";
                $data['code']['other'] .= "\t\t" . 'return true;' . "\r\n";
                $data['code']['other'] .= "\t" . '}' . "\r\n";
                $data['code']['other'] .= "\t" . "\r\n";

            }
        }
        if ($data['header']['mid']['type'] == 'search-with-barcode')
        {
            if (!preg_match("/filterItems/i", $data['code']['other']))
            {
                $data['code']['other'] .= "\t" . "\r\n";
                $data['code']['other'] .= "\t" . '/**' . "\r\n";
                $data['code']['other'] .= "\t" . '* ' . $class_page . ':filterItems($event)' . "\r\n";
                $data['code']['other'] .= "\t" . '* @param any $event' . "\r\n";
                $data['code']['other'] .= "\t" . '*' . "\r\n";
                $data['code']['other'] .= "\t" . '* @required for searchbar' . "\r\n";
                $data['code']['other'] .= "\t" . '**/' . "\r\n";
                $data['code']['other'] .= "\t" . 'public filterItems(evt: any) {' . "\r\n";
                $data['code']['other'] .= "\t\t" . 'let filterVal = evt.target.value;' . "\r\n";
                $data['code']['other'] .= "\t\t" . 'if (filterVal && filterVal.trim() !== ""){' . "\r\n";
                $data['code']['other'] .= "\t\t\t" . '// your code here' . "\r\n";
                $data['code']['other'] .= "\t\t\t" . 'this.filterQuery = filterVal.toLowerCase();' . "\r\n";
                $data['code']['other'] .= "\t\t" . '}' . "\r\n";
                $data['code']['other'] .= "\t\t" . 'return true;' . "\r\n";
                $data['code']['other'] .= "\t" . '}' . "\r\n";
                $data['code']['other'] .= "\t" . "\r\n";

            }
            $new_angular[] = array(
                'class' => 'BarcodeScanner',
                'var' => 'barcodeScanner',
                'cordova' => 'phonegap-plugin-barcodescanner',
                'path' => '@ionic-native/barcode-scanner/ngx',
                'enable' => true);

        }
        $fix_angular = array();
        foreach ($new_angular as $_angular)
        {
            $_var = sha1($_angular['class'] . $_angular['var'] . $_angular['cordova'] . $_angular['path']);
            $fix_angular[$_var] = $_angular;
        }
        $data['modules']['angular'] = array_values($fix_angular);

        //fix tinymce
        $data['content']['html'] = str_replace('outputs/' . $this->app_prefix . '/src/', '', $data['content']['html']);
        $data['content']['html'] = str_replace('./outputs/' . $this->app_prefix . '/src/', '', $data['content']['html']);


        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/pages.' . $page_prefix . '.json';
        $temp_file_name = JSM_PATH . '/projects/' . $app_prefix . '/pages.' . $page_prefix . '.' . time() . '.~tmp';

        if (file_exists($file_name))
        {
            copy($file_name, $temp_file_name);
        }
        if ($page_prefix != '')
        {
            $this->put_contents($file_name, json_encode($data));
        }
    }


    /**
     * jsmDatabase::getPage()
     * 
     * @param mixed $page_name
     * @return
     */
    function getPage($page_name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/pages.' . basename($page_name) . '.json';
        if (file_exists($file_name))
        {
            $page_data = json_decode(file_get_contents($file_name), true);
        }
        if (!isset($page_data['content']['html']))
        {
            $page_data['content']['html'] = '';
        }
        $page_data['content']['html'] = str_replace('src="assets/images/', 'src="./outputs/' . $this->app_prefix . '/src/assets/images/', $page_data['content']['html']);

        return $page_data;
    }


    /**
     * jsmDatabase::getFontComponents()
     * 
     * @return array();
     */
    function getFontComponents()
    {
        $data = array();
        $current = $this->current();
        if (isset($current['font-components']))
        {
            $data = $current['font-components'];
        }
        return $data;
    }

    /**
     * jsmDatabase::getFonts()
     * 
     * @return array();
     */
    function getFonts()
    {
        $pages_data = array();
        $current = $this->current();
        if (isset($current['google-fonts']))
        {
            $pages_data = $current['google-fonts'];
        }
        return $pages_data;
    }


    /**
     * jsmDatabase::getPages()
     * 
     * @return array();
     */
    function getPages()
    {
        $pages_data = array();
        $current = $this->current();
        if (isset($current['pages']))
        {
            $pages_data = $current['pages'];
        }
        return $pages_data;
    }

    /**
     * jsmDatabase::getStaticPages()
     * 
     * @return array();
     */
    public function getStaticPages()
    {
        $pages_data = array();
        $current = $this->current();
        if (isset($current['pages']))
        {
            $new_pages_data = $current['pages'];
            foreach ($new_pages_data as $new_page_data)
            {
                if (!isset($new_page_data['param']))
                {
                    $new_page_data['param'] = '';
                }

                if (!preg_match("/-detail/", $new_page_data['name']))
                {
                    $pages_data[] = $new_page_data;
                }

            }
        }
        return $pages_data;
    }

    /**
     * jsmDatabase::saveFonts()
     * 
     * @param mixed $data
     * @return void
     */
    function saveFonts($data)
    {
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        $new_styles = array();
        foreach ($data['fonts'] as $style)
        {
            if ($style['prefix'] != "")
            {
                $new_styles[($style['prefix'])] = $style;
            }
        }

        $new_data['fonts'] = array_values($new_styles);


        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/google-fonts.json';
        $this->put_contents($file_name, json_encode($new_data));
    }


    /**
     * jsmDatabase::saveFontComponents()
     * 
     * @param mixed $data
     * @return void
     */
    function saveFontComponents($data)
    {
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        $new_components = array();
        foreach ($data['components'] as $component)
        {
            $var = $component['name'];

            if ($var != "")
            {
                $new_components[$var]['name'] = $component['name'];
                $new_components[$var]['font'] = $component['font'];
            }
        }

        $new_components['components'] = array_values($new_components);


        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/font-components.json';
        $this->put_contents($file_name, json_encode($data));
    }


    /**
     * jsmDatabase::saveEnqueues()
     * 
     * @param mixed $data
     * @return void
     */
    function saveEnqueues($data)
    {
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        $new_data = $data;
        $new_styles = array();
        foreach ($data['styles'] as $style)
        {
            if ($style['url'] != "")
            {
                $new_styles[($style['url'])] = $style;
            }
        }

        $new_data['styles'] = array_values($new_styles);


        $new_scripts = array();
        if (!isset($data['scripts']))
        {
            $data['scripts'] = array();
        }
        foreach ($data['scripts'] as $script)
        {
            if ($script['url'] != "")
            {
                $new_scripts[($script['url'])] = $script;
            }
        }

        $new_data['scripts'] = array_values($new_scripts);


        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/enqueues.json';
        $this->put_contents($file_name, json_encode($new_data));
    }

    /**
     * jsmDatabase::addEnqueues(type,data)
     * 
     * @param string $type = 'styles' | 'scripts'
     * @param array $sources = array('url'=>'','attr'=>'')
     */

    function addEnqueues($type = 'styles', $sources)
    {
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        $db = $this->current();
        $new_data = $db['enqueues'];
        if ($type == 'styles')
        {
            $new_styles = array();
            foreach ($sources as $source)
            {
                $var = md5($source['url']);
                $new_styles[$var] = $source;
            }
            foreach ($db['enqueues']['styles'] as $style)
            {
                $var = md5($style['url']);
                $new_styles[$var] = $style;
            }
            $new_data['styles'] = array_values($new_styles);
        }
        if ($type == 'scripts')
        {
            $new_scripts = array();
            foreach ($sources as $source)
            {
                $var = md5($source['url']);
                $new_scripts[$var] = $source;
            }
            foreach ($db['enqueues']['scripts'] as $script)
            {
                $var = md5($script['url']);
                $new_scripts[$var] = $script;
            }
            $new_data['scripts'] = array_values($new_scripts);
        }

        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/enqueues.json';
        $this->put_contents($file_name, json_encode($new_data));
    }


    /**
     * jsmDatabase::saveThemes()
     * 
     * @param mixed $data
     * @return void
     */
    function saveThemes($data)
    {
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        $_new_custom_color = array();
        foreach ($data['custom-color'] as $custom_color)
        {

            if ($custom_color['name'] != '')
            {
                $var = md5($custom_color['name']);
                $_new_custom_color[$var]['name'] = str_replace('-', '', $this->toFileName($custom_color['name']));
                $_new_custom_color[$var]['color'] = $custom_color['color'];
                $_new_custom_color[$var]['contrast'] = $custom_color['contrast'];
                $_new_custom_color[$var]['shade'] = $custom_color['shade'];
                $_new_custom_color[$var]['tint'] = $custom_color['tint'];
            }
        }
        $data['custom-color'] = array_values($_new_custom_color);
        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/themes.json';
        $this->put_contents($file_name, json_encode($data));
    }

    /**
     * jsmDatabase::saveSplashScreen()
     * 
     * @param mixed $data
     * @return void
     */
    function saveSplashScreen($data)
    {
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }

        $file_name = JSM_PATH . '/projects/' . $app_prefix . '/splashscreen.json';
        $this->put_contents($file_name, json_encode($data));
    }

    /**
     * jsmDatabase::getSplashScreen()
     * 
     * @return void
     */
    function getSplashScreen()
    {
        $splashscreen = array();
        $current = $this->current();
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        if (isset($current['splashscreen']))
        {
            $splashscreen = $current['splashscreen'];
        }

        return $splashscreen;
    }


    /**
     * jsmDatabase::getThemes()
     * 
     * @return void
     */
    function getThemes()
    {
        $themes = array();
        $current = $this->current();
        $app_prefix = 'default';
        if (isset($_SESSION['CURRENT_APP_PREFIX']))
        {
            $app_prefix = $_SESSION['CURRENT_APP_PREFIX'];
        }
        if (isset($current['themes']))
        {
            $themes = $current['themes'];
        }

        return $themes;
    }


    /**
     * jsmDatabase::deletePage()
     * 
     * @param mixed $page_name
     * @return
     */
    function deletePage($page_name)
    {
        $page_data = array();
        $file_name = JSM_PATH . '/projects/' . $this->app_prefix . '/pages.' . $page_name . '.json';
        if (file_exists($file_name))
        {
            @unlink($file_name);
        }

        return true;
    }


    /**
     * jsmDatabase::refresh()
     * 
     * @return
     */
    function refresh()
    {
        $apps = array();
        foreach (glob(JSM_PATH . '/projects/*') as $filename)
        {
            if (file_exists($filename . '/apps.json'))
            {
                $apps[] = json_decode(file_get_contents($filename . '/apps.json'), true);
            }

        }
        $_SESSION['ALL_APPS'] = $apps;
        return $apps;
    }

    /**
     * jsmDatabase::current()
     * 
     * @return
     */
    function current()
    {
        $current_app = null;


        if (file_exists(JSM_PATH . '/projects/' . $_SESSION['CURRENT_APP_PREFIX'] . '/pages..json'))
        {
            @unlink(JSM_PATH . '/projects/' . $_SESSION['CURRENT_APP_PREFIX'] . '/pages..json');
        }

        foreach (glob(JSM_PATH . '/projects/' . $_SESSION['CURRENT_APP_PREFIX'] . '/*.json') as $filename)
        {
            $var_name = pathinfo($filename, PATHINFO_FILENAME);
            $var_subname = explode('.', $var_name);

            if (count($var_subname) == 1)
            {
                $current_app[$var_name] = json_decode(file_get_contents($filename), true);
            }
            if (count($var_subname) == 2)
            {
                $current_app[$var_subname[0]][$var_subname[1]] = json_decode(file_get_contents($filename), true);
            }
            if (count($var_subname) == 3)
            {
                $current_app[$var_subname[0]][$var_subname[1]][$var_subname[2]] = json_decode(file_get_contents($filename), true);
            }
        }
        $_SESSION['CURRENT_APP'] = $current_app;
        return $current_app;
    }

    /**
     * jsmDatabase::put_contents()
     * 
     * @return void
     */
    function put_contents($filename, $data)
    {
        if (defined('JSON_PRETTY_PRINT'))
        {
            file_put_contents($filename, json_encode(json_decode($data), JSON_PRETTY_PRINT));
        } else
        {
            file_put_contents($filename, $data);
        }
    }


}

?>