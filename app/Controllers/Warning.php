<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Warning extends BaseController {
	public function index(){
		$data = ['pageinit' => $this->siteInit];

		return view('Warning', $data);
	}
}
