<?php
   
    include("config.php");

    global $userCheck, $acctNotExist, $emailPasswdError;

    if(isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $emailCheck = filter_var($email, FILTER_SANITIZE_EMAIL);

        $userCheck = $pdo->prepare("SELECT * FROM users WHERE email =  :email");
        $userCheck->bindParam(':email', $emailCheck);
        $userCheck->execute();
    

        if(!empty($email) && !empty($password)){
            
            if($userCheck->rowCount() <= 0) {
                $acctNotExist = '<div class="alert alert-danger"> User account does not exist. </div>';
            } else {

                while($row = $userCheck->fetch(PDO::FETCH_ASSOC)) {
                    $userId = $row['user_id'];
                    $firstName = $row['first_name'];
                    $lastName = $row['last_name'];
                    $emailDb = $row['email'];
                    $passwdDb = $row['password'];
                }

                $password = password_verify($password, $passwdDb);

                if($email == $emailDb && $password == $passwdDb) {
                    $_SESSION['user']['id'] = $userId;
                    $_SESSION['user']['firstname'] = $firstName;
                    $_SESSION['user']['lastname'] = $lastName;
                    $_SESSION['user']['email'] = $emailDb;
                    
                    header("location: dashboard.php");
                } else {
                    $emailPasswdError = '<div class="alert alert-danger"> Email or Password is wrong. </div>';
                }
            }

        } 
    }

?>