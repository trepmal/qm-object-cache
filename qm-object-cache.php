<?php
/**
 * Plugin Name: Query Monitor: Object Cache
 * Description:
 * Version: 0.1
 * Author: trepmal
 */

add_action('plugins_loaded', function() {
	add_action( 'wp_enqueue_scripts', 'qm_object_cache_assets' );
	add_action( 'admin_enqueue_scripts', 'qm_object_cache_assets' );
	/**
	 * Register collector, only if Query Monitor is enabled.
	 */
	if( class_exists('QM_Collectors') ) {
		include 'class-qm-collector-object-cache.php';

		QM_Collectors::add( new QM_Collector_ObjectCache() );
	}

	/**
	 * Register output. The filter won't run if Query Monitor is not
	 * installed so we don't have to explicity check for it.
	 */
	add_filter( 'qm/outputter/html', function(array $output, QM_Collectors $collectors) {
		include 'class-qm-output-object-cache.php';
		if ( $collector = QM_Collectors::get( 'object_cache' ) ) {
			$output['object_cache'] = new QM_Output_ObjectCache( $collector );
		}
		return $output;
	}, 101, 2 );
});

function qm_object_cache_assets() {
	wp_enqueue_style( 'qm-objectcache-style', plugin_dir_url( __FILE__ ) . 'css/style.css', null, '0.1' );
}