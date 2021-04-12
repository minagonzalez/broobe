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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'broobe' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9_MnME{:G&P70ywx<0V.m:by~SqAm3O5tUyM<YF0Q_,XQ|KP9^2vxUO?8IREKe;:' );
define( 'SECURE_AUTH_KEY',  '@L,];J{{-,H||HX(3D9%^M8{ZY3ClU8!x4A;56qnX&K-Z%a03;JS)gMeEl;If0m.' );
define( 'LOGGED_IN_KEY',    'yR%Hnzo:0P!%)cq>gt+{JX^LZ1R5E@SagE^mqP6#i~{3K oP^A9rFm~o_->55-+X' );
define( 'NONCE_KEY',        '018q11T5KQ7#e8&eN`PaUA~^g07#5/Qsq~4Q9wDR,2v-p=$lsq0Nv,M. /-0N+Bc' );
define( 'AUTH_SALT',        ',Jm@08:gY,LN3h{mT^=IJ3nT>[ +)X{(<PF&c;iMh|U6Eq5*27kCmPuhp5=plDEx' );
define( 'SECURE_AUTH_SALT', 'qAE:*MbzcjTm9>~LIf0Uy5>0Sjw4m/8mU%kCwi FWMfM.UR1%VFg/>rXavdvpr5N' );
define( 'LOGGED_IN_SALT',   'I>rYiIU1FG:l,l2+a55ZRR}Ux}-{cJO=AM]{Mr0WLr]2JNoOzgk]auBoKn;GDgvk' );
define( 'NONCE_SALT',       'y[m2m|_X,^]X+]A<W_GsCQ{~5,jAVK_kI@?j^^nma]8EA<*t*T?4_@=@t}/L-0X*' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
