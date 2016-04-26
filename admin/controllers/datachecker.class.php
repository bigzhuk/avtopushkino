<?php
class DataChecker {

    const INVALID_EMAIL = 'Email указан неверно';
    const EMPTY_FIELD = 'Поле не заполнено';

    static function checkNum($str){
        $str=preg_replace("/[^0-9]/","",$str);
        return $str;
    }
    static function checkFloat($str){
        $str=preg_replace("/[^0-9.,]/","",$str);
        return $str;
    }
    static function checkIntComma($str){
        $str=preg_replace("/[^0-9,]/","",$str);
        return $str;
    }
    static function checkStr($str){
        $str=trim($str);
        $str=str_replace(chr(13),"",$str);
        $str=str_replace(chr(10),"",$str);
        $str=stripcslashes($str);
        return $str;
    }
    static function checkUserText($str){
        $str=trim(preg_replace("/[^А-Яа-яA-z0-9., _@!\?#]/u","",$str));
        return $str;
    }

    static function checkPassword($str){
        $str=trim(preg_replace("/[^A-z0-9.,_#@!]/u","",$str)); // проверить не надо ли экранировать #&@! - вот эту хрень
        return $str;
    }

    static function checkLatinNumbers($str){
        $str=trim(preg_replace("/[^A-z0-9]/","",$str));
        return $str;
    }
    static function checkLatinNumUnderscore($str){
        $str=trim(preg_replace("/[^A-z0-9_]/","",$str));
        return $str;
    }
    static function checkUrl($str){
        $str=trim(preg_replace("/[^A-z0-9.\-_\/]/","",$str));
        return $str;
    }
    static function checkLatinText($str){
        $str=trim(preg_replace("/[^A-z0-9.,@ _]/","",$str));
        return $str;
    }

    static function checkDate($str){
        $str=preg_replace("/[^0-9.]/","",$str);
        return $str;
    }

    static function checkPhone($str){
        $str=preg_replace("/[^0-9()-]/","",$str);
        return $str;
    }

    static function getArrayFromPostString($str){
        $str=self::checkLatinText($str);
        if(!empty($str)){
            $str=substr($str, 0, -1);  // отрезаем последнюю запятую
            $arr=explode(",",$str);
            return $arr;
        }
        return false;
    }

    static function checkDateTime($str){
        $str=preg_replace("/[^0-9: -]/","",$str);
        return $str;
    }
    static function checkEmail($mail){
        if ( strlen($mail)==0 or !preg_match("/^[a-z0-9_-].{1,30}@(([a-z0-9-]+\.)+(com|net|org|mil|".
                "edu|gov|arpa|info|biz|inc|name|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-".
                "9]{1,3}\.[0-9]{1,3})$/is",$mail)){
            return false;
        }
        return true;
    }
    static function containEmpty(){
        foreach ($_POST as $key=>$value){
            if(empty($value) and $key!="id"){
                $empty[]=$key;
            }
        }
        return $empty;
    }
    static function prepareSearchString($searchstring){
        $searchstring=preg_replace("/(\bМТ)|(\bмт)/","MT", $searchstring);
        $searchstring=preg_replace("/(\bПодарок\b)|(\bПодарки\b)|(\bподарок\b)|(\bподарки\b)|(\bПодарока\b)/","подарок", $searchstring);
        $searchstring=(str_replace("EK-", "EK0",$searchstring));
        return $searchstring;
    }

}

//$str="asda  sdada@ aksjdh? ! askdjh# %";
//echo DataChecker::checkUserText($str);