<?php
include('server.php');
session_start();

$error = array();
if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
}
if (count($error) == 0){
    $query = "SELECT * FROM Users WHERE username = '$username' and password = '$password'";
    $ret = $db->query($query);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
}

if ($row){
    $_SESSION['userid'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['username'] = $username;
    $_SESSION['tier'] = $row['tier'];
    $_SESSION['success'] = 'You are now logged in';
    header('location:index.php');
} 
else{
    array_push($error,'Wrong username or password');
    $_SESSION['error'] = 'Wrong username or password';
    header('location:login.php');
    
}
?>