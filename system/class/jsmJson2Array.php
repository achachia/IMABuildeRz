<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2018
 * @license Commercial License
 * 
 * @package Ihsana Mobile App Builder
 * 
 */

class Json2Array
{
    /**
     * Json2Array::parse()
     * 
     * @param mixed $arr
     * @return
     */
    private function parse($arr)
    {
        $_1arrs = $arr;
        $var = array();
        foreach(array_keys($_1arrs) as $_1arr) {
            if(is_array($_1arrs[$_1arr])) {
                $_2arrs = $_1arrs[$_1arr];
                foreach(array_keys($_2arrs) as $_2arr) {
                    $text1 = $_1arr.'.';
                    if(is_array($_2arrs[$_2arr])) {
                        $_3arrs = $_2arrs[$_2arr];
                        foreach(array_keys($_3arrs) as $_3arr) {
                            $text2 = $_2arr.'.';
                            if(is_array($_3arrs[$_3arr])) {
                                $_4arrs = $_3arrs[$_3arr];
                                foreach(array_keys($_4arrs) as $_4arr) {
                                    $text3 = $_3arr.'.';
                                    if(is_array($_4arrs[$_4arr])) {
                                        $_5arrs = $_4arrs[$_4arr];
                                        foreach(array_keys($_5arrs) as $_5arr) {
                                            $text4 = $_4arr.'.';
                                            if(is_array($_5arrs[$_5arr])) {
                                                $_6arrs = $_5arrs[$_5arr];
                                                foreach(array_keys($_6arrs) as $_6arr) {
                                                    $text5 = $_5arr.'.';
                                                    if(is_array($_6arrs[$_6arr])) {
                                                        $_7arrs = $_6arrs[$_6arr];
                                                        foreach(array_keys($_7arrs) as $_7arr) {
                                                            $text6 = $_6arr.'.';
                                                            if(is_array($_7arrs[$_7arr])) {
                                                                $_8arrs = $_7arrs[$_7arr];
                                                                foreach(array_keys($_8arrs) as $_8arr) {
                                                                    $text7 = $_7arr.'.';
                                                                    if(is_array($_8arrs[$_8arr])) {
                                                                        $_9arrs = $_8arrs[$_8arr];
                                                                        foreach(array_keys($_9arrs) as $_9arr) {
                                                                            $text8 = $_8arr.'.';
                                                                            if(is_array($_9arrs[$_9arr])) {
                                                                                $_10arrs = $_9arrs[$_9arr];
                                                                                foreach(array_keys($_10arrs) as $_10arr) {
                                                                                    $text9 = $_9arr.'.';
                                                                                    if(is_array($_10arrs[$_10arr])) {

                                                                                    } else {
                                                                                        $var[] = $text1.$text2.$text3.$text4.$text5.$text6.$text7.$text8.$text9.$_10arr;
                                                                                    }
                                                                                }
                                                                            } else {
                                                                                $var[] = $text1.$text2.$text3.$text4.$text5.$text6.$text7.$text8.$_9arr;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $var[] = $text1.$text2.$text3.$text4.$text5.$text6.$text7.$_8arr;
                                                                    }
                                                                }
                                                            } else {
                                                                $var[] = $text1.$text2.$text3.$text4.$text5.$text6.$_7arr;
                                                            }
                                                        }
                                                    } else {
                                                        $var[] = $text1.$text2.$text3.$text4.$text5.$_6arr;
                                                    }
                                                }
                                            } else {
                                                $var[] = $text1.$text2.$text3.$text4.$_5arr;
                                            }
                                        }
                                    } else {
                                        $var[] = $text1.$text2.$text3.$_4arr;
                                    }
                                }
                            } else {
                                $var[] = $text1.$text2.$_3arr;
                            }
                        }
                    } else {
                        $var[] = $text1.$_2arr;
                    }
                }
            } else {
                $var[] = $_1arr;
            }
        }
        return $var;
    }
    /**
     * Json2Array::fileGetContent()
     * 
     * @param mixed $url
     * @return void
     */
    function fileGetContent($url)
    {
        $data = array();
        $data_json = json_decode(file_get_contents($url),true);
        if(is_array($data_json)) {
            $data = $this->parse($data_json);
        }
        return $data;
    }

    /**
     * Json2Array::fixStr()
     * 
     * @param mixed $str
     * @return void
     */
    function fixStr($str)
    {
        $exps = explode('.',$str);
        $new_var = array();
        foreach($exps as $exp) {

            if(is_numeric($exp)) {
                $new_var[] = "[".$exp."]";
            } else {
                if(preg_match("/\:|-/",$exp)) {
                    $new_var[] = "['".$exp."']";
                } else {
                    $new_var[] = ".".$exp;
                }

            }
        }
        $var = implode("",$new_var);
        $ret = $var;
        if($var[0] == ".") {
            $ret = substr($var,1,strlen($var));
        } else {
            $ret = $var;
        }
        return $ret;

    }


    /**
     * Json2Array::format()
     * 
     * @param mixed $arrs
     * @return mixed
     */
    function format($arrs)
    {
        $new_arr = array();
        foreach($arrs as $arr) {
            $new_arr[] = $this->fixStr($arr);
        }
        return $new_arr;
    }

    /**
     * Json2Array::exec()
     * 
     * @return void
     */
    public function exec($url)
    {
        $content = $this->fileGetContent($url);
        file_put_contents(JSM_PATH . '/outputs/json2array.json',$content);
        $ret = $this->format($content);
        return $ret;
    }


}

?>