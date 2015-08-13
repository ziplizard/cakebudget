<?php

class User extends AppModel
{
    // Validate data enetered by user
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'A password is required'
            )
        )
    );
}
 