<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web
 host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this
 file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'devproofpoint');

/** MySQL database username */
define('DB_USER', 'devproofpoint');

/** MySQL database password */
define('DB_PASSWORD', 'proofpoint_wp2014!');

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
 * You can generate these using the {@link
 https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key
 service}
 * You can change these at any point in time to invalidate all existing
 cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',
'0~6mF,+5s1{ZtISvt1tk5#$+bFS1yo%%}A?Ub:C`Ms;,]pZy]aOPHI3xVwE3rsU ');
define('SECURE_AUTH_KEY',
'C[Sn7ceXHB/{,%t=N_h?N-uBr@k}d^TS16~KyC*@(AOX~N7te3YH3fs!5lY|g5kg');
define('LOGGED_IN_KEY',    'z0V+Sk^p*kz47.`lZnzO5155O&`aAeg9Csb@@UBfy:
)JE:~R;g/!rn5 JEa=bFo');
define('NONCE_KEY',
'>an_tkCPOi-A:gkS$=gb%C9Ni3N6I73&P_;f`IdZ~#WJ^9l=Ep45/p#2/,6P .@t');
define('AUTH_SALT',        'B(7<8S+zK?bn/u&a<bm`@:Z_K}*u]0r7?
_/7H*pqaoN73&=oMHdOmuxe4Q$+6PV');
define('SECURE_AUTH_SALT', 'xr8-i:{SX+Umuv/`zRHzaA+HxnQ:LD5c5>DR6
J$nv60PoZdO)BQLlcFwrxT8mG5');
define('LOGGED_IN_SALT',   '{-/J9X`Ze
Z+iXwNdP<jkBTgFbi6[HF5bo;Z9!*k<*:=q$i;.+R UM.DUas[r`[c');
define('NONCE_SALT',       'R!?|5TkHk|C~syr
HFtCI#VPrn|9!y{l;zTd|Rl}`km/*)[ROUx!M4Y%*3)W[J2|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a
 unique
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
 * Allow dynamic site url. this will override the database entries
 */
define('WP_HOME', 'http://'.$_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://'.$_SERVER['HTTP_HOST']);

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
