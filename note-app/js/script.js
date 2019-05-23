$('#createNote').click(function() {
    $.ajax({
        type: 'POST',
        url: 'includes/ajax.php',
        data: {
            action: 'createNote'
        },
        success: function(id) {
            window.location.href = 'index.php?id=' + id;
        }
    });
});

$('#deleteNote').click(function() {
    const arr = document.URL.match(/id=([0-9]+)/)
    let id = arr[1];

    $.ajax({
        type: 'POST',
        url: 'includes/ajax.php',
        data: {
            action: 'deleteNote',
            id: id
        },
        success: function() {
            window.location.href = 'index.php';
        }
    });
});

$('#saveNote').click(function() {
    const arr = document.URL.match(/id=([0-9]+)/)
    let id = arr[1];

    $.ajax({
        type: 'POST',
        url: 'includes/ajax.php',
        data: {
            action: 'saveNote',
            id: id,
            title: $('#title').val(),
            content: $('#body').val()
        },
        success: function(data) {
            alert('Saved');
        }
    });
});