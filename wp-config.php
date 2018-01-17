<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
ini_set('max_input_vars',5000);
ini_set('max_execution_time',300);
ini_set('post_max_size','50M');
ini_set('upload_max_filesize','50M');
ini_set('memory_limit','1024M');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true);
//define( 'WPCACHEHOME', '/home/leomax/public_html/wordpress/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'nownews');

/** MySQL database username */
//define('DB_USER', 'nownews');
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', '380ltNJFMHtsONGWENfwJz8IotSgNYXatfmUONV0');
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
#define('DB_COLLATE', '');
define( 'DB_COLLATE', 'utf8_general_ci' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
/**
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');
**/
define('AUTH_KEY',         'NKTlyZN/2CA<>qM@k@!w*SKW[Sww16%yh:y#0He,G+!Ptb{gggn?jhD[IqRuD|=5');
define('SECURE_AUTH_KEY',  '.0Z_@rUVIv&lyxA.fBvMtAIZK5--l8i(|7$/bvRfey!a>n*7KU3GG:W^u8#Cz+Wn');
define('LOGGED_IN_KEY',    '%g=nV:*hJ$r|<N <K4?38Ga|vT]]I`#fddh+8ig^)[|*0e*P6afct75O0#+lk&i&');
define('NONCE_KEY',        '+eQ6gNoi:L7|-o^`eUQtcj/[`lESAb|18x*@hDTc<SxpBHnB:N2F[zZN0Fv6D_oN');
define('AUTH_SALT',        'aj=j&H{unh&C+-=Ser@]`,7<k|Q: ddI4xGwA&!}6~=.qgi)qA-DWZ=|V`eee__W');
define('SECURE_AUTH_SALT', '_IhQ`c]$]!-J%(dZ@~)VaPh_f`XgPvh9s,{}Xd9|JlyIcI:_TP&+nPKB:DAqm3ii');
define('LOGGED_IN_SALT',   'ZV)UCFYOlPyHH+uuCZ;+LL.e^Lc1vbs<sBI=v<QYSP?HKylYU{}~lhtrr0|N4?aM');
define('NONCE_SALT',       '=Ro^OI0/+=NHP?p]y,H}|wqBw3+9brt ]I?i@SW]E3)8JpRF6zq2@YzdWD>`DUH]');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

define('FS_METHOD','direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
