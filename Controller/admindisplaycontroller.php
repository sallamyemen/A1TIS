<?php
namespace Controller;

defined('_Sdef') or exit();

abstract class AdmindisplayController extends AController {
	
	protected function getMenu() {
		
		$pages = array(
						array('name'=>'Материалы','url'=>$this->app->urlFor('aitems')),
						array('name'=>'Категории','url'=>$this->app->urlFor('aitems')),
						array('name'=>'Страницы','url'=>$this->app->urlFor('aitems')),
						array('name'=>'Новости','url'=>$this->app->urlFor('aitems'))
						);
		
		
		return $this->app->view->fetch('admin_menu.tpl.php',array(
														'pages'=>$pages
														));
		
	}
	
	protected function getSidebar() {
		return FALSE;
	}
	
	protected function display() {
		$menu = $this->getMenu();
		$sidebar = $this->getSidebar();
		
		
		$this->app->render('admin_index.tpl.php',array(
												
											'uri'=>$this->uri,
											'menu'=>$menu,
											'sidebar'=>$sidebar,//fALSE
											'title'=>$this->title,
											//'keywords'=>$this->keywords,
											//'description'=>$this->description,
											'mainbar'=>$this->mainbar
										
												));
	}

}
	