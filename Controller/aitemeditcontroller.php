<?php

namespace Controller;
defined('_Sdef') or exit();

class AitemeditController extends AdmindisplayController {
	
	protected $post;
	protected $id;
	
	protected function display($tmpl = FALSE) {
		
		$categories = $this->model->getCategories();
		
		if($this->id) {
			
			$result = $this->model->getItemForEdit($this->id);
			$post = $result[0];
			$post['images'] = json_decode($post['images']);
		}
		else {
			$this->app->flash('error', 'Что то не так');
            $this->app->redirect($this->app->urlFor('aitems'));
		}
		
		
		$this->title .= 'Редaктирование материала - '.$post['title'];
		
		
		$this->mainbar = $this->app->view()->fetch('admin_itemadd.tpl.php',array(
														'categories'=>$categories,
									'url'=>$this->app->urlFor('aitem_edit',array('id'=>$this->id)),
														'post'=>$post,
														'title'=>$this->title,
														'uri'=>$this->uri
																			));
		
		parent::display($tmpl);
	}
	
	
	public function execute($param = array()) {
		
		$post = $this->app->request->post();
		
		$this->id = $post['id'] ? $post['id'] : $param['id'];
		if(empty($this->id)) {
			$this->app->flash('error', 'Что то не так');
            $this->app->redirect($this->app->urlFor('aitems'));
		}
		
		if($this->app->request->isDelete()) {
			//delete
			
			$result = $this->model->deleteItem($this->id);
			if($result) {
				$this->app->flash('msg', 'Запись удалена');
            	$this->app->redirect($this->app->urlFor('aitems'));
			}
		}
		
		if($this->app->request->isPost() && !empty($post)) {
			//edit
			if(empty($post['title']) || empty($post['introtext'])) {
				$_SESSION['post'] = $post;
				$this->app->flash('error', 'Заполните обязательные поля');
            	$this->app->redirect($this->app->urlFor('aitem_add'));
			}
			
			$result = $this->model->save($this->id,$post);//add  edit
			if($result !== TRUE) {
				$_SESSION['post'] = $post;
				$this->app->flash('error', $result);
            	$this->app->redirect($this->app->urlFor('aitem_add'));
			}
			$this->app->flash('msg', 'Запись изменена');
            $this->app->redirect($this->app->urlFor('aitems'));
			
		}
		
		return $this->display();
	}
}