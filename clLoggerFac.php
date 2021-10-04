<?php declare (strict_types = 1);

namespace php_logger;

require_once SITE_ROOT . "/php_logger/ifLogger.php";
require_once SITE_ROOT . "/php_logger/ifLoggerFac.php";
require_once SITE_ROOT . "/php_logger/clLogger.php";

use php_logger\IFFactory as IFFactory;
use php_logger\IFLogger as IFLogger;
use php_logger\Logger as Logger;

/**
 * Logger Factory
 * 
 * only get a singelton of the Factory and his attributes
 * like Logger Instance.
 * 
 * @author     77schneimi
 */
class Factory implements IFFactory
{
    private static $instance = null;
    private $logger;

    /**
     * Factory Constructor
     * private, so you can only create a Instance by static method
     */
    private function __construct()
    {
        // declared as private, so only a singleton is possible 
    }

    /**
     * create a Factory Instance
     *
     * @return Factory : Factory Instance
     */
    public static function getInstance(): Factory
    {
        if (!self::$instance) {
            self::$instance = new Factory();
        }
        return self::$instance;
    }

    /**
     * Singelton Logger
     * 
     * @param int loglevel - default Error
     * @return Logger      - File Logger
     */
    public function get(int $loglevel = IFLogger::ERROR_LEVEL ): IFLogger
    {
        if (!$this->logger) {
            $this->logger = new Logger($loglevel);
        }
        return $this->logger;
    }
}