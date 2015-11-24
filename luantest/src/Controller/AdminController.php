<?php
namespace App\Controller;
//namespace Cake\View\Helper;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Network\Session\DatabaseSession;
use Cake\View\Helper;
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
			$session = $this->request->session();
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
				$session->write('User', $users);
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
		$this->loadModel('Users');
		$session = $this->request->session();
		$data = $this->request->data['data'];
		$users = $this->Users->find('all')
		->where(['email' => $data['Users']['email']])
		->first();
		//print_r($users);exit;
		$user = $this->Users->newEntity();
		if(empty($users)){
			
			if ($this->Users->save($user)) {
				$this->redirect ( '/admin/admin_home' );
			} else {
				$this->redirect ( '/admin/admin_login' );
			}
		}else{
			
		}
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
