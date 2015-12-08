<?php
/**
 * Notebook Content Handler
 *
 * @file
 * @ingroup Extensions
 * @ingroup NotebookHandler
 *
 * @author Ori Livneh <ori@wikimedia.org>
 * @author Yuvi Panda <yuvipanda@gmail.com>
 */

class NotebookContentHandler extends TextContentHandler {

	public function __construct( $modelId = 'Notebook' ) {
		parent::__construct( $modelId );
	}

	public function canBeUsedOn( Title $title ) {
		return $title->inNamespace( NS_NOTEBOOK );
	}

	protected function getContentClass() {
		return 'NotebookContent';
	}
}
