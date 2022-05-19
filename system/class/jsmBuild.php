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

class jsmBuild
{
    var $basedir = 'output/app/';
    var $type_app = 'ios';
    var $prop = array();
    var $menus = array();

    /**
     * IonicV3::__construct()
     * 
     * @return void
     */
    function __construct($properties, $basedir)
    {

        $this->prop = $properties;
        $this->basedir = $basedir;
    }
}

?>