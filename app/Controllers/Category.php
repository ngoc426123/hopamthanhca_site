<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cat;
use App\Models\Catmeta;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;
use App\Models\Type;
use App\Libraries\SongHandle;

class Category extends BaseController {
  public $catPerpage = 20;
  public $listSongPerpage = 10;

  public function Index() {
    $typeModel = new Type();
    $catalogue = [
      'chuyen-muc'   => [],
      'tac-gia'      => [],
      'bang-chu-cai' => [],
      'dieu-bai-hat' => [],
    ];

    foreach ($catalogue as $key => $value) {
      $catData = $typeModel
        ->select('type.type_slug, type.type_name, cat.cat_name, cat.cat_slug')
        ->join('cattype', 'cattype.id_type = type.id')
        ->join('cat', 'cat.id = cattype.id_cat')
        ->where('type.type_slug', $key)
        ->limit(5, 0)
        ->orderBy('cat.cat_name', 'ASC')
        ->find();
      $catCounter = $typeModel
        ->selectCount('cat.id')
        ->join('cattype', 'cattype.id_type = type.id')
        ->join('cat', 'cat.id = cattype.id_cat')
        ->where('type.type_slug', $key)
        ->first();
      $catalogue[$key] = [
        'slug'    => $key,
        'name'    => $catData[0]['type_name'],
        'data'    => $catData,
        'counter' => $catCounter['id'],
      ];
    }

    $data = [
      'pagemeta' => [
        'title'     => 'Danh mục - Mục lục các phần bài hát thánh ca - Hợp âm thánh ca',
        'keywork'   => 'danh mục thánh ca, Mục lục thánh ca, , chuyên mục thánh ca, hợp âm thánh ca theo mục lục',
        'desc'      => 'Lựa chọn danh mục bạn cần tham khảo, đừng ngại liên hệ với chúng tôi nếu cần sự giúp đỡ',
        'canonical' => base_url('danh-muc'),
      ],
      'pagedata' => [
        'pagetitle'  => 'Danh Mục',
				'pagedesc'   => 'Lựa chọn danh mục bạn cần tham khảo, đừng ngại liên hệ với chúng tôi nếu cần sự giúp đỡ',
        'breadcrumb' => [
          [
            'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
            'title' => 'Danh mục',
            'link'  => base_url('danh-muc'),
          ],
        ],
        'catalogue'  => $catalogue,
      ],
    ];
  
		return view('Catalogue', $data);
  }

  public function Category($typeSlug) {
    $catModel = new Cat();
		$typeModel = new Type();
    $page = $this->request->getPostGet('page') ?? 1;
		$typeData = $typeModel
			->where('type_slug', $typeSlug)
			->first();
    $typeID = $typeData['id'];
    $typeName = $typeData['type_name'];
    $viewRender = $typeSlug == 'bang-chu-cai' ? 'AlphabetCategory' : 'CommonCategory';
    $catData = $catModel
      ->join('cattype', 'cattype.id_cat = cat.id')
      ->where('cattype.id_type', $typeID)
      ->orderBy('cat_name', 'ASC');

    if ($typeSlug == 'bang-chu-cai') {
      $catData = $catData->find();
    } else {
      $pageStart = ($page - 1) * $this->catPerpage;
      $catData = $catData
        ->limit($this->catPerpage, $pageStart)
        ->find();

      foreach ($catData as $key => $value) {
        $songcatModel = new Songcat();
        $songcatData = $songcatModel
          ->selectCount('id_cat')
          ->where('id_cat', $value['id_cat'])
          ->first();
  
        $catData[$key]['count'] = $songcatData['id_cat'];
      }
    }

    $catCounter = $catModel
      ->selectCount('cat.id')
      ->join('cattype', 'cattype.id_cat = cat.id')
      ->where('cattype.id_type', $typeID)
      ->orderBy('cat_name', 'ASC')
      ->first();
    $pager = service('pager');
    $pagination = $pager->makeLinks($page, $this->catPerpage, $catCounter['id'], 'pagination');
		$data = [
      'pagemeta' => [
        'title'     => "Thánh ca theo {$typeData["type_name"]} - Thư viện thánh ca có hợp âm lớn nhất.",
        'desc'      => "Thánh ca theo {$typeData["type_name"]} - Hợp âm thánh ca, kho lưu trữ thư viện âm nhạc có hợp âm lớn nhất Việt Nam.",
        'keywork'   => "Thánh ca theo {$typeData["type_name"]} - Hợp âm thánh ca, kho lưu trữ thư viện âm nhạc có hợp âm lớn nhất Việt Nam.",
        'canonical' => base_url('danh-sach-hop-am'),
      ],
			'pagedata' => [
        'pagetitle'  => $typeData['type_name'],
        'pagedesc'   => $typeData['desc'],
        'typename'   => $typeData['type_name'],
        'typeslug'   => $typeSlug,
        'list'       => $catData,
        'breadcrumb' => [
          [
            'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
            'title' => $typeName,
            'link'  => base_url($typeSlug),
          ],
        ],
        'pagination' => $pagination,
			],
    ];

		return view($viewRender, $data);
  }

  public function ListSong($typeSlug, $catSlug) {
    $songModel = new Song();
    $songCatModel = new Songcat();
    $songMetaModel = new Songmeta();
    $catModel = new Cat();
		$typeModel = new Type();
    $catMetaModel = new Catmeta();
		$typeData = $typeModel
			->where('type_slug', $typeSlug)
			->first();
    $typeName = $typeData['type_name'];
    $catData = $catModel
      ->where('cat_slug', $catSlug)
      ->first();
    $catID = $catData['id'];
    $catName = $catData['cat_name'];

    // SONG LIST
    $page = $this->request->getPostGet('page') ?? 1;
    $pageStart = ($page - 1) * $this->listSongPerpage;
    $songCounter = $songModel
			->selectCount('song.id')
			->join('songcat', 'songcat.id_song = song.id')
			->where([
        'song.status'    => 'publish',
        'songcat.id_cat' => $catID,
      ])
			->first();
    $songList = [];
    $songRandom = [];
    
    if ($songCounter['id'] > 0) {
      $songList = $songModel
        ->select('song.id, song.title, song.slug, song.excerpt, song.date')
        ->join('songcat', 'songcat.id_song = song.id')
        ->where([
          'song.status'    => 'publish',
          'songcat.id_cat' => $catID,
        ])
        ->orderBy('song.id', 'DESC')
        ->limit($this->listSongPerpage, $pageStart)
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
      $metaData = $songMetaModel
        ->whereIn('id_song', $songIDs)
        ->WhereIn('key', ['luotxem', 'lovesong', 'hopamchinh'])
        ->findAll();
  
      foreach ($songList as $key => $songValue) {
        $author = array_filter($authorsData, fn($item) => $item['id_song'] === $songValue['id']);
        $arrayMeta = array_filter($metaData, fn($item) => $item['id_song'] === $songValue['id']);
  
        foreach ($author as $val) {
          $songList[$key]['author'][] = $val;
        }
  
        foreach ($arrayMeta as $val) {
          $songList[$key]['meta'][$val['key']] = $val['value'];
        }
      }

      // SONG RANDOM
      $songRandom = $songModel
        ->select('song.id, song.title, song.slug, song.content, song.date')
        ->join('songcat', 'songcat.id_song = song.id')
        ->join('cat', 'cat.id = songcat.id_cat')
        ->where('cat.cat_slug', $catSlug)
        ->orderBy('cat.cat_name', 'RANDOM')
        ->first();
      $songRandomCat = $songCatModel
        ->select('cat.id, cat.cat_name, cat.cat_slug')
        ->join('cat', 'cat.id = songcat.id_cat')
        ->join('cattype', 'cattype.id_cat = songcat.id_cat')
        ->join('type', 'type.id = cattype.id_type')
        ->where('songcat.id_song', $songRandom['id'])
        ->where('type.type_slug', 'tac-gia')
        ->findAll();
      $songRandomMeta = $songMetaModel
        ->where('id_song', $songRandom['id'])
        ->WhereIn('key', ['luotxem', 'lovesong'])
        ->findAll();

      foreach ($songRandomCat as $value) {
        $songRandom['author'][] = $value;
      }
        foreach ($songRandomMeta as $value) {
        $songRandom['meta'][$value['key']] = $value['value'];
      }

      $songHandle = new SongHandle($songRandom['content']);
      $songRandom['content'] = $songHandle->removeChords()->removeUnderscore()->getsong();
    }

    $pager = service('pager');
    $pagination = $pager->makeLinks($page, $this->listSongPerpage, $songCounter['id'], 'pagination');

    // CAT META
    $catMetaData = $catMetaModel
      ->where('id_cat', $catID)
      ->find();
    $catMeta = [];

    foreach ($catMetaData as $value) {
      $catMeta[$value['key']] = $value['value'];
    }

    $catListData = $typeModel
      ->select('cat.cat_name, cat.cat_slug')
      ->join('cattype', 'cattype.id_type = type.id')
      ->join('cat', 'cat.id = cattype.id_cat')
      ->where('type.type_slug', $typeSlug)
      ->orderBy('cat.cat_name', 'ASC')
      ->limit(26, 0)
      ->find();

    $data = [
      'pagemeta' => [
        'title'     => 'Chuyên mục '. $catName. ' - Thư viện thánh ca có hợp âm lớn nhất.',
        'desc'      => $catMeta['seodes'] != '' ? $catMeta['seodes'] : 'Chuyên mục '. $catName. ' - Kho lưu trữ bài hát theo chuyên mục, hỗ trợ sheet nhạc và được sử dụng trong thánh lễ (imprimatur)',
        'keywork'   => $catMeta['seokeywork'],
        'canonical' => base_url($typeSlug . '/' . $catSlug),
      ],
			'pagedata' => [
        'pagetitle'  => $catMeta['seotitle'],
        'pagedesc'   => $catMeta['seodes'] != '' ? $catMeta['seodes'] : 'Chuyên mục '. $catName. ' - Kho lưu trữ bài hát theo chuyên mục, hỗ trợ sheet nhạc và được sử dụng trong thánh lễ (imprimatur)',
        'catlist'    => $catListData,
        'songrandom' => $songRandom,
        'typeslug'   => $typeSlug,
        'breadcrumb' => [
          [
            'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
            'title' => $typeName,
            'link'  => base_url($typeSlug),
          ],
          [
            'title' => $catName,
            'link'  => base_url($typeSlug . '/' . $catSlug),
          ],
        ],
        'pagination' => $pagination,
        'songlist'   => $songList,
			],
    ];

    return view('ListSong', $data);
  }
}
