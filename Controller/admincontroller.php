<?php

namespace Controller;
defined('_Sdef') or exit();

class AdminController extends AdmindisplayController {
	
	protected $page;
	
	protected function display($tmpl = FALSE) {
		
		$items = $this->model->getItems($this->page);
		
		$this->title .= 'Панель администратора';
		
		$this->mainbar = $this->app->view()->fetch('admin_indexbar.tpl.php',array(
																	'items'=>$items['items'],
																	'navigation'=>$items['navigation'],
																	'app'=>$this->app,
																	'uri'=>$this->uri
																			));
		
		parent::display($tmpl);
	}
	
	
	public function execute($param = array()) {
		
		$page = $param['page'];
		
		$this->page = $page ? $page : 1;
		
		return $this->display();
	}
}