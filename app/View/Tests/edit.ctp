<?php
echo '<h1>Edit Budget Line</h1>';

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

//echo $this->Form->input('budget_day', array('label'=>'Day', 'class'=>'form-control', 'div'=>'form-group'));
echo $this->Form->input(
                    'budget_day',
                    array(
                        'options'=>array_combine(range(1,31), range(1,31)),
                        'label'=>'Day',
                        'class'=>'form-control',
                        'div' => 'form-group',
                    ));

echo $this->Form->input('budget_amount', array('label'=>'Amount', 'class'=>'form-control', 'div'=>'form-group'));

//echo $this->Form->submit('Save', array('label'=>'Save', 'class'=>'btn btn-default btn-primary', 'div' => false));
echo $this->Form->button('Save', array('type'=>'submit', 'class'=>'btn btn-primary', 'div' => false));

//echo $this->Form->button('Cancel', array('class'=>'btn btn-default', 'type'=>'button', 'div'=>false));
echo '&nbsp;<a href="/tests/lines" class="btn btn-default"">Cancel</a>';

echo '&nbsp;<a href="/tests/delete/'.$id.'" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
