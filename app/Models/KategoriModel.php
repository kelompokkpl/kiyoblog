<?php namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model{
	protected $table = "kategori";
	public function getKategori($id=false){
		if($id===false){
			$query = $this->db->query("SELECT * FROM kategori");
			$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT * FROM kategori WHERE idkategori='".$id."'");
			$results = $query->getRow();
		}
		return $results;
	}
	
	public function addKategori($data){
		$query = $this->db->table('kategori')->insert($data);
		return $query;
	}

	public function updateKategori($data, $id){
		$query = $this->db->table('kategori')->update($data, ['idkategori' => $id]);
		return $query;
	}
	
	public function deleteKategori($id){
		$query = $this->db->table('kategori')->delete(['idkategori' => $id]);
		return $query;
	}
}
?>