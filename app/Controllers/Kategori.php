<?php namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\AdminModel;
use App\Models\ReqResetModel;
use CodeIgniter\Controller;


class Kategori extends Controller {		
	public function __construct() {
		$this->admin = new AdminModel();
        $this->kategori = new KategoriModel();
        $this->reset = new ReqResetModel();
		helper(['form','url']);
    }

    public function index(){
    	if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'kategori'  => $this->kategori->getKategori(),
    				 'countReq' => $this->reset->countRequest()
			];
			return view('admin/kategori', $data);
    	} else{
    		return redirect()->to(base_url('admin'));
		}
    }
	
	public function kategori(){
		$data = ['validation' => \Config\Services::validation(),
				 'kategori' => $this->kategori->getKategori(),
				 
		];
		return view('admin/kategori', $data);
	}

	public function updateKategori($id){
		if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'row'  => $this->kategori->getKategori($id),
					 'validation' => \Config\Services::validation(),
					 'countReq' => $this->reset->countRequest()
			];
			return view('admin/update_kategori', $data);
    	} else{
    		return redirect()->to(base_url('admin'));
		}
		
	}
		
	public function saveKategori($id=false){
        $data = array(
            'nama_kategori'	=> $this->request->getPost('nama_kategori'),
        );
		
		$validation_rules = [
			'nama_kategori' => [
				'rules' => 'required|min_length[3]|max_length[30]',
				'label' => 'nama kategori'
			],	
		];
		
		if($id === false){ //add
			if ($this->validate($validation_rules)){
				$query = $this->kategori->addKategori($data);
				if($query){
					session()->setFlashdata('success', 'Category data added successfully');
					return redirect()->to(base_url('admin/kategori')); 
				}
			}else{
				return redirect()->to(base_url('admin/kategori'))->withInput(); 
			}
		}else{ //update
			if ($this->validate($validation_rules)){
				$query = $this->kategori->updateKategori($data,$id);
				if($query){
					session()->setFlashdata('success', 'Category data has been updated');
					return redirect()->to(base_url('admin/kategori')); 
				}
			}else{
					session()->setFlashdata('failed', 'Your input is not valid');
					return redirect()->to(base_url('admin/update_kategori').'/'.$id)->withInput(); 
			}
		}
	}
	
	public function deleteKategori($id){
		$query = $this->kategori->deleteKategori($id);
		if($query){
			session()->setFlashdata('success', 'Category data has been deleted');
			return redirect()->to(base_url('admin/kategori')); 
		} else{
			session()->setFlashdata('failed', 'Failed to delete data');
			return redirect()->to(base_url('admin/kategori')); 
		}
	}
}
?>