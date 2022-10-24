<?php
namespace Controller;

defined('_Sdef') or exit();

class IndexController extends ADisplayController {
	
	protected $page;
	
	public function execute($param = array()) {
		
		$page = $param['page'];
		
		$this->page = $page ? $page : 1;
		
		return $this->display();
	}
	
	
	protected function display() {
		
		$items = $this->model->getItems($this->page);
		
		//$row = array();
		foreach($items['items'] as $item) {
			$item['images'] = json_decode($item['images']);
			$row[] = $item;
		}
		
		$items['items'] = $row;
		
		$this->title .= 'HOME';
		$this->keywords = 'Главная';
		$this->description = 'Главная страница';
		
		$this->mainbar = $this->app->view->fetch('indexbar.tpl.php',array(
												'items'=>$items['items'],
												'navigation'=>$items['navigation'],
												'app'=>$this->app,
												'uri'=>$this->uri
																));
		
		parent::display();
	}
	
	
}