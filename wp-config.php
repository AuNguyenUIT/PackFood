<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
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
define('WP_CACHE', true /* Modified by NitroPack */ );

define( 'DB_NAME', 'nhpaco3u_wp_uotln' );
/** MySQL database */

/** MySQL database username */
define( 'DB_USER', 'nhpac_wp_cgfui' );

/** MySQL database password */
define( 'DB_PASSWORD', 'j3^3F1qsUfz*Rvjq' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'x7cRXV6N5hi]RhgOn@dh3Kn5!8~P(279)DxIO6@p(9J3_7Op)/Eui3tl7PByyR-_');
define('SECURE_AUTH_KEY', 'l7qca6Zi!R8mG[F35b6ZI@lK(aODG6!ML:G[@76[sJnR3S4O#U2@@ti*1H~(8YT@');
define('LOGGED_IN_KEY', 'gI]97mcF3RURZu4aZcN06H1JxsMJyMJ(ZG5z]B8*Y&3/sJ_&dUjB882W@HC6reNy');
define('NONCE_KEY', 'F4&01Kwh36O91rj6j1wc86+7nJ0sfu!t9qk+k03y#27&]**;6/B(VzNh5K93B;@o');
define('AUTH_SALT', '*93;caP/+&7L:@fw-%8L715#2T9uHR)cvM33m(YAw]F(jN!YU_cZC6p7nm|9bV+d');
define('SECURE_AUTH_SALT', '(Y9s2;q&3_p10z:m3/9wTaRt(s@q3HR7548H*R82]Nhvd5vD7PX:4T#DZ+c3O~2x');
define('LOGGED_IN_SALT', '68_rt%[@X#/_1EB&[ZRcB334NLCn0_+4k67y3P)O7Ub_zsUm7h]L!Q4K#WC!)%K)');
define('NONCE_SALT', '(4Gnr&19I7iSK7b#QU~2lW37N)Wb)6TJlC4yJ5jdjU*8|dq9aoT2lIzVu!:7zxl~');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '6nqefgr_';


define('WP_ALLOW_MULTISITE', true);
define( 'DISALLOW_FILE_EDIT', false);


define( 'CONCATENATE_SCRIPTS', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
