<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weekly extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

  public function index () {
		$this->load->model(['model_options', 'model_weekly']);

    // DATA
    $data["data"] = [
      "le-rieng-dac-biet" => $this->model_weekly->getlistoncat(312),
      "nam-phung-vu-a" => $this->model_weekly->getlistoncat(313),
      "nam-phung-vu-b" => $this->model_weekly->getlistoncat(314),
      "nam-phung-vu-c" => $this->model_weekly->getlistoncat(315),
    ];

		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => "Thánh ca hàng tuần",
				"link" => base_url('thanh-ca-hang-tuan'),
			],
		];

		// META PAGE
		$data["page_meta"] = [
			"title" => "Thánh ca hằng tuần - Hợp âm Thánh Ca",
			"keywork" => "Soạn bài hát thánh ca hàng tuần theo từng chủ đề, từng tuần phụng vụ, quanh năm A, B, C, các lễ đặc biệt.",
			"desc" => "Thư viện hợp âm thánh ca lớn nhất hiện nay, soạn bài hát thánh ca theo từng chủ đề, từng tuần, qunh năm phụng vụ với các bài hát được Imprimatur (Bài hát được dùng trong phụng vụ)",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => base_url("thanh-ca-hang-tuan"),
		];

		$data["page_view"] = "view_holysongsweekly";
		$this->load->view("layout", $data);
	}

  public function detail ($slug) {
    $this->load->model(['model_song', 'model_cat', 'model_options', 'model_weekly']);

    // DATA
    $data["weekly"] = $this->model_weekly->get($slug);
    $data["list_song"] = $this->model_song->getlistAPI();
    $data["phan_hat"] = $this->model_cat->getlist("phan-hat");

		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => "Thánh ca hàng tuần",
				"link" => base_url('thanh-ca-hang-tuan'),
			],
			[
				"title" => $data["weekly"]["name"],
				"link" => base_url('thanh-ca-hang-tuan'),
			],
		];

		// META PAGE
		$data["page_meta"] = [
			"title" => "{$data["weekly"]["name"]} - Thánh ca hằng tuần - Hợp âm Thánh Ca",
			"keywork" => $data["weekly"]["meta"]["seokeywork"],
			"desc" => $data["weekly"]["meta"]["seodes"],
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => base_url("thanh-ca-hang-tuan"),
		];

		$data["page_view"] = "view_holysongsweekly_detail";
		$this->load->view("layout", $data);
  }
}