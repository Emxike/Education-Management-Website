<?php


namespace App\Core\Util;


class StringUtil
{
    /**
     * @param int $length
     * @return false|string
     */
    public static function random($length = 16)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length * 2);
            if ($bytes === false) {
                throw new \RuntimeException('Unable to generate random string.');
            }
            return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length);
        }
        return static::quickRandom($length);
    }

    /**
     * @param int $length
     * @return false|string
     */
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * @param string|null $str
     * @return bool
     */
    public static function isEmpty(?string $str)
    {
        return $str == null || ctype_space($str) || $str == '';
    }

    /**
     * @param string|null $str
     * @return bool
     */
    public static function isNotEmpty(?string $str)
    {
        return !self::isEmpty($str);
    }

    /**
     * @param string $value
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function truncate(string $value, int $limit = 100, string $end = '')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool $case_sensitive
     * @return bool
     */
    public static function startsWith(string $haystack, string $needle, bool $case_sensitive = true)
    {
        if ($case_sensitive) {
            return strpos($haystack, $needle) === 0;
        } else {
            return stripos($haystack, $needle) === 0;
        }
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function endsWith(string $haystack, string $needle)
    {
        // Search forward starting from end minus needle length characters
        if ($needle === '') {
            return true;
        }

        $diff = \strlen($haystack) - \strlen($needle);
        return $diff >= 0 && strpos($haystack, $needle, $diff) !== false;
    }

    /**
     * @param string $string
     * @param string $stringToSearch
     * @return bool
     */
    public static function contains(string $string, string $stringToSearch)
    {
        return (stripos($string, $stringToSearch) !== false);
    }

    /**
     * @param string $value
     * @return string|string[]
     */
    public static function removeSpace(string $value)
    {
        return str_replace('　', '', str_replace(' ', '', $value));
    }

    /**
     * @param string $str
     * @return string|null
     */
    public static function getLastChar(string $str)
    {
        // Get length of string
        $len = mb_strlen($str);
        // If string is empty, then do not check
        if ($len == 0) {
            return null;
        }

        return mb_substr($str, $len - 1, 1);
    }

    /**
     * @param string $str
     * @return string|null
     */
    public static function removeLastChar(string $str)
    {
        // Get length of string
        $len = mb_strlen($str);
        // If string is empty, then do not check
        if ($len == 0) {
            return null;
        }
        return mb_substr($str, 0, $len - 1);
    }
}
