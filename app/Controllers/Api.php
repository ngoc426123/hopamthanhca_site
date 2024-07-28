<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;

class Api extends ResourceController {
	protected $format = 'json';

	public function Search() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songMetaModel = new Songmeta();
		$body = $this->request->getBody();
		$param = json_decode($body);
		$keywork = $param->keywork;
		$songList = $songModel
			->select('id, title, slug, excerpt')
			->where('status', 'publish')
			->like('title', $keywork)
			->orderBy('id', 'DESC')
			->findAll();
		
		// NOT FIND WITH TITLE
		if (count($songList) == 0) {
			$songList = $songModel
				->select('id, title, slug, excerpt')
				->where('status', 'publish')
				->like('excerpt', $keywork)
				->orderBy('id', 'DESC')
				->findAll();
		}

		// NOT FIND WITH EXCERPT
		if (count($songList) == 0) {
			$data = [
				'data'  => [],
				'count' => 0,
			];
	
			return $this->respond($data, ResponseInterface::HTTP_ACCEPTED);
		}

		// HAS RESULT
		$songIDs = array_map(fn($item) => $item['id'], $songList);
		$authorsData = $songCatModel
			->select('cat.id, cat.cat_name, cat.cat_slug, songcat.id_song')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->whereIn('songcat.id_song', $songIDs)
			->where('type.type_slug', 'tac-gia')
			->findAll();

		foreach ($songList as $key => $songValue) {
			$author = array_filter($authorsData, fn($item) => $item['id_song'] === $songValue['id']);

			foreach ($author as $val) {
				$songList[$key]['author'][] = $val;
			}
		}

		$data = [
			'data' => $songList,
			'count' => count($songList),
		];

		return $this->respond($data, ResponseInterface::HTTP_ACCEPTED);
	}

	public function UpdateLove() {
		$songMetaModel = new Songmeta();
		$body = $this->request->getBody();
		$param = json_decode($body);
		$id = $param->id;
	
		$metaData = $songMetaModel
			->where('id_song', $id)
			->findAll();
		$lover = array_filter($metaData, fn($item) => $item['key'] == 'lovesong', 0);
    $lover = reset($lover);
    $lover = $lover['value'];
    $lover += 1;
    $songMetaModel
      ->set('value', $lover)
      ->where([
        'id_song' => $id,
        'key'     => 'lovesong',
      ])
      ->update();

		$data = [
			'love'  => $lover,
		];

		return $this->respond($data, ResponseInterface::HTTP_ACCEPTED);
	}
}
