<?php namespace App\Controllers;

use App\Models\ReqResetModel;
use App\Models\PenulisModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;


class ReqReset extends Controller {		
	public function __construct() {
        $this->admin = new AdminModel();
        $this->reset = new ReqResetModel();
        $this->penulis = new PenulisModel();
        $this->email = \Config\Services::email();
		helper(['form','url']);
    }
	
	// handle reset password penulis
	public function getRequest(){
		if(session()->has('admin')){
    		$data = ['request' => $this->reset->getRequest(), 
    				 'admin' => $this->admin->getDataAdmin(),
    				 'countReq' => $this->reset->countRequest()
    		];
			return view('admin/reset_penulis', $data);
    	} else{
			return redirect()->to(base_url('admin'));
		}
	}

	public function generatePass(){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$pass = substr(str_shuffle($chars), 0, 10);
		return $pass;
	}

	public function sendEmail($idreset, $email){
		// update password di database
		$new_pass = $this->generatePass();
		$pass = ['password' => md5($new_pass)];

		$this->email->setFrom('kiyoblog.system@gmail.com', 'Kiyoblog System');
		$this->email->setTo($email);

		$this->email->setSubject('Pemulihan Password Penulis Kiyoblog');
		$message = 'Kami telah menerima permintaan Anda untuk reset password akun penulis Kiyoblog. Akun Anda akan tetap aman. Ingat ya, <b>jangan tunjukkan email ini kepada siapapun</b> supaya akun Anda tetap terjamin keamanannya.<br><br>';
		$message .= 'Masuklah dengan akun: <br>';
		$message .= 'Email    : '.$email.'<br>';
		$message .= 'Password : '.$new_pass;
		$message .= '<br><br>Masuklah dengan password tersebut. <br><br><b>Kami menyarankan Anda untuk segera mengubah password Anda di pengaturan.</b><br><br>';
		$message .= '<br>Enjoy your writing! ^-^<br><br>';
		$message .= '<b>Kiyoblog Admin~</b>';

		$this->email->setMessage($message);

		if($this->email->send()){
			$query = $this->penulis->updatePassword($email, $pass);
			if($query){
				$status = ['status' => 'handled'];
				$query = $this->reset->updateStatus($idreset, $status);
				if($query){
					session()->setFlashdata('success', 'Password has been reset.');
					return redirect()->to(base_url('admin/reset_penulis'));
				} else{
					session()->setFlashdata('failed', 'Sorry, failed to reset password. Failed when update status in request list');
					return redirect()->to(base_url('admin/reset_penulis'));
				}
			} else{
				session()->setFlashdata('failed', 'Sorry, failed to reset password. Failed when update data with new password.');
				return redirect()->to(base_url('admin/reset_penulis'));
			}

		} else{
			session()->setFlashdata('failed', 'Sorry, failed to reset password. Failed when send email.');
			return redirect()->to(base_url('admin/reset_penulis'));
		}	
	}

	public function addRequest(){
		$data = ['email' => $this->request->getPost('email'),
				 'tgl' => $this->request->getPost('tgl'),
		];
		$query = $this->reset->addRequest($data);
		if($query){
			return redirect()->to(base_url('penulis/request_success')); 
		} else{
			session()->setFlashdata('failed', ' Ouchh.. Email is not registered.');
			return redirect()->to(base_url('penulis/forgot_password'))->withInput();
		}
	}

	public function delete($id){
		if(session()->has('admin')){
			$query = $this->reset->deleteRequest($id);
			if($query){
				session()->setFlashdata('success', 'Request has been delete.');
				return redirect()->to(base_url('admin/reset_penulis'));
			} else{
				session()->setFlashdata('failed', 'Sorry, failed to delete request.');
				return redirect()->to(base_url('admin/reset_penulis'));
			}
		}
	}
}
?>