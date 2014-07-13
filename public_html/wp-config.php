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
define('DB_NAME', 'rosereads');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'X#~&`blO%wt@TmvC-PTG[w@kS?~sA-Owc9Rt*,eG#-ag5z<Ju/F&!=3[Jpa2.5+p');
define('SECURE_AUTH_KEY',  'A5yB^1I?I?$)JTLvB,26$wp.QqTeH?unW=SX~LhF(l-mHX)f6;1RjB|)-&AyS|-A');
define('LOGGED_IN_KEY',    'RB!ZWkIX2V{8JzKgk[_.>2>*aAM>TShJ(8mF(p,8phInbcM8Xh.8dzA/h17}Xr$s');
define('NONCE_KEY',        '*,|@g9+6c/ -(5MF[P~c>3wq|7E764s;]LC-ZI:Q8^2l6+ZvaU!9v105Cb?Svlx]');
define('AUTH_SALT',        '#@v(Px0N6Hsi?V8T#{%NZ+ltD7_O-dY#!JfnJ-ngG5y_REsiWdKca+-> SzLbT4t');
define('SECURE_AUTH_SALT', 'JPQ$y^aYM:@%|]Sic$(!(b)M2mh)vNrsQwc8fy)J wYg>]xKwo<D?-L3 )5-7QQD');
define('LOGGED_IN_SALT',   'BL0k[B))Io5CXg/0XuX/|nJx_@Q<{|yPWp-W2A7+$_-I%hxa)4mue!JK-2/w(et]');
define('NONCE_SALT',       'l7+RvL;+p%A$|0Mo]g%Y$(bZ-|Asz#O09oaOvP*hP_-~4 2<m@1L`|W.u<S}O*vh');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rr_';

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
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
