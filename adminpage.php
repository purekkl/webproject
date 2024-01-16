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
        </section>


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
          </tr>';
          }

          echo '</table>
          
        </div>
        </section>';}

        else if($_SESSION['role'] == 'warehouse'){
          echo '
        <section class="home-wrapper-1 py-5">
        <div class="container-xxl">
        <h1 class="text-white">Product Management</h1>
        <form action="" method="POST">
        <div class="row">
        
        
        <div class="col-4">
        
      <div class="form-outline mb-4">
          <input type="text" name="proid" required="ID is required" class="form-control" placeholder="ID of Product">
          
      </div>
      </div>

        <div class="col-4">
        
      <div class="form-outline mb-4">
          <input type="text" name="proquan" required="Number" class="form-control" placeholder="Quantity">
          
      </div>
      </div>
      

      <div class="col-4">
      <button type="submit" name="addpro" class="btn btn-danger btn-block">Add</button>
      <button type="submit" name="rempro" class="btn btn-danger btn-block mx-4">Remove</button>
      </div>
      </form>
      
       <form action="upload.php" method="POST" enctype="multipart/form-data">
       <div class="row mb-5">
      <div class="col-4">
      <h3 class="text-white">Upload new Product pictures</h3>
      <div class="form-outline my-2">
          <input type="file" name="mainpic" required="required" class="form-control" accept="image/png, image/jpg, image/jpeg">
          <label for="mainpic" class="form-label text-white">Main Picture <span class="text-danger">Note: Only 1 Picture can be upload</span></label>
      </div>
      <div class="form-outline my-2">
          <input type="file" name="inpic[]" required="required" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple="multiple">
          <label for="inpic" class="form-label text-white">Picture Inside <span class="text-danger">Note: Only 3 Picture can be upload</span></label>
      </div>
      <p class="text-white">Note : Only Jpeg, Jpg, Png File are allowed</p>
      <button type="submit" name="newpro" class="btn btn-success btn-block">Upload</button>
      </div>
      <div class="col-6">
      <h3 class="text-white">Upload new Product</h3>
         
        <div class="form-outline mb-2">
            <input type="text" name="newproid" required="Username is required" class="form-control" placeholder="ID">
        </div>
        <div class="form-outline mb-2">
        <input type="text" name="newproname" required="Username is required" class="form-control" placeholder="Name">

    </div>
    <div class="form-outline mb-2">
    <input type="text" name="newprodesc" required="Username is required" class="form-control" placeholder="Description">

</div>
<div class="form-outline mb-2">
<input type="text" name="newproprice" required="Username is required" class="form-control" placeholder="Price">

</div>
<div class="form-outline mb-2">
<input type="text" name="newproqty" required="Username is required" class="form-control" placeholder="Quantity">

</div>
<div class="form-outline mb-2">
<select class="form-select form-select-lg" aria-label=".form-select-lg example" name="newprocate">
<option selected value="Nintendo">Nintendo</option>
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