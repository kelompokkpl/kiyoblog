<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model{
	public function getPostt($id=false){
		if($id===false){
			$query = $this->db->query("SELECT * FROM post");
			$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT * FROM post WHERE idpost='".$id."'");
			$results = $query->getRow();
		}
		return $results;
	}

	public function getPostJoin($kat=false){
		if($kat===false){
			$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis");
				$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idkategori='".$kat."'");
				$results = $query->getResult();	
		}
		
		return $results;
	}

	public function getPostJoinById($id){
		$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idpost='".$id."'");
		$results = $query->getRow();	
		return $results;
	}

	public function getPostJoinByPenulis($id){
		$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idpenulis='".$id."'");
		$results = $query->getResult();	
		return $results;
	}

	public function getPostJoinByCatPenulis($id, $kat){
		$query = $this->db->query("SELECT * FROM post JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.idpenulis='".$id."' AND post.idkategori='".$kat."'");
		$results = $query->getResult();	
		return $results;
	}

	public function getCountPostPerCat(){
		$query = $this->db->query("SELECT kategori.idkategori, nama_kategori, COUNT(post.idkategori) AS frekuensi FROM kategori LEFT JOIN post ON kategori.idkategori = post.idkategori GROUP BY kategori.idkategori ORDER BY kategori.idkategori");
		$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		return $results;
	}

	public function getCountPostPerCatByPen($id){
		$query = $this->db->query("SELECT kategori.idkategori, nama_kategori, COUNT(post.idkategori) AS frekuensi FROM kategori LEFT JOIN post ON kategori.idkategori = post.idkategori WHERE post.idpenulis = '".$id."' GROUP BY kategori.idkategori ORDER BY kategori.idkategori");
		$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		return $results;
	}

	public function getKomentar($id){
		$query = $this->db->query("SELECT * FROM komentar WHERE idpost='".$id."'");
		$results = $query->getResult();	
		return $results;
	}

	public function getKomentarBySlug($slug){
		$query = $this->db->query("SELECT * FROM komentar JOIN post ON komentar.idpost=post.idpost WHERE post.slug='".$slug."'");
		$results = $query->getResult();	
		return $results;
	}

	public function addKomentar($data){
		$query = $this->db->table('komentar')->insert($data);
		return $query;
	}

	public function deleteKomentar($id){
		$query = $this->db->table('komentar')->delete(['idkomentar' => $id]);
		return $query;
	}

	public function getPostRecent($limit, $kat=false){
		if($kat===false){
			$query = $this->db->query("SELECT *, COUNT(komentar.idkomentar) AS frekuensi FROM post LEFT JOIN komentar ON post.idpost = komentar.idpost JOIN penulis ON penulis.idpenulis = post.idpenulis JOIN kategori ON kategori.idkategori = post.idkategori GROUP BY post.idpost ORDER BY post.idpost DESC LIMIT ".$limit."");
				$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT *, COUNT(komentar.idkomentar) AS frekuensi FROM post LEFT JOIN komentar ON post.idpost = komentar.idpost JOIN penulis ON penulis.idpenulis = post.idpenulis JOIN kategori ON kategori.idkategori = post.idkategori WHERE nama_kategori='".$kat."' GROUP BY post.idpost ORDER BY post.idpost DESC LIMIT ".$limit."");
				$results = $query->getResult();	
		}
		return $results;
	}

	public function getPostHome(){
		$query = $this->db->query("SELECT *, COUNT(komentar.idkomentar) AS frekuensi FROM post LEFT JOIN komentar ON post.idpost = komentar.idpost JOIN penulis ON penulis.idpenulis = post.idpenulis JOIN kategori ON kategori.idkategori = post.idkategori GROUP BY post.idpost ORDER BY frekuensi DESC LIMIT 4");
				$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		return $results;
	}

	public function getPostByPen($id){
		$query = $this->db->query("SELECT *, COUNT(komentar.idkomentar) AS frekuensi FROM post LEFT JOIN komentar ON post.idpost = komentar.idpost JOIN penulis ON penulis.idpenulis = post.idpenulis JOIN kategori ON kategori.idkategori = post.idkategori WHERE post.idpenulis='".$id."' GROUP BY post.idpost ORDER BY post.idpost");
		$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		return $results;
	}

	public function getDetailPost($slug){
		$query = $this->db->query("SELECT *, post.idpost, COUNT(komentar.idkomentar) as frekuensi FROM post LEFT JOIN komentar ON post.idpost = komentar.idpost JOIN kategori ON kategori.idkategori = post.idkategori JOIN penulis ON penulis.idpenulis = post.idpenulis WHERE post.slug='".$slug."'");
		$results = $query->getRow();	
		return $results;
	}

	public function addPost($data){
		$query = $this->db->table('post')->insert($data);
		return $query;
	}

	public function updatePost($data, $id){
		$query = $this->db->table('post')->update($data, ['idpost' => $id]);
		return $query;
	}
	
	public function deletePost($id){
		$query = $this->db->table('post')->delete(['idpost' => $id]);
		return $query;
	}

	public function searchPost($keyword){
		$query = $this->db->query("SELECT * FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis JOIN kategori ON post.idkategori=kategori.idkategori WHERE post.judul LIKE '%".$keyword."%' OR penulis.nama_penulis LIKE '%".$keyword."%' OR kategori.nama_kategori LIKE '%".$keyword."%'");
		$results = $query->getResult();	
		return $results;
	}

	public function countCatByPen($id){
		$query = $this->db->query("SELECT * FROM penulis JOIN post ON post.idpenulis=penulis.idpenulis JOIN kategori ON post.idkategori=kategori.idkategori WHERE post.idpenulis='".$id."' GROUP BY kategori.idkategori");
		$results = $query->getResult();	
		return $results;
	}

	public function countComByPen($id){
		$query = $this->db->query("SELECT * FROM penulis JOIN post ON post.idpenulis=penulis.idpenulis JOIN komentar ON post.idpost=komentar.idpost WHERE post.idpenulis='".$id."'");
		$results = $query->getResult();	
		return $results;
	}
}
?>