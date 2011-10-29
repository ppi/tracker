<?php
namespace App\Model;
use PPI\Core;
class Ticket extends \PPI\Model {

	protected $_table = 'ticket';
	protected $_primary = 'id';

	function __construct() {
		parent::__construct($this->_table, $this->_primary);
	}

	function getAddEditFormStructure($p_sMode = 'create', array $p_aOptions = array()) {
	$structure = array(
		'fields' => array(
		'title'                 => array('type' => 'text', 'label' => 'Title', 'size' => 60),
		'category_id'           => array('type' => 'dropdown', 'label' => 'Category', 'options' => array()),
		'ticket_type'           => array('type' => 'dropdown', 'label' => 'Type', 'options' => array()),
		'severity'              => array('type' => 'dropdown', 'label' => 'Severity', 'options' => array()),
		'status'                => array('type' => 'dropdown', 'label' => 'Status', 'options' => array()),
		'version'               => array('type' => 'dropdown', 'label' => 'Version', 'options' => array()),
		'assigned_user_id'      => array('type' => 'dropdown', 'label' => 'Assign', 'options' => array()),
		'content'               => array('type' => 'textarea', 'label' => 'Description', 'rows' => 10, 'cols' => 40),
		'submit'                => array('type' => 'submit', 'label' => '', 'value' => 'Create Ticket'),
		),
		'rules' => array(
			'title'   => array('type' => 'required', 'message' => 'Title cannot be blank'),
			'content' => array('type' => 'required', 'message' => 'You must enter a description')
		)
	);

		if(isset($p_aOptions['isAdmin']) && $p_aOptions['isAdmin'] === false) {
			unset($structure['fields']['assigned_user_id']);
			unset($structure['fields']['severity']);
			unset($structure['fields']['status']);
			unset($structure['fields']['version']);
		} else {
			$structure['fields']['severity']['options']         = array('minor' => 'minor','major' => 'major','critical' => 'critical');
			$structure['fields']['status']['options']           = array('open' => 'open', 'assigned' => 'assigned', 'closed' => 'closed');
			$oUser                                              = new APP_Model_User();
			$oTicket                                            = new APP_Model_Ticket();
			$structure['fields']['version']['options']          = $this->convertGetListToDropdown($oTicket->getVersionsForFormStructure(), 'version');
			$structure['fields']['assigned_user_id']['options'] = $this->convertGetListToDropdown($oUser->getList(), array('first_name', ' ', 'last_name'));
		}

		$oTicketCat = new APP_Model_Ticket_Category();
		$structure['fields']['ticket_type']['options']          = array('feature_request' => 'Feature request','bug' => 'Bug', 'enhancement' => 'Enhancement');
		$structure['fields']['category_id']['options']          = $this->convertGetListToDropdown($oTicketCat->getList(), 'title');

		return $structure;
	}

	function getTickets(array $params = array()) {

		$cache = Core::getCache();
		$cacheName = 'tickets' . md5(serialize($params));

		if($cache->exists($cacheName)) {
			return $cache->get($cacheName);
		}

		$github  = new \Github_Client();
		$tickets = array();

		foreach($this->getConfig()->custom->labels as $label) {
			try {
				$tmpIssues = $github->getIssueApi()->searchLabel($params["username"], $params['repo'], $label);
				foreach($tmpIssues as $tmpIssue) {
					$tickets[] = $tmpIssue;
				}
			} catch(\Github_HttpClient_Exception $e) {
			}
		}

		foreach($tickets as $key => $ticket) {

			$ticket['id']            = $ticket['number'];
			$ticket['status']        = $ticket['state'];
			$ticket['ticket_type']   = !empty($ticket['labels']) ? ucfirst(strtolower($ticket['labels'][0])) : 'Unknown';
			$ticket['severity']      = 'major';
			$user                    = $github->getUserApi()->show($ticket['user']);
			$ticket['user_fullname'] = $user['name'];
			$ticket['username']      = $user['login'];

			if (extension_loaded('sundown')) {
				$sundown = new \Sundown($ticket['body'], array(
					"filter_html"       => true,
					"no_image"          => true,
					"no_links"          => true,
					"filter_styles"     => true,
					"safelink"          => true,
					"generate_toc"      => true,
					"hard_wrap"         => true,
					"gh_blockcode"      => true,
					"xhtml"             => true,
					"autolink"          => true,
					"no_intraemphasis"  => true,
					"tables"            => true,
					"fenced_code"       => true,
					"strikethrough"     => true,
					"lax_htmlblock"     => true,
					"space_header"      => true
				));
				$ticket['body'] = $sundown->to_html();
			}

			$tickets[$key] = $ticket;
		}

		$cache->set($cacheName, $tickets, 300);

		return $tickets;
	}

	function getTicket(array $p_aParams = array()) {

		$cacheName = 'tickets' . md5(serialize($p_aParams));
		$cache     = Core::getCache();
		if($cache->exists($cacheName)) {
			return $cache->get($cacheName);
		}

		$github = new \Github_Client();
		$ticket = $github->getIssueApi()->show($p_aParams["username"], $p_aParams['repo'], $p_aParams['id']);

		$ticket['id']          = $ticket['number'];
		$ticket['status']      = $ticket['state'];
		$ticket['ticket_type'] = 'bug';
		$ticket['severity']    = 'major';
		$ticket['created']     = date('F j, Y, g:i a', strtotime($ticket['created_at']));

		if (extension_loaded('sundown')) {
			$sundown = new \Sundown($ticket['body'], array(
				"filter_html"       => true,
				"no_image"          => true,
				"no_links"          => true,
				"filter_styles"     => true,
				"safelink"          => true,
				"generate_toc"      => true,
				"hard_wrap"         => true,
				"gh_blockcode"      => true,
				"xhtml"             => true,
				"autolink"          => true,
				"no_intraemphasis"  => true,
				"tables"            => true,
				"fenced_code"       => true,
				"strikethrough"     => true,
				"lax_htmlblock"     => true,
				"space_header"      => true
			));

			$ticket['content']  = $sundown->to_html();
		} else {
			$ticket['content']  = $ticket['body'];
		}

		$user                    = $github->getUserApi()->show($ticket['user']);
		$ticket['username']      = $user['login'];
		$ticket['user_fullname'] = isset($user['name']) ? $user['name'] : $user['login'];
		$ticket['repo_name']     = $p_aParams['repo'];

		$cache->set($cacheName, $ticket, 300);

		return $ticket;
	}

	function getVersionsForFormStructure() {
		return $this->select()
		->columns('id, version')
		->from($this->_table)
		->order('version')
		->group('version')
		->getList();
	}
}