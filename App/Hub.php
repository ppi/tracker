<?php

namespace App;

class Hub {

	/**
	 * The ClientID for the github app
	 *
	 * @var null
	 */
	protected $_githubClientID = null;

	/**
	 * The Secret Key for the github app
	 *
	 * @var null
	 */
	protected $_githubSecretKey = null;

	function __construct(array $options = array()) {

		if(isset($options['clientID'])) {
			$this->_githubClientID = $options['clientID'];
		}

		if(isset($options['secretKey'])) {
			$this->_githubSecretKey = $options['secretKey'];
		}

		$request = new PPI_Request();
		if( ($code = $request->getQuery('code')) !== null ) {
			$token = $this->getAccessToken($code);
			$user = $this->getUserInfo($token);
			$this->saveUser($user);

		} else {

			if(!$this->isAuthenticated()) {
				$this->authorize();
			}
		}

	}

	/**
	 * Is the user already authenticated in the hub
	 *
	 * @return bool
	 */
	function isAuthenticated() {

		$session = new PPI_Session();
		return $session->exists('ppi_hub_key');
	}

	/**
	 * Authorize the user
	 *
	 * @return void
	 */
	function authorize() {

			$url = 'https://github.com/login/oauth/authorize?' . http_build_query(array(
				'client_id'    => $this->_githubClientID,
				'redirect_uri' => 'http://localhost/ppi-issue-tracker'
			));
			header("Location: $url");
	}

	/**
	 * Get the access token for the user when sent back after authorize()
	 *
	 * @param string $code
	 * @return string
	 */
	function getAccessToken($code) {

		$url = 'https://github.com/login/oauth/access_token?';
		$req = array(
			'client_id'     => $this->_githubClientID,
			'client_secret' => $this->_githubSecretKey,
			'code'          => $code
		);
		$token = file_get_contents($url . http_build_query($req));
		return $token;
	}

	/**
	 * With our access token we can request the user info
	 *
	 * @param string $token
	 * @return array
	 */
	function getUserInfo($token) {

		$resp = file_get_contents('https://api.github.com/user?' . $token);
		$user = json_decode($resp);
		$user['token'] = $token;
		return $user;
	}

	/**
	 * Create a user account for the first time.
	 *
	 * @param array $user
	 * @return integer
	 */
	function saveUser($user) {

		$model = new APP_Model_User();
		return $model->insert(array(
			'github_id' => $user['id'],
			'raw' => serialize($user),
		));
	}

}