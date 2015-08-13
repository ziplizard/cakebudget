<div class="panel panel-default">
    <div class="panel-heading">Budget Lines <a href="/tests/add" class="label label-success pull-right">Add</a></div>
    <?php
    
    echo '<table class="table table-condensed">';
    echo '<tr><th>&nbsp;</th><th>Day</th><th>Description</th><th>Income</th><th>Expense/Bill</th></tr>';
    
    foreach ($rows as $row)
    {
        $l = $row['Test'];
        
        echo '<tr>';
        echo '<td><a href="/tests/edit/'.$l['id'].'" class="label label-primary" role="button">Edit</a></td>';
        echo '<td>'.$l['budget_day'].'</td>';
        echo '<td>'.$l['budget_desc'].'</td>';
        
        if ($l['budget_type'] == 'credit')
        {
            echo '<td class="td-credit">$'.$l['budget_amount'].'</td><td class="td-debit">&nbsp;</td>';
        }
        else
        {
            echo '<td class="td-credit">&nbsp;</td><td class="td-debit">$'.$l['budget_amount'].'</td>';
        }
        echo '</tr>';
    }
    
    echo '</table>';
    ?>
</div>