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

function rebuild()
{
    if($_SESSION['CURRENT_APP_PREFIX'] != null)
    {
        $data['version'] = JSM_VERSION;
        $data['app-created'] = date('H:i:s d-m-Y');
        file_put_contents(JSM_PATH.'/projects/'.$_SESSION['CURRENT_APP_PREFIX'].'/builder.json',json_encode($data));

        $src = new jsmIonic($_SESSION['CURRENT_APP'],JSM_PATH.'/outputs/'.$_SESSION['CURRENT_APP_PREFIX']);
        //$src = new jsmIonicV4($_SESSION['CURRENT_APP'],JSM_PATH.'/ionic-apps/'.$_SESSION['CURRENT_APP_PREFIX']);
        
        $build = new jsmBuild($_SESSION['CURRENT_APP'],JSM_PATH.'/outputs/'.$_SESSION['CURRENT_APP_PREFIX']);

    }
}

?>