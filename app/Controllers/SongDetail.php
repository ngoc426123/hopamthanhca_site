<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Song;
use App\Models\Songcat;
use App\Models\Songmeta;
use App\Libraries\SongHandle;
use App\Models\User;

class SongDetail extends BaseController {
  public function Index($songSlug) {
		$songModel = new Song();
    $songCatModel = new Songcat();
    $songMetaModel = new Songmeta();
    $userModel = new User();
		$songData = $songModel
      ->select('song.id, song.title, song.slug, song.content, song.date, song.author as user')
      ->join('songcat', 'songcat.id_song = song.id')
      ->join('cat', 'cat.id = songcat.id_cat')
      ->where('song.slug', $songSlug)
      ->orderBy('cat.cat_name', 'RANDOM')
      ->first();
    $userData = $userModel
      ->select('name')
      ->find($songData['user']);
    $authorsData = $songCatModel
      ->select('cat.id, cat.cat_name, cat.cat_slug')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->where('songcat.id_song', $songData['id'])
			->where('type.type_slug', 'tac-gia')
			->findAll();
    $catData = $songCatModel
      ->select('cat.id, cat.cat_name, cat.cat_slug')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->where([
        'songcat.id_song' => $songData['id'],
        'type.type_slug' => 'chuyen-muc'
      ])
      ->findAll();
    $rhythmData = $songCatModel
      ->select('cat.id, cat.cat_name, cat.cat_slug')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->where([
        'songcat.id_song' => $songData['id'],
        'type.type_slug' => 'dieu-bai-hat'
      ])
			->findAll();
    $metaData = $songMetaModel
			->where('id_song', $songData['id'])
			->findAll();
    $songData['user'] = $userData['name'];
    $songData['cat'] = $catData[0];
    $songData['rhythm'] = $rhythmData[0];

    foreach ($metaData as $value) {
      $songData['meta'][$value['key']] = $value['value'];
    }

    foreach ($authorsData as $value) {
      $songData['author'][] = $value;
    }

    $viewer = array_filter($metaData, fn($item) => $item['key'] == 'luotxem', 0);
    $viewer = reset($viewer);
    $viewer = $viewer['value'];
    $viewer += 1;
    $songMetaModel
      ->set('value', $viewer)
      ->where([
        'id_song' => $songData['id'],
        'key'     => 'luotxem',
      ])
      ->update();

    $songHandle = new SongHandle($songData['content']);
    $songData['content'] = $songHandle->convertChordsSystax()->getsong();
    $authorRender = renderAuthor($songData['author']);
		$data = [
      'pagemeta' => [
        'title'     => ucfirst($songData['meta']['seotitle']).' - ' . $authorRender . ' - '.'Hợp Âm Thánh Ca',
        'desc'      => $songData['meta']['seodes'],
        'keywork'   => $songData['meta']['seokeywork'],
        'canonical' => base_url('bai-hat/'.$songData['slug']),
      ],
      'pageinit' => $this->siteInit,
			'pagedata' => [
        'pagetitle'  => $songData['title'],
        'breadcrumb' => [
          [
            'title' => 'Trang chủ',
            'link'  => base_url(),
          ],
          [
            'title' => $songData['title'],
            'link'  => base_url('bai-hat/'.$songSlug),
          ],
        ],
        'songdata'     => $songData,
        'songauthor'   => $this::getSongAuthor($authorsData[0]['id']),
        'songcat'      => $this::getSongCat($catData[0]['id']),
        'authorrender' => $authorRender,
			],
    ];
    
		return view('SongDetail', $data);
  }

  private static function getSongAuthor($catID) {
    $songModel = new Song();
    $songCatModel = new Songcat();
    $songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date')
			->join('songcat', 'songcat.id_song = song.id')
			->where([
        'song.status'    => 'publish',
        'songcat.id_cat' => $catID,
      ])
			->orderBy('song.id', 'DESC')
			->limit(5, 0)
			->findAll();
    $songIDs = array_map(fn($item) => $item['id'], $songList);
    $catData = $songCatModel
			->select('cat.id, cat.cat_name, cat.cat_slug, songcat.id_song')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->whereIn('songcat.id_song', $songIDs)
			->where('type.type_slug', 'chuyen-muc')
			->findAll();

    foreach ($songList as $key => $value) {
      $songList[$key]['cat'] = $catData[$key];
    }

    return $songList;
  }

  private static function getSongCat($catID) {
    $songModel = new Song();
    $songCatModel = new Songcat();
    $songList = $songModel
			->select('song.id, song.title, song.slug, song.excerpt, song.date')
			->join('songcat', 'songcat.id_song = song.id')
			->where([
        'song.status'    => 'publish',
        'songcat.id_cat' => $catID,
      ])
			->orderBy('song.id', 'DESC')
			->limit(5, 0)
			->findAll();
    $songIDs = array_map(fn($item) => $item['id'], $songList);
    $catsData = $songCatModel
			->select('cat.id, cat.cat_name, cat.cat_slug, songcat.id_song')
			->join('cat', 'cat.id = songcat.id_cat')
			->join('cattype', 'cattype.id_cat = songcat.id_cat')
			->join('type', 'type.id = cattype.id_type')
			->whereIn('songcat.id_song', $songIDs)
			->where('type.type_slug', 'tac-gia')
			->findAll();

    foreach ($songList as $key => $songvalue) {
      $songList[$key]['cat'][] = $catsData[$key];
    }

    return $songList;
  }
}

