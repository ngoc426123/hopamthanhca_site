<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;

class Api extends ResourceController {
	protected $format = 'json';
	protected $perpage = 10;

	public function Search() {
		$songModel = new Song();
		$songCatModel = new Songcat();
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

	public function SongFilter() {
		$songModel = new Song();
		$songMetaModel = new Songmeta();
		$songCatModel = new Songcat();
		$body = $this->request->getBody();
		$arrayParams = json_decode($body, true);
		$Page = +$arrayParams['Page'][0] ?? 1;
		$PageQuery = $Page - 1;
		$Keywork = $arrayParams['TenBaiHat'][0] ?? '';
		$ChuyenMuc = $arrayParams['ChuyenMuc'] ?? null;
		$TacGia = $arrayParams['TacGia'] ?? null;
		$BangChuCai = $arrayParams['BangChuCai'] ?? null;
		$DieuBaiHat = $arrayParams['DieuBaiHat'] ?? null;
		$hasCat = $ChuyenMuc ?? $TacGia ?? $BangChuCai ?? $DieuBaiHat ?? null;
		$songList = [];
		$counter = 0;
		$songList = $songModel
			->distinct()
			->select('song.id, song.title, song.slug, song.excerpt, song.date')
			->when($hasCat, static function ($query) {
				$query->join('songcat', 'songcat.id_song = song.id');
				$query->join('cat', 'cat.id = songcat.id_cat');
			})
			->when($Keywork, static function ($query, $keywork) {
				$query->like('song.title', $keywork);
			})
			->when($ChuyenMuc, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->when($TacGia, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->when($BangChuCai, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->when($DieuBaiHat, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->orderBy('song.id', 'DESC')
			->limit($this->perpage, $PageQuery)
			->findAll();
		$counter = $songModel
			->distinct()
			->selectCount('song.id')
			->join('songcat', 'songcat.id_song = song.id')
			->join('cat', 'cat.id = songcat.id_cat')
			->when($Keywork, static function ($query, $keywork) {
				$query->like('song.title', $keywork);
			})
			->when($ChuyenMuc, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->when($TacGia, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->when($BangChuCai, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->when($DieuBaiHat, static function ($query, $arrayCat) {
				$query->orWhereIn('cat.cat_slug', $arrayCat);
			})
			->orderBy('song.id', 'DESC')
			->first();

		$songIDs = array_map(fn($item) => $item['id'], $songList);
		$authorsData = $songCatModel
			->select('cat.id, cat.cat_name, cat.cat_slug, songcat.id_song')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->whereIn('songcat.id_song', $songIDs)
			->where('type.type_slug', 'tac-gia')
			->findAll();
		$songMeta = $songMetaModel
			->whereIn('id_song', $songIDs)
			->findAll();

		foreach ($songList as $key => $songValue) {
			$arrayMeta = array_filter($songMeta, fn($item) => $item['id_song'] === $songValue['id']);
			$author = array_filter($authorsData, fn($item) => $item['id_song'] === $songValue['id']);

			foreach ($arrayMeta as $val) {
				$songList[$key]['meta'][$val['key']] = $val['value'];
			}

			foreach ($author as $val) {
				$songList[$key]['author'][] = $val;
			}
		}

		

		$pager = service('pager');
    $pagination = $pager->makeLinks($Page, $this->perpage, $counter['id'], 'pagination-api');

		$data = [
			'data'       => $songList,
			'total'      => $counter['id'],
			'pagination' => $pagination,
			'page'       => $arrayParams['Page'][0],
		];

		return $this->respond($data, ResponseInterface::HTTP_ACCEPTED);
	}
}
