<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/bao-tri', 'Maintain::index');
$routes->get('/canh-bao', 'Warning::index');
$routes->get('/sitemap.xml', 'Sitemap::index');

$routes->group('', ['filter' => 'siteinit'], static function ($routes) {
  $routes->get('/', 'Home::Index');
  $routes->get('/gioi-thieu', 'StaticPage::About');
  $routes->get('/danh-sach-hop-am', 'StaticPage::Chords');
  $routes->get('/sheet-nhac', 'Sheet::Index');
  $routes->get('/bai-hat', 'SongList::Index');
  $routes->get('/thanh-ca-hang-tuan', 'SongWeekly::Index');
  $routes->get('/thanh-ca-hang-tuan/(:any)', 'SongWeekly::Detail/$1');
  $routes->get('/danh-muc', 'Category::Index');
  $routes->get('/tim-kiem', 'Search');
  $routes->get('/bai-hat/(:any)', 'SongDetail::Index/$1');
  $routes->get('/(:any)/(:any)', 'Category::ListSong/$1/$2', ['filter' => 'check-category-anonymous']);
  $routes->get('/(:any)', 'Category::Category/$1', ['filter' => 'check-category-anonymous']);
  $routes->post('/api/search', 'Api::Search');
  $routes->post('/api/updatelove', 'Api::UpdateLove');
  $routes->post('/api/songfilter', 'Api::SongFilter');
});