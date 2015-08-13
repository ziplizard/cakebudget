<?php
echo '<h1>Add Budget Line</h1>';

echo $this->Form->create('Test', array('role'=>'form'));

echo $this->Form->input(
                    'budget_type',
                    array(
                        'options'=>array('debit'=>'Expense/Bill','credit'=>'Income'),
                        'default' => 'debit',
                        'label'=>'Type',
                        'class'=>'form-control',
                        'div' => 'form-group',
                    ));

echo $this->Form->input('budget_desc', array('label'=>'Description', 'class'=>'form-control', 'div'=>'form-group'));

echo $this->Form->input('budget_day', array('label'=>'Day', 'class'=>'form-control', 'div'=>'form-group'));

echo $this->Form->input('budget_amount', array('label'=>'Amount', 'class'=>'form-control', 'div'=>'form-group'));

echo $this->Form->end(array('label'=>'Save', 'class'=>'btn btn-primary', 'div' => 'form-group'));
