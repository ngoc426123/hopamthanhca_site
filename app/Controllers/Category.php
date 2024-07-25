<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cat;
use App\Models\Songcat;
use App\Models\Type;

class Category extends BaseController {
  public $perpage = 20;

  public function Index($catSlug) {
    $catModel = new Cat();
		$typeModel = new Type();
		$typeData = $typeModel
			->where('type_slug', $catSlug)
			->first();
    $typeID = $typeData['id'];
    $catData = [];
    $viewRender = $catSlug == 'bang-chu-cai' ? 'AlphabetCategory' : 'CommonCategory';
    $page = $this->request->getPostGet('page') ?? 0;
    $catData = $catModel
      ->join('cattype', 'cattype.id_cat = cat.id')
      ->where('cattype.id_type', $typeID)
      ->orderBy('cat_name', 'ASC')
      ->find();
    
    if ($catSlug != 'bang-chu-cai') {
      $pageStart = ($page) * $this->perpage;
      $pageEnd = ($pageStart - 1) + $this->perpage;
      $catData = array_filter($catData, function($item, $key) use($pageStart, $pageEnd) {
        if ($pageStart <= $key && $key <= $pageEnd) {
          return $item;
        }
      }, ARRAY_FILTER_USE_BOTH);
    
      foreach ($catData as $key => $value) {
        $songcatModel = new Songcat();
        $songcatData = $songcatModel
          ->where('id_cat', $value['id_cat'])
          ->countAllResults();

        $catData[$key]['count'] = $songcatData;
      }
    }

    $pager = service('pager');
    $pagination = $pager->makeLinks($page + 1, $this->perpage, count($catData), 'pagination');
		$data = [
      'pagemeta' => [
        'title'     => "Thánh ca theo {$typeData["type_name"]} - Hợp âm thánh ca",
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
            "title" => "Trang chủ",
            "link"  => base_url(),
          ],
          [
            "title" => "Bảng chữ cái",
            "link"  => base_url('bang-chu-cai'),
          ],
        ],
        'pagination' => $pagination,
			],
    ];

		return view($viewRender, $data);
  }
}
