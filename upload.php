<?php
session_start();
include('server.php');

if($_POST['newprocate'] == 'Nintendo'){
    $targetmaindir = "bsadpic/mainpic/Nintendo/";
    $targetindir = "bsadpic/inpic/Nintendo/";       
}
elseif($_POST['newprocate'] == 'PC'){
    $targetmaindir = "bsadpic/mainpic/PC/";
    $targetindir = "bsadpic/inpic/PC/";       
}
elseif($_POST['newprocate'] == 'PlayStation'){
    $targetmaindir = "bsadpic/mainpic/PlayStation/";
    $targetindir = "bsadpic/inpic/PlayStation/";       
}
elseif($_POST['newprocate'] == 'Xbox'){
    $targetmaindir = "bsadpic/mainpic/Xbox/";
    $targetindir = "bsadpic/inpic/Xbox/";   
}

$picnamemain = $_FILES['mainpic']['name'];
$insertpic = "";
$inpicnames = array_filter($_FILES['inpic']['name']);

if(isset($_POST['newpro'])){
    if(!empty($_FILES['mainpic']['name'])){
        $mainpicname = basename($_FILES['mainpic']['name']);
        $targetmainpic = $targetmaindir.$mainpicname;
        $filetypemain = pathinfo($targetmainpic, PATHINFO_EXTENSION);
        $patecombvalue = "'$mainpicname'";
        $allowtype = array('jpg','jpeg','png');
        move_uploaded_file($_FILES['mainpic']['tmp_name'], $targetmainpic);
            
                foreach($_FILES['inpic']['name'] as $key=>$val){
                    $inpicname= basename($_FILES['inpic']['name'][$key]);
                    $targetinpic = $targetindir.$inpicname;

                    $inpictype = pathinfo($targetinpic,PATHINFO_EXTENSION);
                    if(in_array($inpictype,$allowtype)){
                        if(move_uploaded_file($_FILES['inpic']['tmp_name'][$key], $targetinpic)){
                           
                            $insertpic .= ",'$targetinpic'";
                        }
                    }
                 }
                 $newid = $_POST['newproid'];
                 $newname = $_POST['newproname'];
                 $newdesc = $_POST['newprodesc'];
                 $newprc = (float)$_POST['newproprice'];
                 $newqty = (int)$_POST['newproqty'];
                 $newcate = $_POST['newprocate'];

                 $sqlvalue = "("."'$newid',"."'$newname',"."'$newdesc',"."'$newprc',"."'$newqty',"."'$newcate',"."'$targetmainpic'".$insertpic.")";
                $insertsql = "INSERT INTO Products (ProdID,Prod_Name,Prod_Desc,Prod_Price,Prod_Quantity,Prod_Category,Prod_Mainpic,Prod_Pic1,Prod_Pic2,Prod_Pic3,Prod_Pic4) VALUES $sqlvalue";
            $db->exec($insertsql);
            header('location:adminwarehousenew.php');

            
        

    }
}
else if(isset($_POST['updateexpro'])){
    if(!empty($_FILES['mainpic']['name'])){
        $mainpicname = basename($_FILES['mainpic']['name']);
        $targetmainpic = $targetmaindir.$mainpicname;
        $filetypemain = pathinfo($targetmainpic, PATHINFO_EXTENSION);
        $patecombvalue = "'$mainpicname'";
        $allowtype = array('jpg','jpeg','png');
        move_uploaded_file($_FILES['mainpic']['tmp_name'], $targetmainpic);
            $piccount = 1;
                foreach($_FILES['inpic']['name'] as $key=>$val){
                    $inpicname= basename($_FILES['inpic']['name'][$key]);
                    $targetinpic = $targetindir.$inpicname;

                    $inpictype = pathinfo($targetinpic,PATHINFO_EXTENSION);
                    if(in_array($inpictype,$allowtype)){
                        if(move_uploaded_file($_FILES['inpic']['tmp_name'][$key], $targetinpic)){
                           
                            $insertpic .= ",Prod_Pic".(string)$piccount." = '$targetinpic'";
                            $piccount ++;
                        }
                    }
                 }
                 $newid = $_POST['newproid'];
                 $sqlvalue = " ProdID = $newid";
                 
                
                    
                 
                 if(isset($_POST['newproname'])){
                    $newname = $_POST['newproname'];
                    $sqlvalue .= ",Prod_Name = '$newname'";
                 }
                 if(isset($_POST['newprodesc'])){
                    $newdesc = $_POST['newprodesc'];
                    $sqlvalue .= ",Prod_Desc = '$newdesc'";
                 }
                 if(isset($_POST['newproprice'])){
                    $newprc = (float)$_POST['newproprice'];
                    $sqlvalue .= ",Prod_Price = '$newprc'";
                 }
                 if(isset($_POST['newproqty'])){
                    $newqty = (int)$_POST['newproqty'];
                    $sqlvalue .= ", Prod_Quantity = '$newqty'";
                 }
                 if(isset($_POST['newprocate'])){
                    $newcate = $_POST['newprocate'];
                    $sqlvalue .= ",Prod_Category = '$newcate'";
                 }
                 

                 $sqlvalue .= ",Prod_Mainpic = '$targetmainpic'".$insertpic." where ProdID = $newid";
                $insertsql = "UPDATE Products set $sqlvalue";
            $db->exec($insertsql);
            header('location:index.php');

            
        

    }
    else{
        $newid = $_POST['newproid'];
                 $sqlvalue = " ProdID = $newid";
        if(!empty($_POST['newproname'])){
            $newname = $_POST['newproname'];
            $sqlvalue .= ",Prod_Name = '$newname'";
         }
         if(!empty($_POST['newprodesc'])){
            $newdesc = $_POST['newprodesc'];
            $sqlvalue .= ",Prod_Desc = '$newdesc'";
         }
         if(!empty($_POST['newproprice'])){
            $newprc = (float)$_POST['newproprice'];
            $sqlvalue .= ",Prod_Price = '$newprc'";
         }
         if(!empty($_POST['newproqty'])){
            $newqty = (int)$_POST['newproqty'];
            $sqlvalue .= ", Prod_Quantity = '$newqty'";
         }
         if(($_POST['newprocate']) != "nochange"){
            $newcate = $_POST['newprocate'];
            $sqlvalue .= ",Prod_Category = '$newcate'";
         }
         

         $sqlvalue .= " where ProdID = $newid";
        $insertsql = "UPDATE Products set $sqlvalue";
    $db->exec($insertsql);
    header('location:adminwarehouseupdate.php');
    }
}



?>