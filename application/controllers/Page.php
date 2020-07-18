<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function chord () {
		$this->load->model(['model_options','model_cat']);
		// META PAGE
		$data["page_meta"] = [
			"title" => "Danh sách hợp âm - Tổng hợp hợp âm thường dùng, dễ sử dụng",
			"keywork" => "Danh sách hợp âm, hợp âm guitar, hợp âm thường dùng, hợp âm cơ bản.",
			"desc" => "Danh sách hợp âm - Tổng hợp hợp âm thường dùng, dễ sử dụng, được nhiều người sử dụng, dành cho những bạn nào đam mê thánh ca.",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_chord";
		$this->load->view("layout", $data);
	}

	public function pdf () {
		$this->load->model(['model_options','model_song','model_cat']);
		// PAGINATION
		isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
		$number_on_page = 30;
		$page_start = ($page - 1) * $number_on_page;
		$count_on_page = $this->model_song->count();
		$number_pagination = ceil($count_on_page / $number_on_page);
		for ($i=1; $i <= $number_pagination ; $i++) {
			$active = ($i == $page)?1:0;
			$arr_pagination[] = [
				"number" => $i,
				"link" => base_url("sheet-nhac?page={$i}"),
				"active" => $active,
			];
		}
		// DATA PAGE
		$data["data_page"] = [
			"listsong" => $this->model_song->getlist("pdf", $page_start, $number_on_page),
			"pagination" => isset($arr_pagination) ? $arr_pagination : [],
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => "Sheet nhạc - file pdf nhạc thánh ca.",
			"keywork" => "Danh sách sheet nhạc, sheet nhạc thánh ca, file in bài hát, file download sheet nhạc.",
			"desc" => "Danh sách sheet nhạc - Tổng hợp bài hát có sheet nhạc, dễ tra cứu, truy cập, in bài hát.",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_pdf";
		$this->load->view("layout", $data);
	}

	public function song () {
		$this->load->model(['model_options','model_song','model_cat']);
		// DATA PAGE
		$data["data_page"] = [
			"listsong" => $this->model_song->getlist("new", 0, 16),
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => "Danh sách bài hát - tổng hợp bài hát.",
			"keywork" => "Danh sách bài hát, tổng hợp nhạc thánh ca, nhạc thánh ca, bài hát thánh ca",
			"desc" => "Danh sách bài hát - Tổng hợp nhạc thánh ca, dễ tra cứu, truy cập.",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_songmore";
		$this->load->view("layout", $data);
	}
}