<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cat;
use App\Models\Catmeta;
use App\Models\Songcat;
use App\Models\Type;

class Category extends BaseController {
  public $perpage = 20;

  public function Index($typeSlug) {
    $catModel = new Cat();
		$typeModel = new Type();
		$typeData = $typeModel
			->where('type_slug', $typeSlug)
			->first();
    $typeID = $typeData['id'];
    $typeName = $typeData['type_name'];
    $viewRender = $typeSlug == 'bang-chu-cai' ? 'AlphabetCategory' : 'CommonCategory';
    $page = $this->request->getPostGet('page') ?? 1;
    $catData = $catModel
      ->join('cattype', 'cattype.id_cat = cat.id')
      ->where('cattype.id_type', $typeID)
      ->orderBy('cat_name', 'ASC');

    if ($typeSlug == 'bang-chu-cai') {
      $catData = $catData->find();
    } else {
      $pageStart = ($page - 1) * $this->perpage;
      $catData = $catData
        ->limit($this->perpage, $pageStart)
        ->find();

      foreach ($catData as $key => $value) {
        $songcatModel = new Songcat();
        $songcatData = $songcatModel
          ->where('id_cat', $value['id_cat'])
          ->countAllResults();
  
        $catData[$key]['count'] = $songcatData;
      }
    }

    $catCounter = $catModel
      ->selectCount('cat.id')
      ->join('cattype', 'cattype.id_cat = cat.id')
      ->where('cattype.id_type', $typeID)
      ->orderBy('cat_name', 'ASC')
      ->first();

    $pager = service('pager');
    $pagination = $pager->makeLinks($page, $this->perpage, $catCounter['id'], 'pagination');
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
    $catMetaData = $catMetaModel
      ->where('id_cat', $catID)
      ->find();
    $catMeta = [];
    foreach ($catMetaData as $value) {
      $catMeta[$value['key']] = $value['value'];
    }

    $data = [
      'pagemeta' => [
        'title'     => 'Chuyên mục '. $catName. ' - Thư viện thánh ca có hợp âm lớn nhất.',
        'desc'      => $catMeta['seodes'] ?? 'Chuyên mục '. $catName. ' - Kho lưu trữ bài hát theo chuyên mục, hỗ trợ sheet nhạc và được sử dụng trong thánh lễ (imprimatur)',
        'keywork'   => $catMeta['seokeywork'],
        'canonical' => base_url($typeSlug . '/' . $catSlug),
      ],
			'pagedata' => [
        'pagetitle'  => $catMeta['seotitle'],
        'pagedesc'   => $catMeta['seodes'] ?? 'Chuyên mục '. $catName. ' - Kho lưu trữ bài hát theo chuyên mục, hỗ trợ sheet nhạc và được sử dụng trong thánh lễ (imprimatur)',
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
			],
    ];

    return view('ListSong', $data);
  }
}
