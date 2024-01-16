<?php
require_once('components.php');
include('server.php');
session_start();
if (!isset($_SESSION['username'])){
  header('location:login.php');
  
}
if (isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  
  
}
if(isset($_POST['remove'])){
  if($_GET['action']=='remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value['cardid'] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
          }
      }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
.addresskub{
  margin-left: 100px;
  padding: 20px;
  width: 60%;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 20px;
}
.textkub{
  text-decoration: left;
}
table{
  border-radius: 20px;
}
  </style>
</head>

<body>
  <?php navhead(); ?>
  <?php



          if(isset($_SESSION['cart'])){
            $cardidcart = array_column($_SESSION['cart'],'cardid');
            $totalqty = 0;
            $totalprice = 0;
        }
          if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            echo '<section class="home-wrapper-1 py-5">
            <div class="container-xxl">
                <div class="row text-center mb-5">
                <div class="col-7">
                <br>
                <br>
                <br>
                <h3 class="text-white">Your Cart Item</h3>
                
                <table class="table bg-white" style="padding-bottom: 20px;">
                <tr>
                  <th style="background-color: #1abc9c; border-radius: 20px 0px 0px 0px">Product</th>
                  <th style="background-color: #1abc9c;">Name</th>
                  <th style="background-color: #1abc9c;">Quantity</th>
                  <th style="background-color: #1abc9c;">Price</th>
                  <th style="background-color: #1abc9c;border-radius: 0px 20px 0px 0px">Remove</th>
                </tr>';
            $sql = "SELECT * from Products";
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
            foreach ($_SESSION['cart'] as $key => $value){
                if($row['ProdID'] == $value['cardid']){
                  $fprice = (int)$row['Prod_Price'];
                    $cprice = (int)$value['qty'];
  
                  
                    floatval(preg_replace('/[^\d.],/', '', '"'.$row['Prod_Price'].'"'));
                    $nowprice = $fprice*$cprice;
                    $totalqty += $cprice;
                    $totalprice += $nowprice;              
                          echo '
                          <tr>
                          <td style="width:5%;"><img src="'.$row['Prod_Mainpic'].'" class="img-fluid"></td>
                          <td>'.$row['Prod_Name'].'</td>
                          <td style="text-align:center;">'.$value['qty'].'</td>
                          <td>'.number_format($nowprice,2).'</td>
                          <td><form action="cart.php?action=remove&id='.$row['ProdID'].'" method="post" 
                          class="cart-item"><button type="submit" name="remove" class="btn btn-danger"><i class="bi bi-trash"></i></button></form></td>
                          </tr>
                          ';
                    
                }
            }
            }
            
                echo '<tr>
                <td colspan="2" style="text-align:right;">Total</td>
                <td style="text-align:center;"> '.$totalqty.'</td>
                <td>'.number_format($totalprice,2).'</td>
                </tr>
                
                </table>
                <div class="row">



                </div>
                </div>
                <div class="col-5">
                



                <form action="order.php" method="POST">
                <h1><i class="text-white fa-sharp fa-solid fa-house-chimney-user fa-bounce"></i></h1><h1 class="text-white">Address</h1>
        <div class="addresskub">
        
        <div class="form-outline mb-4">
            <label for="hnum" class="form-label text-white textkub">House Number</label>
            <input type="text" name="hnum" required="House Number is required" class="form-control">
            
        </div >
        <div class="form-outline mb-4">
            <label for="email" class="form-label text-white">Road</label>
            <input type="text" name="road" required="Road is required" class="form-control">
            
            
        </div>
        <div class="form-outline mb-4">
            <label for="district" class="form-label text-white">Subdistrict, District, Province</label>
            <input type="text" name="district" required="Subdistrict, District, Province" class="form-control">
            
            
        </div>
        <div class="form-outline mb-4">
            <label for="postal" class="form-label text-white">Postal Code</label>
            <input type="text" name="postal" required="Postal Code is required" class="form-control" minlength="5">
            
            
        </div>
        <button type="submit" name="createpo" class="btn btn-danger" value="'.$_SESSION['userid'].'">Create Order</button>
        </div>
    </form>



                </div>
                  </div>
              </div>
                    </section>';
            }else{
              echo '<section class="home-wrapper-1 py-5">
              <div class="container-xxl">
              <div class="row h-50 text-center">
              <h1 class="text-white">Your cart is empty</h1>
              </div>
              </div>
              </section>';
            }
      
    


  ?>

  <?php
  footer();
  ?>

</body>

</html>