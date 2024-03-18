<?php

if (!function_exists("cleanStr")) {

    function cleanStr($str = null, bool $persistNull = false) {

        if ($persistNull && is_null($str)) {
            return null;
        }

        if (is_null($str)) {
            return "";
        }

        return utf8_encode(trim($str));
    }

}

if (!function_exists("isJson")) {

    function isJson(string $string) {
        json_decode($string, true);
        return (json_last_error() === JSON_ERROR_NONE);
    }

}

if (!function_exists("validateDate")) {

    function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}

if (!function_exists("strlenArr")) {

    function strlenArr(array $dataArr, bool $sanitizeData = false) {

        $retArr = true;

        foreach ($dataArr as $value) {
            if ($sanitizeData) {
                $value = cleanStr($value);
            }
            if (strlen($value) < 1) {
                $retArr = false;
                break;
            }
        }

        return $retArr;
    }

}

if (!function_exists("cleanArr")) {

    function cleanArr($arr, bool $persistNull = false) {

        $retArr = [];

        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                $addKey = cleanStr($key);
                $addVal = "";

                if (is_null($value) && $persistNull) {
                    $addVal = null;
                } elseif (is_array($value)) {
                    $addVal = cleanArr($value);
                } elseif (is_bool($value)) {
                    $addVal = $value;
                } else {
                    $addVal = cleanStr($value);
                }

                $retArr[$addKey] = $addVal;
            }
        }

        return $retArr;
    }

}

if (!function_exists("array_keys_exists")) {

    function array_keys_exists($array_of_keys, $array) {

        $ret = true;

        if (is_array($array_of_keys) && (is_iterable($array) || is_subclass_of($array, "Illuminate\Database\Eloquent\Model")) && count($array_of_keys)) {

            foreach ($array_of_keys as $key => $value) {

                if ((is_string($value) && strlen($value)) || (is_numeric($value))) {
                    $value = cleanStr($value);

                    if (\Illuminate\Support\Arr::exists($array, $value)) {
                        continue;
                    }
                }

                $ret = false;
                break;
            }
        } else {
            $ret = false;
        }

        return $ret;
    }

}