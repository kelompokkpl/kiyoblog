<?php namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PostModel;
use CodeIgniter\Controller;


class Penulis extends Controller {		
	public function __construct() {
        $this->penulis = new PenulisModel();
        $this->post = new PostModel();
        $this->kategori = new KategoriModel();
		helper(['form','url']);
    }
	
	// handle penulis
    public function index(){
    	if(session()->has('penulis')){
    		return redirect()->to(base_url('penulis/dashboard'));
    	} else{
    		$data = ['validation' => \Config\Services::validation()];
			return view('penulis/login', $data);
		}
    }

    public function dashboard(){
    	if(session()->has('penulis')){
    		$data = [
    				 'kategori' => $this->kategori->getKategori(),
    				 'penulis' => $this->penulis->getDataPenulis(),
    				 'post' => $this->post->getPostJoinByPenulis(session('idpenulis')),
    				 'kat' => $this->post->countCatByPen(session('idpenulis')),
    				 'kom' => $this->post->countComByPen(session('idpenulis')),
    		]; 
    		return view('penulis/dashboard',$data);
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
    }

    public function register(){
    	if(session()->has('penulis')){
    		return redirect()->to(base_url('penulis/dashboard'));
    	} else{
	    	$data = ['validation' => \Config\Services::validation()];
			return view('penulis/register', $data);
		}
    }

    public function save_register(){
		$data = array(
            'nama_penulis'=> $this->request->getPost('nama_penulis'),
            'email'	=> $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'alamat' => $this->request->getPost('alamat'),
            'telp' => $this->request->getPost('telp'),
            'foto' => 'avatar.png',
        );
		
		$validation_rules = [
			'nama_penulis' => [
				'rules' => 'required|min_length[3]|max_length[50]',
				'label' => 'nama',
			],	
			'email' => [
				'rules' => 'required|valid_email',
			],	
			'password' => 'required|min_length[5]|max_length[100]',
			'alamat' => [
				'rules' => 'required|min_length[3]|max_length[100]',
			],
			'telp' => [
				'rules' => 'required|numeric|min_length[8]|max_length[15]',
				'label' => 'no. telepon',
			],
		];
		
		if ($this->validate($validation_rules)){
			$query = $this->penulis->addPenulis($data);
			if($query){
				session()->setFlashdata('success', ' You have an account now! Please sign in');
				return redirect()->to(base_url('penulis')); 
			} else{
				session()->setFlashdata('failed', ' Ouchh.. Email is already registered. Enter another email');
				return redirect()->to(base_url('penulis/register'))->withInput();
			}
		} else{
			session()->setFlashdata('failed', ' Hmm.. sorry :( Failed to register. Your input is not valid');
			return redirect()->to(base_url('penulis/register'))->withInput(); 
		}
	} 

	public function login(){
		$data = array(
            'email'	=> $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
        );
		
		$validation_rules = [
			'email' => [
				'rules' => 'required|valid_email',
			],	
			'password' => 'required|min_length[5]|max_length[100]'
		];
		
		if ($this->validate($validation_rules)){
			$query = $this->penulis->loginPenulis($data);
			if($query){
				return redirect()->to(base_url('penulis/dashboard')); 
			} else{
				session()->setFlashdata('failed', 'Ouchh.. We failed to get you in, enter the correct email and password');
				return redirect()->to(base_url('penulis'))->withInput();
			}
		} else{
				session()->setFlashdata('failed', 'Sorry, failed to login. Please enter the correct email and password.');
				return redirect()->to(base_url('penulis'))->withInput(); 
		}
	}

	public function profile(){
		if(session()->has('penulis')){
    		$data = ['penulis' => $this->penulis->getDataPenulis(),
    				 'validation' => \Config\Services::validation(),
    		]; 
    		return view('penulis/profile',$data);
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
	}

	public function editProfile(){
		if(session()->has('penulis')){
    		$data = ['penulis' => $this->penulis->getDataPenulis(),
    				 'validation' => \Config\Services::validation(),
    		]; 
    		return view('penulis/edit_profile',$data);
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
	}

	public function updateProfile(){
		if(session()->has('penulis')){
    		$data = [
	            'nama_penulis'=> $this->request->getPost('nama_penulis'),
	            'email'	=> $this->request->getPost('email'),
	            'alamat'	=> $this->request->getPost('alamat'),
	            'telp'	=> $this->request->getPost('telp'),
	        ];
			
			$validation_rules = [
				'nama_penulis' => [
				'rules' => 'required|min_length[3]|max_length[50]',
				'label' => 'nama',
				],	
				'email' => [
					'rules' => 'required|valid_email',
				],	
				'alamat' => [
					'rules' => 'required|min_length[3]|max_length[100]',
				],
				'telp' => [
					'rules' => 'required|numeric|min_length[8]|max_length[15]',
					'label' => 'no. telepon',
				],	
			];

			$id = $this->request->getPost('idpenulis');	
			if ($this->validate($validation_rules)){
				$query = $this->penulis->updatePenulis($data, $id);
				if($query){
					session()->setFlashdata('success', 'Profile has been updated');
					return redirect()->to(base_url('penulis/profile')); 
				} else{
					session()->setFlashdata('failed', ' Ouchh.. Failed to update your profile');
					return redirect()->to(base_url('penulis/edit_profile'))->withInput();
				}
			} else{
				session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
				return redirect()->to(base_url('penulis/edit_profile'))->withInput(); 
			}
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
	}

	public function updatePhoto(){
		if(session()->has('penulis')){			
			$validation_rules = [
				'photo' => [
					'rules' => 'max_size[photo,1024]|mime_in[photo,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[photo]',
					'label' => 'photo',
					'errors' => [
						'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
						'mime_in' => 'Your upload does not have a valid image format',
						'is_image' => 'Your file is not image'
					]
				],		
			];
	
			if ($this->validate($validation_rules)){
				$id = $this->request->getPost('idpenulis');
				$old_photo =  $this->request->getPost('old_photo');
				$photo = $this->request->getFile('photo');
				$photo_name = $photo->getRandomName();
				// move photo
				$photo->move('assets/uploads/penulis', $photo_name);
				// jika foto old adalah foto default, maka tak perlu hapus old foto dan sebaliknya
				if ($old_photo != 'avatar.png'){
					// delete old foto
					unlink('assets/uploads/penulis/'.$old_photo);
				}

				$data = ['foto' => $photo_name];

				$query = $this->penulis->updatePenulis($data, $id);
				if($query){
					session()->setFlashdata('success', 'Photo profile has been updated');
					return redirect()->to(base_url('penulis/profile')); 
				} else{
					session()->setFlashdata('failed', ' Ouchh.. Failed to update your photo profile');
					return redirect()->to(base_url('penulis/profile'));
				}
			} else{
				session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
				return redirect()->to(base_url('penulis/profile'))->withInput(); 
			}
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
	}

	public function editPassword(){
		if(session()->has('penulis')){
    		$data = ['penulis' => $this->penulis->getDataPenulis(),
    				 'validation' => \Config\Services::validation(),
    		]; 
    		return view('penulis/update_password',$data);
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
	}

	public function updatePassword(){
		if(session()->has('penulis')){			
			$validation_rules = [
				'old_password' => [
					'rules' => 'required|alpha_numeric|min_length[5]|max_length[100]',
					'label' => 'password lama',
				],	
				'new_password' => [
					'rules' => 'required|alpha_numeric|min_length[5]|max_length[100]',
					'label' => 'password baru',
				],	
			];

			$id = $this->request->getPost('idpenulis');	
			$old = md5($this->request->getPost('old_password'));
			$new = md5($this->request->getPost('new_password'));
			if ($this->validate($validation_rules)){
				$penulis_data = $this->penulis->getDataPenulis($id);
				if ($old == $penulis_data->password){
					$data = ['password' => $new];
					$query = $this->penulis->updatePenulis($data, $id);
					if($query){
						session()->setFlashdata('success', 'Password has been changed');
						return redirect()->to(base_url('penulis/profile')); 
					} else{
						session()->setFlashdata('failed', ' Ouchh.. Failed to change your password');
						return redirect()->to(base_url('penulis/update_password'))->withInput();
					}
				} else{
					session()->setFlashdata('failed', "Wrong old password. Try Again!");
					return redirect()->to(base_url('penulis/update_password'))->withInput();
				}
			} else{
				session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
				return redirect()->to(base_url('penulis/edit_profile'))->withInput(); 
			}
    	} else{
    		return redirect()->to(base_url('penulis'));
    	}
	}

	public function logout(){
		$query = $this->penulis->logoutPenulis();
		if($query){
			return redirect()->to(base_url('penulis'));
		} 
	}

	public function forgotPassword(){
		return view('penulis/forgot_password');
	}

	public function requestSuccess(){
		return view('penulis/request_success');
	}

	// public function penulis(){
	// 	$data = ['penulis' => $this->penulis->getPenulis(),
	// 	];
	// 	return view('admin/penulis', $data);
	// }
	
	// public function addPenulis(){
	// 	$data = ['validation' => \Config\Services::validation()];
	// 	return view('admin/add_penulis', $data);
	// }

	// public function updatePenulis($id){
	// 	$data = [
	// 		'row'  => $this->penulis->getPenulis($id),
	// 		'validation' => \Config\Services::validation()
	// 	];
	// 	return view('admin/update_penulis', $data);
	// }
		
	// public function savePenulis($id=false){
 //        $data = array(
 //            'nama_penulis'	=> $this->request->getPost('nama_penulis'),
 //        );
		
	// 	$validation_rules = [
	// 		'nama_penulis' => [
	// 			'rules' => 'required|alpha_space|min_length[3]|max_length[30]',
	// 			'label' => 'nama penulis'
	// 		],	
	// 	];
		
	// 	if($id === false){ //add
	// 		if ($this->validate($validation_rules)){
	// 			$query = $this->penulis->addPenulis($data);
	// 			if($query){
	// 				session()->setFlashdata('success', 'Category data added successfully');
	// 				return redirect()->to(base_url('admin/penulis')); 
	// 			}
	// 		}else{
	// 			return redirect()->to(base_url('admin/add_penulis'))->withInput(); 
	// 		}
	// 	}else{ //update
	// 		if ($this->validate($validation_rules)){
	// 			$query = $this->penulis->updatePenulis($data,$id);
	// 			if($query){
	// 				session()->setFlashdata('success', 'Category data has been updated');
	// 				return redirect()->to(base_url('admin/penulis')); 
	// 			}
	// 		}else{
	// 				return redirect()->to(base_url('admin/update_penulis').'/'.$id)->withInput(); 
	// 		}
	// 	}
	// }
	
	// public function deletePenulis($id){
	// 	$query = $this->penulis->deletePenulis($id);
	// 	if($query){
	// 		session()->setFlashdata('success', 'Category data has been deleted');
	// 		return redirect()->to(base_url('admin/penulis')); 
	// 	}
	// }
}
?>