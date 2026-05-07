<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

//Using environment variables for memory limits
$wp_memory_limit = (getenv('WP_MEMORY_LIMIT') && preg_match("/^[0-9]+M$/", getenv('WP_MEMORY_LIMIT'))) ? getenv('WP_MEMORY_LIMIT') : '128M';
$wp_max_memory_limit = (getenv('WP_MAX_MEMORY_LIMIT') && preg_match("/^[0-9]+M$/", getenv('WP_MAX_MEMORY_LIMIT'))) ? getenv('WP_MAX_MEMORY_LIMIT') : '256M';

/** General WordPress memory limit for PHP scripts*/
define('WP_MEMORY_LIMIT', $wp_memory_limit );

/** WordPress memory limit for Admin panel scripts */
define('WP_MAX_MEMORY_LIMIT', $wp_max_memory_limit );

/** This will ensure these are only loaded on Lando */
if (getenv('LANDO_INFO')) {
    /**  Parse the LANDO INFO  */
    $lando_info = json_decode(getenv('LANDO_INFO'));
  
    /** Get the database config */
    $database_config = $lando_info->database;
    /** The name of the database for WordPress */
    define('DB_NAME', $database_config->creds->database);
    /** MySQL database username */
    define('DB_USER', $database_config->creds->user);
    /** MySQL database password */
    define('DB_PASSWORD', $database_config->creds->password);
    /** MySQL hostname */
    define('DB_HOST', $database_config->internal_connection->host);
  
    /** URL routing (Optional, may not be necessary) */
    // define('WP_HOME','http://mysite.lndo.site');
    // define('WP_SITEURL','http://mysite.lndo.site');
}
else { // Azure default setup

    // ** Database settings - You can get this info from your web host ** //
    $connectstr_dbhost = getenv('DATABASE_HOST');
    $connectstr_dbname = getenv('DATABASE_NAME');
    $connectstr_dbusername = getenv('DATABASE_USERNAME');
    $connectstr_dbpassword = getenv('DATABASE_PASSWORD');

    /** The name of the database for WordPress */
    define('DB_NAME', $connectstr_dbname);

    /** MySQL database username */
    define('DB_USER', $connectstr_dbusername);

    /** MySQL database password */
    define('DB_PASSWORD',$connectstr_dbpassword);

    /** MySQL hostname */
    define('DB_HOST', $connectstr_dbhost);

    /** Enabling support for connecting external MYSQL over SSL*/
    $mysql_sslconnect = (getenv('DB_SSL_CONNECTION')) ? getenv('DB_SSL_CONNECTION') : 'true';
    if (strtolower($mysql_sslconnect) != 'false' && !is_numeric(strpos($connectstr_dbhost, "127.0.0.1")) && !is_numeric(strpos(strtolower($connectstr_dbhost), "localhost"))) {
        define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);
    }
}

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'z[(58&ZYB}r01d%HYh^` R[N&{qHI|{mMq*Vyg`<Jh8eC?rX)K&WSBHKg#w?_4Tr' );
define( 'SECURE_AUTH_KEY',  '%uPMK,YP|_7E76Bl2!hTYs)Vw$0sK0r9.Y}u3>/kS-evQ$[B=sRfD!vRdMzS[$7i' );
define( 'LOGGED_IN_KEY',    'DQg]k@?Q*Oj#|gCG(pOrA:%X>P:yjfV--A}K7cJZIeM5|DW{PrMxMKqNaL(-4V/-' );
define( 'NONCE_KEY',        '!TkgIX@v+!d3NXN1L7OcAsz ]SmZ-|fW[cf)E]H!p?Y#unz`GFR2owukx@]6`XLw' );
define( 'AUTH_SALT',        'CJz}{^[;c`i`TDr(3]Z u6;X3Bj@(L=:9UNX.8n;wKUn/|*r/,gsMEhbCR8;//X^' );
define( 'SECURE_AUTH_SALT', '7kX{Nr2zqY7dB_euxb_SkN~[J5`PipTs`2r2tuR{X@y&gRM10E~3KQl7C+EYr.YZ' );
define( 'LOGGED_IN_SALT',   'Fyc_#A0<!dN]4>BPJyRGgyE{75~p@;#2h6QvUj4cF1TT!SjntaKTqzq?2y(hFsaX' );
define( 'NONCE_SALT',       'dRO9IK4sbTY O$Obu>]hve%CB4)(p)J?)zngLPn/FKkdMwgfNnDRYE`cS60Nx]Z[' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy blogging. */
/**https://developer.wordpress.org/reference/functions/is_ssl/ */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
	$_SERVER['HTTPS'] = 'on';

// Set http host to localhost if not set by server
$http_host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : 'localhost';

$http_protocol='http://';
if (!preg_match("/^localhost(:[0-9])*/", $http_host) && !preg_match("/^127\.0\.0\.1(:[0-9])*/", $http_host)) {
	$http_protocol='https://';
}

//Relative URLs for swapping across app service deployment slots
define('WP_HOME', $http_protocol . $http_host);
define('WP_SITEURL', $http_protocol . $http_host);
define('WP_CONTENT_URL', '/wp-content');
define('DOMAIN_CURRENT_SITE', $http_host);

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/** Disable auto updates. */
define( 'WP_AUTO_UPDATE_CORE', false );
