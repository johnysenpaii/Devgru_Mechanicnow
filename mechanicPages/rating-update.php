<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
if(isset($_SESSION['mechID'])){
        $mechID = $_SESSION['mechID'];
        $total1 = $_POST['total1'];
        
        if(!empty($total1)){
            $sql2 = "UPDATE mechanic set average = :total1 where mechID = :mechID";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':total1',$total1,PDO::PARAM_STR);
            $query2->bindParam(':mechID',$mechID,PDO::PARAM_STR);
            $query2->execute();
            echo '<script>alert("Successfully");</script>';
        }
        else{
            echo '<script>alert(" Not Successfully");</script>';
        }
    }else{
        header("location: ./mechDashboard.php");
    }

?>