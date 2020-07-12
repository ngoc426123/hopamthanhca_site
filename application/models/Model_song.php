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
		$get = $this->db->get();
		$result = $get->row_array();

		// META
		$this->db->select("key, value");
		$this->db->from("songmeta");
		$this->db->where([
			"id_song" => $id
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
			"songcat.id_song" => $id
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

	public function count($cat) {
		$this->load->database();
		$this->db->select("COUNT(song.id)");
		$this->db->from("song");
		$this->db->join("songcat", "song.id = songcat.id_song");
		$this->db->where([
			"songcat.id_cat" => $cat,
		]);
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
		$result = [];
		// GET SONG
		foreach ($songresult as $key => $value) {
			$result["data"][] = [
				"title" => $value["title"],
				"permalink" => base_url("bai-hat/{$value["slug"]}")
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
}