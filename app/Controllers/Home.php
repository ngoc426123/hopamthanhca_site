<?php

namespace App\Controllers;

use App\Models\Options;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;
use App\Libraries\SongHandle;

class Home extends BaseController {

	public function Index() {
		$data = [
			'pagemeta' => $this::getMeta(),
			'pagedata' => [
				'newest'    => $this::getNewSong(),
				'mostview'  => $this::getMostView(),
				'mostweek'  => $this::getMostWeek(),
				'mostmonth' => $this::getMostMonth(),
				'mostlove'  => $this::getMostLove(),
				'season'    => $this::getSeason(),
				'cat'       => $this::getCat(),
				'author'    => $this::getAuthor(),
				'songhome'  => $this::getSongHome(),
			]
		];

		return view('HomePage', $data);
	}

	private static function getMeta() {
		$optionsModel = new Options();
		$optionsData = $optionsModel
			->whereIn('key', ['title', 'keywork', 'desc'])
			->find();
		$options = [];

		foreach ($optionsData as $value) {
			$options[$value['key']] = $value['value'];
		}

		return [
			'title'     => 'Trang chủ - ' . $options['title'] . ' - Thư viện thánh ca có hợp âm lớn nhất.',
			'keywork'   => $options['keywork'],
			'desc'      => $options['desc'],
			'canonical' => base_url(),
		];
	}

	private static function getSeason(){
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

		return $songList;
	}

	private static function getNewSong() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songList = $songModel
			->select('id, title, slug, excerpt')
			->where('status', 'publish')
			->orderBy('id', 'DESC')
			->limit(10, 0)
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

		foreach ($songList as $key => $songValue) {
			$author = array_filter($authorsData, fn($item) => $item['id_song'] === $songValue['id']);

			foreach ($author as $val) {
				$songList[$key]['author'][] = $val;
			}
		}

		return $songList;
	}

	private static function getMostView() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, CONVERT(songmeta.value, SIGNED INTEGER) as st')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where('song.status', 'publish')
			->orderBy('st', 'DESC')
			->limit(10, 0)
			->findAll();
		$songIDs = array_map(fn($item) => $item['id'], $songList);
		$authorsData = $songCatModel
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

		return $songList;
	}

	private static function getCat() {
		return [
			[
				'name' => 'Mùa thường niên',
				'img' => 'images/chuyen-muc/_0011_thuongnien.jpg',
				'link' => '/chuyen-muc/mua-thuong-nien',
				'class' => '--muathuongnien',
			],
			[
				'name' => 'Mùa chay',
				'img' => 'images/chuyen-muc/_0010_muachay.jpg',
				'link' => '/chuyen-muc/mua-chay',
				'class' => '--muachay',
			],
			[
				'name' => 'Mùa phục sinh',
				'img' => 'images/chuyen-muc/_0009_muaphucsinh.jpg',
				'link' => '/chuyen-muc/mua-phuc-sinh',
				'class' => '--muaphucsinh',
			],
			[
				'name' => 'Mùa vọng',
				'img' => 'images/chuyen-muc/_0008_muavong.jpg',
				'link' => '/chuyen-muc/mua-vong',
				'class' => '--muavong',
			],
			[
				'name' => 'Mùa giáng sinh',
				'img' => 'images/chuyen-muc/_0007_muagiangsinh.jpg',
				'link' => '/chuyen-muc/mua-giang-sinh',
				'class' => '--muagiangsinh',
			],
			[
				'name' => 'Đức Mẹ Maria',
				'img' => 'images/chuyen-muc/_0006_ducme.jpg',
				'link' => '/chuyen-muc/duc-me',
				'class' => '--ducme',
			],
			[
				'name' => 'Hôn phối',
				'img' => 'images/chuyen-muc/_0005_honphoi.jpg',
				'link' => '/chuyen-muc/hon-phoi',
				'class' => '--honphoi',
			],
			[
				'name' => 'Tận hiến',
				'img' => 'images/chuyen-muc/_0004_tanhien.jpg',
				'link' => '/chuyen-muc/tan-hien',
				'class' => '--tanhien',
			],
			[
				'name' => 'Lòng thương xót',
				'img' => 'images/chuyen-muc/_0003_longthuongxot.jpg',
				'link' => '/chuyen-muc/long-thuong-xot-chua',
				'class' => '--longthuongxot',
			],
			[
				'name' => 'Các Thánh TĐVN',
				'img' => 'images/chuyen-muc/_0002_cacthanhTDVN.jpg',
				'link' => '/chuyen-muc/cac-thanh-tu-dao-viet-nam',
				'class' => '--tudaovietnam',
			],
			[
				'name' => 'Cầu hồn',
				'img' => 'images/chuyen-muc/_0001_cauhon.jpg',
				'link' => '/chuyen-muc/cau-hon',
				'class' => '--cauhon',
			],
			[
				'name' => 'Xem thêm',
				'img' => 'images/chuyen-muc/_0000_xemthem.jpg',
				'link' => '/chuyen-muc',
				'class' => '--xemthem',
			],
		];
	}

	private static function getMostWeek() {
		$songModel = new Song();
		$songMetaModel = new Songmeta();
		$listDay = getListDate('week');
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date, CONVERT(songmeta.value, SIGNED INTEGER) as view')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where([
				'song.status' => 'publish',
				'songmeta.key' => 'luotxem',
			])
			->whereIn('day(song.date)', $listDay['day'])
			->whereIn('month(song.date)', $listDay['month'])
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

	private static function getMostMonth() {
		$songModel = new Song();
		$songMetaModel = new Songmeta();
		$listDay = getListDate("week");
		$songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date, CONVERT(songmeta.value, SIGNED INTEGER) as view')
			->join('songmeta', 'songmeta.id_song = song.id')
			->where([
				'song.status' => 'publish',
				'songmeta.key' => 'luotxem',
			])
			->whereIn('month(song.date)', $listDay['month'])
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

	private static function getMostLove() {
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

	private static function getAuthor() {
		return [
			[
				'name' => 'Ân Đức',
				'img' => 'images/tac-gia/_001_anduc.jpg',
				'link' => '/tac-gia/an-duc',
			],
			[
				'name' => 'Cao Huy Hoàng',
				'img' => 'images/tac-gia/_002_caohuyhoang.jpg',
				'link' => '/tac-gia/cao-huy-hoang',
			],
			[
				'name' => 'Cung Trầm',
				'img' => 'images/tac-gia/_003_cungtram.jpg',
				'link' => '/tac-gia/cung-tram',
			],
			[
				'name' => 'Đinh Công Huỳnh',
				'img' => 'images/tac-gia/_004_dinhconghuynh.jpg',
				'link' => '/tac-gia/dinh-cong-huynh',
			],
			[
				'name' => 'Huỳnh Minh Kỳ',
				'img' => 'images/tac-gia/_005_huynhminhky.jpg',
				'link' => '/tac-gia/huynh-minh-ky',
			],
			[
				'name' => 'Đỗ Vỹ Hạ',
				'img' => 'images/tac-gia/_006_dovyha.jpg',
				'link' => '/tac-gia/do-vy-ha',
			],
			[
				'name' => 'Giang Ân',
				'img' => 'images/tac-gia/_007_giangan.jpg',
				'link' => '/tac-gia/giang-an',
			],
			[
				'name' => 'Giang Tâm',
				'img' => 'images/tac-gia/_008_giangtam.jpg',
				'link' => '/tac-gia/giang-tam',
			],
			[
				'name' => 'Kim Long',
				'img' => 'images/tac-gia/_009_kimlong.jpg',
				'link' => '/tac-gia/kim-long',
			],
			[
				'name' => 'Mi Trầm',
				'img' => 'images/tac-gia/_010_mitram.jpg',
				'link' => '/tac-gia/mi-tram',
			],
			[
				'name' => 'Nguyễn Duy',
				'img' => 'images/tac-gia/_011_nguyenduy.jpg',
				'link' => '/tac-gia/nguyen-duy',
			],
			[
				'name' => 'Nguyễn Mộng Huỳnh',
				'img' => 'images/tac-gia/_012_nguyenmonghuynh.jpg',
				'link' => '/tac-gia/nguyen-mong-huynh',
			],
			[
				'name' => 'Vũ Đình Ân',
				'img' => 'images/tac-gia/_013_vudinhan.jpg',
				'link' => '/tac-gia/vu-dinh-an',
			],
		];
	}

	private static function getSongHome() {
		$songModel = new Song();
		$songCatModel = new Songcat();
		$songMetaModel = new Songmeta();
		$songList = $songModel
			->select('id, title, slug, date, content')
			->where('status', 'publish')
			->orderBy('id', 'DESC')
			->limit(12, 10)
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
			->WhereIn('key', ['luotxem', 'lovesong'])
			->findAll();

		foreach ($songList as $key => $songValue) {
			$author = array_filter($authorsData, fn($item) => $item['id_song'] === $songValue['id']);
			$arrayMeta = array_filter($songMeta, fn($item) => $item['id_song'] === $songValue['id']);

			foreach ($author as $val) {
				$songList[$key]['author'][] = $val;
			}

			foreach ($arrayMeta as $val) {
				$songList[$key]['meta'][$val['key']] = $val['value'];
			}

			$songHandle = new SongHandle($songValue['content']);
			$songList[$key]['content'] = $songHandle->removeChords()->removeUnderscore()->getsong();
		}

		return $songList;
	}
}
