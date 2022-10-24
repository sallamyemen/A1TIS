<?php
namespace Controller;

defined('_Sdef') or exit();

class ContactsController extends ADisplayController {

	
	public function execute($param = array()) {
		
		return $this->display();
	}
	
	
	protected function display() {
		
		$this->title .= 'Контакты';
		$this->keywords = 'Контакты';
		$this->description = 'Контакты';
		
		$this->mainbar = $this->app->view->fetch('contacts.tpl.php',array(
																));
		
		parent::display();
	}
	
	
}