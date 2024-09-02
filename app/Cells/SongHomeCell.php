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
	public $datetimeformat;

	private $dateFormat;

	public function mount() {
		$this->dateFormat = date_format(date_create($this->date), $this->datetimeformat);
	}

	public function getDateFormatProperty() {
		return $this->dateFormat;
	}
}
