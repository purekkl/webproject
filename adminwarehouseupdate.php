<?php
require_once('components.php');
include('server.php');
session_start();
if(isset($_POST['removeprod'])){
  if($_GET['action']=='remove'){
    $rid = $_GET['id'];
$sqlre = "DELETE FROM Products WHERE ProdID = $rid";
$db->exec($sqlre);
header('location:adminwarehouseupdate.php');
  }
}
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
  } 
        else if($_SESSION['role'] == 'warehouse'){
          echo '
        <section class="home-wrapper-1 py-5">
        <div class="container-xxl">
        <h1 class="text-white">Update Product Data</h1>

      
       <form action="upload.php" method="POST" enctype="multipart/form-data">
       <div class="row mb-5">
      <div class="col-4">
      <h3 class="text-white">Update new Product pictures</h3>
      <div class="form-outline my-2">
          <input type="file" name="mainpic" class="form-control" accept="image/png, image/jpg, image/jpeg">
          <label for="mainpic" class="form-label text-white">Main Picture <span class="text-danger">Note: Only 1 Picture can be upload</span></label>
      </div>
      <div class="form-outline my-2">
          <input type="file" name="inpic[]" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple="multiple">
          <label for="inpic" class="form-label text-white">Picture Inside <span class="text-danger">Note: Only 3 Picture can be upload</span></label>
      </div>
      <p class="text-white">Note : Only Jpeg, Jpg, Png File are allowed</p>
      <button type="submit" name="updateexpro" class="btn btn-success btn-block">Upload</button>
      </div>
      <div class="col-6">
      <h3 class="text-white">ID of Product</h3>
         
        <div class="form-outline mb-2">
            <input type="text" name="newproid" class="form-control" placeholder="ID">
        </div>
        <h3 class="text-white">Update new Product data</h3>
        <div class="form-outline mb-2">
        <input type="text" name="newproname" class="form-control" placeholder="Name">

    </div>
    <div class="form-outline mb-2">
    <input type="text" name="newprodesc" class="form-control" placeholder="Description">

</div>
<div class="form-outline mb-2">
<input type="text" name="newproprice" class="form-control" placeholder="Price">

</div>
<div class="form-outline mb-2">
<input type="text" name="newproqty" class="form-control" placeholder="Quantity">

</div>
<div class="form-outline mb-2">
<select class="form-select form-select-lg" aria-label=".form-select-lg example" name="newprocate">
<option selected value="nochange">No change</option>
<option value="Nintendo">Nintendo</option>
<option value="PC">PC</option>
<option value="PlayStation">PlayStation</option>
<option value="Xbox">Xbox</option>
</select>
<label for="username" class="form-label text-white">Category</label>
</div>
        </form>
      </div>
      
      </div>
     
      
      
      
        <form action="" method="POST">
        <div class="row w-75 m-auto">
      
      <div class="col-6">
      <select class="form-select form-select-lg mb-5" aria-label=".form-select-lg example" name="selectcate">
      <option selected value="all">Select Category</option>
      <option value="Nintendo">Nintendo</option>
      <option value="PC">PC</option>
      <option value="PlayStation">PlayStation</option>
      <option value="Xbox">Xbox</option>
    </select>
    
      </div>
      
      <div class="col-4">
      <button type="submit" name="find" class="btn btn-danger btn-block">Find</button>
      </div>
      
      </div>
      </form>
      
        </div>
        </div>
        <div class="container-xxl">
        
        <div class="row">
        <table class="table bg-white">
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Platform</th>
            <th>Qunatity Left</th>
            <th>Remove</th>
          </tr>';
    if (isset($_POST['find'])) {
      $catefind = $_POST['selectcate'];
      if ($catefind == 'Nintendo') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'Nintendo'";
      } elseif ($catefind == 'PC') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'PC'";
      } elseif ($catefind == 'PlayStation') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'PlayStation'";
      } elseif ($catefind == 'Xbox') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'Xbox'";
      }
      else {
        $query = "SELECT * FROM Products";
      }

    } else{
      $query = "SELECT * FROM Products";
    }
    $ret = $db->query($query);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
      echo '<tr>
      <td>' . $row['ProdID'] . '</td>
      <td>' . $row['Prod_Name'] . '</td>
      <td>' . $row['Prod_Category'] . '</td>
      <td>' . $row['Prod_Quantity'] . '</td>
      <td><form action="adminwarehouseupdate.php?action=remove&id='.$row['ProdID'].'" method="POST" 
      class="cart-item"><button type="submit" name="removeprod" class="btn btn-danger"><i class="bi bi-trash"></i></button></form></td>
    </tr>';
    }
    echo '</table>
        </div>
        </div>
        </section>';
  }
  if (isset($_POST['rempro'])) {
    $idpro = $_POST['proid'];
    $quanpro = $_POST['proquan'];
    $quanpro = (int)$quanpro;
    $query = "UPDATE Products SET Prod_Quantity = Prod_Quantity-$quanpro WHERE ProdID = '$idpro'";
    $db->exec($query);
  }
  if (isset($_POST['addpro'])) {
    $idpro = $_POST['proid'];
    $quanpro = $_POST['proquan'];
    $quanpro = (int)$quanpro;
    $query = "UPDATE Products SET Prod_Quantity = Prod_Quantity+$quanpro WHERE ProdID = '$idpro'";
    $db->exec($query);
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