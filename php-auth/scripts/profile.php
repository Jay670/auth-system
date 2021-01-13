<?php

include("config.php");

global $fnError, $lnError, $emailError, $ageRangeError, $ageError;

if (isset($_POST["update"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $image = $_POST["image"];
    $address = $_POST["address"];

    $userId = $_SESSION['user']['id'];

    if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
        $fnError = '<p class="alert alert-danger"> First name is invalid.</p>';
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
        $lnError = '<p class="alert alert-danger"> Last name is invalid.</p>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = '<p class="alert alert-danger"> Email format is invalid.</p>';
    }

    $birthday = new DateTime($dob);
    $today = new DateTime('today');
    $verifyAge = $birthday->diff($today)->y;

    if (!empty($_POST["age"])) {
        if (!filter_var($age, FILTER_VALIDATE_INT, array("options" => array("min_range" => 15, "max_range" => 100))) === false) {
            $ageRangeError = '<p class="alert alert-danger"> Age is invalid.</p>';
        }
        
        if ($age != $verifyAge) {
            $ageError = '<p class="alert alert-danger"> Entered wrong age</p>';
        } else {
            $stmt = $pdo->prepare("UPDATE users SET dob=:dob, age=:age WHERE user_id=:userId;");
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
        }
    }
}

