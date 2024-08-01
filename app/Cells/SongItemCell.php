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
		$this->dateFormat = date_format(date_create($this->date), 'd/m/Y H:i:s');
	}

	public function getDateFormatProperty() {
		return $this->dateFormat;
	}
}
