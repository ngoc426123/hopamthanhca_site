<?php

namespace App\Controllers;

use App\Models\Options;
use App\Controllers\BaseController;

class StaticPage extends BaseController {
  public static function About() {
    $optionsModel = new Options();
		$optionsData = $optionsModel
      ->where('key', 'site_url')
      ->find();
		$options = [];

		foreach ($optionsData as $value) {
			$options[$value['key']] = $value['value'];
		}

    $data = [
      'pagemeta' => [
        'title'     => 'Lời Giới thiệu - Hợp âm thánh ca',
        'keywork'   => 'Giới thiệu về hợp âm thánh ca, về hợp âm thánh ca, hợp âm thánh ca có sheet.',
        'desc'      => 'Website hợp âm dành riêng cho nhạc thánh ca hiện nay',
        'site_url'  => $options['site_url'],
        'canonical' => base_url('gioi-thieu'),
      ],
      'breadcrumb' => [
        [
          "title" => "Trang chủ",
          "link"  => base_url(),
        ],
        [
          "title" => "Giới thiệu",
          "link"  => base_url('gioi-thieu'),
        ],
      ],
    ];
  
		return view('About', $data);
  }

  public static function Chords() {
    $optionsModel = new Options();
		$optionsData = $optionsModel
      ->where('key', 'site_url')
      ->find();
		$options = [];

		foreach ($optionsData as $value) {
			$options[$value['key']] = $value['value'];
		}

    $data = [
      'pagemeta' => [
        'title'     => 'Danh sách hợp âm - Tổng hợp hợp âm thường dùng, dễ sử dụng',
        'keywork'   => 'Danh sách hợp âm, hợp âm guitar, hợp âm thường dùng, hợp âm cơ bản.',
        'desc'      => 'Danh sách hợp âm - Tổng hợp hợp âm thường dùng, dễ sử dụng, được nhiều người sử dụng, dành cho những bạn nào đam mê thánh ca.',
        'site_url'  => $options['site_url'],
        'canonical' => base_url('danh-sach-hop-am'),
      ],
      'breadcrumb' => [
        [
          "title" => "Trang chủ",
          "link"  => base_url(),
        ],
        [
          "title" => "Hợp âm",
          "link"  => base_url('danh-sach-hop-am'),
        ],
      ],
    ];
  
		return view('Chords', $data);
  }
}
