<?php

namespace Controller;
defined('_Sdef') or exit();

class AitemaddController extends AdmindisplayController {
	
	protected $post;
	
	protected function display($tmpl = FALSE) {
		
		
		$this->title .= 'Новый материал';
		
		$categories = $this->model->getCategories();
		
		if($_SESSION['post']) {
			$post = $_SESSION['post'];
			unset($_SESSION['post']);
		}
		else {
			$post = array();
		}
		
		$this->mainbar = $this->app->view()->fetch('admin_itemadd.tpl.php',array(
														'categories'=>$categories,
														'url'=>$this->app->urlFor('aitem_add'),
														'post'=>$post,
														'title'=>$this->title
																			));
		
		parent::display($tmpl);
	}
	
	
	public function execute($param = array()) {
		
		$post = $this->app->request->post();
		
		if($this->app->request->isPost() && !empty($post)) {
			//save
			if(empty($post['title']) || empty($post['introtext'])) {
				$_SESSION['post'] = $post;
				$this->app->flash('error', 'Заполните обязательные поля');
            	$this->app->redirect($this->app->urlFor('aitem_add'));
			}
			$result = $this->model->save(FALSE,$post);
			if($result !== TRUE) {
				$_SESSION['post'] = $post;
				$this->app->flash('error', $result);
            	$this->app->redirect($this->app->urlFor('aitem_add'));
			}
			$this->app->flash('msg', 'Запись добавлена');
            $this->app->redirect($this->app->urlFor('aitems'));
		}
		
		return $this->display();
	}
}