<?php
/**
 * Notebook content model
 *
 * @file
 * @ingroup Extensions
 * @ingroup NotebookViewer
 *
 * @author Ori Livneh <ori@wikimedia.org>
 * @author Yuvi Panda <yuvipanda@riseup.net>
 */

use Symfony\Component\Process\Process;

/**
 * Represents the configuration of a Jupyter Notebook
 */
class NotebookContent extends TextContent {

	function __construct( $text ) {
		parent::__construct( $text, 'Notebook' );
	}

	protected function renderNotebook( $content ) {
		$retval = null;
		$process = new Process( [ __DIR__ . "/convertor.py" ] );
		$process->setInput( $content );

		$process->run();
		if ( $process->isSuccessful() ) {
			return $process->getOutput();
		} else {
			return "Parsing error";
		}
	}

	protected function fillParserOutput( Title $title, $revId,
		ParserOptions $options, $generateHtml, ParserOutput &$output
	) {
		// FIXME: WikiPage::doEditContent generates parser output before validation.
		// As such, native data may be invalid (though output is discarded later in that case).
		if ( $generateHtml && $this->isValid() ) {
			$output->setText( $this->renderNotebook( $this->getText() ) );
		} else {
			$output->setText( 'error' );
		}
	}
}
