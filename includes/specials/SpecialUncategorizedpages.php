<?php
/**
 * @file
 * @ingroup SpecialPage
 */

/**
 * A special page looking for page without any category.
 * @ingroup SpecialPage
 */
// FIXME: Make $requestedNamespace selectable, unify all subclasses into one
class UncategorizedPagesPage extends PageQueryPage {
	var $requestedNamespace = false;

	function __construct() {
		SpecialPage::__construct( 'Uncategorizedpages' );
	}

	function sortDescending() {
		return false;
	}

	// inexpensive?
	function isExpensive() {
		return true;
	}
	function isSyndicated() { return false; }

	function getQueryInfo() {
		return array (
			'tables' => array ( 'page', 'categorylinks' ),
			'fields' => array ( 'page_namespace AS namespace',
					'page_title AS title',
					'page_title AS value' ),
			// default for page_namespace is all content namespaces (if requestedNamespace is false)
			// otherwise, page_namespace is requestedNamespace
			'conds' => array ( 'cl_from IS NULL',
					'page_namespace' => ( $this->requestedNamespace!==false ? $this->requestedNamespace : MWNamespace::getContentNamespaces() ),
					'page_is_redirect' => 0 ),
			'join_conds' => array ( 'categorylinks' => array (
					'LEFT JOIN', 'cl_from = page_id' ) )
		);
	}
	
	function getOrderFields() {
		// For some crazy reason ordering by a constant
		// causes a filesort
		if( $this->requestedNamespace === false && count( MWNamespace::getContentNamespaces() ) > 1 )
			return array( 'page_namespace', 'page_title' );
		return array( 'page_title' );
	}
}
