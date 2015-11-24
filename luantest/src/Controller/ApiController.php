<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
/**
 * Api Controller
 *
 * @property \App\Model\Table\ApiTable $Api
 */
class ApiController extends AppController
{
	var $result_code = RESULT_CODE_ERROR;
	var $result_detail = array();
	var $result_error = PARAMS_ERROR;
	var $checkValidaterequest = false;
	var $dataJsonRequest = "";
	var $layout = 'test';
	
	public $components = array('Test');
	
	/**
	 * The Second run
	 * Overwrite beforeRender
	 * Return response is json type
	 */
	public function beforeRender() {
		parent::beforeRender ();
		$this->response->type ( 'json' );
		// Add hock if check validdate error
		if (! $this->checkValidRequest) {
			$this->response->body ( json_encode ( array (
					'result_code' => $this->result_code,
					'result_detail' => $this->result_detail,
					'result_error' => $this->result_error
			) ) );
			return $this->response;
			$this->_stop();
		}
	}
	/**
	 * (non-PHPdoc)
	 * The First Run
	 *
	 * @see Controller::beforeFilter() @overwrite
	 *      always render layout and set default value
	 */
	public function beforeFilter() {
		parent::beforeFilter ();
		// First always check validate request params from client
		$this->checkValidateRequestParams ();
		$this->set ( array (
				'result_code' => $this->result_code,
				'result_detail' => $this->result_detail,
				'result_error' => $this->result_error
		) );
		$this->render ( 'rest_client' );
	}
	/**
	 * (non-PHPdoc)
	 * The third run
	 *
	 * @see Controller::afterFilter() @overwrite
	 *      afterFilter run when action of controller is finished, afterFilter set again value and render again
	 */
	public function afterFilter() {
		parent::afterFilter ();
		$this->set ( array (
				'result_code' => $this->result_code,
				'result_detail' => $this->result_detail,
				'result_error' => $this->result_error
		) );
		$this->render ( 'rest_client' );
	}
	/**
	 * ****************************BASE CONTROLLER ********************************
	 */
	protected function checkValidateRequestParams(){
		$this->checkValidaterequest = true;
		if(!$this->request->is('post') || !is_array($this->request->data) || count($this->request->data)<=0 || !array_key_exists(KEY_REQUEST_PARAMS, $this->request->data)){
			$this->checkValidaterequest=false;
		}
		if($this->request->is('post') || is_array($this->request->data) || count($this->request->data)>0 || array_key_exists(KEY_REQUEST_PARAMS, $this->request->data)){
			$this->dataJsonRequest = json_decode ( urldecode ( $this->request->data [KEY_REQUEST_PARAMS] ), true );
			$this->checkValidaterequest = ((json_last_error() === JSON_ERROR_NONE));
		}
	}
	/**
	 * Check require fields for each action
	 *
	 * @param unknown $arrayIn
	 */
	protected function validateRequireRequestParams($arrayRequire) {
		$strError = "";
		foreach ( $arrayRequire as $key => $value ) {
			// Check validate key not exist in array
			if (! array_key_exists ( $value, $this->dataJsonRequest )) {
				$strError .= "The field " . $value . " is not exist \n";
			}
			// Check validate if value is empty
			if (array_key_exists ( $value, $this->dataJsonRequest )) {
				$value_tpm = $this->dataJsonRequest [$value];
				if (is_array ( $value_tpm )) {
					if (count ( $value_tpm ) == 0) {
						$strError .= "The array value of field " . $value . " is empty \n";
					}
				} else {
					if (strlen ( trim ( $value_tpm ) ) == 0) {
						$strError .= "The value of field " . $value . " is empty \n";
					}
				}
			}
		}
		$this->result_error = $strError;
		return $strError;
	}
	/**
	 * Check key from request params is exists
	 *
	 * @param unknown $key
	 * @return boolean
	 */
	protected function checkKeyRequestParamsExists($key) {
		$boolean = false;
		if (array_key_exists ( $key, $this->dataJsonRequest )) {
			$boolean = true;
		}
		return $boolean;
	}
	/**
	 * get value from request params with in put key
	 *
	 * @param unknown $key
	 * @return string
	 */
	protected function getValueFromKeyRequestParams($key) {
		return $this->dataJsonRequest [$key];
	}
	//=====================================================================//
	/**
	 * Api login app 
	 * @param params={"email":"luantran@gmail.com.vn","password":"12345678"}
	 * @return json
	 * @property $Member
	 */
	public function user_login_email(){
		// Check validate require field
		/**
		* require email, pasword
		*/
		$strError = $this->validateRequireRequestParams ( array (
				'email',
				'password'
		) );
		if (! empty ( $strError )) {
			return;
		}
		$this->loadModel('Users');
		$email = $this->getValueFromKeyRequestParams ( 'email' );
		//find user
		$check_email = $this->Users->find('all')
		->where(['email' => $email])
		->first();
		
		if(count($check_email) > 0){
			$passwordReal = md5($this->getValueFromKeyRequestParams ( 'password' ));
			// Password_salt;
			$passwordSalt = md5(PASSWORD_SALT);
			$password = crypt($passwordSalt, $passwordReal);
			//check password
			
			$members = $this->Users->find('all')
			->where(['email' => $email,'password'=>$password])
			->first();
			if (count ( $members ) > 0) {
				$this->result_code = RESULT_CODE_SUCCESS;
				$this->result_detail = array (
						$members
				);
				$this->result_error = "";
			} else {
				$this->result_code = RESULT_PASSWORD_ERROR;
				$this->result_error = ERROR_PASSWORD;
			}
		}else{
			$this->result_code = RESULT_EMAIL_ERROR;
			$this->result_error = ERROR_EMAIL;
		}
	}
	/**
	 * Api register app 
	 * @param params={"email":"luantran@gmail.com.vn","password":"12345678"}
	 * @return json
	 * @property $Member
	 */
	public function user_register_email(){
		$strError = $this->validateRequireRequestParams ( array (
				'email',
				'password',
				'username'
		) );
		if (! empty ( $strError )) {
			return;
		}
		//load model users
		$this->loadModel('Users');
		$email = $this->getValueFromKeyRequestParams ( 'email' );
		//check email exists
		$check_email = $this->Users->find('all')
		->where(['email' => $email])
		->first();
		
		if(count($check_email)>0){
			$this->result_code = RESULT_CODE_ERROR;
			$this->result_error = MSG_EMAIL_EXISTS;
			return;
		}else{
			//password
			$passwordReal = md5($this->getValueFromKeyRequestParams ( 'password' ));
			// Password_salt;
			$passwordSalt = md5(PASSWORD_SALT);
			$password = crypt($passwordSalt, $passwordReal);
			$timenow = $this->Test->getTimeNowWithGMT();
			//echo $timenow;exit;
			$users = $this->Users->newEntity();
			$data = array(
					'email' => $email,
					'password' => $password,
					'password_salt' => $passwordSalt,
					'created_at'=>$timenow
			);
			$users = $this->Users->patchEntity($users, $data);
			if ($this->Users->save($users)) {
				$this->result_code = RESULT_CODE_SUCCESS;
				$lastInsertId = $users->id ;
				$this->result_detail = array (
						$this->Users->get($lastInsertId)
				);
				$this->result_error = "";
			}else{
				$this->result_code = 9;
				$this->result_error = SAVE_DATA_ERROR;
			}
		}
	}
	
	
	
	
}
