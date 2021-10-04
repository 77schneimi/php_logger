<?php declare (strict_types = 1);

namespace php_logger;

/**
 * Logger Factory Interface
 *  
 * @author     77schneimi
 */
interface IFFactory {

    /**
     * get a Logger Object
     * 
     * @param int $loglevel        : Loglevel, default ERROR
     * @return php_logger\IFLogger : Logger Instance
     */
    public function get( int $loglevel = IFLogger::DEBUG_LEVEL ): IFLogger;
  }
