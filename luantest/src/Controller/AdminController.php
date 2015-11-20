<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Network\Session\DatabaseSession;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class AdminController extends AppController
{
	
	public $layout = 'bootstrap_admin';
	
	public function admin_login(){
		$this->layout = 'admin_login';
		if ($this->request->is('post')) {
			$data = $this->request->data['data'];
			$passwordReal = md5($data['User']['password']);
			$passwordSalt = md5(PASSWORD_SALT);
			$password = crypt($passwordSalt, $passwordReal);
			
			$this->loadModel('Users');
			//find user
			$users = $this->Users->find('all')
			->where(['email' => $data['User']['email'],'password'=>$password])
			->first();
			if(empty($users)){
				
			}else{
				$this->request->session()->write('User', $users);
				$this->redirect ( '/admin/admin_home' );
			}
		}
	}
	public function admin_logout() {
		$this->request->session()->delete ( 'User' );
		$this->redirect ( '/admin/admin_login' );
	}
	public function admin_home(){
		$this->loadModel('Users');
		//$this->request->session()->delete ( 'User' );
		//$this->User->find('all');
	}
	public function admin_register(){
		
	}
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

  
}
