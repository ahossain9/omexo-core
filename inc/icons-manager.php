<?php
/**
 * omexer insight icon manager
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Inc;

defined( 'ABSPATH' ) || die();

class Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_omexer_insight_icons_tab' ] );
    }

    public static function add_omexer_insight_icons_tab( $tabs ) {
        $tabs['omexer-insight-icons'] = [
            'name' => 'omexer-insight-icons',
            'label' => __( 'Omexer Icons', 'omexer-insight-core' ),
            'url' => OMEXER_INSIGHT_ASSETS . 'css/omexer-insight-icons.css',
            'enqueue' => [ OMEXER_INSIGHT_ASSETS . 'css/omexer-insight-icons.css' ],
            'prefix' => 'icon-',
            'displayPrefix' => 'icon',
            'labelIcon' => 'icon icon-education',
            'ver' => OMEXER_INSIGHT_VERSION,
            'fetchJson' => OMEXER_INSIGHT_ASSETS . 'js/omexer-insight-icons.js',
            'native' => false,
        ];
        return $tabs;
    }
}

Icons_Manager::init();