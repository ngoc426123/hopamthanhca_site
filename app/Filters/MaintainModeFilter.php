<?php

namespace App\Filters;

use App\Models\Options;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MaintainModeFilter implements FilterInterface {
	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return RequestInterface|ResponseInterface|string|void
	 */
	public function before(RequestInterface $request, $arguments = null) {
		$optionsModel = new Options();
		$optionsData = $optionsModel
			->where('key', 'maintain_status')
			->find();

		$cookie = new Cookie('hatc_admin_login');
		$cookieAdminLogin = $cookie->isExpired();
		$isMaintain = $optionsData[0]['value'] == 1 && $cookieAdminLogin;

		if ($isMaintain) {
			return redirect()->to(base_url('/bao-tri'));
		}
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return ResponseInterface|void
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
		//
	}
}
