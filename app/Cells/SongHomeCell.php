<?php
namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class SongHomeCell extends Cell {
	public $title;
	public $date;
	public $author;
	public $viewer;
	public $lover;
	public $content;
	public $permalink;

	private $dateFormat;

	public function mount() {
		$session = service('session');
		$this->dateFormat = date_format(date_create($this->date), $session->get('datetimeformat'));
	}

	public function getDateFormatProperty() {
		return $this->dateFormat;
	}
}
