<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cat;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;

class SongList extends BaseController{
	private $perpage = 10;

	public function index() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songMetaModel = new Songmeta();
		$catModel = new Cat();
		$songList = $songModel
			->select('id, title, slug, excerpt, date')
			->where('status', 'publish')
			->orderBy('id', 'DESC')
			->limit($this->perpage, 0)
			->findAll();
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

		$catList = [
			'chuyen-muc'   => [],
			'tac-gia'      => [],
			'bang-chu-cai' => [],
			'dieu-bai-hat' => [],
		];

		foreach ($catList as $key => $value) {
			$catData = $catModel
				->select('cat.id, cat.cat_name, cat.cat_slug')
				->join('cattype', 'cattype.id_cat = cat.id')
				->join('type', 'type.id = cattype.id_type')
				->where('type_slug', $key)
				->orderBy('cat.cat_name', 'ASC')
				->find();
			$catList[$key] = [];
			$catList[$key] = $catData;
		}

		$data = [
      'pagemeta' => [
				'title'     => 'Danh sách bài hát - Hợp Âm Thánh Ca - Kho lưu trữ thánh ca lớn nhất',
				'desc'      => 'Danh sách bài hát được tổng hợp toàn bộ ở đây để người dùng dễ dàng tìm kiếm hoặc muốn xem được toàn bộ bài hát của trang web',
				'keywork'   => 'Danh sách bài hát, tổng hợp nhạc thánh ca, nhạc thánh ca, bài hát thánh ca',
				'canonical' => base_url('thanh-ca-hang-tuan'),
      ],
			'pageinit' => $this->siteInit,
      'pagedata' => [
				'pagetitle'  => 'Danh sách bài hát',
				'pagedesc'   => 'Danh sách bài hát được tổng hợp toàn bộ ở đây để người dùng dễ dàng tìm kiếm hoặc muốn xem được toàn bộ bài hát của trang web',
				'breadcrumb' => [
					[
						'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
						'title' => 'Danh sách bài hát',
            'link'  => base_url('bai-hat'),
          ],
        ],
				'list'       => $songList,
				'cat'        => $catList,
      ],
    ];

		return view('SongList', $data);
	}
}
