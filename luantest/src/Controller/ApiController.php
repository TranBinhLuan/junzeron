<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Api Controller
 *
 * @property \App\Model\Table\ApiTable $Api
 */
class ApiController extends AppController
{

    var $result_code = RESULT_CODE_ERROR;
	var $result_detail = array ();
	var $result_error = ERROR_PARAMS;
	var $dataJsonRequest = "";
	var $checkValidRequest = false;
	public $layout = 'mobilus';
	/**
	 * Using components
	 */
	public $components = array (
			'Mobilus',
		
	);
	/**
	 * ****************************BASE CONTROLLER ********************************
	 */
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
			$this->response->send ();
			$this->_stop ();
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
	 * Check validate
	 */
	protected function checkValidateRequestParams() {
		$this->checkValidRequest = true;
		if (! $this->request->is ( 'post' ) || ! is_array ( $this->request->data ) || count ( $this->request->data ) <= 0 || ! array_key_exists ( KEY_REQUEST_PARAMS, $this->request->data )) {
			$this->checkValidRequest = false;
		}
		if ($this->request->is ( 'post' ) && is_array ( $this->request->data ) && count ( $this->request->data ) > 0 && array_key_exists ( KEY_REQUEST_PARAMS, $this->request->data )) {
			if (is_string ( $this->request->data [KEY_REQUEST_PARAMS] )) {
				$this->dataJsonRequest = @json_decode ( urldecode ( $this->request->data [KEY_REQUEST_PARAMS] ), true );
				$this->checkValidRequest = ((json_last_error () === JSON_ERROR_NONE));
			}
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
	/**
	 * This method allow get information of file and upload file
	 *
	 * @param unknown $arrayNameFile        	
	 * @param unknown $dirUpload        	
	 */
	protected function getInformationAndUploadFile($arrayNameFile, $dirUpload, $time_now) {
		// get file information
		$allFilesUploaded = array ();
		if (! empty ( $this->request->form )) {
			foreach ( $arrayNameFile as $key => $value ) {
				if (array_key_exists ( $value, $this->request->form )) {
					// Add key and value for array
					$allFilesUploaded [$value] = $this->request->form [$value];
				}
			}
		}
		$countFile = count ( $allFilesUploaded );
		// upload file
		if ($countFile > 0) {
			foreach ( $allFilesUploaded as $key => $fileInfo ) {
				$image_file_error = $fileInfo ['error'];
				if ($image_file_error == 0) {
					clearstatcache ();
					$image_file_tmp_name = $fileInfo ['tmp_name'];
					$image_file_name = substr ( md5 ( microtime () ), 0, 28 ) . '_' . $fileInfo ['name'];
					$image_content_type = $fileInfo ['type'];
					$image_file_size = $fileInfo ['size'];
					// Image Resize 1024 to app/webroot/img
					$pathLarge = "img" . DIRECTORY_SEPARATOR . $image_file_name;
					$data_1024 = array (
							'input' => $image_file_tmp_name,
							'width' => 1024,
							'quality' => 100,
							'enlarge' => true,
							'height' => 1024,
							'output' => $pathLarge 
					);
					$this->MaippleImage->resize ( $data_1024 );
					$image_file_path = $this->Aws->uploadFile ( '/' . $dirUpload . '/' . $image_file_name, $image_content_type, $pathLarge );
					// Remove link from app/webroot/img
					if (file_exists ( $pathLarge )) {
						unlink ( $pathLarge );
					}
					$image_file_name_medium = '640_' . $image_file_name;
					$image_file_name_small = '240_' . $image_file_name;
					$pathMedium = "img" . DIRECTORY_SEPARATOR . $image_file_name_medium;
					$pathSmall = "img" . DIRECTORY_SEPARATOR . $image_file_name_small;
					
					// Image Resize 640 to app/webroot/img
					$data_640 = array (
							'input' => $image_file_tmp_name,
							'width' => 640,
							'quality' => 100,
							'enlarge' => true,
							'height' => 640,
							'output' => $pathMedium 
					);
					
					$this->MaippleImage->resize ( $data_640 );
					$image_file_path_medium = $this->Aws->uploadFile ( '/' . $dirUpload . '/' . $image_file_name_medium, $image_content_type, $pathMedium );
					// Remove link from app/webroot/img
					if (file_exists ( $pathMedium )) {
						unlink ( $pathMedium );
					}
					
					// Image Resize 240 to app/webroot/img
					$data_240 = array (
							'input' => $image_file_tmp_name,
							'quality' => 100,
							'width' => 240,
							'height' => 240,
							'enlarge' => true,
							'output' => $pathSmall 
					);
					
					$this->MaippleImage->resize ( $data_240 );
					$image_file_path_small = $this->Aws->uploadFile ( '/' . $dirUpload . '/' . $image_file_name_small, $image_content_type, $pathSmall );
					// Remove link from app/webroot/img
					if (file_exists ( $pathSmall )) {
						unlink ( $pathSmall );
					}
					
					if ($image_file_path != "" && $image_file_path_medium != "" && $image_file_path_small != "") {
						$arrayInforFile = array (
								"image_file_path" => $image_file_path,
								"image_file_path_medium" => $image_file_path_medium,
								"image_file_path_small" => $image_file_path_small,
								"image_content_type" => $image_content_type,
								"image_file_size" => $image_file_size,
								"image_updated_at" => $time_now 
						);
						// Return key and array file upload
						$this->uploadFileInformation [$key] = $arrayInforFile;
					}
				}
			}
		}
	}
	/**
	 * get Information File From Key
	 *
	 * @param unknown $key        	
	 * @return multitype:
	 */
	protected function getInformationFileFromKey($key) {
		if (array_key_exists ( $key, $this->uploadFileInformation )) {
			return $this->uploadFileInformation [$key];
		}
		return array ();
	}
	/**
	 * ******************************END****************************
	/**
	 * Api login app mobilus
	 * @param params={"email":"tran.binh.luan@gmail.com","password":"123456"}        	
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
		$this->loadModel ( 'Member' );
		$email = $this->getValueFromKeyRequestParams ( 'email' );
		//check email is exists
		$check_email = $this->Member->find('first',array(
				'conditions'=>array(
						'Member.email' => $email,
						'Member.delFlg'=>0
				),
				'recursive'=>-1
		));
		if(count($check_email) > 0){
			$passwordReal = md5($this->getValueFromKeyRequestParams ( 'password' ));
			// Password_salt;
			$password_salt = Configure::read ( "Security.salt" );
			//password
			$password = crypt ( $passwordReal, $password_salt );
			//check password
			$members = $this->Member->find('first',array(
					'conditions' => array (
							'Member.email' => $email,
							'Member.password' => $password,
							'Member.delFlg'=>0
					),
					'recursive'=>-1
			));
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
    
}
