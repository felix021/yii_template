<?php

/* wrapper for Yii::log() */

class Log
{
    protected static $last_log = '';
    public static function getLastLog()
    {
        return self::$last_log;
    }

    //all arrays in args will be sent to 'var_export' and converted to a string
    protected static function write($level, $args = [])
    {
        if (count($args) == 0) {
            throw new CException("not message?");
        }

        foreach ($args as &$arg) {
            if (is_array($arg)) {
                $arg = var_export($arg, true);
            }
        }
        
        if (count($args) == 1) {
            $msg = $args[0];
        } else {
            $msg = call_user_func_array("sprintf", $args);
        }
        self::$last_log = $msg;

        Yii::log($msg, $level);

        if (Yii::app() instanceof CConsoleApplication) {
            $trace = debug_backtrace();
            if (count($trace) >= 3) {
                $caller = $trace[2];
                $log_caller = sprintf('[%s::%s] ', $caller['class'], $caller['function']);
            } else {
                $log_caller = '';
            }
            fprintf(STDERR, "%s [%s] %s%s\n", date("Y-m-d H:i:s"), $level, $log_caller, $msg);
        }
    }

    public static function profile()
    {
        self::write(CLogger::LEVEL_PROFILE, func_get_args());
    }

    public static function trace()
    {
        self::write(CLogger::LEVEL_TRACE, func_get_args());
    }

    public static function info()
    {
        self::write(CLogger::LEVEL_INFO, func_get_args());
    }

    public static function warning()
    {
        self::write(CLogger::LEVEL_WARNING, func_get_args());
    }

    public static function error()
    {
        self::write(CLogger::LEVEL_ERROR, func_get_args());
    }
}
