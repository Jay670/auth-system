<!doctype html>

<?php include('./scripts/register.php'); ?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Registration</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 py-5">
                <h1> Register </h1>
                <?php echo $userExistsError ?>
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Firstname *</label>
                            <input type="text" class="form-control" name="firstname" placeholder="First Name" required>

                            
                        </div>
                        <?php echo $fnError; ?>
                        <div class="form-group col-md-4">
                            <label for="inputLname">Lastname *</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>

                        </div>
                        <?php echo $lnError; ?>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email address *</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>

                        <?php echo $emailError; ?>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" name="passwd" required>
                    </div>
                    <div class="form-group">
                        <label for="InputPasswordConfirm">Confirm Password</label>
                        <input type="password" class="form-control" name="passwdconf" required>

                        <?php echo $passwdError; ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>