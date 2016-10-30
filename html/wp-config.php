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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '159.203.116.79');

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
define('AUTH_KEY',         'jfrrhw^-~DN(T?RZZ{Ka{9})s&X+Xn?@=/++-11o!u6 gz&0i&Zbh7.)|?{H>Jct');
define('SECURE_AUTH_KEY',  'PlIEID$DjH2^>^{V*$nM.mM++ 3^gE}MRA>$(SrcH8Om<3Ih> sZV.|h16Pbh<]$');
define('LOGGED_IN_KEY',    'g$T287h#2E-$:  }?d*G|*`t=2nJ[/_i0D$|B)IeNY%r_hr_j)n|dw}1>zv$67Y.');
define('NONCE_KEY',        '0#oA)@?gZi3zL*U,}Ci*/P%,$0&pjU(=faj5}{ON;8JTrnpXT)_90H#7D!46>+wH');
define('AUTH_SALT',        '-t P8`kL_uRd65X2uCfVag;RS._/KXY )s@d +Eq)JanXAZn{;~h5<E1365y!^mn');
define('SECURE_AUTH_SALT', '[x~5kRlE!B7<f8bm*]t.q)tr){>[7nRh:+jG:m G9T.rk=Ty&lYE6.3;@OhWY,L,');
define('LOGGED_IN_SALT',   'F1Zxow`w>fN mrH`pw3M.]U~0LVfugZs{%?Z}yY9IWc1~_r/${&V)z r]lDA}ZXE');
define('NONCE_SALT',       'UY(sib~*kPYjs.Y(K#u_hK(Jj!3D6_P3C,QJXLFoS~;` {FD>_m<[k`sZDx({{6o');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
