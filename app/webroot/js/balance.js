
$(function(){
    $('#budget_calc').submit(function(){
        var bal = $('#curr_balance').val();
        if (bal.length && $.isNumeric(bal))
        {
            $.get( "/tests/calcLines", { 'curr_balance':bal }, function(data){
                $('#budget_calc_lines').html(data);
            });
        }
        else
        {
           $('#budget_calc_lines').html('');
        }
        
        return false;
     });
    
    $('#budget_calc_lines').on('click', '.strike-it', function(){
        
        if ($(this).is(':checked'))
        {
            $(this).closest('tr').addClass('strike');
        }
        else
        {
            $(this).closest('tr').removeClass('strike');
        }
        
        var bal = $('#curr_balance').val();
        var p = [];
        
        $('.strike-it:not(:checked)').each(function(){
            p.push($(this).val());
        });
        
        $.get( "/tests/calcLines", { 'curr_balance':bal, 'unstriked':p, 'checkit':'y' }, function(data){
            $('#budget_calc_lines').html(data);
        });
        
    });
});