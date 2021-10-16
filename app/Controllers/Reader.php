<?php namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PostModel;
use CodeIgniter\Controller;
use App\Models\M_model;


class Reader extends Controller {		
	public function __construct() {
        $this->kategori = new KategoriModel();
        $this->penulis = new PenulisModel();
        $this->post = new PostModel();
		helper(['form','url']);
    }
    
    public function index(){
        $data = [
            'post' => $this->post->getPostHome(),
            'kategori' => $this->kategori->getKategori(),
            'recents' => $this->post->getPostRecent(4)
        ];

		return view('reader/index', $data);
    }

    public function viewPost($slug){
        $data = ['post' => $this->post->getDetailPost($slug),
                 'komentar' => $this->post->getKomentarBySlug($slug),
                 'kategori' => $this->kategori->getKategori(),
                 'validation' => \Config\Services::validation(),
                 'recents' => $this->post->getPostRecent(2)
        ];
        session()->set('url',$slug);
        return view('reader/detail_post', $data);
    }

    public function saveComment(){
        $data = array(
            'idpost' => $this->request->getPost('idpost'),
            'nama_pengirim' => $this->request->getPost('name'),
            'isi' => $this->request->getPost('comment'),
            'tgl' => date('Y-m-d h:i:s'),
        );
        
        $validation_rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[30]',
            ], 
            'comment' => [
                'rules' => 'required|min_length[5]|max_length[255]',
            ],  
        ];
        
        if ($this->validate($validation_rules)){
            $query = $this->post->addKomentar($data);
            if($query){
                return redirect()->to(base_url('article/'.session()->get('url')));
            }
        } else{
            return redirect()->to(base_url('article/'.session()->get('url')))->withInput(); 
        }
    }

    public function deleteComment(){
        $id = $this->request->getPost('id');
        return $this->post->deleteKomentar($id);
    }

    public function about(){
        $data = ['post' => $this->post->getDetailPost($slug),
                 'komentar' => $this->post->getKomentarBySlug($slug),
                 'kategori' => $this->kategori->getKategori(),
                 'validation' => \Config\Services::validation(),
        ];
        return view('reader/about',$data);
    }

    public function contact(){
        $data = ['post' => $this->post->getDetailPost($slug),
                 'komentar' => $this->post->getKomentarBySlug($slug),
                 'kategori' => $this->kategori->getKategori(),
                 'validation' => \Config\Services::validation(),
        ];
        return view('reader/contact',$data);
    }

    public function category($kat){
        $data = [
            'kategori' => $this->kategori->getKategori(),
            'post' => $this->post->getPostRecent(30, $kat),
            'recents' => $this->post->getPostRecent(4),
            'hots' => $this->post->getPostHome(),
        ];
        session()->set('kategori',$kat);

        return view('reader/category', $data);
    }

    public function writer($id){
        $data = [
            'kategori' => $this->kategori->getKategori(),
            'post' => $this->post->getPostByPen($id),
            'hots' => $this->post->getPostHome(),
            'penulis' => $this->penulis->getPenulis($id)
        ];
        $row = $this->penulis->getPenulis($id);
        session()->set('writer',$row->nama_penulis);

        return view('reader/writer', $data);
    }

    public function new(){
        $data = [
            'kategori' => $this->kategori->getKategori(),
            'post' => $this->post->getPostRecent(8),
            'hots' => $this->post->getPostHome(),
            'penulis' => $this->penulis->getPenulis($id)
        ];

        return view('reader/new', $data);
    }

    public function searchAjax(){
        $key = $this->request->getPost('key');
        $posts = $this->post->searchPost($key);

        $html = "";
        if($posts!= NULL){
            foreach ($posts as $post) {
               $html .= '<li><a href="'.base_url('article/'.$post->slug).'">'.ucfirst($post->judul).'</a></li>';
            }
        } else{
            $html = "<li>Sorry, not found</li>";
        }
        
        echo $html;
    }

}
?>