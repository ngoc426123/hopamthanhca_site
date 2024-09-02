<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cat;
use App\Models\Song;
use App\Models\Weekly;
use App\Models\Weeklymeta;

class SongWeekly extends BaseController {
  public function Index() {
		$weeklyModel = new Weekly();
		$weekyArray = [
			'lerieng' => [
				'id' => 312,
			],
			'nama'    => [
				'id' => 313,
			],
			'namb'    => [
				'id' => 314,
			],
			'namc'    => [
				'id' => 315,
			],
		];

		foreach ($weekyArray as $key => $value) {
			$weeklyData = $weeklyModel
				->select('weekly.name, weekly.slug')
				->join('weeklycat', 'weeklycat.id_weekly = weekly.id')
				->where([
					'weeklycat.id_cat' => $value['id'],
					'weekly.status' => 'publish',
				])
				->orderBy('weekly.id', 'ESC')
				->find();

			$weekyArray[$key]['data'] = $weeklyData;
		}

    $data = [
      'pagemeta' => [
				'title'   => 'Thánh ca hằng tuần - Hợp âm Thánh Ca',
				'keywork' => 'Soạn bài hát thánh ca hàng tuần theo từng chủ đề, từng tuần phụng vụ, quanh năm A, B, C, các lễ đặc biệt.',
				'desc'    => 'Thư viện hợp âm thánh ca lớn nhất hiện nay, soạn bài hát thánh ca theo từng chủ đề, từng tuần, qunh năm phụng vụ với các bài hát được Imprimatur (Bài hát được dùng trong phụng vụ)',
				'canonical' => base_url('thanh-ca-hang-tuan'),
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
						'title' => 'thánh ca hàng tuần',
            'link'  => base_url('thanh-ca-hang-tuan'),
          ],
        ],
				'data'       => $weekyArray,
      ],
    ];

		return view('SongWeekly', $data);
  }

  public function Detail($slug) {
		$weeklyModel = new Weekly();
		$weeklyMetaModel = new Weeklymeta();
		$catModel = new Cat();
		$songModel = new Song();
		$weeklyData = $weeklyModel
			->where([
				'slug'   => $slug,
				'status' => 'publish',
			])
			->first();
		$weeklyMetaData = $weeklyMetaModel
			->where('id_weekly', $weeklyData['id'])
			->find();
		
		foreach ($weeklyMetaData as $value) {
			$weeklyData['meta'][$value['key']] = $value['value'];
		}

		$weeklyContentData = unserialize($weeklyData['content']);
	
		foreach ($weeklyContentData as $key => $value) {
			$catData = $catModel
				->where('cat_slug', $key)
				->first();
			$weeklyContentData[$key] = [];
			$weeklyContentData[$key]['cat'] = $catData;

			foreach ($value as $songID) {
				$songData = $songModel
					->select('song.title, song.slug, song.excerpt, songmeta.value as pdffile')
					->join('songmeta', 'songmeta.id_song = song.id')
					->where([
						'song.id'      => $songID,
						'songmeta.key' => 'pdffile',
						'status'       => 'publish',
					])
					->first();
				
				$weeklyContentData[$key]['list'][] = $songData;
			}
		}

		$weeklyData['content'] = $weeklyContentData;
    $data = [
      'pagemeta' => [
				'title'   => $weeklyData['name'].' - Thánh ca hằng tuần - Hợp âm Thánh Ca',
				'desc'    => $weeklyData['desc'] ? $weeklyData['desc'] : $weeklyData['meta']['seodes'],
				'keywork' => $weeklyData['meta']['seokeywork'],
				'canonical' => base_url('thanh-ca-hang-tuan'),
      ],
			'pageinit' => $this->siteInit,
      'pagedata' => [
				'pagetitle'  => $weeklyData['name'],
				'pagedesc'   => $weeklyData['desc'] ? $weeklyData['desc'] : $weeklyData['meta']['seodes'],
				'breadcrumb' => [
					[
						'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
						'title' => 'thánh ca hàng tuần',
            'link'  => base_url('thanh-ca-hang-tuan'),
          ],
          [
						'title' => 'thánh ca hàng tuần',
            'link'  => base_url('thanh-ca-hang-tuan.'.$slug),
          ],
        ],
				'data'       => $weeklyData,
      ],
    ];

		return view('SongWeeklyDetail', $data);
  }
}
