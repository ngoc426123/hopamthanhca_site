<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index () {
		$this->load->model(['model_options','model_cat', 'model_song']);
		// META PAGE
		$data["page_meta"] = [
			"title" => "Tìm kiếm - công cụ tìm kiếm thánh ca có hợp âm.",
			"keywork" => "Danh sách bài hát thánh ca, bài hát thánh ca guitar, bài hát thánh ca thường dùng, bài hát thánh ca cơ bản.",
			"desc" => "Danh sách bài hát thánh ca - Tổng hợp bài hát thánh ca thường dùng, dễ sử dụng, được nhiều người sử dụng, dành cho những bạn nào đam mê thánh ca.",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => base_url('tim-kiem'),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["data_page"] = [
			"keywork" => $_GET["query"],
			"listsong" => $this->model_song->getlistsearch($_GET["query"]),
		];
		$data["page_view"] = "view_search";
		$this->load->view("layout", $data);
	}
}