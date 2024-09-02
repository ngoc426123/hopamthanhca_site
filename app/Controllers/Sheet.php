<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;

class Sheet extends BaseController {
	public $perpage = 20;

	public function Index() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songMetaModel = new Songmeta();
		$page = $this->request->getPostGet('page') ?? 1;
    $pageStart = ($page - 1) * $this->perpage;
		$songList = $songModel
			->select('id, title, slug, excerpt')
			->where('status', 'publish')
			->orderBy('id', 'DESC')
			->limit($this->perpage, $pageStart)
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
			->WhereIn('key', ['pdffile'])
			->findAll();
		$songCounter = $songModel
			->selectCount('id')
			->where('status', 'publish')
			->first();

		$pager = service('pager');
    $pagination = $pager->makeLinks($page, $this->perpage, $songCounter['id'], 'pagination');

		foreach ($songList as $key => $songValue) {
			$author = array_filter($authorsData, fn($item) => $item['id_song'] === $songValue['id']);
			$arrayMeta = array_filter($songMeta, fn($item) => $item['id_song'] === $songValue['id']);

			foreach ($arrayMeta as $val) {
				$songList[$key]['meta'][$val['key']] = $val['value'];
			}

			foreach ($author as $val) {
				$songList[$key]['author'][] = $val;
			}
		}

		$data = [
      'pagemeta' => [
				'title'     => 'Tìm kiếm - công cụ tìm kiếm thánh ca có hợp âm.',
				'keywork'   => 'Danh sách bài hát thánh ca, bài hát thánh ca guitar, bài hát thánh ca thường dùng, bài hát thánh ca cơ bản.',
				'desc'      => 'Danh sách bài hát thánh ca - Tổng hợp bài hát thánh ca thường dùng, dễ sử dụng, được nhiều người sử dụng, dành cho những bạn nào đam mê thánh ca.',
				'canonical' => base_url('sheet-nhac'),
      ],
			'pageinit' => $this->siteInit,
      'pagedata' => [
				'pagetitle'  => 'Sheet nhạc - file pdf nhạc thánh ca.',
				'pagedesc'   => 'Danh sách sheet nhạc - Tổng hợp bài hát có sheet nhạc, dễ tra cứu, truy cập, in bài hát.',
        'breadcrumb' => [
          [
            'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
            'title' => 'sheet nhạc',
            'link'  => base_url('sheet-nhac'),
          ],
        ],
				'list'       => $songList,
				'pagination' => $pagination,
      ],
    ];

		return view('Sheet', $data);
	}
}
