<?php

namespace App\Filters;

use App\Models\Cat;
use App\Models\Type;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckCategoryAnonymousFilter implements FilterInterface {
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
		$catModel = new Cat();
		$typeModel = new Type();
		$checkFlag = true;
		$uri = $request->getServer(['REQUEST_URI']);
		$categorys = explode('/', $uri['REQUEST_URI']);
		$categorys = array_filter($categorys);
		$categorys = array_values($categorys);
		$categorys = array_map(function ($item) {
			return preg_replace('/(\?).+/', '', $item);
		}, $categorys);

		if (count($categorys) > 2) {
			return \Config\Services::response()->setBody(view('Warning'));  
		}

		$typeData = $typeModel
			->selectCount('id')
			->where('type_slug', $categorys[0])
			->first();

		if ($typeData['id'] <= 0) {
			$checkFlag = false;
		}

		if (count($categorys) == 2) {
			$catData = $catModel
				->selectCount('id')
				->where('cat_slug', $categorys[1])
				->first();

			if ($catData['id'] <= 0) {
				$checkFlag = false;
			}
		}

		if (!$checkFlag) {
			return \Config\Services::response()->setBody(view('Warning')); 
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
