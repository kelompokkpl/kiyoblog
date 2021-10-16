<?php namespace App\Models;

use CodeIgniter\Model;

class PostRestModel extends Model{
	protected $table = "post";
	protected $primaryKey = "idpost";
	protected $allowedFields = ['idpost','idkategori','idpenulis','judul','tgl_insert','tgl_update','isi_post','slug'];
	
	public function getPostJoin($kat=false){
	    if($kat===false){
			$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis ORDER BY post.tgl_insert DESC");
				$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idkategori='".$kat."' ORDER BY post.tgl_insert DESC");
				$results = $query->getResult();	
		}
		return $results;
	}

	public function getPostJoinById($id){
		$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idpost='".$id."'");
		$results = $query->getRow();	
		return $results;
	}

	public function getComments($id){
		$query = $this->db->query("SELECT * FROM komentar WHERE idpost='".$id."'");
		$results = $query->getResult();	
		return $results;
	}

	public function getPostRecent(){
		$query = $this->db->query("SELECT p.*, kategori.nama_kategori, penulis.nama_penulis, penulis.email, 
		penulis.foto FROM post p JOIN kategori ON kategori.idkategori = p.idkategori
		JOIN penulis ON penulis.idpenulis = p.idpenulis WHERE p.tgl_insert  >= COALESCE ((
		SELECT pp.tgl_insert FROM post pp WHERE pp.idpenulis= p.idpenulis 
		ORDER BY pp.tgl_insert DESC LIMIT 1,1 ), p.tgl_insert) ORDER BY p.tgl_insert DESC");
		$results = $query->getResult();	
		return $results;
	}


	public function getDetail($id){
		$query = $this->db->query("SELECT *, post.idpost, COUNT(komentar.idkomentar) as frekuensi FROM post LEFT JOIN komentar ON post.idpost = komentar.idpost JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idpost='".$id."'");
		$results = $query->getRow();	
		return $results;
	}

	public function searchPost($keyword){
		$query = $this->db->query("SELECT * FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis JOIN kategori ON post.idkategori=kategori.idkategori WHERE post.judul LIKE '%".$keyword."%' OR penulis.nama_penulis LIKE '%".$keyword."%' OR kategori.nama_kategori LIKE '%".$keyword."%' ORDER BY post.tgl_insert DESC");
		$results = $query->getResult();	
		return $results;
	}
}
?>