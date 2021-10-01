<?php declare (strict_types = 1);

namespace LoggerFramework;

/**
 * Logger Factory Interface
 *  
 * @author     77schneimi
 */



interface IFFactory {

    /**
     * get a Logger Object
     * 
     * @param int $loglevel             : Loglevel, default ERROR
     * @return LoggerFramework\IFLogger : Logger Instance
     */
    public function getLogger( int $loglevel = IFLogger::DEBUG_LEVEL ): IFLogger;
  }
