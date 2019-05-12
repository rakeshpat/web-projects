$(function() {
    alert('testing');
});

$('#createNote').click(function() {
    $.post('ajax.php', {action: 'createNote'})
        .success(function(data) {
            // prepend a href item to the sidebar and create new title and content textareas for this item
        });
});