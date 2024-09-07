<?php
namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
class SongItemCell extends Cell {
  public $title;
	public $author;
	public $excerpt;
	public $date = '';
	public $chords;
	public $pdf;
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
