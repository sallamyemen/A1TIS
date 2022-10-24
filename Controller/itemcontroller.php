<?php
namespace Controller;

defined('_Sdef') or exit();

class ItemController extends ADisplayController {
	
	
	public function execute($param = array()) {
		
		
		$this->alias = $param['alias'];
		
		return $this->display();
	}
	
	
	protected function display() {
		
		$item = $this->model->getItem($this->alias);
		
		
		$this->title .= $item[0]['title'];
		$this->keywords = $item[0]['keywords'];
		$this->description = $item[0]['description'];
		
		$this->mainbar = $this->app->view->fetch('item.tpl.php',array(
												'item'=>$item[0],
												'app'=>$this->app
																));
		
		parent::display();
	}
	
	
}