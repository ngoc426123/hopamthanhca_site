<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index () {
		$this->load->model(['model_options', 'model_cat', 'model_song']);
		// DATA PAGE
		$data["data_page"] = [
			"newsong" => $this->model_song->getlist("new", 0, 10),
			"mostview" => $this->model_song->getlist("mostview", 0, 10),
			"mostweek" => $this->model_song->getlist("mostweek", 0, 10),
			"mostmonth" => $this->model_song->getlist("mostmonth", 0, 10),
			"mostlove" => $this->model_song->getlist("mostlove", 0, 10),
			"nextsong" => $this->model_song->getlist("new", 10, 10),
			"tacgia" => $this->model_cat->getlist("tac-gia", 0, 27),
			"chuyenmuc" => $this->model_cat->getlist("chuyen-muc", 0, 23),
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => "Trang chủ - ".$this->model_options->get('title')." - Thư viện thánh ca hợp âm lớn nhất.",
			"keywork" => $this->model_options->get('keywork'),
			"desc" => $this->model_options->get('desc'),
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_home";
		$this->load->view("layout", $data);
	}

	public function searchAPI() {
		$this->load->model(['model_song']);
		echo json_encode($this->model_song->getlistAPI(), JSON_UNESCAPED_UNICODE);
	}

	public function loadmore() {
		$data = json_decode(file_get_contents('php://input'),true);
		$offset = $data["offset"];
		$limit = $data["limit"];
		$this->load->model(['model_song']);
		$data = $this->model_song->getlist("new", $offset, $limit);
		$ret["data"] = $data;
		$ret["total"] = count($data);
		$ret["more"] = (count($data) >= $limit) ? true : false;
		echo json_encode($ret, JSON_UNESCAPED_UNICODE);
	}
}