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
define('DB_NAME', 'fortwo9_f2p_live');

/** MySQL database username */
define('DB_USER', 'fortwo9_master');

/** MySQL database password */
define('DB_PASSWORD', 'for2forfun');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://www.fortwoplease.com/date-ideas/');
define('WP_SITEURL','http://www.fortwoplease.com/date-ideas/');
define('BASE_URL', 'http://www.fortwoplease.com/date-ideas/');
define('DOMAIN_NAME', 'fortwoplease.com');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/I/5z+Dpcg|us$9NMuYZbMC1KIlR;cOz[*U_(?yv6y>zYq1CMKh6O<|]u;}6O##:');
define('SECURE_AUTH_KEY',  ')]LHz(=1+?VRcO9T]m.MIoq+ [Qm>TA3MZhn}93a)3kt|H:>pJ_Vs+)gQ?H--fdL');
define('LOGGED_IN_KEY',    'dyzLP+R eEMATHJwB20,5shOSdR{CctQokB+u7Dup0tE?Kuw&PMVuv>YC;y$I-~u');
define('NONCE_KEY',        'r9K&k=G3rs`-_041x W]ZjQmelrY==KR59GD+Z#UXr?[@~N7TucbIn?+T(/{-N`<');
define('AUTH_SALT',        'E:m&+/#<exXdLc|crTnLIO<nu^H4jz`4~/n]{zH#a>+C]3S%K/I n-+d?VV&1|x-');
define('SECURE_AUTH_SALT', 'lU;!kW,qK:xCSz#X#(slWm(r|~AY+T4S-JM8Kk Kmm>})[@$ON!g~~Lv*zYF`5Gc');
define('LOGGED_IN_SALT',   'P q`b1F07d2U0|E)jy4+@Kg3nLP|[a+y/j[ sFKOsD9UE|pN4yC|~kWY*T#>U|]]');
define('NONCE_SALT',       'Y*^X|?N{cjM!tj75I!.Y-fO72^d&Wy+|o1P<X/N;:GO!XM!q-RsD,>M7>PLP|j*+');
//define('WPHTTPS_RESET', true);

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
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
