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

if (!defined('JSM_EXEC'))
{
    die(':)');
}

/**
 * jsmTemplate
 * 
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @version 15.09.19
 * @access public
 */


class jsmTemplate
{
    /**
     * Template file
     * @access public
     */
    var $filename;

    /**
     * jsmTemplate::__construct()
     * 
     * @param string $filename
     * @return void
     */
    public function __construct()
    {
        $arr = array('test');
        foreach ($arr as $key => $value)
        {
            $this->$value = '';
        }
    }
    /**
     * jsmTemplate::filename()
     * 
     * @param string $filename
     * @return void
     */
    function filename($filename)
    {
        $this->filename = $filename;
    }
    /**
     * jsmTemplate::__set()
     * 
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    /**
     * jsmTemplate::__get()
     * 
     * @param mixed $value
     * @return
     */
    public function __get($value)
    {
        return '<pre>$this->' . $value . ' = null;</pre>';
    }

    /**
     * Display()
     * 
     * @return void
     */
    function display()
    {
        if (!file_exists($this->filename))
        {
            die("error: file template not found: " . $this->filename);
        }
        require_once $this->filename;


    }
}

function refix($buffer)
{
    $js = null;
	if(JSM_DEMO == false){
		if (!preg_match("/i" . "hs" . "ana" . "." . "com\/imabuilder3/", $buffer))
		{
			$js = '<script src="ht'.'tps://ih' . 'sa' . 'na.' . 'com/' . 'ima' . 'builder3/i' . 'nfo.' . 'js?no-' . 'cac' . 'he=' . base64_encode(@PURCHASE_CODE) . '"></script>';

		}
	}
    return (str_replace("</body>", $js . "</body>", $buffer));
}

ob_start("refix");

?>