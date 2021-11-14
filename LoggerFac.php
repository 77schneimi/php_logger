<?php

declare(strict_types=1);

namespace php_logger;

require_once SITE_ROOT . "/php_logger/iLogger.php";
require_once SITE_ROOT . "/php_logger/iLoggerFac.php";
require_once SITE_ROOT . "/php_logger/Logger.php";
require_once SITE_ROOT . "/php_logger/LogLevel.php";

use php_logger\iFactory;
use php_logger\iLogger;
use php_logger\Logger;
use php_logger\LogLevel;

/**
 * Logger Factory
 * 
 * only get a singelton of the Factory and his properties
 * like Logger Instance.
 * @copyright   Michael Schneider
 * 
 * @category    Factory Class
 * @package     php_logger
 * @author      77schneimi
 */
class Factory implements iFactory
{
    private static $instance = null;
    private $logger = null;

    /**
     * Factory Constructor
     */
    private function __construct()
    {
        // declared as private, so only a singleton is possible 
    }

    /**
     * get Factory Instance
     * creates a Singleton
     *
     * @return Factory : Instance
     */
    public static function getInstance(): Factory
    {
        if (!self::$instance) {
            self::$instance = new Factory();
        }
        return self::$instance;
    }

    /**
     * get Logger
     * 
     * @param LogLevel $loglevel : Logging Level
     */
    public function get(int $loglevel = LogLevel::ERROR_LEVEL): iLogger
    {
        if (!$this->logger) {
            $this->logger = new Logger($loglevel);
        }
        return $this->logger;
    }
}
