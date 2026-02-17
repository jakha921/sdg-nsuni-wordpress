<?php
/**
 * WordPress Configuration for Docker
 */

ini_set('allow_url_fopen', 1);

// Helper function if not exists
if (!function_exists('getenv_docker')) {
    function getenv_docker($key, $default = '') {
        $val = getenv($key);
        return $val !== false ? $val : $default;
    }
}

// Database settings from Docker environment
define( 'DB_NAME',     getenv_docker('WORDPRESS_DB_NAME', 'wordpress_db') );
define( 'DB_USER',     getenv_docker('WORDPRESS_DB_USER', 'wordpress_user') );
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'KuchliParol123!') );
define( 'DB_HOST',     getenv_docker('WORDPRESS_DB_HOST', 'db:3306') );
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  '' );

// Authentication keys and salts
define( 'AUTH_KEY',         'sdg-local-dev-key-1' );
define( 'SECURE_AUTH_KEY',  'sdg-local-dev-key-2' );
define( 'LOGGED_IN_KEY',    'sdg-local-dev-key-3' );
define( 'NONCE_KEY',        'sdg-local-dev-key-4' );
define( 'AUTH_SALT',        'sdg-local-dev-salt-1' );
define( 'SECURE_AUTH_SALT', 'sdg-local-dev-salt-2' );
define( 'LOGGED_IN_SALT',   'sdg-local-dev-salt-3' );
define( 'NONCE_SALT',       'sdg-local-dev-salt-4' );

// Database table prefix
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

// Memory limits
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Debug mode (disable for production)
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Local development settings
define('WP_HOME', 'http://localhost:8080');
define('WP_SITEURL', 'http://localhost:8080');
define('FORCE_SSL_ADMIN', false);

// Allow file modifications for local dev
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', false);

/* That's all, stop editing! */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
