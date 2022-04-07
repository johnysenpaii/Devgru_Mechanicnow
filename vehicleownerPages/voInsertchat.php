<?php 
    session_start();
    include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
    if(isset($_SESSION['custID'])){
        $custID = $_SESSION['custID'];
        $mechID = $_POST['mID'];
        $mechName = $_POST['mechName'];
        $custName = $_SESSION['custFirstname'].' '.$_SESSION['custLastname'];
        $message = $_POST['message'];
        $role = $_POST['role'];
        if(!empty($message)){
            $sql2 = "INSERT INTO chat(custID, mechID, custName, mechName, message, role) VALUES(:custID, :mID, :custName, :mechName, :message, :role)";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':mID',$mechID,PDO::PARAM_STR);
            $query2->bindParam(':custID',$custID,PDO::PARAM_STR);
            $query2->bindParam(':custName',$custName,PDO::PARAM_STR);
            $query2->bindParam(':mechName',$mechName,PDO::PARAM_STR);
            $query2->bindParam(':message',$message,PDO::PARAM_STR);
            $query2->bindParam(':role',$role,PDO::PARAM_STR);
            $query2->execute();
        }
    }else{
        header("location: ./voDashboard.php");
    }
?>