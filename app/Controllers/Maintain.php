<?php
namespace App\Controllers;

use App\Models\Options;
use App\Controllers\BaseController;

class Maintain extends BaseController {
  public function index() {
		$optionsModel = new Options();
    $optionsData = $optionsModel
      ->whereIn('key', ['site_url', 'maintain_title', 'maintain_content', 'maintain_background'])
      ->find();
    $options = [];

    foreach ($optionsData as $value) {
      $options[$value['key']] = $value['value'];
    }

		return view('Maintain', $options);
  }
}
