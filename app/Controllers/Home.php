<?php

namespace App\Controllers;

use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;

class Home extends BaseController {
	public function index(): string {
		$data = [
			'newest' 			=> $this::getNewSong(),
			'mostview' 		=> $this::getMostView(),
			'mostweek' 		=> $this::getMostWeek(),
			'mostmonth' 	=> $this::getMostMonth(),
			'mostlove' 		=> $this::getMostLove(),
			'season' 			=> $this::getSeason(),
			'chuyenmuc' 	=> [
				[
					'name' 	=> 'Mùa thường niên',
					'img' 	=> 'images/chuyen-muc/_0011_thuongnien.jpg',
					'link' 	=> '/chuyen-muc/mua-thuong-nien',
					'class' => '--muathuongnien',
				],
				[
					'name' 	=> 'Mùa chay',
					'img' 	=> 'images/chuyen-muc/_0010_muachay.jpg',
					'link' 	=> '/chuyen-muc/mua-chay',
					'class' => '--muachay',
				],
				[
					'name' 	=> 'Mùa phục sinh',
					'img' 	=> 'images/chuyen-muc/_0009_muaphucsinh.jpg',
					'link' 	=> '/chuyen-muc/mua-phuc-sinh',
					'class' => '--muaphucsinh',
				],
				[
					'name' 	=> 'Mùa vọng',
					'img' 	=> 'images/chuyen-muc/_0008_muavong.jpg',
					'link' 	=> '/chuyen-muc/mua-vong',
					'class' => '--muavong',
				],
				[
					'name' 	=> 'Mùa giáng sinh',
					'img' 	=> 'images/chuyen-muc/_0007_muagiangsinh.jpg',
					'link' 	=> '/chuyen-muc/mua-giang-sinh',
					'class' => '--muagiangsinh',
				],
				[
					'name' 	=> 'Đức Mẹ Maria',
					'img' 	=> 'images/chuyen-muc/_0006_ducme.jpg',
					'link' 	=> '/chuyen-muc/duc-me',
					'class' => '--ducme',
				],
				[
					'name' 	=> 'Hôn phối',
					'img' 	=> 'images/chuyen-muc/_0005_honphoi.jpg',
					'link' 	=> '/chuyen-muc/hon-phoi',
					'class' => '--honphoi',
				],
				[
					'name' 	=> 'Tận hiến',
					'img' 	=> 'images/chuyen-muc/_0004_tanhien.jpg',
					'link' 	=> '/chuyen-muc/tan-hien',
					'class' => '--tanhien',
				],
				[
					'name' 	=> 'Lòng thương xót',
					'img' 	=> 'images/chuyen-muc/_0003_longthuongxot.jpg',
					'link' 	=> '/chuyen-muc/long-thuong-xot-chua',
					'class' => '--longthuongxot',
				],
				[
					'name' 	=> 'Các Thánh TĐVN',
					'img' 	=> 'images/chuyen-muc/_0002_cacthanhTDVN.jpg',
					'link' 	=> '/chuyen-muc/cac-thanh-tu-dao-viet-nam',
					'class' => '--tudaovietnam',
				],
				[
					'name' 	=> 'Cầu hồn',
					'img' 	=> 'images/chuyen-muc/_0001_cauhon.jpg',
					'link' 	=> '/chuyen-muc/cau-hon',
					'class' => '--cauhon',
				],
				[
					'name' 	=> 'Xem thêm',
					'img' 	=> 'images/chuyen-muc/_0000_xemthem.jpg',
					'link' 	=> '/chuyen-muc',
					'class' => '--xemthem',
				],
			],
		];
		return view('HomePage', $data);
	}

	public static function getNewSong() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songList = $songModel
			->select('id, title, slug, excerpt')
			->where('status', 'publish')
			->orderBy('id', 'DESC')
			->limit(10, 0)
			->findAll();

		foreach ($songList as $key => $songValue) {
			$catData = $songCatModel
				->join('cat', 'cat.id = songcat.id_cat')
				->join('cattype', 'cattype.id_cat = songcat.id_cat')
				->join('type', 'type.id = cattype.id_type')
				->where('songcat.id_song', $songValue['id'])
				->where('type.type_slug', 'tac-gia')
				->findAll();

			$songList[$key]['meta'] = [
				'author' => $catData[0]['cat_name'],
			];
		};

		return $songList;
	}

	public static function getMostView() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, CONVERT(songmeta.value, SIGNED INTEGER) as st')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where('song.status', 'publish')
			->orderBy('st', 'DESC')
			->limit(10, 0)
			->findAll();

		foreach ($songList as $key => $songValue) {
			$catData = $songCatModel
				->join('cat', 'cat.id = songcat.id_cat')
				->join('cattype', 'cattype.id_cat = songcat.id_cat')
				->join('type', 'type.id = cattype.id_type')
				->where('songcat.id_song', $songValue['id'])
				->where('type.type_slug', 'tac-gia')
				->findAll();

			$songList[$key]['meta'] = [
				'author' => $catData[0]['cat_name'],
			];
		};

		return $songList;
	}

	public static function getSeason() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt')
			->join('songcat', 'songcat.id_song = song.id')
			->where('song.status', 'publish')
			->whereNotIn('songcat.id_cat', [55])
			->orderBy('title', 'RANDOM')
			->limit(11, 0)
			->findAll();

		foreach ($songList as $key => $songValue) {
			$catData = $songCatModel
				->join('cat', 'cat.id = songcat.id_cat')
				->join('cattype', 'cattype.id_cat = songcat.id_cat')
				->join('type', 'type.id = cattype.id_type')
				->where('songcat.id_song', $songValue['id'])
				->where('type.type_slug', 'tac-gia')
				->findAll();

			$songList[$key]['meta'] = [
				'author' => $catData[0]['cat_name'],
			];
		};

		return $songList;
	}

	public static function getMostWeek() {
		$songModel = new Song();
		$songMetaModel = new Songmeta();
		$listDay = get_list_date("week");
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date, CONVERT(songmeta.value, SIGNED INTEGER) as view')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where([
				'song.status' => 'publish',
				'songmeta.key' => 'luotxem',
			])
			->whereIn('CONVERT(SUBSTRING(song.date, 1, 2), SIGNED INTEGER)', $listDay['day'])
			->whereIn('CONVERT(SUBSTRING(song.date, 4, 2), SIGNED INTEGER)', $listDay['month'])
			->orderBy('view', 'DESC')
			->limit(10, 0)
			->findAll();
		$songIDs = array_map(fn($item) => $item['id'], $songList);
		$songMeta = $songMetaModel
				->whereIn('id_song', $songIDs)
				->WhereIn('key', ['luotxem', 'lovesong'])
				->findAll();

		foreach ($songList as $key => $value) {
			$arrayMeta = array_filter($songMeta, fn($item) => $item['id_song'] === $value['id']);

			foreach ($arrayMeta as $val) {
				$songList[$key]['meta'][$val['key']] = $val['value'];
			}
		}

		return $songList;
	}

	public static function getMostMonth() {
		$songModel = new Song();
		$songMetaModel = new Songmeta();
		$listDay = get_list_date("week");
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date, CONVERT(songmeta.value, SIGNED INTEGER) as view')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where([
				'song.status' => 'publish',
				'songmeta.key' => 'luotxem',
			])
			->whereIn('CONVERT(SUBSTRING(song.date, 4, 2), SIGNED INTEGER)', $listDay['month'])
			->orderBy('view', 'DESC')
			->limit(10, 0)
			->findAll();
		$songIDs = array_map(fn($item) => $item['id'], $songList);
		$songMeta = $songMetaModel
				->whereIn('id_song', $songIDs)
				->WhereIn('key', ['luotxem', 'lovesong'])
				->findAll();

		foreach ($songList as $key => $value) {
			$arrayMeta = array_filter($songMeta, fn($item) => $item['id_song'] === $value['id']);

			foreach ($arrayMeta as $val) {
				$songList[$key]['meta'][$val['key']] = $val['value'];
			}
		}

		return $songList;
	}

	public static function getMostLove() {
		$songModel = new Song();
		$songMetaModel = new Songmeta();
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date, CONVERT(songmeta.value, SIGNED INTEGER) as love')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where([
				'song.status' => 'publish',
				'songmeta.key' => 'lovesong',
			])
			->orderBy('love', 'DESC')
			->limit(10, 0)
			->findAll();
		$songIDs = array_map(fn($item) => $item['id'], $songList);
		$songMeta = $songMetaModel
				->whereIn('id_song', $songIDs)
				->WhereIn('key', ['luotxem', 'lovesong'])
				->findAll();

		foreach ($songList as $key => $value) {
			$arrayMeta = array_filter($songMeta, fn($item) => $item['id_song'] === $value['id']);

			foreach ($arrayMeta as $val) {
				$songList[$key]['meta'][$val['key']] = $val['value'];
			}
		}

		return $songList;
	}
}
