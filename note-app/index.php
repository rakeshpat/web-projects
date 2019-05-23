<?php
    require_once 'includes/db_connection.php';

    function countNotes() {
        $conn = new DBConnect();
        $pdo = $conn->connect();

        $stmt = $pdo->prepare("SELECT * FROM notes");

        try {
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return $stmt->rowCount();
    }

    function getNoteTitles() {
        $conn = new DBConnect();
        $pdo = $conn->connect();

        $stmt = $pdo->prepare("SELECT * FROM notes ORDER BY id ASC");

        try {
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return $stmt->fetchAll();
    }

    function getNote($id) {
        $conn = new DBConnect();
        $pdo = $conn->connect();

        $stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ?");

        try {
            $stmt->execute([$id]);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return $stmt->fetchAll();
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>OnlineNote - A cloud based notepad</title>
    </head>

    <body>
        <div class="container h-100">
            <div class="row">
                <div class="col py-3 text-right">
                    <h1>OnlineNote</h1>
                </div>
            </div>

            <div class="row" id="notes-container">
                <div class="col py-3 px-0" id="note-headings">

                    <button class="btn btn-primary btn-sm col-6" id="createNote">New</button><?= countNotes() > 1 ? '<button class="btn btn-danger btn-sm col-6" id="deleteNote">Delete</button>' : '' ?>

                    <div class="list-group">
                        <?php
                            $notes = getNoteTitles();
                            foreach ($notes as $note) {
                                ?><a href="index.php?id=<?= $note['id'] ?>" class="list-group-item <?= isset($_GET['id']) && $_GET['id'] == $note['id'] ? 'active' : '' ?>"><?= $note['title'] ?></a><?php
                            }
                        ?>
                    </div>
                </div>

                <div class="col-9 py-3" id="note-contents">
                    <textarea id="title" placeholder="Enter a title here"><?= getNote($_GET['id'])[0]['title'] ?></textarea><button class="btn btn-success btn-sm align-top" id="saveNote">Save</button>
                    <textarea id="body" placeholder="Content for this note goes here!"><?= getNote($_GET['id'])[0]['content'] ?></textarea>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script src="js/script.js"></script>
    </body>
</html>