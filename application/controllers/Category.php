<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function cating ($type) {
		$this->load->model(['model_options', 'model_cat']);
		$info_type = $this->model_cat->gettype($type);
		// PAGINATION
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$perpage = 20;
		$page_start = ($page - 1) * $perpage;
		$total = $this->model_cat->count($info_type["type_slug"]);
		$pagination = pagination($page, $perpage, $total, $info_type["type_slug"], "page");
		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => mb_ucfirst($info_type["type_name"]),
				"link" => base_url($info_type["type_slug"]),
			],
		];
		// DATA PAGE
		$data["data_page"] = [
			"page_title" => $info_type["type_name"],
			"page_desc" => $info_type["desc"],
			"listcat" => ($type == "bang-chu-cai") ? $this->model_cat->getlist($type) : $this->model_cat->getlist($type, $page_start, $perpage),
			"pagination" => $pagination,
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => "Bài hát theo {$info_type["type_name"]} - Hợp âm thánh ca",
			"keywork" => "Bài hát theo {$info_type["type_name"]} - Hợp âm thánh ca, kho lưu trữ thư viện âm nhạc có hợp âm lớn nhất Việt Nam.",
			"desc" => "Bài hát theo {$info_type["type_name"]} - Hợp âm thánh ca, kho lưu trữ thư viện âm nhạc có hợp âm lớn nhất Việt Nam.",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => base_url($info_type["type_slug"]),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = ($type == "bang-chu-cai") ? "view_category_alphabet" : "view_category";
		$this->load->view("layout", $data);
	}

	public function catingdetail($type, $cat) {
		$this->load->model(['model_options', 'model_cat', 'model_song']);
		$infocat = $this->model_cat->get($cat);
		// PAGINATION
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$perpage = 10;
		$total = $this->model_cat->countcat($infocat["id"]);
		$page_start = ($page - 1) * $perpage;
		$pagination = pagination($page, $perpage, $total, $infocat["type_slug"]."/".$infocat["cat_slug"], "page");
		// BREADCRUMB
		$data["breadcrumb"] = [
			[
				"title" => "Trang chủ",
				"link" => base_url(),
			],
			[
				"title" => mb_ucfirst($infocat["type_name"]),
				"link" => base_url($infocat["type_slug"]),
			],
			[
				"title" => mb_ucfirst($infocat["cat_name"]),
				"link" => base_url($infocat["type_slug"]."/".$infocat["cat_slug"]),
			],
		];
		// DATA PAGE
		$data["data_page"] = [
			"page_title" => $infocat["cat_name"],
			"page_desc" => $infocat["desc"],
			"listcat" => $this->model_cat->getlist($type),
			"listsong" => $this->model_song->getlistoncat($infocat["id"], $page_start, $perpage),
			"songrandom" => $this->model_song->getsongrandom(),
			"pagination" => $pagination,
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => $infocat["meta"]["seotitle"],
			"keywork" => $infocat["meta"]["seokeywork"],
			"desc" => isset($infocat["meta"]["seodes"]) ? $infocat["meta"]["seodes"] : "",
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => base_url($infocat["type_slug"]."/".$infocat["cat_slug"]),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_listsong";
		$this->load->view("layout", $data);
	}
}