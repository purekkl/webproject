<?php
require_once('components.php');
include('server.php');
session_start();
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css"
    integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php navhead(); ?>
  <?php
  if ($_SESSION['role'] == 'customer') {
    echo '<section class="home-wrapper-1 py-5">
<div class="container-xxl">
    <div class="row h-75 text-center">
    <div class="col-12">
<h1 class="text-danger">You do not have the permisson</h1>
    </div>
    </div>
</div>
      </section>';
  } else if($_SESSION['role'] == 'seller') {
    echo '<section class="home-wrapper-1 py-5">
      <div class="container-xxl">
          <div class="row text-center mb-5">
          <div class="col-12">
          <h3 class="text-white">All member</h3>
          <table class="table bg-white">
          <tr>
            <th>id</th>
            <th>username</th>
            <th>email</th>
            <th>tier</th>
          </tr>';
    $query = "SELECT * FROM Users WHERE role = 'customer'";
    $ret = $db->query($query);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
      echo '<tr>
      <td>' . $row['id'] . '</td>
      <td>' . $row['username'] . '</td>
      <td>' . $row['email'] . '</td>
      <td>' . $row['tier'] . '</td>
    </tr>';
    }
    echo '</table>
    </div>
      </div>
      <div class="row">
      <div class="col-4">
      <form action="" method="POST">
      <div class="form-outline mb-4">
          <input type="text" name="removemem" required="ID is required" class="form-control">
          <label class="form-label text-white" for="removemem">Remove Member By ID</label>
          
      </div>
      <button type="submit" name="removemember" class="btn btn-danger btn-block">Remove</button>
      </form>
      </div>


      <div class="col-4">
      <form action="" method="POST">
      <div class="form-outline mb-4">
          <input type="text" name="memupdate" required="ID is required" class="form-control">
          <label class="form-label text-white" for="updaterole">Update Customer tier By ID</label>
          <select class="form-select form-select-lg my-5" aria-label=".form-select-lg example" name="selecttier">
  <option selected value="standard">No Tier</option>
  <option value="silver">Silver Tier</option>
  <option value="gold">Gold Tier</option>
  <option value="platinum">Platinum Tier</option>
</select>
          
      </div>
      <button type="submit" name="updaterole" class="btn btn-danger btn-block">Update</button>
      </form>
      </div>
      </div>
  </div>
        </section>';


  }
  

  if (isset($_POST['removemember'])) {
    $idremove = $_POST['removemem'];
    $query = "DELETE FROM Users WHERE id = '$idremove'";
    $db->exec($query);
  }
  if (isset($_POST['updaterole'])) {
    $idup = $_POST['memupdate'];
    $tierup = $_POST['selecttier'];
    $query = "UPDATE Users SET tier = '$tierup' WHERE id = '$idup'";
    $db->exec($query);
  }
  if (isset($_POST['updatestatus'])) {
    $oidup = $_POST['remordid'];
    $statusup = $_POST['selectstatus'];
    $query = "UPDATE customerorder SET status = '$statusup' WHERE coid = '$oidup'";
    $db->exec($query);
  }

  ?>

  <?php
  footer();
  ?>

</body>

</html>