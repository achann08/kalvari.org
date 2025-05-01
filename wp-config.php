<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gerejakalvari_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'bJZ/E{}<g!.c[[,4X78<t^50H~DEf~y=ZXiMd1U!%9TSz4_#]Vb>rX+4kFjE>!qm' );
define( 'SECURE_AUTH_KEY',  '/(h1|V>|>b~1#pwd#s)?whGVrjgD@uSrp~aBXir/$Ws-H~}U2E_}f y_=7^4HPTe' );
define( 'LOGGED_IN_KEY',    'wTb3!QQd?}zJL4;nTI*&uVh|0n#OA1/nN:%$LYTvS^~F`a&_O:vxNWmT0kXe0hd:' );
define( 'NONCE_KEY',        'v?K_[ZXH/@0m:c<C yA^%c+qTF/4=p j=z57|9G]o~^alfuak1t EyI%PIgc)sn}' );
define( 'AUTH_SALT',        'NDWX7En3cPt%>lkts4;P7=BG]iGeZrnB0)PZ(>X45rWd+h!r&##gGe`=F5}:Et[~' );
define( 'SECURE_AUTH_SALT', 'tv|C~dYNLLFGR.l)Y*l!.YXc[4f0C^V4]]OB)>l5TY,gCs|4{GS6K%v9g/A?NXY}' );
define( 'LOGGED_IN_SALT',   ')zR4+)AFW;e_Li<e{?4gHlZ5uF+=[drUH]kDvI?*C@e^5v}d/sVDe}n4?x/lT?1q' );
define( 'NONCE_SALT',       'iY%a2J;EaJf!Wu<Li4rSS3DK`jbe}hJ|a)QEa|.54hh42t#$* 24sx}T{w}7>yqI' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = '8qt98u_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
