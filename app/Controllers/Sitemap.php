<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Song;
use App\Models\Cat;
use App\Models\Options;

class Sitemap extends BaseController {
	public function index() {
		$songModel = new Song();
		$catModel = new Cat();
		$optionsModel = new Options();

		// GET SITE URL
		$optionsData = $optionsModel
			->whereIn('key', ['site_url'])
			->first();
		$siteUrl = $optionsData['value'];

		// BEGIN SITEMAP
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		// SONG LIST
		$songList = $songModel
			->select('title, slug, date')
			->where('status', 'publish')
			->orderBy('id', 'DESC')
			->limit(599, 0)
			->findAll();
	
		foreach ($songList as $value) {
			$url = $siteUrl . '/bai-hat/' . $value['slug'];
			$date = date_format(date_create($value['date']), 'Y-m-d');
			$sitemap .= '<url>
										<loc>'.$url.'</loc>
										<lastmod>'.$date.'</lastmod>
										<changefreq>monthly</changefreq>
										<priority>0.8</priority>
									</url>';
		}
		

		// CAT LIST
		$catList = $catModel
			->select('cat_name, cat_slug, type_slug')
			->join('cattype', 'cattype.id_cat = cat.id')
			->join('type', 'type.id = cattype.id_type')
			->findAll();

		foreach ($catList as $value) {
			$url = $siteUrl .'/'.$value['type_slug'].'/'. $value['cat_slug'];
			$date = '2018-06-18';
			$sitemap .= '<url>
										<loc>'.$url.'</loc>
										<lastmod>'.$date.'</lastmod>
										<changefreq>monthly</changefreq>
										<priority>0.8</priority>
									</url>';
		}

		// END SITEMAP
		$sitemap .= '</urlset>';

		// RENDER
		header("Content-type: text/xml");
		header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=file.xml;");
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
		echo $sitemap;
	}
}
