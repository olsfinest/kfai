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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kfaiclou');

/** MySQL database username */
define('DB_USER', 'kfaiclou');

/** MySQL database password */
define('DB_PASSWORD', 'jm2i4TS53j');

/** MySQL hostname */
define('DB_HOST', 'db');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cTyGQoAxd7wu8bR>-*jfRA>=*b]x=r?;r`:>o&S!HWYF?hYh742;L)zuQFI/}PZ7');
define('SECURE_AUTH_KEY',  '/>U.%wH0n+J|OE%GL!cv-#9lD:[w!!&;>rE,k)%(Svg$:~v4p*}.K_zghz0~Bz^v');
define('LOGGED_IN_KEY',    'nNb[loSKqDw)^WEXtA38o[;RQOEY5=!G:aT9O0@/hxtpSJf~#P~<|Kny{^79t@f|');
define('NONCE_KEY',        '^$C8^(JUln8(+6</(Lj]n}sA>E~?a=nCIW^j}|&b-_VtPnQ33U}_ZuT*PG-|(;Ua');
define('AUTH_SALT',        'wi:c;R]L3:Y;1xm=o__k=G*qU ]=lH>hvk!Ms,gv}-,&)e<8gtM/TJUODL,c4V^u');
define('SECURE_AUTH_SALT', '~?!}ko-XiQ8C}8D-gsbK/`9g3s8oaWAQe)n:-]^fvyx0%j6r;CyDdltBB]8?1b;S');
define('LOGGED_IN_SALT',   'D?M;;/(&L|yh$lK+@m0%W^G1~/^9IWad;tiVIfq_!b|A<&4.E?0Y&H$JVYF|4%kE');
define('NONCE_SALT',       'Q`HHeFm(e=3l(ax|)CY^rC|MV5|i`WwLj@*^x,Tb/zf2-DJk7NB[m/yLOa=@NSL$');

if (!defined('AUTOMATIC_UPDATER_DISABLED')) define('AUTOMATIC_UPDATER_DISABLED', false);

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


