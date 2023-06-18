<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_weekly extends CI_Model {
  public function get($slug) {
    $this->load->database();
		$this->db->select("*");
		$this->db->from("weekly");
		$this->db->where([
			"slug" => $slug
		]);
		$get = $this->db->get();
		$result = $get->row_array();
		$id = $result["id"];

		// META
		$this->db->select("key, value");
		$this->db->from("weeklymeta");
		$this->db->where([
			"id_weekly" => $id
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}

		// CATEGORY
		$this->db->select('*');
		$this->db->from('weeklycat');
		$this->db->join("cattype", "weeklycat.id_cat = cattype.id_cat");
		$this->db->join("type", "cattype.id_type = type.id");
		$this->db->where([
			"weeklycat.id_weekly" => $id
		]);
		$get = $this->db->get();
		$cat = $get->result_array();
		foreach ($cat as $key_cat => $item_cat) {
			$result["cat"][$item_cat['type_slug']][] = $item_cat['id_cat'];
		}
		return $result;
  }

	public function getlist($offset = -1, $limit = -1) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("weekly");
		$this->db->order_by("id", "DESC");
		if ($offset !== -1 && $limit !== -1)
			$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$weekly_result = $get->result_array();
		foreach ($weekly_result as $key => $item) {
			$id_weekly = $item['id'];
			// META
			$this->db->select("key, value");
			$this->db->from("weeklymeta");
			$this->db->where([
				"id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$weekly_result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}

			// CATEGORY
			$this->db->select('*');
			$this->db->from('weeklycat');
			$this->db->join("cattype", "weeklycat.id_cat = cattype.id_cat");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"weeklycat.id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$weekly_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		return $weekly_result;
	}

	public function getlistoncat($cat_id, $offset = -1, $limit = -1) {
		$this->load->database();
		$this->db->select("* ");
		$this->db->from("weekly");
		$this->db->join("weeklycat", "weeklycat.id_weekly = weekly.id");
		$this->db->where([
			"weeklycat.id_cat" => $cat_id,
		]);
		$this->db->order_by("weekly.id", "ASC");
		if ($offset !== -1 && $limit !== -1)
			$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$weekly_result = $get->result_array();

		foreach ($weekly_result as $key => $item) {
			$id_weekly = $item['id_weekly'];

			// META
			$this->db->select("key, value");
			$this->db->from("weeklymeta");
			$this->db->where([
				"id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$weekly_result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}

			// CATEGORY
			$this->db->select('*');
			$this->db->from('weeklycat');
			$this->db->join("cattype", "weeklycat.id_cat = cattype.id_cat");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"weeklycat.id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$weekly_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		return $weekly_result;
	}

	public function count($cat_id = 0) {
		$this->load->database();
		$this->db->select("COUNT(weekly.id)");
		$this->db->from("weekly");
		if ( $cat_id != 0 ) {
			$this->db->join("weeklycat", "weeklycat.id_weekly = weekly.id");
			$this->db->join("cat", "cat.id = weeklycat.id_cat");
			$this->db->where([
				"cat.id" => $cat_id,
			]);
		}
		$get = $this->db->get();

		return $get->row_array()['COUNT(weekly.id)'];
	}
}