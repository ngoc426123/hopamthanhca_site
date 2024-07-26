<?php
namespace App\Libraries;

class SongHandle {
  private $song;

  public function __construct($song) {
    $this->song = $song;
  }

  public function convertChordsSystax() {
    $partten = "/(\[\w+(|\#)(|\w+)(|\/\w+)\])/";
		$parttenChord = "/\[|\]/";

		$this->song = preg_replace_callback($partten, function ($chord) use($partten, $parttenChord) {
			return preg_replace_callback($partten, function ($text) use($parttenChord) {
				$chord = preg_replace($parttenChord, '', $text[0]);
				$chord = ucfirst($chord);
				return "<span class='chordsOC'>
					<span class='chordsPer'>[</span>
					<span class='chords'>{$chord}</span>
					<span class='chordsPer'>]</span>
				</span>";
			}, $chord[0]);
		}, $this->song);

    return $this;
  }

  public function removeChords() {
    $partten = "/(\[\w+(|\#)(|\w+)(|\/\w+)\])/";

    $this->song = preg_replace($partten, '', $this->song);

    return $this;
  }

  public function removeUnderscore() {
    $partten = "/(\_{1,2})/";

    $this->song = preg_replace($partten, '', $this->song);

    return $this;
  }

  public function getSong() {
    return $this->song;
  }
}
?>