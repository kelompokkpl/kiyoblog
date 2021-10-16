<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model {

	// memasukkan data registrasi admin
	public function addAdmin($data){
		// cek apakah email sudah terdaftar
		$query = $this->db->table('admin')->where('email',$data['email']);
		if($query->countAllResults()>0){ //kalo sudah ada email yang sama
			return false;
		} else{ // aman aja, jadi lanjut insert ke table
			$query = $this->db->table('admin')->insert($data);
			return $query;
		}
		
	}

	// autentikasi login admin
	public function loginAdmin($data){
		$query = $this->db->query("SELECT * FROM admin WHERE email='".$data['email']."' AND password='".$data['password']."'");
		$row = $query->getRow();
		if(!isset($row)){ //ngga nemu email dan pw di db
			return false;
		} else{ //berhasil login
			$row = $query->getRow(0);
			$data = ['admin' => true,
					 'email_admin' => $data['email']
					];
			session()->set($data);
			return true;
		}
	}

	public function getDataAdmin(){
		$query = $this->db->query("SELECT * FROM admin WHERE email='".session('email_admin')."'");
		$row = $query->getRow(0); //mengembalikan baris ke 0 saja
		return $row;
	}

	public function updateAdmin($data,$id){
		$query = $this->db->table('admin')->update($data, ['idadmin' => $id]);
		if($query){
			return true;
		} else{
			return false;
		}
	}

	public function logoutAdmin(){
		session()->remove(['admin','email_admin']);
		return true;
	}

}
?>