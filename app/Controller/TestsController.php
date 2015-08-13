<?php
/**
 * Static content controller.
 *
 * This file will render views from views/tests/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TestsController extends AppController
{
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout = 'bootstrap';
	}
	
	public function index()
	{
		if ($this->Auth->user())
		{
			return $this->redirect(array('action' => 'balance'));
		}
	}
	
	public function balance()
	{
		$this->render();
	}
	
	public function lines()
	{
		$this->set('rows', $this->Test->find('all', array('order'=>'budget_day')));
	}
	
	public function add()
	{
		if ($this->request->is('post'))
		{
            $this->Test->create();
			
            if ($this->Test->save($this->request->data))
			{
                $this->Session->setFlash('Your Budget Line has been saved.', 'flash');
                return $this->redirect(array('action' => 'lines'));
            }
			
            $this->Session->setFlash('Unable to add your Budget Line.', 'flash');
        }
	}
	
	public function edit($id = NULL)
	{
		if (!$id)
		{
			throw new NotFoundException(__('Invalid Line'));
		}
		
		$line = $this->Test->findById($id);
		
		if (!$line)
		{
			throw new NotFoundException(__('Invalid Line'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			$this->Test->id = $id;
			
			if ($this->Test->save($this->request->data))
			{
				$this->Session->setFlash(__('Line has been updated.'), 'flash');
				$this->redirect(array('action' => 'lines'));
			}
			else
			{
				$this->Session->setFlash(__('Unable to update Line.'), 'flash');
			}
		}
		
		if (!$this->request->data)
		{
			$this->request->data = $line;
		}
		
		$this->set('id', $id);
	}
	
	public function delete($id)
	{
		if ($this->Test->delete($id))
		{
			$this->Session->setFlash(__('The Budget Line(%s) has been deleted.', $id), 'flash');
			$this->redirect(array('action' => 'lines'));
		}
	}
	
	public function calcLines()
	{
		$this->layout = 'ajax';
		
		if (isset($_GET['curr_balance']))
		{
			$bal = $_GET['curr_balance'];
			$rows = array();
			
			$m = date('n');
			$d = date('j');
			$y = date('Y');
			$today = mktime(0,0,0,$m,$d,$y);
			
			$checkit = 'n';
			$unstrike = array();
			if (isset($_GET['checkit']))
			{
				$checkit = $_GET['checkit'];
				$unstrike = isset($_GET['unstriked']) ? $_GET['unstriked'] : array();
			}
			
			$lines = $this->Test->find('all', array('order' => 'budget_day'));
			
			foreach ($lines as $line)
			{
				$l = $line['Test'];
				
				$stamp = mktime(0,0,0,$m,$l['budget_day'],$y);
				
				$class = '';
				
				if ($checkit == 'y')
				{
					if (in_array($l['id'], $unstrike))
					{
						$bal = $this->Test->calcBalance($bal, $l['budget_amount'], $l['budget_type']);
					}
					else
					{
						$class = 'strike';
					}
				}
				else
				{
					if ($stamp > $today)
					{
						$bal = $this->Test->calcBalance($bal, $l['budget_amount'], $l['budget_type']);
					}
					else
					{
						$class = 'strike';
					}
				}
				
				$rows[] = array(
						'id' => $l['id'],
						'class' => $class,
						'date' => date('jS', $stamp),
						'desc' => $l['budget_desc'],
						'type' => $l['budget_type'],
						'amount' => $l['budget_amount'],
						'balance' => $bal
					);
			}
			
			$this->set('rows', $rows);
			
			$this->render();
		}
	}
}
