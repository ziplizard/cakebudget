<?php

//App::uses('Security', 'Utility');

class UsersController extends AppController
{
	public $components = array('Auth');
	
	/*
	public function beforeFilter()
	{
		$this->Security->requireSecure('login');
	}
	*/
	
    public function login()
	{
        if ($this->request->is('post') && !$this->Auth->login())
		{
			$this->Session->setFlash(__('Invalid username or password, try again'), 'flash');
        }
		
		return $this->redirect(array('controller' => 'tests', 'action' => 'balance'));
    }
	
    public function logout()
	{
        $this->Auth->logout();
        return $this->redirect(array('controller'=>'tests', 'action'=>'index'));
    }
}
