<?php

namespace Faisal\Academy;

/**
 * Assets handlers class
 */
class Assets {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'academy-script' => [
                'src'     => FAISAL_ACADEMY_ASSETS . '/js/frontend.js',
                'version' => filemtime( FAISAL_ACADEMY_PATH . '/assets/js/frontend.js' ),
                'deps'    => [ 'jquery' ]
            ],
            'academy-enquiry-script' => [
                'src'     => FAISAL_ACADEMY_ASSETS . '/js/enquiry.js',
                'version' => filemtime( FAISAL_ACADEMY_PATH . '/assets/js/enquiry.js' ),
                'deps'    => [ 'jquery' ]
            ],
            'academy-admin-script' => [
                'src'     => FAISAL_ACADEMY_ASSETS . '/js/admin.js',
                'version' => filemtime( FAISAL_ACADEMY_PATH . '/assets/js/admin.js' ),
                'deps'    => [ 'jquery', 'wp-util' ]
            ],
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles() {
        return [
            'academy-style' => [
                'src'     => FAISAL_ACADEMY_ASSETS . '/css/frontend.css',
                'version' => filemtime( FAISAL_ACADEMY_PATH . '/assets/css/frontend.css' )
            ],
            'academy-admin-style' => [
                'src'     => FAISAL_ACADEMY_ASSETS . '/css/admin.css',
                'version' => filemtime( FAISAL_ACADEMY_PATH . '/assets/css/admin.css' )
            ],
            'academy-enquiry-style' => [
                'src'     => FAISAL_ACADEMY_ASSETS . '/css/enquiry.css',
                'version' => filemtime( FAISAL_ACADEMY_PATH . '/assets/css/enquiry.css' )
            ],
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }

        wp_localize_script( 'academy-enquiry-script', 'FaisalAcademy', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong', 'faisal-academy' ),
        ] );

        wp_localize_script( 'academy-admin-script', 'FaisalAcademy', [
            'nonce' => wp_create_nonce( 'faisal-admin-nonce' ),
            'confirm' => __( 'Are you sure?', 'faisal-academy' ),
            'error' => __( 'Something went wrong', 'faisal-academy' ),
        ] );
    }
}