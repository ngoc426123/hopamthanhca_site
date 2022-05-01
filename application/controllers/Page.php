<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function chord () {
		$this->load->model(['model_options','model_cat']);
		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => "Hợp âm",
				"link" => base_url('danh-sach-hop-am'),
			],
		];
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
			"canonical" => base_url("danh-sach-hop-am"),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_chord";
		$this->load->view("layout", $data);
	}

	public function pdf () {
		$this->load->model(['model_options','model_song','model_cat']);
		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => "Sheet nhạc",
				"link" => base_url('sheet-nhac'),
			],
		];
		// PAGINATION
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$perpage = 20;
		$total = $this->model_song->count();
		$pagination = pagination($page, $perpage, $total, "sheet-nhac", "page");
		// DATA PAGE
		$page_start = ($page - 1) * $perpage;
		$data["data_page"] = [
			"listsong" => $this->model_song->getlist("pdf", $page_start, $perpage),
			"pagination" => $pagination,
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
			"canonical" => base_url("sheet-nhac"),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_pdf";
		$this->load->view("layout", $data);
	}

	public function song () {
		$this->load->model(['model_options','model_song','model_cat']);
		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => "Bài hát",
				"link" => base_url('bai-hat'),
			],
		];
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
			"canonical" => base_url("bai-hat"),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_songmore";
		$this->load->view("layout", $data);
	}

	public function about () {
		$this->load->model(['model_options','model_cat']);
		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => "Giới thiệu",
				"link" => base_url('gioi-thieu'),
			],
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => "Hợp âm thánh ca",
			"keywork" => "Giới thiệu về hợp âm thánh ca, về hợp âm thánh ca, hợp âm thánh ca có sheet.",
			"desc" => "Website hợp âm dành riêng cho nhạc thánh ca hiện nay",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => base_url("gioi-thieu"),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_about";
		$this->load->view("layout", $data);
	}
}