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
define('DB_NAME', 'fortwo9_f2p');
/** MySQL database username */
define('DB_USER', 'fortwo9_admin');
/** MySQL database password */
define('DB_PASSWORD', 'for2fun2');
/** MySQL hostname */
define('DB_HOST', 'localhost');

define('WP_HOME','http://192.241.212.121/');
define('WP_SITEURL','http://192.241.212.121/');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
//define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
define('FS_METHOD', 'direct');
define('AUTH_KEY',         'bXc^S-eh8> /YrLx*yy+]vzCC-SNK<-mpEjWj#C|E[s-$Fkv60j*a~Q+CW_]C&t+');
define('SECURE_AUTH_KEY',  '|pAYv:?y=X1RA62GBFpRjpWsFT x1v1^L)8ulziC7M~)y%fje#!2(U2Bg+BY+)d-');
define('LOGGED_IN_KEY',    '6rL0r<j0_ji5v8EKW^+9gPz?q-X66T1)h>IdkW]wBatgWOn:w:E8*@M/M3=T/.5+');
define('NONCE_KEY',        '*P%ge`9p,@-25)vv(s87kTp+lT4Q5jMZqOlE5~/krnjQK)-BH,9#Zm0gBT~[flK|');
define('AUTH_SALT',        '2^:i?yQEH#H+R0ywXIl&!*.lS`5p6) xDkWnVQq(EeF4b%4i%C 7C@|@=#^ZsWXF');
define('SECURE_AUTH_SALT', 'hj<*sLdADOe,*/#q[x1[[Exx]RcIK^E~W1cbv+@YZ|.k16#8g*sJLkRO7^fkYzD4');
define('LOGGED_IN_SALT',   '-0fg:L}A+tI`74L[axZ<RRm|sqX`2|K]vI|{uf|_tjl;j5Qzj>15x{.*AZNJpYL&');
define('NONCE_SALT',       '`P[IAdHAz++|;<jgtk{_8=.).1&|n45Xn/L 3{eANC@1V*/{xPF}N>3Nl&y|[rWJ');
//define('DB_NAME', 'wordpress');
//define('DB_USER', 'wordpress');
//define('DB_PASSWORD', 'aofHHQcOYY');
//require_once(ABSPATH . 'wp-content/themes/posttypes.php')
require_once(ABSPATH . 'wp-settings.php');
