<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'playground');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Un{jU=]trKF,UaQ>l3A4W7t?T`9dW6 s*ka[q.3s1aR9NYPdFR/p~/4BG$}T^f8n');
define('SECURE_AUTH_KEY',  '>3)=>{{rB?@+;^1Os-f}6%f$6/SyqvH2B7A.@g[YPZ<L,coGCu7%T~R-LQDQpM!5');
define('LOGGED_IN_KEY',    'hxJdrEI[(NK~1VR-XYa>mRfYTDx8JS_=r17&J&XHXI|Z!vx yuN=PBmTV+ODD~7i');
define('NONCE_KEY',        '?k~O+90wnJ>i@:^-F*h|92JJO}/|)L)L^)?=P8Zq|Ftvn-2/g{3Z_{qt*<bXAh?~');
define('AUTH_SALT',        '=.wYa%c,p;S4mnLzCirfK;g;MTpAJe0(R;+j!t+dUjq/`9j=UY*+ZSCbcF-Hti+?');
define('SECURE_AUTH_SALT', '4je*3+wRgy`+S}R:xB2]#t?:1?Smc {A|=*t0kid8O)1u4kYmO0F.lhD}`3-SufV');
define('LOGGED_IN_SALT',   'a,gYUDp2T}^eHR~dUIs,loBDdv>3PefD;UPWME0J^smE#`1|9Zk.$kOl,419M*~$');
define('NONCE_SALT',       '17Bz7M&N$9A(7bej~AuvEp3I-XL|Nl~~%uLNU<V|r+s?Bhwr3y2EqN795siK/f8u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'pg_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
define('CONCATENATE_SCRIPTS', false );
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
