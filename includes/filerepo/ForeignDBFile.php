<?php

class ForeignDBFile extends LocalFile {
	function newFromTitle( $title, $repo ) {
		return new self( $title, $repo );
	}

	function getCacheKey() {
		if ( $this->repo->hasSharedCache ) {
			$hashedName = md5($this->name);
			return wfForeignMemcKey( $this->repo->dbName, $this->repo->tablePrefix, 
				'file', $hashedName );
		} else {
			return false;
		}
	}

	function publish( /*...*/ ) {
		$this->readOnlyError();
	}

	function recordUpload( /*...*/ ) {
		$this->readOnlyError();
	}
	function restore(  /*...*/  ) {
		$this->readOnlyError();
	}

	/*
	function nextHistoryLine() {
		return false;
	}*/
}
?>
