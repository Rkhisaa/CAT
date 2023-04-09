<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "ufanisischool";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
}

if (isset($_POST['username']) && isset($_POST['Password'])) {
    $username = $_POST['username'];
    $password = $_POST['Password'];

    $query = "SELECT * FROM studentdetails WHERE username=? AND Password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Replace with the dashboard page
    } else {
        $error = "Invalid username or password";
        header("Location: login.php?error=" . urlencode($error));
    }

    $stmt->close();
    $conn->close();
}
?>
