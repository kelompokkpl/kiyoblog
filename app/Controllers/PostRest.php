<?php namespace App\Controllers;

use App\Models\PostRestModel;
use App\Models\KategoriModel;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class PostRest extends Controller {	
	use ResponseTrait;

	public function __construct() {
		$this->model = new PostRestModel();
		$this->kategori = new KategoriModel();
	}

	public function showAll(){
		$data = $this->model->getPostJoin();
		return $this->respond($data, 200);
	}

	public function showRecent(){
		$data = $this->model->getPostRecent();
		return $this->respond($data, 200);
	}

	public function showByCategory($id){
		$data = $this->model->getPostJoin($id);
		return $this->respond($data, 200);
	}

	public function showDetail($id){
		$data = $this->model->getDetail($id);
		return $this->respond($data, 200);	
	}

	public function getComments($id){
		$data = $this->model->getComments($id);
		return $this->respond($data, 200);	
	}

	public function getKategori(){
		$data = $this->kategori->findAll();
		return $this->respond($data, 200);
	}
	
	public function getSearchPost($key){
	    $data = $this->model->searchPost($key);
		return $this->respond($data, 200);
	}
}
?>