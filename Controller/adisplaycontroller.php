<?php
namespace Controller;

defined('_Sdef') or exit();

abstract class ADisplayController extends AController {
	
	protected function getMenu() {
		
		
		$pages = $this->model->getPages();
		
		$menu = array();
		
		$home = array('title'=>'Home','url'=>$this->app->urlFor('home'));
		array_push($menu,$home);
		
		foreach($pages as $page) {
$p = array('title'=>$page['title'],'url'=>$this->app->urlFor('page',array('alias'=>$page['alias'])));
		array_push($menu,$p);
		}
		
		$contacts = array('title'=>'Contacts','url'=>$this->app->urlFor('contacts'));
		array_push($menu,$contacts);
		
		foreach($menu as $k=>$m) {
			//
			if($this->app->request->getPath() == $m['url']) {
				$menu[$k]['active'] = TRUE;
			}
		}
		
		
		return $this->app->view->fetch('menu.tpl.php',array(
														'pages'=>$menu,
														'app'=>$this->app
														));
		
	}
	
	protected function getSidebar() {
		$categories = $this->model->getCategories();
		$news = $this->model->getNews();
		
		return $this->app->view->fetch('sidebar.tpl.php',array(
													'categories'=>$categories,
													'news'=>$news,
													'app'=>$this->app,
													'uri'=>$this->uri
													));
		
	}
	
	protected function display() {
		$menu = $this->getMenu();
		$sidebar = $this->getSidebar();
		
		
		$this->app->render('index.tpl.php',array(
												
											'uri'=>$this->uri,
											'menu'=>$menu,
											'sidebar'=>$sidebar,
											'title'=>$this->title,
											'keywords'=>$this->keywords,
											'description'=>$this->description,
											'mainbar'=>$this->mainbar
										
												));
	}

}
	