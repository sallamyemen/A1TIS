<?php

namespace Controller;
defined('_Sdef') or exit();

class LoginController extends ADisplayController {
	
	
	public function display($tmpl = FALSE) {
		
		$this->title .= 'Авторизация';
		$this->keywords = 'Авторизация';
		$this->description = 'Авторизация';
		
		$template = ($tmpl == 'logout') ? 'logout.tpl.php' : 'login.tpl.php';
		
		$this->mainbar = $this->app->view()->fetch($template,array(
								'url' => $this->app->urlFor('login'),
								'title'=>$this->title,
								'uri' => $this->uri
														));
		parent::display($tmpl);
		
		
	}
	
	
	protected function login() {
		$post = $this->app->request->post();
		
		if(!empty($post)) {
			$login = $this->clear_str($post['name']);
			$password = $this->clear_str($post['password']);
			
			if(empty($login) || empty($password)) {
				$this->app->flash('error','Заполните обязательные поля');
				$this->app->redirect($this->app->urlFor('login'));
			}
			
			$password = md5($password);
			$result = $this->model->getUserLoginPass($login,$password);
			
			if(!$result) {
				$this->app->flash('error','Доступ запрещен');
				$this->app->redirect($this->app->urlFor('login'));
			}
			
			$sess = md5(microtime());
			
			if($this->model->userLogin($result[0]['id'],$sess)) {
				$_SESSION['sess'] = $sess;
				$this->app->flash('msg','Добро пожаловать');
				$this->app->redirect($this->app->urlFor('home'));
			}
			else {
				$this->app->flash('error','Ошибка');
				$this->app->redirect($this->app->urlFor('login'));
			}
			
		}
		
		$this->app->flash('error','Доступ запрещен');
		$this->app->redirect($this->app->urlFor('login'));
	}
	
	public function execute($param = array()) {
		
		if($this->app->request->isPost()) {
			if($this->app->request->post('logout')) {
				return $this->logout();
			}
			return $this->login();
		}
		
		//$auth = \Libraries\Authclass;
		if(FALSE) {
			$tmpl = 'logout';
		}
		else {
			$tmpl = 'login';
		}
		
		return $this->display($tmpl);
	}
}