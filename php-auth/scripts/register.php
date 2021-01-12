<?php

require_once("config.php");

global $fnError, $lnError, $emailError, $passwdError, $userExistsError, $regSuccess;

$firstName = "";
$lastName = "";
$email = "";
$passwd = "";
$passwdConfirm = "";

$regSuccess = "";
$userExistsError = "";

//adding some kind of token for csrf and sessions for user....

if (isset($_POST["submit"])) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    $passwdConfirm = $_POST["passwdconf"];

    
    if (!preg_match("/^[a-zA-z]*/", $firstName)) {
        $fnerr = '<p class="alert alert-danger"> First name is invalid.</p>';
    }

    if (!preg_match("/^[a-zA-z]*/", $lastName)) {
        $lnerr = '<p class="alert alert-danger"> Last name is invalid.</p>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = '<p class="alert alert-danger">Email format is invalid.</p>';
    }

    if ($passwd != $passwdConfirm) {
        $passwdError = '<p class="alert alert-danger"> Passwords does not match.</p>';
    }
}


if ((preg_match("/^[a-zA-Z ]*$/", $firstName)) && (preg_match("/^[a-zA-Z ]*$/", $lastName)) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && $passwd == $passwdConfirm) {
    $encryptPasswd = password_hash($passwd, PASSWORD_BCRYPT);

    $userCheck = $pdo->prepare("SELECT * FROM users WHERE email =  :email");
    $userCheck->bindParam(':email', $email);
    $userCheck->execute();

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password);");
    $stmt->bindParam(':firstname', $firstName);
    $stmt->bindParam(':lastname', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $encryptPasswd);

    if ($userCheck->rowCount() > 0) {
        //print_r($userCheck->rowCount());
        $userExistsError = '<div class="alert alert-danger"> Email already exists.</div>';
    } else {
        $stmt->execute();
        header("location: index.php");
    }

    //print_r($stmt->rowCount());
}
