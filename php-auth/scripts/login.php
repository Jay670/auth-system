<?php
   
    include("config.php");

    global $userCheck, $acctNotExist, $emailPasswdError;

    if(isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $emailcheck = filter_var($email, FILTER_SANITIZE_EMAIL);

        $userCheck = $pdo->prepare("SELECT * FROM users WHERE email =  :email");
        $userCheck->bindParam(':email', $email);
        $userCheck->execute();
    

        if(!empty($email) && !empty($password)){
            
            if($userCheck->rowCount() <= 0) {
                $acctNotExist = '<div class="alert alert-danger"> User account does not exist. </div>';
            } else {

                while($row = $userCheck->fetch(PDO::FETCH_ASSOC)) {
                    $user_id = $row['user_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $email_db = $row['email'];
                    $passwd_db = $row['password'];
                }

                $password = password_verify($password, $passwd_db);

                if($email == $email_db && $password == $passwd_db) {
                    print($first_name);
                    print($last_name);
                    print($email_db);
                    //header("location: dashboard.html");
                } else {
                    $emailPasswdError = '<div class="alert alert-danger"> Email or Password is wrong. </div>';
                }
            }

        } 
    }

?>