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
		isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
		$number_on_page = 20;
		$page_start = ($page - 1) * $number_on_page;
		$count_on_page = $this->model_cat->count($info_type["type_slug"]);
		$number_pagination = ceil($count_on_page / $number_on_page);
		for ($i=1; $i <= $number_pagination ; $i++) {
			$active = ($i == $page)?1:0;
			$arr_pagination[] = [
				"number" => $i,
				"link" => base_url("{$info_type["type_slug"]}?page={$i}"),
				"active" => $active,
			];
		}
		// DATA PAGE
		$data["data_page"] = [
			"page_title" => $info_type["type_name"],
			"page_desc" => $info_type["desc"],
			"listcat" => ($type == "bang-chu-cai") ? $this->model_cat->getlist($type) : $this->model_cat->getlist($type, $page_start, $number_on_page),
			"pagination" => ($type == "bang-chu-cai") ? "" : $arr_pagination,
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
		isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
		$number_on_page = 10;
		$page_start = ($page - 1) * $number_on_page;
		$count_on_page = $this->model_song->count($infocat["id"]);
		$number_pagination = ceil($count_on_page / $number_on_page);
		for ($i=1; $i <= $number_pagination ; $i++) {
			$active = ($i == $page)?1:0;
			$arr_pagination[] = [
				"number" => $i,
				"link" => base_url("{$infocat["type_slug"]}/{$infocat["cat_slug"]}?page={$i}"),
				"active" => $active,
			];
		}
		// DATA PAGE
		$data["data_page"] = [
			"page_title" => $infocat["cat_name"],
			"page_desc" => $infocat["desc"],
			"listcat" => $this->model_cat->getlist($type),
			"listsong" => $this->model_song->getlistoncat($infocat["id"], $page_start, $number_on_page),
			"songrandom" => $this->model_song->getsongrandom(),
			"pagination" => $arr_pagination,
		];
		// META PAGE
		$data["page_meta"] = [
			"title" => $infocat["meta"]["seotitle"],
			"keywork" => $infocat["meta"]["seokeywork"],
			"desc" => $infocat["meta"]["seodes"],
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_listsong";
		$this->load->view("layout", $data);
	}
}