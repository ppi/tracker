<?php
class APP_Model_Ticket_Category extends APP_Model_Application {

	protected $_table = 'ticket_category';
	protected $_primary = 'id';

	function __construct() {
		parent::__construct($this->_table, $this->_primary);
	}
}
