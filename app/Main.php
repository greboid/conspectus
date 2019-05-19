<?php

class Main {

	private $config = null;
	private $db = null;

	private function defaults() {
		$config['THEME'] = 'default';
		return $config;
	}

	public function __construct() {
		spl_autoload_register(array($this,'classLoader'));

		$this->loadConfig();
		$this->initDB();
	}

	private function classLoader($class) {
		$class = explode('\\', $class);
		require_once(BASE_DIR. '/app/'.array_pop($class).'.php');
	}
	
	private function loadConfig() {
		if (file_exists(BASE_DIR . '/config.php')) {
			require_once(BASE_DIR. '/config.php');
			$this->config = array_merge($this->defaults(), $config);
			//TODO check for required config entries
		} else {
			//TODO handle this nicer
			$this->fatalErr('no config');
		}
	}

	private function initDB() {
		$this->db = new MySQL($this->config['SQL_HOSTNAME'],
							$this->config['SQL_PORT'],
							$this->config['SQL_USERNAME'],
							$this->config['SQL_PASSWORD'],
							$this->config['SQL_DATABASE']
						);
		$db = $this->db;
		if (!is_object($db->getHandle())) {
			$this->fatalErr('invalid db creds');
		}

	}

	private function fatalErr($string) {
		//TODO make this theme stuff
		//TODO some kind of error codes so theme can do wording
		echo $string;
		die();
	}
	
	public function getDB() {
		return $this->db;
	}
	
}

?>