<?php
namespace Controller;

defined('_Sdef') or exit();

class PageController extends ADisplayController {
	
	
	public function execute($param = array()) {
		
		
		$this->alias = $param['alias'];
		
		return $this->display();
	}
	
	
	protected function display() {
		
		$page = $this->model->getPage($this->alias);
		
	
		
		$this->title .= $page[0]['title'];
		$this->keywords = $page[0]['keywords'];
		$this->description = $page[0]['description'];
		
		$this->mainbar = $this->app->view->fetch('page.tpl.php',array(
												'page'=>$page[0]
																));
		
		parent::display();
	}
	
	
}