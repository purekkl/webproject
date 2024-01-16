<?php
require_once('components.php');
include('server.php');
session_start();
if (!isset($_SESSION['username'])){
  $_SESSION['regmsg'] = 'You must log in first';
  
}
if (isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  
}
if(isset($_POST['add'])){
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
a:hover {
  text-decoration: none;
}

.card{
  border-radius: 10px;
  background: linear-gradient(180deg, #FFFFFF 0%, #909090  52.08%, #3B3A3A  100%)
  
}
.card{
  width: 300px;
  height: 400px;
  background-position: center top;
  background-size: cover;
  overflow: hidden;
  position: relative;
}
.card-details{
  position: absolute;
  bottom: -450px;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 10px 10px;
  background: linear-gradient(90deg, rgba(25, 25, 25, 0.7)0%, rgba(71, 71, 71,0.7)48.44%, rgba(144,144,144,0.7)100%);
  box-shadow: inset -4px -4px 20px rgba(255, 255, 255, 0.35), inset 4px 4px 20px rgba(255, 255, 255, 0.35);
  transition: 0.3s ease-in-out;
}
.card-title{
  position: absolute;
  left: 0;
  text-align: center;
  bottom: 20;
  width: 100%;
  height: 18%;
  text-transform: uppercase;
  transition: 0.3 ease-in-out;
  background: transparent;
}
.card-title h3{
  font-size: 20px;
  font-weight: bold;
  color: #fff;
}
.card:hover .card-title{
  bottom: -100px;
}
.card:hover .card-details{
  bottom: 0;
}

.card button{
  position: absolute;
  top: 75%;
  cursor: pointer;
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
}
.card button:nth-child(1){
  margin: 0px 65px 0px;
  position: sticky;
  width: 85px;
  height: 35px;
  float: left;
  background: #ff00b8;
  border-radius: 20px;
  border: none;
  transition: transform .5s;
}
.card button:nth-child(2){
  margin: 0px 65px 0px;
  position: sticky;
  width: 85px;
  height: 35px;
  float: right;
  background: #00c2ff;
  border-radius: 20px;
  border: none;
  transition: transform .5s;
}
.card button:nth-child(1):hover{
  color: #ff00b8;
  background: #fff;
  transition: .4s;
  transform: scale(1.1);
}
.card button:nth-child(2):hover{
  color: #00c2ff;
  background: #fff;
  transition: .4s;
  transform: scale(1.1);
}
.card:hover .card-details{
  bottom: 0;
}

.details h1{
  position: absolute;
  width: 100%;
  top: 5%;
  text-transform: uppercase;
  text-align: center;
  font-size: 25px;
  color: #fff;
}
.details p{
  position: absolute;
  width: 70%;
  margin-left: 15%;
  margin-right: 15%;
  top: 25%;
  text-align: center;
  color: #e7e7e7;
  font-weight: bold;
  font-family: Roboto;
  font-size: 18px;
}
.details h2{
  position: absolute;
  top: 50%;
  text-align: center;
  width: 100%;
  color: #fff;
  font-size: 25px;
}
.details h2 span{
  font-size: 25px;
}


.card button {
  position: absolute;
  left: 50%;
  bottom: 20px;
  transform: translateX(-50%);
  cursor: pointer;
  color: black;
  font-weight: bold;
  text-transform: uppercase;
}


.card-details input[type="number"] {
  position: absolute;
  left: 50%;
  bottom: 115px;
  transform: translateX(-50%);
}

.card button {
  position: absolute;
  bottom: 20px;
  left: calc(50% - 42.5px); /* กำหนดให้ปุ่มอยู่ตรงกลางของ Card */
  transform: translateX(0);
  cursor: pointer;
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
}

.imggame {
  max-width: 100%;
  height: auto;
}


.boxqty
{
  border-radius: 6px;
  border: none;
}

</style>

</head>

<body>

<?php
navhead();
?>
<section class="home-wrapper-1 pt-5">
        <div class="container-xxl">
          <h1 class="text-center text-white pt-5">คุณอาจชอบ</h1>
          <div class="row w-75 m-auto">
            <div class="col">
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                <div class="carousel-item active">
                  <a href="prop.php?idg=101">
                  <img src="picture/supersmash.avif" class="img-fluid d-block p-0" alt="..." style="width:100%;" />
                </a>
                </div>
                <div class="carousel-item">
                <a href="prop.php?idg=102">
                    <img src="picture/animalcross.avif" class="img-fluid d-block p-0" alt="..." style="width:100%;"/>
                  </a>
                  </div>
                  <div class="carousel-item">
                  <a href="prop.php?idg=103">
                    <img src="picture/zelda.avif" class="img-fluid d-block p-0" alt="..." style="width:100%;"/>
                    </a>  
                  </div>
                <!-- <?php
                $queryhome = "SELECT * FROM Products order by random() LIMIT 3";
                $check = 0;
                $reth = $db->query($queryhome);
                while($rowh = $reth->fetchArray(SQLITE3_ASSOC)){
                if($check == 0){
                  echo '
                
                  <div class="carousel-item active">
                    <img src="'.$rowh['Prod_Pic1'].'" class="img-fluid d-block h-75 w-100 p-0" alt="..." style="width:100%;" />
                  </div>';
                }
                else{
                  echo '
                  <div class="carousel-item">
                    <img src="'.$rowh['Prod_Pic1'].'" class="img-fluid d-block h-75 w-100 p-0" alt="..." style="width:100%;"/>
                  </div>
                  ';}
                  $check++;
                }
                
                ?> -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="rec-wrapper py-5 home-wrapper-2">
    <div class="container-xxl">
      <div class="row">
        <div class="col-12">
          <h3 class='text-white'>Recommended</h3>
        </div>
<?php

  $query = "SELECT * FROM Products ORDER BY Prod_Name ASC limit 4";
  $ret = $db->query($query);
  while($row = $ret->fetchArray(SQLITE3_ASSOC)){
    prodcard($row['Prod_Name'],$row['Prod_Desc'],$row['Prod_Price'],$row['ProdID'],$row['Prod_Mainpic'],$row['Prod_Quantity']);
  }

?>
      </div>
    </div>
      </section>
<?php
footer();
?>


    
</body>

</html>