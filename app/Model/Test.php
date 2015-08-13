<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Test extends AppModel
{
    public $name = 'Test';
    public $useTable = 'budget_lines';
    
    public $validate = array(
        'budget_amount' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Amount is Required.'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Please enter a valid Amount.'
            )
        ),
        'budget_desc' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Please enter a Description'
        ),
        'budget_day' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Please enter a valid Day'
        )
    );
    
    public function calcBalance($currBalance, $lineAmount, $type='debit')
    {
        $currBalance = str_replace(',','',$currBalance);
        $lineAmount = str_replace(',','',$lineAmount);
        
        switch($type)
        {
            case 'credit':
                $bal = $currBalance + $lineAmount;
                break;
            case 'debit':
            default:
                $bal = $currBalance - $lineAmount;
                break;
        }
        
        return number_format($bal, 2);
    }
}
