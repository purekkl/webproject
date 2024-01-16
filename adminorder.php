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
    
    echo '
        <section class="home-wrapper-1 py-5">
        <div class="container-xxl">
        <div class="row">

        <div class="col-6">
        <h1 class="text-white py-3">Order Management</h1>
        <form action="" method="POST">
        <input type="text" name="remordid" required="ID is required" class="form-control" placeholder="ID of Order">
        
        
        
      <div class="form-outline mb-4">
      <h1 class="text-white my-3">Select status to update</h1>
          <select class="form-select form-select-lg my-1" aria-label=".form-select-lg example" name="selectstatus">
  <option selected value="new">New</option>
  <option value="shipping">Shipping</option>
  <option value="complete">Complete</option>
</select>
          
      </div>
      <button type="submit" name="updatestatus" class="btn btn-danger btn-block mb-4">Update</button>
      <button type="submit" name="remord" class="btn btn-danger btn-block mb-4 mx-5">Remove Order</button>
      
        </form>
        </div>

        
        </div>
        
        
        <table class="table bg-white">
          <tr>
            <th>OrderID</th>
            <th>CustomerID</th>
            <th>Customer Username</th>
            <th>email</th>
            <th>Date ordered</th>
            <th>Status</th>
            <th>Detail</th>
          </tr>';

          $joinsql = "SELECT co.coid,re.id,re.username,email,date,status FROM customerorder co INNER JOIN Users re on co.id = re.id";
          $result = $db->query($joinsql);
          while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo '<tr>
            
            <td>' . $row['coid'] . '</td>
            <td>' . $row['id'] . '</td>
            <td>' . $row['username'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['date'] . '</td>
            <td>' . $row['status'] . '</td>
            <td><a href="adminorderdetail.php?odetail='.$row['coid'].'">Detail</a></td>
            
          </tr>';
          }

          echo '</table>
          
        </div>
        </section>';}


  if (isset($_POST['updatestatus'])) {
    $oidup = $_POST['remordid'];
    $statusup = $_POST['selectstatus'];
    $query = "UPDATE customerorder SET status = '$statusup' WHERE coid = '$oidup'";
    $db->exec($query);
  }

  if (isset($_POST['remord'])) {
    $idord = $_POST['remordid'];
    $sql11 = "SELECT * FROM customerorder where coid = ".$idord."";
                    $ret11 = $db->query($sql11);
                    while($row11 = $ret11->fetchArray(SQLITE3_ASSOC)){

                        $sql12 = "SELECT * FROM customerorder_product where copid = ".($row11['coid'])."";
                        $ret12 = $db->query($sql12);
                       
                        while($row12 = $ret12->fetchArray(SQLITE3_ASSOC)){
                            
                            $sql13 = "SELECT * FROM Products where ProdID = ".($row12['ProdID'])."";
                            $ret13 = $db->query($sql13);
                            
                            while($row13 = $ret13->fetchArray(SQLITE3_ASSOC)){

                                $orqty = $row12['quantity'];

                              $query = "UPDATE Products SET Prod_Quantity = Prod_Quantity+$orqty  WHERE ProdID = ".($row13['ProdID'])."";
                              $db->exec($query);

                              $query2 = "DELETE FROM customerorder WHERE coid = '$idord'";
                              $query3 = "DELETE FROM customerorder_product WHERE copid = '$idord'";

                              $db->exec($query2);
                              $db->exec($query3);
                                
                            }
                        }

                    }
  }
  ?>

  <?php
  footer();
  ?>

</body>

</html>