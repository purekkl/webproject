<?php
require_once('components.php');
include('server.php');
session_start();

if(isset($_POST['add'])){
  if (!isset($_SESSION['username'])){
    header('location:login.php');
    
  }
  if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    
    
  }
  if(isset($_SESSION['cart'])){
    $itme_array_id = array_column($_SESSION['cart'],"cardid"); 
    if(in_array($_POST['cardid'],$itme_array_id)){
      $indexa = array_search($_POST['cardid'],$itme_array_id);
       $_SESSION['cart'][$indexa]['qty'] +=$_POST['qty'];
    }
    else{
    $item_array = array(
      'cardid'=>$_POST['cardid'],
      'qty' => $_POST['qty']
    );
    $_SESSION['cart'][] = $item_array;
    }
  }else{
    $item_array = array(
      'cardid'=>$_POST['cardid'],
      'qty' => $_POST['qty']
    );
    $_SESSION['cart'][0] = $item_array;
 
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
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
<style>
  .inputqty{
    border-radius: 20px;
    width: 80px;
    text-align: center; 
  }
  .desc{
    border-radius: 20px;
  }
</style>
</head>

<body>

<?php
navhead();
?>
      <section class="rec-wrapper py-5 home-wrapper-2">
    <div class="container-xxl">
      <div class="row">
        <div class="col-8">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

<?php
$getid = $_GET['idg'];
$sql ="SELECT * from Products WHERE ProdID = $getid";
$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    $inpic = array($row['Prod_Pic1'],$row['Prod_Pic2'],$row['Prod_Pic3'],$row['Prod_Pic4']);
    $gamepid = $row['ProdID'];
    $gamename = $row['Prod_Name'];
    $gamedesc = $row['Prod_Desc'];
    $gameprice = $row['Prod_Price'];
    $gamecate = $row['Prod_Category'];
    $gameqt = $row['Prod_Quantity'];

    function slidesprop($headerpic)
{
  $citem = '<div class="carousel-item">
  
    <img src="' . $headerpic . '"
      class="img-fluid">
 
</div>';
  echo $citem;
}
}
$gameprice = number_format($gameprice,2);
echo '<div class="carousel-inner p-0">';
$slide = 0;
        foreach($inpic as $inp) {
          if ($slide == 0) {
            echo '<div class="carousel-item active">
            
                <img src="' . $inp . '"
                class="img-fluid d-block p-0">
                  
              </div>';
          } 
          else {
            slidesprop($inp);
          }
          $slide++;
        }
        echo '</div>';
        echo '<div class="carousel-indicators">';
for($i=0;$i < $slide;$i++){
  if($i==0){
  echo '<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>';
  }
  else{
  echo '<button type="button" data-bs-target="#demo" data-bs-slide-to="'.$i.'"></button>';
  }
}
echo '</div>';
  ?>
<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
  <span class="carousel-control-next-icon"></span>
</button>
</div>
        </div>
        <div class="col-4">
<div class="container-xxl">
  <div class="row">
    <div class="col-12">
      <h1 class="text-white"><?=$gamename?></h1>
      <h3 class="text-white">Platform - <?=$gamecate?></h3>
    </div>
    <div class="col-12">
    <h1 class="text-white"><?=$gameprice?> Baht</h1>
    <?php
    if($gameqt){
      echo '<form action="" method="POST">
    <input class="inputqty form-control" type="number" name="qty" value="1" max="<?=$gameqt?>" min="1">
    <button type="submit" class="btn btn-warning mt-2" name="add">Add to Cart<i class="bi bi-cart-fill"></i></button>
          <input type="hidden" name="cardid" value="<?=$gamepid?>">
    </form>';
  }
    else{
      echo '<h1 class="text-danger">Out Of Stock!</h1>';
    }
    ?>
    </div>
  </div>
</div>
        </div>
      </div>
    </div>
    <div class="container-xxl mt-5">
    <h3 class="text-white">Description</h3>
      <div class="row">
        <div class="col-12 bg-white p-5 rounded desc">
          <p class=""><?=$gamedesc?></p>
        </div>
      </div>
    </div>
      </section>
<?php
footer();
?>


    
</body>

</html>