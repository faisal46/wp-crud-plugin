<?php
/**
 * Plugin Name: Faisal Academy
 * Description: A plugin are form crud ( insert, edit and delete ) show the wp list table.
 * Plugin URI: https://www.faisal.rajtechbd.com/
 * Author: Md. Faisal Amir Mostafa
 * Author URI: https://www.faisal.rajtechbd.com/
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: faisal-academy
 * Domain Path: /langusges/
 */


if( ! defined( 'ABSPATH' ) ){
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Faisal_Academy{

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class construcotr
     */
    function __construct(){
      $this->define_constants();

      register_activation_hook( __FILE__, [ $this, 'activate' ] );

      add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );

    }

    /**
     * Initializes a singleton instance
     *
     * @return \Faisal_Academy
     */
    public static function init(){
        $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'FAISAL_ACADEMY_VERSION', self::version );
        define( 'FAISAL_ACADEMY_FILE', __FILE__ );
        define( 'FAISAL_ACADEMY_PATH', __DIR__ );
        define( 'FAISAL_ACADEMY_URL', plugins_url( '', FAISAL_ACADEMY_FILE ) );
        define( 'FAISAL_ACADEMY_ASSETS', FAISAL_ACADEMY_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        if ( is_admin() ) {
            new Faisal\Academy\Admin();
        } else {
            new Faisal\Academy\Frontend();
        }

    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new Faisal\Academy\Installer();
        $installer->run();
    }

    
}

/**
 * Initializes the main plugin
 *
 * @return \Faisal_Academy
 */
function faisal_academy() {
    return Faisal_Academy::init();
}

// kick-off the plugin
faisal_academy();