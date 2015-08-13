<?php
echo $this->Html->script('balance', array('inline' => false));
?>

<form class="form-inline" role="form" id="budget_calc">
  <div class="form-group">
    <label class="sr-only" for="curr_balance">Current Balance</label>
    <input type="text" class="form-control" id="curr_balance" placeholder="Enter Current Balance">
  </div>
  <button type="submit" class="btn btn-primary">Calculate</button>
</form>

<br /><br />

<div id="budget_calc_lines"><!-- Ajax data in here --></div>