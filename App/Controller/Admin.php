<?php

namespace App\Controller;
use PPI\Core\CoreException;

class Admin extends Application {

	private $name = null;

	function preDispatch() {

		// Admins only viewing this screen
		$this->adminLoginCheck();

		$this->addJavascript('admin-common.js');
		$this->addStylesheet('leftmenu.css');

		if(!$this->isAdminLoggedIn()) {
			throw new PPI_Exception('Cheatin\' eh ?');
		}

	}

	function index() {
		 $this->loadSmarty('admin/dashboard', array(
			'leftMenu' => true,
			'pageTitle' => 'Admin Dashboard'
		));
	}

	/**
	 * AdminController::user()
	 * Main method that chooses the appropriate method to handle the page request
	 * @return void
	 */
	function user() {

		$sMode = $this->oInput->get('user');
		switch($sMode) {
			case 'create':
			case 'edit':
				$this->userAddEdit($sMode);
				break;

			case 'delete':
				$this->userDelete();
				break;

			case 'view':
				$this->userView();
				break;

			case 'list':
			default:
				$this->userList();
				break;
		}

	}

	function emailtemplate() {

		$sMode = $this->oInput->get('emailtemplate');
		switch($sMode) {
			case 'create':
			case 'edit':
				$this->etAddEdit($sMode);
				break;

			case 'delete':
				$this->etDelete();
				break;

			case 'view':
				$this->etView();
				break;

			case 'list':
			default:
				$this->etList();
				break;
		}

	}

	function emaillog() {


		$sMode = $this->oInput->get('emaillog');
		switch($sMode) {

			case 'delete':
				$this->elDelete();
				break;

			case 'view':
				$this->elView();
				break;

			case 'list':
			default:
				$this->elList();
				break;
		}

	}

	/**
	 * AdminController::userList()
	 * List all the users
	 * @return void
	 */
	private function etList() {
		$oEmail = new \PPI\Model\Email\Template();
		$this->loadSmarty('admin/et_list', array(
			'emails'    => $oEmail->getList(),
			'leftMenu'  => true,
			'pageTitle' => 'Email Templates'
		));
	}


	/**
	 * AdminController::userAddEdit()
	 * Add or Edit a user
	 * @return void
	 */
	private function etAddEdit($p_sMode = 'create') {
		$oEmail    = new \PPI\Model\Email\Template();
		$bEdit     = ($p_sMode == 'edit');
		$oForm     = new \PPI\Model\Form();
		$checkCode = false;
		$iEmailID  = $this->oInput->get($p_sMode, 0);
		$oForm->init('admin_emailtemplate_addedit');
		$oForm->setFormStructure($oEmail->getAddEditFormStructure($p_sMode));
		if($oForm->isSubmitted() && $oForm->isValidated()) {
			$aSubmitValues = $oForm->getSubmitValues();
			// Edit mode to set the primary key so that it performs an update
			if($bEdit && $iEmailID > 0) {
				$aSubmitValues[$oEmail->getPrimaryKey()] = $iEmailID;
			}
			// We're in add mode lets make sure this code doesn't already exist
			if(!$bEdit) {
				if( count($oEmail->getRecord('code = ' . $oEmail->quote($aSubmitValues['code']))) > 0) {
					$oForm->setElementError('code', 'That code already exists');
				}

			// We're in edit mode, but we still need to see if they have changed the 'code'
			} else {
				// Grab the existing DB info
				if( count($aEmail = $oEmail->getRecord('id = ' . $iEmailID)) > 0) {
					// Compare The DB info against the submitted into.
					// If they're different then we need to make sure this doesn't exist elsewhere.
					if($aEmail['code'] != $aSubmitValues['code']) {
						// Lets see if this modified code exists elsewhere.
						if(count($aExistingEmail = $oEmail->getRecord('code = ' . $oEmail->quote($aSubmitValues['code']))) > 0) {
							$oForm->setElementError('code', 'That code already exists');
						}
					}
				}
			}

			if($oForm->isValidated()) {
				// Put the record (insert/update)
				$oEmail->putRecord($aSubmitValues);
				$this->_setFlashMessage('Email template successfully ' . ($bEdit ? 'updated' : 'created') . '.');
				$this->_redirect('admin/emailtemplate/list');
			}
		}

		if($bEdit === true) {
			if( ($iEmailID = $this->oInput->get('edit', 0)) < 1) {
				throw new CoreException('Invalid Template ID: ' . $iEmailID);
			}
			// Set the defaults here
			$oForm->setDefaults($oEmail->find($iEmailID));
		}
		$aViewVars     = array(
			'bEdit'       => $bEdit,
			'formBuilder' => $oForm->getRenderInformation(),  // FB Infos
			'leftMenu'    => true
		);
		$this->loadSmarty('admin/et_addedit', $aViewVars);

	}

	/**
	 * AdminController::userView()
	 * View a specific user
	 * @return void
	 */
	private function etView() {
		if(($iEmailID = $this->oInput->get('view')) != '') {
			$oEmail = new \PPI\Model\Email\Template();
			$this->loadSmarty('admin/et_view', array(
				'email'      => $oEmail->find($iEmailID),
				'leftMenu'  => true,
				'pageTitle' => 'Edit Email Template'
			));
		}
	}


	/**
	 * AdminController::userDelete()
	 * Delete a user
	 * @return void
	 */
	private function etDelete() {
		if( ($iEmailID = $this->oInput->get('delete', 0)) < 1) {
			throw new CoreException('Invalid User ID: ' . $iEmailID);
		}

		$oEmail = new \PPI\Model\Email\Template();
		$oEmail->delete($iEmailID);
		$this->_setFlashMessage('Email template successfully deleted.');
		$this->_redirect('admin/emailtemplate/list');
	}


	/**
	 * AdminController::config()
	 * @todo Look into array_walk_recusrive to convert arrays to strings
	 * List all the users
	 * @return void
	 */
	function config() {

		$aConfig = $this->getConfig()->toArray();
		// Override to filer the results
		if( ($configKey = $this->oInput->get('config', '')) !== '' && array_key_exists($configKey, $aConfig)) {
			foreach($aConfig as $key => $val) {
				if($key !== $configKey) {
					unset($aConfig[$key]);
					continue;
				}
				foreach($aConfig[$key] as $subkey => $value) {
					if(is_array($value) && is_array($value[min(array_keys($value))])) {
						$aConfig[$key][$subkey] = implode(', ', $value[min(array_keys($value))]);
					}
				}
			}
		} else {
			foreach($aConfig as $key => $val) {

				foreach($aConfig[$key] as $subkey => $value) {
					if(is_array($value) && is_array($value[min(array_keys($value))])) {
						$aConfig[$key][$subkey] = implode(', ', $value[min(array_keys($value))]);
					}
				}

			}
		}

		$this->loadSmarty('admin/config_list', array(
			'aConfig'   => $aConfig,
			'leftMenu'  => true,
			'pageTitle' => 'Configuration'
		));
	}



	private function elDelete() {
		if( ($iLogID = $this->oInput->get('delete', 0)) < 1) {
			throw new CoreException('Invalid Log ID: ' . $iLogID);
		}
		$oLog = new PPI_Model_Shared('ppi_email_log', 'id');
		$oLog->delete($iLogID);
		$this->_setFlashMessage('Log item successfully deleted.');
		$this->_redirect('admin/emaillog');
	}

	private function elView() {

		if( ($iLogID = $this->oInput->get('view', 0)) < 1) {
			throw new CoreException('Invalid Log ID: ' . $iLogID);
		}
		$oLog = new PPI_Model_Shared('ppi_email_log', 'id');
		$this->loadSmarty('admin/emaillog_view.tpl', array(
			'log'      => $oLog->find($iLogID),
			'leftMenu'  => true,
			'pageTitle' => 'View User'
		));
	}

	private function elList() {

		$oLog = new PPI_Model_Log();
		$logs = $oLog->getEmailLogs();

		$this->loadSmarty('admin/emaillog_list', array(
			'logs'   => $logs,
			'leftMenu'  => true,
			'pageTitle' => 'Configuration'
		));

	}

	/**
	 * AdminController::userView()
	 * View a specific user
	 * @return void
	 */
	private function userView() {
		if(($iUserID = $this->oInput->get('view')) != '') {
			$oUser = new APP_Model_User();
			$user = $oUser->find($iUserID);
			$user['role_name'] = getRoleNameFromID($user['role_id']);
			$this->loadSmarty('admin/user_view.tpl', array(
				'user'      => $user,
				'leftMenu'  => true,
				'pageTitle' => 'View User'
			));
		}
	}




	/**
	 * AdminController::userList()
	 * List all the users
	 * @return void
	 */
	private function userList() {
		$oUser = new APP_Model_User();

		if( ($iSchoolID = $this->oInput->get('schoolid', 0)) < 1 ) {
			throw new CoreException('Missing School ID');
		}

		$users = $oUser->getList('school_id = ' . $iSchoolID)->fetchAll();
		// If there was a filter applied but returned no results, we default the userlist back to normal
		foreach($users as $key => $user) {
			$users[$key]['role_name'] = ucwords(str_replace('_', ' ', getRoleNameFromID($user['role_id'])));
		}
		$this->addStylesheet(array('demo_table_jui.css', 'jquery-ui-1.7.2.custom.css'));
		$this->addJavascript('jquery.dataTables.js');
		$this->load('admin/user_list', array(
			'schoolID'      => $iSchoolID,
			'users'         => $users,
			'navItems'      => array('Add Staff' => 'admin/user/create/schoolid/' . $iSchoolID),
			'pageTitle'     => 'Users',
			'usernameField' => $this->getConfig()->system->usernameField
		));
	}


	/**
	 * AdminController::userAddEdit()
	 * Add or Edit a user
	 * @return void
	 */
	private function userAddEdit($p_sMode = 'create') {

		if( ($iSchoolID = $this->oInput->get('schoolid', 0)) < 1) {
			throw new CoreException('Invalid School ID: ' . $iSchoolID);
		}

		$bEdit = ($p_sMode == 'edit');
		$oUser = new \APP\Model\User();
		$oForm = new \PPI\Model\Form();
		$oForm->init('admin_user_addedit');
		//$oForm->setTinyMCE(true);
		$oForm->setFormStructure($oUser->getAdminAddEditFormStructure($p_sMode));
		if($oForm->isSubmitted() && $oForm->isValidated()) {
			$aSubmitValues = $oForm->getSubmitValues();
			// Setting the school ID when we insert the user
			if(!$bEdit) {
				$aSubmitValues['school_id'] = $iSchoolID;
			}
			// Edit mode to set the primary key so that it performs an update
			if($bEdit && ($iUserID = $this->oInput->get($p_sMode)) > 0) {
				$aSubmitValues[$oUser->getPrimaryKey()] = $iUserID;
			}
			// Put the record (insert/update)
			$oUser->putRecord($aSubmitValues);
			$this->_setFlashMessage('User account successfully ' . ($bEdit ? 'updated' : 'created') . '.');
			$this->_redirect('admin/user/list/schoolid/' . $iSchoolID);
		} else {
			if($bEdit === true) {
				if( ($iUserID = $this->oInput->get('edit', 0)) < 1) {
					throw new CoreException('Invalid User ID: ' . $iUserID);
				}
				// Set the defaults here
				$oForm->setDefaults($oUser->find($iUserID));
			}
			$aViewVars 	= array(
				'bEdit'       => $bEdit,
				'formBuilder' => $oForm->getRenderInformation(),  // FB Infos
				'leftMenu'    => true
			);
			$this->loadSmarty('admin/user_addedit', $aViewVars);
		}

	}



	/**
	 * AdminController::userDelete()
	 * Delete a user
	 * @return void
	 */
	private function userDelete() {
		if( ($iUserID = $this->oInput->get('delete', 0)) < 1) {
			throw new CoreException('Invalid User ID: ' . $iUserID);
		}

		if( ($iSchoolID = $this->oInput->get('schoolid', 0)) < 1) {
			throw new CoreException('Invalid School ID: ' . $iSchoolID);
		}

		$oUser = new APP_Model_User();
		$oUser->delete($iUserID);
		$oDept = new APP_Model_School_Department();
		$oDept->delRecord('user_id', $iUserID);
		$this->setFlashMessage('User successfully deleted.');
		$this->redirect('admin/user/list/schoolid/' . $iSchoolID);
	}

	function ticket() {
		$sMode = $this->oInput->get('ticket');
		switch($sMode) {
			case 'create':
			case 'edit':
				$this->ticketAddEdit($sMode);
				break;

			case 'delete':
				$this->ticketDelete();
				break;

			case 'view':
				$this->ticketView();
				break;

			case 'list':
			default:
				$this->ticketList();
				break;
		}
	}
	private function ticketDelete() {
		if( ($iTicketID = $this->get('delete', '')) < 1) {
			throw new CoreException('Invalid Ticket ID: ' . $iTicketID);
		}
		$aTicketIDs = explode(',', $iTicketID);
		$oTicket = new APP_Model_Ticket();
		foreach($aTicketIDs as $ticketID) {
			$oTicket->delete($ticketID);
		}
		$this->setFlashMessage('Ticket successfully deleted.');
		$this->redirect('admin/ticket');
	}
	/**
	* AdminController::userList()
	* List all the users
	* @return void
	*/
	private function ticketList() {
		$oTicket = new \APP\Model\Ticket();

		$aParams = array();
		if( ($sSearchKeyword = $this->post('keyword', '')) != '') {
			$aParams['keyword'] = $sSearchKeyword;
		}


		$tickets = $oTicket->getTickets($aParams);

		$this->load('admin/ticket_list', array(
			'tickets'    => $tickets,
			'leftMenu'  => true,
			'pageTitle' => 'Tickets'
		));
	}

	/**
	 * AdminController::userView()
	 * View a specific user
	 * @return void
	 */
	private function ticketView() {
		$oTicket = new \APP\Model\Ticket();
		if(($iTicketID = $this->oInput->get('view')) != '') {
			$ticket = $oTicket->select()
						->columns('t.*, u.first_name user_fn, u.last_name user_ln, uu.first_name user_assigned_fn, uu.last_name user_assigned_ln')
						->from($oTicket->getTableName() . ' t')
						->leftJoin('users u', 't.user_id=u.id')
						->leftJoin('users uu', 't.assigned_user_id=uu.id')
						->where('t.id = ' . $oTicket->quote($iTicketID))
						->order('created desc')
						->getList();

			if($ticket->countRows() == 0) {
				throw new CoreException('Ticket does not exist.');
			}
			$this->load('admin/ticket_view', array(
				'ticket'    => $ticket->fetch(),
				'leftMenu'  => true,
				'pageTitle' => 'View Ticket'
			));
		}
	}

	/**
	 *
	 * @param string $p_sMode The Mode (Create or Edit)
	 * @return void
	 */
	private function ticketAddEdit($p_sMode = 'create') {

		$bEdit = ($p_sMode == 'edit');
		$oTicket = new \APP\Model\Ticket();
		$oForm = new \PPI\Model\Form();

		$oForm->init('admin_ticket_addedit');
		$oForm->setFormStructure($oTicket->getAdminAddEditFormStructure($p_sMode));
		if($oForm->isSubmitted() && $oForm->isValidated()) {
			$aSubmitValues = $oForm->getSubmitValues();
			if(!$bEdit) {
				$aSubmitValues['user_id'] = $this->getAuthData(false)->id;
				$aSubmitValues['created'] = time();
			}
			// Edit mode to set the primary key so that it performs an update
			if($bEdit && ($iTicketID = $this->oInput->get($p_sMode)) > 0) {
				$aSubmitValues[$oTicket->getPrimaryKey()] = $iTicketID;
			}
			// Put the record (insert/update)
			$oTicket->putRecord($aSubmitValues);
			$this->setFlashMessage('Ticket successfully ' . ($bEdit ? 'updated' : 'created') . '.');
			$this->redirect('admin/ticket');
		} else {
			if($bEdit === true) {
				if( ($iTicketID = $this->oInput->get('edit', 0)) < 1) {
					throw new CoreException('Invalid User ID: ' . $iTicketID);
				}
				// Set the defaults here
				$oForm->setDefaults($oTicket->find($iTicketID));
			}
			$aViewVars 	= array(
				'bEdit'       => $bEdit,
				'formBuilder' => $oForm->getRenderInformation(),  // FB Infos
				'leftMenu'    => true
			);
			$this->load('admin/ticket_addedit', $aViewVars);
		}

	}
}