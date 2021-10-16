<?php namespace App\Models;

use CodeIgniter\Model;

class ReqResetModel extends Model{
	public function getRequest($id=false){
		if($id===false){
			$query = $this->db->query("SELECT * FROM request_reset JOIN penulis ON request_reset.idpenulis = penulis.idpenulis ORDER BY request_reset.tgl DESC");
			$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT * FROM request_reset JOIN penulis ON request_reset.idpenulis = penulis.idpenulis WHERE idrequest='".$id."'");
			$results = $query->getRow();
		}
		return $results;
	}

	public function updateStatus($id, $status){
		$query = $this->db->table('request_reset')->update($status, ['idrequest' => $id]);
		return $query;
	}

	public function addRequest($data){
		// cek apakah email sudah terdaftar
		$query = $this->db->query("SELECT idpenulis FROM penulis WHERE email='".$data['email']."'");
		$results = $query->getRow();
		if($results->idpenulis != ''){ //kalo email sudah terdaftar
			$dataa = ['idpenulis' => $results->idpenulis,
					  'tgl' => $data['tgl']
			];
			$query = $this->db->table('request_reset')->insert($dataa);
			return $query;
		} else{ 
			return false;
		}
	}
	
	public function deleteRequest($id){
		$query = $this->db->table('request_reset')->delete(['idrequest' => $id]);
		return $query;
	}

	public function countRequest(){
		$query = $this->db->query("SELECT COUNT(*) as count FROM request_reset WHERE status='request'");
		$results = $query->getRow();
		return $results;
	}

}
?>