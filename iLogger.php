<?php

declare(strict_types=1);

namespace php_logger;

/**
 * Logger Interface
 * 
 * @copyright   Michael Schneider
 * 
 * @category    Interface
 * @package     php_logger
 * @author      77schneimi
 */
interface iLogger
{
    /**
     * tracing
     * logs everything like values of parameters
     */
    public function trace($msg);

    /**
     * debug
     * use logs to debug and find errors
     */
    public function debug($msg);

    /**
     * info
     * important informations
     */
    public function info($msg);

    /**
     * warning
     * something went wrong but application can continue
     */
    public function warning($msg);

    /**
     * error
     * a mistake happes, this can be critical
     */
    public function error($msg);

    /**
     * fatal
     * worst cas of error. application will stop
     */
    public function fatal($msg);
}
