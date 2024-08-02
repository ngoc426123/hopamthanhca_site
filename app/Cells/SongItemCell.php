<?php
namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
class SongItemCell extends Cell {
  public $title;
	public $author;
	public $excerpt;
	public $date;
	public $chords;
	public $pdf;
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
