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

/**
 * Database connection information automatically provided by Pressable.
 * There is no need to set or change the following database configuration
 * values:
 *   DB_HOST
 *   DB_NAME
 *   DB_USER
 *   DB_PASSWORD
 *   DB_CHARSET
 *   DB_COLLATE
 */

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',             'm2m[?0<&9HcGCM%Dl:{wC{*@ZNqdw(t3R-^Sf3wiaz34t{*2<=fmj0gK(!.s|0%x');
define('SECURE_AUTH_KEY',      'V$xL:Qp[<iZ[3Ho?|DeHpQtjt7=1&mY1zTR2P~lBm[Co$9*5on|jSR1vh=p82)Rd');
define('LOGGED_IN_KEY',        'PO*EVRU4QZ=}v}??OHXmyIWww>fV1o~TcV-L#SFhe1pz9]cBwLZ6t-sOx)Ni=8<F');
define('NONCE_KEY',            'zFiIXWKh?k~6vb)}9&*L%Vbx))}3+V{m1*OiCXWx#}_Ce[w0WO:#>Vy7h)3Cl+[#');
define('AUTH_SALT',            'hZDQJn7qW]F}Sqa;)M%mfvN,q3wbW9>nC.oVusem+*TYq.o)Cyu(J~3{+L:5?J7T');
define('SECURE_AUTH_SALT',     'M?kY~X4([0#Z<vZ[FS$#Q=%o8R-}vr|]QKpwFft{EyX30FW@~HU+lqmgAyh^:(Ng');
define('LOGGED_IN_SALT',       'brmrbhAdBq&A~S9aXJ9dts8I^hPCLQ[u&JYiW3WOa@3=QBloU}W%Po[~up((H>P2');
define('NONCE_SALT',           'bqUYE@>|8{xz*bPBC[es04_4E5n*Mo{SL}fpt<9dA3#VdVOUTx{jcSJR0>2ALN#R');

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
define('WP_DEBUG', true); //false

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
