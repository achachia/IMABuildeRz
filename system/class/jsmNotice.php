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

class jsmNotice
{
    var $data;
    function __construct($arr = array())
    {
        $this->data = $arr;
    }

    function Show()
    {
        if (isset($this->data['type']))
        {
            switch ($this->data['type'])
            {
                case 'danger':
                    $icon = 'ban';
                    break;
                case 'info':
                    $icon = 'info';
                    break;
                case 'success':
                    $icon = 'check';
                    break;
                case 'warning':
                    $icon = 'warning';
                    break;
            }
            $icon = '-';
            $ret = null;
            $ret .= '<div class="alert alert-' . $this->data['type'] . ' alert-dismissible auto-dismissible">';
            $ret .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>';
            $ret .= '<p><strong><i class="icon fa fa-' . $icon . '"></i> ' . trim( $this->data['title']) . '</strong> ';
            $ret .= ', ' . $this->data['message'] . '</p>';
            $ret .= '</div>';
            return $ret;

        } else
        {
            return null;
        }

    }
}

?>