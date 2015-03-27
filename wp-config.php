<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'digrammi_local');

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
define('AUTH_KEY',         '+[gT$-Z0kCbI5]{V(_fDy2eI+?SpD.v`s3aBZZZI i+n#tYpWE^bBkzGlR+dTIk%');
define('SECURE_AUTH_KEY',  'H!!R0S*v__-YgUCcN!31VT5w|ni-:Iqn-H-<eNSTub?i!>PrL+N|1IoU]g<.]4kW');
define('LOGGED_IN_KEY',    '!ap?8+[FukZGBU=EE38`=Sj ?kZ1F}tWO!}z_sQfJ1V9|zgy:/3z6Bvm1]]f7)mQ');
define('NONCE_KEY',        ')WcB7ikR #^;HM=d&VfJPM2Bdc|4xn?F-HCM:6TMc1RB;dtf7F+xFdDL>R5K?@)<');
define('AUTH_SALT',        '~2%lUv)qlT{;t64!0uZp4_N.%tJd(;_|Q{ZgpPGP2<|ZL7vD|5WOv4^LLKXl2212');
define('SECURE_AUTH_SALT', 's}lKZ/5GeQYl{bJY?v*A)uhY#rSz_`_L=x4-PI3[H!w&>O)2c]t2Gs}Hj*+`z^-Y');
define('LOGGED_IN_SALT',   'QL)$MKP OEB`?1[5f!|NMJ.x4 ;6@*:LM%m?%d9jv+d2gYDEjyh,Ic-rXRJiz^y9');
define('NONCE_SALT',       '[#)*@bAv{+1dJs*+(YO8UolLDyoD7-tvp5$?[W@21#tM$r|z|1KQ^ooEDX^g>AhZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dig_';

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
