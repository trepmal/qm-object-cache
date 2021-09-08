<?php
/**
 * Output class
 *
 * Class QM_Output_ObjectCache
 */
class QM_Output_ObjectCache extends QM_Output_Html {

	public function __construct( QM_Collector $collector ) {
		parent::__construct( $collector );

		// add_filter( 'qm/output/title', array( $this, 'admin_title' ), 101 );
		add_filter( 'qm/output/menu_class', array( $this, 'admin_class' ) );
		add_filter( 'qm/output/menus', array( $this, 'admin_menu' ), 101 );
	}

	/**
	 * Outputs data in the footer
	 */
	public function output() {
		// $data = $this->collector->get_data();
		global $wp_object_cache;
		?>
		<?php
			echo "<div id='object-cache-stats'>";
			$wp_object_cache->stats();
			echo "</div>";
		?>
		</div>
		<?php
	}

	/**
	 * Adds data to top admin bar
	 *
	 * @param array $title
	 *
	 * @return array
	 */
	public function admin_title( array $title ) {

		return $title;
	}

	/**
	 * @param array $class
	 *
	 * @return array
	 */
	public function admin_class( array $class ) {
		$class[] = 'qm-objectcache';
		return $class;
	}

	public function admin_menu( array $menu ) {

		// $data = $this->collector->get_data();

		$menu[] = $this->menu( array(
			'id'    => 'qm-objectcache',
			'href'  => '#qm-objectcache',
			'title' => __( 'Object Cache', 'query-monitor' ),
		));

		return $menu;
	}
}