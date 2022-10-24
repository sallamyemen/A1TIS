<?php

namespace Libraries;
defined('_Sdef') or exit();

class AuthClass {
	
	public $driver;
	static public $instance;
	
	protected function __construct($driver) {
		$this->driver = $driver;
	}
	
	public static function getInstance($driver) {
		if(self::$instance instanceof self) {
			return self::$instance;
		}
		
		return new self($driver);
	}
	
	public function isUserLogin() {
		if(isset($_SESSION['sess']) && !empty($_SESSION['sess'])) {
			$sess = $_SESSION['sess'];
			
			$sql  = "SELECT `id`, `role`
					FROM ".PREF."users
					WHERE `sess` = '%s'
			";
			$sql = sprintf($sql,$this->driver->clear_db($sess));
			
			$row = $this->driver->query($sql);
			
			if(count($row) == 0 || count($row) > 1) {
				return FALSE;
			}
			
			return $row;

		}
		
		else {
			return FALSE;
		}
	}
}