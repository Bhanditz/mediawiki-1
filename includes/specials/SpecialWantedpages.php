<?php
/**
 * @file
 * @ingroup SpecialPage
 */

/**
 * implements Special:Wantedpages
 * @ingroup SpecialPage
 */
class WantedPagesPage extends WantedQueryPage {
	var $nlinks;

	function __construct() {
		SpecialPage::__construct( 'Wantedpages' );
	}
		
	function execute( $par ) {
		$inc = $this->including();

		if ( $inc ) {
			@list( $limit, $nlinks ) = explode( '/', $par, 2 );
			$this->limit = (int)$limit;
			// FIXME: nlinks is ignored
			$nlinks = $nlinks === 'nlinks';
			$this->offset = 0;
		} else {
			$nlinks = true;
		}
		$this->setListOutput( $inc );
		$this->shownavigation = !$inc;
		parent::execute( $par );
	}

	function getSQL() {
		global $wgWantedPagesThreshold;
		$count = $wgWantedPagesThreshold - 1;
		$dbr = wfGetDB( DB_SLAVE );
		$pagelinks = $dbr->tableName( 'pagelinks' );
		$page      = $dbr->tableName( 'page' );
		$sql = "SELECT 'Wantedpages' AS type,
			        pl_namespace AS namespace,
			        pl_title AS title,
			        COUNT(*) AS value
			 FROM $pagelinks
			 LEFT JOIN $page AS pg1
			 ON pl_namespace = pg1.page_namespace AND pl_title = pg1.page_title
			 LEFT JOIN $page AS pg2
			 ON pl_from = pg2.page_id
			 WHERE pg1.page_namespace IS NULL
			 AND pl_namespace NOT IN ( 2, 3 )
			 AND pg2.page_namespace != 8
			 GROUP BY pl_namespace, pl_title
			 HAVING COUNT(*) > $count";

		wfRunHooks( 'WantedPages::getSQL', array( &$this, &$sql ) );
		return $sql;
	}

	function getQueryInfo() {
		global $wgWantedPagesThreshold;
		$count = $wgWantedPagesThreshold - 1;
		$query = array (
			'tables' => array ( 'pagelinks', 'page AS pg1',
					'page AS pg2' ),
			'fields' => array ( 'pl_namespace AS namespace',
					'pl_title AS title',
					'COUNT(*) AS value' ),
			'conds' => array ( 'pg1.page_namespace IS NULL',
					"pl_namespace NOT IN ( '" . NS_USER .
						"', '" . NS_USER_TALK . "' )",
					"pg2.page_namespace != '" .
						NS_MEDIAWIKI . "'" ),
			'options' => array ( 'HAVING' => "COUNT(*) > $count",
				'GROUP BY' => 'pl_namespace, pl_title' ),
			'join_conds' => array ( 'page AS pg1' => array (
					'LEFT JOIN', array (
					'pg1.page_namespace = pl_namespace',
					'pg1.page_title = pl_title' ) ),
				'page AS pg2' => array ( 'LEFT JOIN',
					'pg2.page_id = pl_from' ) )
		);
		// TODO: find and migrate WantedPages::getSQL hook usage
		wfRunHooks( 'WantedPages::getQueryInfo',
				array( &$this, &$query ) );
		return $query;
	} 	
}
