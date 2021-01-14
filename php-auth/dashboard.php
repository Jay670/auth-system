<!doctype html>
<html lang="en">
<?php include("./scripts/profile.php"); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Profile</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>
        <?php echo $_SESSION['user']['firstname']; ?>
        <?php echo $_SESSION['user']['lastname']; ?>
        <?php echo $_SESSION['user']['email']; ?>

        <div class="container">
          <div class="row">
            <div class="col-xl-8 offset-xl-2 py-5">
              <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-row">
                <img src="<?php echo $target; ?>" class="rounded float-left img-thumbnail" alt="..."> 
              </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="InputLname">Firstname</label>
                    <input type="text" class="form-control" name="firstName" value="<?php echo $_SESSION['user']['firstname']?>">

                    <?php echo $fnError; ?>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="InputLname">Lastname</label>
                    <input type="text" class="form-control" name="lastName" value="<?php echo $_SESSION['user']['lastname']?>">

                    <?php echo $lnError; ?>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Date of Birth</label>
                    <input type="date" max="3000-12-31" min="1000-01-01" class="form-control" name="dob">

                    <?php echo $ageError; ?>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Age</label>
                    <input type="number" class="form-control" name="age" value="">

                    <?php echo $ageRangeError; ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Select Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image">
                    <label class="custom-file-label" for="customFile">Choose Image</label>
                  </div>

                  <?php echo $imageError; ?>
                </div>
                <div class="form-group">
                  <label for="InputEmail">Email address</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']?>">
                </div>
                <div class="form-group">
                  <label for="InputAddress">Address</label>
                  <textarea class="form-control" name="address" rows="3" maxlength="300"></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="../../../../assets/js/vendor/popper.min.js"></script>
  <script src="../../../../dist/js/bootstrap.min.js"></script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

  <!-- Graphs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
          data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false,
        }
      }
    });
  </script>
</body>

</html>