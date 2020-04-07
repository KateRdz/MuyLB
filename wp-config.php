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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', '98929428c1feb041fa2af76e8e9ec2718e6d0782dba7fb64' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '#@wh4ujAiR<z}/lMpNk:kycYPKPAq@P*!|Cm4}Xh.nTJTGh[dz;&O~SCvlNAT/X9' );
define( 'SECURE_AUTH_KEY',  'kv8tCFKs1b-@pR}!BBx*&Jr<Ou%?OJ/&.(zvPjp1Bny[}XZmb/x[<8y+%,Pq[cKo' );
define( 'LOGGED_IN_KEY',    'U7sfl}#! WM#qsi~NMrU=}F)gq.o-D@:zG^4eTGqG@3g9Ux/S#HO74U9oBMnN?OI' );
define( 'NONCE_KEY',        'B54/2/}lJ@([`G9z{_,t7_Fs>x(6//b%i8:wmygoXk!yOaC)9S>|v#%/us!g#r{|' );
define( 'AUTH_SALT',        'OOPc:7xcK1Jq3%A9xRayYj}R>1IIlh3i(KBbmn76yCA[L]x7N*LAz].SG:h%?+~=' );
define( 'SECURE_AUTH_SALT', '=+c.`S*S~|f<(VY7cBwW`?RBk%7;DrY-w2e)?A8&[y<d:E;*2)$6hSPs5UIJ[<1t' );
define( 'LOGGED_IN_SALT',   '!E7Ng6q^EiMz0#KoK^NAx/rWU(>R%{d=]u8I^9ZghpQ8{j,y1+c~WzQG;[2CNY5c' );
define( 'NONCE_SALT',       'KsxUf;W#KXOigr^3||S`|~++aE[,vGXr_9kGK2W/FY#)eWJ!sY:-5!KW N&&I^qb' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
