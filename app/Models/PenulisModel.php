<?php namespace App\Models;

use CodeIgniter\Model;

class PenulisModel extends Model{
	public function getPenulis($id=false){
		if($id===false){
			$query = $this->db->query("SELECT * FROM penulis");
			$results = $query->getResult(); // mengembalikan semua nilai hasil query dalam bentuk object
		} else{
			$query = $this->db->query("SELECT * FROM penulis WHERE idpenulis='".$id."'");
			$results = $query->getRow();
		}
		return $results;
	}
	
	public function addPenulis($data){
		// cek apakah email sudah terdaftar
		$query = $this->db->table('penulis')->where('email',$data['email']);
		if($query->countAllResults()>0){ //kalo sudah ada email yang sama
			return false;
		} else{ // aman aja, jadi lanjut insert ke table
			$query = $this->db->table('penulis')->insert($data);
			return $query;
		}
	}

	// autentikasi login penulis
	public function loginPenulis($data){
		$query = $this->db->query("SELECT * FROM penulis WHERE email='".$data['email']."' AND password='".$data['password']."'");
		$row = $query->getRow();
		if(!isset($row)){ //ngga nemu email dan pw di db
			return false;
		} else{ //berhasil login
			$row = $query->getRow(0);
			$data = ['penulis' => true,
					 'email_penulis' => $data['email'],
					 'idpenulis' => $row->idpenulis
					];
			session()->set($data);
			return true;
		}
	}

	public function getDataPenulis(){
		$query = $this->db->query("SELECT * FROM penulis WHERE email='".session('email_penulis')."'");
		$row = $query->getRow(0); //mengembalikan baris ke 0 saja
		return $row;
	}

	public function getDataPenulisByEmail($email){
		$query = $this->db->query("SELECT * FROM penulis WHERE email='".$email."'");
		$row = $query->getRow(0); //mengembalikan baris ke 0 saja
		return $row;
	}

	public function updatePenulis($data, $id){
		$query = $this->db->table('penulis')->update($data, ['idpenulis' => $id]);
		return $query;
	}

	public function updatePassword($email, $pass){
		$query = $this->db->table('penulis')->update($pass, ['email' => $email]);
		return $query;
	}
	
	public function logoutPenulis(){
		session()->remove(['penulis','email_penulis','idpenulis']);
		return true;
	}
}
?>