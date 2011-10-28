<?php
namespace App\Controller;
class Home extends Application {

	function index() {

		$this->addjs('home');
		$oTicket        = new \APP\Model\Ticket();
		$oTicketCat     = new APP\Model\Ticket\Category();
		$customRepos    = $this->getConfig()->repos->toArray();
		$repos          = array();
		
		foreach($customRepos as $key => $repo) {
			list($user, $repoName)      = explode(':', $repo, 2);
			$repos[$key]["repoName"]    = $repoName;
			$repos[$key]["user"]        = $user;
		}

		$this->addStylesheet('ticket-table.css');
		$this->load('home/index', compact('tickets', 'repos'));
	}

	function search() {
		
		if( ($keyword = $this->get('keyword', '')) == '') {
			$this->redirect('');
		}
		$oTicket = new \APP\Model\Ticket();
		$tickets = $oTicket->getTickets(compact('keyword'));
		$this->load('home/index', compact('tickets', 'keyword'));
	}
}
