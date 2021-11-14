<?php

declare(strict_types=1);

namespace php_logger;

require_once SITE_ROOT . "/php_logger/LogLevel.php";

use php_logger\LogLevel;


/**
 * Logger Factory Interface
 * 
 * @copyright   Michael Schneider
 * 
 * @category    Interface
 * @package     php_logger
 * @author      77schneimi
 */
interface iFactory
{

  /**
   * get a Logger Object
   * 
   * @param int|LogLevel $loglevel  : set the LogLevel, default ERROR
   * 
   * @return php_logger\iLogger    : Logger
   */
  public function get(int $loglevel = LogLevel::ERROR_LEVEL): iLogger;
}
