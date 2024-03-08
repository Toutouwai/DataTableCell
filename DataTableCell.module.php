<?php namespace ProcessWire;

class DataTableCell extends WireData implements Module {

	/**
	 * Ready
	 */
	public function ready() {
		$this->addHookAfter('MarkupAdminDataTable::render', $this, 'afterRender');
	}

	/**
	 * After MarkupAdminDataTable::render
	 *
	 * @param HookEvent $event
	 */
	protected function afterRender(HookEvent $event) {
		require_once __DIR__ . '/simple_html_dom_rps.php';

		$html = str_get_html($event->return);
		$headers = [];

		// Table headers
		foreach($html->find('thead th') as $th) {
			// Get header sanitized as a page name
			$header = $th->find('text', 0)->innertext;
			$header_san = $this->wire()->sanitizer->pageNameTranslate($header);
			// Set as data-dtc attribute
			$th->setAttribute('data-dtc', $header);
			// Save to headers array
			$headers[] = $header_san;
		}

		// Table body rows
		foreach($html->find('tbody tr') as $tr) {
			// Add data-dtc attribute derived from column header
			foreach($tr->find('td') as $index => $td) {
				if(!isset($headers[$index])) continue;
				$td->setAttribute('data-dtc', $headers[$index]);
			}
		}

		$event->return = (string) $html;
	}

}
