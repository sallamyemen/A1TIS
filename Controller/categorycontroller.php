<?php
namespace Controller;

defined('_Sdef') or exit();

class CategoryController extends ADisplayController {
	
	protected $page;
	
	public function execute($param = array()) {
		
		$page = $param['page'];
		
		$this->page = $page ? $page : 1;
		$this->alias = $param['alias'];
		
		if(empty($this->alias)) {
			exit();
		}
		
		return $this->display();
	}
	
	
	protected function display() {
		
		$items = $this->model->getItems($this->page,$this->alias);
		
		$category = $this->model->getCategory($this->alias);
		
		//$row = array();
		foreach($items['items'] as $item) {
			$item['images'] = json_decode($item['images']);
			$row[] = $item;
		}
		
		$items['items'] = $row;
		
		$this->title .= $category[0]['name'];
		$this->keywords = $category[0]['name'];
		$this->description = $category[0]['name'];
		
		$this->mainbar = $this->app->view->fetch('indexbar.tpl.php',array(
												'items'=>$items['items'],
												'navigation'=>$items['navigation'],
												'app'=>$this->app,
												'uri'=>$this->uri
																));
		
		parent::display();
	}
	
	
}