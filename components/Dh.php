<?php

//fengmin

class Dh
{
    const INTERVAL_DAY      = 86400;
    const INTERVAL_HOUR     = 3600;
    const INTERVAL_MINUTE   = 60;

    public static function now($format = 'Y-m-d H:i:s')
    {
        return date($format);
    }

    public static function microtime()
    {
        return microtime(true);
    }

    public static function ago($seconds, $format = 'Y-m-d H:i:s')
    {
        return date($format, time() - $seconds);
    }

    public static function validate($date_string, $format = 'Y-m-d H:i:s')
    {
        return date($format, strtotime($date_string)) == $date_string;
    }

    /*
     * date_string format: YYYY-mm-dd HH:MM:SS
     */
    public static function date($date_string)
    {
        return substr($date_string, 0, 10);
    }

    /*
     * date_string format: YYYY-mm-dd HH:MM:SS
     */
    public static function time($date_string)
    {
        return substr($date_string, 11);
    }

    /*
     * date_string format: YYYY-mm-dd HH:MM:SS
     */
    public static function hour($date_string)
    {
        return substr($date_string, 11, 2);
    }

    /*
     * date_string format: YYYY-mm-dd HH:MM:SS
     */
    public static function minute($date_string)
    {
        return substr($date_string, 14, 2);
    }
}
