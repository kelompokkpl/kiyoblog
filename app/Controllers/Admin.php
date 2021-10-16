<?php namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PostModel;
use App\Models\ReqResetModel;
use CodeIgniter\Controller;


class Admin extends Controller {		
	public function __construct() {
        $this->admin = new AdminModel();
        $this->kategori = new KategoriModel();
        $this->penulis = new PenulisModel();
        $this->post = new PostModel();
        $this->reset = new ReqResetModel();
		helper(['form','url']);
    }

    // handle admin base
    public function index(){
    	if(session()->has('admin')){
    		return redirect()->to(base_url('admin/dashboard'));
    	} else{
    		$data = ['validation' => \Config\Services::validation()];
			return view('admin/login', $data);
		}
    }

    public function dashboard(){
    	if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'kategori' => $this->kategori->getKategori(),
    				 'penulis' => $this->penulis->getPenulis(),
    				 'post' => $this->post->getPostJoin(),
    				 'count_post' => $this->post->getCountPostPerCat(),
    				 'countReq' => $this->reset->countRequest()
    		]; 
    		return view('admin/dashboard',$data);
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
    }

    public function register(){
    	if(session()->has('admin')){
    		return redirect()->to(base_url('admin/dashboard'));
    	} else{
	    	$data = ['validation' => \Config\Services::validation()];
			return view('admin/register', $data);
		}
    }

    public function save_register(){
		$data = array(
            'nama_admin'=> $this->request->getPost('nama_admin'),
            'email'	=> $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'foto' => 'avatar.png',
        );
		
		$validation_rules = [
			'nama_admin' => [
				'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
				'label' => 'nama',
			],	
			'email' => [
				'rules' => 'required|valid_email',
			],	
			'password' => 'required'
		];
		
		if ($this->validate($validation_rules)){
			$query = $this->admin->addAdmin($data);
			if($query){
				session()->setFlashdata('success', ' You have an account now! Please sign in');
				return redirect()->to(base_url('admin')); 
			} else{
				session()->setFlashdata('failed', ' Ouchh.. Email is already registered. Enter another email');
				return redirect()->to(base_url('admin/register'))->withInput();
			}
		} else{
			session()->setFlashdata('failed', ' Hmm.. sorry :( Failed to register');
			return redirect()->to(base_url('admin/register'))->withInput(); 
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
			'password' => 'required'
		];
		
		if ($this->validate($validation_rules)){
			$query = $this->admin->loginAdmin($data);
			if($query){
				return redirect()->to(base_url('admin/dashboard')); 
			} else{
				session()->setFlashdata('failed', 'Ouchh.. We failed to get you in, enter the correct email and password');
				return redirect()->to(base_url('admin'))->withInput();
			}
		} else{
				session()->setFlashdata('failed', 'Sorry, failed to login. Please enter the correct email and password.');
				return redirect()->to(base_url('admin'))->withInput(); 
		}
	}

	public function profile(){
		if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'validation' => \Config\Services::validation(),
    				 'countReq' => $this->reset->countRequest()
    		]; 
    		return view('admin/profile',$data);
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
	}

	public function editProfile(){
		if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'validation' => \Config\Services::validation(),
    				 'countReq' => $this->reset->countRequest()
    		]; 
    		return view('admin/edit_profile',$data);
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
	}

	public function updateProfile(){
		if(session()->has('admin')){
    		$data = [
	            'nama_admin'=> $this->request->getPost('nama_admin'),
	            'email'	=> $this->request->getPost('email'),
	        ];
			
			$validation_rules = [
				'nama_admin' => [
					'rules' => 'required|alpha_space|min_length[3]|max_length[50]',
					'label' => 'nama',
				],	
				'email' => [
					'rules' => 'required|valid_email',
				],	
			];

			$id = $this->request->getPost('idadmin');	
			if ($this->validate($validation_rules)){
				$query = $this->admin->updateAdmin($data, $id);
				if($query){
					session()->setFlashdata('success', 'Profile has been updated');
					return redirect()->to(base_url('admin/profile')); 
				} else{
					session()->setFlashdata('failed', ' Ouchh.. Failed to update your profile');
					return redirect()->to(base_url('admin/edit_profile'))->withInput();
				}
			} else{
				session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
				return redirect()->to(base_url('admin/edit_profile'))->withInput(); 
			}
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
	}

	public function updatePhoto(){
		if(session()->has('admin')){			
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
				$id = $this->request->getPost('idadmin');
				$old_photo =  $this->request->getPost('old_photo');
				$photo = $this->request->getFile('photo');
				$photo_name = $photo->getRandomName();
				// move photo
				$photo->move('assets/uploads/admin', $photo_name);
				// jika foto old adalah foto default, maka tak perlu hapus old foto dan sebaliknya
				if ($old_photo != 'avatar.png'){
					// delete old foto
					unlink('assets/uploads/admin/'.$old_photo);
				}

				$data = ['foto' => $photo_name];

				$query = $this->admin->updateAdmin($data, $id);
				if($query){
					session()->setFlashdata('success', 'Photo profile has been updated');
					return redirect()->to(base_url('admin/profile')); 
				} else{
					session()->setFlashdata('failed', ' Ouchh.. Failed to update your photo profile');
					return redirect()->to(base_url('admin/profile'));
				}
			} else{
				session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
				return redirect()->to(base_url('admin/profile'))->withInput(); 
			}
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
	}

	public function editPassword(){
		if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'validation' => \Config\Services::validation(),
    				 'countReq' => $this->reset->countRequest()
    		]; 
    		return view('admin/update_password',$data);
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
	}

	public function updatePassword(){
		if(session()->has('admin')){			
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

			$id = $this->request->getPost('idadmin');	
			$old = md5($this->request->getPost('old_password'));
			$new = md5($this->request->getPost('new_password'));
			if ($this->validate($validation_rules)){
				$admin_data = $this->admin->getDataAdmin($id);
				if ($old == $admin_data->password){
					$data = ['password' => $new];
					$query = $this->admin->updateAdmin($data, $id);
					if($query){
						session()->setFlashdata('success', 'Password has been changed');
						return redirect()->to(base_url('admin/profile')); 
					} else{
						session()->setFlashdata('failed', ' Ouchh.. Failed to change your password');
						return redirect()->to(base_url('admin/update_password'))->withInput();
					}
				} else{
					session()->setFlashdata('failed', "Wrong old password. Try Again!");
					return redirect()->to(base_url('admin/update_password'))->withInput();
				}
			} else{
				session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
				return redirect()->to(base_url('admin/edit_profile'))->withInput(); 
			}
    	} else{
    		return redirect()->to(base_url('admin'));
    	}
	}

	public function logout(){
		$query = $this->admin->logoutAdmin();
		if($query){
			return redirect()->to(base_url('admin'));
		} 
	}
}
?>