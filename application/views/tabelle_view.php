<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
    $('tr:first').css({'background-color': '#F0ffff',
                       'font-weight': 'bold'});
    $('tr:odd').css('background-color', '#f4f4f4');
});

</script>
{table}
<table cellspacing="2" cellpadding="5" width="100%">
    {row}
    <tr>
        {col}
        <td>
            {content}
        </td>
        {/col}
    </tr>
    {/row}
</table>
{/table}