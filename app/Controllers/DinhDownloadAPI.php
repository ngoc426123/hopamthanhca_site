<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\Songmeta;

class DinhDownloadAPI extends ResourceController {
	public function GetNeedtoDo() {
		$songMetaModel = new Songmeta();
		$songMetaData = $songMetaModel
			->selectCount('id')
			->where('key', 'pdffile')
			->like('value', 'dinh.dk')
			->first();

		return $this->respond(["total" => $songMetaData['id']], ResponseInterface::HTTP_ACCEPTED);
	}

	public function HandleSheet() {
		$body = $this->request->getBody();
		$param = json_decode($body);
		$songmetaModel = new Songmeta();
    $songmetaData = $songmetaModel
      ->where('key', 'pdffile')
      ->like('value', 'dinh.dk')
      ->limit($param->perpage, 0)
      ->orderBy('id', 'ASC')
      ->findAll();

    foreach ($songmetaData as $value) {
			$id = $value['id'];
      $path = $value['value'];
      $file = new File($path);
      $fName = '/sheet/storage/' . $file->getBasename();
			$fPath = ROOTPATH . $fName;
			$success = file_put_contents($fPath, fopen($path, 'r'));

			if ($success) {
				$songmetaModel
					->set('value', $fName)
					->where([
						'id'  => $id,
						'key' => 'pdffile'
					])
					->update();
			}
    }

		return $this->respond(["success" => $param->perpage], ResponseInterface::HTTP_ACCEPTED);
	}
}
