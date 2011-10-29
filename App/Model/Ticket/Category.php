<?php
namespace App\Model\Ticket;
class Category extends \App\Model\Application {

	protected $_table = 'ticket_category';
	protected $_primary = 'id';

	function __construct() {
		parent::__construct($this->_table, $this->_primary);
	}
}
