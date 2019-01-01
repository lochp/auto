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
define('DB_NAME', 'auto');

/** MySQL database username */
define('DB_USER', 'locmysql');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'coUoLcF1$4H{al|p<wSI(]A,GgnFgla<LyjYq*HO!zv+_][/]tB`^YY6g pcG~^a');
define('SECURE_AUTH_KEY',  'NuQ6@oC[$}TBC&HZ7!#^&>iRr]u9wq>VNVpSf7L%o[8#m]n~j)7g(KGC808y{.A4');
define('LOGGED_IN_KEY',    'm16(*>&@m!%_sgRt1ZX,ii55x=1p+Lo:xY.vKYBc>79$>I7+,a:[j6;CwJ{efiWj');
define('NONCE_KEY',        '-$d{E!`U@*O*/R{Zw!ETsL}@P<A2=n0ySM[?n-]`4N.x0_;cP^|e0?*lquHUnl,y');
define('AUTH_SALT',        '!4SRopfEgq+u:pDzegC/13.o$%^uhVuG]7h/Br]3B!6;T4p<Mht-1FJ+q=csCv+,');
define('SECURE_AUTH_SALT', 'D|mn/f@u1nB/.%|y,g5njmU2-CZPM~5rzw kRkl2ZS7_,ToRr9 OQ3j+o#&UtW3E');
define('LOGGED_IN_SALT',   '<Av>WUKlVL8<Ofnp#M1}leEdBh)$,].9hP(EWIA[^#7%b9,y2nBKm=j;kt.k^nvx');
define('NONCE_SALT',       'N]bpk]K*+~|WEy5!GPE g8WOA?GN8.m2N0Yvp~jC%9nT;dTROA6.HuEbyk~d*-E{');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'auto_';

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
