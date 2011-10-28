<?php
namespace App\Controller;

class User extends Application {

	function __construct() {

		parent::__construct();
		$this->oSession     = $this->getSession();
		$this->oForm        = new \PPI\Model\Form();
		$this->oUser        = new \APP\Model\User();
		$this->authData     = $this->oSession->getAuthData();
	}

	function index() {
		$this->redirect('user/home');
	}

	function profile() {
		$iUserID = (int) $this->_input->get('id', 0);
		if($iUserID < 1) {
			throw new CoreException('No UserID Found. No profile information to display.');
		}
		// quote your inputs using PPI_Model->quote()
		$aUserInfo = $this->oUser->getList('id = '.$this->oUser->quote($iUserID));
		if(count($aUserInfo) < 1) {
			throw new CoreException('Unable to obtain profile information');
		}
		$aViewVars['aUserInfo'] = $aUserInfo[0];
		//$		aViewVars['aLanguages'] = $this->oUser->getUserLanguages($iUserID);
		$aViewVars['aLanguages'] = array();
		$this->load('user/profile', $aViewVars);
	}

	function dashboard() {
		$this->load('user/dashboard');
	}

	function home() {
		$this->load('user/home');
	}

	function login() {
		parent::login();
	}

	
	function postLoginRedirect() {
		switch($this->getAuthData(false)->role_name) {
			case 'member':
				$this->redirect('home');	
				break;
				
			case 'administrator':
			case 'developer':
				$this->redirect('admin/ticket');
				break;
		}
		
	}
	
	
	function register() {
		parent::register();
	}

	function recover() {
		parent::recover();
	}

	function logout() {
		$this->oUser->logout();
		$this->redirect('');
	}
}