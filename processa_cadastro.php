<?php
    session_start();
    include("connection.php");

    $name = mysqli_real_escape_string($connection, trim($_POST['user_name']));
    $user = mysqli_real_escape_string($connection, trim($_POST['user_cad']));
    $password = mysqli_real_escape_string($connection, trim(md5($_POST['password_cad'])));

    $sql = "SELECT COUNT(*) AS total FROM users WHERE user = '$user'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row['total'] == 1) {
        $_SESSION['user_exists'] = true;
        header('Location: register.php');
        exit;
    }

    $sql = "INSERT INTO users (name, user, password, date_register) VALUES ('$name', '$user', '$password', NOW())";

    if(mysqli_query($connection, $sql) === TRUE) {
        $_SESSION['status_register'] = true;
    }

    mysqli_close($connection);

    header('Location: register.php');
    exit;
?>