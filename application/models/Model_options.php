<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_options extends CI_Model {
	public function get($key) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("options");
		$this->db->where([
			"key" => $key,
		]);
		$get = $this->db->get();
		return $get->row_array()["value"];
    }
}