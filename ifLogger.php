<?php declare (strict_types = 1);

namespace php_logger;

/**
 * Logger Interface
 *  
 * @author     77schneimi
 */
interface IFLogger {
    
    const TRACE_LEVEL   = 00;
    const DEBUG_LEVEL   = 10;
    const INFO_LEVEL    = 20;
    const WARNING_LEVEL = 30;
    const ERROR_LEVEL   = 40;
    const FATAL_LEVEL   = 50;

    public function trace($msg);
    public function debug($msg);
    public function info($msg);
    public function warning($msg);
    public function error($msg);
    public function fatal($msg);
}