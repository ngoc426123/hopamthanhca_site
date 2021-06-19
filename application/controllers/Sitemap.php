<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index () {
		$this->load->model(['model_song', 'model_options']);

		$site_url = $this->model_options->get('site_url');
		$list_song = $this->model_song->getlist("new", 0, 999);

		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach ($list_song as $value) {
			$url = $site_url .'/bai-hat/'. $value['slug'];
			$date = date4sitemap($value['date']);
			$sitemap .='<url>
									<loc>'.$url.'</loc>
									<lastmod>'.$date.'</lastmod>
									<changefreq>monthly</changefreq>
									<priority>0.8</priority>
								</url>';
		}
		$sitemap .= '</urlset>';

    header("Content-type: text/xml");
		echo $sitemap;
	}
}