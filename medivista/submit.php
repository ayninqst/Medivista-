<?php

$conn = new mysqli("localhost", "root", "123456", "1ag2_mhip");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['question'])) {

    $question = $_POST['question'];
    $userID = 1; 

    $sql = "INSERT INTO qa (question, status, UserID) 
            VALUES ('$question', 'Pending', '$userID')";

    $conn->query($sql);

    header("Location: qa.php");
    exit();
}
?>