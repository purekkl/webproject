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
  <style>
    


    main.table {
    width: 800vw;
    height: 90vh;
    background-color: #fff5;

    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border-radius: .8rem;

    overflow: hidden;
}

.table__header {
    width: 100%;
    height: 10%;
    background-color: #fff4;
    padding: .8rem 1rem;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table__header .input-group {
    width: 35%;
    height: 100%;
    background-color: #fff5;
    padding: 0 .8rem;
    border-radius: 2rem;

    display: flex;
    justify-content: center;
    align-items: center;

    transition: .2s;
}

.table__header .input-group:hover {
    width: 45%;
    background-color: #fff8;
    box-shadow: 0 .1rem .4rem #0002;
}

.table__header .input-group img {
    width: 1.2rem;
    height: 1.2rem;
}

.table__header .input-group input {
    width: 100%;
    padding: 0 .5rem 0 .3rem;
    background-color: transparent;
    border: none;
    outline: none;
}

.table__body {
    width: 95%;
    max-height: calc(89% - 1.6rem);
    background-color: #fffb;

    margin: .8rem auto;
    border-radius: .6rem;

    overflow: auto;
    overflow: overlay;
}

.table__body::-webkit-scrollbar{
    width: 0.5rem;
    height: 0.5rem;
}

.table__body::-webkit-scrollbar-thumb{
    border-radius: .5rem;
    background-color: #0004;
    visibility: hidden;
}

.table__body:hover::-webkit-scrollbar-thumb{ 
    visibility: visible;
}

table {
    width: 100%;
}

td img {
    width: 36px;
    height: 36px;
    margin-right: .5rem;
    border-radius: 50%;

    vertical-align: middle;
}

table, th, td {
    border-collapse: collapse;
    padding: 1rem;
    text-align: left;
}

thead th {
    position: sticky;
    top: 0;
    left: 0;
    background-color: #1abc9c;
    cursor: pointer;
    text-transform: capitalize;
    
}

tbody tr:nth-child(even) {
    background-color: #0000000b;
}

tbody tr {
    --delay: .1s;
    transition: .5s ease-in-out var(--delay), background-color 0s;
}

tbody tr.hide {
    opacity: 0;
    transform: translateX(100%);
}

tbody tr:hover {
    background-color: #fff6 !important;
}

tbody tr td,
tbody tr td p,
tbody tr td img {
    transition: .2s ease-in-out;
}

tbody tr.hide td,
tbody tr.hide td p {
    padding: 0;
    font: 0 / 0 sans-serif;
    transition: .2s ease-in-out .5s;
}

tbody tr.hide td img {
    width: 0;
    height: 0;
    transition: .2s ease-in-out .5s;
}

.status {
    padding: .4rem 0;
    border-radius: 2rem;
    text-align: center;
}

.status.delivered {
    background-color: #86e49d;
    color: #006b21;
}

.status.new{
    background-color: #d893a3;
    color: #b30021;
}

.status.shipping {
    background-color: #ebc474;
}

.status.complete {
    background-color: #46D94C;
}


@media (max-width: 1000px) {
    td:not(:first-of-type) {
        min-width: 12.1rem;
    }
}

thead th span.icon-arrow {
    display: inline-block;
    width: 1.3rem;
    height: 1.3rem;
    border-radius: 50%;
    border: 1.4px solid transparent;
    
    text-align: center;
    font-size: 1rem;
    
    margin-left: .5rem;
    transition: .2s ease-in-out;
}

thead th:hover {
    color: #6c00bd;
}

thead th.active,tbody td.active {
    color: #6c00bd;
}
th{
  text-align: center;
  color: #727171 ;
}
.money{
  text-align: center;
}

  </style>
</head>

<body>
  <?php navhead(); ?>
  
  
<?php

if(isset($_POST['createpo'])){
    $address = $_POST['hnum']." ".$_POST['road']." ".$_POST['district']." ".$_POST['postal'];
    $oddate = date("Y-m-d h:i:sa");
    $sql1 = "INSERT INTO customerorder (id,date,address,status) VALUES (".($_SESSION['userid']).",\"$oddate\",\"$address\",\"new\")";
    $db->exec($sql1);
    $sql2 = "SELECT MAX(coid) as maxid FROM customerorder";
    $ret = $db->query($sql2);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    $lastrowid = $row['maxid'];

    
    if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key => $value){
        $ido = $value['cardid'];
    $qtyo = $value['qty'];
        $sql3 = "INSERT INTO customerorder_product (copid,ProdID,quantity) VALUES ('$lastrowid','$ido','$qtyo')";
        $db->exec($sql3);
        
        $sql4 = "UPDATE Products SET Prod_Quantity = Prod_Quantity - $qtyo where ProdID = $ido";
        $db->exec($sql4);

    }}
    unset($_SESSION['cart']);
}else{

}


?>
<section class="home-wrapper-1 py-5">
    <div class="container-xxl">
        <div class="row">
            <div class="">

                    <?php
                    
                    $sql11 = "SELECT * FROM customerorder where id = ".($_SESSION['userid'])."";
                    $ret11 = $db->query($sql11);
                   $retc = $db->query($sql11);
                   $rowc = $retc->fetchArray(SQLITE3_ASSOC);
                    // if (!empty($ret11->fetchArray(SQLITE3_ASSOC))){
                    //     print_r($ret11->fetchArray(SQLITE3_ASSOC));
                        if(empty($rowc)){
                            echo '<div>
                            <h1 class="text-white">You Have No Order</h1>
                            </div>';
                        }
                        echo '<section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> Order ID </th>
                                    <th> Product </th>
                                    <th> Total Quantity </th>
                                    <th> Status </th>
                                    <th> Amount </th>
                                </tr>
                            </thead>
                            <tbody>';
                    while($row11 = $ret11->fetchArray(SQLITE3_ASSOC)){
                        
                        $sql12 = "SELECT * FROM customerorder_product where copid = ".($row11['coid'])." ";
                        $ret12 = $db->query($sql12);
                       
                        while($row12 = $ret12->fetchArray(SQLITE3_ASSOC)){
                            
                            $sql13 = "SELECT * FROM Products where ProdID = ".($row12['ProdID'])."";
                            $ret13 = $db->query($sql13);
                            
                            while($row13 = $ret13->fetchArray(SQLITE3_ASSOC)){
                                

                                $orpirce = (int)$row13['Prod_Price'];
                                $orqty = (int)$row12['quantity'];
                                echo '
   


                                  <tr>
                                      <td style="text-align: center;">'.$row11['coid'].'</td>
                                      <td> <img src="'.$row13['Prod_Mainpic'].'" alt="">'.$row13['Prod_Name'].'</td>
                                      <td style="text-align: center;"> '.$row12['quantity'].' </td>
                                      <td>
                                          <p class="status '.$row11['status'].'">'.$row11['status'].'</p>
                                      </td>
                                      <td class="money"> <strong> '.number_format($orpirce*$orqty,2).' </strong></td>
                                  </tr>
                             




                          ';
                            }
                        }
            
                    }echo ' </tbody>
                    </table>
                </section>';
                    
                    //


                    //
                
                    ?>
            </div>
            
        </div>
    </div>
</section>



  <?php
  footer();
  ?>

</body>

</html>