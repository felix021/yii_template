<?php

class Command extends CConsoleCommand
{
    protected $ts_action_begin = null;
    protected function beforeAction($action, $params)
    {
        $args = substr(json_encode($params, JSON_UNESCAPED_UNICODE), 1, -1);
        Log::info("%s::%s(%s) begins", get_class($this), $action, $args);
        $this->ts_action_begin = microtime(true);
        return true;
    }

    protected function afterAction($action, $params, $exitCode = 0)
    {
        $args = substr(json_encode($params, JSON_UNESCAPED_UNICODE), 1, -1);
        $elapsed = microtime(true) - $this->ts_action_begin;
        $memory  = memory_get_peak_usage() / 1024.0 / 1024; # MB
        Log::info("%s::%s(%s) finished [elapsed:%.06f][memory:%.02fMB]", get_class($this), $action, $args, $elapsed, $memory);

        try {
            $memory_limit_warning = Yii::app()->params->memory_limit_warning;
        } catch (CException $e) {
            $memory_limit_warning = 64; #MB
        }
        if ($memory >= $memory_limit_warning) {
            Log::warning("%s::%s consumed more than %dMB of memory", get_class($this), $action, $memory_limit_warning);
        }
        return $exitCode;
    }
}
