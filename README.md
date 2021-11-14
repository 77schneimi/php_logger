# php_logger

LoggerFramework implemented in PHP ^7.4.

This is no standalone skript.  
It can be used to embedd it in another php application.

## Loglevels

+ _trace_   - logs everything like values of parameters etc. Never use this in production!
+ _debug_   - use logs to debug and find errors
+ _info_    - to log some important informations
+ _warning_ - something went wrong but application can continue
+ _error_   - a mistake happes, this can be critical
+ _fatal_   - worst cas of error. application will stop

You find this in File `LogLevel.php`.
