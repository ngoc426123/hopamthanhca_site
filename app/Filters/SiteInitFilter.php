<?php
namespace App\Filters;

use App\Models\Options;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SiteInitFilter implements FilterInterface {
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
		$session = service('session');

		if (!$session->get('sitekey')) {
			$optionsModel = new Options();
			$optionsData = $optionsModel
				->whereIn('key', ['favicon', 'site_url', 'phonenumber', 'email', 'social_facebook', 'social_youtube', 'social_twitter',  'dateformat', 'timeformat'])
				->find();
			$options = [];
			foreach ($optionsData as $value) {
				$options[$value['key']] = $value['value'];
			}
			$datetimeFormat = $options['dateformat'] . ' ' . $options['timeformat'];
			$sitekey = random_string('alnum', 16);
			$sesionData = [
				...$options,
				'datetimeformat' => $datetimeFormat,
				'sitekey'        => $sitekey,
			];

			$session->set($sesionData);
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
