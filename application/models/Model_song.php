<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_song extends CI_Model {
	public function get($id) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->where([
			"id" => $id,
		]);
		$this->db->or_where("slug", $id);
		$get = $this->db->get();
		$result = $get->row_array();

		// AUTHOR
		$this->db->select("id, email, dateregister, displayname");
		$this->db->from("user");
		$this->db->where([
			"id" => $result["author"],
		]);
		$get = $this->db->get();
		$result["author"] = $get->row_array();

		// META
		$this->db->select("key, value");
		$this->db->from("songmeta");
		$this->db->where([
			"id_song" => $result["id"]
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}

		// CATEGORY
		$this->db->select('*');
		$this->db->from('songcat');
		$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
		$this->db->join("cat", "cat.id = cattype.id_cat");
		$this->db->join("type", "cattype.id_type = type.id");
		$this->db->where([
			"songcat.id_song" => $result["id"]
		]);
		$get = $this->db->get();
		$cat = $get->result_array();
		foreach ($cat as $key_cat => $item_cat) {
			$result["cat"][$item_cat['type_slug']][] = $item_cat;
		}

		// PERMALINK
		$result["permalink"] = base_url("bai-hat/{$result["slug"]}");
		return $result;
	}

	public function getlist($type = "new", $offset = 0, $limit = 5) {
		$this->load->database();
		switch ($type) {
			case "pdf":
				$this->db->select("song.id");
				$this->db->from("song");
				$this->db->order_by("song.title", "ASC");
				break;
			case "new":
				$this->db->select("song.id");
				$this->db->from("song");
				$this->db->order_by("song.id", "DESC");
				break;
			case "mostview":
				$this->db->select("song.id, CONVERT(songmeta.value, SIGNED INTEGER) as st");
				$this->db->from("song");
				$this->db->join("songmeta", "song.id = songmeta.id_song");
				$this->db->where([
					"key" => "luotxem",
				]);
				$this->db->order_by("st", "DESC");
				break;
			case "mostlove":
				$this->db->select("song.id, CONVERT(songmeta.value, SIGNED INTEGER) as st");
				$this->db->from("song");
				$this->db->join("songmeta", "song.id = songmeta.id_song");
				$this->db->where([
					"key" => "lovesong",
				]);
				$this->db->order_by("st", "DESC");
				break;
			case "mostweek":
				$list_day = get_list_date("week");
				$this->db->select("song.id, CONVERT(songmeta.value, SIGNED INTEGER) as st");
				$this->db->from("song");
				$this->db->join("songmeta", "song.id = songmeta.id_song");
				$this->db->where([
					"key" => "luotxem",
				]);
				$this->db->where_in("CONVERT(SUBSTRING(song.date, 1, 2), SIGNED INTEGER)", $list_day["day"]);
				$this->db->where_in("CONVERT(SUBSTRING(song.date, 4, 2), SIGNED INTEGER)", $list_day["month"]);
				$this->db->or_where_in("CONVERT(SUBSTRING(song.date, 7, 4), SIGNED INTEGER)", $list_day["year"]);
				$this->db->order_by("st", "DESC");
				break;
			case "mostmonth":
				$list_day = get_list_date("month");
				$this->db->select("song.id, CONVERT(songmeta.value, SIGNED INTEGER) as st");
				$this->db->from("song");
				$this->db->join("songmeta", "song.id = songmeta.id_song");
				$this->db->where([
					"key" => "luotxem",
				]);
				$this->db->where_in("CONVERT(SUBSTRING(song.date, 1, 2), SIGNED INTEGER)", $list_day["day"]);
				$this->db->or_where_in("CONVERT(SUBSTRING(song.date, 4, 2), SIGNED INTEGER)", $list_day["month"]);
				$this->db->or_where_in("CONVERT(SUBSTRING(song.date, 7, 4), SIGNED INTEGER)", $list_day["year"]);
				$this->db->order_by("st", "DESC");
				break;
			default:
				# code...
				break;
		}

		$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$song_id = $get->result_array();
		// GET SONG
		$result = [];
		foreach ($song_id as $value) {
			$result[] = $this->get($value["id"]);
		}
		return $result;
	}

	public function getlistoncat($cat, $offset = 0, $limit = 5) {
		$this->db->select("song.id");
		$this->db->from("song");
		$this->db->join("songcat", "song.id = songcat.id_song");
		$this->db->where([
			"songcat.id_cat" => $cat,
		]);
		$this->db->order_by("song.id", "DESC");
		$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$song_id = $get->result_array();
		// GET SONG
		$result = [];
		foreach ($song_id as $value) {
			$result[] = $this->get($value["id"]);
		}
		return $result;
	}

	public function getlistsearch($keywork) {
		$this->db->select("song.id");
		$this->db->from("song");
		$this->db->like([
			"song.title" => $keywork,
		]);
		$this->db->order_by("song.id", "DESC");
		$get = $this->db->get();
		$song_id = $get->result_array();
		// GET SONG
		$result = [];
		foreach ($song_id as $value) {
			$result[] = $this->get($value["id"]);
		}
		return $result;
	}

	public function count($cat = 0) {
		$this->load->database();
		$this->db->select("COUNT(song.id)");
		$this->db->from("song");
		if ( $cat != 0 ) {
			$this->db->join("songcat", "song.id = songcat.id_song");
			$this->db->where([
				"songcat.id_cat" => $cat,
			]);
		}
		$get = $this->db->get();
		return $get->row_array()['COUNT(song.id)'];
	}

	public function getlistAPI() {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->order_by("id", "DESC");
		$get = $this->db->get();
		$songresult = $get->result_array();

		// CATEGORY
		foreach ($songresult as $key => $value) {
			$this->db->select('*');
			$this->db->from('songcat');
			$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"songcat.id_song" => $value["id"]
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$songresult[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		
		// GET SONG
		$result = [];
		foreach ($songresult as $key => $value) {
			$result["data"][] = [
				"value" => $value["title"],
				"label" => $value["title"],
				"permalink" => base_url("bai-hat/{$value["slug"]}"),
				"author" => $value["cat"]["tac-gia"][0]["cat_name"],
			];
		}
		$result["count"] = $this->count();
		return $result;
	}

	public function getsongrandom() {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->order_by("RAND()");
		$this->db->limit(1, 1);
		$get = $this->db->get();
		$result = $get->row_array();

		// META
		$this->db->select("key, value");
		$this->db->from("songmeta");
		$this->db->where([
			"id_song" => $result["id"]
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}

		// CATEGORY
		$this->db->select('*');
		$this->db->from('songcat');
		$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
		$this->db->join("cat", "cat.id = cattype.id_cat");
		$this->db->join("type", "cattype.id_type = type.id");
		$this->db->where([
			"songcat.id_song" => $result["id"]
		]);
		$get = $this->db->get();
		$cat = $get->result_array();
		foreach ($cat as $key_cat => $item_cat) {
			$result["cat"][$item_cat['type_slug']][] = $item_cat;
		}

		// PERMALINK
		$result["permalink"] = base_url("bai-hat/{$result["slug"]}");

		return $result;
	}

	public function getother($song_id, $cat_id, $offset = 0, $limit = 5) {
		$this->db->select("song.id");
		$this->db->from("song");
		$this->db->join("songcat", "song.id = songcat.id_song");
		$this->db->where([
			"songcat.id_cat" => $cat_id,
		]);
		$this->db->where_not_in("song.id", [$song_id]);
		$this->db->order_by("song.id", "DESC");
		$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$song_id = $get->result_array();
		// GET SONG
		$result = [];
		foreach ($song_id as $value) {
			$result[] = $this->get($value["id"]);
		}
		return $result;
	}
}