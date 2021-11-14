<?php

namespace php_logger;

/**
 * LogLevel
 *
 * @copyright   Michael Schneider
 * 
 * @category    enum Class
 * @package     php_logger
 * @author      77schneimi
 */
class LogLevel
{
    /**
     * Possible Loglevels of this enum
     */
    const TRACE_LEVEL   = 00;
    const DEBUG_LEVEL   = 10;
    const INFO_LEVEL    = 20;
    const WARNING_LEVEL = 30;
    const ERROR_LEVEL   = 40;
    const FATAL_LEVEL   = 50;


    /**
     * Gets allowable values of the enum
     * 
     * @return string[] : array of strings
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::TRACE_LEVEL,
            self::DEBUG_LEVEL,
            self::INFO_LEVEL,
            self::WARNING_LEVEL,
            self::ERROR_LEVEL,
            self::FATAL_LEVEL,
        ];
    }
}
