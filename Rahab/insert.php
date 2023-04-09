<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "ufanisischool";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
}

if (isset($_POST['username']) && isset($_POST['Firstname']) && isset($_POST['Middlename']) && isset($_POST['Surname']) && isset($_POST['dob']) && isset($_POST['ClassForm']) && isset($_POST['School']) && isset($_POST['tuitionreason']) && isset($_POST['Password']) && isset($_POST['confirm_password'])) {
    $username = $_POST['username'];
    $firstname = $_POST['Firstname'];
    $middlename = $_POST['Middlename'];
    $surname = $_POST['Surname'];
    $dob = $_POST['dob'];
    $classForm = $_POST['ClassForm'];
    $school = $_POST['School'];
    $tuitionReason = $_POST['tuitionreason'];
    $password = $_POST['Password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $query = "INSERT INTO studentdetails (username, Firstname, Middlename, Surname, dob, ClassForm, School, tuitionreason, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $username, $firstname, $middlename, $surname, $dob, $classForm, $school, $tuitionReason, $password);
        $stmt->execute();
        $stmt->close();
        header("Location: login.php");
    } else {
        echo "Passwords do not match";
    }
    $conn->close();
}
?>
