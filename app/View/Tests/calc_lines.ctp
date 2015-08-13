<div class="panel panel-default">
    <div class="panel-heading"><?php echo date('F'); ?> Balance</div>
    <div class="panel-body">
        <p>You may check/uncheck lines to include/exclude items from calculation.</p>
    </div>
    <?php
    
    echo '<table class="table table-condensed">';
    echo '<tr><th>#</th><th>Day</th><th>Description</th><th>Credit(+)</th><th>Debit(-)</th><th>Balance</th></tr>';
    
    $i=1;
    foreach ($rows as $row)
    {
        $check = ($row['class'] == 'strike') ? ' checked' : ''; 
        
        $rowData = 'data-date="'.$row['date'].'" data-desc="'.$row['desc'].'" data-type="'.$row['type'].'" data-amount="'.$row['amount'].'"';
        
        echo '<tr class="'.$row['class'].'" '.$rowData.'>';
        echo '<td><input type="checkbox" class="strike-it" value="'.$row['id'].'"'.$check.'></td>';
        echo '<td>'.$row['date'].'</td>';
        echo '<td>'.$row['desc'].'</td>';
        
        if ($row['type'] == 'credit')
        {
            echo '<td class="td-credit">$'.$row['amount'].'</td><td class="td-debit">&nbsp;</td>';
        }
        else
        {
            echo '<td class="td-credit">&nbsp;</td><td class="td-debit">$'.$row['amount'].'</td>';
        }
        
        echo '<td class="td-balance">$'.$row['balance'].'</td>';
        echo '</tr>';
        
        $i++;
        $bal = $row['balance'];
    }
    
    echo '<td colspan="5">&nbsp;</td><td class="td-balance final">$'.$bal.'</td>';
    
    echo '</table>';
    ?>
</div>