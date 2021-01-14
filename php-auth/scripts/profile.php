<?php

include("config.php");


global $fnError, $lnError, $emailError, $ageRangeError, $ageError, $imageError;

if (isset($_POST["update"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $address = $_POST["address"];

    $userId = $_SESSION['user']['id'];

    if (!empty($_POST['firstName'])) {
        if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
            $fnError = '<p class="alert alert-danger"> First name is invalid.</p>';
        } else {
            $stmt = $pdo->prepare("UPDATE users SET first_name=:firstName WHERE user_id=:userId;");
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $_SESSION['user']['firstname'] = $firstName;
        }
    }

    if (!empty($_POST['lastName'])) {
        if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
            $lnError = '<p class="alert alert-danger"> Last name is invalid.</p>';
        } else {
            $stmt = $pdo->prepare("UPDATE users SET last_name=:lastName WHERE user_id=:userId;");
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $_SESSION['user']['lastname'] = $lastName;
        }
    }

    if (!empty($_POST['email'])) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = '<p class="alert alert-danger"> Email format is invalid.</p>';
        } else {
            $stmt = $pdo->prepare("UPDATE users SET email=:email WHERE user_id=:userId;");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $_SESSION['user']['email'] = $email;
        }
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

    //$targetDir = "/image/";
    $imageName = $_FILES["image"]["name"];
    $allowedExtensions = array("png","jpg","jpeg");
    $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    if (!in_array($fileExtension, $allowedExtensions)) {
        $imageError = '<p class="alert alert-danger"> Image extension not allowed.</p>';
    } else if (($_FILES["image"]["size"] > 5000000)) { 
        $imageError = '<p class="alert alert-danger"> Image size cannot be more than 5MB.</p>';
    } else {
        $target = "image/" . basename($_FILES["image"]["name"]);
        $stmt = $pdo->prepare("UPDATE users SET image=:image WHERE user_id=:userId;");
        $stmt->bindParam(':image', $target);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        move_uploaded_file($_FILES['image']['tmp_name'] , "image/{$_FILES['image']['name']}");
    }
}

