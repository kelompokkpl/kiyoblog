<?php namespace App\Controllers;

use App\Models\PostModel;
use App\Models\PenulisModel;
use App\Models\AdminModel;
use App\Models\KategoriModel;
use App\Models\ReqResetModel;
use CodeIgniter\Controller;


class Post extends Controller {		
	public function __construct() {
        $this->post = new PostModel();
        $this->kategori = new KategoriModel();
        $this->admin = new AdminModel();
        $this->penulis = new PenulisModel();
        $this->reset = new ReqResetModel();
		helper(['form','url']);
    }
	
	// handle post
	public function index(){
    	if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'kat_post' => $this->request->getPost('kat_post'),
    				 'count_post' => $this->post->getCountPostPerCat(),
    				 'postt' => $this->post->getPostJoin(),
                     'countReq' => $this->reset->countRequest()
    		];
    		if($data['kat_post']=='all' || !isset($data['kat_post'])){
    			$data['post'] = $this->post->getPostJoin();
    		} else{
    			$data['kategori'] = $this->kategori->getKategori($data['kat_post']);
    			$data['post'] = $this->post->getPostJoin($data['kat_post']);
    		}
    		return view('admin/daftar_post', $data);
    	} else{
			return redirect()->to(base_url('admin'));
		}
    }

    public function getPosting(){
        if(session()->has('penulis')){
            $data = ['penulis' => $this->penulis->getDataPenulis(),
                     'kat_post' => $this->request->getPost('kat_post'),
                     'count_post' => $this->post->getCountPostPerCatByPen(session()->get('idpenulis')),
                     'postt' => $this->post->getPostJoinByPenulis(session()->get('idpenulis'))
            ];
            if($data['kat_post']=='all' || !isset($data['kat_post'])){
                $data['post'] = $this->post->getPostJoinByPenulis(session()->get('idpenulis'));
            } else{
                $data['kategori'] = $this->kategori->getKategori($data['kat_post']);
                $data['post'] = $this->post->getPostJoin($data['kat_post']);
            }
            return view('penulis/my_post', $data);
        } else{
            return redirect()->to(base_url('penulis'));
        }
    }

    public function postCategory($id){
    	if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'post' => $this->post->getPostJoin($id),
    				 'kategori' => $this->kategori->getKategori($id),
                     'countReq' => $this->reset->countRequest()
    		];
    		return view('admin/detail_rekap', $data);
    	} else{
			return redirect()->to(base_url('admin'));
		}
    }

    public function detailPost($id){
    	if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'post' => $this->post->getPostJoinById($id),
    				 'komentar' => $this->post->getKomentar($id),
                     'countReq' => $this->reset->countRequest()
    		];
    		return view('admin/detail_post', $data);
    	} else{
			return redirect()->to(base_url('admin'));
		}
    }

    public function detailPostPen($id){
        if(session()->has('penulis')){
            $data = ['penulis' => $this->penulis->getDataPenulis(),
                     'post' => $this->post->getPostJoinById($id),
                     'komentar' => $this->post->getKomentar($id)
            ];
            return view('penulis/detail_post', $data);
        } else{
            return redirect()->to(base_url('penulis'));
        }
    }

    public function rekap(){
    	if(session()->has('admin')){
    		$data = ['admin' => $this->admin->getDataAdmin(),
    				 'count_post' => $this->post->getCountPostPerCat(),
    				 'post' => $this->post->getPostJoin(),
                     'countReq' => $this->reset->countRequest()
    		];
    		return view('admin/rekap_post', $data);
    	} else{
			return redirect()->to(base_url('admin'));
		}
    }

    public function addPost(){
        if(session()->has('penulis')){
            $data = ['penulis' => $this->penulis->getDataPenulis(),
                     'kategori' => $this->kategori->getKategori(),
                     'validation' => \Config\Services::validation(),
            ];
            return view('penulis/add_post', $data);
        } else{
            return redirect()->to(base_url('penulis'));
        }
    }

    public function savePost(){
        if(session()->has('penulis')){
            $validation_rules = [
                'judul' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'label' => 'judul',
                ],  
                'konten' => [
                    'rules' => 'required',
                ],    
                'foto' => [
                    'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[foto]',
                    'label' => 'foto',
                    'errors' => [
                        'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                        'mime_in' => 'Your upload does not have a valid image format',
                        'is_image' => 'Your file is not image'
                    ]
                ],  
            ];

            if ($this->validate($validation_rules)){
                $foto = $this->request->getFile('foto');
                $foto_name = $foto->getRandomName();
                // move photo
                $foto->move('assets/uploads/post', $foto_name);

                // atur slug
                $slug = url_title($this->request->getPost('judul'), '-', TRUE);

                $data = [
                    'idkategori'=> $this->request->getPost('idkategori'),
                    'idpenulis' => $this->request->getPost('idpenulis'),
                    'judul'    => $this->request->getPost('judul'),
                    'tgl_insert'  => $this->request->getPost('tgl_insert'),
                    'isi_post'  => $this->request->getPost('konten'),
                    'file_gambar'  => $foto_name,
                    'slug' => $slug
                ];

                $query = $this->post->addPost($data);
                if($query){
                    session()->setFlashdata('success', 'Your content has been posted');
                    return redirect()->to(base_url('penulis/my_post')); 
                } else{
                    session()->setFlashdata('failed', ' Ouchh.. Failed to post');
                    return redirect()->to(base_url('penulis/add_post'))->withInput();
                }
            } else{
                session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
                return redirect()->to(base_url('penulis/add_post'))->withInput(); 
            }
        } else{
            return redirect()->to(base_url('penulis'));
        }
    }

    public function editPost($id){
        if(session()->has('penulis')){
            $data = ['penulis' => $this->penulis->getDataPenulis(),
                     'kategori' => $this->kategori->getKategori(),
                     'validation' => \Config\Services::validation(),
                     'post' => $this->post->getPostJoinById($id)
            ];
            return view('penulis/edit_post', $data);
        } else{
            return redirect()->to(base_url('penulis'));
        }
    }

    public function updatePost(){
        if(session()->has('penulis')){
            $validation_rules = [
                'judul' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'label' => 'judul',
                ],  
                'konten' => [
                    'rules' => 'required',
                ],    
            ];

            if($this->request->getFile('foto') != ''){
                $validation_rules = [
                        'foto' => [
                        'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[foto]',
                        'label' => 'foto',
                        'errors' => [
                            'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                            'mime_in' => 'Your upload does not have a valid image format',
                            'is_image' => 'Your file is not image'
                        ]
                    ],  
                ];
            }

            if ($this->validate($validation_rules)){
                if($this->request->getFIle('foto')!=''){
                    $foto = $this->request->getFile('foto');
                    $foto_name = $foto->getRandomName();

                    // move photo
                    $foto->move('assets/uploads/post', $foto_name);
                    unlink('assets/uploads/post/'.$this->request->getPost('old_foto'));
                } else{
                    $foto_name = $this->request->getPost('old_foto');
                }
                
                // atur slug
                $slug = url_title($this->request->getPost('judul'), '-', TRUE);

                $data = [
                    'idkategori'=> $this->request->getPost('idkategori'),
                    'idpenulis' => $this->request->getPost('idpenulis'),
                    'judul'    => $this->request->getPost('judul'),
                    'tgl_update'  => $this->request->getPost('tgl_update'),
                    'isi_post'  => $this->request->getPost('konten'),
                    'file_gambar'  => $foto_name,
                    'slug' => $slug
                ];

                $id = $this->request->getPost('idpost');

                $query = $this->post->updatePost($data, $id);
                if($query){
                    session()->setFlashdata('success', 'Your content has been updated');
                    return redirect()->to(base_url('penulis/my_post')); 
                } else{
                    session()->setFlashdata('failed', ' Ouchh.. Failed to post');
                    return redirect()->to(base_url('penulis/edit_post'.'/'.$this->request->getPost('idpost')))->withInput();
                }
            } else{
                session()->setFlashdata('failed', ' Hmm.. sorry :( Your input is not valid');
                return redirect()->to(base_url('penulis/edit_post'.'/'.$this->request->getPost('idpost')))->withInput(); 
            }
        } else{
            return redirect()->to(base_url('penulis'));
        }
    }

    public function deletePost($id, $foto){
        unlink('assets/uploads/post/'.$foto);
        $query = $this->post->deletePost($id);
        if($query){
            session()->setFlashdata('success', 'Your post has been deleted');
            return redirect()->to(base_url('penulis/my_post')); 
        } else{
            session()->setFlashdata('failed', 'Failed to delete data');
            return redirect()->to(base_url('penulis/my_post')); 
        }
    }
}
?>