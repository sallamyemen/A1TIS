<?php

namespace Libraries;
defined('_Sdef') or exit();

class AuthMiddleware extends \Slim\Middleware {
	
	protected $config;
	
	public function __construct($settings = array(), \Libraries\Authclass $auth,\Libraries\Aclclass $acl) {
		$defaults = array(
						'routeName'=>'/admin'
						);
		
		$this->config = array_merge($defaults,$settings);
		
		$this->app = \Slim\Slim::getInstance();	
		$this->auth = $auth;
		$this->acl = $acl;
		
				
	}
	
	public function call() {
		
$this->app->hook('slim.before.dispatch',array($this,'onBeforeDispatch'));
		
		$this->next->call();
	}
	
	public function onBeforeDispatch() {
		
		$resource = $this->app->router->getCurrentRoute()->getPattern();
		
		//if($resource == $this->config['routeName'] ) {
			if(!$user = $this->auth->isUserLogin()) {
				$this->app->flash('error', 'Доступ запрещен');
            	$this->app->redirect($this->app->urlFor('login'));
			}
			
			//
	$this->acl->setAllow('admin','/admin(/:page)',array('GET','POST'));
	$this->acl->setAllow('admin','/admin/item/add',array('GET','POST'));
	$this->acl->setAllow('admin','/admin/item/edit/:id',array('GET','POST','DELETE'));
			//$this->acl->setAllow('admin','/admin/item/add',array('GET','POST'));
			//$this->acl->setAllow('user','/admin',array('GET'));
			
			///
			
if(!$this->acl->check($resource,$user[0]['role'],$this->app->request->getMethod())) {
				$this->app->flash('error', 'Нет прав доступа');
            	$this->app->redirect($this->app->urlFor('home'));
			}
			
		//}
		
		return TRUE;
	}
	
}