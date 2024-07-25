<?php
use App\Models\Options;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$optionsModel = new Options();
$optionsData = $optionsModel
  ->where('key', 'maintain_status')
  ->find();

$cookie = new Cookie('hatc_admin_login');
$cookieAdminLogin = $cookie->isExpired();
$isMaintain = $optionsData[0]['value'] == 1 && $cookieAdminLogin;

if ($isMaintain) {
  $routes->get('(:any)', 'Maintain::index');
} else {
  $routes->get('/', 'Home::Index');
  $routes->get('/gioi-thieu', 'StaticPage::About');
  $routes->get('/hop-am', 'StaticPage::Chords');
  $routes->get('/(:any)', 'Category::Index/$1');
}
