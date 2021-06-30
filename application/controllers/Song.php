<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function detail ($slug) {
		$this->load->model(['model_options', 'model_song', 'model_cat', 'model_meta']);
		// DATA PAGE
		$song = $this->model_song->get($slug);
		$data["data_page"] = [
			"song" => $song,
			"songother" => [
				"tac-gia" => $this->model_song->getother($song["id"], $song["cat"]["tac-gia"][0]["id_cat"]),
				"chuyen-muc" => $this->model_song->getother($song["id"], $song["cat"]["chuyen-muc"][0]["id_cat"]),
			]
		];
		// UPDATE VIEW
		$view = $song["meta"]["luotxem"] + 1;
		$this->model_meta->update($song["id"], 'luotxem', $view);
		// META PAGE
		$data["page_meta"] = [
			"title" => ucfirst($data["data_page"]["song"]["meta"]["seotitle"])." - ".$data["data_page"]["song"]["cat"]["tac-gia"][0]["cat_name"]." - "."Hợp Âm Thánh Ca",
			"keywork" => $data["data_page"]["song"]["meta"]["seokeywork"],
			"desc" => $data["data_page"]["song"]["meta"]["seodes"],
			"site_url" => $this->model_options->get('site_url'),
			"maintain_status" => $this->model_options->get('maintain_status'),
			"maintain_title" => $this->model_options->get('maintain_title'),
			"maintain_content" => $this->model_options->get('maintain_content'),
			"maintain_background" => $this->model_options->get('maintain_background'),
			"canonical" => $song["permalink"],
		];
		$data["data_menu"] = [
			"dieu-bai-hat" => $this->model_cat->getlist("dieu-bai-hat",-1,0),
		];
		$data["page_view"] = "view_song";
		$this->load->view("layout", $data);
	}

	public function updatelove() {
		// UPDATE
		$this->load->model(['model_meta']);
		$love = $_POST["love"];
		$id = $_POST["id"];
		$love++;
		$this->model_meta->update($id, 'lovesong', $love);
		// GET
		$love_new = $this->model_meta->get($id, 'lovesong');
		echo json_encode(["love" => $love_new]);
		die();
	}
}