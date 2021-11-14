<?php

declare(strict_types=1);

namespace php_logger;

require_once SITE_ROOT . "/php_logger/iLogger.php";
require_once SITE_ROOT . "/php_logger/LogLevel.php";

use php_logger\iLogger;
use php_logger\LogLevel;

/**
 * Implementation of Logger Interface
 * 
 * @copyright   Michael Schneider
 *  
 * @category    Class
 * @package     php_logger
 * @author      77schneimi
 */
class Logger implements iLogger
{
    // Properties
    private const newLine = "\r\n";
    private $logLevel;


    /**
     * Constructor
     * 
     * @param iLogger $log          : Logger
     */
    public function __construct(int $logLevel)
    {
        $this->logLevel = $logLevel;
    }


    /**
     * Logs a Trace - Message
     * Logs when Loglevel is TRACE
     * 
     * @param [string|Array|Exception|Error] $msg : Message
     */
    public function trace($msg)
    {
        if ($this->logLevel == LogLevel::TRACE_LEVEL) {
            $this->save(" TRACE - " . $this->render($msg));
        }
    }


    /**
     * Logs a Debug - Message
     * Logs when Loglevel is DEBUG or lower
     * 
     * @param [string|Array|Exception|Error] $msg : Message
     */
    public function debug($msg)
    {
        if ($this->logLevel <= LogLevel::DEBUG_LEVEL) {
            $this->save(" DEBUG - " . $this->render($msg));
        }
    }

    /**
     * Logs a Information - Message
     * Logs when Loglevel is INFO or lower
     * 
     * @param [string|Array|Exception|Error] $msg: Message
     */
    public function info($msg)
    {
        if ($this->logLevel <= LogLevel::INFO_LEVEL) {
            $this->save(" INFO  - " . $this->render($msg));
        }
    }

    /**
     * Logs a Warning - Message
     * Logs when Loglevel is WARN or lower
     * 
     * @param [string|Array|Exception|Error] $msg : Message
     */
    public function warning($msg)
    {
        if ($this->logLevel <= LogLevel::WARNING_LEVEL) {
            $this->save(" WARN  - " . $this->render($msg));
        }
    }

    /**
     * Logs a Error - Message
     * Logs when Loglevel is ERROR or lower
     * 
     * @param [string|Array|Exception|Error] $msg : Message
     */
    public function error($msg)
    {
        if ($this->logLevel <= LogLevel::ERROR_LEVEL) {
            $this->save(" ERROR - " . $this->render($msg));
        }
    }

    /**
     * Logs a Fatal/Critical - Message
     * Logs when Loglevel is FATAL or lower
     * 
     * @param [string|Array|Exception|Error] $msg : Message
     */
    public function fatal($msg)
    {
        if ($this->logLevel <= LogLevel::FATAL_LEVEL) {
            $this->save(" FATAL - " . $this->render($msg));
        }
    }

    /**
     * Render a Logging Message to String
     *
     * @param [string|Array|Exception|Error] $msg : Message
     * 
     * @return string : rendered Message
     */
    private function render($any): string
    {
        $type = gettype($any);

        switch ($type) {

            case 'object':
                // it's an Error | Exception
                $msg = $any->getFile() . "->Ex/Er - " .
                    strval($any->getLine()) . " : " .
                    $any->getMessage() . self::newLine;
                return $msg;

            case 'string':
                $msg = $this->getHierarchy() . " : " . $any . self::newLine;
                return $msg;

            case 'array':
                return print_r($any, TRUE) . self::newLine;

            default:
                return print_r($any, TRUE) . self::newLine;
        }
    }

    /**
     * get TraceStack of Call
     *
     * @return string : Caller Stack 
     */
    private function getHierarchy(): string
    {
        $dbTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);
        //print_r($dbTrace); - print stacktrace

        for ($i = 0; $i < count($dbTrace); $i++) {

            if ($dbTrace[$i]['file'] != "/app/php_logger/Logger.php") {

                $funcName = $this->getCallerFunction($dbTrace, $i);

                $hierarchy = $dbTrace[$i]['file'] .
                    $dbTrace[$i]['type'] .
                    $funcName .
                    " - line:" .
                    $dbTrace[$i]['line'];
                break;
            }
        }
        return $hierarchy;
    }

    /**
     * get caller function/method
     * try to read the function, who call the logger method
     * 
     * @param array $dbTrace    : tracestack
     * @param integer $idx      : start index of trace
     * 
     * @return string           : function name of caller
     */
    private function getCallerFunction(array $dbTrace, int $idx): string
    {
        $curentfunction = $dbTrace[$idx]['function'];
        $functionName = "";

        // if call function is from logger, try to read the function above
        if (
            $curentfunction == "error"
            or $curentfunction == "debug"
            or $curentfunction == "warning"
            or $curentfunction == "trace"
            or $curentfunction == "fatal"
        ) {
            $parent = $idx + 1;
            if (isset($dbTrace[$parent]['function'])) {
                $functionName = $dbTrace[$parent]['function'];
            } else {
                //array error, no stack or end of stack reached
                $functionName = $dbTrace[$idx]['function'];
            }
        }

        return $functionName;
    }

    /**
     * save Log Message into Log-File
     *
     * @param string $msg : Logging
     */
    private function save(string $msg)
    {
        date_default_timezone_set('Europe/Berlin');
        $now = date_create()->format('Y-m-d H:i:s.v');
        $today = date_create()->format('Y-m-d');
        $logMsg = $now . ":" . $msg;
        error_log($logMsg, 3, "/logs/logging_{$today}.log" );
    }
}
