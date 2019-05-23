<?php

require_once 'db_connection.php';

$conn = new DBConnect();
$pdo = $conn->connect();

switch ($_POST['action']) {
    case 'createNote':
        $defaultTitle = "New Note";
        $stmt = $pdo->prepare("INSERT INTO notes (title, content) VALUES (?,?)");
        $stmt->execute([$defaultTitle, '']);

        $lastId = $pdo->lastInsertId();
        echo $lastId;
        break;

    case 'deleteNote':
        $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        break;

    case 'saveNote':
        $stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['content'], $_POST['id']]);
        break;
}