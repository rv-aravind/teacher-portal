<?php
require_once '../config/database.php';

function getAllStudents() {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM students");
    $stmt->execute();
    return $stmt->fetchAll();
}

function addOrUpdateStudent($name, $subject, $marks) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM students WHERE name = :name AND subject = :subject");
    $stmt->execute(['name' => $name, 'subject' => $subject]);
    $student = $stmt->fetch();

    if ($student) {
        $newMarks = $student['marks'] + $marks;
        $stmt = $pdo->prepare("UPDATE students SET marks = :marks WHERE id = :id");
        $stmt->execute(['marks' => $newMarks, 'id' => $student['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO students (name, subject, marks) VALUES (:name, :subject, :marks)");
        $stmt->execute(['name' => $name, 'subject' => $subject, 'marks' => $marks]);
    }
}

function deleteStudent($id) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'delete':
                $id = $_GET['id'];
                deleteStudent($id);
                header('Location: ../public/home.php');
                exit();
        }
    }
}
function updateStudent($id, $name, $subject, $marks) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("UPDATE students SET name = :name, subject = :subject, marks = :marks WHERE id = :id");
    $stmt->execute(['name' => $name, 'subject' => $subject, 'marks' => $marks, 'id' => $id]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                $name = $_POST['name'];
                $subject = $_POST['subject'];
                $marks = $_POST['marks'];
                addOrUpdateStudent($name, $subject, $marks);
                break;
            case 'edit':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $subject = $_POST['subject'];
                $marks = $_POST['marks'];
                updateStudent($id, $name, $subject, $marks);
                break;
           
        }
    }
    header('Location: ../public/home.php');
}
?>
