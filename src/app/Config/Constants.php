<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);
#
$varGRASD1 = linux11('bXlzcWw4MA==');
$varGRASD2 = linux11('cm9vdA==');
$varGRASD3 = linux11('cGFzczEyMw==');
$varGRASD4 = linux11('Ym9td2Vi');
$varGRASD5 = linux11('TXlTUUxp');
$varGRASD6 = linux11('');
#
$varGRASQ1 = linux11('MTAuMTQ2Ljg0LjE2NQ==');
$varGRASQ2 = linux11('cm9vdA==');
$varGRASQ3 = linux11('cGFzczEyMw==');
$varGRASQ4 = linux11('Ym9td2Vi');
$varGRASQ5 = linux11('TXlTUUxp');
$varGRASQ6 = linux11('');
/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code
#
function linux11($parameter)
{
    return base64_decode($parameter);
}
/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);
#
defined('F50F290DA67C44A9BD335F90D944C341') or define('F50F290DA67C44A9BD335F90D944C341', $varGRASD1);
defined('F8AA48DB44422290018F96B9E6453191') or define('F8AA48DB44422290018F96B9E6453191', $varGRASD2);
defined('A0AD14C16BAAC887E8906395619AD40A') or define('A0AD14C16BAAC887E8906395619AD40A', $varGRASD3);
defined('D586E08660DB8F1EF7446D40F91A0C2F') or define('D586E08660DB8F1EF7446D40F91A0C2F', $varGRASD4);
defined('CF25C93AE07A576A93DFC3B19CEC1861') or define('CF25C93AE07A576A93DFC3B19CEC1861', $varGRASD5);
defined('E024C63CA3CB403A1DC176A97F74B678') or define('E024C63CA3CB403A1DC176A97F74B678', $varGRASD6);
#
defined('B07E60D958B2A411E548AF279F7DECF9') or define('B07E60D958B2A411E548AF279F7DECF9', $varGRASQ1);
defined('C49AFC99CAEA33318BCBB8DE6A26D933') or define('C49AFC99CAEA33318BCBB8DE6A26D933', $varGRASQ2);
defined('BAECA335DE8DFC253B31BAF4F6222DDE') or define('BAECA335DE8DFC253B31BAF4F6222DDE', $varGRASQ3);
defined('C2B1A1FB186A242329829C2997C35783') or define('C2B1A1FB186A242329829C2997C35783', $varGRASQ4);
defined('AD8EA978C4A449A14618C457F9EFB7F8') or define('AD8EA978C4A449A14618C457F9EFB7F8', $varGRASQ5);
defined('BB3DCADC18F46D905A5B406189D35EEB') or define('BB3DCADC18F46D905A5B406189D35EEB', $varGRASQ6);
/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);
#
$server_name = isset($_SERVER['SERVER_NAME']) ? ($_SERVER['SERVER_NAME']) : (NULL);
$server_port = isset($_SERVER['SERVER_PORT']) ? ($_SERVER['SERVER_PORT']) : ('0');
#
if (
    $server_port == '80'
) {
    scbdd($server_name);
} elseif (
    $server_port == '443'
) {
    scbdd($server_name);
} elseif (
    $server_port == '45300'
) {
    scbdd($server_name);
} else {
    exit('O Sistema não Encontrou a PORTA: ' . $server_port . ' Para este Sistema');
}
function scbdd($server_name)
{
    if (
        $server_name == 'localhost'
    ) {
        defined('GRUPO_DB_CONFIG') or define('GRUPO_DB_CONFIG', 'FIAPTPA_HML');
    } elseif (
        $server_name == '127.0.0.1' ||
        $server_name == '10.146.84.140' ||
        $server_name == '10.11.62.148'
        ) {
            defined('GRUPO_DB_CONFIG') or define('GRUPO_DB_CONFIG', 'FIAPTPA_DEV');
    } else {
        exit('Não Encontramos HOST: ' . $server_name . ' Para este Sistema');
    }
}
#
if (
    $server_name == 'localhost'
    || $server_name == '127.0.0.1'
    || $server_name == '10.146.84.140'
) {
    # Ambiente DEV
    defined('DEBUG_MY_PRINT') or define('DEBUG_MY_PRINT', true);
} else {
    # Ambiente Default
    defined('DEBUG_MY_PRINT') or define('DEBUG_MY_PRINT', true);
}
