$(document).on('click', '#appbundle_rubrics_save', function(e){
    e.preventDefault();

    var newRubric = $('#appbundle_rubrics_name').val();
    if ( newRubric ) {
        $.post( saveRubricsUrl, {newRubricName: newRubric}, function(e){
            if ( e.msg != 'exists' ) {
                var clone = $('#tableRowTemplate').clone();
                $('#rubrics tbody').append(clone.html());
                $('#rubrics tbody').find('tr:last .rName').text(e.msg);
                $('#rubrics tbody').find('tr:last').attr('id', e.id);
                $('#rubrics tbody').find('tr:last .btn').each(function(){
                    $(this).attr('data-id', e.id);
                });
            } else {
                $('#error').append('Рубрика с таким названием существует');
                $('#error').slideDown().delay(5000).slideUp();
            }
        }, 'json' );
    }
});

$(document).on('click', '.deleteRubric', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id')-0;
    var name = $('#rubrics tbody').find('tr#'+id+' .rName').text();
    if ( confirm('Delete "'+name+'"? ') ) {
        $.post( deleteRubricsUrl, {id: id}, function(e) {
            if (e.msg == 'deleted' ) {
                $('#rubrics tbody').find('tr#'+id+'').remove();
            }
        });
    }
});