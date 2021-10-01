<?php declare (strict_types = 1);

namespace LoggerFramework;

use LoggerFramework\IFFactory as IFFactory;
use LoggerFramework\Logger as Logger;

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
    public function getLogger(int $loglevel = IFLogger::ERROR_LEVEL ): IFLogger
    {
        if (!$this->logger) {
            $ll = getenv('LOGLEVEL'); // read the loglevel from enviroment
            $this->logger = new Logger($ll);
            $this->logger->trace("Loglevel was set to:".$ll);
        }
        return $this->logger;
    }
}