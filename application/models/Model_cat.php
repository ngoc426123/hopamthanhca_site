<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cat extends CI_Model {
	public function get($id) {
		$this->load->database();
		$this->db->from("type");
		$this->db->join("cattype", "type.id = cattype.id_type");
		$this->db->join("cat", "cat.id = cattype.id_cat");
		$this->db->where([
			"cat.id" => $id,
		]);
		$this->db->or_where("cat.cat_slug", $id);
		$get = $this->db->get();
		$result = $get->row_array();
		$id_query = $result["id"];
		// META
		$this->db->select("key, value");
		$this->db->from("catmeta");
		$this->db->where([
			"id_cat" => $id_query 
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}
		$result["permalink"] = base_url("{$result["type_slug"]}/{$result["cat_slug"]}");

		return $result;
	}

	public function getlist($type = null, $offset = -1, $limit = 10) {
		$this->load->database();

		$this->db->select("*");
		if ($type==null) {
			$this->db->from("cat");
		} else {
			$this->db->from("type");
			$this->db->join("cattype", "type.id = cattype.id_type");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->where([
				"type.type_slug" => $type,
			]);
			if ( $offset!=-1 ) {
				$this->db->limit($limit, $offset);
			}
		}
		
		$get = $this->db->get();
		$result = $get->result_array();

		// META
		foreach ($result as $key => $item_cat) {
			$id_cat = $item_cat['id'];
			$this->db->select("key, value");
			$this->db->from("catmeta");
			$this->db->where([
				"id_cat" => $id_cat
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}
			$result[$key]["permalink"] = base_url("{$item_cat["type_slug"]}/{$item_cat["cat_slug"]}");
			$result[$key]["count"] = $this->countcat($result[$key]["id"]);
		}
		return $result;
	}

	public function count($type = null) {
		$this->load->database();
		$this->db->select("COUNT(cat.id)");
		if ( $type == null ) {
			$this->db->from("cat");
		} else {
			$this->db->from("type");
			$this->db->join("cattype", "type.id = cattype.id_type");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->where([
				"type.type_slug" => $type,
			]);
		}
		$get = $this->db->get();
		return $get->row_array()['COUNT(cat.id)'];
	}

	public function countcat($id_cat) {
		$this->load->database();
		$this->db->select("COUNT(songcat.id_cat)");
		$this->db->from("cat");
		$this->db->join("songcat", "cat.id = songcat.id_cat");
		$this->db->where([
			"songcat.id_cat" => $id_cat,
		]);
		$get = $this->db->get();
		return $get->row_array()['COUNT(songcat.id_cat)'];
	}

	public function gettype($type) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("type");
		$this->db->where([
			"type_slug" => $type,
		]);
		$get = $this->db->get();
		$result = $get->row_array();
		return $result;
	}
}