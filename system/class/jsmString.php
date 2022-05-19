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


/**
 * jsmString
 * 
 * @package ionic4
 * @author Jasman
 * @copyright 2019
 * @version $Id$
 * @access public
 */
class jsmString
{
    /**
     * jsmString::toClassName()
     * 
     * @param mixed $string
     * @return
     */
    public function toClassName($string)
    {
        $string = trim($string);
        $Allow = null;
        $char = ' -_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        for($i = 0; $i < strlen($string); $i++) {
            if(strstr($char,$string[$i]) != false) {
                $Allow .= $string[$i];
            }
        }
        $Allow = ucwords(str_replace(array('-','_'),' ',strtolower($Allow)));
        return str_replace(' ','',$Allow);
    }
    /**
     * jsmString::toVar()
     * 
     * @param mixed $string
     * @param string $allow
     * @return
     */
    public function toVar($string,$allow = ",")
    {
        $string = trim($string);
        $string = str_replace('-','_',strtolower($string));
        $Allow = null;
        $char = ' abcdefghijklmnopqrstuvwxyz1234567890_'.$allow;
        for($i = 0; $i < strlen($string); $i++) {
            if(strstr($char,$string[$i]) != false) {
                $Allow .= $string[$i];
            }
        }
        $Allow = str_replace(' ','_',strtolower($Allow));
        return $Allow;
    }
    
    /**
     * jsmString::toFileName()
     * 
     * @param mixed $string
     * @return
     */
    public function toFileName($string)
    {
        $string = strtolower(trim($string));
        $Allow = null;
        $char = ' abcdefghijklmnopqrstuvwxyz1234567890-_';
        for($i = 0; $i < strlen($string); $i++) {
            if(strstr($char,$string[$i]) != false) {
                $Allow .= $string[$i];
            }
        }
        $Allow = str_replace(array(' ','_'),'-',strtolower($Allow));
        return $Allow;
    }


    /**
     * jsmString::toSQL()
     * 
     * @param mixed $string
     * @return
     */
    function toSQL($string)
    {
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_12345678900.';
        $Allow = null;
        $string = str_replace(array(
            ' ',
            '-',
            '__'),'_',($string));

        $string = str_replace(array('___','__'),'_',($string));
        for($i = 0; $i < strlen($string); $i++) {
            if(strstr($char,$string[$i]) != false) {
                $Allow .= $string[$i];
            }
        }
        return $Allow;
    }
    
 
    /**
     * jsmString::toUserClassName()
     * 
     * @param mixed $string
     * @return
     */
    function toUserClassName($string)
    {
        $className = $this->toClassName($string);
        return strtolower($className[0]) . substr($className, 1, strlen($className));
    }
    
    /**
     * jsmString::toArray()
     * 
     * @param string $str
     * @return void
     */
    function toArray($str = '')
    {
        $new_arr = array();
        $arrs = explode(',', $str);
        foreach ($arrs as $arr)
        {
            if ($arr != '')
            {
                $new_arr[] = $this->toVar($arr);
            }
        }
        return $new_arr;
    }
}

?>